<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jenis_bayar extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Jenis_bayar_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'jenis_bayar/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'jenis_bayar/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'jenis_bayar/index.html';
            $config['first_url'] = base_url() . 'jenis_bayar/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Jenis_bayar_model->total_rows($q);
        $jenis_bayar = $this->Jenis_bayar_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'jenis_bayar_data' => $jenis_bayar,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'judul_page' => 'Jenis Bayar',
            'konten' => 'jenis_bayar/jenis_bayar_list',
        );
        $this->load->view('v_index', $data);
    }

    public function read($id) 
    {
        $row = $this->Jenis_bayar_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_jenis_bayar' => $row->id_jenis_bayar,
		'jenis_bayar' => $row->jenis_bayar,
		'harga' => $row->harga,
	    );
            $this->load->view('jenis_bayar/jenis_bayar_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jenis_bayar'));
        }
    }

    public function create() 
    {
        $data = array(
            'judul_page' => 'Jenis Bayar',
            'konten' => 'jenis_bayar/jenis_bayar_form',
            'button' => 'Create',
            'action' => site_url('jenis_bayar/create_action'),
	    'id_jenis_bayar' => set_value('id_jenis_bayar'),
	    'jenis_bayar' => set_value('jenis_bayar'),
	    'harga' => set_value('harga'),
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
		'jenis_bayar' => $this->input->post('jenis_bayar',TRUE),
		'harga' => $this->input->post('harga',TRUE),
	    );

            $this->Jenis_bayar_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('jenis_bayar'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Jenis_bayar_model->get_by_id($id);

        if ($row) {
            $data = array(
                'judul_page' => 'Jenis Bayar',
                'konten' => 'jenis_bayar/jenis_bayar_form',
                'button' => 'Update',
                'action' => site_url('jenis_bayar/update_action'),
		'id_jenis_bayar' => set_value('id_jenis_bayar', $row->id_jenis_bayar),
		'jenis_bayar' => set_value('jenis_bayar', $row->jenis_bayar),
		'harga' => set_value('harga', $row->harga),
	    );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jenis_bayar'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_jenis_bayar', TRUE));
        } else {
            $data = array(
		'jenis_bayar' => $this->input->post('jenis_bayar',TRUE),
		'harga' => $this->input->post('harga',TRUE),
	    );

            $this->Jenis_bayar_model->update($this->input->post('id_jenis_bayar', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('jenis_bayar'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Jenis_bayar_model->get_by_id($id);

        if ($row) {
            $this->Jenis_bayar_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('jenis_bayar'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jenis_bayar'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('jenis_bayar', 'jenis bayar', 'trim|required');
	$this->form_validation->set_rules('harga', 'harga', 'trim|required');

	$this->form_validation->set_rules('id_jenis_bayar', 'id_jenis_bayar', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Jenis_bayar.php */
/* Location: ./application/controllers/Jenis_bayar.php */
/* Please DO NOT modify this information : */
/* Generated by Boy Kurniawan 2022-01-30 04:06:43 */
/* https://jualkoding.com */