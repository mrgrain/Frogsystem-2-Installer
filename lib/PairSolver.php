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
            if (!parent::solve(array('solution'.ucfirst($pair)), array('test'.ucfirst($pair)))) {
                $not_solved[] = $pair;
            }
		}
    
        return empty($not_solved);
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
