<?php
/**
* @file     InstallerPageDatabaseUnslasher.php
* @folder   /steps
* @version  0.1
* @author   Sweil
*
* page for unslashing a whole fs2-database of version 2.alix6
*/
class InstallerPageDatabaseUnslasher extends SelfReloadingInstallerPage {
    
    private $ic;
    protected $result = array();
    private $success = true;
    
    public function __construct() {
        parent::__construct();
        $this->lang = new InstallerLang($this->local, 'database');
        $this->setTitle('database_title');
        $this->ic = $this->getICObject('database.tpl');
        
        // check to header instantly
        if (UPGRADE_FROM == 'none' || !InstallerFunctions::compareFS2Versions(UPGRADE_FROM, '2.alix6') < 0) {
            // nothing todo => go to setup
            header("location: {$_SERVER['PHP_SELF']}?step=setup"); // redirect
            exit;
        }        
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
            $runner = new UnslasherRunner($sql);
            $checkReset = true;
            
            foreach($runner as $pos => $inst) {
				// break out
				if ($this->isDone()) { break; }	
                
				// set next step
				if ($checkReset && !$this->isFirstRun()) {
					$runner->setCurrent($this->getNext()-1);
                    $checkReset = false;
					continue;
				}
				$this->setNext($pos+1);

				// create ouptput 
                $info = $runner->getCurrentInfo();
                $this->ic->addText('instruction', sprintf($this->lang->get('unslasher_info'), $info[0], $info[1], $info[2]));
                
                // images
                $img_path = 'styles/'.$this->tpl->getStyle().'/images/';
                $this->ic->addText('success_img', $img_path.'ok.gif');
                $this->ic->addText('error_img', $img_path.'error.gif');                
                
                //execute instruction
				try {
					if (!$runner->runCurrentInstruction()) {
                        // reset to run that one again
                        $runner->setCurrent($pos-1);
                    }
					$this->ic->addCond('success', true);
				} catch (Exception $e) {
                    $this->ic->addCond('error', true);
                    $this->ic->addText('error_message', $e->getMessage());
                    $this->success = false;
				}
				$this->addResult($this->ic->get('sqlinstructions_info_element'));

				// done?
				if ($runner->getLastKey() == $pos) {
					$this->done();
					break;
				}
                
                // redirect (or not)
                if ($this->needReload()) {
                    break;
                }
            }

			// show output
            if ($this->isDone()) {
                $this->ic->addCond('done', true);
                $this->ic->addText('url', '?step=setup');  
                $this->ic->addText('url_self', '?step=databaseUnslasher');
                unset($_SESSION['unslasher_start']);
            } else {
                $this->ic->addText('url', $this->getUrl($this->getNext()));
            }
            $this->ic->addCond('all_successful', $this->success);
            $this->ic->addText('total_runtime', sprintf('%.3f', $this->getRuntime()));
            $this->ic->addText('instruction_list', implode(PHP_EOL, $this->getResult()));
            print $this->ic->get('sql_unslasher');
            
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
		return $_SERVER['PHP_SELF']."?step=databaseUnslasher&next={$next}";
	}
}
?>
