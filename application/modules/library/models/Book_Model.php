<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Book_Model extends MY_Model {

    function __construct() {
        parent::__construct();
    }

    public function get_book_issued_list() {

        $user_id = '';
        if($this->session->userdata('role_id') == CHILDREN){
            $user_id = $this->session->userdata('user_id');
        }
        $this->db->select('B.*, BI.id AS issue_id, BI.is_returned, BI.due_date, BI.return_date, BI.issue_date, S.nom, S.photo,S.prenom');
        $this->db->from('book_issues AS BI');
        $this->db->join('books AS B', 'B.id = BI.book_id', 'left');
        $this->db->join('library_members AS LM', 'LM.id = BI.library_member_id', 'left');
        $this->db->join('enfants AS S', 'S.user_id = LM.user_id', 'left');
        if($user_id){
            $this->db->where('S.user_id', $user_id);
        }
        $this->db->order_by('BI.is_returned', 'ASC');
        return $this->db->get()->result();
    }

    public function get_book_list() {
        $this->db->select('B.*, c.category');
        $this->db->from('books AS B');
        $this->db->join('category AS C', 'C.id = B.category_id', 'left');
        
        return $this->db->get()->result();
    }

    public function get_single_book($id_book) {
        $this->db->select('B.*, c.category');
        $this->db->from('books AS B');
        $this->db->join('category AS C', 'C.id = B.category_id', 'left');

        $this->db->where('B.id', $id_book);
        return $this->db->get()->row();;
    }


    public function get_library_member_list($is_library_member = 1) {

        $this->db->select('E.*, LM.id AS lm_id, LM.custom_member_id');
        $this->db->from('enfants AS E');
        $this->db->join('library_members AS LM', 'LM.user_id = E.user_id', 'left');
        $this->db->where('E.is_library_member', $is_library_member);
        $this->db->order_by('LM.id', 'DESC');
        return $this->db->get()->result();
    }
    
    public function update_qty($book_id, $type = null){
        
        if($type == 'issue'){
            $sql = "UPDATE books SET qty = qty - 1 WHERE id = $book_id";
        }else{
            $sql = "UPDATE books SET qty = qty + 1 WHERE id = $book_id";
        }
        
        $this->db->query($sql);
    }

}
