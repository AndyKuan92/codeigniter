<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Phone extends CI_Controller {

    private $user_id;
    private $role_id;

    public function __construct()
    {
        parent::__construct();

        $this->user_id = $this->session->userdata()['id']?? 0;
        $this->role_id = $this->session->userdata()['role_id']?? 0;

        if( $_SERVER["REQUEST_METHOD"]==="POST" ){
            if( $this->user_id==0 || $this->role_id==0 ){
                return $this->response(0,'E000','Unauthorised Reqeust',[]);
            }
        }
        else if( $_SERVER["REQUEST_METHOD"]==="GET" ){
            if( $this->user_id==0 || $this->role_id==0 ){
                return redirect(base_url().'user/login');
            }
        }
        else{
            return redirect(base_url().'user/login');
        }
    }

    //web
	public function index()
	{

        $data['data'] = [];
        $data['user'] = $this->session->userdata();

        $this->load->model('user/Phone_model');
		$phoneModel = new Phone_model();
        $data['list'] = json_encode($phoneModel->findAll());
        //exit(  $data['list'] );
        $phoneModel->close_conn();
		return $this->load->view('user/phone/index',$data);
	}

    //web
	public function add()
	{
        $data['data'] = [];
        $data['user'] = $this->session->userdata();
        $this->load->library('form_validation');

        //POST
		if( $_SERVER["REQUEST_METHOD"]==="POST" ){

            $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]|max_length[50]');
			$this->form_validation->set_rules('contact', 'Contact', 'required|integer|greater_than[0]|less_than[999999999999]');

			//exit(json_encode(form_error('email')));
			if( !$this->form_validation->run() ){
				return $this->load->view('user/phone/index_add',$data);
			}
			
			//success
			$insert = [];
			$insert['user_id'] = $this->session->userdata('id');
			$insert['name'] = $this->input->post('name');
			$insert['value'] = $this->input->post('contact');
			$insert['created_at'] = time();

            $this->load->model('user/Phone_model');
			$phoneModel = new Phone_model();
			$result = $phoneModel->insert($insert);
			$phoneModel->close_conn();
			if( $result ){
				$this->session->set_flashdata('message','<div class="col-12 mb-4 alert alert-success">Phone Added Successfully!</div>');
				redirect(base_url().'user/phone/add');
			}
			else{
				$this->session->set_flashdata('message','<div class="col-12 mb-4 alert alert-danger">Phone Add Failed.</div>');
				redirect(base_url().'user/phone/add');
			}

        }

        //GET
		return $this->load->view('user/phone/index_add',$data);
	}

    //web
	public function edit($param_1="")
	{
        $data['data'] = [];
        $data['user'] = $this->session->userdata();
        $this->load->library('form_validation');

        $this->load->model('user/Phone_model');
		$phoneModel = new Phone_model();
        $phone = $phoneModel->findById($param_1);
        if( !$phone ){
            return show_404();
        }
        $data['details'] = $phone;

        //POST
		if( $_SERVER["REQUEST_METHOD"]==="POST" ){

            $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]|max_length[50]');
			$this->form_validation->set_rules('contact', 'Contact', 'required|integer|greater_than[0]|less_than[999999999999]');

			//exit(json_encode(form_error('email')));
			if( !$this->form_validation->run() ){
				return $this->load->view('user/phone/index_edit',$data);
			}
			
			//success
			$update = [];
			$update['name'] = $this->input->post('name');
			$update['value'] = $this->input->post('contact');

            $this->load->model('user/Phone_model');
			$phoneModel = new Phone_model();
			$result = $phoneModel->updateById($phone['id'],$update);
			$phoneModel->close_conn();
			if( $result ){
				$this->session->set_flashdata('message','<div class="col-12 mb-4 alert alert-success">Phone Edit Successfully!</div>');
				redirect(base_url().'user/phone/edit/'.$param_1);
			}
			else{
				$this->session->set_flashdata('message','<div class="col-12 mb-4 alert alert-danger">Phone Edit Failed.</div>');
				redirect(base_url().'user/phone/edit/'.$param_1);
			}

        }

        //GET
		return $this->load->view('user/phone/index_edit',$data);
	}

    //api
    public function delete()
	{
        if( !$_SERVER["REQUEST_METHOD"]==="POST" ){
            return show_404();
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('id', 'Id', 'required');
        if( !$this->form_validation->run() ){
            echo json_encode($this->response(0,'E001','Something Not Right',[]));
            return;
        }

        // echo json_encode($this->response(1,'S001','Success',[]));
        // return;

        $this->load->model('user/Phone_model');
		$phoneModel = new Phone_model();
        $phone = $phoneModel->findById($this->input->post('id'));
        if( !$phone ){
            echo json_encode($this->response(0,'E002','Record Not Found',[]));
            $phoneModel->close_conn();
            return;
        }

        //success
        $update = [];
        $update['is_deleted'] = 1;
        $result = $phoneModel->updateById($this->input->post('id'),$update);
        $phoneModel->close_conn();
        if( !$result ){
            echo json_encode($this->response(0,'E003','Failed',[]));
            return;
        }

        echo json_encode($this->response(1,'S001','Success',[]));
        return;

	}

}
