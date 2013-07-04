<?php
/**
* @file     class_InstallerContent.php
* @folder   /libs
* @version  0.2
* @author   Sweil
*
* provides functionality to display installertemplates
*/

class InstallerContent extends adminpage 
{
    public function __construct ($file, $lang) {        
        // set name
        $this->name = basename($file, '.tpl');
        
        // set lang
        $this->setLang($lang);
        
        // load tpl file
        $path = INSTALLER_PATH.$file;

        if (is_readable($path)) {
            $this->loadTpl(file_get_contents($path));
        }
    }
    
    protected function langValue ($name) {
        return $this->lang->get($name);
    } 
    protected function commonValue ($name) {
        return $this->langValue($name);
    }
}
?>
