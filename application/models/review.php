<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Review extends CI_Model {
	public function find($id){
		return $this->db->find('reviews',array('id'=>$id))->row();
	}
	public function find_by_book($book_id){
		$this->load->model('User');
		$reviews = $this->db->get_where('reviews',array('book_id'=>$book_id))->result();
		foreach($reviews as $r){
			$r->user = $this->User->find_user($r->user_id);
		}
		return $reviews;
	}
	public function find_by_user($user_id){
		$this->load->model('Book');
		$reviews = $this->db->get_where('reviews',array('user_id'=>$user_id))->result();
		foreach($reviews as $r){
			$r->book = $this->Book->find($r->book_id);
		}
		return $reviews;
	}
	public function get(){
		return $this->db->get('reviews')->result();
	}
	public function get_recent(){
		$reviews = $this->db->get('reviews',5)->result();
		$this->load->model('Book');
		$this->load->model('User');
		foreach($reviews as $review){
			$review->book = $this->Book->find($review->book_id);
			$review->user = $this->User->find_user($review->user_id);
		}
		return $reviews;
	}
	public function create($form){
		$errors = [];
		if(empty($form['review'])){
			//A review is required
			array_push($errors,'The review field is required.');
		}
		if(empty($form['rating'])){
			//A rating is required
			array_push($errors,'The rating field is required.');
		}
		else {
			if(strval(intval($form['rating']))!=$form['rating']){
				//Rating is not an integer
				array_push($errors,'The rating is not a valid format');
			}
			else {
				if(intval($form['rating'])<1||intval($form['rating'])>5){
					//Rating is not a valid number
					array_push($errors,'A rating can only be between 1 to 5');
				}
			}
		}
		if(empty($errors)){
			//Valid! Save to db
			$query = 'INSERT INTO reviews(user_id,book_id,review,rating,created_at,updated_at) VALUES(?,?,?,?,NOW(),NOW())';
			$values = array($form['user_id'],$form['book_id'],$form['review'],$form['rating']);
			$this->db->query($query,$values);
			return true;
		}
		else {
			//Not Valid! Send back errors
			return $errors;
		}
	}
	public function destroy($data){
		$review = $this->db->find("id",$data['review_id'])->row();
		$book_id = $review->book_id;
		if($review->user_id==$data['user_id']){
			//Review is found, and user is valid, delete
			$this->db->delete('reviews',array('id'=>$review->id));
		}
		//Whether we succeed or fail, we want to send back the book id
		return $book_id;
	}
}
// end of Review model