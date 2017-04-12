<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
}

?>