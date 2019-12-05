<?php

class Crud extends CI_Model {
	function login($username,$password){
		$this->db->where('username',$username);
		$this->db->where('password',$password);

		$query = $this->db->get('user');
		if($query->num_rows()==1){
			return $query->result();
		} else {
			return false;
		}
	}

	function cek_user($user){
		return $this->db
			->where('username', $user)
			->get('user');
	}

	function create($data,$type) {
		$type_table = $type;
		$this->db->insert($type_table, $data);
	}

	function free_read($sql){
		$query = $this->db->query("SELECT ".$sql);
		return $query->result();
	}

	function free_query($sql){
		$query = $this->db->query($sql);
		return $query->result();
	}

	function read($tbl,$typewhere='',$where='',$limit='') {
		if(!empty($typewhere) || !empty($where)){
			$this->db->where($typewhere, $where);
		}
		if(!empty($limit)){
			$this->db->limit($limit);
		}

		$this->db->order_by('date','desc');
		$query = $this->db->get($tbl);
        return $query->result();
	}

	function read2($tbl,$limit='',$typewhere='',$where='',$typewhere2="",$where2="") {
		if(!empty($typewhere) || !empty($where)){
			$this->db->where($typewhere, $where);
		}
		if(!empty($typewhere2) || !empty($where2)){
			$this->db->where($typewhere2, $where2);
		}
		if(!empty($limit)){
			$this->db->limit($limit);
		}

		$this->db->order_by('date','desc');
		$query = $this->db->get($tbl);
        return $query->result();
	}

	// function blog_detail($slug="") {
	// 	if(!empty($slug)){
	// 		$this->db->like('slug', $slug);
	// 	}

	// 	$this->db->limit(1);
	// 	$this->db->order_by('date','desc');
	// 	return $this->db->get('blog');
	// }


	function blog_detail($slug) {
		if(!empty($slug)){
			$this->db->where('slug', $slug);
		}

		$this->db->limit(1);
		$this->db->order_by('date','desc');
		return $this->db->get('blog');
	}

	function count($tbl, $typewhere="",$where="", $typewhere2="",$where2=""){
		if(!empty($typewhere) || !empty($where)){
			$this->db->where($typewhere, $where);
		}
		if(!empty($typewhere2) || !empty($where2)){
			$this->db->where($typewhere2, $where2);
		}

		$cek = $this->db->get($tbl);
        return $cek->num_rows();
	}

	function read_id($type,$id) {
		$this->db->where('id', $id);
		$query = $this->db->get($type);
		return $query->row();
	}

	function update($data,$type,$id) {
		$this->db->where('id', $id);
		$this->db->update($type, $data);
	}

	function update_message($id){
		$data = array( 'status' => 'READ' );
		$this->db->where('id', $id);
		$this->db->update('message', $data);
	}

	function freeUpdate($sql) {
		$this->db->query("UPDATE ".$sql);
	}

	function delete($type, $id) {
		$this->db->where('id', $id);
		$this->db->delete($type);
	}

	function truncate($type){
		$this->db->truncate($type);
	}

	private function get_ip() {
		if (isset($_SERVER['HTTP_CLIENT_IP'])) {
			return $_SERVER['HTTP_CLIENT_IP'];
		} elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			return $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			return (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '');
		}
	}

	function visitor(){
		$ip=get_ip();
		$cek_ip = $this->db->where('ip',$ip)->get('visitor')->num_rows();
		if($cek_ip == 0){
			$query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));

			if($query && $query['status'] == 'success') {
				$data= array(
					'ip' => $ip,
					'country' => $query['country'],
					'country_code' => $query['countryCode'],
					'hits' => 1,
				);

				$this->db->insert('visitor', $data);

				return "success adding ip address";
			} 
			else
			{
				return 'Something is wrong !';	
			}
		} else {
			$where = array('ip' => $ip);
			$hits = $this->db->where('ip',$ip)->limit(1)->get('visitor')->row();
			$hits = $hits + 1;
			$data = array('hits' => $hits);
			$this->db->update('visitor', $data, $where);

			return "success updating hits in ip address";
		}
	}

}

?>