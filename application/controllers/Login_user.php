<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_user extends CI_Controller {

	
	public function index()
	{
		if ($this->session->userdata('level') == 'user') {
			redirect('app','refresh');
		} else {
			$this->load->view('login_user');
		}
		
	}

	public function auth()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		// $hashed = '$2y$10$LO9IzV0KAbocIBLQdgy.oeNDFSpRidTCjXSQPK45ZLI9890g242SG';
		$cek_user = $this->db->query("SELECT * FROM member WHERE email='$username' and password='$password' ");
		// if (password_verify($password, $hashed)) {
		if ($cek_user->num_rows() > 0) {
			foreach ($cek_user->result() as $row) {
				
                $sess_data['id_user'] = $row->id_member;
				$sess_data['nama'] = $row->nama;
				// $sess_data['username'] = $row->username;
				$sess_data['foto'] = 'default.png';
				$sess_data['level'] = 'user';
				$this->session->set_userdata($sess_data);
			}

			// define('FOTO', $this->session->userdata('foto'), TRUE);
			

			// print_r($this->session->userdata());
			// exit;
			// $sess_data['username'] = $username;
			// $this->session->set_userdata($sess_data);
			if ($this->session->userdata('level') == 'user') {
				redirect('app','refresh');
			// 	echo 'Server TimeOut';
			}
			

			// redirect('app/index');
		} else {
			$this->session->set_flashdata('message', alert_biasa('Gagal Login!\n username atau password kamu salah','warning'));
			// $this->session->set_flashdata('message', alert_tunggu('Gagal Login!\n username atau password kamu salah','warning'));
			redirect('login_user','refresh');
		}
	}

	function logout()
	{
		$this->session->unset_userdata('id_user');
		$this->session->unset_userdata('nama');
		$this->session->unset_userdata('level');
		session_destroy();
		redirect('login_user','refresh');
	}

}
