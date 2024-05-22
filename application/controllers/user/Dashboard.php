<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index()
	{

        $this->load->view('user/common/header');
		$this->load->view('user/dashboard/index');
        $this->load->view('user/common/footer');
	}

}
