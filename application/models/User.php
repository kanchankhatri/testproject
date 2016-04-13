<?php
class User extends CI_Model {

	function __construct()
	{
        // Call the Model constructor
		parent::__construct();
		$this->load->database();

		// $this->db = $this->load->database('group_one', TRUE);

	}

	function validate_user_credentials($params)
	{
		if(empty($params['email'])||empty($params['password'])){
			return false;
		}
		$this->db->select('userid,email,password,status');
		$this->db->from('user');
		$check['email']=$params['email'];
		$check['password']=(md5($params['password']));
		$this->db->where($check);
		$query = $this->db->get();
		$result = $query->result();
		if(empty($result))
			return false;
		else
			return $result;
	}
	function get($params)
	{
		$this->db->select('userid,email,full_name,status');
		$this->db->from('user');		
		if(!empty($params['where'])){
			$this->db->where($params['where']);
		}
		$query = $this->db->get();
		$result = $query->result();				
		if(empty($result))
			return false;
		else
			return $result;
	}
	function user_statuses(){
		$this->db->select('DISTINCT (status)');
		$this->db->from('user');
		$query = $this->db->get();
		$result = $query->result();				
		if(empty($result))
			return false;
		else
			return $result;
	}
	function update($params){
		// print_r($params);echo $this->db->escape($params['update']['email']);
		if(empty($params['where']))
			return false;
		$this->db->where($params['where']);
		$this->db->update('user',$params['update']);
		// echo $this->db->last_query();exit;
		return true;
	}
}