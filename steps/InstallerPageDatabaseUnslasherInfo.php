<?php
/**
* @file     InstallerPageDatabaseUnslasherInfo.php
* @folder   /steps
* @version  0.1
* @author   Sweil
*
* page for displaying informations before unslashing the database
*/
class InstallerPageDatabaseUnslasherInfo extends InstallerPage {
    
    private $ic;
    
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
        $this->ic->addText('url_setup', '?step=setup');
        $this->ic->addText('url_start_unslasher', '?step=databaseUnslasher');
        print $this->ic->get('sql_unslasher_info');
    }
}
?>
