<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Vat_Tax extends CI_Controller {
	
	public function __construct(){
		parent:: __construct();
		if($this->session->userdata('user_id')==NULL){
			redirect('login','refresh');
		}
		$this->load->library('form_validation');
		$this->load->model('company_model','company_model',TRUE);
		$this->load->model('convert_model','convert_model',TRUE);
		$this->load->model('vat_tax_model','vat_tax_model',TRUE);
		$this->load->model('module_model','module_model',TRUE);
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
	

	//---------------------vat_tax SECTION STARTS HERE
	
	/**
	 * [index description]
	 * @param  integer $vat_tax_id [description]
	 * @return void           	[description]
	 */
	public function index($vat_tax_rule_id = 0)
	{
		$permission 	=	$this->module_model->get_permission_by_module_id_and_user_id(25, $this->session->userdata('user_id')); // module_id for vat_tax is 20.....
		if($permission->permission_add != 1){
			redirect('access_control/denied/vat_tax/add_vat_tax_rule','refresh');
		}
		$data							=	array();
		$data['page_title']				=	"Inventory Management";
		$nav_data['dev_key']			=	"vat_tax";
		$nav_data['selected']			=	"create_vat_tax_rule";
		$nav_data['company_name']   	=   $this->company_model->get_company_by_id(1)->company_name;
		$nav_data['user_permission'] 	=	$this->module_model->get_permission_by_user_id($this->session->userdata('user_id'));
		$vat_tax_data					=	array();
		if($vat_tax_rule_id!=0){
			$vat_tax_data['vat_tax_detail']		=	$this->vat_tax_model->get_vat_tax_rule_by_id($vat_tax_rule_id);	
		}else{
			$vat_tax_data['vat_tax_detail']		=	NULL;
		}

		$data['navigation']				=	$this->load->view('templates/navigation',$nav_data,TRUE);
		$data['footer']					=	$this->load->view('templates/footer','',TRUE);
		$data['content']				=	$this->load->view('partials/vat_tax',$vat_tax_data,TRUE);

		$this->load->view('templates/main_template',$data);
	}

	public function view_vat_tax_rules()
	{
		$permission 	=	$this->module_model->get_permission_by_module_id_and_user_id(25, $this->session->userdata('user_id')); // module_id for vat_tax is 20.....
		if($permission->permission_view != 1){
			redirect('access_control/denied/vat_tax/all_vat_tax_rules','refresh');
		}

		$data								=	array();
		$data['page_title']					=	"Inventory Management";
		$nav_data['dev_key']				=	"vat_tax";
		$nav_data['selected']				=	"all_vat_tax_rules";
		$nav_data['company_name']   		=   $this->company_model->get_company_by_id(1)->company_name;
		$nav_data['user_permission'] 		=	$this->module_model->get_permission_by_user_id($this->session->userdata('user_id'));

		$vat_tax_data							=	array();
		$vat_tax_data['vat_tax_rules_list']				=	$this->vat_tax_model->get_all_vat_tax_rules();
		$vat_tax_data['permission']			= 	$this->module_model->get_permission_by_module_id_and_user_id(25,$this->session->userdata('user_id'));

		$data['navigation']					=	$this->load->view('templates/navigation',$nav_data,TRUE);
		$data['footer']						=	$this->load->view('templates/footer','',TRUE);
		$data['content']					=	$this->load->view('partials/vat_tax_rules_list',$vat_tax_data,TRUE);

		$this->load->view('templates/main_template',$data);
	}

	public function add_vat_tax_rule()
	{
		$permission 	=	$this->module_model->get_permission_by_module_id_and_user_id(25, $this->session->userdata('user_id')); // module_id for vat_tax is 20.....
		if($permission->permission_add != 1){
			redirect('access_control/denied/vat_tax/all_vat_tax_rules','refresh');
		}
		$vat_tax_data						=	array();
		$vat_tax_data['user_id']			=	$this->session->userdata('user_id');
		$vat_tax_data['value_added_tax_percentage']			=	$this->input->post('value_added_tax_percentage','',TRUE);
		$vat_tax_data['tax']			=	$this->input->post('tax','',TRUE);
		$vat_tax_data['effective_date']			=	$this->input->post('effective_date','',TRUE);

		$result							=	$this->vat_tax_model->add_vat_tax_rule($vat_tax_data);

		redirect('vat_tax/view_vat_tax_rules','refresh');
	}

	public function update_vat_tax_rule()
	{
		$permission 	=	$this->module_model->get_permission_by_module_id_and_user_id(25, $this->session->userdata('user_id')); // module_id for vat_tax is 20.....
		if($permission->permission_edit != 1){
			redirect('access_control/denied/vat_tax/all_vat_tax_rules','refresh');
		}
		$vat_tax_data						=	array();

		$vat_tax_data['user_id']			=	$this->session->userdata('user_id');
		
		$vat_tax_data['vat_tax_id']			=	$this->input->post('vat_tax_id','',TRUE);
		$vat_tax_data['vat_tax_name']			=	$this->input->post('vat_tax_name','',TRUE);
		$vat_tax_data['vat_tax_code']			=	$this->input->post('vat_tax_code','',TRUE);
		$vat_tax_data['address']			=	$this->input->post('address','',TRUE);

		$result								=	$this->vat_tax_model->update_vat_tax($vat_tax_data,$vat_tax_data['vat_tax_id']);

		redirect('vat_tax/view_vat_taxs','refresh');
	}
	public function delete_vat_tax_rule($vat_tax_id)
	{
		$permission 	=	$this->module_model->get_permission_by_module_id_and_user_id(25, $this->session->userdata('user_id')); // module_id for vat_tax is 20.....
		if($permission->permission_delete != 1){
			redirect('access_control/denied/vat_tax/all_vat_tax_rules','refresh');
		}
		
		$this->vat_tax_model->delete_vat_tax_rule($vat_tax_id);

		redirect('vat_tax/view_vat_taxs','refresh');
	}

	//---------------------vat_tax SECTION ENDS HERE

	
}
