<?php
/**
 * @file     SelfReloadingInstallerPage.php
 * @folder   /classes
 * @version  0.1
 * @author   Sweil
 *
 * this is a page with integraded self reloding mechanism,
 * based on runtime and an imagenary step counter 
 */

abstract class SelfReloadingInstallerPage extends InstallerPage {
    
    abstract protected function getUrl($next);
    
    protected $startTime;
    protected $maxRuntime;
    protected $nextStep;
    protected $done = false;
    protected $result;
    protected $refreshTime;
    protected $totalRuntime = 0;
    protected $first = true;
    
    public function __construct($refreshTime = 2, $step = 0, $maxRuntime = null) {
        parent::__construct();
        
        // runtime and starttime and refreshtime
        if (is_null($maxRuntime)) {
            $this->maxRuntime = SelfReloadingInstallerPage::calcMaxRuntime();
        }
        $this->startTime = microtime(true);
        $this->refreshTime = $refreshTime;
        
        // create srip array on need
        if (!isset($_SESSION['srip']))
            $_SESSION['srip'] = array();
            
        // save session data
        if (isset($_SESSION['srip']['result'])) 
            $this->setResult($_SESSION['srip']['result']);
        if (isset($_SESSION['srip']['totalRuntime'])) 
            $this->totalRuntime = $_SESSION['srip']['totalRuntime'];
        
        // done?
        if (isset($_SESSION['srip']['next']) && isset($_SESSION['srip']['done']) && $_SESSION['srip']['done']) {
            $this->done();
            $this->first = false;
        }
        
        // change start point
        if (isset($_SESSION['srip']['next']) && isset($_GET['next']) && $_SESSION['srip']['next'] == $_GET['next']) {
            $this->setNext($_SESSION['srip']['next']);
            $this->first = false;
        } else {
            $this->setNext($step);
        }
        
        // reset srip-data
        unset($_SESSION['srip']);
    }
    
    protected function setNext($step) {
        $this->nextStep = $step;
    }
    
    protected function getNext() {
        return $this->nextStep;
    }
    
    protected function setResult($result) {    
        $this->result = $result; 
    }
    
    protected function getResult() {
        return $this->result;
    }   
    
    protected function done() {
        $this->done = true;
    }
    
    protected function isDone() {
        return $this->done;
    }
    
    protected function getRefreshTime() {
        return $this->refreshTime;
    }

    protected function getRuntime() {
        return $this->totalRuntime+$this->scriptTime();
    }
    
    protected function getMaxRuntime() {
        return $this->maxRuntime;
    }
    
    protected function scriptTime() {
        return microtime(true)-$this->startTime;
    }
    
    protected function isFirstRun() {
        return $this->first;
    }
    
    protected function reload($force = false) {
        // set data
        $_SESSION['srip']['next'] = $this->getNext();
        $_SESSION['srip']['result'] = $this->getResult();
        $_SESSION['srip']['totalRuntime'] = $this->getRuntime();
        $_SESSION['srip']['done'] = $this->isDone();

        // redirect
        if (($this->scriptTime() > $this->maxRuntime && !$this->isDone()) || $force) {
            // header
            header("refresh: {$this->getRefreshTime()}; url={$this->getUrl($this->getNext())}");
            exit;
        }
    }

    public static function calcMaxRuntime($factor = 0.7) {
        $max_time = ini_get('max_execution_time');
        if (!$max_time) $max_time = 30;
        if ($max_time <= 0) $max_time = 30;
        return round($max_time*$factor);    
    }
}
?>
