<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Payment extends CI_Controller {
	public function __construct(){
		parent:: __construct();
		if($this->session->userdata('user_id')==NULL){
			redirect('login','refresh');
		}
		$this->load->model('purchase_model','purchase_model',TRUE);
		$this->load->model('item_model','item_model',TRUE);
		$this->load->model('payment_model','payment_model',TRUE);
		$this->load->model('module_model','module_model',TRUE);
		$this->load->model('company_model','company_model',TRUE);
		$this->load->library('form_validation');
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
	public function index($payment_id=0)
	{
		$permission 	=	$this->module_model->get_permission_by_module_id_and_user_id(6, $this->session->userdata('user_id')); // module_id for bank is 20.....
		if($permission->permission_add != 1){
			redirect('access_control/denied/payment/add_payment','refresh');
		}
		$data							=	array();
		$data['page_title']				=	"Inventory Management";

		$nav_data						=	array();
		$nav_data['dev_key']			=	"payment";
		$nav_data['selected']			=	"add_payment";
		$nav_data['company_name']   	=   $this->company_model->get_company_by_id(1)->company_name;
		$nav_data['user_permission']=	$this->module_model->get_permission_by_user_id($this->session->userdata('user_id'));

		$payment_data					=	array();
		$payment_data['item_list']		=	$this->item_model->get_all_items();
		if($payment_id!=0){
			$payment_data['payment']	=	$this->payment_model->get_payment_by_id($payment_id);
		}else{
			$payment_data['payment']	=	NULL;
		}

		$data['navigation']				=	$this->load->view('templates/navigation',$nav_data,TRUE);
		$data['footer']					=	$this->load->view('templates/footer','',TRUE);
		$data['content']				=	$this->load->view('partials/payment',$payment_data,TRUE);

		$this->load->view('templates/main_template',$data);
	}

	public function generate_purchase_id(){
		if (isset($_GET['term'])){
	      $purchase_id = strtolower($_GET['term']);
	      $this->purchase_model->get_purchase_like_id($purchase_id);
	    }
	}

	public function view_payments()
	{
		$permission 	=	$this->module_model->get_permission_by_module_id_and_user_id(6, $this->session->userdata('user_id')); // module_id for bank is 20.....
		if($permission->permission_view != 1){
			redirect('access_control/denied/payment/all_payments','refresh');
		}
		$data							=	array();
		$data['page_title']				=	"Inventory Management";
		$nav_data['dev_key']			=	"payment";
		$nav_data['selected']			=	"all_payments";
		$nav_data['company_name']   	=   $this->company_model->get_company_by_id(1)->company_name;
		$nav_data['user_permission']=	$this->module_model->get_permission_by_user_id($this->session->userdata('user_id'));

		$payment_data					=	array();
		$payment_data['payment_list']	=	$this->payment_model->get_all_payments();
		$payment_data['permission']		= 	$this->module_model->get_permission_by_module_id_and_user_id(6,$this->session->userdata('user_id'));

		$data['navigation']				=	$this->load->view('templates/navigation',$nav_data,TRUE);
		$data['footer']					=	$this->load->view('templates/footer','',TRUE);
		$data['content']				=	$this->load->view('partials/payment_list',$payment_data,TRUE);

		$this->load->view('templates/main_template',$data);
	}

	public function add_payment()
	{
		$permission 	=	$this->module_model->get_permission_by_module_id_and_user_id(6, $this->session->userdata('user_id')); // module_id for bank is 20.....
		if($permission->permission_add != 1){
			redirect('access_control/denied/payment/add_payment','refresh');
		}
		$payment_data						=	array();
		$payment_data['user_id']			=	$this->session->userdata('user_id');
		$payment_data['user_name']			=	$this->session->userdata('user_name');
		$payment_data['purchase_id']		=	$this->input->post('purchase_id','',TRUE);
		$purchase							=	$this->purchase_model->get_purchase_by_id($payment_data['purchase_id']);
		$payment_data['vendor_id']			=	$purchase->vendor_id;
		$payment_data['vendor_name']		=	$purchase->vendor_name;
		$payment_data['paid_amount']		=	$this->input->post('paid_amount','',TRUE);
		$payment_data['payment_date']		=	$this->input->post('payment_date','',TRUE);

		$this->form_validation->set_rules('purchase_id', 'Purchase Id', 'required|integer');
		$this->form_validation->set_rules('paid_amount', 'Paid amount', 'required|numeric');
		$this->form_validation->set_rules('payment_date', 'payment date', 'required');

        if ($this->form_validation->run() != FALSE) {
			$result							=	$this->payment_model->add_payment($payment_data);
			redirect('payment/view_payments','refresh');
		}else{
			$this->index();
		}
	}

	public function update_payment($payment_id)
	{
		$permission 	=	$this->module_model->get_permission_by_module_id_and_user_id(6, $this->session->userdata('user_id')); // module_id for bank is 20.....
		if($permission->permission_edit != 1){
			redirect('access_control/denied/payment/add_payment','refresh');
		}
		$payment_data						=	array();
		$payment_data['user_id']			=	$this->session->userdata('user_id');
		$payment_data['user_name']			=	$this->session->userdata('user_name');
		$payment_data['purchase_id']		=	$this->input->post('purchase_id','',TRUE);
		$purchase							=	$this->purchase_model->get_purchase_by_id($payment_data['purchase_id']);
		$payment_data['vendor_id']			=	$purchase->vendor_id;
		$payment_data['vendor_name']		=	$purchase->vendor_name;
		$payment_data['paid_amount']		=	$this->input->post('paid_amount','',TRUE);
		$payment_data['payment_date']		=	$this->input->post('payment_date','',TRUE);

		$this->form_validation->set_rules('purchase_id', 'Purchase Id', 'required|integer');
		$this->form_validation->set_rules('paid_amount', 'Paid amount', 'required|numeric');
		$this->form_validation->set_rules('payment_date', 'payment date', 'required');

        if ($this->form_validation->run() != FALSE) {

			$result							=	$this->payment_model->update_payment($payment_data,$payment_id);
			redirect('payment/view_payments','refresh');
		}else{
			$this->index();
		}
	}
	public function delete_payment($payment_id)
	{
		$permission 	=	$this->module_model->get_permission_by_module_id_and_user_id(6, $this->session->userdata('user_id')); // module_id for bank is 20.....
		if($permission->permission_delete != 1){
			redirect('access_control/denied/payment/all_payments','refresh');
		}
		
		$this->payment_model->delete_payment($payment_id);

		redirect('payment/view_payments','refresh');
	}
}
