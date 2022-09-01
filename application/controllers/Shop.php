<?php 

	/**
	 * 
	 */
	class Shop extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->library('cart');
		}


		function index(){

			$this->db->select('*');
			$this->db->from('tbl_produk');
			$this->db->join('tbl_kategori', 'tbl_kategori.kode_kategori = tbl_produk.kategori');
			$data['produk'] = $this->db->get()->result_array();

			$data['cart'] = $this->cart->contents();

			$this->load->view('template/header', $data);
			$this->load->view('shop/index', $data);
			$this->load->view('template/footer');
		}

		function add_cart(){
			$this->load->library('cart');
			$nama_produk = $this->input->post('nama');
			$harga = $this->input->post('harga');
			$qty = $this->input->post('qty');
			$total_harga = $this->input->post('total_harga');

			$data = array(
				'id'      => $this->input->post('kode_produk'),
				'qty'     => $qty,
				'price'   => $harga,
				'name'    => $nama_produk,
				'total_harga' => $total_harga,
				
			);
			$cart = $this->cart->insert($data);

			$this->load->view('shop/cart');
			
		}

		function cart(){

			$kode_produk = $this->input->get('kode_produk');
			$produk = $this->db->get_where('tbl_produk',['kode_produk' => $kode_produk])->row_array();
			
			$total_harga = $this->input->get('harga') * $this->input->get('qty');
			$data = array(
				'id'      => $kode_produk,
				'qty'     => $this->input->get('qty'),
				'price'   => $this->input->get('harga'),
				'name'    => $produk['nama_produk'],
				'kategori'    => $produk['kategori'],
				'total_harga' => $total_harga,
				'gambar' => $produk['gambar'],
				
			);
			$cart = $this->cart->insert($data);
			$display = $this->cart->contents();
			echo count($display);
		}

		function cart2(){
			
			$display = $this->cart->contents();
			echo count($display);
		}

		function tampil_cart(){
			$data['cart'] = $this->cart->contents();
			$this->load->view('shop/tampil_cart', $data);
		}

		function hapus_cart(){

			$rowid = $this->input->get('id');
			$this->cart->remove($rowid);
			redirect('shop/index');
		}

		function hapus(){

			$cart = $this->cart->contents();
			foreach ($cart as $item) {
				$this->cart->remove($item['rowid']);
			}
			
		}

		function cart_detail(){
			$data['cart'] = $this->cart->contents();
			$this->load->view('template/header');
			$this->load->view('shop/cart_detail', $data);
			$this->load->view('template/footer');
		}

		function checkout(){

			$produk = $this->input->post('produk');
			$jml = count($produk);

			$kode_order = "order-".rand(10, 10000);
			$kode_produk = $this->input->post('kode_produk');
			$kode_user = $this->session->kode_user;
			$nama_produk = $this->input->post('produk');
			$kategori = $this->input->post('kategori');
			$harga = $this->input->post('harga');
			$qty = $this->input->post('qty');


			$total_pembayaran = 0;

			for ($i=0; $i < $jml ; $i++) { 

				$total_pembayaran += $harga[$i] * $qty[$i];
				$data = [

					'kode_order' => $kode_order,
					'kode_produk' => $kode_produk[$i],
					'kode_user' => $kode_user,
					'nama_produk' => $nama_produk[$i],
					'kategori' => $kategori[$i],
					'harga' => $harga[$i],
					'qty' => $qty[$i],
					'total_harga' => $harga[$i] * $qty[$i]
				];

				$input = $this->db->insert('tbl_order', $data);
			}

			$this->db->where('kode_order', $kode_order);
			$update = $this->db->update('tbl_order',['total_pembayaran' => $total_pembayaran]);

			if ($update == true) {

				$alamat = $this->input->post('alamat');
				if ($alamat == null) {
					$alamat = '';
				}else{
					$alamat = $this->input->post('alamat');
				}

				$data = [

					'kode_user' => $kode_user,
					'kode_order' => $kode_order,
					'wa' => $this->input->post('wa'),
					'tgl_pengantaran' => $this->input->post('tgl_pengantaran'),
					'sistem_pengambilan' => $this->input->post('sistem_pengambilan'),
					'alamat_pengantaran' => $alamat,
					'jumlah_pembayaran' => $total_pembayaran,
					'status_pembayaran' => 0
				];

				$this->db->insert('tbl_checkout', $data);
				$this->hapus();
				$this->session->set_flashdata('message', 'swal("Yess", "Checkout anda berhasil", "success" );');
				redirect('shop/order');
			}


		}

		function totalpembayaran(){

			$rowid = $this->input->get('id');
			$total = $this->input->get('totalharga');

			$data = [
				'rowid' => $rowid,
				'total_harga' => $total
			];

			$this->cart->update($data);
			$cart =  $this->cart->contents();

			$totalharga = 0;
			foreach ($cart as $update) {

				$totalharga += $update['total_harga'];

			}

			echo "Rp " . number_format($totalharga,0,',','.');
		}


		function order(){
			$kode_user = $this->session->kode_user;
			$data['order'] = $this->db->get_where('tbl_checkout',['kode_user' => $kode_user])->result_array();
			$this->load->view('template/header');
			$this->load->view('shop/order', $data);
			$this->load->view('template/footer');

		}


		function act_login(){

			$email = $this->input->post('email');
			$pass = $this->input->post('pass');

			$cekemail = $this->db->get_where('tbl_register',['email' => $email])->row_array();
			if ($cekemail == true) {

				if ($cekemail['status'] == 0) {
					
					$this->session->set_flashdata('message', 'swal("Opps!", "kode otp anda belum aktif", "warning" );');
					redirect('shop/cart_detail');
				}else{
					if (password_verify($pass, $cekemail['pass'])) {

						$data = [
							'email' => $cekemail['email'],
							'name' => $cekemail['name'],
							'kode_user' => $cekemail['kode_user'],
						];
						$this->session->set_userdata($data);
						$this->session->set_flashdata('message', 'swal("Yess!", "login anda berhasil", "success" );');
						redirect('shop/cart_detail');
					}else{

						$this->session->set_flashdata('message', 'swal("Opps!", "password anda salah", "warning" );');
						redirect('shop/cart_detail');
					}	
				}
				
			}else{

				$this->session->set_flashdata('message', 'swal("Opps!", "akun anda tidak terdaftar", "warning" );');
				redirect('shop/cart_detail');
			}

		}

		function pembayaran($kode_order){
			$data['cart'] = $this->cart->contents();
			$data['bayar'] = $this->db->get_where('tbl_checkout',['kode_order' => $kode_order])->row_array();
			$this->load->view('template/header');
			$this->load->view('shop/pembayaran',$data);
			$this->load->view('template/footer');

		}

		function konfirmasi_pembayaran($kode_order){



			$this->load->library('form_validation');
			$this->form_validation->set_rules('kode_order', 'kode order', 'required');
			$this->form_validation->set_rules('tgl_pembayaran', 'tgl pembayaran', 'required');
			$this->form_validation->set_rules('bank_pengirim', 'bank pengirim', 'required');
			$this->form_validation->set_rules('nama_rekening', 'nama rekening', 'required');
			$this->form_validation->set_rules('jumlah_pembayaran', 'jumlah pembayaran', 'required');
			

			if ($this->form_validation->run() == false) {


				$data['order'] = $this->db->get_where('tbl_checkout',['kode_order' => $kode_order])->row_array();

				$this->load->view('template/header');
				$this->load->view('shop/konfirmasi_pembayaran',$data);
				$this->load->view('template/footer');

			}else{

				$config['upload_path']          = './assets/bukti/';
				$config['allowed_types']        = 'jpg|png|jpeg';
				$config['min_size']             = 9000000;
				$config['remove_spaces']        = false;

				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('bukti')){
					$error = array('error' => $this->upload->display_errors());
					$this->session->set_flashdata('message', 'swal("Ops!!", "format gambar tidak sesuai", "warning" );');
					redirect("shop/pembayaran/$kode_order");

				}else{

					$cek_konfirmasi = $this->db->get_where('tbl_bukti_pembayaran',['kode_order' => $kode_order])->row_array();

					if ($cek_konfirmasi == true) {

						$this->session->set_flashdata('message', 'swal("Ops!", "konfirmasi pembayaran sudah pernah dilakukan", "error" );');
						redirect("shop/pembayaran/$kode_order");

					}

					$data = [

						'kode_user' => $this->session->kode_user,
						'kode_order' => $this->input->post('kode_order'),
						'tgl_pembayaran' => $this->input->post('tgl_pembayaran'),
						'bank_pengirim' => $this->input->post('bank_pengirim'),
						'nama_rekening' => $this->input->post('nama_rekening'),
						'jumlah_pembayaran' => $this->input->post('jumlah_pembayaran'),
						'pesan' => $this->input->post('pesan_tambahan'),
						'bukti_pembayaran' => $_FILES['bukti']['name'],
						'status' => 0,

					];

					$this->db->insert('tbl_bukti_pembayaran', $data);

				}

				$this->session->set_flashdata('message', 'swal("Yess!", "data berhasil dikirim", "success" );');
				redirect("shop/index");

			}

			


		}

		function cekorder(){

			$kode = $this->input->get('kode');
			$cek = $this->db->get_where('tbl_checkout',['kode_order' => $kode])->row_array();
			if ($kode == '') {
				echo ' <small id="emailHelp" class="form-text text-muted">Masukan kode order anda untuk melihat jumlah pembayaran yang harus di lakukan </small>';
			}else{
				if ($cek == true) {

					echo '<div class="alert alert-success mt-2 text-center" role="alert">
					<i class="fa fa-check-circle-o" aria-hidden="true"></i> Kode order yang anda masukan benar.
					</div>';
				}else{
					echo '<div class="alert alert-danger mt-2 text-center" role="alert">
					<i class="fa fa-times-circle-o" aria-hidden="true"></i> Kode order yang anda masukan salah.
					</div>';
				}
			}
		}


		function join(){
			
			$this->db->select('*');
			$this->db->from('tbl_order');
			$this->db->join('tbl_checkout', 'tbl_checkout.kode_order = tbl_order.kode_order');
			$query = $this->db->get()->result_array();

			var_dump($query);


		}

		
	}

?>