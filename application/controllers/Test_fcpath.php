<?php

defined("BASEPATH") or exit("script not allowed");

class test_fcpath extends CI_Controller
{
	public function index()
	{
		//echo "test";
		$path = FCPATH;
		echo $path;
	}
}

?>