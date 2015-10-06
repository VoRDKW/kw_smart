<?php

class home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('loginmodel');
        $this->load->library('form_validation');
        $this->load->helper('form');
    }

    public function index() {
         $data = array();
        //       this->m_template->set_Debug($c_data);
        $this->TemplateModel->set_Content('home_view', $data);
        $this->TemplateModel->ShowTemplate();
    }
    public function form_input()
    {
        $data = array();
        //       this->m_template->set_Debug($c_data);
        $this->TemplateModel->set_Content('home_view', $data);
        $this->TemplateModel->ShowTemplate();
    }
}

