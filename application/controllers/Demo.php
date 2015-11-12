<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Demo extends CI_Controller {
	public function index()
	{
		$this->load->library("Template");
		$this->template->set_title("Testing Template");
		$this->template->add_css('assets/css/style.css');
		$this->template->add_css('assets/js/script.js');
		$this->template->load('demo');
	}
}