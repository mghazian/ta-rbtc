<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'Generic_model.php';

class Status_model extends Generic_model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function find_id ($id)
	{
		$this->db->where ('id', $id);
		$result = $this->db->get ('ref_status');

		return $result->row_array();
	}

	public function all ()
	{
		$result = $this->db->get ('ref_status');
		return $result->result_array();
	}
}

?>