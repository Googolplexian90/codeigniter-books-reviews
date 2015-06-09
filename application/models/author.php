<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Author extends CI_Model {
  public function find($id){
  	return $this->db->query('SELECT * FROM authors WHERE id=?',array($id))->row();
  }
  public function get() {
  	return $this->db->get('authors')->result();
  }
  public function create($author) {
  	$values = explode(' ',$author,2);
  	if(count($values)<2){
  		return false;
  	}
  	//Force cleaning of values
  	ucwords($values[0]);
  	ucwords($values[1]);

  	//OK, now we can insert into the db
    $query = 'INSERT INTO authors(first_name,last_name,created_at,updated_at) VALUES(?,?,NOW(),NOW())';
    $insert = array('first_name'=>$values[0],'last_name'=>$values[1]);
  	if($this->db->query($query,$insert)){
      return $this->db->order_by('id','desc')->get('authors')->row();
    }
    else {
      return false;
    }
  }
}

// end of Author model