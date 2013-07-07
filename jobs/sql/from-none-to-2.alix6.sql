SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

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


DROP TABLE IF EXISTS `{..pref..}aliases`;
CREATE TABLE IF NOT EXISTS `{..pref..}aliases` (
  `alias_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `alias_go` varchar(100) NOT NULL,
  `alias_forward_to` varchar(100) NOT NULL,
  `alias_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`alias_id`),
  KEY `alias_go` (`alias_go`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `{..pref..}announcement`;
CREATE TABLE IF NOT EXISTS `{..pref..}announcement` (
  `id` smallint(4) NOT NULL,
  `announcement_text` text,
  `show_announcement` tinyint(1) NOT NULL DEFAULT '0',
  `activate_announcement` tinyint(1) NOT NULL DEFAULT '0',
  `ann_html` tinyint(1) NOT NULL DEFAULT '1',
  `ann_fscode` tinyint(1) NOT NULL DEFAULT '1',
  `ann_para` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `{..pref..}announcement` (`id`, `announcement_text`, `show_announcement`, `activate_announcement`, `ann_html`, `ann_fscode`, `ann_para`) VALUES
(1, '', 2, 0, 1, 1, 1);


DROP TABLE IF EXISTS `{..pref..}applets`;
CREATE TABLE IF NOT EXISTS `{..pref..}applets` (
  `applet_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `applet_file` varchar(100) NOT NULL,
  `applet_active` tinyint(1) NOT NULL DEFAULT '1',
  `applet_include` tinyint(1) NOT NULL DEFAULT '1',
  `applet_output` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`applet_id`),
  UNIQUE KEY `applet_file` (`applet_file`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
INSERT INTO `{..pref..}applets` (`applet_file`, `applet_active`, `applet_include`, `applet_output`) VALUES
('dl-forwarding', 1, 1, 0),
('user-menu', 1, 2, 1),
('announcement', 1, 2, 1),
('mini-statistics', 1, 2, 1),
('poll-system', 1, 2, 1),
('preview-image', 1, 2, 1),
('shop-system', 1, 2, 1),
('topdownloads', 1, 2, 1),
('mini-search', 1, 1, 1),
('affiliates', 1, 2, 1);


DROP TABLE IF EXISTS `{..pref..}articles_cat`;
CREATE TABLE IF NOT EXISTS `{..pref..}articles_cat` (
  `cat_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(100) DEFAULT NULL,
  `cat_description` text NOT NULL,
  `cat_date` int(11) NOT NULL,
  `cat_user` mediumint(8) NOT NULL DEFAULT '1',
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;
INSERT INTO `{..pref..}articles_cat` (`cat_id`, `cat_name`, `cat_description`, `cat_date`, `cat_user`) VALUES
(1, 'Artikel', '', UNIX_TIMESTAMP(), 1);


DROP TABLE IF EXISTS `{..pref..}articles`;
CREATE TABLE IF NOT EXISTS `{..pref..}articles` (
  `article_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `article_url` varchar(100) DEFAULT NULL,
  `article_title` varchar(255) NOT NULL,
  `article_date` int(11) DEFAULT NULL,
  `article_user` mediumint(8) DEFAULT NULL,
  `article_text` text NOT NULL,
  `article_html` tinyint(1) NOT NULL DEFAULT '1',
  `article_fscode` tinyint(1) NOT NULL DEFAULT '1',
  `article_para` tinyint(1) NOT NULL DEFAULT '1',
  `article_cat_id` mediumint(8) NOT NULL,
  `article_search_update` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`article_id`),
  KEY `article_url` (`article_url`),
  FULLTEXT KEY `article_text` (`article_title`,`article_text`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
INSERT INTO `{..pref..}articles` (`article_url`, `article_title`, `article_date`, `article_user`, `article_text`, `article_html`, `article_fscode`, `article_para`, `article_cat_id`, `article_search_update`) VALUES
('fscode', 'FSCode Liste', UNIX_TIMESTAMP(), 1, 'Das System dieser Webseite bietet dir die Möglichkeit einfache Codes zur besseren Darstellung deiner Beiträge zu verwenden. Diese sogenannten [b]FSCodes[/b] erlauben dir daher HTML-Formatierungen zu verwenden, ohne dass du dich mit HTML auskennen musst. Mit ihnen hast du die Möglichkeit verschiedene Elemente in deine Beiträge einzubauen bzw. ihren Text zu formatieren.\r\n\r\nHier findest du eine [b]Übersicht über alle verfügbaren FSCodes[/b] und ihre Verwendung. Allerdings ist es möglich, dass nicht alle Codes zur Verwendung freigeschaltet sind.\r\n\r\n[html fscode]<table width="100%" cellpadding="0" cellspacing="10" border="0"><tr><td width="50%">[b][u][size=3]FS-Code:[/size][/u][/b]</td><td width="50%">[b][u][size=3]Beispiel:[/size][/u][/b]</td></tr><tr><td>[noparse][b]fetter Text[/b][/noparse]</td><td>[b]fetter Text[/b]</td></tr><tr><td>[noparse][i]kursiver Text[/i][/noparse]</td><td>[i]kursiver Text[/i]</td></tr><tr><td>[noparse][u]unterstrichener Text[u][/noparse]</td><td>[u]unterstrichener Text[/u]</td></tr><tr><td>[noparse][s]durchgestrichener Text[/s][/noparse]</td><td>[s]durchgestrichener Text[/s]</td></tr><tr><td>[noparse][center]zentrierter Text[/center][/noparse]</td><td>[center]zentrierter Text[/center]</td></tr><tr><td>[noparse][font=Schriftart]Text in Schriftart[/font][/noparse]</td><td>[font=Arial]Text in Arial[/font]</td></tr><tr><td>[noparse][color=Farbcode]Text in Farbe[/color][/noparse]</td><td>[color=#FF0000]Text in Rot (Farbcode: #FF0000)[/color]</td></tr><tr><td>[noparse][size=Größe]Text in Größe 0[/size][/noparse]</td><td>[size=0]Text in Größe 0[/size]</td></tr><tr><td>[noparse][size=Größe]Text in Größe 1[/size][/noparse]</td><td>[size=1]Text in Größe 1[/size]</td></tr><tr><td>[noparse][size=Größe]Text in Größe 2[/size][/noparse]</td><td>[size=2]Text in Größe 2[/size]</td></tr><tr><td>[noparse][size=Größe]Text in Größe 3[/size][/noparse]</td><td>[size=3]Text in Größe 3[/size]</td></tr><tr><td>[noparse][size=Größe]Text in Größe 4[/size][/noparse]</td><td>[size=4]Text in Größe 4[/size]</td></tr><tr><td>[noparse][size=Größe]Text in Größe 5[/size][/noparse]</td><td>[size=5]Text in Größe 5[/size]</td></tr><tr><td>[noparse][size=Größe]Text in Größe 6[/size][/noparse]</td><td>[size=6]Text in Größe 6[/size]</td></tr><tr><td>[noparse][size=Größe]Text in Größe 7[/size][/noparse]</td><td>[size=7]Text in Größe 7[/size]</td></tr><tr><td>[noparse][noparse]Text mit [b]FS[/b]Code[/noparse][/noparse]</td><td>[noparse]kein [b]fetter[/b] Text[/noparse]</td></tr> <tr><td colspan="2"><hr></td></tr> <tr><td>[noparse][url]Linkadresse[/url][/noparse]</td><td>[url]http://www.example.com[/url]</td></tr> <tr><td>[noparse][url=Linkadresse]Linktext[/url][/noparse]</td><td>[url=http://www.example.com]Linktext[/url]</td></tr> <tr><td>[noparse][home]Seitenlink[/home][/noparse]</td><td>[home]news[/home]</td></tr> <tr><td>[noparse][home=Seitenlink]Linktext[/home][/noparse]</td><td>[home=news]Linktext[/home]</td></tr> <tr><td>[noparse][email]Email-Adresse[/email][/noparse]</td><td>[email]max.mustermann@example.com[/email]</td></tr> <tr><td>[noparse][email=Email-Adresse]Beispieltext[/email][/noparse]</td><td>[email=max.mustermann@example.com]Beispieltext[/email]</td></tr> <tr><td colspan="2"><hr></td></tr> <tr><td>[noparse][list]<br>[*]Listenelement<br>[*]Listenelement<br>[/list][/noparse]</td><td>[list]<br>[*]Listenelement<br>[*]Listenelement<br>[/list]</td></tr> <tr><td>[noparse][numlist]<br>[*]Listenelement<br>[*]Listenelement<br>[/numlist][/noparse]</td><td>[numlist]<br>[*]Listenelement<br>[*]Listenelement<br>[/numlist]</td></tr> <tr><td>[noparse][quote]Ein Zitat[/quote][/noparse]</td><td>[quote]Ein Zitat[/quote]</td></tr><tr><td>[noparse][quote=Quelle]Ein Zitat[/quote][/noparse]</td><td>[quote=Quelle]Ein Zitat[/quote]</td></tr><tr><td>[noparse][code]Schrift mit fester Breite[/code][/noparse]</td><td>[code]Schrift mit fester Breite[/code]</td></tr><tr><td colspan="2"><hr></td></tr><tr><td>[noparse][img]Bildadresse[/img][/noparse]</td><td>[img]http://localhost/fs2/www/images/icons/logo.gif[/img]</td></tr><tr><td>[noparse][img=right]Bildadresse[/img][/noparse]</td><td>[img=right]http://localhost/fs2/www/images/icons/logo.gif[/img] Das hier ist ein Beispieltext. Die Grafik ist rechts platziert und der Text fließt links um sie herum.</td></tr><tr><td>[noparse][img=left]Bildadresse[/img][/noparse]</td><td>[img=left]http://localhost/fs2/www/images/icons/logo.gif[/img] Das hier ist ein Beispieltext. Die Grafik ist links platziert und der Text fließt rechts um sie herum.</td></tr></table>[/html]', 0, 1, 1, 1, 0);


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


DROP TABLE IF EXISTS `{..pref..}comments`;
CREATE TABLE IF NOT EXISTS `{..pref..}comments` (
  `comment_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `content_id` mediumint(8) NOT NULL,
  `content_type` varchar(32) NOT NULL,
  `comment_poster` varchar(32) DEFAULT NULL,
  `comment_poster_id` mediumint(8) DEFAULT NULL,
  `comment_poster_ip` varchar(16) NOT NULL,
  `comment_date` int(11) DEFAULT NULL,
  `comment_title` varchar(100) DEFAULT NULL,
  `comment_text` text,
  `comment_classification` tinyint(4) NOT NULL DEFAULT '0',
  `spam_probability` float NOT NULL DEFAULT '0.5',
  `needs_update` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`comment_id`),
  FULLTEXT KEY `comment_title_text` (`comment_text`,`comment_title`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `{..pref..}config`;
CREATE TABLE IF NOT EXISTS `{..pref..}config` (
  `config_name` varchar(30) NOT NULL,
  `config_data` text NOT NULL,
  `config_loadhook` varchar(255) NOT NULL DEFAULT 'none',
  UNIQUE KEY `config_name` (`config_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `{..pref..}counter`;
CREATE TABLE IF NOT EXISTS `{..pref..}counter` (
  `id` tinyint(1) NOT NULL,
  `visits` int(11) unsigned NOT NULL DEFAULT '0',
  `hits` int(11) unsigned NOT NULL DEFAULT '0',
  `user` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `artikel` smallint(6) unsigned NOT NULL DEFAULT '0',
  `news` smallint(6) unsigned NOT NULL DEFAULT '0',
  `comments` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `{..pref..}counter` (`id`, `visits`, `hits`, `user`, `artikel`, `news`, `comments`) VALUES
(1, 0, 0, 0, 1, 2, 0);


DROP TABLE IF EXISTS `{..pref..}counter_ref`;
CREATE TABLE IF NOT EXISTS `{..pref..}counter_ref` (
  `ref_url` varchar(255) DEFAULT NULL,
  `ref_count` int(11) DEFAULT NULL,
  `ref_first` int(11) DEFAULT NULL,
  `ref_last` int(11) DEFAULT NULL,
  KEY `ref_url` (`ref_url`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `{..pref..}counter_stat`;
CREATE TABLE IF NOT EXISTS `{..pref..}counter_stat` (
  `s_year` int(4) NOT NULL DEFAULT '0',
  `s_month` int(2) NOT NULL DEFAULT '0',
  `s_day` int(2) NOT NULL DEFAULT '0',
  `s_visits` int(11) DEFAULT NULL,
  `s_hits` int(11) DEFAULT NULL,
  PRIMARY KEY (`s_year`,`s_month`,`s_day`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `{..pref..}dl`;
CREATE TABLE IF NOT EXISTS `{..pref..}dl` (
  `dl_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `cat_id` mediumint(8) DEFAULT NULL,
  `user_id` mediumint(8) DEFAULT NULL,
  `dl_date` int(11) DEFAULT NULL,
  `dl_name` varchar(100) DEFAULT NULL,
  `dl_text` text,
  `dl_autor` varchar(100) DEFAULT NULL,
  `dl_autor_url` varchar(255) DEFAULT NULL,
  `dl_open` tinyint(4) DEFAULT NULL,
  `dl_search_update` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`dl_id`),
  FULLTEXT KEY `dl_name_text` (`dl_name`,`dl_text`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `{..pref..}dl_cat`;
CREATE TABLE IF NOT EXISTS `{..pref..}dl_cat` (
  `cat_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `subcat_id` mediumint(8) NOT NULL DEFAULT '0',
  `cat_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
INSERT INTO `{..pref..}dl_cat` (`subcat_id`, `cat_name`) VALUES
(0, 'Downloads');


DROP TABLE IF EXISTS `{..pref..}dl_files`;
CREATE TABLE IF NOT EXISTS `{..pref..}dl_files` (
  `dl_id` mediumint(8) DEFAULT NULL,
  `file_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `file_count` mediumint(8) NOT NULL DEFAULT '0',
  `file_name` varchar(100) DEFAULT NULL,
  `file_url` varchar(255) DEFAULT NULL,
  `file_size` mediumint(8) NOT NULL DEFAULT '0',
  `file_is_mirror` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`file_id`),
  KEY `dl_id` (`dl_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `{..pref..}editor_config`;
CREATE TABLE IF NOT EXISTS `{..pref..}editor_config` (
  `id` tinyint(1) NOT NULL DEFAULT '1',
  `smilies_rows` int(2) NOT NULL,
  `smilies_cols` int(2) NOT NULL,
  `textarea_width` int(3) NOT NULL,
  `textarea_height` int(3) NOT NULL,
  `bold` tinyint(1) NOT NULL DEFAULT '0',
  `italic` tinyint(1) NOT NULL DEFAULT '0',
  `underline` tinyint(1) NOT NULL DEFAULT '0',
  `strike` tinyint(1) NOT NULL DEFAULT '0',
  `center` tinyint(1) NOT NULL DEFAULT '0',
  `font` tinyint(1) NOT NULL DEFAULT '0',
  `color` tinyint(1) NOT NULL DEFAULT '0',
  `size` tinyint(1) NOT NULL DEFAULT '0',
  `list` tinyint(1) NOT NULL,
  `numlist` tinyint(1) NOT NULL,
  `img` tinyint(1) NOT NULL DEFAULT '0',
  `cimg` tinyint(1) NOT NULL DEFAULT '0',
  `url` tinyint(1) NOT NULL DEFAULT '0',
  `home` tinyint(1) NOT NULL DEFAULT '0',
  `email` tinyint(1) NOT NULL DEFAULT '0',
  `code` tinyint(1) NOT NULL DEFAULT '0',
  `quote` tinyint(1) NOT NULL DEFAULT '0',
  `noparse` tinyint(1) NOT NULL DEFAULT '0',
  `smilies` tinyint(1) NOT NULL DEFAULT '0',
  `do_bold` tinyint(1) NOT NULL,
  `do_italic` tinyint(1) NOT NULL,
  `do_underline` tinyint(1) NOT NULL,
  `do_strike` tinyint(1) NOT NULL,
  `do_center` tinyint(1) NOT NULL,
  `do_font` tinyint(1) NOT NULL,
  `do_color` tinyint(1) NOT NULL,
  `do_size` tinyint(1) NOT NULL,
  `do_list` tinyint(1) NOT NULL,
  `do_numlist` tinyint(1) NOT NULL,
  `do_img` tinyint(1) NOT NULL,
  `do_cimg` tinyint(1) NOT NULL,
  `do_url` tinyint(1) NOT NULL,
  `do_home` tinyint(1) NOT NULL,
  `do_email` tinyint(1) NOT NULL,
  `do_code` tinyint(1) NOT NULL,
  `do_quote` tinyint(1) NOT NULL,
  `do_noparse` tinyint(1) NOT NULL,
  `do_smilies` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `{..pref..}editor_config` (`id`, `smilies_rows`, `smilies_cols`, `textarea_width`, `textarea_height`, `bold`, `italic`, `underline`, `strike`, `center`, `font`, `color`, `size`, `list`, `numlist`, `img`, `cimg`, `url`, `home`, `email`, `code`, `quote`, `noparse`, `smilies`, `do_bold`, `do_italic`, `do_underline`, `do_strike`, `do_center`, `do_font`, `do_color`, `do_size`, `do_list`, `do_numlist`, `do_img`, `do_cimg`, `do_url`, `do_home`, `do_email`, `do_code`, `do_quote`, `do_noparse`, `do_smilies`) VALUES
(1, 5, 2, 355, 120, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 1, 0, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1);


DROP TABLE IF EXISTS `{..pref..}email`;
CREATE TABLE IF NOT EXISTS `{..pref..}email` (
  `id` tinyint(1) NOT NULL DEFAULT '1',
  `signup` text NOT NULL,
  `change_password` text NOT NULL,
  `delete_account` text NOT NULL,
  `change_password_ack` text NOT NULL,
  `use_admin_mail` tinyint(1) NOT NULL DEFAULT '1',
  `email` varchar(100) NOT NULL,
  `html` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `{..pref..}email` (`id`, `signup`, `change_password`, `delete_account`, `change_password_ack`, `use_admin_mail`, `email`, `html`) VALUES
(1, 'Hallo  {..user_name..},\r\n\r\nDu hast dich bei $VAR(page_title) registriert. Deine Zugangsdaten sind:\r\n\r\nBenutzername: {..user_name..}\r\nPasswort: {..new_password..}\r\n\r\nFalls du deine Daten ändern möchtest, kannst du das gerne auf deiner [url=$URL(user_edit[1])]Profilseite[/url] tun.\r\n\r\nDein Team von $VAR(page_title)!', 'Hallo {..user_name..},\r\n\r\nDein Passwort bei $VAR(page_title) wurde geändert. Deine neuen Zugangsdaten sind:\r\n\r\nBenutzername: {..user_name..}\r\nPasswort: {..new_password..}\r\n\r\nFalls du deine Daten ändern möchtest, kannst du das gerne auf deiner [url=$URL(user_edit[1])]Profilseite[/url] tun.\r\n\r\nDein Team von $VAR(page_title)!', 'Hallo {username},\r\n\r\nSchade, dass du dich von unserer Seite abgemeldet hast. Falls du es dir doch noch anders überlegen willst, [url={virtualhost}]kannst du ja nochmal rein schauen[/url].\r\n\r\nDein Webseiten-Team!', 'Hallo {..user_name..},\r\n\r\nDu hast für deinen Account auf $VAR(page_title) ein neues Passwort angefordert. Um den Vorgang abzuschließen musst du nur noch innerhalb der nächsten zwei Tage den folgenden Link anklicken: [url={..new_password_url..}]Neues Passwort setzen[/url]\r\n\r\nFalls du [b]kein[/b] neues Passwort angefordert hast, ignoriere diese E-Mail einfach. Du kannst dich weiterhin mit deinem bisherigen Passwort bei uns anmelden.\r\n\r\nDein Team von $VAR(page_title)!', 1, '', 0);


DROP TABLE IF EXISTS `{..pref..}ftp`;
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;


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


DROP TABLE IF EXISTS `{..pref..}news_cat`;
CREATE TABLE IF NOT EXISTS `{..pref..}news_cat` (
  `cat_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(100) DEFAULT NULL,
  `cat_description` text NOT NULL,
  `cat_date` int(11) NOT NULL,
  `cat_user` mediumint(8) NOT NULL DEFAULT '1',
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;
INSERT INTO `{..pref..}news_cat` (`cat_id`, `cat_name`, `cat_description`, `cat_date`, `cat_user`) VALUES
(1, 'News', '', UNIX_TIMESTAMP(), 1);


DROP TABLE IF EXISTS `{..pref..}news`;
CREATE TABLE IF NOT EXISTS `{..pref..}news` (
  `news_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `cat_id` smallint(6) DEFAULT NULL,
  `user_id` mediumint(8) DEFAULT NULL,
  `news_date` int(11) DEFAULT NULL,
  `news_title` varchar(255) DEFAULT NULL,
  `news_text` text,
  `news_active` tinyint(1) NOT NULL DEFAULT '1',
  `news_comments_allowed` tinyint(1) NOT NULL DEFAULT '1',
  `news_search_update` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`news_id`),
  FULLTEXT KEY `news_title_text` (`news_title`,`news_text`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
INSERT INTO `{..pref..}news` (`cat_id`, `user_id`, `news_date`, `news_title`, `news_text`, `news_active`, `news_comments_allowed`, `news_search_update`) VALUES
(1, 1, UNIX_TIMESTAMP(), 'Frogsystem 2.alix6 - Installation erfolgreich', 'Herzlich Willkommen in deinem frisch installierten Frogsystem 2!\r\nDas Frogsystem 2-Team wünscht viel Spaß und Erfolg mit der Seite.\r\n\r\nWeitere Informationen und Hilfe bei Problemen gibt es auf der offiziellen Homepage des Frogsystem 2, in den zugehörigen Supportforen und dem Dokumentations-Wiki. Die wichtigsten Links haben wir unten zusammengefasst. Einfach mal vorbei schauen!\r\n\r\nDein Frogsystem 2-Team', 1, 1, 0);


DROP TABLE IF EXISTS `{..pref..}news_links`;
CREATE TABLE IF NOT EXISTS `{..pref..}news_links` (
  `news_id` mediumint(8) DEFAULT NULL,
  `link_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `link_name` varchar(100) DEFAULT NULL,
  `link_url` varchar(255) DEFAULT NULL,
  `link_target` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`link_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
INSERT INTO `{..pref..}news_links` (`news_id`, `link_name`, `link_url`, `link_target`) VALUES
(1, 'Offizielle Frogsystem 2 Homepage', 'http://www.frogsystem.de', 1),
(1, 'Frogsystem 2 Supportforum', 'http://forum.sweil.de/viewforum.php?f=7', 1),
(1, 'Frogsystem 2 Dokumentations-Wiki', 'http://wiki.frogsystem.de/', 1);


DROP TABLE IF EXISTS `{..pref..}partner`;
CREATE TABLE IF NOT EXISTS `{..pref..}partner` (
  `partner_id` smallint(3) unsigned NOT NULL AUTO_INCREMENT,
  `partner_name` varchar(150) NOT NULL,
  `partner_link` varchar(250) NOT NULL,
  `partner_beschreibung` text NOT NULL,
  `partner_permanent` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`partner_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `{..pref..}player`;
CREATE TABLE IF NOT EXISTS `{..pref..}player` (
  `video_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `video_type` tinyint(1) NOT NULL DEFAULT '1',
  `video_x` text NOT NULL,
  `video_title` varchar(100) NOT NULL,
  `video_lenght` smallint(6) NOT NULL DEFAULT '0',
  `video_desc` text NOT NULL,
  `dl_id` mediumint(8) NOT NULL,
  PRIMARY KEY (`video_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `{..pref..}poll`;
CREATE TABLE IF NOT EXISTS `{..pref..}poll` (
  `poll_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `poll_quest` varchar(255) DEFAULT NULL,
  `poll_start` int(11) DEFAULT NULL,
  `poll_end` int(11) DEFAULT NULL,
  `poll_type` tinyint(4) DEFAULT NULL,
  `poll_participants` mediumint(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`poll_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `{..pref..}poll_answers`;
CREATE TABLE IF NOT EXISTS `{..pref..}poll_answers` (
  `poll_id` mediumint(8) DEFAULT NULL,
  `answer_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `answer` varchar(255) DEFAULT NULL,
  `answer_count` mediumint(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`answer_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `{..pref..}poll_voters`;
CREATE TABLE IF NOT EXISTS `{..pref..}poll_voters` (
  `voter_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `poll_id` mediumint(8) NOT NULL DEFAULT '0',
  `ip_address` varchar(15) NOT NULL DEFAULT '0.0.0.0',
  `time` int(32) NOT NULL DEFAULT '0',
  PRIMARY KEY (`voter_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `{..pref..}press`;
CREATE TABLE IF NOT EXISTS `{..pref..}press` (
  `press_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `press_title` varchar(255) NOT NULL,
  `press_url` varchar(255) NOT NULL,
  `press_date` int(12) NOT NULL,
  `press_intro` text NOT NULL,
  `press_text` text NOT NULL,
  `press_note` text NOT NULL,
  `press_lang` int(11) NOT NULL,
  `press_game` tinyint(2) NOT NULL,
  `press_cat` tinyint(2) NOT NULL,
  PRIMARY KEY (`press_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `{..pref..}press_admin`;
CREATE TABLE IF NOT EXISTS `{..pref..}press_admin` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`,`type`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
INSERT INTO `{..pref..}press_admin` (`type`, `title`) VALUES
(1, 'Beispiel-Spiel'),
(2, 'Preview'),
(2, 'Review'),
(2, 'Interview'),
(3, 'Deutsch'),
(3, 'Englisch');


DROP TABLE IF EXISTS `{..pref..}screen`;
CREATE TABLE IF NOT EXISTS `{..pref..}screen` (
  `screen_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `cat_id` smallint(6) unsigned DEFAULT NULL,
  `screen_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`screen_id`),
  KEY `cat_id` (`cat_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `{..pref..}screen_cat`;
CREATE TABLE IF NOT EXISTS `{..pref..}screen_cat` (
  `cat_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(255) DEFAULT NULL,
  `cat_type` tinyint(1) NOT NULL DEFAULT '0',
  `cat_visibility` tinyint(1) NOT NULL DEFAULT '1',
  `cat_date` int(11) NOT NULL DEFAULT '0',
  `randompic` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
INSERT INTO `{..pref..}screen_cat` (`cat_name`, `cat_type`, `cat_visibility`, `cat_date`, `randompic`) VALUES
('Screenshots', 1, 1, UNIX_TIMESTAMP(), 1),
('Wallpaper', 2, 1, UNIX_TIMESTAMP(), 0);


DROP TABLE IF EXISTS `{..pref..}screen_random`;
CREATE TABLE IF NOT EXISTS `{..pref..}screen_random` (
  `random_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `screen_id` mediumint(8) NOT NULL,
  `start` int(11) NOT NULL,
  `end` int(11) NOT NULL,
  PRIMARY KEY (`random_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `{..pref..}search_index`;
CREATE TABLE IF NOT EXISTS `{..pref..}search_index` (
  `search_index_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `search_index_word_id` mediumint(8) NOT NULL DEFAULT '0',
  `search_index_type` enum('news','articles','dl') NOT NULL DEFAULT 'news',
  `search_index_document_id` mediumint(8) NOT NULL DEFAULT '0',
  `search_index_count` smallint(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`search_index_id`),
  UNIQUE KEY `un_search_index_word_id` (`search_index_word_id`,`search_index_type`,`search_index_document_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `{..pref..}search_time`;
CREATE TABLE IF NOT EXISTS `{..pref..}search_time` (
  `search_time_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `search_time_type` enum('news','articles','dl') NOT NULL DEFAULT 'news',
  `search_time_document_id` mediumint(8) NOT NULL,
  `search_time_date` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`search_time_id`),
  UNIQUE KEY `un_search_time_type` (`search_time_type`,`search_time_document_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `{..pref..}search_words`;
CREATE TABLE IF NOT EXISTS `{..pref..}search_words` (
  `search_word_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `search_word` varchar(32) NOT NULL DEFAULT '',
  PRIMARY KEY (`search_word_id`),
  UNIQUE KEY `search_word` (`search_word`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `{..pref..}shop`;
CREATE TABLE IF NOT EXISTS `{..pref..}shop` (
  `artikel_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `artikel_name` varchar(100) DEFAULT NULL,
  `artikel_url` varchar(255) DEFAULT NULL,
  `artikel_text` text,
  `artikel_preis` varchar(10) DEFAULT NULL,
  `artikel_hot` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`artikel_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `{..pref..}smilies`;
CREATE TABLE IF NOT EXISTS `{..pref..}smilies` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `replace_string` varchar(15) NOT NULL,
  `order` mediumint(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
INSERT INTO `{..pref..}smilies` (`replace_string`, `order`) VALUES
(':-)', 1),
(':-(', 2),
(';-)', 3),
(':-P', 4),
('xD', 5),
(':-o', 6),
('^_^', 7),
(':-/', 8),
(':-]', 9),
('&gt;-(', 10);


DROP TABLE IF EXISTS `{..pref..}snippets`;
CREATE TABLE IF NOT EXISTS `{..pref..}snippets` (
  `snippet_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `snippet_tag` varchar(100) NOT NULL,
  `snippet_text` text NOT NULL,
  `snippet_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`snippet_id`),
  UNIQUE KEY `snippet_tag` (`snippet_tag`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
INSERT INTO `{..pref..}snippets` (`snippet_tag`, `snippet_text`, `snippet_active`) VALUES
('[%feeds%]', '<p>\r\n  <b>News-Feeds:</b>\r\n</p>\r\n<p align="center">\r\n  <a href="$VAR(url)feeds/rss091.php" target="_self"><img src="$VAR(style_icons)feeds/rss091.gif" alt="RSS 0.91" title="RSS 0.91" border="0"></a><br>\r\n  <a href="$VAR(url)feeds/rss10.php" target="_self"><img src="$VAR(style_icons)feeds/rss10.gif" alt="RSS 1.0" title="RSS 1.0" border="0"></a><br>\r\n  <a href="$VAR(url)feeds/rss20.php" target="_self"><img src="$VAR(style_icons)feeds/rss20.gif" alt="RSS 2.0" title="RSS 2.0" border="0"></a><br>\r\n  <a href="$VAR(url)feeds/atom10.php" target="_self"><img src="$VAR(style_icons)feeds/atom10.gif" alt="Atom 1.0" title="Atom 1.0" border="0"></a>\r\n</p>', 1);


DROP TABLE IF EXISTS `{..pref..}styles`;
CREATE TABLE IF NOT EXISTS `{..pref..}styles` (
  `style_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `style_tag` varchar(30) NOT NULL,
  `style_allow_use` tinyint(1) NOT NULL DEFAULT '1',
  `style_allow_edit` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`style_id`),
  UNIQUE KEY `style_tag` (`style_tag`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3;
INSERT INTO `{..pref..}styles` (`style_id`, `style_tag`, `style_allow_use`, `style_allow_edit`) VALUES
(1, 'default', 0, 0),
(2, 'lightfrog', 1, 1);

DROP TABLE IF EXISTS `{..pref..}user`;
CREATE TABLE IF NOT EXISTS `{..pref..}user` (
  `user_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `user_name` char(100) DEFAULT NULL,
  `user_password` char(32) DEFAULT NULL,
  `user_salt` varchar(10) NOT NULL,
  `user_mail` char(100) DEFAULT NULL,
  `user_is_staff` tinyint(1) NOT NULL DEFAULT '0',
  `user_group` mediumint(8) NOT NULL DEFAULT '0',
  `user_is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `user_reg_date` int(11) DEFAULT NULL,
  `user_show_mail` tinyint(4) NOT NULL DEFAULT '0',
  `user_homepage` varchar(100) DEFAULT NULL,
  `user_icq` varchar(50) DEFAULT NULL,
  `user_aim` varchar(50) DEFAULT NULL,
  `user_wlm` varchar(50) DEFAULT NULL,
  `user_yim` varchar(50) DEFAULT NULL,
  `user_skype` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `{..pref..}useronline`;
CREATE TABLE IF NOT EXISTS `{..pref..}useronline` (
  `ip` varchar(30) NOT NULL,
  `user_id` mediumint(8) NOT NULL DEFAULT '0',
  `date` int(30) DEFAULT NULL,
  PRIMARY KEY (`ip`)
) ENGINE=MEMORY DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `{..pref..}user_groups`;
CREATE TABLE IF NOT EXISTS `{..pref..}user_groups` (
  `user_group_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `user_group_name` varchar(50) NOT NULL,
  `user_group_description` text,
  `user_group_title` varchar(50) DEFAULT NULL,
  `user_group_color` varchar(6) NOT NULL DEFAULT '-1',
  `user_group_highlight` tinyint(1) NOT NULL DEFAULT '0',
  `user_group_date` int(11) NOT NULL,
  `user_group_user` mediumint(8) NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;
INSERT INTO `{..pref..}user_groups` (`user_group_id`, `user_group_name`, `user_group_description`, `user_group_title`, `user_group_color`, `user_group_highlight`, `user_group_date`, `user_group_user`) VALUES
(1, 'Administrator', '', 'Administrator', '008800', 1, UNIX_TIMESTAMP(), 1);


DROP TABLE IF EXISTS `{..pref..}user_permissions`;
CREATE TABLE IF NOT EXISTS `{..pref..}user_permissions` (
  `perm_id` varchar(255) NOT NULL,
  `x_id` mediumint(8) NOT NULL,
  `perm_for_group` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`perm_id`,`x_id`,`perm_for_group`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `{..pref..}wallpaper`;
CREATE TABLE IF NOT EXISTS `{..pref..}wallpaper` (
  `wallpaper_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `wallpaper_name` varchar(255) NOT NULL,
  `wallpaper_title` varchar(255) NOT NULL,
  `cat_id` mediumint(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`wallpaper_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `{..pref..}wallpaper_sizes`;
CREATE TABLE IF NOT EXISTS `{..pref..}wallpaper_sizes` (
  `size_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `wallpaper_id` mediumint(8) NOT NULL DEFAULT '0',
  `size` varchar(255) NOT NULL,
  PRIMARY KEY (`size_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
