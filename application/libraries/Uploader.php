<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Uploader {

	private $folder_name;
	private $save_dir;
	private $ds;

	public function __construct()
	{
		$this->ds = DIRECTORY_SEPARATOR;
		$basepath = dirname (APPPATH);
		$this->folder_name = 'upload';
		$this->save_dir = $basepath . $this->ds . $this->folder_name . $this->ds;

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

			return ( file_exists ($target_file) ) ? $this->folder_name . $this->ds . $file['name'] : NULL;
		}
		
		return (move_uploaded_file ($file['tmp_name'], $target_file) ) ? $this->folder_name . $this->ds . $file['name'] : NULL;
	}
}
