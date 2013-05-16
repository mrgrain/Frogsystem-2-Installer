<?php
/**
 * @file     Checker.php
 * @folder   /classes
 * @version  0.1
 * @author   Sweil
 *
 * provides the interface for any checkers
 * a checker is a class which ensures or checks certain circumstances 
 */
abstract class Checker {
    
    public function check($tests = true) {       
        // load all tests
        if ($tests === true) {
            $tests = $this->getDefaultTests();
        }
        
        // not array? => fail
        if (!is_array($tests)) {
            CheckerTestFailedException('check');
            return false;
        }
        
        // run tests
        foreach ($tests as $test) {
            if (!$this->$test()) {
                Throw new CheckerTestFailedException($test);
                return false;
            }
        }
        return true;
    }
    
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
    
    public function getTests() {
        $methods = get_class_methods($this);
        return array_filter($methods, create_function('$m', 'return "test" === substr($m, 0, 4);'));
    }
    
    public function getSolutions() {
        $methods = get_class_methods($this);
        return array_filter($methods, create_function('$m', 'return "solution" === substr($m, 0, 8);'));
    }
    
    abstract public function getDefaultTests();
    abstract public function getDefaultSolutions();
}

?>
