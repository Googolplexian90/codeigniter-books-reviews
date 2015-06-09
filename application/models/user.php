<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Model {
	public function validate_user($form){
		$query = 'SELECT * FROM users WHERE email=?';
		$value = [$form['email']];
		$user = $this->db->query($query,$value)->row();
		if(!empty($user)){
			$password = $this->encrypt($form['password'],$user->password);
			if($password != $user->password){
				$user = false;
			}
		}
		else {
			$user = false;
		}
		return $user;
	}
	public function create($form){
		$errors = [];
		if(empty($form['name'])){
			//Name is required
			array_push($errors,'Name is required.');
		}
		else {
			ucwords($form['name']);
		}
		if(empty($form['alias'])){
			//Take the first name, if an alias hasn't been given
			$t = explode(' ',$form['name']);
			$form['alias'] = $t[0];
		}
		if(empty($form['email'])){
			//Email is required
			array_push($errors,'Email is required.');
		}
		else{
			if(preg_match('/\A([^@\s]+)@((?:[-a-z0-9]+\.)+[a-z]+)\z/i',$form['email'])===0){
				//Not a valid email
				array_push($errors,'The email provided is not in a valid format.');
			}
			else {
				//Email is valid, force lowercase letters
				strtolower($form['email']);
			}
		}
		if(empty($form['password'])){
			//Password is required
			array_push($errors,'Password is required.');
		}
		else {
			if($form['password']!=$form['confirm']){
				//Password confirmation failed
				array_push($errors,'The password and password confirmation fields do not match.');
			}
			if(strlen($form['password'])<8){
				//Password is too short
				array_push($errors,'Password must be at least 8 characters.');
			}
		}

		//Validations done, check for errors
		if(empty($errors)){
			//We need to make sure the email isn't taken already. Then, we can save to the db
			$check = $this->db->get_where('users',array('email'=>$form['email']))->row();
			if(empty($check)){
				$values = array('name'=>$form['name'],'alias'=>$form['alias'],'email'=>$form['email']);
				$values['password'] = $this->encrypt($form['password']);
				$this->db->query('INSERT INTO users(name,alias,email,password,created_at,updated_at) VALUES(?,?,?,?,NOW(),NOW())',$values);
				return $this->db->query('SELECT * FROM users ORDER BY id DESC')->row();
			}
			else {
				return array('This email is already registered.');
			}
		}
		else{
			return array('valid'=>false,'errors'=>$errors);
		}
	}
	public function find($id){
		return $this->db->query('SELECT * FROM users WHERE id=?',array($id))->row();
	}
	public function find_user($id){
		return $this->db->query('SELECT id,alias FROM users WHERE id=?',array($id))->row();
	}

	private function encrypt( $password, $salt=null ){
		if(!$salt){
			$salt = bin2hex( openssl_random_pseudo_bytes(22) );
		}
		return crypt($password,$salt);
	}
}

// end of User model