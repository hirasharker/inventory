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
		$this->load->model('sales_model','sales_model',TRUE);
		$this->load->library('form_validation');
		$this->load->model('company_model','company_model',TRUE);
		$this->load->model('convert_model','convert_model',TRUE);
		$this->load->model('module_model','module_model',TRUE);
		$this->load->model('upload_model','upload_model',TRUE);
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
	public function index($warranty_claim_id = 0)
	{
		$data							=	array();
		$data['page_title']				=	"Inventory Management";
		$nav_data['dev_key']			=	"warranty_claim";
		$nav_data['selected']			=	"add_warranty_claim";
		$nav_data['company_name']   	=   $this->company_model->get_company_by_id(1)->company_name;
		$nav_data['user_permission'] 	=	$this->module_model->get_permission_by_user_id($this->session->userdata('user_id'));

		$warranty_claim_data					=	array();
		if($warranty_claim_id!=0){
			$warranty_claim_data['warranty_claim']		=	$this->warranty_claim_model->get_warranty_claim_by_id($warranty_claim_id);	
		}else{
			$warranty_claim_data['warranty_claim']		=	NULL;
		}

		$warranty_claim_data['item_list']				=	$this->item_model->get_all_items();
		$warranty_claim_data['sales_list']				=	$this->sales_model->get_all_sales();
		$warranty_claim_data['wc_type_list']			=	$this->warranty_claim_model->get_all_warranty_claim_types();

		$data['navigation']				=	$this->load->view('templates/navigation',$nav_data,TRUE);
		$data['footer']					=	$this->load->view('templates/footer','',TRUE);
		$data['content']				=	$this->load->view('partials/warranty_claim',$warranty_claim_data,TRUE);

		$this->load->view('templates/main_template',$data);
	}
	public function view_warranty_claims()
	{
		$data								=	array();
		$data['page_title']					=	"Inventory Management";
		$nav_data['dev_key']				=	"warranty_claim";
		$nav_data['selected']				=	"all_warranty_claims";
		$nav_data['company_name']   		=   $this->company_model->get_company_by_id(1)->company_name;
		$nav_data['user_permission'] 		=	$this->module_model->get_permission_by_user_id($this->session->userdata('user_id'));

		$warranty_claim_data								=	array();
		$warranty_claim_data['warranty_claim_list']			=	$this->warranty_claim_model->get_all_warranty_claims();
		$warranty_claim_data['wc_type_list']				=	$this->warranty_claim_model->get_all_warranty_claim_types();
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

		$warranty_claim_data['item_id']							=	$this->input->post('item_id','',TRUE);
		$warranty_claim_data['item_serial_no']					=	$this->input->post('item_serial_no','',TRUE);
		$warranty_claim_data['sales_id']						=	$this->input->post('sales_id','',TRUE);
		$warranty_claim_data['warranty_claim_type_id']			=	$this->input->post('warranty_claim_type_id','',TRUE);
		$warranty_claim_data['buyer_complain']					=	$this->input->post('buyer_complain','',TRUE);
		$warranty_claim_data['observation_note']				=	$this->input->post('observation_note','',TRUE);
		$warranty_claim_data['quantity']						=	$this->input->post('quantity','',TRUE);
		$warranty_claim_data['warranty_claim_date']				=	$this->input->post('warranty_claim_date','',TRUE);

		$document_upload										=	$this->upload_model->upload_file('document_path','files'); //after upload
		if(isset($document_upload['file_name'])){
			$warranty_claim_data['document_path'] 					=	$document_upload['file_name'];
		}else{
			$sdata=array();
			$sdata['upload_error'] = $document_upload['error'];
			$this->session->set_userdata($sdata);
		}

		$result								=	$this->warranty_claim_model->add_warranty_claim($warranty_claim_data);

		redirect('warranty_claim/view_warranty_claims','refresh');
	}

	public function update_warranty_claim()
	{
		$warranty_claim_data						=	array();
		$warranty_claim_data['user_id']				=	$this->session->userdata('user_id');
		$warranty_claim_data['user_name']			=	$this->session->userdata('user_name');
		$warranty_claim_data['warranty_claim_id']			=	$this->input->post('warranty_claim_id','',TRUE);
		$warranty_claim_data['warranty_claim_name']			=	$this->input->post('warranty_claim_name','',TRUE);
		$warranty_claim_data['warranty_claim_category']		=	$this->input->post('warranty_claim_category','',TRUE);
		$warranty_claim_data['present_address']				=	$this->input->post('present_address','',TRUE);
		$warranty_claim_data['phone_no']			=	$this->input->post('phone_no','',TRUE);

		$result								=	$this->warranty_claim_model->update_warranty_claim($warranty_claim_data,$warranty_claim_data['warranty_claim_id']);

		redirect('warranty_claim/view_warranty_claims','refresh');
	}
	public function delete_warranty_claim($warranty_claim_id)
	{
		
		$this->warranty_claim_model->delete_warranty_claim($warranty_claim_id);

		redirect('warranty_claim/view_warranty_claims','refresh');
	}

	//---------------------warranty_claim SECTION ENDS HERE

	//---------------------- AJAX SECTION
	
	public function ajax_get_item_list_by_sales_id(){
		$sales_id = $this->input->post('sales_id');

		$item_list 				=	$this->warranty_claim_model->get_item_by_sales_id($sales_id);

		echo json_encode($item_list);
		// a die here helps ensure a clean ajax call
		die();
	}

	
}
