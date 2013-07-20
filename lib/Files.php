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

    // set url-wrapper for filesystem functions
    protected static $uw = '';
    public static function setUrlWrapper($_uw, $_current_dir) {
        self::$uw = $_uw;
        self::$current_dir = $_current_dir;
    }

    // get path with current dir prefixed
    protected static function getPath($path) {
        return self::$uw.self::$current_dir.DIRECTORY_SEPARATOR.$path;
    }

    // is file wrapper
    protected static function isFileWrapper() {
        if (empty(self::$uw)) {
            return true;
        }
        if (strpos(self::$uw, 'file') === 0) {
            return true;
        }
        return false;
    }

    // pseudo callStatic for functions
    protected static function call($name, $arguments, $keys, $contexts = array(), $use_defaults = array()) {
        // prepend url-wrapper
        foreach($keys as $key) {
            $arguments[$key] = self::getPath($arguments[$key]);
        }

        // set context to overwrite
        $options = array('ftp' => array('overwrite' => true));
        foreach($contexts as $context) {
            if (isset($arguments[$context])) {
                stream_context_set_option($arguments[$context], $options);
            } else {
                $arguments[$key] = stream_context_create($options);
                foreach($use_defaults as $key => $default) {
                    if (!isset($arguments[$key])) {
                        $arguments[$key] = $default;
                    }
                }
            }
        }

        // call function
        return call_user_func_array($name, $arguments);
    }


    // map filesystem functions
    public static function copy() {
        return self::call('copy', func_get_args(), array(0,1), array(2));
    }
    public static function file_exists() {
        return self::call('file_exists', func_get_args(), array(0));
    }
    public static function file_get_contents() {
        return self::call('file_get_contents', func_get_args(), array(0), array(2), array(1 => false));
    }
    public static function file_put_contents() {
        return self::call('file_put_contents', func_get_args(), array(0), array(3), array(2 => 0));
    }
    public static function file() {
        return self::call('file', func_get_args(), array(0), array(2), array(1 => 0));
    }
    public static function fileatime() {
        return self::call('fileatime', func_get_args(), array(0));
    }
    public static function filectime() {
        return self::call('filectime', func_get_args(), array(0));
    }
    public static function filegroup() {
        return self::call('filegroup', func_get_args(), array(0));
    }
    public static function fileinode() {
        return self::call('fileinode', func_get_args(), array(0));
    }
    public static function filemtime() {
        return self::call('filemtime', func_get_args(), array(0));
    }
    public static function fileowner() {
        return self::call('fileowner', func_get_args(), array(0));
    }
    public static function fileperms() {
        return self::call('fileperms', func_get_args(), array(0));
    }
    public static function filesize() {
        return self::call('filesize', func_get_args(), array(0));
    }
    public static function filetype() {
        return self::call('filetype', func_get_args(), array(0));
    }
    public static function fopen() {
        return self::call('fopen', func_get_args(), array(0), array(3), array(2 => false));
    }
    public static function fclose() {
        return call_user_func_array('fclose', func_get_args());
    }
    public static function is_dir() {
        return self::call('is_dir', func_get_args(), array(0));
    }
    public static function is_executable() {
        return self::call('is_executable', func_get_args(), array(0));
    }
    public static function is_file() {
        return self::call('is_file', func_get_args(), array(0));
    }
    public static function is_link() {
        return self::call('is_link', func_get_args(), array(0));
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
        if (self::is_dir($filename)) {
            return self::is_writable_dir($filename);
        } else {
            return self::is_writable_file($filename);
        }
    }
    public static function lstat() {
        return self::call('lstat', func_get_args(), array(0));
    }
    public static function mkdir() {
        return self::call('mkdir', func_get_args(), array(0), array(3), array(1 => 0777, 2 => false));
    }
    public static function move_uploaded_file() { //?
        return self::call('move_uploaded_file', func_get_args(), array(1));
    }
    public static function readfile() {
        return self::call('readfile', func_get_args(), array(0));
    }
    public static function rename() {
        return self::call('rename', func_get_args(), array(0,1), array(1));
    }
    public static function rmdir() {
        return self::call('rmdir', func_get_args(), array(0), array(1));
    }
    public static function stat() {
        return self::call('stat', func_get_args(), array(0));
    }
    public static function touch() { //?
        return self::call('touch', func_get_args(), array(0));
    }
    public static function unlink() {
        return self::call('unlink', func_get_args(), array(0), array(1));
    }

    // map directory functions
    // url wrapper is never used!
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
        $unlink = self::file_exists($filename)?true:false;
        $file = self::fopen($filename, 'ab');
        if ($file !== false) {
            self:fclose($file);
            self::unlink($filename);
            return true;
        }
        return false;
    }

    protected static function is_writable_dir($filename) {
        do {
            $path = $filename.DIRECTORY_SEPERATOR.mt_rand(0, 9999999);
        } while (self::file_exists($path));

        $file = self::fopen($path, 'ab');
        if ($file !== false) {
            self:fclose($file);
            self::unlink($path);
            return true;
        }
        return false;
    }
}
?>
