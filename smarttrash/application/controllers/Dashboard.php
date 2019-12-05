<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct()
	{
		date_default_timezone_set('Asia/Jakarta');
		parent::__construct();

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
			'menu'=>'dashboard',
		);

		$this->_render_page('petugas/dashboard',$data);
	}

}
