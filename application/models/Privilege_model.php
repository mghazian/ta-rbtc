<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'Generic_model.php';

class Privilege_model extends Generic_model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
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
		
		return $this->db->get ('ref_privilege')->result_array();
	}
}

?>