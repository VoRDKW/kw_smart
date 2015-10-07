<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class UserModel extends CI_Model {

    public function get_user() {
        $this->db->join('tbm_images', 'tbm_user.ImageUserID = tbm_images.ImageID', 'left');
        $this->db->join('tbm_positions', 'tbm_user.PositionID = tbm_positions.PositionID', 'left');
        $this->db->where('MemberID', $this->session->userdata('MemberID'));
        $query = $this->db->get('tbm_user');
        $rs = $query->row_array();
        return $rs;
    }

    public function set_form_edit($MemberID) {
        $data = $this->get_user();
        $i_PersonalID = array(
            'name' => 'PersonalID',
            'value' => $data['PersonalID'],
            'placeholder' => 'รหัสประจำตัวประชาชน',
            'class' => 'form-control'
        );
        $i_Username = array(
            'name' => 'UserName',
            'value' => $data['UserName'],
            'placeholder' => 'ชื่อผู้ใช้',
            'class' => 'form-control'
        );
        $i_Password = array(
            'name' => 'Password',
            'value' => $data['Password'],
            'placeholder' => 'รหัสผ่าน',
            'class' => 'form-control'
        );
        $i_Fname = array(
            'name' => 'Fname',
            'value' => $data['Fname'],
            'placeholder' => 'ชื่อ',
            'class' => 'form-control'
        );
        $i_Lname = array(
            'name' => 'Lname',
            'value' => $data['Lname'],
            'placeholder' => 'นามสกุล',
            'class' => 'form-control'
        );
        $i_MobilePhone = array(
            'name' => 'MobilePhone',
            'value' => $data['MobilePhone'],
            'placeholder' => 'เบอร์โทรศัพท์',
            'class' => 'form-control'
        );
        $i_Email = array(
            'name' => 'Email',
            'value' => $data['Email'],
            'placeholder' => 'อีเมล',
            'class' => 'form-control'
        );
        $i_ImageUserID = array(
            'name' => "ImageUserID",
            'value' => $data['ImageUserID'],
            'placeholder' => 'รูปภาพ',
            'type' => 'file',
            'class' => ''
        );

        $form_add = array(
            'form_open' => form_open_multipart(base_url("user/edit/$MemberID"), array('class' => 'form-horizontal', 'id' => 'frm_user')),
            'PersonalID' => form_input($i_PersonalID),
            'UserName' => form_input($i_Username),
            'Password' => form_input($i_Password),
            'Fname' => form_input($i_Fname),
            'Lname' => form_input($i_Lname),
            'MobilePhone' => form_input($i_MobilePhone),
            'Email' => form_input($i_Email),
            'ImageUserID' => form_input($i_ImageUserID),
            'form_close' => form_close(),
        );
        return $form_add;
    }

    public function update_user($MemberID, $data) {


        $data['UpdateDate'] = $this->DatetimeModel->getDatetimeNow();
        $data['UpdateBy'] = $name = $this->session->userdata('MemberID');

        $this->db->trans_begin();
        $this->db->where('MemberID', $MemberID);
        $this->db->update('tbm_user', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $rs = FALSE;
        } else {
            $this->db->trans_commit();
            $rs = TRUE;
        }
        return $rs;
    }

    public function set_validation_form() {
        $this->form_validation->set_rules('PersonalID', 'รหัสประจำตัวประชาชน', 'trim|required');
        $this->form_validation->set_rules('UserName', 'ชื่อผู้ใช้', 'trim|required');
        $this->form_validation->set_rules('Password', 'รหัสผ่าน', 'trim|required');
        $this->form_validation->set_rules('Fname', 'ชื่อ', 'trim|required');
        $this->form_validation->set_rules('Lname', 'นามสกุล', 'trim|required');
        $this->form_validation->set_rules('MobilePhone', 'เบอร์โทรศัพท์', 'trim|required');
        $this->form_validation->set_rules('Email', 'อีเมล', 'trim|required');
        $this->form_validation->set_rules('ImageUserID', 'รูปผู้ใช้', 'trim');
        $rs = $this->form_validation->run();

        return $rs;
    }

    public function get_form_post() {
         $this->load->model('uploadmodel');
        $form_data = array(
            "PersonalID" => $this->input->post('PersonalID'),
            "UserName" => $this->input->post('UserName'),
            "Password" => $this->input->post('Password'),
            "Fname" => $this->input->post('Fname'),
            "Lname" => $this->input->post('Lname'),
            "MobilePhone" => $this->input->post('MobilePhone'),
            "Email" => $this->input->post('Email'),        
        );
     
           
            $img_id = $this->uploadmodel->upload_image('img_user', 'ImageUserID');
            
            $form_data['ImageUserID'] = $img_id;
     
        return $form_data;
    }

}
