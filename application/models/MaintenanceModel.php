<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class MaintenanceModel extends CI_Model {

    public function set_form_add() {
        $i_JobName = array(
            'name' => 'JobName',
            'value' => set_value('JobName'),
            'placeholder' => '',
            'size' => '5',
            'autofocus' => true,
            'class' => 'form-control'
        );
        $i_BuildingID = array(
            'name' => 'BuildingID',
            'value' => set_value('BuildingID'),
            'placeholder' => '',
            'class' => 'form-control'
        );
        $i_RoomNo = array(
            'name' => 'RoomNo',
            'value' => set_value('RoomNo'),
            'placeholder' => '',
            'class' => 'form-control'
        );
        $i_Floor = array(
            'name' => 'Floor',
            'value' => set_value('Floor'),
            'placeholder' => '',
            'class' => 'form-control'
        );
        $i_NumberKWDevice = array(
            'name' => 'NumberKWDevice',
            'value' => set_value('NumberKwDevie'),
            'placeholder' => '',
            'class' => 'form-control'
        );
        $i_ImageName = array(
            'name' => 'ImageName',
            'type' => 'file',
            'value' => set_value('ImageName'),
            'placeholder' => '',
            'class' => '',
            'id' => 'files',
            'multiple' => 'multiple'
        );
        $i_JobDetail = array(
            'name' => 'JobDetail',
            'value' => set_value('JobDetail'),
            'placeholder' => '',
            'rows' => '3',
            'class' => 'form-control'
        );
        $i_Note = array(
            'name' => 'Note',
            'value' => set_value('Notes'),
            'placeholder' => '',
            'class' => 'form-control'
        );
        $form_add = array(
            'form_open' => form_open('building/add/', array('class' => 'form-horizontal', 'id' => 'frm_building')),
            'JobName' => form_input($i_JobName),
            'BuildingID' => form_input($i_BuildingID),
            'RoomNo' => form_input($i_RoomNo),
            'Floor' => form_input($i_Floor),
            'NumberKWDevice' => form_input($i_NumberKWDevice),
            'ImageName' => form_input($i_ImageName),
            'JobDetail' => form_textarea($i_JobDetail),
            'Note' => form_input($i_Note),
            'form_close' => form_close(),
        );

        return $form_add;
    }

    public function set_form_edit($data) {

//        $i_Destination = array(
//            'name' => 'Destination',
//            'placeholder' => 'ปลายทาง',
//            'readonly' => '',
//            'class' => 'form-control text-center',
//            'value' => $desination
//        );

        $form_edit = array(
            'form' => form_open('user/edit/', array('class' => 'form-horizontal', 'id' => 'form_user')),
        );

        return $form_edit;
    }

    public function get_post_form() {
        $form_data = array(
            "JobName" => $this->input->post('JobName'),
            "RoomNo" => $this->input->post('RoomNo'),
            "NumberKWDevice" => $this->input->post('NumberKWDevice'),
            "ImageName" => $this->input->post('ImageName'),
            "JobDetail" => $this->input->post('JobDetail'),
            "Note" => $this->input->post('Note')
        );
        return $form_data;
    }

    public function validate_form_maintenace() {
        $this->form_validation->set_rules('JobName', 'หัวข้อ', 'trim|required');
        $this->form_validation->set_rules('RoomNo', 'หมายเลขห้อง', 'trim|required');
        $this->form_validation->set_rules('NumberKWDevice', 'เลขที่ กว.', 'trim|required');
        $this->form_validation->set_rules('ImageName', 'รูปภาพ', 'trim|required');
        $this->form_validation->set_rules('JobDetail', 'ปัญหาที่แจ้ง', 'trim|required');
        $this->form_validation->set_rules('Note', 'หมายเหตุ', 'trim|required');

        return TRUE;
    }

}
