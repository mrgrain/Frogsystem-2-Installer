<?php
require('./classes/Runner.php');
require('./classes/SQLRunner.php');
require('./libs/class_sql.php');

function calc_my_max_runtime() {
    $max_time = ini_get('max_execution_time');
    if (!$max_time) $max_time = 30;
    if ($max_time <= 0) $max_time = 30;
    
    return $max_time/2;
}

$time_start = microtime(true);
$max_time = calc_my_max_runtime();
session_start();

$sqlr = new SQLRunner('jobs/sql/from-2.alix5-to-2.alix6.sql');
$done = true;

foreach($sqlr as $pos => $ins) {

    // change start point
    if (isset($_SESSION['next']) && isset($_GET['next']) && $_SESSION['next'] == $_GET['next']) {
        $sqlr->setCurrent($_SESSION['next']-1);
        unset($_SESSION['next'], $_GET['next']);
        continue;
    }     
    
    // check for reload 
    //http://localhost/fs-installer/test.php
    if (microtime(true)-$time_start > $max_time) {
        $_SESSION['next'] = $pos; 
        $done = false;
        break;
    }
    
    ob_start();
    print('<p>');
    print(($pos+1).'. '.$sqlr->getCurrentInfo().': ');
    try {
        $sqlr->runCurrentInstruction();
        print("okay");
    } catch (Exception $e) {
       print("error (".$e->getMessage().")"); 
    }
    print('</p>');
    usleep(700000);
    $html = ob_get_clean();
    if (!isset($_SESSION['result'])) $_SESSION['result'] = array();
    $_SESSION['result'][] = $html;
}

// output
foreach($_SESSION['result'] as $html) {
    print $html;
}

$_SESSION['total_runtime'] = isset($_SESSION['total_runtime'])?$_SESSION['total_runtime']:0 + microtime(true)-$time_start;
print "<p>Max Runtime per Reload: {$max_time}<br>Total Runtime: {$_SESSION['total_runtime']}</p>";

// redirect
if (!$done) {
    header("refresh: 2; url={$_SERVER['PHP_SELF']}?next={$pos}");
    exit;
}

// do when done
unset($_SESSION['result']);
unset($_SESSION['total_runtime']);
?>
