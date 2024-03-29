<?php 

function get_last_id_detail_inv()
{
	$CI =& get_instance();
	$CI->db->order_by('id_detail_inv', 'desc');
	$cek = $CI->db->get('invoice_detail');
	if ($cek->num_rows() == 1) {
		return $cek->row()->id_detail_inv + 1;
	} elseif ($cek->num_rows() > 1) {
		return $cek->row()->id_detail_inv;
	} else {
		return 1;
	}
}

function alert_notif($pesan,$type)
{
	return "<div class=\"alert alert-$type fade in alert-radius-bordered alert-shadowed\">
                                        <button class=\"close\" data-dismiss=\"alert\">
                                            ×
                                        </button>
                                        <i class=\"fa-fw fa fa-info\"></i>

                                        <strong>Info:</strong> $pesan
                                    </div>";
}

function superman()
{
  if (strpos(siteURL(),'://localhost')){
    return true;
  }else {
    return false;
  }
}

function siteURL() {
  $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
  $domainName = $_SERVER['HTTP_HOST'] . '/';
  return $protocol . $domainName;
}

function api($value)
{
	if ($value == 'login_fb') {
		// return '701355177153874, 10c9e248729110d46d06f40f5acb56b8';
		return '1794882023993743, 18d3188afc60c0f31518342a87aedf23';
	} elseif ($value == 'login_google') {
		// return '636707262351-sl58b3he6rkitp08722t1oj6vkhd5von.apps.googleusercontent.com, dYeGNNwrm_TzzJY__1pvGhQv';
		return '811302971088-laha3mgvlbq7t5t307jmje0m323pgu95.apps.googleusercontent.com, HXwyPUMuNf9A4HQCnXbEeLg_';
	}
}

function kirim_email($subject,$pesan,$email_to)
{
	$CI =& get_instance();
	$config = [
        'mailtype'  => 'html',
        'charset'   => 'utf-8',
        'protocol'  => 'smtp',
        'smtp_host' => 'smtp.gmail.com',
        'smtp_user' => get_data('setting','nama','email_pengirim','value'),  // Email gmail
        'smtp_pass'   => get_data('setting','nama','password_pengirim','value'),  // Password gmail
        'smtp_crypto' => 'tls',
        'smtp_port'   => 587,
        'crlf'    => "\r\n",
        'newline' => "\r\n"
    ];

    // Load library email dan konfigurasinya
    $CI->email->initialize($config);  
  
	$CI->email->set_newline("\r\n"); 

    // Email dan nama pengirim
    $CI->email->from('test@dokterarief.com', 'Klinik Dokter');

    // Email penerima
    $CI->email->to($email_to); // Ganti dengan email tujuan

    // Lampiran email, isi dengan url/path file
    // $CI->email->attach('https://masrud.com/content/images/20181215150137-codeigniter-smtp-gmail.png');

    // Subject email
    $CI->email->subject($subject);

    // Isi email
    $CI->email->message($pesan);

    // Tampilkan pesan sukses atau error
    if ($CI->email->send()) {
        return 'Sukses! email berhasil dikirim.';
    } else {
    	
    	return $CI->email->print_debugger();
    }
}

function list_date() {

	$tgl1 = date('Y-m-d');// pendefinisian tanggal awal
	$tgl2 = date('Y-m-d', strtotime('+7 days', strtotime($tgl1)));

    $start    = new DateTime($tgl1);
	$end      = new DateTime($tgl2);
	$interval = DateInterval::createFromDateString('1 day');
	$period   = new DatePeriod($start, $interval, $end);

	// foreach ($period as $dt)
	// {
	//     echo $dt->format("l Y-m-d");
	//     echo "<br>";
	// }

	return $period;
}

function cek_hari($date)
{
	$daftar_hari = array(
		'Sunday' => 'Minggu',
		'Monday' => 'Senin',
		'Tuesday' => 'Selasa',
		'Wednesday' => 'Rabu',
		'Thursday' => 'Kamis',
		'Friday' => 'Jumat',
		'Saturday' => 'Sabtu'
	);
	$namahari = date('l', strtotime($date));

	return $daftar_hari[$namahari];
}

function kode_urut($tgl_kunjungan)
{
	error_reporting(0);
	$CI =& get_instance();
	$CI->db->where('tgl_kunjungan', $tgl_kunjungan);
	$CI->db->order_by('no_antrian', 'desc');
	$no_antrian = $CI->db->get('antrian')->row()->no_antrian;
	$urutan = (int) substr($no_antrian, 3,3);
	$urutan++;

	$huruf = "ANT";
	$kode = $huruf. sprintf("%03s", $urutan);

	return $kode;

}

function hitung_umur($tgl_lahir)
{
	// tanggal lahir
	$tanggal = new DateTime($tgl_lahir);

	// tanggal hari ini
	$today = new DateTime('today');

	// tahun
	$y = $today->diff($tanggal)->y;

	// bulan
	$m = $today->diff($tanggal)->m;

	// hari
	$d = $today->diff($tanggal)->d;
	//echo "Umur: " . $y . " tahun " . $m . " bulan " . $d . " hari";

	return $y . " tahun " . $m . " bulan " . $d . " hari";
}

function total_modal_produk($no_penjualan)
{
	$CI =& get_instance();
	$modal = 0;

	foreach ($CI->db->get('penjualan_detail', array('no_penjualan'=>$no_penjualan))->result() as $rw) {
		$modal = $modal + ( modal_produk($rw->id_produk) * $rw->qty ) ;
	}
	return $modal;
}

function modal_produk($id_produk)
{
	$modal = get_data('produk','id_produk',$id_produk,'harga_beli');
	return $modal;
}

function total_stok($id_subkategori)
{
	$total = stok_display($id_subkategori) + stok_gudang($id_subkategori);
	return $total;
}

function stok_display($id_subkategori)
{
	$CI =& get_instance();
	$sql = "
	SELECT
		((COALESCE(SUM(in_qty),0) - COALESCE(SUM(out_qty),0)) ) AS stok_akhir 
	FROM
		stok_transfer
	WHERE
		id_subkategori='$id_subkategori'
		and milik='display';
	";
	$stok = $CI->db->query($sql)->row()->stok_akhir;
	return $stok;
}

function stok_gudang($id_subkategori)
{
	$CI =& get_instance();
	$sql = "
	SELECT
		((COALESCE(SUM(in_qty),0) - COALESCE(SUM(out_qty),0)) ) AS stok_akhir 
	FROM
		stok_transfer
	WHERE
		id_subkategori='$id_subkategori'
		and milik='gudang';
	";
	$stok = $CI->db->query($sql)->row()->stok_akhir;
	return $stok;
}

function cek_ppn($no_po)
{
	$cek = get_data('po_master','no_po',$no_po,'ppn');
	if ($cek == NULL) {
		$cek = 0;
	}
	return $cek;
}

function cek_return($n,$no)
{
	if ($n == '0') {
		return '<a href="app/ubah_return/'.$no.'" onclick="javasciprt: return confirm(\'Are You Sure ?\')"><label class="label label-info"><i class="fa fa-close"></i></label></a>';
	} else {
		return '<label class="label label-success"><i class="fa fa-check"></i></label>';
	}
}

// function create_random($length)
// {
//     $data = 'ABCDEFGHIJKLMNOPQRSTU1234567890';
//     $string = '';
//     for($i = 0; $i < $length; $i++) {
//         $pos = rand(0, strlen($data)-1);
//         $string .= $data{$pos};
//     }
//     return $string;
// }

function upload_gambar_biasa($nama_gambar, $lokasi_gambar, $tipe_gambar, $ukuran_gambar, $name_file_form)
{
    $CI =& get_instance();
    $nmfile = $nama_gambar."_".time();
    $config['upload_path'] = './'.$lokasi_gambar;
    $config['allowed_types'] = $tipe_gambar;
    $config['max_size'] = $ukuran_gambar;
    $config['file_name'] = $nmfile;
    // load library upload
    $CI->load->library('upload', $config);
    // upload gambar 1
    if ( ! $CI->upload->do_upload($name_file_form)) {
    	return $CI->upload->display_errors();
    } else {
	    $result1 = $CI->upload->data();
	    $result = array('gambar'=>$result1);
	    $dfile = $result['gambar']['file_name'];
	    
	    return $dfile;
	}	
}

function get_ph($no_po,$total_h)
{
	$CI =& get_instance();
	// log_r($total_h);
	// if ($total_h = '') {
	// 	$total_h = 0;
	// }
	$ph = $CI->db->get_where('po_master', array('no_po'=>$no_po))->row()->potongan_harga;
	$d_ph = explode(';', $ph);
	$t_h_now = $total_h;
	foreach ($d_ph as $key => $value) {
		if (strstr($value, '%')) {
			$t_persen = str_replace('%', '', $value) /100;
			$n_persen = $t_persen * $t_h_now;
			$t_h_now = $t_h_now - $n_persen;
		} else {
			$t_h_now = $t_h_now - floatval($value);
			// log_r($t_h_now);
		}
	}
	return $t_h_now;

}

function get_diskon_beli($diskon,$total_h)
{
	$CI =& get_instance();
	// log_r($total_h);
	// if ($total_h = '') {
	// 	$total_h = 0;
	// }
	$ph = $diskon;
	$d_ph = explode(';', $ph);
	$t_h_now = $total_h;
	foreach ($d_ph as $key => $value) {
		if (strstr($value, '%')) {
			$t_persen = str_replace('%', '', $value) /100;
			$n_persen = $t_persen * $t_h_now;
			$t_h_now = $t_h_now - $n_persen;
		} else {
			$t_h_now = $t_h_now - floatval($value);
			// log_r($t_h_now);
		}
	}
	return $t_h_now;

}


function get_waktu()
{
	date_default_timezone_set('Asia/Jakarta');
	return date('Y-m-d H:i:s');
}
function select_option($name, $table, $field, $pk, $selected = null,$class = null, $extra = null, $option_tamabahan = null) {
    $ci = & get_instance();
    $cmb = "<select name='$name' class='form-control $class  ' $extra>";
    $cmb .= $option_tamabahan;
    $data = $ci->db->get($table)->result();
    foreach ($data as $row) {
        $cmb .="<option value='" . $row->$pk . "'";
        $cmb .= $selected == $row->$pk ? 'selected' : '';
        $cmb .=">" . strtoupper($row->$field ). "</option>";
    }
    $cmb .= "</select>";
    return $cmb;
}

function get_setting($select)
{
	return 'KLINIK DOKTER';
}

function tanggal_indo($tanggal)
{
	$bulan = array (1 =>   'Januari',
				'Februari',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agustus',
				'September',
				'Oktober',
				'November',
				'Desember'
			);
	$split = explode('-', $tanggal);
	return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
}

function get_data($tabel,$primary_key,$id,$select)
{
	$CI =& get_instance();
	$data = $CI->db->query("SELECT $select FROM $tabel where $primary_key='$id' ");
	if ($data->num_rows() > 0) {
		$data = $data->row_array();
		return $data[$select];
	} else {
		return '';
	}
	
}

function get_produk($barcode,$select)
{
	$CI =& get_instance();
	$data = $CI->db->query("SELECT $select FROM produk where barcode1='$barcode' or barcode2='$barcode' ")->row_array();
	return $data[$select];
}



function alert_biasa($pesan,$type)
{
	return 'swal("'.$pesan.'", "You clicked the button!", "'.$type.'");';
}

function alert_tunggu($pesan,$type)
{
	return '
	swal("Silahkan Tunggu!", {
	  button: false,
	  icon: "info",
	});
	';
}

function selisih_waktu($start_date)
{
	date_default_timezone_set('Asia/Jakarta');
	$waktuawal  = date_create($start_date); //waktu di setting

	$waktuakhir = date_create(date('Y-m-d H:i:s')); //2019-02-21 09:35 waktu sekarang

	//Membandingkan
	$date1 = new DateTime($start_date);
	$date2 = new DateTime(date('Y-m-d H:i:s'));
	if ($date2 < $date1) {
	    $diff  = date_diff($waktuawal, $waktuakhir);
		return $diff->d . ' hari '.$diff->h . ' jam lagi ';
	} else {
		return 'berlangsung';
	}

	

	// echo 'Selisih waktu: ';

	// echo $diff->y . ' tahun, ';

	// echo $diff->m . ' bulan, ';

	// echo $diff->d . ' hari, ';

	// echo $diff->h . ' jam, ';

	// echo $diff->i . ' menit, ';

	// echo $diff->s . ' detik, ';
}



function filter_string($n)
{
	$hasil = str_replace('"', "'", $n);
	return $hasil;
}

function cek_nilai_lulus()
{	
	$CI 	=& get_instance();
	$nilai = $CI->db->query("SELECT sum(nilai_lulus) as lulus FROM mapel ")->row()->lulus;
	return $nilai;
}



function log_r($string = null, $var_dump = false)
    {
        if ($var_dump) {
            var_dump($string);
        } else {
            echo "<pre>";
            print_r($string);
        }
        exit;
    }

    function log_data($string = null, $var_dump = false)
    {
        if ($var_dump) {
            var_dump($string);
        } else {
            echo "<pre>";
            print_r($string);
        }
        // exit;
    }