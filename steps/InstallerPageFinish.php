<?php
/**
* @file     InstallerPageFinish.php
* @folder   /steps
* @version  0.1
* @author   Sweil
*
* page for displaying final informations
*/
class InstallerPageFinish extends InstallerPage {
    
    private $ic;
    
    public function __construct() {
        parent::__construct();
        $this->lang = new InstallerLang($this->local, 'finish');
        $this->setTitle('finish_title');
        $this->ic = $this->getICObject('finish.tpl');
    }
    
    protected function show() {
        $this->ic->addText('url_website', URL);
        $this->ic->addText('url_admin_cp', URL.'admin/');
        print $this->ic->get('finish');
    }
}
?>
