<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller
{
	public function __construct() {
		parent::__construct();
		$this->load->model('CommonModel');
	} // Load Common Model

	function index()
	{
		$data['title'] = 'CodeIgniter Simple Login form With Session';
		$this->load->view("login", $data);
	}
	function login()
	{
		$data['title'] = 'CodeIgniter Simple Login form With Session';
		$this->load->view("login", $data);
	}

	function login_validation()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if ($this->form_validation->run()) {
			//true
			$username = $this->input->post('username');
			$password = md5($this->input->post('password'));

			//model function
			$this->load->model('Main_model');
			if ($this->Main_model->can_login($username, $password)) {
				$session_data = array(
					'username' => $username
				);
				$this->session->set_userdata($session_data);
				redirect(base_url() . 'main/enter');
			} else {
				$this->session->set_flashdata('error', 'Invalid Username and Password');
				redirect(base_url() . 'main/login');
			}
		} else {
			//false
			$this->login();
		}
	}

	//empty ok
	function enter()
	{
		if ($this->session->userdata('username') != '') {

			$data['medicine_qty'] = count($this->CommonModel->get_all_info('create_medicine_name')); //

			//Expire Date
			$array_check_near_expire = array(
				"expiredate<=" => date('Y-m-d')
			);
			$data['near_expired_product'] = count($this->CommonModel->get_all_info_by_array('insert_purchase_info', $array_check_near_expire));

			//END Dash Data

			$this->load->view("header");
			$this->load->view("dashboard",$data);
			$this->load->view("footer");
//			echo'<h2>Welcome-'.$this->session->userdata('username').'</h2>';
//			echo '<a href="'.base_url().'main/logout">Logout</a>';
		}
	}

	function logout()
	{
		$this->session->unset_userdata('username');
		redirect(base_url() . 'main/login');
	}
}
