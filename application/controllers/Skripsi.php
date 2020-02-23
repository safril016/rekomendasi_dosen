<?php 

class Skripsi extends CI_Controller{
	public function index()
	{
		$origin['menu_list_id'] = 'skripsi_index';
		$data['skripsi']= $this->m_skripsi->tampil_data()-> result();
		$this->load->view('template/header', $origin);
		$this->load->view('template/sidebar');
		$this->load->view('skripsi', $data);
		$this->load->view('template/footer');
	}

	public function tambah_aksi(){
		$nama				= $this->input->post('nama');
		$nim				= $this->input->post('nim');
		$tahun_lulus		= $this->input->post('tahun_lulus');
		$judul_skripsi		= $this->input->post('judul_skripsi');

		$data = array(
				'nama'			=> $nama,
				'nim'			=> $nim,
				'tahun_lulus'	=> $tahun_lulus,
				'judul_skripsi'	=> $judul_skripsi,
		);
		$this->m_skripsi->input_data($data, 'tb_kumpulan');
 		redirect('skripsi/index');
	} 
	public function hapus ($id)
	{
		$where= array ('id' => $id);
		$this->m_skripsi->hapus_data($where, 'tb_kumpulan');
		redirect('skripsi/index');
	}
	public function edit ($id)
	{
		$where = array ('id'=>$id);
		$data['skripsi']= $this->m_skripsi->edit_data($where, 'tb_kumpulan')->result();

		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('edit', $data);
		$this->load->view('template/footer');
	}

	public function update (){
		$id= $this->input->post('id');
		$nama= $this->input->post('nama');
		$nim= $this->input->post('nim');
		$tahun_lulus= $this->input->post('tahun_lulus');
		$judul_skripsi= $this->input->post('judul_skripsi');

			$data = array(
				'nama'			=> $nama,
				'nim'			=> $nim,
				'tahun_lulus'	=> $tahun_lulus,
				'judul_skripsi'	=> $judul_skripsi
		);

		$where = array (
			'id'=> $id
		);
		$this->m_skripsi->update_data($where, $data, 'tb_kumpulan');
		redirect('skripsi/index');
	}
}


