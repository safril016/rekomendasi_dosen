<?php 

class Dosen extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		if( !$this->session->userdata('id') ) redirect('auth/login');
	}
	public function index()
	{
		$origin['menu_list_id'] = 'dosen_index';
		$data['dosen']= $this->m_dosen->tampil_data()-> result();
		$this->load->view('template/header', $origin);
		$this->load->view('template/sidebar');
		$this->load->view('dosen', $data);
		$this->load->view('template/footer');
	}

	public function tambah_aksi(){
		$nama				= $this->input->post('nama');
		$kategori			= $this->input->post('kategori');
		$keterangan			= $this->input->post('keterangan');
		
		$data = array(
				'nama'			=> $nama,
				'kategori'		=> $kategori,
				'keterangan'	=> $keterangan,
				
		);
		$this->m_dosen->input_data($data, 'tb_dosen');
 		redirect('dosen/index');
	} 
	public function hapus ($id)
	{
		$where= array ('id' => $id);
		$this->m_dosen->hapus_data($where, 'tb_dosen');
		redirect('dosen/index');
	}
	public function editdosen ($id)
	{
		$where = array ('id'=>$id);
		$data['dosen']= $this->m_dosen->edit_data($where, 'tb_dosen')->result();

		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('editdosen', $data);
		$this->load->view('template/footer');
	}

	public function update (){
		$id= $this->input->post('id');
		$nama= $this->input->post('nama');
		$kategori= $this->input->post('kategori');
		$keterangan= $this->input->post('keterangan');
		
			$data = array(
				'nama'			=> $nama,
				'kategori'		=> $kategori,
				'keterangan'	=> $keterangan
		
		);

		$where = array (
			'id'=> $id
		);
		$this->m_dosen->update_data($where, $data, 'tb_dosen');
		redirect('dosen/index');
	}
}


