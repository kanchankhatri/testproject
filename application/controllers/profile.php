<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');						
		$this->load->helper('url');
		if(!isset($_SESSION['userid'])){
			header("Location: ".base_url('/home'));
		}
		$this->load->model('user');						
	}
	public function index()
	{   
		$data['save_error']='';	
		$data['statuses'] = $this->user->user_statuses();
		$data['profile'] = $this->user->get(array('where'=>array('userid'=>$_SESSION['userid'])));
		if(!empty($_POST)) {
			try{
				$params['update'] = array_map('trim',$_POST);
				$params['where']['userid'] = $_SESSION['userid'];
				if($this->user->update($params)){					
					$data['profile'] = $this->user->get(array('where'=>array('userid'=>$_SESSION['userid'])));
				} else {										
					$data['save_error']='Error in Updating';	
				}				
			} catch(Exception $e){
				$data['save_error']='Error in Updating - '.$e->getMessage();	
			}		
		}
		$data['sections'] = array($this->load->view('profile',$data,true));
		$this->load->view('main',$data);
	}
}