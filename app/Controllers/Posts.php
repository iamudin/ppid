<?php

namespace App\Controllers;

use App\Core\CI_Controller;

#[\AllowDynamicProperties]
class Posts extends CI_Controller{
	function __construct()
	{
		parent::__construct();
		$this->load->model('posts_model');
		$this->load->library('pagination');

	}

	function page()
	{
		$rows = 2;

		$page = $this->uri->segment(3);

		$page = $page ? (($page * $rows) - 2) : 0;

		$input = $this->input->post();

		$data['posts'] = $this->posts_model->get($rows, $page);

		$data['paging'] = $this->posts_model->paging();

		$this->load->view('posts', $data);
	}
}

 ?>	