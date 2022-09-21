<?php 

	/**
	 * 
	 */
	class Admin extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
		}

		function index(){


			$this->load->view('template_admin/header');
			$this->load->view('admin/index');
			$this->load->view('template_admin/footer');
		}

		function data_produk(){


			$this->db->select('*');
			$this->db->from('tbl_produk');
			$this->db->join('tbl_kategori', 'tbl_kategori.kode_kategori = tbl_produk.kategori');
			$data['produk'] = $this->db->get()->result_array();

			$data['kategori'] = $this->db->get('tbl_kategori')->result_array();

			$this->load->view('template_admin/header');
			$this->load->view('admin/data_produk', $data);
			$this->load->view('template_admin/footer');
		}

		function tambah_produk(){

			$config['upload_path']          = './assets/img/products/';
			$config['allowed_types']        = 'jpg|png|jpeg';
			$config['min_size']             = 9000000;
			$config['remove_spaces']        = false;

			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('gambar')){
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('message', 'swal("Opps", "file gambar anda tidak suport", "warning" );');
				redirect('admin/data_produk');

			}else{

				$data = [
					'kode_produk' => 'produk-'.rand(0,100000),
					'nama_produk' => $this->input->post('nama_produk'),
					'kategori' => $this->input->post('kategori'),
					'harga' => $this->input->post('harga'),
					'ket' => $this->input->post('ket'),
					'gambar' => $_FILES['gambar']['name'],
				];

				$this->db->insert('tbl_produk', $data);
				$this->session->set_flashdata('message', 'swal("Yess!", "Produk berhasil ditambah", "success" );');
				redirect('admin/data_produk');
			}
		}

		function hapus_produk(){

			$id = $this->input->post('id');
			$this->db->where('id', $id);
			$this->db->delete('tbl_produk');

			$this->session->set_flashdata('message', 'swal("Yess!", "Produk berhasil dihapus", "success" );');
			redirect('admin/data_produk');
		}

		function data_kategori(){

			$data['kategori'] = $this->db->get('tbl_kategori')->result_array();

			$this->load->view('template_admin/header');
			$this->load->view('admin/data_kategori', $data);
			$this->load->view('template_admin/footer');
		}

		function tambah_kategori(){

			$kode = "KT-".rand(0,1000);
			$nama_kategori = $this->input->post('nama_kategori');     
			$slug = str_replace(" ", "-", $nama_kategori);
			$slug = ucwords($slug);

			$data = [
				'kode_kategori' => $kode,
				'nama_kategori' => $nama_kategori,
				'slug' => strtolower($slug),
			];

			$this->db->insert('tbl_kategori', $data);
			$this->session->set_flashdata('message', 'swal("Yess!", "Kategori berhasil ditambah", "success" );');
			redirect('admin/data_kategori');
		}

		function hapus_kategori(){

			$id = $this->input->post('id');
			$this->db->where('id', $id);
			$this->db->delete('tbl_kategori');
			$this->session->set_flashdata('message', 'swal("Yess!", "Kategori berhasil dihapus", "success" );');
			redirect('admin/data_kategori');
		}

		function edit_kategori(){

			$data = [
				'nama_kategori' => $this->input->post('nama_kategori'),
			];
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('tbl_kategori', $data);
			$this->session->set_flashdata('message', 'swal("Yess!", "Kategori berhasil diedit", "success" );');
			redirect('admin/data_kategori');
		}


		function data_user(){

			$data['user'] = $this->db->get('tbl_register')->result_array();

			$this->load->view('template_admin/header');
			$this->load->view('admin/data_user', $data);
			$this->load->view('template_admin/footer');
		}

		function hapus_user(){

			$id = $this->input->post('id');
			$this->db->where('id', $id);
			$this->db->delete('tbl_register');
			$this->session->set_flashdata('message', 'swal("Yess!", "User berhasil dihapus", "success" );');
			redirect('admin/data_user');
		}
	}

?>