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
        $result = $phoneModel->userUpdateById($this->input->post('id'),$update);
        $phoneModel->close_conn();
        if( !$result ){
            echo json_encode($this->response(0,'E003','Failed',[]));
            return;
        }

        echo json_encode($this->response(1,'S001','Success',[]));
        return;

	}

}
