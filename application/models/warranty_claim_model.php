<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Warranty_Claim_Model extends CI_Model {


    public function get_all_warranty_claims(){
        $this->db->select("tbl_warranty_claim.warranty_claim_id, tbl_warranty_claim.customer_id, tbl_warranty_claim.sales_id, tbl_warranty_claim.warranty_claim_type_id, tbl_warranty_claim.engine_no, tbl_warranty_claim.chassis_no, tbl_warranty_claim.customer_name, tbl_warranty_claim.document_path, tbl_warranty_claim.warranty_claim_date, sum(tbl_warranty_claim_detail.quantity), string_agg(tbl_item.item_name, ', ') as item_name, tbl_warranty_claim.approval_status");
        $this->db->from('tbl_warranty_claim');
        $this->db->join('tbl_warranty_claim_detail','tbl_warranty_claim.warranty_claim_id = tbl_warranty_claim_detail.warranty_claim_id');
        $this->db->join('tbl_item','tbl_warranty_claim_detail.item_id = tbl_item.item_id');
        $this->db->group_by('tbl_warranty_claim.warranty_claim_id');
        $this->db->order_by('tbl_warranty_claim.warranty_claim_date','desc');
        $result_query = $this->db->get();
        $result       = $result_query->result();
        return $result;
    }
    
    public function get_warranty_claim_by_status($approval_status){
        $this->db->select("tbl_warranty_claim.*, string_agg(tbl_item.item_name, ', ') as item_name, string_agg(tbl_item.part_no, ', ') as part_no, max(tbl_sales.customer_type),
            tbl_warranty_claim.customer_id, tbl_warranty_claim.customer_name");
        $this->db->from('tbl_warranty_claim');
        $this->db->join('tbl_warranty_claim_detail','tbl_warranty_claim_detail.warranty_claim_id = tbl_warranty_claim.warranty_claim_id');
        $this->db->join('tbl_item','tbl_warranty_claim_detail.item_id = tbl_item.item_id');
        $this->db->join('tbl_sales','tbl_warranty_claim.sales_id = tbl_sales.sales_id','left');
        $this->db->where('tbl_warranty_claim.approval_status',$approval_status);
        $this->db->group_by('tbl_warranty_claim.warranty_claim_id');
        $result_query=$this->db->get();
        $result=$result_query->result();
        return $result;
    }

    public function get_warranty_claim_by_id($warranty_claim_id){
        $this->db->select('*');
        $this->db->from('tbl_warranty_claim');
        $this->db->where('warranty_claim_id',$warranty_claim_id);
        $result_query=$this->db->get();
        $result=$result_query->row();
        return $result;
    }


    

    public function get_warranty_claim_like_id($warranty_claim_id){
        $this->db->select('warranty_claim_id');
        $this->db->like('warranty_claim_id', $warranty_claim_id);
        $query = $this->db->get('tbl_warranty_claim');
        if($query->num_rows() > 0){
          foreach ($query->result_array() as $row){
            $row_set[] = htmlentities(stripslashes($row['warranty_claim_id'])); //build an array
          }
          echo json_encode($row_set); //format the array into json data
        }
    }

    
    public function get_warranty_claim_detail_by_transfer_id($warranty_claim_id){
        $this->db->select('*');
        $this->db->from('tbl_warranty_claim_detail');
        $this->db->where('warranty_claim_id', $warranty_claim_id);
        $result_query=$this->db->get();
        $result=$result_query->result();
        return $result;
    }


    
    public function add_warranty_claim($data){
        $this->db->insert('tbl_warranty_claim',$data);
        $result = $this->db->insert_id();
        return $result;
    }
   
    public function update_warranty_claim($data,$warranty_claim_id){
        
        $this->db->where('warranty_claim_id',$warranty_claim_id);
        $this->db->update('tbl_warranty_claim',$data);
        $result     =   $this->db->affected_rows();
        return $result;
    }
   
    public function delete_warranty_claim($warranty_claim_id){
        $this->db->where('warranty_claim_id',$warranty_claim_id);
        $this->db->delete('tbl_warranty_claim');
    }

    public function get_item_by_sales_id($sales_id){
        $this->db->select('tbl_item.*, tbl_sales_detail.quantity as sales_quantity');
        $this->db->from('tbl_sales_detail');
        $this->db->join('tbl_item','tbl_sales_detail.item_id = tbl_item.item_id');
        $this->db->where('tbl_sales_detail.sales_id',$sales_id);
        $result_query=$this->db->get();
        $result=$result_query->result();
        return $result;
    }

    public function get_preloaded_item_by_sales_id($sales_id){
        $this->db->select('tbl_item.*, tbl_sales_detail.quantity as sales_quantity, tbl_warranty_claim_detail.warranty_claim_id');
        $this->db->from('tbl_sales_detail');
        $this->db->join('tbl_item','tbl_sales_detail.item_id = tbl_item.item_id');
        $this->db->join('tbl_warranty_claim_detail','tbl_sales_detail.item_id = tbl_warranty_claim_detail.item_id','left');
        $this->db->where('tbl_warranty_claim_detail.warranty_claim_id',NULL);
        $this->db->where('tbl_sales_detail.sales_id',$sales_id);
        $result_query=$this->db->get();
        $result=$result_query->result();
        return $result;
    }

    //------- WARRANTY CLAIM DETAIL
    public function get_warranty_claim_detail_by_claim_id($warranty_claim_id){
        $this->db->select('tbl_warranty_claim_detail.*,tbl_item.item_name, tbl_item.item_price, tbl_item.part_no, tbl_item.quantity as stock_quantity');
        $this->db->from('tbl_warranty_claim_detail');
        $this->db->join('tbl_item','tbl_item.item_id = tbl_warranty_claim_detail.item_id');
        $this->db->where('warranty_claim_id', $warranty_claim_id);
        $result_query=$this->db->get();
        $result=$result_query->result();
        return $result;
    }

    public function get_warranty_claim_total_by_claim_id($warranty_claim_id){
        $this->db->select('sum(tbl_warranty_claim_detail.quantity * tbl_item.item_price) as total_price');
        $this->db->from('tbl_warranty_claim_detail');
        $this->db->join('tbl_item','tbl_item.item_id = tbl_warranty_claim_detail.item_id');
        $this->db->where('warranty_claim_id', $warranty_claim_id);
        $result_query=$this->db->get();
        $result=$result_query->row();
        return $result;
    }

    
    public function get_warranty_claim_detail_summary_claim_id($warranty_claim_id){
        $this->db->select('sum(quantity * item_price) as total_price, sum(quantity) as total_quantity');
        $this->db->from('tbl_warranty_claim_detail');
        $this->db->where('warranty_claim_id',$warranty_claim_id);
        $this->db->group_by('warranty_claim_id');
        $result_query=$this->db->get();
        $result=$result_query->row();
        return $result;
    }

    public function add_warranty_claim_detail($data){
        $this->db->insert('tbl_warranty_claim_detail',$data);
        $result = $this->db->insert_id();
        return $result;
    }
   
    public function update_warranty_claim_detail($data,$warranty_claim_detail_id){
        
        $this->db->where('warranty_claim_detail_id',$warranty_claim_detail_id);
        $this->db->update('tbl_warranty_claim_detail',$data);
        $result     =   $this->db->affected_rows();
        return $result;
    }
   
    public function delete_warranty_claim_detail($warranty_claim_id){
        $this->db->where('warranty_claim_id',$warranty_claim_id);
        $this->db->delete('tbl_warranty_claim_detail');
    }

    /////----warranty_claim_type SECTION START HERE...................

    public function get_all_warranty_claim_types(){
        $this->db->select('*');
        $this->db->from('tbl_warranty_claim_type');
        $this->db->order_by('time_stamp','asc');
        $result_query=$this->db->get();
        $result=$result_query->result();
        return $result;
    }

    public function get_warranty_claim_type_by_id($warranty_claim_type_id){
        $this->db->select('*');
        $this->db->from('tbl_warranty_claim_type');
        $this->db->where('warranty_claim_type_id',$warranty_claim_type_id);
        $result_query=$this->db->get();
        $result=$result_query->row();
        return $result;
    }
    
    
    public function add_warranty_claim_type($data){
        $this->db->insert('tbl_warranty_claim_type',$data);
        $result = $this->db->insert_id();
        return $result;
    }
   
    public function update_warranty_claim_type($data,$warranty_claim_type_id){
        
        $this->db->where('warranty_claim_type_id',$warranty_claim_type_id);
        $this->db->update('tbl_warranty_claim_type',$data);
    }
   
    public function delete_warranty_claim_type($warranty_claim_type_id){
        $this->db->where('warranty_claim_type_id',$warranty_claim_type_id);
        $this->db->delete('tbl_warranty_claim_type');
    }

    ////----warranty_claim_type SECTION ENDS HERE-----

    //------warranty_claim_report SECTION--------------

    public function get_warranty_claim_status($claim_status, $warranty_claim_type_id, $from_date, $to_date) {
        $this->db->select("tbl_warranty_claim.*, string_agg(tbl_item.item_name, ', ') as item_name, string_agg(tbl_item.part_no, '| '), max(tbl_sales.customer_type),
            tbl_warranty_claim.customer_id, tbl_warranty_claim.customer_name, max(tbl_sales.sales_date) as sales_date");
        $this->db->from('tbl_warranty_claim');
        $this->db->join('tbl_warranty_claim_detail','tbl_warranty_claim_detail.warranty_claim_id = tbl_warranty_claim.warranty_claim_id');
        $this->db->join('tbl_item','tbl_warranty_claim_detail.item_id = tbl_item.item_id');
        $this->db->join('tbl_sales','tbl_warranty_claim.sales_id = tbl_sales.sales_id');

        if($claim_status != ''){
            switch ($claim_status) {
                case '1':
                    $this->db->where('tbl_warranty_claim.approval_status >= 0 
                                    and tbl_warranty_claim.approval_status <= 2');
                    break;

                case '2':
                    $this->db->where('tbl_warranty_claim.approval_status >= 2');
                    break;

                case '3':
                    $this->db->where('tbl_warranty_claim.approval_status < 0');
                    break;
                
                default:
                    break;
            }
            
        }

        if($warranty_claim_type_id != ''){
            $this->db->where('tbl_warranty_claim.warranty_claim_type_id',$warranty_claim_type_id);
        }

        $this->db->where('tbl_warranty_claim.time_stamp >=',$from_date);
        $this->db->where('tbl_warranty_claim.time_stamp <=',$to_date);

        $this->db->group_by('tbl_warranty_claim.warranty_claim_id');

        $result_query=$this->db->get();
        $result=$result_query->result();
        return $result;
    }
    
}
?>
