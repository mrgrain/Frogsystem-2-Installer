<?php
define('FS2_ROOT_PATH', './', true);
require('./phpinit.php');

//inti lang
$lang = new InstallerLang('de_DE', false);
$lang->setType('installer');
$page = new InstallerPage('styles/installer/start.tpl', $lang);
$content = $page->get('introduction');


// init template
$tpl = new InstallerTemplate();
$tpl->setFile('main.tpl');

// create main template
$tpl->load('MAIN');
$tpl->tag('copyright', "(c) 2013 FS2-Team");
$tpl->tag('content', $content);
$body = (string) $tpl;

// Load HTML
$tpl->load('DOCTYPE');
$tpl->clearTags();
$doctype = (string) $tpl;
$tpl->load('MATRIX');
$tpl->tag('doctype', $doctype);
$tpl->tag('language', "DE");
$tpl->tag('title_tag', '<title>TEST INSTALLER PAGE</title>');
$tpl->tag('body', $body);

print $tpl;
?>
