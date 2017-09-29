<?php

class UserModel extends CI_Model{	   
    function getEmployees($where, $orWhere=null){ 
        $this->db->select('e.id, e.desig, ei.empName');
        $this->db->from('employees as e');
        $this->db->join('emp_info as ei', 'e.id = ei.empId');
        $this->db->order_by('ei.empName', 'ASC');
        $this->db->where($where);
        if($orWhere){
            $this->db->or_where($orWhere); 
        }
        return $this->db->get()->result_array(); 
         
    }
    function getUsers($where=null){ 
        $this->db->select('l.*, r.id as roleId, r.role, ei.empName');
        $this->db->from('login as l');
        $this->db->join('login_role as r', 'l.role = r.id');
        $this->db->join('employees as e', 'l.id = e.loginId', 'left');
        $this->db->join('emp_info as ei', 'e.id = ei.empId', 'left');
        $this->db->order_by('l.login', 'ASC');
        if($where){
            $this->db->where($where);
        }
        return $this->db->get()->result_array(); 
    }

}