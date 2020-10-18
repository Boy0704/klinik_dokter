<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrator extends CI_Controller {

	
	public function index()
	{
		if ($this->session->userdata('level') == 'admin') {
			redirect('app','refresh');
		} else {
			redirect('login','refresh');
		}
	}
}
