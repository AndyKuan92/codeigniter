<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Services\Aesencrypt;

class Login extends CI_Controller {

	//web
	public function index()
	{

		$this->load->view('user/login/index');
	}

	//web
    public function register()
	{

		$this->load->library('form_validation');
		if( $_SERVER["REQUEST_METHOD"]==="POST" ){
			$this->form_validation->set_rules('name', 'Surname', 'required');
			$this->form_validation->set_rules('contact', 'Contact', 'required');
			$this->form_validation->set_rules('email', 'Username/Email', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('password_confirm', 'Password Confirm', 'required');
			//success
			if( $this->form_validation->run() ){

			}

		}
		
		$this->load->view('user/login/register');
	}

	//api
    public function signup()
	{
		if( $_SERVER["REQUEST_METHOD"]!="POST" ){
			show_404();
		}

		$this->load->library('form_validation');
		$this->form_validation->set_data($this->input->post());
        $this->form_validation->set_rules('name', 'Surname', 'required');
		
		$error_data = [];
		if( !$this->form_validation->run() ){
			foreach( $this->input->post() as $k => $v ){
				if( form_error($k) ){
					$error_data[$k] = form_error($k,'','');
				}
			}
			echo json_encode($this->response(0,'E001',reset($error_data)?? 'Something Went Wrong',$error_data)) ;
		};

		//$data = (new Aesencrypt())->login_encrypt('123');
	
		//echo json_encode($this->response(0,'','Error',form_error()));
	}

	//api
    public function signin()
	{
		echo json_encode($this->response());
	}

}
