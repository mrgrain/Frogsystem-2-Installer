<?php
/**
* @file     database.php
* @folder   /steps
* @version  0.1
* @author   Sweil
*
* database operations
*/
unset($_SESSION['dbc']);
// load content object
$ic = $page->getIC('database.tpl');

// check post
if (isset($_POST['db_host']) && isset($_POST['db_data']) && isset($_POST['db_user']) && isset($_POST['db_pass']) && isset($_POST['db_pref'])
    && !empty($_POST['db_host']) && !empty($_POST['db_user'])&& !empty($_POST['db_data'])) {
        try {
            $sql = new sql($_POST['db_host'], $_POST['db_data'], $_POST['db_user'], $_POST['db_pass'], $_POST['db_pref']);
            unset($sql);
            InstallerFunctions::writeDBConnectionFile($_POST['db_host'], $_POST['db_user'], $_POST['db_pass'], $_POST['db_data'], $_POST['db_pref']);
            require(FS2_ROOT_PATH.'copy/db_connection.php');
            $_SESSION['dbc'] = $dbc;
            unset($dbc);
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
        exit;
    }
}    

//check connection from session
try {
    $sql = new sql($_SESSION['dbc']['host'], $_SESSION['dbc']['data'], $_SESSION['dbc']['user'], $_SESSION['dbc']['pass'], $_SESSION['dbc']['pref']);
    $runner = new SQLRunner('jobs/sql/', $_SESSION['update_from'], $_SESSION['update_to'], $sql);
    
    $inst_list = array();
    foreach($runner as $inst) {
        $ic->addText('instruction', $runner->getCurrentInfo());
        $inst_list[] = $ic->get('sqlinstructions_info_element');
    }
    $ic->addText('instruction_list', implode(PHP_EOL, $inst_list));
    print $ic->get('sqlinstructions_info');
    
    
} catch (Exception $e) {
    print $ic->get('sqlconnection');
    exit;
}

?>
