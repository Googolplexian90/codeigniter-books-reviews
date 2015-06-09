<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Book extends CI_Model {
	public function find($id){
		$this->load->model('Author');
		$book = $this->db->query('SELECT * FROM books WHERE id=?',array($id))->row();
		$book->author = $this->Author->find($book->author_id);
		return $book;
	}
	public function get() {
		return $this->db->get('books')->result();
	}
	public function create($form){
		$errors = [];
		if(empty($form['title'])){
			//Title is required
			array_push($errors,'Book Title is required.');
		}
		if(empty($form['author_id'])){
			//An author is required
			array_push($errors,'Book Author is required');
		}
		if(empty($errors)){
			//Valid form, add book now
			$query = 'INSERT INTO books(title,author_id,created_at,updated_at) VALUES(?,?,NOW(),NOW())';
			$values = array($form['title'],$form['author_id']);
			$this->db->query($query,$values);
			return $this->db->order_by('id','desc')->get('books')->row();
		}
		else{
			//Validation errors, go back
			return $errors;
		}
	}
}
// end of book model