<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ebook_Model extends MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
     public function get_ebook_list(){
        
        if($this->session->userdata('role_id') == CHILDREN){
           //$class_id = $this->session->userdata('class_id');
        }
         
        $this->db->select('B.*');
        $this->db->from('ebooks AS B');
        
        return $this->db->get()->result();
        
    }
    
    public function get_single_ebook($id){
        
        $this->db->select('B.*');
        $this->db->from('ebooks AS B');
        $this->db->where('B.id', $id);
        return $this->db->get()->row();
        
    } 
}
