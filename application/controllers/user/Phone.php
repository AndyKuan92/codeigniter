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
            $this->form_validation->set_rules('imagex', 'Image', 'required');

			//exit(json_encode(form_error('email')));
			if( !$this->form_validation->run() ){
				return $this->load->view('user/phone/index_add',$data);
			}

            if( !isset($_FILES['image']['name']) || empty($_FILES['image']['name']) ){
                $this->form_validation->set_rules('imagex', 'Image', 'custom_error');
                $this->form_validation->set_message('custom_error', 'Image file is required.');
                $this->form_validation->run();
                return $this->load->view('user/phone/index_add',$data);
            }
            
            $time = time();
            $file_path = 'assets/uploads/';
            $file_name = 'phone_image_uid_'.$this->user_id.'_'.$time;
            $file_extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
            $config['upload_path']          = './'.$file_path;
            $config['file_name']            = $file_name;
            $config['allowed_types']        = 'jpeg|jpg|png';
            $config['max_size']             = 1000;
            $config['max_width']            = 1024;
            $config['max_height']           = 1024;
            $this->load->library('upload', $config);

            if( !$this->upload->do_upload('image') ){
                $this->form_validation->set_rules('imagex', 'Image', 'custom_error');
                $this->form_validation->set_message('custom_error', $this->upload->display_errors());
                $this->form_validation->run();
                return $this->load->view('user/phone/index_add',$data);
            }

            //success
			$insert = [];
			$insert['user_id'] = $this->session->userdata('id');
			$insert['name'] = $this->input->post('name');
			$insert['value'] = $this->input->post('contact');
            $insert['image_url'] = $file_path.$file_name.'.'.$file_extension;
			$insert['created_at'] = $time;

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
            $this->form_validation->set_rules('imagex', 'Image', 'required');

			//exit(json_encode(form_error('email')));
			if( !$this->form_validation->run() ){
				return $this->load->view('user/phone/index_edit',$data);
			}

            $is_change_image = ( isset($_FILES['image']['name']) && !empty($_FILES['image']['name']) )? 1 : 0;

            if( $is_change_image ){
                $time = time();
                $file_path = 'assets/uploads/';
                $file_name = 'phone_image_uid_'.$this->user_id.'_'.$time;
                $file_extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
                $config['upload_path']          = './'.$file_path;
                $config['file_name']            = $file_name;
                $config['allowed_types']        = 'jpeg|jpg|png';
                $config['max_size']             = 1000;
                $config['max_width']            = 1024;
                $config['max_height']           = 1024;
                $this->load->library('upload', $config);
    
                if( !$this->upload->do_upload('image') ){
                    $this->form_validation->set_rules('imagex', 'Image', 'custom_error');
                    $this->form_validation->set_message('custom_error', $this->upload->display_errors());
                    $this->form_validation->run();
                    return $this->load->view('user/phone/index_edit',$data);
                }
            }
			
			//success
			$update = [];
			$update['name'] = $this->input->post('name');
			$update['value'] = $this->input->post('contact');
            if( $is_change_image ){
                $update['image_url'] = $file_path.$file_name.'.'.$file_extension;
            }

            $this->load->model('user/Phone_model');
			$phoneModel = new Phone_model();
			$result = $phoneModel->updateById($phone['id'],$update);
			$phoneModel->close_conn();
			if( $result ){
                if( $is_change_image ){
                    unlink('./'.$phone['image_url']);
                }
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

    //api
    public function checkFileUpload()
    {
        if( !$_SERVER["REQUEST_METHOD"]==="POST" ){
            return show_404();
        }

        if ( !isset($_FILES['fileUpload']) || empty($_FILES['fileUpload']) ) {
            echo json_encode($this->response(0,'E001','Please upload a photo(jpeg, jpg or png).',[]));
            return;
        }

        $file = explode('.', $_FILES['fileUpload']['name']);
        $extension = end($file);
        if ( !in_array($extension,['jpeg','jpg','png']) ) {
            echo json_encode($this->response(0,'E001','Please upload a photo(jpeg, jpg or png).',[]));
            return;
        }

        echo json_encode($this->response(1,'S001','Success',[]));
        return;

    }

}
