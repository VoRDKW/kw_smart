<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
Class TemplateModel extends CI_Model {
    private $title = 'KW Smart App';
    private $view_name = NULL;
    private $real_alert = NULL;
    private $set_data = NULL;
    private $permission = "ALL";
    private $debud_data = NULL;
    private $lang_value = array('theme');
    private $version = '1.0';
    
    function set_RealAlert($data) {
        $this->real_alert = $data;
    }
    function set_Debug($data) {
        $this->debud_data = $data;
    }
    function set_Title($name) {
        $this->title = $name . ' | ' . $this->title;
    }
    function set_Content($name, $data) {
        $this->view_name = $name;
        $this->set_data = $data;
    }
    function set_Permission($mode) {
        $this->permission = $mode;
    }
    function check_Alert() {
        return $this->session->flashdata('alert');
    }
    function check_RealAlert() {
        return $this->real_alert;
    }
    function ShowTemplate() {
        //--- Load language --//
        $site_lang = $this->session->userdata('site_lang');
        if (!$site_lang) {
            $site_lang = 'thai'; //Default set language to Thai
        }
        foreach ($this->lang_value as $path) {
            $this->lang->load($path, $site_lang); //Load message
        }
        //Load version for Cache CSS and JS
        $data['version'] = $this->version;
        
        //--- Redirect to current page ---//
        $data['page'] = $this->uri->segment(1);
        
        //--- Alert System ---//
        $data['alert'] = $this->session->userdata('alert');
        $this->session->unset_userdata('alert');
        
        $data['username'] = $this->session->userdata('username');
        $data['title'] = $this->title;
        $data['debug'] = $this->debud_data;
        $data['alert'] = $this->check_Alert();
        $data['real_alert'] = $this->check_RealAlert();
        
        $this->load->view('theme/theme_user_header', $data);
        if ($this->view_name != NULL) {
            $this->load->view($this->view_name, $this->set_data);
        } else {
            $this->load->view('permission_deny');
        }
        $this->load->view('theme/theme_user_footer');
    }
    
    
    
}

