<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Auth_Model
 *
 * @author Nafeesa
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth_Model extends MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    public function get_single_children($user_id){
        var_dump($user_id);
        $this->db->select('E.*,  U.email, U.role_id');
        $this->db->from('Enfants AS E');
        $this->db->join('users AS U', 'U.id = E.user_id', 'left');
        $this->db->where('E.user_id', $user_id);
        return $this->db->get()->row();
   }
}
