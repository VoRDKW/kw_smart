<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class LoginModel extends CI_Model {

    private function get_user_login($user, $pass) {
        $this->db->select("*");
        $this->db->where("(PersonalID = 'PersonalID' OR Email = '$user' "
                . "OR UserName = '$user' OR MobilePhone ='$user')");
        if ($pass != NULL) {
            $this->db->where('Password', $pass);
        }
        $query = $this->db->get('tbm_user');
        $users = $query->row_array();
        return $users;
    }

    public function check_admin($MemberID) {
        $this->db->where('PositionID', 2);
        $this->db->where('MemberID', $MemberID);
        $query = $this->db->get('tbm_user');
        $users = $query->row_array();
        if ($users != NULL) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function set_form() {
        $i_user = array(
            'name' => 'username',
            'value' => set_value('username'),
            'placeholder' => 'ชื่อผู้ใช้',
            'autofocus' => true,
            'class' => 'form-control');
        $i_pass = array(
            'name' => 'password',
            //'value' => set_value('password'),
            'placeholder' => 'รหัสผ่าน',
            'class' => 'form-control');

        $data = array(
            'username' => form_input($i_user),
            'password' => form_password($i_pass)
        );
        return $data;
    }

    function set_validation() {
        $this->form_validation->set_rules('username', 'ชื่อผู้ใช้งาน', 'trim|required|callback_username_check');
        $this->form_validation->set_rules('password', 'รหัสผ่าน', 'trim|required');
        return TRUE;
    }

    function get_post() {
        $get_page_data = array(
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password')
        );
        return $get_page_data;
    }

    public function check_user($user, $pass = NULL) {
        $this->db->select("*");
        $this->db->where("(PersonalID = 'PersonalID' OR Email = '$user' "
                . "OR UserName = '$user' OR MobilePhone ='$user')");
        if ($pass != NULL) {
            $this->db->where('Password', $pass);
        }
        $query = $this->db->get('tbm_user');
        $users = $query->result_array();
        if (count($users) <= 0) {
            $rs = FALSE;
        } else {
            $rs = TRUE;
        }
        return $rs;
    }

    function login($data) {
        //Intial data
        $session = array();

//        if ($data['username'] == 'admin' && $data['password'] == 'admin') {
//            $session['MemberID'] = 99999;
//            $session['username'] = 'Admin';
//            $session['login'] = TRUE;
//            $session['IsAdmin'] = TRUE;
//            $session['permittion'] = "ALL";
//
//            $this->session->set_userdata($session);
//            return TRUE;
//        } else if ($data['username'] == 'user' && $data['password'] == 'user') {
//            $session['MemberID'] = 99999;
//            $session['username'] = 'Admin';
//            $session['login'] = TRUE;
//            $session['IsAdmin'] = FALSE;
//            $session['permittion'] = "ALL";
//            $this->session->set_userdata($session);
//            return TRUE;
//        } 
        $temp = $this->check_user($data['username'], $data['pass']);
        if ($temp != FALSE) {
            $user_data = $this->get_user_login($data['username'], $data['password']);

            $session['MemberID'] = $user_data['MemberID'];
            $session['username'] = $user_data['username'];
            $session['IsLogin'] = TRUE;
            $session['IsAdmin'] = $this->check_admin($user_data['MemberID']);
            $session['permittion'] = "ALL";
            $this->session->set_userdata($session);
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
