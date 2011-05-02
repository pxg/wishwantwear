<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dress extends CI_Controller {
	
	public function index()
	{
		#TODO? refactor to call this getAll and use routes to set this as the index?
		#TODO: get instance of dress model and get all dresses
		$this->load->model('Dressmodel', '', TRUE);
		$dresses = $this->Dressmodel->get_last_ten_entries();
		prd($dresses);
		#TODO: how to pass data/variables to the view?
		$data['page_title'] = 'Dress Catalogue';
		//$this->load->view('header', $data);
		//$this->load->view('menu');
		$this->load->view('all_dresses', $dresses);
		//$this->load->view('footer');
	}
}