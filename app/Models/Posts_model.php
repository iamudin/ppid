<?php

namespace App\Models;

use App\Core\CI_Model;

#[\AllowDynamicProperties]
class Posts_model extends CI_Model{

	function __construct()
	{
		
	}

	function get($limit = null, $start = null)
	{ 
				
		$DB = $this->db->from('posts')
			->limit($limit, $start)
			->order_by('post_id', 'desc');

		return $DB->get()->result();
	}

	function paging()
	{
		$this->load->library('pagination');	
		$url = 'posts/page';
		$total = $this->db->count_all('posts');
		$paging = $this->pagination->paging($url, $total);
		return $paging;
	}
}
 ?>