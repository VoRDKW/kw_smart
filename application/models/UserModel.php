<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class UserModel extends CI_Model {

    public function get_user() {
        $this->db->join('tbm_images', 'tbm_user.ImageUserID = tbm_images.ImageID', 'left');
        $this->db->join('tbm_positions', 'tbm_user.PositionID = tbm_positions.PositionID', 'left');
        $this->db->where('MemberID', $this->session->userdata('MemberID'));
        $query = $this->db->get('tbm_user');
        $rs = $query->db->row_result();

        return $rs;
    }

    public function set_form_edit() {

        $i_PersonalID = array(
            'name' => 'PersonalID',
            'value' => set_value('PersonalID'),
            'placeholder' => 'รหัสประจำตัวประชาชน',
            'class' => 'form-control'
        );
        $i_Username = array(
            'name' => 'Username',
            'value' => set_value('Username'),
            'placeholder' => 'ชื่อผู้ใช้',
            'class' => 'form-control'
        );
        $i_Password = array(
            'name' => 'Password',
            'value' => set_value('Password'),
            'placeholder' => 'รหัสผ่าน',
            'class' => 'form-control'
        );
        $i_Fname = array(
            'name' => 'Fname',
            'value' => set_value('Fname'),
            'placeholder' => 'ชื่อ',
            'class' => 'form-control'
        );
        $i_Lname = array(
            'name' => 'Lname',
            'value' => set_value('Lname'),
            'placeholder' => 'นามสกุล',
            'class' => 'form-control'
        );
        $i_MobilePhone = array(
            'name' => 'MobilePhone',
            'value' => set_value('MobilePhone'),
            'placeholder' => 'เบอร์โทรศัพท์',
            'class' => 'form-control'
        );
        $i_Email = array(
            'name' => 'Email',
            'value' => set_value('Email'),
            'placeholder' => 'อีเมล',
            'class' => 'form-control'
        );
        $i_RoleID = array(
            'name' => 'RoleID',
            'value' => set_value('RoleID'),
            'placeholder' => 'สถานะผู้ใช้',
            'class' => 'form-control'
        );
        $i_ImageName = array(
            'name' => 'ImageName',
            'value' => set_value('ImageName'),
            'placeholder' => 'รูปภาพ',
            'type' => 'file',
            'class' => ''
        );


        $form_add = array(
            'form_open' => form_open(base_url('user/edit/'), array('class' => 'form-horizontal', 'id' => 'form_user')),
            'PersonalID' => form_input($i_PersonalID),
            'Username' => form_input($i_Username),
            'Password' => form_input($i_Password),
            'Fname' => form_input($i_Fname),
            'Lname' => form_input($i_Lname),
            'MobilePhone' => form_input($i_MobilePhone),
            'Email' => form_input($i_Email),
            'RoleID' => form_input($i_RoleID),
            'ImageName' => form_input($i_ImageName),
            'form_close' => form_close(),
        );


        return $form_add;
    }

    public function get_post_form_edit() {
        $form_data = array(
            "PersonalID" => $this->input->post('PersonalID'),
//            "Username" => $this->input->post('Username'),
//            "Password" => $this->input->post('Password'),
//            "Fname" => $this->input->post('Fname'),
//            "Lname" => $this->input->post('Lname'),
//            "MobilePhone" => $this->input->post('MobilePhone'),
//            "Email" => $this->input->post('Email'),
//            "RoleID" => $this->input->post('RoleID'),
//            "ImageName" => $this->input->post('ImageName'),
        );
        return array("user" => $form_data);
    }

    public function set_validation() {
        $this->form_validation->set_rules('PersonalID', 'รหัสประจำตัวประชาชน', 'trim|required');
//        $this->form_validation->set_rules('Usename', 'ชื่อผู้ใช้', 'trim|required');
//        $this->form_validation->set_rules('Password', 'รหัสผ่าน', 'trim|required');
//        $this->form_validation->set_rules('Fname', 'ชื่อ', 'trim|required');
//        $this->form_validation->set_rules('Lname', 'นามสกุล', 'trim|required');
//        $this->form_validation->set_rules('MobilePhone', 'เบอร์โทรศัพท์', 'trim|required');
//        $this->form_validation->set_rules('Email', 'อีเมล', 'trim|required');
//        $this->form_validation->set_rules('RoleID', 'สถานะผู้ใช้', 'trim|required');
//        $this->form_validation->set_rules('ImageName', 'รูปภาพ', 'trim');
        return TRUE;
    }

}
