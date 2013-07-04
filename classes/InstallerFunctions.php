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
        
        // TODO Generic Fileaccess Class
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
        return '2.alix4';
    }
    
    public static function getInstalledFS2Version($path) {
        $files = array(
            '2.alix5' => array('index.php', 'login.inc.php', 'imageviewer.php'),
            '2.alix4' => array('editor_css.php', 'index.php', 'login.inc.php', 'showimg.php', 'style_css.php'),
        );
        
        $fs2 = false;
        foreach ($files as $key => $list) {
            $fs2 = true;
            foreach ($list as $file) {
                $filepath = $path.DIRECTORY_SEPARATOR.$file;
                $fs2 = $fs2 && is_file($filepath);
                if (!$fs2)
                    break;
            }
            if ($fs2)
                return $key;
        }
        
        return false;    
    }          
    
    
    // checks wheter in a given valid path an frogsystem installation is placed 
    public static function isFrogsystem($path) {
        if (false !== InstallerFunctions::getInstalledFS2Version($path))
            return true;
        return false;
    }       
    
    
    // try to get an old database connection
    public static function getOldDBConnection($path, $version) {
                
        // handle by version
        $dbc = array('type' => null, 'host' => null, 'user' => null, 'pass' => null, 'data' => null, 'pref' => null);
        switch($version) {
            case '2.alix4':
                if ($file = @file($path.DIRECTORY_SEPARATOR.'login.inc.php')) {
                    for ($i = 0; $i <= 15; $i++) {
                        $matches = array();
                        if (isset($file[$i])) {
                            @preg_match('/^\$(host|user|data|pass|pref) *= *("|\')([^\2]+)\2 *;/', trim($file[$i]), $matches);
                            if (!empty($matches)) {
                                if ('"' == $matches[2])
                                    $matches[3] = str_replace('\"', '"', $matches[3]);
                                    
                                $dbc[$matches[1]] = $matches[3];
                                $dbc['type'] = 'mysql';
                            }
                        }
                    }
                }
                break;
            case '2.alix5':
                if ($file = @file($path.DIRECTORY_SEPARATOR.'login.inc.php')) {
                    for ($i = 0; $i <= 15; $i++) {
                        $matches = array();
                        if (isset($file[$i])) {
                            @preg_match('/^\$dbc\[("|\')(host|user|data|pass|pref)\1\] *= *("|\')([^\3]+)\3 *;/', trim($file[$i]), $matches);
                            if (!empty($matches)) {
                                if ('"' == $matches[3])
                                    $matches[4] = str_replace('\"', '"', $matches[4]);
                                    
                                $dbc[$matches[2]] = $matches[4];
                                $dbc['type'] = 'mysql';
                            }
                        }
                    }
                }
                break;
            default:
                return false;
        }

        // check if we found any values
        if ("" != trim(implode($dbc))) {
            return $dbc;
        }        
        return false;
    }      
    
    
        
    // function to detect the language from user agent
    public static function detect_language() {
        // get language
        $de = strpos($_SERVER['HTTP_ACCEPT_LANGUAGE'], 'de');
        $en = strpos($_SERVER['HTTP_ACCEPT_LANGUAGE'], 'en');

        if ($de !== false && $de < $en) {
            return 'de_DE';
        } else {
            return 'en_US';
        }
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
    

    
    ////////////////////////////////////////
    //// Decode JSON to Array with UTF8 ////
    ////////////////////////////////////////
    public static function json_array_decode ($string) {
        // JSON for PHP <= 5.2
        require_once(INSTALLER_PATH . 'resources/jsonwrapper/jsonwrapper_helper.php');
        
        $data = json_decode($string, true);
        // empty json creates null not emtpy array => error
        if (empty($data)) // prevent this
            $data = array();
        return array_map('utf8_decode', $data);
    }
    ///////////////////////////////////////
    //// Encode Array from JSON & UTF8 ////
    ///////////////////////////////////////
    public static function json_array_encode ($array) {
        // JSON for PHP <= 5.2
        require_once(INSTALLER_PATH . 'resources/jsonwrapper/jsonwrapper_helper.php');
        return json_encode(array_map('utf8_encode', $array), JSON_FORCE_OBJECT);
    }
    
    
    /////////////////////////////////////////////////////////////////////////////////////////////////
    //// get timezonelist                                                                        ////
    //// thx@Rob Kaper <http://de.php.net/manual/en/function.date-default-timezone-set.php#84459>////
    /////////////////////////////////////////////////////////////////////////////////////////////////
    public static function get_timezones () {
        $timezones = DateTimeZone::listAbbreviations();

        $cities = array();
        foreach( $timezones as $key => $zones )
        {
            foreach( $zones as $id => $zone )
            {
                if ( preg_match( '/^(America|Antartica|Arctic|Asia|Atlantic|Europe|Indian|Pacific)\//', $zone['timezone_id'] ) )
                    $cities[$zone['timezone_id']][] = $key;
            }
        }

        // For each city, have a comma separated list of all possible timezones for that city.
        foreach( $cities as $key => $value )
            $cities[$key] = join( ', ', $value);

        // Only keep one city (the first and also most important) for each set of possibilities.
        $cities = array_unique( $cities );

        // Sort by area/city name.
        ksort($cities);

        return $cities;
    }  
 
}

?>
