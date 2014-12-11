<?php
/**
* @file     InstallerPageTemplateOperations.php
* @folder   /steps
* @version  0.1
* @author   Sweil
*
* page for template operations
*/
class InstallerPageTemplateOperations extends SelfReloadingInstallerPage {

    private $ic;
    protected $result = array();
    private $success = true;
    private $styles = array();

    public function __construct() {
        parent::__construct();
        $this->lang = new InstallerLang($this->local, 'templates');
        $this->setTitle('templates_title');
        $this->ic = $this->getICObject('templates.tpl');

        // add styles
        if (isset($_POST['styles'])) {
            $styles = $_POST['styles'];
        } else if (isset($_SESSION['update_styles'])) {
            $styles = $_SESSION['update_styles'];
        } else {
            $styles = array();
        }

        // check styles
        foreach ($styles as $style) {
            if (Files::is_dir(new Path('styles/'.$style, 'target'))) {
                $this->styles[] = $style;
            }
        }
    }

    protected function show() {
        // start runner
        $runner = new TemplateRunner('jobs/templates/', UPGRADE_FROM, UPGRADE_TO, $this->lang);
        $checkReset = true;

        foreach($runner as $pos => $inst) {
            // break out
            if ($this->isDone()) { break; }

            // skip infos
            if ($runner->currentIsOfType('info')) {
				if ($runner->getLastKey() == $pos) {
					$this->done();
					break;
				}
                continue;
            }

            // set next step
            if ($checkReset && !$this->isFirstRun()) {
                $runner->setCurrent($this->getNext()-1);
                $checkReset = false;
                continue;
            }
            $this->setNext($pos+1);

            // create ouptput
            $info = $runner->getCurrentInfo();

            // images
            $img_path = 'styles/'.$this->tpl->getStyle().'/images/';

            //execute instruction
            foreach ($this->styles as $style) {
                $runner->setStyle($style);
                try {
                    $runner->runCurrentInstruction();
                    $this->ic->addCond('success', true);
                } catch (TemplateOperationException $e) {
                    $this->ic->addCond('error', true);
                    $this->ic->addText('error_message', $e->getMessage());
                    $this->success = false;
                }
                $this->ic->addText('success_img', $img_path.'ok.gif');
                $this->ic->addText('error_img', $img_path.'error.gif');
                $this->ic->addText('instruction', $style.": ".$info);
                $this->addResult($this->ic->get('instruction_element'));
            }

            // done?
            if ($runner->getLastKey() == $pos) {
                $this->done();
                break;
            }

            // redirect (or not)
            if ($this->needReload()) {
                break;
            }
        }

        // show output
        if ($this->isDone()) {
            $this->ic->addCond('done', true);
            $this->ic->addText('url', '?step=cleanup');
            $this->ic->addText('url_self', '?step=templateOperations');
        } else {
            $this->ic->addText('url', $this->getUrl($this->getNext()));
        }
        $this->ic->addCond('all_successful', $this->success);
        $this->ic->addText('total_runtime', sprintf('%.3f', $this->getRuntime()));
        $this->ic->addText('instruction_list', implode(PHP_EOL, $this->getResult()));
        print $this->ic->get('template_runner');

        // redirect (or not)
        $this->reload();

        // call last to reset session if neccessary
        $this->finish();
    }

    protected function reload($force = false) {
        $_SESSION['update_styles'] = $this->styles;
        parent::reload();
    }

    private function addResult($result) {
        $this->result[] = $result;
    }

    protected function getUrl($next) {
        return $_SERVER['PHP_SELF']."?step=templateOperations&next={$next}";
    }
}
?>
