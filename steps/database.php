<?php
/**
* @file     database.php
* @folder   /steps
* @version  0.1
* @author   Sweil
*
* database operations
*/

// load content object
$ic = $page->getIC('database.tpl');

// check post
if (isset($_POST['db_host']) && isset($_POST['db_data']) && isset($_POST['db_user']) && isset($_POST['db_pass']) && isset($_POST['db_pref'])
    && !empty($_POST['db_host']) && !empty($_POST['db_user'])&& !empty($_POST['db_data'])) {
        try {
            $sql = new sql($_POST['db_host'], $dat_POST['db_data'], $_POST['db_user'], $_POST['db_pass'], $_POST['db_pref']);
            unset($sql);
            InstallerFunctions::writeDBConnectionFile($_POST['db_host'], $dat_POST['db_user'], $_POST['db_pass'], $_POST['db_data'], $_POST['db_pref']);
            require(FS2_ROOT_PATH.'copy/db_connection.php');
            
            $_SESSION['dbc']
        } catch (Exception $e) {
            // error case
        }
}

// check session
if (!isset($_SESSION['dbc'])) {
    // check copy file
    require(FS2_ROOT_PATH.'copy/db_connection.php');
    if ($dbc && !empty($dbc['type']) && !empty($dbc['host']) && !empty($dbc['user']) && !empty($dbc['data'])) {
        $_SESSION['dbc'] = $dbc;
    }
    
    // check old fs installations
    else if (isset($_SESSION['update_from']) && false !== $dbc = CompatibilityLayer::getOldDBConnection($_SESSION['update_from'])) {
        $_SESSION['dbc'] = $dbc;
    }
    
    // show form
    else {
        print $ic->get('sqlconnection');
    }
    
// database operations 
} else {
    
    $sqlr = new SQLRunner('jobs/sql/', $_SESSION['update_from'], $_SESSION['update_to']);
    $instructions = array();
    foreach($sqlr as $ins) {
        $ic->addText('instruction', $ins->getInfo());
        $instructions[] = $ic->get('sqlinstructions_info_element');
    }
    $ic->addText('instruction_list', implode(PHP_EOL, $instructions));
    print $ic->get('sqlinstructions_info');
}

?>
