<?php

class dbHandler{

	private $dbhost = 'localhost';
	private $dbuser = 'root';
	private $dbpass = '';
	private $dbname = 'silat';

	function __construct(){
		$pdo = new PDO('mysql:dbname='.$this->dbname, $this->dbuser, $this->dbpass);
		$this->db = new NotOrm($pdo);
	}

	public function validate($api){
		$res = $this->db->user()->where('api_key', $api);
		return $res->fetch();
	}

	public function verifyLogin($user, $pass){
		$res = $this->db->user('username', $user)->where('password', $pass);
		return $res->fetch();
	}

	public function createUser($data){
		$key = $this->generateKey();
		$data['password'] = md5($data['password']);
		$data += ['api_key'=>$key];
		$result = $this->db->user()->insert($data);
		if($result) return true;
		return false;
	}

	public function updateUser($id, $data){
		$result = $this->db->user()->where('id', $id)->update($data);
		if($result) return true;
		return false;
	}

	public function deleteUser($id){
		$result = $this->db->user('id',$id)->delete();
		if($result) return true;
		return false;
	}

	public function getUsers(){
		$result = array();
		foreach($this->db->user as $user){
			$result['all'][] = array(
				'id_user'	=> $user['id'],
				'nama_user'	=> $user['nama_user'],
				'email'	=> $user['email'],
				'no_hp'		=> $user['no_hp'],
				'alamat'		=> $user['alamat'],
				'username'		=> $user['username'],
				'api_key'	=> $user['api_key']);
		}
		return $result;
	}

	public function getUserById($id){
		$result = $this->db->user('id',$id);
		return $result->fetch();
	}


	private function generateKey(){
		return md5(uniqid(rand(), true));
	}
}

?>

