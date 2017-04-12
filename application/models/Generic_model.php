<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tag_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	/**
	 *	Removes value with key @param $key
	 *	@param array $array
	 *	@param string $key
	 *	@return array
	 */
	protected function expunge ($array, $key)
	{
		return array_diff_key ($array, array ($key => NULL));
	}

	/**
	 *	Array validity verification
	 *	@param array $array
	 *	@return bool
	 */
	protected function is_array_valid ($array)
	{
		return ( is_array ($array) && ! empty ($array) );
	}

	/**
	 *	Checks whether specified data is exist or not
	 *	@param array $data
	 *	@param string $table
	 *	@return bool
	 */
	protected function is_exist ($data, $table)
	{
		if ( ! $this->is_array_valid ($data) )
			return FALSE;

		$this->db->where ($data);
		$query = $this->db->get ($table);

		return ( $query->num_rows() > 0 );
	}
}

?>