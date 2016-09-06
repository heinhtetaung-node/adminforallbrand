<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Crud extends CI_Controller {

	function __construct(){

		parent::__construct();
			
		//$this->load->library('session');
		//$this->load->library('site_entry');
		//if(!$this->site_entry->is_logged_in()){
			//redirect(base_url().'admin_dashboard/login');	
		//}
		$this->_init();

	}

	private function _init(){
		$this->load->model('Crud_model');
	}

	public function getdatas(){
		$data = json_decode(file_get_contents("php://input"));     
		echo json_encode($this->Crud_model->getdatas($data->table),JSON_NUMERIC_CHECK);
	}
	
	public function getdatasbybrand($brand_id){
		$data = json_decode(file_get_contents("php://input"));     
		echo json_encode($this->Crud_model->getdatasbybrand($data->table, $brand_id),JSON_NUMERIC_CHECK);
	}
	
	public function getonedata(){
		$data = json_decode(file_get_contents("php://input"));     
		echo json_encode($this->Crud_model->getonedata($data->id, $data->table, $data->idname)); 		
	}


	public function savedata(){
		$data = json_decode(file_get_contents("php://input"));     
		
		if($data->table=='tbl_supplier'){
			if(isset($data->arr->supplier_password)){
				$data->arr->supplier_password=$this->prep_password($data->arr->supplier_password);
			}
		}
		
		if($data->table=='tbl_user'){
			if(isset($data->arr->password)){
				$data->arr->password=$this->prep_password($data->arr->password);
			}
			$brand_ids=$data->arr->brand_ids;
			
			$arr=array();
			$i=0;
			foreach($brand_ids as $b){
				$a = explode("|", $b);
				$arr[$i]['brand_id']=$a[0];
				$arr[$i]['brand_name']=$a[1];
				$i++;
			}
			
			$brand_ids=json_encode($arr);
			$data->arr->brand_ids=$brand_ids;
		}
		
		if($data->table=="tbl_new" || $data->table=="tbl_post"){
			//echo "<pre>";
			//var_dump($data);
			//echo "</pre>";
			
			rename("./userupload/".$data->arr->post_img, "./userupload/".$data->brand."/".$data->arr->post_img);
			//exit;
		}
		
		if(!isset($data->id)){
			echo json_encode($this->Crud_model->savedata($data->arr, $data->table)); 		
		}

		if(isset($data->id)){
			if($data->id!=""){
				echo json_encode($this->Crud_model->updatedata($data->arr, $data->id, $data->table, $data->idname)); 		
			}else{
				echo json_encode($this->Crud_model->savedata($data->arr, $data->table)); 			
			}
		}
	}

	
	public function prep_password($password){
		return substr(md5($password.$this->config->item('password_salt')),0,32);
	}
	
	
	public function delete(){
		$data = json_decode(file_get_contents("php://input"));     
        echo json_encode($this->Crud_model->delete($data->id, $data->table, $data->idname)); 		
	}
	
	public function getdatasforselect(){
		$data = json_decode(file_get_contents("php://input"));     
		echo json_encode($this->Crud_model->getdatas($data->table),JSON_NUMERIC_CHECK);
	}
	
	public function uploadphoto(){
		//sleep(1);
		
		$config['overwrite'] = true;
		$config['upload_path'] =  './userupload/';
		$config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';
		$config['max_size'] = $this->config->item('max_size');
		$config['max_width'] = $this->config->item('max_width');
		$config['max_height'] = $this->config->item('max_height');
		$config['encrypt_name'] = FALSE;
		$config['max_size'] = 0;
		$this->load->library('upload');
		$this->upload->initialize($config);
		$this->upload->do_upload('photo');
		
		
		
		if (!$this->upload->do_upload('photo'))		// name of tile
		{ 
			$error = $this->upload->display_errors();
			echo '<p>'.$error.'</p>';
		}
		else
		{
			$upload_data = $this->upload->data();
			
		}
		
		//var_dump($upload_data);
		echo json_encode($upload_data['file_name']);
	}
}



/* End of file welcome.php */

/* Location: ./application/controllers/welcome.php */

