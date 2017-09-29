<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends MX_Controller {
    
    public $login_id;    
    function __construct() {
        parent::__construct();
        $this->login_id = $this->session->userdata('login_id'); 
        if(empty($this->login_id)){ redirect("login"); } 
        $this->load->model('userModel');
    }
    
    function index() { 
        $where = array();
        if($this->session->userdata('login_role')>1){ 
            $where = array('l.role >'=>1);  
        }
        $data['users'] = $this->userModel->getUsers($where);                   
        $data['status'] = array('Inactive', 'Active');
        $data['title'] = "User";
        $this->common_model->loadView('view', $data);
    }       
    function add() {
        $data['roles'] = $this->common_model->get_result('id, role', 'login_role', 'role ASC', array('id !='=>1));
        $data['employees'] = $this->userModel->getEmployees(array('e.loginId'=>0));
        $result = $this->common_model->get_result('*', 'menu', 'position ASC', array('parent_id'=>0));
        $result2 = $this->common_model->get_result('*', 'menu', 'position ASC', array('parent_id !='=>0));
        foreach($result2 as $k2=>$val2){
            $row2 = $this->common_model->get_row('*', 'menu', array('id'=>$val2['id']));
            array_push($result, $row2);
        }

        foreach($result as $k=>$val){
            $row3 = $this->common_model->get_result('*', 'menu_bar', '', array('menuId'=>$val['id']));
            array_push($result[$k], $row3);
        }

        $data['menuList'] = $result;
        $data['title'] = "Add User";
        $this->common_model->loadView('add', $data);
    }
    function chkDupUsername() {
        $q= ltrim($_POST['action'], " ");
        $result = $this->common_model->get_row('id', 'login', array('username'=>$q));
        if($result){
            echo 1;
        }else{
            echo 0;
        }
    }
    function groupArray(){ 
        $parentMenuId = $this->input->post('parentMenuId'); 
        $mainMenuId = array_filter($this->input->post('mainMenuId')); 
        $menuId = array_filter($this->input->post('menuId')); 
        $viewAcl = $this->input->post('viewAcl');       
        foreach($menuId as $k=>$val){ 
            $groupArray[] = array('menuId'=>$val, 'parentMenuId'=>$parentMenuId[$k], 'mainMenuId'=>$mainMenuId[$k], 'viewAcl'=>$viewAcl[$k]);
        }
        return $groupArray; 
    }    
    function insert() { 
        $menuId = array_filter($this->input->post('menuId'));
        if(empty($menuId)){
            $this->session->set_flashdata('failed', "Select at least one Menu from the ACL");
            if($this->input->post('editId')){
                redirect('user/edit/'.$this->input->post('editId'));
            }
            redirect('user/add');
        }
        $data['login'] = $this->input->post('name');          
        $data['username'] = $this->input->post('username');                  
        $data['role'] = $this->input->post('role');          
        $data['status'] = 1;
        if($this->input->post('type')==1){
            $data['empId'] = $this->input->post('empId');
        }else{
            $data['empId'] = 0;
        }
        
        if($this->input->post('editId')){ 
            if($this->input->post('changePass') == 1){
                $data['password'] = md5($this->input->post('password'));           
            }
            $data['status'] = $this->input->post('status');
            $loginId = $this->input->post('editId');
            $this->common_model->update('login', array('id'=>$loginId), $data); 
            $this->common_model->delete('menu_acl', array('loginId'=>$loginId));
            $msg = "Data has been updated";
            $redirect = 'user';
            
        }else{ 
            $data['password'] = md5($this->input->post('password'));
            $loginId = $this->common_model->insert('login', $data);
            $msg = "Data has been inserted";
            $redirect = 'user/add';
        }
        
        if($this->input->post('type')==1){
            $this->common_model->update('employees', array('id'=>$data['empId']), array('loginId'=>$loginId));
        }else{ 
            $this->common_model->update('employees', array('loginId'=>$loginId), array('loginId'=>0));
        }
            
        $groupArray = $this->groupArray(); 
        for($i=0; $i<count($groupArray); $i++){
            if($groupArray[$i]['menuId']>0){
                $acl['loginId'] = $loginId;
                $acl['parentMenuId'] = $groupArray[$i]['parentMenuId'];
                if($groupArray[$i]['parentMenuId']==0){
                    $acl['parentMenuId'] = $groupArray[$i]['mainMenuId'];
                }
                $acl['mainMenuId'] = $groupArray[$i]['mainMenuId'];
                $acl['menuId'] = $groupArray[$i]['menuId'];
                $acl['viewAcl'] = $groupArray[$i]['viewAcl'];
                $this->common_model->insert('menu_acl', $acl);
            }
            
        }
        
        $this->session->set_flashdata('success', $msg);
        redirect($redirect);
    }
    function edit($loginId) {        
        $data['roles'] = $this->common_model->get_result('id, role', 'login_role', 'role ASC', array('id !='=>1));
        $data['employees'] = $this->userModel->getEmployees(array('e.loginId'=>0), array('e.loginId'=>$loginId));
        $result = $this->common_model->get_result('*', 'menu', 'position ASC', array('parent_id'=>0));
        $result2 = $this->common_model->get_result('*', 'menu', 'position ASC', array('parent_id !='=>0));
        foreach($result2 as $k2=>$val2){
            $row2 = $this->common_model->get_row('*', 'menu', array('id'=>$val2['id']));
            array_push($result, $row2);
        }
        foreach($result as $k=>$val){
            $row3 = $this->common_model->get_result('*', 'menu_bar', '', array('menuId'=>$val['id']));
            array_push($result[$k], $row3);
        }        
        $data['menuList'] = $result;
        $data['login'] = $this->common_model->get_row('*', 'login', array('id'=>$loginId));
        $data['loginAcl'] = $this->common_model->get_result('*', 'menu_acl', '', array('loginId'=>$loginId));
        $data['status'] = array('Inactive', 'Active');

        $data['title'] = "Edit User";
        $this->common_model->loadView('edit', $data);
    }
    function chkDuplicateUpdate() {
        $q= ltrim($_POST['action'], " ");
        $id= ltrim($_POST['id'], " ");
        $result = $this->common_model->get_row('id', 'login', array('username'=>$q, 'id !='=>$id));
        if($result){
            echo 1;
        }else{
            echo 0;
        }
    }
    function delete($id) {
        $exists = $this->common_model->get_row('status', 'login', array('id'=>$id));
        if($exists['status'] == 1){
            $msg = "Can't be deleted! inactive the user first";
            $this->session->set_flashdata('failed', $msg);
            redirect('user');
        }
        $this->common_model->delete('login', array('id'=>$id));
        $this->common_model->delete('menu_acl', array('loginId'=>$id));
        $this->common_model->update('employees', array('loginId'=>$id), array('loginId'=>0));
        $this->session->set_flashdata('success', 'Data has been deleted');
        redirect('user');
    }       
    
    function addRole() { 
        $data['title'] = "Add User Role";
        $this->common_model->loadView('role/addRole', $data);
    }
    function chkDupRole() {
        $query = ltrim($_POST['action'], " ");
        $result = $this->common_model->get_row('id', 'login_role', array('role'=>$query));
        if($result){ echo 1; }else{ echo 0; }
    }
    function insertRole() { 
        $data['role'] = $this->input->post('name');
        $data['viewAcl'] = $this->input->post('viewAcl');
        $data['addAcl'] =  $this->input->post('addAcl');
        $data['editAcl'] = $this->input->post('editAcl');
        $data['deleteAcl'] = $this->input->post('deleteAcl');
        $data['changeStatus'] = $this->input->post('changeStatus');
        $data['download'] = $this->input->post('download');
        $data['approveReject'] = $this->input->post('approveReject');
        $data['allAcl'] = $this->input->post('allAcl'); 
       
        if($this->input->post('editId')){
            $this->common_model->update('login_role', array('id'=>$this->input->post('editId')), $data); 
            $msg = "Data has been updated";
            $redirect = 'user/viewRole';
            
        }else{
            $this->common_model->insert('login_role', $data);
            $msg = "Data has been inserted";
            $redirect = 'user/addRole';
        } 
        $this->session->set_flashdata('success', $msg);
        redirect($redirect);
    }
    function viewRole() {               
        $data['roles'] = $this->common_model->get_result('*', 'login_role', 'role ASC');              
        $data['title'] = "User Role";
        $this->common_model->loadView('role/viewRole', $data);
    }
    function editRole($id) { 
        $data['role'] = $this->common_model->get_row('*', 'login_role', array('id'=>$id));
        $data['title'] = "Edit Role";
        $this->common_model->loadView('role/editRole', $data);
    }
    function chkDupRoleEdit() {
        $query= ltrim($_POST['action'], " ");
        $id= ltrim($_POST['id'], " ");
        $result = $this->common_model->get_row('id', 'login_role', array('role'=>$query, 'id !='=>$id));
        if($result){
            echo 1;
        }else{
            echo 0;
        }
    }
    function deleteRole($id) {
        if($this->common_model->get_row('id', 'login', array('role'=>$id))){
            $this->session->set_flashdata('failed', "Can't be deleted! Already used in user");
            redirect('user/viewRole');
        }
        $this->common_model->delete('login_role', array('id'=>$id));
        $this->session->set_flashdata('success', 'Data has been deleted');
        redirect('user/viewRole');
    }
    
    function listGlobal(){
        $data['listGlobal'] = $this->common_model->get_result('id, password, status, used, clientId', 'login_global', 'id DESC');                  
        $data['title'] = "Global User List";
        $this->common_model->loadView('global/viewGlobal', $data);
    }
    function insertGlobal() {           
        $data['password'] = $this->input->post('password');                  
        $data['role'] = 6;                  
        $this->common_model->insert('login_global', $data);       
        $this->session->set_flashdata('success', "Global user has been ADDED");
        redirect("user/listGlobal");
    }
    function deleteGlobal($id) {
        $this->common_model->delete('login_global', array('id'=>$id));
        $this->session->set_flashdata('success', 'Global user has been deleted');
        redirect('user/listGlobal');
    }
    

}