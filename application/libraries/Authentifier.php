<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authentifier {

	private $CI;

	public function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->library ('session');
	}

	public function authenticate ($username, $password)
	{
		$this->CI->load->model ('user_model');

		$this->CI->user_model->join (array ('ref_privilege' => 'ref_privilege.id_privilege = data_user.id_privilege'));
		$result = $this->CI->user_model->get (NULL, array ('nama' => $username, 'pass' => $password));
		
		if (count ($result) === 0)
			return FALSE;
		
		$this->CI->session->set_userdata ('username', $username);
		$this->CI->session->set_userdata ('privilege', $result[0]['nama_privilege']);
		
		return TRUE;
	}

	public function deauthenticate ()
	{
		$this->CI->session->sess_destroy();
		$this->CI->session->unset_userdata ('username');
		$this->CI->session->unset_userdata ('privilege');

		return $this->CI->session->has_userdata ('username');
	}

	public function has_privilege ($privilege)
	{
		return (strcasecmp ($privilege, $this->CI->session->userdata ('privilege')) === 0);
	}

	public function auto_redirect ()
	{
		if ( $this->has_privilege ('administrator') )
			redirect ('admin');
		
		else if ( $this->has_privilege ('mahasiswa') )
			redirect ('mahasiswa');
	}

	public function guard ($privilege)
	{
		if ( ! $this->has_privilege ($privilege) )
			redirect ('home');
	}

	public function get_info ($attribute)
	{
		$this->CI->load->model ('user_model');
		$result = $this->CI->user_model->get (array ($attribute), array ('nama' => $this->CI->session->userdata ('username')));

		if ( count ($result) > 0 )
			return $result[0][$attribute];
		
		return NULL;
	}
}
