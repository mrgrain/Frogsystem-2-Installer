SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT;
SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS;
SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION;
SET NAMES utf8;


DROP TABLE IF EXISTS `{..pref..}admin_cp`;
CREATE TABLE IF NOT EXISTS `{..pref..}admin_cp` (
  `page_id` varchar(255) NOT NULL,
  `group_id` varchar(20) NOT NULL,
  `page_file` varchar(255) NOT NULL,
  `page_pos` tinyint(3) NOT NULL DEFAULT '0',
  `page_int_sub_perm` tinyint(1) NOT NULL DEFAULT '0'
) DEFAULT CHARSET=utf8;
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
('table_admin', 'db', 'admin_table_admin.php', 1, 0),
('tpl_styleselect', 'templates', 'admin_template_styleselect.php', 26, 0),
('social_meta_tags', 'socialmedia', 'admin_social_meta_tags.php', 1, 0);


DROP TABLE IF EXISTS `{..pref..}admin_groups`;
CREATE TABLE IF NOT EXISTS `{..pref..}admin_groups` (
  `group_id` varchar(20) NOT NULL,
  `menu_id` varchar(20) NOT NULL,
  `group_pos` tinyint(3) NOT NULL DEFAULT '0'
) DEFAULT CHARSET=utf8;
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
('popup', 'none', 0),
('socialmedia', 'promo', 3);


DROP TABLE IF EXISTS `{..pref..}admin_inherited`;
CREATE TABLE IF NOT EXISTS `{..pref..}admin_inherited` (
  `group_id` varchar(255) NOT NULL,
  `pass_to` varchar(255) NOT NULL
) DEFAULT CHARSET=utf8;
INSERT INTO `{..pref..}admin_inherited` (`group_id`, `pass_to`) VALUES
('applets', 'find_applet'),
('news', 'find_user'),
('articles', 'find_user'),
('news', 'news_preview'),
('articles', 'article_preview'),
('stats', 'statgfx');


DROP TABLE IF EXISTS `{..pref..}aliases`;
CREATE TABLE IF NOT EXISTS `{..pref..}aliases` (
  `alias_id` mediumint(8) NOT NULL,
  `alias_go` varchar(100) NOT NULL,
  `alias_forward_to` varchar(100) NOT NULL,
  `alias_active` tinyint(1) NOT NULL DEFAULT '1'
) DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `{..pref..}announcement`;
CREATE TABLE IF NOT EXISTS `{..pref..}announcement` (
  `id` smallint(4) NOT NULL,
  `announcement_text` text,
  `show_announcement` tinyint(1) NOT NULL DEFAULT '0',
  `activate_announcement` tinyint(1) NOT NULL DEFAULT '0',
  `ann_html` tinyint(1) NOT NULL DEFAULT '1',
  `ann_fscode` tinyint(1) NOT NULL DEFAULT '1',
  `ann_para` tinyint(1) NOT NULL DEFAULT '1'
) DEFAULT CHARSET=utf8;
INSERT INTO `{..pref..}announcement` (`id`, `announcement_text`, `show_announcement`, `activate_announcement`, `ann_html`, `ann_fscode`, `ann_para`) VALUES
(1, '', 2, 0, 1, 1, 1);


DROP TABLE IF EXISTS `{..pref..}applets`;
CREATE TABLE IF NOT EXISTS `{..pref..}applets` (
  `applet_id` mediumint(8) NOT NULL,
  `applet_file` varchar(100) NOT NULL,
  `applet_active` tinyint(1) NOT NULL DEFAULT '1',
  `applet_include` tinyint(1) NOT NULL DEFAULT '1',
  `applet_output` tinyint(1) NOT NULL DEFAULT '1'
) DEFAULT CHARSET=utf8;
INSERT INTO `{..pref..}applets` (`applet_id`, `applet_file`, `applet_active`, `applet_include`, `applet_output`) VALUES
( 1, 'affiliates', 1, 2, 1),
( 2, 'user-menu', 1, 2, 1),
( 3, 'announcement', 1, 2, 1),
( 4, 'mini-statistics', 1, 2, 1),
( 5, 'poll-system', 1, 2, 1),
( 6, 'preview-image', 1, 2, 1),
( 7, 'shop-system', 1, 2, 1),
( 8, 'dl-forwarding', 1, 1, 0),
( 9, 'mini-search', 1, 1, 1),
(10, 'topdownloads', 1, 2, 1),
(11, 'social-meta-tags', 1, 2, 1);


DROP TABLE IF EXISTS `{..pref..}articles_cat`;
CREATE TABLE IF NOT EXISTS `{..pref..}articles_cat` (
  `cat_id` smallint(6) NOT NULL,
  `cat_name` varchar(100) DEFAULT NULL,
  `cat_description` text NOT NULL,
  `cat_date` int(11) NOT NULL,
  `cat_user` mediumint(8) NOT NULL DEFAULT '1'
) DEFAULT CHARSET=utf8;
INSERT INTO `{..pref..}articles_cat` (`cat_id`, `cat_name`, `cat_description`, `cat_date`, `cat_user`) VALUES
(1, 'Artikel', '', UNIX_TIMESTAMP(), 1);


DROP TABLE IF EXISTS `{..pref..}articles`;
CREATE TABLE IF NOT EXISTS `{..pref..}articles` (
  `article_id` mediumint(8) NOT NULL,
  `article_url` varchar(100) DEFAULT NULL,
  `article_title` varchar(255) NOT NULL,
  `article_date` int(11) DEFAULT NULL,
  `article_user` mediumint(8) DEFAULT NULL,
  `article_text` text NOT NULL,
  `article_html` tinyint(1) NOT NULL DEFAULT '1',
  `article_fscode` tinyint(1) NOT NULL DEFAULT '1',
  `article_para` tinyint(1) NOT NULL DEFAULT '1',
  `article_cat_id` mediumint(8) NOT NULL,
  `article_search_update` int(11) NOT NULL DEFAULT '0'
) DEFAULT CHARSET=utf8;
INSERT INTO `{..pref..}articles` (`article_id`, `article_url`, `article_title`, `article_date`, `article_user`, `article_text`, `article_html`, `article_fscode`, `article_para`, `article_cat_id`, `article_search_update`) VALUES
(1, 'fscode', 'FSCode Liste', NULL, NULL, 'Das System dieser Webseite bietet dir die Möglichkeit einfache Codes zur besseren Darstellung deiner Beiträge zu verwenden. Diese sogenannten [b]FSCodes[/b] erlauben dir daher HTML-Formatierungen zu verwenden, ohne dass du dich mit HTML auskennen musst. Mit ihnen hast du die Möglichkeit verschiedene Elemente in deine Beiträge einzubauen bzw. ihren Text zu formatieren.\n\nHier findest du eine [b]Übersicht über alle verfügbaren FSCodes[/b] und ihre Verwendung. Allerdings ist es möglich, dass nicht alle Codes zur Verwendung freigeschaltet sind.\n\n[html fscode]\n<table width="100%" cellpadding="0" cellspacing="10" border="0"><tr><td width="50%">\n[b][u][size=3]FS-Code:[/size][/u][/b]\n</td><td width="50%">\n[b][u][size=3]Beispiel:[/size][/u][/b]\n</td></tr><tr><td>\n[nofscode][b]fetter Text[/b][/nofscode]\n</td><td>\n[b]fetter Text[/b]\n</td></tr><tr><td>\n[nofscode][i]kursiver Text[/i][/nofscode]\n</td><td>\n[i]kursiver Text[/i]\n</td></tr><tr><td>\n[nofscode][u]unterstrichener Text[u][/nofscode]\n</td><td>\n[u]unterstrichener Text[/u]\n</td></tr><tr><td>\n[nofscode][s]durchgestrichener Text[/s][/nofscode]\n</td><td>\n[s]durchgestrichener Text[/s]\n</td></tr><tr><td>\n[nofscode][center]zentrierter Text[/center][/nofscode]\n</td><td>\n[center]zentrierter Text[/center]\n</td></tr><tr><td>\n[nofscode][font=Schriftart]Text in Schriftart[/font][/nofscode]\n</td><td>\n[font=Arial]Text in Arial[/font]</td></tr><tr><td>\n[nofscode][color=Farbcode]Text in Farbe[/color][/nofscode]\n</td><td>\n[color=#FF0000]Text in Rot (Farbcode: #FF0000)[/color]\n</td></tr><tr><td>\n[nofscode][size=Größe]Text in Größe 0[/size][/nofscode]\n</td><td>\n[size=0]Text in Größe 0[/size]\n</td></tr><tr><td>\n[nofscode][size=Größe]Text in Größe 1[/size][/nofscode]\n</td><td>\n[size=1]Text in Größe 1[/size]\n</td></tr><tr><td>\n[nofscode][size=Größe]Text in Größe 2[/size][/nofscode]\n</td><td>\n[size=2]Text in Größe 2[/size]\n</td></tr><tr><td>\n[nofscode][size=Größe]Text in Größe 3[/size][/nofscode]\n</td><td>\n[size=3]Text in Größe 3[/size]\n</td></tr><tr><td>\n[nofscode][size=Größe]Text in Größe 4[/size][/nofscode]\n</td><td>\n[size=4]Text in Größe 4[/size]\n</td></tr><tr><td>\n[nofscode][size=Größe]Text in Größe 5[/size][/nofscode]\n</td><td>\n[size=5]Text in Größe 5[/size]\n</td></tr><tr><td>\n[nofscode][size=Größe]Text in Größe 6[/size][/nofscode]\n</td><td>\n[size=6]Text in Größe 6[/size]\n</td></tr><tr><td>\n[nofscode][size=Größe]Text in Größe 7[/size][/nofscode]\n</td><td>\n[size=7]Text in Größe 7[/size]\n</td></tr><tr><td>\n[nofscode][nofscode]Text mit [b]FS[/b]Code[/nofscode][/nofscode]\n</td><td>\n[nofscode]kein [b]fetter[/b] Text[/nofscode]\n</td></tr><tr><td colspan="2"><hr></td></tr><tr><td>\n[nofscode][url]Linkadresse[/url][/nofscode]\n</td><td>\n[url]http://www.example.com[/url]\n</td></tr><tr><td>\n[nofscode][url=Linkadresse]Linktext[/url][/nofscode]\n</td><td>\n[url=http://www.example.com]Linktext[/url]\n</td></tr><tr><td>\n[nofscode][home]Seitenlink[/home][/nofscode]\n</td><td>\n[home]news[/home]\n</td></tr> <tr><td>\n[nofscode][home=Seitenlink]Linktext[/home][/nofscode]\n</td><td>\n[home=news]Linktext[/home]\n</td></tr><tr><td>\n[nofscode][email]Email-Adresse[/email][/nofscode]</td><td>\n[email]max.mustermann@example.com[/email]\n</td></tr> <tr><td>\n[nofscode][email=Email-Adresse]Beispieltext[/email][/nofscode]\n</td><td>\n[email=max.mustermann@example.com]Beispieltext[/email]\n</td></tr> <tr><td colspan="2"><hr></td></tr><tr><td>\n[nofscode][list]\n[*]Listenelement\n[*]Listenelement\n[/list][/nofscode]</td><td>[list]\n[*]Listenelement\n[*]Listenelement\n[/list]\n</td></tr> <tr><td>\n[nofscode][numlist]\n[*]Listenelement\n[*]Listenelement\n[/numlist][/nofscode]\n</td><td>\n[numlist]\n[*]Listenelement\n[*]Listenelement\n[/numlist]\n</td></tr> <tr><td>\n[nofscode][quote]Ein Zitat[/quote][/nofscode]\n</td><td>\n[quote]Ein Zitat[/quote]\n</td></tr><tr><td>\n[nofscode][quote=Quelle]Ein Zitat[/quote][/nofscode]\n</td><td>\n[quote=Quelle]Ein Zitat[/quote]\n</td></tr><tr><td>\n[nofscode][code]Schrift mit fester Breite[/code][/nofscode]\n</td><td>\n[code]Schrift mit fester Breite[/code]\n</td></tr><tr><td colspan="2"><hr></td></tr><tr><td>\n[nofscode][img]Bildadresse[/img][/nofscode]\n</td><td>\n[img]http://placehold.it/150x100[/img]\n</td></tr><tr><td>\n[nofscode][img=right]Bildadresse[/img][/nofscode]\n</td><td>\n[img=right]http://placehold.it/150x100[/img] Das hier ist ein Beispieltext. Die Grafik ist rechts platziert und der Text fließt links um sie herum.\n</td></tr><tr><td>\n[nofscode][img=left]Bildadresse[/img][/nofscode]\n</td><td>\n[img=left]http://placehold.it/150x100[/img] Das hier ist ein Beispieltext. Die Grafik ist links platziert und der Text fließt rechts um sie herum.\n</td></tr></table>\n[/html]', 0, 1, 1, 1, 0),
(2, 'search_help', 'Suchregeln', NULL, NULL, 'Mit der Suchfunktion können die verschiedenen Inhalte dieser Webseite schnell und einfach gefunden werden. Suchbegriffe können beliebig angeben werden, es sollten aber die folgenden Regeln bedacht werden:\n[list]\n[*][b]Ein Suchbegriff muss aus mindestens 3 Zeichen bestehen[/b]\n[*][b]Nach bestimmten, häufig vorkommenden Füllwörtern kann nicht gesucht werden:[/b] \nz.B. "und", "oder", "hallo", etc.\n[*][b]Zahlen & Sonderzeichen werden durch Leerzeichen ersetzt[/b]\n[*][b]Umlaute werden umgewandelt:[/b] ä => ae, ö=>oe, ü => ue\n[/list]\n\n[i]Beispiele:[/i]\n[font=monospace]Ei[/font] => Findet nichts, da der Suchbegriff zu kurz ist\n[font=monospace]und oder oder[/font] => Findet nichts, da nur nach Füllwörtern gesucht wurde\n[font=monospace]Guten8geschichte[/font] => Sucht nach "guten" und "geschichte"\n[font=monospace]mäuse[/font] => Findet Inhalte mit "Mäuse", "mäuse" oder "Maeuse"\n\nDamit die Suchergebnisse immer nachvollziehbar bleiben, wird bei jeder Suche auch die berechnete Suchanfrage mit ausgegeben. So kann die eigene Anfrage leicht überprüft und evtl. korrigiert werden.\n\n\n[b][size=3]Suchfunktionen[/size][/b]\n\nLiefert die Suche nach einfachen Stichwörtern nicht das gewünschte Ergebnis, kann die Suchanfrage verfeinert werden. Dazu stehen einige Operatoren und Funktionen zur Verfügung.\n\n\n[b]Alle Suchbegriffe müssen enthalten sein: AND[/b]\nDie Verknüpfung mit AND ist der Standardoperator. Sie wird auch immer dann angewandt, wenn keine andere Verknüpfung angegeben wurde. Mit der AND-Verknüpfung werden nur Inhalte gefunden, die alle Suchbegriffe enthalten.\n\n[i]Beispiele:[/i]\n[font=monospace]frosch internet[/font] => Findet nur Inhalte mit "frosch" UND "internet"\n[font=monospace]hund AND katze[/font] => Findet nur Inhalte mit "hund" UND "katze"\n\n\n[b]Nur ein Suchbegriffe muss enthalten sein: OR[/b]\nEs kann aber auch nach Inhalten gesucht werden, die möglicherweise nur einen der Suchbegriffe enthalten. Hierzu wird der OR-Operator verwendet.\n\n[i]Beispiele:[/i]\n[font=monospace]papagei OR rabe[/font] => Findet Inhalte mit "papagei" ODER "rabe"\n\n\n[b]Entweder-oder-Suche: XOR[/b]\nEine Verknüpfung mit dem XOR-Operator entspricht im Grundsatz der Suche mir OR. Der Unterschied besteht darin, dass aber nur solche Inhalte gefunden werden die nur einen der beiden Suchbegriffe enthalten, nicht aber beide zusammen.\n\n[i]Beispiele:[/i]\n[font=monospace]frau XOR mann[/font] => Findet Inhalte mit "frau" aber NICHT "mann" und umgekehrt\n\n\n[b]Suche nach Teilwörtern: *[/b]\nWenn nach bestimmten Teilwörtern gesucht wird, kann das Sternchen als Platzhalter verwendet werden. Vorangestellt werden Wörter gefunden, die auf den Suchbegriff enden; an letzter Stelle stehend findet die Suche nur Wörter die damit beginnen. Das Sternchen kann aber auch gleichzeitig vorne und hinten verwendet werden.\n\n[i]Beispiele:[/i]\n[font=monospace]*haus[/font] => Findet "Haus", "Wohnhaus", "Waisenhaus", aber NICHT "Hausboot"\n[font=monospace]tür*[/font] => Findet "Türschloss", "türmen", aber NICHT "Hintertür"\n[font=monospace]*wunder*[/font] => Findet "Wunderheiler", "Wirtschaftswunder" und "Verwunderung"\n\n\n[b]Suchbegriffe ausschließen: ![/b]\nUm bestimmte Begriffe aus den Suchergebnissen auszuschließen, kann ihnen ein Ausrufezeichen vorangestellt werden. So können Inhalte gefunden werden, die bestimmte Begriff nicht enthalten. Die anderen Suchregeln gelten weiterhin, insbesondere können Verknüpfungen verwendet werden.\n\n[i]Beispiele:[/i]\n[font=monospace]kind !junge[/font] => Findet Inhalte mit "kind" aber OHNE "junge"\n[font=monospace]maus katze !hund[/font] => Findet Inhalte mit "maus" UND "katze", aber OHNE "hund"\n[font=monospace]frosch OR !storch[/font] => Findet Inhalte die "frosch" ODER NICHT "Storch" enthalten\n\n\n[b]Phonetische Suche[/b]\nOft ist die genaue Schreibweise eines Wortes nicht bekannt. Dann kann die Phonetische Suche weiterhelfen. Mit dieser Option werden auch ähnlich klingende Begriffe zu einem Suchwort gefunden.\n\n[i]Beispiele:[/i]\n[font=monospace]team[/font] => Findet Inhalte mit "Team", "Tim", "Teen", etc.', 0, 1, 1, 1, 0);


DROP TABLE IF EXISTS `{..pref..}b8_wordlist`;
CREATE TABLE IF NOT EXISTS `{..pref..}b8_wordlist` (
  `token` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `count_ham` int(10) unsigned DEFAULT NULL,
  `count_spam` int(10) unsigned DEFAULT NULL
) DEFAULT CHARSET=utf8;
INSERT INTO `{..pref..}b8_wordlist` (`token`, `count_ham`, `count_spam`) VALUES
('b8*dbversion', 3, NULL),
('b8*texts', 0, 0);


DROP TABLE IF EXISTS `{..pref..}cimg`;
CREATE TABLE IF NOT EXISTS `{..pref..}cimg` (
  `id` mediumint(8) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(4) NOT NULL,
  `hasthumb` tinyint(1) NOT NULL,
  `cat` mediumint(8) NOT NULL
) DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `{..pref..}cimg_cats`;
CREATE TABLE IF NOT EXISTS `{..pref..}cimg_cats` (
  `id` mediumint(8) NOT NULL,
  `name` varchar(25) NOT NULL,
  `description` varchar(100) NOT NULL
) DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `{..pref..}comments`;
CREATE TABLE IF NOT EXISTS `{..pref..}comments` (
  `comment_id` mediumint(8) NOT NULL,
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
  `needs_update` tinyint(4) NOT NULL DEFAULT '1'
) DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `{..pref..}config`;
CREATE TABLE IF NOT EXISTS `{..pref..}config` (
  `config_name` varchar(30) NOT NULL,
  `config_data` text NOT NULL,
  `config_loadhook` varchar(255) NOT NULL DEFAULT 'none'
) DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `{..pref..}counter`;
CREATE TABLE IF NOT EXISTS `{..pref..}counter` (
  `id` tinyint(1) NOT NULL,
  `visits` int(11) unsigned NOT NULL DEFAULT '0',
  `hits` int(11) unsigned NOT NULL DEFAULT '0',
  `user` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `artikel` smallint(6) unsigned NOT NULL DEFAULT '0',
  `news` smallint(6) unsigned NOT NULL DEFAULT '0',
  `comments` mediumint(8) unsigned NOT NULL DEFAULT '0'
) DEFAULT CHARSET=utf8;
INSERT INTO `{..pref..}counter` (`id`, `visits`, `hits`, `user`, `artikel`, `news`, `comments`) VALUES
(1, 0, 0, 0, 1, 2, 0);


DROP TABLE IF EXISTS `{..pref..}counter_ref`;
CREATE TABLE IF NOT EXISTS `{..pref..}counter_ref` (
  `ref_url` varchar(255) DEFAULT NULL,
  `ref_count` int(11) DEFAULT NULL,
  `ref_first` int(11) DEFAULT NULL,
  `ref_last` int(11) DEFAULT NULL
) DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `{..pref..}counter_stat`;
CREATE TABLE IF NOT EXISTS `{..pref..}counter_stat` (
  `s_year` int(4) NOT NULL DEFAULT '0',
  `s_month` int(2) NOT NULL DEFAULT '0',
  `s_day` int(2) NOT NULL DEFAULT '0',
  `s_visits` int(11) DEFAULT NULL,
  `s_hits` int(11) DEFAULT NULL
) DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `{..pref..}dl`;
CREATE TABLE IF NOT EXISTS `{..pref..}dl` (
  `dl_id` mediumint(8) NOT NULL,
  `cat_id` mediumint(8) DEFAULT NULL,
  `user_id` mediumint(8) DEFAULT NULL,
  `dl_date` int(11) DEFAULT NULL,
  `dl_name` varchar(100) DEFAULT NULL,
  `dl_text` text,
  `dl_autor` varchar(100) DEFAULT NULL,
  `dl_autor_url` varchar(255) DEFAULT NULL,
  `dl_open` tinyint(4) DEFAULT NULL,
  `dl_search_update` int(11) NOT NULL DEFAULT '0'
) DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `{..pref..}dl_cat`;
CREATE TABLE IF NOT EXISTS `{..pref..}dl_cat` (
  `cat_id` mediumint(8) NOT NULL,
  `subcat_id` mediumint(8) NOT NULL DEFAULT '0',
  `cat_name` varchar(100) DEFAULT NULL
) DEFAULT CHARSET=utf8;
INSERT INTO `{..pref..}dl_cat` (`cat_id`, `subcat_id`, `cat_name`) VALUES
(1, 0, 'Downloads');


DROP TABLE IF EXISTS `{..pref..}dl_files`;
CREATE TABLE IF NOT EXISTS `{..pref..}dl_files` (
  `dl_id` mediumint(8) DEFAULT NULL,
  `file_id` mediumint(8) NOT NULL,
  `file_count` mediumint(8) NOT NULL DEFAULT '0',
  `file_name` varchar(100) DEFAULT NULL,
  `file_url` varchar(255) DEFAULT NULL,
  `file_size` mediumint(8) NOT NULL DEFAULT '0',
  `file_is_mirror` tinyint(1) NOT NULL DEFAULT '0'
) DEFAULT CHARSET=utf8;


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
  `do_smilies` tinyint(1) NOT NULL
) DEFAULT CHARSET=utf8;
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
  `html` tinyint(1) NOT NULL DEFAULT '1'
) DEFAULT CHARSET=utf8;
INSERT INTO `{..pref..}email` (`id`, `signup`, `change_password`, `delete_account`, `change_password_ack`, `use_admin_mail`, `email`, `html`) VALUES
(1, 'Hallo  {..user_name..},\n\nDu hast dich bei $VAR(page_title) registriert. Deine Zugangsdaten sind:\n\nBenutzername: {..user_name..}\nPasswort: {..new_password..}\n\nFalls du deine Daten ändern möchtest, kannst du das gerne auf deiner [url=$URL(user_edit[true])]Profilseite[/url] tun.\n\nDein Team von $VAR(page_title)!', 'Hallo {..user_name..},\n\nDein Passwort bei $VAR(page_title) wurde geändert. Deine neuen Zugangsdaten sind:\n\nBenutzername: {..user_name..}\nPasswort: {..new_password..}\n\nFalls du deine Daten ändern möchtest, kannst du das gerne auf deiner [url=$URL(user_edit[true])]Profilseite[/url] tun.\n\nDein Team von $VAR(page_title)!', 'Hallo {..user_name..},\n\nSchade, dass du dich von unserer Seite abgemeldet hast. Falls du es dir anders überlegst, [url=$URL()]darfst du gerne mal wieder vorbeischauen[/url].\n\nDein Team von $VAR(page_title)!', 'Hallo {..user_name..},\n\nDu hast für deinen Account auf $VAR(page_title) ein neues Passwort angefordert. Um den Vorgang abzuschließen musst du nur noch innerhalb der nächsten zwei Tage den folgenden Link anklicken: [url={..new_password_url..}]Neues Passwort setzen[/url]\n\nFalls du [b]kein[/b] neues Passwort angefordert hast, ignoriere diese E-Mail einfach. Du kannst dich weiterhin mit deinem bisherigen Passwort bei uns anmelden.\n\nDein Team von $VAR(page_title)!', 1, '', 0);


DROP TABLE IF EXISTS `{..pref..}ftp`;
CREATE TABLE IF NOT EXISTS `{..pref..}ftp` (
  `ftp_id` mediumint(9) NOT NULL,
  `ftp_title` varchar(100) NOT NULL,
  `ftp_type` varchar(10) NOT NULL,
  `ftp_url` varchar(255) NOT NULL,
  `ftp_user` varchar(255) NOT NULL,
  `ftp_pw` varchar(255) NOT NULL,
  `ftp_ssl` tinyint(1) NOT NULL,
  `ftp_http_url` varchar(255) NOT NULL
) DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `{..pref..}hashes`;
CREATE TABLE IF NOT EXISTS `{..pref..}hashes` (
  `id` mediumint(8) NOT NULL,
  `hash` varchar(40) CHARACTER SET utf8 NOT NULL,
  `type` varchar(20) CHARACTER SET utf8 NOT NULL,
  `typeId` mediumint(8) NOT NULL,
  `deleteTime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `{..pref..}news_cat`;
CREATE TABLE IF NOT EXISTS `{..pref..}news_cat` (
  `cat_id` smallint(6) NOT NULL,
  `cat_name` varchar(100) DEFAULT NULL,
  `cat_description` text NOT NULL,
  `cat_date` int(11) NOT NULL,
  `cat_user` mediumint(8) NOT NULL DEFAULT '1'
) DEFAULT CHARSET=utf8;
INSERT INTO `{..pref..}news_cat` (`cat_id`, `cat_name`, `cat_description`, `cat_date`, `cat_user`) VALUES
(1, 'News', '', UNIX_TIMESTAMP(), 1);


DROP TABLE IF EXISTS `{..pref..}news`;
CREATE TABLE IF NOT EXISTS `{..pref..}news` (
  `news_id` mediumint(8) NOT NULL,
  `cat_id` smallint(6) DEFAULT NULL,
  `user_id` mediumint(8) DEFAULT NULL,
  `news_date` int(11) DEFAULT NULL,
  `news_title` varchar(255) DEFAULT NULL,
  `news_text` text,
  `news_active` tinyint(1) NOT NULL DEFAULT '1',
  `news_comments_allowed` tinyint(1) NOT NULL DEFAULT '1',
  `news_search_update` int(11) NOT NULL DEFAULT '0'
) DEFAULT CHARSET=utf8;
INSERT INTO `{..pref..}news` (`news_id`, `cat_id`, `user_id`, `news_date`, `news_title`, `news_text`, `news_active`, `news_comments_allowed`, `news_search_update`) VALUES
(1, 1, 1, UNIX_TIMESTAMP(), 'Frogsystem 2.alix7 - Installation erfolgreich', 'Herzlich Willkommen in deinem frisch installierten Frogsystem 2!\nDas Frogsystem 2-Team wünscht viel Spaß und Erfolg mit der Seite.\n\nWeitere Informationen und Hilfe bei Problemen gibt es über die Frogsystem 2-Homepage, das GitHub-Projekt und im Wiki. Die wichtigsten Links haben wir unten zusammengefasst. Einfach mal vorbei schauen!\n\nDein Frogsystem 2-Team', 1, 1, 0);


DROP TABLE IF EXISTS `{..pref..}news_links`;
CREATE TABLE IF NOT EXISTS `{..pref..}news_links` (
  `news_id` mediumint(8) DEFAULT NULL,
  `link_id` mediumint(8) NOT NULL,
  `link_name` varchar(100) DEFAULT NULL,
  `link_url` varchar(255) DEFAULT NULL,
  `link_target` tinyint(4) DEFAULT NULL
) DEFAULT CHARSET=utf8;
INSERT INTO `{..pref..}news_links` (`news_id`, `link_id`, `link_name`, `link_url`, `link_target`) VALUES
(1, 1, 'Offizielle Frogsystem 2 Homepage', 'http://www.frogsystem.de', 1),
(1, 2, 'GitHub Projekt', 'https://github.com/mrgrain/Frogsystem-2', 1),
(1, 3, 'Frogsystem 2 Wiki', 'https://github.com/mrgrain/Frogsystem-2/wiki', 1);


DROP TABLE IF EXISTS `{..pref..}partner`;
CREATE TABLE IF NOT EXISTS `{..pref..}partner` (
  `partner_id` smallint(3) unsigned NOT NULL,
  `partner_name` varchar(150) NOT NULL,
  `partner_link` varchar(250) NOT NULL,
  `partner_beschreibung` text NOT NULL,
  `partner_permanent` tinyint(1) unsigned NOT NULL DEFAULT '0'
) DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `{..pref..}player`;
CREATE TABLE IF NOT EXISTS `{..pref..}player` (
  `video_id` mediumint(8) NOT NULL,
  `video_type` tinyint(1) NOT NULL DEFAULT '1',
  `video_x` text NOT NULL,
  `video_title` varchar(100) NOT NULL,
  `video_lenght` smallint(6) NOT NULL DEFAULT '0',
  `video_desc` text NOT NULL,
  `dl_id` mediumint(8) NOT NULL
) DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `{..pref..}poll`;
CREATE TABLE IF NOT EXISTS `{..pref..}poll` (
  `poll_id` mediumint(8) NOT NULL,
  `poll_quest` varchar(255) DEFAULT NULL,
  `poll_start` int(11) DEFAULT NULL,
  `poll_end` int(11) DEFAULT NULL,
  `poll_type` tinyint(4) DEFAULT NULL,
  `poll_participants` mediumint(8) NOT NULL DEFAULT '0'
) DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `{..pref..}poll_answers`;
CREATE TABLE IF NOT EXISTS `{..pref..}poll_answers` (
  `poll_id` mediumint(8) DEFAULT NULL,
  `answer_id` mediumint(8) NOT NULL,
  `answer` varchar(255) DEFAULT NULL,
  `answer_count` mediumint(8) NOT NULL DEFAULT '0'
) DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `{..pref..}poll_voters`;
CREATE TABLE IF NOT EXISTS `{..pref..}poll_voters` (
  `voter_id` mediumint(8) NOT NULL,
  `poll_id` mediumint(8) NOT NULL DEFAULT '0',
  `ip_address` varchar(15) NOT NULL DEFAULT '0.0.0.0',
  `time` int(32) NOT NULL DEFAULT '0'
) DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `{..pref..}press`;
CREATE TABLE IF NOT EXISTS `{..pref..}press` (
  `press_id` smallint(6) NOT NULL,
  `press_title` varchar(255) NOT NULL,
  `press_url` varchar(255) NOT NULL,
  `press_date` int(12) NOT NULL,
  `press_intro` text NOT NULL,
  `press_text` text NOT NULL,
  `press_note` text NOT NULL,
  `press_lang` int(11) NOT NULL,
  `press_game` tinyint(2) NOT NULL,
  `press_cat` tinyint(2) NOT NULL
) DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `{..pref..}press_admin`;
CREATE TABLE IF NOT EXISTS `{..pref..}press_admin` (
  `id` mediumint(8) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL
) DEFAULT CHARSET=utf8;
INSERT INTO `{..pref..}press_admin` (`id`, `type`, `title`) VALUES
(1, 1, 'Beispiel-Spiel'),
(2, 2, 'Preview'),
(3, 2, 'Review'),
(4, 2, 'Interview'),
(5, 3, 'Deutsch'),
(6, 3, 'Englisch');


DROP TABLE IF EXISTS `{..pref..}screen`;
CREATE TABLE IF NOT EXISTS `{..pref..}screen` (
  `screen_id` mediumint(8) NOT NULL,
  `cat_id` smallint(6) unsigned DEFAULT NULL,
  `screen_name` varchar(255) DEFAULT NULL
) DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `{..pref..}screen_cat`;
CREATE TABLE IF NOT EXISTS `{..pref..}screen_cat` (
  `cat_id` smallint(6) NOT NULL,
  `cat_name` varchar(255) DEFAULT NULL,
  `cat_type` tinyint(1) NOT NULL DEFAULT '0',
  `cat_visibility` tinyint(1) NOT NULL DEFAULT '1',
  `cat_date` int(11) NOT NULL DEFAULT '0',
  `randompic` tinyint(1) NOT NULL DEFAULT '0'
) DEFAULT CHARSET=utf8;
INSERT INTO `{..pref..}screen_cat` (`cat_id`, `cat_name`, `cat_type`, `cat_visibility`, `cat_date`, `randompic`) VALUES
(1, 'Screenshots', 1, 1, UNIX_TIMESTAMP(), 1),
(2, 'Wallpaper', 2, 1, UNIX_TIMESTAMP(), 0);


DROP TABLE IF EXISTS `{..pref..}screen_random`;
CREATE TABLE IF NOT EXISTS `{..pref..}screen_random` (
  `random_id` mediumint(8) NOT NULL,
  `screen_id` mediumint(8) NOT NULL,
  `start` int(11) NOT NULL,
  `end` int(11) NOT NULL
) DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `{..pref..}search_index`;
CREATE TABLE IF NOT EXISTS `{..pref..}search_index` (
  `search_index_id` mediumint(8) NOT NULL,
  `search_index_word_id` mediumint(8) NOT NULL DEFAULT '0',
  `search_index_type` enum('news','articles','dl') NOT NULL DEFAULT 'news',
  `search_index_document_id` mediumint(8) NOT NULL DEFAULT '0',
  `search_index_count` smallint(5) NOT NULL DEFAULT '0'
) DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `{..pref..}search_time`;
CREATE TABLE IF NOT EXISTS `{..pref..}search_time` (
  `search_time_id` mediumint(8) NOT NULL,
  `search_time_type` enum('news','articles','dl') NOT NULL DEFAULT 'news',
  `search_time_document_id` mediumint(8) NOT NULL,
  `search_time_date` int(11) NOT NULL DEFAULT '0'
) DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `{..pref..}search_words`;
CREATE TABLE IF NOT EXISTS `{..pref..}search_words` (
  `search_word_id` mediumint(8) NOT NULL,
  `search_word` varchar(32) NOT NULL DEFAULT ''
) DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `{..pref..}shop`;
CREATE TABLE IF NOT EXISTS `{..pref..}shop` (
  `artikel_id` mediumint(8) NOT NULL,
  `artikel_name` varchar(100) DEFAULT NULL,
  `artikel_url` varchar(255) DEFAULT NULL,
  `artikel_text` text,
  `artikel_preis` varchar(10) DEFAULT NULL,
  `artikel_hot` tinyint(4) DEFAULT NULL
) DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `{..pref..}smilies`;
CREATE TABLE IF NOT EXISTS `{..pref..}smilies` (
  `id` mediumint(8) NOT NULL,
  `replace_string` varchar(15) NOT NULL,
  `order` mediumint(8) NOT NULL
) DEFAULT CHARSET=utf8;
INSERT INTO `{..pref..}smilies` (`id`, `replace_string`, `order`) VALUES
(1, ':-)', 1),
(2, ':-(', 2),
(3, ';-)', 3),
(4, ':-P', 4),
(5, 'xD',  5),
(6, ':-o', 6),
(7, '^_^', 7),
(8, ':-/', 8),
(9, ':-]', 9),
(10, '&gt;-(', 10);


DROP TABLE IF EXISTS `{..pref..}snippets`;
CREATE TABLE IF NOT EXISTS `{..pref..}snippets` (
  `snippet_id` mediumint(8) NOT NULL,
  `snippet_tag` varchar(100) NOT NULL,
  `snippet_text` text NOT NULL,
  `snippet_active` tinyint(1) NOT NULL DEFAULT '1'
) DEFAULT CHARSET=utf8;
INSERT INTO `{..pref..}snippets` (`snippet_id`, `snippet_tag`, `snippet_text`, `snippet_active`) VALUES
(1, '[%feeds%]', '<p>\n  <b>News-Feeds:</b>\n</p>\n<p align="center">\n  <a href="$URL(feed[xml=rss091 true])" target="_self"><img src="$VAR(style_icons)feeds/rss091.gif" alt="RSS 0.91" title="RSS 0.91" border="0"></a><br>\n  <a href="$URL(feed[xml=rss10 true])" target="_self"><img src="$VAR(style_icons)feeds/rss10.gif" alt="RSS 1.0" title="RSS 1.0" border="0"></a><br>\n  <a href="$URL(feed[xml=rss20 true])" target="_self"><img src="$VAR(style_icons)feeds/rss20.gif" alt="RSS 2.0" title="RSS 2.0" border="0"></a><br>\n  <a href="$URL(feed[xml=atom10 true])" target="_self"><img src="$VAR(style_icons)feeds/atom10.gif" alt="Atom 1.0" title="Atom 1.0" border="0"></a>\n</p>', 1);


DROP TABLE IF EXISTS `{..pref..}styles`;
CREATE TABLE IF NOT EXISTS `{..pref..}styles` (
  `style_id` mediumint(8) NOT NULL,
  `style_tag` varchar(30) NOT NULL,
  `style_allow_use` tinyint(1) NOT NULL DEFAULT '1',
  `style_allow_edit` tinyint(1) NOT NULL DEFAULT '1'
) DEFAULT CHARSET=utf8;
INSERT INTO `{..pref..}styles` (`style_id`, `style_tag`, `style_allow_use`, `style_allow_edit`) VALUES
(1, 'lightfrog', 1, 1);

DROP TABLE IF EXISTS `{..pref..}user`;
CREATE TABLE IF NOT EXISTS `{..pref..}user` (
  `user_id` mediumint(8) NOT NULL,
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
  `user_skype` varchar(50) DEFAULT NULL
) DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `{..pref..}useronline`;
CREATE TABLE IF NOT EXISTS `{..pref..}useronline` (
  `ip` varchar(30) NOT NULL,
  `user_id` mediumint(8) NOT NULL DEFAULT '0',
  `date` int(30) DEFAULT NULL
) ENGINE=MEMORY DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `{..pref..}user_groups`;
CREATE TABLE IF NOT EXISTS `{..pref..}user_groups` (
  `user_group_id` mediumint(8) NOT NULL,
  `user_group_name` varchar(50) NOT NULL,
  `user_group_description` text,
  `user_group_title` varchar(50) DEFAULT NULL,
  `user_group_color` varchar(6) NOT NULL DEFAULT '-1',
  `user_group_highlight` tinyint(1) NOT NULL DEFAULT '0',
  `user_group_date` int(11) NOT NULL,
  `user_group_user` mediumint(8) NOT NULL DEFAULT '1'
) DEFAULT CHARSET=utf8;
INSERT INTO `{..pref..}user_groups` (`user_group_id`, `user_group_name`, `user_group_description`, `user_group_title`, `user_group_color`, `user_group_highlight`, `user_group_date`, `user_group_user`) VALUES
(1, 'Administrator', '', 'Administrator', '008800', 1, UNIX_TIMESTAMP(), 1);


DROP TABLE IF EXISTS `{..pref..}user_permissions`;
CREATE TABLE IF NOT EXISTS `{..pref..}user_permissions` (
  `perm_id` varchar(255) NOT NULL,
  `x_id` mediumint(8) NOT NULL,
  `perm_for_group` tinyint(1) NOT NULL DEFAULT '1'
) DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `{..pref..}wallpaper`;
CREATE TABLE IF NOT EXISTS `{..pref..}wallpaper` (
  `wallpaper_id` mediumint(8) NOT NULL,
  `wallpaper_name` varchar(255) NOT NULL,
  `wallpaper_title` varchar(255) NOT NULL,
  `cat_id` mediumint(8) NOT NULL DEFAULT '0'
) DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `{..pref..}wallpaper_sizes`;
CREATE TABLE IF NOT EXISTS `{..pref..}wallpaper_sizes` (
  `size_id` mediumint(8) NOT NULL,
  `wallpaper_id` mediumint(8) NOT NULL DEFAULT '0',
  `size` varchar(255) NOT NULL
) DEFAULT CHARSET=utf8;



ALTER TABLE `{..pref..}admin_cp`
 ADD PRIMARY KEY (`page_id`);

ALTER TABLE `{..pref..}aliases`
 ADD PRIMARY KEY (`alias_id`), ADD KEY `alias_go` (`alias_go`);

ALTER TABLE `{..pref..}announcement`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `{..pref..}applets`
 ADD PRIMARY KEY (`applet_id`), ADD UNIQUE KEY `applet_file` (`applet_file`);

ALTER TABLE `{..pref..}articles`
 ADD PRIMARY KEY (`article_id`), ADD KEY `article_url` (`article_url`);

ALTER TABLE `{..pref..}articles_cat`
 ADD PRIMARY KEY (`cat_id`);

ALTER TABLE `{..pref..}b8_wordlist`
 ADD PRIMARY KEY (`token`);

ALTER TABLE `{..pref..}cimg`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `{..pref..}cimg_cats`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `{..pref..}comments`
 ADD PRIMARY KEY (`comment_id`);

ALTER TABLE `{..pref..}config`
 ADD UNIQUE KEY `config_name` (`config_name`);

ALTER TABLE `{..pref..}counter`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `{..pref..}counter_ref`
 ADD KEY `ref_url` (`ref_url`);

ALTER TABLE `{..pref..}counter_stat`
 ADD PRIMARY KEY (`s_year`,`s_month`,`s_day`);

ALTER TABLE `{..pref..}dl`
 ADD PRIMARY KEY (`dl_id`);

ALTER TABLE `{..pref..}dl_cat`
 ADD PRIMARY KEY (`cat_id`);

ALTER TABLE `{..pref..}dl_files`
 ADD PRIMARY KEY (`file_id`), ADD KEY `dl_id` (`dl_id`);

ALTER TABLE `{..pref..}editor_config`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `{..pref..}email`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `{..pref..}ftp`
 ADD PRIMARY KEY (`ftp_id`);

ALTER TABLE `{..pref..}hashes`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `hash` (`hash`);

ALTER TABLE `{..pref..}news`
 ADD PRIMARY KEY (`news_id`);

ALTER TABLE `{..pref..}news_cat`
 ADD PRIMARY KEY (`cat_id`);

ALTER TABLE `{..pref..}news_links`
 ADD PRIMARY KEY (`link_id`);

ALTER TABLE `{..pref..}partner`
 ADD PRIMARY KEY (`partner_id`);

ALTER TABLE `{..pref..}player`
 ADD PRIMARY KEY (`video_id`);

ALTER TABLE `{..pref..}poll`
 ADD PRIMARY KEY (`poll_id`);

ALTER TABLE `{..pref..}poll_answers`
 ADD PRIMARY KEY (`answer_id`);

ALTER TABLE `{..pref..}poll_voters`
 ADD PRIMARY KEY (`voter_id`);

ALTER TABLE `{..pref..}press`
 ADD PRIMARY KEY (`press_id`);

ALTER TABLE `{..pref..}press_admin`
 ADD PRIMARY KEY (`id`,`type`);

ALTER TABLE `{..pref..}screen`
 ADD PRIMARY KEY (`screen_id`), ADD KEY `cat_id` (`cat_id`);

ALTER TABLE `{..pref..}screen_cat`
 ADD PRIMARY KEY (`cat_id`);

ALTER TABLE `{..pref..}screen_random`
 ADD PRIMARY KEY (`random_id`);

ALTER TABLE `{..pref..}search_index`
 ADD PRIMARY KEY (`search_index_id`), ADD UNIQUE KEY `un_search_index_word_id` (`search_index_word_id`,`search_index_type`,`search_index_document_id`);

ALTER TABLE `{..pref..}search_time`
 ADD PRIMARY KEY (`search_time_id`), ADD UNIQUE KEY `un_search_time_type` (`search_time_type`,`search_time_document_id`);

ALTER TABLE `{..pref..}search_words`
 ADD PRIMARY KEY (`search_word_id`), ADD UNIQUE KEY `search_word` (`search_word`);

ALTER TABLE `{..pref..}shop`
 ADD PRIMARY KEY (`artikel_id`);

ALTER TABLE `{..pref..}smilies`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `{..pref..}snippets`
 ADD PRIMARY KEY (`snippet_id`), ADD UNIQUE KEY `snippet_tag` (`snippet_tag`);

ALTER TABLE `{..pref..}styles`
 ADD PRIMARY KEY (`style_id`), ADD UNIQUE KEY `style_tag` (`style_tag`);

ALTER TABLE `{..pref..}user`
 ADD PRIMARY KEY (`user_id`);

ALTER TABLE `{..pref..}useronline`
 ADD PRIMARY KEY (`ip`);

ALTER TABLE `{..pref..}user_groups`
 ADD PRIMARY KEY (`user_group_id`);

ALTER TABLE `{..pref..}user_permissions`
 ADD PRIMARY KEY (`perm_id`,`x_id`,`perm_for_group`);

ALTER TABLE `{..pref..}wallpaper`
 ADD PRIMARY KEY (`wallpaper_id`);

ALTER TABLE `{..pref..}wallpaper_sizes`
 ADD PRIMARY KEY (`size_id`);


ALTER TABLE `{..pref..}aliases`
MODIFY `alias_id` mediumint(8) NOT NULL AUTO_INCREMENT;

ALTER TABLE `{..pref..}applets`
MODIFY `applet_id` mediumint(8) NOT NULL AUTO_INCREMENT;

ALTER TABLE `{..pref..}articles`
MODIFY `article_id` mediumint(8) NOT NULL AUTO_INCREMENT;

ALTER TABLE `{..pref..}articles_cat`
MODIFY `cat_id` smallint(6) NOT NULL AUTO_INCREMENT;

ALTER TABLE `{..pref..}cimg`
MODIFY `id` mediumint(8) NOT NULL AUTO_INCREMENT;

ALTER TABLE `{..pref..}cimg_cats`
MODIFY `id` mediumint(8) NOT NULL AUTO_INCREMENT;

ALTER TABLE `{..pref..}comments`
MODIFY `comment_id` mediumint(8) NOT NULL AUTO_INCREMENT;

ALTER TABLE `{..pref..}dl`
MODIFY `dl_id` mediumint(8) NOT NULL AUTO_INCREMENT;

ALTER TABLE `{..pref..}dl_cat`
MODIFY `cat_id` mediumint(8) NOT NULL AUTO_INCREMENT;

ALTER TABLE `{..pref..}dl_files`
MODIFY `file_id` mediumint(8) NOT NULL AUTO_INCREMENT;

ALTER TABLE `{..pref..}ftp`
MODIFY `ftp_id` mediumint(9) NOT NULL AUTO_INCREMENT;

ALTER TABLE `{..pref..}hashes`
MODIFY `id` mediumint(8) NOT NULL AUTO_INCREMENT;

ALTER TABLE `{..pref..}news`
MODIFY `news_id` mediumint(8) NOT NULL AUTO_INCREMENT;

ALTER TABLE `{..pref..}news_cat`
MODIFY `cat_id` smallint(6) NOT NULL AUTO_INCREMENT;

ALTER TABLE `{..pref..}news_links`
MODIFY `link_id` mediumint(8) NOT NULL AUTO_INCREMENT;

ALTER TABLE `{..pref..}partner`
MODIFY `partner_id` smallint(3) unsigned NOT NULL AUTO_INCREMENT;

ALTER TABLE `{..pref..}player`
MODIFY `video_id` mediumint(8) NOT NULL AUTO_INCREMENT;

ALTER TABLE `{..pref..}poll`
MODIFY `poll_id` mediumint(8) NOT NULL AUTO_INCREMENT;

ALTER TABLE `{..pref..}poll_answers`
MODIFY `answer_id` mediumint(8) NOT NULL AUTO_INCREMENT;

ALTER TABLE `{..pref..}poll_voters`
MODIFY `voter_id` mediumint(8) NOT NULL AUTO_INCREMENT;

ALTER TABLE `{..pref..}press`
MODIFY `press_id` smallint(6) NOT NULL AUTO_INCREMENT;

ALTER TABLE `{..pref..}press_admin`
MODIFY `id` mediumint(8) NOT NULL AUTO_INCREMENT;

ALTER TABLE `{..pref..}screen`
MODIFY `screen_id` mediumint(8) NOT NULL AUTO_INCREMENT;

ALTER TABLE `{..pref..}screen_cat`
MODIFY `cat_id` smallint(6) NOT NULL AUTO_INCREMENT;

ALTER TABLE `{..pref..}screen_random`
MODIFY `random_id` mediumint(8) NOT NULL AUTO_INCREMENT;

ALTER TABLE `{..pref..}search_index`
MODIFY `search_index_id` mediumint(8) NOT NULL AUTO_INCREMENT;

ALTER TABLE `{..pref..}search_time`
MODIFY `search_time_id` mediumint(8) NOT NULL AUTO_INCREMENT;

ALTER TABLE `{..pref..}search_words`
MODIFY `search_word_id` mediumint(8) NOT NULL AUTO_INCREMENT;

ALTER TABLE `{..pref..}shop`
MODIFY `artikel_id` mediumint(8) NOT NULL AUTO_INCREMENT;

ALTER TABLE `{..pref..}smilies`
MODIFY `id` mediumint(8) NOT NULL AUTO_INCREMENT;

ALTER TABLE `{..pref..}snippets`
MODIFY `snippet_id` mediumint(8) NOT NULL AUTO_INCREMENT;

ALTER TABLE `{..pref..}styles`
MODIFY `style_id` mediumint(8) NOT NULL AUTO_INCREMENT;

ALTER TABLE `{..pref..}user`
MODIFY `user_id` mediumint(8) NOT NULL AUTO_INCREMENT;

ALTER TABLE `{..pref..}user_groups`
MODIFY `user_group_id` mediumint(8) NOT NULL AUTO_INCREMENT;

ALTER TABLE `{..pref..}wallpaper`
MODIFY `wallpaper_id` mediumint(8) NOT NULL AUTO_INCREMENT;

ALTER TABLE `{..pref..}wallpaper_sizes`
MODIFY `size_id` mediumint(8) NOT NULL AUTO_INCREMENT;


SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT;
SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS;
SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION;
