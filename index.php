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
