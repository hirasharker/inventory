<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Vat_Tax_Model extends CI_Model {

    /**
     * [get_all_vat_taxs description]
     * @return ArrayList [description]
     */
    public function get_all_vat_tax_rules(){
        $this->db->select('*');
        $this->db->from('tbl_vat_tax');
        $this->db->order_by('time_stamp','asc');
        $result_query=$this->db->get();
        $result=$result_query->result();
        return $result;
    }
    /**
     * [get_vat_tax_by_id description]
     * @param  int $vat_tax_id [description]
     * @return Array
     */
    public function get_vat_tax_rule_by_id($vat_tax_rule_id){
        $this->db->select('*');
        $this->db->from('tbl_vat_tax');
        $this->db->where('vat_tax_rule_id',$vat_tax_rule_id);
        $result_query=$this->db->get();
        $result=$result_query->row();
        return $result;
    }
    
    public function get_vat_tax_rule_by_date($effective_date){
        $this->db->select('*');
        $this->db->from('tbl_vat_tax');
        $this->db->where('effective_date <=',$effective_date);
        $this->db->order_by('effective_date','desc');
        $this->db->limit(1);
        $result_query=$this->db->get();
        $result=$result_query->row();
        return $result;
    }
    
    
    public function add_vat_tax_rule($data){
        $this->db->insert('tbl_vat_tax',$data);
        $result = $this->db->insert_id();
        return $result;
    }
   
    public function update_vat_tax_rule($data,$vat_tax_rule_id){
        
        $this->db->where('vat_tax_rule_id',$vat_tax_rule_id);
        $this->db->update('tbl_vat_tax',$data);
    }
   
    public function delete_vat_tax_rule($vat_tax_rule_id){
        $this->db->where('vat_tax_rule_id',$vat_tax_rule_id);
        $this->db->delete('tbl_vat_tax');
    }

   
}?>
