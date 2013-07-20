<?php
/**
* @file     InstallerPageDatabase.php
* @folder   /steps
* @version  0.1
* @author   Sweil
*
* page for database operations
*/
class InstallerPageDatabase extends InstallerPage {

    private $ic;

    public function __construct() {
        parent::__construct();
        $this->lang = new InstallerLang($this->local, 'database');
        $this->setTitle('database_title');
        $this->ic = $this->getICObject('database.tpl');
    }

    protected function show() {
        // init solver
        $solver = new SQLConnectionSolver($this->ic);

        // check SQL Connection
        if (isset($_GET['reset'])) { //reset?
            $solver->solve(array('solutionShowForm'), array('fail'));
            return;
        } else {
            if (!$solver->solve(array('solutionFromPostToDBConnectionFile', 'solutionShowForm'))) { return; }
        }

        //check connection from session
        try {
            $sql = new sql($_SESSION['dbc']['host'], $_SESSION['dbc']['data'], $_SESSION['dbc']['user'], $_SESSION['dbc']['pass'], $_SESSION['dbc']['pref']);

            $tableSolver = new TableSolver($sql, $this->ic);
            if (!$tableSolver->solve()) { return; }

            if (!isset($_SESSION['db_instructions']) || empty($_SESSION['db_instructions'])) {
                $runner = new SQLRunner(INSTALLER_PATH.DIRECTORY_SEPARATOR.'jobs/sql/', UPGRADE_FROM, UPGRADE_TO, $sql);
                $inst_list = array();
                foreach($runner as $inst) {
                    $info = $runner->getCurrentInfo();
                    $info[1] = str_replace('{..pref..}', $sql->getPrefix(), $info[1]);
                    $this->ic->addText('table', $info[1]);
                    $info = sprintf($this->lang->get('info_'.$info[0]), $this->ic->get('sqlinstructions_info_table'));
                    $this->ic->addText('instruction', $info);
                    $inst_list[] = $this->ic->get('sqlinstructions_info_element');
                }
                $_SESSION['db_instructions'] = $inst_list;
            } else {
                $inst_list = $_SESSION['db_instructions'];
            }

            $this->ic->addText('instruction_list', implode(PHP_EOL, $inst_list));
            $this->ic->addText('url', '?step=databaseOperations');
            print $this->ic->get('sqlinstructions_info');


        } catch (Exception $e) {
            $solver->solve(array('solutionShowForm'), array('fail'));
            return;
        }
    }
}
?>
