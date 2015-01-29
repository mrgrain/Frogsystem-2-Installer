<?php
/**
 * @file     SettingsMigrationSolver.php
 * @folder   /classes
 * @version  0.1
 * @author   Sweil
 *
 * migrate existing settings from updated versions
 */
class SettingsMigrationSolver extends PairSolver {
    
    private $sql;
    private $version;
    private $configs = array(
		'affiliatesConfig', 'articlesConfig', 'captchaConfig', 'downloadsConfig', 'galleryConfig', 
		'groupsConfig', 'mainConfig', 'newsConfig', 'pollsConfig', 'pressConfig', 'previewImagesConfig', 
		'searchConfig', 'usersConfig', 'videoPlayerConfig',
        'systemConfig', 'envConfig', 'infoConfig', 'cronjobsConfig', 'socialMetaTagsConfig',
        'version'
	);
    
    public function __construct($sql) {
        $this->sql = $sql;
    }
    
    /* Default tests & solutions */             
    public function getDefaultPairs() {
        return $this->configs;
    }
    
    // test for old configs
    public function testAffiliatesConfig() {
		return $this->genericConfigTester('affiliates');
    }
    public function testArticlesConfig() {
		return $this->genericConfigTester('articles');
    }
    public function testCaptchaConfig() {
		return $this->genericConfigTester('captcha');
    }
    public function testDownloadsConfig() {
		return $this->genericConfigTester('downloads');
    }
    public function testGalleryConfig() {
		return $this->genericConfigTester('screens');
    }
    public function testGroupsConfig() {
		return $this->genericConfigTester('groups');
    }   
    public function testMainConfig() {
		return $this->genericConfigTester('main');
    }
    public function testNewsConfig() {
		return $this->genericConfigTester('news');
    }
    public function testPollsConfig() {
		return $this->genericConfigTester('polls');
    }
    public function testPressConfig() {
		return $this->genericConfigTester('press');
    }
    public function testPreviewImagesConfig() {
		return $this->genericConfigTester('preview_images');
    }
    public function testSearchConfig() {
		return $this->genericConfigTester('search');
    }
    public function testUsersConfig() {
		return $this->genericConfigTester('users');
    }
    public function testVideoPlayerConfig() {
		return $this->genericConfigTester('video_player');
    }
    public function testSystemConfig() {
		return $this->genericConfigTester('system');
    }
    public function testEnvConfig() {
		return $this->genericConfigTester('env');
    }
    public function testInfoConfig() {
		return $this->genericConfigTester('info');
    }
    public function testCronjobsConfig() {
		return $this->genericConfigTester('cronjobs');
    }
    public function testSocialMetaTagsConfig() {
		return $this->genericConfigTester('social_meta_tags');
    }
    
    // test version
    public function testVersion() {
		return false; // always update to new version
    }
    
    
    // solutions
    public function solutionAffiliatesConfig() {
        return $this->genericMigrateConfig('affiliates', 'none', array(), 'partner_config');
    }
    public function solutionArticlesConfig() {
        return $this->genericMigrateConfig('articles', 'none', array(), 'articles_config');
    }
    public function solutionCaptchaConfig() {
        return $this->genericMigrateConfig('captcha', 'none', array(), 'captcha_config');
    }
    public function solutionDownloadsConfig() {
        return $this->genericMigrateConfig('downloads', 'none', array(), 'dl_config');        
    }
    public function solutionGalleryConfig() {
        return $this->genericMigrateConfig('screens', 'none', array(), 'screen_config'); 
    }
    public function solutionGroupsConfig() {
        return $this->genericMigrateConfig('groups', 'none', array(), 'user_config'); 
    }   
    public function solutionMainConfig() { //todo
        $config = array();
        
        // alix5 and lowe
        if ($this->tableExists('global_config')) {
            $config = $this->sql->getById('global_config', '*', 1);
            
            // url slash & leading http://
            $config['url'] = $config['virtualhost'];
            if (substr($config['url'], -1) != '/') {
                $config['url'] = $config['url'].'/';
            }
            if (substr($config['url'], 0, 8) == 'https://') {
                $config['url'] = substr($config['url'], 8);
                $config['protocol'] = 'https://';
            }             
            elseif (substr($config['url'], 0, 7) == 'http://') {
                $config['url'] = substr($config['url'], 7);
                $config['protocol'] = 'http://';
            } else {
                $config['protocol'] = 'http://';
            }
            
            //set lang
            $config['language_text'] = InstallerFunctions::detect_language();
            
            //set style_id
            if(isset($config['style_tag'])) {
                if (false !== $style_id = $this->sql->getFieldById('styles', 'style_id', $config['style_tag'], 'style_tag')) {
                    $config['style_id'] = $style_id;
                }
            }
            
            //update dyn title
            $config['dyn_title_ext'] = str_replace(array('{title}', '{ext}'), array('{..title..}', '{..ext..}'), $config['dyn_title_ext']);      
        
            // not possible in property
            $server_timezone = @date_default_timezone_get();
            if (false !== $server_timezone && (!isset($config['timezone']) || empty($config['timezone']))) {
                $config['timezone'] = $server_timezone;
            }
        }
        
        return $this->genericMigrateConfig('main', 'startup', $config, false);         
    }
    public function solutionNewsConfig() {
        return $this->genericMigrateConfig('news', 'none', array(), 'news_config');         
    }
    public function solutionPollsConfig() {
        return $this->genericMigrateConfig('polls', 'none', array(), 'poll_config');          
    }
    public function solutionPressConfig() {
        return $this->genericMigrateConfig('press', 'none', array(), 'press_config');          
    }
    public function solutionPreviewImagesConfig() {
        $config = array();
        if ($this->tableExists('global_config')) {
            $timed_deltime = $this->sql->getFieldById('global_config', 'random_timed_deltime', 1);
            if (!empty($timed_deltime))
                $config['timed_deltime'] = $timed_deltime;
        }

        return $this->genericMigrateConfig('preview_images', 'none', $config, 'screen_random_config');              
    }
    public function solutionSearchConfig() {
        return $this->genericMigrateConfig('search', 'none', array(), 'search_config');              
    }
    public function solutionUsersConfig() {
        return $this->genericMigrateConfig('users', 'none', array(), 'user_config');          
    }
    public function solutionVideoPlayerConfig() {
        // prepend colors with #
        $converter = function(&$value, $key) {
            $colors = array('cfg_buffercolor','cfg_bufferbgcolor','cfg_titlecolor','cfg_playercolor','cfg_loadingcolor','cfg_bgcolor','cfg_bgcolor1','cfg_bgcolor2','cfg_buttoncolor','cfg_buttonovercolor','cfg_slidercolor1','cfg_slidercolor2','cfg_sliderovercolor','cfg_videobgcolor','cfg_iconplaycolor','cfg_iconplaybgcolor');
            
            if (in_array($key, $colors)) {
                $value = '#'.$value;
            }
        };
        
        return $this->genericMigrateConfig('video_player', 'none', array(), 'player_config', $converter);          
    }
    
    public function solutionSystemConfig() {
        return $this->genericMigrateConfig('system', 'startup');
    }
    public function solutionEnvConfig() {
        return $this->genericMigrateConfig('env', '');
    }
    public function solutionInfoConfig() {
        return $this->genericMigrateConfig('info', 'startup');
    }
    public function solutionCronjobsConfig() {
        return $this->genericMigrateConfig('cronjobs', 'startup');
    }
    public function solutionSocialMetaTagsConfig() {
        return $this->genericMigrateConfig('social_meta_tags');
    }
    
    
    // version solution
    public function solutionVersion() {
        $main = $this->sql->getFieldById('config', 'config_data', 'main', 'config_name');
        $main = InstallerFunctions::json_array_decode($main);
        $main['version'] = UPGRADE_TO;
        $main = InstallerFunctions::json_array_encode($main);
        return $this->sql->save('config', array('config_name' => 'main', 'config_data' => $main), 'config_name', false);
    }
    
    
    
	// generic config tester
    private function genericConfigTester($name) {
        $config = $this->sql->getFieldById('config', 'config_data', $name, 'config_name');
        if (empty($config))
            return false;
        
        $config = json_array_decode($config);
        $defaultConfig = $name.'Config';
        if (!empty(array_diff_key($this->$defaultConfig, $config))) // any new default keys not present in current config
            return false;
        if (!empty(array_diff_key($config, $this->$defaultConfig))) // any old keys not longer present in current config
            return false;
        
        return true;
    }
    
    // generic migrate config
    public function genericMigrateConfig($name, $loadhook = 'none', $important = array(), $oldname = false, $converter = false) {
        // Try to get config array from new table...
        $config = $this->sql->getFieldById('config', 'config_data', $name, 'config_name');
        
        // ... otherwise try to get from an old table (alix5 and lower)
        if ((empty($config) || !is_array($config)) && false !== $oldname && $this->tableExists($oldname)) {
            $config = $this->sql->getById($name, '*', 1);
        }
        
        // fallback = empty array
        if (empty($config) || !is_array($config)) {
             $config = array();
        }
    
        // specific important data has priority
        $config = $important + $config;
        
        // map conversion function to config
        if (is_callable($converter)) {
            array_walk($config, $converter;
        }
    
        return $this->genericFillConfig($name, $config, $loadhook);
    }
    
    // generic config filler
    // Update old data with new defaults and save config
    public function genericFillConfig($name, $old, $loadhook = 'none') {
        //data-array
        $data = $this->getDataArray($name);
        
        // filter and fill with default config value
        $defaultConfig = $name.'Config';
        $config = array_intersect_key($old, $this->$defaultConfig); // remove keys not longer available
        $config = $config+$this->$defaultConfig; // overwrite only unset keys with new defaults

        // write into new config
        $data['config_data'] = InstallerFunctions::json_array_encode($config);
        $data['config_loadhook'] = $loadhook;
        try {
            $this->sql->save('config', $data, 'config_name', false);
        } catch (Exception $e) {
            return false;
        }
        return true;
    } 
    
    // helper functions
    private function tableExists($tablename) {
        $table = $this->sql->doQuery("SHOW TABLES LIKE '{..pref..}".$tablename."'");
        foreach($table as $t) {
            return true;
        }
        return false;
    }
    
    private function getDataArray($name, $loadhook = 'none') {
        return array(
            'config_name' => $name,
            'config_loadhook' => $loadhook,
            'config_data' => null
        );
    }
    
    
    // Default values
    private $systemConfig = array('var_loop' => '20');    
    private $envConfig = array();    
    private $infoConfig = array();
    
    private $cronjobsConfig = array(
        'last_cronjob_time' => '0',
        'last_cronjob_time_daily' => '0',
        'last_cronjob_time_hourly' => '0',
        'search_index_update' => '2',
        'ref_cron' => '1',
        'ref_days' => '7',
        'ref_hits' => '5',
        'ref_contact' => 'first',
        'ref_age' => 'older',
        'ref_amount' => 'less'
    );    
    

    // `frogsystem_alix5`.`fs2_partner_config`
    private $affiliatesConfig = array(
        'partner_anzahl' => '5',
        'small_x' => '88',
        'small_y' => '31',
        'small_allow' => '0',
        'big_x' => '468',
        'big_y' => '60',
        'big_allow' => '1',
        'file_size' => '1024'
    );
    
    // `frogsystem_alix5`.`fs2_articles_config`
    private $articlesConfig = array(
        'html_code' => '2',
        'fs_code' => '4',
        'para_handling' => '4',
        'cat_pic_x' => '150',
        'cat_pic_y' => '150',
        'cat_pic_size' => '1024',
        'com_rights' => '2', 
        'com_antispam' => '2',
        'com_sort' => 'DESC',
        'acp_per_page' => '25',
        'acp_view' => '2'
    );

    // `frogsystem_alix5`.`fs2_captcha_config`
    private $captchaConfig = array(
        'captcha_bg_color' => 'FFFFFF',
        'captcha_bg_transparent' => '1',
        'captcha_text_color' => '000000',
        'captcha_first_lower' => '1',
        'captcha_first_upper' => '5',
        'captcha_second_lower' => '1',
        'captcha_second_upper' => '5',
        'captcha_use_addition' => '1',
        'captcha_use_subtraction' => '1',
        'captcha_use_multiplication' => '0',
        'captcha_create_easy_arithmetics' => '1',
        'captcha_x' => '58',
        'captcha_y' => '18',
        'captcha_show_questionmark' => '0',
        'captcha_use_spaces' => '1',
        'captcha_show_multiplication_as_x' => '1',
        'captcha_start_text_x' => '0',
        'captcha_start_text_y' => '0',
        'captcha_font_size' => '5',
        'captcha_font_file' => ''
    );

    // `frogsystem_alix5`.`fs2_dl_config`
    private $downloadsConfig = array(
        'screen_x' => '1024',
        'screen_y' => '768',
        'thumb_x' => '120',
        'thumb_y' => '90',
        'quickinsert' => '',
        'dl_rights' => '2',
        'dl_show_sub_cats' => '0',
        'dl_comments' => '0',
    );
    
    // `frogsystem_alix5`.`fs2_screen_config`
    private $screensConfig = array(
        'screen_x' => '3500',
        'screen_y' => '3500',
        'screen_thumb_x' => '120',
        'screen_thumb_y' => '90',
        'screen_size' => '2048',
        'screen_rows' => '5',
        'screen_cols' => '3',
        'screen_order' => 'id',
        'screen_sort' => 'desc',
        'show_type' => '1',
        'show_size_x' => '950',
        'show_size_y' => '700',
        'show_img_x' => '800',
        'show_img_y' => '600',
        'wp_x' => '3500',
        'wp_y' => '3500',
        'wp_thumb_x' => '200',
        'wp_thumb_y' => '150',
        'wp_order' => 'id',
        'wp_size' => '2048',
        'wp_rows' => '6',
        'wp_cols' => '2',
        'wp_sort' => 'desc'
    );

    // `frogsystem_alix5`.`fs2_user_config`
    private $groupsConfig = array(
        'group_pic_x' => '250',
        'group_pic_y' => '25',
        'group_pic_size' => '50'
    );    

    // `frogsystem_alix5`.`fs2_global_config`
    private $mainConfig = array(
        'version' => '2.alix6',
        'protocol' => 'http://',
        'url' => '',
        'other_protocol' => '1',
        'title' => '',
        'dyn_title' => '1',
        'dyn_title_ext' => '{..title..} - {..ext..}',
        'admin_mail' => '',
        'description' => '',
        'keywords' => '',
        'publisher' => '',
        'copyright' => '',
        'style_id' => '2',
        'style_tag' => 'lightfrog',
        'allow_other_designs' => '0',
        'show_favicon' => '0',
        'home' => '0',
        'home_text' => '',
        'language_text' => 'de_DE',
        'feed' => 'rss20',
        'timezone' => 'UTC',
        'auto_forward' => '4',
        'search_index_update' => '2',
        'search_index_time' => '0',
        'url_style' => 'default',
        'count_referers' => '1',
        'date' => 'd.m.Y',
        'time' => 'H:i \U\h\r',
        'datetime' => 'd.m.Y, H:i \U\h\r',
        'timezone' => null,
        'page' => '<div align="center" style="width:270px;"><div style="width:70px; float:left;">{..prev..}&nbsp;</div>Seite <b>{..page_number..}</b> von <b>{..total_pages..}</b><div style="width:70px; float:right;">&nbsp;{..next..}</div></div>',
        'page_next' => '|&nbsp;<a href="{..url..}">weiter&nbsp»</a>',
        'page_prev' => '<a href="{..url..}">«&nbsp;zurück</a>&nbsp|'
    );

    // `frogsystem_alix5`.`fs2_news_config`
    private $newsConfig = array(
        'num_news' => '10',
        'num_head' => '5',
        'html_code' => '2',
        'fs_code' => '4',
        'para_handling' => '4',
        'cat_pic_x' => '150',
        'cat_pic_y' => '150',
        'cat_pic_size' => '1024',
        'com_rights' => '2',
        'com_antispam' => '2',
        'com_sort' => 'DESC',
        'news_headline_lenght' => '20',
        'news_headline_ext' => ' ...',
        'acp_per_page' => '25',
        'acp_view' => '2',
        'acp_force_cat_selection' => '1' // new in 2.alix6
    );

    // `frogsystem_alix5`.`fs2_poll_config`
    private $pollsConfig = array(
        'answerbar_width' => '100',
        'answerbar_type' => '0'
    );

    // `frogsystem_alix5`.`fs2_press_config`
    private $pressConfig = array(
        'game_navi' => '1',
        'cat_navi' => '1',
        'lang_navi' => '0',
        'show_press' => '0',
        'show_root' => '0',
        'order_by' => 'press_date',
        'order_type' => 'desc'
    );

    // `frogsystem_alix5`.`fs2_screen_random_config`
    private $preview_imagesConfig = array(
        'active' => '1',
        'type_priority' => '1',
        'use_priority_only' => '0',
        'timed_deltime' => '604800' // from main
    );

    // `frogsystem_alix5`.`fs2_search_config`
    private $searchConfig = array(
        'search_num_previews' => '10',
        'search_and' => 'AND, and, &&',
        'search_or' => 'OR, or, ||',
        'search_xor' => 'XOR, xor',
        'search_not' => '!',
        'search_wildcard' => '*',
        'search_min_word_length' => '3',
        'search_allow_phonetic' => '1',
        'search_use_stopwords' => '1',
    );

    // `frogsystem_alix5`.`fs2_user_config`
    private $usersConfig = array(
        'user_per_page' => '50',
        'registration_antispam' => '1',
        'avatar_x' => '110',
        'avatar_y' => '110',
        'avatar_size' => '20',
        'reg_date_format' => 'l, j. F Y',
        'user_list_reg_date_format' => 'j. F Y'
    );

    // `frogsystem_alix5`.`fs2_player_config`
    private $video_playerConfig = array(
        'cfg_player_x' => '500', // new in 2.alix6
        'cfg_player_y' => '280', // new in 2.alix6
        'cfg_autoload' => '1',
        'cfg_buffer' => '5',
        'cfg_buffermessage' => 'Buffering _n_',
        'cfg_buffercolor' => '#FFFFFF',
        'cfg_bufferbgcolor' => '#000000',
        'cfg_buffershowbg' => '0',
        'cfg_titlesize' => '20',
        'cfg_titlecolor' => '#FFFFFF',
        'cfg_margin' => '5',
        'cfg_showstop' => '1',
        'cfg_showvolume' => '1',
        'cfg_showtime' => '1',
        'cfg_showplayer' => 'autohide',
        'cfg_showloading' => 'always',
        'cfg_showfullscreen' => '1',
        'cfg_showmouse' => 'autohide',
        'cfg_loop' => '0',
        'cfg_playercolor' => '#a6a6a6',
        'cfg_loadingcolor' => '#000000',
        'cfg_bgcolor' => '#FAFCF1',
        'cfg_bgcolor1' => '#E7E7E7',
        'cfg_bgcolor2' => '#cccccc',
        'cfg_buttoncolor' => '#000000',
        'cfg_buttonovercolor' => '#E7E7E7',
        'cfg_slidercolor1' => '#cccccc',
        'cfg_slidercolor2' => '#bbbbbb',
        'cfg_sliderovercolor' => '#E7E7E7',
        'cfg_loadonstop' => '1',
        'cfg_onclick' => 'playpause',
        'cfg_ondoubleclick' => 'fullscreen',
        'cfg_playertimeout' => '1500',
        'cfg_videobgcolor' => '#000000',
        'cfg_volume' => '100',
        'cfg_shortcut' => '1',
        'cfg_playeralpha' => '100',
        'cfg_top1_url' => '',
        'cfg_top1_x' => '0',
        'cfg_top1_y' => '0',
        'cfg_showiconplay' => '1',
        'cfg_iconplaycolor' => '#FFFFFF',
        'cfg_iconplaybgcolor' => '#000000',
        'cfg_iconplaybgalpha' => '75',
        'cfg_showtitleandstartimage' => '0'
    );
    
    private $social_meta_tagsConfig = array(
        'use_google_plus' => '',
        'google_plus_page' => '',
        'use_schema_org' => '',
        'use_twitter_card' => '',
        'twitter_site' => '',
        'use_open_graph' => '',
        'fb_admins' => '',
        'og_section' => '',
        'site_name' => '',
        'default_image' => '',
        'news_cat_prepend' => ': ',
        'enable_news' => '1',
        'enable_articles' => '1',
        'enable_downloads' => '1'
    );
}

?>
