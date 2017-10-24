# iaeweb bakfile
# version:iaeweb x1 
# time:2015-05-19 15:39:02
# http://www.iaeweb.com
# ----------------------------------------

DROP TABLE IF EXISTS `io_admin`;
CREATE TABLE IF NOT EXISTS `io_admin` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

INSERT INTO `io_admin` (`userid`, `username`, `password`, `roleid`, `realname`, `auth`, `list_size`, `left_width`) VALUES
(1, 'admin_name', 'admin_pass', 1, '超级管理员', '', 20, 180);

DROP TABLE IF EXISTS `io_autolink`;
CREATE TABLE `io_autolink` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `catid` smallint(5) NOT NULL,
  `url` varchar(255) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `rank` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `io_autolink` (`id`, `catid`, `url`, `keyword`,`rank`)  VALUES
('1','0','http://cms.iaeweb.com','轻量级CMS','0'),
('2','0','http://cms.iaeweb.com','好用的CMS','0');

DROP TABLE IF EXISTS `io_block`;
CREATE TABLE IF NOT EXISTS `io_block` (
  `id` smallint(8) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) NOT NULL,
  `name` varchar(50) NOT NULL,
  `content` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
  `username` char(20) NOT NULL,
  `time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `catid` (`catid`,`listorder`,`time`),
  KEY `time` (`catid`,`time`),
  KEY `status` (`catid`,`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `io_content_news`;
CREATE TABLE IF NOT EXISTS `io_content_news` (
  `id` mediumint(8) NOT NULL,
  `catid` smallint(5) NOT NULL,
  `content` mediumtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `catid` (`catid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `io_content_product`;
CREATE TABLE IF NOT EXISTS `io_content_product` (
  `id` mediumint(8) NOT NULL,
  `catid` smallint(5) NOT NULL,
  `content` mediumtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `catid` (`catid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `io_form_comment`;
CREATE TABLE IF NOT EXISTS `io_form_comment` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `cid` mediumint(8) NOT NULL,
  `userid` mediumint(8) NOT NULL,
  `username` char(20) NOT NULL,
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
CREATE TABLE IF NOT EXISTS `io_form_gestbook` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `cid` mediumint(8) NOT NULL,
  `userid` mediumint(8) NOT NULL,
  `username` char(20) NOT NULL,
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `time` int(10) unsigned NOT NULL DEFAULT '0',
  `ip` char(20) DEFAULT NULL,
  `nindexingming` varchar(255) DEFAULT NULL,
  `lianxiQQ` varchar(255) DEFAULT NULL,
  `liuyanneirong` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `listorder` (`listorder`),
  KEY `status` (`status`),
  KEY `time` (`time`),
  KEY `userid` (`userid`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `io_member`;
CREATE TABLE IF NOT EXISTS `io_member` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `username` char(20) NOT NULL DEFAULT '',
  `password` char(32) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL,
  `avatar` varchar(100) NOT NULL DEFAULT '',
  `modelid` smallint(5) NOT NULL,
  `regdate` int(10) unsigned NOT NULL DEFAULT '0',
  `regip` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `io_member_geren`;
CREATE TABLE IF NOT EXISTS `io_member_geren` (
  `id` mediumint(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `io_model`;
CREATE TABLE IF NOT EXISTS `io_model` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

INSERT INTO `io_model` (`modelid`, `typeid`, `modelname`, `tablename`, `listtpl`, `showtpl`, `joinid`, `setting`) VALUES
(1, 1, '文章模型', 'content_news', 'list_news.html', 'show_news.html', 0, 'a:1:{s:7:"default";a:6:{s:5:"title";a:2:{s:4:"name";s:6:"标题";s:4:"show";s:1:"1";}s:8:"keywords";a:2:{s:4:"name";s:9:"关键字";s:4:"show";s:1:"1";}s:5:"thumb";a:2:{s:4:"name";s:9:"缩略图";s:4:"show";s:1:"1";}s:11:"description";a:2:{s:4:"name";s:6:"描述";s:4:"show";s:1:"1";}s:4:"time";a:2:{s:4:"name";s:12:"发布时间";s:4:"show";s:1:"1";}s:4:"hits";a:2:{s:4:"name";s:9:"阅读数";s:4:"show";s:1:"1";}}}'),
(2, 1, '产品模型', 'content_product', 'list_product.html', 'show_product.html', NULL, 'a:1:{s:7:"default";a:6:{s:5:"title";a:2:{s:4:"name";s:6:"标题";s:4:"show";s:1:"1";}s:8:"keywords";a:2:{s:4:"name";s:9:"关键字";s:4:"show";s:1:"1";}s:5:"thumb";a:2:{s:4:"name";s:9:"缩略图";s:4:"show";s:1:"1";}s:11:"description";a:2:{s:4:"name";s:6:"描述";s:4:"show";s:1:"1";}s:4:"time";a:2:{s:4:"name";s:12:"发布时间";s:4:"show";s:1:"1";}s:4:"hits";a:2:{s:4:"name";s:9:"阅读数";s:4:"show";s:1:"1";}}}'),
(3, 3, '在线留言', 'form_gestbook', 'list_gestbook.html', 'form.html', NULL, 'a:1:{s:4:"form";a:8:{s:4:"post";s:1:"0";s:3:"num";s:1:"0";s:4:"time";s:0:"";s:5:"check";s:1:"0";s:4:"code";s:1:"0";s:6:"member";s:1:"0";s:4:"show";a:3:{i:0;s:13:"nindexingming";i:1;s:8:"lianxiQQ";i:2;s:13:"liuyanneirong";}s:10:"membershow";a:3:{i:0;s:13:"nindexingming";i:1;s:8:"lianxiQQ";i:2;s:13:"liuyanneirong";}}}'),
(4, 3, '文章评论', 'form_comment', 'list_comment.html', 'form.html', 1, 'a:1:{s:4:"form";a:8:{s:4:"post";s:1:"0";s:3:"num";s:1:"0";s:4:"time";s:0:"";s:5:"check";s:1:"0";s:4:"code";s:1:"0";s:6:"member";s:1:"0";s:4:"show";a:1:{i:0;s:14:"pinglunneirong";}s:10:"membershow";a:1:{i:0;s:14:"pinglunneirong";}}}'),
(5, 2, '个人', 'member_geren', 'list_geren.html', 'show_geren.html', NULL, NULL),
('6','4','自动内链','autolink','list_autolink.html','show_autolink.html','','a:1:{s:4:\"form\";a:1:{s:4:\"show\";a:3:{i:0;s:7:\"keyword\";i:1;s:3:\"url\";i:2;s:4:\"rank\";}}}');

DROP TABLE IF EXISTS `io_model_field`;
CREATE TABLE IF NOT EXISTS `io_model_field` (
  `fieldid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `modelid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `field` varchar(20) NOT NULL,
  `name` varchar(30) NOT NULL,
  `isshow` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `tips` text NOT NULL,
  `pattern` varchar(255) NOT NULL,
  `errortips` varchar(255) NOT NULL,
  `formtype` varchar(20) NOT NULL,
  `setting` mediumtext NOT NULL,
  `listorder` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `disabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`fieldid`),
  KEY `modelid` (`modelid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

INSERT INTO `io_model_field` (`fieldid`, `modelid`, `field`, `name`, `isshow`, `tips`, `pattern`, `errortips`, `formtype`, `setting`, `listorder`, `disabled`) VALUES
(1, 1, 'content', '内容', 1, '', '', '', 'editor', 'a:4:{s:7:"toolbar";s:1:"1";s:5:"width";s:3:"700";s:6:"height";s:3:"450";s:12:"defaultvalue";s:0:"";}', 0, 0),
(2, 2, 'content', '内容', 1, '', '', '', 'editor', 'a:5:{s:7:"toolbar";s:1:"2";s:5:"items";s:256:"''source'',''|'',''forecolor'',''bold'',''italic'',''underline'',''lineheight'',''|'',''fontname'',''fontsize'',''code'',''plainpaste'',''wordpaste'',''|'',''image'',''multiimage'',''flash'',''media'',''insertfile'',''link'',''unlink'',''|'',''justifyleft'',''justifycenter'',''justifyright'',''justifyfull''";s:5:"width";s:3:"700";s:6:"height";s:3:"450";s:12:"defaultvalue";s:190:"编辑器支持自定义啦，赶快去内容模型》产品模型》字段管理》编辑器里面看看吧&lt;br&gt;如需更多字段，请大家自己在字段管理处自行添加吧。";}', 0, 0),
(3, 3, 'nindexingming', '您的姓名', 1, '', '', '', 'input', 'a:2:{s:4:"size";s:3:"150";s:12:"defaultvalue";s:0:"";}', 0, 0),
(4, 3, 'lianxiQQ', '联系QQ', 1, '', '/^[0-9]{5,20}$/', '', 'input', 'a:2:{s:4:"size";s:3:"150";s:12:"defaultvalue";s:0:"";}', 0, 0),
(5, 3, 'liuyanneirong', '留言内容', 1, '', '1', '留言内容不能为空', 'textarea', 'a:3:{s:5:"width";s:3:"400";s:6:"height";s:2:"90";s:12:"defaultvalue";s:0:"";}', 0, 0),
(6, 4, 'pinglunneirong', '评论内容', 1, '', '1', '评论内容不能为空', 'textarea', 'a:3:{s:5:"width";s:3:"400";s:6:"height";s:2:"90";s:12:"defaultvalue";s:0:"";}', 0, 0),
('7','6','url','链接地址','1','请输入链接网址或者相对路径','1','请输入正确的链接地址','input','a:2:{s:4:\"size\";s:3:\"200\";s:12:\"defaultvalue\";s:0:\"\";}','0','0'),
('8','6','keyword','关键词','1','请输入要增加内链的关键词','1','关键词不能为空','input','a:2:{s:4:\"size\";s:3:\"180\";s:12:\"defaultvalue\";s:0:\"\";}','0','0'),
('9','6','rank','权重','1','','/^[0-9-]+$/','','input','a:2:{s:4:\"size\";s:3:\"180\";s:12:\"defaultvalue\";s:1:\"0\";}','0','0'),
('10','6','target','打开方式','1','选择链接打开方式','','','radio','a:2:{s:7:\"content\";s:14:\"新建窗口|1\";s:12:\"defaultvalue\";s:0:\"\";}','3','0'),
('11','6','num','替换次数','1','请输入替换的最大次数','/^[0-9.-]+$/','只能是数字','input','a:2:{s:4:\"size\";s:3:\"180\";s:12:\"defaultvalue\";s:1:\"1\";}','0','0');

DROP TABLE IF EXISTS `io_spider_catched`;
CREATE TABLE IF NOT EXISTS `io_spider_catched` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `urlkey` char(16) NOT NULL,
  `url` varchar(255) NOT NULL DEFAULT '',
  `dateline` int(11) unsigned NOT NULL DEFAULT '0',
  `rule` smallint(5) NOT NULL DEFAULT '0',
  `itemid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `urlkey` (`urlkey`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `io_spider_contentpagerules`;
CREATE TABLE IF NOT EXISTS `io_spider_contentpagerules` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `io_spider_contentrules`;
CREATE TABLE IF NOT EXISTS `io_spider_contentrules` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `io_spider_listrules`;
CREATE TABLE IF NOT EXISTS `io_spider_listrules` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `io_filters`;
CREATE TABLE IF NOT EXISTS `io_filters` (
  `id` tinyint(1) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT '',
  `data` text NOT NULL,
  `ext` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;