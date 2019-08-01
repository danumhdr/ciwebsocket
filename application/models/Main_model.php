<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_model extends CI_Model {
	
	function getUserDetails($postData){
 
	    $response = array();
	 
	    if($postData['username'] ){
	 
	      // Select record
	      $this->db->select('*');
	      $this->db->where('username', $postData['username']);
	      $q = $this->db->get('users');
	      $response = $q->result_array();
	 
	    }
	 
	    return $response;
	  }

}

/* End of file main_model.php */
/* Location: ./application/models/main_model.php */