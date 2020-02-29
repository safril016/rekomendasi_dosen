<?php

 class M_user extends CI_Model{

 	public function ambil_data( $param )
 	{
		$this->db->select('*');
		$this->db->where( $param );
 		return $this->db->get('tb_user');
 	}

 }
?> 

