<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Uploader {

	private $save_dir;
	private $ds;

	public function __construct()
	{
		$ds = DIRECTORY_SEPARATOR;
		$basepath = dirname (APPPATH);
		$this->save_dir = $basepath . $ds . 'upload' . $ds;

		if ( ! file_exists ($this->save_dir) )
			mkdir ($this->save_dir);
	}

	public function upload ($file)
	{
		$target_file = $this->save_dir . $file['name'];
		$tmp_name = basename ($file['tmp_name']);

		if ( file_exists ($target_file) )
		{
			move_uploaded_file($file['tmp_name'], $target_file . '_' . $tmp_name);
			unlink ($target_file);
			rename ($target_file . '_' . $tmp_name, $target_file);

			return ( file_exists ($target_file) ) ? $target_file : NULL;
		}

		return (move_uploaded_file ($file['tmp_name'], $target_file) ) ? $target_file : NULL;
	}
}
