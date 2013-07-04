<?php
/**
 * @file     Files.php
 * @folder   /classes
 * @version  0.2
 * @author   Sweil
 *
 * extended file operations
 */
 
class Files {
    
    // COPY (-RO)? "soruce" "destination"
    public static function copy($source, $destination, $recursive = false, $overwrite = false) {
        // source is array
        if (is_array($source)) {
            $result = true;
            foreach($source as $s) {
                $result = $result && self::copy($s, $destination, $recursive, $overwrite);
            }
            return $result;
        }
        
        // source file
        if (is_file($source)) {
            
            // target folder
                // => change destination path to file name and call myself
            if(is_dir($destination)) {
                $target_path = $destination.DIRECTORY_SEPARATOR.basename($source);
                return self::copy($source, $target_path, $recursive, $overwrite);
                

            //target file
                // => copy (or overwrite?) an rename     
            } elseif ($overwrite || !file_exists($destination)) {           
                return @copy($source, $destination);
            }
            
        // if recursive
            // source folder
        } elseif (is_dir($source) && $recursive) {
            // target does not existst
                // create folder and call myself                  
            if (!file_exists($destination)) {
                if (!@mkdir($destination, 0777, $recursive));
                    return false;
                return self::copy($source, $destination, $recursive, $overwrite);
  
            // target folder
                // copy each file and folder 
            } elseif (is_dir($destination)) {
                $copied = true;
                foreach(scandir($source) as $entry) {                    
                    if ($entry != "." && $entry != "..")
                        $copied = $copied && self::copy($source.DIRECTORY_SEPARATOR.$entry, $recursive, $overwrite);
                }
                return $copied;
            }
        }
        return false;
    }
    
    
    // DELETE (-R)? "path"
    public static function delete($path, $recursive = false) {
        // $path is array
        if (is_array($path)) {
            $result = true;
            foreach($path as $p) {
                $result = $result && self::delete($p, $recursive);
            }
            return $result;
        }
        
        // path file
            // => delete file
        if (is_file($path))
            return @unlink($path);
        // path folder
        if (is_dir($path)) {
            if (!$recursive) {
                return @rmdir($path);
            } else {
                // recursivly?
                    // => delete recursivly                
                $removed = true;
                foreach(scandir($path) as $entry) {                    
                    if ($entry != "." && $entry != "..")
                        $removed = $removed && self::delete($path.DIRECTORY_SEPARATOR.$entry, true);
                }
                return $removed && rmdir($path);
            }
        }
        
        return false;
    }
    
    // MOVE (-O)? "source" "destination"
    public static function move($source, $destination, $overwrite = false) {
        // source is array
        if (is_array($source)) {
            $result = true;
            foreach($source as $s) {
                $result = $result && self::move($s, $destination, $overwrite);
            }
            return $result;
        }  
                
        // target not existing
            // => rename
        // target file
            // => rename if overwrite
        if (!file_exists($destination) || $overwrite)
            return rename($source, $destination);
            
        // source is file and target folder
            // => rename if target not exists
        $new_dest = $destination.DIRECTORY_SEPARATOR.basename($source);
        if (is_file($source) && is_dir($destination) && !file_exists($new_dest))
            return rename($source, $new_dest);
        
    }

    // IS_WRITABLE (-R)? "path"
    public static function is_writable($path, $recursive = false) {
        // path is array
        if (is_array($path)) {
            $result = true;
            foreach($path as $p) {
                $result = $result && self::is_writable($p, $recursive);
            }
            return $result;
        }        
        
        // path not existin
        if (!file_exists($path)) {
            return self::is_writable(dirname($path), false);
        }
        
        // recursively ?
        if ($recursive && is_dir($path)) {
        // folder & recursive
            // => each file and folder and subfolders are writable
            $writable = is_writable($path);
            foreach(scandir($path) as $entry) {
                if (!$writable)
                    break;
                
                if ($entry != "." && $entry != "..")
                    $writable = $writable && self::is_writable($path.DIRECTORY_SEPARATOR.$entry, $recursive);
            }
            return $writable;
            
        } else {
        // source file
            // => is wrtiable?          
        // source folder
            // => is wrtiable?
            return is_writable($path);            
        }
        
        return false;
    }
    
    
    // resolve path
    public static function resolve_path($path, $star = false) {
        // installer_path or install_to path
        $start = substr($path, 0, 2);
        if ("./" == $start || ".".DIRECTORY_SEPARATOR == $start) {
            $path = INSTALLER_PATH.substr($path, 2);
        } elseif ("~/" == $start || "~".DIRECTORY_SEPARATOR == $start) {
            $path = INSTALL_TO.substr($path, 2);
        }

        // all files in folder
        $end = substr($path,-2,2);
        if ($star && ('/*' == $end || DIRECTORY_SEPARATOR.'*' == $end)) {
            $shortpath = substr($path,0,-1);
            if (is_dir($shortpath)) {
                $pathes = array($shortpath);
                foreach(scandir($shortpath) as $entry) {                  
                    if ($entry != "." && $entry != "..") {
                        $pathes[] = $shortpath.$entry;
                    }
                }
                return $pathes;
            }
        }
        return $path;
    }    
    
}


?>
