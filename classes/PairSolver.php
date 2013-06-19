<?php
/**
 * @file     PairSolver.php
 * @folder   /classes
 * @version  0.1
 * @author   Sweil
 *
 * provides the interface for a pairSolver
 * a pairSolver tests and trys to solves a pair of equally named test and soultion
 */
abstract class PairSolver extends Solver {
    
    public function solve($pairs = true) {
        // load default pairs
        if ($pairs === true) {
            $pairs = $this->getDefaultPairs();
        }
        if (!is_array($pairs)) {
            $pairs = array($pairs);
        }
		
		// which are not solved?
		$not_solved = array();
		foreach ($pairs as $pair) {
			try {
				if ($this->check('test'+ucfirst($pair))) { continue; }
			} catch (CheckerTestFailedException $e) {
				$not_solved[] = $pair;
			}
		}
				if ($this->'solution'+ucfirst($pair)()) {
					try {
						if ($this->check('test'+ucfirst($pair))) { continue; }
					catch (CheckerTestFailedException $e) {
					}
				}
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

    public function getDefaultTests() {
		return getDefaultPairs();
	}
	
    public function getDefaultSolutions() {
		return getDefaultPairs();
	}
	
    abstract public function getDefaultPairs();
}

?>
