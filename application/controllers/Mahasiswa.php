<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {
	function __construct()
	{	
		parent::__construct();
		$this->load->library ('authentifier');
		
		$this->authentifier->guard ('mahasiswa');
	}

	function index ()
	{
		$this->dashboard();
	}

	function dashboard ()
	{
		$css['css'] = array ('assets/css/status_circle.css');

		$this->load->model ('user_model');
		$this->load->model ('poster_model');

		$content['akun'] = $this->user_model->get
		(
			array ('nama_lengkap', 'nomor_induk'),
			array ('nama' => $this->session->userdata ('username'))
		)[0];

		$id_user = $this->authentifier->get_info ('id_user');

		$this->poster_model->join ( array
		(
			'ref_rmk' => 'ref_rmk.id_rmk = data_poster.id_rmk',
			'ref_status' => 'ref_status.id_status = data_poster.id_status'
		) );

		$poster = $this->poster_model->get (array (
			'judul_publikasi',
			'nama_penulis',
			'nrp_penulis',
			'tahun_publikasi',
			'nama_rmk',
			'waktu_entri',
			'perubahan_terakhir',
			'ref_status.id_status as id_status',
			'deskripsi'
		), array ('id_user' => $id_user));

		if ( count ($poster) > 0 )
			$content['poster'] = $poster[0];

		$this->load->view ('header', $css);
		$this->load->view ('mahasiswa/navbar');
		$this->load->view ('mahasiswa/dashboard', $content);
		$this->load->view ('footer');
	}

	function setting_akun ()
	{
		if ( ! empty ($this->input->post()) )
			$result = $this->setting_akun_handler();
		
		$this->load->model ('user_model');
		$content['akun'] = $this->user_model->get (NULL, array ('nama' => $this->session->userdata ('username')))[0];

		$this->load->view ('header');
		$this->load->view ('mahasiswa/navbar');

		if (isset ($result))
		{
			if ($result === TRUE)
				$this->load->view ('success_message', array ('message' => 'Data akun berhasil diubah'));
			else
				$this->load->view ('validation_error', array ('error' => $result));
		}

		$this->load->view ('mahasiswa/akun', $content);
		$this->load->view ('footer');
	}

	private function setting_akun_handler ()
	{
		$this->load->library ('form_validation');
		$this->form_validation->set_rules ('password_lama', 'Password Lama', 'required|max_length[100]');
		$this->form_validation->set_rules ('password_baru', 'Password Baru', 'required|max_length[100]');
		$this->form_validation->set_rules ('re_password_baru', 'Ulangi Password Baru', 'required|matches[password_baru]');

		if ($this->form_validation->run() == FALSE)
			return FALSE;

		$this->load->model ('user_model');
		
		$akun = $this->user_model->get (NULL, array ('nama' => $this->session->userdata ('username')));
		
		if ( ! empty ($akun) )
		{
			$akun = $akun[0];
			$input = array (
				'pass' => $_POST['password_baru'],
				'nama_lengkap' => $_POST['nama_lengkap'],
				'nomor_induk' => $_POST['nrp']
			);

			$result = $this->user_model->update ($akun['id_user'], $input);
			return $result;
		}

		return FALSE;
	}

	function form_berkas ()
	{
		if ( ! empty ($this->input->post()) )
			if ( $this->form_berkas_handler() === TRUE )
				redirect ('mahasiswa');
		
		$this->load->model ('rmk_model');
		$this->load->model ('poster_model');
		$content['rmk'] = $this->rmk_model->all();

		$this->load->view ('header');
		$this->load->view ('mahasiswa/navbar');

		$id_poster = $this->poster_model->get ('id_poster', array ('id_user' => $this->authentifier->get_info ('id_user')));
		
		if ( count ($id_poster) !== 0 )
			redirect ('mahasiswa/edit_berkas');
		
		$this->load->view ('mahasiswa/inputposter', $content);
		$this->load->view ('footer');
	}

	private function form_berkas_handler ()
	{
		$this->load->library ('form_validation');
		$this->form_validation->set_rules ('nama', 'Nama Author', 'required|max_length[100]');
		$this->form_validation->set_rules ('judul', 'Judul Tugas Akhir', 'required|max_length[250]');
		$this->form_validation->set_rules ('tahun', 'Tahun Publikasi', 'required|max_length[4]');
		$this->form_validation->set_rules ('rumpun', 'Rumpun Mata Kuliah', 'required');
		$this->form_validation->set_rules ('dosbing_1', 'Dosen Pembimbing 1', 'required');

		if ($this->form_validation->run() == FALSE)
			return FALSE;

		$this->load->library ('uploader');
		$this->load->model ('poster_model');

		$uploaded_file = $this->uploader->upload ($_FILES['file']);
		if ($uploaded_file == NULL)
			return FALSE;

		$id_user = $this->authentifier->get_info ('id_user');
		
		$input = array (
			'nama_penulis'		=>	$_POST['nama'],
			'nrp_penulis' 		=>	$_POST['nrp'],
			'judul_publikasi'	=>	$_POST['judul'],
			'tahun_publikasi'	=> 	$_POST['tahun'],
			'id_rmk'			=>	$_POST['rumpun'],
			'abstrak'			=>	$_POST['abstrak'],
			'kata_kunci'		=>	strtolower ( $_POST['keyword'] ),
			'dosbing_1'			=>	$_POST['dosbing_1'],
			'dosbing_2'			=>	$_POST['dosbing_2'],
			'id_user'			=>	$id_user,
			'path_image'		=>	$uploaded_file
		);

		return $this->poster_model->insert ($input);
	}

	function edit_berkas ()
	{
		if ( ! empty ($this->input->post()) )
			if ( $this->edit_berkas_handler() === TRUE )
				redirect ('mahasiswa');
		
		$this->load->model ('rmk_model');
		$this->load->model ('poster_model');
		$content['rmk'] = $this->rmk_model->all();

		$this->load->view ('header');
		$this->load->view ('mahasiswa/navbar');

		$id_poster = $this->poster_model->get ('id_poster', array ('id_user' => $this->authentifier->get_info ('id_user')));
		
		if ( count ($id_poster) === 0 )
			redirect ('mahasiswa/form_berkas');

		$content['poster'] = $this->poster_model->get (NULL, array ('id_poster' => $id_poster[0]['id_poster']))[0];
		
		if ($content['poster']['id_status'] == 1 || $content['poster']['id_status'] == 2)
		{
			if ($content['poster']['id_status'] == 1)
				$content['message'] = 'Tugas akhir sudah dikirim, dan akan diverifikasi oleh staf RBTC. Data saat ini tidak dapat diubah.';
			else
				$content['message'] = 'Tugas akhir sudah diterima. Data tidak dapat diubah.';
			$this->load->view ('mahasiswa/manajemendata_blocked', $content);
		}
		else
			$this->load->view ('mahasiswa/manajemendata', $content);
		
		$this->load->view ('footer');
	}

	private function edit_berkas_handler ()
	{
		$this->load->library ('form_validation');
		$this->form_validation->set_rules ('nama', 'Nama Author', 'required|max_length[100]');
		$this->form_validation->set_rules ('judul', 'Judul Tugas Akhir', 'required|max_length[250]');
		$this->form_validation->set_rules ('tahun', 'Tahun Publikasi', 'required|max_length[4]');
		$this->form_validation->set_rules ('rumpun', 'Rumpun Mata Kuliah', 'required');
		$this->form_validation->set_rules ('dosbing_1', 'Dosen Pembimbing 1', 'required');

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
			'nrp_penulis' 		=>	$_POST['nrp'],
			'judul_publikasi'	=>	$_POST['judul'],
			'tahun_publikasi'	=> 	$_POST['tahun'],
			'id_rmk'			=>	$_POST['rumpun'],
			'abstrak'			=>	$_POST['abstrak'],
			'kata_kunci'		=>	strtolower ( $_POST['keyword'] ),
			'dosbing_1'			=>	$_POST['dosbing_1'],
			'dosbing_2'			=>	$_POST['dosbing_2'],
			'perubahan_terakhir'=>	date ("Y-m-d h:i:s"),
			'id_status'			=>	1
		);

		if ( isset ($uploaded_file) )
			$input = array_merge ($input, array ('path_image' => $uploaded_file));
		
		return $this->poster_model->update ($_POST['id_poster'], $input);	
	}
}
