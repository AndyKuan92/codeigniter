<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
                redirect(base_url().'user/login');
            }
        }
        else{
            redirect(base_url().'user/login');
        }
    }

    //web
	public function index()
	{

        $data['data'] = [];
        $data['user'] = $this->session->userdata();
		return $this->load->view('user/dashboard/index',$data);
	}

    //api
    public function logout()
	{
        $this->session->sess_destroy();
        echo json_encode($this->response(1,'','You Have Logged Out.',[]));
	}

}
