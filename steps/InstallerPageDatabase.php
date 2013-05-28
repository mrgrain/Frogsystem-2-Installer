<?php
/**
* @file     InstallerPageDatabase.php
* @folder   /steps
* @version  0.1
* @author   Sweil
*
* page for database operations
*/
class InstallerPageDatabase extends InstallerPage {
    
    private $ic;
    
    public function __construct() {
        parent::__construct();
        $this->setTitle('database_title');
        $this->ic = $this->getICObject('database.tpl');
        
        unset($_SESSION['dbc'], $_SESSION['srip']); // testing
    }
    
    protected function show() {
        // check SQL Connection
        $solver = new SQLConnectionSolver($this->ic);
        if (!$solver->solve()) { exit; }
                
        //check connection from session
        try {
            $sql = new sql($_SESSION['dbc']['host'], $_SESSION['dbc']['data'], $_SESSION['dbc']['user'], $_SESSION['dbc']['pass'], $_SESSION['dbc']['pref']);
            $runner = new SQLRunner('jobs/sql/', UPGRADE_FROM, UPGRADE_TO, $sql);
            
            $inst_list = array();
            foreach($runner as $inst) {
                $this->ic->addText('instruction', $runner->getCurrentInfo());
                $inst_list[] = $this->ic->get('sqlinstructions_info_element');
            }
            $this->ic->addText('instruction_list', implode(PHP_EOL, $inst_list));
            $this->ic->addText('url', '?step=databaseOperations');
            print $this->ic->get('sqlinstructions_info');
            
            
        } catch (Exception $e) {
            $solver->solutionShowForm();
            exit;
        }        
    }
}
?>
