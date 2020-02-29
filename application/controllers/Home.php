<?php 

class Home extends CI_Controller{
	public function index()
	{
		$origin['menu_list_id'] = 'home_index';
		$data['skripsi']= $this->m_skripsi->tampil_data()-> result();
		$this->load->view('template/public/header');
		$this->load->view('body', $data);
		// $this->load->view('home', $data);
		$this->load->view('template/public/footer');
	}

	public function dosen(  )
	{
		$origin['menu_list_id'] = 'home_dosen';
		$data['dosen'] = $this->m_dosen->tampil_data()->result();
		$this->load->view('template/public/header', $origin);
		$this->load->view('template/public/dosen', $data);
		// $this->load->view('home', $data);
		$this->load->view('template/public/footer');
	}

}


