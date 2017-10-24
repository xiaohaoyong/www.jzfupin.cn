<?php

class index extends Base
{

    public function __construct()
    {
        parent::__construct();
        //未登录用户 && 微信客户端 && 开启微信
        if ($this->site_config['wechat_login'] && is_wechat()) $this->autoReg();//huifu
        if ($this->member_info && empty($this->member_info['phone']) && $this->get('catid') != 14) $this->redirect('/member'.url('index/phone'));//提示去认证手机号
        if ($this->member_info['modelid'] == 7 && $this->member_info['status'] != 1) $this->redirect('/member'.url('index/edit'));//提示去认证手机号
    }

    public function indexAction()
    {
        $member_model = get_cache('member_model');
        if ($this->get('catdir') || $this->get('catid')) {
            $catid = (int)$this->get('catid');
            if (!empty($catid)) {
                $category = $this->category_cache[$catid];
            } else if ($this->get('catdir')) {
                $category_dir = get_cache('category_dir');
                $catid = $category_dir[strtolower($this->get('catdir'))];
                $category = $this->category_cache[$catid];
            }
            if (empty($category)) {
                header('HTTP/1.1 404 Not Found');
                $this->show_message('当前栏目不存在');
            }
            $category['page'] = (int)$this->get('page') ? (int)$this->get('page') : 1;
            if ($category['islook'] && !$this->member_info) {
                $text_message = '会员';
                $callback = '/';
                if ($category['islook'] > 1) {
                    $text_message = $member_model[$category['islook']]['modelname'];
                }

                var_dump($category['islook']);exit;
                $this->show_message('当前栏目只允许'.$text_message.'查看', 1, $callback);
            } else {
                if ($this->member_info && $category['islook'] > 1 && $this->member_info['modelid'] != $category['islook']) {
                    $callback = '/';//直接回首页
                    if ($this->member_info['modelid'] == 7) $callback = url('index', ['catid' => 15]);//医生首页
                    if ($this->member_info['modelid'] == 5) $callback = url('index', ['catid' => 22]);//居民首页
                    $text_message = $member_model[$category['islook']]['modelname'];
                    $this->show_message('当前栏目只允许'.$text_message.'查看', 1, $callback);
                }
            }
            $category['cat'] = $category;
            $this->view->assign($category);
            $this->view->assign($this->listSeo($category, $category['page']));
            if ($category['typeid'] == 1) $this->view->display($category['listtpl']); else if ($category['typeid'] == 2) $this->view->display($category['pagetpl']); else if ($category['typeid'] == 3) {
                header('Location: '.html_entity_decode($category['http']));
            }
        } else if ($this->get('id')) {
            $id = (int)$this->get('id');
            $content = $this->db->setTableName('content')->find($id);
            if (empty($content)) {
                header('HTTP/1.1 404 Not Found');
                $this->show_message('不存在此内容！');
            }
            if (empty($content['status'])) $this->show_message('此内容正在审核中不能查看！');
            $category = $this->category_cache[$content['catid']];
            if ($category['islook'] && !$this->member_info) $this->show_message('当前栏目游客不允许查看');
            $content_add = $this->db->setTableName($category['tablename'])->find($id);
            $content_add = $this->handle_fields($this->content_model[$content['modelid']]['fields'], $content_add);
            $content = $content_add ? array_merge($content, $content_add) : $content;
            $content['page'] = (int)$this->get('page') ? (int)$this->get('page') : 1;
            if (strpos($content_add['content'], '[iAEweb-page]') !== false) {
                $pdata = array_filter(explode('[iAEweb-page]', $content_add['content']));
                $pagenumber = count($pdata);
                $content['content'] = $pdata[$content['page'] - 1];
                $pageurl = $this->view->get_show_url($content, 1);
                $pagelist = iaeweb::load_class('pager');
                $pagelist = $pagelist->total($pagenumber)->url($pageurl)->num(1)->hide()->page($content['page'])->output();
                $this->view->assign('pagelist', $pagelist);
            }
            $content['cat'] = $category;
            $prev_page = $this->db->setTableName('content')->order('id DESC')->getOne(array('id<?', 'modelid='.$content['modelid'], 'status!=0'), $id);
            if ($prev_page) $prev_page['url'] = $this->view->get_show_url($prev_page);
            $next_page = $this->db->setTableName('content')->order('id ASC')->getOne(array('id>?', 'modelid='.$content['modelid'], 'status!=0'), $id);
            if ($next_page) $next_page['url'] = $this->view->get_show_url($next_page);

            //加内链
            if ($this->site_config['site_autolink']) {
                $autolink = get_cache('autolink');
                foreach ($autolink as $v) {
                    //师傅新窗口打开
                    $v_target = "";
                    if ($v['target']) $v_target = " target=\"_blank\"";
                    //移除原有链接
                    $a_keyword[0] = "/<a[^>]*>".$v['keyword']."<\/a>/";
                    $a_url[0] = $v['keyword'];
                    //增加链接
                    $a_keyword[1] = "#".$v['keyword']."#";
                    $a_url[1] = "<a href=\"".$v['url']."\" title=\"".$v['keyword']."\"".$v_target.">".$v['keyword']."</a>";
                    $content['content'] = preg_replace($a_keyword, $a_url, $content['content'], $v['num']);
                }
            }
            /**
             * 增加模板获取顶级栏目
             */
            $parentcat = get_top_cat($category['catid']);

            $this->view->assign($content);
            $this->view->assign($this->showSeo($content, $content['page']));
            $this->view->assign(array('parentid' => $parentcat['catid'], 'catname' => $category['catname'], 'caturl' => $category['url'], 'prev_page' => $prev_page, 'next_page' => $next_page,));
            $this->view->display($category['showtpl']);
        } else {
            if ($this->get('mid') == 5) $this->redirect(url('index/', ["catid" => 22]));
            if ($this->get('mid') == 7) $this->redirect(url('index/', ["catid" => 15]));
            if ($this->member_info['modelid'] == 5) $this->redirect(url('index/', ["catid" => 22]));
            if ($this->member_info['modelid'] == 7) $this->redirect(url('index/', ["catid" => 15]));
            $this->view->assign(array('index' => 1, 'site_title' => $this->site_config['site_title'], 'site_keywords' => $this->site_config['site_keywords'], 'site_description' => $this->site_config['site_description'],));

            $this->view->display('index.html');
        }

    }

    /**
     * 内容搜索
     */
    public function searchAction()
    {
        $kw = urldecode($this->get('kw'));
        if ($kw == '') $this->show_message('请输入要搜索的关键字 如:iaeweb');
        $catid = $catid ? $catid : (int)$this->get('catid');
        $modelid = $modelid ? $modelid : (int)$this->get('modelid');
        $page = (int)$this->get('page') ? (int)$this->get('page') : 1;
        $pagesize = 10;
        $urlparam = array();
        $urlparam['kw'] = $kw;
        $url = url('index/search', $urlparam);
        if ($catid) $this->db->where('catid=?', $catid);
        if ($modelid) $this->db->where('modelid=?', $modelid);
        if ($modelid == 19) $this->db->where('userid=?', $this->member_info['id']);
        $data = $this->db->setTableName('content')->pageLimit($page, $pagesize)->where("`title` LIKE  ?", '%'.$kw.'%')->getAll(null, null, null, array('listorder DESC', 'time DESC'));
        foreach ($data as $key => $t) {
            $data[$key]['url'] = $this->view->get_show_url($t);
        }
        if ($catid) $this->db->where('catid=?', $catid);
        if ($modelid) $this->db->where('modelid=?', $modelid);
        $total = $this->db->setTableName('content')->where("`title` LIKE  ?", '%'.$kw.'%')->count();
        $pagelist = iaeweb::load_class('pager');
        $pagelist = $pagelist->total($total)->url($url.'&page=[page]')->hide(true)->num($pagesize)->page($page)->output();
        $this->view->assign($this->listSeo($cat, $page, $kw));
        $this->view->assign(array('kw' => $kw, 'pagelist' => $pagelist, 'data' => $data, 'num' => $total, 'site_title' => '搜索 '.$kw.' - '.$this->site_config['site_name'], 'site_keywords' => $kw, 'site_description' => '搜索 '.$kw.' - '.$this->site_config['site_name'],));
        $this->view->display('search.html');
    }

    /**
     * 居民搜索
     */
    public function searchjumAction()
    {
        $kw = urldecode($this->get('kw'));
        $poor = urldecode($this->get('poor'));
        $sex = urldecode($this->get('sex'));
        $jkzk = urldecode($this->get('jkzk'));
        if ($kw == '') $this->show_message('请输入要搜索的关键字 如:yiyi');
        $catid = $catid ? $catid : (int)$this->get('catid');
        $modelid = $modelid ? $modelid : (int)$this->get('modelid');
        $page = (int)$this->get('page') ? (int)$this->get('page') : 1;
        $pagesize = 10;
        $urlparam = array();
        $urlparam['kw'] = $kw;
        $url = url('index/searchjum', $urlparam);
        if ($catid) $this->db->where('catid=?', $catid);
        if ($modelid) $this->db->where('modelid=?', $modelid);
        if ($modelid == 19) {
            $this->db->where('userid=?', $this->member_info['id']);
            // if($jkzk != "不限" && !empty($jkzk)) $this->db->where('jkzk=?', $jkzk);
            // if($poor == "是") $this->db->where('poor=?', 1);
            // if($poor == "否") $this->db->where('poor=?', 0);
            // if($sex == "男") $this->db->where('sex=?', 1);
            // if($sex == "女") $this->db->where('sex=?', 2);
        }
        $data = $this->db->setTableName('content_users')->pageLimit($page, $pagesize)->where("`title` LIKE  ?", '%'.$kw.'%')->getAll(null, null, null, array('listorder DESC', 'time DESC'));
        foreach ($data as $key => $t) {
            $data[$key]['url'] = $this->view->get_show_url($t);
        }
        if ($catid) $this->db->where('catid=?', $catid);
        if ($modelid) $this->db->where('modelid=?', $modelid);
        $total = $this->db->setTableName('content')->where("`title` LIKE  ?", '%'.$kw.'%')->count();
        $pagelist = iaeweb::load_class('pager');
        $pagelist = $pagelist->total($total)->url($url.'&page=[page]')->hide(true)->num($pagesize)->page($page)->output();
        $this->view->assign($this->listSeo($cat, $page, $kw));
        $this->view->assign(array('kw' => $kw, 'pagelist' => $pagelist, 'data' => $data, 'num' => $total, 'site_title' => '搜索 '.$kw.' - '.$this->site_config['site_name'], 'site_keywords' => $kw, 'site_description' => '搜索 '.$kw.' - '.$this->site_config['site_name'],));
        $this->view->display('searchjum.html');
    }


    /*
     * 表单提交页面
     */
    public function formAction()
    {
        $modelid = (int)$this->get('modelid');
        $cid = (int)$this->get('cid');
        $form_model = get_cache('form_model');
        $form_model = $form_model[$modelid];
        !empty($form_model) or $this->show_message('表单模型不存在');
        if (!empty($form_model['joinid'])) {
            !empty($cid) or $this->show_message('缺少关联内容id');
            $this->db->setTableName('content')->getOne(array('id=?', 'modelid=?'), array($cid, $form_model['joinid']), 'id') or $this->show_message('关联id不存在');
        }
        if ($this->post('submit')) {
            //$gobackurl = $this->post('gobackurl');
            $gobackurl = html_entity_decode($this->post('gobackurl'));
            if (!empty($form_model['setting']['form']['code']) && !$this->checkCode($this->post('code'))) $this->show_message('验证码不正确', 2, 1);
            if (!empty($form_model['setting']['form']['post']) && !$this->member_info) $this->show_message('只允许会员提交，请注册会员后提交', 2, 1);
            if (!empty($form_model['setting']['form']['time'])) {
                $time = $form_model['setting']['form']['time'] * 60;
                $this->db->setTableName($form_model['tablename'])->where('ip=?', $this->get_user_ip());
                if (!empty($form_model['joinid'])) $this->db->where('cid=?', $cid);
                $ipdata = $this->db->order('time DESC')->getOne('', '', 'time');
                if (time() - $ipdata['time'] < $time) $this->show_message('同一IP在'.$form_model['setting']['form']['time'].'分钟内不能重复提交', 2, 1);
            }
            if (!empty($form_model['setting']['form']['num']) && !empty($form_model['setting']['form']['post']) && $this->member_info) {
                $this->db->setTableName($form_model['tablename'])->where('userid=?', $this->member_info['id']);
                if (!empty($form_model['joinid'])) $this->db->where('cid=?', $cid);
                if ($this->db->getOne('', '', 'id')) $this->show_message('您已经提交过了，不能重复提交', 2, 1);
            }
            $data = $this->post('data');
            $data = $this->post_check_fields($form_model['fields'], $data);
            $data['cid'] = $cid;
            $data['ip'] = $this->get_user_ip();
            $data['userid'] = empty($this->member_info) ? 0 : $this->member_info['id'];
            $data['username'] = empty($this->member_info) ? '' : $this->member_info['username'];
            $data['name'] = empty($this->member_info) ? '' : $this->member_info['name'];
            $data['time'] = time();
            $data['status'] = empty($form_model['setting']['form']['check']) ? 1 : 0;
            if (empty($gobackurl)) $gobackurl = HTTP_REFERER;
            if ($this->db->setTableName($form_model['tablename'])->insert($data, true)) {
                if ($modelid == 3) {
                    if ($this->member_info['modelid'] == 7) $this->createMassage(8, $this->member_info['id'], '/member');
                    if ($this->member_info['modelid'] == 5) $this->createMassage(9, $this->member_info['id'], '/member/?c=index&a=user');
                }

                if ($modelid == 17) {
                    // 点赞功能 写入 concent
                    $likename = 'hates';
                    if ($data['type'] == 1) $likename = 'loves';
                    $this->changeContentNum($likename, $cid);
                } else if ($modelid == 16) {
                    //分享次数
                    $this->changeContentNum('shares', $cid);
                } else if ($modelid == 4) {
                    //评论次数
                    $this->changeContentNum('comment', $cid);
                }

                if ($modelid == 20) {
                    $content_info = $this->db->setTableName('content')->find($cid);
                    $this->createMassage(7, $content_info['uid'], '/?id='.$cid.'&tab=1');//通知 居民
                }

                //村医 回答问题 后通知 居民
                if ($modelid == 14) {
                    $content_info = $this->db->setTableName('content')->find($cid);

                    $this->createMassage(4, $content_info['userid'], '/?id='.$cid.'&tab=3', $content_info['time']);//通知 居民
                }

                //新增预警 判定 后 通知 居民 （血压）
                if ($modelid == 23) {
                    $content_info = $this->db->setTableName('content')->find($cid);

                    $oldw = $this->db->setTableName('form_warning')->order('id DESC')->getOne(array('cid=?'), $data['cid']);
                    if ($oldw) {
                        if ($content_info['uid'] > 0 && ($data['ssy'] < 91 || $data['ssy'] > 141 || $data['szy'] < 61 || $data['szy'] > 91) && ($oldw['ssy'] < 91 || $oldw['ssy'] > 141 || $oldw['szy'] < 61 || $oldw['szy'] > 91)) $this->createMassage(20, $content_info['uid'], '/?id='.$cid.'&tab=2');//通知 居民
                    }
                }

                $this->show_message($data['status'] ? '提交成功' : '提交成功，等待审核', 1, $gobackurl);
            } else {
                $this->show_message('提交失败', 2, 1);
            }
        }
        $this->view->assign(array('code' => $form_model['setting']['form']['code'], 'fields' => $this->get_data_fields($form_model['fields']), 'form_name' => $form_model['modelname'], 'site_title' => $form_model['modelname'].' - '.$this->site_config['site_name'], 'site_keywords' => $this->site_config['site_keywords'], 'site_description' => $this->site_config['site_description'].' - Powered by iAEweb', 'cid' => $cid,));
        $this->view->display($form_model['showtpl']);
    }

    public function editAction()
    {
        $this->redirect('/member'.url('index/edit'));
    }

    public function licenseAction()
    {
        $license = get_cache('license');
        var_dump($license);
    }

    private function changeContentNum($tablename, $cid)
    {
        $content = $this->db->setTableName('content')->find($cid, $tablename);
        $num = $content[$tablename] + 1;
        $this->db->setTableName('content')->update(array($tablename => $num), 'id=?', $cid);
    }

}