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
        parent::__construct();
        $this->lang = new InstallerLang($this->local, 'templates');
        $this->setTitle('templates_title');
        $this->ic = $this->getICObject('templates.tpl');

        // check to header instantly
        if (UPGRADE_FROM == 'none') {
            // nothing todo => go to cleanup
            header("location: {$_SERVER['PHP_SELF']}?step=cleanup"); // redirect
            exit;
        }
    }

    protected function show() {
        // Available Styles
        $styles_list = array();
        $styles = array_diff(scandir(new Path('./styles', 'target')), array('.', '..', 'default'));
        foreach ($styles as $style) {
            if (!Files::is_dir(new Path('styles/'.$style, 'target'))) {
                continue;
            }
            // TODO check file version
            $style_ini = new Path('styles/'.$style.'/style.ini', 'target');
            $style_ini = TemplateRunner::getStyleIniData($style_ini);
            $this->ic->addText('info', sprintf('%s, v%s', $style_ini->name, $style_ini->version));
            $this->ic->addText('style', $style);
            $styles_list[] = $this->ic->get('styles_selection_element');
        }
        $this->ic->addText('styles_selection_list', implode(PHP_EOL, $styles_list));
        $styles_selection = $this->ic->get('styles_selection');


        // Template Instructions
        $runner = new TemplateRunner(new Path('jobs/templates/', 'current'), UPGRADE_FROM, UPGRADE_TO, $this->lang);
        $inst_list = array();
        $info_list = array();

        foreach($runner as $inst) {
            if ($runner->currentIsOfType('info')) {
                $this->ic->addText('info', $runner->getCurrentInfo());
                $info_list[] = $this->ic->get('info_element');
            } else {
                $this->ic->addText('instruction', $runner->getCurrentInfo());
                $inst_list[] = $this->ic->get('instruction_element');
            }
        }

        // Render Page
        $this->ic->addText('styles_selection', $styles_selection);
        $this->ic->addText('info_list', implode(PHP_EOL, $info_list));
        $this->ic->addText('instruction_list', implode(PHP_EOL, $inst_list));
        $this->ic->addText('url_start', '?step=templateOperations');
        $this->ic->addText('url_skip', '?step=cleanup');
        print $this->ic->get('templates_info');
    }
}
?>
