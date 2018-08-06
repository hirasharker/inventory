<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Sales_Model extends CI_Model {


    public function get_all_sales(){
        $this->db->select('tbl_sales.sales_id, tbl_sales.customer_id, tbl_sales.customer_name, tbl_sales.dealer_name, tbl_sales.user_id, tbl_sales.user_name
            , tbl_sales.sales_date, GROUP_CONCAT(tbl_sales_detail.item_name SEPARATOR ",") as item_name, (sum(tbl_sales_detail.sales_price * tbl_sales_detail.quantity-tbl_sales_detail.individual_discount))*(1-.01*tbl_sales.overall_discount) as total_price'); 
        $this->db->from('tbl_sales');
        $this->db->join('tbl_sales_detail','tbl_sales_detail.sales_id = tbl_sales.sales_id');
        $this->db->group_by('tbl_sales_detail.sales_id');
        $this->db->order_by('tbl_sales.time_stamp','desc');
        $this->db->order_by('tbl_sales.customer_name','desc');
        $result_query=$this->db->get();
        $result=$result_query->result();
        return $result;
    }

    public function get_all_sales_by_date($from_date,$to_date){
        $this->db->select('tbl_sales.sales_id, tbl_sales.customer_id, tbl_sales.customer_name,tbl_sales.user_id, tbl_sales.user_name
            , tbl_sales.sales_date, GROUP_CONCAT(tbl_sales_detail.item_name SEPARATOR ",") as item_name, (sum(tbl_sales_detail.sales_price * tbl_sales_detail.quantity-tbl_sales_detail.individual_discount))*(1-.01*tbl_sales.overall_discount) as total_price'); 
        $this->db->from('tbl_sales');
        $this->db->join('tbl_sales_detail','tbl_sales_detail.sales_id = tbl_sales.sales_id');
        $this->db->group_by('tbl_sales_detail.sales_id');
        $this->db->where('tbl_sales.sales_date >=',$from_date);
        $this->db->where('tbl_sales.sales_date <=',$to_date);
        $this->db->order_by('tbl_sales.time_stamp','desc');
        $this->db->order_by('tbl_sales.customer_name','desc');
        $result_query=$this->db->get();
        $result=$result_query->result();
        return $result;
    }

    public function get_all_sales_by_date_and_customer_name($customer_name,$from_date,$to_date){
        $this->db->select('tbl_sales.sales_id, tbl_sales.customer_id, tbl_sales.customer_name,tbl_sales.user_id, tbl_sales.user_name
            , tbl_sales.sales_date, GROUP_CONCAT(tbl_sales_detail.item_name SEPARATOR ",") as item_name
            , (sum(tbl_sales_detail.sales_price * tbl_sales_detail.quantity-tbl_sales_detail.individual_discount))*(1-.01*tbl_sales.overall_discount) as total_price'); 
        $this->db->from('tbl_sales');
        $this->db->join('tbl_sales_detail','tbl_sales_detail.sales_id = tbl_sales.sales_id');
        $this->db->group_by('tbl_sales_detail.sales_id');
        $this->db->where('tbl_sales.sales_date >=',$from_date);
        $this->db->where('tbl_sales.sales_date <=',$to_date);
        $this->db->where('tbl_sales.customer_name',$customer_name);
        $this->db->order_by('tbl_sales.time_stamp','desc');
        $this->db->order_by('tbl_sales.customer_name','desc');
        $result_query=$this->db->get();
        $result=$result_query->result();
        return $result;
    }

    public function get_individual_sales_report_by_date_and_customer_name($customer_name,$from_date,$to_date){
        $this->db->select('tbl_sales.sales_id, tbl_sales.customer_id, tbl_sales.customer_name, tbl_sales.user_id, tbl_sales.user_name
            , tbl_sales_detail.item_name, tbl_sales_detail.quantity, tbl_sales.sales_date
            , (tbl_sales_detail.sales_price - tbl_sales_detail.individual_discount)*(1-.01*tbl_sales.overall_discount) as item_rate
            , tbl_money_receipt.received_amount,0, tbl_money_receipt.money_receipt_date'); 
        $this->db->from('tbl_sales');
        $this->db->join('tbl_sales_detail','tbl_sales_detail.sales_id = tbl_sales.sales_id','left');
        $this->db->join('tbl_money_receipt','tbl_money_receipt.sales_id = tbl_sales.sales_id','left');
        $this->db->where('tbl_sales.sales_date >=',$from_date);
        $this->db->where('tbl_sales.sales_date <=',$to_date);
        $this->db->where('tbl_sales.customer_name',$customer_name);
        $this->db->order_by('tbl_sales.time_stamp','desc');
        $this->db->order_by('tbl_sales.customer_name','desc');
        $result_query=$this->db->get();
        $result=$result_query->result();
        return $result;
    }

    public function get_group_sales_report_by_date($from_date,$to_date){
        $this->db->select('tbl_sales.sales_id, tbl_sales.customer_id, tbl_sales.customer_name, tbl_sales.user_id, tbl_sales.user_name
            , tbl_sales_detail.item_name, tbl_sales_detail.quantity, tbl_sales.sales_date
            , (tbl_sales_detail.sales_price - tbl_sales_detail.individual_discount)*(1-.01*tbl_sales.overall_discount) as item_rate
            , tbl_money_receipt.received_amount,0, tbl_money_receipt.money_receipt_date'); 
        $this->db->from('tbl_sales');
        $this->db->join('tbl_sales_detail','tbl_sales_detail.sales_id = tbl_sales.sales_id','left');
        $this->db->join('tbl_money_receipt','tbl_money_receipt.sales_id = tbl_sales.sales_id','left');
        $this->db->where('tbl_sales.sales_date >=',$from_date);
        $this->db->where('tbl_sales.sales_date <=',$to_date);
        $this->db->order_by('tbl_sales.time_stamp','desc');
        $this->db->order_by('tbl_sales.customer_name','desc');
        $result_query=$this->db->get();
        $result=$result_query->result();
        return $result;
    }

    public function get_sales_by_id($sales_id){
        $this->db->select('tbl_sales.*, sum(tbl_sales_detail.sales_price*tbl_sales_detail.quantity-tbl_sales_detail.individual_discount) as sub_total
            ,sum(tbl_sales_detail.quantity) as total_quantity
            ,sum(tbl_sales_detail.sales_price*tbl_sales_detail.quantity-tbl_sales_detail.individual_discount)*(1-tbl_sales.overall_discount*.01) as total_price');
        $this->db->from('tbl_sales');
        $this->db->where('tbl_sales.sales_id',$sales_id);
        $this->db->join('tbl_sales_detail','tbl_sales_detail.sales_id = tbl_sales.sales_id');
        $this->db->group_by('tbl_sales_detail.sales_id');
        $result_query=$this->db->get();
        $result=$result_query->row();
        return $result;
    }

    public function get_sales_like_id($sales_id){
        $this->db->select('sales_id');
        $this->db->like('sales_id', $sales_id);
        $query = $this->db->get('tbl_sales');
        if($query->num_rows() > 0){
          foreach ($query->result_array() as $row){
            $row_set[] = htmlentities(stripslashes($row['sales_id'])); //build an array
          }
          echo json_encode($row_set); //format the array into json data
        }
    }
    
    public function add_sales($data){
        $this->db->insert('tbl_sales',$data);
        $result = $this->db->insert_id();
        return $result;
    }
   
    public function update_sales($data,$sales_id){
        
        $this->db->where('sales_id',$sales_id);
        $this->db->update('tbl_sales',$data);
    }
   
    public function delete_sales($sales_id){
        $this->db->where('sales_id',$sales_id);
        $this->db->delete('tbl_sales');
    }


    //---SALES DETAIL SECTION START HERE----------------

    public function get_all_sales_details(){
        $this->db->select('*');
        $this->db->from('tbl_sales');
        $this->db->order_by('time_stamp','asc');
        $result_query=$this->db->get();
        $result=$result_query->result();
        return $result;
    }

    public function get_sales_details_by_id($sales_id){
        $this->db->select('*');
        $this->db->from('tbl_sales_detail');
        $this->db->where('sales_id',$sales_id);
        $result_query=$this->db->get();
        $result=$result_query->result();
        return $result;
    }

    public function get_sales_details_by_sales_id_and_item_id($sales_id,$item_id){
        $this->db->select('*');
        $this->db->from('tbl_sales_detail');
        $this->db->where('sales_id',$sales_id);
        $this->db->where('item_id',$item_id);
        $result_query=$this->db->get();
        $result=$result_query->result();
        return $result;
    }

    public function add_sales_detail($data){
        $this->db->insert('tbl_sales_detail',$data);
        $result = $this->db->insert_id();
        return $result;
    }
   
    public function update_sales_detail($data,$sales_detail_id){
        
        $this->db->where('sales_id',$sales_detail_id);
        $this->db->update('tbl_sales_detail',$data);
    }
   
    public function delete_sales_detail($sales_id){
        $this->db->where('sales_id',$sales_id);
        $this->db->delete('tbl_sales_detail');
    }

    /////----CUSTOMER SECTION START HERE...................

    public function get_all_customers(){
        $this->db->select('*');
        $this->db->from('tbl_customer');
        $this->db->order_by('time_stamp','asc');
        $result_query=$this->db->get();
        $result=$result_query->result();
        return $result;
    }

    public function get_customer_by_id($customer_id){
        $this->db->select('*');
        $this->db->from('tbl_customer');
        $this->db->where('customer_id',$customer_id);
        $result_query=$this->db->get();
        $result=$result_query->row();
        return $result;
    }
    
    
    public function add_customer($data){
        $this->db->insert('tbl_customer',$data);
        $result = $this->db->insert_id();
        return $result;
    }
   
    public function update_customer($data,$customer_id){
        
        $this->db->where('customer_id',$customer_id);
        $this->db->update('tbl_customer',$data);
    }
   
    public function delete_customer($customer_id){
        $this->db->where('customer_id',$customer_id);
        $this->db->delete('tbl_customer');
    }

    ////----CUSTOMER SECTION ENDS HERE-----

    //------Money Receipt------------------

    public function get_all_money_receipts(){
        $this->db->select('*');
        $this->db->from('tbl_money_receipt');
        $this->db->order_by('time_stamp','desc');
        $result_query=$this->db->get();
        $result=$result_query->result();
        return $result;
    }

    public function get_all_money_receipts_by_date_and_customer_name($customer_name,$from_date,$to_date){
        $this->db->select('*');
        $this->db->from('tbl_money_receipt');
        $this->db->where('money_receipt_date >=',$from_date);
        $this->db->where('money_receipt_date <=',$to_date);
        $this->db->where('customer_name',$customer_name);
        $this->db->order_by('time_stamp','desc');
        $result_query=$this->db->get();
        $result=$result_query->result();
        return $result;
    }

    public function get_individual_money_receipt_by_date_and_customer_name($customer_name,$from_date,$to_date){
        $this->db->select('*');
        $this->db->from('tbl_money_receipt');
        $this->db->where('money_receipt_date >=',$from_date);
        $this->db->where('money_receipt_date <=',$to_date);
        $this->db->where('customer_name',$customer_name);
        $this->db->order_by('time_stamp','desc');
        $result_query=$this->db->get();
        $result=$result_query->result();
        return $result;
    }

    public function get_all_money_receipts_by_date($from_date,$to_date){
        $this->db->select('*');
        $this->db->from('tbl_money_receipt');
        $this->db->where('money_receipt_date >=',$from_date);
        $this->db->where('money_receipt_date <=',$to_date);
        $this->db->order_by('time_stamp','desc');
        $result_query=$this->db->get();
        $result=$result_query->result();
        return $result;
    }

    public function get_money_receipt_by_id($money_receipt_id){
        $this->db->select('*');
        $this->db->from('tbl_money_receipt');
        $this->db->where('money_receipt_id',$money_receipt_id);
        $result_query=$this->db->get();
        $result=$result_query->row();
        return $result;
    }

    public function add_money_receipt($data){
        $this->db->insert('tbl_money_receipt',$data);
        $result = $this->db->insert_id();
        return $result;
    }
   
    public function update_money_receipt($data,$money_receipt_id){
        $this->db->where('money_receipt_id',$money_receipt_id);
        $this->db->update('tbl_money_receipt',$data);
    }
   
    public function delete_money_receipt($money_receipt_id){
        $this->db->where('money_receipt_id',$money_receipt_id);
        $this->db->delete('tbl_money_receipt');
    }




    /////-----------------BALANCE---------

    public function get_invoice_balance_by_customer_id($customer_id){
        $this->db->select('tbl_sales_detail.customer_id, sum((tbl_sales_detail.sales_price * tbl_sales_detail.quantity-tbl_sales_detail.individual_discount)*(1-.01*tbl_sales_detail.overall_discount)) as invoice_balance'); 
        // $this->db->select('tbl_sales_detail.customer_id, tbl_sales_detail.sales_price'); 
        $this->db->from('tbl_sales_detail');
        $this->db->where('tbl_sales_detail.customer_id',$customer_id);
        $this->db->join('tbl_sales','tbl_sales.sales_id = tbl_sales_detail.sales_id','left');
        // $this->db->join('tbl_sales','tbl_sales.customer_id = tbl_sales_detail.customer_id','inner');
        $this->db->group_by('tbl_sales_detail.customer_id');

        // $this->db->order_by('tbl_sales.time_stamp','desc');
        // $this->db->order_by('tbl_sales.customer_name','desc');
        $result_query=$this->db->get();
        $result=$result_query->result();
        return $result;
    }

    public function get_paid_amount_by_customer_id($customer_id){
        $this->db->select('tbl_customer.customer_id, sum(tbl_money_receipt.received_amount) as paid_amount'); 
        $this->db->from('tbl_customer');
        $this->db->where('tbl_customer.customer_id',$customer_id);
        $this->db->join('tbl_money_receipt','tbl_money_receipt.customer_id = tbl_customer.customer_id','inner');
        $this->db->order_by('tbl_money_receipt.time_stamp','desc');
        $result_query=$this->db->get();
        $result=$result_query->row();
        return $result;
    }

    //-----------RECEIVABLE------------

    public function get_customer_like_customer_id($search_key){
        $this->db->select('customer_name');
        $this->db->like('customer_name', $search_key);
        $this->db->or_like('customer_id', $search_key);
        $query = $this->db->get('tbl_customer');
        if($query->num_rows() > 0){
          foreach ($query->result_array() as $row){
            $row_set[] = htmlentities(stripslashes($row['customer_name'])); //build an array
          }
          echo json_encode($row_set); //format the array into json data
        }
    }

    //  public function get_receivable(){
    //     $this->db->select('tbl_sales.sales_id, tbl_sales.customer_id, tbl_sales.customer_name,tbl_sales.user_id, tbl_sales.user_name
    //         , tbl_sales.sales_date, GROUP_CONCAT(tbl_sales_detail.item_name SEPARATOR ",") as item_name
    //         , sum(tbl_sales_detail.sales_price) as total_price, tbl_money_receipt.money_receipt_id, tbl_money_receipt.received_amount
    //         ,tbl_money_receipt.money_receipt_date'); 
    //     $this->db->from('tbl_sales');
    //     $this->db->join('tbl_sales_detail','tbl_sales_detail.sales_id = tbl_sales.sales_id');
    //     $this->db->join('tbl_money_receipt','tbl_money_receipt.sales_id = tbl_sales.sales_id','full');
    //     $this->db->group_by('tbl_sales_detail.sales_id');
    //     $this->db->order_by('tbl_sales.time_stamp','asc');
    //     $result_query=$this->db->get();
    //     $result=$result_query->result();
    //     return $result;
    // }
    
}
?>