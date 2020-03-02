<?php

 class M_dosen extends CI_Model{

 	public function tampil_data()
 	{
 		return $this->db->get('tb_dosen');
 	}

	public function dosen_berdasarkan_peminatan( $peminatan, $keterangan = NULL, $dosen1 = NULL, $dosen2 = NULL )
 	{
		$this->db->select('*');
		$this->db->where('tb_dosen.kategori', $peminatan);
		$this->db->order_by('RAND()');

		if( $keterangan ){
			$this->db->where('tb_dosen.keterangan', $keterangan);
			$this->db->limit(2);
		}else {
			$this->db->where('tb_dosen.id !=', $dosen1);
			$this->db->where('tb_dosen.id !=', $dosen2);
			$this->db->limit(3);
		}

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

