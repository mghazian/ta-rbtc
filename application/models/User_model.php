<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'Generic_model.php';

class User_model extends Generic_model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	/**
	 *	Adds account for admin if not already exist
	 *	@param string $nama
	 *	@param string $pass
	 *	@return bool
	 */
	public function insert ($nama, $pass)
	{
		$data = array (
			'nama' 		=> $nama,
			'pass'		=> $pass
		);

		//	To ensure unique combination of poster and tag pair, checking is necessary
		if ( $this->is_exist ($data, 'data_admin') )
			return FALSE;

		return $this->db->insert ('data_admin', $data);
	}

	/**
	 *	Searches for given name and password
	 *	@param string $nama
	 *	@param string $pass
	 *	@return bool
	 */
	public function find ($nama, $pass)
	{
		$data = array (
			'nama' 	=> $nama,
			'pass'	=> $pass
		);

		return $this->is_exist ($data, 'data_admin');
	}
}

?>