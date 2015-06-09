<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$this->load->view('partials/header',array('title'=>'Books Reviewer &ndash; Welcome!'));
		$this->load->view('partials/splash');
		$this->load->view('partials/footer');	
	}
	public function login(){
			$this->load->view('partials/header',array('title'=>'Login/Registration'));
			$this->load->view('users/login');
			$this->load->view('partials/footer');	
	}
	public function guest(){
		$data = array('id'=>0,'alias'=>'Guest');
		$this->session->set_userdata('user',$data);
		redirect('/books');
	}
}

//end of main controller