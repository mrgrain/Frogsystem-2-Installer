<?php
/**
 * @file     Solver.php
 * @folder   /classes
 * @version  0.1
 * @author   Sweil
 *
 * provides the interface for any solvers
 * a solver provieds possible solutions to pass all (or certain) checks
 */
abstract class Solver extends Checker {
    
    public function solve($solutions = true, $tests = true) {
        // load all solutions
        if ($solutions === true) {
            $solutions = $this->getDefaultSolutions();
        }
        
        try {     
            // run first check
            try {
                if ($this->check($tests)) { return true; }
            } catch (CheckerTestFailedException $e) {}
            
            // run solutions
            foreach ($solutions as $solution) {
                // try next solution & check on success
                if ($this->$solution()) {
                    try {
                        if ($this->check($tests)) { return true; }
                    } catch (CheckerTestFailedException $e) {}
                }
            } 
        }
        // rethrow others
        catch (Exception $e) { throw $e; }        
    
        return false;
    }
    
    public function getSolutions() {
        $methods = get_class_methods($this);
        return array_filter($methods, create_function('$m', 'return "solution" === substr($m, 0, 8);'));
    }

    abstract public function getDefaultSolutions();
}

?>
