<?php
/**
 * @file     Runner.php
 * @folder   /classes
 * @version  0.2
 * @author   Sweil
 *
 * provides an abstract implementation for any runner
 * a runner implements the chronologically execution of instructions 
 * from a set of instructions (e.g. a file or an array)
 */
abstract class Runner implements Iterator {
    
    private $instructions;
    private $position;
    private $lastInstruction;
    private $lastResult;
    
    public function __construct() {
        $this->instructions = array();
        $this->position = 0;
    }   
    
    /*
     * Functions with direct access
     */
    abstract protected function runInstruction($instruction);
    abstract protected function getInfo($instruction);  
    
    public function validIndex ($index) {
        return isset($this->instructions[$index]);
    }

    public function addInstruction($instruction) {
        $this->instructions[] = $instruction;
    }
    
    public function getInstruction($index) {
        if (!$this->validIndex($index)) {
            throw new InstructionNotFoundException();
        }     
        return $this->instructions[$index];
    } 
    
    
    /*
     * Iterative Functions
     */
    public function current () {
        return $this->instructions[$this->position];
    } 
    public function setCurrent ($index) {
        $this->position = $index;
    }     
    public function key () {
        return $this->position;
    }
    public function next () {
        ++$this->position;
    }
    public function rewind () {
        $this->position = 0;
    }
    public function valid () {
        return isset($this->instructions[$this->position]);
    }
    public function runCurrentInstruction() {
        return $this->runInstruction($this->current());
    }
    public function getCurrentInfo() {
        return $this->getInfo($this->current());
    } 

    
    /*
     * Run all instructions
     */
    public function run() {
        $result = array();
        foreach ($this as $instruction) {
            $res = new StdClass();
            $res->instruction = $instruction;
            $res->result = $this->runInstruction($instruction);
            $result[] = $res;
        }
        return $result;  
    }
}

?>
