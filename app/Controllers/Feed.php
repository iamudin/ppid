<?php

namespace App\Controllers;

use App\Core\CI_Controller;

#[\AllowDynamicProperties]
class Feed extends CI_Controller
{
public function __construct() {
		parent::__construct();
		$this->load->helper(array('form','url', 'text_helper','date'));
		$this->load->database();
		$this->load->helper(array('xml','text'));
		$this->load->model('mdl_rss');
    }
	
	public function index(){

		$data = array(
			'encoding' 			=> 'utf-8',
			'feed_name' 		=> 'www.ppid.bengkaliskab.go.id',
			'feed_url' 			=> 'http://ppid.bengkaliskab.go.id/feed/',
			'page_description' 	=> 'PPID Kabupaten Bengkalis',
			'page_language' 	=> 'en-ca',
			'creator_email' 	=> 'affandyfreaks@gmail.com',
			'posts' 			=> $this->mdl_rss->get_posts(25)
		);
		header("Content-Type: application/rss+xml");
		$this->load->vars($data);
		$this->load->view('feed/rss');
	}
}
