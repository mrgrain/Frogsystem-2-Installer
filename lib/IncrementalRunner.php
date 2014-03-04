<?php
/**
 * @file     IncrementalRunner.php
 * @folder   /classes
 * @version  0.1
 * @author   Sweil
 *
 * provides an abstract implementation for an incremental runner
 * an incremental runner implements the execution of a selection of
 * different runners in a specified order
 */
abstract class IncrementalRunner extends Runner {

    private $start;
    private $end;

    /**
     * Cunstructor, creates Runners from the list and starts
     * @param array $list a sorted array
     * @param $start element to start with instructions
     * @param $end last element with instructions
     */
    public function __construct(array $list, $start, $end) {
        $this->instructions = array();
        $this->position = 0;
        $this->start = $start;
        $this->end = $end;

        foreach ($list as $element) {
            //skip if current element is smaller than start element
            if ($this->compare($element, $this->start) < 0) {
                continue;
            // break when current element is bigger than end element
            } else if ($this->compare($element, $this->end) > 0) {
                break;
            }

            // load element to instructions
            $this->load($element);
        }
    }

    /*
     * IMPORTANT NOTE:
     * You CANNOT assume that $element and $testValue are of the same kind
     * In fact, the idea behind it is to get e.g. 'from-2.alix5-to-2.alix6.sql'
     * if start is '2.alix4' and end is '2.alix6'
     *
     * @param $element an element of the $list of instruction sets
     * @param $testValue a value to test against the element
     */
    abstract protected function compare($element, $testValue);
    abstract protected function load($element);
}

?>
