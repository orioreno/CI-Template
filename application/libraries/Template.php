<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Template 
{
	var $ci;
	protected $js;
	protected $css;
	protected $title;
	protected $tpl_view;
	
	function __construct() {
		$this->ci =& get_instance();
		$this->js = array();
		$this->css = array();
		$this->title = "";
		$this->tpl_view = 'default';
	}
	 
	function set_title($title) {
		$this->title = $title;
	}
    
	function add_js($path) {
		$this->js[] = $path;
	}
	
	function add_css($path) {
		$this->css[] = $path;
	}
	
	function set_template($path) {
		$this->tpl_view = $path;
	}
	
	function add_package($name) {
		switch ($name):
			case 'angular':
				$this->js[] = 'packages/angular/angular.min.js';
				break;
			case 'accounting':
				$this->js[] = 'packages/accounting/accounting.min.js';
				break;
			case 'datatable':
				$this->css[] = 'packages/font-awesome-4.3.0/css/font-awesome.min.css';
				$this->css[] = 'packages/datatable/css/jquery.dataTables.min.css';
				$this->js[] = 'packages/datatable/js/jquery.dataTables.min.js';
				$this->js[] = 'packages/datatable/js/dataTables.bootstrap.js';
				break;
			case 'spinner':
				$this->css[] = 'packages/bootstrap-touchspin/css/bootstrap-touchspin.min.css';
				$this->js[] = 'packages/bootstrap-touchspin/js/bootstrap-touchspin.min.js';
				break;
			case 'datepicker':
				$this->css[] = 'packages/bootstrap-datepicker/css/datepicker.css';
				$this->css[] = 'packages/bootstrap-datepicker/css/datepicker3.css';
				$this->js[] = 'packages/bootstrap-datepicker/js/bootstrap-datepicker.js';
				break;
			case 'bootstrap-validator':
				$this->js[] = 'packages/bootstrap-validator/dist/validator.min.js';
				break;
		endswitch;
	}
	
	function load($body_view = null, $data = null) {
		if ( ! is_null( $body_view ) ) {
			$body = $this->ci->load->view($body_view, $data, TRUE);
			 
			if ( is_null($data) ) {
				$data = array('body' => $body);
			} else if ( is_array($data) ) {
				$data['body'] = $body;
			} else if ( is_object($data) ) {
				$data->body = $body;
			}
		}
		
		$data['title'] = $this->title;
		$data['js'] = array();
		$data['css'] = array();
        
		$this->ci->load->helper('url');
		
		if ( !empty($this->js) ) {
			foreach ($this->js as $js) {
				$path = $js;
				if ( file_exists( $path ) ) {
					$data['js'][] = '<script type="text/javascript" src="'.base_url($path).'"></script>';
				}
			}
			$data['js'] = implode($data['js'],PHP_EOL);
		}
		
		if ( !empty($this->css) ) {
			foreach ($this->css as $css){
				$path = $css;
				if ( file_exists( $path ) ) {
					$data['css'][] = '<link rel="stylesheet" type="text/css" href="'.base_url($path).'"/>';
				}
			}
			$data['css'] = implode($data['css'],PHP_EOL);
		}
        
		$this->ci->load->view('templates/'.$this->tpl_view, $data);
	}
}