<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('session');
		$this->load->library('site_entry');
		 
		if(!$this->site_entry->is_logged_in()){
			//$this->session->set_userdata('previousurl',$_SERVER['REQUEST_URI']); 
			redirect(base_url().'Login');	
		}
		
		$user=$this->session->userdata('login_id');
		$brandjson=$user['brand_ids'];
		$brandids=json_decode($brandjson);

		$host=$_SERVER['HTTP_HOST'];

		$hostbrand_name="";
		$hostbrand_id="";

		$jnbk=strpos($host,'jnbk');
		if($jnbk==""){
			foreach($brandids as $b){
				$brand=strpos($host,$b->brand_name);
				if($brand!=""){
					$url=substr($_SERVER['REQUEST_URI'],1,strlen($_SERVER['REQUEST_URI'])-2);
					//echo $url;
					if($url!="Home/homeconten" && $url!="Language"){
						//$re=base_url().$url.'/'.$b->brand_id;
						//redirect($re);
						//$this->index();
						//to begin from this
					}
					$hostbrand_name=$b->brand_name;
					$hostbrand_id=$b->brand_id;
				}
			}

			if($hostbrand_name==""){
				echo "You have no permission here";
				exit;
			}
		}
		
	}

} 