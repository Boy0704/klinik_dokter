<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran extends CI_Controller {

	public function index()
	{
		$data = array(
            'konten' => 'pembayaran/view',
            'judul_page' => 'Pembayaran',
        );
        $this->load->view('v_index', $data);
	}

}

/* End of file Pembayaran.php */
/* Location: ./application/controllers/Pembayaran.php */