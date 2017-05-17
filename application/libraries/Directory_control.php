<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Directory_control
{
	private $ci;
	private $basepath;
	private $delim;

	public function __construct ()
	{
		$this->ci =& get_instance();
		$this->ci->load->helper ('tokenizer_helper');

		$this->delim = DIRECTORY_SEPARATOR;
		$this->basepath = $this->_normalize_path (APPPATH . '..') . $this->delim;
		if ( strcmp ("/", substr ($this->basepath, 0, 1) ) != 0 && $this->delim == '/')
			$this->basepath = '/' . $this->basepath;
	}

	/**
	 *	Mengeset basepath untuk direktori
	 *	@param string $path
	 */
	public function set_basepath ($path)
	{
		$this->basepath = $this->_normalize_path ($path);
		$this->basepath = $this->_check_slash($this->basepath);
	}

	/**
	 *	Mengembalikan nilai basepath dan perpanjangannya
	 *	@param string $dirfile Direktori yang ingin diberikan prefix dengan basepath
	 *	@return string
	 */
	public function get_basepath ($dirfile = '')
	{
		return $this->basepath . $this->_normalize_path ($dirfile);
	}

	/**
	 *	Menyambung nama direktori untuk basepath
	 *	@param string $path
	 */
	public function append_basepath ($path)
	{
		$this->basepath = $this->_check_slash($this->basepath);
		$this->basepath .= $this->_normalize_path ($path);
	}

	/**
	 *	Membuat direktori baru. Pembuatan dilakukan secara rekursif
	 *	@param string $basedir Direktori tempat direktori baru akan dibuat
	 *	@param mixed $dirfile Direktori yang akan dibuat
	 * 	@param string Directory path yang dimaksud
	 */
	public function create_dir ($dirfile, $basedir = NULL)
	{
		$this->basepath = $this->_check_slash($this->basepath);

		if ($basedir == NULL)
			$basedir = $this->basepath;

		if ( ! is_array ($dirfile) )
			$folders = string_split ($dirfile, $this->delim);
		else
		{
			$dirfile = $this->_normalize_path ($dirfile);
			$folders = $dirfile;
		}	
		
		foreach ($folders as $f)
		{
			if ( ! file_exists ($basedir . $f))
				mkdir ($basedir . $f);
			
			$basedir .= $f . $this->delim;
		}

		return $basedir;
	}

	/**
	 *	Membuat string direktori yang valid dengan menghilangkan ".."
	 *	dan mengganti delimiter sesuai OS yang digunakan
	 *	@param string $string
	 *	@return string
	 */
	private function _normalize_path ($string)
	{
		$string = preg_replace ("/(\\\|\/)/", $this->delim, $string);
		$folders = string_split ($string, $this->delim);
		
		for ($i = 0; $i < count ($folders); $i++)
		{
			if ( strcmp ( $folders[$i], '..') == 0 )
			{
				array_splice ($folders, $i--, 1);
				if ($i >= 0)
					array_splice ($folders, $i--, 1);
			}
		}

		$output = string_create ($folders, $this->delim);

		//	Catching the front dir separator
		if (strcmp (substr ($string, 0, 1), $this->delim) == 0 && strcmp (substr ($output, 0, 1), $this->delim) != 0)
			$output = $this->delim . $output;
		
		//	Catching the back dir separator
		if (strcmp (substr ($string, -1, 1), $this->delim) == 0 && strcmp (substr ($output, -1, 1), $this->delim) != 0)
			$output = $output . $this->delim;
		
		return $output;
	}

	/**
	 *	Mengecek apakah di akhir @param $string ada garis miring atau tidak, dan
	 *	mengembalikan string yang memiliki garis miring
	 *	@param string $string
	 *	@param string
	 */
	private function _check_slash ($string)
	{
		if ( substr ($string, -1, 1) != $this->delim )
			$string .= $this->delim;
		
		return $string;
	}
}
?>