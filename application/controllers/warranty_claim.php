<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Warranty_Claim extends CI_Controller {
	public function __construct(){
		parent:: __construct();
		if($this->session->userdata('user_id')==NULL){
			redirect('login','refresh');
		}
		$this->load->model('warranty_claim_model','warranty_claim_model',TRUE);
		$this->load->model('item_model','item_model',TRUE);
		$this->load->model('stock_model','stock_model',TRUE);
		$this->load->model('sales_model','sales_model',TRUE);
		$this->load->library('form_validation');
		$this->load->model('company_model','company_model',TRUE);
		$this->load->model('convert_model','convert_model',TRUE);
		$this->load->model('module_model','module_model',TRUE);
		$this->load->model('upload_model','upload_model',TRUE);
		$this->load->model('customer_model','customer_model',TRUE);
		$this->load->model('warehouse_model','warehouse_model',TRUE);
	}


	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	

	//---------------------warranty_claim SECTION STARTS HERE
	public function index($warranty_claim_id = 0, $error_count = 0)
	{
		$data							=	array();
		$data['page_title']				=	"Inventory Management";
		$nav_data['dev_key']			=	"warranty_claim";
		$nav_data['selected']			=	"add_warranty_claim";
		$nav_data['company_name']   	=   $this->company_model->get_company_by_id(1)->company_name;
		$nav_data['user_permission'] 	=	$this->module_model->get_permission_by_user_id($this->session->userdata('user_id'));

		$warranty_claim_data							=	array();
		if($warranty_claim_id!=0){
			$warranty_claim_data['warranty_claim']		=	$this->warranty_claim_model->get_warranty_claim_by_id($warranty_claim_id);
			$warranty_claim_data['warranty_claim_detail']		=	$this->warranty_claim_model->get_warranty_claim_detail_by_claim_id($warranty_claim_id);
			$warranty_claim_data['item_list']			=	$this->sales_model->get_items_by_sales_id($warranty_claim_data['warranty_claim']->sales_id);	
		}else{
			$warranty_claim_data['warranty_claim']		=	NULL;
			$warranty_claim_data['item_list']			=	NULL;
		}

		if($error_count != 0){
			$warranty_claim_data['error_content']		=	$error_count +1;
		}else{
			$warranty_claim_data['error_content']		=	NULL;
		}

		$warranty_claim_data['customer_list']			=	$this->customer_model->get_all_customers();
		$warranty_claim_data['sales_list']				=	$this->sales_model->get_all_sales();
		$warranty_claim_data['wc_type_list']			=	$this->warranty_claim_model->get_all_warranty_claim_types();
		$warranty_claim_data['warehouse_list']			=	$this->warehouse_model->get_all_warehouses();

		$data['navigation']				=	$this->load->view('templates/navigation',$nav_data,TRUE);
		$data['footer']					=	$this->load->view('templates/footer','',TRUE);
		$data['content']				=	$this->load->view('partials/warranty_claim',$warranty_claim_data,TRUE);

		$this->load->view('templates/main_template',$data);
	}
	public function view_warranty_claims()
	{
		$data												=	array();
		$data['page_title']									=	"Inventory Management";
		$nav_data['dev_key']								=	"warranty_claim";
		$nav_data['selected']								=	"all_warranty_claims";
		$nav_data['company_name']   						=   $this->company_model->get_company_by_id(1)->company_name;
		$nav_data['user_permission'] 						=	$this->module_model->get_permission_by_user_id($this->session->userdata('user_id'));

		$warranty_claim_data								=	array();
		$warranty_claim_data['warranty_claim_list']			=	$this->warranty_claim_model->get_all_warranty_claims();
		$warranty_claim_data['wc_type_list']				=	$this->warranty_claim_model->get_all_warranty_claim_types();
		// echo '<pre>';print_r($warranty_claim_data['warranty_claim_list']);echo '</pre>';exit();
		$warranty_claim_data['permission']					= 	$this->module_model->get_permission_by_module_id_and_user_id(17,$this->session->userdata('user_id'));

		$data['navigation']					=	$this->load->view('templates/navigation',$nav_data,TRUE);
		$data['footer']						=	$this->load->view('templates/footer','',TRUE);
		$data['content']					=	$this->load->view('partials/warranty_claim_list',$warranty_claim_data,TRUE);

		$this->load->view('templates/main_template',$data);
	}

	public function add_warranty_claim()
	{
		$warranty_claim_data						=	array();
		$warranty_claim_data['user_id']				=	$this->session->userdata('user_id');
		$warranty_claim_data['user_name']			=	$this->session->userdata('user_name');

		$warranty_claim_data['claim_mode']						=	$this->input->post('claim_mode','',TRUE);
		$warranty_claim_data['sales_id']						=	$this->input->post('sales_id','',TRUE);
		if($warranty_claim_data['sales_id'] != NULL){
			$sales_detail 										=	$this->sales_model->get_sales_by_id($warranty_claim_data['sales_id']);
			$warranty_claim_data['customer_id']					=	$sales_detail->customer_id;
			$warranty_claim_data['customer_name']				=	$sales_detail->customer_name;
		}else {
			$warranty_claim_data['customer_id']						=	$this->input->post('customer_id','',TRUE);
			$warranty_claim_data['customer_name']					=	$this->input->post('customer_name','',TRUE);
		}
		$warranty_claim_data['warehouse_id']					=	$this->input->post('warehouse_id','',TRUE);
		$warranty_claim_data['engine_no']						=	$this->input->post('engine_no','',TRUE);
		$warranty_claim_data['chassis_no']						=	$this->input->post('chassis_no','',TRUE);
		$warranty_claim_data['warranty_claim_type_id']			=	$this->input->post('warranty_claim_type_id','',TRUE);
		$warranty_claim_data['buyer_complain']					=	$this->input->post('buyer_complain','',TRUE);
		$warranty_claim_data['observation_note']				=	$this->input->post('observation_note','',TRUE);
		$warranty_claim_data['warranty_claim_date']				=	$this->input->post('warranty_claim_date','',TRUE);

		$document_upload										=	$this->upload_model->upload_file('document_path','files'); //after upload
		if(isset($document_upload['file_name'])){
			$warranty_claim_data['document_path'] 				=	$document_upload['file_name'];
		}else{
			$sdata=array();
			$sdata['upload_error'] = $document_upload['error'];
			// print_r($sdata['upload_error']);exit();
			$this->session->set_userdata($sdata);
		}

		$result													=	$this->warranty_claim_model->add_warranty_claim($warranty_claim_data);
		$warranty_claim_id 										=	$result;
		

		$item_id 												=	$this->input->post('item_id','',TRUE);
		$quantity 												=	$this->input->post('quantity','',TRUE);
		$item_price												=	$this->input->post('item_price','',TRUE);
		
		$count 													=	$this->input->post('count','',TRUE);

		$warranty_claim_detail_data								=	array();

		for ($i=0; $i < $count; $i++) { 
			$warranty_claim_detail_data['warranty_claim_id']	=	$warranty_claim_id;
			$warranty_claim_detail_data['item_id']				=	$item_id[$i];
			$warranty_claim_detail_data['sales_id']				=	$warranty_claim_data['sales_id'];
			$warranty_claim_detail_data['item_price']			=	$item_price[$i];
			$warranty_claim_detail_data['quantity']				=	$quantity[$i];
			$detail_result 										=	$this->warranty_claim_model->add_warranty_claim_detail($warranty_claim_detail_data);
			unset($warranty_claim_detail_data);
		}

		redirect('warranty_claim/view_warranty_claims','refresh');
	}

	public function update_warranty_claim()
	{
		$sdata=array();
		$warranty_claim_id 										=	$this->input->post('warranty_claim_id','',TRUE);

		$warranty_claim_data									=	array();
		$warranty_claim_data['user_id']							=	$this->session->userdata('user_id');
		$warranty_claim_data['user_name']						=	$this->session->userdata('user_name');

		$warranty_claim_data['claim_mode']						=	$this->input->post('claim_mode','',TRUE);
		$warranty_claim_data['sales_id']						=	$this->input->post('sales_id','',TRUE);
		if($warranty_claim_data['sales_id'] != NULL){
			$sales_detail 										=	$this->sales_model->get_sales_by_id($warranty_claim_data['sales_id']);
			$warranty_claim_data['customer_id']					=	$this->sales_detail->customer_id;
			$warranty_claim_data['customer_name']				=	$this->sales_detail->customer_name;
		}else {
			$warranty_claim_data['customer_id']						=	$this->input->post('customer_id','',TRUE);
			$warranty_claim_data['customer_name']					=	$this->input->post('customer_name','',TRUE);
		}
		$warranty_claim_data['warehouse_id']					=	$this->input->post('warehouse_id','',TRUE);
		$warranty_claim_data['engine_no']						=	$this->input->post('engine_no','',TRUE);
		$warranty_claim_data['chassis_no']						=	$this->input->post('chassis_no','',TRUE);
		$warranty_claim_data['warranty_claim_type_id']			=	$this->input->post('warranty_claim_type_id','',TRUE);
		$warranty_claim_data['buyer_complain']					=	$this->input->post('buyer_complain','',TRUE);
		$warranty_claim_data['observation_note']				=	$this->input->post('observation_note','',TRUE);
		$warranty_claim_data['warranty_claim_date']				=	$this->input->post('warranty_claim_date','',TRUE);

		$document_upload										=	$this->upload_model->upload_file('document_path','files'); //after upload
		if(isset($document_upload['file_name'])){
			$warranty_claim_data['document_path'] 				=	$document_upload['file_name'];
			unlink('files/'.$warranty_claim_detail->document_path);
		}else{
			$sdata['upload_error'] = $document_upload['error'];
			$this->session->set_userdata($sdata);
		}
		$count 													=	$this->input->post('count','',TRUE);
		if ($count == 0) {
			$sdata['error'] = 'Item list cannot be empty!!!';
			$this->session->set_userdata($sdata);
			redirect('warranty_claim/index/'.$warranty_claim_id,'refresh');
		}

		$update_result											=	$this->warranty_claim_model->update_warranty_claim($warranty_claim_data,$warranty_claim_id);
 
		$this->delete_warranty_claim_detail($warranty_claim_id);
		$item_id 												=	$this->input->post('item_id','',TRUE);
		$quantity 												=	$this->input->post('quantity','',TRUE);
		$item_price												=	$this->input->post('item_price','',TRUE);

		$warranty_claim_detail_data								=	array();

		for ($i=0; $i < $count; $i++) { 
			$warranty_claim_detail_data['warranty_claim_id']	=	$warranty_claim_id;
			$warranty_claim_detail_data['item_id']				=	$item_id[$i];
			$warranty_claim_detail_data['sales_id']				=	$warranty_claim_data['sales_id'];
			$warranty_claim_detail_data['item_price']			=	$item_price[$i];
			$warranty_claim_detail_data['quantity']				=	$quantity[$i];
			$detail_result 										=	$this->warranty_claim_model->add_warranty_claim_detail($warranty_claim_detail_data);
			unset($warranty_claim_detail_data);
		}

		// redirect('warranty_claim/view_warranty_claims','refresh');
	}
	public function delete_warranty_claim($warranty_claim_id)
	{
		$warranty_claim_detail 				=	$this->warranty_claim_model->get_warranty_claim_by_id($warranty_claim_id);

		unlink('files/'.$warranty_claim_detail->document_path);

		$this->warranty_claim_model->delete_warranty_claim($warranty_claim_id);

		redirect('warranty_claim/view_warranty_claims','refresh');
	}

	public function delete_warranty_claim_detail($warranty_claim_id){
		$this->warranty_claim_model->delete_warranty_claim_detail($warranty_claim_id);
	}

	//---------------------warranty_claim SECTION ENDS HERE

	//-------------------- warranty_claim_approval SECTION

	public function warranty_claim_approval_1()
	{
		$data								=	array();
		$data['page_title']					=	"Inventory Management";
		$nav_data['dev_key']				=	"warranty_claim_approval";
		$nav_data['selected']				=	"approval_1";
		$nav_data['company_name']   		=   $this->company_model->get_company_by_id(1)->company_name;
		$nav_data['user_permission'] 		=	$this->module_model->get_permission_by_user_id($this->session->userdata('user_id'));

		$warranty_claim_data								=	array();
		$warranty_claim_data['waiting_list']				=	$this->warranty_claim_model->get_warranty_claim_by_status($approval_status = 0);
		// echo '<pre>';print_r($warranty_claim_data['waiting_list']);echo '</pre>';exit();
		$warranty_claim_data['approved_list']				=	$this->warranty_claim_model->get_warranty_claim_by_status($approval_status = 1);
		$warranty_claim_data['denied_list']					=	$this->warranty_claim_model->get_warranty_claim_by_status($approval_status = -1);
		$warranty_claim_data['wc_type_list']				=	$this->warranty_claim_model->get_all_warranty_claim_types();
		$warranty_claim_data['permission']					= 	$this->module_model->get_permission_by_module_id_and_user_id(22,$this->session->userdata('user_id'));
		$warranty_claim_data['url']							=	'approve_warranty_claim_1';

		$data['navigation']									=	$this->load->view('templates/navigation',$nav_data,TRUE);
		$data['footer']										=	$this->load->view('templates/footer','',TRUE);
		$data['content']									=	$this->load->view('partials/warranty_claim_approval',$warranty_claim_data,TRUE);

		$this->load->view('templates/main_template',$data);
	}

	public function warranty_claim_approval_2()
	{
		$data								=	array();
		$data['page_title']					=	"Inventory Management";
		$nav_data['dev_key']				=	"warranty_claim_approval";
		$nav_data['selected']				=	"approval_2";
		$nav_data['company_name']   		=   $this->company_model->get_company_by_id(1)->company_name;
		$nav_data['user_permission'] 		=	$this->module_model->get_permission_by_user_id($this->session->userdata('user_id'));

		$warranty_claim_data								=	array();
		$warranty_claim_data['waiting_list']				=	$this->warranty_claim_model->get_warranty_claim_by_status($approval_status = 1);
		$warranty_claim_data['approved_list']				=	$this->warranty_claim_model->get_warranty_claim_by_status($approval_status = 2);
		$warranty_claim_data['denied_list']					=	$this->warranty_claim_model->get_warranty_claim_by_status($approval_status = -2);
		$warranty_claim_data['wc_type_list']				=	$this->warranty_claim_model->get_all_warranty_claim_types();
		$warranty_claim_data['permission']					= 	$this->module_model->get_permission_by_module_id_and_user_id(23,$this->session->userdata('user_id'));
		$warranty_claim_data['url']							=	'warranty_claim_approval_2';

		$data['navigation']					=	$this->load->view('templates/navigation',$nav_data,TRUE);
		$data['footer']						=	$this->load->view('templates/footer','',TRUE);
		$data['content']					=	$this->load->view('partials/warranty_claim_approval',$warranty_claim_data,TRUE);

		$this->load->view('templates/main_template',$data);
	}

	public function warranty_claim_approval_3()
	{
		$data								=	array();
		$data['page_title']					=	"Inventory Management";
		$nav_data['dev_key']				=	"warranty_claim_approval";
		$nav_data['selected']				=	"approval_3";
		$nav_data['company_name']   		=   $this->company_model->get_company_by_id(1)->company_name;
		$nav_data['user_permission'] 		=	$this->module_model->get_permission_by_user_id($this->session->userdata('user_id'));

		$warranty_claim_data								=	array();
		$warranty_claim_data['waiting_list']				=	$this->warranty_claim_model->get_warranty_claim_by_status($approval_status = 2);
		$warranty_claim_data['approved_list']				=	$this->warranty_claim_model->get_warranty_claim_by_status($approval_status = 3);
		$warranty_claim_data['denied_list']					=	$this->warranty_claim_model->get_warranty_claim_by_status($approval_status = -3);
		$warranty_claim_data['wc_type_list']				=	$this->warranty_claim_model->get_all_warranty_claim_types();
		$warranty_claim_data['permission']					= 	$this->module_model->get_permission_by_module_id_and_user_id(24,$this->session->userdata('user_id'));
		$warranty_claim_data['url']							=	'warranty_claim_approval_3';

		$data['navigation']					=	$this->load->view('templates/navigation',$nav_data,TRUE);
		$data['footer']						=	$this->load->view('templates/footer','',TRUE);
		$data['content']					=	$this->load->view('partials/warranty_claim_approval',$warranty_claim_data,TRUE);

		$this->load->view('templates/main_template',$data);
	}

	public function approve_warranty_claim(){
		$warranty_claim_data								=	array();

		$warranty_claim_data 								=	array();
		$warranty_claim_data['warranty_claim_id']			=	$this->input->post('warranty_claim_id','',TRUE);

		$warranty_claim 									=	$this->warranty_claim_model->get_warranty_claim_by_id($warranty_claim_data['warranty_claim_id']);

		$warranty_claim_detail 								=	$this->warranty_claim_model->get_warranty_claim_detail_by_claim_id($warranty_claim_data['warranty_claim_id']);

		// $sales_detail 										=	$this->sales_model->get_sales_by_id($warranty_claim_detail->sales_id);

		$warranty_claim_data['approval_status']				=	$warranty_claim->approval_status;

		switch ($warranty_claim_data['approval_status']) {
			case '0':
			case '-1': //-----DENIED CASE for APPROVAL 1------------
				$warranty_claim_data['authorized_user_id_1']		=	$this->session->userdata('user_id');
				$warranty_claim_data['approval_time_stamp_1']		=	date('Y-m-d G:i:s');
				$warranty_claim_data['approval_status'] 			=	1;
				$update_result 										=	$this->warranty_claim_model->update_warranty_claim($warranty_claim_data, $warranty_claim_data['warranty_claim_id']);

				if($update_result != 0){
					redirect('warranty_claim/warranty_claim_approval_1'); 
				}
				break;
						
			case '1':
			case '-2': //-----DENIED CASE for APPROVAL 2------------
				$warranty_claim_data['authorized_user_id_2']		=	$this->session->userdata('user_id');
				$warranty_claim_data['approval_time_stamp_2']		=	date('Y-m-d G:i:s');
				$warranty_claim_data['approval_status'] 			=	2;
				$update_result 										=	$this->warranty_claim_model->update_warranty_claim($warranty_claim_data, $warranty_claim_data['warranty_claim_id']);

				if($update_result != 0){
					foreach($warranty_claim_detail as $value){
						$this->update_stock_quantity ($warranty_claim->warranty_claim_type_id, $warranty_claim->sales_id, $warranty_claim->warehouse_id, $value->item_id, $value->quantity);
					}
					
					redirect('warranty_claim/warranty_claim_approval_2');
				}
				break;
			
			case '2':
			case '-3': //-----DENIED CASE for APPROVAL 2------------
				$warranty_claim_data['authorized_user_id_2']		=	$this->session->userdata('user_id');
				$warranty_claim_data['approval_time_stamp_2']		=	date('Y-m-d G:i:s');
				$warranty_claim_data['approval_status'] 			=	3;
				$update_result 										=	$this->warranty_claim_model->update_warranty_claim($warranty_claim_data, $warranty_claim_data['warranty_claim_id']);

				if($update_result != 0){
					redirect('warranty_claim/warranty_claim_approval_2');
				}
				break;
			
			default :
				break;
		}
		
	}

	public function deny_warranty_claim(){
		$warranty_claim_data								=	array();

		$warranty_claim_data 								=	array();
		$warranty_claim_data['warranty_claim_id']			=	$this->input->post('warranty_claim_id','',TRUE);

		$comment 											=	$this->input->post('comment','',TRUE);

		$warranty_claim_detail 								=	$this->warranty_claim_model->get_warranty_claim_by_id($warranty_claim_data['warranty_claim_id']);

		switch ($warranty_claim_detail->approval_status) {
			case '0':
				$warranty_claim_data['authorized_user_id_1']		=	$this->session->userdata('user_id');
				$warranty_claim_data['comment_1']					=	$comment;
				$warranty_claim_data['approval_time_stamp_1']		=	date('Y-m-d G:i:s');
				$warranty_claim_data['approval_status']				=	-1;
				$update_result 										=	$this->warranty_claim_model->update_warranty_claim($warranty_claim_data, $warranty_claim_data['warranty_claim_id']);

				if($update_result != 0){
					redirect('warranty_claim/warranty_claim_approval_1');
				}
				break;
			
			case '1':
				$warranty_claim_data['authorized_user_id_2']		=	$this->session->userdata('user_id');
				$warranty_claim_data['comment_2']					=	$comment;
				$warranty_claim_data['approval_time_stamp_2']		=	date('Y-m-d G:i:s');
				$warranty_claim_data['approval_status']				=	-2;
				$update_result 										=	$this->warranty_claim_model->update_warranty_claim($warranty_claim_data, $warranty_claim_data['warranty_claim_id']);

				if($update_result != 0){
					redirect('warranty_claim/warranty_claim_approval_2');
				}
				break;

			case '2':
				$warranty_claim_data['authorized_user_id_3']		=	$this->session->userdata('user_id');
				$warranty_claim_data['comment_3']					=	$comment;
				$warranty_claim_data['approval_time_stamp_3']		=	date('Y-m-d G:i:s');
				$warranty_claim_data['approval_status']				=	-3;
				$update_result 										=	$this->warranty_claim_model->update_warranty_claim($warranty_claim_data, $warranty_claim_data['warranty_claim_id']);

				if($update_result != 0){
					redirect('warranty_claim/warranty_claim_approval_3');
				}
				break;
			default :
				break;
		}
		
	}

	public function update_stock_quantity ($warranty_claim_type_id, $sales_id, $warehouse_id, $item_id, $quantity) {

		// Sales Return
		if($warranty_claim_type_id == 5){ 

			$this->sales_model->subtract_item_quantity_from_sales_detail($sales_id, $item_id, $quantity);
		
			$this->item_model->add_item_quantity($item_id, $quantity);

			$this->stock_model->add_stock_quantity($item_id, $warehouse_id, $quantity);
		}
		// DWP - Defective During Warranty Period
		if($warranty_claim_type_id == 2 || $warranty_claim_type_id == 1){

			$this->item_model->subtract_item_quantity($item_id, $quantity);

			$this->stock_model->subtract_stock_quantity($item_id, $warehouse_id, $quantity);

			$this->item_model->add_broken_item_quantity($item_id, $quantity);

			$this->stock_model->add_broken_stock_quantity($item_id, $warehouse_id, $quantity);
		}
	}
	//-------------------- warranty_claim_approval SECTION ENDS HERE
	public function print_warranty_claim ($warranty_claim_id) {
		$this->load->library('mypdf');
		$pdf = $this->mypdf->load();

		$warranty_claim_data							=	array();
		
		$warranty_claim_data['warranty_claim']			=	$this->warranty_claim_model->get_warranty_claim_by_id($warranty_claim_id);
		$warranty_claim_data['warranty_claim_detail']	=	$this->warranty_claim_model->get_warranty_claim_detail_by_claim_id($warranty_claim_id);
		$warranty_claim_data['price_detail']			=	$this->warranty_claim_model->get_warranty_claim_total_by_claim_id($warranty_claim_id);
		$warranty_claim_data['item_list']				=	$this->sales_model->get_items_by_sales_id($warranty_claim_data['warranty_claim']->sales_id);
		$warranty_claim_data['wc_detail_summary']		=	$this->warranty_claim_model->get_warranty_claim_detail_summary_claim_id($warranty_claim_id);	
		

		$warranty_claim_data['customer_list']			=	$this->customer_model->get_all_customers();
		$warranty_claim_data['sales_list']				=	$this->sales_model->get_all_sales();
		$warranty_claim_data['wc_type_list']			=	$this->warranty_claim_model->get_all_warranty_claim_types();

		$data 							= 	$this->load->view('partials/warranty_claim_print',$warranty_claim_data,TRUE);
		$pdf->writeHTML($data);
		$pdf->Output();
	}

	//---------------------- AJAX SECTION
	
	public function ajax_get_all_items(){
		$item_list 				=	$this->item_model->get_all_items();
		echo json_encode($item_list);
		// a die here helps ensure a clean ajax call
		die();
	}

	public function ajax_get_item_list_by_sales_id(){
		$sales_id = $this->input->post('sales_id');

		$item_list 				=	$this->warranty_claim_model->get_item_by_sales_id($sales_id);

		echo json_encode($item_list);
		// a die here helps ensure a clean ajax call
		die();
	}
	
	public function ajax_get_preloaded_item_list_by_sales_id(){
		$sales_id = $this->input->post('sales_id');

		$item_list 				=	$this->warranty_claim_model->get_preloaded_item_by_sales_id($sales_id);

		echo json_encode($item_list);
		// a die here helps ensure a clean ajax call
		die();
	}

	public function ajax_count_item(){
		$count						=	$this->input->post('count',TRUE);

		$data 						=	array();
		$data['count']				=	$count+1;
		$data['error_content']		=	$this->load->view('partials/form_validation_tag',$data,TRUE);

		// $error_message			=	$count +1;
        echo json_encode($data['error_content']);
	}

	

	
}
