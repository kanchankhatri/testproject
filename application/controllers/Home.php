<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$data['sections'] = array($this->load->view('home','',true));
		$this->load->view('main',$data);
	}
}
