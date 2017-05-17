<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	function __construct()
	{	
		parent::__construct();
	}

	function index()
	{
		$this->cari();
	}

	function cari()
	{
		$data['css'] = array ('assets/css/searchbar.css');
		$this->load->view('header', $data);
		$this->load->view('home/navbar');
		$this->load->view('home/homepage');
		$this->load->view('footer');
	}

	function login()
	{
		if ( ! empty ( $this->input->post() ) )
		{
			$this->load->model ('user_model');
			if ( $this->user_model->find (
					$this->input->post ('username'),
					$this->input->post ('password')
					))
			{
				$this->session->set_userdata ('username', $this->input->post ('username'));
				redirect ('admin');
			}
		}

		$this->load->view('header');
		$this->load->view('home/navbar');
		$this->load->view('home/login');
		$this->load->view('footer');
	}

	function logout()
	{
		$this->session->unset_userdata ('username');

		redirect ('home/login');
	}
}
