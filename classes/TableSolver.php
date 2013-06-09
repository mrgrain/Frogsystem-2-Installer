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
        if (isset($_POST['db_table_overwrite'])) {
            return true;
        }
        
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
        // run SQLConnectionSolver to show form
        $solver = new SQLConnectionSolver($this->ic);
        $solver->setError(implode(', ', $this->doubles), 'table_duplicates');
        $solver->solve(array('solutionShowForm'), array('fail'));
        return;        
    }
}

?>
