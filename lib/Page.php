<?php
/**
 * @file     Page.php
 * @folder   /classes
 * @version  0.1
 * @author   Sweil
 *
 * provides an abstract page construct
 */
abstract class Page {

    protected $title;
    protected $content;

    abstract public function __construct();

    /* create & show content */
    public function getContent($overwrite = false) {
        // call show?
        if(is_null($this->content) || $overwrite) {
            ob_start();
            try {
                $this->show();
            } catch (Exception $e) {
                trigger_error($e->getMessage().PHP_EOL.$e->getTraceAsString(), E_USER_ERROR);
            }
            $this->content = ob_get_clean();
        } //else use content from setContent
        return $this->content;
    }
    public function setContent ($html = null) {
        $this->content = $html;
    }

    abstract protected function show();


    /* Title Functions */
    public function setTitle($title) {
        $this->title = $title;
    }
    protected function getTitle() {
        return $this->title;
    }
    abstract protected function getTitleTag();

    /* create ouptut */
    abstract public function __toString();
}
?>
