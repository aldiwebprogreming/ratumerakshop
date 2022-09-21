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
	}

?>