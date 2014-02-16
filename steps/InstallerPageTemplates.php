<?php
/**
* @file     InstallerPageTemplates.php
* @folder   /steps
* @version  0.1
* @author   Sweil
*
* page for template operations
*/
class InstallerPageTemplates extends InstallerPage {

    private $ic;

    public function __construct() {
        $_SESSION['upgrade_from'] = '2.alix5';
        parent::__construct();
        $this->lang = new InstallerLang($this->local, 'templates');
        $this->setTitle('templates_title');
        $this->ic = $this->getICObject('templates.tpl');
    }

    protected function show() {
        $runner = new TemplateRunner(new Path('jobs/templates/', 'current'), UPGRADE_FROM, UPGRADE_TO, $this->lang);
        $inst_list = array();

        foreach($runner as $inst) {
            $this->ic->addText('instruction', $runner->getCurrentInfo());
            $inst_list[] = $this->ic->get('instruction_element');
        }

        $this->ic->addText('instruction_list', implode(PHP_EOL, $inst_list));
        $this->ic->addText('url_start', '?step=templateOperations');
        $this->ic->addText('url_skip', '?step=cleanup');
        print $this->ic->get('templates_info');
    }
}
?>
