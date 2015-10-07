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


        $data = array(
            'page_title' => 'ข้อมูลผู้ใช้ระบบ',
            'page_title_small' => '',
            'data' => $this->usermodel->get_user(),
                //'' => ,
                //'previous_page' => 'route/time/' . $rcode . '/' . $vtid,
                //'next_page' => 'fares/add/' . $rcode . '/' . $vtid,
        );
        $data_debug = array(
            'data' => $data['data'],
        );

        //$this->TemplateModel->set_Debug($data_debug);
        $this->TemplateModel->set_Content('users/user_detail_view', $data);
        $this->TemplateModel->ShowTemplate();
    }

    public function edit() {
        $data_debug = array();
        $MemberID = $this->session->userdata('MemberID');
        if ($MemberID == NULL) {
            redirect('home');
        }
        if ($this->usermodel->set_validation_form()) {
            $form_data = $this->usermodel->get_form_post();
            $rs = $this->usermodel->update_user($MemberID);

            if ($rs) {
                $alert['alert_message'] = "บันทึกข้อมูลสำเร็จ";
                $alert['alert_mode'] = "success";
            } else {
                $alert['alert_message'] = "บันทึกข้อมูลผิดพลาด";
                $alert['alert_mode'] = "danger";
            }
            $this->session->set_flashdata('alert', $alert);
            redirect('user/');

            $data_debug['form_data'] = $form_data;
            $data_debug['rs'] = $rs;
        } else {
            
        }

        $data = array(
            'page_title' => 'แก้ไขผู้ใช้งาน',
            'page_title_small' => '',
            'form' => $this->usermodel->set_form_edit($MemberID),
                //'' => ,
                //'previous_page' => 'route/time/' . $rcode . '/' . $vtid,
                //'next_page' => 'fares/add/' . $rcode . '/' . $vtid,
        );

        $this->TemplateModel->set_Debug($data_debug);
        $this->TemplateModel->set_Content('users/user_form_view', $data);
        $this->TemplateModel->ShowTemplate();
    }

}
