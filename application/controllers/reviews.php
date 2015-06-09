<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reviews extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Review');
	}

	public function create($id){
		$inputs = $this->input->post(null,true);
		$inputs['user_id'] = $this->session->userdata('user')['id'];
		$inputs['book_id'] = $id;
		$check = $this->Review->create($inputs);
		if($check !== true){
			$this->session->set_flashdata('form',$inputs);
			$this->session->set_flashdata('errors',$check);
		}
		redirect('/books/' . $id);
	}
	public function delete($id){
		$data = array('review_id'=>$id,'user_id'=>$this->session->userdata('user')['id']);
		$book = $this->Review->destroy($data);
		redirect('/books/'.$book);
	}
}

//end of reviews controller