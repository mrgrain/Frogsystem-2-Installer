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

    // functions to set & get default values
    public function setStyle($style, $no_default = false) {
        $this->clearSectionCache();
        if (Files::file_exists(INSTALLER_PATH.DIRECTORY_SEPARATOR.'styles/'.$style)) {
            $this->style = $style;
        } else if ($no_default) {
            $this->style = 'default';
        } else {
            return false;
        }
    }

    // save template to file
    public function saveToFile() {
        $file_data = array();
        foreach ($this->sections as $name => $number) {
            $content = $this->sections_content[$number];
            $file_data[] = '<!--section-start::'.$name.'-->'.$content.'<!--section-end::'.$name.'-->';
        }

        $file_path =  new Path('styles/'.$this->getStyle().'/'.$this->getFile(), 'target');
        return Files::file_put_contents($file_path, implode(PHP_EOL.PHP_EOL, $file_data));
    }

    // save template to file
    private function fillSectionCache() {
        $template = $this->template;
        $this->load('tmp');
        $this->template = $template;
    }


    public function setFile($file) {
        if (Files::is_readable(new Path('styles/'.$this->getStyle().'/'.$file, 'target'))) {
            $this->file = $file;
            $this->clearSectionCache();
            $this->fillSectionCache();
        } else {
            $this->__destruct ();
        }
    }


    public function createFile($file, $source = null, $overwrite = true) {
        //overwrite?
        if (!$overwrite && Files::file_exists($file)) {
            return false;
        }

        // load source
        $content = "";
        if ($source) {
            $content = Files::file_get_contents($source);
        }
        return Files::file_put_contents($file, $content);
    }
    public function removeFile($file) {
        return Files::unlink($file);
    }
    public function moveFile($source, $target, $overwrite = true) {
        if ($this->createFile($target, $source, $overwrite)) {
            return $this->removeFile($source);
        }
        return false;
    }

    public function createSection($section, $source = null, $overwrite = true) {
        //overwrite?
        if (!$overwrite && $this->sectionExists($section)) {
            return false;
        }

        // load source
        $content = "";
        if ($source) {
            $content = Files::file_get_contents($source);
        }

        $this->sections[$section] = $section;
        $this->sections_content[$section] = $content;
        return $this->saveToFile();
    }
    public function removeSection($section) {
        unset($this->sections_content[$this->getSectionNumber($section)]);
        unset($this->sections[$section]);
        return $this->saveToFile();
    }
    public function moveSection($source, $target_file, $target_section, $overwrite = true) {
        $content = $this->getSectionContent($this->getSectionNumber($section));

        $other = new Template($style);
        $other->setStyle($this->getStyle());
        $other->setFile($target_file);
        if ($other->createSection($target_section, $content, $overwrite)) {
            return $this->removeSection($source);
        } else {
            return false;
        }
    }

    public function renameTag($section, $old, $new) {
        return $this->replaceTag($section, $old, self::OPENER.$new.self::CLOSER);
    }
    public function replaceTag($section, $tag, $content = "") {
        $sec = $this->getSectionContent($this->getSectionNumber($section));
        $this->sections_content[$this->getSectionNumber($section)] = str_replace(self::OPENER.$tag.self::CLOSER, $content, $this->getSectionContent($this->getSectionNumber($section)));
        return $this->saveToFile();
    }



}
?>
