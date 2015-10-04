<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
Class LoginModel extends CI_Model {

   
    function set_form() {
        $i_user = array(
            'name' => 'username',
            'value' => set_value('username'),
            'placeholder' => 'ชื่อผู้ใช้',
            'autofocus' => true,
            'class' => 'form-control');
        $i_pass = array(
            'name' => 'password',
            'value' => set_value('password'),
            'placeholder' => 'รหัสผ่าน',
            'class' => 'form-control');

        $data = array(
            'username' => form_input($i_user),
            'password' => form_password($i_pass)
        );
        return $data;
    }
    function set_validation() {
        $this->form_validation->set_rules('username', 'ชื่อผู้ใช้งาน', 'trim|required');
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

    function login($data) {
        //Intial data
        $session = array();

        if ($data['username'] == 'admin' && $data['password'] == 'admin') {
            $session['MemberID']=99999;
            $session['username'] = 'Admin';
            $session['login'] = TRUE;
            $session['IsAdmin']=TRUE;
            $session['permittion'] = "ALL";
            
            $this->session->set_userdata($session);
            return TRUE;
        }  else if ($data['username'] == 'user' && $data['password'] == 'user') {
            $session['MemberID']=99999;
            $session['username'] = 'Admin';
            $session['login'] = TRUE;
             $session['IsAdmin']=FALSE;
            $session['permittion'] = "ALL";
            $this->session->set_userdata($session);
            return TRUE;
        } 
        else {
//            $temp = $this->check_user($data['user'], $data['pass']);
//            if ($temp != FALSE) {
//                $session['username'] = $temp[0]['UserName'];
//                $session['name'] = $temp[0]['Title'] . $temp[0]['FirstName'] . ' ' . $temp[0]['LastName'];
//                $session['login'] = TRUE;
//                $session['permittion'] = $temp[0]['PermissionDetails'];
//                $this->session->set_userdata($session);
//                return TRUE;
//            } else {
                return FALSE;
//            }
        }
    }

    
}
