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

    private $targets;
    private $dir;

    public function __construct($targets, $dir, $start, $end, $lang) {
        // target array
        $this->targets = $targets;

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


    protected function runInstruction($inst) {
        $result = false;
        switch ($inst->command) {
            case 'copy':
                $result = FilesX::x_copy($inst->source, $inst->destination, $inst->recursive, $inst->overwrite);
                break;
            case 'delete':
                $result = FilesX::x_delete($inst->path, $inst->recursive);
                break;
            case 'move':
                $result = FilesX::x_move($inst->source, $inst->destination, $inst->overwrite);
                break;
            case 'is_writable':
                $result = FilesX::x_is_writable($inst->path, $inst->recursive);
                break;
        }

        if(!$result) {
            throw new FileOperationException('Error with command `'.$inst->command.'`.');
        }
    }


    protected function getInfo($inst) {
        switch ($inst->command) {
            case 'copy':
                $source = (is_array($inst->source))?dirname($inst->source[0]).'/*':$inst->source;
                return sprintf($this->lang->get('info_'.$inst->command), $source, $inst->destination);
                break;
            case 'delete':
                $path = (is_array($inst->path))?dirname($inst->path[0]).'/*':$inst->path;
                return sprintf($this->lang->get('info_'.$inst->command), $path);
                break;
            case 'move':
                $source = (is_array($inst->source))?dirname($inst->source[0]).'/*':$inst->source;
                return sprintf($this->lang->get('info_'.$inst->command),$source, $inst->destination);
                break;
            case 'is_writable':
                $path = (is_array($inst->path))?dirname($inst->path[0]).'/*':$inst->path;
                return sprintf($this->lang->get('info_'.$inst->command), $path);
                break;
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
     *          SECTION DELETE 0_main.tpl FOOTER
     *          SECTION MOVE -O 0_old.tpl CONTENT 0_new.tpl BODY
     *
     *          CREATE [-(OPTIONS)] filename sectionname [source]
     *          creates an empty section named "sectionname" in the file
     *          called "filename". if the path to a source file is
     *          provided, all content of source will be placed inside
     *          the new section.
     *              O   overwrite if section already exists
     *
     *          #DELETE filename sectionname
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
     *          TAG REPLACE 0_main.tpl FOOTER ./path/to/source/file
     *          TAG REPLACE 0_main.tpl NONSENSE
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
            'copy'              => '/^COPY *(?:-(?P<params>[OR]{1,2}))? *("|\')?(?P<first>(?(2)[^\2]|[^\s])+)(?(2)\2) *("|\')?(?P<second>(?(4)[^\4]|[^\s])+)(?(4)\4).*/i',
            'delete'            => '/^DELETE *(?:-(?P<params>R))? *("|\')?(?P<first>(?(2)[^\2]|[^\s])+)(?(2)\2).*/i',
            'move'              => '/^MOVE *(?:-(?P<params>O))? *("|\')?(?P<first>(?(2)[^\2]|[^\s])+)(?(2)\2) *("|\')?(?P<second>(?(4)[^\4]|[^\s])+)(?(4)\4).*/i',
            'is_writable'       => '/^IS_WRITABLE *(?:-(?P<params>R))? *("|\')?(?P<first>(?(2)[^\2]|[^\s])+)(?(2)\2).*/i',
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

        // resolve pathes
        if (isset($matches['second']))
            $matches['second'] = FilesX::resolve_path($matches['second']);

        if (isset($matches['first'])) {
            $matches['first'] = FilesX::resolve_path($matches['first'], true);
        }

        // switch commands
        $res = new StdClass();
        $res->command = $command;
        switch ($command) {
            case 'copy':
                $res->writable = $matches['second'];
                $res->source = $matches['first'];
                $res->destination = $matches['second'];
                $res->recursive = (in_array('R', str_split(strtoupper($matches['params']))));
                $res->overwrite = (in_array('O', str_split(strtoupper($matches['params']))));
                break;
            case 'delete':
                $res->writable = $matches['first'];
                $res->path = $matches['first'];
                $res->recursive = ('R' == strtoupper($matches['params']));
                break;
            case 'move':
                $res->writable = $matches['second'];
                $res->source = $matches['first'];
                $res->destination = $matches['second'];
                $res->overwrite = ('O' == strtoupper($matches['params']));
                break;
            case 'is_writable':
                $res->writable = $matches['first'];
                $res->path = $matches['first'];
                $res->recursive = ('R' == strtoupper($matches['params']));
                break;
        }

        return $res;
    }
}

?>
