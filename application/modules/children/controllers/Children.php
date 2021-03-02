<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* * *****************Children.php**********************************
 * @product name    : compassion
 * @type            : Class
 * @class name      : Children
 * @description     : Manage childre imformation of the program.      
 * ********************************************************** */

class Children extends MY_Controller {

    public $data = array();

    function __construct() {
        parent::__construct();      
        
        $this->load->model('Children_Model', 'child', true);
        
    }

    
    
    /*****************Function index**********************************
    * @type            : Function
    * @function name   : index
    * @description     : Load "Children List" user interface                 
    *                    with class wise listing    
    * @return          : null 
    * ********************************************************** */
    public function index() {

        check_permission(VIEW);
        $this->data['children'] = $this->child->get_children_list(); 
        
        $this->data['list'] = TRUE;
        $this->layout->title($this->lang->line('manage_children') . ' | ' . CH);
        $this->layout->view('children/index', $this->data);
    }

    
    /*****************Function add**********************************
    * @type            : Function
    * @function name   : add
    * @description     : Load "Add new Children" user interface                 
    *                    and process to store "Children" into database 
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function add() {

        check_permission(ADD);

        if ($_POST) {
            $this->_prepare_children_validation();
            if ($this->form_validation->run() === TRUE) {

                $data = $this->_get_posted_children_data();

                $insert_id = $this->child->insert('enfants', $data);

                if ($insert_id) {
                    create_log('Has been added a Children : '.$data['name']);
                    success($this->lang->line('insert_success'));
                    redirect('children/index');
                } else {
                    error($this->lang->line('insert_failed'));
                    redirect('children/add');
                }
            } else {

                $this->data['post'] = $_POST;
            }
        }
        
        $this->data['children'] = $this->child->get_children_list();
        
        $this->data['add'] = TRUE;
        $this->layout->title($this->lang->line('add') . ' ' . $this->lang->line('children') . ' | ' . CH);
        $this->layout->view('children/index', $this->data);
    }

        
    /*****************Function edit**********************************
    * @type            : Function
    * @function name   : edit
    * @description     : Load Update "Children" user interface                 
    *                    with populate "Children" value 
    *                    and process to update "Children" into database    
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function edit($id = null) {

        check_permission(EDIT);

        if(!is_numeric($id)){
            error($this->lang->line('unexpected_error'));
            redirect('children/index');     
        }
        
        if ($_POST) {
            $this->_prepare_children_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_children_data();
                $updated = $this->child->update('enfants', $data, array('id' => $this->input->post('id')));

                if ($updated) {
                    success($this->lang->line('update_success'));
                    redirect('children/index');
                } else {
                    error($this->lang->line('update_failed'));
                    redirect('children/edit');
                }
            } else {
                $this->data['child'] = $this->child->get_single_children($this->input->post('id'));
            }
        }

        if ($id) {
            $this->data['child'] = $this->child->get_single_children($id);

            if (!$this->data['child']) {
                redirect('children/index');
            }
        }
       $this->data['children'] = $this->child->get_children_list(); 
        
        
        $this->data['edit'] = TRUE;
        $this->layout->title($this->lang->line('edit') . ' ' . $this->lang->line('children') . ' | ' . CH);
        $this->layout->view('children/index', $this->data);
    }

        
    
    /*****************Function view**********************************
    * @type            : Function
    * @function name   : view
    * @description     : Load user interface with specific Children data                 
    *                       
    * @param           : $student_id integer value
    * @return          : null 
    * ********************************************************** */
    public function view($children_id = null) {

        check_permission(VIEW);

        if(!is_numeric($children_id)){
             error($this->lang->line('unexpected_error'));
              redirect('children/index');
        }
        
        $this->data['child'] = $this->child->get_single_children($children_id);       

        $this->data['children'] = $this->child->get_children_list();
        
        
        $this->data['detail'] = TRUE;
        $this->layout->title($this->lang->line('view') . ' ' . $this->lang->line('children') . ' | ' . CH);
        $this->layout->view('children/index', $this->data);
    }
    
    
    
     /*****************Function get_single_student**********************************
     * @type            : Function
     * @function name   : get_single_student
     * @description     : "Load single child information" from database                  
     *                    to the user interface   
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    public function get_single_children(){
        
        $this->load->helper('report');
        $children_id = $this->input->post('children_id');
        $adv = $this->input->post('adv');

        $this->data['child'] = $this->child->get_single_children($children_id);
        
        $this->data['days'] = 31;
        $this->data['children_id'] = $this->data['child']->id;
        //$this->data['activity'] = $this->child->get_activity_list($children_id);  
        
        echo $this->load->view('get-single-children', $this->data);
    }
    
        
    /*****************Function _prepare_student_validation**********************************
    * @type            : Function
    * @function name   : _prepare_student_validation
    * @description     : Process "Children" user input data validation                 
    *                       
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    private function _prepare_children_validation() {
        
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error-message" style="color: red;">', '</div>');

        if (!$this->input->post('id')) {
            $this->form_validation->set_rules('email', $this->lang->line('email'), 'trim|required|valid_email|callback_email');
            $this->form_validation->set_rules('password', $this->lang->line('password'), 'trim|required');  
        }

        $this->form_validation->set_rules('code', $this->lang->line('code'), 'trim');
        $this->form_validation->set_rules('nom', $this->lang->line('lastname'), 'trim|required');
        $this->form_validation->set_rules('prenom', $this->lang->line('firstname'), 'trim|required');
       
        
    }
                        
    /*****************Function email**********************************
    * @type            : Function
    * @function name   : email
    * @description     : Unique check for "Children Email" data/value                  
    *                       
    * @param           : null
    * @return          : boolean true/false 
    * ********************************************************** */ 
    public function email() {
        if ($this->input->post('id') == '') {
            $email = $this->child->duplicate_check($this->input->post('email'));
            if ($email) {
                $this->form_validation->set_message('email', $this->lang->line('already_exist'));
                return FALSE;
            } else {
                return TRUE;
            }
        } else if ($this->input->post('id') != '') {
            $email = $this->child->duplicate_check($this->input->post('email'), $this->input->post('id'));
            if ($email) {
                $this->form_validation->set_message('email', $this->lang->line('already_exist'));
                return FALSE;
            } else {
                return TRUE;
            }
        } else {
            return TRUE;
        }
    }
     
                
    /*****************Function photo**********************************
    * @type            : Function
    * @function name   : photo
    * @description     : validate child profile photo                 
    *                       
    * @param           : null
    * @return          : boolean true/false 
    * ********************************************************** */
    public function photo() {
        if ($_FILES['photo']['name']) {
            $name = $_FILES['photo']['name'];
            $arr = explode('.', $name);
            $ext = end($arr);
            if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'gif') {
                return TRUE;
            } else {
                $this->form_validation->set_message('photo', $this->lang->line('select_valid_file_format'));
                return FALSE;
            }
        }
    }

       
    /*****************Function _get_posted_student_data**********************************
    * @type            : Function
    * @function name   : _get_posted_student_data
    * @description     : Prepare "Children" user input data to save into database                  
    *                       
    * @param           : null
    * @return          : $data array(); value 
    * ********************************************************** */
    private function _get_posted_children_data() {

        $items = array();

        $items[] = 'nom';
        $items[] = 'prenom';    
        $items[] = 'code';

        $data = elements($items, $_POST);

        $data['datenaissance'] = date('Y-m-d', strtotime($this->input->post('dob')));
        $data['sexe'] = $this->input->post('gender');

        if ($this->input->post('id')) {
            
            $data['modified'] = date('Y-m-d H:i:s');
            $data['modifiedby'] = logged_in_user_id();
            
        } else {
            
            $data['created'] = date('Y-m-d H:i:s');
            $data['createdby'] = logged_in_user_id();
            $data['modified'] = date('Y-m-d H:i:s');
            $data['modifiedby'] = logged_in_user_id();
            $data['status'] = 1;
            $data['name'] = $data['nom'].' '.$data['prenom'];
            // create child user 
            $data['user_id'] = $this->child->create_user();
            unset($data['name']);
        }

        // child  photo
        if ($_FILES['photo']['name']) {
            $data['photo'] = $this->_upload_photo();
        }
        return $data;
    }

           
    /*****************Function _upload_photo**********************************
    * @type            : Function
    * @function name   : _upload_photo
    * @description     : process to upload child profile photo in the server                  
    *                     and return photo file name  
    * @param           : null
    * @return          : $return_photo string value 
    * ********************************************************** */
    private function _upload_photo() {

        $prev_photo = $this->input->post('prev_photo');
        $photo = $_FILES['photo']['name'];
        $photo_type = $_FILES['photo']['type'];
        $return_photo = '';
        if ($photo != "") {
            if ($photo_type == 'image/jpeg' || $photo_type == 'image/pjpeg' ||
                    $photo_type == 'image/jpg' || $photo_type == 'image/png' ||
                    $photo_type == 'image/x-png' || $photo_type == 'image/gif') {

                $destination = 'assets/uploads/child-photo/';

                $file_type = explode(".", $photo);
                $extension = strtolower($file_type[count($file_type) - 1]);
                $photo_path = 'photo-' . time() . '-sms.' . $extension;

                move_uploaded_file($_FILES['photo']['tmp_name'], $destination . $photo_path);

                // need to unlink previous photo
                if ($prev_photo != "") {
                    if (file_exists($destination . $prev_photo)) {
                        @unlink($destination . $prev_photo);
                    }
                }

                $return_photo = $photo_path;
            }
        } else {
            $return_photo = $prev_photo;
        }

        return $return_photo;
    }
    
 
    /*****************Function delete**********************************
    * @type            : Function
    * @function name   : delete
    * @description     : delete "Children" data from database                  
    *                     also delete all relational data
    *                     and unlink child photo from server   
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function delete($id = null) {

        check_permission(DELETE);
        
        if(!is_numeric($id)){
             error($this->lang->line('unexpected_error'));
              redirect('child/index');
        }
        
        $child = $this->child->get_single('enfants', array('id' => $id));
        if (!empty($child)) {

            // delete child data
            $this->child->delete('enfants', array('id' => $id));

            // delete child login data
            $this->child->delete('users', array('id' => $child->user_id));

            // delete child library_members
            $this->child->delete('library_members', array('user_id' => $child->user_id));
            
            // delete child activity_logs
            $this->child->delete('activity_logs', array('user_id' => $child->user_id));
            
            // delete child messages data
            // $this->child->delete('messages', array('created_by' => $child->user_id));
            
            // $this->child->delete('message_relationships', array('sender_id' => $child->user_id));
            // $this->child->delete('message_relationships', array('receiver_id' => $child->user_id));
            // $this->child->delete('message_relationships', array('owner_id' => $child->user_id));
            
            // $this->child->delete('replies', array('sender_id' => $child->user_id));
            // $this->child->delete('replies', array('receiver_id' => $child->user_id));
            

            // delete child  photo
            $destination = 'assets/uploads/';
            if (file_exists($destination . '/children-photo/' . $child->photo)) {
                @unlink($destination . '/children-photo/' . $child->photo);
            }
            if (file_exists($destination . '/transfer-certificate/' . $child->transfer_certificate)) {
                @unlink($destination . '/transfer-certificate/' . $child->transfer_certificate);
            }

            create_log('Has been deleted a Children : '.$child->name);
            
            success($this->lang->line('delete_success'));
            redirect('children/index/'.$enroll->class_id);
        } else {
            error($this->lang->line('delete_failed'));
        }
        
        redirect('children/index/');
    }

    /*****************Function advanced**********************************
    * @type            : Function
    * @function name   : advanced
    * @description     : Load "Add new advanced Children" user interface                 
    *                    and process to store "Children" into database 
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function advanced() {

        check_permission(ADD);

        if ($_POST) {
            $this->_prepare_student_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_student_data();

                $insert_id = $this->child->insert('students', $data);

                if ($insert_id) {
                    $this->__insert_enrollment($insert_id);
                    success($this->lang->line('insert_success'));
                    redirect('children/advanced/'.$this->input->post('class_id'));
                } else {
                    error($this->lang->line('insert_failed'));
                    redirect('children/advanced/'.$this->input->post('class_id'));
                }
            } else {

                $this->data['post'] = $_POST;
            }
        }
        
       
        
        $class_id = $this->uri->segment(3);
        if(!$class_id){
          $class_id = $this->input->post('class_id');
        }
        
        $session = $this->child->get_single('academic_years', array('id'=>$this->academic_year_id));   
        $this->data['class_id'] = $class_id;      
        $this->data['students'] = $this->child->get_student_list($class_id, $session->end_year);
        $this->data['academic_years'] = $this->child->get_list('academic_years', array('status' => 1), '', '', '', 'id', 'ASC');
        $this->data['roles'] = $this->child->get_list('roles', array('status' => 1), '', '', '', 'id', 'ASC');
        $this->data['guardians'] = $this->child->get_list('guardians', array('status' => 1), '', '', '', 'id', 'ASC');
        $this->data['classes'] = $this->child->get_list('classes', array('status' => 1), '', '', '', 'id', 'ASC');
        $this->data['discounts'] = $this->child->get_list('discounts', array('status'=> 1), '', '', '', 'id', 'ASC');  
        $this->data['types'] = $this->child->get_list('student_types', array('status'=> 1), '', '', '', 'id', 'ASC');  
        $this->data['groups'] = $this->child->get_list('student_groups', array('status'=> 1), '', '', '', 'id', 'ASC'); 
        
        $this->data['list'] = TRUE;
        $this->layout->title($this->lang->line('add') . ' ' . $this->lang->line('child') . ' | ' . SMS);
        $this->layout->view('children/advanced', $this->data);
    }
    
            
    /*****************Function editadvanced**********************************
    * @type            : Function
    * @function name   : editadvanced
    * @description     : Load Update "Children" user interface                 
    *                    with populate "Children" value 
    *                    and process to update "Children" into database    
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function editadvanced($id = null) {

        check_permission(EDIT);

        if(!is_numeric($id)){
            error($this->lang->line('unexpected_error'));
            redirect('children/advanced');     
        }
        
        if ($_POST) {
            $this->_prepare_student_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_student_data();
                $updated = $this->child->update('students', $data, array('id' => $this->input->post('id')));

                if ($updated) {
                    $this->__update_enrollment();
                    success($this->lang->line('update_success'));
                    redirect('children/advanced/'.$this->input->post('class_id'));
                } else {
                    error($this->lang->line('update_failed'));
                    redirect('children/editadvanced/' . $this->input->post('id'));
                }
            } else {
                $this->data['children'] = $this->child->get_single_student($this->input->post('id'), true);
            }
        }

        if ($id) {
            $this->data['children'] = $this->child->get_single_student($id, true);

            if (!$this->data['children']) {
                redirect('children/advanced');
            }
        }
        
        $class_id = $this->data['children']->class_id;
        if(!$class_id){
          $class_id = $this->input->post('class_id');
        } 

        $this->data['class_id'] = $class_id;
        $this->data['students'] = $this->child->get_student_list($class_id, true);
        $this->data['academic_years'] = $this->child->get_list('academic_years', array('status' => 1), '', '', '', 'id', 'ASC');
        $this->data['roles'] = $this->child->get_list('roles', array('status' => 1), '', '', '', 'id', 'ASC');
        $this->data['guardians'] = $this->child->get_list('guardians', array('status' => 1), '', '', '', 'id', 'ASC');
        $this->data['classes'] = $this->child->get_list('classes', array('status' => 1), '', '', '', 'id', 'ASC');
        $this->data['discounts'] = $this->child->get_list('discounts', array('status'=> 1), '', '', '', 'id', 'ASC');  
        $this->data['types'] = $this->child->get_list('student_types', array('status'=> 1), '', '', '', 'id', 'ASC');  
        $this->data['groups'] = $this->child->get_list('student_groups', array('status'=> 1), '', '', '', 'id', 'ASC'); 
        
        $this->data['edit'] = TRUE;
        $this->layout->title($this->lang->line('edit') . ' ' . $this->lang->line('children') . ' | ' . SMS);
        $this->layout->view('children/advanced', $this->data);
    }


}
