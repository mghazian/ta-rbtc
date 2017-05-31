<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	function __construct()
	{	
		parent::__construct();
		$this->load->library ('authentifier');
	}

	function index()
	{
		$this->cari();
	}

	function cari()
	{
		$this->authentifier->auto_redirect();

		$data['css'] = array ('assets/css/searchbar.css');
		$this->load->view('header', $data);
		$this->load->view('home/navbar');
		$this->load->view('home/homepage');
		$this->load->view('footer');
	}

	function login()
	{
		$this->authentifier->auto_redirect();

		if ( ! empty ( $this->input->post() ) )
		{
			if ( $this->authentifier->authenticate ($_POST['username'], $_POST['password']) )
			{
				$this->authentifier->auto_redirect();
			}
		}

		$this->load->view('header');
		$this->load->view('home/navbar');
		$this->load->view('home/login');
		$this->load->view('footer');
	}

	function logout()
	{
		$this->authentifier->deauthenticate();

		redirect ('home/login');
	}
}
