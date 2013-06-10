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
    public function testAdminExists() {
        $id = $this->sql->getFieldById('user', 'user_id', 1, 'user_id');
        if (empty($id))
            return false;
        
        return true;
    }
    
    // solvers
    public function solutionSaveAdminFromPost() {        
        // check post and Save to File
        if (isset($_POST['setup_admin'])) {
            $salt = generate_spamcode ( 10 );
        $user_salt = generate_spamcode ( 10 );
        $userpass = md5 ( $_POST['admin_pass'].$user_salt );            
            $sql->insertId('user', array(
                'user_name' => $_POST['user'],
                'user_password' => $_POST['pass'],
                'user_salt' => $_POST['pass'],
                'user_mail' => $_POST['mail'],
                'user_is_staff' => 1,
                'user_group' => 0,
                'user_is_admin' => 1,
                'user_reg_date' => time(),
                
        }
        return false;
    }

    public function solutionShowForm() {
        print $this->ic->get('superadmin');
        return false;
    }        
}

?>
