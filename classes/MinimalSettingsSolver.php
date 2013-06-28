<?php
/**
 * @file     MinimalSettingsSolver.php
 * @folder   /classes
 * @version  0.1
 * @author   Sweil
 *
 * ensuring we have valid settings to use the page
 */
class MinimalSettingsSolver extends Solver {
    
    private $sql;
    private $ic;
    private $error = array();
    
    public function __construct($ic, $sql) {
        $this->ic = $ic;
        $this->sql = $sql;
    }
    
    /* Default tests & solutions */             
    public function getDefaultTests() {
        return $this->getTests();
    }    
    public function getDefaultSolutions() {
        return $this->getSolutions();
    } 
    
    
    // test for existing admin
    public function testDataSaved() {
        return isset($_SESSION['minimal_settings']);
    }
    
    
    // solvers
    public function solutionSaveSettingsFromPost() {
		// unset error
		$this->error = array();
		     
        // check post and Save to File
        if (isset($_POST['minimal_settings'])) {
            
			// check errors
			if (!(isset($_POST['title']) && trim($_POST['title']) != '')) {
				$this->error[] = 'title';
			} 
			if (!(isset($_POST['url']) && trim($_POST['url']))
                || !(isset($_POST['protocol']) && trim($_POST['protocol']))) {
				$this->error[] = 'url';
			}
			if (!(isset($_POST['admin_mail']) && trim($_POST['admin_mail']) != '' && strpos($_POST['admin_mail'], '@') !== false)) {
				$this->error[] = 'admin_mail';
			}
			if (!(isset($_POST['url_style']) && in_array($_POST['url_style'], array('default', 'seo')))) {
				$this->error[] = 'url_style';
			}
			if (!(isset($_POST['timezone']) && trim($_POST['timezone']) != '')) {
				$this->error[] = 'timezone';
			} 

			// quit on form error;
			if (!empty($this->error)) {
				return false;
			}
            
            // kick any wrong values
            $data = array('title' => null, 'protocol' => null, 'url' => null, 'admin_mail' => null, 'url_style' => null, 'timezone' => null);
            $_POST = array_intersect_key($_POST, $data);
            
            // add trailing slash to url
            if (substr($_POST['url'], -1) != '/') {
                $_POST['url'] = $_POST['url'].'/';
            }

			// update data           
            $main = $this->sql->getFieldById('config', 'config_data', 'main', 'config_name');
            $main = InstallerFunctions::json_array_decode($main);
            $main = InstallerFunctions::json_array_encode($_POST+$main);
            
            $this->sql->save('config', array('config_name' => 'main', 'config_data' => $main), 'config_name', false);
            $_SESSION['minimal_settings'] = true;
            return true;
        }
        return false;
    }

    public function solutionShowForm() {
		// error handling
		$errors = array();
		if (in_array('title', $this->error)) {
			$this->ic->addCond('title_error', true);
            $errors[] = $this->ic->getLang()->get('settings_title_empty_error');
		}
		if (in_array('url', $this->error)) {
			$this->ic->addCond('url_error', true);
			$errors[] = $this->ic->getLang()->get('settings_url_empty_error');
		}
		if (in_array('admin_mail', $this->error)) {
			$this->ic->addCond('admin_mail_error', true);
			$errors[] = $this->ic->getLang()->get('settings_admin_mail_error');
		}
		if (in_array('url_style', $this->error)) {
			$this->ic->addCond('url_style_error', true);
			$errors[] = $this->ic->getLang()->get('settings_url_style_error');
		}
		if (in_array('timezone', $this->error)) {
			$this->ic->addCond('timezone_error', true);
			$errors[] = $this->ic->getLang()->get('settings_timezone_error');
		}

		if (!empty($this->error)) {
			$this->ic->addCond('form_error', true);
			$this->ic->addText('settings_form_error', implode('<br>'.PHP_EOL, $errors));			
		}
 
        //prefill form
        $data = array('title' => null, 'protocol' => null, 'url' => null, 'admin_mail' => null, 'url_style' => null, 'timezone' => null);

        // from post
        if (isset($_POST['minimal_settings'])) {       
            $data = InstallerFunctions::killhtml(array_intersect_key($_POST, $data)) + $data;
            
        // from database
        } else {
            $main = $this->sql->getFieldById('config', 'config_data', 'main', 'config_name');
            $main = InstallerFunctions::json_array_decode($main);
            $data = InstallerFunctions::killhtml(array_intersect_key($main, $data)) + $data;
            
            // guess url if empty
            if(empty($data['url'])) {
                // guess one folder up
                $scriptlist = explode('/',$_SERVER['PHP_SELF']);
                $scriptname = end($scriptlist);
                $scriptpath = str_replace('/'.INSTALLER_LOCATION.'a/'.$scriptname,'',$_SERVER['PHP_SELF']);
                
                // guess direct in domain
                if ($scriptpath == $_SERVER['PHP_SELF'])
                    $scriptpath = "";
                
                // guess from install_to TODO
                    
                // prefill
                $data['url'] = $_SERVER['SERVER_NAME'].$scriptpath;
            }
            
            // guess admin_mail if empty
            if(empty($data['admin_mail'])) {
                $mail = $this->sql->getFieldById('user', 'user_mail', 1, 'user_id');
                if (!empty($mail)) 
                    $data['admin_mail'] = $mail;
            }
            
            // guess timezone if empty
            if(empty($data['timezone'])) {
                $data['timezone'] = date_default_timezone_get(); // in worst case this is UTC
            }            
        }
        
        // add trailing slash to url
        if (substr($data['url'], -1) != '/') {
            $data['url'] = $data['url'].'/';
        }        
        
		// show stuff
        $this->ic->addText('title', $data['title']);
        $this->ic->addCond('protocol_http', $data['protocol'] === 'http://');
        $this->ic->addCond('protocol_https', $data['protocol'] === 'https://');
        $this->ic->addText('url', $data['url']);
        $this->ic->addText('admin_mail', $data['admin_mail']);
        $this->ic->addCond('url_style_default', $data['url_style'] === 'default');
        $this->ic->addCond('url_style_seo', $data['url_style'] === 'seo');        
        
        //timezones
        $timezone_options = '<option value="UTC"'.('UTC' == $data['timezone']?'selected':'').'>UTC</option>'.PHP_EOL;
        foreach(InstallerFunctions::get_timezones() as $timezone => $val) {
                $timezone_options .= '<option value="'.$timezone.'" '
                .($timezone == $data['timezone']?'selected':'')
                .'>'.$timezone.'</option>'.PHP_EOL;
        }
        $this->ic->addText('timezones', $timezone_options);        
        
        print $this->ic->get('settings');
        return false;
    }        
}

?>
