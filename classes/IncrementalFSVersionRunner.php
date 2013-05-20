<?php
/**
 * @file     IncrementalFSVersionRunner.php
 * @folder   /classes
 * @version  0.2
 * @author   Sweil
 *
 * provides an abstract implementation for incremental runners based
 * on FS2 version files, e.g. from-2.alix6-to-2.alix7
 * thus it only implements consturctor and some compare functions
 */
abstract class IncrementalFSVersionRunner extends IncrementalRunner {
    
    private $versions = array(
        '2.alix3','2.alix4','2.alix5','2.alix6','2.alix7','2.alix8','2.alix9',
        '2.beta1','2.beta2','2.beta3','2.beta4','2.beta5','2.beta6','2.beta7','2.beta8','2.beta9',
        '2.rc1','2.rc2','2.rc3','2.rc4','2.rc5'
    );
        
        
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
       
        $loadList = array();
        $last = new StdClass();
        $last->diff = -1;
        $last->matches = array(1 => $start);
        $virtualStart = $start;
       
        // get elements
        foreach ($list as $element) {
            // skip not found
            $res = $this->compareWithMatches($element, $virtualStart);
            if (!$res) continue;
            // skip when element is lower than default start
            // we need this twice because 
            if ($res->compare < 0) continue; 
            
            // set virtul Start
            if (isset($last) && $last->matches[1] != $res->matches[1]) {
                $virtualStart = $loadList[$last->matches[1]]->matches[2];
                $res = $this->compareWithMatches($element, $virtualStart);
                $last->diff = 0;
            }
            // skip top border
            if ($this->compare($element, $this->end) >= 0)  break;
            
            // found a match: now check if its the best one            
            if ($res->compare == 0 && 1 > $this->compareVersions($res->matches[2], $this->end)) {
                $a = array_search($res->matches[1], $this->versions);
                $b = array_search($res->matches[2], $this->versions);
                $res->diff = $b-$a;
                if ($res->diff > $last->diff) {
                    $last = $res;
                    $loadList[$last->matches[1]] = $res;
                } else {
                    continue;
                }
            }
        }

        //load elements
        foreach($loadList as $element) {
            $this->load($element->matches[0]);
        }
    } 
    
    /*
     *  This compare function only checks against the from entry.
     *  Works very well with IncrementalRunner default constructor
     *  if each update-file just updates to next version
     */
    private function compareWithMatches($element, $testValue) {
        $res = new StdClass();
        $res->matches = array();
        preg_match('#^from-(2\.[0-9a-zA-Z\.]+)-to-(2\.[0-9a-zA-Z\.]+)(\.[^.]+){1}$#', $element, $res->matches);
                
        //reg_ex_not_match
        if (empty($res->matches)) {
            return false;
        }
        
        //compare versions
        if (false === ($res->compare = $this->compareVersions($res->matches[1], $testValue))) {
            return false; // not found in list
        }
        return $res;
    }
    
    /*
     * Accually compares the FS2 versions
     */    
    private function compareVersions($one, $two) {
        // equal
        if ($one == $two) {
            return 0;
        }
        
        // return what ever element is found first in the versions array
        foreach ($this->versions as $v) {
            if ($v == $one) { // $one < $two
                return -1;
            } else if ($v == $two) { // $one > $two
                return 1;
            }
        }
        
        // not found in list
        return false;
    } 
    
    /*
     * Wrapper for compareWithMatches
     */
    protected function compare($element, $testValue) {
        $res = $this->compareWithMatches($element, $testValue);
        return $res->compare;
    }

}
?>
