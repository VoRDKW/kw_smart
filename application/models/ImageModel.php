<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class ImageModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        //$this->load->model('');
    }

    public function get_job_image($JobID) {
        $this->db->join('tbm_images','tbm_images.ImageID = job_has_image.ImageID','left');
        $this->db->where('JobID', $JobID);        
        $query = $this->db->get('job_has_image');
        return $query->result_array();
    }

}
