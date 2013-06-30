<?php
/**
* @file     InstallerPageTarget.php
* @folder   /steps
* @version  0.1
* @author   Sweil
*
* page to select the installation path
*/
class InstallerPageTarget extends InstallerPage {
    
    private $ic;
    
    public function __construct() {
        parent::__construct();
        $this->lang = new InstallerLang($this->local, 'target');
        $this->setTitle('target_title');
        $this->ic = $this->getICObject('target.tpl');
    }
    
    protected function show() {
        // check input
        if (isset($_POST['set_target']) && isset($_POST['target_path'])) {
            //error empty
            if ("" == trim($_POST['target_path'])) {
                $this->ic->addCond('target_error', true);  
            }
            //error no folder
            elseif (!is_dir($_POST['target_path'])) {
                $this->ic->addCond('target_error', true);  
            }
            
            // check for install update
            elseif(InstallerFunctions::isFrogsystem($_POST['target_path'])) {
                $this->ic->addCond('update', true);
                $this->ic->addCond('target_path', true);
                $_SESSION['install_to'] = $_POST['target_path'];
            } else {
                $this->ic->addCond('installation', true);  
                $this->ic->addCond('target_path', true);
                $_SESSION['install_to'] = $_POST['target_path'];
            }
            
        
        // Session?
        } elseif (isset($_SESSION['install_to'])) {
            $_POST['target_path'] = $_SESSION['install_to'];
        
        // guess data
        } else {
            // guess one folder up
            $scriptlist = explode('/',$_SERVER['PHP_SELF']);
            $scriptname = end($scriptlist);
            $scriptpath = str_replace('/'.INSTALLER_LOCATION.'/'.$scriptname,'',$_SERVER['PHP_SELF']);
                
            // prefill
            $_POST['target_path'] = $_SERVER['DOCUMENT_ROOT'].$scriptpath;

            $this->ic->addCond('target_prefill', true);
        }
        
        // prefill
        $_POST['target_path'] = InstallerFunctions::killhtml($_POST['target_path']);
        $this->ic->addText('target_path', $_POST['target_path']);
        
        // Show template
        print $this->ic->get('target');
    }
}
?>
