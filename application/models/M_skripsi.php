<?php

class M_skripsi extends CI_Model{

 	public function tampil_data()
 	{
 		return $this->db->get('tb_kumpulan');
 	}
	 public function tampil_data_skripsi()
 	{
 		return $this->db->get('tb_skripsi');
 	}
	public function input_data($data)
    {
        $this->db->insert('tb_kumpulan', $data);
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
	public function tambah_data( $data )
	{
		$this->db->insert('tb_skripsi', $data);
	}
	public function skripsi_terbaru()
	{
		$this->db->select('*');
		$this->db->order_by('id', 'desc');
		$this->db->limit(1);
		return $this->db->get('tb_skripsi');
	}
	public function tambah_data_relasi( $data )
	{
		$this->db->insert_batch('tb_seminar', $data);
	}
}
?> 

