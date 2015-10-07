<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('loginmodel');
        $this->load->model('uploadmodel');
        $this->load->library('form_validation');
        $this->load->helper('form');
    }

    public function index() {
        if (isset($_SESSION['IsLogin']) && $_SESSION['IsLogin'] == TRUE) {
            redirect('home');
        }

        if ($this->loginmodel->set_validation() && $this->form_validation->run()) {
            $form_data = $this->loginmodel->get_post();
            if ($this->loginmodel->login($form_data)) {
                if ($_SESSION['IsAdmin'] == TRUE) {
                    redirect('http://localhost/kw_smart_admin/');
                } else {
                    redirect('home');
                }
            }
        }
        $data['form_action'] = form_open('login', array('class' => 'form-signin'));
        $data['form_input'] = $this->loginmodel->set_form();

        $this->load->view('login_view', $data);
    }

////////////////////////////
    public function upload() {
        $data = array();

        $this->load->view('upload_form', array('error' => ' '));
    }

    public function upload_image2() {
        // $this->uploadmodel->upload_image('img_user','userfile');
        $rs = $this->upload_multi_image('img_maintenance', 'userfile');
        $this->load->view('upload_form', array('error' => $rs));
    }

    public function upload_image($folder, $input_file_name) {

        if (!empty($_FILES[$input_file_name]['name'])) {
            $config['upload_path'] = "./assets/upload/" . $folder . "/";
            $config['allowed_types'] = "gif|jpg|jpeg|png";
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = "5000";
            $config['max_width'] = "2920";
            $config['max_height'] = "2080";
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $this->load->view('upload_form', $error);
            } else {
                $finfo = $this->upload->data();
                // to re-size for thumbnail images un-comment and set path here and in json array
                $config2 = array();
                $config2['image_library'] = 'gd2';
                $config2['source_image'] = $finfo['full_path'];
                $config2['create_thumb'] = TRUE;
                $config2['new_image'] = './assets/upload/' . $folder . '/thumbs/' . $finfo['file_name'];
                $config2['thumb_marker'] = '';
                $config2['width'] = 1;
                $config2['height'] = 200;
                $config2['maintain_ratio'] = TRUE;
                $config2['master_dim'] = 'height';
                $this->load->library('image_lib', $config2);
                $this->image_lib->resize();

                $data_img = array(
                    'ImageName' => $finfo['file_name'],
                    'ImageFullPath' => $folder . '/' . $finfo['file_name'],
                    'ImageThumbPath' => $folder . '/thumbs/' . $finfo['file_name'],
                    'ImageWidth' => $finfo['image_width'],
                    'ImageHigh' => $finfo['image_height'],
                    'ImageSize' => $finfo['file_size']
                );
                $this->load->view('upload_form', array('error' => $data_img));
            }
        } else {
            redirect(site_url('login/upload'));
        }
    }

    public function upload_multi_image($folder, $input_name, $job_id = NULL) {
        //$rs = array();
        $this->load->library('upload');
        $table = 'job_has_image';
        $rs = count($_FILES[$input_name]['name']); //$this->multifile($_FILES[$input_name]);
//        foreach ($_FILES as $file => $file_data) {
//            // No problems with the file
//            if ($file_data['error'] == 0) {
////                $this->upload->initialize($this->set_upload_image($folder));
//                $this->load->library('upload', $this->set_upload_image($folder));
//                // So lets upload
//                if ($this->upload->do_upload($file)) {
//                    $finfo = $this->upload->data();
//                    $this->resize_image($finfo['full_path'], $finfo['file_path']);
//                    //insert to database
//                    $data_img = array(
//                        'ImageName' => $finfo['file_name'],
//                        'ImageFullPath' => $folder . '/' . $finfo['file_name'],
//                        'ImageThumbPath' => $folder . '/thumbs/' . $finfo['file_name'],
//                        'ImageWidth' => $finfo['image_width'],
//                        'ImageHigh' => $finfo['image_height'],
//                        'ImageSize' => $finfo['file_size']
//                    );
////                    $this->db->trans_start();
////                    $this->db->insert('tbm_images', $data_img);
////                    $image_id = $this->db->insert_id();
////                    $this->db->trans_complete();
////                    if ($table == 'job_has_image') {
////                        $img = array(
////                            'JobID' => $job_id,
////                            'ImageID' => $image_id,
////                        );
////                     $rs =  $this->db->insert('job_has_image', $img);
////                    }
//                    array_push($rs, $data_img);
//                } else {
//                    $rs = $this->upload->display_errors();
//                }
//            }
//        }
        return $rs;
    }

    private function resize_image($src_path, $file_path) {
        $this->load->library('image_lib');
        // to re-size for thumbnail images un-comment and set path here and in json array
        $config = array();
        $config['image_library'] = 'gd2';
        $config['source_image'] = $src_path;
        $config['create_thumb'] = TRUE;
        $config['new_image'] = $file_path . 'thumbs/';
        $config['thumb_marker'] = '';
        $config['width'] = 1;
        $config['height'] = 200;
        $config['maintain_ratio'] = TRUE;
        $config['master_dim'] = 'height';
        $this->image_lib->clear();
        $this->image_lib->initialize($config);
        $rs = $this->image_lib->resize();
        return $rs;
    }

// Codeigniter Upload Multiple File
    public function multifile($filedata) { // $_FILES['files'];
        if (count($filedata) == 0)
            return FALSE;
        $files = array();
        $all_files = $filedata['name'];
        $i = 0;
        foreach ($all_files as $filename) {
            $files[++$i]['name'] = $filename;
            $files[$i]['type'] = current($filedata['type']);
            next($filedata['type']);
            $files[$i]['tmp_name'] = current($filedata['tmp_name']);
            next($filedata['tmp_name']);
            $files[$i]['error'] = current($filedata['error']);
            next($filedata['error']);
            $files[$i]['size'] = current($filedata['size']);
            next($filedata['size']);
        }
        return $files;
    }

    ////////////////////////////

    public function username_check($str) {
        if ($this->loginmodel->check_user($str) == FALSE) {
            $this->form_validation->set_message('username_check', 'ชื่อผู้ใช้งานไม่ถูกต้อง');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
