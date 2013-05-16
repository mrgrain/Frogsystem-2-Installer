<?php
/**
 * @file     SQLConnectionChecker.php
 * @folder   /classes
 * @version  0.1
 * @author   Sweil
 *
 * provides the interface for any checkers
 * a checker is a class which ensures or checks certain circumstances 
 */
class SQLConnectionChecker extends Checker {
    
    private $ic;
    
    public function __construct($ic) {
        $this->ic = $ic;
    }
    
    /* Default tests & solutions */             
    public function getDefaultTests() {
        return array('testDBConnectionFromSession');
    }    
    public function getDefaultSolutions() {
        return $this->getSolutions();
    }    
    
    /* Run all the tests in this order */
    public function testSessionData() {
        // data exists?
        if (!isset($_SESSION['dbc'])
            || !isset($_SESSION['dbc']['host'])
            || !isset($_SESSION['dbc']['data'])
            || !isset($_SESSION['dbc']['user'])
            || !isset($_SESSION['dbc']['pass'])
            || !isset($_SESSION['dbc']['pref'])) {
            return false;  
        }
        return true;
    }
    
    public function testDBConnectionFromSession() {
        // data exists?
        if (!$this->testSessionData()) {
            return false;  
        }
        
        try {
            $sql = new sql($_SESSION['dbc']['host'], $_SESSION['dbc']['data'], $_SESSION['dbc']['user'], $_SESSION['dbc']['pass'], $_SESSION['dbc']['pref']);
        } catch (Exception $e) {
            unset($sql);
            return false;
        }
        unset($sql);
        return true;
    }
    
    /* Run all the solutions in this order */
    public function solutionFromPostToDBConnectionFile() {
        // check post and Save to File
        if (isset($_POST['db_host']) && isset($_POST['db_data']) && isset($_POST['db_user']) && isset($_POST['db_pass']) && isset($_POST['db_pref'])
            && !empty($_POST['db_host']) && !empty($_POST['db_user'])&& !empty($_POST['db_data'])) {
                try {
                    $sql = new sql($_POST['db_host'], $_POST['db_data'], $_POST['db_user'], $_POST['db_pass'], $_POST['db_pref']);
                    unset($sql);
                    InstallerFunctions::writeDBConnectionFile($_POST['db_host'], $_POST['db_user'], $_POST['db_pass'], $_POST['db_data'], $_POST['db_pref']);
                    require(FS2_ROOT_PATH.'copy/db_connection.php');
                    $_SESSION['dbc'] = $dbc;
                    unset($dbc);
                    return true;
                } catch (Exception $e) {
                    return false;
                }
        } else {
            return false;
        }
    }    
    
    public function solutionDBConnectionFile() {
        // check copy file
        require(FS2_ROOT_PATH.'copy/db_connection.php');
        if ($dbc && !empty($dbc['type']) && !empty($dbc['host']) && !empty($dbc['user']) && !empty($dbc['data'])) {
            $_SESSION['dbc'] = $dbc;
            return true;
        }
        return false;
    }
    
    public function solutionFromFSInstallation() {
        // check old fs installations
        if (isset($_SESSION['update_from']) && false !== $dbc = CompatibilityLayer::getOldDBConnection($_SESSION['update_from'])) {
            $_SESSION['dbc'] = $dbc;
            return true;
        }
        return false;
    }
    
    public function solutionShowForm() {
        // show form
        print $this->ic->get('sqlconnection');
        return false;
    }
}

?>
