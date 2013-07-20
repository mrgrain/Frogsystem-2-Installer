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
    private static $uw = '';
    private static $current_dir = '';

    public static function setUrlWrapper($_uw, $_current_dir) {
        self::$uw = $_uw;
        self::$current_dir = $_current_dir;
    }

    private static function getPath($path) {
        return self::$uw.self::$current_dir.DIRECTORY_SEPARATOR.$path;
    }

    // is file wrapper
    private static function isFileWrapper() {
        if (empty(self::$uw)) {
            return true;
        }
        if (strpos(self::$uw, 'file') === 0) {
            return true;
        }
        return false;
    }

    // pseudo callStatic for functions
    private static function call($name, $arguments, $keys) {
        // prepend url-wrapper
        foreach($keys as $key) {
            $arguments[$key] = self::getPath($arguments[$key]);
        }
        // call function
        return call_user_func_array($name, $arguments);
    }


    // map filesystem functions
    public static function copy() {
        return self::call('copy', func_get_args(), array(0,1));
    }
    public static function file_exists() {
        return self::call('file_exists', func_get_args(), array(0));
    }
    public static function file_get_contents() {
        return self::call('file_get_contents', func_get_args(), array(0));
    }
    public static function file_put_contents() {
        return self::call('file_put_contents', func_get_args(), array(0));
    }
    public static function file() {
        return self::call('file', func_get_args(), array(0));
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
        return self::call('fopen', func_get_args(), array(0));
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
    public static function is_readable() {
        return self::call('is_readable', func_get_args(), array(0));
    }
    public static function is_writable() {
        return self::call('is_writable', func_get_args(), array(0));
    }
    public static function lstat() {
        return self::call('lstat', func_get_args(), array(0));
    }
    public static function mkdir() {
        return self::call('mkdir', func_get_args(), array(0));
    }
    public static function move_uploaded_file() { //?
        return self::call('move_uploaded_file', func_get_args(), array(1));
    }
    public static function readfile() {
        return self::call('readfile', func_get_args(), array(0));
    }
    public static function rename() {
        return self::call('rename', func_get_args(), array(0,1));
    }
    public static function rmdir() {
        return self::call('rmdir', func_get_args(), array(0));
    }
    public static function stat() {
        return self::call('stat', func_get_args(), array(0));
    }
    public static function touch() { //?
        return self::call('touch', func_get_args(), array(0));
    }
    public static function unlink() {
        return self::call('unlink', func_get_args(), array(0));
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
}
?>
