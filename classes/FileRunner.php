<?php
/**
 * @file     FileRunner.php
 * @folder   /classes
 * @version  0.1
 * @author   Sweil
 *
 * run a list of FileOperations instructions
 */

class FileRunner extends IncrementalFSVersionRunner implements Iterator {

    private $dir;

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

    public function isWritable($inst) {
        switch ($inst->command) {
            case 'delete':
            case 'is_writable':
                return FilesX::x_is_writable($inst->writable, $inst->recursive);
                break;
            case 'copy':
            case 'move':
            default:
                return FilesX::x_is_writable($inst->writable, false);
                break;
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


    /* parse a file command in fs2installer syntax
     *
     * SYNTAX-DOCUMENTATION:
     *
     * FILE PATHS:
     *      ./  will be replaced by path to the installer
     *      ~/  will be replaced by path to installation target
     *      Paths with a space MUST be enclosed by quotes. Others MAY be.
     *
     * WILDCARDS:
     *      /*  at the very end of a path to a directory MAY be
     *          interpreted as "all files and directories in this
     *          directory, do this"
     *          (possible use is indicated by a * after the argument)
     *      Atm all paths with a wildcard MUST be enclosed by quotes.
     *
     * COMMANDS:
     *
     *      COPY [-(OPTIONS)] source* target
     *      copy files from source to target. if source is a file copy
     *      file to target (in target if target is a directory)
     *          R   copy recursive if source is a directory
     *          O   overwrite if target exists
     *
     *      DELETE [-(OPTIONS)] path*
     *      delete file or empty directory speciefied by path
     *          R   delete a non empty directory recursivly
     *
     *      MOVE [-(OPTIONS)] source* target
     *      move file or directory from source to target. if source is a
     *      file and target a directory, move file into directory
     *          O   overwrite if target exists
     *
     *      IS_WRITABLE [-(OPTIONS)] path*
     *      checks wheter a file or directory is writable
     *          R   check each file and directory recursivly
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
