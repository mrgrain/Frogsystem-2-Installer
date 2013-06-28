<?php
/**
* @file     InstallerPageCleanup.php
* @folder   /steps
* @version  0.1
* @author   Sweil
*
* page for cleaing up after update/installation
*/
class InstallerPageCleanup extends InstallerPage {
    
    private $ic;
    
    public function __construct() {
        parent::__construct();
        $this->setTitle('cleanup_title');
        $this->ic = $this->getICObject('cleanup.tpl');
    }
    
    protected function show() {
        // nothing todo => go to cleanup
        header("location: {$_SERVER['PHP_SELF']}?step=finish"); // redirect
        exit;        
        
        //~ try {
            //~ // $sql connection
            //~ $sql = new sql($_SESSION['dbc']['host'], $_SESSION['dbc']['data'], $_SESSION['dbc']['user'], $_SESSION['dbc']['pass'], $_SESSION['dbc']['pref']);
//~ 
            //~ // admin
            //~ $admin_solver = new AdminSolver($this->ic, $sql);
            //~ if (!$admin_solver->solve()) { return; };
            //~ // TODO: send email
            //~ 
            //~ //  settings migration solver
            //~ $migration_solver = new SettingsMigrationSolver($sql);
            //~ if (!$migration_solver->solve()) { return; };
//~ 
            //~ //  mininmal settings solver
            //~ $settings_solver = new MinimalSettingsSolver($this->ic, $sql);
            //~ if (!$settings_solver->solve()) { return; };
            //~ unset($_SESSION['minimal_settings']); // important, so user can navigate back
            //~ 
            //~ // nothing todo => go to cleanup
            //~ header("location: {$_SERVER['PHP_SELF']}?step=cleanup"); // redirect
            //~ exit;
            //~ 
        //~ } catch (ErrorException $e) {
            //~ Throw new NoDatabaseConnectionException($e->getMessage(), $e->getCode());
        //~ }
    }
}
?>
