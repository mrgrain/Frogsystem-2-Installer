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
        $this->lang = new InstallerLang($this->local, 'cleanup');
        $this->setTitle('cleanup_title');
        $this->ic = $this->getICObject('cleanup.tpl');
    }
    
    protected function show() {
        // actually do the clean up?
        $do_any = $do_files = $do_sql = false;
        if (isset($_POST['cleanup_both']) || isset($_POST['cleanup_files'])) {
            $do_any = $do_files = true;
        }
        if (isset($_POST['cleanup_both']) || isset($_POST['cleanup_sql'])) {
            $do_any = $do_sql = true;
        }

        // image_path
        $img_path = 'styles/'.$this->tpl->getStyle().'/images/';
        $this->ic->addText('success_img', $img_path.'ok.gif');
        $this->ic->addText('error_img', $img_path.'error.gif');        
        
        // files
        $files_list = array();
        $files_success = true;
        if (!$do_any || $do_files) {
            $filerunner = new FileRunner('jobs/cleanup_files/', UPGRADE_FROM, UPGRADE_TO, $this->lang);
            
            foreach($filerunner as $inst) {
                // images
                $this->ic->addText('success_img', $img_path.'ok.gif');
                $this->ic->addText('error_img', $img_path.'error.gif');
                
                //execute instruction
                if ($do_files) {
                    try {
                        $filerunner->runCurrentInstruction();
                        $this->ic->addCond('success', true);
                    } catch (FileOperationException $e) {
                        $this->ic->addCond('error', true);
                        $this->ic->addText('error_message', $e->getMessage());
                        $files_success = false;
                    }
                }            
                
                 // generate info
                $this->ic->addText('instruction', $filerunner->getCurrentInfo());
                $files_list[] = $this->ic->get('instruction_element');            
            }  
        }
        
        // sql
        $sql_list = array();
        $sql_sucess = true;
        try {
            if (!$do_any || $do_sql) {
                // get connection from session            
                $sql = new sql($_SESSION['dbc']['host'], $_SESSION['dbc']['data'], $_SESSION['dbc']['user'], $_SESSION['dbc']['pass'], $_SESSION['dbc']['pref']);
                $sqlrunner = new SQLRunner('jobs/cleanup_sql/', UPGRADE_FROM, UPGRADE_TO, $sql);
                
                foreach($sqlrunner as $inst) {                
                    // generate info
                    $info = $sqlrunner->getCurrentInfo();
                    $info[1] = str_replace('{..pref..}', $sql->getPrefix(), $info[1]);
                    $this->ic->addText('table', $info[1]);
                    $info = sprintf($this->lang->get('info_'.$info[0]), $this->ic->get('instruction_element_table'));                
                    
                    // images
                    $this->ic->addText('success_img', $img_path.'ok.gif');
                    $this->ic->addText('error_img', $img_path.'error.gif');                
                    
                    //execute instruction
                    if ($do_sql) {
                        try {
                            $sqlrunner->runCurrentInstruction();
                            $this->ic->addCond('success', true);
                        } catch (Exception $e) {
                            $this->ic->addCond('error', true);
                            $this->ic->addText('error_message', $e->getMessage());
                            $sql_sucess = false;
                        }
                    }

                    $this->ic->addText('instruction', $info);
                    $sql_list[] = $this->ic->get('instruction_element');                
                } 
            }
        } catch (Exception $e) {
        } 
        var_dump($files_success, $sql_sucess);
        var_dump(!($do_any && $files_success && $sql_sucess));
        // nothing todo => go on
        if (empty($sql_list) && empty($files_list)) {
            header("location: {$_SERVER['PHP_SELF']}?step=finish");
            exit;
        }
        
        //conds
        $this->ic->addCond('files', !(empty($files_list) || ($do_any && !$do_files)));
        $this->ic->addCond('sql', !(empty($sql_list) || ($do_any && !$do_sql)));
        $this->ic->addCond('total_success',  $do_any && $files_success && $sql_sucess);
        $this->ic->addCond('any_error', $do_any && !($files_success && $sql_sucess));
        $this->ic->addCond('files_error',  $do_files  && !$files_success);
        $this->ic->addCond('sql_error', $do_sql && !$sql_sucess);
    
        // lists
        $this->ic->addText('instructions_files', implode(PHP_EOL, $files_list));
        $this->ic->addText('instructions_sql', implode(PHP_EOL, $sql_list));
        
        $this->ic->addText('url_next', '?step=finish');      
        print $this->ic->get('cleanup_info');
    }
}
?>
