<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
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

    public function users_delete()
    {
        $id = (int) $this->get('id');

        // Validate the id.
        if ($id <= 0)
        {
            // Set the response and exit
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        // $this->some_model->delete_something($id);
        $message = [
        'id' => $id,
        'message' => 'Deleted the resource'
        ];

        $this->set_response($message, REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204) being the HTTP response code
    }

}
