<?php
class Export_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    //for exporting data
    function exportDataFormat($filename, $dir_id=null){ //echo "<pre>";print_r($dir_id);die;
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        $delimiter = " ";
        $newline = "\r\n";
        
        if($dir_id){
            foreach($dir_id as $did){
            $query = "SELECT mobile as m FROM mobiles where directory_id = ".$did['id'];
            $result = $this->db->query($query);
            $data[] = $this->dbutil->csv_from_result($result, $delimiter, $newline);
            }
        }else{
            $query = "SELECT mobile as m FROM mobiles";
            $result = $this->db->query($query);
            $data[] = $this->dbutil->csv_from_result($result, $delimiter, $newline);
        }
       
            $str="";
            foreach($data as $k=>$i){
                if(is_array($i)){
                    $str.=array2string($i);
                }
                else{
                    $str.=$i;
                    $str2 = str_replace('"m"', ' ', $str);
                    $str3 = preg_replace('/^[ \t]*[\r\n]+/m', '', $str2);
                    $str= preg_replace("/[^a-zA-Z0-9]+/", "\r\n", html_entity_decode($str3, ENT_QUOTES));
                }
            }  
            
        force_download($filename, $str);

    }
    //for main sample
    function mainSample(){ 
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        $delimiter = " ";
        $newline = "\r\n";
        $filename = "filename_you_wish.txt";
        $query = "SELECT mobile FROM mobiles where";
        $result = $this->db->query($query);
        $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
        
        force_download($filename, $data);

    }
    

}
