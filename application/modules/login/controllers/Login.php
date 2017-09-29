<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MX_Controller {   
    public $login_id='';
    function __construct(){
        parent::__construct();
        $this->login_id = $this->session->userdata('login_id'); 
    }
    function index(){       
        $data['title'] = "Login";
        $this->load->view('login', $data);
    }    
    function loginCheck() { 
        $user_name = $this->input->post('name');
        $password = md5($this->input->post('password'));
        if($user_name == "global"){
            $result = $this->common_model->get_row('*', 'login_global', array('password'=>$this->input->post('password'), 'status <'=>2));
            $redirect = "client/add";
        }else{
            $result = $this->common_model->get_row('*', 'login', array('username'=>$user_name, 'password'=>$password, 'status'=>1));
            $redirect = "dashboard";
        }
        
        if($result) { 
            $data['login_id'] = $result['id'];
            $data['login_login'] = $result['login'];
            $data['login_username'] = $result['username'];
            $data['login_status'] = $result['status'];
            $data['login_role'] = $result['role'];
            
            $loginRole = $this->common_model->get_row('*', 'login_role', array('id'=>$result['role']));
            $data['viewAcl'] = $loginRole['viewAcl'];
            $data['addAcl'] = $loginRole['addAcl'];
            $data['editAcl'] = $loginRole['editAcl'];
            $data['deleteAcl'] = $loginRole['deleteAcl'];
            $data['changeStatus'] = $loginRole['changeStatus'];
            $data['download'] = $loginRole['download'];
            $data['approveReject'] = $loginRole['approveReject'];
            $data['allAcl'] = $loginRole['allAcl'];
            
            $this->session->set_userdata($data); 
            redirect($redirect);
            
        }else {
            $this->session->set_flashdata(array('failed'=>'Invalid Username or Password!'));
            redirect("login");
        }
    }
    function userLogout(){
        $this->session->unset_userdata('login_id');
        $this->session->unset_userdata('login_login');
        $this->session->unset_userdata('login_username');
        $this->session->unset_userdata('login_status');
        $this->session->unset_userdata('login_role');
        
        $this->session->unset_userdata('viewAcl');
        $this->session->unset_userdata('addAcl');
        $this->session->unset_userdata('editAcl');
        $this->session->unset_userdata('deleteAcl');
        $this->session->unset_userdata('changeStatus');
        $this->session->unset_userdata('download');
        $this->session->unset_userdata('approveReject');
        $this->session->unset_userdata('allAcl');

        $this->session->set_flashdata(array('success'=>'You have successfully loggedout'));
        redirect("login");
    }
   
}