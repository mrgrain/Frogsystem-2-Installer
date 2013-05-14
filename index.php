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
$step_file = FS2_ROOT_PATH.'steps/'.$go.'.php';

// error fallback
if (!file_exists($step_file)) {
  $go = '404';
  $step_file = FS2_ROOT_PATH.'steps/404.php';
}

// fill Session with important data
// TODO: generate once on need
$_SESSION['update_from'] = '2.alix5';
$_SESSION['update_to'] = file_get_contents(FS2_ROOT_PATH.'inc/version');

// create page object
$page = new InstallerPage(detect_language(), 'default_title');

// load content
ob_start();
require($step_file);
$content = ob_get_clean();

// print page
$page->setContent($content);
print $page;
?>
