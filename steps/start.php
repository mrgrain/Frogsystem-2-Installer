<?php
/**
* @file     start.php
* @folder   /steps
* @version  0.1
* @author   Sweil
*
* welcome page for installer
*/

$ic = $page->getIC('start.tpl');
print $ic->get('introduction');

?>
