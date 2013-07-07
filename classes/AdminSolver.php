<?php
/**
 * @file     AdminSolver.php
 * @folder   /classes
 * @version  0.1
 * @author   Sweil
 *
 * ensuring we have a valid superadmin
 */
class AdminSolver extends Solver {
    
    private $sql;
    private $ic;
    private $error = array();
    private $isNew = false;
    private $user = null;
    private $mail = null;
    private $password = null;
    
    public function __construct($ic, $sql) {
        $this->ic = $ic;
        $this->sql = $sql;
    }
    
    /* Default tests & solutions */             
    public function getDefaultTests() {
        return array('testAdminExists');
    }    
    public function getDefaultSolutions() {
        return $this->getSolutions();
    } 
    
    // access on admin data
    public function isNew() {
        return $this->isNew;
    }
    public function getUser() {
        return $this->user;
    }
    public function getMail() {
        return $this->mail;
    }
    public function getPassword() {
        return $this->password;
    }
    
    // test for existing admin
    public function testAdminExists() {
        $id = $this->sql->getFieldById('user', 'user_id', 1, 'user_id');
        if (empty($id))
            return false;
        
        return true;
    }
    
    public function testUserExists($name) {
		if (empty($name))
            return false;
            
        $id = $this->sql->getFieldById('user', 'user_id', $name, 'user_name');
        if (empty($id))
            return true;
        
        return false;
    }
    
    public function testMailExists($mail) {
		if (empty($mail))
            return false;
            
        $id = $this->sql->getFieldById('user', 'user_id', $mail, 'user_mail');
        if (empty($id))
            return true;
        
        return false;
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
            
            // save in class
            $this->isNew = true;
            $this->user = $_POST['user'];
            $this->mail = $_POST['mail'];
            $this->password = $_POST['pass'];
            
			// create dataset
            $salt = InstallerFunctions::getRandomCode(10);
			$pass = md5 ( $_POST['pass'].$salt );
            unset($_POST['pass']);
            $id = $this->sql->insertId('user', array(
                'user_name' => $_POST['user'],
                'user_password' => $pass,
                'user_salt' => $salt,
                'user_mail' => $_POST['mail'],
                'user_is_staff' => 1,
                'user_group' => 1,
                'user_is_admin' => 1,
                'user_reg_date' => time()));
                
			$this->sql->doQuery('UPDATE {..pref..}user SET `user_id` = 1 WHERE `user_id` = '.$id);
            return true;
        }
        return false;
    }

    public function solutionShowForm() {
		// error handling
		$errors = array();
		if (in_array('user', $this->error)) {
			$this->ic->addCond('user_error', true);
            $errors[] = $this->ic->getLang()->get('superadmin_form_error_user');
		}
		if (in_array('user_exists', $this->error)) {
			$this->ic->addCond('user_error', true);
            $errors[] = $this->ic->getLang()->get('superadmin_form_error_user_exists');
		}
		if (in_array('pass', $this->error)) {
			$this->ic->addCond('pass_error', true);
			$errors[] = $this->ic->getLang()->get('superadmin_form_error_pass');
		}
		if (in_array('mail', $this->error)) {
			$this->ic->addCond('mail_error', true);
			$errors[] = $this->ic->getLang()->get('superadmin_form_error_mail');
		}
		if (in_array('mail_exists', $this->error)) {
			$this->ic->addCond('mail_error', true);
            $errors[] = $this->ic->getLang()->get('superadmin_form_error_mail_exists');
		}
		if (!empty($this->error)) {
			$this->ic->addCond('form_error', true);
			$this->ic->addText('superadmin_form_error', implode('<br>'.PHP_EOL, $errors));			
		}
		
        //prefill form
        if (isset($_POST['setup_admin'])) {
            $data = array('user' => null, 'pass' => null, 'mail' => null);
            $data = InstallerFunctions::killhtml(array_intersect_key($_POST, $data)) + $data;
            $this->ic->addText('user', $data['user']);
            $this->ic->addText('pass', $data['pass']);
            $this->ic->addText('mail', $data['mail']);
        }

        print $this->ic->get('superadmin');
        return false;
    }        
}

?>
