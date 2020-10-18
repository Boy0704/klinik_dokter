<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {

	
	public function index()
	{
        if ($this->session->userdata('level') == '') {
            redirect('login');
        }
		$data = array(
			'konten' => 'home_admin',
            'judul_page' => 'Dashboard',
		);
		$this->load->view('v_index', $data);
    }

    public function daftar_pasien()
    {
        $data = array(
            'konten' => 'front/pendaftaran_pasien',
            'judul_page' => 'Pendaftaran Pasien',
        );
        $this->load->view('v_index', $data);
    }

    public function simpan_pendaftaran()
    {
        $nama = $this->input->post('nama');
        $jenis_kelamin = $this->input->post('jenis_kelamin');
        $tgl_lahir = $this->input->post('tgl_lahir');
        $nama_ayah = $this->input->post('nama_ayah');
        $nama_ibu = $this->input->post('nama_ibu');
        $alamat = $this->input->post('alamat');
        $no_telp = $this->input->post('no_telp');
        $no_hp = $this->input->post('no_hp');

        $this->db->insert('pasien', array(
            'nama' => $nama,
            'jenis_kelamin' => $jenis_kelamin,
            'tanggal_lahir' => $tgl_lahir,
            'nama_ayah' => $nama_ayah,
            'nama_ibu' => $nama_ibu,
            'alamat' => $alamat,
            'no_telp' => $no_telp,
            'no_hp' => $no_hp,
            'id_member' => $this->session->userdata('id_user'),
        ));

        $id_pasien = $this->db->insert_id();

        $simpan = $this->db->insert('antrian', array(
            'no_antrian' => kode_urut(),
            'id_pasien' => $id_pasien,
            'create_at' => get_waktu()
        ));

        if ($simpan) {
            $this->session->set_flashdata('message', alert_biasa('Pendaftaran berhasil di simpan, silahkan klik konfirmasi jika telah diklinik','success'));
            redirect('app/daftar_pasien','refresh');
        }
    }

    public function cek_umur()
    {
        $tgl_lahir = $this->input->post('tgl_lahir');
        echo hitung_umur($tgl_lahir);
    }

    public function cetak()
	{
        if ($this->session->userdata('level') == '') {
            redirect('login');
        }
		$data = array(
			'konten' => 'laporan/view',
            'judul_page' => 'Cetak Laporan',
		);
		$this->load->view('v_index', $data);
    }

    public function cetak_pembayaran()
    {
    	$this->load->view('laporan/lap_pembayaran');
    }

    public function cetak_nota()
    {
        $this->load->view('laporan/cetak_nota');
    }

}
