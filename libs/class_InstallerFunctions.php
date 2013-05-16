<?php
/**
 * @file     class_InstallerFunctions.php
 * @folder   /libs
 * @version  0.1
 * @author   Sweil
 *
 * provides some static compatibilty functions for the updater
 */
class InstallerFunctions {
    
    public static function writeDBConnectionFile($h, $u, $pa, $d, $pr) {
        $file_path = FS2_ROOT_PATH.'copy/db_connection.php';
        
        $file = file($file_path);
        $file[4] = '$dbc[\'host\'] = \''.addcslashes($h, "\'").'\';'.PHP_EOL;
        $file[6] = '$dbc[\'user\'] = \''.addcslashes($u, "\'").'\';'.PHP_EOL;
        $file[8] = '$dbc[\'pass\'] = \''.addcslashes($pa, "\'").'\';'.PHP_EOL;
        $file[10] = '$dbc[\'data\'] = \''.addcslashes($d, "\'").'\';'.PHP_EOL;
        $file[12] = '$dbc[\'pref\'] = \''.addcslashes($pr, "\'").'\';'.PHP_EOL;
        
        // TODO fileaccess
        return file_put_contents($file_path, $file);
    }
    
}

?>
