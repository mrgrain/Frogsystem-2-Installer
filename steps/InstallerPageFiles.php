<?php
/**
* @file     InstallerPageFiles.php
* @folder   /steps
* @version  0.1
* @author   Sweil
*
* page to copy and move new files
*/
class InstallerPageFiles extends InstallerPage {
    
    private $ic;
    
    public function __construct() {
        parent::__construct();
        $this->lang = new InstallerLang($this->local, 'files');
        $this->setTitle('files_title');
        $this->ic = $this->getICObject('files.tpl');
    }
    
    protected function show() {

        $runner = new FileRunner('jobs/files/', UPGRADE_FROM, UPGRADE_TO);
        $inst_list = array();
        foreach($runner as $inst) {
            var_dump($runner->getCurrentInfo());
        }  
        
        // nothing todo => go to cleanup
        //~ header("location: {$_SERVER['PHP_SELF']}?step=cleanup"); // redirect
        //~ exit;
    }
}
?>
