DROP TABLE IF EXISTS `{..pref..}admin_cp`;
CREATE TABLE IF NOT EXISTS `{..pref..}admin_cp` (
  `page_id` varchar(255) NOT NULL,
  `group_id` varchar(20) NOT NULL,
  `page_file` varchar(255) NOT NULL,
  `page_pos` tinyint(3) NOT NULL DEFAULT '0',
  `page_int_sub_perm` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`page_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `{..pref..}admin_cp` (`page_id`, `group_id`, `page_file`, `page_pos`, `page_int_sub_perm`) VALUES
('start_general', '-1', 'general', 1, 0),
('start_content', '-1', 'content', 2, 0),
('start_media', '-1', 'media', 3, 0),
('start_interactive', '-1', 'interactive', 4, 0),
('start_promo', '-1', 'promo', 5, 0),
('start_user', '-1', 'user', 6, 0),
('start_styles', '-1', 'styles', 7, 0),
('start_system', '-1', 'system', 8, 0),
('start_mods', '-1', 'mods', 9, 0),
('partner_config', 'affiliates', 'admin_partnerconfig.php', 1, 0),
('partner_add', 'affiliates', 'admin_partneradd.php', 2, 0),
('partner_edit', 'affiliates', 'admin_partneredit.php', 3, 0),
('aliases_add', 'aliases', 'admin_aliases_add.php', 1, 0),
('aliases_delete', 'aliases', 'aliases_edit', 1, 1),
('aliases_edit', 'aliases', 'admin_aliases_edit.php', 2, 0),
('applets_add', 'applets', 'admin_applets_add.php', 1, 0),
('applets_delete', 'applets', 'applets_edit', 1, 1),
('applets_edit', 'applets', 'admin_applets_edit.php', 2, 0),
('articles_config', 'articles', 'admin_articles_config.php', 1, 0),
('articles_add', 'articles', 'admin_articles_add.php', 2, 0),
('articles_edit', 'articles', 'admin_articles_edit.php', 3, 0),
('articles_cat', 'articles', 'admin_articles_cat.php', 4, 0),
('cimg_add', 'cimg', 'admin_cimg.php', 1, 0),
('cimg_admin', 'cimg', 'admin_cimgdel.php', 2, 0),
('dl_config', 'downloads', 'admin_dlconfig.php', 1, 0),
('dl_add', 'downloads', 'admin_dladd.php', 2, 0),
('dl_edit', 'downloads', 'admin_dledit.php', 3, 0),
('dl_cat', 'downloads', 'admin_dlcat.php', 4, 0),
('dl_newcat', 'downloads', 'admin_dlnewcat.php', 5, 0),
('dlcommentedit', 'downloads', 'admin_dlcommentedit.php', 6, 0),
('editor_config', 'fseditor', 'admin_editor_config.php', 1, 0),
('editor_design', 'fseditor', 'admin_editor_design.php', 2, 0),
('editor_smilies', 'fseditor', 'admin_editor_smilies.php', 3, 0),
('editor_fscodes', 'fseditor', 'admin_editor_fscode.php', 4, 0),
('gallery_config', 'gallery', 'admin_screenconfig.php', 1, 0),
('screens_add', 'gallery_img', 'admin_screenadd.php', 1, 0),
('wp_add', 'gallery_wp', 'admin_wallpaperadd.php', 1, 0),
('gallery_cat', 'gallery', 'admin_screencat.php', 2, 0),
('randompic_config', 'gallery_preview', 'admin_randompic_config.php', 1, 0),
('gallery_newcat', 'gallery', 'admin_screennewcat.php', 3, 0),
('screens_edit', 'gallery_img', 'admin_screenedit.php', 2, 0),
('wp_edit', 'gallery_wp', 'admin_wallpaperedit.php', 2, 0),
('gen_config', 'general', 'admin_general_config.php', 1, 0),
('gen_announcement', 'general', 'admin_allannouncement.php', 2, 0),
('gen_captcha', 'general', 'admin_captcha_config.php', 2, 0),
('gen_emails', 'general', 'admin_allemail.php', 4, 0),
('gen_phpinfo', 'general', 'admin_allphpinfo.php', 5, 0),
('group_config', 'groups', 'admin_group_config.php', 1, 0),
('group_admin', 'groups', 'admin_group_admin.php', 2, 0),
('group_rights', 'groups', 'admin_group_rights.php', 3, 0),
('news_config', 'news', 'admin_news_config.php', 1, 0),
('news_delete', 'news', 'news_edit', 1, 1),
('news_add', 'news', 'admin_news_add.php', 2, 0),
('news_comments', 'news', 'news_edit', 2, 1),
('news_edit', 'news', 'admin_news_edit.php', 3, 0),
('news_cat', 'news', 'admin_news_cat.php', 4, 0),
('player_config', 'player', 'admin_player_config.php', 1, 0),
('player_add', 'player', 'admin_player_add.php', 2, 0),
('player_edit', 'player', 'admin_player_edit.php', 3, 0),
('poll_config', 'polls', 'admin_pollconfig.php', 1, 0),
('poll_add', 'polls', 'admin_polladd.php', 2, 0),
('poll_edit', 'polls', 'admin_polledit.php', 3, 0),
('article_preview', 'popup', 'admin_articles_prev.php', 0, 0),
('find_applet', 'popup', 'admin_find_applet.php', 0, 0),
('find_file', 'popup', 'admin_find_file.php', 0, 0),
('find_gallery_img', 'popup', 'admin_findpicture.php', 0, 0),
('find_user', 'popup', 'admin_finduser.php', 0, 0),
('frogpad', 'popup', 'admin_frogpad.php', 0, 0),
('news_preview', 'popup', 'admin_news_prev.php', 0, 0),
('press_config', 'press', 'admin_press_config.php', 1, 0),
('press_add', 'press', 'admin_press_add.php', 2, 0),
('press_edit', 'press', 'admin_press_edit.php', 3, 0),
('press_admin', 'press', 'admin_press_admin.php', 4, 0),
('search_config', 'search', 'admin_search_config.php', 1, 0),
('search_index', 'search', 'admin_search_index.php', 2, 0),
('shop_add', 'shop', 'admin_shopadd.php', 1, 0),
('shop_edit', 'shop', 'admin_shopedit.php', 2, 0),
('snippets_add', 'snippets', 'admin_snippets_add.php', 1, 0),
('snippets_delete', 'snippets', 'snippets_edit', 1, 1),
('snippets_edit', 'snippets', 'admin_snippets_edit.php', 2, 0),
('stat_view', 'stats', 'admin_statview.php', 1, 0),
('stat_edit', 'stats', 'admin_statedit.php', 2, 0),
('stat_ref', 'stats', 'admin_statref.php', 3, 0),
('style_add', 'styles', 'admin_style_add.php', 1, 0),
('style_management', 'styles', 'admin_style_management.php', 2, 0),
('style_css', 'styles', 'admin_template_css.php', 3, 0),
('style_js', 'styles', 'admin_template_js.php', 4, 0),
('style_nav', 'styles', 'admin_template_nav.php', 5, 0),
('tpl_main', 'templates', 'admin_template_main.php', 1, 0),
('tpl_general', 'templates', 'admin_template_general.php', 2, 0),
('tpl_user', 'templates', 'admin_template_user.php', 2, 0),
('tpl_articles', 'templates', 'admin_template_articles.php', 3, 0),
('tpl_news', 'templates', 'admin_template_news.php', 3, 0),
('tpl_search', 'templates', 'admin_template_search.php', 3, 0),
('tpl_viewer', 'templates', 'admin_template_viewer.php', 3, 0),
('tpl_poll', 'templates', 'admin_template_poll.php', 4, 0),
('tpl_press', 'templates', 'admin_template_press.php', 5, 0),
('tpl_screens', 'templates', 'admin_template_screenshot.php', 6, 0),
('tpl_wp', 'templates', 'admin_template_wallpaper.php', 7, 0),
('tpl_previewimg', 'templates', 'admin_template_previewimg.php', 8, 0),
('tpl_dl', 'templates', 'admin_template_dl.php', 9, 0),
('tpl_shop', 'templates', 'admin_template_shop.php', 10, 0),
('tpl_affiliates', 'templates', 'admin_template_affiliates.php', 11, 0),
('tpl_editor', 'templates', 'admin_editor_design.php', 13, 0),
('tpl_fscodes', 'templates', 'admin_editor_fscode.php', 14, 0),
('tpl_player', 'templates', 'admin_template_player.php', 20, 0),
('tpl_topdownloads', 'templates', 'admin_template_topdownloads.php', 25, 0),
('user_config', 'users', 'admin_user_config.php', 1, 0),
('user_add', 'users', 'admin_user_add.php', 2, 0),
('user_edit', 'users', 'admin_user_edit.php', 3, 0),
('user_rights', 'users', 'admin_user_rights.php', 4, 0),
('news_comments_list', 'news', 'admin_news_comments_list.php', 4, 0),
('cimg_cat', 'cimg', 'admin_cimgcats.php', 3, 0),
('cimg_import', 'cimg', 'admin_cimgimport.php', 4, 0),
('stat_ref_delete', 'stats', 'stat_ref', 1, 1),
('randompic_cat', 'gallery_preview', 'admin_randompic_cat.php', 2, 0),
('timedpic_add', 'gallery_preview', 'admin_randompic_time_add.php', 3, 0),
('timedpic_edit', 'gallery_preview', 'admin_randompic_time.php', 4, 0),
('statgfx', 'popup', 'admin_statgfx.php', 0, 0),
('table_admin', 'db', 'admin_table_admin.php', 1, 0);


DROP TABLE IF EXISTS `{..pref..}admin_groups`;
CREATE TABLE IF NOT EXISTS `{..pref..}admin_groups` (
  `group_id` varchar(20) NOT NULL,
  `menu_id` varchar(20) NOT NULL,
  `group_pos` tinyint(3) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `{..pref..}admin_groups` (`group_id`, `menu_id`, `group_pos`) VALUES
('-1', 'none', 0),
('0', 'none', 0),
('general', 'general', 1),
('fseditor', 'general', 2),
('stats', 'general', 3),
('news', 'content', 1),
('articles', 'content', 2),
('press', 'content', 3),
('cimg', 'content', 4),
('gallery', 'media', 1),
('gallery_img', 'media', 2),
('gallery_wp', 'media', 3),
('gallery_preview', 'media', 4),
('downloads', 'media', 6),
('player', 'media', 7),
('polls', 'interactive', 1),
('affiliates', 'promo', 1),
('shop', 'promo', 2),
('users', 'user', 1),
('styles', 'styles', 1),
('templates', 'styles', 2),
('groups', 'user', 2),
('applets', 'system', 1),
('snippets', 'system', 2),
('aliases', 'system', 3),
('db', 'system', 4),
('search', 'general', 4),
('popup', 'none', 0);


DROP TABLE IF EXISTS `{..pref..}admin_inherited`;
CREATE TABLE IF NOT EXISTS `{..pref..}admin_inherited` (
  `group_id` varchar(255) NOT NULL,
  `pass_to` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `{..pref..}admin_inherited` (`group_id`, `pass_to`) VALUES
('applets', 'find_applet'),
('news', 'find_user'),
('articles', 'find_user'),
('news', 'news_preview'),
('articles', 'article_preview'),
('stats', 'statgfx');


DROP TABLE IF EXISTS `_temp_{..pref..}applets`;
CREATE TABLE `_temp_{..pref..}applets` (
	`applet_id` mediumint(8) NOT NULL auto_increment,
	`applet_file` varchar(100) NOT NULL,
	`applet_active` tinyint(1) NOT NULL default '1',
	`applet_include` tinyint(1) NOT NULL default '1',
	`applet_output` tinyint(1) NOT NULL default '1',
	UNIQUE INDEX `applet_file` ( `applet_file` ),
	PRIMARY KEY  ( `applet_id` )
) ENGINE = MyISAM CHARACTER SET = utf8;
INSERT INTO `_temp_{..pref..}applets` ( `applet_active`, `applet_file`, `applet_id`, `applet_output` ) SELECT `applet_active`, `applet_file`, `applet_id`, `applet_output` FROM `{..pref..}applets`;
DROP TABLE `{..pref..}applets`;
ALTER TABLE `_temp_{..pref..}applets` RENAME `{..pref..}applets`;
ALTER TABLE `{..pref..}applets` AUTO_INCREMENT = 0;


DROP TABLE IF EXISTS `{..pref..}b8_wordlist`;
CREATE TABLE IF NOT EXISTS `{..pref..}b8_wordlist` (
  `token` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `count_ham` int(10) unsigned DEFAULT NULL,
  `count_spam` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `{..pref..}b8_wordlist` (`token`, `count_ham`, `count_spam`) VALUES
('b8*dbversion', 3, NULL),
('b8*texts', 0, 0);


DROP TABLE IF EXISTS `{..pref..}cimg`;
CREATE TABLE IF NOT EXISTS `{..pref..}cimg` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` varchar(4) NOT NULL,
  `hasthumb` tinyint(1) NOT NULL,
  `cat` mediumint(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `{..pref..}cimg_cats`;
CREATE TABLE IF NOT EXISTS `{..pref..}cimg_cats` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `_temp_{..pref..}comments`;
CREATE TABLE `_temp_{..pref..}comments` (
 `comment_id` mediumint(8) NOT NULL AUTO_INCREMENT,
 `content_id` mediumint(8) NOT NULL,
 `content_type` varchar(32) NOT NULL,
 `comment_poster` varchar(32) DEFAULT NULL,
 `comment_poster_id` mediumint(8) DEFAULT NULL,
 `comment_poster_ip` varchar(16) NOT NULL,
 `comment_date` int(11) DEFAULT NULL,
 `comment_title` varchar(100) DEFAULT NULL,
 `comment_text` text DEFAULT NULL,
 `comment_classification` tinyint(4) NOT NULL DEFAULT '0',
 `spam_probability` float NOT NULL DEFAULT '0.5',
 `needs_update` tinyint(4) NOT NULL DEFAULT '1',
 FULLTEXT KEY `comment_title_text` ( `comment_text`, `comment_title` ),
 PRIMARY KEY  ( `comment_id` )
) ENGINE = MyISAM CHARACTER SET = utf8;
INSERT INTO `_temp_{..pref..}comments`(`comment_date`, `comment_id`, `comment_poster`, `comment_poster_id`, `comment_poster_ip`, `comment_text`, `comment_title`) SELECT `comment_date`, `comment_id`, `comment_poster`, `comment_poster_id`, `comment_poster_ip`, `comment_text`, `comment_title` FROM `{..pref..}news_comments`;
DROP TABLE `{..pref..}news_comments`;
ALTER TABLE `_temp_{..pref..}comments` RENAME `{..pref..}comments`;


DROP TABLE IF EXISTS `{..pref..}config`;
CREATE TABLE IF NOT EXISTS `{..pref..}config` (
  `config_name` varchar(30) NOT NULL,
  `config_data` text NOT NULL,
  `config_loadhook` varchar(255) NOT NULL DEFAULT 'none',
  UNIQUE KEY `config_name` (`config_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `_temp_{..pref..}email`;
CREATE TABLE `_temp_{..pref..}email` (
	`id` tinyint(1) NOT NULL default '1',
	`signup` text NOT NULL,
	`change_password` text NOT NULL,
	`delete_account` text NOT NULL,
	`change_password_ack` text NOT NULL,
	`use_admin_mail` tinyint(1) NOT NULL default '1',
	`email` varchar(100) NOT NULL,
	`html` tinyint(1) NOT NULL default '1',
	PRIMARY KEY  ( `id` )
) ENGINE = MyISAM CHARACTER SET = utf8;
INSERT INTO `_temp_{..pref..}email` ( `change_password`, `delete_account`, `email`, `html`, `id`, `signup`, `use_admin_mail` ) SELECT `change_password`, `delete_account`, `email`, `html`, `id`, `signup`, `use_admin_mail` FROM `{..pref..}email`;
DROP TABLE `{..pref..}email`;
ALTER TABLE `_temp_{..pref..}email` RENAME `{..pref..}email`;


CREATE TABLE IF NOT EXISTS `{..pref..}ftp` (
  `ftp_id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `ftp_title` varchar(100) NOT NULL,
  `ftp_type` varchar(10) NOT NULL,
  `ftp_url` varchar(255) NOT NULL,
  `ftp_user` varchar(255) NOT NULL,
  `ftp_pw` varchar(255) NOT NULL,
  `ftp_ssl` tinyint(1) NOT NULL,
  `ftp_http_url` varchar(255) NOT NULL,
  PRIMARY KEY (`ftp_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `{..pref..}hashes`;
CREATE TABLE IF NOT EXISTS `{..pref..}hashes` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `hash` varchar(40) CHARACTER SET utf8 NOT NULL,
  `type` varchar(20) CHARACTER SET utf8 NOT NULL,
  `typeId` mediumint(8) NOT NULL,
  `deleteTime` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `hash` (`hash`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
