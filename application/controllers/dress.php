<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dress extends CI_Controller {
	
	var $data;
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('tank_auth');
		$this->lang->load('tank_auth');
		$this->data = array();
		
		$this->userStatus();
	}
	
	private function userStatus()
	{
		$userName = '';
		if ($this->tank_auth->is_logged_in()) {
			$loggedIn = TRUE;
			$userName = $this->tank_auth->get_username();
		}else{
			$loggedIn = FALSE;
		}
		$this->data['logged_in'] = $loggedIn;
		$this->data['username'] = $userName;
	}
		
	public function index()
	{
		$this->load->model('Dressmodel', '', TRUE);
		$data = $this->data;
		$data['dresses'] = $this->Dressmodel->getAll();
		
		$data['page_title'] = 'Dress Catalogue';
		$this->load->view('header', $data);
		$this->load->view('all_dresses', $data);
		$this->load->view('footer');
	}
	
	public function view($id)
	{
		// NOTE: could use Codeigniter built in url matching from routes here
		if(preg_match( '/^[0-9]+$/', $id) == FALSE){
			redirect(base_url());
		}
		
		$this->load->model('Dressmodel', '', TRUE);
		$data = $this->data;
		$dressDetails = $this->Dressmodel->getOne($id);
		if($dressDetails == FALSE){
			redirect(base_url());
		}
		$data['dress'] = $dressDetails;
		$data['page_title'] = $dressDetails->name . ' > Dress Details';
		$this->load->view('header', $data);
		$this->load->view('dress_detail', $data);
		$this->load->view('footer');
	}
	
	public function star($id)
	{
		// NOTE: could use Codeigniter built in url matching from routes here
		if(preg_match( '/^[0-9]+$/', $id) == FALSE){
			redirect(base_url());
		}
		
		$data = $this->data;
		if ($data['logged_in'] == FALSE){
			redirect('/auth/login');
		}
		$userId = $this->tank_auth->get_user_id();
		
		$this->load->model('Dressmodel', '', TRUE);
		$dressDetails = $this->Dressmodel->favouriteDress($userId, $id);
		
		redirect('/dress/view/' . $id);
	}
	
	public function favourites()
	{
		$data = $this->data;
		if ($data['logged_in'] == FALSE){
			redirect('/auth/login');
		}
		$userId = $this->tank_auth->get_user_id();
		
		$this->load->model('Dressmodel', '', TRUE);
		$data['dresses'] = $this->Dressmodel->getFavourites($userId);
		
		$data['page_title'] = 'Your Favourites';
		$this->load->view('header', $data);
		$this->load->view('all_dresses', $data);
		$this->load->view('footer');
	}
}