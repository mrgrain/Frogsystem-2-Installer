<?php
// SetUp
require('./phpinit.php');
phpinit();
debug();
setup();

// detect step
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

// get title prefix
$title_prefix = 'fs2_install_update_tool';
if (isset($_SESSION['upgrade_from']))
    $title_prefix = ($_SESSION['upgrade_from'] == 'none'?'fs2_install':'fs2_update');

// create page object and display
$page = new $stepClass();
$page->setTitlePrefix($title_prefix);
print $page;var_dump($_SESSION);
?>
