<?php

namespace App\Controllers;

use App\Core\CI_Controller;

#[\AllowDynamicProperties]
class Rss2 extends CI_Controller
{
	
function index() {
	$this->load->helper('xml');
    $this->load->helper('text');
	#Getting data from Database with Active Record
	$this->db->order_by('id_berita', 'desc'); #order so newest posts would be first
	$this->db->limit(5); #25 is a great number for RSS feeds 10-20 is too few
	$query = $this->db->get('tblberita'); #make the query
	#RSS data
	$data['title'] = 'Latest Posts'; #RSS feed title
	$data['link'] = base_url(); #site link where the newest posts are, base_url() needs url helper
	$data['description'] = 'Latest posts of our site.'; #describe the feeds
 
	$data['items'] = $query->result(); #put posts to our $data array
 	
	$this->load->view('rssku',$data);
}



}