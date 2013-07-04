<?php
/**
* @file     class_InstallerTemplate.php
* @folder   /libs
* @version  0.2
* @author   Sweil
*
* provides functionality to display installertemplates
*/

class InstallerTemplate extends template 
{
    // constructor
    public function  __construct() {
         $this->setStyle('installer');
    }
}
?>
