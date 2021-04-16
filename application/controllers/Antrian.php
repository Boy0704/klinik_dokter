<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Antrian extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Antrian_model');
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
            $config['base_url'] = base_url() . 'antrian/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'antrian/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'antrian/index.html';
            $config['first_url'] = base_url() . 'antrian/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Antrian_model->total_rows($q);
        $antrian = $this->Antrian_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'antrian_data' => $antrian,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'judul_page' => 'Data Antrian',
            'konten' => 'antrian/antrian_list',
        );
        $this->load->view('v_index', $data);
    }

    public function skip_panggilan($id_antrian)
    {
        $this->db->where('id_antrian', $id_antrian);
        $this->db->update('antrian', array('date_konfirmasi'=>get_waktu()));

        if ($_GET) {
            redirect('antrian?tanggal='.$_GET['tanggal'],'refresh');
        } else {
            redirect('antrian','refresh');
        }
    }

    public function simpan_panggilan($id_antrian)
    {
        $this->db->where('id_antrian', $id_antrian);
        $this->db->update('antrian', array('status_kunjungan'=>'close'));

        if ($_GET) {
            redirect('antrian?tanggal='.$_GET['tanggal'],'refresh');
        } else {
            redirect('antrian','refresh');
        }
    }

    public function read($id) 
    {
        $row = $this->Antrian_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_antrian' => $row->id_antrian,
		'no_antrian' => $row->no_antrian,
		'id_pasien' => $row->id_pasien,
		'create_at' => $row->create_at,
		'konfirmasi' => $row->konfirmasi,
		'date_konfirmasi' => $row->date_konfirmasi,
	    );
            $this->load->view('antrian/antrian_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('antrian'));
        }
    }

    public function create() 
    {
        $data = array(
            'judul_page' => 'Tambah Antrian',
            'konten' => 'antrian/antrian_form',
            'button' => 'Create',
            'action' => site_url('antrian/create_action'),
	    'id_antrian' => set_value('id_antrian'),
	    'no_antrian' => set_value('no_antrian'),
	    'id_pasien' => set_value('id_pasien'),
	    'create_at' => set_value('create_at'),
	    'konfirmasi' => set_value('konfirmasi'),
	    'date_konfirmasi' => set_value('date_konfirmasi'),
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
		'no_antrian' => $this->input->post('no_antrian',TRUE),
		'id_pasien' => $this->input->post('id_pasien',TRUE),
		'create_at' => $this->input->post('create_at',TRUE),
		'konfirmasi' => $this->input->post('konfirmasi',TRUE),
		'date_konfirmasi' => $this->input->post('date_konfirmasi',TRUE),
	    );

            $this->Antrian_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('antrian'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Antrian_model->get_by_id($id);

        if ($row) {
            $data = array(
                'judul_page' => 'Ubah Antrian',
                'konten' => 'antrian/antrian_form',
                'button' => 'Update',
                'action' => site_url('antrian/update_action'),
		'id_antrian' => set_value('id_antrian', $row->id_antrian),
		'no_antrian' => set_value('no_antrian', $row->no_antrian),
		'id_pasien' => set_value('id_pasien', $row->id_pasien),
		'create_at' => set_value('create_at', $row->create_at),
		'konfirmasi' => set_value('konfirmasi', $row->konfirmasi),
		'date_konfirmasi' => set_value('date_konfirmasi', $row->date_konfirmasi),
	    );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('antrian'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_antrian', TRUE));
        } else {
            $data = array(
		'no_antrian' => $this->input->post('no_antrian',TRUE),
		'id_pasien' => $this->input->post('id_pasien',TRUE),
		'create_at' => $this->input->post('create_at',TRUE),
		'konfirmasi' => $this->input->post('konfirmasi',TRUE),
		'date_konfirmasi' => $this->input->post('date_konfirmasi',TRUE),
	    );

            $this->Antrian_model->update($this->input->post('id_antrian', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('antrian'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Antrian_model->get_by_id($id);

        if ($row) {
            $this->Antrian_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('antrian'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('antrian'));
        }
    }


    public function cek_email($value='')
    {
        if ($value != '' and strpos($value, '@')) {
            $this->db->where('email', $value);
            $cek = $this->db->get('member');
            if ($cek->num_rows() > 0) {
                $id_member = $cek->row()->id_member;
                ?>
                <span class="label label-success">Email ditemukan.</span>
                <input type="hidden" name="status_email" value="1">
                <input type="hidden" name="id_member" value="<?php echo $id_member ?>">
                <?php
            } else {
                ?>
                <span class="label label-info">Email tidak ditemukan.</span>
                <input type="hidden" name="status_email" value="0">
                <input type="hidden" name="id_member" value="">
                <?php
            }
        }
    }

    public function simpan_antrian_manual()
    {
        $nama = $this->input->post('nama');
        $tgl_lahir = $this->input->post('tgl_lahir');
        $no_hp = $this->input->post('no_hp');
        $email = $this->input->post('email');
        $status_email = $this->input->post('status_email');
        $id_member = $this->input->post('id_member');
        $id_jadwal = $this->input->post('id_jadwal');

        $data_p = array(
            'nama' => $nama,
            'tanggal_lahir' => $tgl_lahir,
            'no_hp' => $no_hp,
            'id_member' => $id_member,
        );
        $this->db->insert('pasien', $data_p);
        $id_pasien = $this->db->insert_id();
        $data_ant = array(
            'id_pasien' => $id_pasien,
            'konfirmasi' => 'y',
            'id_jadwal' => $id_jadwal,
            'create_at' =>get_waktu(),
            'date_konfirmasi' =>get_waktu(),
            'tgl_kunjungan' =>date('Y-m-d'),
        );
        $this->db->insert('antrian', $data_ant);
        $this->session->set_flashdata('message', alert_notif('Pendaftaran berhasil di simpan !','success'));
        redirect('antrian','refresh');
    }


    public function _rules() 
    {
	$this->form_validation->set_rules('no_antrian', 'no antrian', 'trim|required');
	$this->form_validation->set_rules('id_pasien', 'id pasien', 'trim|required');
	$this->form_validation->set_rules('create_at', 'create at', 'trim|required');
	$this->form_validation->set_rules('konfirmasi', 'konfirmasi', 'trim|required');
	$this->form_validation->set_rules('date_konfirmasi', 'date konfirmasi', 'trim|required');

	$this->form_validation->set_rules('id_antrian', 'id_antrian', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Antrian.php */
/* Location: ./application/controllers/Antrian.php */
/* Please DO NOT modify this information : */
/* Generated by Boy Kurniawan 2020-10-18 07:42:29 */
/* https://jualkoding.com */