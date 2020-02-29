<?php 

class Rekomendasi extends CI_Controller{
	public function index()
	{
		$origin['menu_list_id'] = 'dosen_index';
		$data['rekomendasi']= $this->m_dosen->tampil_data()-> result();
		$this->load->view('template/header', $origin);
		$this->load->view('template/sidebar');
		$this->load->view('rekomendasi', $data);
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
		$this->m_rekomendasi->input_data($data, 'tb_dosen');
 		redirect('rekomendasi/index');
	} 
	public function hapus ($id)
	{
		$where= array ('id' => $id);
		$this->m_rekomendasi->hapus_data($where, 'tb_dosen');
		redirect('rekomendasi/index');
	}
	public function editrekomendasi ($id)
	{
		$where = array ('id'=>$id);
		$data['rekomendasi']= $this->m_dosen->edit_data($where, 'tb_dosen')->result();

		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('editrekomendasi', $data);
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


