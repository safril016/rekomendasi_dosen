<?php

 class M_home extends CI_Model{

 	public function tampil_data()
 	{
 		return $this->db->get('tb_kumpulan');
 	}

	
 }
?> 

