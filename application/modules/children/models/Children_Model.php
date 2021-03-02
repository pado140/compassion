<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Children_Model extends MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    public function get_children_list(){
        $this->db->select('E.*, U.email, U.role_id');
        $this->db->from('enfants AS E');
        $this->db->join('users AS U', 'U.id = E.user_id', 'left');
        return $this->db->get()->result();
    }
    
    public function get_single_children($id){
        $this->db->select('E.*, U.email, U.role_id');
        $this->db->from('enfants AS E');
        $this->db->join('users AS U', 'U.id = E.user_id', 'left');
        $this->db->where('E.id', $id);
        return $this->db->get()->row();
        
    }
        
    public function get_invoice_list($student_id, $due = null){

    $this->db->select('I.*, IH.title AS head, S.name AS student_name, AY.session_year, C.name AS class_name');
    $this->db->from('invoices AS I');        
    $this->db->join('classes AS C', 'C.id = I.class_id', 'left');
    $this->db->join('students AS S', 'S.id = I.student_id', 'left');
    $this->db->join('income_heads AS IH', 'IH.id = I.income_head_id', 'left');
    $this->db->join('academic_years AS AY', 'AY.id = I.academic_year_id', 'left');        
    $this->db->where('I.invoice_type !=', 'income'); 
    $this->db->where('I.student_id', $student_id);        

    if($due){
        $this->db->where('I.paid_status !=', 'paid');  
    }        
    if($this->session->userdata('role_id') == CHILDREN){
        $this->db->where('I.student_id', $this->session->userdata('profile_id'));
    }        
    $this->db->order_by('I.id', 'DESC');  
    return $this->db->get()->result();  

   // echo $this->db->last_query();
}

    public function get_activity_list($student_id){
        
        $this->db->select('SA.*, ST.name AS student, ST.phone, C.name AS class_name, S.name as section, AY.session_year');
        $this->db->from('student_activities AS SA');
        $this->db->join('students AS ST', 'ST.id = SA.student_id', 'left');
        $this->db->join('classes AS C', 'C.id = SA.class_id', 'left');
        $this->db->join('sections AS S', 'S.id = SA.section_id', 'left');
        $this->db->join('academic_years AS AY', 'AY.id = SA.academic_year_id', 'left');
        $this->db->where('SA.student_id', $student_id);
        return $this->db->get()->result();
    } 
    
    
    function duplicate_check($email, $id = null) {

        if ($id) {
            $this->db->where_not_in('id', $id);
        }
        $this->db->where('email', $email);
        return $this->db->get('users')->num_rows();
    }
}
