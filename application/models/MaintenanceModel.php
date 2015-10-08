<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class MaintenanceModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->model('buildingmodel');
        $this->load->model('uploadmodel');
        $this->load->model('datetimemodel');
    }

    public function set_data_view() {
        $rs = array();
        $Jobs = $this->get_jobs();
        foreach ($Jobs as $Job) {
            $job_id = $Job['JobID'];
            $Job['Images'] = $this->imagemodel->get_job_image($job_id);
            $Job['CreateDate'] = $this->datetimemodel->DateTimeThai($Job['CreateDate']);
            array_push($rs, $Job);
        }
        $rs = array_reverse($rs, true); 
        return $rs;
    }
    
    public function get_jobs($JobID = NULL) {
        $this->db->select('*,tbm_jobs.Note as Note,tbm_jobs.CreateDate as CreateDate');
        $this->db->join('tbm_room', 'tbm_room.RoomID=tbm_jobs.RoomID', 'LEFT');
        $this->db->join('building_has_room', 'tbm_room.RoomID = building_has_room.RoomID', 'LEFT');
        $this->db->join('tbm_building', 'tbm_building.BuildingID = building_has_room.BuildingID', 'LEFT');
        $this->db->join('tbm_job_status', 'tbm_job_status.JobStatusID = tbm_jobs.JobStatusID', 'LEFT');
        $this->db->where('tbm_jobs.CreateBy', $this->session->userdata('MemberID'));
        $query = $this->db->get('tbm_jobs');

        if ($JobID == NULL) {
            $rs = $query->result_array();
        } else {
            $rs = $query->row_array();
        }
        return $rs;
    }

    public function insert_job($data) {
        $job_id = $this->gen_job_id();
        $data['JobID'] = $job_id;
        $data['CreateDate'] = $this->datetimemodel->getDatetimeNow();
        $data['CreateBy'] = $this->session->userdata('MemberID');
        $this->db->trans_begin();
        $this->db->insert('tbm_jobs', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $rs = FALSE;
        } else {
            $this->db->trans_commit();
            $this->uploadmodel->upload_multi_image('img_maintenance', 'ImageName', $job_id, 'job_has_image');
            $rs = TRUE;
        }
        return $rs;
    }

    public function update_job($JobID, $data) {
        $data['UpdateDate'] = $this->datetimemodel->getDatetimeNow();
        $data['UpdateBy'] = $this->session->userdata('MemberID');
        $this->db->trans_begin();
        $this->db->where('JobID', $JobID);
        $this->db->update('tbm_jobs', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $rs = FALSE;
        } else {
            $this->db->trans_commit();
            //$this->uploadmodel->upload_multi_image('img_maintenance', 'ImageName', $job_id, 'job_has_image');
            $rs = TRUE;
        }
        return $rs;
    }

    private function gen_job_id() {
        $job_id = date('Ymd');
        $this->db->like('CreateDate', $this->datetimemodel->getDateToday());
        $this->db->order_by('CreateDate', 'DESC');
        $query = $this->db->get('tbm_jobs');
        $num = $query->num_rows();
        $job_id .= str_pad($num + 1, 5, "0", STR_PAD_LEFT);
        return $job_id;
    }

    public function set_form_add() {
        $i_JobName = array(
            'name' => 'JobName',
            'value' => set_value('JobName'),
            'placeholder' => '',
            'size' => '5',
            'autofocus' => true,
            'class' => 'form-control'
        );

        $BuildingID = NULL;

        $i_Building[0] = 'เลือกอาคาร';
        foreach ($this->buildingmodel->get_building() as $building) {
            $i_Building[$building['BuildingID']] = $building['BuildingNo'] . ' ' . $building['BuildingName'];
        }

        $i_Floor[0] = 'เลือกชั้น';
        if ($this->input->post('BuildingID')) {
            $BuildingID = $this->input->post('BuildingID');
            $floor = $this->buildingmodel->get_floor($BuildingID);
            for ($i = 1; $i < $floor; $i++) {
                $i_Floor[$i] = "ชั้นที่ $i";
            }
        }
        $i_Room[0] = 'เลือกห้อง';
        if ($this->input->post('Floor')) {
            $FloorNo = $this->input->post('Floor');
            $rooms = $this->buildingmodel->get_rooms($BuildingID, $FloorNo);
            foreach ($rooms as $room) {
                $i_Room[$room['RoomID']] = 'ห้อง' . $room['RoomNO'] . ' ' . $room['RoomName'];
            }
        }
        $i_NumberKWDevice = array(
            'name' => 'NumberKWDevice',
            'value' => set_value('NumberKWDevice'),
            'placeholder' => 'เลขที่ กว.',
            'class' => 'form-control'
        );
        $i_ImageName = array(
            'name' => 'ImageName[]',
            'type' => 'file',
            'id' => 'ImageName',
            'multiple' => ''
        );
        $i_Detail = array(
            'name' => 'Detail',
            'value' => set_value('Detail'),
            'placeholder' => '',
            'rows' => '3',
            'class' => 'form-control'
        );
        $i_Note = array(
            'name' => 'Note',
            'value' => set_value('Note'),
            'placeholder' => '',
            'class' => 'form-control'
        );
        //$dropdown = 'class="selecter_3" data-selecter-options = \'{"cover":"true"}\' ';
        $dropdown1 = ' class="form-control" ';
        $form_add = array(
            'form_open' => form_open_multipart('maintenance/add/', array('class' => 'form-horizontal', 'id' => 'frm_maintenance')),
            'JobName' => form_input($i_JobName),
            'BuildingID' => form_dropdown('BuildingID', $i_Building, ($BuildingID != NULL) ? $BuildingID : set_value('BuildingID'), $dropdown1 . 'id = "BuildingID" '),
            'RoomID' => form_dropdown('RoomID', $i_Room, set_value('RoomID'), $dropdown1 . 'id = "RoomID" '),
            'Floor' => form_dropdown('Floor', $i_Floor, set_value('Floor'), $dropdown1 . 'id = "Floor" '),
            'NumberKWDevice' => form_input($i_NumberKWDevice),
            'ImageName' => form_input($i_ImageName),
            'Detail' => form_textarea($i_Detail),
            'Note' => form_input($i_Note),
            'form_close' => form_close(),
        );

        return $form_add;
    }

    public function set_form_edit($data) {

        $i_JobName = array(
            'name' => 'JobName',
            'value' => $data['JobName'],
            'placeholder' => '',
            'size' => '5',
            'autofocus' => true,
            'class' => 'form-control'
        );

        $BuildingID = NULL;

        $i_Building[0] = 'เลือกอาคาร';
        foreach ($this->buildingmodel->get_building() as $building) {
            $i_Building[$building['BuildingID']] = $building['BuildingNo'] . ' ' . $building['BuildingName'];
        }

        $i_Floor[0] = 'เลือกชั้น';
        if ($this->input->post('BuildingID') || $data['BuildingID'] != NULL) {
            if ($this->input->post('BuildingID')) {
                $BuildingID = $this->input->post('BuildingID');
            } else {
                $BuildingID = $data['BuildingID'];
            }
            $floor = $this->buildingmodel->get_floor($BuildingID);
            for ($i = 1; $i < $floor; $i++) {
                $i_Floor[$i] = "ชั้นที่ $i";
            }
        }
        $i_Room[0] = 'เลือกห้อง';
        if ($this->input->post('Floor') || $data['Floor'] != NULL) {
            if ($this->input->post('Floor')) {
                $FloorNo = $this->input->post('Floor');
            } else {
                $FloorNo = $data['Floor'];
            }
            $rooms = $this->buildingmodel->get_rooms($BuildingID, $FloorNo);
            foreach ($rooms as $room) {
                $i_Room[$room['RoomID']] = 'ห้อง' . $room['RoomNO'] . ' ' . $room['RoomName'];
            }
        }
        $i_NumberKWDevice = array(
            'name' => 'NumberKWDevice',
            'value' => $data['NumberKWDevice'],
            'placeholder' => 'เลขที่ กว.',
            'class' => 'form-control'
        );
        $i_ImageName = array(
            'name' => 'ImageName[]',
            'type' => 'file',
            'id' => 'ImageName',
            'multiple' => ''
        );
        $i_Detail = array(
            'name' => 'Detail',
            'value' => $data['Detail'],
            'placeholder' => '',
            'rows' => '3',
            'class' => 'form-control'
        );
        $i_Note = array(
            'name' => 'Note',
            'value' => $data['Note'],
            'placeholder' => 'อื่นๆ',
            'class' => 'form-control'
        );
        //$dropdown = 'class="selecter_3" data-selecter-options = \'{"cover":"true"}\' ';
        $dropdown1 = ' class="form-control" ';
        $form_edit = array(
            'form_open' => form_open_multipart('maintenance/edit/' . $data['JobID'], array('class' => 'form-horizontal', 'id' => 'frm_maintenance')),
            'JobName' => form_input($i_JobName),
            'BuildingID' => form_dropdown('BuildingID', $i_Building, ($data['BuildingID'] != NULL) ? $data['BuildingID'] : set_value('BuildingID'), $dropdown1 . 'id = "BuildingID" '),
            'RoomID' => form_dropdown('RoomID', $i_Room, ($data['RoomID'] != NULL ) ? $data['RoomID'] : set_value('RoomID'), $dropdown1 . 'id = "RoomID" '),
            'Floor' => form_dropdown('Floor', $i_Floor, ($data['Floor'] != NULL ) ? $data['Floor'] : set_value('Floor'), $dropdown1 . 'id = "Floor" '),
            'NumberKWDevice' => form_input($i_NumberKWDevice),
            'ImageName' => form_input($i_ImageName),
            'Detail' => form_textarea($i_Detail),
            'Note' => form_input($i_Note),
            'form_close' => form_close(),
        );

        return $form_edit;
    }

    public function get_post_form() {
        $form_data = array(
            "JobName" => $this->input->post('JobName'),
            "RoomID" => $this->input->post('RoomID'),
            "NumberKWDevice" => $this->input->post('NumberKWDevice'),
            // "ImageName" => $this->input->post('ImageName'),
            "Detail" => $this->input->post('Detail'),
            "Note" => $this->input->post('Note'),
        );
        return $form_data;
    }

    public function set_validate_form() {

        $this->form_validation->set_rules('JobName', 'หัวข้อ', 'trim|required');
        $this->form_validation->set_rules('BuildingID', 'อาคาร', 'trim|required|callback_check_dropdown');
        $this->form_validation->set_rules('Floor', 'ชั้น', 'trim|required|callback_check_dropdown');
        $this->form_validation->set_rules('RoomID', 'หมายเลขห้อง', 'trim|required|callback_check_dropdown');
        $this->form_validation->set_rules('NumberKWDevice', 'เลขที่ กว.', 'trim|required');
        $this->form_validation->set_rules('Detail', 'ปัญหาที่แจ้ง', 'trim|required');
        $this->form_validation->set_rules('Note', 'หมายเหตุ', 'trim');

        $rs = $this->form_validation->run();
        return $rs;
    }

}
