<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Menu extends MX_Controller {    
    public $loginId;    
    public $loginRole;    
    function __construct() {
        parent::__construct();
        $this->loginId = $this->session->userdata('login_id'); 
        $this->loginRole = $this->session->userdata('login_role'); 
        if (empty($this->loginId)) { redirect("login"); }     
    }

    function parentMenu(){ 
        return $this->common_model->get_result('*', 'parent_menu', 'position ASC');    
    }    
    function getMenu(){ 
        $result = $this->common_model->get_result('*', 'menu', 'position ASC', array('parent_id'=>0, 'show_menu'=>1));    
        if($this->loginRole > 1){ 
            $menuAcl = $this->common_model->get_result('*', 'menu_acl', '', array('loginId'=>$this->loginId), 'parentMenuId');
            $result = array();            
            foreach($menuAcl as $acl){
                $loginAcl = $this->common_model->get_row('*', 'menu', array('parent_id'=>0, 'id'=>$acl['parentMenuId'], 'show_menu'=>1));                            
                array_push($result, $loginAcl); 
            }
            $result = $this->orderingMenu($result, 'position');
        }       

        $result = array_filter($result);      
        foreach($result as $k=>$val){             
            $row1 = $this->common_model->get_result('*', 'menu_bar', 'title ASC', array('menuId'=>$val['id'], 'show_menu'=>1));
            if($this->loginRole >1){
                $row1 = array();
                $menuAcl2 = $this->common_model->get_result('*', 'menu_acl', '', array('loginId'=>$this->loginId), 'menuId');
                foreach($menuAcl2 as $acl2){
                    $subMenu = $this->common_model->get_row('*', 'menu_bar', array('menuId'=>$val['id'], 'id'=>$acl2['menuId']));                            
                    array_push($row1, $subMenu); 
                } 
            }
            $row1 = array_filter($row1);
            array_push($result[$k], $row1); 

            $row2 = $this->common_model->get_result('*', 'menu', '', array('parent_id'=>$val['id'], 'show_menu'=>1));
            if($this->loginRole>1){
                $row2 = array();
                $menuAcl3 = $this->common_model->get_result('*', 'menu_acl', '', array('loginId'=>$this->loginId), 'mainMenuId');
                foreach($menuAcl3 as $acl3){
                    $subMenu2 = $this->common_model->get_row('*', 'menu', array('parent_id'=>$val['id'], 'id'=>$acl3['mainMenuId']));                            
                    array_push($row2, $subMenu2); 
                } 
            }
            
            $row2 = array_filter($row2);
           
            foreach($row2 as $key=>$value){
                $row3 = $this->common_model->get_result('*', 'menu_bar', '', array('menuId'=>$value['id'], 'show_menu'=>1));
                if($this->loginRole >1){
                    $row3 = array(); 
                    $menuAcl4 = $this->common_model->get_result('*', 'menu_acl', '', array('loginId'=>$this->loginId), 'menuId');
                    foreach($menuAcl4 as $acl4){
                        $subMenu3 = $this->common_model->get_row('*', 'menu_bar', array('menuId'=>$value['id'], 'id'=>$acl4['menuId'], 'show_menu'=>1));                            
                        array_push($row3, $subMenu3); 
                    } 
                }
                $row3 = array_filter($row3);
                 
                array_push($row2[$key], $row3);

            }
           array_push($result[$k], $row2);

        }

        return $result;
    }    
    function orderingMenu($users, $val){
        $usernames = array(); 
        foreach($users as $user){
            $usernames[] = $user[$val];
        }
        array_multisort($usernames, SORT_ASC, $users);
        return $users;
    }
  
    

}