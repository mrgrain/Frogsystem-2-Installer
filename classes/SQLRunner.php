<?php
/**
 * @file     SQLRunner.php
 * @folder   /classes
 * @version  0.1
 * @author   Sweil
 *
 * run a list of SQL instructions
 */
class SQLRunner extends IncrementalFSVersionRunner implements Iterator {
    
    private $sql;
    private $dir;
    
    public function __construct($dir, $start, $end) {
        // create sql connection
        $this->sql = new sql('localhost', 'fs2_installer', 'frogsystem', 'frogsystem', 'fs2_');
        
        // create filelist
        $this->dir = $dir;
        $list = scandir($dir);
        $list = array_diff($list, array('.', '..'));
        
        // call parent __construct
        parent::__construct($list, $start, $end);
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
        return $this->sql->doQuery($instruction);
    }
    

    
    protected  function getInfo($instruction) {
        $db_instructions = array(
            'CREATE DATABASE', 'DROP DATABASE',
            'CREATE TABLE', 'ALTER TABLE', 'DROP TABLE',
            'CREATE INDEX', 'CREATE UNIQUE INDEX', 'DROP INDEX',
            'INSERT INTO', 'UPDATE', 'DELETE DROM', 'TRUNCATE', 
            'SELECT', 'SELECT DISTINCT'
        );
        foreach ($db_instructions as $dbi) {
            if (false !== stripos($instruction, $dbi))
                return $dbi;
        }
        
        return 'GENERIC DATABASE OPERATION';
    }    
    

}

?>
