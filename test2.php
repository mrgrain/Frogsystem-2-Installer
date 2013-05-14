<?php
define('FS2_ROOT_PATH', './', true);
require('./phpinit.php');


// page object
$page = new InstallerPage('de_DE', 'default_title');
$ic = $page->getIC('start.tpl');
$page->setContent($ic->get('sqlconnection'));

print $page;
?>
