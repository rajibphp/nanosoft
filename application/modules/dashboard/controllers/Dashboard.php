<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends MX_Controller {
   
    public $login_id; 
    public $loginRole;
    function __construct() {
        parent::__construct();
        $this->login_id = $this->session->userdata('login_id'); 
        $this->loginRole = $this->session->userdata('login_role'); 
        if(empty($this->login_id)){ redirect("login"); }
        $this->load->model('dashboardModel');
    }
    function index(){                  
        $data['title'] = 'Dashboard | Student Info';
        $this->common_model->loadView('frontPage', $data);
    }

    function getBar(){
        $statics = array();
        for($i=2010; $i<= date('Y'); $i++){ 
            $male = $this->common_model->get_row('MAX(age)as age', 'students', array('year'=>$i, 'gender'=>'Male'));
            $female = $this->common_model->get_row('MAX(age)as age', 'students', array('year'=>$i,  'gender'=>'Female')); 

            $age = $this->common_model->get_row('age', 'students', array('year'=>$i));  
            array_push($statics, array('y'=>$i, 'a'=>$male['age'], 'b'=>$female['age']));             
        }
 
        echo json_encode($statics);  
    }

    function getStudents(){
        $result = $this->common_model->get_result('*', 'students', 'id DESC', '', '');  
        echo json_encode($result);  
    }

    function insertStudent(){
        $fields = array(
            'name'=>$this->input->post('name'),
            'gender'=>$this->input->post('gender'),
            'age'=>$this->input->post('age'),
            'year'=>$this->input->post('year'),
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s')
        );

        $result = $this->common_model->insert('students', $fields); 
         
        $msg['success'] = false;
        $msg['type'] = 'add';
        if($result){
            $msg['success'] = true;    
        } 
        echo json_encode($msg);
    }

    function editStudent(){
        $result = $this->common_model->get_row('*', 'students', array('id'=>$this->input->get('id')));  
        echo json_encode($result);  
    }

    function updateStudent(){
        $fields = array(
            'name'=>$this->input->post('name'),
            'gender'=>$this->input->post('gender'),
            'age'=>$this->input->post('age'),
            'year'=>$this->input->post('year'),
        );
        $result = $this->common_model->update('students', array('id'=>$this->input->post('id')), $fields); 
         
        $msg['success'] = false;
        $msg['type'] = 'update';
        if($result){
            $msg['success'] = true;    
        } 
        echo json_encode($msg);
    }

    function deleteStudent(){
        $result = $this->common_model->delete('students', array('id'=>$this->input->get('id'))); 

        $msg['success'] = false;
        if($result){
            $msg['success'] = true;    
        } 
        echo json_encode($msg);
    }
}