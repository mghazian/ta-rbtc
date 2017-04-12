<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tag_model extends Generic_model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	/**
	 *	Adds supervisor/dosbing to a poster if it is not already exist
	 *	@param mixed $id_poster
	 *	@param string $nama_dosen
	 *	@return bool
	 */
	public function insert ($id_poster, $nama_dosen)
	{
		$data = array (
			'id_poster' 	=> $id_poster,
			'nama_dosen'	=> $nama_dosen
		);

		//	To ensure unique combination of poster and supervisor pair, checking is necessary
		if ( $this->is_exist ($data, 'data_dosbing') )
			return FALSE;

		return $this->db->insert ('data_dosbing', $data);
	}

	/**
	 *	Updates tag only if the to-be supervisor/dosbing is not already present
	 *	@param mixed $id_dosbing
	 *	@param array $data
	 *	@return bool
	 */
	public function update ($id_dosbing, $data)
	{
		if ( ! $this->is_array_valid ($data) )
			return FALSE;
		
		$data = $this->expunge ($data, 'id_dosbing');

		if ( $this->is_exist ($data, 'data_dosbing') )
			return FALSE;
		
		$this->db->where ('id_dosbing', $id_dosbing);
		return $this->db->update ('data_dosbing', $data);
	}

	/**
	 *	Deletes data
	 *	@param $mixed $id_dosbing
	 *	@return bool
	 */
	public function delete ($id_dosbing)
	{
		$this->db->where ('id_dosbing', $id_dosbing);
		return $this->db->delete ('data_dosbing');
	}
}

?>