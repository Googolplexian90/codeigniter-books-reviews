<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		if($this->session->userdata('user')){
			//Logged in, showing home page
			$this->load->model('Book');
			$this->load->model('Review');
			$this->load->model('Author');
			$data = array('reviews'=>$this->Review->get_recent(),'books'=>$this->Book->get())
			$this->load->view('partials/header',array('title'=>'Home'));
			$this->load->view('books/index',$data);
			$this->load->view('partials/footer',array('authors'=>$this->Author->get()));
		} else {
			//Not logged in, loading sign-in screen
			$this->load->view('partials/header',array('title'->'Books Reviewer &ndash; Welcome!'));
			$this->load->view('users/login');
			$this->load->view('partials/footer');
		}
	}
}

//end of main controller