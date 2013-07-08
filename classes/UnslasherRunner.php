<?php
/**
 * @file     UnslasherRunner.php
 * @folder   /classes
 * @version  0.1
 * @author   Sweil
 *
 * run unslashin operations on a whole databse *funky*
 */
class UnslasherData extends StdClass {
    public $name;
    public $id;
    public $fields = array();
    
    public function __construct($_name, $_id, $_fields) {
        $this->name = $_name;
        $this->id = $_id;
        $this->fields = $_fields;
    }
}

class UnslasherRunner extends Runner  {
    
    private $sql;
    private $tables;
    private $limit = 30;
    
    public function __construct($sql) {
        // call parent __construct
        parent::__construct();
        
        // create sql connection
        $this->sql = $sql;
        
        // default data
        $this->tables = array (
            new UnslasherData('aliases', 'alias_id', array('alias_go', 'alias_forward_to')),
            new UnslasherData('announcement', 'id', array('announcement_text')),
            new UnslasherData('applets', 'applet_id', array('applet_file')),
            new UnslasherData('articles', 'article_id', array('article_url', 'article_title', 'article_text')),
            new UnslasherData('articles_cat', 'cat_id', array('cat_name', 'cat_description')),
            new UnslasherData('comments', 'comment_id', array('content_type', 'comment_poster', 'comment_title', 'comment_text')),
            new UnslasherData('dl', 'dl_id', array('dl_name', 'dl_text', 'dl_autor', 'dl_autor_url')),
            new UnslasherData('dl_cat', 'cat_id', array('cat_name')),
            new UnslasherData('dl_files', 'file_id', array('file_name', 'file_url')),
            new UnslasherData('email', 'id', array('signup', 'change_password', 'delete_account', 'email')),
            new UnslasherData('ftp', 'ftp_id', array('ftp_title', 'ftp_type', 'ftp_url', 'ftp_user', 'ftp_pw', 'ftp_http_url')),
            new UnslasherData('news', 'news_id', array('news_title', 'news_text')),
            new UnslasherData('news_cat', 'cat_id', array('cat_name', 'cat_description')),
            new UnslasherData('news_links', 'link_id', array('link_name', 'link_url')),
            new UnslasherData('partner', 'partner_id', array('partner_name', 'partner_link', 'partner_beschreibung')),
            new UnslasherData('player', 'video_id', array('video_x', 'video_title', 'video_desc')),
            new UnslasherData('poll', 'poll_id', array('poll_quest')),
            new UnslasherData('poll_answers', 'answer_id', array('answer')),
            new UnslasherData('press', 'press_id', array('press_title', 'press_url', 'press_intro', 'press_text', 'press_note')),
            new UnslasherData('press_admin', 'id', array('title')),
            new UnslasherData('screen', 'screen_id', array('screen_name')),
            new UnslasherData('screen_cat', 'cat_id', array('cat_name')),
            new UnslasherData('shop', 'artikel_id', array('artikel_name', 'artikel_url', 'artikel_text', 'artikel_preis')),
            new UnslasherData('smilies', 'id', array('replace_string')),
            new UnslasherData('snippets', 'snippet_id', array('snippet_tag', 'snippet_text')),
            new UnslasherData('styles', 'style_id', array('style_tag')),
            new UnslasherData('user', 'user_id', array('user_name', 'user_mail', 'user_homepage', 'user_icq', 'user_aim', 'user_wlm', 'user_yim', 'user_skype')),
            new UnslasherData('user_groups', 'user_group_id', array('user_group_name', 'user_group_description', 'user_group_title')),
            new UnslasherData('wallpaper', 'wallpaper_id', array('wallpaper_name', 'wallpaper_title')),
            new UnslasherData('wallpaper_sizes', 'size_id', array('size')),
            
            new UnslasherData('config', 'config_name', array('config_data')),
            new UnslasherData('captcha_config', 'id', array('captcha_font_file')),
            new UnslasherData('dl_config', 'id', array('quickinsert')),
            new UnslasherData('global_config', 'id', array('virtualhost', 'admin_mail', 'title', 'dyn_title_ext', 'description', 'keywords', 'publisher', 'copyright', 'style_tag', 'date', 'time', 'datetime', 'page', 'page_next', 'page_prev', 'feed', 'language_text', 'home_text')),
            new UnslasherData('news_config', 'id', array('news_headline_ext')),
            new UnslasherData('player_config', 'id', array('cfg_buffermessage', 'cfg_top1_url')),
            new UnslasherData('user_config', 'id', array('reg_date_format', 'user_list_reg_date_format')),
        );
        
        // create filelist
        $this->load();
    }
    
    public function load() {
        foreach ($this->tables as $table) {
            $this->addInstruction($table);
        }
    }    


    protected function runInstruction($table) {
        if (!isset($_SESSION['unslasher_start']))
            $_SESSION['unslasher_start'] = 0;
        
        try {
            // get data
            $cols = $table->fields;
            $cols[] = $table->id;
            $data = $this->sql->get($table->name, $cols, array('L' => $_SESSION['unslasher_start'].','.$this->limit));

            // update data
            foreach ($data['data'] as $row) {
                foreach ($table->fields as $field) {
                    $row[$field] = stripslashes($row[$field]);
                }
                $this->sql->save($table->name, $row, $table->id, false);
            }
        } catch (Exception $e) {
            $_SESSION['unslasher_start'] = 0;
            throw $e;
        }
        
        // return true if done
        if ($data['num'] < $this->limit) {
            $_SESSION['unslasher_start'] = 0;
            return true;
        } else {
            $_SESSION['unslasher_start'] = $_SESSION['unslasher_start'] + $this->limit;
            return false;
        }
    }
    
    
    protected function getInfo($table) {
        if (!isset($_SESSION['unslasher_start']))
            $_SESSION['unslasher_start'] = 0;
            
        return array($this->sql->getPrefix().$table->name, $_SESSION['unslasher_start'], $this->limit);
    }
}

?>
