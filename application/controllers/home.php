<?php

class home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('loginmodel');
        $this->load->model('maintenancemodel');
    }

    public function index() {
         $data = array(
             'data_job' => $this->maintenancemodel->get_jobs(),
         );
        $this->TemplateModel->set_Debug($data);
        $this->TemplateModel->set_Content('home_view', $data);
        $this->TemplateModel->ShowTemplate();
    }
    
}

