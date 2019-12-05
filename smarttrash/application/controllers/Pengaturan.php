<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan extends CI_Controller {

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
			'menu'=>'pengaturan',
			'data'=> $this->db->where('id',$this->session->userdata('id'))->get('user')->row()
		);

		$this->_render_page('petugas/pengaturan',$data);
	}
	public function update_akun()
	{
		$pass = $this->input->post('password');
		$repass = $this->input->post('retype-password');
		$status=1;
		$data = array('username' => $this->input->post('username') );
		if ($pass!='') {
			if ($pass==$repass) {
				$data['password']=password_hash($pass,PASSWORD_DEFAULT);
			}else {
				$status = 0;
			}
		}

		if ($status==1) {
			$this->db->update('user',$data,array('id',$this->session->userdata('id')));
			$this->session->set_flashdata('message','toastr.success("Success update data.", "Success!");');
			redirect(base_url('Pengaturan/'));
		}else {
			$this->session->set_flashdata('message','toastr.error("Gagal update data.", "Success!");');
			redirect(base_url('Pengaturan/'));
		}
	}

}
