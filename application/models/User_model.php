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
	 *	Adds account
	 *	@param array $data
	 *	@return bool
	 */
	public function insert ($data)
	{
		//	To ensure unique combination of poster and tag pair, checking is necessary
		if ( $this->is_exist ($data, 'data_user') )
			return 'Data sudah ada';

		if ( ! $this->db->insert ('data_user', $data) )
			return $this->db->error();
		
		return TRUE;
	}

	public function update ($id_user, $data)
	{
		$data = $this->expunge ($data, 'id_user');

		$this->db->where ('id_user', $id_user);

		if ( ! $this->db->update ('data_user', $data) )
			return $this->db->error();
		
		return TRUE;
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

		return $this->is_exist ($data, 'data_user');
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
		
		return $this->db->get ('data_user')->result_array();
	}
}

?>