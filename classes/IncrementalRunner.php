<?php
/**
 * @file     IncrementalRunner.php
 * @folder   /classes
 * @version  0.1
 * @author   Sweil
 *
 * provides an interface for an incremental runner
 * an incremental runner implements the execution of a selection of 
 * different runners in a specified order
 */
abstract class IncrementalRunner implements Runner {

    /**
     * Cunstructor, creates Runners from the list and starts 
     * @param Foo
     */
    public function __construct(Array $list) {
        foreach ($list as $element) {

        }
    }
    
    
    abstract public function order();
    
    
    public function order();
    
    
}

?>
