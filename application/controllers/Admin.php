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

			// $this->load->view('template_admin/header');
			// $this->load->view('admin/data_produk');
			// $this->load->view('template_admin/footer');
		}
	}

?>