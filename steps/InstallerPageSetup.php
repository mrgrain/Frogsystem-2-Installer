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

            // url and protocol to session
            if (!is_null($settings_solver->getUrl()) && !is_null($settings_solver->getProtocol())) {
                $_SESSION['url'] = $settings_solver->getProtocol().$settings_solver->getUrl();
            }
            if (!is_null($settings_solver->getAdminMail())) {
                $_SESSION['admin_mail'] = $settings_solver->getAdminMail();
            }
            
            // admin
            $admin_solver = new AdminSolver($this->ic, $sql);
            if (!$admin_solver->solve()) { return; };

            // generate & send email
            if ($admin_solver->isNew()) {
                // fallback
                if (!isset($_SESSION['url']) || empty($_SESSION['url'])) {
                    $_SESSION['url'] = 'http://'.$_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF']);
                }                
                if (!isset($_SESSION['admin_mail']) || empty($_SESSION['admin_mail'])) {
                    $_SESSION['admin_mail'] = $admin_solver->getMail();
                }
                
                // content
                $mail = new InstallerLang($this->local, 'mail');
                $content = $mail->get('content');
                $content = str_replace("{..url..}", $_SESSION['url'], $content);      
                $content = str_replace("{..username..}", $admin_solver->getUser(), $content);      
                $content = str_replace("{..password..}", $admin_solver->getPassword(), $content);
                
                // send email
                InstallerFunctions::send_mail($_SESSION['admin_mail'], $admin_solver->getMail(), $mail->get('subject'), $content);
                unset($_SESSION['admin_mail']);
            }
            
            // nothing more todo => go to cleanup
            unset($admin_solver, $settings_solver);       
            unset($_SESSION['minimal_settings']); // important, so user can navigate back        
            header("location: {$_SERVER['PHP_SELF']}?step=files"); // redirect
            exit;
            
        } catch (ErrorException $e) {
            Throw new NoDatabaseConnectionException($e->getMessage(), $e->getCode());
        }
    }
}
?>
