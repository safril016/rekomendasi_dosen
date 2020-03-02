<?php

class M_seminar extends CI_Model{

 	public function tampil_data( $skripsi_id = NULL )
 	{
		 $this->db->select('tb_dosen.*');
		 $this->db->join(
			 'tb_dosen',
			 'tb_dosen.id = tb_seminar.dosen_id',
			 'inner'
		 );
		 if( $skripsi_id ){
			 $this->db->where('tb_seminar.skripsi_id', $skripsi_id);
		 }
 		return $this->db->get('tb_seminar');
 	}
	public function tambah_data_relasi( $data )
	{
		$this->db->insert_batch('tb_seminar', $data);
	}
	public function hapus_data($where, $table){
    	$this->db->where($where);
    	$this->db->delete($table);
    }
}
?> 

