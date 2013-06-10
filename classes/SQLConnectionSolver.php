<?php
/**
 * @file     SQLConnectionSolver.php
 * @folder   /classes
 * @version  0.3
 * @author   Sweil
 *
 * this class checks the databese connection and provides
 * some solutions to create one
 */
class SQLConnectionSolver extends Solver {
    
    private $ic;
    private $sqlError; 
    private $sqlErrorNo; 
    
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
            
            unset($_SESSION['db_instructions']);
            return false;  
        }
        return true;
    }
    
    public function testDBConnectionFromSession() {
        // reset sql error
        $this->setError(null, null);
        
        // data exists?
        if (!$this->testSessionData()) {
            return false;  
        }
        
        try {
            $sql = new sql($_SESSION['dbc']['host'], $_SESSION['dbc']['data'], $_SESSION['dbc']['user'], $_SESSION['dbc']['pass'], $_SESSION['dbc']['pref']);
        } catch (Exception $e) {
            $this->setError($e->getMessage(), $e->getCode());
            unset($_SESSION['dbc'], $sql);
            return false;
        }
        unset($sql);
        return true;
    }
    
    /* Run all the solutions in this order */
    public function solutionFromPostToDBConnectionFile() {
        $this->setError(null, null);
        
        // check post and Save to File
        if (isset($_POST['db_from_form'])) {
                try {
                    $sql = new sql($_POST['db_host'], $_POST['db_data'], $_POST['db_user'], $_POST['db_pass'], $_POST['db_pref']);
                    unset($sql);
                    InstallerFunctions::writeDBConnectionFile($_POST['db_host'], $_POST['db_user'], $_POST['db_pass'], $_POST['db_data'], $_POST['db_pref']);
                    require(INSTALLER_PATH.'copy/db_connection.php');
                    $_SESSION['dbc'] = $dbc;
                    unset($dbc);
                    return true;
                } catch (Exception $e) {
                    $this->setError($e->getMessage(), $e->getCode());
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
        if (false !== $dbc = UpgradeFunctions::getOldDBConnection(UPGRADE_FROM)) {
            $_SESSION['dbc'] = $dbc;
            return true;
        }
        return false;
    }
    
    public function solutionShowForm() {
        //prefill form
        if (isset($_POST['db_from_form'])) {
            $dbc = array('db_host' => null, 'db_data' => null, 'db_user' => null, 'db_pass' => null, 'db_pref' => null);
            $dbc = InstallerFunctions::killhtml($_POST) + $dbc;
            $this->ic->addText('sql_host', $dbc['db_host']);
            $this->ic->addText('sql_data', $dbc['db_data']);
            $this->ic->addText('sql_user', $dbc['db_user']);
            $this->ic->addText('sql_pass', $dbc['db_pass']);        
            $this->ic->addText('sql_pref', $dbc['db_pref']);   
        } elseif ($this->solutionDBConnectionFile() || $this->solutionFromFSInstallation()) {
            $_SESSION['dbc'] = InstallerFunctions::killhtml($_SESSION['dbc']);
            $this->ic->addText('sql_host', $_SESSION['dbc']['host']);
            $this->ic->addText('sql_data', $_SESSION['dbc']['data']);
            $this->ic->addText('sql_user', $_SESSION['dbc']['user']);
            $this->ic->addText('sql_pass', $_SESSION['dbc']['pass']);        
            $this->ic->addText('sql_pref', $_SESSION['dbc']['pref']);
            $this->ic->addCond('sql_prefill', true);
        }
        
        // delete session
        unset($_SESSION['dbc'], $_SESSION['db_instructions']);
        
        // show form
        $this->ic->addCond('sql_error', !is_null($this->sqlError));
        switch ($this->sqlErrorNo) {
            case 'table_duplicates':
                $this->ic->addCond('table_duplicates', true);
                $this->ic->addCond('sql_error', false);
                $this->ic->addText('table_duplicates', $this->sqlError);
                break;
            case 2002:
                $this->ic->addCond('sql_host_error', true);
                $this->ic->addText('sql_connection_error', $this->ic->getLang()->get('sql_host_error'));
                break;
            case 1044:
                $this->ic->addCond('sql_database_error', true);
                $this->ic->addText('sql_connection_error', $this->ic->getLang()->get('sql_database_error'));
                break;
            case 1045:
                $this->ic->addCond('sql_userpw_error', true);
                $this->ic->addText('sql_connection_error', $this->ic->getLang()->get('sql_userpw_error'));
                break;
            default:
                $this->ic->addCond('sql_default_error', true);
                $this->ic->addText('sql_connection_error', $this->ic->getLang()->get('sql_default_error'));
                break;
        }
             
        
        $this->setError(null, null);
        print $this->ic->get('sqlconnection');
        return false;
    }
    
    
    public function setError($msg, $no) {
        $this->sqlError = $msg;
        $this->sqlErrorNo = $no;
    }
}

?>
