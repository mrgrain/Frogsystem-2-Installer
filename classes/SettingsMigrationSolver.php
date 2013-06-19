<?php
/**
 * @file     SettingsMigrationSolver.php
 * @folder   /classes
 * @version  0.1
 * @author   Sweil
 *
 * migrate existing settings from updated versions
 */
class SettingsMigrationSolver extends Solver {
    
    private $sql;
    private $configs = array(
		'affiliates', 'articles', 'captcha', 'downloads', 'gallery', 
		'groups', 'main', 'news', 'polls', 'press', 'previewImages', 
		'search', 'users', 'videoPlayer'
	);
    
    public function __construct($sql) {
        $this->sql = $sql;
    }
    
    /* Default tests & solutions */             
    public function getDefaultTests() {
        return $this->getTests();
    }    
    public function getDefaultSolutions() {
        return $this->getSolutions();
    } 
    
    // 
    
    
    // test for old configs
    public function testArticlesConfig() {
		return genericConfigTester('articles_config', 'articles');
    }
    public function testCaptchaConfig() {
		return genericConfigTester('captcha_config', 'captcha');
    }
    public function testDownloadsConfig() {
		return genericConfigTester('dl_config', 'downloads');
    }
    public function testMainConfig() {
		return genericConfigTester('global_config', 'main');
    }
    public function testNewsConfig() {
		return genericConfigTester('news_config', 'news');
    }
    public function testAffiliatesConfig() {
		return genericConfigTester('partner_config', 'affiliates');
    }
    public function testVideoPlayerConfig() {
		return genericConfigTester('player_config', 'video_player');
    }
    public function testPollsConfig() {
		return genericConfigTester('poll_config', 'polls');
    }
    public function testPressConfig() {
		return genericConfigTester('press_config', 'press');
    }
    public function testGalleryConfig() {
		return genericConfigTester('screen_config', 'screens');
    }
    public function testPreviewImagesConfig() {
		return genericConfigTester('screen_random_config', 'preview_images');
    }
    public function testSearchConfig() {
		return genericConfigTester('search_config', 'search');
    }
    public function testUsersConfig() {
		return genericConfigTester('user_config', 'users');
    }
    public function testGroupsConfig() {
		return genericConfigTester('user_config', 'groups');
    }
    
    
    // solvers
    public function solutionSaveAdminFromPost() {
		// unset error
		$this->error = array();
		     
        // check post and Save to File
        if (isset($_POST['setup_admin'])) {
			
			// check errors
			if (!(isset($_POST['user']) && trim($_POST['user']) != '' && strlen(trim($_POST['user'])) > 4)) {
				$this->error[] = 'user';
			} else if (!$this->testUserExists($_POST['user'])) {
				$this->error[] = 'user_exists';
			}
			if (!(isset($_POST['pass']) && trim($_POST['pass']) != '' && strlen(trim($_POST['pass'])) > 4)) {
				$this->error[] = 'pass';
			}
			if (!(isset($_POST['mail']) && trim($_POST['mail']) != '' && strpos($_POST['mail'], '@') !== false)) {
				$this->error[] = 'mail';
			} else if (!$this->testMailExists($_POST['mail'])) {
				$this->error[] = 'mail_exists';
			}

			// quit on form error;
			if (!empty($this->error)) {
				return false;
			}

			// create dataset
            $salt = InstallerFunctions::getRandomCode(10);
			$pass = md5 ( $_POST['pass'].$salt );            
            $id = $this->sql->insertId('user', array(
                'user_name' => $_POST['user'],
                'user_password' => $pass,
                'user_salt' => $salt,
                'user_mail' => $_POST['mail'],
                'user_is_staff' => 1,
                'user_group' => 0,
                'user_is_admin' => 1,
                'user_reg_date' => time()));
                
			$this->sql->doQuery('UPDATE {..pref..}user SET `user_id` = 1 WHERE `user_id` = '.$id);
            return true;
        }
        return false;
    }
    
	// generic config tester
    public function genericConfigTester($old, $new) {
		$table = $this->sql->doQuery("SHOW TABLES LIKE '{..pref..}".$old."'");
		if (!empty($table)) {
			$config = $this->sql->getFieldById('config', 'config_name', $new, 'config_name');
			if (empty($config))
				return false;
		}
        return true;
    }
     
}

?>
