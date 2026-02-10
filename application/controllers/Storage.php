<?php
class Storage extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Storage_model');
    }

    public function index() {
        $data['storage'] = $this->Storage_model->get_all();
        $data['all_medicine'] = $this->Storage_model->get_all_medicine_name();
        $this->load->view("create_option/header", $data);
        $this->load->view('storage_form', $data);
        $this->load->view("create_option/footer");
    }

    public function save() {
        $data = [
            'medicine_name' => $this->input->post('medicine_name'),
            'storage_category' => $this->input->post('storage_category'),
            'storage_temperature' => $this->input->post('storage_temperature'),
            'notes' => $this->input->post('notes')
        ];
        $this->Storage_model->insert($data);
        redirect('storage');
    }
} 