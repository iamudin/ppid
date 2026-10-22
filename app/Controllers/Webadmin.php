<?php

namespace App\Controllers;

use App\Core\CI_Controller;
use TCPDF;

#[\AllowDynamicProperties]
class Webadmin extends CI_Controller
{
	var $gallerypath;
	var $gallerypath_ori;
	function __construct()
	{
		parent::__construct();
		if (session_status() === PHP_SESSION_NONE) {
			session_start();
		}
		$this->load->helper(array('form', 'url', 'text_helper', 'date'));
		$this->load->model('Webadmin_model');
	}
	function tambahlampiran()
	{
		$page = $this->uri->segment(4);
		$idx = $this->uri->segment(3);
		$limit = 100;
		if (!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;
		$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['h2_title'] = 'Tambah Foto';
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$total = $this->Webadmin_model->Total_Data("tbl_galeri");
			$config['base_url'] = base_url() . '/webadmin/tambahlampiran/';
			$config['total_rows'] = $total->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 4;
			//config for bootstrap pagination class integration
			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			$config['first_link'] = false;
			$config['last_link'] = false;
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			$config['prev_link'] = '&laquo';
			$config['prev_tag_open'] = '<li class="prev">';
			$config['prev_tag_close'] = '</li>';
			$config['next_link'] = '&raquo';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><a href="#">';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';

			$this->pagination->initialize($config);
			$data['paginator'] = $this->pagination->create_links();
			$data['album'] = $this->Webadmin_model->Semua_Album();
			$data['daftarartikel'] = $this->Webadmin_model->Lampiran($idx, $offset, $limit);
			$_SESSION['ses_kcfinder'] = array();
			$_SESSION['ses_kcfinder']['disabled'] = false;
			$_SESSION['ses_kcfinder']['uploadURL'] = "../content_upload";
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/pengumuman/lampiran', $data);
			$this->load->view('webadmin/bg_bawahbaru');
		}

	}



	function updateku()
	{
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {

			//$data2['status'] = "administrator";
//			$this->Webadmin_model->Update_Content("user",$data2,"kode_wartawan");
//			$this->session->set_flashdata('message', 'Data Tersimpan!');
//	   		echo "<meta http-equiv='refresh' content='0; url=".base_url()."webadmin/pengguna'>";
			$action = $this->input->post('action');
			$updateRecordsArray = $this->input->post('recordsArray');

			if ($action == "updateRecordsListings") {

				$listingCounter = 1;
				foreach ($updateRecordsArray as $recordIDValue) {
					$data2["id_kepegawaian"] = $recordIDValue;
					$data2['urut'] = $listingCounter;
					$this->Webadmin_model->Update_Content("tbl_kepegawaian", $data2, "id_kepegawaian");
					$listingCounter = $listingCounter + 1;
				}

				echo '<pre>';
				print_r($updateRecordsArray);
				echo '</pre>';
				echo 'If you refresh the page, you will see that records will stay just as you modified.';
			}

		}

	}
	function loginpage()
	{
		$cek = $this->session->userdata('logged_in');
		if (empty($cek)) {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$this->load->view('webadmin/bg_login', $data);
		} else {

			header('location:' . base_url() . 'webadmin'); exit;
		}
	}


	public function login()
	{
		$cek = $this->session->userdata('logged_in');
		if (empty($cek)) {
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			//$this->form_validation->set_rules('captcha', 'Captcha', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
				$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
				$data['instansi'] = $this->config->item('nama_instansi');
				$data['credit'] = $this->config->item('credit_aplikasi');
				$data['alamat'] = $this->config->item('alamat_instansi');
				$this->load->view('webadmin/bg_login', $data);
			} else {
				$u = $this->input->post('username', TRUE);
				$p = $this->input->post('password', TRUE);
				$this->Webadmin_model->getLoginData($u, $p);
			}
		} else {
			header('location:' . base_url() . 'webadmin'); exit;
		}
	}

	function logout()
	{
		$this->session->sess_destroy();
		header('location:' . base_url() . ''); exit;
	}
	function index()
	{

		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$data['message'] = "";
			$data['daftarartikel'] = $this->Webadmin_model->Artikel("0", "5");
			$data['permohonan'] = $this->Webadmin_model->Permohonan(0, 1, 'N');
			$data['keberatan'] = $this->Webadmin_model->Keberatan(0, 1);

			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/bg_home', $data);
			$this->load->view('webadmin/bg_bawah');
		}
	}
	function pengguna()
	{
		$page = $this->uri->segment(3);
		$limit = 10;
		if (!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;
		$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$data['message'] = "Data Pengguna";
			$total = $this->Webadmin_model->Total_Data("user");
			$config['base_url'] = base_url() . '/webadmin/pengguna/';
			$config['total_rows'] = $total->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			$config['first_link'] = false;
			$config['last_link'] = false;
			$config['first_tag_open'] = '<li class="page-item">';
			$config['first_tag_close'] = '</li>';
			$config['prev_link'] = '&laquo';
			$config['prev_tag_open'] = '<li class="prev">';
			$config['prev_tag_close'] = '</li>';
			$config['next_link'] = '&raquo';
			$config['next_tag_open'] = '<li class="page-item">';
			$config['next_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li class="page-item">';
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$this->pagination->initialize($config);
			$data['paginator'] = $this->pagination->create_links();
			$data['daftarartikel'] = $this->Webadmin_model->Wartawan($offset, $limit);
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/pengguna/wartawan', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function tambahpengguna()
	{
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/pengguna/tambah_pengguna', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function simpanwartawan()
	{
		$page = $this->uri->segment(3);
		$limit = 10;
		if (!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;
		$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data2['nama'] = $this->input->post('nama');
			$data2['alamat'] = $this->input->post('alamat');
			$data2['username'] = $this->input->post('username');
			$data2['akses'] = $this->input->post('status');
			$data2['password'] = MD5($this->input->post('password') . $this->config->item("key_login"));
			$data2['status'] = "administrator";
			$this->form_validation->set_rules('nama', 'Nama Lengkap', 'trim|required');
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
				$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
				$data['instansi'] = $this->config->item('nama_instansi');
				$data['credit'] = $this->config->item('credit_aplikasi');
				$data['alamat'] = $this->config->item('alamat_instansi');
				$this->load->view('webadmin/bg_atas', $data);
				$this->load->view('webadmin/pengguna/tambah_pengguna', $data);
				$this->load->view('webadmin/bg_bawah');
			} else {
				$this->Webadmin_model->In_Polling("user", $data2);
				$this->session->set_flashdata('message', 'Data Tersimpan!');
				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/pengguna'>";
			}
		}

	}
	function hapuswartawan()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$this->Webadmin_model->Delete_Content($id, "kode_wartawan", "user");
			$this->session->set_flashdata('message', 'Data Terhapus!');
			echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/pengguna'>";
		}


	}
	function editwartawan()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$data["edit"] = $this->Webadmin_model->Edit_Content("user", "kode_wartawan=$id");
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/pengguna/edit_wartawan', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function updatewartawan()
	{
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data2["kode_wartawan"] = $this->input->post('id');
			$data2['nama'] = $this->input->post('nama');
			$data2['alamat'] = $this->input->post('alamat');
			$data2['username'] = $this->input->post('username');
			$data2['akses'] = $this->input->post('status');
			$data2['password'] = MD5($this->input->post('password') . $this->config->item("key_login"));
			$data2['status'] = "administrator";
			$this->Webadmin_model->Update_Content("user", $data2, "kode_wartawan");
			$this->session->set_flashdata('message', 'Data Tersimpan!');
			echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/pengguna'>";
		}

	}
	function menustatis()
	{
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['h2_title'] = 'Menu Statis';
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$data["daftar"] = $this->Webadmin_model->Semua_Sitemap_Induk();
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/menustatis/menustatis', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function simpanmenu()
	{
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$timezone = "Asia/Jakarta";
			if (function_exists('date_default_timezone_set'))
				date_default_timezone_set($timezone);
			$tgl = " %Y-%m-%d";
			$jam = "%h:%i:%a";
			$time = time();
			$date = date("Y/m/d");
			$title = $this->input->post('permalink');
			$title = strtolower($title);
			$newtitle = string_limit_words($title, 15);
			$urltitle = preg_replace('/[^a-z0-9]/i', ' ', $newtitle);
			$newurltitle = str_replace(" ", "-", $newtitle);
			if ($this->input->post('visible') == "N") {
				$nilai = "statis";
			} elseif ($this->input->post('visible') == "Y") {
				$nilai = "download";
			} elseif ($this->input->post('visible') == "LINK") {
				$nilai = "link";
			} else {
				$nilai = "berita";
			}
			$data2['sorting'] = $nilai;
			$data2['title'] = $this->input->post('permalink');
			$data2['id_parent'] = $this->input->post('kategori');
			$data2['link'] = $this->input->post('permalink2');
			$data2['status'] = $this->input->post('visible');
			$data2['level'] = "1";
			$data2['permalink'] = $newurltitle;
			if ($data2['title'] == "") {
				echo "Data Masih Kosong";
			} else {
				$this->Webadmin_model->In_Polling("tbl_menu", $data2);
				$this->session->set_flashdata('message', 'Data Tersimpan!');
				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/menustatis'>";
			}
		}

	}
	function ubahmenu()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}
		$datestring = "Login : %d-%m-%Y pukul %h:%i %a";
		$time = time();
		$data["tanggal"] = mdate($datestring, $time);
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['h2_title'] = 'Ubah Menu Statis';
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$data["edit"] = $this->Webadmin_model->Edit_Content("tbl_menu", "id=$id");
			$data["daftar"] = $this->Webadmin_model->Semua_Sitemap_Induk();
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/menustatis/edit_menustatis', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function updatemenu()
	{
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$tgl = " %Y-%m-%d";
			$jam = "%h:%i:%a";
			$time = time();
			$data2["id"] = $this->input->post('id');
			$title = $this->input->post('permalink');
			$title = strtolower($title);
			$newtitle = string_limit_words($title, 15);
			$urltitle = preg_replace('/[^a-z0-9]/i', ' ', $newtitle);
			$newurltitle = str_replace(" ", "-", $newtitle);
			if ($this->input->post('visible') == "N") {
				$nilai = "statis";
			} elseif ($this->input->post('visible') == "Y") {
				$nilai = "download";
			} elseif ($this->input->post('visible') == "LINK") {
				$nilai = "link";
			} else {
				$nilai = "berita";
			}
			$data2['sorting'] = $nilai;
			$data2['title'] = $this->input->post('permalink');
			$data2['link'] = $this->input->post('permalink2');
			$data2['id_parent'] = $this->input->post('kategori');
			$data2['status'] = $this->input->post('visible');
			$data2['level'] = "1";
			$data2['permalink'] = $newurltitle;
			$this->Webadmin_model->Update_Content("tbl_menu", $data2, "id");
			$this->session->set_flashdata('message', 'Data Tersimpan!');
			echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/menustatis'>";
		}

	}
	function hapusmenu()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$this->Webadmin_model->Delete_Content($id, "id", "tbl_menu");
			$this->session->set_flashdata('message', 'Data Terhapus!');
			echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/menustatis'>";
		}

	}
	function statis()
	{
		$page = $this->uri->segment(3);
		$limit = 100;
		if (!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;
		$datestring = "Login : %d-%m-%Y pukul %h:%i %a";
		$time = time();
		$data["tanggal"] = mdate($datestring, $time);
		$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['h2_title'] = 'Statis';
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$total = $this->Webadmin_model->Total_Data("tbl_menu");
			$config['base_url'] = base_url() . '/webadmin/statis/';
			$config['total_rows'] = $total->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			$config['first_link'] = false;
			$config['last_link'] = false;
			$config['first_tag_open'] = '<li class="page-item">';
			$config['first_tag_close'] = '</li>';
			$config['prev_link'] = '&laquo';
			$config['prev_tag_open'] = '<li class="prev">';
			$config['prev_tag_close'] = '</li>';
			$config['next_link'] = '&raquo';
			$config['next_tag_open'] = '<li class="page-item">';
			$config['next_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li class="page-item">';
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$this->pagination->initialize($config);
			$data['paginator'] = $this->pagination->create_links();
			$data['daftarartikel'] = $this->Webadmin_model->Statis($offset, $limit);
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/statis/statis', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function tambahstatis()
	{
		$datestring = "Login : %d-%m-%Y pukul %h:%i %a";
		$time = time();
		$tgl = "%d-%m-%Y";
		$data["wkt_skr"] = mdate($tgl, $time);
		$data["tanggal"] = mdate($datestring, $time);
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['h2_title'] = 'Tambah Data Statis';
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$data["menu"] = $this->Webadmin_model->Semua_Menu();
			$_SESSION['ses_kcfinder'] = array();
			$_SESSION['ses_kcfinder']['disabled'] = false;
			$_SESSION['ses_kcfinder']['uploadURL'] = "../content_upload";
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/statis/tambah_statis', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function simpandatastatis()
	{
		$page = $this->uri->segment(3);
		$limit = 10;
		if (!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;

		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data2['data_id'] = $this->input->post('data_id');
			$data2['content'] = $this->input->post('content');
			$this->form_validation->set_rules('content', 'Isi Content Statis', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
				$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
				$data['instansi'] = $this->config->item('nama_instansi');
				$data['credit'] = $this->config->item('credit_aplikasi');
				$data['alamat'] = $this->config->item('alamat_instansi');
				$data["menu"] = $this->Webadmin_model->Semua_Menu();
				$this->load->view('webadmin/bg_atas', $data);
				$this->load->view('webadmin/statis/tambah_statis', $data);
				$this->load->view('webadmin/bg_bawah');
			} else {
				$this->Webadmin_model->In_Polling("tbl_data", $data2);
				$this->session->set_flashdata('message', 'Data Tersimpan!');
				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/statis'>";
			}
		}

	}
	function editstatis()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}
		$datestring = "Login : %d-%m-%Y pukul %h:%i %a";
		$time = time();
		$data["tanggal"] = mdate($datestring, $time);
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['h2_title'] = 'Ubah Data Statis';
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			//$_SESSION['ses_admin']=$session;
			$_SESSION['ses_kcfinder'] = array();
			$_SESSION['ses_kcfinder']['disabled'] = false;
			$_SESSION['ses_kcfinder']['uploadURL'] = "../content_upload";
			$data["edit"] = $this->Webadmin_model->Edit_Content("tbl_data", "id_data=$id");
			$data["menu"] = $this->Webadmin_model->Semua_Menu();
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/statis/edit_statis', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function updatedatastatis()
	{
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$tgl = " %Y-%m-%d";
			$jam = "%h:%i:%a";
			$time = time();
			$data2["id_data"] = $this->input->post('id_data');
			$data2['data_id'] = $this->input->post('data_id');
			$data2['content'] = $this->input->post('content');
			$this->Webadmin_model->Update_Content("tbl_data", $data2, "id_data");
			$this->session->set_flashdata('message', 'Data Tersimpan!');
			echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/statis'>";
		}

	}
	function hapusstatis()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$this->Webadmin_model->Delete_Content($id, "id_data", "tbl_data");
			$this->session->set_flashdata('message', 'Data Terhapus!');
			echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/statis'>";
		}

	}

	function banner()
	{
		$page = $this->uri->segment(3);
		$limit = 100;
		if (!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;
		$datestring = "Login : %d-%m-%Y pukul %h:%i %a";
		$time = time();
		$data["tanggal"] = mdate($datestring, $time);
		$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['h2_title'] = 'Master Banner';
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$total = $this->Webadmin_model->Total_Data("tbl_banner");
			$config['base_url'] = base_url() . 'index.php/webadmin/banner/';
			$config['total_rows'] = $total->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
			//config for bootstrap pagination class integration
			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			$config['first_link'] = false;
			$config['last_link'] = false;
			$config['first_tag_open'] = '<li class="page-item">';
			$config['first_tag_close'] = '</li>';
			$config['prev_link'] = '&laquo';
			$config['prev_tag_open'] = '<li class="prev">';
			$config['prev_tag_close'] = '</li>';
			$config['next_link'] = '&raquo';
			$config['next_tag_open'] = '<li class="page-item">';
			$config['next_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li class="page-item">';
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';

			$this->pagination->initialize($config);
			$data['paginator'] = $this->pagination->create_links();
			$data['daftarartikel'] = $this->Webadmin_model->Banner($offset, $limit);
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/banner/banner', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function hapusbanner()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$this->session->set_flashdata('message', 'Data Terhapus!');
			$this->Webadmin_model->Delete_Content($id, "id_banner", "tbl_banner");
			echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "index.php/webadmin/banner'>";
		}

	}
	function tambahbanner()
	{

		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/banner/tambah_banner', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function uploadbanner()
	{
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$tgl = " %Y-%m-%d";
			$jam = "%h:%i:%a";
			$time = time();
			$in["judul"] = $this->input->post('nama');
			$in["keterangan"] = $this->input->post('keterangan');
			$acak = rand(00000000000, 99999999999);
			$bersih = $_FILES['userfile']['name'];
			$nm = str_replace(" ", "_", "$bersih");
			$pisah = explode(".", $nm);
			$nama_murni = $pisah[0];
			$ubah = $acak . $nama_murni; //tanpa ekstensi
			$config["file_name"] = $ubah; //dengan eekstensi
			$in["foto_besar"] = $acak . $nm;
			$config['upload_path'] = './asset/banner/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size'] = '500000';
			$config['max_width'] = '12000';
			$config['max_height'] = '12000';
			$this->load->library('upload', $config);

			if (!$this->upload->do_upload()) {
				echo $this->upload->display_errors();
			} else {
				$this->session->set_flashdata('message', 'Data Tersimpan!');
				$this->Webadmin_model->In_Polling("tbl_banner", $in);
				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "index.php/webadmin/banner'>";
			}

		}

	}
	function editbanner()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}
		$datestring = "Login : %d-%m-%Y pukul %h:%i %a";
		$time = time();
		$data["tanggal"] = mdate($datestring, $time);
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['h2_title'] = 'Ubah Banner';
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$data["edit"] = $this->Webadmin_model->Edit_Content("tbl_banner", "id_banner=$id");
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/banner/edit_banner', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function updatebanner()
	{
		$data2 = array();
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$acak = rand(00000000000, 99999999999);
			$bersih = $_FILES['userfile']['name'];
			$nm = str_replace(" ", "_", "$bersih");
			$pisah = explode(".", $nm);
			$nama_murni = $pisah[0];
			$ubah = $acak . $nama_murni; //tanpa ekstensi
			$config["file_name"] = $ubah; //dengan eekstensi

			$config['upload_path'] = './asset/banner/';
			$config['allowed_types'] = 'bmp|gif|jpg|jpeg|png';
			$config['max_size'] = '10000';
			$config['max_width'] = '10000';
			$config['max_height'] = '10000';
			$this->load->library('upload', $config);
			if (empty($_FILES['userfile']['name'])) {
				$data2["judul"] = $this->input->post('nama');
				$data2["keterangan"] = $this->input->post('keterangan');
				$data2["id_banner"] = $this->input->post('id_foto');
				$this->Webadmin_model->Update_Content("tbl_banner", $data2, "id_banner");
				$this->session->set_flashdata('message', 'Data Tersimpan!');
				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "index.php/webadmin/banner'>";
			} else {
				if (!$this->upload->do_upload()) {
					echo $this->upload->display_errors();
				} else {
					$data2["judul"] = $this->input->post('nama');
					$data2["keterangan"] = $this->input->post('keterangan');
					$data2["id_banner"] = $this->input->post('id_foto');
					$data2["foto_besar"] = $acak . $nm;
					$this->Webadmin_model->Update_Content("tbl_banner", $data2, "id_banner");
					echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "index.php/webadmin/banner'>";
				}
			}
		}

	}

	function link()
	{
		$page = $this->uri->segment(3);
		$limit = 30;
		if (!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;

		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		$data["page"] = $page;
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$data['message'] = "Data Pengguna";
			$total = $this->Webadmin_model->Total_Data("tbl_link");
			$config['base_url'] = base_url() . '/webadmin/link/';
			$config['total_rows'] = $total->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			$config['first_link'] = false;
			$config['last_link'] = false;
			$config['first_tag_open'] = '<li class="page-item">';
			$config['first_tag_close'] = '</li>';
			$config['prev_link'] = '&laquo';
			$config['prev_tag_open'] = '<li class="prev">';
			$config['prev_tag_close'] = '</li>';
			$config['next_link'] = '&raquo';
			$config['next_tag_open'] = '<li class="page-item">';
			$config['next_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li class="page-item">';
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$this->pagination->initialize($config);
			$data['paginator'] = $this->pagination->create_links();
			$data['daftarartikel'] = $this->Webadmin_model->Link($offset, $limit);
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/link/link', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function tambahlink()
	{

		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$_SESSION['ses_kcfinder'] = array();
			$_SESSION['ses_kcfinder']['disabled'] = false;
			$_SESSION['ses_kcfinder']['uploadURL'] = "../content_upload";
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/link/tambah_link', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function simpanlink()
	{
		$page = $this->uri->segment(3);
		$limit = 10;
		if (!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;

		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');

		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data2['judul_link'] = $this->input->post('nama');
			$data2['url'] = $this->input->post('username');
			$this->form_validation->set_rules('nama', 'Judul Link', 'trim|required');
			$this->form_validation->set_rules('username', 'Url Link', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
				$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
				$data['instansi'] = $this->config->item('nama_instansi');
				$data['credit'] = $this->config->item('credit_aplikasi');
				$data['alamat'] = $this->config->item('alamat_instansi');
				$this->load->view('webadmin/bg_atas', $data);
				$this->load->view('webadmin/link/tambah_link', $data);
				$this->load->view('webadmin/bg_bawah');
			} else {
				$acak = rand(00000000000, 99999999999);
				$bersih = $_FILES['userfile']['name'];
				$nm = str_replace(" ", "_", "$bersih");
				$pisah = explode(".", $nm);
				$nama_murni = $pisah[0];
				$ubah = $acak . $nama_murni; //tanpa ekstensi
				$config["file_name"] = $ubah; //dengan eekstensi
				$data2["gambar"] = $acak . $nm;
				$config['upload_path'] = './asset/banner/';
				$config['allowed_types'] = 'gif|jpg|jpeg|png';
				$config['max_size'] = '500000';
				$config['max_width'] = '12000';
				$config['max_height'] = '12000';
				$this->load->library('upload', $config);

				if (!$this->upload->do_upload()) {
					echo $this->upload->display_errors();
				} else {
					$this->Webadmin_model->In_Polling("tbl_link", $data2);
					$this->session->set_flashdata('message', 'Data Tersimpan!');
					echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/link'>";
				}
			}
		}

	}
	function hapuslink()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$this->Webadmin_model->Delete_Content($id, "id_link", "tbl_link");
			$this->session->set_flashdata('message', 'Data Terhapus!');
			echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/link'>";
		}

	}
	function editlink()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}

		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$_SESSION['ses_kcfinder'] = array();
			$_SESSION['ses_kcfinder']['disabled'] = false;
			$_SESSION['ses_kcfinder']['uploadURL'] = "../content_upload";
			$data["edit"] = $this->Webadmin_model->Edit_Content("tbl_link", "id_link=$id");
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/link/edit_link', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function updatelink()
	{
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$tgl = " %Y-%m-%d";
			$jam = "%h:%i:%a";
			$time = time();
			//for gambar
			$acak = rand(00000000000, 99999999999);
			$bersih = $_FILES['userfile']['name'];
			$nm = str_replace(" ", "_", "$bersih");
			$pisah = explode(".", $nm);
			$nama_murni = $pisah[0];
			$ubah = $acak . $nama_murni; //tanpa ekstensi
			$config["file_name"] = $ubah; //dengan eekstensi	
			$config['upload_path'] = './asset/banner/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size'] = '10000';
			$config['max_width'] = '10000';
			$config['max_height'] = '10000';
			$this->load->library('upload', $config);
			if (empty($_FILES['userfile']['name'])) {
				//end gambar
				$data2["id_link"] = $this->input->post('id');
				$data2['judul_link'] = $this->input->post('nama');
				$data2['url'] = $this->input->post('username');
				$this->Webadmin_model->Update_Content("tbl_link", $data2, "id_link");
				$this->session->set_flashdata('message', 'Data Tersimpan!');
				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/link'>";
			} else {
				if (!$this->upload->do_upload()) {
					echo $this->upload->display_errors();
				} else {
					$data2["gambar"] = $acak . $nm;
					$data2["id_link"] = $this->input->post('id');
					$data2['judul_link'] = $this->input->post('nama');
					$data2['url'] = $this->input->post('username');
					$this->Webadmin_model->Update_Content("tbl_link", $data2, "id_link");
					$this->session->set_flashdata('message', 'Data Tersimpan!');
					echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/link'>";
				}
			}
		}

	}
	function kepegawaian()
	{
		$page = $this->uri->segment(3);
		$limit = 100;
		if (!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;
		$datestring = "Login : %d-%m-%Y pukul %h:%i %a";
		$time = time();
		$data["tanggal"] = mdate($datestring, $time);
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		$data["page"] = $page;
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['h2_title'] = 'Kepegawaian';
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$total = $this->Webadmin_model->Total_Data("tbl_kepegawaian");
			$config['base_url'] = base_url() . '/webadmin/kepegawaian/';
			$config['total_rows'] = $total->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
			//config for bootstrap pagination class integration
			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			$config['first_link'] = false;
			$config['last_link'] = false;
			$config['first_tag_open'] = '<li class="page-item">';
			$config['first_tag_close'] = '</li>';
			$config['prev_link'] = '&laquo';
			$config['prev_tag_open'] = '<li class="prev">';
			$config['prev_tag_close'] = '</li>';
			$config['next_link'] = '&raquo';
			$config['next_tag_open'] = '<li class="page-item">';
			$config['next_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li class="page-item">';
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';

			$this->pagination->initialize($config);
			$data['paginator'] = $this->pagination->create_links();
			$data['daftarartikel'] = $this->Webadmin_model->Kepegawaian($offset, $limit);
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/kepegawaian/kepegawaian', $data);
			$this->load->view('webadmin/bg_bawahpegawai');
		}

	}
	function hapuspegawai()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$this->Webadmin_model->Delete_Content($id, "id_kepegawaian", "tbl_kepegawaian");
			echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/kepegawaian'>";
		}

	}
	function tambahjabatan()
	{
		$page = $this->uri->segment(3);
		$limit = 10;
		if (!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;
		$data = array();
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['h2_title'] = 'Tambah Jenis Informasi';
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$tot_hal = $this->Webadmin_model->Total_Data("tbl_jabatan");
			$config['base_url'] = base_url() . '/webadmin/tambahjabatan/';
			$config['total_rows'] = $tot_hal->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
			//config for bootstrap pagination class integration
			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			$config['first_link'] = false;
			$config['last_link'] = false;
			$config['first_tag_open'] = '<li class="page-item">';
			$config['first_tag_close'] = '</li>';
			$config['prev_link'] = '&laquo';
			$config['prev_tag_open'] = '<li class="prev">';
			$config['prev_tag_close'] = '</li>';
			$config['next_link'] = '&raquo';
			$config['next_tag_open'] = '<li class="page-item">';
			$config['next_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li class="page-item">';
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';

			$this->pagination->initialize($config);
			$data["paginator"] = $this->pagination->create_links();
			$data["page"] = $page;
			$data['daftarartikel'] = $this->Webadmin_model->Jabatan($offset, $limit);
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/kepegawaian/tambahjabatan', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function simpanjabatan()
	{
		$page = $this->uri->segment(3);
		$limit = 10;
		if (!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data2['jabatan'] = $this->input->post('nama');
			$this->form_validation->set_rules('nama', 'Jabatan', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
				$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
				$data['instansi'] = $this->config->item('nama_instansi');
				$data['credit'] = $this->config->item('credit_aplikasi');
				$data['alamat'] = $this->config->item('alamat_instansi');
				$tot_hal = $this->Webadmin_model->Total_Data("tbl_jabatan");
				$config['base_url'] = base_url() . '/webadmin/tambahjabatan/';
				$config['total_rows'] = $tot_hal->num_rows();
				$config['per_page'] = $limit;
				$config['uri_segment'] = 3;
				//config for bootstrap pagination class integration
				$config['full_tag_open'] = '<ul class="pagination">';
				$config['full_tag_close'] = '</ul>';
				$config['first_link'] = false;
				$config['last_link'] = false;
				$config['first_tag_open'] = '<li class="page-item">';
				$config['first_tag_close'] = '</li>';
				$config['prev_link'] = '&laquo';
				$config['prev_tag_open'] = '<li class="prev">';
				$config['prev_tag_close'] = '</li>';
				$config['next_link'] = '&raquo';
				$config['next_tag_open'] = '<li class="page-item">';
				$config['next_tag_close'] = '</li>';
				$config['last_tag_open'] = '<li class="page-item">';
				$config['last_tag_close'] = '</li>';
				$config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
				$config['cur_tag_close'] = '</a></li>';
				$config['num_tag_open'] = '<li>';
				$config['num_tag_close'] = '</li>';

				$this->pagination->initialize($config);
				$data["paginator"] = $this->pagination->create_links();
				$data["page"] = $page;
				$data['daftarartikel'] = $this->Webadmin_model->Jabatan($offset, $limit);

				$this->load->view('webadmin/bg_atas', $data);
				$this->load->view('webadmin/kepegawaian/tambahjabatan', $data);
				$this->load->view('webadmin/bg_bawah');
			} else {
				$this->Webadmin_model->In_Polling("tbl_jabatan", $data2);
				$this->session->set_flashdata('message', 'Data Tersimpan!');
				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/tambahjabatan'>";
			}
		}

	}
	function hapusjabatan()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$this->Webadmin_model->Delete_Content($id, "id_jabatan", "tbl_jabatan");
			$this->session->set_flashdata('message', 'Data Terhapus!');
			echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/tambahjabatan'>";
		}

	}
	function tambahkepegawaian()
	{
		$datestring = "Login : %d-%m-%Y pukul %h:%i %a";
		$time = time();
		$tgl = "%d-%m-%Y";
		$data["wkt_skr"] = mdate($tgl, $time);
		$data["tanggal"] = mdate($datestring, $time);
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['h2_title'] = 'Tambah Informasi';
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$data["kategori"] = $this->Webadmin_model->Semua_Jabatan();
			$_SESSION['ses_kcfinder'] = array();
			$_SESSION['ses_kcfinder']['disabled'] = false;
			$_SESSION['ses_kcfinder']['uploadURL'] = "../content_upload";
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/kepegawaian/tambah_kepegawaian', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function editjabatan()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}

		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$_SESSION['ses_kcfinder'] = array();
			$_SESSION['ses_kcfinder']['disabled'] = false;
			$_SESSION['ses_kcfinder']['uploadURL'] = "../content_upload";
			$data["edit"] = $this->Webadmin_model->Edit_Content("tbl_jabatan", "id_jabatan=$id");
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/kepegawaian/edit_jabatan', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function updatejabatan()
	{
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$tgl = " %Y-%m-%d";
			$jam = "%h:%i:%a";
			$time = time();
			$data2["id_jabatan"] = $this->input->post('id');
			$data2['jabatan'] = $this->input->post('nama');
			$this->Webadmin_model->Update_Content("tbl_jabatan", $data2, "id_jabatan");
			$this->session->set_flashdata('message', 'Data Tersimpan!');
			echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/tambahjabatan'>";
		}

	}
	function simpanpegawai()
	{
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$timezone = "Asia/Jakarta";
			if (function_exists('date_default_timezone_set'))
				date_default_timezone_set($timezone);
			$tgl = " %Y-%m-%d";
			$jam = "%h:%i:%a";
			$time = time();
			$content = $this->input->post('content');
			$data2['nip'] = $this->input->post('nip');
			$data2['nama_pegawai'] = $this->input->post('nama');
			$data2['riwayat'] = preg_replace('#(href|src)="(.*?)/media#', '$1="' . base_url() . 'media', $content);
			$data2['kelahiran'] = $this->input->post('kelahiran');
			$data2['kode_jabatan'] = $this->input->post('kategori');
			$data2['jk'] = $this->input->post('editor');
			$data2['pangkat/gol'] = $this->input->post('golongan');
			$data2['pend_terakhir'] = $this->input->post('pendidikan');
			$data2['fb'] = $this->input->post('fb');
			$data2['ig'] = $this->input->post('ig');
			$data2['email'] = $this->input->post('email');
			if (empty($content) && empty($data2["nama_pegawai"])) {
				echo "Data Masih Kosong";
			} else {
				if (empty($_FILES['userfile']['name'])) {
					$data2["gambar"] = "welcome.gif";
					$data2["foto_kecil"] = "welcome.gif";
					$this->Webadmin_model->Simpan_Kepegawaian($data2);
					echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/kepegawaian'>";
				} else {
					$acak = rand(00000000000, 99999999999);
					$bersih = $_FILES['userfile']['name'];
					$nm = str_replace(" ", "_", "$bersih");
					$pisah = explode(".", $nm);
					$nama_murni = $pisah[0];
					$ubah = $acak . $nama_murni; //tanpa ekstensi
					$config["file_name"] = $ubah; //dengan eekstensi
					$in["foto_besar"] = $acak . $nm;
					$config['upload_path'] = './asset/pegawai/';
					$config['allowed_types'] = 'gif|jpg|jpeg|png';
					$config['max_size'] = '500000';
					$config['max_width'] = '12000';
					$config['max_height'] = '12000';
					$this->load->library('upload', $config);

					if (!$this->upload->do_upload()) {
						echo $this->upload->display_errors();
					} else {

						//---------------------------------------------------------------------------------------------------

						$data2['gambar'] = $acak . $nm;
						$data2['foto_kecil'] = $acak . $nm;
						$this->Webadmin_model->Simpan_Kepegawaian($data2);
						echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/kepegawaian'>";
					}
				}
			}
		}

	}
	function editpegawai()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}
		$datestring = "Login : %d-%m-%Y pukul %h:%i %a";
		$time = time();
		$data["tanggal"] = mdate($datestring, $time);
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['h2_title'] = 'Ubah Data Statis';
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$_SESSION['ses_kcfinder'] = array();
			$_SESSION['ses_kcfinder']['disabled'] = false;
			$_SESSION['ses_kcfinder']['uploadURL'] = "../content_upload";
			$data["edit"] = $this->Webadmin_model->Edit_Content("tbl_kepegawaian", "id_kepegawaian=$id");
			$data["kategori"] = $this->Webadmin_model->Semua_Jabatan();
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/kepegawaian/edit_kepegawaian', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function updatepegawai()
	{
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			if (empty($_FILES['userfile']['name'])) {
				$content = $this->input->post('content');
				$data2['nip'] = $this->input->post('nip');
				$data2['nama_pegawai'] = $this->input->post('nama');
				$data2['riwayat'] = preg_replace('#(href|src)="(.*?)/media#', '$1="' . base_url() . 'media', $content);
				$data2['kelahiran'] = $this->input->post('kelahiran');
				$data2['kode_jabatan'] = $this->input->post('kategori');
				$data2['jk'] = $this->input->post('editor');
				$data2['pangkat/gol'] = $this->input->post('golongan');
				$data2['pend_terakhir'] = $this->input->post('pendidikan');
				$data2['fb'] = $this->input->post('fb');
				$data2['ig'] = $this->input->post('ig');
				$data2['email'] = $this->input->post('email');
				$data2["id_kepegawaian"] = $this->input->post('id_berita');
				$this->Webadmin_model->Update_Content("tbl_kepegawaian", $data2, "id_kepegawaian");
				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/kepegawaian'>";
			} else {
				$acak = rand(00000000000, 99999999999);
				$bersih = $_FILES['userfile']['name'];
				$nm = str_replace(" ", "_", "$bersih");
				$pisah = explode(".", $nm);
				$nama_murni = $pisah[0];
				$ubah = $acak . $nama_murni; //tanpa ekstensi
				$config["file_name"] = $ubah; //dengan eekstensi
				$in["foto_besar"] = $acak . $nm;
				$config['upload_path'] = './asset/pegawai/';
				$config['allowed_types'] = 'gif|jpg|jpeg|png';
				$config['max_size'] = '500000';
				$config['max_width'] = '12000';
				$config['max_height'] = '12000';
				$this->load->library('upload', $config);

				if (!$this->upload->do_upload()) {
					echo $this->upload->display_errors();
				} else {

					//---------------------------------------------------------------------------------------------------
					$data2['gambar'] = $acak . $nm;
					$data2['foto_kecil'] = $acak . $nm;
					$content = $this->input->post('content');
					$data2['nip'] = $this->input->post('nip');
					$data2['nama_pegawai'] = $this->input->post('nama');
					$data2['riwayat'] = preg_replace('#(href|src)="(.*?)/media#', '$1="' . base_url() . 'media', $content);
					$data2['kelahiran'] = $this->input->post('kelahiran');
					$data2['kode_jabatan'] = $this->input->post('kategori');
					$data2['jk'] = $this->input->post('editor');
					$data2['pangkat/gol'] = $this->input->post('golongan');
					$data2['pend_terakhir'] = $this->input->post('pendidikan');
					$data2["id_kepegawaian"] = $this->input->post('id_berita');
					$data2['fb'] = $this->input->post('fb');
					$data2['ig'] = $this->input->post('ig');
					$data2['email'] = $this->input->post('email');
					$this->Webadmin_model->Update_Content("tbl_kepegawaian", $data2, "id_kepegawaian");
					echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/kepegawaian'>";

				}
			}
		}

	}

	function download()
	{
		$page = $this->uri->segment(3);
		$limit = 15;
		if (!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;
		$datestring = "Login : %d-%m-%Y pukul %h:%i %a";
		$time = time();
		$data["tanggal"] = mdate($datestring, $time);
		$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['h2_title'] = 'Master Download';
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$total = $this->Webadmin_model->Total_Data("tbl_download");
			$config['base_url'] = base_url() . '/webadmin/download/';
			$config['total_rows'] = $total->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
			//config for bootstrap pagination class integration
			$config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination">';
			$config['full_tag_close'] = '</ul></nav></div>';
			$config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['num_tag_close'] = '</span></li>';
			$config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
			$config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
			$config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
			$config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['prev_tagl_close'] = '</span></li>';
			$config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['first_tagl_close'] = '</span></li>';
			$config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['last_tagl_close'] = '</span></li>';

			$this->pagination->initialize($config);
			$data['paginator'] = $this->pagination->create_links();
			$data['daftarartikel'] = $this->Webadmin_model->Download($offset, $limit);
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/download/download', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function hapusdownload()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$this->Webadmin_model->Delete_Content($id, "kode_download", "tbl_download");
			$this->session->set_flashdata('message', 'Data Terhapus!');
			echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/download'>";
		}

	}
	function tambahdownload()
	{
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['h2_title'] = 'Tambah download';
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$data["kategori"] = $this->Webadmin_model->Semua_Menutype();
			$data["kategori2"] = $this->Webadmin_model->Semua_Skpd();
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/download/tambah_download', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function simpandownload()
	{
		$data = array();
		$data2 = array();
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$tgl = " %Y-%m-%d";
			$jam = "%h:%i:%a";
			$time = time();
			$content = $this->input->post('putusan');
			$data2["download"] = $this->input->post('judul');
			$data2["kode_menu"] = $this->input->post('kategori');
			$data2["ket"] = preg_replace('#(href|src)="(.*?)/media#', '$1="' . base_url() . 'media', $content);
			$data2["tanggal"] = mdate($tgl, $time);
			$data2["waktu"] = date('G:i:s');
			$data2["counter"] = "1";
			$data2['id_skpd'] = $this->input->post('kategori2');

			$this->form_validation->set_rules('judul', 'Judul Download', 'trim|required');
			$this->form_validation->set_rules('kategori', 'type Download', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data['h2_title'] = 'Tambah download';
				$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
				$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
				$data['instansi'] = $this->config->item('nama_instansi');
				$data['credit'] = $this->config->item('credit_aplikasi');
				$data['alamat'] = $this->config->item('alamat_instansi');
				$data["kategori"] = $this->Webadmin_model->Semua_Menutype();
				$data["kategori2"] = $this->Webadmin_model->Semua_Skpd();
				$this->load->view('webadmin/bg_atas', $data);
				$this->load->view('webadmin/download/tambah_download', $data);
				$this->load->view('webadmin/bg_bawah');
			} else {
				//Update Counter
				$idmku = $this->input->post('kategori2');
				$this->Webadmin_model->Update_Counter_Skpd($idmku);
				//End
				$acak = rand(00000000000, 99999999999);
				$bersih = $_FILES['userfile']['name'];
				$nm = str_replace(" ", "_", "$bersih");
				$pisah = explode(".", $nm);
				$nama_murni = $pisah[0];
				$ubah = $acak . $nama_murni;
				$config["file_name"] = $ubah;
				$in = $acak . $nm;
				$config['upload_path'] = './media/file/';
				$config['allowed_types'] = 'pdf|gif|jpg|jpeg|png';
				$config['max_size'] = '1000000000';
				$this->load->library('upload', $config);

				if (empty($_FILES['userfile']['name'])) {
					$data2["file"] = "welcome.jpg";
					$this->Webadmin_model->Simpan_Artikel2("tbl_download", $data2);
					$this->session->set_flashdata('message', 'Data Tersimpan!');
					echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/download'>";
				} else {
					if (!$this->upload->do_upload()) {
						echo $this->upload->display_errors();
					} else {
						$data2["file"] = $in;
						$data2["ukuran"] = "1";
						$this->Webadmin_model->Simpan_Artikel2("tbl_download", $data2);
						$this->session->set_flashdata('message', 'Data Tersimpan!');
						echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/download'>";
					}
				}
			}
		}

	}
	function editdownload()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);

		}
		$datestring = "Login : %d-%m-%Y pukul %h:%i %a";
		$time = time();
		$tgl = "%d-%m-%Y";
		$data["wkt_skr"] = mdate($tgl, $time);
		$data["tanggal"] = mdate($datestring, $time);
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['h2_title'] = 'Edit Download';
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$data["kategori"] = $this->Webadmin_model->Semua_Menutype();
			$data["kategori2"] = $this->Webadmin_model->Semua_Skpd();
			$data['edit'] = $this->Webadmin_model->Edit_Content("tbl_download", "kode_download=$id");
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/download/edit_download', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function updatedownload()
	{
		$data2 = array();
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$acak = rand(00000000000, 99999999999);
			$bersih = $_FILES['userfile']['name'];
			$nm = str_replace(" ", "_", "$bersih");
			$pisah = explode(".", $nm);
			$nama_murni = $pisah[0];
			$ubah = $acak . $nama_murni;
			$config["file_name"] = $ubah;
			$in = $acak . $nm;
			$config['upload_path'] = './media/file/';
			$config['allowed_types'] = 'pdf|gif|jpg|jpeg|png';
			$config['max_size'] = '1000000000';
			$this->load->library('upload', $config);
			if (empty($_FILES['userfile']['name'])) {
				$content = $this->input->post('putusan');
				$data2["download"] = $this->input->post('judul');
				$data2["kode_menu"] = $this->input->post('kategori');
				$data2['id_skpd'] = $this->input->post('kategori2');
				$data2["ket"] = preg_replace('#(href|src)="(.*?)/media#', '$1="' . base_url() . 'media', $content);
				$data2["kode_download"] = $this->input->post('id_berita');
				$this->Webadmin_model->Update_Content("tbl_download", $data2, "kode_download");
				$this->session->set_flashdata('message', 'Data Tersimpan!');
				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/download'>";
			} else {
				if (!$this->upload->do_upload()) {
					echo $this->upload->display_errors();
				} else {
					$content = $this->input->post('putusan');
					$data2["download"] = $this->input->post('judul');
					$data2["kode_menu"] = $this->input->post('kategori');
					$data2['id_skpd'] = $this->input->post('kategori2');
					$data2["ket"] = preg_replace('#(href|src)="(.*?)/media#', '$1="' . base_url() . 'media', $content);
					$data2["kode_download"] = $this->input->post('id_berita');
					$data2["file"] = $in;
					$this->Webadmin_model->Update_Content("tbl_download", $data2, "kode_download");
					$this->session->set_flashdata('message', 'Data Tersimpan!');
					echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/download'>";
				}
			}
		}

	}

	function polling()
	{
		$page = $this->uri->segment(3);
		$limit = 10;
		if (!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;
		$data = array();
		$cek = $this->session->userdata('logged_in');
		$data["page"] = $page;
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['h2_title'] = 'Polling';
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$tot_hal = $this->Webadmin_model->Total_Data("tbl_soalpolling");
			$config['base_url'] = base_url() . '/webadmin/polling/';
			$config['total_rows'] = $tot_hal->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
			//config for bootstrap pagination class integration
			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			$config['first_link'] = false;
			$config['last_link'] = false;
			$config['first_tag_open'] = '<li class="page-item">';
			$config['first_tag_close'] = '</li>';
			$config['prev_link'] = '&laquo';
			$config['prev_tag_open'] = '<li class="prev">';
			$config['prev_tag_close'] = '</li>';
			$config['next_link'] = '&raquo';
			$config['next_tag_open'] = '<li class="page-item">';
			$config['next_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li class="page-item">';
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';

			$this->pagination->initialize($config);
			$data["paginator"] = $this->pagination->create_links();
			$data["page"] = $page;
			$data["detail"] = $this->Webadmin_model->Daftar_Polling($offset, $limit);
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/polling/polling', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function tambahsoalpoll()
	{
		$data = array();
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['h2_title'] = 'Tambah Soal Polling';
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/polling/tambah_soal_poll', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function simpansoalpoll()
	{
		$page = $this->uri->segment(3);
		$limit = 10;
		if (!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;

		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {

			$data2['soal_poll'] = $this->input->post('soal');
			$data2['status'] = $this->input->post('status');
			$this->form_validation->set_rules('soal', 'Soal Polling', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
				$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
				$data['instansi'] = $this->config->item('nama_instansi');
				$data['credit'] = $this->config->item('credit_aplikasi');
				$data['alamat'] = $this->config->item('alamat_instansi');
				$this->load->view('webadmin/bg_atas', $data);
				$this->load->view('webadmin/polling/tambah_soal_poll', $data);
				$this->load->view('webadmin/bg_bawah');
			} else {
				$this->Webadmin_model->In_Polling("tbl_soalpolling", $data2);
				$this->session->set_flashdata('message', 'Data Tersimpan!');
				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/polling'>";
			}
		}

	}
	function editsoalpolling()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}
		$data = array();
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['h2_title'] = 'Ubah Soal Polling';
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');

			$tgl = "%d-%m-%Y";
			$time = time();
			$data["wkt_skr"] = mdate($tgl, $time);
			$data["detail"] = $this->Webadmin_model->Edit_Content("tbl_soalpolling", "id_soal_poll=" . $id . "");
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/polling/edit_soal_poll', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function updatesoalpoll()
	{
		$in = array();
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$in["id_soal_poll"] = $this->input->post('id');
			$in["soal_poll"] = $this->input->post('soal');
			$in["status"] = $this->input->post('status');
			$this->Webadmin_model->Update_Content("tbl_soalpolling", $in, "id_soal_poll");
			$this->session->set_flashdata('message', 'Data Tersimpan!');
			echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/polling'>";
		}

	}
	function hapussoalpolling()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}
		$data = array();
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$this->Webadmin_model->Delete_Content($id, "id_soal_poll", "tbl_soalpolling");
			$this->session->set_flashdata('message', 'Data Terhapus!');
			?>
			<script type="text/javascript">
				javascript: history.go(-1);
			</script>
			<?php
		}

	}
	function tambahjwbpoll()
	{
		$page = $this->uri->segment(3);
		$limit = 10;
		if (!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;
		$data = array();
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['h2_title'] = 'Tambah Jawaban Polling';
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$tot_hal = $this->Webadmin_model->Total_Data("tbl_jawabanpoll");
			$config['base_url'] = base_url() . '/webadmin/tambahjwbpoll/';
			$config['total_rows'] = $tot_hal->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
			//config for bootstrap pagination class integration
			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			$config['first_link'] = false;
			$config['last_link'] = false;
			$config['first_tag_open'] = '<li class="page-item">';
			$config['first_tag_close'] = '</li>';
			$config['prev_link'] = '&laquo';
			$config['prev_tag_open'] = '<li class="prev">';
			$config['prev_tag_close'] = '</li>';
			$config['next_link'] = '&raquo';
			$config['next_tag_open'] = '<li class="page-item">';
			$config['next_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li class="page-item">';
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';

			$this->pagination->initialize($config);
			$data["paginator"] = $this->pagination->create_links();
			$data["page"] = $page;
			$data["soal_poll"] = $this->Webadmin_model->Tampil_Data("tbl_soalpolling", "id_soal_poll");
			$data["jwb_poll"] = $this->Webadmin_model->Tampil_Data_Terbatas("tbl_jawabanpoll", "id_jawaban_poll", "left join tbl_soalpolling on 
			tbl_jawabanpoll.id_soal_poll=tbl_soalpolling.id_soal_poll", $offset, $limit);
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/polling/tambah_jwb_poll', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function simpanjwbpoll()
	{
		$data = array();
		$data2 = array();
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$tgl = " %Y-%m-%d";
			$time = time();
			$in["id_soal_poll"] = $this->input->post('pertanyaan');
			$in["jawaban"] = $this->input->post('jawaban');
			$in["counter"] = "1";
			if ($in["jawaban"] == "") {
				echo "Data masih kosong..!!!";
			} else {
				$this->Webadmin_model->Simpan_Data("tbl_jawabanpoll", $in);
				$this->session->set_flashdata('message', 'Data Tersimpan!');
				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/tambahjwbpoll'>";
			}
		}

	}
	function hapusjwbpoll()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}
		$data = array();
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$this->Webadmin_model->Delete_Content($id, "id_jawaban_poll", "tbl_jawabanpoll");
			$this->session->set_flashdata('message', 'Data Terhapus!');
			?>
			<script type="text/javascript">
				javascript: history.go(-1);
			</script>
			<?php
		}

	}
	function editjwbpoll()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}
		$data = array();
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['h2_title'] = 'Ubah Jawaban Polling';
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$data["soal_poll"] = $this->Webadmin_model->Tampil_Data("tbl_soalpolling", "id_soal_poll");
			$data["detail"] = $this->Webadmin_model->Edit_Content("tbl_jawabanpoll", "id_jawaban_poll=" . $id . "");
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/polling/edit_jwb_poll', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function updatejwbpoll()
	{
		$in = array();
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$in["id_jawaban_poll"] = $this->input->post('id');
			$in["id_soal_poll"] = $this->input->post('pertanyaan');
			$in["jawaban"] = $this->input->post('jawaban');
			$in["counter"] = $this->input->post('counter');
			$this->Webadmin_model->Update_Content("tbl_jawabanpoll", $in, "id_jawaban_poll");
			$this->session->set_flashdata('message', 'Data Tersimpan!');
			echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/tambahjwbpoll'>";
		}

	}

	function agenda()
	{
		$page = $this->uri->segment(3);
		$limit = 10;
		if (!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;
		$datestring = "Login : %d-%m-%Y pukul %h:%i %a";
		$time = time();
		$data["tanggal"] = mdate($datestring, $time);
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		$data["page"] = $page;
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['h2_title'] = 'Master Agenda';
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$total = $this->Webadmin_model->Total_Data("tbl_agenda");
			$config['base_url'] = base_url() . '/webadmin/agenda/';
			$config['total_rows'] = $total->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
			//config for bootstrap pagination class integration
			$config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination">';
			$config['full_tag_close'] = '</ul></nav></div>';
			$config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['num_tag_close'] = '</span></li>';
			$config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
			$config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
			$config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
			$config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['prev_tagl_close'] = '</span></li>';
			$config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['first_tagl_close'] = '</span></li>';
			$config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['last_tagl_close'] = '</span></li>';

			$this->pagination->initialize($config);
			$data['paginator'] = $this->pagination->create_links();
			$data['daftarartikel'] = $this->Webadmin_model->Agenda($offset, $limit);
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/agenda/agenda', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function hapusagenda()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}
		$data = array();
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$this->Webadmin_model->Delete_Content($id, "id_agenda", "tbl_agenda");
			echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/agenda'>";
		}

	}
	function tambahagenda()
	{

		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$tgl = "%d-%m-%Y";
			$time = time();
			$data["wkt_skr"] = mdate($tgl, $time);

			$_SESSION['ses_kcfinder'] = array();
			$_SESSION['ses_kcfinder']['disabled'] = false;
			$_SESSION['ses_kcfinder']['uploadURL'] = "../content_upload";

			$data['datax1'] = $this->db->query("SELECT
tbl_kepegawaian.nama_pegawai,
tbl_jabatan.jabatan,
tbl_kepegawaian.id_kepegawaian
FROM
tbl_kepegawaian LEFT JOIN
tbl_jabatan on tbl_jabatan.id_jabatan=tbl_kepegawaian.kode_jabatan

");

			$data['datax2'] = $this->db->query("SELECT
tbl_kepegawaian.nama_pegawai,
tbl_jabatan.jabatan,
tbl_kepegawaian.id_kepegawaian
FROM
tbl_kepegawaian LEFT JOIN
tbl_jabatan on tbl_jabatan.id_jabatan=tbl_kepegawaian.kode_jabatan

");

			$data['datax3'] = $this->db->query("SELECT
tbl_kepegawaian.nama_pegawai,
tbl_jabatan.jabatan,
tbl_kepegawaian.id_kepegawaian
FROM
tbl_kepegawaian LEFT JOIN
tbl_jabatan on tbl_jabatan.id_jabatan=tbl_kepegawaian.kode_jabatan


");

			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/agenda/tambah_agenda', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function simpanagenda()
	{
		$page = $this->uri->segment(3);
		$limit = 10;
		if (!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;

		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {

			$tgl = " %Y-%m-%d";
			$time = time();
			$in["tgl_posting"] = mdate($tgl, $time);
			$in["tema_agenda"] = $this->input->post('judul');
			$in["isi"] = strip_tags($this->input->post('isi'));
			$t_mulai = $this->input->post('tgl_mulai');
			$b_mulai = $this->input->post('bln_mulai');
			$y_mulai = $this->input->post('thn_mulai');
			$in["tgl_mulai"] = "" . $y_mulai . "-" . $b_mulai . "-" . $t_mulai . "";
			$t_selesai = $this->input->post('tgl_selesai');
			$b_selesai = $this->input->post('bln_selesai');
			$y_selesai = $this->input->post('thn_selesai');
			$in["tgl_selesai"] = "" . $y_selesai . "-" . $b_selesai . "-" . $t_selesai . "";
			//
			$in["tempat"] = $this->input->post('lokasi');

			$in["id1"] = $this->input->post('p1');
			$in["id2"] = $this->input->post('p2');
			$in["id3"] = $this->input->post('p3');
			$in["ket1"] = $this->input->post('ket1');
			$in["ket2"] = $this->input->post('ket2');
			$in["ket3"] = $this->input->post('ket3');
			//
			$in["jam"] = $this->input->post('jam');
			$in["keterangan"] = strip_tags($this->input->post('keterangan'));

			$title = $this->input->post('judul');
			$title = strtolower($title);
			$date = date("Y/m/d");
			$newtitle = string_limit_words($title, 15);
			$urltitle = preg_replace('/[^a-z0-9]/i', ' ', $newtitle);
			$newurltitle = str_replace(" ", "-", $newtitle);
			$karakter = array('{', '}', ')', '(', '|', '`', '~', '!', '@', '%', '$', '^', '&', '*', '=', '?', '+', '-', '/', '\\', ',', '.', '#', ':', ';', '\'', '"', '[', ']');
			$hapus_karakter_aneh = strtolower(str_replace($karakter, "", $title));
			$tambah_strip = strtolower(str_replace(' ', '-', $hapus_karakter_aneh));
			$link_akhir = $tambah_strip;

			$url = $link_akhir;
			$in["permalink"] = $url;

			$this->form_validation->set_rules('judul', 'Judul Agenda', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
				$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
				$data['instansi'] = $this->config->item('nama_instansi');
				$data['credit'] = $this->config->item('credit_aplikasi');
				$data['alamat'] = $this->config->item('alamat_instansi');
				$tgl = "%d-%m-%Y";
				$time = time();
				$data["wkt_skr"] = mdate($tgl, $time);
				$this->load->view('webadmin/bg_atas', $data);
				$this->load->view('webadmin/agenda/tambah_agenda', $data);
				$this->load->view('webadmin/bg_bawah');
			} else {
				$this->Webadmin_model->In_Polling("tbl_agenda", $in);
				$this->session->set_flashdata('message', 'Data Tersimpan!');
				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/agenda'>";
			}
		}

	}
	function editagenda()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}

		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$data["detail"] = $this->Webadmin_model->Edit_Content("tbl_agenda", "id_agenda=$id");
			$tgl = "%d-%m-%Y";
			$time = time();
			$data["wkt_skr"] = mdate($tgl, $time);
			$_SESSION['ses_kcfinder'] = array();
			$_SESSION['ses_kcfinder']['disabled'] = false;
			$_SESSION['ses_kcfinder']['uploadURL'] = "../content_upload";

			$data['datax1'] = $this->db->query("SELECT
tbl_kepegawaian.nama_pegawai,
tbl_jabatan.jabatan,
tbl_kepegawaian.id_kepegawaian
FROM
tbl_kepegawaian LEFT JOIN
tbl_jabatan on tbl_jabatan.id_jabatan=tbl_kepegawaian.kode_jabatan

");

			$data['datax2'] = $this->db->query("SELECT
tbl_kepegawaian.nama_pegawai,
tbl_jabatan.jabatan,
tbl_kepegawaian.id_kepegawaian
FROM
tbl_kepegawaian LEFT JOIN
tbl_jabatan on tbl_jabatan.id_jabatan=tbl_kepegawaian.kode_jabatan

");

			$data['datax3'] = $this->db->query("SELECT
tbl_kepegawaian.nama_pegawai,
tbl_jabatan.jabatan,
tbl_kepegawaian.id_kepegawaian
FROM
tbl_kepegawaian LEFT JOIN
tbl_jabatan on tbl_jabatan.id_jabatan=tbl_kepegawaian.kode_jabatan


");

			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/agenda/edit_agenda', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function updateagenda()
	{
		$in = array();
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$in["id_agenda"] = $this->input->post('id_agenda');
			$in["tema_agenda"] = $this->input->post('judul');
			$in["isi"] = strip_tags($this->input->post('isi'));
			$t_mulai = $this->input->post('tgl_mulai');
			$b_mulai = $this->input->post('bln_mulai');
			$y_mulai = $this->input->post('thn_mulai');
			$in["tgl_mulai"] = "" . $y_mulai . "-" . $b_mulai . "-" . $t_mulai . "";
			$t_selesai = $this->input->post('tgl_selesai');
			$b_selesai = $this->input->post('bln_selesai');
			$y_selesai = $this->input->post('thn_selesai');
			$in["tgl_selesai"] = "" . $y_selesai . "-" . $b_selesai . "-" . $t_selesai . "";
			//
			$in["tempat"] = $this->input->post('lokasi');

			$in["id1"] = $this->input->post('p1');
			$in["id2"] = $this->input->post('p2');
			$in["id3"] = $this->input->post('p3');
			$in["ket1"] = $this->input->post('ket1');
			$in["ket2"] = $this->input->post('ket2');
			$in["ket3"] = $this->input->post('ket3');
			//

			$title = $this->input->post('judul');
			$title = strtolower($title);
			$date = date("Y/m/d");
			$newtitle = string_limit_words($title, 15);
			$urltitle = preg_replace('/[^a-z0-9]/i', ' ', $newtitle);
			$newurltitle = str_replace(" ", "-", $newtitle);
			$karakter = array('{', '}', ')', '(', '|', '`', '~', '!', '@', '%', '$', '^', '&', '*', '=', '?', '+', '-', '/', '\\', ',', '.', '#', ':', ';', '\'', '"', '[', ']');
			$hapus_karakter_aneh = strtolower(str_replace($karakter, "", $title));
			$tambah_strip = strtolower(str_replace(' ', '-', $hapus_karakter_aneh));
			$link_akhir = $tambah_strip;

			$url = $link_akhir;
			$in["permalink"] = $url;
			$in["jam"] = $this->input->post('jam');
			$in["keterangan"] = strip_tags($this->input->post('keterangan'));
			$this->Webadmin_model->Update_Content("tbl_agenda", $in, "id_agenda");
			echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/agenda'>";
		}

	}

	function pengumuman()
	{
		$page = $this->uri->segment(3);
		$limit = 10;
		if (!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;
		$datestring = "Login : %d-%m-%Y pukul %h:%i %a";
		$time = time();
		$data["tanggal"] = mdate($datestring, $time);
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		$data["page"] = $page;
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['h2_title'] = 'Master Pengumuman';
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$total = $this->Webadmin_model->Total_Data("tbl_pengumuman");
			$config['base_url'] = base_url() . '/webadmin/pengumuman/';
			$config['total_rows'] = $total->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
			//config for bootstrap pagination class integration
			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			$config['first_link'] = false;
			$config['last_link'] = false;
			$config['first_tag_open'] = '<li class="page-item">';
			$config['first_tag_close'] = '</li>';
			$config['prev_link'] = '&laquo';
			$config['prev_tag_open'] = '<li class="prev">';
			$config['prev_tag_close'] = '</li>';
			$config['next_link'] = '&raquo';
			$config['next_tag_open'] = '<li class="page-item">';
			$config['next_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li class="page-item">';
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';

			$this->pagination->initialize($config);
			$data['paginator'] = $this->pagination->create_links();
			$data['daftarartikel'] = $this->Webadmin_model->Pengumuman($offset, $limit);
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/pengumuman/pengumuman', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function tambahpengumuman()
	{

		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$tgl = "%d-%m-%Y";
			$time = time();
			$data["wkt_skr"] = mdate($tgl, $time);
			$_SESSION['ses_kcfinder'] = array();
			$_SESSION['ses_kcfinder']['disabled'] = false;
			$_SESSION['ses_kcfinder']['uploadURL'] = "../content_upload";
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/pengumuman/tambah_pengumuman', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function simpanpengumuman()
	{
		$page = $this->uri->segment(3);
		$limit = 10;
		if (!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;

		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$tgl = " %Y-%m-%d";
			$time = time();
			$content = $this->input->post('content');
			$data2["judul_pengumuman"] = $this->input->post('judul');
			$data2["isi"] = preg_replace('#(href|src)="(.*?)/media#', '$1="' . base_url() . 'media', $content);
			$data2["tanggal"] = mdate($tgl, $time);
			$data2["penulis"] = $data["username"];

			$title = $this->input->post('judul');
			$title = strtolower($title);
			$date = date("Y/m/d");
			$newtitle = string_limit_words($title, 15);
			$urltitle = preg_replace('/[^a-z0-9]/i', ' ', $newtitle);
			$newurltitle = str_replace(" ", "-", $newtitle);
			$karakter = array('{', '}', ')', '(', '|', '`', '~', '!', '@', '%', '$', '^', '&', '*', '=', '?', '+', '-', '/', '\\', ',', '.', '#', ':', ';', '\'', '"', '[', ']');
			$hapus_karakter_aneh = strtolower(str_replace($karakter, "", $title));
			$tambah_strip = strtolower(str_replace(' ', '-', $hapus_karakter_aneh));
			$link_akhir = $tambah_strip;

			$url = $link_akhir;
			$data2["permalink"] = $url;

			$this->form_validation->set_rules('judul', 'Judul Pengumuman', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
				$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
				$data['instansi'] = $this->config->item('nama_instansi');
				$data['credit'] = $this->config->item('credit_aplikasi');
				$data['alamat'] = $this->config->item('alamat_instansi');
				$tgl = "%d-%m-%Y";
				$time = time();
				$data["wkt_skr"] = mdate($tgl, $time);
				$this->load->view('webadmin/bg_atas', $data);
				$this->load->view('webadmin/pengumuman/tambah_pengumuman', $data);
				$this->load->view('webadmin/bg_bawah');
			} else {
				$this->Webadmin_model->In_Polling("tbl_pengumuman", $data2);
				$this->session->set_flashdata('message', 'Data Tersimpan!');
				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/pengumuman'>";
			}
		}

	}
	function hapuspengumuman()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}
		$data = array();
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$this->Webadmin_model->Delete_Content($id, "id_pengumuman", "tbl_pengumuman");
			echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/pengumuman'>";
		}

	}
	function editpengumuman()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}

		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$data["detail"] = $this->Webadmin_model->Edit_Content("tbl_pengumuman", "id_pengumuman=$id");
			$tgl = "%d-%m-%Y";
			$time = time();
			$data["wkt_skr"] = mdate($tgl, $time);
			$_SESSION['ses_kcfinder'] = array();
			$_SESSION['ses_kcfinder']['disabled'] = false;
			$_SESSION['ses_kcfinder']['uploadURL'] = "../content_upload";
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/pengumuman/edit_pengumuman', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function updatepengumuman()
	{
		$data2 = array();
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$content = $this->input->post('content');
			$data2["judul_pengumuman"] = $this->input->post('judul');
			$data2["id_jpengumuman"] = $this->input->post('kategori');
			$data2["isi"] = preg_replace('#(href|src)="(.*?)/media#', '$1="' . base_url() . 'media', $content);
			$data2["id_pengumuman"] = $this->input->post('id_pengumuman');
			$title = $this->input->post('judul');
			$title = strtolower($title);
			$date = date("Y/m/d");
			$newtitle = string_limit_words($title, 15);
			$urltitle = preg_replace('/[^a-z0-9]/i', ' ', $newtitle);
			$newurltitle = str_replace(" ", "-", $newtitle);
			$karakter = array('{', '}', ')', '(', '|', '`', '~', '!', '@', '%', '$', '^', '&', '*', '=', '?', '+', '-', '/', '\\', ',', '.', '#', ':', ';', '\'', '"', '[', ']');
			$hapus_karakter_aneh = strtolower(str_replace($karakter, "", $title));
			$tambah_strip = strtolower(str_replace(' ', '-', $hapus_karakter_aneh));
			$link_akhir = $tambah_strip;

			$url = $link_akhir;
			$data2["permalink"] = $url;
			$this->Webadmin_model->Update_Content("tbl_pengumuman", $data2, "id_pengumuman");
			echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/pengumuman'>";
		}

	}


	function tambahpetugas()
	{
		$page = $this->uri->segment(4);
		$limit = 1000;
		if (!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;
		$data = array();
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['h2_title'] = 'Tambah Petugas';
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$tot_hal = $this->Webadmin_model->Total_Data("tbl_jabatan");
			$config['base_url'] = base_url() . '/webadmin/tambahpetugas/';
			$config['total_rows'] = $tot_hal->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 4;
			//config for bootstrap pagination class integration
			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			$config['first_link'] = false;
			$config['last_link'] = false;
			$config['first_tag_open'] = '<li class="page-item">';
			$config['first_tag_close'] = '</li>';
			$config['prev_link'] = '&laquo';
			$config['prev_tag_open'] = '<li class="prev">';
			$config['prev_tag_close'] = '</li>';
			$config['next_link'] = '&raquo';
			$config['next_tag_open'] = '<li class="page-item">';
			$config['next_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li class="page-item">';
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';

			$this->pagination->initialize($config);
			$data["paginator"] = $this->pagination->create_links();
			$data["page"] = $page;
			$data['daftarartikel'] = $this->Webadmin_model->Petugas($offset, $limit);
			$data['datax1'] = $this->db->query("SELECT
tbl_kepegawaian.nama_pegawai,
tbl_jabatan.jabatan,
tbl_kepegawaian.id_kepegawaian
FROM
tbl_kepegawaian LEFT JOIN
tbl_jabatan on tbl_jabatan.id_jabatan=tbl_kepegawaian.kode_jabatan
order by tbl_kepegawaian.nama_pegawai ASC
");

			$data['datax2'] = $this->db->query("SELECT
*
FROM
tbl_agenda order by tbl_agenda.id_agenda DESC

");
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/agenda/tambahpetugas', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function simpanpetugas()
	{
		$page = $this->uri->segment(3);
		$limit = 10;
		if (!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data2['ket'] = $this->input->post('nama');
			$data2['id_agenda'] = $this->input->post('agenda');
			$data2['id_kepegawaian'] = $this->input->post('pegawai');
			$this->form_validation->set_rules('nama', 'Petugas', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
				$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
				$data['instansi'] = $this->config->item('nama_instansi');
				$data['credit'] = $this->config->item('credit_aplikasi');
				$data['alamat'] = $this->config->item('alamat_instansi');
				$tot_hal = $this->Webadmin_model->Total_Data("tbl_jabatan");
				$config['base_url'] = base_url() . '/webadmin/tambahjabatan/';
				$config['total_rows'] = $tot_hal->num_rows();
				$config['per_page'] = $limit;
				$config['uri_segment'] = 3;
				//config for bootstrap pagination class integration
				$config['full_tag_open'] = '<ul class="pagination">';
				$config['full_tag_close'] = '</ul>';
				$config['first_link'] = false;
				$config['last_link'] = false;
				$config['first_tag_open'] = '<li class="page-item">';
				$config['first_tag_close'] = '</li>';
				$config['prev_link'] = '&laquo';
				$config['prev_tag_open'] = '<li class="prev">';
				$config['prev_tag_close'] = '</li>';
				$config['next_link'] = '&raquo';
				$config['next_tag_open'] = '<li class="page-item">';
				$config['next_tag_close'] = '</li>';
				$config['last_tag_open'] = '<li class="page-item">';
				$config['last_tag_close'] = '</li>';
				$config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
				$config['cur_tag_close'] = '</a></li>';
				$config['num_tag_open'] = '<li>';
				$config['num_tag_close'] = '</li>';

				$this->pagination->initialize($config);
				$data["paginator"] = $this->pagination->create_links();
				$data["page"] = $page;
				$data['daftarartikel'] = $this->Webadmin_model->Petugas($offset, $limit);
				$data['datax1'] = $this->db->query("SELECT
tbl_kepegawaian.nama_pegawai,
tbl_jabatan.jabatan,
tbl_kepegawaian.id_kepegawaian
FROM
tbl_kepegawaian LEFT JOIN
tbl_jabatan on tbl_jabatan.id_jabatan=tbl_kepegawaian.kode_jabatan
order by tbl_kepegawaian.nama_pegawai ASC
");
				$data['datax2'] = $this->db->query("SELECT
*
FROM
tbl_agenda order by tbl_agenda.id_agenda DESC

");

				$this->load->view('webadmin/bg_atas', $data);
				$this->load->view('webadmin/agenda/tambahpetugas', $data);
				$this->load->view('webadmin/bg_bawah');
			} else {
				$this->Webadmin_model->In_Polling("tbl_petugas", $data2);
				$this->session->set_flashdata('message', 'Data Tersimpan!');
				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/tambahpetugas'>";
			}
		}

	}
	function hapuspetugas()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$this->Webadmin_model->Delete_Content($id, "id_petugas", "tbl_petugas");
			$this->session->set_flashdata('message', 'Data Terhapus!');
			echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/tambahpetugas'>";
		}

	}

	function editpetugas()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}

		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$_SESSION['ses_kcfinder'] = array();
			$_SESSION['ses_kcfinder']['disabled'] = false;
			$_SESSION['ses_kcfinder']['uploadURL'] = "../content_upload";
			$data["edit"] = $this->Webadmin_model->Edit_Content("tbl_petugas", "id_petugas=$id");
			$data['datax1'] = $this->db->query("SELECT
tbl_kepegawaian.nama_pegawai,
tbl_jabatan.jabatan,
tbl_kepegawaian.id_kepegawaian
FROM
tbl_kepegawaian LEFT JOIN
tbl_jabatan on tbl_jabatan.id_jabatan=tbl_kepegawaian.kode_jabatan
order by tbl_kepegawaian.nama_pegawai ASC
");
			$data['datax2'] = $this->db->query("SELECT
*
FROM
tbl_agenda order by tbl_agenda.id_agenda DESC

");
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/agenda/edit_petugas', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function updatepetugas()
	{
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$tgl = " %Y-%m-%d";
			$jam = "%h:%i:%a";
			$time = time();
			$data2["id_petugas"] = $this->input->post('id');
			$data2['ket'] = $this->input->post('nama');
			$data2['id_agenda'] = $this->input->post('agenda');
			$data2['id_kepegawaian'] = $this->input->post('pegawai');
			$this->Webadmin_model->Update_Content("tbl_petugas", $data2, "id_petugas");
			$this->session->set_flashdata('message', 'Data Tersimpan!');
			echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/tambahpetugas'>";
		}

	}

	function paper()
	{
		$page = $this->uri->segment(3);
		$limit = 10;
		if (!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;

		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		$data["page"] = $page;
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$data['message'] = "Data Pengguna";
			$total = $this->Webadmin_model->Total_Data("tbl_paper");
			$config['base_url'] = base_url() . '/webadmin/paper/';
			$config['total_rows'] = $total->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
			//config for bootstrap pagination class integration
			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			$config['first_link'] = false;
			$config['last_link'] = false;
			$config['first_tag_open'] = '<li class="page-item">';
			$config['first_tag_close'] = '</li>';
			$config['prev_link'] = '&laquo';
			$config['prev_tag_open'] = '<li class="prev">';
			$config['prev_tag_close'] = '</li>';
			$config['next_link'] = '&raquo';
			$config['next_tag_open'] = '<li class="page-item">';
			$config['next_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li class="page-item">';
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';

			$this->pagination->initialize($config);
			$data['paginator'] = $this->pagination->create_links();
			$data['daftarartikel'] = $this->Webadmin_model->Paper($offset, $limit);
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/paper/paper', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function tambahpaper()
	{

		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$_SESSION['ses_kcfinder'] = array();
			$_SESSION['ses_kcfinder']['disabled'] = false;
			$_SESSION['ses_kcfinder']['uploadURL'] = "../content_upload";
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/paper/tambah_paper', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function simpanpaper()
	{
		$page = $this->uri->segment(3);
		$limit = 10;
		if (!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;

		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data2['judul_paper'] = $this->input->post('nama');
			$data2['url'] = $this->input->post('username');
			$this->form_validation->set_rules('nama', 'Judul paper', 'trim|required');
			$this->form_validation->set_rules('username', 'Url paper', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
				$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
				$data['instansi'] = $this->config->item('nama_instansi');
				$data['credit'] = $this->config->item('credit_aplikasi');
				$data['alamat'] = $this->config->item('alamat_instansi');
				$this->load->view('webadmin/bg_atas', $data);
				$this->load->view('webadmin/paper/tambah_paper', $data);
				$this->load->view('webadmin/bg_bawah');
			} else {
				//SIMPAN COver

				$acak = rand(00000000000, 99999999999);
				$bersih = $_FILES['userfile']['name'];
				$nm = str_replace(" ", "_", "$bersih");
				$pisah = explode(".", $nm);
				$nama_murni = $pisah[0];
				$ubah = $acak . $nama_murni; //tanpa ekstensi
				$config["file_name"] = $ubah; //dengan eekstensi
				$data2["gambar"] = $acak . $nm;
				$config['upload_path'] = './asset/banner/';
				$config['allowed_types'] = 'gif|jpg|jpeg|png';
				$config['max_size'] = '500000';
				$config['max_width'] = '12000';
				$config['max_height'] = '12000';
				$this->load->library('upload', $config);
				//END

				if (!$this->upload->do_upload()) {
					echo $this->upload->display_errors();
				} else {
					$this->Webadmin_model->In_Polling("tbl_paper", $data2);
					$this->session->set_flashdata('message', 'Data Tersimpan!');
					echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/paper'>";
				}
			}
		}

	}
	function hapuspaper()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$this->Webadmin_model->Delete_Content($id, "id_paper", "tbl_paper");
			$this->session->set_flashdata('message', 'Data Terhapus!');
			echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/paper'>";
		}

	}
	function editpaper()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}

		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$_SESSION['ses_kcfinder'] = array();
			$_SESSION['ses_kcfinder']['disabled'] = false;
			$_SESSION['ses_kcfinder']['uploadURL'] = "../content_upload";
			$data["edit"] = $this->Webadmin_model->Edit_Content("tbl_paper", "id_paper=$id");
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/paper/edit_paper', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function tambahpaperpdf()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}

		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$_SESSION['ses_kcfinder'] = array();
			$_SESSION['ses_kcfinder']['disabled'] = false;
			$_SESSION['ses_kcfinder']['uploadURL'] = "../content_upload";
			$data["edit"] = $this->Webadmin_model->Edit_Content("tbl_paper", "id_paper=$id");
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/paper/edit_pdf', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	public function uploadpdfbaru()
	{
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			if (!empty($_FILES)) {
				$kode = $this->input->post('id_param');
				$tempFile = $_FILES['file']['tmp_name'];
				$fileName = $_FILES['file']['name'];
				$targetPath = getcwd() . '/asset/banner/';
				$targetFile = $targetPath . $fileName;
				$pecah = explode(".", $fileName);
				$ekstensi = $pecah[1];
				$extensionList = array("jpg", "gif", "png", "pdf");
				if (in_array($ekstensi, $extensionList)) {
					move_uploaded_file($tempFile, $targetFile);
				}
				$data2['kop_bawah'] = $fileName;
				$data2['id_paper'] = $kode;
				$this->Webadmin_model->Update_Content("tbl_paper", $data2, "id_paper");
			}
		}
	}
	function updatepaper()
	{
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$tgl = " %Y-%m-%d";
			$jam = "%h:%i:%a";
			$time = time();
			//for gambar

			$acak = rand(00000000000, 99999999999);
			$bersih = $_FILES['userfile']['name'];
			$nm = str_replace(" ", "_", "$bersih");
			$pisah = explode(".", $nm);
			$nama_murni = $pisah[0];
			$ubah = $acak . $nama_murni; //tanpa ekstensi
			$config["file_name"] = $ubah; //dengan eekstensi	
			$config['upload_path'] = './asset/banner/';
			$config['allowed_types'] = 'bmp|gif|jpg|jpeg|png';
			$config['max_size'] = '10000';
			$config['max_width'] = '10000';
			$config['max_height'] = '10000';
			$this->load->library('upload', $config);
			if (empty($_FILES['userfile']['name'])) {
				//end gambar
				$data2["id_paper"] = $this->input->post('id');
				$data2['judul_paper'] = $this->input->post('nama');
				$data2['url'] = $this->input->post('username');
				$this->Webadmin_model->Update_Content("tbl_paper", $data2, "id_paper");
				$this->session->set_flashdata('message', 'Data Tersimpan!');
				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/paper'>";
			} else {
				if (!$this->upload->do_upload()) {
					echo $this->upload->display_errors();
				} else {
					$data2["gambar"] = $acak . $nm;
					$data2["id_paper"] = $this->input->post('id');
					$data2['judul_paper'] = $this->input->post('nama');
					$data2['url'] = $this->input->post('username');
					$this->Webadmin_model->Update_Content("tbl_paper", $data2, "id_paper");
					$this->session->set_flashdata('message', 'Data Tersimpan!');
					echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/paper'>";
				}
			}
		}

	}




	function berita()
	{
		$page = $this->uri->segment(3);
		$limit = 10;
		if (!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;
		$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['h2_title'] = 'Berita';
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$total = $this->Webadmin_model->Total_Data("tblberita");
			$config['base_url'] = base_url() . '/webadmin/berita/';
			$config['total_rows'] = $total->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
			//config for bootstrap pagination class integration
			$config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination">';
			$config['full_tag_close'] = '</ul></nav></div>';
			$config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['num_tag_close'] = '</span></li>';
			$config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
			$config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
			$config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
			$config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['prev_tagl_close'] = '</span></li>';
			$config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['first_tagl_close'] = '</span></li>';
			$config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['last_tagl_close'] = '</span></li>';

			$this->pagination->initialize($config);
			$data['paginator'] = $this->pagination->create_links();
			$data['daftarartikel'] = $this->Webadmin_model->Artikel($offset, $limit);
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/berita/berita', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function pencarian()
	{
		$nama_non = $this->input->post('q');
		$idx = strip_tags($nama_non);
		$page = $this->uri->segment(3);
		$limit = 100;
		if (!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;
		$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['h2_title'] = 'Berita';
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$total = $this->Webadmin_model->Total_Data_Cari("tblberita", $idx);
			$config['base_url'] = base_url() . '/webadmin/pencarian/';
			$config['total_rows'] = $total->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
			//config for bootstrap pagination class integration
			$config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination">';
			$config['full_tag_close'] = '</ul></nav></div>';
			$config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['num_tag_close'] = '</span></li>';
			$config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
			$config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
			$config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
			$config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['prev_tagl_close'] = '</span></li>';
			$config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['first_tagl_close'] = '</span></li>';
			$config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['last_tagl_close'] = '</span></li>';

			$this->pagination->initialize($config);
			$data['paginator'] = $this->pagination->create_links();
			$data['daftarartikel'] = $this->Webadmin_model->Artikel_Cari($offset, $limit, $idx);
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/berita/berita', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}

	function tambahberita()
	{
		$page = $this->uri->segment(3);
		$limit = 10;
		if (!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;
		$datestring = "Login : %d-%m-%Y pukul %h:%i %a";
		$time = time();
		$tgl = "%d-%m-%Y";
		$data["wkt_skr"] = mdate($tgl, $time);
		$data["tanggal"] = mdate($datestring, $time);
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['h2_title'] = 'Tambah Berita';
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$_SESSION['ses_kcfinder'] = array();
			$_SESSION['ses_kcfinder']['disabled'] = false;
			$_SESSION['ses_kcfinder']['uploadURL'] = "../content_upload";
			$data["kategori"] = $this->Webadmin_model->Semua_Menu8();
			$data["tag"] = $this->Webadmin_model->Semua_Tag();
			$data['unik'] = $this->Webadmin_model->get_kode_mahasiswa();

			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/berita/tambah_berita', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function hapusberita()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$this->Webadmin_model->Delete_Content($id, "id_berita", "tblberita");
			$this->session->set_flashdata('message', 'Data Terhapus!');
			echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/berita'>";
		}

	}
	function simpanberita()
	{
		$page = $this->uri->segment(3);
		$limit = 10;
		if (!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;

		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$timezone = "Asia/Jakarta";
			if (function_exists('date_default_timezone_set'))
				date_default_timezone_set($timezone);
			$tgl = " %Y-%m-%d";
			$jam = "%h:%i:%a";
			$time = time();
			$title = $this->input->post('judul');
			$title = strtolower($title);
			$date = date("Y/m/d");
			$newtitle = string_limit_words($title, 15);
			$urltitle = preg_replace('/[^a-z0-9]/i', ' ', $newtitle);
			$newurltitle = str_replace(" ", "-", $newtitle);
			$url = $newurltitle;
			$content = $this->input->post('content');
			$data2['lite'] = $this->input->post('lite');
			$data2['anak'] = $this->input->post('anakjudul');
			$data2['id_kategori'] = $this->input->post('kategori');
			//
			$data2['editor'] = $this->input->post('edi');
			$data2['reporter'] = $this->input->post('rep');
			$data2['video'] = $this->input->post('fot');
			//
			$data2['status'] = $this->input->post('headline');
			$data2['judul_berita'] = $this->input->post('judul');
			$data2['id_berita'] = $this->input->post('id_berita');
			//$data2['isi'] = preg_replace('#(href|src)="(.*?)/media#', '$1="'.base_url().'media', $content);
			$text = str_ireplace('/editor/', 'https://humas.bengkaliskab.go.id/editor/', $content);
			$data2['isi'] = $text;
			$data2['ket_foto'] = $this->input->post('ket_foto');
			$data2["tanggal"] = $date;
			$data2["waktu"] = date('G:i:s');
			$data2["url"] = $url;

			//validation
			$this->form_validation->set_rules('judul', 'Judul', 'trim|required');
			$this->form_validation->set_rules('kategori', 'Kategori', 'trim|required');

			if ($this->input->post('tag') != "") {
				foreach ($this->input->post('tag') as $idx) {
					$iu = $this->input->post('id_berita');
					$sql1 = "INSERT INTO tbl_tagdetail(id_berita,id_tag)values('$iu','$idx')";
					$result1 = $this->db->query($sql1);

				}
			}

			//end validation
			if ($this->form_validation->run() == FALSE) {
				$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
				$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
				$data['instansi'] = $this->config->item('nama_instansi');
				$data['credit'] = $this->config->item('credit_aplikasi');
				$data['alamat'] = $this->config->item('alamat_instansi');
				$data["kategori"] = $this->Webadmin_model->Semua_Menu8();
				$data["tag"] = $this->Webadmin_model->Semua_Tag();
				$data['unik'] = $this->Webadmin_model->get_kode_mahasiswa();
				$this->load->view('webadmin/bg_atas', $data);
				$this->load->view('webadmin/berita/tambah_berita', $data);
				$this->load->view('webadmin/bg_bawah');
			} else {
				if (empty($_FILES['userfile']['name'])) {
					$data2["gambar"] = "welcome.jpg";
					$data2["foto_kecil"] = "welcome.jpg";
					$data2['url_gambar'] = $this->input->post('url_gambar');
					$this->Webadmin_model->Simpan_Artikel($data2);
					$this->session->set_flashdata('message', 'Data Tersimpan!');
					echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/berita'>";
				} else {
					//for gambar
					$acak = rand(00000000000, 99999999999);
					$bersih = $_FILES['userfile']['name'];
					$nm = str_replace(" ", "_", "$bersih");
					$pisah = explode(".", $nm);
					$nama_murni_lama = preg_replace("/^(.+?);.*$/", "\\1", $pisah[0]);
					$nama_murni = strtolower($nama_murni_lama);
					$ekstensi_kotor = $pisah[1];
					$file_type = preg_replace("/^(.+?);.*$/", "\\1", $ekstensi_kotor);
					$file_type_baru = strtolower($file_type);
					$ubah = $acak . '-' . $nama_murni; //tanpa ekstensi
					$n_baru = $ubah . '.' . $file_type_baru;

					$url = './asset/berita/';    //path image 
					if ($_FILES['userfile']['error'] == 4)  //if No file was uploaded. 
						return false;
					$config['upload_path'] = $url . "original/";
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['max_size'] = 10240;
					$config['max_width'] = 2024;
					$config['max_height'] = 2024;
					$config["file_name"] = $ubah; //dengan eekstensi
					$this->load->library('upload');
					$this->upload->initialize($config);

					if ($this->upload->do_upload('userfile')) {
						$this->load->library('image_lib');
						$files = $this->upload->data();
						$fileNameResize = $config['upload_path'] . $files['file_name'];
						$size = array(
							array('name' => 'thumb', 'width' => 120, 'height' => 75, 'quality' => '50%'),
							array('name' => 'large', 'width' => 315, 'height' => 211, 'quality' => '50%')
						);
						$resize = array();
						foreach ($size as $r) {
							$resize = array(
								"width" => $r['width'],
								"height" => $r['height'],
								"quality" => $r['quality'],
								"source_image" => $fileNameResize,
								"new_image" => $url . $r['name'] . '/' . $files['file_name']
							);
							$this->image_lib->initialize($resize);
							if (!$this->image_lib->resize())
								die($this->image_lib->display_errors());
						}
						//echo "resize oke";
					} else {
						echo $this->upload->display_errors();
					}
					$data2['gambar'] = $n_baru;
					$data2['foto_kecil'] = 'kecil-' . $n_baru;
					$this->Webadmin_model->Simpan_Artikel($data2);
					$this->session->set_flashdata('message', 'Data Tersimpan!');
					echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/berita'>";

				}
			}
		}

	}
	function editartikel()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);

		}
		$datestring = "Login : %d-%m-%Y pukul %h:%i %a";
		$time = time();
		$tgl = "%d-%m-%Y";
		$data["wkt_skr"] = mdate($tgl, $time);
		$data["tanggal"] = mdate($datestring, $time);
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['h2_title'] = 'Ubah Berita';
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$_SESSION['ses_kcfinder'] = array();
			$_SESSION['ses_kcfinder']['disabled'] = false;
			$_SESSION['ses_kcfinder']['uploadURL'] = "../content_upload";
			$data["kategori"] = $this->Webadmin_model->Semua_Menu8();
			$data['edit'] = $this->Webadmin_model->Edit_Content("tblberita", "id_berita=$id");
			$data["tag"] = $this->Webadmin_model->Semua_Tag();
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/berita/edit_berita', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function updateberita()
	{
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			if (empty($_FILES['userfile']['name'])) {
				$timezone = "Asia/Jakarta";
				if (function_exists('date_default_timezone_set'))
					date_default_timezone_set($timezone);
				$tgl = " %Y-%m-%d";
				$jam = "%h:%i:%a";
				$time = time();
				$title = $this->input->post('judul');
				$title = strtolower($title);
				$date = date("Y/m/d");
				$newtitle = string_limit_words($title, 15);
				$urltitle = preg_replace('/[^a-z0-9]/i', ' ', $newtitle);
				$newurltitle = str_replace(" ", "-", $newtitle);
				$url = $newurltitle;
				$content = $this->input->post('content');
				$text = str_ireplace('/editor/', 'https://humas.bengkaliskab.go.id/editor/', $content);
				$data2['isi'] = $text;
				$data2['id_kategori'] = $this->input->post('kategori');
				$data2['judul_berita'] = $this->input->post('judul');
				$data2['url_gambar'] = $this->input->post('url_gambar');


				$data2['ket_foto'] = $this->input->post('ket_foto');
				$data2['lite'] = $this->input->post('lite');
				$data2['anak'] = $this->input->post('anakjudul');
				$data2["waktu"] = date('G:i:s');
				$data2['status'] = $this->input->post('headline');
				//
				$data2['editor'] = $this->input->post('edi');
				$data2['reporter'] = $this->input->post('rep');
				$data2['video'] = $this->input->post('fot');
				//
				$data2["url"] = $url;
				$data2["id_berita"] = $this->input->post('id_berita');

				if ($this->input->post('tag') != "") {
					$iu2 = $this->input->post("id_berita");
					$sql2 = "DELETE FROM tbl_tagdetail where id_berita='$iu2'";
					$tindak = $this->db->query($sql2);
					if ($tindak) {
						foreach ($this->input->post('tag') as $idx) {
							$iu = $this->input->post("id_berita");
							$sql1 = "INSERT INTO tbl_tagdetail(id_berita,id_tag)values('$iu','$idx')";
							$result1 = $this->db->query($sql1);

						}
					}
				}

				$this->Webadmin_model->Update_Content("tblberita", $data2, "id_berita");
				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/berita'>";
			} else {
				//for gambar
				$acak = rand(00000000000, 99999999999);
				$bersih = $_FILES['userfile']['name'];
				$nm = str_replace(" ", "_", "$bersih");
				$pisah = explode(".", $nm);
				$nama_murni_lama = preg_replace("/^(.+?);.*$/", "\\1", $pisah[0]);
				$nama_murni = strtolower($nama_murni_lama);
				$ekstensi_kotor = $pisah[1];
				$file_type = preg_replace("/^(.+?);.*$/", "\\1", $ekstensi_kotor);
				$file_type_baru = strtolower($file_type);
				$ubah = $acak . '-' . $nama_murni; //tanpa ekstensi
				$n_baru = $ubah . '.' . $file_type_baru;

				$url = './asset/berita/';    //path image 
				if ($_FILES['userfile']['error'] == 4)  //if No file was uploaded. 
					return false;
				$config['upload_path'] = $url . "original/";
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = 10240;
				$config['max_width'] = 2024;
				$config['max_height'] = 2024;
				$config["file_name"] = $ubah; //dengan eekstensi
				$this->load->library('upload');
				$this->upload->initialize($config);

				if ($this->upload->do_upload('userfile')) {
					$this->load->library('image_lib');
					$files = $this->upload->data();
					$fileNameResize = $config['upload_path'] . $files['file_name'];
					$size = array(
						array('name' => 'thumb', 'width' => 120, 'height' => 75, 'quality' => '50%'),
						array('name' => 'large', 'width' => 315, 'height' => 211, 'quality' => '50%')
					);
					$resize = array();
					foreach ($size as $r) {
						$resize = array(
							"width" => $r['width'],
							"height" => $r['height'],
							"quality" => $r['quality'],
							"source_image" => $fileNameResize,
							"new_image" => $url . $r['name'] . '/' . $files['file_name']
						);
						$this->image_lib->initialize($resize);
						if (!$this->image_lib->resize())
							die($this->image_lib->display_errors());
					}
					//echo "resize oke";
				} else {
					echo $this->upload->display_errors();
				}

				//---------------------------------------------------------------------------------------------------

				$data2['gambar'] = $n_baru;
				$data2['foto_kecil'] = 'kecil-' . $n_baru;
				$tgl = " %Y-%m-%d";
				$jam = "%h:%i:%a";
				$time = time();
				$title = $this->input->post('judul');
				$title = strtolower($title);
				$date = date("Y/m/d");
				$newtitle = string_limit_words($title, 15);
				$urltitle = preg_replace('/[^a-z0-9]/i', ' ', $newtitle);
				$newurltitle = str_replace(" ", "-", $newtitle);
				$url = $date . '/' . $newurltitle . '';
				$content = $this->input->post('content');
				$data2['id_kategori'] = $this->input->post('kategori');
				$data2['judul_berita'] = $this->input->post('judul');
				$data2['status'] = $this->input->post('headline');
				$data2['lite'] = $this->input->post('lite');
				$text = str_ireplace('/editor/', 'https://humas.bengkaliskab.go.id/editor/', $content);
				$data2['isi'] = $text;
				$data2['ket_foto'] = $this->input->post('ket_foto');
				$data2["waktu"] = date('G:i:s');
				$data2['anak'] = $this->input->post('anakjudul');
				$data2["url"] = $url;
				$data2["id_berita"] = $this->input->post('id_berita');
				$data2['url_gambar'] = $this->input->post('url_gambar');
				$this->session->set_flashdata('message', 'Data Tersimpan!');

				if ($this->input->post('tag') != "") {
					$iu2 = $this->input->post("id_berita");
					$sql2 = "DELETE FROM tbl_tagdetail where id_berita='$iu2'";
					$tindak = $this->db->query($sql2);
					if ($tindak) {
						foreach ($this->input->post('tag') as $idx) {
							$iu = $this->input->post("id_berita");
							$sql1 = "INSERT INTO tbl_tagdetail(id_berita,id_tag)values('$iu','$idx')";
							$result1 = $this->db->query($sql1);

						}
					}
				}

				$this->Webadmin_model->Update_Content("tblberita", $data2, "id_berita");
				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/berita'>";
			}
		}

	}

	function beritafoto()
	{
		$page = $this->uri->segment(3);
		$limit = 10;
		if (!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;

		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		$data["page"] = $page;
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$data['message'] = "Data Berita Foto";
			$total = $this->Webadmin_model->Total_Data("tbl_beritafoto");
			$config['base_url'] = base_url() . '/webadmin/beritafoto/';
			$config['total_rows'] = $total->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
			//config for bootstrap pagination class integration
			$config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination">';
			$config['full_tag_close'] = '</ul></nav></div>';
			$config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['num_tag_close'] = '</span></li>';
			$config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
			$config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
			$config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
			$config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['prev_tagl_close'] = '</span></li>';
			$config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['first_tagl_close'] = '</span></li>';
			$config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['last_tagl_close'] = '</span></li>';

			$this->pagination->initialize($config);
			$data['paginator'] = $this->pagination->create_links();
			$data['daftarartikel'] = $this->Webadmin_model->Beritafoto($offset, $limit);
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/beritafoto/beritafoto', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function tambahberitafoto()
	{

		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$_SESSION['ses_kcfinder'] = array();
			$_SESSION['ses_kcfinder']['disabled'] = false;
			$_SESSION['ses_kcfinder']['uploadURL'] = "../content_upload";
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/beritafoto/tambah_beritafoto', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function simpanberitafoto()
	{
		$page = $this->uri->segment(3);
		$limit = 10;
		if (!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;

		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data2['judul_beritafoto'] = $this->input->post('nama');
			$data2['isi'] = $this->input->post('username');
			$data2['penulis'] = $this->input->post('fot');
			$tgl = " %Y-%m-%d";
			$jam = "%h:%i:%a";
			$time = time();
			$data2["tanggal"] = mdate($tgl, $time);
			$data2["waktu"] = date('G:i:s');

			$title = $this->input->post('nama');
			$title = strtolower($title);
			$date = date("Y/m/d");
			$newtitle = string_limit_words($title, 15);
			$urltitle = preg_replace('/[^a-z0-9]/i', ' ', $newtitle);
			$newurltitle = str_replace(" ", "-", $newtitle);
			$karakter = array('{', '}', ')', '(', '|', '`', '~', '!', '@', '%', '$', '^', '&', '*', '=', '?', '+', '-', '/', '\\', ',', '.', '#', ':', ';', '\'', '"', '[', ']');
			$hapus_karakter_aneh = strtolower(str_replace($karakter, "", $title));
			$tambah_strip = strtolower(str_replace(' ', '-', $hapus_karakter_aneh));
			$link_akhir = $tambah_strip;

			$url = $link_akhir;
			$data2["permalink"] = $url;

			$this->form_validation->set_rules('nama', 'Judul beritafoto', 'trim|required');
			$this->form_validation->set_rules('username', 'Url beritafoto', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
				$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
				$data['instansi'] = $this->config->item('nama_instansi');
				$data['credit'] = $this->config->item('credit_aplikasi');
				$data['alamat'] = $this->config->item('alamat_instansi');
				$this->load->view('webadmin/bg_atas', $data);
				$this->load->view('webadmin/beritafoto/tambah_beritafoto', $data);
				$this->load->view('webadmin/bg_bawah');
			} else {
				$acak = rand(00000000000, 99999999999);
				$bersih = $_FILES['userfile']['name'];
				$nm = str_replace(" ", "_", "$bersih");
				$pisah = explode(".", $nm);
				$nama_murni = $pisah[0];
				$ubah = $acak . $nama_murni; //tanpa ekstensi
				$config["file_name"] = $ubah; //dengan eekstensi
				$data2["gambar"] = $acak . $nm;
				$config['upload_path'] = './asset/banner/';
				$config['allowed_types'] = 'gif|jpg|jpeg|png';
				$config['max_size'] = '500000';
				$config['max_width'] = '12000';
				$config['max_height'] = '12000';
				$this->load->library('upload', $config);

				if (!$this->upload->do_upload()) {
					echo $this->upload->display_errors();
				} else {
					$this->Webadmin_model->In_Polling("tbl_beritafoto", $data2);
					$this->session->set_flashdata('message', 'Data Tersimpan!');
					echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/beritafoto'>";
				}
			}
		}

	}
	function hapusberitafoto()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$this->Webadmin_model->Delete_Content($id, "id_beritafoto", "tbl_beritafoto");
			$this->session->set_flashdata('message', 'Data Terhapus!');
			echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/beritafoto'>";
		}

	}
	function editberitafoto()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}

		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$_SESSION['ses_kcfinder'] = array();
			$_SESSION['ses_kcfinder']['disabled'] = false;
			$_SESSION['ses_kcfinder']['uploadURL'] = "../content_upload";
			$data["edit"] = $this->Webadmin_model->Edit_Content("tbl_beritafoto", "id_beritafoto=$id");
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/beritafoto/edit_beritafoto', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function updateberitafoto()
	{
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$tgl = " %Y-%m-%d";
			$jam = "%h:%i:%a";
			$time = time();
			//for gambar
			$acak = rand(00000000000, 99999999999);
			$bersih = $_FILES['userfile']['name'];
			$nm = str_replace(" ", "_", "$bersih");
			$pisah = explode(".", $nm);
			$nama_murni = $pisah[0];
			$ubah = $acak . $nama_murni; //tanpa ekstensi
			$config["file_name"] = $ubah; //dengan eekstensi	
			$config['upload_path'] = './asset/banner/';
			$config['allowed_types'] = 'bmp|gif|jpg|jpeg|png';
			$config['max_size'] = '10000';
			$config['max_width'] = '10000';
			$config['max_height'] = '10000';
			$this->load->library('upload', $config);
			if (empty($_FILES['userfile']['name'])) {
				//end gambar
				$data2["id_beritafoto"] = $this->input->post('id');
				$data2['judul_beritafoto'] = $this->input->post('nama');
				$data2['isi'] = $this->input->post('username');
				$data2['penulis'] = $this->input->post('fot');
				$date = date("Y/m/d");
				$data2["tanggal"] = $date;

				$title = $this->input->post('nama');
				$title = strtolower($title);
				$date = date("Y/m/d");
				$newtitle = string_limit_words($title, 15);
				$urltitle = preg_replace('/[^a-z0-9]/i', ' ', $newtitle);
				$newurltitle = str_replace(" ", "-", $newtitle);
				$karakter = array('{', '}', ')', '(', '|', '`', '~', '!', '@', '%', '$', '^', '&', '*', '=', '?', '+', '-', '/', '\\', ',', '.', '#', ':', ';', '\'', '"', '[', ']');
				$hapus_karakter_aneh = strtolower(str_replace($karakter, "", $title));
				$tambah_strip = strtolower(str_replace(' ', '-', $hapus_karakter_aneh));
				$link_akhir = $tambah_strip;

				$url = $link_akhir;
				$data2["permalink"] = $url;

				$this->Webadmin_model->Update_Content("tbl_beritafoto", $data2, "id_beritafoto");
				$this->session->set_flashdata('message', 'Data Tersimpan!');
				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/beritafoto'>";
			} else {
				if (!$this->upload->do_upload()) {
					echo $this->upload->display_errors();
				} else {
					$data2["gambar"] = $acak . $nm;
					$data2["id_beritafoto"] = $this->input->post('id');
					$data2['judul_beritafoto'] = $this->input->post('nama');
					$data2['url'] = $this->input->post('username');

					$title = $this->input->post('nama');
					$title = strtolower($title);
					$date = date("Y/m/d");
					$newtitle = string_limit_words($title, 15);
					$urltitle = preg_replace('/[^a-z0-9]/i', ' ', $newtitle);
					$newurltitle = str_replace(" ", "-", $newtitle);
					$karakter = array('{', '}', ')', '(', '|', '`', '~', '!', '@', '%', '$', '^', '&', '*', '=', '?', '+', '-', '/', '\\', ',', '.', '#', ':', ';', '\'', '"', '[', ']');
					$hapus_karakter_aneh = strtolower(str_replace($karakter, "", $title));
					$tambah_strip = strtolower(str_replace(' ', '-', $hapus_karakter_aneh));
					$link_akhir = $tambah_strip;

					$url = $link_akhir;
					$data2["permalink"] = $url;

					$this->Webadmin_model->Update_Content("tbl_beritafoto", $data2, "id_beritafoto");
					$this->session->set_flashdata('message', 'Data Tersimpan!');
					echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/beritafoto'>";
				}
			}
		}

	}

	function galeri()
	{
		$page = $this->uri->segment(3);
		$limit = 10;
		if (!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		$data["page"] = $page;
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['h2_title'] = 'Galeri';
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$total = $this->Webadmin_model->Total_Data("tbl_album_galeri");
			$config['base_url'] = base_url() . '/webadmin/galeri/';
			$config['total_rows'] = $total->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
			//config for bootstrap pagination class integration
			$config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination">';
			$config['full_tag_close'] = '</ul></nav></div>';
			$config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['num_tag_close'] = '</span></li>';
			$config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
			$config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
			$config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
			$config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['prev_tagl_close'] = '</span></li>';
			$config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['first_tagl_close'] = '</span></li>';
			$config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['last_tagl_close'] = '</span></li>';

			$this->pagination->initialize($config);
			$data['paginator'] = $this->pagination->create_links();
			$data['daftarartikel'] = $this->Webadmin_model->Album_Galeri($offset, $limit);
			$data["kategori"] = $this->Webadmin_model->Semua_Kategori();
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/galeri/galeri', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function tambahalbum()
	{

		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$_SESSION['ses_kcfinder'] = array();
			$_SESSION['ses_kcfinder']['disabled'] = false;
			$_SESSION['ses_kcfinder']['uploadURL'] = "../content_upload";
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/galeri/tambah_album', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function simpanalbum()
	{
		$page = $this->uri->segment(3);
		$limit = 10;
		if (!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;

		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data2['nama_album'] = $this->input->post('nama');
			$data2['keterangan'] = $this->input->post('isi');
			$timezone = "Asia/Jakarta";
			if (function_exists('date_default_timezone_set'))
				date_default_timezone_set($timezone);
			$tgl = " %Y-%m-%d";
			$jam = "%h:%i:%a";
			$time = time();
			$data2["tanggal_album"] = mdate($tgl, $time);
			$data2['penulis'] = $this->input->post('fot');
			$title = $this->input->post('nama');
			$title = strtolower($title);
			$date = date("Y/m/d");
			$newtitle = string_limit_words($title, 15);
			$urltitle = preg_replace('/[^a-z0-9]/i', ' ', $newtitle);
			$newurltitle = str_replace(" ", "-", $newtitle);
			$karakter = array('{', '}', ')', '(', '|', '`', '~', '!', '@', '%', '$', '^', '&', '*', '=', '?', '+', '-', '/', '\\', ',', '.', '#', ':', ';', '\'', '"', '[', ']');
			$hapus_karakter_aneh = strtolower(str_replace($karakter, "", $title));
			$tambah_strip = strtolower(str_replace(' ', '-', $hapus_karakter_aneh));
			$link_akhir = $tambah_strip;

			$url = $link_akhir;
			$data2["permalink"] = $url;

			$data2["waktu"] = date('G:i:s');
			$this->form_validation->set_rules('nama', 'Judul Album', 'trim|required');
			$this->form_validation->set_rules('isi', 'Keterangan', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
				$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
				$data['instansi'] = $this->config->item('nama_instansi');
				$data['credit'] = $this->config->item('credit_aplikasi');
				$data['alamat'] = $this->config->item('alamat_instansi');
				$this->load->view('webadmin/bg_atas', $data);
				$this->load->view('webadmin/galeri/tambah_album', $data);
				$this->load->view('webadmin/bg_bawah');
			} else {
				$this->Webadmin_model->In_Polling("tbl_album_galeri", $data2);
				$this->session->set_flashdata('message', 'Data Tersimpan!');
				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/galeri'>";
			}
		}

	}
	function hapusalbum()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$this->Webadmin_model->Delete_Content($id, "id_album", "tbl_album_galeri");
			$this->session->set_flashdata('message', 'Data Terhapus!');
			echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/galeri'>";
		}

	}
	function editalbum()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}

		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$_SESSION['ses_kcfinder'] = array();
			$_SESSION['ses_kcfinder']['disabled'] = false;
			$_SESSION['ses_kcfinder']['uploadURL'] = "../content_upload";
			$data["edit"] = $this->Webadmin_model->Edit_Content("tbl_album_galeri", "id_album=$id");
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/galeri/edit_album', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function updatealbum()
	{
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$timezone = "Asia/Jakarta";
			if (function_exists('date_default_timezone_set'))
				date_default_timezone_set($timezone);
			$tgl = " %Y-%m-%d";
			$jam = "%h:%i:%a";
			$time = time();
			$data2["id_album"] = $this->input->post('id');
			$data2["nama_album"] = $this->input->post('nama');
			$data2['keterangan'] = $this->input->post('isi');
			$data2["tanggal_album"] = mdate($tgl, $time);
			$data2['penulis'] = $this->input->post('fot');
			$data2["waktu"] = date('G:i:s');

			$title = $this->input->post('nama');
			$title = strtolower($title);
			$date = date("Y/m/d");
			$newtitle = string_limit_words($title, 15);
			$urltitle = preg_replace('/[^a-z0-9]/i', ' ', $newtitle);
			$newurltitle = str_replace(" ", "-", $newtitle);
			$karakter = array('{', '}', ')', '(', '|', '`', '~', '!', '@', '%', '$', '^', '&', '*', '=', '?', '+', '-', '/', '\\', ',', '.', '#', ':', ';', '\'', '"', '[', ']');
			$hapus_karakter_aneh = strtolower(str_replace($karakter, "", $title));
			$tambah_strip = strtolower(str_replace(' ', '-', $hapus_karakter_aneh));
			$link_akhir = $tambah_strip;

			$url = $link_akhir;
			$data2["permalink"] = $url;

			$this->Webadmin_model->Update_Content("tbl_album_galeri", $data2, "id_album");
			$this->session->set_flashdata('message', 'Data Tersimpan!');
			echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/galeri'>";
		}

	}
	function tambahfoto()
	{
		$page = $this->uri->segment(4);
		$idx = $this->uri->segment(3);
		$limit = 100;
		if (!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['h2_title'] = 'Tambah Foto';
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$total = $this->Webadmin_model->Total_Data("tbl_galeri");
			$config['base_url'] = base_url() . '/webadmin/tambahfoto/';
			$config['total_rows'] = $total->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 4;
			//config for bootstrap pagination class integration
			$config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination">';
			$config['full_tag_close'] = '</ul></nav></div>';
			$config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['num_tag_close'] = '</span></li>';
			$config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
			$config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
			$config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
			$config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['prev_tagl_close'] = '</span></li>';
			$config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['first_tagl_close'] = '</span></li>';
			$config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['last_tagl_close'] = '</span></li>';

			$this->pagination->initialize($config);
			$data['paginator'] = $this->pagination->create_links();
			$data['album'] = $this->Webadmin_model->Semua_Album();
			$data['daftarartikel'] = $this->Webadmin_model->Foto($idx, $offset, $limit);
			$_SESSION['ses_kcfinder'] = array();
			$_SESSION['ses_kcfinder']['disabled'] = false;
			$_SESSION['ses_kcfinder']['uploadURL'] = "../content_upload";
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/galeri/foto', $data);
			$this->load->view('webadmin/bg_bawahbaru');
		}

	}
	public function uploadfotobaru()
	{

		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {

			if (!empty($_FILES)) {
				$kode = $this->input->post('id_param');
				//$storeFolder = getcwd() . '/asset/galeri/original/';

				$image_path = "/asset/galeri/logo.png";
				$tempFile = $_FILES['file']['tmp_name'];
				$fileName = $_FILES['file']['name'];
				$targetPath = getcwd() . '/asset/galeri/original/';
				$targetPath2 = getcwd() . '/asset/galeri/thumb/';
				$targetFile = $targetPath . $fileName;
				list($txt, $ext) = explode(".", $fileName);
				$actual_image_name = time() . substr(str_replace(" ", "_", $txt), 5) . "." . $ext;
				$tmp = $_FILES['file']['tmp_name'];

				$pecah = explode(".", $fileName);
				$ekstensi = $pecah[1];
				$extensionList = array("jpg", "bmp", "gif");
				if (in_array($ekstensi, $extensionList)) {


					if (move_uploaded_file($tempFile, $targetPath . $actual_image_name)) {
						$add = $targetPath . $actual_image_name; // the path with the file name where the file will be stored, upload is the directory 


						$data2['foto_besar'] = $actual_image_name;
						$data2['foto_kecil'] = $actual_image_name;
						$data2['id_album'] = $kode;
						$data2['keterangan'] = "";
						$this->Webadmin_model->In_Polling("tbl_galeri", $data2);
					}
				} else {
					echo "Error";
				}

			}
		}
	}
	function uploadfoto()
	{
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			//------------------------------------------------------------------------------------
			if (!empty($_FILES['userfile']['name'])) {
				$acak = rand(00000000000, 99999999999);
				$bersih = $_FILES['userfile']['name'];
				$nm = str_replace(" ", "_", "$bersih");
				$pisah = explode(".", $nm);
				$nama_murni_lama = preg_replace("/^(.+?);.*$/", "\\1", $pisah[0]);
				$nama_murni = strtolower($nama_murni_lama);
				$ekstensi_kotor = $pisah[1];
				$file_type = preg_replace("/^(.+?);.*$/", "\\1", $ekstensi_kotor);
				$file_type_baru = strtolower($file_type);
				$ubah = $acak . '-' . $nama_murni; //tanpa ekstensi
				$n_baru = $ubah . '.' . $file_type_baru;
				$this->load->library('image_lib');
				$url = './asset/galeri/';    //path image 
				if ($_FILES['userfile']['error'] == 4)  //if No file was uploaded. 
					return false;
				$config['upload_path'] = $url . "original/";
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = 10240;
				$config['max_width'] = 2024;
				$config['max_height'] = 2024;
				$config["file_name"] = $ubah; //dengan eekstensi
				$this->load->library('upload');
				$this->upload->initialize($config);

				if ($this->upload->do_upload('userfile')) {
					$files = $this->upload->data();
					$fileNameResize = $config['upload_path'] . $files['file_name'];
					$size = array(
						array('name' => 'thumb', 'width' => 120, 'quality' => '50%'),
						array('name' => 'large', 'width' => 315, 'quality' => '50%')
					);
					$resize = array();
					foreach ($size as $r) {
						$resize = array(
							"width" => $r['width'],
							"quality" => $r['quality'],
							"source_image" => $fileNameResize,
							"new_image" => $url . $r['name'] . '/' . $files['file_name']
						);
						$this->image_lib->initialize($resize);
						if (!$this->image_lib->resize())
							die($this->image_lib->display_errors());
					}
					//echo "resize oke";
				} else {
					echo $this->upload->display_errors();
				}

				//---------------------------------------------------------------------------------------------------
				$data2['foto_besar'] = $n_baru;
				$data2['foto_kecil'] = 'kecil-' . $n_baru;
				$data2['id_album'] = $this->input->post('album');
				$data2['keterangan'] = $this->input->post('keterangan');
				$this->Webadmin_model->In_Polling("tbl_galeri", $data2);
				$this->session->set_flashdata('message', 'Data Tersimpan!');
				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/tambahfoto'>";
			} else {
				echo "Foto Masih Kosong";
			}
		}

	}
	function editfoto()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}
		$datestring = "Login : %d-%m-%Y pukul %h:%i %a";
		$time = time();
		$data["tanggal"] = mdate($datestring, $time);
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['h2_title'] = 'Ubah Foto';
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$data["edit"] = $this->Webadmin_model->Edit_Content("tbl_galeri", "id_foto=$id");
			$data['album'] = $this->Webadmin_model->Semua_Album();
			$_SESSION['ses_kcfinder'] = array();
			$_SESSION['ses_kcfinder']['disabled'] = false;
			$_SESSION['ses_kcfinder']['uploadURL'] = "../content_upload";
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/galeri/edit_foto', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function updatefoto()
	{
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			if (empty($_FILES['userfile']['name'])) {
				$timezone = "Asia/Jakarta";
				if (function_exists('date_default_timezone_set'))
					date_default_timezone_set($timezone);
				$tgl = " %Y-%m-%d";
				$jam = "%h:%i:%a";
				$time = time();
				$data2['id_foto'] = $this->input->post('id_foto');
				$data2['id_album'] = $this->input->post('album');
				$data2['keterangan'] = $this->input->post('keterangan');
				$this->Webadmin_model->Update_Content("tbl_galeri", $data2, "id_foto");
				$this->session->set_flashdata('message', 'Data Tersimpan!');
				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/tambahfoto'>";
			} else {
				$acak = rand(00000000000, 99999999999);
				$bersih = $_FILES['userfile']['name'];
				$nm = str_replace(" ", "_", "$bersih");
				$pisah = explode(".", $nm);
				$nama_murni_lama = preg_replace("/^(.+?);.*$/", "\\1", $pisah[0]);
				$nama_murni = strtolower($nama_murni_lama);
				$ekstensi_kotor = $pisah[1];
				$file_type = preg_replace("/^(.+?);.*$/", "\\1", $ekstensi_kotor);
				$file_type_baru = strtolower($file_type);
				$ubah = $acak . '-' . $nama_murni; //tanpa ekstensi
				$n_baru = $ubah . '.' . $file_type_baru;
				$this->load->library('image_lib');
				$url = './asset/galeri/';    //path image 
				if ($_FILES['userfile']['error'] == 4)  //if No file was uploaded. 
					return false;
				$config['upload_path'] = $url . "original/";
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = 10240;
				$config['max_width'] = 2024;
				$config['max_height'] = 2024;
				$config["file_name"] = $ubah; //dengan eekstensi
				$this->load->library('upload');
				$this->upload->initialize($config);

				if ($this->upload->do_upload('userfile')) {
					$files = $this->upload->data();
					$fileNameResize = $config['upload_path'] . $files['file_name'];
					$size = array(
						array('name' => 'thumb', 'width' => 120, 'quality' => '50%'),
						array('name' => 'large', 'width' => 315, 'quality' => '50%')
					);
					$resize = array();
					foreach ($size as $r) {
						$resize = array(
							"width" => $r['width'],
							"quality" => $r['quality'],
							"source_image" => $fileNameResize,
							"new_image" => $url . $r['name'] . '/' . $files['file_name']
						);
						$this->image_lib->initialize($resize);
						if (!$this->image_lib->resize())
							die($this->image_lib->display_errors());
					}
					//echo "resize oke";
				} else {
					echo $this->upload->display_errors();
				}

				//---------------------------------------------------------------------------------------------------

				$tgl = " %Y-%m-%d";
				$jam = "%h:%i:%a";
				$time = time();
				$data2['foto_besar'] = $n_baru;
				$data2['foto_kecil'] = 'kecil-' . $n_baru;
				$data2['id_album'] = $this->input->post('album');
				$data2['keterangan'] = $this->input->post('keterangan');
				$data2["id_foto"] = $this->input->post('id_foto');
				$this->Webadmin_model->Update_Content("tbl_galeri", $data2, "id_foto");
				$this->session->set_flashdata('message', 'Data Tersimpan!');
				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/tambahfoto'>";

			}
		}

	}
	function hapusfoto()
	{
		$id = '';

		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}
		$id2 = $this->uri->segment(4);
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$this->Webadmin_model->Delete_Content($id, "id_foto", "tbl_galeri");
			$this->session->set_flashdata('message', 'Data Terhapus!');
			//echo "<meta http-equiv='refresh' content='0; url=".base_url()."webadmin/tambahfoto/'.$id2>";
			header('location:' . base_url() . 'webadmin/tambahfoto/' . $id2); exit;
		}

	}



	function kritikview()
	{
		$page = $this->uri->segment(3);
		$limit = 10;
		if (!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;

		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		$data["page"] = $page;
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$data['message'] = "Data Kritik & Saran";
			$total = $this->Webadmin_model->Total_Data_Kritik("tblhubungi", "Y");
			$config['base_url'] = base_url() . '/webadmin/kritikview/';
			$config['total_rows'] = $total->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
			//config for bootstrap pagination class integration
			$config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination">';
			$config['full_tag_close'] = '</ul></nav></div>';
			$config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['num_tag_close'] = '</span></li>';
			$config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
			$config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
			$config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
			$config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['prev_tagl_close'] = '</span></li>';
			$config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['first_tagl_close'] = '</span></li>';
			$config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['last_tagl_close'] = '</span></li>';

			$this->pagination->initialize($config);
			$data['paginator'] = $this->pagination->create_links();
			$data['daftarartikel'] = $this->Webadmin_model->Kritik($offset, $limit, 'Y');
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/kritik/kritik', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function kritik()
	{
		$page = $this->uri->segment(3);
		$limit = 10;
		if (!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;

		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		$data["page"] = $page;
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$data['message'] = "Data Kritik & Saran";
			$total = $this->Webadmin_model->Total_Data_Kritik("tblhubungi", "N");
			$config['base_url'] = base_url() . '/webadmin/kritik/';
			$config['total_rows'] = $total->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
			//config for bootstrap pagination class integration
			$config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination">';
			$config['full_tag_close'] = '</ul></nav></div>';
			$config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['num_tag_close'] = '</span></li>';
			$config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
			$config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
			$config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
			$config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['prev_tagl_close'] = '</span></li>';
			$config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['first_tagl_close'] = '</span></li>';
			$config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['last_tagl_close'] = '</span></li>';

			$this->pagination->initialize($config);
			$data['paginator'] = $this->pagination->create_links();
			$data['daftarartikel'] = $this->Webadmin_model->Kritik($offset, $limit, 'N');
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/kritik/kritik', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function editkritik()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}
		$datestring = "Login : %d-%m-%Y pukul %h:%i %a";
		$time = time();
		$data["tanggal"] = mdate($datestring, $time);
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['h2_title'] = 'Ubah Kontak';
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$_SESSION['ses_admin'] = "admin";
			$_SESSION['ses_kcfinder'] = array();
			$_SESSION['ses_kcfinder']['disabled'] = false;
			$_SESSION['ses_kcfinder']['uploadURL'] = "../content_upload";
			$data["edit"] = $this->Webadmin_model->Edit_Content("tblhubungi", "id_hubungi=$id");
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/kritik/edit_kritik', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function updatekontak()
	{
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$tgl = " %Y-%m-%d";
			$jam = "%h:%i:%a";
			$time = time();
			$data2["id_hubungi"] = $this->input->post('id');
			$data2['nama'] = $this->input->post('nama');
			$data2['email'] = $this->input->post('email');
			$data2['pesan'] = $this->input->post('pesan');
			$data2['replay'] = $this->input->post('pesan2');
			$data2['status'] = $this->input->post('status');
			$isi_psn = $data2['replay'];
			if ($this->input->post('pesan2') != "") {
				//validation
				$isi_psn = 'Terima kasih telah menghubungi LPTQ Kabupaten Bengkalis,Menanggapi pertanyan Anda Tentang :<br><br>

" ' . $this->input->post('pesan') . '"<br><br>

 ' . $this->input->post('pesan2') . '<br>
';

				$this->load->library('email');
				$this->email->set_mailtype('html');
				$this->email->from("administrator@lptqkabupatenbengkalis.org", "Admin LPTQ Kabupaten Bengkalis");
				$this->email->to($data2['email']);
				$this->email->subject('Jawaban Kritik &');
				$this->email->message($isi_psn);
				$this->email->send();
				$this->email->clear();
				//tujuan
			}
			$this->session->set_flashdata('message', 'Data Tersimpan!');
			$this->Webadmin_model->Update_Content("tblhubungi", $data2, "id_hubungi");
			echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/kritik'>";
		}

	}
	function hapuskritik()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$this->session->set_flashdata('message', 'Data Terhapus!');
			$this->Webadmin_model->Delete_Content($id, "id_hubungi", "tblhubungi");
			echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/kritik'>";
		}

	}



	function info()
	{
		$page = $this->uri->segment(3);
		$limit = 10;
		if (!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;

		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$data['message'] = "Data Pengguna";
			$total = $this->Webadmin_model->Total_Data("tbl_info");
			$config['base_url'] = base_url() . '/webadmin/info/';
			$config['total_rows'] = $total->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
			//config for bootstrap pagination class integration
			$config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination">';
			$config['full_tag_close'] = '</ul></nav></div>';
			$config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['num_tag_close'] = '</span></li>';
			$config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
			$config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
			$config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
			$config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['prev_tagl_close'] = '</span></li>';
			$config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['first_tagl_close'] = '</span></li>';
			$config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['last_tagl_close'] = '</span></li>';

			$this->pagination->initialize($config);
			$data['paginator'] = $this->pagination->create_links();
			$data['daftarartikel'] = $this->Webadmin_model->Info($offset, $limit);
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/info/info', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function hapusinfo()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$this->Webadmin_model->Delete_Content($id, "id_info", "tbl_info");
			$this->session->set_flashdata('message', 'Data Terhapus!');
			echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/info'>";
		}

	}
	function tambahinfo()
	{

		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$_SESSION['ses_kcfinder'] = array();
			$_SESSION['ses_kcfinder']['disabled'] = false;
			$_SESSION['ses_kcfinder']['uploadURL'] = "../content_upload";
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/info/tambah_info', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function simpaninfo()
	{
		$page = $this->uri->segment(3);
		$limit = 10;
		if (!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;

		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data2['judul_info'] = $this->input->post('nama');
			$data2['url'] = $this->input->post('username');
			$this->form_validation->set_rules('nama', 'Judul Link', 'trim|required');
			$this->form_validation->set_rules('username', 'Isi Link', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
				$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
				$data['instansi'] = $this->config->item('nama_instansi');
				$data['credit'] = $this->config->item('credit_aplikasi');
				$data['alamat'] = $this->config->item('alamat_instansi');
				$this->load->view('webadmin/bg_atas', $data);
				$this->load->view('webadmin/link/tambah_info', $data);
				$this->load->view('webadmin/bg_bawah');
			} else {
				$acak = rand(00000000000, 99999999999);
				$bersih = $_FILES['userfile']['name'];
				$nm = str_replace(" ", "_", "$bersih");
				$pisah = explode(".", $nm);
				$nama_murni = $pisah[0];
				$ubah = $acak . $nama_murni; //tanpa ekstensi
				$config["file_name"] = $ubah; //dengan eekstensi
				$data2["gambar"] = $acak . $nm;
				$config['upload_path'] = './asset/banner/';
				$config['allowed_types'] = 'gif|jpg|jpeg|png';
				$config['max_size'] = '500000';
				$config['max_width'] = '12000';
				$config['max_height'] = '12000';
				$this->load->library('upload', $config);

				if (!$this->upload->do_upload()) {
					echo $this->upload->display_errors();
				} else {
					$this->Webadmin_model->In_Polling("tbl_info", $data2);
					$this->session->set_flashdata('message', 'Data Tersimpan!');
					echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/info'>";
				}
			}
		}

	}
	function editinfo()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}

		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$_SESSION['ses_kcfinder'] = array();
			$_SESSION['ses_kcfinder']['disabled'] = false;
			$_SESSION['ses_kcfinder']['uploadURL'] = "../content_upload";
			$data["edit"] = $this->Webadmin_model->Edit_Content("tbl_info", "id_info=$id");
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/info/edit_info', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function updateinfo()
	{
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$tgl = " %Y-%m-%d";
			$jam = "%h:%i:%a";
			$time = time();
			//for gambar
			$acak = rand(00000000000, 99999999999);
			$bersih = $_FILES['userfile']['name'];
			$nm = str_replace(" ", "_", "$bersih");
			$pisah = explode(".", $nm);
			$nama_murni = $pisah[0];
			$ubah = $acak . $nama_murni; //tanpa ekstensi
			$config["file_name"] = $ubah; //dengan eekstensi	
			$config['upload_path'] = './asset/banner/';
			$config['allowed_types'] = 'bmp|gif|jpg|jpeg|png';
			$config['max_size'] = '10000';
			$config['max_width'] = '10000';
			$config['max_height'] = '10000';
			$this->load->library('upload', $config);
			if (empty($_FILES['userfile']['name'])) {
				//end gambar
				$data2["id_info"] = $this->input->post('id');
				$data2['judul_info'] = $this->input->post('nama');
				$data2['url'] = $this->input->post('username');
				$this->Webadmin_model->Update_Content("tbl_info", $data2, "id_info");
				$this->session->set_flashdata('message', 'Data Tersimpan!');
				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/info'>";
			} else {
				if (!$this->upload->do_upload()) {
					echo $this->upload->display_errors();
				} else {
					$data2["gambar"] = $acak . $nm;
					$data2["id_link"] = $this->input->post('id');
					$data2['judul_link'] = $this->input->post('nama');
					$data2['url'] = $this->input->post('username');
					$this->Webadmin_model->Update_Content("tbl_info", $data2, "id_info");
					$this->session->set_flashdata('message', 'Data Tersimpan!');
					echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/info'>";
				}
			}
		}

	}
	function video()
	{
		$page = $this->uri->segment(3);
		$limit = 10;
		if (!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;

		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		$data["page"] = $page;
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$data['message'] = "Data Pengguna";
			$total = $this->Webadmin_model->Total_Data("tbl_video");
			$config['base_url'] = base_url() . '/webadmin/video/';
			$config['total_rows'] = $total->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
			//config for bootstrap pagination class integration
			$config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination">';
			$config['full_tag_close'] = '</ul></nav></div>';
			$config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['num_tag_close'] = '</span></li>';
			$config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
			$config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
			$config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
			$config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['prev_tagl_close'] = '</span></li>';
			$config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['first_tagl_close'] = '</span></li>';
			$config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['last_tagl_close'] = '</span></li>';
			$this->pagination->initialize($config);
			$data['paginator'] = $this->pagination->create_links();
			$data['daftarartikel'] = $this->Webadmin_model->Video($offset, $limit);
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/video/video', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function hapusvideo()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$this->Webadmin_model->Delete_Content($id, "id_video", "tbl_video");
			$this->session->set_flashdata('message', 'Data Terhapus!');
			echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/video'>";
		}

	}
	function tambahvideo()
	{

		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$_SESSION['ses_kcfinder'] = array();
			$_SESSION['ses_kcfinder']['disabled'] = false;
			$_SESSION['ses_kcfinder']['uploadURL'] = "../content_upload";
			$data["kategori"] = $this->Webadmin_model->Semua_Menu89();
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/video/tambah_video', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function simpanvideo()
	{
		$page = $this->uri->segment(3);
		$limit = 10;
		if (!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;

		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data2['judul_video'] = $this->input->post('nama');
			$data2['url'] = $this->input->post('username');
			$data2['penulis'] = $this->input->post('fot');
			$data2['id_kategori'] = $this->input->post('kategori');
			$tgl = " %Y-%m-%d";
			$jam = "%h:%i:%a";
			$time = time();
			$data2["tanggal"] = mdate($tgl, $time);
			$data2["waktu"] = date('G:i:s');
			$this->form_validation->set_rules('nama', 'Judul Link', 'trim|required');
			$this->form_validation->set_rules('username', 'Isi Link', 'trim|required');

			$title = $this->input->post('nama');
			$title = strtolower($title);
			$date = date("Y/m/d");
			$newtitle = string_limit_words($title, 15);
			$urltitle = preg_replace('/[^a-z0-9]/i', ' ', $newtitle);
			$newurltitle = str_replace(" ", "-", $newtitle);
			$karakter = array('{', '}', ')', '(', '|', '`', '~', '!', '@', '%', '$', '^', '&', '*', '=', '?', '+', '-', '/', '\\', ',', '.', '#', ':', ';', '\'', '"', '[', ']');
			$hapus_karakter_aneh = strtolower(str_replace($karakter, "", $title));
			$tambah_strip = strtolower(str_replace(' ', '-', $hapus_karakter_aneh));
			$link_akhir = $tambah_strip;

			$url = $link_akhir;
			$data2["permalink"] = $url;
			if ($this->form_validation->run() == FALSE) {
				$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
				$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
				$data['instansi'] = $this->config->item('nama_instansi');
				$data['credit'] = $this->config->item('credit_aplikasi');
				$data['alamat'] = $this->config->item('alamat_instansi');
				$this->load->view('webadmin/bg_atas', $data);
				$this->load->view('webadmin/link/tambah_video', $data);
				$this->load->view('webadmin/bg_bawah');
			} else {
				$acak = rand(00000000000, 99999999999);
				$bersih = $_FILES['userfile']['name'];
				$nm = str_replace(" ", "_", "$bersih");
				$pisah = explode(".", $nm);
				$nama_murni = $pisah[0];
				$ubah = $acak . $nama_murni; //tanpa ekstensi
				$config["file_name"] = $ubah; //dengan eekstensi
				$data2["gambar"] = $acak . $nm;
				$config['upload_path'] = './asset/banner/';
				$config['allowed_types'] = 'gif|jpg|jpeg|png';
				$config['max_size'] = '500000';
				$config['max_width'] = '12000';
				$config['max_height'] = '12000';
				$this->load->library('upload', $config);

				if (!$this->upload->do_upload()) {
					echo $this->upload->display_errors();
				} else {
					$this->Webadmin_model->In_Polling("tbl_video", $data2);
					$this->session->set_flashdata('message', 'Data Tersimpan!');
					echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/video'>";
				}
			}
		}

	}
	function editvideo()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}

		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$_SESSION['ses_kcfinder'] = array();
			$_SESSION['ses_kcfinder']['disabled'] = false;
			$_SESSION['ses_kcfinder']['uploadURL'] = "../content_upload";
			$data["kategori"] = $this->Webadmin_model->Semua_Menu89();
			$data["edit"] = $this->Webadmin_model->Edit_Content("tbl_video", "id_video=$id");
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/video/edit_video', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function updatevideo()
	{
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$tgl = " %Y-%m-%d";
			$jam = "%h:%i:%a";
			$time = time();
			//for gambar
			$acak = rand(00000000000, 99999999999);
			$bersih = $_FILES['userfile']['name'];
			$nm = str_replace(" ", "_", "$bersih");
			$pisah = explode(".", $nm);
			$nama_murni = $pisah[0];
			$ubah = $acak . $nama_murni; //tanpa ekstensi
			$config["file_name"] = $ubah; //dengan eekstensi	
			$config['upload_path'] = './asset/banner/';
			$config['allowed_types'] = 'bmp|gif|jpg|jpeg|png';
			$config['max_size'] = '10000';
			$config['max_width'] = '10000';
			$config['max_height'] = '10000';
			$this->load->library('upload', $config);
			if (empty($_FILES['userfile']['name'])) {
				//end gambar
				$data2["id_video"] = $this->input->post('id');
				$data2['judul_video'] = $this->input->post('nama');
				$data2['penulis'] = $this->input->post('fot');
				$data2['url'] = $this->input->post('username');
				$data2['id_kategori'] = $this->input->post('kategori');
				$title = $this->input->post('nama');
				$title = strtolower($title);
				$date = date("Y/m/d");
				$newtitle = string_limit_words($title, 15);
				$urltitle = preg_replace('/[^a-z0-9]/i', ' ', $newtitle);
				$newurltitle = str_replace(" ", "-", $newtitle);
				$karakter = array('{', '}', ')', '(', '|', '`', '~', '!', '@', '%', '$', '^', '&', '*', '=', '?', '+', '-', '/', '\\', ',', '.', '#', ':', ';', '\'', '"', '[', ']');
				$hapus_karakter_aneh = strtolower(str_replace($karakter, "", $title));
				$tambah_strip = strtolower(str_replace(' ', '-', $hapus_karakter_aneh));
				$link_akhir = $tambah_strip;

				$url = $link_akhir;
				$data2["permalink"] = $url;

				$this->Webadmin_model->Update_Content("tbl_video", $data2, "id_video");
				$this->session->set_flashdata('message', 'Data Tersimpan!');
				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/video'>";
			} else {
				if (!$this->upload->do_upload()) {
					echo $this->upload->display_errors();
				} else {
					$data2["gambar"] = $acak . $nm;
					$data2["id_video"] = $this->input->post('id');
					$data2['judul_video'] = $this->input->post('nama');
					$data2['url'] = $this->input->post('username');
					$data2['id_kategori'] = $this->input->post('kategori');
					$title = $this->input->post('nama');
					$title = strtolower($title);
					$date = date("Y/m/d");
					$newtitle = string_limit_words($title, 15);
					$urltitle = preg_replace('/[^a-z0-9]/i', ' ', $newtitle);
					$newurltitle = str_replace(" ", "-", $newtitle);
					$karakter = array('{', '}', ')', '(', '|', '`', '~', '!', '@', '%', '$', '^', '&', '*', '=', '?', '+', '-', '/', '\\', ',', '.', '#', ':', ';', '\'', '"', '[', ']');
					$hapus_karakter_aneh = strtolower(str_replace($karakter, "", $title));
					$tambah_strip = strtolower(str_replace(' ', '-', $hapus_karakter_aneh));
					$link_akhir = $tambah_strip;

					$url = $link_akhir;
					$data2["permalink"] = $url;

					$this->Webadmin_model->Update_Content("tbl_video", $data2, "id_video");
					$this->session->set_flashdata('message', 'Data Tersimpan!');
					echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/video'>";
				}
			}
		}

	}







	function tagar()
	{
		$page = $this->uri->segment(3);
		$limit = 10;
		if (!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;
		$data = array();
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['h2_title'] = 'Tambah Jenis Informasi';
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$tot_hal = $this->Webadmin_model->Total_Data("tbl_tag");
			$config['base_url'] = base_url() . '/webadmin/tagar/';
			$config['total_rows'] = $tot_hal->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
			//config for bootstrap pagination class integration
			$config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination">';
			$config['full_tag_close'] = '</ul></nav></div>';
			$config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['num_tag_close'] = '</span></li>';
			$config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
			$config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
			$config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
			$config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['prev_tagl_close'] = '</span></li>';
			$config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['first_tagl_close'] = '</span></li>';
			$config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['last_tagl_close'] = '</span></li>';

			$this->pagination->initialize($config);
			$data["paginator"] = $this->pagination->create_links();
			$data["page"] = $page;
			$data['daftarartikel'] = $this->Webadmin_model->Tagar($offset, $limit);
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/berita/tambahtagar', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function simpantagar()
	{
		$page = $this->uri->segment(3);
		$limit = 10;
		if (!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {

			$data2['tag'] = $this->input->post('nama');

			$title = $this->input->post('nama');
			$title = strtolower($title);
			$newtitle = string_limit_words($title, 15);
			$urltitle = preg_replace('/[^a-z0-9]/i', ' ', $newtitle);
			$newurltitle = str_replace(" ", "-", $newtitle);
			$data2['permalink'] = $newurltitle;

			$this->form_validation->set_rules('nama', 'Tagar', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
				$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
				$data['instansi'] = $this->config->item('nama_instansi');
				$data['credit'] = $this->config->item('credit_aplikasi');
				$data['alamat'] = $this->config->item('alamat_instansi');
				$tot_hal = $this->Webadmin_model->Total_Data("tbl_tagar");
				$config['base_url'] = base_url() . '/webadmin/tagar/';
				$config['total_rows'] = $tot_hal->num_rows();
				$config['per_page'] = $limit;
				$config['uri_segment'] = 3;
				//config for bootstrap pagination class integration
				$config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination">';
				$config['full_tag_close'] = '</ul></nav></div>';
				$config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
				$config['num_tag_close'] = '</span></li>';
				$config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
				$config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
				$config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
				$config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
				$config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
				$config['prev_tagl_close'] = '</span></li>';
				$config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
				$config['first_tagl_close'] = '</span></li>';
				$config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
				$config['last_tagl_close'] = '</span></li>';

				$this->pagination->initialize($config);
				$data["paginator"] = $this->pagination->create_links();
				$data["page"] = $page;
				$data['daftarartikel'] = $this->Webadmin_model->Tagar($offset, $limit);

				$this->load->view('webadmin/bg_atas', $data);
				$this->load->view('webadmin/berita/tambahtagar', $data);
				$this->load->view('webadmin/bg_bawah');
			} else {
				$this->Webadmin_model->In_Polling("tbl_tag", $data2);
				$this->session->set_flashdata('message', 'Data Tersimpan!');
				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/tagar'>";
			}
		}

	}

	function hapustagar()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$this->Webadmin_model->Delete_Content($id, "id_tag", "tbl_tag");
			$this->session->set_flashdata('message', 'Data Terhapus!');
			echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/tagar'>";
		}

	}
	function edittagar()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}

		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$_SESSION['ses_kcfinder'] = array();
			$_SESSION['ses_kcfinder']['disabled'] = false;
			$_SESSION['ses_kcfinder']['uploadURL'] = "../content_upload";
			$data["edit"] = $this->Webadmin_model->Edit_Content("tbl_tag", "id_tag=$id");
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/berita/edit_tagar', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function updatetagar()
	{
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$tgl = " %Y-%m-%d";
			$jam = "%h:%i:%a";
			$time = time();
			$data2["id_tag"] = $this->input->post('id');
			$data2['tag'] = $this->input->post('nama');

			$title = $this->input->post('nama');
			$title = strtolower($title);
			$newtitle = string_limit_words($title, 15);
			$urltitle = preg_replace('/[^a-z0-9]/i', ' ', $newtitle);
			$newurltitle = str_replace(" ", "-", $newtitle);
			$data2['permalink'] = $newurltitle;

			$this->Webadmin_model->Update_Content("tbl_tag", $data2, "id_tag");
			$this->session->set_flashdata('message', 'Data Tersimpan!');
			echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/tagar'>";
		}

	}

	function penghargaan()
	{
		$page = $this->uri->segment(3);
		$limit = 10;
		if (!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;

		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		$data["page"] = $page;
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$data['message'] = "Data Berita Foto";
			$total = $this->Webadmin_model->Total_Data("tbl_penghargaan");
			$config['base_url'] = base_url() . '/webadmin/penghargaan/';
			$config['total_rows'] = $total->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
			//config for bootstrap pagination class integration
			$config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination">';
			$config['full_tag_close'] = '</ul></nav></div>';
			$config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['num_tag_close'] = '</span></li>';
			$config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
			$config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
			$config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
			$config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['prev_tagl_close'] = '</span></li>';
			$config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['first_tagl_close'] = '</span></li>';
			$config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['last_tagl_close'] = '</span></li>';

			$this->pagination->initialize($config);
			$data['paginator'] = $this->pagination->create_links();
			$data['daftarartikel'] = $this->Webadmin_model->Penghargaan($offset, $limit);
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/penghargaan/penghargaan', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function tambahpenghargaan()
	{

		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$_SESSION['ses_kcfinder'] = array();
			$_SESSION['ses_kcfinder']['disabled'] = false;
			$_SESSION['ses_kcfinder']['uploadURL'] = "../content_upload";

			$tgl = "%d-%m-%Y";
			$time = time();
			$data["wkt_skr"] = mdate($tgl, $time);
			$data["kategori"] = $this->Webadmin_model->Semua_Menutype5();
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/penghargaan/tambah_penghargaan', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function simpanpenghargaan()
	{
		$page = $this->uri->segment(3);
		$limit = 10;
		if (!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;

		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data2['judul_penghargaan'] = $this->input->post('nama');
			$data2['isi'] = $this->input->post('username');
			//$data2['url'] = $this->input->post('fot');
			$tgl = " %Y-%m-%d";
			$jam = "%h:%i:%a";
			$time = time();
			$data2["tanggal"] = mdate($tgl, $time);
			$data2["waktu"] = date('G:i:s');

			$data2['tahun'] = $this->input->post('tahun');
			//$data2['id_kategori'] = $this->input->post('kategori');

			$title = $this->input->post('nama');
			$title = strtolower($title);
			$date = date("Y/m/d");
			$newtitle = string_limit_words($title, 15);
			$urltitle = preg_replace('/[^a-z0-9]/i', ' ', $newtitle);
			$newurltitle = str_replace(" ", "-", $newtitle);
			$karakter = array('{', '}', ')', '(', '|', '`', '~', '!', '@', '%', '$', '^', '&', '*', '=', '?', '+', '-', '/', '\\', ',', '.', '#', ':', ';', '\'', '"', '[', ']');
			$hapus_karakter_aneh = strtolower(str_replace($karakter, "", $title));
			$tambah_strip = strtolower(str_replace(' ', '-', $hapus_karakter_aneh));
			$link_akhir = $tambah_strip;

			$url = $link_akhir;
			$data2["permalink"] = $url;

			$this->form_validation->set_rules('nama', 'Judul Penghargaan', 'trim|required');
			$this->form_validation->set_rules('username', 'Url beritafoto', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
				$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
				$data['instansi'] = $this->config->item('nama_instansi');
				$data['credit'] = $this->config->item('credit_aplikasi');
				$data['alamat'] = $this->config->item('alamat_instansi');
				$tgl = "%d-%m-%Y";
				$time = time();
				$data["wkt_skr"] = mdate($tgl, $time);
				$data["kategori"] = $this->Webadmin_model->Semua_Menutype5();
				$this->load->view('webadmin/bg_atas', $data);
				$this->load->view('webadmin/penghargaan/tambah_penghargaan', $data);
				$this->load->view('webadmin/bg_bawah');
			} else {
				$acak = rand(00000000000, 99999999999);
				$bersih = $_FILES['userfile']['name'];
				$nm = str_replace(" ", "_", "$bersih");
				$pisah = explode(".", $nm);
				$nama_murni = $pisah[0];
				$ubah = $acak . $nama_murni; //tanpa ekstensi
				$config["file_name"] = $ubah; //dengan eekstensi
				$data2["gambar"] = $acak . $nm;
				$config['upload_path'] = './asset/penghargaan/';
				$config['allowed_types'] = 'gif|jpg|jpeg|png';
				$config['max_size'] = '500000';
				$config['max_width'] = '12000';
				$config['max_height'] = '12000';
				$this->load->library('upload', $config);

				if (!$this->upload->do_upload()) {
					echo $this->upload->display_errors();
				} else {
					$this->Webadmin_model->In_Polling("tbl_penghargaan", $data2);
					$this->session->set_flashdata('message', 'Data Tersimpan!');
					echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/penghargaan'>";
				}
			}
		}

	}
	function hapuspenghargaan()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$this->Webadmin_model->Delete_Content($id, "id_penghargaan", "tbl_penghargaan");
			$this->session->set_flashdata('message', 'Data Terhapus!');
			echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/penghargaan'>";
		}

	}
	function editpenghargaan()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}

		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$_SESSION['ses_kcfinder'] = array();
			$_SESSION['ses_kcfinder']['disabled'] = false;
			$_SESSION['ses_kcfinder']['uploadURL'] = "../content_upload";
			$data["edit"] = $this->Webadmin_model->Edit_Content("tbl_penghargaan", "id_penghargaan=$id");
			$data["kategori"] = $this->Webadmin_model->Semua_Menutype5();

			$tgl = "%d-%m-%Y";
			$time = time();
			$data["wkt_skr"] = mdate($tgl, $time);

			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/penghargaan/edit_penghargaan', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function updatepenghargaan()
	{
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$tgl = " %Y-%m-%d";
			$jam = "%h:%i:%a";
			$time = time();
			//for gambar
			$acak = rand(00000000000, 99999999999);
			$bersih = $_FILES['userfile']['name'];
			$nm = str_replace(" ", "_", "$bersih");
			$pisah = explode(".", $nm);
			$nama_murni = $pisah[0];
			$ubah = $acak . $nama_murni; //tanpa ekstensi
			$config["file_name"] = $ubah; //dengan eekstensi	
			$config['upload_path'] = './asset/penghargaan/';
			$config['allowed_types'] = 'bmp|gif|jpg|jpeg|png';
			$config['max_size'] = '10000';
			$config['max_width'] = '10000';
			$config['max_height'] = '10000';
			$this->load->library('upload', $config);
			if (empty($_FILES['userfile']['name'])) {
				//end gambar
				$data2["id_penghargaan"] = $this->input->post('id');
				$data2['judul_penghargaan'] = $this->input->post('nama');
				$data2['isi'] = $this->input->post('username');
				$data2['url'] = $this->input->post('fot');
				$date = date("Y/m/d");
				$data2["tanggal"] = $date;
				$data2['tahun'] = $this->input->post('tahun');
				$data2['id_kategori'] = $this->input->post('kategori');
				$title = $this->input->post('nama');
				$title = strtolower($title);
				$date = date("Y/m/d");
				$newtitle = string_limit_words($title, 15);
				$urltitle = preg_replace('/[^a-z0-9]/i', ' ', $newtitle);
				$newurltitle = str_replace(" ", "-", $newtitle);
				$karakter = array('{', '}', ')', '(', '|', '`', '~', '!', '@', '%', '$', '^', '&', '*', '=', '?', '+', '-', '/', '\\', ',', '.', '#', ':', ';', '\'', '"', '[', ']');
				$hapus_karakter_aneh = strtolower(str_replace($karakter, "", $title));
				$tambah_strip = strtolower(str_replace(' ', '-', $hapus_karakter_aneh));
				$link_akhir = $tambah_strip;

				$url = $link_akhir;
				$data2["permalink"] = $url;

				$this->Webadmin_model->Update_Content("tbl_penghargaan", $data2, "id_penghargaan");
				$this->session->set_flashdata('message', 'Data Tersimpan!');
				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/Penghargaan'>";
			} else {
				if (!$this->upload->do_upload()) {
					echo $this->upload->display_errors();
				} else {
					$data2["gambar"] = $acak . $nm;
					$data2["id_penghargaan"] = $this->input->post('id');
					$data2['judul_penghargaan'] = $this->input->post('nama');
					$data2['isi'] = $this->input->post('username');
					$data2['url'] = $this->input->post('fot');
					$data2['tahun'] = $this->input->post('tahun');
					$data2['id_kategori'] = $this->input->post('kategori');
					$title = $this->input->post('nama');
					$title = strtolower($title);
					$date = date("Y/m/d");
					$newtitle = string_limit_words($title, 15);
					$urltitle = preg_replace('/[^a-z0-9]/i', ' ', $newtitle);
					$newurltitle = str_replace(" ", "-", $newtitle);
					$karakter = array('{', '}', ')', '(', '|', '`', '~', '!', '@', '%', '$', '^', '&', '*', '=', '?', '+', '-', '/', '\\', ',', '.', '#', ':', ';', '\'', '"', '[', ']');
					$hapus_karakter_aneh = strtolower(str_replace($karakter, "", $title));
					$tambah_strip = strtolower(str_replace(' ', '-', $hapus_karakter_aneh));
					$link_akhir = $tambah_strip;

					$url = $link_akhir;
					$data2["permalink"] = $url;

					$this->Webadmin_model->Update_Content("tbl_penghargaan", $data2, "id_penghargaan");
					$this->session->set_flashdata('message', 'Data Tersimpan!');
					echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/penghargaan'>";
				}
			}
		}
	}


	function skpd()
	{
		$page = $this->uri->segment(3);
		$limit = 10;
		if (!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;
		$data = array();
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['h2_title'] = 'Polling';
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$tot_hal = $this->Webadmin_model->Total_Data("tbl_skpd");
			$config['base_url'] = base_url() . '/webadmin/skpd/';
			$config['total_rows'] = $tot_hal->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
			//config for bootstrap pagination class integration
			$config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination">';
			$config['full_tag_close'] = '</ul></nav></div>';
			$config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['num_tag_close'] = '</span></li>';
			$config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
			$config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
			$config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
			$config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['prev_tagl_close'] = '</span></li>';
			$config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['first_tagl_close'] = '</span></li>';
			$config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['last_tagl_close'] = '</span></li>';

			$this->pagination->initialize($config);
			$data["paginator"] = $this->pagination->create_links();
			$data["page"] = $page;
			$data["detail"] = $this->Webadmin_model->Daftar_Skpd($offset, $limit);
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/skpd/skpd', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}

	function tambahskpd()
	{
		$data = array();
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['h2_title'] = 'Tambah Soal Polling';
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/skpd/tambah_skpd', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}


	function simpanskpd()
	{
		$page = $this->uri->segment(3);
		$limit = 10;
		if (!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;

		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {

			$data2['skpd'] = $this->input->post('soal');
			$this->form_validation->set_rules('soal', 'Nama SPKD/OPD', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
				$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
				$data['instansi'] = $this->config->item('nama_instansi');
				$data['credit'] = $this->config->item('credit_aplikasi');
				$data['alamat'] = $this->config->item('alamat_instansi');
				$this->load->view('webadmin/bg_atas', $data);
				$this->load->view('webadmin/skpd/tambah_skpd', $data);
				$this->load->view('webadmin/bg_bawah');
			} else {
				$this->Webadmin_model->In_Polling("tbl_skpd", $data2);
				$this->session->set_flashdata('message', 'Data Tersimpan!');
				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/skpd'>";
			}
		}

	}
	function editskpd()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}
		$data = array();
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['h2_title'] = 'Ubah Soal Polling';
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');

			$tgl = "%d-%m-%Y";
			$time = time();
			$data["wkt_skr"] = mdate($tgl, $time);
			$data["detail"] = $this->Webadmin_model->Edit_Content("tbl_skpd", "id_skpd=" . $id . "");
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/skpd/edit_skpd', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function updateskpd()
	{
		$in = array();
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$in["id_skpd"] = $this->input->post('id');
			$in["skpd"] = $this->input->post('soal');
			$this->Webadmin_model->Update_Content("tbl_skpd", $in, "id_skpd");
			$this->session->set_flashdata('message', 'Data Tersimpan!');
			echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/skpd'>";
		}

	}
	function hapusskpd()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}
		$data = array();
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$this->Webadmin_model->Delete_Content($id, "id_skpd", "tbl_skpd");
			$this->session->set_flashdata('message', 'Data Terhapus!');
			?>
			<script type="text/javascript">
				javascript: history.go(-1);
			</script>
			<?php
		}

	}

	function pembantu()
	{
		$page = $this->uri->segment(3);
		$limit = 10;
		if (!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;
		$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$data['message'] = "Data Pengguna";
			$total = $this->Webadmin_model->Total_Data("user_pembantu");
			$config['base_url'] = base_url() . '/webadmin/pembantu/';
			$config['total_rows'] = $total->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
			//config for bootstrap pagination class integration
			$config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination">';
			$config['full_tag_close'] = '</ul></nav></div>';
			$config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['num_tag_close'] = '</span></li>';
			$config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
			$config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
			$config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
			$config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['prev_tagl_close'] = '</span></li>';
			$config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['first_tagl_close'] = '</span></li>';
			$config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['last_tagl_close'] = '</span></li>';
			$this->pagination->initialize($config);
			$data['paginator'] = $this->pagination->create_links();
			$data['daftarartikel'] = $this->Webadmin_model->Pembantu($offset, $limit);
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/pembantu/pembantu', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}

	function hapuspembantu()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$this->Webadmin_model->Delete_Content($id, "id_pembantu", "user_pembantu");
			$this->session->set_flashdata('message', 'Data Terhapus!');
			echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/pembantu'>";
		}

	}

	function tambahpembantu()
	{
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$data["kategori"] = $this->Webadmin_model->Semua_Skpd();
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/pembantu/tambah_pembantu', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function simpanpembantu()
	{
		$page = $this->uri->segment(3);
		$limit = 10;
		if (!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data2['nama'] = $this->input->post('nama');
			$data2['email'] = $this->input->post('isi');
			$data2['username'] = $this->input->post('username');
			$data2['id_skpd'] = $this->input->post('kategori');
			$data2['akses'] = $this->input->post('status');
			$data2['password'] = MD5($this->input->post('password') . $this->config->item("key_login"));

			$data2['fb'] = $this->input->post('fb');
			$data2['twitter'] = $this->input->post('tw');
			$data2['ig'] = $this->input->post('ig');
			$data2['gplus'] = $this->input->post('gp');
			$data2['yt'] = $this->input->post('yt');
			$data2['webiste'] = $this->input->post('web');
			$data2['alamat'] = $this->input->post('alamat');

			$data2['status'] = "administrator";
			$this->form_validation->set_rules('nama', 'Nama Lengkap', 'trim|required');
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
				$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
				$data['instansi'] = $this->config->item('nama_instansi');
				$data['credit'] = $this->config->item('credit_aplikasi');
				$data['alamat'] = $this->config->item('alamat_instansi');
				$data["kategori"] = $this->Webadmin_model->Semua_Skpd();
				$this->load->view('webadmin/bg_atas', $data);
				$this->load->view('webadmin/pembantu/tambah_pembantu', $data);
				$this->load->view('webadmin/bg_bawah');
			} else {

				$acak = rand(00000000000, 99999999999);
				$bersih = $_FILES['userfile']['name'];
				$nm = str_replace(" ", "_", "$bersih");
				$pisah = explode(".", $nm);
				$nama_murni = $pisah[0];
				$ubah = $acak . $nama_murni; //tanpa ekstensi
				$config["file_name"] = $ubah; //dengan eekstensi


				$config['upload_path'] = './asset/banner/';
				$config['allowed_types'] = 'gif|jpg|jpeg|png';
				$config['max_size'] = '500000';
				$config['max_width'] = '12000';
				$config['max_height'] = '12000';
				$this->load->library('upload', $config);

				if (!$this->upload->do_upload()) {
					echo $this->upload->display_errors();
				} else {
					$data2["gambar"] = $acak . $nm;
					$this->Webadmin_model->In_Polling("user_pembantu", $data2);
					$this->session->set_flashdata('message', 'Data Tersimpan!');
				}

				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/pembantu'>";
			}
		}

	}

	function editpembantu()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$data["kategori"] = $this->Webadmin_model->Semua_Skpd();
			$data["edit"] = $this->Webadmin_model->Edit_Content("user_pembantu", "id_pembantu=$id");
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/pembantu/edit_pembantu', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}


	function updatepembantu()
	{
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {





			$data2["id_pembantu"] = $this->input->post('id');
			$data2['nama'] = $this->input->post('nama');
			$data2['email'] = $this->input->post('alamatku');
			$data2['id_skpd'] = $this->input->post('kategori');
			$data2['username'] = $this->input->post('username');
			$data2['akses'] = $this->input->post('status');
			if ($this->input->post('password') != "") {
				$data2['password'] = MD5($this->input->post('password') . $this->config->item("key_login"));
			}
			$data2['status'] = "administrator";

			$data2['fb'] = $this->input->post('fb');
			$data2['twitter'] = $this->input->post('tw');
			$data2['ig'] = $this->input->post('ig');
			$data2['gplus'] = $this->input->post('gp');
			$data2['yt'] = $this->input->post('yt');
			$data2['webiste'] = $this->input->post('web');
			$data2['alamat'] = $this->input->post('alamat');
			if (empty($_FILES['userfile']['name'])) {
				$this->Webadmin_model->Update_Content("user_pembantu", $data2, "id_pembantu");
			} else {
				$acak = rand(00000000000, 99999999999);
				$bersih = $_FILES['userfile']['name'];
				$nm = str_replace(" ", "_", "$bersih");
				$pisah = explode(".", $nm);
				$nama_murni = $pisah[0];
				$ubah = $acak . $nama_murni; //tanpa ekstensi
				$config["file_name"] = $ubah; //dengan eekstensi

				$config['upload_path'] = './asset/banner/';
				$config['allowed_types'] = 'bmp|gif|jpg|jpeg|png';
				$config['max_size'] = '10000';
				$config['max_width'] = '10000';
				$config['max_height'] = '10000';
				$this->load->library('upload', $config);
				$data2["gambar"] = $acak . $nm;
				if (!$this->upload->do_upload()) {
					echo $this->upload->display_errors();
				} else {

					$this->Webadmin_model->Update_Content("user_pembantu", $data2, "id_pembantu");
				}
			}
			$this->session->set_flashdata('message', 'Data Tersimpan!');
			echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/pembantu'>";
		}

	}

	function permohonan()
	{
		$page = $this->uri->segment(3);
		$limit = 10;
		if (!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;

		$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$data['message'] = "Data Kritik & Saran";
			$total = $this->Webadmin_model->Total_Data_Kritik("tbl_pemohon", "N");
			$config['base_url'] = base_url() . '/webadmin/permohonan/';
			$config['total_rows'] = $total->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
			//config for bootstrap pagination class integration
			//config for bootstrap pagination class integration
			$config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination">';
			$config['full_tag_close'] = '</ul></nav></div>';
			$config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['num_tag_close'] = '</span></li>';
			$config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
			$config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
			$config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
			$config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['prev_tagl_close'] = '</span></li>';
			$config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['first_tagl_close'] = '</span></li>';
			$config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['last_tagl_close'] = '</span></li>';

			$this->pagination->initialize($config);
			$data['paginator'] = $this->pagination->create_links();
			$data['daftarartikel'] = $this->Webadmin_model->Permohonan($offset, $limit, 'N');
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/permohonan/permohonan', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}

	function permohonanpembantu()
	{
		$page = $this->uri->segment(3);
		$limit = 10;
		if (!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;

		$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$data['message'] = "Data Kritik & Saran";
			$total = $this->Webadmin_model->Total_Data_Kritik("tbl_pemohon", "DISPOSISI");
			$config['base_url'] = base_url() . '/webadmin/permohonanpembantu/';
			$config['total_rows'] = $total->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
			//config for bootstrap pagination class integration
			$config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination">';
			$config['full_tag_close'] = '</ul></nav></div>';
			$config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['num_tag_close'] = '</span></li>';
			$config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
			$config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
			$config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
			$config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['prev_tagl_close'] = '</span></li>';
			$config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['first_tagl_close'] = '</span></li>';
			$config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['last_tagl_close'] = '</span></li>';

			$this->pagination->initialize($config);
			$data['paginator'] = $this->pagination->create_links();
			$data['daftarartikel'] = $this->Webadmin_model->Permohonan($offset, $limit, 'DISPOSISI');
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/permohonan/permohonanpembantu', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}

	function permohonanfinal()
	{
		$page = $this->uri->segment(3);
		$limit = 10;
		if (!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;

		$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$data['message'] = "Data Kritik & Saran";
			$total = $this->Webadmin_model->Total_Data_KritikFinal();
			$config['base_url'] = base_url() . '/webadmin/permohonanfinal/';
			$config['total_rows'] = $total->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
			//config for bootstrap pagination class integration
			$config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination">';
			$config['full_tag_close'] = '</ul></nav></div>';
			$config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['num_tag_close'] = '</span></li>';
			$config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
			$config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
			$config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
			$config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['prev_tagl_close'] = '</span></li>';
			$config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['first_tagl_close'] = '</span></li>';
			$config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['last_tagl_close'] = '</span></li>';

			$this->pagination->initialize($config);
			$data['paginator'] = $this->pagination->create_links();
			$data['daftarartikel'] = $this->Webadmin_model->PermohonanFinal($offset, $limit);
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/permohonan/permohonanfinal', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}

	function keberatan()
	{
		$page = $this->uri->segment(3);
		$limit = 10;
		if (!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;

		$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$data['message'] = "Data Kritik & Saran";
			$total = $this->Webadmin_model->Total_Data_KritikKeberatan();
			$config['base_url'] = base_url() . '/webadmin/keberatan/';
			$config['total_rows'] = $total->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
			//config for bootstrap pagination class integration
			$config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination">';
			$config['full_tag_close'] = '</ul></nav></div>';
			$config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['num_tag_close'] = '</span></li>';
			$config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
			$config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
			$config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
			$config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['prev_tagl_close'] = '</span></li>';
			$config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['first_tagl_close'] = '</span></li>';
			$config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['last_tagl_close'] = '</span></li>';

			$this->pagination->initialize($config);
			$data['paginator'] = $this->pagination->create_links();
			$data['daftarartikel'] = $this->Webadmin_model->Keberatan($offset, $limit);
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/keberatan/keberatan', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function keberatanfinal()
	{
		$page = $this->uri->segment(3);
		$limit = 10;
		if (!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;

		$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$data['message'] = "Data Kritik & Saran";
			$total = $this->Webadmin_model->Total_Data_Keberatan();
			$config['base_url'] = base_url() . '/webadmin/keberatanfinal/';
			$config['total_rows'] = $total->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
			//config for bootstrap pagination class integration
			$config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination">';
			$config['full_tag_close'] = '</ul></nav></div>';
			$config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['num_tag_close'] = '</span></li>';
			$config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
			$config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
			$config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
			$config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['prev_tagl_close'] = '</span></li>';
			$config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['first_tagl_close'] = '</span></li>';
			$config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['last_tagl_close'] = '</span></li>';

			$this->pagination->initialize($config);
			$data['paginator'] = $this->pagination->create_links();
			$data['daftarartikel'] = $this->Webadmin_model->KeberatanFInal($offset, $limit);
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/keberatan/keberatanfinal', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	public function faq()
	{
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$page = $this->uri->segment(3);
			$limit = $this->config->item('limit_data');
			if (!$page):
				$offset = 0;
			else:
				$offset = $page;
			endif;
			$data['tot'] = $offset;
			$tot_hal = $this->db->query("SELECT tbl_faq.id_faq, 
	tbl_faq.pertanyaan, 
	tbl_faq.jawaban
FROM tbl_faq
");
			$config['base_url'] = base_url() . 'faq/index/';
			$config['total_rows'] = $tot_hal->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
			//config for bootstrap pagination class integration
			$config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination">';
			$config['full_tag_close'] = '</ul></nav></div>';
			$config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['num_tag_close'] = '</span></li>';
			$config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
			$config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
			$config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
			$config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['prev_tagl_close'] = '</span></li>';
			$config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['first_tagl_close'] = '</span></li>';
			$config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['last_tagl_close'] = '</span></li>';
			$this->pagination->initialize($config);
			$data["paginator"] = $this->pagination->create_links();
			$data['status_pegawai'] = $this->db->query("SELECT tbl_faq.id_faq, 
	tbl_faq.pertanyaan, 
	tbl_faq.jawaban
FROM tbl_faq
order by tbl_faq.id_faq ASC");
			$data['semua'] = $config['total_rows'];
			$data['label'] = "Kategori";
			$data['bread'] = "Master Data";
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/faq/list', $data);
			$this->load->view('webadmin/bg_bawah', $data);
		}

	}

	public function tambahfaq()
	{
		$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
		$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
		$data['instansi'] = $this->config->item('nama_instansi');
		$data['credit'] = $this->config->item('credit_aplikasi');
		$data['alamat'] = $this->config->item('alamat_instansi');
		$data['akses'] = $this->session->userdata('akses');
		if ($this->session->userdata('logged_in') != "") {
			$data['id_param'] = "";
			$data['nama'] = "";
			$data['isi'] = "";
			$data['st'] = "tambah";
			$data['label'] = "Cabang Aktif";
			$data['bread'] = "Tambah/Ubah Data";
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');

			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/faq/input', $data);
			$this->load->view('webadmin/bg_bawah', $data);
		} else {
			header('location:' . base_url() . ''); exit;
		}
	}

	public function hapusfaq()
	{
		$data['akses'] = $this->session->userdata('akses');
		if ($this->session->userdata('logged_in') != "") {
			$id['id_faq'] = $this->uri->segment(3);
			$this->db->delete("tbl_faq", $id);
			$this->session->set_flashdata('message', 'Data Sudah Terhapus.');
			header('location:' . base_url() . 'webadmin/faq'); exit;
		} else {
			header('location:' . base_url() . ''); exit;
		}
	}

	public function editfaq()
	{
		$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
		$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
		$data['instansi'] = $this->config->item('nama_instansi');
		$data['credit'] = $this->config->item('credit_aplikasi');
		$data['alamat'] = $this->config->item('alamat_instansi');
		$data['akses'] = $this->session->userdata('akses');
		if ($this->session->userdata('logged_in') != "") {
			$id['id_faq'] = $this->uri->segment(3);
			$q = $this->db->get_where("tbl_faq", $id);
			$d = array();
			foreach ($q->result() as $dt) {
				$data['id_param'] = $dt->id_faq;
				$data['nama'] = $dt->pertanyaan;
				$data['isi'] = $dt->jawaban;
			}
			$data['label'] = "kecamatan Aktif";
			$data['bread'] = "Tambah/Ubah Data";
			$data['st'] = "edit";
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/faq/input', $data);
			$this->load->view('webadmin/bg_bawah', $data);
		} else {
			header('location:' . base_url() . ''); exit;
		}
	}



	function tambahpermohonan()
	{
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$data["kategori"] = $this->Webadmin_model->Semua_Skpd();
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/permohonan/tambah_permohonan', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function tambahpermohonanbantu()
	{
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$data["kategori"] = $this->Webadmin_model->Semua_Skpd();
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/permohonan/tambah_permohonanbantu', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function tambahkeberatan()
	{
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$data["kategori"] = $this->Webadmin_model->Semua_Skpd();
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/keberatan/tambah_keberatan', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}

	function simpanpermohonan()
	{
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {

			//Proses Simpan
			$this->load->library('form_validation');
			$this->form_validation->set_rules('nama_lengkap', 'Nama', 'required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
			if (empty($_FILES['userfile']['name'])) {
				$this->form_validation->set_rules('userfile', 'Document', 'required');
			}

			$tgl = " %Y-%m-%d";
			$jam = "%h:%i:%a";
			$time = time();
			if ($this->form_validation->run() == FALSE) {
				?>
				<script type="text/javascript">
					alert("Inputan tidak Valid!!! Ulangi lagi.");			
				</script>
				<?php
				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/tambahpermohonan'>";
			} else {
				$datainput['nik'] = $this->input->post('nik_no_ktp');
				$datainput['nama'] = $this->input->post('nama_lengkap');
				$datainput['email'] = $this->input->post('email');
				$datainput['rincian'] = $this->input->post('rincian_informasi');
				$datainput['alamat'] = $this->input->post('alamat');
				$datainput['phone'] = $this->input->post('no_telepon');
				$datainput['pekerjaan'] = $this->input->post('pekerjaan');
				$datainput['posted_date'] = mdate($tgl, $time);

				$datainput['tujuan'] = $this->input->post('tujuan');
				$datainput['id_skpd'] = $this->input->post('kategori2');
				$datainput['cara'] = $this->input->post('cara_memperoleh');
				$datainput['salinan'] = $this->input->post('mendapatkan_salinan');
				$datainput['cara2'] = $this->input->post('cara_mendapatkan');
				$datainput['cara3'] = $this->input->post('cara_mendapatkan2');
				$datainput['jenis'] = $this->input->post('katku');
				$datainput['register'] = $this->input->post('register');

				$acak = rand(00000000000, 99999999999);
				$bersih = $_FILES['userfile']['name'];
				$nm = str_replace(" ", "_", "$bersih");
				$pisah = explode(".", $nm);
				$nama_murni = $pisah[0];
				$ubah = $acak . $nama_murni;
				$config["file_name"] = $ubah;
				$in = $acak . $nm;
				$config['upload_path'] = './media/ktp/';
				$config['allowed_types'] = 'gif|jpg|jpeg|png';
				$config['max_size'] = '1000000000';
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload()) {
					echo $this->upload->display_errors();
				} else {
					$datainput["foto"] = $in;
					$this->News_model->Simpan_Pemohon($datainput);
					?>
					<script type="text/javascript">
						alert("Data Sudah Tersimpan");			
					</script>
					<?php
					echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/tambahpermohonan'>";

				}

			}
		}
	}

	function simpankebaratan()
	{
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {

			//Proses Simpan
			$this->load->library('form_validation');
			$this->form_validation->set_rules('nama_lengkap', 'Nama', 'required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
			if (empty($_FILES['userfile']['name'])) {
				$this->form_validation->set_rules('userfile', 'Document', 'required');
			}

			$tgl = " %Y-%m-%d";
			$jam = "%h:%i:%a";
			$time = time();
			if ($this->form_validation->run() == FALSE) {
				?>
				<script type="text/javascript">
					alert("Inputan tidak Valid!!! Ulangi lagi.");			
				</script>
				<?php
				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/tambahkeberatan'>";
			} else {
				$datainput['nik'] = $this->input->post('nik_no_ktp');
				$datainput['nama'] = $this->input->post('nama_lengkap');
				$datainput['email'] = $this->input->post('email');
				$datainput['rincian'] = $this->input->post('rincian_informasi');
				$datainput['alamat'] = $this->input->post('alamat');
				$datainput['alasan'] = $this->input->post('cara_mendapatkan');
				$datainput['phone'] = $this->input->post('no_telepon');
				$datainput['pekerjaan'] = $this->input->post('pekerjaan');
				$datainput['posted_date'] = mdate($tgl, $time);
				$datainput['register'] = $this->input->post('register');
				$datainput['tujuan'] = $this->input->post('tujuan');
				$datainput['alasan'] = $this->input->post('cara_mendapatkan');
				$datainput['id_skpd'] = $this->input->post('kategori2');

				$acak = rand(00000000000, 99999999999);
				$bersih = $_FILES['userfile']['name'];
				$nm = str_replace(" ", "_", "$bersih");
				$pisah = explode(".", $nm);
				$nama_murni = $pisah[0];
				$ubah = $acak . $nama_murni;
				$config["file_name"] = $ubah;
				$in = $acak . $nm;
				$config['upload_path'] = './media/ktp/';
				$config['allowed_types'] = 'gif|jpg|jpeg|png';
				$config['max_size'] = '1000000000';
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload()) {
					echo $this->upload->display_errors();
				} else {
					$datainput["foto"] = $in;
					$this->News_model->Simpan_Keberatan($datainput);
					?>
					<script type="text/javascript">
						alert("Data Sudah Tersimpan");			
					</script>
					<?php
					echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/tambahkeberatan'>";

				}

			}
		}
	}

	function editpermohonan()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$data["kategori"] = $this->Webadmin_model->Semua_Skpd();
			$data["edit"] = $this->Webadmin_model->Edit_Content("tbl_pemohon", "id_pemohon=$id");
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/permohonan/edit_permohonan', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}

	function updatepermohonan()
	{
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {

			//Proses Simpan
			$this->load->library('form_validation');
			$this->form_validation->set_rules('nama_lengkap', 'Nama', 'required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

			$tgl = " %Y-%m-%d";
			$jam = "%h:%i:%a";
			$time = time();
			if ($this->form_validation->run() == FALSE) {
				?>
				<script type="text/javascript">
					alert("Inputan tidak Valid!!! Ulangi lagi.");			
				</script>
				<?php
				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/permohonan'>";
			} else {
				$datainput['id_pemohon'] = $this->input->post('id');
				$datainput['nik'] = $this->input->post('nik_no_ktp');
				$datainput['nama'] = $this->input->post('nama_lengkap');
				$datainput['email'] = $this->input->post('email');
				$datainput['rincian'] = $this->input->post('rincian_informasi');
				$datainput['alamat'] = $this->input->post('alamat');
				$datainput['phone'] = $this->input->post('no_telepon');
				$datainput['pekerjaan'] = $this->input->post('pekerjaan');
				$datainput['posted_date'] = mdate($tgl, $time);
				$datainput['register'] = $this->input->post('register');
				$datainput['tujuan'] = $this->input->post('tujuan');
				$datainput['id_skpd'] = $this->input->post('kategori');
				$datainput['cara'] = $this->input->post('cara_memperoleh');
				$datainput['salinan'] = $this->input->post('mendapatkan_salinan');
				$datainput['cara2'] = $this->input->post('cara_mendapatkan');
				$datainput['cara3'] = $this->input->post('cara_mendapatkan2');
				$datainput['jenis'] = $this->input->post('katku');
				if (empty($_FILES['userfile']['name'])) {
					$this->Webadmin_model->Update_Content("tbl_pemohon", $datainput, "id_pemohon");
				} else {
					$acak = rand(00000000000, 99999999999);
					$bersih = $_FILES['userfile']['name'];
					$nm = str_replace(" ", "_", "$bersih");
					$pisah = explode(".", $nm);
					$nama_murni = $pisah[0];
					$ubah = $acak . $nama_murni;
					$config["file_name"] = $ubah;
					$in = $acak . $nm;
					$config['upload_path'] = './media/ktp/';
					$config['allowed_types'] = 'gif|jpg|jpeg|png';
					$config['max_size'] = '1000000000';
					$this->load->library('upload', $config);
					if (!$this->upload->do_upload()) {
						echo $this->upload->display_errors();
					} else {
						$datainput["foto"] = $in;
						//$this->News_model->Simpan_Pemohon($datainput);
						$this->Webadmin_model->Update_Content("tbl_pemohon", $datainput, "id_pemohon");
					}
					?>
					<script type="text/javascript">
						alert("Data Sudah Tersimpan");			
					</script>
					<?php


				}

				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/permohonan'>";

			}
		}
	}


	function editkeberatan()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$data["kategori"] = $this->Webadmin_model->Semua_Skpd();
			$data["edit"] = $this->Webadmin_model->Edit_Content("tbl_keberatan", "id_keberatan=$id");
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/keberatan/edit_keberatan', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}


	function updatekeberatan()
	{
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {

			//Proses Simpan
			$this->load->library('form_validation');
			$this->form_validation->set_rules('nama_lengkap', 'Nama', 'required');

			$tgl = " %Y-%m-%d";
			$jam = "%h:%i:%a";
			$time = time();
			if ($this->form_validation->run() == FALSE) {
				?>
				<script type="text/javascript">
					alert("Inputan tidak Valid!!! Ulangi lagi.");			
				</script>
				<?php
				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/keberatan'>";
			} else {
				$datainput['id_keberatan'] = $this->input->post('id');
				$datainput['nik'] = $this->input->post('nik_no_ktp');
				$datainput['nama'] = $this->input->post('nama_lengkap');
				$datainput['email'] = $this->input->post('email');
				$datainput['rincian'] = $this->input->post('rincian_informasi');
				$datainput['alamat'] = $this->input->post('alamat');
				$datainput['alasan'] = $this->input->post('cara_mendapatkan');
				$datainput['phone'] = $this->input->post('no_telepon');
				$datainput['pekerjaan'] = $this->input->post('pekerjaan');
				$datainput['posted_date'] = mdate($tgl, $time);
				$datainput['id_skpd'] = $this->input->post('kategori');
				$datainput['tujuan'] = $this->input->post('tujuan');
				$datainput['alasan'] = $this->input->post('cara_mendapatkan');
				$datainput['register'] = $this->input->post('register');
				if (empty($_FILES['userfile']['name'])) {
					$this->Webadmin_model->Update_Content("tbl_keberatan", $datainput, "id_keberatan");
				} else {
					$acak = rand(00000000000, 99999999999);
					$bersih = $_FILES['userfile']['name'];
					$nm = str_replace(" ", "_", "$bersih");
					$pisah = explode(".", $nm);
					$nama_murni = $pisah[0];
					$ubah = $acak . $nama_murni;
					$config["file_name"] = $ubah;
					$in = $acak . $nm;
					$config['upload_path'] = './media/ktp/';
					$config['allowed_types'] = 'gif|jpg|jpeg|png';
					$config['max_size'] = '1000000000';
					$this->load->library('upload', $config);
					if (!$this->upload->do_upload()) {
						echo $this->upload->display_errors();
					} else {
						$datainput["foto"] = $in;
						$this->Webadmin_model->Update_Content("tbl_keberatan", $datainput, "id_keberatan");
					}
				}
				?>
				<script type="text/javascript">
					alert("Data Sudah Tersimpan");			
				</script>
				<?php

				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/keberatan'>";



			}
		}
	}

	function prosespermohonan()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$data["kategori"] = $this->Webadmin_model->Semua_Jk();

			$data["dok"] = $this->db->query("SELECT tbl_kelengkapan.id_kelengkapan, 
	tbl_kelengkapan.id_pemohon, 
	tbl_kelengkapan.id_jk, 
	tbl_kelengkapan.berkas, 
	tbl_jk.jk
FROM tbl_kelengkapan left join tbl_jk on tbl_jk.id_jk=tbl_kelengkapan.id_jk WHERE 
tbl_kelengkapan.id_pemohon='$id' order by tbl_kelengkapan.id_kelengkapan ASC");

			$data["edit"] = $this->db->query("SELECT
tbl_pemohon.id_pemohon,
tbl_pemohon.nik,
tbl_pemohon.email,
tbl_pemohon.nama,
tbl_pemohon.rincian,
tbl_pemohon.`status`,
tbl_pemohon.posted_date,
tbl_pemohon.alamat,
tbl_pemohon.phone,
tbl_pemohon.replay,
tbl_pemohon.foto,
tbl_pemohon.pekerjaan,
tbl_pemohon.tujuan,
tbl_pemohon.id_skpd,
tbl_pemohon.cara,
tbl_pemohon.salinan,
tbl_pemohon.cara2,
tbl_skpd.skpd,
tbl_jenis.jenis,
tbl_pemohon.download,
tbl_pemohon.pemenuhan,
tbl_pemohon.ket,
tbl_pemohon.status2,
tbl_pemohon.register
FROM
tbl_pemohon
LEFT JOIN tbl_skpd ON tbl_skpd.id_skpd = tbl_pemohon.id_skpd LEFT JOIN
tbl_jenis on tbl_jenis.permalink=tbl_pemohon.jenis
 where tbl_pemohon.id_pemohon='$id'");

			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/permohonan/proses_permohonan', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}



	function updatefinal()
	{
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {


			$datainput['id_pemohon'] = $this->input->post('id');
			$datainput['status'] = $this->input->post('kategori');
			$datainput['ket'] = $this->input->post('rincian_informasi2');
			$datainput['register'] = $this->input->post('register');
			$datainput['download'] = $this->input->post('rincian_informasi');
			$datainput['pemenuhan'] = $date = date("Y-m-d");
			$idx = $this->input->post('id');
			$this->Webadmin_model->Update_Content("tbl_pemohon", $datainput, "id_pemohon");
			echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/prosespermohonan/$idx'>";

		}

	}

	function updatefinalberkas()
	{
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$tgl = " %Y-%m-%d";
			$jam = "%h:%i:%a";
			$time = time();

			$in["id_pemohon"] = $this->input->post('id');
			$in["id_jk"] = $this->input->post('kategori');

			$acak = rand(00000000000, 99999999999);
			$bersih = $_FILES['userfile']['name'];
			$nm = str_replace(" ", "_", "$bersih");
			$pisah = explode(".", $nm);
			$nama_murni = $pisah[0];
			$ubah = $acak . $nama_murni; //tanpa ekstensi
			$config["file_name"] = $ubah; //dengan eekstensi
			$in["berkas"] = $acak . $nm;

			$config['upload_path'] = './media/ktp/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png|pdf';
			$config['max_size'] = '500000';
			$config['max_width'] = '12000';
			$config['max_height'] = '12000';
			$this->load->library('upload', $config);
			$idx = $this->input->post('id');

			if (!$this->upload->do_upload()) {
				echo $this->upload->display_errors();
			} else {
				$this->session->set_flashdata('message', 'Data Tersimpan!');
				$this->Webadmin_model->In_Polling("tbl_kelengkapan", $in);
				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/prosespermohonan/$idx'>";
			}

		}

	}

	function hapusdokumenku()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}
		//$data["page"] = $page;
		$idx = $this->uri->segment(4);
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$this->session->set_flashdata('message', 'Data Terhapus!');
			$this->Webadmin_model->Delete_Content($id, "id_kelengkapan", "tbl_kelengkapan");
			echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/prosespermohonan/$idx'>";
		}

	}

	function proseskeberatan()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$data["kategori"] = $this->Webadmin_model->Semua_Jk2();

			$data["dok"] = $this->db->query("SELECT tbl_kelengkapanberat.id_kelengkapanberat, 
	tbl_kelengkapanberat.id_keberatan, 
	tbl_kelengkapanberat.id_jk, 
	tbl_jk.jk, 
	tbl_kelengkapanberat.berkas
FROM tbl_kelengkapanberat LEFT OUTER JOIN tbl_jk ON tbl_jk.id_jk = tbl_kelengkapanberat.id_jk
WHERE tbl_kelengkapanberat.id_keberatan='$id'
ORDER BY tbl_kelengkapanberat.id_kelengkapanberat ASC");

			$data["edit"] = $this->Webadmin_model->Edit_Content("tbl_keberatan", "id_keberatan=$id");
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/keberatan/proses_keberatan', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}

	function updatefinalberat()
	{
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {


			$datainput['id_keberatan'] = $this->input->post('id');
			$datainput['status'] = $this->input->post('kategori');
			$datainput['ket'] = $this->input->post('rincian_informasi2');
			$datainput['register'] = $this->input->post('register');
			$datainput['pemenuhan'] = $date = date("Y-m-d");
			$idx = $this->input->post('id');
			$this->Webadmin_model->Update_Content("tbl_keberatan", $datainput, "id_keberatan");
			echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/proseskeberatan/$idx'>";

		}

	}

	function updatefinalberkasberat()
	{
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$tgl = " %Y-%m-%d";
			$jam = "%h:%i:%a";
			$time = time();

			$in["id_keberatan"] = $this->input->post('id');
			$in["id_jk"] = $this->input->post('kategori');

			$acak = rand(00000000000, 99999999999);
			$bersih = $_FILES['userfile']['name'];
			$nm = str_replace(" ", "_", "$bersih");
			$pisah = explode(".", $nm);
			$nama_murni = $pisah[0];
			$ubah = $acak . $nama_murni; //tanpa ekstensi
			$config["file_name"] = $ubah; //dengan eekstensi
			$in["berkas"] = $acak . $nm;

			$config['upload_path'] = './media/ktp/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png|pdf';
			$config['max_size'] = '500000';
			$config['max_width'] = '12000';
			$config['max_height'] = '12000';
			$this->load->library('upload', $config);
			$idx = $this->input->post('id');

			if (!$this->upload->do_upload()) {
				echo $this->upload->display_errors();
			} else {
				$this->session->set_flashdata('message', 'Data Tersimpan!');
				$this->Webadmin_model->In_Polling("tbl_kelengkapanberat", $in);
				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/proseskeberatan/$idx'>";
			}

		}

	}

	function hapusdokumenberat()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}
		//$data["page"] = $page;
		$idx = $this->uri->segment(4);
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$this->session->set_flashdata('message', 'Data Terhapus!');
			$this->Webadmin_model->Delete_Content($id, "id_kelengkapanberat", "tbl_kelengkapanberat");
			echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/proseskeberatan/$idx'>";
		}

	}

	public function hapuspermohonan()
	{
		$data['akses'] = $this->session->userdata('akses');
		if ($this->session->userdata('logged_in') != "") {
			$id['id_pemohon'] = $this->uri->segment(3);
			$this->db->delete("tbl_pemohon", $id);

			//Kelang

			$this->session->set_flashdata('message', 'Data Sudah Terhapus.');
			header('location:' . base_url() . 'webadmin/permohonan'); exit;
		} else {
			header('location:' . base_url() . ''); exit;
		}
	}

	public function publishpermohonan()
	{
		$data['akses'] = $this->session->userdata('akses');
		if ($this->session->userdata('logged_in') != "") {
			$datainput['id_pemohon'] = $this->uri->segment(3);
			$datainput['status2'] = "N";
			$this->Webadmin_model->Update_Content("tbl_pemohon", $datainput, "id_pemohon");
			header('location:' . base_url() . 'webadmin/permohonanfinal'); exit;
		} else {
			header('location:' . base_url() . ''); exit;
		}
	}

	public function cetakpermohonan()
	{
		// Sembunyikan error/warning PHP agar tidak mengganggu output PDF
		error_reporting(0);
		ini_set('display_errors', 0);

		$data['akses'] = $this->session->userdata('akses');
		if ($this->session->userdata('logged_in') != "") {
			$id_pemohon = $this->uri->segment(3);

			$data['status_pegawai'] = $this->db->query("SELECT
            tbl_pemohon.id_pemohon,
            tbl_pemohon.nik,
            tbl_pemohon.email,
            tbl_pemohon.nama,
            tbl_pemohon.rincian,
            tbl_pemohon.`status`,
            tbl_pemohon.posted_date,
            tbl_pemohon.alamat,
            tbl_pemohon.phone,
            tbl_pemohon.replay,
            tbl_pemohon.foto,
            tbl_pemohon.pekerjaan,
            tbl_pemohon.tujuan,
            tbl_pemohon.id_skpd,
            tbl_pemohon.cara,
            tbl_pemohon.salinan,
            tbl_pemohon.cara2,
            tbl_skpd.skpd,
            tbl_jenis.jenis,
            tbl_pemohon.download,
            tbl_pemohon.pemenuhan,
            tbl_pemohon.ket,
            tbl_pemohon.status2,
            tbl_pemohon.register
            FROM tbl_pemohon
            LEFT JOIN tbl_skpd ON tbl_skpd.id_skpd = tbl_pemohon.id_skpd 
            LEFT JOIN tbl_jenis ON tbl_jenis.permalink = tbl_pemohon.jenis
            WHERE tbl_pemohon.id_pemohon = '$id_pemohon'");

			$this->load->helper('pdf_helper');
			tcpdf();

			// Pastikan tidak ada output sebelum PDF dibuat
			if (ob_get_length())
				ob_clean();

			$obj_pdf = new \TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
			$obj_pdf->SetCreator(PDF_CREATOR);
			$title = "Cetak Permohonan";
			$obj_pdf->SetTitle($title);
			$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
			$obj_pdf->SetMargins('10', '5', '10');
			$obj_pdf->SetAutoPageBreak(TRUE, '12');
			$obj_pdf->SetFont('helvetica', '', 11);
			$obj_pdf->setFontSubsetting(false);
			$obj_pdf->AddPage();

			ob_start();
			$this->load->view('webadmin/permohonan/cetak', $data);
			$content = ob_get_clean();

			$obj_pdf->writeHTML($content, true, true, true, true, '');

			// Bersihkan buffer jika ada sebelum Output PDF dikirim
			while (ob_get_level()) {
				ob_end_clean();
			}

			$obj_pdf->Output('cetakpermohonan.pdf', 'I');
			exit;
		} else {
			redirect(''); // Menggunakan redirect CodeIgniter
		}
	}

	public function hapuskeberatan()
	{
		$data['akses'] = $this->session->userdata('akses');
		if ($this->session->userdata('logged_in') != "") {
			$id['id_keberatan'] = $this->uri->segment(3);
			$this->db->delete("tbl_keberatan", $id);
			$this->session->set_flashdata('message', 'Data Sudah Terhapus.');
			header('location:' . base_url() . 'webadmin/keberatan'); exit;
		} else {
			header('location:' . base_url() . ''); exit;
		}
	}

	public function cetakkeberatan()
	{
		$data['akses'] = $this->session->userdata('akses');
		if ($this->session->userdata('logged_in') != "") {

			$id_pemohon = $this->uri->segment(3);

			$data['status_pegawai'] = $this->db->query("SELECT tbl_keberatan.id_keberatan, 
	tbl_keberatan.nik, 
	tbl_keberatan.nama, 
	tbl_keberatan.email, 
	tbl_keberatan.rincian, 
	tbl_keberatan.`status`, 
	tbl_keberatan.posted_date, 
	tbl_keberatan.alamat, 
	tbl_keberatan.phone, 
	tbl_keberatan.register, 
	tbl_keberatan.replay, 
	tbl_keberatan.foto, 
	tbl_keberatan.pekerjaan, 
	tbl_keberatan.tujuan, 
	tbl_keberatan.alasan, 
	tbl_keberatan.pemenuhan, 
	tbl_keberatan.ket
FROM tbl_keberatan where tbl_keberatan.id_keberatan='$id_pemohon'
");

			$this->load->helper('pdf_helper');
			tcpdf();
			$obj_pdf = new \TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
			$obj_pdf->SetCreator(PDF_CREATOR);
			$title = "Cetak Keberatan";
			$obj_pdf->SetTitle($title);
			$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
			$obj_pdf->SetMargins('10', '5', '10');
			$obj_pdf->SetAutoPageBreak(TRUE, '12');
			$obj_pdf->SetFont('helvetica', '', 11);
			$obj_pdf->setFontSubsetting(false);
			$obj_pdf->AddPage();
			ob_start();

			$this->load->view('webadmin/keberatan/cetak', $data);

			$content = ob_get_contents();
			ob_end_clean();
			$obj_pdf->writeHTML($content, true, true, true, true, '');
			while (ob_get_level()) {
				ob_end_clean();
			}
			$obj_pdf->Output('cetakkeberatan.pdf', 'I');
			exit;
		} else {
			header('location:' . base_url() . ''); exit;
		}
	}

	function laporantahun()
	{

		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$data['message'] = "";

			$datestring = "Login : %d-%m-%Y pukul %h:%i %a";
			$time = time();
			$tgl = "%d-%m-%Y";
			$data["wkt_skr"] = mdate($tgl, $time);
			$data["tanggal"] = mdate($datestring, $time);

			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/laporan/tahun', $data);
			$this->load->view('webadmin/bg_bawah');
		}
	}

	function cetakpertahun()
	{
		$data["tahun"] = $this->input->post('thn_mulai');
		$data["kategori"] = $this->Webadmin_model->Semua_Skpd();
		$this->load->view('webadmin/laporan/cetaktahun', $data);




	}
	function laporanskpd()
	{

		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$data['message'] = "";


			$datestring = "Login : %d-%m-%Y pukul %h:%i %a";
			$time = time();
			$tgl = "%d-%m-%Y";
			$data["wkt_skr"] = mdate($tgl, $time);
			$data["tanggal"] = mdate($datestring, $time);
			$data["kategori2"] = $this->Webadmin_model->Semua_Skpd();

			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/laporan/skpd', $data);
			$this->load->view('webadmin/bg_bawah');
		}
	}
	function cetakpertahunskpd()
	{
		$data["tahun"] = $this->input->post('thn_mulai');
		$id = $this->input->post('kategori2');
		$data["skpd"] = $this->input->post('kategori2');
		$d = $this->News_model->Detail_Skpd($id);
		foreach ($d->result() as $soal) {
			$na = $soal->skpd;
			$data['bread'] = $na;
		}
		$this->load->view('webadmin/laporan/cetakskpd', $data);




	}
	function laporanbulan()
	{

		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$data['message'] = "";
			$datestring = "Login : %d-%m-%Y pukul %h:%i %a";
			$time = time();
			$tgl = "%d-%m-%Y";
			$data["wkt_skr"] = mdate($tgl, $time);
			$data["tanggal"] = mdate($datestring, $time);

			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/laporan/bulan', $data);
			$this->load->view('webadmin/bg_bawah');
		}
	}

	function cetakpertahunsbulan()
	{
		$data["tahun"] = $this->input->post('thn_mulai');
		$data["bulan"] = $this->input->post('bulan');
		$data["kategori"] = $this->Webadmin_model->Semua_Skpd();
		$this->load->view('webadmin/laporan/cetakbulan', $data);




	}

	function laporanpublik()
	{

		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$data['message'] = "";


			$datestring = "Login : %d-%m-%Y pukul %h:%i %a";
			$time = time();
			$tgl = "%d-%m-%Y";
			$data["wkt_skr"] = mdate($tgl, $time);
			$data["tanggal"] = mdate($datestring, $time);
			$data["kategori2"] = $this->Webadmin_model->Semua_Skpd();

			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/laporan/publik', $data);
			$this->load->view('webadmin/bg_bawah');
		}
	}
	function cetakpublik()
	{
		$data["tahun"] = $this->input->post('thn_mulai');
		$id = $this->input->post('kategori2');
		$data["skpd"] = $this->input->post('kategori2');


		if ($id == "semua") {
			$data["kategori"] = $this->Webadmin_model->Semua_Skpd_Counter();
			$this->load->view('webadmin/laporan/cetakpublik', $data);
		} else {
			$d = $this->News_model->Detail_Skpd($id);
			foreach ($d->result() as $soal) {
				$na = $soal->skpd;
				$data['bread'] = $na;
			}
			$data["kategori"] = $this->News_model->Detail_Skpd($id);
			$this->load->view('webadmin/laporan/cetakpublikskpd', $data);
		}



	}

	function laporankeberatan()
	{

		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$data['message'] = "";


			$datestring = "Login : %d-%m-%Y pukul %h:%i %a";
			$time = time();
			$tgl = "%d-%m-%Y";
			$data["wkt_skr"] = mdate($tgl, $time);
			$data["tanggal"] = mdate($datestring, $time);
			$data["kategori2"] = $this->Webadmin_model->Semua_Skpd();

			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/laporan/keberatan', $data);
			$this->load->view('webadmin/bg_bawah');
		}
	}
	function cetakkebaratanku()
	{
		$data["tahun"] = $this->input->post('thn_mulai');
		$id = $this->input->post('kategori2');
		$data["skpd"] = $this->input->post('kategori2');


		if ($id == "semua") {
			$data["kategori"] = $this->Webadmin_model->Semua_Skpd();
			$this->load->view('webadmin/laporan/cetakkeberatan', $data);
		} else {
			$d = $this->News_model->Detail_Skpd($id);
			foreach ($d->result() as $soal) {
				$na = $soal->skpd;
				$data['bread'] = $na;
			}
			$data["kategori"] = $this->News_model->Detail_Skpd($id);
			$this->load->view('webadmin/laporan/cetakkeberatanskpd', $data);
		}



	}
	function editkpt()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$data["kategori"] = $this->Webadmin_model->Semua_Jk();

			$data["dok"] = $this->db->query("SELECT
tbl_ktp.id_ktp,
tbl_ktp.id_pemohon,
tbl_ktp.gambar,
tbl_ktp.nik,
tbl_ktp.nama,
tbl_ktp.jk,
tbl_ktp.alamat
FROM
tbl_ktp

 WHERE 
tbl_ktp.id_pemohon='$id' order by tbl_ktp.id_ktp ASC");


			$data["edit"] = $this->db->query("SELECT
tbl_pemohon.id_pemohon,
tbl_pemohon.nik,
tbl_pemohon.email,
tbl_pemohon.nama,
tbl_pemohon.rincian,
tbl_pemohon.`status`,
tbl_pemohon.posted_date,
tbl_pemohon.alamat,
tbl_pemohon.phone,
tbl_pemohon.replay,
tbl_pemohon.foto,
tbl_pemohon.pekerjaan,
tbl_pemohon.tujuan,
tbl_pemohon.id_skpd,
tbl_pemohon.cara,
tbl_pemohon.salinan,
tbl_pemohon.cara2,
tbl_skpd.skpd,
tbl_jenis.jenis,
tbl_pemohon.download,
tbl_pemohon.pemenuhan,
tbl_pemohon.ket,
tbl_pemohon.status2,
tbl_pemohon.register
FROM
tbl_pemohon
LEFT JOIN tbl_skpd ON tbl_skpd.id_skpd = tbl_pemohon.id_skpd LEFT JOIN
tbl_jenis on tbl_jenis.permalink=tbl_pemohon.jenis
 where tbl_pemohon.id_pemohon='$id'");

			$data['nik'] = "";
			$data['nama'] = "";
			$data['jk'] = "";
			$data['alamat'] = "";
			$data['st'] = "tambah";

			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/permohonan/proses_ktp', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function hapusktp()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}
		//$data["page"] = $page;
		$idx = $this->uri->segment(4);
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$this->session->set_flashdata('message', 'Data Terhapus!');
			$this->Webadmin_model->Delete_Content($id, "id_ktp", "tbl_ktp");
			echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/editkpt/$idx'>";
		}

	}



	function editktp()
	{
		$id = '';
		if ($this->uri->segment(4) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(4);
		}
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$data["kategori"] = $this->Webadmin_model->Semua_Jk();

			$data["dok"] = $this->db->query("SELECT
tbl_ktp.id_ktp,
tbl_ktp.id_pemohon,
tbl_ktp.gambar,
tbl_ktp.nik,
tbl_ktp.nama,
tbl_ktp.jk,
tbl_ktp.alamat
FROM
tbl_ktp

 WHERE 
tbl_ktp.id_pemohon='$id' order by tbl_ktp.id_ktp ASC");


			$data["edit"] = $this->db->query("SELECT
tbl_pemohon.id_pemohon,
tbl_pemohon.nik,
tbl_pemohon.email,
tbl_pemohon.nama,
tbl_pemohon.rincian,
tbl_pemohon.`status`,
tbl_pemohon.posted_date,
tbl_pemohon.alamat,
tbl_pemohon.phone,
tbl_pemohon.replay,
tbl_pemohon.foto,
tbl_pemohon.pekerjaan,
tbl_pemohon.tujuan,
tbl_pemohon.id_skpd,
tbl_pemohon.cara,
tbl_pemohon.salinan,
tbl_pemohon.cara2,
tbl_skpd.skpd,
tbl_jenis.jenis,
tbl_pemohon.download,
tbl_pemohon.pemenuhan,
tbl_pemohon.ket,
tbl_pemohon.status2,
tbl_pemohon.register
FROM
tbl_pemohon
LEFT JOIN tbl_skpd ON tbl_skpd.id_skpd = tbl_pemohon.id_skpd LEFT JOIN
tbl_jenis on tbl_jenis.permalink=tbl_pemohon.jenis
 where tbl_pemohon.id_pemohon='$id'");

			$id2 = $this->uri->segment(3);
			$dx = $this->db->query("SELECT
tbl_ktp.id_ktp,
tbl_ktp.id_pemohon,
tbl_ktp.gambar,
tbl_ktp.nik,
tbl_ktp.nama,
tbl_ktp.jk,
tbl_ktp.alamat
FROM
tbl_ktp

 WHERE 
tbl_ktp.id_ktp='$id2'");


			foreach ($dx->result_array() as $artikel) {
				$data['idm'] = $artikel['id_ktp'];
				$data['nik'] = $artikel['nik'];
				$data['nama'] = $artikel['nama'];
				$data['jk'] = $artikel['jk'];
				$data['gk'] = $artikel['gambar'];
				$data['alamat'] = $artikel['alamat'];
				$data['st'] = "tambah";
			}
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/permohonan/proses_ktp2', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}

	function updatefinalktp()
	{
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$tgl = " %Y-%m-%d";
			$jam = "%h:%i:%a";
			$time = time();

			$in["id_pemohon"] = $this->input->post('id');
			$in["nik"] = $this->input->post('nik_no_ktp');
			$in["nama"] = $this->input->post('nama_lengkap');
			$in["jk"] = $this->input->post('mendapatkan_salinan');
			$in["alamat"] = $this->input->post('alamat');

			$acak = rand(00000000000, 99999999999);
			$bersih = $_FILES['userfile']['name'];
			$nm = str_replace(" ", "_", "$bersih");
			$pisah = explode(".", $nm);
			$nama_murni = $pisah[0];
			$ubah = $acak . $nama_murni; //tanpa ekstensi
			$config["file_name"] = $ubah; //dengan eekstensi
			$in["gambar"] = $acak . $nm;

			$config['upload_path'] = './media/ktp/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png|pdf';
			$config['max_size'] = '500000';
			$config['max_width'] = '12000';
			$config['max_height'] = '12000';
			$this->load->library('upload', $config);
			$idx = $this->input->post('id');

			if (!$this->upload->do_upload()) {
				echo $this->upload->display_errors();
			} else {
				$this->session->set_flashdata('message', 'Data Tersimpan!');
				$this->Webadmin_model->In_Polling("tbl_ktp", $in);
				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/editkpt/$idx'>";
			}

		}

	}

	function updatefinalktp2()
	{
		$data2 = array();
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$idx = $this->input->post('id');
			$acak = rand(00000000000, 99999999999);
			$bersih = $_FILES['userfile']['name'];
			$nm = str_replace(" ", "_", "$bersih");
			$pisah = explode(".", $nm);
			$nama_murni = $pisah[0];
			$ubah = $acak . $nama_murni; //tanpa ekstensi
			$config["file_name"] = $ubah; //dengan eekstensi

			$config['upload_path'] = './media/ktp/';
			$config['allowed_types'] = 'bmp|gif|jpg|jpeg|png';
			$config['max_size'] = '10000';
			$config['max_width'] = '10000';
			$config['max_height'] = '10000';
			$this->load->library('upload', $config);
			if (empty($_FILES['userfile']['name'])) {

				$in["id_ktp"] = $this->input->post('idm');
				$in["nik"] = $this->input->post('nik_no_ktp');
				$in["nama"] = $this->input->post('nama_lengkap');
				$in["jk"] = $this->input->post('mendapatkan_salinan');
				$in["alamat"] = $this->input->post('alamat');

				$this->Webadmin_model->Update_Content("tbl_ktp", $in, "id_ktp");
				$this->session->set_flashdata('message', 'Data Tersimpan!');
				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/editkpt/$idx'>";
			} else {
				if (!$this->upload->do_upload()) {
					echo $this->upload->display_errors();
				} else {

					$in["id_ktp"] = $this->input->post('idm');
					$in["nik"] = $this->input->post('nik_no_ktp');
					$in["nama"] = $this->input->post('nama_lengkap');
					$in["jk"] = $this->input->post('mendapatkan_salinan');
					$in["alamat"] = $this->input->post('alamat');
					$in["gambar"] = $acak . $nm;

					$this->Webadmin_model->Update_Content("tbl_ktp", $in, "id_ktp");
					echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/editkpt/$idx'>";
				}
			}
		}

	}

	function survey()
	{
		$page = $this->uri->segment(3);
		$limit = 10;
		if (!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;

		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		$data["page"] = $page;
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$data['message'] = "Data Kritik & Saran";
			$total = $this->Webadmin_model->Total_Data("tbl_pengirim");
			$config['base_url'] = base_url() . '/webadmin/survey/';
			$config['total_rows'] = $total->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
			//config for bootstrap pagination class integration
			$config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination">';
			$config['full_tag_close'] = '</ul></nav></div>';
			$config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['num_tag_close'] = '</span></li>';
			$config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
			$config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
			$config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
			$config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['prev_tagl_close'] = '</span></li>';
			$config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['first_tagl_close'] = '</span></li>';
			$config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['last_tagl_close'] = '</span></li>';

			$this->pagination->initialize($config);
			$data['paginator'] = $this->pagination->create_links();
			$data['daftarartikel'] = $this->Webadmin_model->Pengirim($offset, $limit);
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/survey/survey', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}

	function hapuspengirim()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$this->Webadmin_model->Delete_Content($id, "id_pengirim", "tbl_pengirim");
			$this->session->set_flashdata('message', 'Data Terhapus!');
			echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/survey'>";
		}

	}
	function transparansi()
	{
		$page = $this->uri->segment(3);
		$limit = 15;
		if (!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;
		$datestring = "Login : %d-%m-%Y pukul %h:%i %a";
		$time = time();
		$data["tanggal"] = mdate($datestring, $time);
		$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['h2_title'] = 'Master Download';
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$total = $this->Webadmin_model->Total_Data("tbl_transparansi");
			$config['base_url'] = base_url() . '/webadmin/transparansi/';
			$config['total_rows'] = $total->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
			//config for bootstrap pagination class integration
			$config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination">';
			$config['full_tag_close'] = '</ul></nav></div>';
			$config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['num_tag_close'] = '</span></li>';
			$config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
			$config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
			$config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
			$config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['prev_tagl_close'] = '</span></li>';
			$config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['first_tagl_close'] = '</span></li>';
			$config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['last_tagl_close'] = '</span></li>';

			$this->pagination->initialize($config);
			$data['paginator'] = $this->pagination->create_links();
			$data['daftarartikel'] = $this->Webadmin_model->Transparansi($offset, $limit);
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/transparansi/transparansi', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function hapustransparansi()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);
		}
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$this->Webadmin_model->Delete_Content($id, "id_transparansi", "tbl_transparansi");
			$this->session->set_flashdata('message', 'Data Terhapus!');
			echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/transparansi'>";
		}

	}
	function tambahtransparansi()
	{
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['h2_title'] = 'Tambah download';
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$data["kategori"] = $this->Webadmin_model->Semua_Menutype();
			$data["kategori2"] = $this->Webadmin_model->Semua_Jenis();
			$data["tahun"] = $this->Webadmin_model->Semua_Tahun();
			$data["skpd"] = $this->Webadmin_model->Semua_Skpd();
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/transparansi/tambah_transparansi', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function simpantransparansi()
	{
		$data = array();
		$data2 = array();
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$tgl = " %Y-%m-%d";
			$jam = "%h:%i:%a";
			$time = time();
			$data2["judul"] = $this->input->post('judul');
			$data2["id_jenistransparansi"] = $this->input->post('kategori2');
			$data2['id_tahun'] = $this->input->post('tahun');
			$data2["tanggal"] = mdate($tgl, $time);
			$data2["counter"] = "1";
			$data2["id_skpd"] = $this->input->post('id_skpd');

			$this->form_validation->set_rules('judul', 'Judul Transparansi', 'trim|required');
			//$this->form_validation->set_rules('kategori', 'type Download', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data['h2_title'] = 'Tambah download';
				$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
				$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
				$data['instansi'] = $this->config->item('nama_instansi');
				$data['credit'] = $this->config->item('credit_aplikasi');
				$data['alamat'] = $this->config->item('alamat_instansi');
				$data["kategori"] = $this->Webadmin_model->Semua_Menutype();
				$data["kategori2"] = $this->Webadmin_model->Semua_Jenis();
				$data["tahun"] = $this->Webadmin_model->Semua_Tahun();
				$this->load->view('webadmin/bg_atas', $data);
				$this->load->view('webadmin/transparansi/tambah_transparansi', $data);
				$this->load->view('webadmin/bg_bawah');
			} else {
				//Update Counter
				//End
				$acak = rand(00000000000, 99999999999);
				$bersih = $_FILES['userfile']['name'];
				$nm = str_replace(" ", "_", "$bersih");
				$pisah = explode(".", $nm);
				$nama_murni = $pisah[0];
				$ubah = $acak . $nama_murni;
				$config["file_name"] = $ubah;
				$in = $acak . $nm;
				$config['upload_path'] = './media/file/';
				$config['allowed_types'] = 'pdf|gif|jpg|jpeg|png';
				$config['max_size'] = '1000000000';
				$this->load->library('upload', $config);

				if (empty($_FILES['userfile']['name'])) {
					$data2["file"] = "welcome.jpg";
					$this->Webadmin_model->Simpan_Artikel2("tbl_transparansi", $data2);
					$this->session->set_flashdata('message', 'Data Tersimpan!');
					echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/transparansi'>";
				} else {
					if (!$this->upload->do_upload()) {
						echo $this->upload->display_errors();
					} else {
						$data2["file"] = $in;
						$this->Webadmin_model->Simpan_Artikel2("tbl_transparansi", $data2);
						$this->session->set_flashdata('message', 'Data Tersimpan!');
						echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/transparansi'>";
					}
				}
			}
		}

	}
	function edittransparansi()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);

		}
		$datestring = "Login : %d-%m-%Y pukul %h:%i %a";
		$time = time();
		$tgl = "%d-%m-%Y";
		$data["wkt_skr"] = mdate($tgl, $time);
		$data["tanggal"] = mdate($datestring, $time);
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['h2_title'] = 'Edit Download';
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$data["kategori"] = $this->Webadmin_model->Semua_Menutype();
			$data["kategori"] = $this->Webadmin_model->Semua_Menutype();
			$data["kategori2"] = $this->Webadmin_model->Semua_Jenis();
			$data["tahun"] = $this->Webadmin_model->Semua_Tahun();
			$data["skpd"] = $this->Webadmin_model->Semua_Skpd();
			$data['edit'] = $this->Webadmin_model->Edit_Content("tbl_transparansi", "id_transparansi=$id");
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/transparansi/edit_transparansi', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}
	function updatetransparansi()
	{
		$data2 = array();
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$acak = rand(00000000000, 99999999999);
			$bersih = $_FILES['userfile']['name'];
			$nm = str_replace(" ", "_", "$bersih");
			$pisah = explode(".", $nm);
			$nama_murni = $pisah[0];
			$ubah = $acak . $nama_murni;
			$config["file_name"] = $ubah;
			$in = $acak . $nm;
			$config['upload_path'] = './media/file/';
			$config['allowed_types'] = 'pdf|gif|jpg|jpeg|png';
			$config['max_size'] = '1000000000';
			$this->load->library('upload', $config);
			if (empty($_FILES['userfile']['name'])) {
				$data2["judul"] = $this->input->post('judul');
				$data2["id_jenistransparansi"] = $this->input->post('kategori2');
				$data2["id_skpd"] = $this->input->post('id_skpd');
				$data2['id_tahun'] = $this->input->post('tahun');
				$data2["id_transparansi"] = $this->input->post('id_berita');
				$this->Webadmin_model->Update_Content("tbl_transparansi", $data2, "id_transparansi");
				$this->session->set_flashdata('message', 'Data Tersimpan!');
				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/transparansi'>";
			} else {
				if (!$this->upload->do_upload()) {
					echo $this->upload->display_errors();
				} else {
					$data2["judul"] = $this->input->post('judul');
					$data2["id_jenistransparansi"] = $this->input->post('kategori2');
					$data2['id_tahun'] = $this->input->post('tahun');
					$data2["id_transparansi"] = $this->input->post('id_berita');
					$data2["id_skpd"] = $this->input->post('id_skpd');
					$data2["file"] = $in;
					$this->Webadmin_model->Update_Content("tbl_transparansi", $data2, "id_transparansi");
					$this->session->set_flashdata('message', 'Data Tersimpan!');
					echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "webadmin/transparansi'>";
				}
			}
		}

	}
	function tampilpengirim()
	{
		$id = '';
		if ($this->uri->segment(3) === FALSE) {
			$id = $id;
		} else {
			$id = $this->uri->segment(3);

		}
		$datestring = "Login : %d-%m-%Y pukul %h:%i %a";
		$time = time();
		$tgl = "%d-%m-%Y";
		$data["wkt_skr"] = mdate($tgl, $time);
		$data["tanggal"] = mdate($datestring, $time);
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['h2_title'] = 'Ubah Berita';
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$_SESSION['ses_kcfinder'] = array();
			$_SESSION['ses_kcfinder']['disabled'] = false;
			$_SESSION['ses_kcfinder']['uploadURL'] = "../content_upload";
			$data["kategori"] = $this->Webadmin_model->Semua_Menu8();
			$data['edit'] = $q = $this->db->query("SELECT
	tbl_pengirim.id_pengirim, 
	tbl_pengirim.nama_depan, 
	tbl_pengirim.nama_belakang, 
	tbl_pengirim.email, 
	tbl_pengirim.wa, 
	tbl_pengirim.id_pekerjaan, 
	tbl_pengirim.id_pelayanan, 
	tbl_pengirim.saran, 
	tbl_pengirim.id_survey, 
	tbl_pekerjaan.pekerjaan, 
	tbl_pelayanan.pelayanan
FROM
	tbl_pengirim LEFT JOIN
	tbl_pekerjaan on tbl_pekerjaan.id_pekerjaan=tbl_pengirim.id_pekerjaan LEFT JOIN
	tbl_pelayanan on tbl_pelayanan.id_pelayanan=tbl_pengirim.id_pelayanan where 
	tbl_pengirim.id_pengirim='$id'");
			$data["info2"] = $this->Webadmin_model->Semua_Pertanyaan($id);
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/survey/detail', $data);
			$this->load->view('webadmin/bg_bawah');
		}

	}

	function hasilsurvey()
	{
		$page = $this->uri->segment(3);
		$limit = 10;
		if (!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;

		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		$data["page"] = $page;
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {
			$data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
			$data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
			$data['instansi'] = $this->config->item('nama_instansi');
			$data['credit'] = $this->config->item('credit_aplikasi');
			$data['alamat'] = $this->config->item('alamat_instansi');
			$data['message'] = "Data Kritik & Saran";

			$data["info2"] = $this->Webadmin_model->Semua_Pertanyaan2();
			$this->load->view('webadmin/bg_atas', $data);
			$this->load->view('webadmin/survey/hasil', $data);
			$this->load->view('webadmin/bg_bawahhasil');
		}

	}



	function hapuslampiran()
	{
		$id = $this->uri->segment(3);
		$id2 = $this->uri->segment(4);

		$this->Webadmin_model->Delete_Content($id, "id_lampiran", "tbl_lampiran");
		$this->session->set_flashdata('message', 'Data Terhapus!');
		//echo "<meta http-equiv='refresh' content='0; url=".base_url()."webadmin/tambahfoto/'.$id2>";
		header('location:' . base_url() . 'webadmin/tambahlampiran/' . $id2); exit;

	}
	public function uploadlampiranbaru()
	{
		$cek = $this->session->userdata('logged_in');
		$data['akses'] = $this->session->userdata('akses');
		if (empty($cek)) {
			header('location:' . base_url() . 'webadmin/loginpage'); exit;
		} else {

			$kode = $this->input->post('id_param');
			//$storeFolder = getcwd() . '/asset/galeri/original/';

			$image_path = "/asset/lampiran/logo.png";
			$tempFile = $_FILES['file']['tmp_name'];
			$fileName = $_FILES['file']['name'];
			$targetPath = getcwd() . '/asset/lampiran/original/';
			$targetPath2 = getcwd() . '/asset/lampiran/thumb/';
			$targetFile = $targetPath . $fileName;
			list($txt, $ext) = explode(".", $fileName);
			$actual_image_name = time() . substr(str_replace(" ", "_", $txt), 5) . "." . $ext;
			$tmp = $_FILES['file']['tmp_name'];
			$pecah = explode(".", $fileName);
			$ekstensi = $pecah[1];
			$extensionList = array("pdf", "doc", "docx");
			if (in_array($ekstensi, $extensionList)) {
				if (move_uploaded_file($tempFile, $targetPath . $actual_image_name)) {
					$add = $targetPath . $actual_image_name; // the path with the file name where the file will be stored, upload is the directory 


					$data2['file'] = $actual_image_name;
					$data2['id_pengumuman'] = $kode;
					$this->Webadmin_model->In_Polling("tbl_lampiran", $data2);
				}
			}

		}

	}


}
?>