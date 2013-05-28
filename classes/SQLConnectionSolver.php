<?php
/**
 * @file     SQLConnectionSolver.php
 * @folder   /classes
 * @version  0.2
 * @author   Sweil
 *
 * this class checks the databese connection and provides
 * some solutions to create one
 */
class SQLConnectionSolver extends Solver {
    
    private $ic;
    private $sqlError; 
    
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
        // reset sql error
        $this->sqlError = null;
        
        // data exists?
        if (!$this->testSessionData()) {
            return false;  
        }
        
        try {
            $sql = new sql($_SESSION['dbc']['host'], $_SESSION['dbc']['data'], $_SESSION['dbc']['user'], $_SESSION['dbc']['pass'], $_SESSION['dbc']['pref']);
        } catch (Exception $e) {
            $this->sqlError = $e->getCode().": ".$e->getMessage();
            unset($sql);
            return false;
        }
        unset($sql);
        return true;
    }
    
    /* Run all the solutions in this order */
    public function solutionFromPostToDBConnectionFile() {$this->sqlError = null;
        // check post and Save to File
        if (isset($_POST['db_host']) && isset($_POST['db_data']) && isset($_POST['db_user']) && isset($_POST['db_pass']) && isset($_POST['db_pref'])
            && !empty($_POST['db_host']) && !empty($_POST['db_user'])&& !empty($_POST['db_data'])) {
                try {
                    $sql = new sql($_POST['db_host'], $_POST['db_data'], $_POST['db_user'], $_POST['db_pass'], $_POST['db_pref']);
                    unset($sql);
                    InstallerFunctions::writeDBConnectionFile($_POST['db_host'], $_POST['db_user'], $_POST['db_pass'], $_POST['db_data'], $_POST['db_pref']);
                    require(INSTALLER_PATH.'copy/db_connection.php');
                    $_SESSION['dbc'] = $dbc;
                    unset($dbc);
                    return true;
                } catch (Exception $e) {
                    $this->sqlError = $e->getCode().": ".$e->getMessage();
                    unset($sql);
                    return false;
                }
        } else {
            return false;
        }
    }    
    
    public function solutionDBConnectionFile() {
        // check copy file
        require(INSTALLER_PATH.'copy/db_connection.php');
        if ($dbc && !empty($dbc['type']) && !empty($dbc['host']) && !empty($dbc['user']) && !empty($dbc['data'])) {
            $_SESSION['dbc'] = $dbc;
            return true;
        }
        return false;
    }
    
    public function solutionFromFSInstallation() {
        // check old fs installations
        if (isset($_SESSION['upgrade_from']) && false !== $dbc = UpgradeFunctions::getOldDBConnection($_SESSION['upgrade_from'])) {
            $_SESSION['dbc'] = $dbc;
            return true;
        }
        return false;
    }
    
    public function solutionShowForm() {
        // show form
        $this->ic->addCond('sql_error', !is_null($this->sqlError));
        $this->ic->addText('sql_connection_error', $this->sqlError);        
        
        $this->sqlError = null;
        print $this->ic->get('sqlconnection');
        return false;
    }
}

?>
