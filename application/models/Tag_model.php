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
	 *	Adds tag to a poster if it is not already exist
	 *	@param mixed $id_poster
	 *	@param string $tag
	 *	@return bool
	 */
	public function insert ($id_poster, $tag)
	{
		$data = array (
			'id_poster' => $id_poster,
			'tag' 		=> $tag
		);

		//	To ensure unique combination of poster and tag pair, checking is necessary
		if ( $this->is_exist ($data, 'data_tag') )
			return FALSE;

		return $this->db->insert ('data_tag', $data);
	}

	/**
	 *	Updates tag only if the to-be tag is not already present
	 *	@param mixed $id_tag
	 *	@param array $data
	 *	@return bool
	 */
	public function update ($id_tag, $data)
	{
		if ( ! $this->is_array_valid ($data) )
			return FALSE;
		
		$data = $this->expunge ($data, 'id_tag');

		if ( $this->is_exist ($data, 'data_tag') )
			return FALSE;
		
		$this->db->where ('id_tag', $id_tag);
		return $this->db->update ('data_tag', $data);
	}

	/**
	 *	Deletes data
	 *	@param mixed $id_tag
	 *	@return bool
	 */
	public function delete ($id_tag)
	{
		$this->db->where ('id_tag', $id_tag);
		return $this->db->delete ('data_tag');
	}
}

?>