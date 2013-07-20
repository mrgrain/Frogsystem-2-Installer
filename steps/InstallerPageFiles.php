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
        $runner = new FileRunner('jobs/files/', UPGRADE_FROM, UPGRADE_TO, $this->lang);
        $inst_list = array();
        $all_success = true;
        foreach($runner as $inst) {
            // images
            $img_path = 'styles/'.$this->tpl->getStyle().'/images/';
            $this->ic->addText('success_img', $img_path.'ok.gif');
            $this->ic->addText('error_img', $img_path.'error.gif');          
            
            $writable = $runner->isWritable($runner->current());
            $all_success = $all_success && $writable;
            $this->ic->addCond('error', !$writable);
            //~ $this->ic->addCond('success', $writable);   // don't show the image, to not confuse the user  
            $this->ic->addText('error_message', $this->lang->get('target_not_writable')); 
            $this->ic->addText('instruction', $runner->getCurrentInfo());
            $inst_list[] = $this->ic->get('instruction_element');            
        }  
        
        $this->ic->addCond('error', !$all_success);           
        $this->ic->addCond('success', $all_success);           
        $this->ic->addText('url_next', '?step=fileOperations');
        $this->ic->addText('url_self', '?step=files');
        $this->ic->addText('url_skip', '?step=cleanup');
        $this->ic->addText('instruction_list', implode(PHP_EOL, $inst_list));
        print $this->ic->get('file_info');        
    }
}
?>
