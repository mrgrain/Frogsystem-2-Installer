<?php
/**
 * @file     SQLRunner.php
 * @folder   /classes
 * @version  0.1
 * @author   Sweil
 *
 * run a list of SQL instructions
 */
class SQLRunner extends Runner implements Iterator {
    
    private $sql;
    
    public function __construct($file) {
        parent::__construct($file);
        
        // create sql connection
        $this->sql = new sql('localhost', 'fs2_installer', 'frogsystem', 'frogsystem', 'fs2_');
        
        //TODO Generic Fileaccess FTP/NOT_FTP
        $lines = file($file);
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
        $this->lastInstruction = $instruction;
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
