<?php 

	/**
	 * 
	 */
	class Auth extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->library('cart');
		}

		function login(){
			$data['cart'] = $this->cart->contents();
			$this->load->view('template/header', $data);
			$this->load->view('auth/login');
			$this->load->view('template/footer');

		}

		function act_login(){

			$email = $this->input->post('email');
			$pass = $this->input->post('pass');

			$cekemail = $this->db->get_where('tbl_register',['email' => $email])->row_array();
			if ($cekemail == true) {

				if ($cekemail['status'] == 0) {
					
					$this->session->set_flashdata('message', 'swal("Opps!", "kode otp anda belum aktif", "warning" );');
					redirect('auth/login');
				}else{
					if (password_verify($pass, $cekemail['pass'])) {

						$data = [
							'email' => $cekemail['email'],
							'name' => $cekemail['name'],
							'kode_user' => $cekemail['kode_user'],
						];
						$this->session->set_userdata($data);
						redirect('shop/');
					}else{

						$this->session->set_flashdata('message', 'swal("Opps!", "password anda salah", "warning" );');
						redirect('auth/login');
					}	
				}
				
			}else{

				$this->session->set_flashdata('message', 'swal("Opps!", "akun anda tidak terdaftar", "warning" );');
				redirect('auth/login');
			}

		}

		function register(){
			$this->load->library('form_validation');

			$this->form_validation->set_rules('name', 'name', 'required');
			$this->form_validation->set_rules('email', 'email', 'required|is_unique[tbl_register.email]');
			$this->form_validation->set_rules('pass', 'password', 'required|min_length[6]');
			$this->form_validation->set_rules('pass1', 'confirm password', 'required|matches[pass]|min_length[6]');

			if ($this->form_validation->run() == false) {
				
				$data['cart'] = $this->cart->contents();
				$this->load->view('template/header', $data);
				$this->load->view('auth/register');
				$this->load->view('template/footer');
			}else{

				$otp = rand(10, 10000);
				$data = [
					'kode_user' => "user-".rand(10, 10000),
					'name' => $this->input->post('name'),
					'email' => $this->input->post('email'),
					'pass' => password_hash($this->input->post('pass'), PASSWORD_DEFAULT),
					'kode_otp' => $otp,
				];

				$input = $this->db->insert('tbl_register', $data);
				// $this->sendemail($this->input->post('email'), $otp);
				$this->session->set_flashdata('message', 'swal("Yess", "Regiser anda berhasil", "success" );');
				redirect('Auth/otp');
			}


			

		}

		// function sendemail($email, $otp){

		// 	$this->load->library('email');
		// 	$ci = get_instance();
		// 	$config['protocol'] = "SMTP";
		// 	$config['smtp_host'] = "mail.ratumerak.id";
		// 	$config['smtp_port'] = "465";
		// 	$config['smtp_user'] = "cs@ratumerak.id";
		// 	$config['smtp_pass'] = "ratumerak123";
		// 	$config['charset'] = "utf-8";
		// 	$config['mailtype'] = "html";
		// 	$config['newline'] = "\r\n";
		// 	$ci->email->initialize($config);


		// 	$this->email->from('cs@ratumerak.id', 'Ratumrakshop');
		// 	$this->email->to($email);

		// 	$this->email->subject('KODE OTP RATUMERAKSHOP');
		// 	$this->email->message("<p> Terima kasih sudah melakukan registrasi</p><p><b>KODE OTP : ". $otp."</p>");

		// 	if (!$this->email->send())
		// 		show_error($this->email->print_debugger());
		// 	else
		// 		echo 'Your e-mail has been sent!';
		// }



		function logout(){

			$this->session->unset_userdata('kod_user');
			$this->session->unset_userdata('email');
			$this->session->unset_userdata('name');
			$this->session->set_flashdata('keluar', 'keluar');
			redirect('auth/login');
			
			
		}

		function otp(){

			$data['cart'] = $this->cart->contents();
			$this->load->view('template/header', $data);
			$this->load->view('auth/otp');
			$this->load->view('template/footer');

		}

		function act_otp(){

			$otp = $this->input->post('otp');
			
			$cek = $this->db->get_where('tbl_register',['kode_otp' => $otp])->row_array();
			if ($cek == true) {
				$this->db->where('kode_user', $cek['kode_user']);
				$this->db->update('tbl_register',['status' => 1]);
				$this->session->set_flashdata('message', 'swal("Yess", "kode otp anda berhasil", "success" );');
				redirect('Auth/login');

			}else{
				$this->session->set_flashdata('otp', 'error" );');
				redirect('Auth/otp');
				
			}
		}


	}
?>