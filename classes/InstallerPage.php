<?php
/**
 * @file     InstallerPage.php
 * @folder   /classes
 * @version  0.1
 * @author   Sweil
 *
 * provides a full installer page with html struct, etc.
 */
class InstallerPage extends Page {
    
    protected $lang;
    protected $tpl;
    protected $local;
    protected $titlePrefix;
    
    public function __construct() {
        
        // init properties
        $this->local = detect_language();
        
        //inti lang
        $this->lang = new InstallerLang($this->local, 'installer');
        
        // default title        
        $this->setTitle('default_title');

        // init template
        $this->tpl = new InstallerTemplate();
    }
    
    /* create & show content */    
    protected function show() {
    } 

    
    /* Title Functions */
    public function setTitle($title) {
        $this->title = $this->lang->get($title);
    }
    public function setTitlePrefix($prefix) {
        $this->titlePrefix = $this->lang->get($prefix);
    }
    protected function getTitle() {
        if ($this->titlePrefix)
            return $this->titlePrefix.': '.$this->title;
        return $this->title;
    }     
    protected function getTitleTag() {
        return '<title>'.$this->getTitle().'</title>';
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
        $this->tpl->tag('info_badge', $this->lang->get('info_badge'));
        $this->tpl->tag('version', UPGRADE_TO);
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
