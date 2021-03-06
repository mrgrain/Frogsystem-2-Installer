<?php
/**
 * @file     TemplateRunner.php
 * @folder   /classes
 * @version  0.1
 * @author   Sweil
 *
 * run a list of instructions on templates
 */

class TemplateRunner extends IncrementalFSVersionRunner implements Iterator {

    private $dir;
    private $style;

    public function __construct($dir, $start, $end, $lang) {
        // langfile
        $this->lang = $lang;

        // create filelist
        $this->dir = $dir;
        $list = Files::scandir($dir);
        $list = array_diff($list, array('.', '..'));
        InstallerFunctions::orderByIncrementalFilenames($list);

        // call parent __construct
        parent::__construct($list, $start, $end);
    }

    public function load($file) {
        $lines = Files::file($this->dir.$file);
        foreach ($lines as $line) {
            if ("" != trim($line)) {
                $command = $this->parse($line);
                if (false !== $command)
                    $this->addInstruction($command);
            }
        }
    }

    public function currentIsOfType($type) {
        return ($type == $this->current()->command);
    }

    public function setStyle($style) {
        $this->style = $style;
    }


    protected function runInstruction($inst) {
		$tpl = new InstallerTemplate();
        $tpl->setStyle($this->style, 'target', true);

        $prefix = 'styles'.DIRECTORY_SEPARATOR.$tpl->getStyle().DIRECTORY_SEPARATOR;

        $result = false;
        switch ($inst->command) {
            case 'file':
                switch ($inst->type) {
                    case 'create':
                        if (isset($inst->second_file)) {
                            $result = $tpl->createFile(new Path($prefix.$inst->file, 'target'), new Path($inst->second_file, 'current'));
                        } else {
                            $result = $tpl->createFile(new Path($prefix.$inst->file, 'target'));
                        }
                        break;
                    case 'delete':
                        $result = $tpl->removeFile(new Path($prefix.$inst->file, 'target')); // NOT IMPLEMENTED
                        break;
                    case 'move':
                        $result = $tpl->moveFile(new Path($prefix.$inst->file, 'target'), new Path($prefix.$inst->second_file, 'target')); // NOT IMPLEMENTED
                        break;
                }
                break;

            case 'section':
				$tpl->setFile($inst->file, 'target');
                switch ($inst->type) {
                    case 'create':
                        if (isset($inst->second_file)) {
                            $result = $tpl->createSectionFromFile($inst->section, new Path($inst->second_file, 'current'));
                        } else {
                            $result = $tpl->createSection($inst->section);
                        }
                        break;
                    case 'delete':
                        $result = $tpl->removeSection($inst->section); // NOT IMPLEMENTED
                        break;
                    case 'move':
                        $result = $tpl->moveSection($inst->section, $inst->second_file, $inst->second_section, true);
                        break;
                }
                break;

            case 'tag':
				$tpl->setFile($inst->file, 'target');
                switch ($inst->type) {
                    case 'rename':
                        $result = $tpl->renameTag($inst->section, $inst->tag, $inst->new);
                        break;
                    case 'replace':
                        if (!empty($inst->new)) {
                            $new = new Path($inst->new, 'current');
                            $result = $tpl->replaceTag($inst->section, $inst->tag, Files::file_get_contents($new));
                        } else {
                            $result = $tpl->replaceTag($inst->section, $inst->tag);
                        }
                        break;
                }
                break;

            case 'info':
            default:
                $result = true;
        }
        unset($tpl);

        if(false === $result) {
            throw new TemplateOperationException('Error with command `'.$inst->command.'`.');
        }

        return $result;
    }


    protected function getInfo($inst) {
        $info = $this->lang->get('info_'.$inst->command.'_'.$inst->type);

        switch ($inst->command) {
            case 'file':
                switch ($inst->type) {
                    case 'create':
                        if (isset($inst->second_file)) {
                            return sprintf($this->lang->get('info_'.$inst->command.'_'.$inst->type.'_from'),
                                           $inst->file, $inst->second_file);
                        } else {
                            return sprintf($info, $inst->file);
                        }
                    case 'delete':
                        return sprintf($info, $inst->file);
                    case 'move':
                        return sprintf($info, $inst->file, $inst->second_file);
                }

            case 'section':
                switch ($inst->type) {
                    case 'create':
                        if (isset($inst->second_file)) {
                            return sprintf($this->lang->get('info_'.$inst->command.'_'.$inst->type.'_from'),
                                           $inst->file, $inst->section, $inst->second_file);
                        } else {
                            return sprintf($info, $inst->file, $inst->section);
                        }
                    case 'delete':
                        return sprintf($info, $inst->file, $inst->section);
                    case 'move':
                        return sprintf($info, $inst->file, $inst->section, $inst->second_file, $inst->second_section);
                }

            case 'tag':
                switch ($inst->type) {
                    case 'rename':
                        return sprintf($info, $inst->file, $inst->section, $inst->tag, $inst->new);
                    case 'replace':
                        if (!empty($inst->new)) {
                            return sprintf($info, $inst->file, $inst->section, $inst->tag, $inst->new);
                        } else {
                            return sprintf($this->lang->get('info_'.$inst->command.'_'.$inst->type.'_empty'),
                                           $inst->file, $inst->section, $inst->tag);
                        }
                }

            case 'info':
                switch ($inst->type) {
                    case 'note':
                        return sprintf($info, $this->lang->get($inst->lang.'_title'), $this->lang->get($inst->lang.'_text'));
                    case 'file':
                        return sprintf($info, $inst->file, $this->lang->get($inst->lang));
                    case 'section':
                        return sprintf($info, $inst->file, $inst->section, $this->lang->get($inst->lang));
                    case 'tag':
                        return sprintf($info, $inst->file, $inst->section, $inst->tag, $this->lang->get($inst->lang));
                }

            default:
                return $inst->command;
        }
        return false;
    }


    /* parse a template command in fs2installer syntax
     *
     * SYNTAX-DOCUMENTATION:
     * All operations will be done in all style directories. so if a
     * command references to "0_main.tpl" the corresponding file
     * in the every single style directory (except default) will be
     * modified. Of cource this only applies on styles, selected by the
     * user to convert.
     *
     * FILE PATHS:
     *      ./  will be replaced by path to the installer
     *      ~/  will be replaced by path to installation target
     *
     * COMMANDS:
     * # <= a hash in front of a command means: not yet implemented ;)
     *
     *      FILE
     *      operating with whole template files
     *      Examples:
     *          FILE CREATE 0_main.tpl
     *          FILE CREATE -O 0_main.tpl ./path/to/source/file
     *          FILE DELETE 0_main.tpl
     *          FILE MOVE -O 0_old.tpl 0_new.tpl
     *
     *          CREATE [-(OPTIONS)] filename [source]
     *          creates an empty file called "filename", unless the path
     *          to a source file is provided.
     *              O   overwrite if file already exists
     *
     *          #DELETE filename
     *          delete the file called "filename"
     *
     *          #MOVE [-(OPTIONS)] oldfile newfile
     *          rename file from "oldfile" to "newfile"
     *              O   overwrite if newfile already exists
     *
     *
     *      SECTION
     *      operating with sections
     *      Examples:
     *          SECTION CREATE 0_main.tpl COPYRIGHT
     *          SECTION CREATE -O 0_main.tpl HEADER ./path/to/source/file
     *          #SECTION DELETE 0_main.tpl FOOTER
     *          SECTION MOVE -O 0_old.tpl CONTENT 0_new.tpl BODY
     *
     *          CREATE [-(OPTIONS)] filename sectionname [source]
     *          creates an empty section named "sectionname" in the file
     *          called "filename". if the path to a source file is
     *          provided, all content of source will be placed inside
     *          the new section.
     *              O   overwrite if section already exists
     *
     *          DELETE filename sectionname
     *          delete the section called "sectionname" from file "filename"
     *
     *          MOVE [-(OPTIONS)] sourcefile sourcesection targetfile sectionname
     *          moves the section "sourcesection" of file "sourcefile" to
     *          "targetfile" and renames it "sectionname"
     *              O   overwrite if new section already exists in "targetfile"
     *
     *
     *      TAG
     *      operating with specific tags of a section
     *      Examples:
     *          TAG RENAME 0_search.tpl RESULT_LINE num_matches rank
     *          TAG REPLACE 0_main.tpl FOOTER a_tag ./path/to/source/file
     *          TAG REPLACE 0_main.tpl NONSENSE a_tag
     *
     *          RENAME filename sectionname oldtag newtag
     *          replace all occurances of "{..oldtag..}" with "{..newtag..}"
     *          in the section "sectionname" of file "filename"
     *
     *          REPLACE filename sectionname tagname [source]
     *          replace all occurances of "{..tagname..}" with the content
     *          from a source file. if no source file is given, "{..tagname..}"
     *          will be replaced by an empty string (i.e. deleted).
     *
     *
     *      INFO [file] [section] [tag] langtext
     *      displaying informations on changes that cannot be done by a script.
     *      text will be read from the lang-system, using "langtext" as
     *      identifier. if provided, given file, section and tag will be
     *      displayed additionally.
     *
     *      Examples:
     *          INFO 0_search.tpl search_info
     *          INFO 0_main.tpl FOOTER footer_info
     *          INFO 0_main.tpl HEADER punchline footer_new_tag_info
     *
     */
    private static function parse($input) {
        $commands = array(
            'file'              => '/^FILE *(?P<type>CREATE|DELETE|MOVE) *(?:-(?P<params>O))? *("|\')?(?P<first>(?(3)[^\3]|[^\s])+)(?(3)\3)( *("|\')?(?P<second>(?(5)[^\5]|[^\s])+)(?(5)\5))?.*/i',
            'section'           => '/^SECTION *(?P<type>CREATE|MOVE) *(?:-(?P<params>O))? *("|\')?(?P<first>(?(3)[^\3]|[^\s])+)(?(3)\3) *("|\')?(?P<second>(?(5)[^\5]|[^\s])+)(?(5)\5)(?: *("|\')?(?P<third>(?(7)[^\7]|[^\s])+)(?(7)\7))?(?: *("|\')?(?P<fourth>(?(9)[^\9]|[^\s])+)(?(9)\9))?.*/i',
            'section_delete'    => '/^SECTION *(?P<type>DELETE) *("|\')?(?P<first>(?(2)[^\2]|[^\s])+)(?(2)\2) +("|\')?(?P<second>(?(4)[^\4]|[^\s])+)(?(4)\4).*/i',
            'tag'               => '/^TAG *(?P<type>RENAME|REPLACE) *("|\')?(?P<first>(?(2)[^\2]|[^\s])+)(?(2)\2) *("|\')?(?P<second>(?(4)[^\4]|[^\s])+)(?(4)\4) *("|\')?(?P<third>(?(6)[^\6]|[^\s])+)(?(6)\6)(?: *("|\')?(?P<fourth>(?(8)[^\8]|[^\s])+)(?(8)\8))?.*/i',
            'info'              => '/^INFO *("|\')?(?P<first>(?(1)[^\1]|[^\s])+)(?(1)\1)(?: *("|\')?(?P<second>(?(3)[^\3]|[^\s])+)(?(3)\3))?(?: *("|\')?(?P<third>(?(5)[^\5]|[^\s])+)(?(5)\5))?(?: *("|\')?(?P<fourth>(?(7)[^\7]|[^\s])+)(?(7)\7))?.*/i',
        );

        // brute force regex
        $input = trim($input);
        foreach ($commands as $command => $pattern) {
            $matches = array();
            $result = false;
            $result = preg_match($pattern, $input, $matches);
            if (false !== $result && $result > 0 && !empty($matches) && count($matches) >= 2) {
                break;
            }

        }

        // not matched
        if (!$result) {
            return false;
        }

        // Get named matches
        $args = array_intersect_key($matches, array_flip(array('type', 'first', 'second', 'third', 'fourth')));

        // switch commands
        $res = new StdClass();
        $res->command = $command;
        switch ($command) {
            case 'file':
                $res->type = strtolower($args['type']);
                $res->file = $args['first'];
                if (isset($args['second'])) $res->second_file = $args['second'];
                $res->overwrite = ('O' == strtoupper($matches['params']));

                if ('create' == $res->type && isset($res->second_file)) {
                    $res->second_file = FilesX::resolve_path($res->second_file);
                }
                break;
            case 'section':
                $res->type = strtolower($args['type']);
                $res->file = $matches['first'];
                $res->section = $args['second'];
                $res->overwrite = ('O' == strtoupper($matches['params']));

                if (isset($args['third'])) $res->second_file = $args['third'];
                if (isset($args['fourth'])) $res->second_section = $args['fourth'];

                if ('create' == $res->type && isset($res->second_file)) {
                    $res->second_file = FilesX::resolve_path($res->second_file);
                }
                break;
            case 'section_delete':
                $res->command = 'section';
                $res->type = strtolower($args['type']);
                $res->file = $args['first'];
                $res->section = $args['second'];
                break;
            case 'tag':
                $res->type = strtolower($args['type']);
                $res->file = $args['first'];
                $res->section = $args['second'];
                $res->tag = $args['third'];

                // fourth
                if ('replace' == $res->type && isset($args['fourth'])) {
                    $args['fourth'] = FilesX::resolve_path($args['fourth']);
                }
                if (!isset($args['fourth'])) {
                    $args['fourth'] = null;
                }
                $res->new = $args['fourth'];

                break;
            case 'info':
                $res->type = 'note';
                $res->lang = array_pop($args);

                if (isset($args['first'])) {
                    $res->file = $args['first'];
                    $res->type = 'file';
                }
                if (isset($args['second'])) {
                    $res->section = $args['second'];
                    $res->type = 'section';
                }
                if (isset($args['third'])) {
                    $res->tag = $args['third'];
                    $res->type = 'tag';
                }
                break;
        }

        return $res;
    }

    public static function getStyleIniData($STYLE_INI_FILE) {
        $ini_lines = Files::file($STYLE_INI_FILE);
        $ini_lines = array_map('trim', $ini_lines);
        $ini_lines = array_map('htmlspecialchars', $ini_lines);

        return (object) array(
            'name'          => !empty($ini_lines[0]) ? $ini_lines[0] : null,
            'version'       => !empty($ini_lines[1]) ? $ini_lines[1] : null,
            'copyright'     => !empty($ini_lines[2]) ? $ini_lines[2] : null,
            'fs2_version'     => !empty($ini_lines[3]) ? $ini_lines[3] : null
        );
    }
}

?>
