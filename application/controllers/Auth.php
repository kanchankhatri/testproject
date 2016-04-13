<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');						
		$this->load->helper('url');
		if(isset($_SESSION['userid']) && stripos($_SERVER['REQUEST_URI'], '/auth/logout')===false) {
			if(isset($_SERVER['HTTP_REFERER'])) {
				$redirect_url = $_SERVER['HTTP_REFERER'];
			} else {
				$redirect_url = base_url('/');
			}
			header("Location: $redirect_url");
		}
	}
	public function login()
	{
		if(empty($_POST)) {
			$data['sections'] = array($this->load->view('login','',true));
			$this->load->view('main',$data);
		} else {
			$this->load->model('user');
			$validate = $this->user->validate_user_credentials($_POST);
			if($validate){
				if($validate[0]->status=='active'){
					//set session								
					$this->session_login($validate[0]);
					header('Location: '.base_url('/profile'));
				}
			}
			$data['login_error']='Invalid Email / Password';
			$data['sections'] = array($this->load->view('login',$data,true));
			$this->load->view('main',$data);
		}
	}
	function session_login($data){
		$user['userid']=$data->userid;
		$user['email']=$data->email;	
		$this->session->set_userdata($user);		
	}
	public function logout()
	{   		
		$this->load->library('session');					
		$this->session->sess_destroy();		
		if(!empty($_SERVER['HTTP_REFERER']))
			header('Location: '.$_SERVER['HTTP_REFERER']);
		header('Location: '.base_url('/'));exit;
	}	
}