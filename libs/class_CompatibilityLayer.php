<?php
/**
 * @file     class_CompatibilityLayer.php
 * @folder   /libs
 * @version  0.1
 * @author   Sweil
 *
 * provides some static compatibilty functions for the updater
 */
class CompatibilityLayer {
    
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
    
}

?>
