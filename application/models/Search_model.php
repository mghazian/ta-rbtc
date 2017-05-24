<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function search ($keyword)
	{
		$this->db->like ($keyword);

		return $this->db->get('data_poster')->result_array();
	}
}

?>