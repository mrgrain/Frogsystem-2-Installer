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
        $this->setTitle('finish_title');
        $this->ic = $this->getICObject('finish.tpl');
    }
    
    protected function show() {
        $url = "/";
        if (isset($_SESSION['url'])) {
            $url = $_SESSION['url'];
        }
        $this->ic->addText('url_website', $url);
        $this->ic->addText('url_admin_cp', $url.'admin/');
        print $this->ic->get('finish');
    }
}
?>
