<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dress extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		//$this->load->library('form_validation');
		//$this->load->library('security');
		$this->load->library('tank_auth');
		$this->lang->load('tank_auth');
	}
		
	public function index()
	{
		#TODO: move this to the constructor? shall we use $this->data instead? Maybe we could set header there
		$userName = '';
		if ($this->tank_auth->is_logged_in()) {
			$loggedIn = TRUE;
			$userName = $this->tank_auth->get_username();
		}else{
			$loggedIn = FALSE;
		}
		
		#TODO? refactor to call this getAll and use routes to set this as the index?
		$this->load->model('Dressmodel', '', TRUE);
		$data['dresses'] = $this->Dressmodel->get_all();
		$data['page_title'] = 'Dress Catalogue';
		#TODO? can we assign all of these together?
		$data['logged_in'] = $loggedIn;
		$data['username'] = $userName;
		
		$this->load->view('header', $data);
		$this->load->view('all_dresses', $data);
		$this->load->view('footer');
	}
	
	public function view($id)
	{
		#TODO: could use Codeigniter built in url matching from routes here
		if(preg_match( '/^[0-9]+$/', $id) == FALSE){
			redirect(base_url());
		}
		
		#TODO: lookup dress in DB here
		$this->load->model('Dressmodel', '', TRUE);
		$data['dresses'] = $this->Dressmodel->get_all();
		
		#TODO: get user info here (can we put in constructor?)
		$this->load->view('header', $data);
		$this->load->view('dress_detail', $data);
		$this->load->view('footer');
	}
}