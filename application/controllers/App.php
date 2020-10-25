<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        
    }

    // public function tes_email()
    // {
    //     echo kirim_email("TES AJA","kirim email tes","boykurniawan123@gmail.com");
    // }
	
	public function index()
	{
        if ($this->session->userdata('level') == '') {
            redirect('login');
        }
        if ($this->session->userdata('level') =='user') {
            $this->db->where('id_member', $this->session->userdata('id_user'));
            $cek_data = $this->db->get('member')->row();
            if ($cek_data->nama == '' OR $cek_data->no_telp == '') {
                $this->session->set_flashdata('message', alert_biasa('Silahkan update profil kamu dahulu !','warning'));
                redirect('app/update_profil/'.$this->session->userdata('id_user'),'refresh');
            }
        }
		$data = array(
			'konten' => 'home_admin',
            'judul_page' => 'Dashboard',
		);
		$this->load->view('v_index', $data);
    }

    public function daftar_user()
    {
        $simpan = $this->db->insert('member', array(
            'nama' => $this->input->post('nama'),
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password')
        ));
        if ($simpan) {
            $this->session->set_flashdata('message', alert_biasa('Berhasil, silahkan login','success'));
            redirect('login_user','refresh');
        }
    }

    public function update_profil($id_member)
    {
        if ($_POST) {
            if ($_POST['password'] == '') {
                $_POST['password'] = $_POST['password_old'];
                unset($_POST['password_old']);
            } else {
                unset($_POST['password_old']);
            }
            // log_r($_POST);
            $this->db->where('id_member', $id_member);
            $this->db->update('member', $_POST);
            $this->session->set_flashdata('message', alert_biasa('Profil Berhasil di update','success'));
            redirect('app/update_profil/'.$this->session->userdata('id_user'),'refresh');
        } else {
            $this->db->where('id_member', $id_member);
            $data_profil = $this->db->get('member');
            $data = array(
                'data_profil' => $data_profil,
                'konten' => 'front/profil',
                'judul_page' => 'Update Profil',
            );
            $this->load->view('v_index', $data);
        }
    }

    public function get_data_jadwal()
    {
        $no = 0;
        $nama_dokter = $this->input->post('dokter');
        $id_pasien = $this->input->post('id_pasien');
        foreach (list_date() as $jd): 
            $this->db->where('dokter', $nama_dokter);
            $this->db->where('hari', cek_hari($jd->format("Y-m-d")));
            $data_jadwal = $this->db->get('jadwal');
            if ($data_jadwal->num_rows() > 0) {
                ?>
                <tr>
                    <td><?php echo $no ?></td>
                    <td><?php echo $data_jadwal->row()->dokter ?></td>
                    
                    <td><?php echo $data_jadwal->row()->hari ?></td>
                    <td><?php echo $jd->format("Y-m-d"); ?></td>
                    <td><?php echo $data_jadwal->row()->dari.' - '.$data_jadwal->row()->sampai ?></td>
                    <td>
                        <a onclick="javasciprt: return confirm('Pastikan nomor whatsapp/HP utama benar dan sudah update agar dapat dihubungi beserta kolom notes input untuk admin ?')" href="app/pilih_jadwal?tgl=<?php echo $jd->format("Y-m-d"); ?>&id_jadwal=<?php echo $data_jadwal->row()->id_jadwal ?>&id_pasien=<?php echo $id_pasien ?>" class="label label-success">Pilih</a>
                    </td>
                </tr>
                <?php
            } 

            
            
        $no++; endforeach;
    }

    public function pilih_jadwal()
    {
        $tgl = $this->input->get('tgl');
        $id_jadwal = $this->input->get('id_jadwal');
        $id_pasien = $this->input->get('id_pasien');

        $cek_antrian = $this->db->get_where('antrian',array('id_pasien'=>$id_pasien,'tgl_kunjungan'=>$tgl));
        if ($cek_antrian->num_rows() > 0) {
            $this->session->set_flashdata('message', alert_biasa('Kamu sudah memilih jadwal kunjungan di tanggal ini '.$tgl,'error'));
            redirect('app/daftar_pasien','refresh');
        }

        $simpan = $this->db->insert('antrian', array(
            'id_pasien' => $id_pasien,
            'no_antrian' => kode_urut(),
            'create_at' => get_waktu(),
            'id_jadwal' => $id_jadwal,
            'tgl_kunjungan' => $tgl
        ));
        if ($simpan) {
            $this->session->set_flashdata('message', alert_biasa('Antrian Berhasil disimpan','success'));
            redirect('app/daftar_pasien','refresh');
        }
    }

    public function jadwal_dokter($id_pasien)
    {
        $data = array(
            'konten' => 'front/jadwal_dokter',
            'judul_page' => 'Pilih Jadwal Dokter',
        );
        $this->load->view('v_index', $data);
    }

    public function lihat_semua_antrian($id_jadwal,$tgl_kunjungan)
    {
        $data = array(
            'konten' => 'front/lihat_semua_antrian',
            'judul_page' => 'Semua Antrian '.$tgl_kunjungan,
        );
        $this->load->view('v_index', $data);
    }

    public function daftar_pasien()
    {
        $this->db->where('id_member', $this->session->userdata('id_user'));
        $cek_data = $this->db->get('member')->row();
        if ($cek_data->nama == '' OR $cek_data->no_telp == '') {
            $this->session->set_flashdata('message', alert_biasa('Silahkan update profil kamu dahulu !','warning'));
            redirect('app/update_profil/'.$this->session->userdata('id_user'),'refresh');
        }
        $data = array(
            'konten' => 'front/pendaftaran_pasien',
            'judul_page' => 'Pendaftaran Pasien',
        );
        $this->load->view('v_index', $data);
    }

    public function tambah_peserta()
    {
        $data_profil = $this->db->get_where('member', array('id_member'=>$this->session->userdata('id_user')));
        $data = array(
            'data_profil'=>$data_profil,
            'konten' => 'front/tambah_peserta',
            'judul_page' => 'Tambah Peserta',
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

        $simpan = $this->db->insert('pasien', array(
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

    public function update_konfirmasi($id_antrian,$val)
    {
        $this->db->where('id_antrian', $id_antrian);
        $simpan = $this->db->update('antrian', array('konfirmasi'=>$val,'date_konfirmasi'=>get_waktu()));
        if ($val == 'y') {
            $data_pasien = $this->db->get_where('antrian', array('id_antrian'=>$id_antrian))->row();
            $nama_pasien = get_data('pasien','id_pasien',$data_pasien->id_pasien,'nama');
            $subject = "Konfirmasi Kehadiran Pasien - $nama_pasien";
            $pesan = "Pasien - $nama_pasien, telah melakukan konfirmasi untuk kujungan pada $data_pasien->tgl_kunjungan";
            echo kirim_email($subject,$pesan,get_data('setting','nama','email_admin','value'));
        }
        if ($simpan) {
            $this->session->set_flashdata('message', alert_biasa('Terima kasih sudah melakukan konfirmasi !','success'));
            if ($this->session->userdata('level') == 'user') {
                redirect('app/daftar_pasien','refresh');
            } else {
                redirect('antrian','refresh');
            }
            
        }
    }

    public function hapus_peserta($id_pasien)
    {
        $this->db->where('id_pasien', $id_pasien);
        $this->db->update('pasien', array('aktif'=>'0'));
        $this->session->set_flashdata('message', alert_biasa('Data peserta berhasil di hapus !','success'));
        redirect('app/daftar_pasien','refresh');
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
