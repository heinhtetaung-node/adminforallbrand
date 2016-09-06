<?php

class Crud_model extends CI_Model{

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	
	/****************** common CRUD and login logout ******************/

	

	public function if_admin_user($login_id,$password){

		$row="false";

		$this->db->select('*');

		$this->db->where('user_name',$login_id);

		$this->db->where('password',$password);

		$result = $this->db->get('tbl_user');

		if($result->num_rows() > 0){

			$row = $result->row_array();

		}

		return $row;

	}

	

	public function getdatas($table){		
		
		if($table=="tbl_supplier"){
			$sql="select n.*, b.brand_name from tbl_supplier n left join tbl_brand b on n.brand_id=b.brand_id";
			$Q = $this->db->query($sql);
			return $Q->result_array();
		}
		
		if($table=="tbl_new"){
			$sql="select n.*, b.brand_name from tbl_new n left join tbl_brand b on n.brand_id=b.brand_id";
			$Q = $this->db->query($sql);
			return $Q->result_array();
		}
		
		if($table=="tbl_category"){
			$sql="select c.*, b.brand_name, b.brand_id, l.language_id, l.language_name from tbl_category c left join tbl_brand b on c.brand_id=b.brand_id left join tbl_language l on l.language_id=c.language_id";
			$Q = $this->db->query($sql);
			return $Q->result_array();
		}
		
		
		if($table=="tbl_post"){
			$sql="select p.*, b.brand_name, b.brand_id, l.language_id, l.language_name from tbl_post p left join tbl_brand b on p.brand_id=b.brand_id left join tbl_language l on l.language_id=p.language_id";
			$Q = $this->db->query($sql);
			return $Q->result_array();
		}
		
		$data = array();
		
		$query = $this->db->get($table);
		
		return $query->result_array();

	}

	
	public function getdatasbybrand($table, $brand_id){		
		
		if($table=="tbl_supplier"){
			$sql="select n.*, b.brand_name from tbl_supplier n left join tbl_brand b on n.brand_id=b.brand_id where n.brand_id='$brand_id'";
			$Q = $this->db->query($sql);
			return $Q->result_array();
		}
		
		if($table=="tbl_new"){
			$sql="select n.*, b.brand_name from tbl_new n left join tbl_brand b on n.brand_id=b.brand_id where n.brand_id='$brand_id'";
			$Q = $this->db->query($sql);
			return $Q->result_array();
		}
		
		if($table=="tbl_category"){
			$sql="select c.*, b.brand_name, b.brand_id, l.language_id, l.language_name from tbl_category c left join tbl_brand b on c.brand_id=b.brand_id left join tbl_language l on l.language_id=c.language_id where c.brand_id='$brand_id'";
			$Q = $this->db->query($sql);
			return $Q->result_array();
		}
		
		
		if($table=="tbl_post"){
			$sql="select p.*, b.brand_name, b.brand_id, l.language_id, l.language_name from tbl_post p left join tbl_brand b on p.brand_id=b.brand_id left join tbl_language l on l.language_id=p.language_id where p.brand_id='$brand_id'";
			$Q = $this->db->query($sql);
			return $Q->result_array();
		}

	}
	

	public function getonedata($id, $table, $idname){

		$this->db->where($idname, $id);		

		$query=$this->db->get($table);

		return $query->result_array();

	}

	

	

	public function savedata($datas, $table){		

		$this->db->insert($table,$datas);

		

		if($this->db->affected_rows() == '1')

		{

			return TRUE;

		}else{

			return FALSE;

		}

	}

	

	public function get_lastid($table,$id){

		$this->db->select_max($id);

		$result=$this->db->get($table)->result_array();

		$id=$result[0][$id];

		$id=$id+1;

		return $id;

	}

	

	public function updatedata($datas, $id, $table, $idname){

		$this->db->where($idname,$id);

		$this->db->update($table, $datas); 	

		if($this->db->affected_rows() == '1'){

			return TRUE;

		}else{

			return FALSE;

		}

		

	}

	

	function delete($id, $table, $idname){

		$this->db->where($idname,$id);

		$this->db->delete($table);

		

		if($this->db->affected_rows() == '1'){

			return TRUE;

		}else{

			return FALSE;

		}

	}	

	

	/****************** common CRUD and login logout ******************/

	

}