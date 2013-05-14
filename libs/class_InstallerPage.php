<?php
/**
* @file     class_InstallerPage.php
* @folder   /libs
* @version  0.2
* @author   Sweil
*
* provides functionality to display installertemplates
*/

class InstallerPage extends adminpage 
{
    function __construct ($file, $lang) {
        
        // set language object
        $this->setLang($lang);
        
        // set name
        $this->name = basename($file, '.tpl');

        // load tpl file
        $path = FS2_ROOT_PATH.$file;

        if (is_readable($path)) {
            $this->loadTpl(file_get_contents($path));
        }
    }
    
    private function langValue ($name) {
        return $this->lang->get($name);
    } 
    private function commonValue ($name) {
        return $this->langValue($name);
    }
}
?>
