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
                if ($_SESSION['IsAdmin'] == TRUE) {
                    redirect('http://localhost/kw_smart_admin/');
                } else {
                    redirect('home');
                }
            }
        }
        $data['form_action'] = form_open('login', array('class' => 'form-signin'));
        $data['form_input'] = $this->loginmodel->set_form();

        $this->load->view('login_view', $data);
    }

    public function username_check($str) {
        if ($this->loginmodel->check_user($str) == FALSE) {
            $this->form_validation->set_message('username_check', 'ชื่อผู้ใช้งานไม่ถูกต้อง');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
