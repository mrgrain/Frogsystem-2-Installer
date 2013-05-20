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
    
    public function __construct() {
        parent::__construct();
        $this->setTitle('database_title');
        $this->ic = $this->getICObject('database.tpl');
        $this->result = array();
        
        unset($_SESSION['dbc']); // testing
    }
    
    protected function show() {
        // check SQL Connection
        $checker = new SQLConnectionChecker($this->ic);
        $solutions = $checker->getSolutions();
        array_pop($solutions);
        if (!$checker->solve($solutions)) { 
			header("location: {$_SERVER['PHP_SELF']}?step=database");
			exit;
		}
                
        //check connection from session
        try {
            $sql = new sql($_SESSION['dbc']['host'], $_SESSION['dbc']['data'], $_SESSION['dbc']['user'], $_SESSION['dbc']['pass'], $_SESSION['dbc']['pref']);
            $runner = new SQLRunner('jobs/sql/', $_SESSION['update_from'], $_SESSION['update_to'], $sql);
            var_dump($this->getResult());
            $inst_list = array();
            foreach($runner as $pos => $inst) {
				// break out
				if ($this->isDone()) { break; }	
							
				print_r($pos.'<br>');
				// set next step
				if (!$this->isFirstRun()) {print_r($this->getNext().'--------');
					$runner->setCurrent($this->getNext()-1);
					continue;
				}
				$this->setNext($pos+1);
				
				// create ouptput
				ob_start();
				print('<p>');
				print(($pos+1).'. '.$runner->getCurrentInfo().': ');
				try {
					var_dump($runner->runCurrentInstruction());
					print("okay");
				} catch (Exception $e) {
				   print("error (".$e->getMessage().")"); 
				}
				print('</p>');
				$html = ob_get_clean();
				$this->addResult($html);
				
				// done?
				if ($runner->getLastKey() == $pos) {
					$this->done();
					break;
				}
            }
            
			// show output
			foreach($this->getResult() as $html) {
				print $html;
			}

			// show time data
			print "<p>Max Runtime per Reload: {$this->getMaxRuntime()}<br>Total Runtime: {$this->getRuntime()}</p>";
			print "<p><a href=\"{$this->getUrl($this->getNext())}\">Fortsetzen</a></p>";
		
			// redirect
			$this->reload();
			          
        } catch (Exception $e) {
            header("location: {$_SERVER['PHP_SELF']}?step=database");
            exit;
        }        
    }
    
   	private function addResult($result) {
		$this->result[] = $result;
	}
	
   	protected function getUrl($next) {
		return $_SERVER['PHP_SELF']."?step=databaseOperations&amp;next={$next}";
	}
}
?>
