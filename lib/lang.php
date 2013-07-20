<?php
/**
* @file     class_lang.php
* @folder   /libs/
* @version  0.4
* @author   Sweil
*
* this class is responsible for the language operations
*
*/

class lang
{
    // vars for class options
    protected $local              = null;
    protected $type               = null;

    // other vars
    protected $phrases            = array();


    // constructor
    public function  __construct ($local = false, $type = false) {
        if ($local == false)
            $this->local = $FD->cfg('language_text');
        else
            $this->local = $local;

        if ($type !== false)
            $this->setType($type);
    }

    // destructor
    public function  __destruct(){
        unset($this->local, $this->type, $this->phrases);
    }


    // function to assign phrases to tags
    protected function add($tag, $text) {
        $this->phrases[$tag] = tpl_functions($text, 1, array('DATE', 'VAR', 'URL'));
    }

    // function to extend a phrase
    protected function extend($tag, $text) {
        $this->phrases[$tag] = $this->phrases[$tag].tpl_functions($text, 1, array('DATE', 'VAR', 'URL'));
    }

    // load text data
    protected function import(&$data) {
        $imports = array();
        preg_match_all('/#@([-a-z0-9\/_]+)\\n/is', $data, $imports, PREG_SET_ORDER);
        foreach ($imports as $import) {
            $importPath = INSTALLER_PATH . DIRECTORY_SEPARATOR. 'lang/' . $this->local . '/' . $import[1] . '.txt';
            $importData = @Files::file_get_contents($importPath);

            // getting file content ok
            if ($importData != false) {
                $importData = str_replace(array("\r\n", "\r"), "\n", $importData); // unify linebreaks
                $this->import($importData);
                $replace = '/#@'.preg_quote($import[1], '/').'/i';
                $data = preg_replace($replace, $importData, $data);
               // replace all imports recursive
            }
        }
        unset($imports);
    }

    // load text data
    protected function load() {
        // reset phrases
        $this->phrases = array();

        // set file path
        $langDataPath = INSTALLER_PATH . DIRECTORY_SEPARATOR. 'lang/' . $this->local . '/' . $this->type . '.txt';

        // include language data file
        if (Files::file_exists($langDataPath)) {
            // load file
            $langData = Files::file_get_contents($langDataPath);
            $langData = str_replace(array("\r\n", "\r"), "\n", $langData); // unify linebreaks
            $this->import($langData);

            // get lines
            $langData = preg_replace("/^#.*?\n/is", '', $langData);
            $langData = explode("\n", $langData);

            // Run through lines
            $last = false;
            foreach ($langData as $line) {
                $match = array();

                // match line extender
                if (false !== $last) {
                    preg_match("~^#\/(.*)~i", $line, $match);
                    if (count($match) == 2) {
                        $this->extend($last, PHP_EOL.$match[1]);
                        continue;
                    }
                }

                // match content
                preg_match ("#([a-z0-9_-]+?)\s*?:\s*(.*)#is", $line, $match);
                if (count($match) >= 2) {
                    $last = $match[1];
					$this->add($match[1], $match[2]);
				} else {
                    $last = false;
                }
            }
        } else {
            Throw new Exception('Language File not found: '.$langDataPath);
        }
    }



    // set used file
    public function setType($type) {
        $this->type = $type;
        try {
            $this->load();
        } catch (Exception $e) {
            throw $e;
           // $this->phrases = array();
        }
    }

    // function to display phrases
    public function get($tag) {
        if ( !isset($this->phrases[$tag]) || $this->phrases[$tag] == '' ) {
            return 'LOCALIZE ['.$this->local.']: ' . $tag;
        } else {
            return $this->phrases[$tag];
        }
    }

}
?>
