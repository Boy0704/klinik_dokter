<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_user extends CI_Controller {

	
	public function index()
	{
		if ($this->session->userdata('level') == 'user') {
			redirect('app','refresh');
		} else {
			$this->load->view('login_user');
		}
		
	}

	public function auth()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		// $hashed = '$2y$10$LO9IzV0KAbocIBLQdgy.oeNDFSpRidTCjXSQPK45ZLI9890g242SG';
		$cek_user = $this->db->query("SELECT * FROM member WHERE email='$username' and password='$password' ");
		// if (password_verify($password, $hashed)) {
		if ($cek_user->num_rows() > 0) {
			foreach ($cek_user->result() as $row) {
				
                $sess_data['id_user'] = $row->id_member;
				$sess_data['nama'] = $row->nama;
				// $sess_data['username'] = $row->username;
				$sess_data['foto'] = 'default.png';
				$sess_data['level'] = 'user';
				$this->session->set_userdata($sess_data);
			}

			// define('FOTO', $this->session->userdata('foto'), TRUE);
			

			// print_r($this->session->userdata());
			// exit;
			// $sess_data['username'] = $username;
			// $this->session->set_userdata($sess_data);
			if ($this->session->userdata('level') == 'user') {
				redirect('app','refresh');
			// 	echo 'Server TimeOut';
			}
			

			// redirect('app/index');
		} else {
			$this->session->set_flashdata('message', alert_biasa('Gagal Login!\n username atau password kamu salah','warning'));
			// $this->session->set_flashdata('message', alert_tunggu('Gagal Login!\n username atau password kamu salah','warning'));
			redirect('login_user','refresh');
		}
	}

	public function auth_pass()
	{
		$username = $this->input->get('username');
		?>
		<script type="text/javascript" src="<?php echo base_url() ?>assets/is-private-mode.js"></script>
		<script type="text/javascript">
	        // isPrivateMode().then(function (isPrivate) {
	        //   if (!isPrivate) {
	        //   	alert("Kamu tidak di mode private, silahkn klik kanan \"Open in Mode Incegnito\" ");
	        //   	return window.history.back();
	        //   } else {
	        //   	return window.location="<?php echo base_url() ?>proses_auth_pass?username=<?php echo $username ?>";
	        //   }
	        // });
	        return window.location="<?php echo base_url() ?>proses_auth_pass?username=<?php echo $username ?>";



	    </script>
		<?php
		
	}

	public function proses_auth_pass()
	{
		$username = $this->input->get('username');

		// $hashed = '$2y$10$LO9IzV0KAbocIBLQdgy.oeNDFSpRidTCjXSQPK45ZLI9890g242SG';
		$cek_user = $this->db->query("SELECT * FROM member WHERE email='$username'");
		// if (password_verify($password, $hashed)) {
		if ($cek_user->num_rows() > 0) {
			foreach ($cek_user->result() as $row) {
				
                $sess_data['id_user'] = $row->id_member;
				$sess_data['nama'] = $row->nama;
				// $sess_data['username'] = $row->username;
				$sess_data['foto'] = 'default.png';
				$sess_data['level'] = 'user';
				$this->session->set_userdata($sess_data);
			}

			// define('FOTO', $this->session->userdata('foto'), TRUE);
			

			// print_r($this->session->userdata());
			// exit;
			// $sess_data['username'] = $username;
			// $this->session->set_userdata($sess_data);
			if ($this->session->userdata('level') == 'user') {
				redirect('app','refresh');
			// 	echo 'Server TimeOut';
			}
			

			// redirect('app/index');
		} else {
			$this->session->set_flashdata('message', alert_biasa('Gagal Login!\n username kamu salah','warning'));
			// $this->session->set_flashdata('message', alert_tunggu('Gagal Login!\n username atau password kamu salah','warning'));
			redirect('login_user','refresh');
		}
	}

	// LOGIN SOSMED ==============================================================

	public function login_fb()
	{
		$_POST['oauth_token'] = 'access_token';
		if (empty($_POST['oauth_token'])) { redirect('404'); }
		include_once APPPATH.'/functions/sosmed/Facebook/autoload.php'; // panggil autoload dari Facebook SDK
		$log_fb = explode(", ", api('login_fb'));
		$app_id = $log_fb[0];
		$secret_id = $log_fb[1];

		$fb = new Facebook\Facebook([
		    'app_id' => $app_id,
		    'app_secret' => $secret_id,
		    'default_graph_version' => 'v2.9',
		    //'default_access_token' => '{access-token}', // optional
		]);

		try {
		    // Get the FacebookGraphNodesGraphUser object for the current user.
		    // If you provided a 'default_access_token', the '{access-token}' is optional.
		    $response = $fb->get('/me?fields=first_name,last_name,email,id,gender', $_POST['oauth_token']);
		} catch(FacebookExceptionsFacebookResponseException $e) {
		    // When Graph returns an error
		    echo 'Graph returned an error: ' . $e->getMessage();
		    exit;
		} catch(FacebookExceptionsFacebookSDKException $e) {
		    // When validation fails or other local issues
		    echo 'Facebook SDK returned an error: ' . $e->getMessage();
		    exit;
		}

		$me = $response->getGraphUser();
		log_r($me);
		$fullName = $me['first_name']." ".$me['last_name'];
		$email 		= $me['email'];
		$token    = $me['id'];
		$ip    		= $_SERVER['REMOTE_ADDR'];

		// echo "Nama : ".$fullName.", Email : ".$email;
		$level=1; //member
		$id_new = $token;
		$get = get('user', array('token_fb'=>$token));
		if ($get->num_rows()==0) {
			$post = array('username'=>$email, 'password'=>encode($token), 'token_fb'=>$token, 'level'=>$level, 'status'=>'1', 'mode'=>'0', 'tgl_input'=>tgl_now());
			$simpan = add_data('user', $post);
			$id_new = $this->db->insert_id();
			$post2 = array('id_user'=>$id_new, 'nama_lengkap'=>$fullName, 'email'=>$email, 'no_hp'=>'', 'jenis_akun'=>0);
			$simpan2 = add_data('user_biodata', $post2);
		}else {
			$id_new = $get->row()->id_user;
		}
    $this->session->sess_expiration = 0;
		set_session('id_user', "$id_new");
		set_session('username', "$email");
		set_session('level', $level);
		set_session('time', time());
		$pesan = "Selamat Datang ".$fullName.", Selamat beraktifitas :)";
		pesan('success','msg_dashboard','',$pesan,'ajax');
	}


	public function login_google()
	{
		include_once APPPATH.'/functions/sosmed/Google/config.php';

		if(!empty($_GET["code"])){
			 $get_token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
			 if(!isset($token['error'])){
				  $token = $get_token['access_token'];
				  $google_client->setAccessToken($token);
				  $google_service = new Google_Service_Oauth2($google_client);
				  $data = $google_service->userinfo->get();

				  log_r($data);

					$fullName=''; $email=''; $gender=''; $picture='';
				  if(!empty($data['name'])){
				   	$fullName = $data['name'];
				  }

					if(!empty($data['email'])){
				   $email = $data['email'];
				  }

				  if(!empty($data['gender'])){
				   $gender = $data['gender'];
				  }

				  if(!empty($data['picture'])){
				   $picture = $data['picture'];
				  }

					$level=1; //member
					$id_new = $token;
					$get = get('user', array('token_google'=>$token));
					if ($get->num_rows()==0) {
						$post = array('username'=>$email, 'password'=>encode($token), 'token_google'=>$token, 'level'=>$level, 'status'=>'1', 'mode'=>'0', 'tgl_input'=>tgl_now());
						$simpan = add_data('user', $post);
						$id_new = $this->db->insert_id();
						$post2 = array('id_user'=>$id_new, 'nama_lengkap'=>$fullName, 'email'=>$email, 'no_hp'=>'', 'jenis_akun'=>0);
						$simpan2 = add_data('user_biodata', $post2);
					}else {
						$id_new = $get->row()->id_user;
					}
			    $this->session->sess_expiration = 0;
					set_session('token_google', "$token");
					set_session('id_user', "$id_new");
					set_session('username', "$email");
					set_session('level', $level);
					set_session('time', time());
					$pesan = "Selamat Datang ".$fullName.", Selamat beraktifitas :)";
					pesan('success','msg_dashboard','',$pesan,'dashboard');
			 }else {
				 pesan('warning','msg','','Gagal, silahkan coba lagi!','auth/login');
			 }

		 }else {
			 redirect($google_client->createAuthUrl());
		 }

	}



	function logout()
	{
		include_once APPPATH.'/functions/sosmed/Google/config.php';
		if (!empty($this->session->userdata('token_google'))) {
			$google_client->revokeToken();
		}
		$this->session->unset_userdata('id_user');
		$this->session->unset_userdata('nama');
		$this->session->unset_userdata('level');
		session_destroy();
		redirect('login_user','refresh');
	}

}
