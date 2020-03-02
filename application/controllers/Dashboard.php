<?php 

class Dashboard extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		if( !$this->session->userdata('id') ) redirect('auth/login');
	}
	public function index()
	{
		$origin['menu_list_id'] = 'dashboard_index';
		$this->load->view('template/header', $origin);
		$this->load->view('template/sidebar');
		$this->load->view('dashboard');
		$this->load->view('template/footer');
	}
}


