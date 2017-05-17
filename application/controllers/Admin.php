<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	function __construct()
	{	
		parent::__construct();

		if ( $this->session->userdata ('username') === NULL )
			redirect ('home');
	}

	function index()
	{
		$this->dashboard();
		$this->load->library ('uploader');
		
	}

	function dashboard()
	{
		$data['css'] = array ('assets/css/searchbar.css', 'assets/css/statbox.css', 'assets/css/tablepanel.css');
		$this->load->view('header', $data);
		$this->load->view('admin/navbar');
		$this->load->view('admin/dashboard');
		$this->load->view('footer');
	}

	function tambah()
	{
		if ( ! empty ($this->input->post()) )
		{
			$this->load->library ('uploader');
			$this->load->model ('poster_model');

			$uploaded_file = $this->uploader->upload ($_FILES['file']);
			if ($uploaded_file == NULL)
				redirect ('admin/tambah');

			$input = array (
				'nama_penulis'		=>	$this->input->post ('nama'),
				'judul_publikasi'	=>	$this->input->post ('judul'),
				'tahun_publikasi'	=> 	$this->input->post ('tahun'),
				'id_rmk'			=>	$this->input->post ('rumpun'),
				'path_image'		=>	$uploaded_file
			);

			$this->poster_model->insert ($input);
		}

		$this->load->model ('rmk_model');
		$content['rmk'] = $this->rmk_model->all();

		$this->load->view('header');
		$this->load->view('admin/navbar');
		$this->load->view('admin/inputposter', $content);
		$this->load->view('footer');
	}

	function edit()
	{
		$this->load->model ('poster_model');
		$poster = $this->poster_model->find_id ($this->input->post ('id_poster'));

		$this->load->model ('rmk_model');
		$content['rmk'] = $this->rmk_model->all();

		$this->load->view('header');
		$this->load->view('admin/navbar');
		$this->load->view('admin/manajemendata', $content);
		$this->load->view('footer');
	}

	function poster()
	{
		$this->load->view('header');
		$this->load->view('admin/navbar');
		$this->load->view('admin/posterlist');
		$this->load->view('footer');
	}
}
