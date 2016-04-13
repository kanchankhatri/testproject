<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

class Info extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['user_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['user_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['user_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->load->model('user');
        $this->load->library('session');
    }

    public function users_get()
    {
        $check=array();
        $id = (int)$this->get('userid');
        if (isset($id) && $id > 0){         
            $check['where']['userid']=$id;
        } else if ($id!=''){
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); 
        }
        $users = $this->user->get($check);        
        if (!empty($users)) {
            // Set the response and exit
            $this->response($users, REST_Controller::HTTP_OK); 
        } else {
            // Set the response and exit
            $this->response([
                'status' => FALSE,
                'message' => 'No users were found'
                ], REST_Controller::HTTP_NOT_FOUND); 
        }
    }

    public function users_post()
    {
        // if(!isset($_SESSION['userid'])){
        //     $this->response([
        //         'status' => FALSE,
        //         'message' => 'User not logged in'
        //         ], REST_Controller::HTTP_PROXY_AUTHENTICATION_REQUIRED);    
        // } else {
        $required_keys = array('userid','full_name','email');        
        foreach ($required_keys as $key) {
            if(empty($_POST[$key])){
                $this->response([
                    'status' => FALSE,
                    'message' => 'Missing Params'
                    ], 400);    
            }            
        }

            // }
        $data['profile'] = $this->user->get(array('where'=>array('userid'=>$_POST['userid'])));
        if(!empty($_POST)) {
            try {
                $params['update'] = array_map('trim',$_POST);
                $params['where']['userid'] = $_POST['userid'];
                
                if($this->user->update($params)) {
                    $data['profile'] = $this->user->get(array('where'=>array('userid'=>$_POST['userid'])));
                    $this->response([
                        'status' => true,
                        'message' => 'Info Updated',
                        'info' => json_encode($data['profile'])
                        ], REST_Controller::HTTP_OK);               
                } else { 
                    $this->response([
                        'status' => false,
                        'message' => 'Error in updating',                        
                        ], REST_Controller::HTTP_BAD_REQUEST);               
                }               
            } catch(Exception $e){
                $result['status']=false;
                $result['message']=$e->getMessage();
                $this->response(json_encode($result), REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code                
            }       
        }
    }    
    function login_post(){
        if(isset($_SESSION['userid'])){
            $this->response([
                    'status' => FALSE,
                    'message' => 'User already logged in',
                    'userid' => $_SESSION['userid']
                    ], 400);
        }
        $required_keys = array('email','password');        
        foreach ($required_keys as $key) {
            if(empty($_POST[$key])){
                $this->response([
                    'status' => FALSE,
                    'message' => 'Missing Params'
                    ], 400);    
            }
        }
        $user_validate = $this->user->get(array('where'=>array('email'=>$_POST['email'],
            'password'=>md5($_POST['password']))));
        if(!empty($_POST)) {
            try {
                $this->load->helper('session');
                if($user_validate){
                    session_login($user_validate[0]);
                    $this->response([
                        'status' => true,
                        'message' => 'User Logged In',
                        'userid' => $user_validate[0]->userid
                        ], REST_Controller::HTTP_OK);
                } else {
                    $this->response([
                        'status' => false,
                        'message' => 'Email Or Password Incorrect',                        
                        ], REST_Controller::HTTP_BAD_REQUEST);               
                }                
            } catch(Exception $e){
                $result['status']=false;
                $result['message']=$e->getMessage();
                $this->response(json_encode($result), REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code                
            }
        }
    }
    function logout_get() {
        $required_keys = array('userid');
        foreach ($required_keys as $key) {
            if(empty($_GET[$key])){
                $this->response([
                    'status' => FALSE,
                    'message' => 'Missing userid'
                    ], 400);    
            }
        }
        if($_SESSION['userid']==$_GET['userid']){
            $this->session->sess_destroy();
            $this->response([
                'status' => true,
                'message' => 'User Logout'
                ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Current Session is for different user'
                ], 400);
        }        
        
    }
    function auth_status_get() {
        $required_keys = array('userid');
        foreach ($required_keys as $key) {
            if(empty($_GET[$key])){
                $this->response([
                    'status' => FALSE,
                    'message' => 'Missing userid'
                    ], 400);    
            }
        }
        if($_SESSION['userid']==$_GET['userid']){            
            $this->response([
                'status' => true,
                'message' => 'User is Logged In'
                ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                    'status' => true,
                'message' => 'User is not Logged In'
                ], REST_Controller::HTTP_OK);
        }                
    }
}
