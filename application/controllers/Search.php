<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {
	function __construct()
	{	
		parent::__construct();
	}

	function index()
	{
		redirect ('home');
	}

	function result($set = 0)
	{
		function get_setter ($param)
		{
			if (isset ($_GET[$param]))
				return $_GET[$param];
			return '';
		}

		$this->load->library ('pagination');
		$this->load->model ('search_model');
		$this->load->model ('poster_model');

		$item_per_page = 20;

		$query['judul_publikasi'] = get_setter ('judul');
		$query['tahun_publikasi'] = get_setter ('tahun');
		$query['nama_penulis'] = get_setter ('author');

		$data['request'] = array ('judul' => get_setter ('judul'), 'tahun' => get_setter ('tahun'), 'author' => get_setter ('author'))	;
		$data['poster'] = $this->poster_model->get (NULL, NULL, $query, NULL, NULL, $set * $item_per_page, $item_per_page);
		$data['previous_link'] = base_url ('home');
		$data['sitemap'] = array (
			'Home' => base_url ('home'),
			'Result' => '#'
		);

		$css['css'] = array ('assets/css/searchbar.css', 'assets/css/search_result.css');

		$config['base_url'] 	= base_url ('search/result');
		$config['total_rows'] 	= $this->poster_model->count (NULL, $query);
		$config['per_page'] 	= $item_per_page;

		$this->pagination->initialize ($config);

		$this->load->view ('header', $css);
		$this->load->view ('home/navbar');
		$this->load->view ('home/searchresult', $data);
		$this->load->view ('footer');
	}

	function poster($id_poster)
	{
		$this->load->model ('poster_model');

		$this->poster_model->join (array ('ref_rmk' => 'ref_rmk.id_rmk = data_poster.id_rmk'));
		$content['poster'] = $this->poster_model->get (NULL, array ('id_poster' => $id_poster))[0];
		
		$content['previous_link'] = $_SERVER['HTTP_REFERER'];
		$content['sitemap'] = array (
			'Home'		=>	base_url ('home'),	
			'Search'	=>	base_url ('home/result'),
			'Result'	=> 	'#'
		);

		$css['css'] = array ('assets/css/poster.css');

		$this->load->view ('header', $css);
		$this->load->view ('home/navbar');
		$this->load->view ('home/detailposter', $content);
		$this->load->view ('footer');
	}
}
