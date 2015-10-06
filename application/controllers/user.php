<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


defined('BASEPATH') OR exit('No direct script access allowed');

class user extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        $this->load->model('usermodel');
            
    }

    public function index() {
        $data_debug = array();
                     
        $data = array(
            'page_title' => 'แก้ไขผู้ใช้งาน',
            'page_title_small' => '',
            'data' => $this->usermodel->set_form_edit(),
                //'' => ,
                //'previous_page' => 'route/time/' . $rcode . '/' . $vtid,
                //'next_page' => 'fares/add/' . $rcode . '/' . $vtid,
        );
        
        $this->TemplateModel->set_Debug($data_debug);
        $this->TemplateModel->set_Content('users/user_detail_view', $data);
        $this->TemplateModel->ShowTemplate();
    }

    public function edit() {
        $data_debug = array();
        
        if($this->usermodel->set_validation() && $this->form_validation->run()){
            $data_debug['form_data'] = $this->usermodel->get_post_form_edit();
        }
        
        $data = array(
            'page_title' => 'แก้ไขผู้ใช้งาน',
            'page_title_small' => '',
            'form' => $this->usermodel->set_form_edit(),
                //'' => ,
                //'previous_page' => 'route/time/' . $rcode . '/' . $vtid,
                //'next_page' => 'fares/add/' . $rcode . '/' . $vtid,
        );
        
        $this->TemplateModel->set_Debug($data_debug);
        $this->TemplateModel->set_Content('users/user_form_view', $data);
        $this->TemplateModel->ShowTemplate();
    }
    

}
