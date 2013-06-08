<?php
/**
* @file     InstallerPageStart.php
* @folder   /steps
* @version  0.1
* @author   Sweil
*
* welcome page for installer
*/
class InstallerPageStart extends InstallerPage {
    
    public function __construct() {
        parent::__construct();
        $this->setTitle('start_title');
        unset($_SESSION['dbc']);
    }
    
    protected function show() {
        $ic = $this->getICObject('start.tpl');
        $ic->addText('changelog_text', nl2br($this->lang->get('changelog_text'), false));
        $changelog = $ic->get('changelog');
        $ic->addText('notes_text',     nl2br($this->lang->get('notes_text'), false));
        $notes     = $ic->get('notes');
        $ic->addText('copyright_text', nl2br($this->lang->get('copyright_text'), false));
        $copyright = $ic->get('copyright');
        
        $ic->addText('changelog', $changelog);
        $ic->addText('notes',     $notes);
        $ic->addText('copyright', $copyright);
        print $ic->get('introduction');
    }
}

?>
