<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_ketinggian extends CI_Controller {

	function __construct()
	{
		date_default_timezone_set('Asia/Jakarta');
		parent::__construct();

		$this->load->model('mdata_ketinggian');

		if(!$this->session->userdata('logged_in')){
			redirect(base_url('Auth'),'refresh');
	    }
	}

	private function _render_page($view, $data = null)
	{
		$this->viewdata = (empty($data)) ? $this->data : $data;

		$this->load->view('petugas/_global/header',$this->viewdata);
		$this->load->view($view, $this->viewdata);
		$this->load->view('petugas/_global/footer',$this->viewdata);
	}

	public function index()
	{
		$data=array(
			'menu'=>'data_ketinggian',
		);
		$this->_render_page('petugas/data_realtime',$data);
	}

	public function getTable($id='')
	{
		$data = array(
			'data_realtime'=>$this->mdata_ketinggian->getdata($id)->result_array(),
			'nama'=>$this->mdata_ketinggian->getNama($id)
		);
		$this->load->view('petugas/table',$data);
	}


	public function getAlat()
{
	$data = $this->db->get('tb_sensor')->result();
	foreach ($data as $k) {
		$get_last= $this->db->where('id_sensor',$k->id_sensor)->order_by('id','desc')->limit(1)->get('data_ketinggian')->result();
		foreach ($get_last as $l) {
			$k->ketinggian=$l->ketinggian;
			if ($l->ketinggian>80) {
				$k->status=1;
			}else {
				$k->status=0;
			}
		}
	}
	echo json_encode($data);
}
}
