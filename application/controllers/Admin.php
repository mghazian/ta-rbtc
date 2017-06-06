<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	function __construct()
	{	
		parent::__construct();
		$this->load->library ('authentifier');
		
		$this->authentifier->guard ('administrator');
	}

	function index()
	{
		$this->dashboard();
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
		$this->form_validation->set_rules ('dosbing_1', 'Dosen Pembimbing 1', 'required');

		if ($this->form_validation->run() == FALSE)
			return FALSE;

		$this->load->library ('uploader');
		$this->load->model ('poster_model');

		$uploaded_file = $this->uploader->upload ($_FILES['file']);
		if ($uploaded_file == NULL)
			return FALSE;
		
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
			'path_image'		=>	$uploaded_file
		);

		return $this->poster_model->insert ($input);
	}

	function edit($id_poster)
	{
		if ( ! empty ($this->input->post()) )
			$result = $this->edit_form_handler();
		
		$this->load->model ('poster_model');
		$poster = $this->poster_model->get (NULL, array ('id_poster' => $id_poster) )[0];

		$this->load->model ('rmk_model');
		$content['rmk'] = $this->rmk_model->all();
		$content['poster'] = $poster;

		$this->load->view('header');
		$this->load->view('admin/navbar');

		if ( isset ($result) )
		{
			if ($result === TRUE)
				$this->load->view ('success_message', array ('message' => 'Data berhasil diubah'));
			else
				$this->load->view ('validation_error', array ('error' => $result));
		}

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
		$this->form_validation->set_rules ('dosbing_1', 'Dosen Pembimbing 1', 'required');

		if ($this->form_validation->run() == FALSE)
			return FALSE;
		
		$this->load->library ('uploader');
		$this->load->model ('poster_model');
		
		if ( $_FILES['file']['error'] === 0 )
		{
			$uploaded_file = $this->uploader->upload ($_FILES['file']);
			if ($uploaded_file == NULL)
				return 'Ada kesalahan pada pengunggahan file!';
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
		$this->load->model ( array ('poster_model', 'rmk_model', 'status_model') );

		$item_per_page = 20;

		$rule = $this->poster_ruler();
		
		if ($rule['date'] !== NULL)
		{
			$bulan = ( isset ($rule['date']['bulan_entri']) ) ? $rule['date']['bulan_entri'] : NULL;
			$tahun = ( isset ($rule['date']['tahun_entri']) ) ? $rule['date']['tahun_entri'] : NULL;
			$rule_tanggal = $this->create_date_rule ($bulan, $tahun);

			$rule['condition'] = array_merge ($rule['condition'], array ('waktu_entri >= ' => $rule_tanggal['begin'], 'waktu_entri <= ' => $rule_tanggal['end']));
		}

		$this->poster_model->join (array ('ref_rmk' => 'ref_rmk.id_rmk = data_poster.id_rmk'));
		$data['poster'] = $this->poster_model->get(NULL, $rule['condition'], $rule['keyword'], NULL, $rule['order'], $set * $item_per_page, $item_per_page);

		$data['set'] = $set;
		$data['rmk'] = $this->rmk_model->all();
		$data['status'] = $this->status_model->all();
		
		$config['base_url'] 	= base_url ('admin/poster');
		$config['total_rows'] 	= $this->poster_model->count ($rule['condition'], $rule['keyword']);
		$config['per_page'] 	= $item_per_page;

		$this->pagination->initialize ($config);
		
		$this->load->view('header');
		$this->load->view('admin/navbar');
		$this->load->view('admin/posterlist', $data);
		$this->load->view('footer');
	}

	private function poster_ruler ()
	{
		function get_setter ($param)
		{
			if (isset ($_GET[$param]))
				return $_GET[$param];
			return NULL;
		}
		$rule = array();

		$keyword['judul_publikasi'] = get_setter ('judul');
		$keyword['nama_penulis'] = get_setter ('penulis');
		$keyword['nrp_penulis'] = get_setter ('nrp');

		$keyword = array_filter ($keyword, 'strlen');
		$keyword = ( count ($keyword) ) ? $keyword : NULL;

		$condition['data_poster.id_rmk'] = get_setter ('rmk');
		$condition['id_status'] = get_setter ('status');
		$condition['sudah_publish'] = get_setter ('published');

		$condition = array_filter ($condition, 'strlen');
		$condition = ( count ($condition) ) ? $condition : NULL;

		$order['waktu_cetak'] = get_setter ('cetak');
		$order['waktu_entri'] = get_setter ('entri');
		$order['perubahan_terakhir'] = get_setter ('changed');

		$order = array_filter ($order, 'strlen');
		$order = ( count ($order) ) ? $order : NULL;

		$date['tahun_entri'] = get_setter ('tahun_entri');
		$date['bulan_entri'] = get_setter ('bulan_entri');

		$date = array_filter ($date, 'strlen');
		$date = ( count ($date) ) ? $date : NULL;

		$rule['keyword'] = $keyword;
		$rule['condition'] = $condition;
		$rule['order'] = $order;
		$rule['date'] = $date;
		
		return $rule;
	}

	private function create_date_rule ($bulan = NULL, $tahun = NULL)
	{
		if ($tahun == NULL)
			$tahun = strtotime ('Y');
		
		if ($bulan == NULL)
		{
			$date = date_create_from_format ('Y m d H i s', $tahun . ' 01 01 00 00 00');
			$rule['begin'] = date_format ($date, 'Y-m-d H:i:s');

			$date = date_add ($date, date_interval_create_from_date_string ('1 year'));
			$rule['end'] = date_format ($date, 'Y-m-d- H:i:s');
		}

		else
		{
			$date = date_create_from_format ('Y m d H i s', $tahun . ' ' . $bulan . ' 01 00 00 00');
			$rule['begin'] = date_format ($date, 'Y-m-d H:i:s');

			$date = date_add ($date, date_interval_create_from_date_string ('1 month'));
			$rule['end'] = date_format ($date, 'Y-m-d- H:i:s');
		}

		return $rule;
	}

	function hapus_poster ($id_poster)
	{
		$this->load->model ('poster_model');
		$this->poster_model->join ( array (
			'ref_rmk' => 'ref_rmk.id_rmk = data_poster.id_rmk',
			'ref_status' => 'ref_status.id_status = data_poster.id_status'
		));

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
			$result = $this->akun_form_handler();

		$this->load->model ('user_model');
		$data['akun'] = $this->user_model->get(NULL, array ('nama' => $this->session->userdata ('username')))[0];
		
		$this->load->view ('header');
		$this->load->view ('admin/navbar');

		if ( isset ($success) )
		{
			if ($success === TRUE)
				$this->load->view ('success_message', array ('message' => 'Data berhasil diubah'));
			else
				$this->load->view('validation_error', array ('error' => $result));
		}

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
		
		if ( ! empty ($akun) )
		{
			$akun = $akun[0];
			$input = array (
				'nama' => $_POST['username'],
				'pass' => $_POST['password_baru']
			);

			$result = $this->user_model->update ($akun['id_user'], $input);
			if ($result)
				$this->session->set_userdata ('username', $_POST['username']);
			
			return $result;
		}

		return FALSE;
	}

	function tambah_mahasiswa()
	{
		if ( ! empty ($this->input->post()) )
			$result = $this->tambah_mahasiswa_handler ();

		$this->load->view ('header');
		$this->load->view ('admin/navbar');

		if ( isset ($result) )
		{
			if ($result === TRUE)
				$this->load->view ('success_message', array ('message' => 'Data mahasiswa a.n. ' . $_POST['username'] . ' berhasil dimasukkan'));
			else
				$this->load->view ('validation_error', array ('error' => $result));
		}

		$this->load->view ('admin/tambah_mahasiswa');
		$this->load->view ('footer');
	}

	private function tambah_mahasiswa_handler ()
	{
		$this->load->library ('form_validation');
		$this->form_validation->set_rules ('username', 'Username', 'required|max_length[100]');
		$this->form_validation->set_rules ('password', 'Password', 'required|max_length[100]');
		$this->form_validation->set_rules ('re_password', 'Pengulangan Password', 'required|matches[password]');

		if ( $this->form_validation->run() === FALSE )
			return FALSE;
		
		$this->load->model ('user_model');
		$this->load->model ('privilege_model');

		$privilege = $this->privilege_model->get (NULL, array ('nama_privilege' => 'mahasiswa'));

		$data = array (
			'nama'			=>	$_POST['username'],
			'pass'			=>	$_POST['password'],
			'id_privilege'	=>	$privilege[0]['id_privilege']
		);

		return $this->user_model->insert ($data);
	}

	function tambah_admin()
	{
		$this->load->model ('privilege_model');
		$privilege = $this->privilege_model->get (NULL, array ('nama_privilege' => 'administrator'));

		if ( ! empty ($this->input->post()) )
			$result = $this->tambah_admin_handler ();

		$this->load->view ('header');
		$this->load->view ('admin/navbar');

		if ( isset ($result) )
		{
			if ($result === TRUE)
				$this->load->view ('success_message', array ('message' => 'Data administrator a.n. ' . $_POST['username'] . ' berhasil dimasukkan'));
			else
				$this->load->view ('validation_error', array ('error' => $result));
		}

		$this->load->view ('admin/tambah_admin');
		$this->load->view ('footer');
	}

	private function tambah_admin_handler ()
	{
		$this->load->library ('form_validation');
		$this->form_validation->set_rules ('username', 'Username', 'required|max_length[100]');
		$this->form_validation->set_rules ('password', 'Password', 'required|max_length[100]');
		$this->form_validation->set_rules ('re_password', 'Pengulangan Password', 'required|matches[password]');

		if ( $this->form_validation->run() === FALSE )
			return FALSE;
		
		$this->load->model ('user_model');
		$this->load->model ('privilege_model');

		$privilege = $this->privilege_model->get (NULL, array ('nama_privilege' => 'administrator'));

		$data = array (
			'nama'			=>	$_POST['username'],
			'pass'			=>	$_POST['password'],
			'id_privilege'	=>	$privilege[0]['id_privilege']
		);

		var_dump ($data);

		return $this->user_model->insert ($data);
	}

	function validasi_form ($id_poster)
	{
		$this->load->model ('poster_model');
		$this->poster_model->join ( array (
			'ref_rmk' => 'ref_rmk.id_rmk = data_poster.id_rmk',
			'ref_status' => 'ref_status.id_status = data_poster.id_status'
		));

		$data['poster'] = $this->poster_model->get (NULL, array ('id_poster' => $id_poster))[0];
		$data['previous_link'] = $_SERVER['HTTP_REFERER'];
		$css['css'] = array ('assets/css/tablepanel.css');

		$this->load->view ('header', $css);
		$this->load->view ('admin/navbar');
		$this->load->view ('admin/validasi', $data);
		$this->load->view ('footer');
	}

	function validasi ()
	{
		$this->load->model ('poster_model');

		$status = ($_POST['action'] == 1) ? 2 : 3;

		$this->poster_model->update ($_POST['id_poster'], array ('id_status' => $status));

		redirect ('admin/poster');
	}
}
