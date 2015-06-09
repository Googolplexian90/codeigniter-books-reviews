<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Books extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Review');
		$this->load->model('Book');
		$this->load->model('Author');
	}

	// View Controllers
	public function index()
	{
		$this->load->view('partials/header',array('title'=>'Books Home'));
		$reviews = $this->Review->get_recent();
		$books = $this->Book->get();
		$this->load->view('books/index',array('reviews'=>$reviews,'books'=>$books));
		$this->load->view('partials/footer',array('authors'=>$this->Author->get()));
	}
	public function show($id)
	{
		$data = array('book'=>null,'reviews'=>null);
		$data['book'] = $this->Book->find($id);
		$data['reviews'] = $this->Review->find_by_book($id);
		$this->load->view('partials/header',array('title'=>'Reviews for '.$data['book']->title));
		$this->load->view('books/show',$data);
		$this->load->view('partials/footer',array('authors'=>$this->Author->get()));
	}

	// Logic Controllers
	public function create(){
		$form = $this->input->post(null,true);
		if(!empty($form['new_author'])){
			$this->load->model('Author');
			$form['author'] = $this->Author->create($form['new_author']);
		}
		$book = array('title'=>$form['title'],'author_id'=>$form['author']);
		$b = $this->Book->create($book);
		$review = array('user_id'=>$this->session->userdata('user')['id'],'book_id'=>$b->id,'rating'=>$form['rating'],'review'=>$form['review']);
		var_dump($review);
		$r = $this->Review->create($review);
		var_dump($r);
		die();
	}
	public function update(){}
	public function destroy(){}
}

// end of books controller