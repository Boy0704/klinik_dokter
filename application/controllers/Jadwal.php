<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jadwal extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Jadwal_model');
        $this->load->library('form_validation');
        if ($this->session->userdata('level') != 'admin') {
            redirect('login','refresh');
        }
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'jadwal/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'jadwal/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'jadwal/index.html';
            $config['first_url'] = base_url() . 'jadwal/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Jadwal_model->total_rows($q);
        $jadwal = $this->Jadwal_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'jadwal_data' => $jadwal,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'judul_page' => 'Daftar Jadwal',
            'konten' => 'jadwal/jadwal_list',
        );
        $this->load->view('v_index', $data);
    }

    public function read($id) 
    {
        $row = $this->Jadwal_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_jadwal' => $row->id_jadwal,
		'hari' => $row->hari,
		'dari' => $row->dari,
		'sampai' => $row->sampai,
	    );
            $this->load->view('jadwal/jadwal_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jadwal'));
        }
    }

    public function create() 
    {
        $data = array(
            'judul_page' => 'Tambah Jadwal',
            'konten' => 'jadwal/jadwal_form',
            'button' => 'Create',
            'action' => site_url('jadwal/create_action'),
	    'id_jadwal' => set_value('id_jadwal'),
	    'hari' => set_value('hari'),
	    'dari' => set_value('dari'),
        'sampai' => set_value('sampai'),
	    'dokter' => set_value('dokter'),
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
		'hari' => $this->input->post('hari',TRUE),
		'dari' => $this->input->post('dari',TRUE),
        'sampai' => $this->input->post('sampai',TRUE),
		'dokter' => $this->input->post('dokter',TRUE),
	    );

            $this->Jadwal_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('jadwal'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Jadwal_model->get_by_id($id);

        if ($row) {
            $data = array(
                'judul_page' => 'Ubah Jadwal',
                'konten' => 'jadwal/jadwal_form',
                'button' => 'Update',
                'action' => site_url('jadwal/update_action'),
		'id_jadwal' => set_value('id_jadwal', $row->id_jadwal),
		'hari' => set_value('hari', $row->hari),
		'dari' => set_value('dari', $row->dari),
        'sampai' => set_value('sampai', $row->sampai),
		'dokter' => set_value('dokter', $row->dokter),
	    );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jadwal'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_jadwal', TRUE));
        } else {
            $data = array(
		'hari' => $this->input->post('hari',TRUE),
		'dari' => $this->input->post('dari',TRUE),
        'sampai' => $this->input->post('sampai',TRUE),
		'dokter' => $this->input->post('dokter',TRUE),
	    );

            $this->Jadwal_model->update($this->input->post('id_jadwal', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('jadwal'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Jadwal_model->get_by_id($id);

        if ($row) {
            $this->Jadwal_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('jadwal'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jadwal'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('hari', 'hari', 'trim|required');
	$this->form_validation->set_rules('dari', 'dari', 'trim|required');
	$this->form_validation->set_rules('sampai', 'sampai', 'trim|required');

	$this->form_validation->set_rules('id_jadwal', 'id_jadwal', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Jadwal.php */
/* Location: ./application/controllers/Jadwal.php */
/* Please DO NOT modify this information : */
/* Generated by Boy Kurniawan 2020-10-17 11:20:29 */
/* https://jualkoding.com */