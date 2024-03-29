<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Access_Control extends CI_Controller {
	public function __construct(){
		parent:: __construct();
		if($this->session->userdata('user_id')==NULL){
			redirect('login','refresh');
		}
		$this->load->model('company_model','company_model',TRUE);
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
	

	//---------------------bank SECTION STARTS HERE
	
	/**
	 * [index description]
	 * @param  integer $bank_id [description]
	 * @return void           	[description]
	 */
	public function index()
	{
	}

	public function denied($key = NULL,$selected = NULL)
	{
		$data								=	array();
		$data['page_title']					=	"Inventory Management";
		$nav_data['dev_key']				=	$key;
		$nav_data['selected']				=	$selected;
		$nav_data['company_name']   		=   $this->company_model->get_company_by_id(1)->company_name;
		$nav_data['user_permission'] 		=	$this->module_model->get_permission_by_user_id($this->session->userdata('user_id'));
		$access_data						=	array();

		$data['navigation']					=	$this->load->view('templates/navigation',$nav_data,TRUE);
		$data['footer']						=	$this->load->view('templates/footer','',TRUE);
		$data['content']					=	$this->load->view('partials/access_control',$access_data,TRUE);

		$this->load->view('templates/main_template',$data);
	}

}
