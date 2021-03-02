<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* * *****************Bulk.php**********************************
 * @product name    : Global School Management System Pro
 * @type            : Class
 * @class name      : Bulk
 * @description     : Manage bulk students imformation of the school.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Bulk extends MY_Controller {

    public $data = array();

    function __construct() {
        parent::__construct();      
        
        $this->load->model('Student_Model', 'student', true);
        // check running session
        if(!$this->academic_year_id){
            error($this->lang->line('academic_year_setting'));
            redirect('setting');
        }        
    }

    
    /*****************Function add**********************************
    * @type            : Function
    * @function name   : add
    * @description     : Load "Add Bulk Student" user interface                 
    *                    and process to store "Bulk Student" into database 
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function add() {

        check_permission(ADD);

        if ($_POST) {            
            $status = $this->_get_posted_student_data();
            if ($status) {                   

                create_log('Has been added Bulk Student');
                success($this->lang->line('insert_success'));
                redirect('student/index/'.$this->input->post('class_id'));
            } else {
                error($this->lang->line('insert_failed'));
                redirect('student/bulk/add/');
            }            
        } 
        
        $this->data['academic_years'] = $this->student->get_list('academic_years', array('status' => 1), '', '', '', 'id', 'ASC');
        $this->data['classes'] = $this->student->get_list('classes', array('status' => 1), '', '', '', 'id', 'ASC');
        
        $this->layout->title($this->lang->line('add') . ' ' . $this->lang->line('student') . ' | ' . SMS);
        $this->layout->view('bulk', $this->data);
    }

   

    /*****************Function _get_posted_student_data**********************************
    * @type            : Function
    * @function name   : _get_posted_student_data
    * @description     : Prepare "Student" user input data to save into database                  
    *                       
    * @param           : null
    * @return          : $data array(); value 
    * ********************************************************** */
    private function _get_posted_student_data() {

        $this->_upload_file();

        $destination = 'assets/csv/bulk_uploaded_student.csv';
        if (($handle = fopen($destination, "r")) !== FALSE) {

            $count = 1;

            while (($arr = fgetcsv($handle)) !== false) {

                if ($count == 1) {  $count++;  continue;  }

                // need atleast some mandatory data
                // student name, email, admission date, dob, gender, roll_no
                // guardian name , email, phone
                if ($arr[0] != '' && $arr[2] != '' && $arr[3] != '' && $arr[4] != '' && $arr[5] != '' && $arr[6] != '' && $arr[34] != '' && $arr[35] != '' && $arr[36] != '') {

                    
                    $user = array();
                    $data = array();
                    $enroll = array();
                    $guardian_user = array();
                    $guardian = array();
                    
                    // need to check email unique for guardian
                    if ($this->student->duplicate_check($arr[36])) { continue; }
                    
                    // need to check email unique for student
                    if ($this->student->duplicate_check($arr[5])) { continue; }
                    
                    // now we have to create guardian user
                    $guardian_user['role_id']  = GUARDIAN;
                    $guardian_user['name']     =  isset($arr[34]) ? $arr[34] : '';
                    $guardian_user['phone']    =  isset($arr[35]) ? $arr[35] : '';
                    $guardian_user['email']    =  isset($arr[36]) ? $arr[36] : '';
                    $guardian_user['password'] =  rand();
                    
                    $guardian['user_id'] = $this->student->create_custom_user($guardian_user);   
                   
                    // now we have to create guardian
                    $guardian['name']    = isset($arr[34]) ? $arr[34] : '';
                    $guardian['phone']   = isset($arr[35]) ? $arr[35] : '';
                    $guardian['profession']   = isset($arr[37]) ? $arr[37] : '';
                    $guardian['religion']   = isset($arr[38]) ? $arr[38] : '';
                    $guardian['national_id'] = isset($arr[39]) ? $arr[39] : '';
                    $guardian['present_address']   = isset($arr[40]) ? $arr[40] : '';
                    $guardian['permanent_address']   = isset($arr[41]) ? $arr[41] : '';
                    $guardian['other_info']   = isset($arr[42]) ? $arr[42] : '';
                    $guardian['created_at'] = date('Y-m-d H:i:s');
                    $guardian['created_by'] = logged_in_user_id();
                    $guardian['modified_at'] = date('Y-m-d H:i:s');
                    $guardian['modified_by'] = logged_in_user_id();
                    $guardian['status'] = 1; 
                    
                    $data['guardian_id'] = $this->student->insert('guardians', $guardian);
                    
                    // now we have to create student user
                    $user['role_id'] = STUDENT;                    
                    $user['name'] = isset($arr[0]) ? $arr[0] : '';
                    $user['phone'] = isset($arr[9]) ? $arr[9] : '';    
                    $user['email'] = isset($arr[5]) ? $arr[5] : '';
                    $user['password'] = rand();   
                    
                    $data['user_id'] = $this->student->create_custom_user($user);                    

                    $data['name'] = isset($arr[0]) ? $arr[0] : '';
                    $data['admission_no'] = isset($arr[1]) ? $arr[1] : '';
                    $data['admission_date'] = isset($arr[2]) ? date('Y-m-d', strtotime($arr[2])) : date('Y-m-d');
                    $data['dob'] = isset($arr[3]) ? date('Y-m-d', strtotime($arr[3])) : date('Y-m-d');
                    $data['gender'] = isset($arr[4]) ? $arr[4] : '';
                    $data['registration_no'] = isset($arr[7]) ? $arr[7] : '';                    
                    $data['blood_group'] = isset($arr[8]) ? $arr[8] : '';
                    $data['religion'] = isset($arr[10]) ? $arr[10] : '';
                    $data['caste'] = isset($arr[11]) ? $arr[11] : '';
                    $data['national_id'] = isset($arr[12]) ? $arr[12] : '';
                    $data['second_language'] = isset($arr[13]) ? $arr[13] : '';
                    $data['present_address'] = isset($arr[14]) ? $arr[14] : '';
                    $data['permanent_address'] = isset($arr[15]) ? $arr[15] : '';
                    $data['previous_school'] = isset($arr[16]) ? $arr[16] : '';
                    $data['previous_class'] = isset($arr[17]) ? $arr[17] : '';
                    $data['other_info'] = isset($arr[18]) ? $arr[18] : '';
                    $data['health_condition'] = isset($arr[19]) ? $arr[19] : '';                    
                    $data['discount_id'] = isset($arr[20]) ? $arr[20] : '';
                    $data['type_id'] = isset($arr[21]) ? $arr[21] : '';
                    $data['group_id'] = isset($arr[22]) ? $arr[22] : '';
                    
                    $data['father_name'] = isset($arr[23]) ? $arr[23] : '';
                    $data['father_phone'] = isset($arr[24]) ? $arr[24] : '';
                    $data['father_education'] = isset($arr[25]) ? $arr[25] : '';
                    $data['father_profession'] = isset($arr[26]) ? $arr[26] : '';
                    $data['father_designation'] = isset($arr[27]) ? $arr[27] : '';
                    $data['mother_name'] = isset($arr[28]) ? $arr[28] : '';
                    $data['mother_phone'] = isset($arr[29]) ? $arr[29] : '';
                    $data['mother_education'] = isset($arr[30]) ? $arr[30] : '';
                    $data['mother_profession'] = isset($arr[31]) ? $arr[31] : '';
                    $data['mother_designation'] = isset($arr[32]) ? $arr[32] : '';
                    
                    $data['is_guardian'] = isset($arr[33]) ? $arr[33] : '';
                    $data['relation_with'] = isset($arr[43]) ? $arr[43] : '';
               
                    $data['age'] = $data['dob'] ? floor((time() - strtotime($data['dob'])) / 31556926) : 0;
                    $data['created_at'] = date('Y-m-d H:i:s');
                    $data['created_by'] = logged_in_user_id();
                    $data['modified_at'] = date('Y-m-d H:i:s');
                    $data['modified_by'] = logged_in_user_id();
                    $data['status'] = 1;
                    
                    // now need to create student
                    $enroll['student_id'] = $this->student->insert('students', $data);
                    $enroll['roll_no'] = isset($arr[6]) ? $arr[6] : '';

                    // now need to create enroll
                    $this->_insert_enrollment($enroll);
                }
            }
        }

        return TRUE;
    }
    
    
     /*****************Function _upload_file**********************************
    * @type            : Function
    * @function name   : _upload_file
    * @description     : upload bulk studebt csv file                  
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    private function _upload_file() {

        $file = $_FILES['bulk_student']['name'];

        if ($file != "") {

            $destination = 'assets/csv/bulk_uploaded_student.csv';          
            $ext = strtolower(end(explode('.', $file)));
            if ($ext == 'csv') {                 
                move_uploaded_file($_FILES['bulk_student']['tmp_name'], $destination);  
            }else{
                error($this->lang->line('invalid_format'));
                redirect('student/bulk/add/');
            }
        } else {
            error($this->lang->line('insert_failed'));
            redirect('student/bulk/add/');
        }       
    }
   
    
    /*****************Function _create_user**********************************
    * @type            : Function
    * @function name   : _create_user
    * @description     : save user info to users while create a new student                  
    * @param           : $insert_id integer value
    * @return          : null 
    * ********************************************************** */
    private function _create_user($user){
        
        $data = array();
        $data['role_id']    = STUDENT;
        $data['password']   = md5($user['password']);
        $data['temp_password'] = base64_encode($user['password']);
        $data['email']      = $user['email'];
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['created_by'] = logged_in_user_id();
        $data['modified_at'] = date('Y-m-d H:i:s');
        $data['modified_by'] = logged_in_user_id();
        $data['status']     = 1; // by default would not be able to login
        $this->db->insert('users', $data);
        $user_id = $this->db->insert_id();
        
        // Process Sending email/ sms with login info
        $this->_send_email();        
        $this->_send_sms();       
        
        return $user_id;
    }
    
    
    public function _send_email() {

        if($this->input->post('email')){         
     
            $this->load->library('email');
            $config['protocol'] = 'sendmail';
            $config['mailpath'] = '/usr/sbin/sendmail';
            $config['charset'] = 'iso-8859-1';
            $config['wordwrap'] = TRUE;
            $config['mailtype'] = 'html';
            $this->email->initialize($config);

            $to         = $this->input->post('email');
            $password   = $this->input->post('password');

            $setting = $this->db->get_where('settings', array('status'=>1))->row();
            $from_email = $setting->email ? $setting->email : 'info@'.$_SERVER['HTTP_HOST'];
            $from_name  = $setting->school_name;
           
            
            $this->email->from($from_email, $from_name);
            $this->email->to($to);
            $this->email->subject('Your login credentials on ' .$from_name);       

            $message = 'Hi '. $this->input->post('name');
            $message .= '<br/><br/>';
            $message .= 'Following is your ' . $from_name . ' login credentials.<br/>';
            $message .= '<br/><br/>';
            $message .= 'Your Email : ' . $to;
            $message .= '<br/>';
            $message .= 'Your Password : ' . $password;
            $message .= '<br/>';
            $message .= 'Login url : <a href="'.site_url('login').'"> Login Here </a>';      
            $message .= '<br/><br/>';

            $message .= 'If you are not right person, Plesae ignore this email.<br/><br/>';
            $message .= 'Thank you<br/>';
            $message .= $from_name;

            $this->email->message($message);
            $this->email->send();        
        }
    }
    
    
    
    /*****************Function _insert_enrollment**********************************
    * @type            : Function
    * @function name   : _insert_enrollment
    * @description     : save student info to enrollment while create a new student                  
    * @param           : $insert_id integer value
    * @return          : null 
    * ********************************************************** */
    private function _insert_enrollment($enroll) {
        
        $data = array();
        $data['student_id'] = $enroll['student_id'];
        $data['class_id']   = $this->input->post('class_id');
        $data['section_id'] = $this->input->post('section_id');        
        $data['academic_year_id'] = $this->input->post('academic_year_id');        
        $data['roll_no'] = $enroll['roll_no'];
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['created_by'] = logged_in_user_id();
        $data['modified_at'] = date('Y-m-d H:i:s');
        $data['modified_by'] = logged_in_user_id();
        $data['status'] = 1;
        $this->db->insert('enrollments', $data);
    }
}