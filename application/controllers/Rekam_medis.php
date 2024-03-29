<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rekam_medis extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Rekam_medis_model');
        $this->load->library('form_validation');
        if ($this->session->userdata('level') != 'admin') {
            redirect('login','refresh');
        }
    }

    public function get_form_pembayaran($id_antrian,$id_invoice)
    {
        // if (empty($_SESSION['add_inv'])) {
        //     $_SESSION['add_inv'] = 1;
        // } else {
        //     $_SESSION['add_inv'] = $_SESSION['add_inv'] + 1;
        // }
        // $no = $_SESSION['add_inv'];
        if (get_last_id_detail_inv() == 1) {
            $no = get_last_id_detail_inv();
        } else {
            $no = get_last_id_detail_inv() + 1;
        }
        $this->db->insert('invoice_detail', array(
            'id_detail_inv' => $no,
            'id_invoice' => $id_invoice
        ));
        
        ?>
        <tr id="br<?php echo $no ?>">
            <td>

                <select class="form-control select2" onchange="pilih_jenis('<?php echo $id_antrian ?>','<?php echo $id_invoice ?>','<?php echo $no ?>')" name="id_jenis_bayar[]" id="jenis_bayar<?php echo $no ?>">
                    <option value="0">Pilih Jenis Biaya</option>
                    <?php foreach ($this->db->get('jenis_bayar')->result() as $rw): ?>
                        <option value="<?php echo $rw->id_jenis_bayar ?>"><?php echo $rw->jenis_bayar ?></option>
                    <?php endforeach ?>
                </select>
            </td>
            <td>
                <span id="harga<?php echo $no ?>"></span>
            </td>
            <td>
                <span class="btn btn-xs btn-danger" onclick="remove('<?php echo $id_antrian ?>','<?php echo $id_invoice ?>','<?php echo $no ?>')">
                    <i class="fa fa-trash"></i>
                </span>
            </td>
        </tr>
        <?php
    }

    public function get_biaya($id_detail_inv)
    {
        $id = $this->input->post('id');
        $jenis_bayar =  $this->db->get_where('jenis_bayar', ['id_jenis_bayar'=>$id])->row();
        $this->db->where('id_detail_inv', $id_detail_inv);
        $this->db->update('invoice_detail', ['id_jenis_bayar'=>$jenis_bayar->id_jenis_bayar]);
        echo $jenis_bayar->harga;
    }

    public function remove_invoice_detail($id_detail_inv)
    {
        $this->db->where('id_detail_inv', $id_detail_inv);
        $this->db->delete('invoice_detail');
    }

    public function total_detail_inv($id_invoice)
    {
        $total = 0;
        $this->db->where('id_invoice', $id_invoice);
        foreach ($this->db->get('invoice_detail')->result() as $rw) {
            $total = $total + get_data('jenis_bayar','id_jenis_bayar',$rw->id_jenis_bayar,'harga');
        }
        echo $total;
    }

    public function update_pembayaran($id_invoice)
    {
        $total = $this->input->post('total');
        $dibayar = $this->input->post('dibayar');
        $sisa = $this->input->post('sisa');

        $_POST['updated_at'] = get_waktu();

        $this->db->where('id_invoice', $id_invoice);
        $this->db->update('invoice', $_POST);
    }

    public function index()
    {
        // $q = urldecode($this->input->get('q', TRUE));
        // $start = intval($this->input->get('start'));
        
        // if ($q <> '') {
        //     $config['base_url'] = base_url() . 'rekam_medis/index.html?q=' . urlencode($q);
        //     $config['first_url'] = base_url() . 'rekam_medis/index.html?q=' . urlencode($q);
        // } else {
        //     $config['base_url'] = base_url() . 'rekam_medis/index.html';
        //     $config['first_url'] = base_url() . 'rekam_medis/index.html';
        // }

        // $config['per_page'] = 10;
        // $config['page_query_string'] = TRUE;
        // $config['total_rows'] = $this->Rekam_medis_model->total_rows($q);
        // $rekam_medis = $this->Rekam_medis_model->get_limit_data($config['per_page'], $start, $q);

        // $this->load->library('pagination');
        // $this->pagination->initialize($config);

        // $data = array(
        //     'rekam_medis_data' => $rekam_medis,
        //     'q' => $q,
        //     'pagination' => $this->pagination->create_links(),
        //     'total_rows' => $config['total_rows'],
        //     'start' => $start,
        //     'judul_page' => 'Riwayat Medis Pasien',
        //     'konten' => 'rekam_medis/rekam_medis_list',
        // );
        $data = array(
            'konten' => 'rekam_medis/view',
            'judul_page' => "Rekam Medis Pasien"
        );
        $this->load->view('v_index', $data);
    }

    public function cetak_resep($id_antrian)
    {
        $this->load->view('rekam_medis/cetak_resep');
    }

    public function lihat($id_pasien)
    {
        $nama = strtoupper(get_data('pasien','id_pasien',$id_pasien,'nama'));
        $data = array(
            'konten' => 'rekam_medis/lihat',
            'judul_page' => "Rekam Medis Pasien [ <b>$nama</b> ]"
        );
        $this->load->view('v_index', $data);
    }

    public function aksi_simpan($aksi,$id)
    {
        if ($aksi == '1') {
            $riwayat_penyakit = $this->input->post('riwayat_penyakit');
            $alergi = $this->input->post('alergi');
            $data = array(
                'riwayat_penyakit' =>$riwayat_penyakit,
                'alergi'=>$alergi
            );
            $cek = $this->db->get_where('rekam_medis', array('id_pasien'=>$id));
            if ($cek->num_rows()>0) {
                $this->db->where('id_pasien', $id);
                $this->db->update('rekam_medis', $data);
            } else {
                $this->db->insert('rekam_medis', array('id_pasien'=>$id,'riwayat_penyakit'=>$riwayat_penyakit,'alergi'=>$alergi));
            }
            
        } elseif ($aksi == '2') {
            $tujuan_kunjungan = $this->input->post('tujuan_kunjungan');
            $clinical_notes = $this->input->post('clinical_notes');
            $medications = $this->input->post('medications');
            $data = array(
                'tujuan_kunjungan' =>$tujuan_kunjungan,
                'clinical_notes' =>$clinical_notes,
                'medications'=>$medications,
            );
            $this->db->where('id_pasien', $id);
            $this->db->where('tgl_kunjungan', $_GET['tgl_kunjungan']);
            $this->db->update('antrian', $data);
        } elseif ($aksi == '4') {
            $imunisasi = $this->input->post('imunisasi');
            $data = array('imunisasi'=>$imunisasi);
            $this->db->where('id_pasien', $id);
            $this->db->update('rekam_medis', $data);
        }
        $this->session->set_flashdata('message', alert_biasa('data berhasil di update','success'));
        redirect('rekam_medis/lihat/'.$id,'refresh');

    }

    public function read($id) 
    {
        $row = $this->Rekam_medis_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_rekam_medis' => $row->id_rekam_medis,
		'id_pasien' => $row->id_pasien,
		'riwayat_peyakit' => $row->riwayat_peyakit,
		'keluhan_penyakit' => $row->keluhan_penyakit,
		'create_at' => $row->create_at,
	    );
            $this->load->view('rekam_medis/rekam_medis_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('rekam_medis'));
        }
    }

    public function create() 
    {
        $data = array(
            'judul_page' => 'Tambah Rekam Medis',
            'konten' => 'rekam_medis/rekam_medis_form',
            'button' => 'Create',
            'action' => site_url('rekam_medis/create_action'),
	    'id_rekam_medis' => set_value('id_rekam_medis'),
	    'id_pasien' => set_value('id_pasien'),
	    'riwayat_peyakit' => set_value('riwayat_peyakit'),
	    'keluhan_penyakit' => set_value('keluhan_penyakit'),
	    'create_at' => set_value('create_at'),
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
		'id_pasien' => $this->input->post('id_pasien',TRUE),
		'riwayat_peyakit' => $this->input->post('riwayat_peyakit',TRUE),
		'keluhan_penyakit' => $this->input->post('keluhan_penyakit',TRUE),
		'create_at' => get_waktu(),
	    );

            $this->Rekam_medis_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('rekam_medis'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Rekam_medis_model->get_by_id($id);

        if ($row) {
            $data = array(
                'judul_page' => 'Ubah Rekam Medis',
                'konten' => 'rekam_medis/rekam_medis_form',
                'button' => 'Update',
                'action' => site_url('rekam_medis/update_action'),
		'id_rekam_medis' => set_value('id_rekam_medis', $row->id_rekam_medis),
		'id_pasien' => set_value('id_pasien', $row->id_pasien),
		'riwayat_peyakit' => set_value('riwayat_peyakit', $row->riwayat_peyakit),
		'keluhan_penyakit' => set_value('keluhan_penyakit', $row->keluhan_penyakit),
		'create_at' => set_value('create_at', $row->create_at),
	    );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('rekam_medis'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_rekam_medis', TRUE));
        } else {
            $data = array(
		'id_pasien' => $this->input->post('id_pasien',TRUE),
		'riwayat_peyakit' => $this->input->post('riwayat_peyakit',TRUE),
        'keluhan_penyakit' => $this->input->post('keluhan_penyakit',TRUE),
		'update_at' => get_waktu(),
	    );

            $this->Rekam_medis_model->update($this->input->post('id_rekam_medis', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('rekam_medis'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Rekam_medis_model->get_by_id($id);

        if ($row) {
            $this->Rekam_medis_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('rekam_medis'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('rekam_medis'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_pasien', 'id pasien', 'trim|required');
	$this->form_validation->set_rules('riwayat_peyakit', 'riwayat peyakit', 'trim|required');
	$this->form_validation->set_rules('keluhan_penyakit', 'keluhan penyakit', 'trim|required');
	// $this->form_validation->set_rules('create_at', 'create at', 'trim|required');

	$this->form_validation->set_rules('id_rekam_medis', 'id_rekam_medis', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Rekam_medis.php */
/* Location: ./application/controllers/Rekam_medis.php */
/* Please DO NOT modify this information : */
/* Generated by Boy Kurniawan 2020-10-17 11:20:46 */
/* https://jualkoding.com */