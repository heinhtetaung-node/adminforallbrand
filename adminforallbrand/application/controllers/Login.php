<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data['error']=false;
		$this->load->model('Crud_model');
		if($this->input->post('login_id')){
			$login_id=$this->input->post('login_id');
			$password=$this->prep_password($this->input->post('password'));
			//echo $password;
			$result=$this->Crud_model->if_admin_user($login_id,$password);
			if($result=="false"){
				$data['error']=true;
			}else{
				$this->session->set_userdata('login_id',$result);
			}
		}
		if(!$this->session->userdata('login_id')){
			$this->load->view('login.php', $data);
		}else{
			//if(!$this->session->userdata('previousurl')){
				redirect(base_url().'Home');
			//}else{
				//$purl=$this->session->userdata('previousurl');
				//$this->session->unset_userdata('previousurl');
				//redirect('http://localhost'.$purl);
			//}
		}
	}
	
	public function prep_password($password){
		return substr(md5($password.$this->config->item('password_salt')),0,32);
	}
	
	public function logout(){
		$this->session->unset_userdata('login_id');
		redirect(base_url().'Login','refresh');
	}
	
}
