<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('loginmodel');
        $this->load->library('form_validation');
        $this->load->helper('form');
    }

    public function index() {
        if ($this->loginmodel->set_validation() && $this->form_validation->run()) {
            $form_data = $this->loginmodel->get_post();
            if ($this->loginmodel->login($form_data)) {
                redirect('home');
            }
        }
        $data['form_action'] = form_open('login', array('class' => 'form-signin'));
        $data['form_input'] = $this->loginmodel->set_form();

        $this->load->view('login_view', $data);
    }

    public function test() {
        $data = array();
        //       this->m_template->set_Debug($c_data);
        $this->TemplateModel->set_Content('home_view', $data);
        $this->TemplateModel->ShowTemplate();
    }

}
