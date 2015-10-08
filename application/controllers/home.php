<?php

class home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('loginmodel');
        $this->load->model('maintenancemodel');
        $this->load->model('imagemodel');
    }

    public function index() {
        if ($_SESSION['IsAdmin']) {
            $MemberID = $_SESSION['MemberID'];
            $this->session->sess_destroy();
            redirect('http://localhost/kw_smart_admin/login/check/' . $MemberID);
        }
        $data = array(
            'data_job' => $this->maintenancemodel->set_data_view(),
            'is' => $_SESSION['IsAdmin']
        );
        $this->TemplateModel->set_Debug($data);
        $this->TemplateModel->set_Content('home_view', $data);
        $this->TemplateModel->ShowTemplate();
    }

}
