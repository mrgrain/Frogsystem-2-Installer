<?php
// init php
define('FS2_ROOT_PATH', './', true);
require('./phpinit.php');


// detect page
if (!isset($_REQUEST['step']) || empty($_REQUEST['step'])) {
    $go = 'start';
} else {
    $go = $_REQUEST['step'];
}
$stepClass = 'InstallerPage'.ucfirst($go);

// error fallback
if (!class_exists($stepClass)) {
  $go = '404';
  $stepClass = 'InstallerPage404';
}

// fill Session with important data
// TODO: generate once on need
$_SESSION['update_from'] = '2.alix5';
$_SESSION['update_to'] = trim(file_get_contents(FS2_ROOT_PATH.'inc/version'));

// create page object
$page = new $stepClass();
print $page;
?>
