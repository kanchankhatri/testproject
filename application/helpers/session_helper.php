<?php 
function session_login($data){
	$CI = get_instance();
	$CI->load->library('session');
	$user['userid']=$data->userid;
	$user['email']=$data->email;
	$CI->session->set_userdata($user);
}
?>