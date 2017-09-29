<?php

class DashboardModel extends CI_Model {

    function emiInstallments() { 
        $this->db->select('ei.*, e.monthly_premium, q.id as qId, q.quotation_id, q.client_id, c.name');
        $this->db->from('emi_installment as ei');
        $this->db->where('ei.approved', 0);
        $this->db->where('ei.month <=', date('Y-m-32'));
        $this->db->join('emi as e', 'ei.emi_id = e.id', 'left');
        $this->db->join('quotation as q', 'ei.emi_id = q.emi_id', 'left');
        $this->db->join('client as c', 'q.client_id = c.id', 'left');
        return $this->db->get()->result_array();

    }
    function crmStatus() {
        $this->db->select('*');
        $this->db->from('types');
        $this->db->order_by('type', 'ASC');
        $result = $this->db->get()->result_array();
        foreach($result as $k=>$row){
            $this->db->select('crm.*, c.id as cid, c.client_id as c_id, c.name');
            $this->db->from('crm');
            $this->db->join('client as c', 'crm.client_id = c.id', 'left');
            $this->db->where(array('crm.type_id'=>$row['id']));
            $this->db->order_by('crm.id', 'DESC');
            $this->db->limit(10);
            $crm['cid'] = $this->db->get()->result_array();
            array_push($result[$k], $crm['cid']);
        }
        return $result;        
    }
    function quotations($where=null) {
        $this->db->select('q.id, q.quotation_id, q.net_total, q.date, q.invoiceDate, c.id as cid, c.client_id as c_id, c.name');
        $this->db->from('quotation as q');
        $this->db->join('client as c', 'q.client_id = c.id', 'left');
        if($where){ $this->db->where($where); }
        $this->db->order_by('q.id', 'DESC');
        $this->db->limit(10);
        return $this->db->get()->result_array();        
    }

}