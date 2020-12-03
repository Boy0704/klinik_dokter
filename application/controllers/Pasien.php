<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pasien extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Pasien_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'pasien/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'pasien/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'pasien/index.html';
            $config['first_url'] = base_url() . 'pasien/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Pasien_model->total_rows($q);
        $pasien = $this->Pasien_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'pasien_data' => $pasien,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'judul_page' => 'Data Pasien',
            'konten' => 'pasien/pasien_list',
        );
        $this->load->view('v_index', $data);
    }

    public function read($id) 
    {
        $row = $this->Pasien_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_pasien' => $row->id_pasien,
		'nama' => $row->nama,
		'tanggal_lahir' => $row->tanggal_lahir,
		'jenis_kelamin' => $row->jenis_kelamin,
		'nama_ayah' => $row->nama_ayah,
		'nama_ibu' => $row->nama_ibu,
		'alamat' => $row->alamat,
		'no_telp' => $row->no_telp,
		'no_hp' => $row->no_hp,
		'id_member' => $row->id_member,
	    );
            $this->load->view('pasien/pasien_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pasien'));
        }
    }

    public function create() 
    {
        $data = array(
            'judul_page' => 'Tambah Pasien',
            'konten' => 'pasien/pasien_form',
            'button' => 'Create',
            'action' => site_url('pasien/create_action'),
	    'id_pasien' => set_value('id_pasien'),
	    'nama' => set_value('nama'),
	    'tanggal_lahir' => set_value('tanggal_lahir'),
	    'jenis_kelamin' => set_value('jenis_kelamin'),
	    'nama_ayah' => set_value('nama_ayah'),
	    'nama_ibu' => set_value('nama_ibu'),
	    'alamat' => set_value('alamat'),
	    'no_telp' => set_value('no_telp'),
	    'no_hp' => set_value('no_hp'),
	    'id_member' => set_value('id_member'),
	);
        $this->load->view('v_index', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'tanggal_lahir' => $this->input->post('tanggal_lahir',TRUE),
		'jenis_kelamin' => $this->input->post('jenis_kelamin',TRUE),
		'nama_ayah' => $this->input->post('nama_ayah',TRUE),
		'nama_ibu' => $this->input->post('nama_ibu',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'no_telp' => $this->input->post('no_telp',TRUE),
		'no_hp' => $this->input->post('no_hp',TRUE),
		'id_member' => $this->input->post('id_member',TRUE),
	    );

            $this->Pasien_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('pasien'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Pasien_model->get_by_id($id);

        if ($row) {
            $data = array(
                'judul_page' => 'Ubah Pasien',
                'konten' => 'pasien/pasien_form',
                'button' => 'Update',
                'action' => site_url('pasien/update_action'),
		'id_pasien' => set_value('id_pasien', $row->id_pasien),
		'nama' => set_value('nama', $row->nama),
		'tanggal_lahir' => set_value('tanggal_lahir', $row->tanggal_lahir),
		'jenis_kelamin' => set_value('jenis_kelamin', $row->jenis_kelamin),
		'nama_ayah' => set_value('nama_ayah', $row->nama_ayah),
		'nama_ibu' => set_value('nama_ibu', $row->nama_ibu),
		'alamat' => set_value('alamat', $row->alamat),
		'no_telp' => set_value('no_telp', $row->no_telp),
		'no_hp' => set_value('no_hp', $row->no_hp),
		'id_member' => set_value('id_member', $row->id_member),
	    );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pasien'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_pasien', TRUE));
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'tanggal_lahir' => $this->input->post('tanggal_lahir',TRUE),
		'jenis_kelamin' => $this->input->post('jenis_kelamin',TRUE),
		'nama_ayah' => $this->input->post('nama_ayah',TRUE),
		'nama_ibu' => $this->input->post('nama_ibu',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'no_telp' => $this->input->post('no_telp',TRUE),
		'no_hp' => $this->input->post('no_hp',TRUE),
		'id_member' => $this->input->post('id_member',TRUE),
	    );

            $this->Pasien_model->update($this->input->post('id_pasien', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pasien'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Pasien_model->get_by_id($id);

        if ($row) {
            $this->Pasien_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pasien'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pasien'));
        }
    }

    public function kaitkan_akun($id_pasien)
    {
        $id_member = $this->input->post('id_member');

        $email = get_data('member','id_member',$id_member,'email');

        $this->db->where('id_pasien', $id_pasien);
        $this->db->update('pasien', array('id_member'=>$id_member));
        $this->session->set_flashdata('message', alert_notif('email berhasil di kaitkan dengan akun '.$email.' !','success'));
        redirect('rekam_medis','refresh');
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('tanggal_lahir', 'tanggal lahir', 'trim|required');
	$this->form_validation->set_rules('jenis_kelamin', 'jenis kelamin', 'trim|required');
	$this->form_validation->set_rules('nama_ayah', 'nama ayah', 'trim|required');
	$this->form_validation->set_rules('nama_ibu', 'nama ibu', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('no_telp', 'no telp', 'trim|required');
	$this->form_validation->set_rules('no_hp', 'no hp', 'trim|required');
	$this->form_validation->set_rules('id_member', 'id member', 'trim|required');

	$this->form_validation->set_rules('id_pasien', 'id_pasien', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Pasien.php */
/* Location: ./application/controllers/Pasien.php */
/* Please DO NOT modify this information : */
/* Generated by Boy Kurniawan 2020-10-18 07:42:37 */
/* https://jualkoding.com */