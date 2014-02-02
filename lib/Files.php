<?php
/**
 * @file     Files.php
 * @folder   /classes
 * @version  0.2
 * @author   Sweil
 *
 * file operations, working with php >= 5.1.0
 */

class Files {
    /**
     * Static call of PHP functions
     *
     * @param array $name Name of the file function to be called
     * @param array $arguments List of arguments to use in funciton call
     * @param array $paths List of arguments which are path and should be extended
     * @param array $contexts List of numeric keys, which arguments are of type context and musst be extended
     * @param array $use_defaults List of numeric keys and values for which arguments should be set with a default value, if empty.
     *
     * @return mixed
     **/

    protected static function call($name, $arguments, $write_paths = array(), $contexts = array(), $use_defaults = array()) {
        // prepend url-wrapper
        foreach($write_paths as $path) {
            if (!is_object($arguments[$path]) || !is_a($arguments[$path], 'Path')) {
                $arguments[$path] = new Path($arguments[$path]);
            }
            $arguments[$path] = $arguments[$path]->get('write_wrapper');
        }

        // set defaults for empty arguments
        foreach($use_defaults as $key => $default) {
            if (!isset($arguments[$key])) {
                $arguments[$key] = $default;
            }
        }

        // set context to overwrite
        $options = array('ftp' => array('overwrite' => true));
        foreach($contexts as $context) {
            if (isset($arguments[$context])) {
                stream_context_set_option($arguments[$context], $options);
            } else {
                $arguments[$context] = stream_context_create($options);
            }
        }

        // call function
        ksort($arguments);
        return call_user_func_array($name, $arguments);
    }

    protected static function makePath($filename) {
        if (!is_object($filename) || !is_a($filename, 'Path')) {
            $filename = new Path($filename);
        }
        return $filename;
    }


    // map filesystem functions
    public static function copy() {
        $args = func_get_args();
        // remove existing file
        if (self::file_exists($args[1])) {
            self::unlink($args[1]);
        }
        return self::call('copy', $args, array(0,1), array(2));
    }
    public static function file_exists() {
        return self::call('file_exists', func_get_args());
    }
    public static function file_get_contents() {
        return self::call('file_get_contents', func_get_args(), array(), array(2), array(1 => false));
    }
    public static function file_put_contents() {
        return self::call('file_put_contents', func_get_args(), array(0), array(3), array(2 => 0));
    }
    public static function file() {
        return self::call('file', func_get_args(), array(), array(2), array(1 => 0));
    }
    public static function fileatime() {
        return self::call('fileatime', func_get_args(), array());
    }
    public static function filectime() {
        return self::call('filectime', func_get_args(), array());
    }
    public static function filegroup() {
        return self::call('filegroup', func_get_args(), array());
    }
    public static function fileinode() {
        return self::call('fileinode', func_get_args(), array());
    }
    public static function filemtime() {
        return self::call('filemtime', func_get_args(), array());
    }
    public static function fileowner() {
        return self::call('fileowner', func_get_args(), array());
    }
    public static function fileperms() {
        return self::call('fileperms', func_get_args(), array());
    }
    public static function filesize() {
        return self::call('filesize', func_get_args(), array());
    }
    public static function filetype() {
        return self::call('filetype', func_get_args(), array());
    }
    public static function fopen() {
        $paths = array();
        if (0 !== strpos(func_get_arg(1), 'r')) {
            $paths = array(0);
        }
        return self::call('fopen', func_get_args(), $paths, array(3), array(2 => false));
    }
    public static function fclose() {
        return call_user_func_array('fclose', func_get_args());
    }
    public static function is_dir() {
        return self::call('is_dir', func_get_args(), array());
    }
    public static function is_executable() {
        return self::call('is_executable', func_get_args(), array());
    }
    public static function is_file() {
        return self::call('is_file', func_get_args(), array());
    }
    public static function is_link() {
        return self::call('is_link', func_get_args(), array());
    }
    public static function is_readable($filename) {
        $file = self::fopen($filename, 'r');
        if ($file !== false) {
            self:fclose($file);
            return true;
        }
        return false;
    }
    public static function is_writable($filename) {
        $filename = self::makePath($filename);
        if (self::is_dir($filename)) {
            return self::is_writable_dir($filename);
        } else {
            return self::is_writable_file($filename);
        }
    }
    public static function lstat() {
        return self::call('lstat', func_get_args(), array());
    }
    public static function mkdir() {
        return self::call('mkdir', func_get_args(), array(0), array(3), array(1 => 0777, 2 => false));
    }
    public static function move_uploaded_file() { //?
        return self::call('move_uploaded_file', func_get_args(), array(1));
    }
    public static function readfile() {
        return self::call('readfile', func_get_args(), array());
    }
    public static function rename() {
        $args = func_get_args();
        // remove existing file
        if (self::file_exists($args[1])) {
            self::unlink($args[1]);
        }
        return self::call('rename', $args, array(0,1), array(1));
    }
    public static function rmdir() {
        return self::call('rmdir', func_get_args(), array(0), array(1));
    }
    public static function stat() {
        return self::call('stat', func_get_args(), array());
    }
    public static function touch() { //?
        return self::call('touch', func_get_args(), array(0));
    }
    public static function unlink() {
        return self::call('unlink', func_get_args(), array(0), array(1));
    }

    // map directory functions
    // url wrapper is never used because ftps doesn't work (BUG!)
    public static function scandir() {
        return self::call('scandir', func_get_args(), array());
    }
    public static function opendir() {
        return self::call('opendir', func_get_args(), array());
    }
    public static function readdir() {
        return self::call('readdir', func_get_args(), array());
    }
    public static function rewinddir() {
        return self::call('rewinddir', func_get_args(), array());
    }
    public static function closedir() {
        return self::call('closedir', func_get_args(), array());
    }


    // helper functions
    protected static function is_writable_file($filename) {
        $unlink = self::file_exists($filename)?false:true;
        $handle = self::fopen($filename, 'ab');

        if ($handle !== false) {
            self::fclose($handle);
            if ($unlink) {
                self::unlink($filename);
            }
            return true;
        }
        return false;
    }

    protected static function is_writable_dir($filename) {
        do {
            $path = new Path($filename->getPath().DIRECTORY_SEPARATOR.mt_rand(0, 9999999), $filename->getType());
        } while (self::file_exists($path));

        $handle = self::fopen($path, 'ab');
        if ($handle !== false) {
            self:fclose($handle);
            self::unlink($path);
            return true;
        }
        return false;
    }
}
?>
