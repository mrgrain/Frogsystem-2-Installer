<?php
/**
 * @file     Path.php
 * @folder   /classes
 * @version  0.2
 * @author   Sweil
 *
 * A path representation with selectable prefixes and groups
 * e.g. for different base-folders or using a url wrapper
 */

class Path {

    const DEFAULT_GROUP = 'default';
    const DEFAULT_TYPE = 'default';

    protected static $prefixes = array(self::DEFAULT_GROUP => array(self::DEFAULT_TYPE => ''));
    protected $path;
    protected $type;

    public static function setPrefix($_prefix, $_type, $_group = self::DEFAULT_GROUP) {
        if (!isset(self::$prefixes[$_group])) {
            self::$prefixes[$_group] = array();
        }
        self::$prefixes[$_group][$_type] = $_prefix;
    }

    public function __construct($_path, $_type = self::DEFAULT_TYPE) {
        $this->path = $_path;
        $this->type = $_type;
    }

    public function get($_group = self::DEFAULT_GROUP) {
        $_type = $this->type;

        // group exists, but type not => keep group, get default type
        if (isset(self::$prefixes[$_group]) && !isset(self::$prefixes[$_group][$_type])) {
            $_type = self::DEFAULT_TYPE;
        }

        // group does not exist, use default group and keep type
        if (!isset(self::$prefixes[$_group]) || !isset(self::$prefixes[$_group][$_type])) {
            return $this->get(self::DEFAULT_GROUP);
        }

        return self::$prefixes[$_group][$_type].DIRECTORY_SEPARATOR.$this->path;
    }

    public function getType() {
        return $this->type;
    }

    public function getPath() {
        return $this->path;
    }

    public function setPath($_path) {
        $this->path = $_path;
    }

    public function __toString() {
        return $this->get();
    }
}
?>
