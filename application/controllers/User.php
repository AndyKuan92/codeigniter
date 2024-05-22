<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function index()
	{
        // if ( !file_exists(APPPATH.'views/user/login/index.html') ){
        //         show_404();
        // }

		$this->load->view('user/login/index');
	}

    public function register()
	{
        // if ( !file_exists(APPPATH.'views/user/login/index.html') ){
        //         show_404();
        // }

		$this->load->view('user/register/index');
	}
}
