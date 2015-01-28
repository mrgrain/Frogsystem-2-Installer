SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT;
SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS;
SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION;
SET NAMES utf8;

INSERT INTO `{..pref..}admin_cp` (`page_id`, `group_id`, `page_file`, `page_pos`, `page_int_sub_perm`) VALUES
('tpl_styleselect', 'templates', 'admin_template_styleselect.php', 26, 0),
('social_meta_tags', 'socialmedia', 'admin_social_meta_tags.php', 1, 0);

INSERT INTO `{..pref..}admin_groups` (`group_id`, `menu_id`, `group_pos`) VALUES
('socialmedia', 'promo', 3);

INSERT INTO `{..pref..}applets` (`applet_file`, `applet_active`, `applet_include`, `applet_output`) VALUES
('social-meta-tags', 1, 2, 1);

DELETE FROM `{..pref..}styles` WHERE `style_tag` = 'default';


SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT;
SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS;
SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION;
