<?php

namespace App\Models;

use App\Core\CI_Model;

#[\AllowDynamicProperties]
class Mdl_rss extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}


	function get_posts($count)
	{
		$this->db->order_by('id_berita', 'desc'); 
		$query = $this->db->get('tblberita', $count)->result();
		return $query;
	}
	
}