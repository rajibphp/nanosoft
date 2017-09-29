<?php
class Common_model extends CI_Model {

    function loginRole() { 
        $viewAcl = $this->session->userdata('viewAcl');
        $addAcl = $this->session->userdata('addAcl');
        $editAcl = $this->session->userdata('editAcl');
        $deleteAcl = $this->session->userdata('deleteAcl');
        $changeStatus = $this->session->userdata('changeStatus');
        $download = $this->session->userdata('download');
        $approveReject = $this->session->userdata('approveReject');
        $allAcl = $this->session->userdata('allAcl');
        
        $data = array('viewAcl'=>$viewAcl, 'addAcl'=>$addAcl, 'editAcl'=>$editAcl, 'deleteAcl'=>$deleteAcl, 
                'changeStatus'=>$changeStatus, 'download'=>$download, 'approveReject'=>$approveReject, 'allAcl'=>$allAcl);
        array_push($data, $this->loginRoleMsg());
        return $data;
    }
    function loginRoleMsg() { 
        $viewAcl = '<h3 style="color: red;" align="center">Access denied!</h3>';
        $addAcl = '<b style="color: red;">Permission denied to ADD</b>';
        $editAcl = '<b style="color: red;">Permission denied to EDIT/UPDATE</b>';
        $deleteAcl = '<h3 style="color: red;">Permission denied to DELETE</h3>';
        $changeStatus = '<h3 style="color: red;">Permission denied to CHANGE STATUS</h3>';
        $download = '<h3 style="color: red;">Permission denied to DOWNLOAD</h3>';
        $approveReject = '<h3 style="color: red;">Permission denied to APPROVE/REJECT</h3>';
        $common = '<h3 style="color: red;">Access Not Allowed</h3>';
        return array('viewAcl'=>$viewAcl, 'addAcl'=>$addAcl, 'editAcl'=>$editAcl, 'deleteAcl'=>$deleteAcl,
            'changeStatus'=>$changeStatus, 'download'=>$download, 'approveReject'=>$approveReject, 'common'=>$common);
    }
    function loadView($view, $data, $global=null) { 
        if($this->session->userdata('login_role') == 6){
            if(empty($global)){
                echo '<h3 align="center" style="color: red;">Access Denied!</h3>'; exit();
            }
        }
        $data['loginRole'] = $this->loginRole();
        $data['main_content'] = $this->load->view($view, $data, TRUE);
        // if($data['loginRole']['viewAcl'] != 1){
        //     $data['main_content'] = $data['loginRole'][0]['viewAcl'];
        // }  
        $this->load->view('main_content', $data);
    }
    
    function duplicate_check($select, $table, $where, $where_id=null) {
        $this->db->select($select);
        $this->db->from($table);
        $this->db->where($where);
        if($where_id){ $this->db->where($where_id); }
        return $this->db->get()->row_array(); 
    }
    
    function insert($table, $data) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
    
    
    function update($table, $where, $data) {
        $this->db->where($where);
        $this->db->update($table, $data);
        return true;
    }
    

    function delete($table, $where) {
        $this->db->where($where);
        $this->db->delete($table); 
        return true;
    }

    function get_row($select, $table, $where = null){
        $this->db->select($select);
        $this->db->from($table);
        if($where){ $this->db->where($where); }        
        return $this->db->get()->row_array(); 
    }
  
 
    function isNumeric($value, $msg=null, $redirect=null){
        if(is_numeric($value)){
            return true;
        }else{
            if($redirect){
                $this->session->set_flashdata('failed', $msg);
                redirect($redirect);
            }else{
                return false;
            }
            
        }        
    }
    function redirect($session, $redirect){
        $this->session->set_flashdata($session);
        redirect($redirect);
    }
    
    function dateFormat($date, $format){
        $created = date_create($date);
        return date_format($created, $format);
    }
    function dateFormatFixed($date){
        $created = date_create($date);
        return date_format($created, "M d, Y");
    }
    function months($date){
        $month = time();
        for ($i = 1; $i <= 12; $i++) {
          $month = strtotime('next month', $month);
          $months[] = date("Y-m", $month);
        }
        echo "<pre>";print_r($months);die;
    }
    
    function get_result($select, $table, $order_by=null, $where=null, $groupBy=null, $limit=null){
        $this->db->select($select);
        $this->db->from($table);        
        if($order_by){ $this->db->order_by($order_by); }
        if($where){ $this->db->where($where); }        
        if($groupBy){ $this->db->group_by($groupBy); }         
        if($limit){ $this->db->limit($limit); }         
        return $this->db->get()->result();
    }

    function sort_array_of_array(&$array, $subfield){
        $sortarray = array();
        foreach ($array as $key => $row){
            $sortarray[$key] = $row[$subfield];
        }
        array_multisort($sortarray, SORT_ASC, $array);
    }
}    