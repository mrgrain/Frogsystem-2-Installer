<?php
/**
 * @file     FileRunner.php
 * @folder   /classes
 * @version  0.1
 * @author   Sweil
 *
 * run a set of File instructions
 */
class FileRunner extends IncrementalFSVersionRunner implements Iterator {
    
    private $sql;
    private $dir;
    private $options;
    
    public function __construct($dir, $start, $end) {
        // init options
        $this->options = array(
            'copy' => true,
            'delete' => false,
            'chmod' => false,            
        );
        
        // create sql connection
        //~ $this->sql = new sql('localhost', 'fs2_installer', 'frogsystem', 'frogsystem', 'fs2_');
        
        // create filelist
        $this->dir = $dir;
        $list = scandir($dir);
        $list = array_diff($list, array('.', '..'));
        
        // call parent __construct
        parent::__construct($list, $start, $end);
    }
    
    public function setOptions(array $opt) {
        $this->options = $opt;
    }
    
    public function load($file) {
        //TODO Generic Fileaccess FTP/NOT_FTP
        $lines = file($this->dir.$file);
        $last_instruction = "";
        foreach ($lines as $line) {
            $last_instruction .= $line;
            if (';' === substr(trim($line), -1)) {
                $this->addInstruction($last_instruction);
                $last_instruction = '';
            }
        }
    }    


    protected function runInstruction($instruction) {
        //TODO
        return $instruction;
    }
    

    
    protected  function getInfo($instruction) {
        //TODO
        return $instruction;
    }    
    

}

?>
