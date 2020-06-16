<?php 

class Katadasar extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		if( !$this->session->userdata('id') ) redirect('auth/login');
	}
	public function index()
	{
		$origin['menu_list_id'] = 'katadasar_index';
		$data['katadasar']= $this->m_katadasar->tampil_data()-> result();
		$this->load->view('template/header', $origin);
		$this->load->view('template/sidebar');
		$this->load->view('katadasar', $data);
		$this->load->view('template/footer');
	}

	public function tambah_aksi(){
		$kata_dasar				= $this->input->post('kata_dasar');
		$kategori				= $this->input->post('kategori');
		
		$data = array(
				'kata_dasar'	=> $kata_dasar,
				'kategori'		=> $kategori,
				
		);
		$this->m_katadasar->input_data($data, 'tb_katadasar');
 		redirect('katadasar/index');
	} 
	public function hapus ($id)
	{
		$where= array ('id' => $id);
		$this->m_katadasar->hapus_data($where, 'tb_katadasar');
		redirect('katadasar/index');
	}
	public function editkatadasar ($id)
	{
		$where = array ('id'=>$id);
		$data['katadasar']= $this->m_katadasar->edit_data($where, 'tb_katadasar')->result();

		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('editkatadasar', $data);
		$this->load->view('template/footer');
	}

	public function update (){
		$id= $this->input->post('id');
		$kata_dasar= $this->input->post('kata_dasar');
		$kategori= $this->input->post('kategori');
		
			$data = array(
				'kata_dasar'	=> $kata_dasar,
				'kategori'		=> $kategori
		
		);

		$where = array (
			'id'=> $id
		);
		$this->m_katadasar->update_data($where, $data, 'tb_katadasar');
		redirect('perhitungan/indexing');
	}
}


