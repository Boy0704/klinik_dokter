<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pemberitahuan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Pemberitahuan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'pemberitahuan/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'pemberitahuan/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'pemberitahuan/index.html';
            $config['first_url'] = base_url() . 'pemberitahuan/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Pemberitahuan_model->total_rows($q);
        $pemberitahuan = $this->Pemberitahuan_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'pemberitahuan_data' => $pemberitahuan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'judul_page' => 'pemberitahuan/pemberitahuan_list',
            'konten' => 'pemberitahuan/pemberitahuan_list',
        );
        $this->load->view('v_index', $data);
    }

    public function read($id) 
    {
        $row = $this->Pemberitahuan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_pemberitahuan' => $row->id_pemberitahuan,
		'pemberitahuan' => $row->pemberitahuan,
		'aktif' => $row->aktif,
	    );
            $this->load->view('pemberitahuan/pemberitahuan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pemberitahuan'));
        }
    }

    public function create() 
    {
        $data = array(
            'judul_page' => 'pemberitahuan/pemberitahuan_form',
            'konten' => 'pemberitahuan/pemberitahuan_form',
            'button' => 'Create',
            'action' => site_url('pemberitahuan/create_action'),
	    'id_pemberitahuan' => set_value('id_pemberitahuan'),
	    'pemberitahuan' => set_value('pemberitahuan'),
	    'aktif' => set_value('aktif'),
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
		'pemberitahuan' => $this->input->post('pemberitahuan',TRUE),
		'aktif' => $this->input->post('aktif',TRUE),
	    );

            $this->Pemberitahuan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('pemberitahuan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Pemberitahuan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'judul_page' => 'pemberitahuan/pemberitahuan_form',
                'konten' => 'pemberitahuan/pemberitahuan_form',
                'button' => 'Update',
                'action' => site_url('pemberitahuan/update_action'),
		'id_pemberitahuan' => set_value('id_pemberitahuan', $row->id_pemberitahuan),
		'pemberitahuan' => set_value('pemberitahuan', $row->pemberitahuan),
		'aktif' => set_value('aktif', $row->aktif),
	    );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pemberitahuan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_pemberitahuan', TRUE));
        } else {
            $data = array(
		'pemberitahuan' => $this->input->post('pemberitahuan',TRUE),
		'aktif' => $this->input->post('aktif',TRUE),
	    );

            $this->Pemberitahuan_model->update($this->input->post('id_pemberitahuan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pemberitahuan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Pemberitahuan_model->get_by_id($id);

        if ($row) {
            $this->Pemberitahuan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pemberitahuan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pemberitahuan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('pemberitahuan', 'pemberitahuan', 'trim|required');

	$this->form_validation->set_rules('id_pemberitahuan', 'id_pemberitahuan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Pemberitahuan.php */
/* Location: ./application/controllers/Pemberitahuan.php */
/* Please DO NOT modify this information : */
/* Generated by Boy Kurniawan 2020-10-25 18:18:00 */
/* https://jualkoding.com */