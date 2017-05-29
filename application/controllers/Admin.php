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
		$this->load->model ('poster_model');

		$data['css'] = array ('assets/css/searchbar.css', 'assets/css/statbox.css', 'assets/css/tablepanel.css');
		$content['total_poster'] = $this->poster_model->count ();
		$content['total_tercetak'] = $this->poster_model->count (array ('sudah_publish' => 1));
		$content['poster_mutakhir'] = $this->poster_model->get ( array ('judul_publikasi', 'nama_penulis', 'waktu_entri'), NULL, NULL, array ('waktu_entri' => 'DESC'), 0, 5);
		$content['poster_tercetak'] = $this->poster_model->get ( array ('judul_publikasi', 'nama_penulis', 'waktu_entri', 'waktu_cetak'), array ('sudah_publish' => 1), NULL, array ('waktu_entri' => 'DESC'), 0, 5);

		$this->load->view('header', $data);
		$this->load->view('admin/navbar');
		$this->load->view('admin/dashboard', $content);
		$this->load->view('footer');
	}

	function tambah()
	{
		if ( ! empty ($this->input->post()) )
		{
			$success = $this->tambah_form_handler();

			if ( $success )
				redirect ('admin/poster');
		}

		$this->load->model ('rmk_model');
		$content['rmk'] = $this->rmk_model->all();

		if ( isset ($success))
			$css['css'] = array ('assets/css/validation_error.css');
		else
			$css = array();
		
		$this->load->view('header', $css);
		$this->load->view('admin/navbar');

		if (isset ($success))
			$this->load->view('validation_error');
		
		$this->load->view('admin/inputposter', $content);
		$this->load->view('footer');
	}

	private function tambah_form_handler()
	{
		$this->load->library ('form_validation');
		$this->form_validation->set_rules ('nama', 'Nama Author', 'required|max_length[100]');
		$this->form_validation->set_rules ('judul', 'Judul Tugas Akhir', 'required|max_length[250]');
		$this->form_validation->set_rules ('tahun', 'Tahun Publikasi', 'required|max_length[4]');
		$this->form_validation->set_rules ('rumpun', 'Rumpun Mata Kuliah', 'required');

		if ($this->form_validation->run() == FALSE)
			return FALSE;

		$this->load->library ('uploader');
		$this->load->model ('poster_model');

		$uploaded_file = $this->uploader->upload ($_FILES['file']);
		if ($uploaded_file == NULL)
			return FALSE;
		
		$input = array (
			'nama_penulis'		=>	$_POST['nama'],
			'judul_publikasi'	=>	$_POST['judul'],
			'tahun_publikasi'	=> 	$_POST['tahun'],
			'id_rmk'			=>	$_POST['rumpun'],
			'path_image'		=>	$uploaded_file
		);

		return $this->poster_model->insert ($input);
	}

	function edit($id_poster)
	{
		if ( ! empty ($this->input->post()) )
		{
			$success = $this->edit_form_handler();
			
			if ($success)
				redirect ('admin/poster');
		}
		$this->load->model ('poster_model');
		$poster = $this->poster_model->get (NULL, array ('id_poster' => $id_poster) )[0];

		$this->load->model ('rmk_model');
		$content['rmk'] = $this->rmk_model->all();
		$content['poster'] = $poster;

		$this->load->view('header');
		$this->load->view('admin/navbar');
		$this->load->view('admin/manajemendata', $content);
		$this->load->view('footer');
	}

	private function edit_form_handler()
	{
		$this->load->library ('form_validation');
		$this->form_validation->set_rules ('nama', 'Nama Author', 'required|max_length[100]');
		$this->form_validation->set_rules ('judul', 'Judul Tugas Akhir', 'required|max_length[250]');
		$this->form_validation->set_rules ('tahun', 'Tahun Publikasi', 'required|max_length[4]');
		$this->form_validation->set_rules ('rumpun', 'Rumpun Mata Kuliah', 'required');

		if ($this->form_validation->run() == FALSE)
			return FALSE;
		
		$this->load->library ('uploader');
		$this->load->model ('poster_model');
		
		if ( $_FILES['file']['error'] === 0 )
		{
			$uploaded_file = $this->uploader->upload ($_FILES['file']);
			if ($uploaded_file == NULL)
				return FALSE;
		}
		
		$input = array (
			'nama_penulis'		=>	$_POST['nama'],
			'judul_publikasi'	=>	$_POST['judul'],
			'tahun_publikasi'	=> 	$_POST['tahun'],
			'id_rmk'			=>	$_POST['rumpun'],
			'perubahan_terakhir'=>	date ("Y-m-d h:i:s")
		);

		if ( isset ($uploaded_file) )
			$input = array_merge ($input, array ('path_image' => $uploaded_file));
		
		return $this->poster_model->update ($_POST['id_poster'], $input);
	}

	function ubah_status_handler ()
	{
		$this->load->model ('poster_model');

		$this->poster_model->update ($_POST['id_poster'], array ('sudah_publish' => 1, 'waktu_cetak' => date ('Y-m-d H:i:s')));
		redirect ('admin/poster');
	}

	function poster($set = 0)
	{
		$this->load->library ('pagination');
		$this->load->model ('poster_model');

		$item_per_page = 20;

		if ( isset ($_GET['order']) )
		{
			if (strcasecmp ($_GET['order'], 'newest') == 0)
				$order = array ('perubahan_terakhir' => 'DESC');
			else if (strcasecmp ($_get['order'], 'oldest') == 0)
				$order = array ('perubahan_terakhir' => 'ASC');
		}
		else
			$order = NULL;

		$data['poster'] = $this->poster_model->get(NULL, NULL, NULL, $order, $set, $item_per_page);
		$data['set'] = $set;
		
		$config['base_url'] 	= base_url ('admin/poster');
		$config['total_rows'] 	= $this->poster_model->count (NULL, NULL, NULL, $order, $set, $item_per_page);
		$config['per_page'] 	= $item_per_page;

		$this->pagination->initialize ($config);
		
		$this->load->view('header');
		$this->load->view('admin/navbar');
		$this->load->view('admin/posterlist', $data);
		$this->load->view('footer');
	}

	function poster_tercetak ($set = 0)
	{
		$this->load->library ('pagination');
		$this->load->model ('poster_model');

		$item_per_page = 20;

		$data['poster'] = $this->poster_model->get(
			NULL,
			array ('sudah_publish' => 1),
			NULL,
			NULL,
			$set, $item_per_page);
		$data['set'] = $set;

		$config['base_url'] 	= base_url ('admin/poster');
		$config['total_rows'] 	= $this->poster_model->count (NULL,
			array ('sudah_publish' => 1),
			NULL,
			NULL,
			$set, $item_per_page);
		$config['per_page'] 	= $item_per_page;

		$this->load->view('header');
		$this->load->view('admin/navbar');
		$this->load->view('admin/posterlist', $data);
		$this->load->view('footer');
	}

	function hapus_poster ($id_poster)
	{
		$this->load->model ('poster_model');
		$data['poster'] = $this->poster_model->get (NULL, array ('id_poster' => $id_poster))[0];
		$css['css'] = array ('assets/css/tablepanel.css');

		$this->load->view ('header', $css);
		$this->load->view ('admin/navbar');
		$this->load->view ('admin/hapusposter', $data);
		$this->load->view ('footer');
	}

	function hapus_poster_handler ($id_poster)
	{
		$this->load->model ('poster_model');
		$this->poster_model->delete ($id_poster);

		redirect ('admin/poster');
	}

	function akun ()
	{
		if ( ! empty ($this->input->post()) )
		{
			$success = $this->akun_form_handler();
			if ($success)
				redirect ('admin/akun');
		}

		$this->load->model ('user_model');
		$data['akun'] = $this->user_model->get(NULL, array ('nama' => $this->session->userdata ('username')))[0];
		
		$this->load->view ('header');
		$this->load->view ('admin/navbar');
		if (isset ($success)) $this->load->view('validation_error');
		$this->load->view ('admin/akun', $data);
		$this->load->view ('footer');
	}

	private function akun_form_handler()
	{
		$this->load->library ('form_validation');
		$this->form_validation->set_rules ('username', 'Username Baru', 'required|max_length[100]');
		$this->form_validation->set_rules ('password_lama', 'Password Lama', 'required|max_length[100]');
		$this->form_validation->set_rules ('password_baru', 'Password Baru', 'required|max_length[100]');
		$this->form_validation->set_rules ('re_password_baru', 'Ulangi Password Baru', 'required|matches[password_baru]');

		if ($this->form_validation->run() == FALSE)
			return FALSE;

		$this->load->model ('user_model');
		
		if (strcmp ($_POST['username'], $this->session->userdata('username')) != 0 && ! empty($this->user_model->get(NULL, array ('nama' => $_POST['username']))))
			return FALSE;
		
		$akun = $this->user_model->get (NULL, array ('nama' => $this->session->userdata ('username')));
		var_dump ($akun);
		if ( ! empty ($akun) )
		{
			$akun = $akun[0];
			$input = array (
				'nama' => $_POST['username'],
				'pass' => $_POST['password_baru']
			);

			$result = $this->user_model->update ($akun['id_admin'], $input);
			if ($result)
				$this->session->set_userdata ('username', $_POST['username']);
			
			return $result;
		}

		return FALSE;
	}

}
