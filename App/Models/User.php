<?php

namespace App\Models;

use MF\Model\Model;

class user extends Model {

	private $id;
	private $type;
	private $name;
	private $email;
	private $password;

	public function __get($attr) {
		return $this->$attr;
	}

	public function __set($attr, $value) {
		$this->$attr = $value;
	}

	public function login() {
		$query = "select id, type, name, email from users where email = :email and password = :password";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':email', $this->__get('email'));
		$stmt->bindValue(':password', $this->__get('password'));
		$stmt->execute();

		$user = $stmt->fetch(\PDO::FETCH_ASSOC);

		if($user['id'] != '' && $user['name'] != '') {			
			$this->__set('id', $user['id']);			
			$this->__set('type', $user['type']);			
			$this->__set('name', $user['name']);
		}

		return $this;

	}

	public function deleteStage($id_user_seguindo) {
		$query = "delete from tweets where id_users = :id_user and id = :tweet_id";

		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id_user', $this->__get('id'));
		$stmt->bindValue(':tweet_id', $tweet['id']);
		$stmt->execute();

		return true;

	}

}

?>