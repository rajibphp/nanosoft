<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
session_start();

class Export extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('common_model/common_model');
        $this->load->model('export/export_model');
        $id = $this->session->userdata('abhinvoiser_1_1_user_id');
        if (empty($id)) {
            redirect("authenticationcontroller");
        }
    }
    
    function index() { 
        $data['categories'] = $this->common_model->get('item_group', 'group_name', 'ASC');
        $data['title'] = "Export Mobiles";
        $data['dashboardContent'] = $this->load->view('dashboard/export/add', $data, TRUE);
        $this->load->view('dashboard/master_dashboard_panel', $data);
    }
    
    
    //for exporting data
    function exportDataFormat(){       
        $cat = $this->input->post('category');
        $format = $this->input->post('format');
        if($cat == "all"){
            $query = null;
        }else{ 
            if($this->input->post('sub_category')){
               $where = array('sub_cat_id'=>$this->input->post('sub_category')); 
            }else{ 
                $where = array('cat_id'=>$cat);
            }            
            $query = $this->common_model->get_result('id', 'directories', array(), $where);            
        } 
        
        if($format == 1){
            $filename = "mobiles.csv";
        }else{
            $filename = "mobiles.txt";
        }

        $sub_cat = $this->input->post('sub_category');
        $this->export_model->exportDataFormat($filename, $query);
        redirect('export/export');
    }
}