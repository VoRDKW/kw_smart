<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class BuildingModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_building($BuildingID = NULL) {
        if ($BuildingID != NULL) {
            $this->db->where('BuildingID', $BuildingID);
        }
        $query = $this->db->get('tbm_building');
        if ($BuildingID == NULL) {
            $buildings = $query->result_array();
        } else {
            $buildings = $query->row_array();
        }
        return $buildings;
    }

    public function get_floor($BuildingID = NULL) {

        $Building = $this->get_building($BuildingID);
        $NumberFloor = $Building['NumberFloor'];

        return $NumberFloor;
    }

    public function get_rooms($BuildingID, $Floor = NULL, $RoomID = NULL) {
        $this->db->join('building_has_room', 'tbm_room.RoomID  = building_has_room.RoomID', 'left');
        $this->db->where('building_has_room.BuildingID', $BuildingID);
        if ($Floor != NULL) {
            $this->db->where('Floor', $Floor);
        }

        if ($RoomID != NULL) {
            $this->db->where('tbm_room.RoomID', $RoomID);
        }

        $query = $this->db->get('tbm_room');

        if ($RoomID == NULL) {
            $rs = $query->result_array();
        } else {
            $rs = $query->row_array();
        }
        return $rs;
    }

}
