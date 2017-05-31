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

	function result()
	{
		function get_setter ($param)
		{
			if (isset ($_GET[$param]))
				return $_GET[$param];
			return '';
		}

		$this->load->model ('search_model');
		$query['judul_publikasi'] = get_setter ('judul');
		$query['tahun_publikasi'] = get_setter ('tahun');
		$query['nama_penulis'] = get_setter ('author');

		$data['request'] = array ('judul' => get_setter ('judul'), 'tahun' => get_setter ('tahun'), 'author' => get_setter ('author'))	;
		$data['poster'] = $this->search_model->search ($query);
		$data['previous_link'] = base_url ('home');
		$data['sitemap'] = array (
			'Home' => base_url ('home'),
			'Result' => '#'
		);

		$css['css'] = array ('assets/css/searchbar.css', 'assets/css/search_result.css');

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
