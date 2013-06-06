<?php
/**
 * @file     InstallerPage.php
 * @folder   /classes
 * @version  0.1
 * @author   Sweil
 *
 * provides a full page with html struct, etc.
 */
class InstallerPage {
    
    protected $lang;
    protected $tpl;
    protected $local;
    protected $title;
    protected $content;
    
    public function __construct() {
        
        // init properties
        $this->local = detect_language();
        $this->setTitle('default_title');
        
        //inti lang
        $this->lang = new InstallerLang($this->local, 'installer');

        // init template
        $this->tpl = new InstallerTemplate();
    }
    
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
    
    protected function show() {
    } 

    
    /* Title Functions */
    public function setTitle($title) {
        $this->title = $title;
    }
    protected function getTitle() {
        return $this->title;
    }     
    protected function getTitleTag() {
        return '<title>'.$this->lang->get($this->getTitle()).'</title>';
    }   
    
    /* InstallerContent Object Creator*/
    public function getICObject($file) {
        return new InstallerContent('styles/installer/'.$file, $this->lang);
    }
    
    
    /* create ouptut */
    public function __toString() {      
        // open main template file
        $this->tpl->setFile('main.tpl');  
        
        // get COPYRIGHT
        $this->tpl->load('COPYRIGHT');
        $this->tpl->clearTags();
        $copyright = (string) $this->tpl;       
         
        // get DOCTYPE
        $this->tpl->load('DOCTYPE');
        $this->tpl->clearTags();
        $doctype = (string) $this->tpl;        
        
        // get MAIN body
        $this->tpl->load('MAIN');
        $this->tpl->tag('copyright', $copyright);
        $this->tpl->tag('content', $this->getContent());
        $body = (string) $this->tpl;   
                     
        // get HTML-MATRIX      
        $this->tpl->load('MATRIX');
        $this->tpl->tag('doctype', $doctype);
        $this->tpl->tag('language', "DE");
        $this->tpl->tag('title_tag', $this->getTitleTag());
        $this->tpl->tag('title', $this->getTitle());
        $this->tpl->tag('body', $body);

        return (string) $this->tpl; 
    }  
}
?>
