<?php
/**
 * @file     InstallerPage.php
 * @folder   /classes
 * @version  0.1
 * @author   Sweil
 *
 * provides the matrix of a page
 */
class InstallerPage {
    
    private $lang;
    private $tpl;
    private $local;
    private $title;
    private $content;
    
    public function __construct($local, $title) {
        
        // init values
        $this->local = $local;
        $this->setTitle($title);
        
        //inti lang
        $this->lang = new InstallerLang($this->local, 'installer');

        // init template
        $this->tpl = new InstallerTemplate();
    }
    
    public function setTitle($title) {
        $this->title = $title;
    }
    private function getTitle() {
        return $this->title;
    }     
    private function getTitleTag() {
        return '<title>'.$this->lang->get($this->getTitle()).'</title>';
    }   
    
    public function getIC($file) {
        return new InstallerContent('styles/installer/'.$file, $this->lang);
    }
    
    public function setContent($html) {
        $this->content = $html;
    }    
    
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
        $this->tpl->tag('content', $this->content);
        $body = (string) $this->tpl;   
             
        // get HTML-MATRIX      
        $this->tpl->load('MATRIX');
        $this->tpl->tag('doctype', $doctype);
        $this->tpl->tag('language', "DE");
        $this->tpl->tag('title_tag', $this->getTitleTag());
        $this->tpl->tag('body', $body);
        
        return (string) $this->tpl; 
    }  
}
