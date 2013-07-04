<?php
/**
* @file     InstallerPageSetup.php
* @folder   /steps
* @version  0.1
* @author   Sweil
*
* page for installation/update setup
*/
class InstallerPageSetup extends InstallerPage {
    
    private $ic;
    
    public function __construct() {
        parent::__construct();
        $this->lang = new InstallerLang($this->local, 'setup');
        $this->setTitle('setup_title');
        $this->ic = $this->getICObject('setup.tpl');
    }
    
    protected function show() {
        try {
            // $sql connection
            $sql = new sql($_SESSION['dbc']['host'], $_SESSION['dbc']['data'], $_SESSION['dbc']['user'], $_SESSION['dbc']['pass'], $_SESSION['dbc']['pref']);
            
            //  settings migration solver
            $migration_solver = new SettingsMigrationSolver($sql);
            if (!$migration_solver->solve()) { return; };
            
            //  mininmal settings solver
            $settings_solver = new MinimalSettingsSolver($this->ic, $sql);
            if (!$settings_solver->solve()) { return; };
            
            // url and proto to session
            if (!is_null($settings_solver->getUrl()) && !is_null($settings_solver->getProtocol())) {
                $_SESSION['url'] = $settings_solver->getProtocol().$settings_solver->getUrl();
            }
            unset($settings_solver);
        
            // admin
            $admin_solver = new AdminSolver($this->ic, $sql);
            if (!$admin_solver->solve()) { return; };
            
            // generate & send email
            if ($admin_solver->isNew()) {
                $mail = new InstallerLang($this->local, 'mail');
                $content = $mail->get('content');
                $content = str_replace("{..url..}", $_SESSION['url'], $content);      
                $content = str_replace("{..username..}", $admin_solver->getUser(), $content);      
                $content = str_replace("{..password..}", $admin_solver->getPassword(), $content);
                
                // send email
                send_mail($admin_solver->getMail(), $admin_solver->getMail(), $mail->get('subject'), $content);
            }
            unset($admin_solver);    
            
            // nothing more todo => go to cleanup
            unset($_SESSION['minimal_settings']); // important, so user can navigate back        
            header("location: {$_SERVER['PHP_SELF']}?step=files"); // redirect
            exit;
            
        } catch (ErrorException $e) {
            Throw new NoDatabaseConnectionException($e->getMessage(), $e->getCode());
        }
    }
}
?>
