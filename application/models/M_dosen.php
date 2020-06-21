<?php

 class M_dosen extends CI_Model{

 	public function tampil_data()
 	{
 		$this->db->select('tb_dosen.*');
 		$this->db->select("SUM(CASE WHEN tb_seminar.keterangan = 'Pembimbing' THEN 1 ELSE 0 END ) AS jumlah_bimbing");
 		$this->db->select("SUM(CASE WHEN tb_seminar.keterangan = 'Penguji' THEN 1 ELSE 0 END ) AS jumlah_uji");
 		$this->db->join(
 			'tb_seminar',
 			'tb_seminar.dosen_id = tb_dosen.id',
 			'left'
 		);
 		$this->db->group_by('tb_dosen.id');
 		return $this->db->get('tb_dosen');
 	}

	public function dosen_berdasarkan_peminatan( $peminatan, $dosen1 = NULL, $dosen2 = NULL )
 	{
		$this->db->select('*');
		$this->db->where('tb_dosen.kategori', $peminatan);
		$this->db->order_by('RAND()');

		$this->db->where('tb_dosen.id !=', $dosen1);
		$this->db->where('tb_dosen.id !=', $dosen2);
		$this->db->limit(3);

 		return $this->db->get('tb_dosen');
	}

	public function dosen_ketua( $peminatan, $keterangan = "Lektor" )
 	{
		$this->db->select('*');
		$this->db->where('tb_dosen.kategori', $peminatan);
		$this->db->order_by('RAND()');

		if($keterangan != "")
			$this->db->where('tb_dosen.keterangan', $keterangan);
		$this->db->limit(2);

 		return $this->db->get('tb_dosen');
	}
	 
	public function input_data($data)
    {
        $this->db->insert('tb_dosen', $data);
    }
    public function hapus_data($where, $table){
    	$this->db->where($where);
    	$this->db->delete($table);
    }
    public function edit_data ($where, $table){
    	return $this->db->get_where($table, $where);

    }
    public function update_data ($where,$data,$table){
    	$this->db->where($where);
    	$this->db->update($table,$data);
    }
 }
?> 

