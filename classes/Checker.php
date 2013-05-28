<?php
/**
 * @file     Checker.php
 * @folder   /classes
 * @version  0.2
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
    
    
    public function getTests() {
        $methods = get_class_methods($this);
        return array_filter($methods, create_function('$m', 'return "test" === substr($m, 0, 4);'));
    }
    
    abstract public function getDefaultTests();
}

?>
