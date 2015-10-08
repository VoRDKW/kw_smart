<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


defined('BASEPATH') OR exit('No direct script access allowed');

class maintenance extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('maintenancemodel');
        $this->load->model('buildingmodel');
        $this->load->model('imagemodel');
    }

    public function index() {
        $data = array(
            'page_title' => 'ระบบแจ้งซ่อมบำรุงคอมพิวเตอร์',
            'page_title_small' => '',
            'data_job' => $this->maintenancemodel->set_data_view()
                //'previous_page' => 'route/time/' . $rcode . '/' . $vtid,
                //'next_page' => 'fares/add/' . $rcode . '/' . $vtid,
        );
        $data_debug = array(
            'data_job' => $data['data_job']
        );
        //$this->TemplateModel->set_Debug($data_debug);
        $this->TemplateModel->set_Content('maintenance/maintenance_view', $data);
        $this->TemplateModel->ShowTemplate();
    }

    public function add() {

        $data_debug = array();

        if ($this->maintenancemodel->set_validate_form()) {
            $form_data = $this->maintenancemodel->get_post_form();
            $rs = $this->maintenancemodel->insert_job($form_data);
            if ($rs) {
                $alert['alert_message'] = "บันทึกข้อมูลสำเร็จ";
                $alert['alert_mode'] = "success";
            } else {
                $alert['alert_message'] = "บันทึกข้อมูลผิดพลาด";
                $alert['alert_mode'] = "danger";
            }
            $this->session->set_flashdata('alert', $alert);
            redirect('maintenance/');

//            $data_debug['form_data'] = $form_data;
//            $data_debug['rs'] = $rs;
        }

        $data = array(
            'page_title' => 'เพิ่มงานซ่อมบำรุง',
            'page_title_small' => '',
            'form' => $this->maintenancemodel->set_form_add(),
            'Images' => NULL,
                //'previous_page' => 'route/time/' . $rcode . '/' . $vtid,
                //'next_page' => 'fares/add/' . $rcode . '/' . $vtid,
        );
        //$this->TemplateModel->set_Debug($data_debug);
        $this->TemplateModel->set_Content('maintenance/maintenance_form_view', $data);
        $this->TemplateModel->ShowTemplate();
    }

    public function edit($JobID) {
        $data_job = $this->maintenancemodel->get_jobs($JobID);
        if ($data_job == NULL) {
            redirect('maintenance/');
        }
        if ($this->maintenancemodel->set_validate_form()) {
            $form_data = $this->maintenancemodel->get_post_form();
            $rs = $this->maintenancemodel->update_job($JobID,$form_data);
            if ($rs) {
                $alert['alert_message'] = "แก้ไขข้อมูลสำเร็จ";
                $alert['alert_mode'] = "success";
            } else {
                $alert['alert_message'] = "แก้ไขข้อมูลผิดพลาด";
                $alert['alert_mode'] = "danger";
            }
            $this->session->set_flashdata('alert', $alert);
            redirect('maintenance/');

//            $data_debug['form_data'] = $form_data;
//            $data_debug['rs'] = $rs;
        }
        $data = array(
            'page_title' => 'เพิ่มงานซ่อมบำรุง',
            'page_title_small' => '',
            'form' => $this->maintenancemodel->set_form_edit($data_job),
            'Images' => NULL,
                //'previous_page' => 'route/time/' . $rcode . '/' . $vtid,
                //'next_page' => 'fares/add/' . $rcode . '/' . $vtid,
        );

        $data_debug = array(
            'data' => $data_job
        );

        //$this->TemplateModel->set_Debug($data_debug);
        $this->TemplateModel->set_Content('maintenance/maintenance_form_view', $data);
        $this->TemplateModel->ShowTemplate();
    }

    //    ตรวจสอบค่าใน dropdown
    public function check_dropdown($str) {
        if ($str === '0') {
            $this->form_validation->set_message('check_dropdown', 'เลือก %s');
            return FALSE;
        } else {
            return TRUE;
        }
    }

// for Ajax
    public function get_floor() {
        $BuildingID = $this->input->post('BuildingID');
        $floor = $this->buildingmodel->get_floor($BuildingID);
        $num_floor = array(
            'NumFloor' => $floor
        );
        header('Content-Type: application/json');

        echo json_encode($num_floor);
    }

    public function get_room() {
        $BuildingID = $this->input->post('BuildingID');
        $FloorNo = $this->input->post('FloorNo');
        $room = $this->buildingmodel->get_rooms($BuildingID, $FloorNo);
        header('Content-Type: application/json');
        echo json_encode($room);
    }

}
