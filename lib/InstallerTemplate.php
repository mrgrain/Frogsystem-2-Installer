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
    public function setStyle($style, $target = 'current', $no_default = false) {
        $this->clearSectionCache();
        if (Files::file_exists(new Path('styles/'.$style, $target))) {
            $this->style = $style;
        } else if (!$no_default) {
            $this->style = 'default';
        } else {
            return false;
        }
    }

    // functions to access templates
    public function load($section) {
        // Wenn der Section-Cache wurde noch nicht befüllt wurde => alle Sections in den Cache laden
        if ( count ( $this->sections ) <= 0 ) {
            $file_path = $this->getFile (); // Pfad zur Template-Datei
            $search_expression = '/<!--section-start::(.*)-->(.*)<!--section-end::(\1)-->/Uis'; // Regulärer Ausruck um Sections auszuwählen
            $number_of_sections = preg_match_all ( $search_expression, Files::file_get_contents($file_path), $sections ); // Regulären Ausruck ausführen, Anzahl in $number_of_sections, Inhalte in $sections
            $this->setSections ( array_flip ( $sections[1] ) ); // array_flip damit die Keys auch die Section-Namen sind
            $this->setSectionsContent ( $sections[2] ); // Section Inhalte speichern
        }

        // Section-Cache wurde bereits befüllt => einfach auslesen
        if ( $this->sectionExists ( $section ) ) {
            $this->setTemplate ( $this->getSectionContent ( $this->getSectionNumber ( $section ) ) );
            return TRUE;
        } else { // Falls die Section nicht gefunden wurde
            return FALSE;
        }
    }

    // save template to file
    public function saveToFile() {
        $file_data = array();
        foreach ($this->sections as $name => $number) {
            $content = $this->sections_content[$number];
            $file_data[] = '<!--section-start::'.$name.'-->'.$content.'<!--section-end::'.$name.'-->';
        }

        return Files::file_put_contents($this->getFile(), implode(PHP_EOL.PHP_EOL, $file_data));
    }

    // save template to file
    private function fillSectionCache() {
        $template = $this->template;
        $this->load('tmp');
        $this->template = $template;
    }


    public function setFile($file, $target = "current") {
        $file_path = new Path('styles/'.$this->getStyle().'/'.$file,  $target);
        if (Files::is_readable($file_path)) {
            $this->file = $file_path;
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
        if ($source && Files::file_exists($source)) {
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

    public function createSectionFromFile($section, $source = null, $overwrite = true) {
        // load source
        $content = "";
        if ($source) {
            $content = Files::file_get_contents($source);
        }

        return $this->createSection($section, $content, $overwrite);
    }

    public function createSection($section, $content = "", $overwrite = true) {
        //overwrite?
        if (!$overwrite && $this->sectionExists($section)) {
            return false;
        }

        $this->sections[$section] = $section;
        $this->sections_content[$section] = $content;
        return $this->saveToFile();
    }
    public function removeSection($section) {
        if (!$this->sectionExists($section)) {
            return false;
        }
        unset($this->sections_content[$this->getSectionNumber($section)]);
        unset($this->sections[$section]);
        return $this->saveToFile();
    }
    public function moveSection($source, $target_file, $target_section, $overwrite = true) {
        if (!$this->sectionExists($source)) {
            return false;
        }
        $content = $this->getSectionContent($this->getSectionNumber($source));

        $other = new InstallerTemplate();
        $other->setStyle($this->getStyle(), 'target', false);
        $other->setFile($target_file, 'target');
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
        if (!$this->sectionExists($section)) {
            return false;
        }

        $sec = $this->getSectionContent($this->getSectionNumber($section));
        $this->sections_content[$this->getSectionNumber($section)] = str_replace(self::OPENER.$tag.self::CLOSER, $content, $this->getSectionContent($this->getSectionNumber($section)));
        return $this->saveToFile();
    }


/* copy n paste */
    private function getFile() {
        return $this->file;
    }
    private function setSections($sections) {
        $this->sections = $sections;
    }
    private function getSectionNumber($section) {
        return $this->sections[$section];
    }
    private function setSectionsContent($content) {
        $this->sections_content = $content;
    }
    private function getSectionContent($section_number) {
        return $this->sections_content[$section_number];
    }

    private function sectionExists ( $section ) {
        if ( isset ( $this->sections[$section] ) ) {
            return TRUE;
        }
        return FALSE;
    }
    private function setTemplate($template) {
        $this->template = $template;
    }
    private function getTemplate() {
        return $this->template;
    }
}
?>
