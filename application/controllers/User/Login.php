<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
    {
        parent::__construct(); 
    }

	//web
	public function index()
	{
		$this->load->library('form_validation');

		//POST
		if( $_SERVER["REQUEST_METHOD"]==="POST" ){
			
			$this->form_validation->set_rules('email', 'Username/Email', 'required|min_length[3]');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

			//exit(json_encode(form_error('email')));
			if( !$this->form_validation->run() ){
				$this->session->set_flashdata('message','<div class="mb-4 alert alert-danger">Username or Password Is Incorrect.</div>');
				return $this->load->view('user/login/index');
			}

			$this->load->model('user/User_model');
			$userModel = new User_model();
			$user = $userModel->findUserByEmail($this->input->post('email'));
			$userModel->close_conn();
			if( !$user ){
				$this->session->set_flashdata('message','<div class="mb-4 alert alert-danger">Username or Password Is Incorrect.</div>');
				return $this->load->view('user/login/index');
			}

			$this->load->model('services/Aesencrypt_model');
			if( $user['password']!=(new Aesencrypt_model())->login_encrypt($this->input->post('password')) ){
				$this->session->set_flashdata('message','<div class="mb-4 alert alert-danger">Username or Password Is Incorrect.</div>');
				return $this->load->view('user/login/index');
			}

			if( $user['status']!=1 ){
				$this->session->set_flashdata('message','<div class="mb-4 alert alert-danger">Account Is Inactive.</div>');
				return $this->load->view('user/login/index');
			}
			
			//success
			unset($user['password']);
			$this->session->set_userdata($user);

			redirect(base_url().'user/dashboard');
		}

		//GET
		
		$data['data'] = [];
		return $this->load->view('user/login/index',$data);
	}

	//web
    public function register()
	{
		$this->load->library('form_validation');

		//POST
		if( $_SERVER["REQUEST_METHOD"]==="POST" ){
			
			$this->form_validation->set_rules('name', 'Surname', 'trim|required|min_length[3]|max_length[20]');
			$this->form_validation->set_rules('contact', 'Contact', 'required|integer|greater_than[0]|less_than[999999999999]');
			$this->form_validation->set_rules('email', 'Username/Email', 'required|min_length[3]|max_length[50]');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
			$this->form_validation->set_rules('password_confirm', 'Password Confirm', 'required|min_length[6]');

			//exit(json_encode(form_error('email')));
			if( !$this->form_validation->run() ){
				return $this->load->view('user/login/register');
			}

			if( $this->input->post('password')!=$this->input->post('password_confirm') ){
				$this->form_validation->set_rules('password', 'Username/Email', 'custom_error');
				$this->form_validation->set_rules('password_confirm', 'Username/Email', 'custom_error');
				$this->form_validation->set_message('custom_error', 'Passwords Did Not Match.');
				$this->form_validation->run();
				return $this->load->view('user/login/register');
			}

			$this->load->model('user/User_model');
			$userModel = new User_model();
			$user_exist = $userModel->findUserByEmail($this->input->post('email'),'id');
			if( $user_exist ){
				$this->form_validation->set_rules('email', 'Username/Email', 'custom_error');
				$this->form_validation->set_message('custom_error', 'Username/Email has already taken. Please enter another one.');
				$this->form_validation->run();
				return $this->load->view('user/login/register');
			}
			
			//success
			$this->load->model('services/Aesencrypt_model');
			$insert = [];
			$insert['role_id'] = 3;//user
			$insert['status'] = 1;
			$insert['email'] = $this->input->post('email');
			$insert['password'] = (new Aesencrypt_model())->login_encrypt($this->input->post('password'));
			$insert['name'] = $this->input->post('name');
			$insert['contact'] = $this->input->post('contact');
			$insert['created_at'] = time();

			$result = $userModel->insert($insert);
			$userModel->close_conn();
			if( $result ){
				$this->session->set_flashdata('message','<div class="mb-4 alert alert-success">Account Created Successfully! Please Login.</div>');
				redirect(base_url().'user/login');
			}
			else{
				$this->session->set_flashdata('message','<div class="mb-4 alert alert-danger">Account Register Failed.</div>');
				redirect(base_url().'user/login');
			}
			
		}

		//GET
		$data['data'] = [];
		return $this->load->view('user/login/register',$data);
	}

	//api not developing
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
			return json_encode($this->response(0,'E001',reset($error_data)?? 'Something Went Wrong',$error_data)) ;
		};
	
		return json_encode($this->response(0,'','Error',form_error()));
	}

	//api
    public function signin()
	{
		echo json_encode($this->response());
	}

}
