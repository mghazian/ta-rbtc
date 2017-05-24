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

	public function update ($id_admin, $data)
	{
		$data = $this->expunge ($data, 'id_admin');

		$this->db->where ('id_admin', $id_admin);
		return $this->db->update ('data_admin', $data);
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

	/**
	 *	Fetches data from DB
	 *	@param mixed $column
	 *	@param mixed $condition
	 *	@param mixed $group
	 *	@param mixed $order
	 *	@param int $offset
	 *	@param mixed $limit
	 *	@return array
	 */
	public function get ($column = NULL, $condition = NULL, $group = NULL, $order = NULL, $offset = 0, $limit = NULL)
	{
		if ($column !== NULL)
			$this->db->select ($column);
		
		if ($condition !== NULL)
			$this->db->where ($condition);
		
		if ($group !== NULL)
		{	
			if ( array_key_exists ('group_by', $group) )
				$this->db->group_by ($group['group_by']);
			
			if ( array_key_exists ('having', $group) )
				$this->db->having ($group['having']);
		}

		if ($order !== NULL)
		{
			foreach ($order as $key => $value)
				$this->db->order_by($key, $value);
		}

		$this->db->offset = $offset;
		
		if ($limit !== NULL)
			$this->db->limit = $limit;
		
		return $this->db->get ('data_admin')->result_array();
	}
}

?>