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
		var_dump($_SESSION);
		// runtime and starttime and refreshtime
		if (is_null($maxRuntime)) {
			$this->maxRuntime = SelfReloadingInstallerPage::calcMaxRuntime();
		}
		$this->startTime = microtime(true);
		$this->refreshTime = $refreshTime;
		
		// save session data
		if (isset($_SESSION['result'])) 
			$this->setResult($_SESSION['result']);
		if (isset($_SESSION['totalRuntime'])) 
			$this->totalRuntime = $_SESSION['totalRuntime'];
		
		// change start point
		if (isset($_SESSION['next']) && isset($_SESSION['done']) && $_SESSION['done']) {
			$this->done();
			$this->first = false;
		}
		
		if (isset($_SESSION['next']) && isset($_GET['next']) && $_SESSION['next'] == $_GET['next']) {
			$this->setNext($_SESSION['next']);
			$this->first = false;
		} else {
			$this->setNext($step);
		}
		unset($_SESSION['next'], $_GET['next'], $_SESSION['result'], $_SESSION['totalRuntime']);
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
		$_SESSION['done'] = true;
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
		$_SESSION['next'] = $this->getNext();
		$_SESSION['result'] = $this->getResult();
		$_SESSION['totalRuntime'] = $this->getRuntime();
		
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
