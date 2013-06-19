<?php
/**
 * @file     InstallerFunctions.php
 * @folder   /classes
 * @version  0.1
 * @author   Sweil
 *
 * provides some static compatibilty functions for the updater
 */
class InstallerFunctions {
    
    public static function writeDBConnectionFile($h, $u, $pa, $d, $pr) {
        $file_path = INSTALLER_PATH.'copy/db_connection.php';
        
        $file = file($file_path);
        $file[4] = '$dbc[\'host\'] = \''.addcslashes($h, "\'").'\';'.PHP_EOL;
        $file[6] = '$dbc[\'user\'] = \''.addcslashes($u, "\'").'\';'.PHP_EOL;
        $file[8] = '$dbc[\'pass\'] = \''.addcslashes($pa, "\'").'\';'.PHP_EOL;
        $file[10] = '$dbc[\'data\'] = \''.addcslashes($d, "\'").'\';'.PHP_EOL;
        $file[12] = '$dbc[\'pref\'] = \''.addcslashes($pr, "\'").'\';'.PHP_EOL;
        
        // TODO fileaccess
        return file_put_contents($file_path, $file);
    }
    
    public static function getRequiredPHPVersion() {
        return '5.1.0';
    }
    
    public static function getRequiredPHPExtensions() {
        return array('pdo', 'pdo_mysql');
    }
    
    public static function getFS2Versions() {
        return array(
            'none',
            '2.alix3','2.alix4','2.alix5','2.alix6','2.alix7','2.alix8','2.alix9',
            '2.beta1','2.beta2','2.beta3','2.beta4','2.beta5','2.beta6','2.beta7','2.beta8','2.beta9',
            '2.rc1','2.rc2','2.rc3','2.rc4','2.rc5'
        );
    }

    public static function getRequiredFS2Version() {
        return '2.alix5';
    }
    
    /*
     * Accually compares to FS2 versions
     */    
    public static function compareFS2Versions($one, $two) {
        // equal
        if ($one == $two) {
            return 0;
        }
        
        // return what ever element is found first in the versions array
        $versions = InstallerFunctions::getFS2Versions();
        foreach ($versions as $v) {
            if ($v == $one) { // $one < $two
                return -1;
            } else if ($v == $two) { // $one > $two
                return 1;
            }
        }
        
        // not found in list
        return false;
    }
    
    public static function orderByIncrementalFilenames(&$list) {
        usort($list, create_function('$a, $b', '
            $regex = \'~^from-(none|2\.[0-9a-zA-Z\.]+)-to-(none|2\.[0-9a-zA-Z\.]+)(\.[^.]+){1}$~\';
            $one = array();
            preg_match($regex, $a, $one);
            $two = array();
            preg_match($regex, $b, $two);

            if (empty($one) && empty($two)) {
                return false;
            }

            $first = InstallerFunctions::compareFS2Versions($one[1], $two[1]);
            if ($first == 0) {
                return InstallerFunctions::compareFS2Versions($one[2], $two[2]);
            }
            return $first;
        '));
    }   
    
    public static function getTableList ($prefix = "") {
        $tables = array (
            'admin_cp',
            'admin_groups',
            'admin_inherited',
            'aliases',
            'announcement',
            'applets',
            'articles',
            'articles_cat',
            'cimg',
            'cimg_cats',
            'counter',
            'counter_ref',
            'counter_stat',
            'dl',
            'dl_cat',
            'dl_files',
            'editor_config',
            'email',
            'ftp',
            'hashes',
            'news',
            'news_cat',
            'news_links',
            'partner',
            'player',
            'poll',
            'poll_answers',
            'poll_voters',
            'press',
            'press_admin',
            'screen',
            'screen_cat',
            'screen_random',
            'search_index',
            'search_time',
            'search_words',
            'shop',
            'smilies',
            'snippets',
            'styles',
            'user',
            'useronline',
            'user_groups',
            'user_permissions',
            'wallpaper',
            'wallpaper_sizes',
        );
        
        if (!empty($prefix)) {
            foreach ($tables as $k => $v) {
                $tables[$k] = $prefix.$v;
            }
        }
        
        return $tables;
    } 
    
    public static function killhtml ($VAL, $ARR = true) {
        // save data
        if (is_array($VAL)) {
            if ($ARR)
                $VAL = array_map(array('InstallerFunctions', 'killhtml'), $VAL);
        } 
        elseif (is_numeric($VAL)) {
            if (floatval($VAL) == intval($VAL)) {
                $VAL = intval($VAL);
                settype($VAL, 'integer');
            } else {
                $VAL = floatval($VAL);
                settype($VAL, 'float');
            }
        } else {
            $VAL = htmlspecialchars(strval($VAL), ENT_QUOTES, 'ISO-8859-1', false);
            settype($VAL, 'string');
        }

        return $VAL;
    }    
    
    public static function getRandomCode($length, $charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789') {
		$code = '';
		$charset_length = strlen($charset) - 1;
		mt_srand((double)microtime() * 1001000);

		while(strlen($code) < $length) {
			$code .= $charset[mt_rand (0,$charset_length)];
		}
		return $code;
	}
}

?>
