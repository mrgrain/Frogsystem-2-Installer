<?php
/**
* @file     class_InstallerLang.php
* @folder   /libs/
* @version  0.1
* @author   Sweil
*
* this class is responsible for the language operations of the installer
*
*/

class InstallerLang extends lang
{
   
    // constructor
    public function  __construct ($local, $type = false) {
        //~ require_once(INSTALLER_PATH.'includes/indexfunctions.php');

        $this->local = $local;

        if ($type !== false)
            $this->setType($type);
    }
    
    // function to assign phrases to tags
    protected function add($tag, $text) {
        $this->phrases[$tag] = $text;
    }
    
    // function to extend a phrase
    protected function extend($tag, $text) {
        $this->phrases[$tag] = $this->phrases[$tag].$text;
    }        
}
?>
