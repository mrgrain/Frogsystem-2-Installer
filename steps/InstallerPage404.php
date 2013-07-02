<?php
/**
* @file     InstallerPage404.php
* @folder   /steps
* @version  0.1
* @author   Sweil
*
* 404 Error Page
*/
class InstallerPage404 extends InstallerPage {
    
    public function __construct() {
        parent::__construct();
        $this->lang = new InstallerLang($this->local, 'errors');
        $this->setTitle('error404_title');
    }
    
    protected function show() {
        print $this->getICObject('errors.tpl')->get('notfound');
    }
}

?>
