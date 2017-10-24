# iaeweb bakfile
# version:iaeweb x1 
# time:2016-06-07 21:51:05
# http://www.iaeweb.com
# ----------------------------------------


DROP TABLE IF EXISTS `io_admin`;
CREATE TABLE `io_admin` (
  `userid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `roleid` smallint(5) DEFAULT '0',
  `realname` varchar(50) NOT NULL DEFAULT '',
  `auth` text NOT NULL,
  `list_size` smallint(5) NOT NULL,
  `left_width` smallint(5) NOT NULL DEFAULT '180',
  PRIMARY KEY (`userid`),
  KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `io_admin` VALUES('1','admin','c3284d0f94606de1fd2af172aba15bf3','1','超级管理员','','20','180');

DROP TABLE IF EXISTS `io_autolink`;
CREATE TABLE `io_autolink` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `catid` smallint(5) NOT NULL,
  `url` varchar(255) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `rank` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `io_autolink` VALUES('1','0','http://cms.iaeweb.com','轻量级CMS','0');
INSERT INTO `io_autolink` VALUES('2','0','http://cms.iaeweb.com','好用的CMS','0');

DROP TABLE IF EXISTS `io_block`;
CREATE TABLE `io_block` (
  `id` smallint(8) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) NOT NULL,
  `name` varchar(50) NOT NULL,
  `content` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `io_category`;
CREATE TABLE `io_category` (
  `catid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `typeid` tinyint(1) NOT NULL,
  `modelid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `parentid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `child` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `childids` varchar(255) NOT NULL,
  `catname` varchar(30) NOT NULL,
  `image` varchar(100) NOT NULL,
  `content` mediumtext NOT NULL,
  `seo_title` varchar(255) NOT NULL,
  `seo_keywords` varchar(255) NOT NULL,
  `seo_description` varchar(255) NOT NULL,
  `catdir` varchar(30) NOT NULL,
  `http` varchar(255) NOT NULL,
  `items` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `listorder` smallint(5) unsigned NOT NULL DEFAULT '0',
  `ismenu` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `ispost` smallint(2) NOT NULL,
  `verify` smallint(2) NOT NULL DEFAULT '0',
  `islook` smallint(2) NOT NULL,
  `listtpl` varchar(50) NOT NULL,
  `showtpl` varchar(50) NOT NULL,
  `pagetpl` varchar(50) NOT NULL,
  `pagesize` smallint(5) NOT NULL,
  PRIMARY KEY (`catid`),
  KEY `listorder` (`listorder`,`catid`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

INSERT INTO `io_category` VALUES('1','1','1','0','1','2,3,12,','扶贫专栏','','','','','','fupinzhuanlan','','8','0','1','0','0','0','list_news.html','show_news.html','','10');
INSERT INTO `io_category` VALUES('2','1','1','1','0','','预防动态','','','','','','yufangdongtai','','2','0','1','0','0','0','list_news.html','show_news.html','','10');
INSERT INTO `io_category` VALUES('3','1','1','1','0','','预防宣教','','','','','','yufangxuanjiao','','4','0','1','0','0','0','list_news.html','show_news.html','','10');
INSERT INTO `io_category` VALUES('4','1','13','0','1','5,6,8,9,','问诊中心','','','','','','ask','','38','0','1','2','0','1','list_ask.html','show_ask.html','','10');
INSERT INTO `io_category` VALUES('5','1','13','4','0','','快速问诊','','','','','','kuaisuwenzhen','','12','0','1','5','0','1','list_ask.html','show_ask.html','','10');
INSERT INTO `io_category` VALUES('6','1','13','4','0','','问村医','','','','','','wencunyi','','26','0','1','2','0','1','list_ask.html','show_ask.html','','10');
INSERT INTO `io_category` VALUES('7','1','1','0','1','10,11,13,','培训信息','','','','','','learning','','3','0','1','0','0','0','list_learning.html','show_learning.html','','10');
INSERT INTO `io_category` VALUES('8','1','13','4','0','','问专家','','','','','','wenzhuanjia','','0','0','1','0','0','0','list_ask.html','show_ask.html','','10');
INSERT INTO `io_category` VALUES('9','1','13','4','0','','寻医问药','','','','','','xywy','','0','0','1','0','0','0','list_ask.html','show_ask.html','','10');
INSERT INTO `io_category` VALUES('10','1','1','7','0','','医学考试','','','','','','yxks','','1','0','1','0','0','0','list_learning.html','show_learning.html','','10');
INSERT INTO `io_category` VALUES('11','1','18','7','0','','技能培训','','','','','','jnpx','','1','0','1','0','0','0','list_learning.html','show_learning.html','','10');
INSERT INTO `io_category` VALUES('12','1','1','1','0','','健康教育','','','','','','jkjy','','2','0','1','0','0','0','list_news.html','show_news.html','','10');
INSERT INTO `io_category` VALUES('13','1','1','7','0','','学习病例','','','','','','blxx','','1','0','1','0','0','0','list_learning.html','show_learning.html','','10');
INSERT INTO `io_category` VALUES('14','2','0','0','0','','帮扶规则','','&lt;span style=&quot;color:#222222;font-family:Menlo, monospace;line-height:normal;background-color:#FFFFFF;&quot;&gt;帮扶规则&lt;/span&gt;','','','','other','','0','0','1','0','0','0','','','page.html','10');
INSERT INTO `io_category` VALUES('15','2','0','0','1','16,18,17,19,20,21,','医生首页','','','','','医生随时了解病人档案，方便快捷。','doctor','','0','0','1','0','0','7','','','doctor.html','10');
INSERT INTO `io_category` VALUES('16','3','0','15','0','','辖区居民','/data/upload/image/201605/e445cef793baf09c.png','辖区居民&lt;br /&gt;\r\n慢危病控&lt;br /&gt;','','','医生随时了解病人档案，方便快捷。','xiaqujumin','/?catid=25','0','6','1','0','0','0','','','user_list.html','10');
INSERT INTO `io_category` VALUES('17','2','0','15','0','','慢危病控','/data/upload/image/201605/2820965efc776eed.png','辖区居民&lt;br /&gt;\r\n慢危病控&lt;br /&gt;','','','慢危病人的信息，医生随时掌握。','manweibingkong','','0','4','1','0','0','0','','','mawei_list.html','10');
INSERT INTO `io_category` VALUES('18','2','0','15','0','','问诊专家','/data/upload/image/201605/c289c6e046f8c1ad.png','','','','专家在线为您解决疑难问题，解烦忧。','wenzhenzhuanjia','/index.php?catid=8','0','5','1','0','0','0','','','askdoc.html','10');
INSERT INTO `io_category` VALUES('19','3','0','15','0','','预防宣教','/data/upload/image/201605/37494c696e9b7069.png','','','','掌握前沿的知识，法规，提升医生知识面。','yfxj','/index.php?catid=3','0','3','1','0','0','0','','','','10');
INSERT INTO `io_category` VALUES('20','3','0','15','0','','智能分诊','/data/upload/image/201605/bdb3234a91d034fb.png','','','','对部位病情进行精准的分析与讲解。','zhinengfenzhen','http://sjzdsyy.bjwkyy.net/mod/weixin/igman/index.html','0','2','1','0','0','0','','','','10');
INSERT INTO `io_category` VALUES('21','2','0','15','0','','对口支援','/data/upload/image/201605/20adbfd349c2e9c7.png','','','','随时随地了解帮扶信息，病案交流。','duikouzhiyuan','http://yiyi.com/','0','1','1','0','0','0','','','msg.html','10');
INSERT INTO `io_category` VALUES('22','2','0','0','1','23,24,','居民首页','','居民首页','','','','userhome','','0','0','1','0','0','5','','','user_home.html','10');
INSERT INTO `io_category` VALUES('23','2','0','22','0','','寻医问药','/data/upload/image/201605/e8852d7a61e06501.png','寻医问药','','','随时随地找医生咨询问题','askdoc','','0','0','1','0','0','0','','','askdoc.html','10');
INSERT INTO `io_category` VALUES('24','3','0','22','0','','健康档案','/data/upload/image/201605/96291f01a1f599fe.png','','','','自己随时可查看自己身体的各项数据','myfile','/member','0','0','1','0','0','0','','','myfile.html','10');
INSERT INTO `io_category` VALUES('25','1','19','0','0','','辖区居民','','','','','','xqjm','','10','0','1','7','1','7','list_users.html','show_users.html','','100');
INSERT INTO `io_category` VALUES('26','2','0','0','0','','消息中心','','','','','','message','','0','0','1','0','0','0','','','message.html','10');

DROP TABLE IF EXISTS `io_content`;
CREATE TABLE `io_content` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `modelid` smallint(5) NOT NULL,
  `title` varchar(80) NOT NULL DEFAULT '',
  `seourl` varchar(255) NOT NULL,
  `thumb` varchar(255) NOT NULL DEFAULT '',
  `keywords` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL,
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `hits` smallint(5) unsigned NOT NULL DEFAULT '0',
  `loves` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '点赞',
  `hates` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '不喜欢',
  `shares` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '分享次数',
  `comment` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '评论数量',
  `authorid` int(11) NOT NULL DEFAULT '0' COMMENT '运营id',
  `username` char(20) NOT NULL,
  `name` char(50) NOT NULL COMMENT '用户姓名',
  `userid` smallint(5) NOT NULL DEFAULT '0' COMMENT '录入用户id',
  `uid` smallint(5) NOT NULL DEFAULT '0' COMMENT '关联用户id',
  `telme` int(8) NOT NULL DEFAULT '0' COMMENT '0 不大 1 用什么药',
  `phone` varchar(255) NOT NULL COMMENT '用户表手机号',
  `time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `catid` (`catid`,`listorder`,`time`),
  KEY `time` (`catid`,`time`),
  KEY `status` (`catid`,`status`)
) ENGINE=MyISAM AUTO_INCREMENT=68 DEFAULT CHARSET=utf8;

INSERT INTO `io_content` VALUES('1','5','13','医生要问一个东西','','','','医生要问一个东西','0','1','0','0','0','0','0','0','我是医生','','0','0','0','','1463824809');
INSERT INTO `io_content` VALUES('2','3','1','这是测试一下宣传材料','','','','这是测试一下宣传材料','0','1','0','0','0','0','0','0','admin','','0','0','0','','1463827135');
INSERT INTO `io_content` VALUES('3','5','13','我要问 ADSL会计法好撒大立科技返回','','','','安师大发生的发','0','1','0','0','0','0','0','0','我是医生','','0','0','0','','1463829293');
INSERT INTO `io_content` VALUES('4','2','1','测试一下培训信息','','','','测试一下培训信息','0','1','0','0','0','0','0','0','admin','','0','0','0','','1463837201');
INSERT INTO `io_content` VALUES('6','3','1','健康营养的「蔬菜鸡蛋饼」只需要几分钟就搞定啦','','/data/upload/image/201605/08db7a6fda4bda44.jpg','鸡蛋饼,健康,蔬菜','\r\n	\r\n\r\n\r\n	\r\n\r\n\r\n	\r\n		以下内容来自「丁香医生」www.dxy.com\r\n美好的一天，从早餐开始。现代生活节奏快了，家长朋友们经常没有时间给孩子好好准备早餐。今天我们来做一道健康美味营养，最关键是很快手的蔬菜蔬菜鸡蛋饼，很适','0','1','0','0','0','0','0','0','admin','','0','0','0','','1464177647');
INSERT INTO `io_content` VALUES('7','3','1','临床必备诀窍：如何秒算血管活性药物所用剂量？','','','如何','\r\n	你是否遇到过这样的问题，一位危重患者同时泵着几种血管活性药，主任查房时提问你：这个病人血管活性药用量是多少ug/kg/min呢？\r\n\r\n\r\n	如果做足功课，查房之前就准备好答案，自然能够从容应答。又或者你心算超牛，一','0','1','0','0','0','0','0','0','admin','','0','0','0','','1464263048');
INSERT INTO `io_content` VALUES('8','3','1','高钾血症：教你 3 招把钾降下来','','','','\r\n	临床工作中，无论哪一科都会遇到高钾血症的情况，高钾严重时可导致心跳骤停，所以快速有效的降钾刻不容缓，下面就为大家总结一下高血钾的小知识及临床常用的降钾药物。\r\n\r\n\r\n	一、定义\r\n\r\n\r\n	血清钾&gt;5.5mmol/l称为高钾血','0','1','0','0','0','1','0','0','admin','','0','0','0','','1464263090');
INSERT INTO `io_content` VALUES('9','12','1','2016 年 ESC 工作组意见书：冠状动脉非阻塞性心肌梗死','','','心肌梗死,工作组,意见书','\r\n	研究显示，90%左右的急性心肌梗死（AMI）病例冠脉造影显示存在阻塞性冠状脉疾病（CAD），但仍有10%的病例行冠脉造影时未见明显阻塞，研究人员称之为冠状动脉非阻塞性心肌梗死（MINOCA）。近期，欧洲心脏病学会（ES','0','1','0','0','0','0','0','0','admin','','0','0','0','','1464263156');
INSERT INTO `io_content` VALUES('10','12','1','ACCP 2016 抗栓治疗循证指南：深静脉血栓的处理','','','','\r\n	重磅消息：美国胸科医师学院（ACCP）第10版（AT10）VTE抗栓治疗循证指南2016年1月发表，具体内容可见官网介绍。\r\n\r\n\r\n	远端孤立性DVT是否需要抗凝治疗、如何进行抗凝治疗?\r\n\r\n\r\n	1.对于急性下肢远端孤立性DVT患者：\r\n\r\n\r\n	','0','1','0','0','0','0','0','0','admin','','0','0','0','','1464263170');
INSERT INTO `io_content` VALUES('11','2','1','儿童溃疡性结肠炎：对糖皮质激素无反应者上二线治疗','','','结肠炎,儿童','\r\n	溃疡性结肠炎患儿约1/3在15岁前会发生至少1次的急性结肠炎，意大利墨西拿大学附属儿科医院炎症性肠病科的Romano教授等总结了儿童急性结肠炎的生物治疗方法和疗效，其结果发表在近日的Pediatrics杂志上。\r\n\r\n\r\n	儿童严','0','1','0','0','0','0','0','0','admin','','0','0','0','','1464263211');
INSERT INTO `io_content` VALUES('12','10','1','中央国家机关政府采购中心国家医学考试中心2015年度医师和护士相关证书采购项目中标公告','','','政府采购,医学考试,国家,公告,护士','1、项目名称：2015年度医师和护士相关证书采购项目\r\n2、项目编号：GC-FG151053\r\n3、招标公告发布日期：2015年10月21日\r\n4、变更公告发布日期：2015年10月30日\r\n5、开标日期：2015年11月16日\r\n6、中标详情\r\n（1）中标供应商','0','1','0','0','0','0','0','0','admin','','0','0','0','','1464263232');
INSERT INTO `io_content` VALUES('13','11','18','国家医学考试中心关于不再统一组织全国采供血机构从业人员岗位培训考核工作的通知','','','医学考试,国家,机构,中心','根据国家卫生计生委关于修改部门规章的决定，国家卫生计生委不再统一组织全国采供血机构从业人员岗位培训考核工作。依据《血站管理办法》《单采血浆站管理办法》，血站工作人员和单采血浆站关键','0','1','0','0','0','0','0','0','admin','','0','0','0','','1464263292');
INSERT INTO `io_content` VALUES('14','13','1','病例读片大挑战：让医生都意想不到的腹痛原因','','/data/upload/image/201605/8e7c581f3ce6b48c.jpg','','\r\n	好久不读片了，今天来集中学习一下来自丁香园论坛的经典病例。\r\n\r\n\r\n	病例一\r\n\r\n\r\n	患者性别：男\r\n\r\n\r\n	患者年龄：62岁\r\n\r\n\r\n	简要病史：腹痛2天，加重6小时\r\n\r\n\r\n	\r\n感谢站友@mimosafsk提供的病例，文末见答案。\r\n\r\n\r\n	病例二\r\n\r\n\r\n	中','0','1','0','0','0','0','0','0','admin','','0','0','0','','1464263328');
INSERT INTO `io_content` VALUES('15','5','13','测试胰腺癌','','','','','0','0','0','0','0','0','0','0','胡操航','','0','15','0','','1464430821');
INSERT INTO `io_content` VALUES('16','6','13','我要提问','','','','','0','1','0','0','0','0','0','0','胡操航','','0','0','0','','1464431238');
INSERT INTO `io_content` VALUES('17','6','13','间皴允乛','','','','嫒。乙。会计较得失？在意思议……不参','0','1','0','0','0','0','0','0','胡操航','','0','17','0','','1464432100');
INSERT INTO `io_content` VALUES('18','6','13','叠','','','','','0','1','0','0','0','0','0','0','胡操航','','0','0','0','','1464433802');
INSERT INTO `io_content` VALUES('19','6','13','觉得肯定了动力','','','','大家觉得肯定开心','0','1','0','0','0','0','0','0','张秀珍','','0','0','0','','1464448729');
INSERT INTO `io_content` VALUES('20','6','13','觉得肯定了动力','','','','大家觉得肯定开心','0','1','0','0','0','0','0','0','张秀珍','','0','0','0','','1464472646');
INSERT INTO `io_content` VALUES('28','25','19','胡居','','/data/upload/member/26/image/201605/ce1cfa2e35e9ff5913c625b0b035ae4f.jpeg','','㓜你是一切随风雨飘摇','0','1','0','0','0','0','0','0','东北西北','','26','0','0','13343805545','1464572183');
INSERT INTO `io_content` VALUES('24','6','13','到家附近楼房','','','','你弟弟','0','1','0','0','0','0','0','0','星叔','','3','0','0','','1464512191');
INSERT INTO `io_content` VALUES('29','6','13','hhgghe','','','','Sdfgvvvvbvfsd','0','0','0','0','0','0','0','0','阿基利','','28','0','0','','1464575687');
INSERT INTO `io_content` VALUES('30','25','19','好','','/data/upload/member/4/image/201605/c4bd1922470c5b684c730c3fda723d14.jpg','','胡','0','1','0','0','0','0','0','0','1464616597','','4','2','1','18003813904','1464616897');
INSERT INTO `io_content` VALUES('31','25','19','gsdfg','','','','','0','1','0','0','0','0','0','0','1464615240','','1','0','0','13526664104','1464697192');
INSERT INTO `io_content` VALUES('32','6','13','嗓子很不舒服','','','','女28岁。嗓子难受咳血','0','0','0','0','0','0','0','0','1464752054','✨刘婷♏️Tina❤️','18','0','0','','1464760232');
INSERT INTO `io_content` VALUES('33','5','13','嗓子不舒服','','','','女28咳血','0','0','0','0','0','0','0','0','1464752054','✨刘婷♏️Tina❤️','18','0','0','','1464760321');
INSERT INTO `io_content` VALUES('34','6','13','胃疼不舒服，经常胃痉挛','','','','31,女，胃痛','0','0','0','0','0','0','0','0','1464687247','毛毳毳','10','0','0','','1464760361');
INSERT INTO `io_content` VALUES('35','5','13','胃疼不舒服，经常胃痉挛','','','','31,女，胃痛','0','0','0','0','0','0','0','0','1464687247','毛毳毳','10','0','0','','1464760383');
INSERT INTO `io_content` VALUES('36','6','13','vvvvv','','','','宝贝宝贝','0','0','0','0','0','0','0','0','1464752054','✨刘婷♏️Tina❤️','18','0','0','','1464760684');
INSERT INTO `io_content` VALUES('37','6','13','如何治疗失眠','','','','26\"&\"+@','0','0','0','0','0','0','0','0','1464687247','毛毳毳','10','0','0','','1464760716');
INSERT INTO `io_content` VALUES('38','25','19','下次出差','','/data/upload/member/12/image/201606/5bec110a60bf193eb82c7f9e37553fb8.jpeg','','','0','1','0','0','0','0','0','0','1464687339','阿基利','12','0','0','13261235007','1464765114');
INSERT INTO `io_content` VALUES('39','25','19','哈哈哈哈哈','','/data/upload/member/8/image/201606/abb24352638775090d9ffe3f976ffffc.png','','','0','1','0','0','0','0','0','0','1464686694','9.16','8','0','0','13718425252','1464770795');
INSERT INTO `io_content` VALUES('40','6','13','头疼','','','','','0','0','0','0','0','0','0','0','1464778937','杜小瘦','19','0','0','','1464779010');
INSERT INTO `io_content` VALUES('41','6','13','头疼','','','','','0','0','0','0','0','0','0','0','1464778937','杜小瘦','19','0','0','','1464779017');
INSERT INTO `io_content` VALUES('42','5','13','头疼','','','','','0','0','0','0','0','0','0','0','1464778937','杜小瘦','19','0','0','','1464779020');
INSERT INTO `io_content` VALUES('43','5','13','头疼','','','','','0','0','0','0','0','0','0','0','1464778937','杜小瘦','19','0','0','','1464779026');
INSERT INTO `io_content` VALUES('44','6','13','头疼','','','','','0','0','0','0','0','0','0','0','1464778937','杜小瘦','19','0','0','','1464779070');
INSERT INTO `io_content` VALUES('45','6','13','头疼','','','','','0','0','0','0','0','0','0','0','1464778937','杜小瘦','19','0','0','','1464781039');
INSERT INTO `io_content` VALUES('46','6','13','头疼','','','','','0','0','0','0','0','0','0','0','1464778937','杜小瘦','19','0','0','','1464781057');
INSERT INTO `io_content` VALUES('47','5','13','头疼','','','','','0','0','0','0','0','0','0','0','1464778937','杜小瘦','19','0','0','','1464781060');
INSERT INTO `io_content` VALUES('48','5','13','o','','','','','0','0','0','0','0','0','0','0','1464778937','杜小瘦','19','0','0','','1464781101');
INSERT INTO `io_content` VALUES('49','5','13','o','','','','\r\n	测试记录ID\r\n','0','0','0','0','0','0','0','0','admin','杜小瘦','19','0','0','','1464781154');
INSERT INTO `io_content` VALUES('50','6','13','问题','','','','','0','0','0','0','0','0','0','0','1464778937','杜小瘦','19','0','0','','1464781561');
INSERT INTO `io_content` VALUES('51','6','13','问题','','','','','0','0','0','0','0','0','0','0','1464778937','杜小瘦','19','0','0','','1464781721');
INSERT INTO `io_content` VALUES('52','25','19','高猛','','','','','0','1','0','0','0','0','0','0','1464695529','杜小瘦','14','0','0','15083333333','1464782060');
INSERT INTO `io_content` VALUES('53','25','19','，就岌岌可危','','','','','0','1','0','0','0','0','0','0','1464695529','杜小瘦','14','0','0','15236985263','1464782140');
INSERT INTO `io_content` VALUES('54','25','19','，就岌岌可危','','','','','0','1','0','0','0','0','0','0','1464695529','杜小瘦','14','0','0','15236985263','1464782202');
INSERT INTO `io_content` VALUES('55','25','19','高猛','','','','','0','1','0','0','0','0','0','0','1464695529','杜小瘦','14','0','0','15083333333','1464782635');
INSERT INTO `io_content` VALUES('56','25','19','啊吉利','','/data/upload/member/12/image/201606/15ca0ac661a3796015dfdafddb2a8f03.png','','','0','1','0','0','0','0','0','0','1464687339','阿基利','12','0','0','13718300494','1465197411');
INSERT INTO `io_content` VALUES('57','6','13','测试','','','','啊啊啊','0','1','0','0','0','0','0','0','admin','星叔','3','0','0','','1465197992');
INSERT INTO `io_content` VALUES('58','6','13','测试2016-06-06','','','','爱的色放公司邓福','0','0','0','0','0','0','0','0','1464616568','测试','2','0','0','','1465223398');
INSERT INTO `io_content` VALUES('59','6','13','测试2016-06-06','','','','我要问医生测试','0','0','0','0','0','0','0','0','1464616568','测试','2','0','0','','1465223558');
INSERT INTO `io_content` VALUES('60','6','13','测试2016-06-06','','','','我要问医生测试','0','0','0','0','0','0','0','0','1464616568','测试','2','0','0','','1465223726');
INSERT INTO `io_content` VALUES('61','6','13','测试2016-06-06','','','','我要问医生测试','0','0','0','0','0','0','0','0','1464616568','测试','2','0','0','','1465223777');
INSERT INTO `io_content` VALUES('62','6','13','测试2016-06-06','','','','恢复肌肤i放假放假就放回房间','0','0','0','0','0','0','0','0','1464616568','测试','2','0','0','','1465223919');
INSERT INTO `io_content` VALUES('63','5','13','测试2016-06-07','','','','asdfasdfasdf','0','0','0','0','0','0','0','0','1464616568','测试','2','0','0','','1465304263');
INSERT INTO `io_content` VALUES('64','6','13','测试2016-06-07','','','','i老同学可以对他经历了系统协力同心李同学讨论开心','0','0','0','0','0','0','0','0','1464616568','测试','2','0','0','','1465304356');
INSERT INTO `io_content` VALUES('65','6','13','测试2016-06-07','','','','i老同学可以对他经历了系统协力同心李同学讨论开心','0','0','0','0','0','0','0','0','1464616568','测试','2','0','0','','1465304368');
INSERT INTO `io_content` VALUES('66','5','13','测试2016-06-07','','','','解放军队肌肤大静家大静的','0','0','0','0','0','0','0','0','1464616568','测试','2','0','0','','1465304404');
INSERT INTO `io_content` VALUES('67','6','13','测试2016-06-07','','','','你反馈反馈反馈新款','0','0','0','0','0','0','0','0','1464616568','测试','2','0','0','','1465305822');

DROP TABLE IF EXISTS `io_content_ask`;
CREATE TABLE `io_content_ask` (
  `id` mediumint(8) NOT NULL,
  `catid` smallint(5) NOT NULL,
  `content` mediumtext NOT NULL,
  `files` mediumtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `catid` (`catid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `io_content_ask` VALUES('1','5','医生要问一个东西','');
INSERT INTO `io_content_ask` VALUES('3','5','安师大发生的发','');
INSERT INTO `io_content_ask` VALUES('15','0','catid','');
INSERT INTO `io_content_ask` VALUES('16','6','你猜猜','a:2:{s:7:\"fileurl\";a:1:{i:0;s:71:\"/data/upload/member/2/image/201605/39cec679e06ae799c36fa224623dd4d5.jpg\";}s:8:\"filename\";a:1:{i:0;s:9:\"image.jpg\";}}');
INSERT INTO `io_content_ask` VALUES('17','6','嫒。乙。会计较得失？在意思议……不参','a:2:{s:7:\"fileurl\";a:1:{i:0;s:71:\"/data/upload/member/2/image/201605/ddbdacd255bd79721a6472f0d1faa8c6.png\";}s:8:\"filename\";a:1:{i:0;s:9:\"image.png\";}}');
INSERT INTO `io_content_ask` VALUES('18','6','','');
INSERT INTO `io_content_ask` VALUES('19','6','大家觉得肯定开心','');
INSERT INTO `io_content_ask` VALUES('20','6','大家觉得肯定开心','');
INSERT INTO `io_content_ask` VALUES('24','6','你弟弟','a:2:{s:7:\"fileurl\";a:1:{i:0;s:71:\"/data/upload/member/3/image/201605/ad85d4d0b9dc6397d22cc3712e9e5658.jpg\";}s:8:\"filename\";a:1:{i:0;s:9:\"image.jpg\";}}');
INSERT INTO `io_content_ask` VALUES('29','6','Sdfgvvvvbvfsd','a:2:{s:7:\"fileurl\";a:1:{i:0;s:72:\"/data/upload/member/28/image/201605/5078fd4e88481f5ac53234ddcd8f890c.jpg\";}s:8:\"filename\";a:1:{i:0;s:26:\"microMsg.1464523524585.jpg\";}}');
INSERT INTO `io_content_ask` VALUES('32','6','女 28岁。嗓子难受 咳血','a:2:{s:7:\"fileurl\";a:1:{i:0;s:73:\"/data/upload/member/18/image/201606/addfe65eecca41c5e3455cfb3a264215.jpeg\";}s:8:\"filename\";a:1:{i:0;s:35:\"Screenshot_2016-06-01-13-44-36.jpeg\";}}');
INSERT INTO `io_content_ask` VALUES('33','5','女 28 咳血','a:2:{s:7:\"fileurl\";a:1:{i:0;s:73:\"/data/upload/member/18/image/201606/be88229cb8007fa23fc2dfa5eb2917da.jpeg\";}s:8:\"filename\";a:1:{i:0;s:35:\"Screenshot_2016-06-01-11-54-23.jpeg\";}}');
INSERT INTO `io_content_ask` VALUES('34','6','31,女，胃痛','a:2:{s:7:\"fileurl\";a:1:{i:0;s:72:\"/data/upload/member/10/image/201606/bdce4b035ca4e50cbf4bb11adab0df4a.png\";}s:8:\"filename\";a:1:{i:0;s:34:\"Screenshot_2016-06-01-11-45-41.png\";}}');
INSERT INTO `io_content_ask` VALUES('35','5','31,女，胃痛','');
INSERT INTO `io_content_ask` VALUES('36','6','宝贝宝贝','');
INSERT INTO `io_content_ask` VALUES('37','6','26&quot;&amp;&quot;+@','a:2:{s:7:\"fileurl\";a:1:{i:0;s:72:\"/data/upload/member/10/image/201606/d14d9341b96a43b621aaa642cb10306b.png\";}s:8:\"filename\";a:1:{i:0;s:34:\"Screenshot_2016-06-01-11-45-41.png\";}}');
INSERT INTO `io_content_ask` VALUES('40','6','','');
INSERT INTO `io_content_ask` VALUES('41','6','','');
INSERT INTO `io_content_ask` VALUES('42','5','','');
INSERT INTO `io_content_ask` VALUES('43','5','','');
INSERT INTO `io_content_ask` VALUES('44','6','','');
INSERT INTO `io_content_ask` VALUES('45','6','','');
INSERT INTO `io_content_ask` VALUES('46','6','','');
INSERT INTO `io_content_ask` VALUES('47','5','','');
INSERT INTO `io_content_ask` VALUES('48','5','','');
INSERT INTO `io_content_ask` VALUES('49','5','&lt;p&gt;\r\n	测试记录ID\r\n&lt;/p&gt;','');
INSERT INTO `io_content_ask` VALUES('50','6','','a:2:{s:7:\"fileurl\";a:1:{i:0;s:72:\"/data/upload/member/19/image/201606/3ed16f8c087c40dafa6b73efdb428e8c.jpg\";}s:8:\"filename\";a:1:{i:0;s:9:\"image.jpg\";}}');
INSERT INTO `io_content_ask` VALUES('51','6','','a:2:{s:7:\"fileurl\";a:1:{i:0;s:72:\"/data/upload/member/19/image/201606/3ed16f8c087c40dafa6b73efdb428e8c.jpg\";}s:8:\"filename\";a:1:{i:0;s:9:\"image.jpg\";}}');
INSERT INTO `io_content_ask` VALUES('57','6','啊啊啊','');
INSERT INTO `io_content_ask` VALUES('58','6','爱的色放公司邓福','');
INSERT INTO `io_content_ask` VALUES('61','6','我要问医生 测试','');
INSERT INTO `io_content_ask` VALUES('62','6','恢复肌肤 i 放假放假就放回房间','');
INSERT INTO `io_content_ask` VALUES('63','5','asdfasdf asdf','');
INSERT INTO `io_content_ask` VALUES('64','6','i 老同学可以对他经历了系统协力同心李同学讨论开心','');
INSERT INTO `io_content_ask` VALUES('65','6','i 老同学可以对他经历了系统协力同心李同学讨论开心','');
INSERT INTO `io_content_ask` VALUES('66','5','解放军队肌肤大静家大静的','');
INSERT INTO `io_content_ask` VALUES('67','6','你反馈反馈反馈新款','');

DROP TABLE IF EXISTS `io_content_learning`;
CREATE TABLE `io_content_learning` (
  `id` mediumint(8) NOT NULL,
  `catid` smallint(5) NOT NULL,
  `content` mediumtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `catid` (`catid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `io_content_learning` VALUES('13','11','&lt;table cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; style=&quot;border-collapse:separate;margin:0px;padding:0px;width:967px;color:#333333;font-family:\'PingFang SC\', \'Source Han Sans SC\', \'Noto Sans CJK SC\', \'Hiragino Sans GB\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', sans-serif;font-size:12px;background-color:#FFFFFF;&quot;&gt;\r\n	&lt;tbody&gt;\r\n		&lt;tr&gt;\r\n			&lt;td class=&quot;postbody&quot; style=&quot;font-size:14px !important;&quot;&gt;\r\n				&lt;p style=&quot;font-weight:inherit;font-style:inherit;font-family:inherit;vertical-align:baseline;&quot;&gt;\r\n					根据国家卫生计生委关于修改部门规章的决定，国家卫生计生委不再统一组织全国采供血机构从业人员岗位培训考核工作。依据《血站管理办法》《单采血浆站管理办法》，血站工作人员和单采血浆站关键岗位工作人员的岗位培训和考核工作由血站和单采血浆站组织进行。\r\n				&lt;/p&gt;\r\n				&lt;p style=&quot;font-weight:inherit;font-style:inherit;font-family:inherit;vertical-align:baseline;&quot;&gt;\r\n					自2002年-2015年，原卫生部医政司委托国家医学考试中心开展了全国采供血机构从业人员岗位培训考核工作。国家医学考试中心依据卫生部《关于对采供血机构人员进行岗位培训和考核的通知》（卫办医发〔2002〕41号）、《关于规范全国采供血机构从业人员岗位培训与考核工作的通知》（卫办医发〔2007〕89号）等文件，在各省相关部门的大力支持和协助下，国家医学考试中心组织的全国采供血机构从业人员岗位培训考核工作平稳、安全有效。据统计，截至2015年，该项目共考核101507人次，合格人员达77602人，为保证血液安全和全国采供血机构队伍建设做出了一定的贡献。\r\n				&lt;/p&gt;\r\n			&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n	&lt;/tbody&gt;\r\n&lt;/table&gt;');

DROP TABLE IF EXISTS `io_content_news`;
CREATE TABLE `io_content_news` (
  `id` mediumint(8) NOT NULL,
  `catid` smallint(5) NOT NULL,
  `content` mediumtext NOT NULL,
  `images` mediumtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `catid` (`catid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `io_content_news` VALUES('2','3','这是测试一下宣传材料','');
INSERT INTO `io_content_news` VALUES('4','2','测试一下培训信息','a:2:{s:7:\"fileurl\";a:3:{i:0;s:46:\"/data/upload/image/201605/71651fe6ed11dd59.jpg\";i:1;s:46:\"/data/upload/image/201605/585bad2db6e17e34.jpg\";i:2;s:46:\"/data/upload/image/201605/de876341d68423fb.jpg\";}s:8:\"filename\";a:3:{i:0;s:22:\"201110101455422812.jpg\";i:1;s:23:\"1407031631559204039.jpg\";i:2;s:23:\"1407031632036484816.jpg\";}}');
INSERT INTO `io_content_news` VALUES('6','3','&lt;p&gt;\r\n	&lt;img src=&quot;/data/upload/image/201605/08db7a6fda4bda44.jpg&quot; alt=&quot;&quot; /&gt;\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;br /&gt;\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;div&gt;\r\n		以下内容来自「丁香医生」www.dxy.com&lt;br /&gt;\r\n美好的一天，从早餐开始。现代生活节奏快了，家长朋友们经常没有时间给孩子好好准备早餐。今天我们来做一道健康美味营养，最关键是很快手的蔬菜蔬菜鸡蛋饼，很适合成长发育中的孩子。\r\n那么这蔬菜鸡蛋饼怎么做呢？真的非常简单，你只需照着这么几步来。 &lt;br /&gt;\r\n作者：王辘 ，未经许可请勿转载。查看原文：http://dxy.com/column/5345\r\n	&lt;/div&gt;\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;div&gt;\r\n		以下内容来自「丁香医生」www.dxy.com&lt;br /&gt;\r\n1. 面粉 100 克\r\n选择一：普通面粉 50 克、玉米粉 50 克（如图）\r\n选择二：全麦面粉 100 克\r\n选择三：普通白面粉 100 克\r\n如果选用全麦面粉，它的筋度比较低，营养价值比普通白面粉要高；还可以加入粘性较差的玉米粉、其它杂粮粉、绿豆粉、豌豆粉等。\r\n2. 鸡蛋不超过两个，可以加牛奶或豆浆\r\n在面粉中加入鸡蛋，是一个方便又营养的办法。和面时，可以一滴水都不加，直接用温牛奶或豆浆。这样做出来的面团富有弹性，不易粘连，也不会断条或者破皮，口感松软，而且增加了大量的蛋白质，还有 B 族维生素。\r\n但如果是摊饼，就不能加太多的鸡蛋或牛奶，不然会过分筋道和 Q 弹。\r\n3. 蔬菜约 200 克\r\n选择一：胡萝卜、西葫芦 、芹菜，切成末（如图）；\r\n选择二：胡萝卜、青豆、甜玉米粒，可以买速冻的混合蔬菜；\r\n选择三：紫甘蓝、圆白菜、圆葱，切成细丝。\r\n选择四：随心所欲了。前一天晚上做饭剩些边角蔬菜，都可以留着利用起来。同时，为了节约早上时间，提前一晚把蔬菜洗切好，密封起来，放冰箱冷藏。\r\n3. 油：约 20 克，分多次添加\r\n4. 盐、黑胡椒粉、虾皮适量\r\n烹调用具：最好选择平底不粘锅。即使你对做饭不是很娴熟，这样也不会糊锅，而且可以更好地让饼少吸油。&lt;br /&gt;\r\n作者：王辘 ，未经许可请勿转载。查看原文：http://dxy.com/column/5345\r\n	&lt;/div&gt;\r\n&lt;/p&gt;','');
INSERT INTO `io_content_news` VALUES('7','3','&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	你是否遇到过这样的问题，一位危重患者同时泵着几种血管活性药，主任查房时提问你：这个病人血管活性药用量是多少 ug/kg/min 呢？\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	如果做足功课，查房之前就准备好答案，自然能够从容应答。又或者你心算超牛，一秒就能算出来。但不是每个人都有那么强的大脑，也不是每次都能提前准备好，怎么办？今天教你一招，保证能让你一眼看出答案。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	临床工作中，尤其是心血管科室，经常会使用血管活性药，比如多巴胺、肾上腺素、多巴酚丁胺、去甲肾上腺素、硝酸甘油、硝普钠等等，这么多的血管活性药，每种药物的规格及剂量范围都不一样，如多巴胺剂量范围是 1～20 ug/kg/min，肾上腺素是 0.01～0.2 ug/kg/min，这就给使用过程中的剂量计算带来困难。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	那么，窍门来了。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	配置公式：体重（kg）＊A（mg）配制成 50 mL 溶液，每小时走 B mL，那这个药物使用的剂量就是 A*B/3（ug/kg/min）。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	例如：一位 50 kg 的患者，配置多巴胺溶液，需要的多巴胺是 50＊3（A）= 150 mg，150 mg 多巴胺是 15 mL，再加 35 mL 水，配成 50 mL 的溶液，每小时走 3 mL（B），多巴胺的剂量就 A 是 3（A）*3（B）/3 = 3 ug/kg/min. 我们可以计算一下，150 mg 多巴胺，配成 50 mL 的溶液，相当于每 mL 溶液含多巴胺 3 mg，每小时走 3 mL，相当于每小时使用 9 mg 多巴胺，换算成 ug/kg/min，就是（9＊1000）ug/（50 kg*60 min）＝3 ug/kg/min。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	再比如：一个 60 kg 的病人，需要配置去甲肾上腺素溶液泵入，需要的去甲肾上腺素是 60*0.03 mg（A）= 1.8 mg，相当于 0.9 mL 去甲肾上腺素，再加 49.1 mL 水，配制成 50 mL 溶液，每小时走 6 mL（B），相当于 0.03（A）*6（B）/3 = 0.06 ug/kg/min。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	参数 A 可根据不同的药进行调整。\r\n&lt;/p&gt;\r\n&lt;ul class=&quot; list-paddingleft-2&quot; style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	&lt;li&gt;\r\n		&lt;p&gt;\r\n			配置多巴胺，多巴酚丁胺时，A 为 3，即 kg＊3 mg/50 mL。\r\n		&lt;/p&gt;\r\n	&lt;/li&gt;\r\n	&lt;li&gt;\r\n		&lt;p&gt;\r\n			配置肾上腺素，去甲肾上腺素时 A 为 0.03，即 kg＊0.03 mg/50 mL。\r\n		&lt;/p&gt;\r\n	&lt;/li&gt;\r\n	&lt;li&gt;\r\n		&lt;p&gt;\r\n			配置硝酸甘油、硝普钠时 A 为 0.6，即 kg＊0.6 mg/50 mL。&lt;span style=&quot;line-height:1.8;&quot;&gt;硝酸甘油按 kg 乘以 0.6 配置，1 mL/h 相当于 0.2ug /kg/min ，配置浓度可根据常用剂量灵活掌握。&lt;/span&gt;\r\n		&lt;/p&gt;\r\n	&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	按照这样的方式配置血管活性药，套用公式 A*B/3（ug/kg/min），就可以一眼看出血管活性药使用的剂量了。知道了药物的精确剂量，才能充分体现血管活性药物的量效关系，根据病人用药量的增减，判断病情变化。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	下面简单介绍一下临床常用血管活性药的使用以及部分用药体会。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	&lt;strong&gt;1.&amp;nbsp; 多巴胺&lt;/strong&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	多巴胺可以说是最常用的血管活性药，并且随使用剂量的不同，会有不同的α作用机制。小剂量（1～5）ug/kg/min 作用于多巴胺受体，扩张内脏血管，特别是冠状动脉、肾动脉、肠系膜动脉，可增加肾小球滤过率，适用于低心排伴肾功能损害的疾病。中等剂量（1～5）ug/kg/min 时，激动心肌β1 受体和促进去甲肾上腺素释放，表现为正性肌力作用。大剂量时激动α1 受体，收缩血管，减少肾脏血流。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	临床中中小剂量的多巴胺最常用，取其增加心肌收缩力、扩张内脏血管的作用。很少使用大剂量的原因是，大剂量主要用于收缩血管，且其收缩血管的作用不如去甲肾上腺素强，如果必须要收缩血管，不如使用去甲肾上腺素或其他单纯的α1 受体激动剂如去氧肾上腺素。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	&lt;strong&gt;2. 多巴酚丁胺&lt;/strong&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	主要兴奋心脏的β1 受体，正性肌力作用较强，而正性频率的作用相对较弱；&amp;nbsp; 剂量范围为 2～20 μｇ/kg·min，常用剂量＜10 ug/kg·min，可增加心肌收缩力，可增加心排血量和降低毛细血管楔压。&amp;nbsp;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	&lt;strong&gt;3. 肾上腺素&lt;/strong&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	具有强大的α受体和β受体激动作用，是心肺复苏、过敏性休克、心脏手术围术期循环衰竭时的常用药。其α受体激动作用可收缩皮肤、黏膜、肾脏血管，增加外周血管阻力，升高血压。β 受体激动时具有正性肌力和正性频率作用，增加心肌收缩力，增加心排量，改善重要器官如心脏、大脑的灌注。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	肾上腺素常用剂量范围是 0.01～0.2 ug/kg·min，特殊情况下也可增加用量。在抢救严重过敏性休克时，我们肾上腺素曾用到 1 ug/kg·min 才能维持住血压，当然也同时用了大量的抗过敏药。对于心功能特别差，严重低血压，又没有别的方法（如 ECMO，心室辅助）辅助心脏功能，只能使用药物维持的时候，肾上腺素也经常用到 0.5ug/kg·min。这么大剂量使用，在保证心脏、大脑重要器官灌注的同时，也牺牲了肾脏、内脏、皮肤黏膜等次要器官的灌注，需要积极行床旁血滤，维持水电解质酸碱平衡，皮肤末梢注意保暖，并用一些改善微循环的药物如罂粟碱等，防止肢端缺血坏死。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	&lt;strong&gt;4. 去甲肾上腺素&lt;/strong&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	主要激动血管α1 受体，使血管尤其是小动脉和小静脉收缩，也可激动心脏β1 受体，增加心肌收缩力，增快心率，但作用比肾上腺素作用弱。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	去甲肾上腺素常用剂量范围为 0.01～0.2 ug/kg·min。在严重低血压时也可以暂时增加剂量，维持重要器官灌注，但应尽快调整循环状态，避免长时间大剂量使用，尽量减轻其副作用。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	我们的经验是：体外循环后冠状动脉旁路移植术后早期，部分病人给予利尿剂后，可能出现尿量明显增多，容量不足，若持续大量补液可能会出现肺水肿或组织水肿。如果没有心功能低下，仅仅容量不足，可短期小剂量（一般＜0.1ug/kg·min）使用去甲肾上腺素，维持血压，保证心脏灌注，同时慢慢补足容量，逐渐停用去甲肾上腺素，未见明显不良反应发生。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	&lt;strong&gt;5. 硝酸甘油&lt;/strong&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	硝酸酯类应用已有一百余年的历史，可扩张动脉和静脉，减轻心脏前后负荷，并可改变心肌血液分布，有利于缺血区供血，是治疗心绞痛的首选药。个体差异较大，无固定适合剂量，应根据个体的血压，心率和其他血流动力学参数来调整。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	&lt;strong&gt;6. 硝普钠&lt;/strong&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	能直接松弛小动脉和小静脉平滑肌，扩张动静脉的作用较硝酸甘油强，常用剂量范围 0.5～10 ug/kg·min。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	硝普钠可引起冠脉「窃血」现象，恶化缺血区心肌血供，一般不用于冠心病病人。硝普纳还可引起肺泡静脉短路，导致肺内分流，引起低氧血症。若长期大剂量应用，因血中的代谢产物硫氰酸盐过高而发生中毒。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	血管活性药物是把双刃剑，是一剂猛药，正确合理使用可改善血流动力学，同时应避免其副作用。但必须要牢记，血管活性药物不是万能的，最根本的还是解决原发病，比如改善心肌供血，更换合适的瓣膜，改善血流动力学状态，调整心脏前后负荷，调整内环境，控制感染等。在心功能失代偿时，尽快予机械辅助，如 ECMO、IABP、心室辅助装置等治疗，等待心肌功能恢复，必要时行心脏移植。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	更多精彩内容，欢迎关注丁香园心血管频道官方微信号「心血管时间」。\r\n&lt;/p&gt;','');
INSERT INTO `io_content_news` VALUES('8','3','&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	临床工作中，无论哪一科都会遇到高钾血症的情况，高钾严重时可导致心跳骤停，所以快速有效的降钾刻不容缓，下面就为大家总结一下高血钾的小知识及临床常用的降钾药物。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	&lt;strong&gt;一、定义&lt;/strong&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	血清钾 &amp;gt;5.5 mmol/l 称为高钾血症。但是需要注意的是要排除假性高血钾的情况，最常见的为溶血，当 WBC&amp;gt;50×10&lt;sup&gt;9&lt;/sup&gt;/L 或 PLT&amp;gt;1000&lt;span style=&quot;line-height:28px;&quot;&gt;×&lt;/span&gt;10&lt;sup&gt;9&lt;/sup&gt;/L 时，如血液标本放置时间过长可导致溶血，造成假性高血钾，此时需复查血清钾\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	&lt;strong&gt;二、临床表现&lt;/strong&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	症状：不典型，常有心悸、乏力、恶心、肌肉刺痛、感觉异常、严重可至肌无力和麻痹，甚至呼吸肌麻痹，有时可以心跳骤停首发。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	ECG 表现：\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	&lt;span style=&quot;line-height:1.8;&quot;&gt;1. 血清钾﹥5.5-6.5 mmol/L 时出现基底窄而高尖的 T 波。 &amp;nbsp;&amp;nbsp;&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	2. 血清钾 &amp;gt;7-8 mmol/L 时 P-R 间期延长，P 波渐消失，QRS 渐变宽（ R 波渐低，S 波渐深），ST 段与 T 波融合，Q-T 间期缩短。 &amp;nbsp;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	3&lt;span style=&quot;line-height:28px;&quot;&gt;.&amp;nbsp;&lt;/span&gt;血清钾﹥9-10 mmol/L 时，以上改变综合后可使 ECG 呈正弦波形、心室颤动、心脏停搏。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	4&lt;span style=&quot;line-height:28px;&quot;&gt;.&amp;nbsp;&lt;/span&gt;由于许多高钾血症常用时合并代酸，低钙及低钠等，也对 ECG 改变有影响，因此有时必须仔细加以分析，始能确诊。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	&lt;strong&gt;三、治疗&lt;/strong&gt;&amp;nbsp;&amp;nbsp;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	轻症患者治疗原发病，去除能引起血钾继续升高的因素：&lt;span style=&quot;line-height:1.8;&quot;&gt;停（减）经口、静脉的含 K 饮食（香蕉、橘子、橙子、土豆、地瓜等）和药物（保 K 利尿剂和 ACEI 类药物）；&lt;/span&gt;&lt;span style=&quot;line-height:1.8;&quot;&gt;控制感染，减少细胞分解；&lt;/span&gt;&lt;span style=&quot;line-height:1.8;&quot;&gt;供高糖高脂饮食，或采用静脉营养，以确保足够热量，减少体内分解代谢释放的钾。&lt;/span&gt;&lt;span style=&quot;line-height:1.8;&quot;&gt;&amp;nbsp;&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	重症患者需紧急采取下列措施\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	&lt;strong&gt;抗毒药物－钙剂&amp;nbsp;&lt;/strong&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	作用机制：钾离子多是从细胞内转移至细胞外（多见于酸中毒），钙离子具有细胞膜稳定性，稳定细胞膜降低通透性，减少钾离子流出；钾离子和钙离子均为阳离子，注射钙离子会竞争心肌上的阳离子通道，从而减轻钾离子对心脏的毒害作用；提高钙离子浓度可以强化心肌的肌张力，克服钾离子对心脏的抑制作用。用）可预防心脏事件，1-3 min 起效，持续 30-60 min，应作为起始治疗（特别是血清钾 &amp;gt;7 mmol/L 或出现 P 波渐消失、高尖的 T 波、QRS 延长等）\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	用法：10% 葡萄糖酸钙或 5% 氯化钙 10 ml+5%GS 20-40 ml 缓慢静脉推注 10 min，5-10 min 内无效可再次应用（此处需注意血钙迅速升高可加重洋地黄的心脏毒性，故如患者应用洋地黄类制剂，钙剂应用需慎重，推注速度要慢，或避免使\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	&lt;strong&gt;促进钾向细胞内转移药物&lt;span style=&quot;line-height:1.8;&quot;&gt;&amp;nbsp;&lt;/span&gt;&lt;/strong&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	&lt;span style=&quot;line-height:1.8;&quot;&gt;1. 短效胰岛素（RI）+ 葡萄糖：&amp;nbsp;&lt;/span&gt;&lt;span style=&quot;line-height:1.8;&quot;&gt;胰岛素促进葡萄糖转化成糖原的过程中，把钾离子带入细胞内，可以暂时降低血液中的钾离子的浓度。&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	&lt;span style=&quot;line-height:1.8;&quot;&gt;用法：50%GS 50 ml 或 5%-10%GS 500 ml + 短效胰岛素 6--18u（按每 4 g GS 给予 1u 短效胰岛素静滴），10-20 min 起效，持续 4-6 h，适用于血糖 &amp;lt;14 mmol/l 患者。&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	2. β2 受体激动剂：&amp;nbsp;&lt;span style=&quot;line-height:1.8;&quot;&gt;激活 Na+-K+-ATP 酶系统促进钾离子转运进细胞内。&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	&lt;span style=&quot;line-height:1.8;&quot;&gt;用法：沙丁胺醇 10-20 mg 雾化吸入，20 min 起效，持续 90-120 min（心动过速患者慎用）&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	3. 碱剂：&amp;nbsp;&lt;span style=&quot;line-height:1.8;&quot;&gt;造成药物性碱血症，促使 K&lt;sup&gt;+&lt;/sup&gt;&amp;nbsp;进入细胞内；Na&lt;sup&gt;+&lt;/sup&gt;&amp;nbsp;对抗 K&lt;sup&gt;+&lt;/sup&gt;&amp;nbsp;对心脏的的抑制作用；可提高远端肾小管中钠含量，增加 Na&lt;sup&gt;+&lt;/sup&gt;-K&lt;sup&gt;+&lt;/sup&gt;&amp;nbsp;交换，增加尿钾排出量；Na&lt;sup&gt;+&lt;/sup&gt;&amp;nbsp;升高血浆渗透压、扩容，起到稀释性降低血钾作用；Na&lt;sup&gt;+&lt;/sup&gt;有抗迷走神经作用，有利于提高心率。&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	用法：5% 碳酸氢钠 100-200 ml 静点，如同时有代谢性酸中毒和容量不足时，可用 5% 葡萄糖将 5% 碳酸氢钠稀释成 1.25% 溶液静点，也可应用乳酸钠代替（注意先补钙，后纠酸，NaHCO&lt;sup&gt;3&lt;/sup&gt;&amp;nbsp;与 Ca&lt;sup&gt;2+&lt;/sup&gt;&amp;nbsp;不见面）。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	&amp;nbsp;需要注意的是&lt;span style=&quot;line-height:1.8;&quot;&gt;上诉措施仅能使细胞外钾浓度降低，而体内总钾含量未降低，故需促进钾排泄，并严格限制钾的摄入，减少内源性钾产生。&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	&lt;strong&gt;促进钾排泄药物&lt;/strong&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	1. 利尿剂：&lt;span style=&quot;line-height:1.8;&quot;&gt;主要通过抑制肾小管髓袢厚壁段对 NaCl 的主动重吸收，管腔液&amp;nbsp;&lt;span style=&quot;line-height:28px;&quot;&gt;Na&lt;/span&gt;&lt;sup&gt;＋&lt;/sup&gt;、&lt;span style=&quot;line-height:28px;&quot;&gt;、Cl&lt;/span&gt;&lt;sup&gt;－&lt;/sup&gt;浓度升高，而髓质间液&lt;span style=&quot;line-height:28px;&quot;&gt;&amp;nbsp;Na&lt;/span&gt;&lt;sup&gt;＋&lt;/sup&gt;、&lt;span style=&quot;line-height:28px;&quot;&gt;、Cl&lt;/span&gt;&lt;sup&gt;－&lt;/sup&gt;浓度降低，使渗透压梯度差降低，肾小管浓缩功能下降，从而导致水、Na&lt;sup&gt;＋&lt;/sup&gt;、Cl&lt;sup&gt;－&lt;/sup&gt;排泄增多。由于 Na＋重吸收减少，远端小管&amp;nbsp;&lt;span style=&quot;line-height:28px;&quot;&gt;Na&lt;/span&gt;&lt;sup&gt;＋&lt;/sup&gt;浓度升高，促进&amp;nbsp;&lt;span style=&quot;line-height:28px;&quot;&gt;Na&lt;/span&gt;&lt;sup&gt;＋&lt;/sup&gt;-&lt;span style=&quot;line-height:28px;&quot;&gt;K&lt;/span&gt;&lt;sup&gt;＋&lt;/sup&gt;和&amp;nbsp;&lt;span style=&quot;line-height:28px;&quot;&gt;Na&lt;/span&gt;&lt;sup&gt;＋&lt;/sup&gt;-H&lt;sup&gt;＋&lt;/sup&gt;交换增加，K&lt;sup&gt;＋&lt;/sup&gt;和&amp;nbsp;&lt;span style=&quot;line-height:28px;&quot;&gt;H&lt;/span&gt;&lt;sup&gt;＋&lt;/sup&gt;排出增多。&lt;/span&gt;&lt;span style=&quot;line-height:28px;&quot;&gt;首选袢利尿剂（呋塞米、托拉塞米、依他尼酸、布美他尼等）。&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	用法：5% 葡萄糖 20 ml-100 ml+ 呋塞米 40-240 mg 静脉推注，1-5 min 起效，持续 0.5-2 h。用于每日尿量﹥700 ml 者，对尿毒症少尿患者无效。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	2. 钠型交换树脂：&amp;nbsp;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	作用机制：口服后，其分子中的阳离子被氢离子置换。当进入空肠、回肠、结肠时，血液中浓度较高的钾、铵离子透过肠壁又与之发生交换。这些离子被树脂吸收后随粪便排出体外。在肠胃道中各种离于与树脂的结合次序和程度取决于它们的浓度及对树脂的亲和力，钾离子与树脂的亲和力较强，故较易被树脂所吸收。肠道排钾，起效缓慢，需 1-2 h，持续 4-6 h。&lt;span style=&quot;line-height:1.8;&quot;&gt;&amp;nbsp;&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	使用方法：15-30 g/ 次，每日 3 次，20% 山梨醇同时服用可避免便秘；或 50 g+20% 山梨醇灌肠（需注意肠穿孔，近期腹部手术者禁用）。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	3. 透析治疗：当严重高钾血症伴有明显功能损害对上诉治疗反应不佳时，可进行透析治疗。血液透析为最快最有效的方法，腹膜透析疗效相对较差，且效果较慢。应用低&amp;nbsp;&lt;span style=&quot;line-height:28px;&quot;&gt;K&lt;/span&gt;&lt;sup&gt;＋&lt;/sup&gt;或无&amp;nbsp;&lt;span style=&quot;line-height:28px;&quot;&gt;K&lt;/span&gt;&lt;sup&gt;＋&lt;/sup&gt;透析液进行血透，1-2 小时后即可使高&lt;span style=&quot;line-height:28px;&quot;&gt;K&lt;/span&gt;&lt;sup&gt;＋&lt;/sup&gt;血症恢复到正常。&amp;nbsp;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	总结：严重高钾血症可出现危及生命的紧急情况，应紧急处理。临床中如遇到严重高钾血症，应谨记首推钙剂 （未使用洋地黄）；胰岛素 + 葡萄糖、β2 受体激动剂和碱剂；严重心律失常甚至心脏停搏时可紧急安装心脏起搏器或电除颤；呼吸机麻痹可进行呼吸机辅助呼吸；以及紧急透析。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	&lt;span style=&quot;line-height:25.2px;&quot;&gt;扫描下方二维码，关注临床用药微信平台，查看用药经验精彩分享 everyday！关注还可领取 5 个丁当哦！&lt;/span&gt;\r\n&lt;/p&gt;','');
INSERT INTO `io_content_news` VALUES('9','12','&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	研究显示，90% 左右的急性心肌梗死（AMI）病例冠脉造影显示存在阻塞性冠状脉疾病（CAD），但仍有 10% 的病例行冠脉造影时未见明显阻塞，研究人员称之为冠状动脉非阻塞性心肌梗死（MINOCA）。近期，欧洲心脏病学会（ESC）工作组发布了首个关于冠状动脉非阻塞性心肌梗死的意见书，就其定义、临床特征、病因、发生机制及治疗进行阐述，本文为该意见书主要内容。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	&lt;strong&gt;定义&lt;/strong&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	冠脉非阻塞性心肌梗死具体标准如下：\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	1. 急性心肌梗死标准\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	1）心肌损伤标志物阳性（优选肌钙蛋白）\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	2）确切的心梗临床依据，至少满足以下一条：a. 缺血症状；b. 新出现或推测新出现 ST-T 明显变化或新出现左束支传导阻滞；c. 病理性 Q 波形成；d. 新出现的存活心肌减少或室壁运动异常影像学证据；e. 冠脉造影或尸检发现冠脉内血栓。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	2. 冠脉造影显示非阻塞性冠脉疾病\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	任一可能的梗死相关血管造影未见阻塞性冠脉疾病（例如无冠脉狭窄 ≥ 50%），包括冠脉正常（无 &amp;gt;30% 的狭窄）和轻度冠脉粥样硬化（狭窄 &amp;gt;30% 但 &amp;lt;50%）\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	3. 无引起急性心梗临床表现的特殊临床疾病（例如心肌炎和肺栓塞等）\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	&lt;strong&gt;临床特征&lt;/strong&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	冠状动脉非阻塞性心肌梗死患者往往较阻塞性患者年轻，男性发病率稍高于女性。非冠脉阻塞性心肌梗死心电图可表现为 ST 段抬高，也可无 ST 段抬高，女性患者 ST 段抬高与未见抬高的数量比例相似，男性患者 ST 段抬高较多。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	&lt;strong&gt;病因&lt;/strong&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	1. 斑块破裂\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	动脉粥样斑块破裂是导致冠脉非阻塞性心肌梗死的常见病因。通过血管内超声发现约 40% 冠脉非阻塞性心肌梗死患者存在斑块破裂或斑块侵蚀，采用光学相干断层扫描（OCT）等更高分辨率的影像学手段可能检测率更高。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	血栓形成和血栓栓塞在斑块破坏致冠脉非阻塞性心肌梗死中起着主要作用，因此，对于可疑或确诊斑块破裂引起冠脉非阻塞性心肌梗死的患者，推荐双联抗血小板治疗 1 年，之后终身服用单一抗血小板药物，另外还推荐他汀治疗。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	2. 冠脉痉挛\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	冠脉痉挛反映血管平滑肌对内源性缩血管物质或外源性缩血管物质存在高反应性，冠状动脉痉挛激发试验表明 27% 冠脉非阻塞性心肌梗死患者存在可诱导性痉挛，提示冠脉痉挛是冠脉非阻塞性心肌梗死常见且重要的发病机制。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	反复发作的静息心绞痛，服用短效硝酸酯药物后缓解，尤其是发作时出现暂时性缺血性心电图表现，并呈一定节律性（典型表现为夜间心绞痛），若满足以上临床特征，则可考虑诊断为冠脉痉挛。若静息心绞痛发作不频繁，而临床上又怀疑是冠脉痉挛导致的冠脉非阻塞性心肌梗死，可能需行痉挛激发试验辅助诊断，但应避免在心梗急性期实施。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	治疗上主要包括硝酸酯类药物和钙离子拮抗剂，其中钙离子拮抗剂可预防冠脉痉挛性心绞痛患者心脏事件发生。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	3. 冠脉血栓栓塞\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	冠脉血栓形成除了继发于斑块破坏或冠脉痉挛，也可能由遗传性或获得性血栓形成疾病引起，血栓形成倾向筛查研究显示 14% 冠脉非阻塞性心肌梗死患者存在遗传倾向。冠脉栓塞则可能由于冠脉或系统性动脉血栓（房颤或瓣膜疾病引起）脱落导致，也可能因瓣膜赘生物、心脏肿瘤、瓣膜钙化及医源性空气栓塞等引起。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	尽管目前认为冠脉血栓栓塞在冠脉非阻塞性心肌梗死中所占比例较小，这可能与筛查不充分有关，例如冠脉造影未发现小血管血栓形成或栓塞，常规检查未发现主动脉瓣膜疾病或未评估有无血栓形成疾病倾向等，明确这类病因对目标性治疗意义重大。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	4. 冠脉夹层\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	自发性冠脉夹层往往通过管腔阻塞导致急性心肌梗死，但冠脉造影有时未能显示管腔阻塞，因而被诊断为冠脉非阻塞性心肌梗死。冠脉内影像是诊断冠脉夹层的关键。目前冠脉内夹层原因尚未明确，可能与肌纤维发育不良相关。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	绝大多数冠脉夹层发生与动脉粥样硬化无关，因此对于这部分患者不推荐他汀治疗，由于介入治疗可能扩大夹层，因此目前提倡药物保守治疗。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	5. &amp;nbsp;Takotsubo 心肌病（应激性心肌病）\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	Takotsubo 心肌病往往表现为 ST 段改变的急性冠脉综合征，其为急性、可逆性病变，无阻塞性冠脉疾病依据，好发于绝经后女性，预后通常较好。与冠脉阻塞导致的急性心梗相比，Takotsubo 心肌病肌钙蛋白升高幅度较低，左室功能也可能会自行恢复。心脏磁共振检查有助于明确诊断。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	目前尚无 Takotsubo 心肌病最佳治疗循证依据，经验治疗包括避免使用拟交感药物，左室流出道梗阻患者选用 β 受体阻滞剂，持续性左室功能障碍患者选用 ACEI，心源性休克患者选择心脏辅助装置等。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	6. 心肌炎\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	心肌炎可出现急性冠脉综合征样表现，且无阻塞性冠脉疾病。对于存在典型心肌炎表现的患者，应在冠脉造影前或冠脉造影时作出诊断，但大多数情况下无法确诊，而诊断为冠脉非阻塞性心肌梗死。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	心肌炎确诊只能通过心内膜活检，明确诊断对治疗和预后意义重大。尽管 50% 心肌炎患者 2~4 周后可恢复，但也可能进展为需要移植的终末期扩张型心肌病。心肌炎患者可能需要静脉强心药物和 / 或循环辅助支持装置作为恢复或移植前的桥接治疗，而不需要抗缺血治疗。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	7. 其它类型的 2 型急性心肌梗死\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	2 型急性心梗定义为因心肌氧供需失衡导致的心肌细胞坏死，无冠脉斑块破裂及冠脉阻塞等病变。2 型急性心梗的病因包括贫血、快慢综合征、呼吸衰竭、低血压、休克、伴或不伴左室肥厚的重度高血压、重度主动脉瓣疾病、心衰、心肌病以及药物毒素损伤等。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	治疗上，在可能的情况下应纠正导致供氧和需氧失衡的潜在疾病，另外，阿司匹林和 β 受体阻滞剂可能有益，目前尚无针对 2 型急性心梗的循证治疗依据。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	8. 不确定病因的冠脉非阻塞性心肌梗死\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	心脏磁共振不仅能确诊急性心肌梗死，也可能为潜在病因提供线索，钆对比剂延迟强化（LGE）有助于区分血管性和非血管性病因。因此，对于无明确病因的冠脉非阻塞性心肌梗死患者，推荐行心脏磁共振检查。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	&lt;strong&gt;总结&lt;/strong&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	冠脉非阻塞性心肌梗死在急性心肌梗死中占 1%~13%，本文阐述了几种可能的病因，由于不同病因导致的冠脉非阻塞性心肌梗死治疗方案不尽相同 ，因此明确病因才能制定合理的治疗方案。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	对于行超声心动图等初步评估后未能发现明显冠脉非阻塞性心肌梗死病因的患者，推荐常规行心脏磁共振检查。未来需要进一步开展针对冠脉非阻塞性心肌梗死诊断和治疗的多中心研究，以更好地指导治疗并改善患者预后。\r\n&lt;/p&gt;','');
INSERT INTO `io_content_news` VALUES('10','12','&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	重磅消息：美国胸科医师学院（ACCP）第 10 版（AT10）VTE 抗栓治疗循证指南 2016 年 1 月发表，具体内容可见官网介绍。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	&lt;strong&gt;远端孤立性 DVT 是否需要抗凝治疗、如何进行抗凝治疗?&lt;/strong&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	1. 对于急性下肢远端孤立性 DVT 患者：\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	（1）如果无严重症状或血栓进展相关的危险因素，建议 2 周后动态复查深静脉影像学检查，可不给予抗凝治疗（2C 级）；\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	（2）如果有严重症状或血栓进展危险因素，建议初始抗凝治疗而非动态复查（2C 级）。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	血栓进展相关的危险因素包括：年龄 &amp;gt;65 岁，年龄 &amp;gt;75 岁，出血病史，癌症，转移瘤，肾衰竭&amp;nbsp;&lt;span style=&quot;line-height:1.8;&quot;&gt;，&lt;/span&gt;&lt;span style=&quot;line-height:25.2px;&quot;&gt;肝&lt;/span&gt;&lt;span style=&quot;line-height:1.8;&quot;&gt;衰竭，血小板减少，脑卒中病史，糖尿病，贫血，抗血小板治疗，抗凝治疗差，伴有合并症及功能减低，近期手术，频繁跌倒，嗜酒。&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	备注：具有高出血风险的患者更能够从重复影像学检查中获益。如果患者非常不方便进行重复影像学检查，而治疗的不方便性和出血风险较小，则更倾向于选择初始抗凝治疗，优于重复进行影像学检查。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	2. 对于急性下肢远端孤立性 DVT 拟选择初始抗凝治疗者，推荐应用与急性近端 DVT 患者相同的治疗方案（1B 级）。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	3. 急性下肢远端孤立性 DVT 患者进行动态影像学检查之后：\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	（1）如果血栓未见进展，推荐不应用抗凝剂（1B 级）；\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	（2）如果血栓进展但仍局限于远端静脉者，建议应用抗凝剂（2C 级）；\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	（3）如果血栓进展至近端静脉时，推荐应用抗凝剂（1B 级）。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	&lt;strong&gt;急性 DVT 患者的导管溶栓&lt;/strong&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	急性下肢近端 DVT 患者，建议给予单纯抗凝治疗,&amp;nbsp; 而不是首选导管溶栓治疗（CDT）（2C 级）。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	备注：对于可能从 CDT 治疗中获益的患者，以及更在意预防血栓后综合征；相比于治疗的复杂性、操作、费用、出血的风险而言，更重视血栓后综合征的预防的患者，如果其有可能从 CDT 治疗获益，更有可能选择 CDT 而不是抗凝治疗。这里面强调患者的意愿，熟练操作的团队，以及溶栓后更规范的抗凝治疗。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	&lt;strong&gt;下腔静脉滤器作为急性 DVT 或 PE 患者抗凝治疗辅助治疗的价值&lt;/strong&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	急性 DVT 或 PE 已接受抗凝治疗的患者，不推荐放置下腔静脉滤器（1B 级）。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	备注：如果患者已经接受抗凝治疗且病情平稳，更不建议安装下腔静脉滤器，此时提示患者往往不存在抗凝禁忌，且对治疗有较好的反应。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	&lt;strong&gt;弹力袜预防血栓后综合征（PTS）&lt;/strong&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	急性下肢 DVT 患者不建议常规使用弹力袜预防 PTS（2B 级）。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	备注：该建议重点关注预防 PTS 的慢性并发症，而非治疗其症状。若患者有急性或慢性症状，试用梯度加压弹力袜通常是合理的。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	&lt;strong&gt;亚段 PE 是否需要抗凝治疗&lt;/strong&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	亚段 PE（无近端肺动脉受累）且无下肢近端 DVT 的患者：\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	1. 若 VTE 复发风险低，建议临床观察而非抗凝治疗（2C 级）；\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	2. 若 VTE 复发风险高，建议初始抗凝治疗而非临床观察（2C 级）。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	备注：应该进行双下肢深静脉超声检查以除外近端 DVT。临床观察同时可动态进行双下肢近端深静脉超声检查，以便及时发现进展性 DVT。如果心肺功能良好或出血风险较高，患者和临床医生更倾向于选择临床观察而不是抗凝治疗。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	对于亚段 PE，我们更建议结合临床表现，D- 二聚体，CT 和 V/Q 显像等检查进行综合评估。如果存在血栓进展危险因素，我们更建议积极抗凝治疗。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	&lt;strong&gt;急性 PE 的院外治疗&lt;/strong&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	低危 PE 患者，若家庭情况许可，建议在家内治疗或早日出院（例如，抗凝治疗 5 天后）（2B 级）。抗凝治疗 5 天一般情况下血栓基本稳定，INR 一般也会调节至 2~3 之间，患者出院相对安全，尤其是对低危 PE 患者。\r\n&lt;/p&gt;','');
INSERT INTO `io_content_news` VALUES('11','2','&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	溃疡性结肠炎患儿约 1/3 在 15 岁前会发生至少 1 次的急性结肠炎，意大利墨西拿大学附属儿科医院炎症性肠病科的 Romano 教授等总结了儿童急性结肠炎的生物治疗方法和疗效，其结果发表在近日的 Pediatrics 杂志上。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	儿童严重溃疡性结肠炎可定义为：溃疡性结肠炎活动指数＞65 和 / 或日解血便次数 ≥ 6 次和 / 或伴有以下任意一项：心动过速（＞90 次 / 分），发热（＞37.8℃），贫血（血红蛋白＜10.5 g/dL），血沉速度加快（＞30 mm/h）伴或不伴全身中毒症状。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	溃疡性结肠炎的大部分患者除结肠外亦有直肠的累及，内窥镜表现为黏膜脆弱、红斑以及典型黏膜血管的缺如，组织学改变包括隐窝变形、隐窝炎和隐窝脓肿，可伴艰难梭菌属、巨细胞病毒等感染。感染增加手术率并可能引起耐药。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	本研究的目的是利用新兴的生物治疗为急性结肠炎的患儿提供实用的临床处理建议。生物治疗的目标有：减少结肠切除术的使用率，减少疾病的并发症，减少药物副作用和死亡率。几种药物的使用指征、剂量和疗效也是研究的重点。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	本研究为系统性回顾性研究，研究通过 PubMed 进行医学文献检索，检索出包含「溃疡性结肠炎」、「儿童溃疡性结肠炎」、「生物治疗」、「急性重型溃疡性结肠炎」相关的英文文献。综合对糖皮质激素无反应，从而采用二线治疗（亦称为「补救治疗」）的病例。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	二线治疗的临床试验多采用生物药物治疗的方法，药物包括钙调神经磷酸酶抑制剂（环孢菌素，他克莫司）和抗肿瘤坏死因子分子（英夫利昔单抗）。本研究仅针对上述 3 种药物展开。现认为激素治疗 5 天内溃疡性结肠炎活动指数＜45 为好转反应，而高手术风险指标包括治疗第 3 天 CRP 持续上升（＞45 mg/L）和腹泻（＞3 次 / 天）。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	研究发现：15%～30% 的的溃疡性结肠炎患儿曾有急性结肠炎病史，并且常发生于疾病开始的时候，这种现象应引起临床医生的重视。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	二线治疗在约 70% 的患儿中产生反应，且效果较好，可延长手术的时间窗，减少手术率，增加出院率。因此一线治疗（即糖皮质激素）3～5 天无好转后需要考虑使用二线治疗，一是避免病情加重，二是减少糖皮质激素的毒副作用。如伴有并发症（如巨结肠、穿孔、严重贫血或败血症）或病情急剧恶化应行手术。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	研究的 3 种二线药物各有特点，总结如下表：\r\n&lt;/p&gt;','');
INSERT INTO `io_content_news` VALUES('12','10','&lt;span style=&quot;color:#333333;font-family:\'PingFang SC\', \'Source Han Sans SC\', \'Noto Sans CJK SC\', \'Hiragino Sans GB\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', sans-serif;font-size:14px;line-height:23.8px;background-color:#FFFFFF;&quot;&gt;1、项目名称：2015年度医师和护士相关证书采购项目&lt;/span&gt;&lt;br /&gt;\r\n&lt;span style=&quot;color:#333333;font-family:\'PingFang SC\', \'Source Han Sans SC\', \'Noto Sans CJK SC\', \'Hiragino Sans GB\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', sans-serif;font-size:14px;line-height:23.8px;background-color:#FFFFFF;&quot;&gt;2、项目编号：GC-FG151053&lt;/span&gt;&lt;br /&gt;\r\n&lt;span style=&quot;color:#333333;font-family:\'PingFang SC\', \'Source Han Sans SC\', \'Noto Sans CJK SC\', \'Hiragino Sans GB\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', sans-serif;font-size:14px;line-height:23.8px;background-color:#FFFFFF;&quot;&gt;3、招标公告发布日期：2015年10月21日&lt;/span&gt;&lt;br /&gt;\r\n&lt;span style=&quot;color:#333333;font-family:\'PingFang SC\', \'Source Han Sans SC\', \'Noto Sans CJK SC\', \'Hiragino Sans GB\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', sans-serif;font-size:14px;line-height:23.8px;background-color:#FFFFFF;&quot;&gt;4、变更公告发布日期：2015年10月30日&lt;/span&gt;&lt;br /&gt;\r\n&lt;span style=&quot;color:#333333;font-family:\'PingFang SC\', \'Source Han Sans SC\', \'Noto Sans CJK SC\', \'Hiragino Sans GB\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', sans-serif;font-size:14px;line-height:23.8px;background-color:#FFFFFF;&quot;&gt;5、开标日期：2015年11月16日&lt;/span&gt;&lt;br /&gt;\r\n&lt;span style=&quot;color:#333333;font-family:\'PingFang SC\', \'Source Han Sans SC\', \'Noto Sans CJK SC\', \'Hiragino Sans GB\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', sans-serif;font-size:14px;line-height:23.8px;background-color:#FFFFFF;&quot;&gt;6、中标详情&lt;/span&gt;&lt;br /&gt;\r\n&lt;span style=&quot;color:#333333;font-family:\'PingFang SC\', \'Source Han Sans SC\', \'Noto Sans CJK SC\', \'Hiragino Sans GB\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', sans-serif;font-size:14px;line-height:23.8px;background-color:#FFFFFF;&quot;&gt;（1）中标供应商名称：北京中融安全印务公司&lt;/span&gt;&lt;br /&gt;\r\n&lt;span style=&quot;color:#333333;font-family:\'PingFang SC\', \'Source Han Sans SC\', \'Noto Sans CJK SC\', \'Hiragino Sans GB\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', sans-serif;font-size:14px;line-height:23.8px;background-color:#FFFFFF;&quot;&gt;（2）中标供应商联系地址：北京市西城区白广路24号&lt;/span&gt;&lt;br /&gt;\r\n&lt;span style=&quot;color:#333333;font-family:\'PingFang SC\', \'Source Han Sans SC\', \'Noto Sans CJK SC\', \'Hiragino Sans GB\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', sans-serif;font-size:14px;line-height:23.8px;background-color:#FFFFFF;&quot;&gt;（3）中标金额：人民币 513万元&lt;/span&gt;&lt;br /&gt;\r\n&lt;span style=&quot;color:#333333;font-family:\'PingFang SC\', \'Source Han Sans SC\', \'Noto Sans CJK SC\', \'Hiragino Sans GB\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', sans-serif;font-size:14px;line-height:23.8px;background-color:#FFFFFF;&quot;&gt;（4）中标标的基本概况：&lt;/span&gt;&lt;br /&gt;\r\n&lt;table style=&quot;margin:0px;padding:0px;width:966px;color:#333333;font-family:\'PingFang SC\', \'Source Han Sans SC\', \'Noto Sans CJK SC\', \'Hiragino Sans GB\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	&lt;tbody&gt;\r\n		&lt;tr&gt;\r\n			&lt;td style=&quot;font-size:14px;border:1px solid #D0D0D0;&quot;&gt;\r\n				主要中标的名称、数量\r\n			&lt;/td&gt;\r\n			&lt;td style=&quot;font-size:14px;border:1px solid #D0D0D0;&quot;&gt;\r\n				总价（元）\r\n			&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n		&lt;tr&gt;\r\n			&lt;td style=&quot;font-size:14px;border:1px solid #D0D0D0;&quot;&gt;\r\n				1.《医师资格证书》共计240050本&lt;br /&gt;\r\n2.《医师执业证书》共计319350本&lt;br /&gt;\r\n3.《助理医师资格证书》共计132100本&lt;br /&gt;\r\n4.《助理医师执业证书》共计217840本&lt;br /&gt;\r\n5.《医师资格证书（老人老办法）》共计121350本&lt;br /&gt;\r\n6.《助理医师资格证书（老人老办法）》共计35000本&lt;br /&gt;\r\n7.《护士执业证书》共计689000本&lt;br /&gt;\r\n8.《港澳医师短期行医执业证书》共计13030本&lt;br /&gt;\r\n9.《台湾医师短期行医执业证书》共计11390本&lt;br /&gt;\r\n10.《外国医师短期行医许可证》共计20890本&lt;br /&gt;\r\n上述证书中，《医师资格证书》、《医师执业证书》、《助理医师资格证书》和《助理医师执业证书》分别各有汉、蒙、壮、藏、维五种语言版本。\r\n			&lt;/td&gt;\r\n			&lt;td style=&quot;font-size:14px;border:1px solid #D0D0D0;&quot;&gt;\r\n				5130000.00\r\n			&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n	&lt;/tbody&gt;\r\n&lt;/table&gt;\r\n&lt;br /&gt;\r\n&lt;span style=&quot;color:#333333;font-family:\'PingFang SC\', \'Source Han Sans SC\', \'Noto Sans CJK SC\', \'Hiragino Sans GB\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', sans-serif;font-size:14px;line-height:23.8px;background-color:#FFFFFF;&quot;&gt;7、招标文件链接地址：&lt;/span&gt;&lt;a class=&quot;ilink unline&quot; href=&quot;http://www.zycg.gov.cn/article/show/371548&quot; target=&quot;_blank&quot;&gt;http://www.zycg.gov.cn/article/show/371548&lt;/a&gt;&lt;br /&gt;\r\n&lt;span style=&quot;color:#333333;font-family:\'PingFang SC\', \'Source Han Sans SC\', \'Noto Sans CJK SC\', \'Hiragino Sans GB\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', sans-serif;font-size:14px;line-height:23.8px;background-color:#FFFFFF;&quot;&gt;8、评标委员会成员名单：张根祥、尚越建、丛文卓、李俊卿、王伟欣、冯燕潮、郭俊忠&lt;/span&gt;&lt;br /&gt;\r\n&lt;span style=&quot;color:#333333;font-family:\'PingFang SC\', \'Source Han Sans SC\', \'Noto Sans CJK SC\', \'Hiragino Sans GB\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', sans-serif;font-size:14px;line-height:23.8px;background-color:#FFFFFF;&quot;&gt;9、联系方式&lt;/span&gt;&lt;br /&gt;\r\n&lt;a class=&quot;ilink unline&quot; href=&quot;http://caigouren.caigou2003.com/&quot; target=&quot;_blank&quot;&gt;采购人&lt;/a&gt;&lt;span style=&quot;color:#333333;font-family:\'PingFang SC\', \'Source Han Sans SC\', \'Noto Sans CJK SC\', \'Hiragino Sans GB\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', sans-serif;font-size:14px;line-height:23.8px;background-color:#FFFFFF;&quot;&gt;名称：国家医学考试中心&lt;/span&gt;&lt;br /&gt;\r\n&lt;span style=&quot;color:#333333;font-family:\'PingFang SC\', \'Source Han Sans SC\', \'Noto Sans CJK SC\', \'Hiragino Sans GB\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', sans-serif;font-size:14px;line-height:23.8px;background-color:#FFFFFF;&quot;&gt;地址：北京市西城区西直门内大街西章胡同9号院&lt;/span&gt;&lt;br /&gt;\r\n&lt;span style=&quot;color:#333333;font-family:\'PingFang SC\', \'Source Han Sans SC\', \'Noto Sans CJK SC\', \'Hiragino Sans GB\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', sans-serif;font-size:14px;line-height:23.8px;background-color:#FFFFFF;&quot;&gt;联系电话：010-59935012&lt;/span&gt;&lt;br /&gt;\r\n&lt;span style=&quot;color:#333333;font-family:\'PingFang SC\', \'Source Han Sans SC\', \'Noto Sans CJK SC\', \'Hiragino Sans GB\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', sans-serif;font-size:14px;line-height:23.8px;background-color:#FFFFFF;&quot;&gt;采购中心地址：北京市西城区西直门内大街西章胡同9号院&lt;/span&gt;&lt;br /&gt;\r\n&lt;span style=&quot;color:#333333;font-family:\'PingFang SC\', \'Source Han Sans SC\', \'Noto Sans CJK SC\', \'Hiragino Sans GB\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', sans-serif;font-size:14px;line-height:23.8px;background-color:#FFFFFF;&quot;&gt;邮政编码：100035&lt;/span&gt;&lt;br /&gt;\r\n&lt;span style=&quot;color:#333333;font-family:\'PingFang SC\', \'Source Han Sans SC\', \'Noto Sans CJK SC\', \'Hiragino Sans GB\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', sans-serif;font-size:14px;line-height:23.8px;background-color:#FFFFFF;&quot;&gt;项目联系人： 于佳辉、刘士伟&lt;/span&gt;&lt;br /&gt;\r\n&lt;span style=&quot;color:#333333;font-family:\'PingFang SC\', \'Source Han Sans SC\', \'Noto Sans CJK SC\', \'Hiragino Sans GB\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', sans-serif;font-size:14px;line-height:23.8px;background-color:#FFFFFF;&quot;&gt;联系电话：55602771、55603662&lt;/span&gt;&lt;br /&gt;\r\n&lt;span style=&quot;color:#333333;font-family:\'PingFang SC\', \'Source Han Sans SC\', \'Noto Sans CJK SC\', \'Hiragino Sans GB\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', sans-serif;font-size:14px;line-height:23.8px;background-color:#FFFFFF;&quot;&gt;10、公告期限&lt;/span&gt;&lt;br /&gt;\r\n&lt;span style=&quot;color:#333333;font-family:\'PingFang SC\', \'Source Han Sans SC\', \'Noto Sans CJK SC\', \'Hiragino Sans GB\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', sans-serif;font-size:14px;line-height:23.8px;background-color:#FFFFFF;&quot;&gt;本中标公告自发布之日起公告期限为1个工作日。&lt;/span&gt;&lt;br /&gt;\r\n&lt;span style=&quot;color:#333333;font-family:\'PingFang SC\', \'Source Han Sans SC\', \'Noto Sans CJK SC\', \'Hiragino Sans GB\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', sans-serif;font-size:14px;line-height:23.8px;background-color:#FFFFFF;&quot;&gt;相关供应商对中标结果有异议的，可自公告期届满之日起7个工作日内书面提出。&lt;/span&gt;&lt;br /&gt;\r\n&lt;span style=&quot;color:#333333;font-family:\'PingFang SC\', \'Source Han Sans SC\', \'Noto Sans CJK SC\', \'Hiragino Sans GB\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', sans-serif;font-size:14px;line-height:23.8px;background-color:#FFFFFF;&quot;&gt;联系部门：办公室&lt;/span&gt;&lt;br /&gt;\r\n&lt;span style=&quot;color:#333333;font-family:\'PingFang SC\', \'Source Han Sans SC\', \'Noto Sans CJK SC\', \'Hiragino Sans GB\', \'Microsoft YaHei UI\', \'Microsoft YaHei\', sans-serif;font-size:14px;line-height:23.8px;background-color:#FFFFFF;&quot;&gt;联系电话：010-83087977&lt;/span&gt;','');
INSERT INTO `io_content_news` VALUES('14','13','&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	好久不读片了，今天来集中学习一下来自丁香园论坛的经典病例。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	&lt;strong&gt;病例一&lt;/strong&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	患者性别：男\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	患者年龄：62 岁\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	简要病史：腹痛 2 天，加重 6 小时\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	&lt;img alt=&quot;1-1.jpg&quot; src=&quot;/data/upload/image/201605/8e7c581f3ce6b48c.jpg&quot; title=&quot;&quot; /&gt;&lt;br /&gt;\r\n&lt;span style=&quot;line-height:1.8;&quot;&gt;感谢站友&amp;nbsp;&lt;/span&gt;&lt;span style=&quot;line-height:1.8;&quot;&gt;@ mimosafsk 提供的病例，文末见答案。&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	&lt;strong&gt;病例二&lt;/strong&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	中年男性\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	主诉：发现左腹部包块 2 周伴疼痛\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	简要病史：自诉腹部包块逐渐增大，疼痛加重\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	入院查体：左侧腹壁处理一直径约 8 cm 压痛肿物。边界不清，质硬\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	&lt;img alt=&quot;3.jpg&quot; src=&quot;/data/upload/image/201605/71364da8326c497d.jpg&quot; title=&quot;&quot; /&gt;&lt;br /&gt;\r\n&lt;span style=&quot;line-height:1.8;&quot;&gt;感谢站友&amp;nbsp;&lt;/span&gt;&lt;span style=&quot;line-height:1.8;&quot;&gt;@ pwkzyh&amp;nbsp;&lt;/span&gt;&lt;span style=&quot;line-height:1.8;&quot;&gt;提供的病例，文末见答案。&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	&lt;strong&gt;病例三&lt;/strong&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	年龄：62 岁\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	主诉：转移性右下腹疼痛 4 小时\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	简要病史：入院前 4 小时前患者出现上腹疼痛，呈持续性隐痛，无恶心呕吐，无腹胀腹泻，无发热，约 2 小时后疼痛转移至脐右侧。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	查体：脐稍右侧压痛（+），无肌紧张，无反跳痛。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	辅助检查：\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	血常规：白细胞 11×10&lt;sup&gt;9&lt;/sup&gt;/L，CRP 5.6 mg/L，中性粒细胞 72%\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	泌尿系和阑尾 B 超未见异常。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	&lt;img alt=&quot;2.pic.jpg&quot; src=&quot;/data/upload/image/201605/f4e46f53b24d8cf2.jpg&quot; title=&quot;&quot; /&gt;&lt;br /&gt;\r\n&lt;img alt=&quot;3.pic.jpg&quot; src=&quot;/data/upload/image/201605/d8b0b29372c260e1.jpg&quot; title=&quot;&quot; /&gt;&lt;br /&gt;\r\n&lt;img alt=&quot;3-2.jpg&quot; src=&quot;/data/upload/image/201605/b2a26c9823f24182.jpg&quot; title=&quot;&quot; /&gt;&lt;br /&gt;\r\n&lt;img alt=&quot;2.jpg&quot; src=&quot;/data/upload/image/201605/6aabb86f3bce733a.jpg&quot; title=&quot;&quot; /&gt;&lt;br /&gt;\r\n&lt;span style=&quot;line-height:1.8;&quot;&gt;感谢站友&amp;nbsp;&lt;/span&gt;&lt;span style=&quot;line-height:1.8;&quot;&gt;@&amp;nbsp;dongyuan1122&amp;nbsp;&lt;/span&gt;&lt;span style=&quot;line-height:1.8;&quot;&gt;提供的病例。&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	&lt;strong&gt;答案：&lt;/strong&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	以上三个病例的皆因小小「鱼刺」所致，各位看官您答对了么？\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#404040;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;&quot;&gt;\r\n	病例一：回肠末端，局部破裂，可见鱼刺穿出。&lt;br /&gt;\r\n&lt;img alt=&quot;答1.jpg&quot; src=&quot;/data/upload/image/201605/c875ac8f2a8164b6.jpg&quot; title=&quot;&quot; /&gt;\r\n&lt;/p&gt;\r\n&lt;div&gt;\r\n	&lt;br /&gt;\r\n&lt;/div&gt;','');

DROP TABLE IF EXISTS `io_content_product`;
CREATE TABLE `io_content_product` (
  `id` mediumint(8) NOT NULL,
  `catid` smallint(5) NOT NULL,
  `content` mediumtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `catid` (`catid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `io_content_users`;
CREATE TABLE `io_content_users` (
  `id` mediumint(8) NOT NULL,
  `catid` smallint(5) NOT NULL,
  `content` mediumtext NOT NULL,
  `cardid` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `poor` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `catid` (`catid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `io_content_users` VALUES('28','25','㓜你是一切随风雨飘摇','12345678913','1','32','1','18003813904');
INSERT INTO `io_content_users` VALUES('30','25','胡','我','1','17','1','13526664104');
INSERT INTO `io_content_users` VALUES('31','25','','dsfgdsfg','1','32','1','13526664104');
INSERT INTO `io_content_users` VALUES('38','25','','上的的此次并不亘古不变本本分分出场费','1','33','0','13261235007');
INSERT INTO `io_content_users` VALUES('39','25','','220323178909096654','1','58','1','13718425252');
INSERT INTO `io_content_users` VALUES('52','25','','2225552225522525','1','5','1','15083333333');
INSERT INTO `io_content_users` VALUES('53','25','','107825656228','1','66','1','15236985263');
INSERT INTO `io_content_users` VALUES('54','25','','107825656228','1','66','1','15236985263');
INSERT INTO `io_content_users` VALUES('55','25','','2225552225522525','1','5','1','15083333333');
INSERT INTO `io_content_users` VALUES('56','25','','上的亘古不变的的餐馆','1','5555','1','13718300494');

DROP TABLE IF EXISTS `io_diy_ad`;
CREATE TABLE `io_diy_ad` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `lianjiedizhi` varchar(255) NOT NULL,
  `pic` varchar(255) NOT NULL,
  `info` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `io_diy_ad` VALUES('1','javascript:;','/data/upload/image/201606/784fabb5da8ec94e.png','居民首页banner');

DROP TABLE IF EXISTS `io_diy_area`;
CREATE TABLE `io_diy_area` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `province` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `village` varchar(255) NOT NULL,
  `county` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `io_diy_area` VALUES('1','内蒙古自治区','乌兰察布市','城关镇','兴和县');

DROP TABLE IF EXISTS `io_diy_disease`;
CREATE TABLE `io_diy_disease` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `info` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `io_diy_disease` VALUES('1','传染性疾病','手足口','手足口描述');

DROP TABLE IF EXISTS `io_diy_doctor`;
CREATE TABLE `io_diy_doctor` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `minzu` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `cardid` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `birthday` varchar(255) NOT NULL,
  `best` varchar(255) NOT NULL,
  `ranks` varchar(255) NOT NULL,
  `area` varchar(255) NOT NULL,
  `mechanism` varchar(255) NOT NULL,
  `jianjie` mediumtext NOT NULL,
  `gongzuojingyan` mediumtext NOT NULL,
  `files` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `io_diy_doctor` VALUES('1','胡操航','0','汉族','13526664104','410782198411261578','刘庄','1984-11-26','吃饭','三岁小孩','刘庄','刘庄医疗服务站','','','');

DROP TABLE IF EXISTS `io_diy_family`;
CREATE TABLE `io_diy_family` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `bxzt` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `realname` varchar(255) NOT NULL,
  `xingbie` varchar(255) NOT NULL,
  `birthday` varchar(255) NOT NULL,
  `minzu` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `cardid` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `relationship` varchar(255) NOT NULL,
  `health` varchar(255) NOT NULL,
  `attribute` varchar(255) NOT NULL,
  `doctor` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `io_diy_mechanism`;
CREATE TABLE `io_diy_mechanism` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `io_diy_mechanism` VALUES('1','刘庄医疗服务中心','刘庄','2','胡操航','0371-55451140','1');

DROP TABLE IF EXISTS `io_diy_message`;
CREATE TABLE `io_diy_message` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `userid` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `msg` mediumtext NOT NULL,
  `status` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

INSERT INTO `io_diy_message` VALUES('18','2','6','您好，测试，居民健康宝于2016年06月07日20:51:29收到您的投诉，我们将及时处理，并通过电话将处理结果反馈给您。','1','/','1465303889');
INSERT INTO `io_diy_message` VALUES('19','4','2','您好，星叔哈哈 医生，您辖区的居民在 2016年06月07日20:57:43 有健康问题向您提问，请及时关注他的健康状况。','1','/?catid=18#xqwz','1465304263');
INSERT INTO `io_diy_message` VALUES('20','4','2','您好，星叔哈哈 医生，您辖区的居民在 2016年06月07日20:59:16 有健康问题向您提问，请及时关注他的健康状况。','1','/?catid=18#xqwz','1465304356');
INSERT INTO `io_diy_message` VALUES('21','2','3','您好，测试，居民健康宝于 2016年06月07日20:59:16 收到您提交的健康问题，医生正在为您解答，请随时关注您的短信、微信或站内消息，及时查收问题答案。','1','/','1465304356');
INSERT INTO `io_diy_message` VALUES('22','4','2','您好，星叔哈哈 医生，您辖区的居民在 2016年06月07日20:59:28 有健康问题向您提问，请及时关注他的健康状况。','1','/?catid=18#xqwz','1465304368');
INSERT INTO `io_diy_message` VALUES('23','2','3','您好，测试，居民健康宝于 2016年06月07日20:59:28 收到您提交的健康问题，医生正在为您解答，请随时关注您的短信、微信或站内消息，及时查收问题答案。','1','/','1465304368');
INSERT INTO `io_diy_message` VALUES('24','2','3','您好，测试，居民健康宝于 2016年06月07日21:00:04 收到您提交的健康问题，医生正在为您解答，请随时关注您的短信、微信或站内消息，及时查收问题答案。','1','/','1465304404');
INSERT INTO `io_diy_message` VALUES('25','2','6','您好，测试，居民健康宝于2016年06月07日21:03:40收到您的投诉，我们将及时处理，并通过电话将处理结果反馈给您。','1','/','1465304620');
INSERT INTO `io_diy_message` VALUES('26','2','7','您好，星叔哈哈，您的家庭医生（星叔哈哈）已于 2016年06月07日21:15:27 新增了您的体检报告（预警信息），你可以点击查看。','1','/?id=30','1465305327');
INSERT INTO `io_diy_message` VALUES('27','2','6','您好，测试，居民健康宝于 2016年06月07日21:22:20 收到您的投诉，我们将及时处理，并通过电话将处理结果反馈给您。','0','/','1465305740');
INSERT INTO `io_diy_message` VALUES('28','4','2','您好，星叔哈哈 医生，您辖区的居民在 2016年06月07日21:23:42 有健康问题向您提问，请及时关注他的健康状况。','0','/?catid=18#xqwz','1465305822');
INSERT INTO `io_diy_message` VALUES('29','2','3','您好，测试，居民健康宝于 2016年06月07日21:23:42 收到您提交的健康问题，医生正在为您解答，请随时关注您的短信、微信或站内消息，及时查收问题答案。','0','/','1465305822');
INSERT INTO `io_diy_message` VALUES('30','2','6','您好，测试，居民健康宝于 2016年06月07日21:26:20 收到您的投诉，我们将及时处理，并通过电话将处理结果反馈给您。','0','/','1465305980');

DROP TABLE IF EXISTS `io_diy_tousu`;
CREATE TABLE `io_diy_tousu` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `uid` varchar(255) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `content` mediumtext NOT NULL,
  `cid` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO `io_diy_tousu` VALUES('1','2','4','投诉测试','2','1465303889');
INSERT INTO `io_diy_tousu` VALUES('2','2','4','不怎么样','3','1465304620');
INSERT INTO `io_diy_tousu` VALUES('3','2','4','000','3','1465305740');
INSERT INTO `io_diy_tousu` VALUES('4','2','4','短信测试','4','1465305980');

DROP TABLE IF EXISTS `io_filters`;
CREATE TABLE `io_filters` (
  `id` tinyint(1) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT '',
  `data` text NOT NULL,
  `ext` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `io_form_answer`;
CREATE TABLE `io_form_answer` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `cid` mediumint(8) NOT NULL,
  `userid` mediumint(8) NOT NULL,
  `username` char(20) NOT NULL,
  `name` char(25) NOT NULL,
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `time` int(10) unsigned NOT NULL DEFAULT '0',
  `ip` char(20) DEFAULT NULL,
  `content` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `time` (`time`),
  KEY `userid` (`userid`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `io_form_comment`;
CREATE TABLE `io_form_comment` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `cid` mediumint(8) NOT NULL,
  `userid` mediumint(8) NOT NULL,
  `username` char(20) NOT NULL,
  `name` char(25) NOT NULL,
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `time` int(10) unsigned NOT NULL DEFAULT '0',
  `ip` char(20) DEFAULT NULL,
  `pinglunneirong` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `listorder` (`listorder`),
  KEY `status` (`status`),
  KEY `time` (`time`),
  KEY `userid` (`userid`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `io_form_gestbook`;
CREATE TABLE `io_form_gestbook` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `cid` mediumint(8) NOT NULL,
  `userid` mediumint(8) NOT NULL,
  `username` char(20) NOT NULL,
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `time` int(10) unsigned NOT NULL DEFAULT '0',
  `ip` char(20) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `content` mediumtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `listorder` (`listorder`),
  KEY `status` (`status`),
  KEY `time` (`time`),
  KEY `userid` (`userid`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `io_form_gestbook` VALUES('1','0','13','1464694226','0','1','1464918914','103.254.115.115','','兔兔咯莫探讨了哦咯哦就业');

DROP TABLE IF EXISTS `io_form_like`;
CREATE TABLE `io_form_like` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `cid` mediumint(8) NOT NULL,
  `userid` mediumint(8) NOT NULL,
  `username` char(20) NOT NULL,
  `name` char(25) NOT NULL,
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `time` int(10) unsigned NOT NULL DEFAULT '0',
  `ip` char(20) DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `time` (`time`),
  KEY `userid` (`userid`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `io_form_report`;
CREATE TABLE `io_form_report` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `cid` mediumint(8) NOT NULL,
  `userid` mediumint(8) NOT NULL,
  `username` char(20) NOT NULL,
  `name` char(20) NOT NULL COMMENT '用户姓名',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `time` int(10) unsigned NOT NULL DEFAULT '0',
  `ip` char(20) DEFAULT NULL,
  `content` mediumtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `time` (`time`),
  KEY `userid` (`userid`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO `io_form_report` VALUES('3','30','4','1464616597','星叔哈哈','1','1465303908','115.60.13.178','觉得快点快点快点');
INSERT INTO `io_form_report` VALUES('2','30','4','1464616597','星叔哈哈','1','1465303832','115.60.13.178','觉得快点快点快点');
INSERT INTO `io_form_report` VALUES('4','30','4','1464616597','星叔哈哈','1','1465305327','115.60.13.178','体质测试和打击打击打击打击');

DROP TABLE IF EXISTS `io_form_share`;
CREATE TABLE `io_form_share` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `cid` mediumint(8) NOT NULL,
  `userid` mediumint(8) NOT NULL,
  `username` char(20) NOT NULL,
  `name` char(20) NOT NULL,
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `time` int(10) unsigned NOT NULL DEFAULT '0',
  `ip` char(20) DEFAULT NULL,
  `content` mediumtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `time` (`time`),
  KEY `userid` (`userid`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `io_form_share` VALUES('1','8','4','1464616597','','1','1464620150','120.219.27.193','疯狂醋醋醋几乎好');

DROP TABLE IF EXISTS `io_form_warning`;
CREATE TABLE `io_form_warning` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `cid` mediumint(8) NOT NULL,
  `userid` mediumint(8) NOT NULL,
  `username` char(20) NOT NULL,
  `name` char(25) NOT NULL,
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `time` int(10) unsigned NOT NULL DEFAULT '0',
  `ip` char(20) DEFAULT NULL,
  `ssy` varchar(255) NOT NULL,
  `szy` varchar(255) NOT NULL,
  `xuetang` varchar(255) NOT NULL,
  `xdtinfo` mediumtext NOT NULL,
  `xdtpic` mediumtext NOT NULL,
  `maibo` varchar(255) NOT NULL,
  `tiwen` varchar(255) NOT NULL,
  `shengao` varchar(255) NOT NULL,
  `tizhong` varchar(255) NOT NULL,
  `BMI` varchar(255) NOT NULL,
  `yyqk` varchar(255) NOT NULL,
  `yybz` mediumtext NOT NULL,
  `hwinfo` mediumtext NOT NULL,
  `hwpic` mediumtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `time` (`time`),
  KEY `userid` (`userid`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `io_member`;
CREATE TABLE `io_member` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `username` char(20) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL COMMENT '姓名',
  `password` char(32) NOT NULL DEFAULT '',
  `phone` text NOT NULL COMMENT '手机号码',
  `userid` mediumint(8) NOT NULL COMMENT '患者归属医生ID',
  `email` varchar(100) NOT NULL,
  `avatar` varchar(255) NOT NULL DEFAULT '',
  `sex` int(11) NOT NULL COMMENT '性别 1 男 2 女',
  `age` int(11) NOT NULL DEFAULT '0' COMMENT '年龄',
  `modelid` smallint(5) NOT NULL,
  `regdate` int(10) unsigned NOT NULL DEFAULT '0',
  `regip` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

INSERT INTO `io_member` VALUES('1','1464615240','胡操航','ca749250df171535eb886d6c3ecb7847','13526664104','0','1464615240@yiyi.hnzhixi.com','http://wx.qlogo.cn/mmopen/EZLVLIZyANzhxZRT2vQp8LmFI1xicibuf4icqjF7RQmJMHyrdS83zF0oLRSc8DngCqtA4ULucjjicfUNiaiceakzqHChSbXic2LEia1S/0','1','0','7','1464615240','120.219.27.193','1');
INSERT INTO `io_member` VALUES('2','1464616568','测试','ca749250df171535eb886d6c3ecb7847','18003813904','4','1464615250@yiyi.hnzhixi.com','http://wx.qlogo.cn/mmopen/EZLVLIZyANzhxZRT2vQp8LmFI1xicibuf4icqjF7RQmJMHyrdS83zF0oLRSc8DngCqtA4ULucjjicfUNiaiceakzqHChSbXic2LEia1S/0','1','17','5','1464615250','120.219.27.193','1');
INSERT INTO `io_member` VALUES('3','1464616567','星叔','ca749250df171535eb886d6c3ecb7847','13700879031','0','1464616567@yiyi.hnzhixi.com','http://wx.qlogo.cn/mmopen/Q3auHgzwzM5RgeGVzssaXLhannynvLN2otypic2AWgwMzOkZMaGNkaZdqicImjP8UHoicylicT4TKaaAfbKsvE262w/0','1','0','5','1464616567','120.219.27.193','1');
INSERT INTO `io_member` VALUES('4','1464616597','星叔哈哈','ca749250df171535eb886d6c3ecb7847','13700879031','0','1464616597@yiyi.hnzhixi.com','http://wx.qlogo.cn/mmopen/Q3auHgzwzM5RgeGVzssaXLhannynvLN2otypic2AWgwMzOkZMaGNkaZdqicImjP8UHoicylicT4TKaaAfbKsvE262w/0','1','0','7','1464616597','120.219.27.193','1');
INSERT INTO `io_member` VALUES('5','1464685991','✎﹏G๓♔','572540200','18603664601','0','1464685991@yiyi.hnzhixi.com','http://wx.qlogo.cn/mmopen/Q3auHgzwzM5PzUnCKSu1FSgrvibzveU0bGpia3wdRqGJplR3cPQcphlUarB8GvPk6E8afsHjHCbiboQKxbXtopamfQ6fNofia3ibuMoZXDBiaS7yQ/0','1','0','7','1464685991','124.207.180.37','1');
INSERT INTO `io_member` VALUES('6','1464686101','阿基利','135838556','13261235007','0','1464686101@yiyi.hnzhixi.com','http://wx.qlogo.cn/mmopen/y6eQ3l5Fo5rnINTiaZ0RvCic5BmPHWyDfMSIjFXBr4BJzAV3wgbNHZuCJIPW9caEAhgWzqAVOJwHC5rg6UEnLvDwAQMMjibqDIK/0','1','0','5','1464686101','103.254.115.115','1');
INSERT INTO `io_member` VALUES('7','1464686691','9.16','146938457','13718476612','0','1464686691@yiyi.hnzhixi.com','http://wx.qlogo.cn/mmopen/y6eQ3l5Fo5rnINTiaZ0RvCzfhza2sPc9GYpL1MAQtsaPdnIqibaMygmib3b4wG0Via2Mc43nliauPuQk3nMYQLky3IQqaeHRiawicNf/0','1','0','5','1464686691','103.254.115.115','1');
INSERT INTO `io_member` VALUES('8','1464686694','9.16','118815239','13718476612','0','1464686694@yiyi.hnzhixi.com','http://wx.qlogo.cn/mmopen/y6eQ3l5Fo5rnINTiaZ0RvCzfhza2sPc9GYpL1MAQtsaPdnIqibaMygmib3b4wG0Via2Mc43nliauPuQk3nMYQLky3IQqaeHRiawicNf/0','1','0','7','1464686694','103.254.115.115','1');
INSERT INTO `io_member` VALUES('9','1464687147','✨刘婷♏️Tina❤️','297504667','15001395683','0','1464687147@yiyi.hnzhixi.com','http://wx.qlogo.cn/mmopen/avncmo55pSYSqEmMQsh6hXF3UEvZjrwYB8dFlbUj6VjkIl2q0HSXTsILRMxYKbxXHHricBEdI5CVdQ2mcM3D1q2EvMHAVyZwic/0','2','0','7','1464687147','103.254.115.115','1');
INSERT INTO `io_member` VALUES('10','1464687247','毛毳毳','45915164','13661393691','0','1464687247@yiyi.hnzhixi.com','http://wx.qlogo.cn/mmopen/ajNVdqHZLLDjtPbFrJbXnUUHiam3ZklQjiasVICjV4ZONlF4CqhwFyI7cVvcjNbUFsqSrKI2MR4RBjkcia4I9B7AYjRXLy79uxBo6oRhLuQC0c/0','1','0','5','1464687247','124.207.180.37','1');
INSERT INTO `io_member` VALUES('11','1464687253','毛毳毳','325177589','13661393691','0','1464687253@yiyi.hnzhixi.com','http://wx.qlogo.cn/mmopen/ajNVdqHZLLDjtPbFrJbXnUUHiam3ZklQjiasVICjV4ZONlF4CqhwFyI7cVvcjNbUFsqSrKI2MR4RBjkcia4I9B7AYjRXLy79uxBo6oRhLuQC0c/0','2','0','7','1464687253','124.207.180.37','1');
INSERT INTO `io_member` VALUES('12','1464687339','阿基利','605457840','13261235007','0','1464687339@yiyi.hnzhixi.com','/data/upload/member/12/image/201605/0aafe1e39c983cb6519e6fa7536d31cd.jpeg','1','0','7','1464687339','103.254.115.115','1');
INSERT INTO `io_member` VALUES('13','1464694226','✎﹏G๓♔','610680288','18603664601','0','1464694226@yiyi.hnzhixi.com','http://wx.qlogo.cn/mmopen/Q3auHgzwzM5PzUnCKSu1FSgrvibzveU0bGpia3wdRqGJplR3cPQcphlUarB8GvPk6E8afsHjHCbiboQKxbXtopamfQ6fNofia3ibuMoZXDBiaS7yQ/0','1','0','5','1464694226','124.207.180.37','1');
INSERT INTO `io_member` VALUES('14','1464695529','杜小瘦','451827169','18513131931','0','1464695529@yiyi.hnzhixi.com','http://wx.qlogo.cn/mmopen/Q3auHgzwzM7q1Siactn5JGtgKkltnPAm2sbzC6K7MulTWkvCsBUUQzXZ3kK0fgl3KocvZHDI6hMUkCX9o0iaP6ibg/0','2','0','7','1464695529','103.254.115.115','1');
INSERT INTO `io_member` VALUES('27','1465228133','东北西北','390984774','','0','1465228133@yiyi.hnzhixi.com','http://wx.qlogo.cn/mmopen/vNG0AUMt1SUr4RU4XPicWLO7lFMIL2lgmbL4SSTTMMarjcCibAxqTnm7NsanicxkulphEuiccWXAdta4UNwBm5vibqDYkoh57RSgr/0','1','0','5','1465228133','115.60.11.153','0');
INSERT INTO `io_member` VALUES('16','1464699869','东北西北','993430162','13526664104','0','1464699869@yiyi.hnzhixi.com','http://wx.qlogo.cn/mmopen/vNG0AUMt1SUr4RU4XPicWLO7lFMIL2lgmbL4SSTTMMarjcCibAxqTnm7NsanicxkulphEuiccWXAdta4UNwBm5vibqDYkoh57RSgr/0','1','0','7','1464699869','122.228.11.214','1');
INSERT INTO `io_member` VALUES('18','1464752054','✨刘婷♏️Tina❤️','423158417','15001395683','0','1464752054@yiyi.hnzhixi.com','http://wx.qlogo.cn/mmopen/avncmo55pSYSqEmMQsh6hXF3UEvZjrwYB8dFlbUj6VjkIl2q0HSXTsILRMxYKbxXHHricBEdI5CVdQ2mcM3D1q2EvMHAVyZwic/0','1','0','5','1464752054','124.207.180.37','1');
INSERT INTO `io_member` VALUES('19','1464778937','杜小瘦','974376621','18513131931','0','1464778937@yiyi.hnzhixi.com','http://wx.qlogo.cn/mmopen/Q3auHgzwzM7q1Siactn5JGtgKkltnPAm2sbzC6K7MulTWkvCsBUUQzXZ3kK0fgl3KocvZHDI6hMUkCX9o0iaP6ibg/0','1','0','5','1464778937','124.207.180.37','1');
INSERT INTO `io_member` VALUES('20','1464869748','师金召','490304421','13343805545','0','1464869748@yiyi.hnzhixi.com','http://wx.qlogo.cn/mmopen/avncmo55pSYqUA9DrnEWQicNgBvESKjD3bJJDNrdjR9jzUkichQPdZ5c0HFt1RbPPdxGYcTry7kdNIGlsmdX9icBw/0','1','0','7','1464869748','117.136.44.130','1');
INSERT INTO `io_member` VALUES('21','1464945148','胡泽玉','541019196','13718300494','0','1464945148@yiyi.hnzhixi.com','http://wx.qlogo.cn/mmopen/y6eQ3l5Fo5rnINTiaZ0RvC3JpgNClQm59aiaOLibfptsz62kepRLnwdsYlS7hOVEe7VicD53MIibuZlibYr8PLul9bkibPkXLFnxiayI/0','1','0','5','1464945148','103.254.115.115','1');
INSERT INTO `io_member` VALUES('22','1465174893','高翰文','993598197','','0','1465174893@yiyi.hnzhixi.com','http://wx.qlogo.cn/mmopen/avncmo55pSZ57fPhJtZJ1V1vDgVpibpf5a9U0m63nHkaibeycl84nCL9OjibA8xdmKrQia7JImcedSBduv5vymgL70zHEgGuFAYP/0','1','0','5','1465174893','124.207.180.37','0');
INSERT INTO `io_member` VALUES('23','1465174906','高翰文','146210841','','0','1465174906@yiyi.hnzhixi.com','http://wx.qlogo.cn/mmopen/avncmo55pSZ57fPhJtZJ1V1vDgVpibpf5a9U0m63nHkaibeycl84nCL9OjibA8xdmKrQia7JImcedSBduv5vymgL70zHEgGuFAYP/0','1','0','7','1465174906','124.207.180.37','1');
INSERT INTO `io_member` VALUES('24','1465175198','大嘴鸟','981792686','18610762355','0','1465175198@yiyi.hnzhixi.com','http://wx.qlogo.cn/mmopen/vNG0AUMt1SUr4RU4XPicWLCmc1AHKKAKwcjA8kwwI5K4pbibC6aVs62bmQZqq68QatoWOScPibUqYElT3qfVZKOZGutH97BAF4M/0','1','0','7','1465175198','124.207.180.37','1');
INSERT INTO `io_member` VALUES('25','1465175348','大嘴鸟','271998927','','0','1465175348@yiyi.hnzhixi.com','http://wx.qlogo.cn/mmopen/vNG0AUMt1SUr4RU4XPicWLCmc1AHKKAKwcjA8kwwI5K4pbibC6aVs62bmQZqq68QatoWOScPibUqYElT3qfVZKOZGutH97BAF4M/0','1','0','5','1465175348','124.207.180.37','0');
INSERT INTO `io_member` VALUES('26','1465198283','胡泽玉','295987244','','0','1465198283@yiyi.hnzhixi.com','http://wx.qlogo.cn/mmopen/y6eQ3l5Fo5rnINTiaZ0RvC3JpgNClQm59aiaOLibfptsz62kepRLnwdsYlS7hOVEe7VicD53MIibuZlibYr8PLul9bkibPkXLFnxiayI/0','1','0','7','1465198283','124.207.180.37','0');

DROP TABLE IF EXISTS `io_member_connect`;
CREATE TABLE `io_member_connect` (
  `uid` mediumint(9) NOT NULL,
  `openid` varchar(32) NOT NULL,
  `modelid` smallint(5) NOT NULL COMMENT '用户模型 双身份使用'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `io_member_connect` VALUES('1','oH4Iws5MV08scwxxP1cG00gNrfNo','7');
INSERT INTO `io_member_connect` VALUES('2','oH4Iws5MV08scwxxP1cG00gNrfNo','5');
INSERT INTO `io_member_connect` VALUES('3','oH4Iws6xXu-6cNfd7ju-rmyBe4ks','5');
INSERT INTO `io_member_connect` VALUES('4','oH4Iws6xXu-6cNfd7ju-rmyBe4ks','7');
INSERT INTO `io_member_connect` VALUES('5','oH4IwsxFUzlj-KEWo-u5RT6ZQR0Y','7');
INSERT INTO `io_member_connect` VALUES('6','oH4Iws2ghIHn7_myUN7XevY5VmOY','5');
INSERT INTO `io_member_connect` VALUES('7','oH4Iws8xk5QhqSnwkkGjUVfHk_Ec','5');
INSERT INTO `io_member_connect` VALUES('8','oH4Iws8xk5QhqSnwkkGjUVfHk_Ec','7');
INSERT INTO `io_member_connect` VALUES('9','oH4Iws5LNRRGOS_i7SnBSlhwDKkA','7');
INSERT INTO `io_member_connect` VALUES('10','oH4IwszP_Tn0xk5_RCUUeWA8xr9c','5');
INSERT INTO `io_member_connect` VALUES('11','oH4IwszP_Tn0xk5_RCUUeWA8xr9c','7');
INSERT INTO `io_member_connect` VALUES('12','oH4Iws2ghIHn7_myUN7XevY5VmOY','7');
INSERT INTO `io_member_connect` VALUES('13','oH4IwsxFUzlj-KEWo-u5RT6ZQR0Y','5');
INSERT INTO `io_member_connect` VALUES('14','oH4Iws0DL13MjiSw8feux-LXAV9k','7');
INSERT INTO `io_member_connect` VALUES('27','oH4Iws76AcieOon7iSUox6lCTB3Q','5');
INSERT INTO `io_member_connect` VALUES('16','oH4Iws76AcieOon7iSUox6lCTB3Q','7');
INSERT INTO `io_member_connect` VALUES('18','oH4Iws5LNRRGOS_i7SnBSlhwDKkA','5');
INSERT INTO `io_member_connect` VALUES('19','oH4Iws0DL13MjiSw8feux-LXAV9k','5');
INSERT INTO `io_member_connect` VALUES('20','oH4Iws3xccFs4J4xaPsOeUP7ulzc','7');
INSERT INTO `io_member_connect` VALUES('21','oH4IwsylK1cHeQ7WkxoDsyMGZ8eI','5');
INSERT INTO `io_member_connect` VALUES('22','oH4Iws-zMb2Mm4Gidg68zdtsnTWk','5');
INSERT INTO `io_member_connect` VALUES('23','oH4Iws-zMb2Mm4Gidg68zdtsnTWk','7');
INSERT INTO `io_member_connect` VALUES('24','oH4Iws5MTthLAf_jJwEKOA7NcWsg','7');
INSERT INTO `io_member_connect` VALUES('25','oH4Iws5MTthLAf_jJwEKOA7NcWsg','5');
INSERT INTO `io_member_connect` VALUES('26','oH4IwsylK1cHeQ7WkxoDsyMGZ8eI','7');

DROP TABLE IF EXISTS `io_member_doctor`;
CREATE TABLE `io_member_doctor` (
  `id` mediumint(8) NOT NULL,
  `cardid` varchar(255) NOT NULL,
  `brithday` varchar(255) NOT NULL,
  `good` varchar(255) NOT NULL,
  `info` mediumtext NOT NULL,
  `images` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `io_member_doctor` VALUES('1','3256283839383646','1990-12-11','恢复肌肤九分裤 好多话大静','活得很好大静的我也有很开心？我说不会有没有没有点什么呢','a:2:{s:7:\"fileurl\";a:1:{i:0;s:71:\"/data/upload/member/1/image/201606/6f94d51b99c7852ca112f2f11c5f2560.jpg\";}s:8:\"filename\";a:1:{i:0;s:9:\"image.jpg\";}}');
INSERT INTO `io_member_doctor` VALUES('4','z s s','1990-12-01','解决','坎坎坷坷','a:2:{s:7:\"fileurl\";a:1:{i:0;s:72:\"/data/upload/member/4/image/201605/8740763f2d7d7ad6825a0c8e19e7b09d.jpeg\";}s:8:\"filename\";a:1:{i:0;s:10:\"image.jpeg\";}}');
INSERT INTO `io_member_doctor` VALUES('5','','','','','');
INSERT INTO `io_member_doctor` VALUES('8','2204230393030303','0393-03-03','疾病','我去吧','a:2:{s:7:\"fileurl\";a:1:{i:0;s:71:\"/data/upload/member/8/image/201605/cd548aa0ef107a932fade51c19a7b664.png\";}s:8:\"filename\";a:1:{i:0;s:9:\"image.png\";}}');
INSERT INTO `io_member_doctor` VALUES('9','362430198810060000','1988-11-14','眼疾','我是一位负责任的医生','a:2:{s:7:\"fileurl\";a:1:{i:0;s:72:\"/data/upload/member/9/image/201605/db08553f36a2c0db83d587c8bb3dde1e.jpeg\";}s:8:\"filename\";a:1:{i:0;s:35:\"Screenshot_2016-05-31-17-40-10.jpeg\";}}');
INSERT INTO `io_member_doctor` VALUES('11','110101198408081236','1984-08-08','内科','主任医师','a:2:{s:7:\"fileurl\";a:1:{i:0;s:72:\"/data/upload/member/11/image/201606/b8cac0156cb57688352f904b7a04bab9.png\";}s:8:\"filename\";a:1:{i:0;s:34:\"Screenshot_2016-05-31-17-41-48.png\";}}');
INSERT INTO `io_member_doctor` VALUES('12','的反反复复风风光光八佰伴','1990-12-15','多层次此次','的敢不敢风风光光的发布亘古不变爸爸粑粑八佰伴','a:2:{s:7:\"fileurl\";a:1:{i:0;s:72:\"/data/upload/member/12/image/201605/700c5162adc237d842b1c22d19c48421.jpg\";}s:8:\"filename\";a:1:{i:0;s:26:\"microMsg.1464523596906.jpg\";}}');
INSERT INTO `io_member_doctor` VALUES('14','0000000000000000','0000-00-00','神经','k k k l lo o o o www','a:2:{s:7:\"fileurl\";a:1:{i:0;s:72:\"/data/upload/member/14/image/201606/34da24c808752197ae7072e537716d4c.jpg\";}s:8:\"filename\";a:1:{i:0;s:9:\"image.jpg\";}}');
INSERT INTO `io_member_doctor` VALUES('16','410782198411261555','1984-11-26','乛紧','马：','a:2:{s:7:\"fileurl\";a:1:{i:0;s:73:\"/data/upload/member/16/image/201606/efa96f887898fa2e00ce74b42b573b8d.jpeg\";}s:8:\"filename\";a:1:{i:0;s:20:\"200756161925517.jpeg\";}}');
INSERT INTO `io_member_doctor` VALUES('23','','','','','');
INSERT INTO `io_member_doctor` VALUES('20','','','','','');
INSERT INTO `io_member_doctor` VALUES('24','','','','','');
INSERT INTO `io_member_doctor` VALUES('26','','','','','');

DROP TABLE IF EXISTS `io_member_geren`;
CREATE TABLE `io_member_geren` (
  `id` mediumint(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `io_member_geren` VALUES('2');
INSERT INTO `io_member_geren` VALUES('3');
INSERT INTO `io_member_geren` VALUES('6');
INSERT INTO `io_member_geren` VALUES('7');
INSERT INTO `io_member_geren` VALUES('10');
INSERT INTO `io_member_geren` VALUES('13');
INSERT INTO `io_member_geren` VALUES('18');
INSERT INTO `io_member_geren` VALUES('19');
INSERT INTO `io_member_geren` VALUES('21');
INSERT INTO `io_member_geren` VALUES('22');
INSERT INTO `io_member_geren` VALUES('25');
INSERT INTO `io_member_geren` VALUES('27');

DROP TABLE IF EXISTS `io_model`;
CREATE TABLE `io_model` (
  `modelid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `typeid` tinyint(3) NOT NULL,
  `modelname` char(30) NOT NULL,
  `tablename` char(20) NOT NULL,
  `listtpl` varchar(30) NOT NULL,
  `showtpl` varchar(30) NOT NULL,
  `joinid` smallint(5) DEFAULT NULL,
  `setting` text,
  PRIMARY KEY (`modelid`),
  KEY `typeid` (`typeid`),
  KEY `joinid` (`joinid`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

INSERT INTO `io_model` VALUES('1','1','文章模型','content_news','list_news.html','show_news.html','0','a:1:{s:7:\"default\";a:6:{s:5:\"title\";a:2:{s:4:\"name\";s:6:\"标题\";s:4:\"show\";s:1:\"1\";}s:8:\"keywords\";a:2:{s:4:\"name\";s:9:\"关键字\";s:4:\"show\";s:1:\"1\";}s:5:\"thumb\";a:2:{s:4:\"name\";s:9:\"缩略图\";s:4:\"show\";s:1:\"1\";}s:11:\"description\";a:2:{s:4:\"name\";s:6:\"描述\";s:4:\"show\";s:1:\"1\";}s:4:\"time\";a:2:{s:4:\"name\";s:12:\"发布时间\";s:4:\"show\";s:1:\"1\";}s:4:\"hits\";a:2:{s:4:\"name\";s:9:\"阅读数\";s:4:\"show\";s:1:\"1\";}}}');
INSERT INTO `io_model` VALUES('13','1','问答模型','content_ask','list_ask.html','show_ask.html','0','a:1:{s:7:\"default\";a:6:{s:5:\"title\";a:2:{s:4:\"name\";s:6:\"标题\";s:4:\"show\";s:1:\"1\";}s:8:\"keywords\";a:2:{s:4:\"name\";s:9:\"关键字\";s:4:\"show\";s:1:\"0\";}s:5:\"thumb\";a:2:{s:4:\"name\";s:9:\"缩略图\";s:4:\"show\";s:1:\"0\";}s:11:\"description\";a:2:{s:4:\"name\";s:6:\"描述\";s:4:\"show\";s:1:\"0\";}s:4:\"time\";a:2:{s:4:\"name\";s:12:\"发布时间\";s:4:\"show\";s:1:\"1\";}s:4:\"hits\";a:2:{s:4:\"name\";s:9:\"阅读数\";s:4:\"show\";s:1:\"0\";}}}');
INSERT INTO `io_model` VALUES('3','3','意见反馈','form_gestbook','list_gestbook.html','form_gestbook.html','0','a:1:{s:4:\"form\";a:8:{s:4:\"post\";s:1:\"1\";s:3:\"num\";s:1:\"0\";s:4:\"time\";s:0:\"\";s:5:\"check\";s:1:\"0\";s:4:\"code\";s:1:\"0\";s:6:\"member\";s:1:\"0\";s:4:\"show\";a:2:{i:0;s:5:\"phone\";i:1;s:7:\"content\";}s:10:\"membershow\";a:2:{i:0;s:5:\"phone\";i:1;s:7:\"content\";}}}');
INSERT INTO `io_model` VALUES('4','3','文章评论','form_comment','list_comment.html','form.html','1','a:1:{s:4:\"form\";a:8:{s:4:\"post\";s:1:\"0\";s:3:\"num\";s:1:\"0\";s:4:\"time\";s:0:\"\";s:5:\"check\";s:1:\"0\";s:4:\"code\";s:1:\"0\";s:6:\"member\";s:1:\"0\";s:4:\"show\";a:1:{i:0;s:14:\"pinglunneirong\";}s:10:\"membershow\";a:1:{i:0;s:14:\"pinglunneirong\";}}}');
INSERT INTO `io_model` VALUES('5','2','居民','member_geren','list_geren.html','show_geren.html','0','');
INSERT INTO `io_model` VALUES('6','4','自动内链@(废弃)','autolink','list_autolink.html','show_autolink.html','0','a:1:{s:4:\"form\";a:1:{s:4:\"show\";a:3:{i:0;s:3:\"url\";i:1;s:7:\"keyword\";i:2;s:4:\"rank\";}}}');
INSERT INTO `io_model` VALUES('7','2','医生','member_doctor','list_doctor.html','show_doctor.html','0','');
INSERT INTO `io_model` VALUES('8','4','疾病管理','diy_disease','list_disease.html','show_disease.html','0','a:1:{s:4:\"form\";a:1:{s:4:\"show\";a:3:{i:0;s:4:\"type\";i:1;s:5:\"title\";i:2;s:4:\"info\";}}}');
INSERT INTO `io_model` VALUES('9','4','地域管理','diy_area','list_area.html','show_area.html','0','a:1:{s:4:\"form\";a:1:{s:4:\"show\";a:5:{i:0;s:8:\"province\";i:1;s:4:\"city\";i:2;s:6:\"county\";i:3;s:5:\"towns\";i:4;s:7:\"village\";}}}');
INSERT INTO `io_model` VALUES('10','4','医疗机构','diy_mechanism','list_mechanism.html','show_mechanism.html','0','a:1:{s:4:\"form\";a:1:{s:4:\"show\";a:6:{i:0;s:5:\"title\";i:1;s:7:\"address\";i:2;s:5:\"level\";i:3;s:7:\"contact\";i:4;s:5:\"phone\";i:5;s:4:\"type\";}}}');
INSERT INTO `io_model` VALUES('11','4','医生管理','diy_doctor','list_doctor.html','show_doctor.html','0','a:1:{s:4:\"form\";a:1:{s:4:\"show\";a:6:{i:0;s:4:\"name\";i:1;s:3:\"sex\";i:2;s:5:\"minzu\";i:3;s:5:\"phone\";i:4;s:4:\"area\";i:5;s:9:\"mechanism\";}}}');
INSERT INTO `io_model` VALUES('12','4','家庭管理@(废弃)','diy_family','list_family.html','show_family.html','0','a:1:{s:4:\"form\";a:1:{s:4:\"show\";a:14:{i:0;s:4:\"bxzt\";i:1;s:4:\"name\";i:2;s:6:\"avatar\";i:3;s:8:\"realname\";i:4;s:7:\"xingbie\";i:5;s:8:\"birthday\";i:6;s:5:\"minzu\";i:7;s:5:\"phone\";i:8;s:6:\"cardid\";i:9;s:7:\"address\";i:10;s:12:\"relationship\";i:11;s:6:\"health\";i:12;s:9:\"attribute\";i:13;s:6:\"doctor\";}}}');
INSERT INTO `io_model` VALUES('14','3','问诊回答','form_answer','list_answer.html','form.html','13','a:1:{s:4:\"form\";a:8:{s:4:\"post\";s:1:\"0\";s:3:\"num\";s:1:\"0\";s:4:\"time\";s:0:\"\";s:5:\"check\";s:1:\"0\";s:4:\"code\";s:1:\"0\";s:6:\"member\";s:1:\"1\";s:4:\"show\";a:1:{i:0;s:7:\"content\";}s:10:\"membershow\";a:1:{i:0;s:7:\"content\";}}}');
INSERT INTO `io_model` VALUES('16','3','分享内容','form_share','list_share.html','form.html','1','a:1:{s:4:\"form\";a:8:{s:4:\"post\";s:1:\"1\";s:3:\"num\";s:1:\"1\";s:4:\"time\";s:0:\"\";s:5:\"check\";s:1:\"0\";s:4:\"code\";s:1:\"0\";s:6:\"member\";s:1:\"1\";s:4:\"show\";a:1:{i:0;s:7:\"content\";}s:10:\"membershow\";a:1:{i:0;s:7:\"content\";}}}');
INSERT INTO `io_model` VALUES('17','3','点赞功能','form_like','list_like.html','form.html','1','a:1:{s:4:\"form\";a:8:{s:4:\"post\";s:1:\"1\";s:3:\"num\";s:1:\"1\";s:4:\"time\";s:0:\"\";s:5:\"check\";s:1:\"0\";s:4:\"code\";s:1:\"0\";s:6:\"member\";s:1:\"0\";s:4:\"show\";a:1:{i:0;s:4:\"type\";}s:10:\"membershow\";a:1:{i:0;s:4:\"type\";}}}');
INSERT INTO `io_model` VALUES('18','1','培训信息','content_learning','list_learning.html','show_learning.html','0','a:1:{s:7:\"default\";a:6:{s:5:\"title\";a:2:{s:4:\"name\";s:6:\"标题\";s:4:\"show\";s:1:\"1\";}s:8:\"keywords\";a:2:{s:4:\"name\";s:9:\"关键字\";s:4:\"show\";s:1:\"1\";}s:5:\"thumb\";a:2:{s:4:\"name\";s:9:\"缩略图\";s:4:\"show\";s:1:\"1\";}s:11:\"description\";a:2:{s:4:\"name\";s:6:\"描述\";s:4:\"show\";s:1:\"1\";}s:4:\"time\";a:2:{s:4:\"name\";s:12:\"发布时间\";s:4:\"show\";s:1:\"1\";}s:4:\"hits\";a:2:{s:4:\"name\";s:9:\"阅读数\";s:4:\"show\";s:1:\"1\";}}}');
INSERT INTO `io_model` VALUES('19','1','居民模型','content_users','list_users.html','show_users.html','','a:1:{s:7:\"default\";a:6:{s:5:\"title\";a:2:{s:4:\"name\";s:6:\"标题\";s:4:\"show\";s:1:\"1\";}s:8:\"keywords\";a:2:{s:4:\"name\";s:9:\"关键字\";s:4:\"show\";s:1:\"0\";}s:5:\"thumb\";a:2:{s:4:\"name\";s:9:\"缩略图\";s:4:\"show\";s:1:\"1\";}s:11:\"description\";a:2:{s:4:\"name\";s:6:\"描述\";s:4:\"show\";s:1:\"1\";}s:4:\"time\";a:2:{s:4:\"name\";s:12:\"发布时间\";s:4:\"show\";s:1:\"1\";}s:4:\"hits\";a:2:{s:4:\"name\";s:9:\"阅读数\";s:4:\"show\";s:1:\"0\";}}}');
INSERT INTO `io_model` VALUES('20','3','体检结果','form_report','list_report.html','form.html','19','a:1:{s:4:\"form\";a:8:{s:4:\"post\";s:1:\"1\";s:3:\"num\";s:1:\"0\";s:4:\"time\";s:0:\"\";s:5:\"check\";s:1:\"0\";s:4:\"code\";s:1:\"0\";s:6:\"member\";s:1:\"0\";s:4:\"show\";a:1:{i:0;s:7:\"content\";}s:10:\"membershow\";a:1:{i:0;s:7:\"content\";}}}');
INSERT INTO `io_model` VALUES('21','4','广告','diy_ad','list_ad.html','show_ad.html','','a:1:{s:4:\"form\";a:1:{s:4:\"show\";a:2:{i:0;s:12:\"lianjiedizhi\";i:1;s:4:\"info\";}}}');
INSERT INTO `io_model` VALUES('22','4','消息提醒','diy_message','list_message.html','show_message.html','','a:1:{s:4:\"form\";a:1:{s:4:\"show\";a:5:{i:0;s:6:\"userid\";i:1;s:4:\"type\";i:2;s:3:\"msg\";i:3;s:6:\"status\";i:4;s:3:\"url\";}}}');
INSERT INTO `io_model` VALUES('23','3','健康预警','form_warning','list_warning.html','warning.html','19','a:1:{s:4:\"form\";a:8:{s:4:\"post\";s:1:\"0\";s:3:\"num\";s:1:\"0\";s:4:\"time\";s:0:\"\";s:5:\"check\";s:1:\"0\";s:4:\"code\";s:1:\"0\";s:6:\"member\";s:1:\"0\";s:4:\"show\";a:14:{i:0;s:3:\"ssy\";i:1;s:3:\"szy\";i:2;s:7:\"xuetang\";i:3;s:7:\"xdtinfo\";i:4;s:6:\"xdtpic\";i:5;s:5:\"maibo\";i:6;s:5:\"tiwen\";i:7;s:7:\"shengao\";i:8;s:7:\"tizhong\";i:9;s:3:\"BMI\";i:10;s:4:\"yyqk\";i:11;s:4:\"yybz\";i:12;s:6:\"hwinfo\";i:13;s:5:\"hwpic\";}s:10:\"membershow\";a:14:{i:0;s:3:\"ssy\";i:1;s:3:\"szy\";i:2;s:7:\"xuetang\";i:3;s:7:\"xdtinfo\";i:4;s:6:\"xdtpic\";i:5;s:5:\"maibo\";i:6;s:5:\"tiwen\";i:7;s:7:\"shengao\";i:8;s:7:\"tizhong\";i:9;s:3:\"BMI\";i:10;s:4:\"yyqk\";i:11;s:4:\"yybz\";i:12;s:6:\"hwinfo\";i:13;s:5:\"hwpic\";}}}');
INSERT INTO `io_model` VALUES('24','4','居民投诉','diy_tousu','list_tousu.html','show_tousu.html','','a:1:{s:4:\"form\";a:1:{s:4:\"show\";a:5:{i:0;s:3:\"uid\";i:1;s:6:\"userid\";i:2;s:7:\"content\";i:3;s:3:\"cid\";i:4;s:4:\"time\";}}}');

DROP TABLE IF EXISTS `io_model_field`;
CREATE TABLE `io_model_field` (
  `fieldid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `modelid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `field` varchar(20) NOT NULL,
  `name` varchar(30) NOT NULL,
  `isshow` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `tips` text NOT NULL,
  `pattern` varchar(255) NOT NULL,
  `errortips` varchar(255) NOT NULL,
  `formtype` varchar(20) NOT NULL,
  `inputtype` varchar(20) NOT NULL COMMENT '前段表现类型',
  `setting` mediumtext NOT NULL,
  `listorder` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `disabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`fieldid`),
  KEY `modelid` (`modelid`)
) ENGINE=MyISAM AUTO_INCREMENT=110 DEFAULT CHARSET=utf8;

INSERT INTO `io_model_field` VALUES('1','1','content','内容','1','','','','editor','','a:4:{s:7:\"toolbar\";s:1:\"1\";s:5:\"width\";s:3:\"700\";s:6:\"height\";s:3:\"450\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('57','13','content','内容 ','1','','','','editor','','','0','0');
INSERT INTO `io_model_field` VALUES('58','14','content','回答内容','1','','1','','input','','a:2:{s:4:\"size\";s:3:\"180\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('60','13','files','问诊附件','1','上传最近在医院或诊所的检查结果和处方等','','','files','','a:3:{s:4:\"type\";s:11:\"gif,png,jpg\";s:7:\"preview\";s:1:\"1\";s:4:\"size\";s:1:\"2\";}','0','0');
INSERT INTO `io_model_field` VALUES('62','16','content','分享感言','1','','1','','textarea','','a:3:{s:5:\"width\";s:3:\"100\";s:6:\"height\";s:2:\"46\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('67','3','phone','手机号','1','','','','input','','a:2:{s:4:\"size\";s:3:\"180\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('68','3','content','建议内容','1','','1','','textarea','','a:3:{s:5:\"width\";s:3:\"650\";s:6:\"height\";s:2:\"46\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('6','4','pinglunneirong','评论内容','1','','1','评论内容不能为空','textarea','','a:3:{s:5:\"width\";s:3:\"400\";s:6:\"height\";s:2:\"90\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('7','6','url','链接地址','1','请输入链接网址或者相对路径','1','请输入正确的链接地址','input','','a:2:{s:4:\"size\";s:3:\"200\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('8','6','keyword','关键词','1','请输入要增加内链的关键词','1','关键词不能为空','input','','a:2:{s:4:\"size\";s:3:\"180\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('9','6','rank','权重','1','','/^[0-9-]+$/','','input','','a:2:{s:4:\"size\";s:3:\"180\";s:12:\"defaultvalue\";s:1:\"0\";}','0','0');
INSERT INTO `io_model_field` VALUES('10','6','target','打开方式','1','选择链接打开方式','','','radio','','a:2:{s:7:\"content\";s:14:\"新建窗口|1\";s:12:\"defaultvalue\";s:0:\"\";}','3','0');
INSERT INTO `io_model_field` VALUES('11','6','num','替换次数','1','请输入替换的最大次数','/^[0-9.-]+$/','只能是数字','input','','a:2:{s:4:\"size\";s:3:\"180\";s:12:\"defaultvalue\";s:1:\"1\";}','0','0');
INSERT INTO `io_model_field` VALUES('12','8','type','疾病种类','1','请选择疾病种类','1','','radio','','a:2:{s:7:\"content\";s:35:\"传染性疾病\r\n非传染性疾病\";s:12:\"defaultvalue\";s:15:\"传染性疾病\";}','0','0');
INSERT INTO `io_model_field` VALUES('13','8','title','疾病名称','1','请输入疾病名称','1','疾病名称不能为空','input','','a:2:{s:4:\"size\";s:3:\"180\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('14','8','info','疾病描述','1','','','','editor','','a:5:{s:7:\"toolbar\";s:1:\"0\";s:5:\"items\";s:0:\"\";s:5:\"width\";s:3:\"680\";s:6:\"height\";s:3:\"300\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('16','9','province','省份','1','','1','','input','','a:2:{s:4:\"size\";s:3:\"180\";s:12:\"defaultvalue\";s:0:\"\";}','6','0');
INSERT INTO `io_model_field` VALUES('17','9','city','城市','1','','1','','input','','a:2:{s:4:\"size\";s:3:\"180\";s:12:\"defaultvalue\";s:0:\"\";}','5','0');
INSERT INTO `io_model_field` VALUES('19','9','village','行政村','1','','1','','input','','a:2:{s:4:\"size\";s:3:\"180\";s:12:\"defaultvalue\";s:0:\"\";}','2','0');
INSERT INTO `io_model_field` VALUES('20','9','county','区县','1','','1','','input','','a:2:{s:4:\"size\";s:3:\"180\";s:12:\"defaultvalue\";s:0:\"\";}','4','0');
INSERT INTO `io_model_field` VALUES('21','10','title','机构名称','1','','1','','input','','a:2:{s:4:\"size\";s:3:\"180\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('22','10','address','地址','1','','1','','input','','a:2:{s:4:\"size\";s:3:\"180\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('23','10','level','等级','1','','1','','select','','a:2:{s:7:\"content\";s:28:\"一级|1\r\n二级|2\r\n三级|3\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('24','10','contact','联系人','1','','1','','input','','a:2:{s:4:\"size\";s:3:\"180\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('25','10','phone','联系电话','1','','/^[0-9-]{6,13}||^(1)[0-9]{10}$/','','input','','a:2:{s:4:\"size\";s:3:\"180\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('26','10','type','属性','1','','','','select','','a:2:{s:7:\"content\";s:18:\"公立|0\r\n私立|1\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('27','11','name','姓名','1','','1','','input','','a:2:{s:4:\"size\";s:3:\"180\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('28','11','sex','性别','1','','1','','radio','','a:2:{s:7:\"content\";s:12:\"男|0\r\n女|1\";s:12:\"defaultvalue\";s:1:\"0\";}','0','0');
INSERT INTO `io_model_field` VALUES('29','11','minzu','民族','1','','1','','input','','a:2:{s:4:\"size\";s:3:\"180\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('30','11','phone','手机号','1','','/^(1)[0-9]{10}$/','','input','','a:2:{s:4:\"size\";s:3:\"180\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('31','11','cardid','身份证号码','1','','1','','input','','a:2:{s:4:\"size\";s:3:\"180\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('32','11','address','家庭地址','1','','1','','input','','a:2:{s:4:\"size\";s:3:\"180\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('33','11','birthday','出生日期','1','','1','','date','','a:1:{s:4:\"type\";s:10:\"yyyy-MM-dd\";}','0','0');
INSERT INTO `io_model_field` VALUES('34','11','best','擅长','1','','1','','input','','a:2:{s:4:\"size\";s:3:\"180\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('35','11','ranks','职称','1','','1','','input','','a:2:{s:4:\"size\";s:3:\"180\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('36','11','area','负责区域','1','','1','','input','','a:2:{s:4:\"size\";s:3:\"180\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('37','11','mechanism','所在医院/卫生室','1','','1','','input','','a:2:{s:4:\"size\";s:3:\"180\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('38','11','jianjie','简介','1','','','','editor','','a:5:{s:7:\"toolbar\";s:1:\"0\";s:5:\"items\";s:0:\"\";s:5:\"width\";s:3:\"680\";s:6:\"height\";s:3:\"300\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('39','11','gongzuojingyan','工作经验','1','','','','editor','','a:5:{s:7:\"toolbar\";s:1:\"0\";s:5:\"items\";s:0:\"\";s:5:\"width\";s:3:\"680\";s:6:\"height\";s:3:\"300\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('40','11','files','证书','1','','','','files','','a:3:{s:4:\"type\";s:11:\"gif,png,jpg\";s:7:\"preview\";s:1:\"1\";s:4:\"size\";s:1:\"2\";}','0','0');
INSERT INTO `io_model_field` VALUES('41','12','bxzt','保险状态','1','','1','','radio','','a:2:{s:7:\"content\";s:31:\"新农合|1\r\n社保|2\r\n商保|3\";s:12:\"defaultvalue\";s:1:\"1\";}','0','0');
INSERT INTO `io_model_field` VALUES('42','12','name','户主姓名','1','','1','','input','','a:2:{s:4:\"size\";s:3:\"180\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('44','12','avatar','头像','1','','1','','file','','a:3:{s:4:\"type\";s:11:\"gif,png,jpg\";s:7:\"preview\";s:1:\"0\";s:4:\"size\";s:1:\"2\";}','0','0');
INSERT INTO `io_model_field` VALUES('45','12','realname','姓名','1','','1','','input','','','0','0');
INSERT INTO `io_model_field` VALUES('46','12','xingbie','性别','1','','1','','radio','','a:2:{s:7:\"content\";s:12:\"男|0\r\n女|1\";s:12:\"defaultvalue\";s:1:\"0\";}','0','0');
INSERT INTO `io_model_field` VALUES('48','12','birthday','出生日期','1','','1','','date','','a:1:{s:4:\"type\";s:10:\"yyyy-MM-dd\";}','0','0');
INSERT INTO `io_model_field` VALUES('49','12','minzu','民族','1','','1','','input','','a:2:{s:4:\"size\";s:3:\"180\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('50','12','phone','手机号','1','','/^(1)[0-9]{10}$/','','input','','a:2:{s:4:\"size\";s:3:\"180\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('51','12','cardid','身份证号','1','','1','','input','','a:2:{s:4:\"size\";s:3:\"180\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('52','12','address','家庭地址','1','','1','','input','','a:2:{s:4:\"size\";s:3:\"180\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('53','12','relationship','与户主关系','1','','1','','input','','a:2:{s:4:\"size\";s:3:\"180\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('54','12','health','健康状况','1','','1','','input','','a:2:{s:4:\"size\";s:3:\"180\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('55','12','attribute','家庭属性','1','','1','','radio','','a:2:{s:7:\"content\";s:14:\"贫困\r\n普通\";s:12:\"defaultvalue\";s:6:\"贫困\";}','0','0');
INSERT INTO `io_model_field` VALUES('56','12','doctor','家庭医生','1','','1','','input','','','0','0');
INSERT INTO `io_model_field` VALUES('66','1','images','图片集','1','','','','files','','a:3:{s:4:\"type\";s:11:\"gif,png,jpg\";s:7:\"preview\";s:1:\"1\";s:4:\"size\";s:1:\"2\";}','0','0');
INSERT INTO `io_model_field` VALUES('64','18','content','内容 ','1','','','','editor','','','0','0');
INSERT INTO `io_model_field` VALUES('65','17','type','心情','1','','1','','radio','','a:2:{s:7:\"content\";s:12:\"赞|1\r\n踩|0\";s:12:\"defaultvalue\";s:1:\"1\";}','0','0');
INSERT INTO `io_model_field` VALUES('69','7','cardid','身份证号','1','','1','','input','','a:2:{s:4:\"size\";s:3:\"180\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('70','7','brithday','出生日期','1','','1','','date','','a:1:{s:4:\"type\";s:10:\"yyyy-MM-dd\";}','0','0');
INSERT INTO `io_model_field` VALUES('71','7','good','专长疾病','1','','1','','input','','a:2:{s:4:\"size\";s:3:\"180\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('72','7','info','医生简介','1','','1','','textarea','','a:3:{s:5:\"width\";s:3:\"600\";s:6:\"height\";s:2:\"46\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('73','7','images','证书','1','','1','','files','','a:3:{s:4:\"type\";s:11:\"gif,png,jpg\";s:7:\"preview\";s:1:\"1\";s:4:\"size\";s:1:\"2\";}','0','0');
INSERT INTO `io_model_field` VALUES('74','19','content','备注','1','','','','textarea','','a:3:{s:5:\"width\";s:3:\"500\";s:6:\"height\";s:2:\"46\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('75','19','cardid','身份证号','1','','1','','input','','a:2:{s:4:\"size\";s:3:\"240\";s:12:\"defaultvalue\";s:0:\"\";}','10','0');
INSERT INTO `io_model_field` VALUES('76','19','sex','性别','1','','','','radio','','a:2:{s:7:\"content\";s:12:\"男|1\r\n女|2\";s:12:\"defaultvalue\";s:1:\"1\";}','9','0');
INSERT INTO `io_model_field` VALUES('77','19','age','年龄','1','','/^[0-9.-]+$/','','input','tel','a:2:{s:4:\"size\";s:2:\"80\";s:12:\"defaultvalue\";s:0:\"\";}','8','0');
INSERT INTO `io_model_field` VALUES('78','19','poor','是否贫穷','1','','','','radio','','a:2:{s:7:\"content\";s:12:\"是|1\r\n否|0\";s:12:\"defaultvalue\";s:1:\"1\";}','7','0');
INSERT INTO `io_model_field` VALUES('79','19','phone','手机号','1','','/^(1)[0-9]{10}$/','','input','tel','a:2:{s:4:\"size\";s:3:\"240\";s:12:\"defaultvalue\";s:0:\"\";}','6','0');
INSERT INTO `io_model_field` VALUES('80','20','content','体检报告','1','','1','','textarea','','a:3:{s:5:\"width\";s:3:\"600\";s:6:\"height\";s:2:\"46\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('81','21','lianjiedizhi','链接地址','1','空连接 可填写 javascript:;','1','','input','','a:2:{s:4:\"size\";s:3:\"180\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('82','21','pic','图片','1','','1','','file','','a:3:{s:4:\"type\";s:11:\"gif,png,jpg\";s:7:\"preview\";s:1:\"0\";s:4:\"size\";s:1:\"2\";}','0','0');
INSERT INTO `io_model_field` VALUES('83','21','info','说明','1','','','','input','','a:2:{s:4:\"size\";s:3:\"360\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('84','22','userid','用户id','1','','','','input','','a:2:{s:4:\"size\";s:3:\"180\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('85','22','type','消息类型','1','','','','input','','a:2:{s:4:\"size\";s:3:\"180\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('86','22','msg','消息内容','1','','','','textarea','','a:3:{s:5:\"width\";s:3:\"100\";s:6:\"height\";s:2:\"46\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('87','22','status','状态','1','','','','radio','','a:2:{s:7:\"content\";s:18:\"未读|0\r\n已读|1\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('88','22','url','跳转地址','1','','','','input','','a:2:{s:4:\"size\";s:3:\"180\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('89','22','time','创建时间','1','','','','input','','a:2:{s:4:\"size\";s:3:\"180\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('90','23','ssy','收缩压','1','','','','input','','a:2:{s:4:\"size\";s:3:\"180\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('91','23','szy','舒张压','1','','','','input','','a:2:{s:4:\"size\";s:3:\"180\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('92','23','xuetang','血糖','1','','','','input','','a:2:{s:4:\"size\";s:3:\"180\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('93','23','xdtinfo','心电图','1','','','','textarea','','a:3:{s:5:\"width\";s:3:\"100\";s:6:\"height\";s:2:\"46\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('94','23','xdtpic','心电图','1','','','','files','','a:3:{s:4:\"type\";s:11:\"gif,png,jpg\";s:7:\"preview\";s:1:\"0\";s:4:\"size\";s:1:\"2\";}','0','0');
INSERT INTO `io_model_field` VALUES('95','23','maibo','脉搏','1','','','','input','','a:2:{s:4:\"size\";s:3:\"180\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('96','23','tiwen','体温','1','','','','input','','a:2:{s:4:\"size\";s:3:\"180\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('97','23','shengao','身高','1','','','','input','','a:2:{s:4:\"size\";s:3:\"180\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('98','23','tizhong','体重','1','','','','input','','a:2:{s:4:\"size\";s:3:\"180\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('99','23','BMI','BMI','1','','','','input','','a:2:{s:4:\"size\";s:3:\"180\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('100','23','yyqk','用药情况','1','','','','radio','','a:2:{s:7:\"content\";s:46:\"未服用药物\r\n间断性用药\r\n长期用药\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('102','23','yybz','用药备注','1','','','','textarea','','a:3:{s:5:\"width\";s:3:\"100\";s:6:\"height\";s:2:\"46\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('103','23','hwinfo','红外诊断图','1','','','','textarea','','a:3:{s:5:\"width\";s:3:\"100\";s:6:\"height\";s:2:\"46\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('104','23','hwpic','红外诊断图','1','','','','files','','a:3:{s:4:\"type\";s:11:\"gif,png,jpg\";s:7:\"preview\";s:1:\"0\";s:4:\"size\";s:1:\"2\";}','0','0');
INSERT INTO `io_model_field` VALUES('105','24','uid','居民id','1','','','','input','','a:2:{s:4:\"size\";s:3:\"180\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('106','24','userid','医生id','1','','','','input','','a:2:{s:4:\"size\";s:3:\"180\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('107','24','content','投诉内容','1','','','','textarea','','a:3:{s:5:\"width\";s:3:\"100\";s:6:\"height\";s:2:\"46\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('108','24','cid','相关信息id','1','','','','input','','a:2:{s:4:\"size\";s:3:\"180\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');
INSERT INTO `io_model_field` VALUES('109','24','time','时间','1','','','','input','','a:2:{s:4:\"size\";s:3:\"180\";s:12:\"defaultvalue\";s:0:\"\";}','0','0');

DROP TABLE IF EXISTS `io_spider_catched`;
CREATE TABLE `io_spider_catched` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `urlkey` char(16) NOT NULL,
  `url` varchar(255) NOT NULL DEFAULT '',
  `dateline` int(11) unsigned NOT NULL DEFAULT '0',
  `rule` smallint(5) NOT NULL DEFAULT '0',
  `itemid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `urlkey` (`urlkey`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `io_spider_contentpagerules`;
CREATE TABLE `io_spider_contentpagerules` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `io_spider_contentrules`;
CREATE TABLE `io_spider_contentrules` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `io_spider_listrules`;
CREATE TABLE `io_spider_listrules` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


