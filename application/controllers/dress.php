<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dress extends CI_Controller {
	
	public function index()
	{
		#TODO? refactor to call this getAll and use routes to set this as the index?
		$this->load->model('Dressmodel', '', TRUE);
		$data['dresses'] = $this->Dressmodel->get_all();
		//prd($dresses);
		$data['page_title'] = 'Dress Catalogue';
		//$this->load->view('header', $data);
		//$this->load->view('menu');
		$this->load->view('all_dresses', $data);
		//$this->load->view('footer');
	}
}