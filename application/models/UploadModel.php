<?php

Class UploadModel extends CI_Model {

    private function set_config_image($folder) {
//  upload an image options
        $config = array();
        $config['upload_path'] = "./assets/upload/" . $folder;
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = "5000";
        $config['max_width'] = "2920";
        $config['max_height'] = "2080";
//        $config['overwrite'] = FALSE;
        $config['encrypt_name'] = TRUE;
        return $config;
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

    public function upload_image($folder, $input_file_name, $img_id = NULL) {
        if (!empty($_FILES[$input_file_name]['name'])) {
            $config['upload_path'] = "./assets/upload/" . $folder;
            $config['allowed_types'] = "gif|jpg|jpeg|png";
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = "5000";
            $config['max_width'] = "2920";
            $config['max_height'] = "2080";
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload()) {
                return $this->upload->display_errors();
            } else {
                //insert to database
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
//                unlink($finfo['full_path']);
                if ($img_id == NULL) {
                    $this->db->trans_start();
                    $this->db->insert('tbm_images', $data_img);
                    $image_id = $this->db->insert_id();
                    $this->db->trans_complete();
                    return $image_id;
                } else {
                    //$this->deleteImage($img_id);
                    //$this->db->where('image_id', $img_id);
                    //$this->db->update('images', $data_img);
                    return $image_id;
                }
            }
        }
    }

    public function upload_multi_image($folder, $input_file_name, $id, $table) {
        $this->load->library('upload');
        $data_img = array();
        $data_error = array();
        $number_of_files_uploaded = count($_FILES[$input_file_name]['name']);
        for ($i = 0; $i < $number_of_files_uploaded; $i++) {
            $_FILES['userfile']['name'] = $_FILES[$input_file_name]['name'][$i];
            $_FILES['userfile']['type'] = $_FILES[$input_file_name]['type'][$i];
            $_FILES['userfile']['tmp_name'] = $_FILES[$input_file_name]['tmp_name'][$i];
            $_FILES['userfile']['error'] = $_FILES[$input_file_name]['error'][$i];
            $_FILES['userfile']['size'] = $_FILES[$input_file_name]['size'][$i];
            $this->upload->initialize($this->set_config_image($folder));
            if (!$this->upload->do_upload()) {
                $data_error[$i] = $this->upload->display_errors();
            } else {
                $finfo = $this->upload->data();
                $this->resize_image($finfo['full_path'], $finfo['file_path']);
                $data_img[$i] = $finfo;
                $data_img = array(
                    'ImageName' => $finfo['file_name'],
                    'ImageFullPath' => $folder . '/' . $finfo['file_name'],
                    'ImageThumbPath' => $folder . '/thumbs/' . $finfo['file_name'],
                    'ImageWidth' => $finfo['image_width'],
                    'ImageHigh' => $finfo['image_height'],
                    'ImageSize' => $finfo['file_size']
                );
                if ($table == 'job_has_image') {
                    $job_has_image = array(
                        'JobID' => $id,
                        'ImageID' => $this->insert_image($data_img)
                    );
                    $data_img[$i]['insert_job_has_image'] = $this->insert_job_has_image($job_has_image);
                }
            }
        }
        $rs = array(
            'number_file' => $number_of_files_uploaded,
            'data_img' => $data_img,
            'error' => $data_error
        );

        return $rs;
    }

    private function insert_job_has_image($data) {
        $this->db->trans_begin();
        $this->db->insert('job_has_image', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $rs = FALSE;
        } else {
            $this->db->trans_commit();
            $rs = TRUE;
        }
        return $rs;
    }

    public function insert_image($data) {
        $data['CreateDate'] = $this->DatetimeModel->getDatetimeNow();
        $data['CreateBy'] = $name = $this->session->userdata('MemberID');

        $this->db->trans_begin();
        $this->db->insert('tbm_images', $data);
        $id = $this->db->insert_id();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $rs = NULL;
        } else {
            $this->db->trans_commit();
            $rs = $id;
        }
        return $rs;
    }

    public function deleteImage($image_id) {
        $this->db->select('ImageName,ImageFullPath,ImageThumbPath');
        $this->db->from('tbm_images');
        $this->db->where('ImageID', $image_id);
        $query = $this->db->get();
        $row = $query->row_array();
        unlink($row['ImageFullPath']);
        unlink($row['ImageThumbPath']);
    }

    public function upload_file($name, $id = NULL) {
        if (!empty($_FILES[$name]['name'])) {
            $config['upload_path'] = "assets/upload";
            // set allowed file types
            $config['allowed_types'] = "pdf";
            // set upload limit, set 0 for no limit
            $config['max_size'] = 0;
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload($name)) {
                return $this->upload->display_errors();
            } else {
                //insert to database
                $finfo = $this->upload->data();
                $data_file = array(
                    'file_name' => $finfo['file_name'],
                    'file_path' => $finfo['file_path'],
                    'file_full_path' => $finfo['full_path'],
                );
//                unlink($finfo['full_path']);
                if ($id == NULL) {
                    $this->db->trans_start();
                    $this->db->insert('files', $data_file);
                    $file_id = $this->db->insert_id();
                    $this->db->trans_complete();
                    return $file_id;
                } else {
                    $this->deleteFile($id);
                    $this->db->where('file_id', $id);
                    $this->db->update('files', $data_file);
                    return $id;
                }
            }
        }
    }

    public function upload_multi_file($input_name, $id) {
        $this->load->library('upload');
        $i = 0;
        $_FILES = $this->multifile($_FILES[$input_name]);
        if (count($_FILES) > 0) {
            foreach ($_FILES as $file => $file_data) {
                // No problems with the file
                if ($file_data['error'] == 0) {
                    // So lets upload  
                    $this->upload->initialize($this->set_upload_file());
//                $this->upload->do_upload($file);
                    if ($this->upload->do_upload($file)) {
                        $finfo = $this->upload->data();
                        //insert to database
                        $data_file = array(
                            'file_name' => $finfo['file_name'],
                            'file_path' => $finfo['file_path'],
                            'file_full_path' => $finfo['full_path'],
                        );
                        $this->db->trans_start();
                        $this->db->insert('files', $data_file);
                        $f_id = $this->db->insert_id();
                        $this->db->trans_complete();
                        $t = $this->input->post('txtTitle');
                        if ($t[$i] == NULL || $t[$i] == '') {
                            $title = $finfo['orig_name'];
                        } else {
                            $title = $t[$i];
                        }
                        $f = array(
                            'news_id' => $id,
                            'file_id' => $f_id,
                            'title' => $title,
                        );
                        $this->db->insert('news_has_files', $f);
                    }
                }
                $i++;
            }
        }
        $_FILES[$input_name]['name'] = NULL;
    }

    private function set_upload_file() {
//  upload an image options
        $config = array();
        $config['upload_path'] = "assets/upload";
        $config['allowed_types'] = 'pdf|gif|jpg|png|doc|docx|zip';
        $config['max_size'] = 0;
//        $config['overwrite'] = FALSE;
        $config['encrypt_name'] = TRUE;
        return $config;
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

    public function deleteFile($file_id) {
        $this->db->select('file_full_path');
        $this->db->from('files');
        $this->db->where('file_id', $file_id);
        $query = $this->db->get();
        $row = $query->row_array();
        unlink($row['file_full_path']);
    }

}
