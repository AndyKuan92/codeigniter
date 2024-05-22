<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
        // if ( !file_exists(APPPATH.'views/user/login/index.html') ){
        //         show_404();
        // }

		$this->load->view('login/index');
	}
}
