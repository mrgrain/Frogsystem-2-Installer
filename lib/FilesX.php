<?php
/**
 * @file     FilesX.php
 * @folder   /classes
 * @version  0.4
 * @author   Sweil
 *
 * extended file operations
 */

class FilesX extends Files {

    // COPY (-RO)? "soruce" "destination"
    public static function x_copy($source, $destination, $recursive = false, $overwrite = false) {
        // source is array
        if (is_array($source)) {
            $result = true;
            foreach($source as $path) {
                $result = self::x_copy($path, $destination, $recursive, $overwrite) && $result;
            }
            return $result;
        }

        // source file
        if (self::is_file($source)) {

            // target folder
                // => change destination path to file name and call myself
            if (self::is_dir($destination)) {
                $target_path = new Path($destination->getPath().DIRECTORY_SEPARATOR.basename($source->getPath()), $destination->getType());
                return self::x_copy($source, $target_path, $recursive, $overwrite);

            //target file
                // => copy (or overwrite?) and rename
            } elseif ($overwrite || !self::file_exists($destination)) {
                return self::copy($source, $destination);
            }

        // recursive: source is folder, target folder exists
        } elseif ($recursive && self::is_dir($source) && self::is_dir($destination)) {

            // create target path
            $target_path = new Path($destination->getPath().DIRECTORY_SEPARATOR.basename($source->getPath()), $destination->getType());

            // target folder not yet exists
            if (!self::file_exists($target_path)) {

                // get permissions of parent
                $perms = octdec(intval(substr(decoct(@self::fileperms($destination)),1)));
                $oldumask = @umask(0);

                if (!@self::mkdir($target_path, $perms, $recursive)) {
                    @umask($oldumask);
                    return false;
                }
                @umask($oldumask);
            }

            // x_copy each file
            $copied = true;
            foreach(self::scandir($source) as $entry) {
                if ($entry != "." && $entry != "..") {
                    $copied = self::x_copy(new Path($source->getPath().DIRECTORY_SEPARATOR.$entry, $source->getType()), $target_path, $recursive, $overwrite) && $copied;
                }
            }
            return $copied;
        }
        return false;
    }


    // DELETE (-R)? "path"
    public static function x_delete($path, $recursive = false) {
        // $path is array
        if (is_array($path)) {
            $result = true;
            foreach($path as $p) {
                $result = self::x_delete($p, $recursive) && $result;
            }
            return $result;
        }

        // path file
            // => delete file
        if (self::is_file($path))
            return @self::unlink($path);
        // path folder
        if (self::is_dir($path)) {
            if (!$recursive) {
                return @self::rmdir($path);
            } else {
                // recursivly?
                    // => delete recursivly
                $removed = true;
                foreach(self::scandir($path) as $entry) {
                    if ($entry != "." && $entry != "..")
                        $removed = self::x_delete(new Path($path->getPath().DIRECTORY_SEPARATOR.$entry, $path->getType()), true) && $removed;
                }
                return @self::rmdir($path) && $removed;
            }
        }

        return false;
    }

    // MOVE (-O)? "source" "destination"
    public static function x_move($source, $destination, $overwrite = false) {
        // source is array
        if (is_array($source)) {
            $result = true;
            foreach($source as $s) {
                $result = self::x_move($s, $destination, $overwrite) && $result;
            }
            return $result;
        }

        // target not existing
            // => rename
        // target file
            // => rename if overwrite
        if (!self::file_exists($destination) || $overwrite)
            return self::rename($source, $destination);

        // source is file and target folder
            // => rename if target not exists
        $new_dest = new Path($destination->getPath().DIRECTORY_SEPARATOR.basename($source->getPath()), $destination->getType());
        if (self::is_file($source) && self::is_dir($destination) && !self::file_exists($new_dest))
            return self::rename($source, $new_dest);
    }

    // IS_WRITABLE (-R)? "path"
    public static function x_is_writable($path, $recursive = false) {

        // path is array
        if (is_array($path)) {
            $result = true;
            foreach($path as $p) {
                $result = self::x_is_writable($p, $recursive) && $result;
            }
            return $result;
        }

        // path not existing
        if (!self::file_exists($path)) {
            return self::x_is_writable(new Path(dirname($path->getPath()), $path->getType()), false);
        }

        // recursively ?
        if ($recursive && self::is_dir($path)) {
        // folder & recursive
            // => each file and folder and subfolders are writable
            $writable = self::is_writable($path);
            foreach(self::scandir($path) as $entry) {
                if (!$writable)
                    break;

                if ($entry != "." && $entry != "..")
                    $writable = self::x_is_writable(new Path($path->getPath().DIRECTORY_SEPARATOR.$entry, $path->getType()), $recursive) && $writable;
            }
            return $writable;

        } else {
        // source file
            // => is wrtiable?
        // source folder
            // => is wrtiable?
            return self::is_writable($path);
        }

        return false;
    }


    // resolve path
    public static function resolve_path($path, $star = false) {
        // installer_path or install_to path
        $start = substr($path, 0, 2);
        if ("./" == $start || ".".DIRECTORY_SEPARATOR == $start) {
            $path = new Path(substr($path, 2), 'current');
        } elseif ("~/" == $start || "~".DIRECTORY_SEPARATOR == $start) {
            $path = new Path(substr($path, 2), 'target');
        } else {
            $path = new Path($path);
        }

        // all files in folder
        $end = substr($path->getPath(),-2,2);
        if ($star && ('/*' == $end || DIRECTORY_SEPARATOR.'*' == $end)) {
            $shortpath = new Path(substr($path->getPath(),0,-1), $path->getType());
            if (Files::is_dir($shortpath)) {
                $pathes = array();
                foreach(self::scandir($shortpath) as $entry) {
                    if ($entry != "." && $entry != "..") {
                        $pathes[] = new Path($shortpath->getPath().$entry, $shortpath->getType());
                    }
                }
                return $pathes;
            }
        }
        return $path;
    }
}
?>
