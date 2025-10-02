<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 

class User_model extends CI_Model {
    private $table = 'users'; 

    
    public function get_by_username($username) {
        
        return $this->db->get_where($this->table, ['username' => $username])->row(); 
        
    }
}
