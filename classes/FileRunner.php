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
    
    public function __construct($dir, $start, $end) {       
        // create filelist
        $this->dir = $dir;
        $list = scandir($dir);
        $list = array_diff($list, array('.', '..'));
        InstallerFunctions::orderByIncrementalFilenames($list);

        // call parent __construct
        parent::__construct($list, $start, $end);
    }
    
    public function load($file) {
        //TODO Generic Fileaccess FTP/NOT_FTP
        $lines = file($this->dir.$file);
        foreach ($lines as $line) {
            if ("" != trim($line)) {
                $command = $this->parse($line);
                if (false !== $command)
                    $this->addInstruction($command);
            }
        }
    }    


    protected function runInstruction($inst) {
        switch ($inst->command) {
            case 'copy':
                return Files::copy($inst->source, $inst->destination, $inst->recursive, $inst->overwrite);
                break;
            case 'delete':
                return Files::delete($inst->path, $inst->recursive);
                break;
            case 'move':
                return Files::move($inst->source, $inst->destination, $inst->overwrite);
                break;
            case 'is_writable':
                return Files::is_writable($inst->path, $inst->recursive);
                break;
        }
    }
    
    protected function getInfo($instruction) {
        return $instruction;
    }    
    

    // parse a command
    public static function parse($input) {
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
            $matches['second'] = Files::resolve_path($matches['second']);
            
        if (isset($matches['first'])) {
            $matches['first'] = Files::resolve_path($matches['first'], true);
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
