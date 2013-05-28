<?php
/**
* @file     InstallerPageRequirements.php
* @folder   /steps
* @version  0.1
* @author   Sweil
*
* page for database operations
*/
class InstallerPageRequirements extends InstallerPage {
    
    private $ic;
    
    public function __construct() {
        parent::__construct();
        $this->setTitle('requirements_title');
        $this->ic = $this->getICObject('requirements.tpl');
    }
    
    protected function show() {
        // check SQL Connection
        $checker = new Requirements();

        // fs2 version
        $fs2version = !$checker->testFS2Version();
        $this->ic->addText('your_version', UPGRADE_FROM);
        $this->ic->addText('required_version', InstallerFunctions::getRequiredFS2Version());        
        $this->ic->addCond('fs_version_error', $fs2version);  
        $fs2_version_error = $this->ic->get('fs_version');
        
        // php version
        $phpversion = !$checker->testPHPVersion();
        $this->ic->addText('your_version', PHP_VERSION);
        $this->ic->addText('required_version', InstallerFunctions::getRequiredPHPVersion());        
        $this->ic->addCond('php_version_error', $phpversion);  
        $php_version_error = $this->ic->get('php_version');
        
        // php extensions
        $extensions = !$checker->testPHPExtensions();
        $this->ic->addText('missing_extensions', implode(', ', $checker->getFailedExtensions()));     
        $this->ic->addCond('php_extensions_error', $extensions);   
        $extensions_error = $this->ic->get('php_extensions');
        
        // Show template
        $this->ic->addText('fs_version', $fs2_version_error);
        $this->ic->addText('php_version', $php_version_error);
        $this->ic->addText('php_extensions', $extensions_error);           
        print $this->ic->get('requirements');
    }
}
?>
