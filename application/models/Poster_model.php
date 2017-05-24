<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'Generic_model.php';

class Poster_model extends Generic_model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	/**
	 *	Inserts poster
	 *	@param array $data
	 *	@return bool
	 */
	public function insert ($data)
	{
		if ( ! $this->is_array_valid ($data) )
			return FALSE;
		
		$data = $this->expunge ($data, 'id_poster');
		
		return $this->db->insert ('data_poster', $data);
	}

	/**
	 *	Deletes poster using primary key
	 *	@param mixed $id_poster
	 *	@return bool
	 */
	public function delete ($id_poster)
	{
		$this->db->where ('id_poster', $id_poster);
		return $this->db->delete ('data_poster');
	}
	
	/**
	 *	Updates poster
	 *	@param mixed $id_poster
	 *	@param array $data
	 *	@return bool
	 */
	public function update ($id_poster, $data)
	{
		if ( ! $this->is_array_valid ($data) )
			return FALSE;
		
		$data = $this->expunge ($data, 'id_poster');
		
		$this->db->where ('id_poster', $id_poster);
		return $this->db->update ('data_poster', $data);
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

		$this->db->offset ($offset);
		
		if ($limit !== NULL)
			$this->db->limit ($limit);

		$this->db->join ('ref_rmk', 'ref_rmk.id_rmk = data_poster.id_rmk');
		
		return $this->db->get ('data_poster')->result_array();
	}

	/**
	 *	Returns the number of element given the parameter
	 *	@param $condition
	 *	@param $group
	 *	@param $offset
	 *	@param $limit
	 *	@return int
	 */
	public function count ($condition = NULL, $group = NULL, $offset = 0, $limit = NULL)
	{
		if ($condition !== NULL)
			$this->db->where ($condition);
		
		if ($group !== NULL)
		{	
			if ( array_key_exists ('group_by', $group) )
				$this->db->group_by ($group['group_by']);
			
			if ( array_key_exists ('having', $group) )
				$this->db->having ($group['having']);
		}

		$this->db->offset ($offset);
		
		if ($limit !== NULL)
			$this->db->limit ($limit);
		
		return $this->db->get ('data_poster')->num_rows();
	}
}

?>