<?php
// init php
define('INSTALLER_PATH', './', true);
require('./phpinit.php');
error_reporting(E_ALL);

// Installer constants
if (!isset($_SESSION['upgrade_from'])) {
  $_SESSION['upgrade_from'] = UpgradeFunctions::getInstalledFS2Version();
}
if (!isset($_SESSION['upgrade_to'])) {
  $_SESSION['upgrade_to'] = trim(file_get_contents(INSTALLER_PATH.'copy/version'));
}
define('UPGRADE_FROM', $_SESSION['upgrade_from'], true);
define('UPGRADE_TO', $_SESSION['upgrade_to'], true);

// todo
define('SLASH', false, true);
define('INSTALLER_LOCATION', 'fs-installer', true);

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

// create page object
$page = new $stepClass();
$page->setTitlePrefix($_SESSION['upgrade_from'] == 'none'?'fs2_install':'fs2_update');
print $page;
?>
