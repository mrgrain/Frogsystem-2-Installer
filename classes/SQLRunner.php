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
    
    public function __construct($dir, $start, $end, $sql) {
        // sql & lang objects
        $this->sql = $sql;
        
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
        $instruction = trim($instruction);
        
        $create = array(
            'create_table'      => '/CREATE *(?:TEMPORARY)? *TABLE *(?:IF *NOT *EXISTS)? *`([^`]+)`.*/is', // CREATE TABLE
            'create_index'      => '/CREATE *(?:UNIQUE|FULLTEXT|SPATIAL)? *INDEX *`(?:[^`]+)`.*ON *`([^`]+)`.*/is', // CREATE (UNIQUE) INDEX
            'create_database'   => '/CREATE *DATABASE *(?:IF *NOT *EXISTS)? *`([^`]+)`.*/is', // CREATE DATABASE
        );
        $alter = array(
            'alter_table'       => '/ALTER *(?:IGNORE)? *TABLE *`([^`]+)`.*/is', // ALTER TABLE
            'alter_database'    => '/ALTER *DATABASE *`([^`]+)`.*/is', // ALTER DATABASE
        );
        $drop = array(
            'drop_table'        => '/DROP *(?:TEMPORARY)? *TABLE *(?:IF *EXISTS) *`([^`]+)`.*?/is', // DROP TABLE
            'drop_index'        => '/DROP *INDEX *`(?:[^`]+)` *ON *`([^`]+)`.*/is', // DROP INDEX
            'drop_database'     => '/DROP *DATABASE *(?:IF *EXISTS)? *`([^`]+)`.*/is', // DROP DATABASE
        );       
        $rest = array(
            'insert'            => '/INSERT *(?:LOW_PRIORITY|DELAYED|HIGH_PRIORITY)? *(?:IGNORE)? *(?:INTO)? *`([^`]+)`.*/is', // INSERT INTO
            'update'            => '/UPDATE *(?:LOW_PRIORITY)? *(?:IGNORE)? *`([^`]+)`.*/is', // UPDATE
            'delete'            => '/DELETE *(?:LOW_PRIORITY)? *(?:QUICK)? *(?:IGNORE)? *FROM *`([^`]+)`.*/is', // DELETE FROM
            'truncate'          => '/TRUCNATE *(?:TABLE)? *`([^`]+)`.*/is', // TRUNCATE
            'select'            => '/SELECT *(?:ALL|DISTINCT|DISTINCTROW)? *.*FROM`([^`]+)`.*/is', // SELECT (DISTINCT)
        );
        
        // limit set
        if (0 === stripos($instruction, 'CREATE')) $set = $create;
        elseif (0 === stripos($instruction, 'ALTER')) $set = $alter;
        elseif (0 === stripos($instruction, 'DROP')) $set = $drop;
        else $set = $rest;

        // brute force regex
        foreach ($set as $key => $pattern) {
            $matches = array();
            $result = preg_match($pattern, $instruction, $matches);
            if (false !== $result && $result > 0 && !empty($matches) && count($matches) >= 2) {
                return array($key, $matches[1]);
            }
        }
        
        // not matched
        return array('generic', null);       
    }    
    

}

?>
