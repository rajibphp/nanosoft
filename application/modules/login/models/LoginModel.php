<?php
class LoginModel extends CI_Model{	    
    function loginCheck($select, $table, $where){
        $this->db->select($select);
        $this->db->from($table);
        $this->db->where($where);
        return $this->db->get()->row_array(); 
    }

}