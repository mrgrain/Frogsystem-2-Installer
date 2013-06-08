<?php
/**
 * @file     TableSolver.php
 * @folder   /classes
 * @version  0.2
 * @author   Sweil
 *
 * this class checks the databese for used tables and provides
 * a form to change the prefix if wanted.
 */
class TableSolver extends Solver {
    
    private $sql;
    private $ic;
    private $doubles = array();
    
    public function __construct($sql, $ic) {
        $this->sql = $sql;
        $this->ic = $ic;
    }
    
    /* Default tests & solutions */             
    public function getDefaultTests() {
        return $this->getTests();
    }    
    public function getDefaultSolutions() {
        return $this->getSolutions();
    }    
    
    /* Run all the tests in this order */
    public function testTables() {
        try {
            $tables = InstallerFunctions::getTableList($this->sql->getPrefix());
            $this->doubles = array();
            $rows = $this->sql->doQuery("SHOW TABLES LIKE '{..pref..}%'");
            foreach($rows as $row) {
                if (in_array($row[0], $tables)) {
                    $this->doubles[] = $row[0];
                }
            }
        } catch (Exception $e) { throw $e; }
        return empty($this->doubles);
    }

    
    /* Run all the solutions in this order */
    public function solutionListTablesAndShowForm() {
        // delete session
        unset($_SESSION['dbc']);
                
        // show form
        $this->ic->addCond('sql_error', true);
        $this->ic->addText('sql_connection_error_title', $this->ic->getLang()->get('fs2_table_error_title'));
        $this->ic->addText('sql_connection_error', $this->ic->getLang()->get('fs2_table_error').'<br>'.implode(', ', $this->doubles));
        $this->ic->addCond('sql_prefix_error', true);
        print $this->ic->get('sqlconnection');
        return false;
    }
}

?>
