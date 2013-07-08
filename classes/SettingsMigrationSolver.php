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
    private $configs = array(
		'affiliatesConfig', 'articlesConfig', 'captchaConfig', 'downloadsConfig', 'galleryConfig', 
		'groupsConfig', 'mainConfig', 'newsConfig', 'pollsConfig', 'pressConfig', 'previewImagesConfig', 
		'searchConfig', 'usersConfig', 'videoPlayerConfig',
        'systemConfig', 'envConfig', 'infoConfig', 'cronjobsConfig'
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
    
    
    // solutions
    public function solutionAffiliatesConfig() {
        $config = array();
        if ($this->tableExists('partner_config')) {
            $config = $this->sql->getById('partner_config', '*', 1);
        }
        return $this->genericFillConfig('affiliates', $config);
    }
    
    public function solutionArticlesConfig() {
        $config = array();
        if ($this->tableExists('articles_config')) {
            $config = $this->sql->getById('articles_config', '*', 1);
        }
        return $this->genericFillConfig('articles', $config);
    }
    
    public function solutionCaptchaConfig() {
        $config = array();
        if ($this->tableExists('captcha_config')) {
            $config = $this->sql->getById('captcha_config', '*', 1);
        }
        return $this->genericFillConfig('captcha', $config);
    }
    public function solutionDownloadsConfig() {
        $config = array();
        if ($this->tableExists('dl_config')) {
            $config = $this->sql->getById('dl_config', '*', 1);
        }
        return $this->genericFillConfig('downloads', $config);        
    }
    public function solutionGalleryConfig() {
        $config = array();
        if ($this->tableExists('screen_config')) {
            $config = $this->sql->getById('screen_config', '*', 1);
        }
        return $this->genericFillConfig('screens', $config); 
    }
    public function solutionGroupsConfig() {
        $config = array();
        if ($this->tableExists('user_config')) {
            $config = $this->sql->getById('user_config', '*', 1);
        }
        return $this->genericFillConfig('groups', $config); 
    }   
    public function solutionMainConfig() {
        $config = array();
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
                if (false !== $style_id = $this->sql->getById('styles', array('style_id'), $config['style_tag'], 'style_tag')) {
                    $config['style_id'] = $style_id;
                }
            }
        }
        
        // overwrite version
        $config['version'] = '2.alix6';
        
        // not possible in property
        if (!isset($config['timezone']) || empty($config['timezone'])) {
            $config['timezone'] = @date_default_timezone_get();
        }
        
        return $this->genericFillConfig('main', $config, 'startup');         
    }
    public function solutionNewsConfig() {
        $config = array();
        if ($this->tableExists('news_config')) {
            $config = $this->sql->getById('news_config', '*', 1);
        }
        return $this->genericFillConfig('news', $config);         
    }
    public function solutionPollsConfig() {
        $config = array();
        if ($this->tableExists('poll_config')) {
            $config = $this->sql->getById('poll_config', '*', 1);
        }
        return $this->genericFillConfig('polls', $config);          
    }
    public function solutionPressConfig() {
        $config = array();
        if ($this->tableExists('press_config')) {
            $config = $this->sql->getById('press_config', '*', 1);
        }
        return $this->genericFillConfig('press', $config);          
    }
    public function solutionPreviewImagesConfig() {
        $config = array();
        if ($this->tableExists('screen_random_config')) {
            $config = $this->sql->getById('screen_random_config', '*', 1);
        }
        if ($this->tableExists('global_config')) {
            $timed_deltime = $this->sql->getFieldById('global_config', 'random_timed_deltime', 1);
            if (!empty($timed_deltime))
                $config['timed_deltime'] = $timed_deltime;
        }
        return $this->genericFillConfig('preview_images', $config);              
    }
    public function solutionSearchConfig() {
        $config = array();
        if ($this->tableExists('search_config')) {
            $config = $this->sql->getById('search_config', '*', 1);
        }
        return $this->genericFillConfig('search', $config);              
    }
    public function solutionUsersConfig() {
        $config = array();
        if ($this->tableExists('user_config')) {
            $config = $this->sql->getById('user_config', '*', 1);
        }
        return $this->genericFillConfig('users', $config);          
    }
    public function solutionVideoPlayerConfig() {
        $config = array();
        if ($this->tableExists('player_config')) {
            $config = $this->sql->getById('player_config', '*', 1);
            
            // prepend colors with #
            $colors = array('cfg_buffercolor','cfg_bufferbgcolor','cfg_titlecolor','cfg_playercolor','cfg_loadingcolor','cfg_bgcolor','cfg_bgcolor1','cfg_bgcolor2','cfg_buttoncolor','cfg_buttonovercolor','cfg_slidercolor1','cfg_slidercolor2','cfg_sliderovercolor','cfg_videobgcolor','cfg_iconplaycolor','cfg_iconplaybgcolor');
            foreach($config as $key => $value) {
                if (in_array($key, $colors)) {
                    $config[$key] = '#'.$value;
                }
            }
        }
        return $this->genericFillConfig('video_player', $config);          
    }
    
    public function solutionSystemConfig() {
        return $this->genericFillConfig('system', array(), 'startup');
    }
    public function solutionEnvConfig() {
        return $this->genericFillConfig('env', array(), 'startup');
    }
    public function solutionInfoConfig() {
        return $this->genericFillConfig('info', array(), 'startup');
    }
    public function solutionCronjobsConfig() {
        return $this->genericFillConfig('cronjobs', array(), 'startup');
    }
    
	// generic config tester
    private function genericConfigTester($name) {
        $config = $this->sql->getFieldById('config', 'config_name', $name, 'config_name');
        if (empty($config))
            return false;
        return true;
    }
    
    // generic config filler
    public function genericFillConfig($name, $old, $loadhook = 'none') {
        //data-array
        $data = $this->getDataArray($name);
        
        // filter and fill with default config value
        $defaultConfig = $name.'Config';
        $config = array_intersect_key($old, $this->$defaultConfig);
        $config = $config+$this->$defaultConfig;
        
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
    // `frogsystem_alix5`.`fs2_screen_random_config`
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
        'captcha_bg_color' => 'FAFCF1',
        'captcha_bg_transparent' => '0',
        'captcha_text_color' => 'AB30AB',
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
        'dyn_title_ext' => '{title} - {ext}',
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
        'timezone' => '',
        'auto_forward' => '4',
        'search_index_update' => '2',
        'search_index_time' => '1340746339',
        'version' => '2.alix6',
        'url_style' => 'default',
        'count_referers' => '1',
        'date' => 'd.m.Y',
        'time' => 'H:i \U\h\r',
        'datetime' => 'd.m.Y, H:i \U\h\r',
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
}

?>
