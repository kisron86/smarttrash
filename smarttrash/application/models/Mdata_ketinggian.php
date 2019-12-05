<?php

class Mdata_ketinggian extends CI_Model {
	function getdata($id=''){
		$query = $this->db->select('*');
		$query = $this->db->from('data_ketinggian');
		$query = $this->db->join('tb_sensor', 'tb_sensor.id_sensor = data_ketinggian.id_sensor');
		$query = $this->db->where('tb_sensor.id_sensor',$id);
		$query = $this->db->order_by('log','DESC');
		$query = $query = $this->db->get();
		return $query;
	}
	function getNama($id='')
	{
		$data = $this->db->where('id_sensor',$id)->get('tb_sensor')->row();
		return $data->lokasi;
	}
}

?>
