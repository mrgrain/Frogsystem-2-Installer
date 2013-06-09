<?php
/**
* @file     InstallerPageDatabaseOperations.php
* @folder   /steps
* @version  0.1
* @author   Sweil
*
* page for database operations
*/
class InstallerPageDatabaseOperations extends SelfReloadingInstallerPage {
    
    private $ic;
    protected $result = array();
    private $success = true;
    
    public function __construct() {
        parent::__construct();
        $this->setTitle('database_title');
        $this->ic = $this->getICObject('database.tpl');
        unset($_SESSION['db_instructions']); // from previous step
    }
    
    protected function show() {
        // check SQL Connection
        $solver = new SQLConnectionSolver($this->ic);
        $solutions = $solver->getSolutions();
        array_pop($solutions); // dont show form
        if (!$solver->solve($solutions)) { 
			header("location: {$_SERVER['PHP_SELF']}?step=database"); // redirect
			return;
		}
                
        //check connection from session
        try {
            $sql = new sql($_SESSION['dbc']['host'], $_SESSION['dbc']['data'], $_SESSION['dbc']['user'], $_SESSION['dbc']['pass'], $_SESSION['dbc']['pref']);
            $runner = new SQLRunner('jobs/sql/', $_SESSION['upgrade_from'], $_SESSION['upgrade_to'], $sql);

            foreach($runner as $pos => $inst) {
				// break out
				if ($this->isDone()) { break; }	

				// set next step
				if (!$this->isFirstRun()) {print_r($this->getNext().'--------');
					$runner->setCurrent($this->getNext()-1);
					continue;
				}
				$this->setNext($pos+1);
				
				// execute instructions & create ouptput 
                $this->ic->addText('instruction', $runner->getCurrentInfo());
				try {
					$runner->runCurrentInstruction();
					$this->ic->addCond('success', true);
				} catch (Exception $e) {
                    $this->ic->addCond('error', true);
                    $this->success = false;
				}
				$this->addResult($this->ic->get('sqlinstructions_info_element'));
				
				// done?
				if ($runner->getLastKey() == $pos) {
					$this->done();
					break;
				}
            }

			// show output
            if ($this->isDone()) {
                $this->ic->addCond('done', true);
                $this->ic->addText('url', '?step=setup');  
                $this->ic->addText('url_self', '?step=databaseOperations');  
            } else {
                $this->ic->addText('url', $this->getUrl($this->getNext()));
            }
            $this->ic->addCond('all_successful', $this->success);
            $this->ic->addText('total_runtime', sprintf('%.3f', $this->getRuntime()));
            $this->ic->addText('instruction_list', implode(PHP_EOL, $this->getResult()));
            print $this->ic->get('sql_runner');
            
			// redirect (or not)
			$this->reload();
        } catch (Exception $e) {
            header("location: {$_SERVER['PHP_SELF']}?step=database");
            exit;
        }

		// call last to reset session if neccessary                  
        $this->finish();        
    }
    
   	private function addResult($result) {
		$this->result[] = $result;
	}
	
   	protected function getUrl($next) {
		return $_SERVER['PHP_SELF']."?step=databaseOperations&amp;next={$next}";
	}
}
?>
