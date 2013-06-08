<?php
/**
 * @file     Requirements.php
 * @folder   /classes
 * @version  0.1
 * @author   Sweil
 *
 * this class checks for the hardcore requirements like php and mysql
 * version
 */
 
class Requirements extends Checker {
    
    private $failedExtensions = array();
    
    public function getDefaultTests() {
        return $this->getTests();
    }
    
    public static function testFS2Version() {
        return InstallerFunctions::compareFS2Versions(UPGRADE_FROM, InstallerFunctions::getRequiredFS2Version()) >= 0;
    }
    public static function testFS2VersionWithNone($none = false) {
        if (UPGRADE_FROM == 'none')
            return true;
        return $this->testFS2Version();
    }
    
    public static function testPHPVersion() {
        return version_compare(PHP_VERSION, InstallerFunctions::getRequiredPHPVersion()) >= 0;
    }

    public function testPHPExtensions($extensions = false) {
        if (false == $extensions) {
            $extensions = InstallerFunctions::getRequiredPHPExtensions();
        }
        $passed = true;
        $this->failedExtensions = array();
        foreach ($extensions as $extension) {
            if (!Requirements::phpExtensionCheck($extension)) {
                $this->failedExtensions[] = $extension;
                $passed = false;
            }
        }
        return $passed;
    } 
    
    public function getFailedExtensions() {
        return $this->failedExtensions;
    }
    
    public static function phpExtensionCheck($module, $compare = false) {
        if ($compare) {
            return version_compare (phpversion($module), $compare ) >= 0;
        }
        return false !== phpversion($module);
    } 
}
    
