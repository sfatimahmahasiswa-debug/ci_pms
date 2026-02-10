<?php
class Storage_model extends CI_Model {
    public function insert($data) {
        return $this->db->insert('medicine_storage_classification', $data);
    }
    public function get_all() {
        return $this->db->get('medicine_storage_classification')->result();
    }
    public function get_all_medicine_name() {
        return $this->db->get('create_medicine_name')->result();
    }
} 