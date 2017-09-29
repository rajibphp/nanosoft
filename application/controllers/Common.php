<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Common extends CI_Controller {
    
    public $login_id;    
    function __construct() {
        parent::__construct();
        $this->login_id = $this->session->userdata('login_id'); 
        if(empty($this->login_id)){ redirect("login"); }     
    }
    
    function chkDuplicacy(){ 
        $select = trim($this->input->post('select')); 
        $table = $this->input->post('table'); 
        $where = $this->input->post('where');  
        $row = $this->common_model->get_row($select, $table, $where);
        if($row){ 
            if(!empty($row[$select])){ echo 1; }else{ echo 0; }
        }else{ echo 0; }
    }
    function chkDuplicacyEdit() { 
        $select = trim($this->input->post('select')); 
        $table = $this->input->post('table'); 
        $array = $this->input->post('where'); 
        $key = (array_keys($array));
        
        $where = array($key[0]=>$array[$key[0]], $key[1].'!='=>$array[$key[1]]);
        if(!empty($key[2])){
            $key2 = $key[2];
            $val2 = $array[$key[2]];
            $where = array($key[0]=>$array[$key[0]], $key[1].'!='=>$array[$key[1]], $key[2]=>$array[$key[2]]);
        }
        
        $row = $this->common_model->get_row($select, $table, $where);
        if($row){ 
            if(!empty($row[$select])){ echo 1; }else{ echo 0; }
        }else{ echo 0; }
    }
    function get_state(){
        $id = $_POST['id'];
        $results = $this->common_model->get_result('q.id, q.quotation_id, q.status', 'quotation as q', 'id DESC', array('client_id'=>$id, 'type'=>0));
        
        echo '<option selected="" disabled="">Select Quotation</option>';
        foreach($results as $row){ ?>
            <option value="<?php echo $row['id']; ?>">
                <?php echo $row['quotation_id']; ?>
            </option>
        <?php }             
    }
    function getRow() {
        $where = array();
        $order_by = '';
        $limit = '';
        $select = $this->input->post('select'); 
        $table = $this->input->post('table'); 
        if($this->input->post('where')){
            $where = $this->input->post('where');
        }  
        if($this->input->post('order_by')){
            $order_by = $this->input->post('order_by');
        }  
        if($this->input->post('limit')){
            $limit = $this->input->post('limit');
        }  
        echo json_encode($this->common_model->get_row($select, $table, $where, $order_by, $limit));
    }
    function bankBalance() {
        $id = $this->input->post('bank_id');
        $data = $this->common_model->get_row('balance', 'accounts', array('id'=>$id));
        echo json_encode($data);
    }
    
    function downloadFile() {
        $file = $this->input->post("file");
        $url = $this->input->post("url");
        $data = file_get_contents(base_url($url.'/'.$file));
        unlink($url.'/'.$file);
        force_download($file, $data);
    }
    
    
}