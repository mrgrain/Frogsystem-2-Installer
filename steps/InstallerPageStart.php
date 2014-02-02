<?php
/**
* @file     InstallerPageStart.php
* @folder   /steps
* @version  0.2
* @author   Sweil
*
* welcome page for installer
*/
class InstallerPageStart extends InstallerPage {

    public function __construct() {
        parent::__construct();
        $this->lang = new InstallerLang($this->local, 'start');
        $this->setTitle('start_title');
    }

    protected function show() {
        $ic = $this->getICObject('start.tpl');
        $ic->addText('changelog_text', nl2br($this->lang->get('changelog_text'), false));
        $changelog = $ic->get('changelog');
        $ic->addText('notes_text',     nl2br($this->lang->get('notes_text'), false));
        $notes     = $ic->get('notes');
        $ic->addText('copyright_text', nl2br($this->lang->get('copyright_text'), false));
        $copyright = $ic->get('copyright');


        // session and reset?
        $good_keys = array('installer_path', 'upgrade_to');
        if (is_array($_SESSION) && count(array_diff_key($_SESSION, array_flip($good_keys))) > 0) {
            $ic->addCond('session', true);
        }
        if (isset($_GET['reset'])) {
            $_SESSION = array();
            InstallerFunctions::writeDBConnectionFile("","","","","");
            header("location: {$_SERVER['PHP_SELF']}?step=start");
            exit;
        }

        $ic->addText('changelog', $changelog);
        $ic->addText('notes',     $notes);
        $ic->addText('copyright', $copyright);
        print $ic->get('introduction');
    }
}

?>
