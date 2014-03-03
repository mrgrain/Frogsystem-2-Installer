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
    
    
    public function setFile($file) {
	}
	public function setSection($section) {
	}
	
	
	public function createFile($file, $content = null, $overwrite = true) {
	}
	public function removeFile($file) {	
	}
	public function moveFile($source, $target, $overwrite = true) {
	}
	
	public function createSection($section, $content = null, $overwrite = true) {
	}
	public function removeSection($section) {	
	}
	public function moveSection($source, $target_file, $target_section, $overwrite = true) {
		$content = $this->getSection($source);
		
		$other = new Template($style);
		$other->setFile($target_file);
		if ($other->createSection($target_section, $content, $overwrite)) {
			return $this->removeSection($source);
		} else {
			return false;
		}
	}
	
	public function renameTag($old, $new) {
		return $this->replaceTag($old, self::OPENER.$new.self::CLOSER);
	}
	public function replaceTag($tag, $content = null) {
	} 
	
}
?>
