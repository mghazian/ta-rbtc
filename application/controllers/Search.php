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
		$this->load->model ('search_model');
		$query['judul_publikasi'] = $_GET['judul'];
		$query['tahun_publikasi'] = $_GET['tahun'];
		$query['nama_penulis'] = $_GET['author'];

		$data['request'] = $_GET;
		$data['poster'] = $this->search_model->search ($query);

		$css['css'] = array ('assets/css/searchbar.css', 'assets/css/search_result.css');

		$this->load->view ('header', $css);
		$this->load->view ('home/navbar');
		$this->load->view ('home/searchresult', $data);
		$this->load->view ('footer');
	}

	function poster($id_poster)
	{
		$this->load->model ('poster_model');
		
		$content['poster'] = $this->poster_model->get (NULL, array ('id_poster' => $id_poster))[0];
		$css['css'] = array ('assets/css/poster.css');

		$this->load->view ('header', $css);
		$this->load->view ('home/navbar');
		$this->load->view ('home/poster', $content);
		$this->load->view ('footer');
	}
}
