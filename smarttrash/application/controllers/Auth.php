<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct()
	{
		date_default_timezone_set('Asia/Jakarta');
		parent::__construct();

		$this->load->model('crud');
	}


	public function index()
	{
		if ($this->session->userdata('logged_in')) {
			redirect('Dashboard','refresh');
		}

		$this->load->helper(array('captcha','form'));
		$vals = array(
			'img_path' => './capimg/',
			'img_url' => base_url().'capimg/',
			'img_width' => 150,
			'img_height' => 40,
			'font_size' => '30',
			'font_path' => base_url().'assets/font-cap/captcha4.ttf',
			'expiration' => 7200,
			'word_length'   => '3',
		);
		$cap = create_captcha($vals);
		$this->session->set_userdata('keycode',md5($cap['word']));

		$data=array(
			'captcha_img' => $cap['image']
		);
		$this->load->view('auth',$data);
	}

	function login() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('login-username','Username','trim|required');
		$this->form_validation->set_rules('login-password','Password','trim|required');
		if($this->form_validation->run()==false){
			echo json_encode(array(
				'pesan'	=> 'Username dan Password Harus Diisi'
			));
		} else {
			$username = $this->input->post('login-username');
			$password = $this->input->post('login-password');
			$resuser = $this->crud->cek_user($username);
			if($resuser->num_rows() < 1){
				echo json_encode(array(
					'pesan'	=> 'Username tidak terdaftar'
				));
			} else {
				$r = $resuser->row();
				$pass = $r->password;
				$verify = password_verify($password,$pass);
				if(!$verify){
					echo json_encode(array(
						'pesan'	=> 'Cek Kombinasi Username dan Password ! '
					));
				} else {

					$captcha = $this->input->post('kode');
					if(md5($captcha)==$this->session->userdata('keycode')){
						$this->load->library('session');
						$sess_array = array(
							'logged_in'		=> 'logged_in',
							'id'			=> $r->id,
						);
						$this->session->set_userdata($sess_array);

						echo json_encode(array(
							'status'	=> 1,
							'url'		=> base_url('dashboard'),
						));

							$this->session->unset_userdata('keycode');
							redirect('Auth','refresh');
					}else{
						echo json_encode(array(
							'pesan'	=> 'Kode Keamanan Salah '
						));
						redirect('Auth','refresh');
					}

				}
			}
		}
	}

	public function logout() {

		$this->session->unset_userdata('logged_in');
		$this->session->sess_destroy();
		redirect(base_url('Auth'), 'refresh');
	}

	function hash(){
		echo password_hash('admin',PASSWORD_DEFAULT);
	}
}
