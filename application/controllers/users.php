<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('User');
	}

	// View Controllers
	public function index()
	{
		$this->load->view('partials/header',array('title'=>'Welcome!'));
		$this->load->view('users/login');
		$this->load->view('partials/footer');
	}
	public function show($id)
	{
		$this->load->model('Author');
		$this->load->model('Review');
		$data = array('user'=>$this->User->find($id),'reviews'=>$this->Review->find_by_user($id));
		$this->load->view('partials/header',array('title'=>$data['user']->alias . ' Profile'));
		$this->load->view('users/show',$data);
		$this->load->view('partials/footer',array('authors'=>$this->Author->get()));
	}
	// Logic Controllers
	public function sign_in()
	{
		$user = $this->User->validate_user($this->input->post(null,true));
		if($user === false){
			$this->session->set_flashdata('error',true);
			redirect('/login');
		}
		else {
			$this->session->set_userdata('user',array('id'=>$user->id,'alias'=>$user->alias));
			redirect('/books');
		}

	}
	public function create(){
		$form = $this->input->post(null,true);
		$user = $this->User->create($form);
		if(gettype($user)=='object'){
			$this->session->set_userdata('user',array('id'=>$user->id,'alias'=>$user->alias));
			redirect('/books');
		}
		else {
			$this->session->set_flashdata('errors',$user['errors']);
			redirect('/login');
		}
	}
	public function update(){}
	public function destroy(){}
	public function sign_out()
	{
		$this->session->sess_destroy();
		redirect(base_url());
	}
}

//end of users controller