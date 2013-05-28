<?php
/**
 * @file     UpgradeFunctions.php
 * @folder   /classes
 * @version  0.1
 * @author   Sweil
 *
 * provides some static upgrade functions for the updater
 */
class UpgradeFunctions {
    
    public static function getOldDBConnection($version) {
        
        // handle by version
        switch($version) {
            case '2.alix3':
            case '2.alix4':
            case '2.alix5':
            default:
                return false;
        }
        
    }
    
    public static function getInstalledFS2Version() {
        return 'none';        
    }    
    
}

?>
