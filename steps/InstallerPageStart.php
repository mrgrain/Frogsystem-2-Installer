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
    }
    
    protected function show() {
        print $this->getICObject('start.tpl')->get('introduction');
    }
}

?>
