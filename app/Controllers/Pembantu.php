<?php

namespace App\Controllers;

use App\Core\CI_Controller;

#[\AllowDynamicProperties]
class Pembantu extends CI_Controller
{
    var $gallerypath;
    var $gallerypath_ori;
    
    function __construct()
    {
        parent::__construct();
        if (session_status() === PHP_SESSION_NONE) { session_start(); }
        $this->load->helper(array('form', 'url', 'text_helper', 'date'));
        $this->load->model('Profil_model');
        $this->load->model('Webadmin_model');
        $this->load->model('Anak_model');
        $this->load->model('Pendidikan_model');
        $this->load->model('Pekerjaanprofil_model');
    }
    
    function index()
    {
        $cek = $this->session->userdata('logged_in_ppid');
        $data['akses'] = $this->session->userdata('akses_ppid');
        if (empty($cek)) {
            redirect('web');
        } else {
            $ikx = $this->session->userdata('skpd_ppid');
            $data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
            $data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
            $data['instansi'] = $this->config->item('nama_instansi');
            $data['credit'] = $this->config->item('credit_aplikasi');
            $data['alamat'] = $this->config->item('alamat_instansi');
            $data['message'] = "";
            $data['permohonan'] = $this->Webadmin_model->Permohonan_Pembantu(0, 15, $ikx);
            $data['publik'] = $this->Webadmin_model->Download_Pembantu(0, 15, $ikx);
            
            $this->load->view('pembantu/bg_atas', $data);
            $this->load->view('pembantu/bg_home', $data);
            $this->load->view('pembantu/bg_bawah');
        }
    }

    function panduan()
    {
        $cek = $this->session->userdata('logged_in_ppid');
        $data['akses'] = $this->session->userdata('akses_ppid');
        if (empty($cek)) {
            redirect('web');
        } else {
            $ikx = $this->session->userdata('skpd_ppid');
            $data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
            $data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
            $data['instansi'] = $this->config->item('nama_instansi');
            $data['credit'] = $this->config->item('credit_aplikasi');
            $data['alamat'] = $this->config->item('alamat_instansi');
            $data['message'] = "";
            
            $data['testi2'] = $this->db->query("SELECT tbl_faq.id_faq, tbl_faq.pertanyaan, tbl_faq.jawaban FROM tbl_faq ORDER BY tbl_faq.id_faq ASC");

            $this->load->view('pembantu/bg_atas', $data);
            $this->load->view('pembantu/panduan', $data);
            $this->load->view('pembantu/bg_bawah');
        }
    }

    function download()
    {
        $ikx = $this->session->userdata('skpd_ppid');
        $page = $this->uri->segment(3);
        $limit = 500;
        $offset = !$page ? 0 : $page;
        
        $datestring = "Login : %d-%m-%Y pukul %h:%i %a";
        $time = time();
        $data["tanggal"] = mdate($datestring, $time);
        $data["page"] = $page;
        $cek = $this->session->userdata('logged_in_ppid');
        $data['akses_ppid'] = $this->session->userdata('akses_ppid');
        
        if (empty($cek)) {
            redirect('web');
        } else {
            $data['h2_title'] = 'Master Download';
            $data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
            $data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
            $data['instansi'] = $this->config->item('nama_instansi');
            $data['credit'] = $this->config->item('credit_aplikasi');
            $data['alamat'] = $this->config->item('alamat_instansi');
            
            $total = $this->Webadmin_model->Total_DataPembantu($ikx);
            
            $config['base_url'] = base_url() . 'pembantu/download/';
            $config['total_rows'] = $total->num_rows();
            $config['per_page'] = $limit;
            $config['uri_segment'] = 3;
            
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

            $this->load->library('pagination');
            $this->pagination->initialize($config);
            $data['paginator'] = $this->pagination->create_links();
            $data['daftarartikel'] = $this->Webadmin_model->Download_Pembantu($offset, $limit, $ikx);
            
            $this->load->view('pembantu/bg_atas', $data);
            $this->load->view('pembantu/download/download', $data);
            $this->load->view('pembantu/bg_bawah');
        }
    }

    function hapusdownload()
    {
        $id = $this->uri->segment(3) !== FALSE ? $this->uri->segment(3) : '';
        
        $cek = $this->session->userdata('logged_in_ppid');
        if (empty($cek)) {
            redirect('web');
        } else {
            if (!empty($id)) {
                $this->Webadmin_model->Delete_Content($id, "kode_download", "tbl_download");
                $this->session->set_flashdata('message', 'Data Terhapus!');
            }
            redirect('pembantu/download');
        }
    }

    function tambahdownload()
    {
        $cek = $this->session->userdata('logged_in_ppid');
        $data['akses_ppid'] = $this->session->userdata('akses_ppid');
        
        if (empty($cek)) {
            redirect('web');
        } else {
            $data['h2_title'] = 'Tambah download';
            $data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
            $data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
            $data['instansi'] = $this->config->item('nama_instansi');
            $data['credit'] = $this->config->item('credit_aplikasi');
            $data['alamat'] = $this->config->item('alamat_instansi');
            $data["kategori"] = $this->Webadmin_model->Semua_Menutypeku();
            $data["kategori2"] = $this->Webadmin_model->Semua_Skpd();
            
            $this->load->view('pembantu/bg_atas', $data);
            $this->load->view('pembantu/download/tambah_download', $data);
            $this->load->view('pembantu/bg_bawah');
        }
    }

    function simpandownload()
    {
        $cek = $this->session->userdata('logged_in_ppid');
        if (empty($cek)) {
            redirect('web');
        } else {
            $tgl = " %Y-%m-%d";
            $time = time();
            $content = strip_tags($this->input->post('putusan')); // Tidak pakai filter XSS keras jika ini rich text editor
            
            $data2["download"] = $this->input->post('judul', TRUE);
            $data2["kode_menu"] = $this->input->post('kategori', TRUE);
            $data2["ket"] = preg_replace('#(href|src)="(.*?)/media#', '$1="' . base_url() . 'media', $content);
            $data2["tanggal"] = mdate($tgl, $time);
            $data2["waktu"] = date('G:i:s');
            $data2["counter"] = "1";
            $data2['id_skpd'] = $this->session->userdata('skpd_ppid');

            $this->load->library('form_validation');
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
                
                $this->load->view('pembantu/bg_atas', $data);
                $this->load->view('pembantu/download/tambah_download', $data);
                $this->load->view('pembantu/bg_bawah');
            } else {
                $idmku = $this->session->userdata('skpd_ppid');
                $this->Webadmin_model->Update_Counter_Skpd($idmku);

                $config['upload_path'] = './media/file/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|doc|docx|xls|xlsx|zip|rar';
                $config['max_size'] = 5120; // 5 MB
                $config['encrypt_name'] = TRUE;
                
                $this->load->library('upload', $config);

                if (empty($_FILES['userfile']['name'])) {
                    $data2["file"] = "welcome.jpg";
                    $this->Webadmin_model->Simpan_Artikel2("tbl_download", $data2);
                    $this->session->set_flashdata('message', 'Data Tersimpan!');
                    redirect('pembantu/download');
                } else {
                    if (!$this->upload->do_upload('userfile')) {
                        echo $this->upload->display_errors();
                    } else {
                        $uploadData = $this->upload->data();
                        $data2["file"] = $uploadData['file_name'];
                        $data2["ukuran"] = "1";
                        $this->Webadmin_model->Simpan_Artikel2("tbl_download", $data2);
                        $this->session->set_flashdata('message', 'Data Tersimpan!');
                        redirect('pembantu/download');
                    }
                }
            }
        }
    }

    function editdownload()
    {
        $id = $this->uri->segment(3) !== FALSE ? $this->uri->segment(3) : '';
        
        $datestring = "Login : %d-%m-%Y pukul %h:%i %a";
        $time = time();
        $tgl = "%d-%m-%Y";
        $data["wkt_skr"] = mdate($tgl, $time);
        $data["tanggal"] = mdate($datestring, $time);
        
        $cek = $this->session->userdata('logged_in_ppid');
        $data['akses_ppid'] = $this->session->userdata('akses_ppid');
        
        if (empty($cek)) {
            redirect('web');
        } else {
            $data['h2_title'] = 'Edit Download';
            $data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
            $data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
            $data['instansi'] = $this->config->item('nama_instansi');
            $data['credit'] = $this->config->item('credit_aplikasi');
            $data['alamat'] = $this->config->item('alamat_instansi');
            $data["kategori"] = $this->Webadmin_model->Semua_Menutypeku();
            $data["kategori2"] = $this->Webadmin_model->Semua_Skpd();
            $data['edit'] = $this->Webadmin_model->Edit_Content("tbl_download", "kode_download=".intval($id));
            
            $this->load->view('pembantu/bg_atas', $data);
            $this->load->view('pembantu/download/edit_download', $data);
            $this->load->view('pembantu/bg_bawah');
        }
    }

    function updatedownload()
    {
        $cek = $this->session->userdata('logged_in_ppid');
        if (empty($cek)) {
            redirect('web');
        } else {
            $config['upload_path'] = './media/file/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|doc|docx|xls|xlsx|zip|rar';
            $config['max_size'] = 5120;
            $config['encrypt_name'] = TRUE;
            
            $this->load->library('upload', $config);
            
            $content = $this->input->post('putusan');
            $data2["download"] = $this->input->post('judul', TRUE);
            $data2["kode_menu"] = $this->input->post('kategori', TRUE);
            $data2["ket"] = preg_replace('#(href|src)="(.*?)/media#', '$1="' . base_url() . 'media', $content);
            $data2["kode_download"] = $this->input->post('id_berita', TRUE);
            
            if (empty($_FILES['userfile']['name'])) {
                $this->Webadmin_model->Update_Content("tbl_download", $data2, "kode_download");
                $this->session->set_flashdata('message', 'Data Tersimpan!');
                redirect('pembantu/download');
            } else {
                if (!$this->upload->do_upload('userfile')) {
                    echo $this->upload->display_errors();
                } else {
                    $uploadData = $this->upload->data();
                    $data2["file"] = $uploadData['file_name'];
                    
                    $this->Webadmin_model->Update_Content("tbl_download", $data2, "kode_download");
                    $this->session->set_flashdata('message', 'Data Tersimpan!');
                    redirect('pembantu/download');
                }
            }
        }
    }

    function permohonan()
    {
        $ikx = $this->session->userdata('skpd_ppid');
        $page = $this->uri->segment(3);
        $limit = 10;
        $offset = !$page ? 0 : $page;

        $data["page"] = $page;
        $cek = $this->session->userdata('logged_in_ppid');
        $data['akses_ppid'] = $this->session->userdata('akses_ppid');
        if (empty($cek)) {
            redirect('web');
        } else {
            $data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
            $data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
            $data['instansi'] = $this->config->item('nama_instansi');
            $data['credit'] = $this->config->item('credit_aplikasi');
            $data['alamat'] = $this->config->item('alamat_instansi');
            $data['message'] = "Data Kritik & Saran";
            $total = $this->Webadmin_model->Total_Data_Kritik_Pembantu($ikx);
            
            $config['base_url'] = base_url() . 'pembantu/permohonan/';
            $config['total_rows'] = $total->num_rows();
            $config['per_page'] = $limit;
            $config['uri_segment'] = 3;
            
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

            $this->load->library('pagination');
            $this->pagination->initialize($config);
            $data['paginator'] = $this->pagination->create_links();
            $data['daftarartikel'] = $this->Webadmin_model->Permohonan_Pembantu($offset, $limit, $ikx);
            
            $this->load->view('pembantu/bg_atas', $data);
            $this->load->view('pembantu/permohonan/permohonan', $data);
            $this->load->view('pembantu/bg_bawah');
        }
    }

    function permohonanfinal()
    {
        $ikx = $this->session->userdata('skpd_ppid');
        $page = $this->uri->segment(3);
        $limit = 10;
        $offset = !$page ? 0 : $page;

        $data["page"] = $page;
        $cek = $this->session->userdata('logged_in_ppid');
        $data['akses_ppid'] = $this->session->userdata('akses_ppid');
        if (empty($cek)) {
            redirect('web');
        } else {
            $data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
            $data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
            $data['instansi'] = $this->config->item('nama_instansi');
            $data['credit'] = $this->config->item('credit_aplikasi');
            $data['alamat'] = $this->config->item('alamat_instansi');
            $data['message'] = "Data Kritik & Saran";
            
            $total = $this->Webadmin_model->Total_Data_KritikFinalPembantu($ikx);
            $config['base_url'] = base_url() . 'webadmin/permohonanfinal/'; // Ini tetap sesuai kode asli
            $config['total_rows'] = $total->num_rows();
            $config['per_page'] = $limit;
            $config['uri_segment'] = 3;
            
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

            $this->load->library('pagination');
            $this->pagination->initialize($config);
            $data['paginator'] = $this->pagination->create_links();
            $data['daftarartikel'] = $this->Webadmin_model->PermohonanFinalPembantu($offset, $limit, $ikx);
            
            $this->load->view('pembantu/bg_atas', $data);
            $this->load->view('pembantu/permohonan/permohonanfinal', $data);
            $this->load->view('pembantu/bg_bawah');
        }
    }

    function prosespermohonan()
    {
        $id = $this->uri->segment(3) !== FALSE ? $this->uri->segment(3) : '';
        
        $cek = $this->session->userdata('logged_in_ppid');
        $data['akses'] = $this->session->userdata('akses_ppid');
        if (empty($cek)) {
            redirect('web');
        } else {
            $data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
            $data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
            $data['instansi'] = $this->config->item('nama_instansi');
            $data['credit'] = $this->config->item('credit_aplikasi');
            $data['alamat'] = $this->config->item('alamat_instansi');
            $data["kategori"] = $this->Webadmin_model->Semua_Jk3();

            $sql_dok = "SELECT tbl_kelengkapan.id_kelengkapan, tbl_kelengkapan.id_pemohon, tbl_kelengkapan.id_jk, tbl_kelengkapan.berkas, tbl_jk.jk 
                        FROM tbl_kelengkapan 
                        LEFT JOIN tbl_jk ON tbl_jk.id_jk = tbl_kelengkapan.id_jk 
                        WHERE tbl_kelengkapan.id_pemohon = ? AND (tbl_kelengkapan.id_jk='3' OR tbl_kelengkapan.id_jk='4' OR tbl_kelengkapan.id_jk='13') 
                        ORDER BY tbl_kelengkapan.id_kelengkapan ASC";
            $data["dok"] = $this->db->query($sql_dok, array($id));

            $sql_edit = "SELECT tbl_pemohon.*, tbl_skpd.skpd, tbl_jenis.jenis 
                         FROM tbl_pemohon 
                         LEFT JOIN tbl_skpd ON tbl_skpd.id_skpd = tbl_pemohon.id_skpd 
                         LEFT JOIN tbl_jenis ON tbl_jenis.permalink = tbl_pemohon.jenis 
                         WHERE tbl_pemohon.id_pemohon = ?";
            $data["edit"] = $this->db->query($sql_edit, array($id));

            $this->load->view('pembantu/bg_atas', $data);
            $this->load->view('pembantu/permohonan/proses_permohonan', $data);
            $this->load->view('pembantu/bg_bawah');
        }
    }

    function updatefinalberkas()
    {
        $cek = $this->session->userdata('logged_in_ppid');
        if (empty($cek)) {
            redirect('web');
        } else {
            $in["id_pemohon"] = $this->input->post('id', TRUE);
            $in["id_jk"] = $this->input->post('kategori', TRUE);

            $config['upload_path'] = './media/ktp/';
            $config['max_size'] = 5120; // 5 MB
            $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf';
            $config['encrypt_name'] = TRUE;
            
            $this->load->library('upload', $config);
            $idx = $this->input->post('id', TRUE);

            if (!$this->upload->do_upload('userfile')) {
                echo $this->upload->display_errors();
            } else {
                $uploadData = $this->upload->data();
                $in["berkas"] = $uploadData['file_name'];
                
                $this->session->set_flashdata('message', 'Data Tersimpan!');
                $this->Webadmin_model->In_Polling("tbl_kelengkapan", $in);
                redirect("pembantu/prosespermohonan/$idx");
            }
        }
    }

    function updatefinal()
    {
        $cek = $this->session->userdata('logged_in_ppid');
        if (empty($cek)) {
            redirect('web');
        } else {
            $datainput['id_pemohon'] = $this->input->post('id', TRUE);
            $datainput['status'] = $this->input->post('kategori', TRUE);
            $datainput['ket'] = $this->input->post('rincian_informasi2', TRUE);
            $datainput['download'] = $this->input->post('rincian_informasi', TRUE);
            $datainput['status2'] = "Y";
            $datainput['pemenuhan'] = date("Y-m-d");
            
            $idx = $this->input->post('id', TRUE);
            $this->Webadmin_model->Update_Content("tbl_pemohon", $datainput, "id_pemohon");
            redirect("pembantu/prosespermohonan/$idx");
        }
    }

    function pengguna()
    {
        $id = $this->session->userdata('idm_ppid');
        $cek = $this->session->userdata('logged_in_ppid');
        if (empty($cek)) {
            redirect('web');
        } else {
            $data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
            $data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
            $data['instansi'] = $this->config->item('nama_instansi');
            $data['credit'] = $this->config->item('credit_aplikasi');
            $data['alamat'] = $this->config->item('alamat_instansi');
            $data["kategori"] = $this->Webadmin_model->Semua_Skpd();
            $data["edit"] = $this->Webadmin_model->Edit_Content("user_pembantu", "id_pembantu=".intval($id));
            
            $this->load->view('pembantu/bg_atas', $data);
            $this->load->view('pembantu/pembantu/edit_pembantu', $data);
            $this->load->view('webadmin/bg_bawah'); // Terdapat anomali pemanggilan path dari script aslinya, tetap dibiarkan
        }
    }

    function updatepembantu()
    {
        $cek = $this->session->userdata('logged_in_ppid');
        if (empty($cek)) {
            redirect('web');
        } else {
            $data2["id_pembantu"] = $this->input->post('id', TRUE);
            $data2['nama'] = $this->input->post('nama', TRUE);
            $data2['email'] = $this->input->post('alamatku', TRUE);
            $data2['id_skpd'] = $this->input->post('kategori', TRUE);
            $data2['username'] = $this->input->post('username', TRUE);
            $data2['akses'] = $this->input->post('status', TRUE);
            
            if ($this->input->post('password') != "") {
                $data2['password'] = MD5($this->input->post('password', TRUE) . $this->config->item("key_login"));
            }
            
            $data2['status'] = "administrator";
            $data2['fb'] = $this->input->post('fb', TRUE);
            $data2['twitter'] = $this->input->post('tw', TRUE);
            $data2['ig'] = $this->input->post('ig', TRUE);
            $data2['gplus'] = $this->input->post('gp', TRUE);
            $data2['yt'] = $this->input->post('yt', TRUE);
            $data2['webiste'] = $this->input->post('web', TRUE);
            $data2['alamat'] = $this->input->post('alamat', TRUE);
            
            if (empty($_FILES['userfile']['name'])) {
                $this->Webadmin_model->Update_Content("user_pembantu", $data2, "id_pembantu");
            } else {
                $config['upload_path'] = './asset/banner/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = 5120;
                $config['encrypt_name'] = TRUE;
                
                $this->load->library('upload', $config);
                
                if (!$this->upload->do_upload('userfile')) {
                    echo $this->upload->display_errors();
                    return; // Stop eksekusi agar tidak refresh prematur
                } else {
                    $uploadData = $this->upload->data();
                    $data2["gambar"] = $uploadData['file_name'];
                    $this->Webadmin_model->Update_Content("user_pembantu", $data2, "id_pembantu");
                }
            }
            $this->session->set_flashdata('message', 'Data Tersimpan!');
            redirect('pembantu/pengguna');
        }
    }

    function laporan()
    {
        $cek = $this->session->userdata('logged_in_ppid');
        if (empty($cek)) {
            redirect('web');
        } else {
            $data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
            $data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
            $data['instansi'] = $this->config->item('nama_instansi');
            $data['credit'] = $this->config->item('credit_aplikasi');
            $data['alamat'] = $this->config->item('alamat_instansi');
            $data['message'] = "";

            $datestring = "Login : %d-%m-%Y pukul %h:%i %a";
            $time = time();
            $data["wkt_skr"] = mdate("%d-%m-%Y", $time);
            $data["tanggal"] = mdate($datestring, $time);
            
            $ikx = $this->session->userdata('skpd_ppid');
            $data["kategori2"] = $this->Webadmin_model->Semua_Skpdku($ikx);

            $this->load->view('pembantu/bg_atas', $data);
            $this->load->view('pembantu/laporan/skpd', $data);
            $this->load->view('pembantu/bg_bawah');
        }
    }

    function cetakpertahunskpd()
    {
        $data["tahun"] = $this->input->post('thn_mulai', TRUE);
        $id = $this->input->post('kategori2', TRUE);
        $data["skpd"] = $id;
        
        $d = $this->News_model->Detail_Skpd($id);
        foreach ($d->result() as $soal) {
            $data['bread'] = $soal->skpd;
        }
        
        $this->load->view('pembantu/laporan/cetakskpd', $data);
    }

    function laporanpublik()
    {
        $cek = $this->session->userdata('logged_in_ppid');
        if (empty($cek)) {
            redirect('web');
        } else {
            $data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
            $data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
            $data['instansi'] = $this->config->item('nama_instansi');
            $data['credit'] = $this->config->item('credit_aplikasi');
            $data['alamat'] = $this->config->item('alamat_instansi');
            $data['message'] = "";

            $datestring = "Login : %d-%m-%Y pukul %h:%i %a";
            $time = time();
            $data["wkt_skr"] = mdate("%d-%m-%Y", $time);
            $data["tanggal"] = mdate($datestring, $time);
            
            $ikx = $this->session->userdata('skpd_ppid');
            $data["kategori2"] = $this->Webadmin_model->Semua_Skpdku($ikx);

            $this->load->view('pembantu/bg_atas', $data);
            $this->load->view('pembantu/laporan/publik', $data);
            $this->load->view('pembantu/bg_bawah');
        }
    }

    function cetakpublik()
    {
        $data["tahun"] = $this->input->post('thn_mulai', TRUE);
        $id = $this->input->post('kategori2', TRUE);
        $data["skpd"] = $id;

        if ($id == "semua") {
            $data["kategori"] = $this->Webadmin_model->Semua_Skpd();
            $this->load->view('pembantu/laporan/cetakpublik', $data);
        } else {
            $d = $this->News_model->Detail_Skpd($id);
            foreach ($d->result() as $soal) {
                $data['bread'] = $soal->skpd;
            }
            $data["kategori"] = $this->News_model->Detail_Skpd($id);
            $this->load->view('pembantu/laporan/cetakpublikskpd', $data);
        }
    }

    function editkpt()
    {
        $id = $this->uri->segment(3) !== FALSE ? $this->uri->segment(3) : '';
        $cek = $this->session->userdata('logged_in_ppid');
        if (empty($cek)) {
            redirect('web');
        } else {
            $data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
            $data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
            $data['instansi'] = $this->config->item('nama_instansi');
            $data['credit'] = $this->config->item('credit_aplikasi');
            $data['alamat'] = $this->config->item('alamat_instansi');
            $data["kategori"] = $this->Webadmin_model->Semua_Jk();

            $sql_dok = "SELECT tbl_ktp.* FROM tbl_ktp WHERE tbl_ktp.id_pemohon = ? ORDER BY tbl_ktp.id_ktp ASC";
            $data["dok"] = $this->db->query($sql_dok, array($id));

            $sql_edit = "SELECT tbl_pemohon.*, tbl_skpd.skpd, tbl_jenis.jenis 
                         FROM tbl_pemohon 
                         LEFT JOIN tbl_skpd ON tbl_skpd.id_skpd = tbl_pemohon.id_skpd 
                         LEFT JOIN tbl_jenis ON tbl_jenis.permalink = tbl_pemohon.jenis 
                         WHERE tbl_pemohon.id_pemohon = ?";
            $data["edit"] = $this->db->query($sql_edit, array($id));

            $data['nik'] = "";
            $data['nama'] = "";
            $data['jk'] = "";
            $data['alamat'] = "";
            $data['st'] = "tambah";

            $this->load->view('pembantu/permohonan/proses_ktp', $data);
        }
    }

    function profil()
    {
        $ikx = $this->session->userdata('skpd_ppid');
        $page = $this->uri->segment(3);
        $limit = 500;
        $offset = !$page ? 0 : $page;
        
        $datestring = "Login : %d-%m-%Y pukul %h:%i %a";
        $time = time();
        $data["tanggal"] = mdate($datestring, $time);
        $data["page"] = $page;
        $cek = $this->session->userdata('logged_in_ppid');
        
        if (empty($cek)) {
            redirect('web');
        } else {
            $data['h2_title'] = 'Master Profil Pegawai';
            $data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
            $data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
            $data['instansi'] = $this->config->item('nama_instansi');
            $data['credit'] = $this->config->item('credit_aplikasi');
            $data['alamat'] = $this->config->item('alamat_instansi');
            $total = $this->Webadmin_model->Total_DataProfil($ikx);
            
            $config['base_url'] = base_url() . 'pembantu/profil/';
            $config['total_rows'] = $total->num_rows();
            $config['per_page'] = $limit;
            $config['uri_segment'] = 3;
            
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

            $this->load->library('pagination');
            $this->pagination->initialize($config);
            $data['paginator'] = $this->pagination->create_links();
            $data['daftarartikel'] = $this->Webadmin_model->Profil_Pembantu($offset, $limit, $ikx);
            
            $this->load->view('pembantu/bg_atas', $data);
            $this->load->view('pembantu/profil/profil', $data);
            $this->load->view('pembantu/bg_bawah');
        }
    }

    public function read($id = '')
    {
        $cek = $this->session->userdata('logged_in_ppid');
        if (empty($cek)) {
            redirect('web');
        } else {
            $data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
            $data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
            $data['instansi'] = $this->config->item('nama_instansi');
            $data['credit'] = $this->config->item('credit_aplikasi');
            $data['alamat'] = $this->config->item('alamat_instansi');

            $sql_pegawai = "SELECT tbl_profil.*, tbl_agama.agama, tbl_menikah.menikah, tbl_pangkat.pangkat, 
                                   tbl_golongan.golongan, tbl_jabatanprofil.jabatanprofil, tbl_kelamin.kelamin, tbl_skpd.skpd 
                            FROM tbl_profil 
                            LEFT JOIN tbl_agama ON tbl_agama.id_agama = tbl_profil.id_agama 
                            LEFT JOIN tbl_menikah ON tbl_menikah.id_menikah = tbl_profil.id_menikah 
                            LEFT JOIN tbl_pangkat ON tbl_pangkat.id_pangkat = tbl_profil.id_pangkat 
                            LEFT JOIN tbl_golongan ON tbl_golongan.id_golongan = tbl_profil.id_golongan 
                            LEFT JOIN tbl_jabatanprofil ON tbl_jabatanprofil.id_jabatanprofil = tbl_profil.id_jabatanprofil 
                            LEFT JOIN tbl_kelamin ON tbl_kelamin.id_kelamin = tbl_profil.id_jk 
                            LEFT JOIN tbl_skpd ON tbl_skpd.id_skpd = tbl_profil.unit_kerja 
                            WHERE tbl_profil.id_profil = ?";
            $data['status_pegawai'] = $this->db->query($sql_pegawai, array($id));

            $sql_keluarga = "SELECT tbl_anak.*, tbl_kelamin.kelamin FROM tbl_anak 
                             LEFT JOIN tbl_kelamin ON tbl_kelamin.id_kelamin = tbl_anak.id_jk 
                             WHERE tbl_anak.id_profil = ? ORDER BY tbl_anak.id_anak ASC";
            $data['keluarga'] = $this->db->query($sql_keluarga, array($id));

            $sql_pendidikan = "SELECT tbl_pendidikan.*, tbl_jenjang.jenjang FROM tbl_pendidikan 
                               LEFT JOIN tbl_jenjang ON tbl_jenjang.id_jenjang = tbl_pendidikan.id_jenjang 
                               WHERE tbl_pendidikan.id_profil = ? ORDER BY tbl_pendidikan.id_pendidikan ASC";
            $data['pendidikan'] = $this->db->query($sql_pendidikan, array($id));

            $sql_pekerjaan = "SELECT tbl_pekerjaanprofil.*, tbl_skpd.skpd, tbl_jabatanprofil.jabatanprofil 
                              FROM tbl_pekerjaanprofil 
                              LEFT JOIN tbl_skpd ON tbl_skpd.id_skpd = tbl_pekerjaanprofil.unit_kerja 
                              LEFT JOIN tbl_jabatanprofil ON tbl_jabatanprofil.id_jabatanprofil = tbl_pekerjaanprofil.id_jabatanprofil 
                              WHERE tbl_pekerjaanprofil.id_profil = ? ORDER BY tbl_pekerjaanprofil.id_jabatanprofil ASC";
            $data['pekerjaan'] = $this->db->query($sql_pekerjaan, array($id));

            $this->load->view('pembantu/bg_atas', $data);
            $this->load->view('pembantu/profil/tbl_profil_read', $data);
            $this->load->view('pembantu/bg_bawah', $data);
        }
    }

    public function tambahprofil()
    {
        $cek = $this->session->userdata('logged_in_ppid');
        if (empty($cek)) {
            redirect('web');
        } else {
            $data = array(
                'button' => 'Simpan',
                'action' => site_url('pembantu/create_action'),
                'id_profil' => set_value('id_profil'),
                'identitas_diri' => set_value('identitas_diri'),
                'nama_lengkap' => set_value('nama_lengkap'),
                'tempat_lahir' => set_value('tempat_lahir'),
                'tanggal_lahir' => set_value('tanggal_lahir'),
                'alamatku' => set_value('alamatku'),
                'id_agama' => set_value('id_agama'),
                'hp' => set_value('hp'),
                'alamat_surel' => set_value('alamat_surel'),
                'alamat_kantor' => set_value('alamat_kantor'),
                'id_menikah' => set_value('id_menikah'),
                'id_level' => set_value('id_level'),
                'nip' => set_value('nip'),
                'id_pangkat' => set_value('id_pangkat'),
                'id_tingkatan' => set_value('id_tingkatan'),
                'id_golongan' => set_value('id_golongan'),
                'id_jabatanprofil' => set_value('id_jabatanprofil'),
                'unit_kerja' => set_value('unit_kerja'),
                'hobi' => set_value('hobi'),
                'nama_pasangan' => set_value('nama_pasangan'),
                'id_jk' => set_value('id_jk'),
                'pendidikan' => set_value('pendidikan'),
                'foto' => set_value('foto'),
                'foto_profil' => set_value('foto_profil'),
            );
            $data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
            $data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
            $data['instansi'] = $this->config->item('nama_instansi');
            $data['credit'] = $this->config->item('credit_aplikasi');
            $data['alamat'] = $this->config->item('alamat_instansi');

            $data["agama"] = $this->Webadmin_model->Semua_Agama();
            $data["menikah"] = $this->Webadmin_model->Semua_Menikah();
            $data["pangkat"] = $this->Webadmin_model->Semua_Pangkat();
            $data["golongan"] = $this->Webadmin_model->Semua_Golongan();
            $data["jabatan"] = $this->Webadmin_model->Semua_Jabatanprofil();
            $data["jk"] = $this->Webadmin_model->Semua_Kelamin();
            $data["skpd"] = $this->Webadmin_model->Semua_Skpd();
            $data["tingkat"] = $this->Webadmin_model->Semua_Tingkat();
            $data["level"] = $this->Webadmin_model->Semua_Level();

            $this->load->view('pembantu/bg_atas', $data);
            $this->load->view('pembantu/profil/tbl_profil_form', $data);
            $this->load->view('pembantu/bg_bawah');
        }
    }

    public function create_action()
    {
        $cek = $this->session->userdata('logged_in_ppid');
        if (empty($cek)) {
            redirect('web');
        } else {
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->tambahprofil();
            } else {
                if (empty($_FILES['userfile']['name'])) {
                    $data = array(
                        'identitas_diri' => $this->input->post('identitas_diri', TRUE),
                        'nama_lengkap' => $this->input->post('nama_lengkap', TRUE),
                        'tempat_lahir' => $this->input->post('tempat_lahir', TRUE),
                        'tanggal_lahir' => date('Y-m-d', strtotime($this->input->post('tanggal_lahir', TRUE))),
                        'alamat' => $this->input->post('alamatku', TRUE),
                        'id_agama' => $this->input->post('id_agama', TRUE),
                        'id_level' => $this->input->post('id_level', TRUE),
                        'hp' => $this->input->post('hp', TRUE),
                        'alamat_surel' => $this->input->post('alamat_surel', TRUE),
                        'alamat_kantor' => $this->input->post('alamat_kantor', TRUE),
                        'id_menikah' => $this->input->post('id_menikah', TRUE),
                        'nip' => $this->input->post('nip', TRUE),
                        'id_pangkat' => $this->input->post('id_pangkat', TRUE),
                        'id_golongan' => $this->input->post('id_golongan', TRUE),
                        'id_tingkatan' => $this->input->post('id_tingkatan', TRUE),
                        'id_jabatanprofil' => $this->input->post('id_jabatanprofil', TRUE),
                        'unit_kerja' => $this->input->post('unit_kerja', TRUE),
                        'hobi' => $this->input->post('hobi', TRUE),
                        'nama_pasangan' => $this->input->post('nama_pasangan', TRUE),
                        'id_jk' => $this->input->post('id_jk', TRUE),
                        'pendidikan' => $this->input->post('pendidikan', TRUE),
                        'foto' => "welcome.png",
                    );

                    $this->Profil_model->insert($data);
                    $this->session->set_flashdata('message', 'Create Record Success');
                    redirect('pembantu/profil');
                } else {
                    $config['upload_path'] = './asset/profil/';
                    $config['allowed_types'] = 'gif|jpg|jpeg|png';
                    $config['max_size'] = 5120;
                    $config['encrypt_name'] = TRUE;
                    
                    $this->load->library('upload', $config);
                    
                    if (!$this->upload->do_upload('userfile')) {
                        echo $this->upload->display_errors();
                    } else {
                        $uploadData = $this->upload->data();
                        
                        $data = array(
                            'identitas_diri' => $this->input->post('identitas_diri', TRUE),
                            'nama_lengkap' => $this->input->post('nama_lengkap', TRUE),
                            'tempat_lahir' => $this->input->post('tempat_lahir', TRUE),
                            'tanggal_lahir' => date('Y-m-d', strtotime($this->input->post('tanggal_lahir', TRUE))),
                            'alamat' => $this->input->post('alamatku', TRUE),
                            'id_agama' => $this->input->post('id_agama', TRUE),
                            'hp' => $this->input->post('hp', TRUE),
                            'alamat_surel' => $this->input->post('alamat_surel', TRUE),
                            'alamat_kantor' => $this->input->post('alamat_kantor', TRUE),
                            'id_menikah' => $this->input->post('id_menikah', TRUE),
                            'nip' => $this->input->post('nip', TRUE),
                            'id_level' => $this->input->post('id_level', TRUE),
                            'id_tingkatan' => $this->input->post('id_tingkatan', TRUE),
                            'id_pangkat' => $this->input->post('id_pangkat', TRUE),
                            'id_golongan' => $this->input->post('id_golongan', TRUE),
                            'id_jabatanprofil' => $this->input->post('id_jabatanprofil', TRUE),
                            'unit_kerja' => $this->input->post('unit_kerja', TRUE),
                            'hobi' => $this->input->post('hobi', TRUE),
                            'nama_pasangan' => $this->input->post('nama_pasangan', TRUE),
                            'id_jk' => $this->input->post('id_jk', TRUE),
                            'pendidikan' => $this->input->post('pendidikan', TRUE),
                            'foto' => $uploadData['file_name'],
                        );

                        $this->Profil_model->insert($data);
                        $this->session->set_flashdata('message', 'Create Record Success');
                        redirect('pembantu/profil');
                    }
                }
            }
        }
    }

    public function update($id = '')
    {
        $cek = $this->session->userdata('logged_in_ppid');
        if (empty($cek)) {
            redirect('web');
        } else {
            $row = $this->Profil_model->get_by_id($id);

            if ($row) {
                $data = array(
                    'button' => 'Update',
                    'action' => site_url('pembantu/update_action'),
                    'id_profil' => set_value('id_profil', $row->id_profil),
                    'identitas_diri' => set_value('identitas_diri', $row->identitas_diri),
                    'nama_lengkap' => set_value('nama_lengkap', $row->nama_lengkap),
                    'tempat_lahir' => set_value('tempat_lahir', $row->tempat_lahir),
                    'tanggal_lahir' => set_value('tanggal_lahir', date('d-m-Y', strtotime($row->tanggal_lahir))),
                    'alamatku' => set_value('alamatku', $row->alamat),
                    'id_agama' => set_value('id_agama', $row->id_agama),
                    'hp' => set_value('hp', $row->hp),
                    'alamat_surel' => set_value('alamat_surel', $row->alamat_surel),
                    'alamat_kantor' => set_value('alamat_kantor', $row->alamat_kantor),
                    'id_menikah' => set_value('id_menikah', $row->id_menikah),
                    'nip' => set_value('nip', $row->nip),
                    'id_pangkat' => set_value('id_pangkat', $row->id_pangkat),
                    'id_level' => set_value('id_level', $row->id_level),
                    'id_golongan' => set_value('id_golongan', $row->id_golongan),
                    'id_tingkatan' => set_value('id_tingkatan', $row->id_tingkatan),
                    'id_jabatanprofil' => set_value('id_jabatanprofil', $row->id_jabatanprofil),
                    'unit_kerja' => set_value('unit_kerja', $row->unit_kerja),
                    'hobi' => set_value('hobi', $row->hobi),
                    'nama_pasangan' => set_value('nama_pasangan', $row->nama_pasangan),
                    'id_jk' => set_value('id_jk', $row->id_jk),
                    'pendidikan' => set_value('pendidikan', $row->pendidikan),
                    'foto' => set_value('foto', $row->foto),
                    'foto_profil' => set_value('foto_profil', $row->foto_profil),
                );
                $data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
                $data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
                $data['instansi'] = $this->config->item('nama_instansi');
                $data['credit'] = $this->config->item('credit_aplikasi');
                $data['alamat'] = $this->config->item('alamat_instansi');

                $data["agama"] = $this->Webadmin_model->Semua_Agama();
                $data["menikah"] = $this->Webadmin_model->Semua_Menikah();
                $data["pangkat"] = $this->Webadmin_model->Semua_Pangkat();
                $data["golongan"] = $this->Webadmin_model->Semua_Golongan();
                $data["jabatan"] = $this->Webadmin_model->Semua_Jabatanprofil();
                $data["jk"] = $this->Webadmin_model->Semua_Kelamin();
                $data["skpd"] = $this->Webadmin_model->Semua_Skpd();
                $data["tingkat"] = $this->Webadmin_model->Semua_Tingkat();
                $data["level"] = $this->Webadmin_model->Semua_Level();
                
                $this->load->view('pembantu/bg_atas', $data);
                $this->load->view('pembantu/profil/tbl_profil_form', $data);
                $this->load->view('pembantu/bg_bawah', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect('pembantu/profil');
            }
        }
    }

    public function update_action()
    {
        $cek = $this->session->userdata('logged_in_ppid');
        if (empty($cek)) {
            redirect('web');
        } else {
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->update($this->input->post('id_profil', TRUE));
            } else {
                if (empty($_FILES['userfile']['name'])) {
                    $data = array(
                        'identitas_diri' => $this->input->post('identitas_diri', TRUE),
                        'nama_lengkap' => $this->input->post('nama_lengkap', TRUE),
                        'tempat_lahir' => $this->input->post('tempat_lahir', TRUE),
                        'tanggal_lahir' => date('Y-m-d', strtotime($this->input->post('tanggal_lahir', TRUE))),
                        'alamat' => $this->input->post('alamatku', TRUE),
                        'id_agama' => $this->input->post('id_agama', TRUE),
                        'hp' => $this->input->post('hp', TRUE),
                        'id_tingkatan' => $this->input->post('id_tingkatan', TRUE),
                        'alamat_surel' => $this->input->post('alamat_surel', TRUE),
                        'alamat_kantor' => $this->input->post('alamat_kantor', TRUE),
                        'id_menikah' => $this->input->post('id_menikah', TRUE),
                        'nip' => $this->input->post('nip', TRUE),
                        'id_level' => $this->input->post('id_level', TRUE),
                        'id_pangkat' => $this->input->post('id_pangkat', TRUE),
                        'id_golongan' => $this->input->post('id_golongan', TRUE),
                        'id_jabatanprofil' => $this->input->post('id_jabatanprofil', TRUE),
                        'unit_kerja' => $this->input->post('unit_kerja', TRUE),
                        'hobi' => $this->input->post('hobi', TRUE),
                        'nama_pasangan' => $this->input->post('nama_pasangan', TRUE),
                        'id_jk' => $this->input->post('id_jk', TRUE),
                        'pendidikan' => $this->input->post('pendidikan', TRUE),
                    );
                } else {
                    $config['upload_path'] = './asset/profil/';
                    $config['allowed_types'] = 'gif|jpg|jpeg|png';
                    $config['max_size'] = 5120;
                    $config['encrypt_name'] = TRUE;
                    
                    $this->load->library('upload', $config);
                    
                    if (!$this->upload->do_upload('userfile')) {
                        echo $this->upload->display_errors();
                        return; // return immediately avoiding further processing
                    } else {
                        $uploadData = $this->upload->data();
                        
                        $data = array(
                            'identitas_diri' => $this->input->post('identitas_diri', TRUE),
                            'nama_lengkap' => $this->input->post('nama_lengkap', TRUE),
                            'tempat_lahir' => $this->input->post('tempat_lahir', TRUE),
                            'tanggal_lahir' => date('Y-m-d', strtotime($this->input->post('tanggal_lahir', TRUE))),
                            'alamat' => $this->input->post('alamatku', TRUE),
                            'id_agama' => $this->input->post('id_agama', TRUE),
                            'hp' => $this->input->post('hp', TRUE),
                            'alamat_surel' => $this->input->post('alamat_surel', TRUE),
                            'alamat_kantor' => $this->input->post('alamat_kantor', TRUE),
                            'id_menikah' => $this->input->post('id_menikah', TRUE),
                            'nip' => $this->input->post('nip', TRUE),
                            'id_tingkatan' => $this->input->post('id_tingkatan', TRUE),
                            'id_pangkat' => $this->input->post('id_pangkat', TRUE),
                            'id_golongan' => $this->input->post('id_golongan', TRUE),
                            'id_jabatanprofil' => $this->input->post('id_jabatanprofil', TRUE),
                            'unit_kerja' => $this->input->post('unit_kerja', TRUE),
                            'hobi' => $this->input->post('hobi', TRUE),
                            'id_level' => $this->input->post('id_level', TRUE),
                            'nama_pasangan' => $this->input->post('nama_pasangan', TRUE),
                            'id_jk' => $this->input->post('id_jk', TRUE),
                            'pendidikan' => $this->input->post('pendidikan', TRUE),
                            'foto' => $uploadData['file_name'],
                        );
                    }
                }

                $this->Profil_model->update($this->input->post('id_profil', TRUE), $data);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect('pembantu/profil');
            }
        }
    }

    public function delete($id = '')
    {
        $cek = $this->session->userdata('logged_in_ppid');
        if (empty($cek)) {
            redirect('web');
        } else {
            $row = $this->Profil_model->get_by_id($id);

            if ($row) {
                $this->Profil_model->delete($id);
                $this->session->set_flashdata('message', 'Delete Record Success');
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
            }
            redirect('pembantu/profil');
        }
    }

    public function keluarga($id = '')
    {
        $cek = $this->session->userdata('logged_in_ppid');
        if (empty($cek)) {
            redirect('web');
        } else {
            $row = $this->Profil_model->get_by_id($id);

            if ($row) {
                $data = array(
                    'button' => 'Update',
                    'action' => site_url('pembantu/update_keluarga'),
                    'action2' => site_url('pembantu/simpan_anak'),
                    'id_anak' => set_value('id_anak'),
                    'id_profil' => set_value('id_profil', $row->id_profil),
                    'identitas_diri' => set_value('identitas_diri', $row->identitas_diri),
                    'nama_lengkap' => set_value('nama_lengkap', $row->nama_lengkap),
                    'tempat_lahir' => set_value('tempat_lahir', $row->tempat_lahir),
                    'tanggal_lahir' => set_value('tanggal_lahir', date('d-m-Y', strtotime($row->tanggal_lahir))),
                    'alamatku' => set_value('alamatku', $row->alamat),
                    'id_agama' => set_value('id_agama', $row->id_agama),
                    'hp' => set_value('hp', $row->hp),
                    'alamat_surel' => set_value('alamat_surel', $row->alamat_surel),
                    'alamat_kantor' => set_value('alamat_kantor', $row->alamat_kantor),
                    'id_menikah' => set_value('id_menikah', $row->id_menikah),
                    'nip' => set_value('nip', $row->nip),
                    'id_pangkat' => set_value('id_pangkat', $row->id_pangkat),
                    'id_golongan' => set_value('id_golongan', $row->id_golongan),
                    'id_jabatanprofil' => set_value('id_jabatanprofil', $row->id_jabatanprofil),
                    'unit_kerja' => set_value('unit_kerja', $row->unit_kerja),
                    'hobi' => set_value('hobi', $row->hobi),
                    'nama_pasangan' => set_value('nama_pasangan', $row->nama_pasangan),
                    'id_jk' => set_value('id_jk', $row->id_jk),
                    'pendidikan' => set_value('pendidikan', $row->pendidikan),
                    'foto' => set_value('foto', $row->foto),
                    'foto_profil' => set_value('foto_profil', $row->foto_profil),
                );

                $data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
                $data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
                $data['instansi'] = $this->config->item('nama_instansi');
                $data['credit'] = $this->config->item('credit_aplikasi');
                $data['alamat'] = $this->config->item('alamat_instansi');

                $data["agama"] = $this->Webadmin_model->Semua_Agama();
                $data["menikah"] = $this->Webadmin_model->Semua_Menikah();
                $data["pangkat"] = $this->Webadmin_model->Semua_Pangkat();
                $data["golongan"] = $this->Webadmin_model->Semua_Golongan();
                $data["jabatan"] = $this->Webadmin_model->Semua_Jabatanprofil();
                $data["jk"] = $this->Webadmin_model->Semua_Kelamin();
                $data["skpd"] = $this->Webadmin_model->Semua_Skpd();

                $sql_anak = "SELECT tbl_anak.*, tbl_kelamin.kelamin 
                             FROM tbl_anak 
                             LEFT JOIN tbl_kelamin ON tbl_kelamin.id_kelamin = tbl_anak.id_jk 
                             WHERE tbl_anak.id_profil = ? ORDER BY tbl_anak.id_anak DESC";
                $data['status_pegawai'] = $this->db->query($sql_anak, array($id));

                $this->load->view('pembantu/bg_atas', $data);
                $this->load->view('pembantu/profil/tbl_keluarga_form', $data);
                $this->load->view('pembantu/bg_bawah', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect('pembantu/profil');
            }
        }
    }

    public function simpan_anak()
    {
        $cek = $this->session->userdata('logged_in_ppid');
        if (empty($cek)) {
            redirect('web');
        } else {
            $idm = $this->input->post('id_profil', TRUE);
            $data = array(
                'id_profil' => $idm,
                'nama_anak' => $this->input->post('nama_anak', TRUE),
                'id_jk' => $this->input->post('id_jk', TRUE),
                'pendidikan' => $this->input->post('pendidikan', TRUE),
            );

            $this->Anak_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect('pembantu/keluarga/' . $idm);
        }
    }

    public function update_anak($id = '')
    {
        $cek = $this->session->userdata('logged_in_ppid');
        if (empty($cek)) {
            redirect('web');
        } else {
            $row = $this->Anak_model->get_by_id($id);

            if ($row) {
                $data = array(
                    'button' => 'Update',
                    'action3' => site_url('pembantu/update_anak_action'),
                    'id_anak' => set_value('id_anak', $row->id_anak),
                    'id_profil' => set_value('id_profil', $row->id_profil),
                    'nama_anak' => set_value('nama_anak', $row->nama_anak),
                    'id_jk' => set_value('id_jk', $row->id_jk),
                    'pendidikan' => set_value('pendidikan', $row->pendidikan),
                );
                
                $data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
                $data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
                $data['instansi'] = $this->config->item('nama_instansi');
                $data['credit'] = $this->config->item('credit_aplikasi');
                $data['alamat'] = $this->config->item('alamat_instansi');

                $data["agama"] = $this->Webadmin_model->Semua_Agama();
                $data["menikah"] = $this->Webadmin_model->Semua_Menikah();
                $data["pangkat"] = $this->Webadmin_model->Semua_Pangkat();
                $data["golongan"] = $this->Webadmin_model->Semua_Golongan();
                $data["jabatan"] = $this->Webadmin_model->Semua_Jabatanprofil();
                $data["jk"] = $this->Webadmin_model->Semua_Kelamin();
                $data["skpd"] = $this->Webadmin_model->Semua_Skpd();

                $this->load->view('pembantu/bg_atas', $data);
                $this->load->view('pembantu/profil/tbl_anak_form', $data);
                $this->load->view('pembantu/bg_bawah', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect('pembantu/anak');
            }
        }
    }

    public function update_keluarga()
    {
        $cek = $this->session->userdata('logged_in_ppid');
        if (empty($cek)) {
            redirect('web');
        } else {
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->update($this->input->post('id_profil', TRUE));
            } else {
                $idm = $this->input->post('id_profil', TRUE);
                $data = array(
                    'nama_pasangan' => $this->input->post('nama_pasangan', TRUE),
                    'id_jk' => $this->input->post('id_jk', TRUE),
                    'pendidikan' => $this->input->post('pendidikan', TRUE),
                );

                $this->Profil_model->update($idm, $data);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect('pembantu/keluarga/' . $idm);
            }
        }
    }

    public function update_anak_action()
    {
        $cek = $this->session->userdata('logged_in_ppid');
        if (empty($cek)) {
            redirect('web');
        } else {
            $aj = $this->input->post('id_profil', TRUE);
            $data = array(
                'id_profil' => $aj,
                'nama_anak' => $this->input->post('nama_anak', TRUE),
                'id_jk' => $this->input->post('id_jk', TRUE),
                'pendidikan' => $this->input->post('pendidikan', TRUE),
            );

            $this->Anak_model->update($this->input->post('id_anak', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect('pembantu/keluarga/' . $aj);
        }
    }

    public function delete_anak()
    {
        $id = $this->uri->segment(3);
        $id2 = $this->uri->segment(4);
        $cek = $this->session->userdata('logged_in_ppid');
        if (empty($cek)) {
            redirect('web');
        } else {
            $row = $this->Anak_model->get_by_id($id);

            if ($row) {
                $this->Anak_model->delete($id);
                $this->session->set_flashdata('message', 'Delete Record Success');
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
            }
            redirect('pembantu/keluarga/' . $id2);
        }
    }

    public function pendidikan($id = '')
    {
        $cek = $this->session->userdata('logged_in_ppid');
        if (empty($cek)) {
            redirect('web');
        } else {
            $row = $this->Profil_model->get_by_id($id);

            if ($row) {
                $data = array(
                    'id_profil' => set_value('id_profil', $row->id_profil),
                    'identitas_diri' => set_value('identitas_diri', $row->identitas_diri),
                    'nama_lengkap' => set_value('nama_lengkap', $row->nama_lengkap),
                    'tempat_lahir' => set_value('tempat_lahir', $row->tempat_lahir),
                    'tanggal_lahir' => set_value('tanggal_lahir', date('d-m-Y', strtotime($row->tanggal_lahir))),
                    'alamatku' => set_value('alamatku', $row->alamat),
                    'id_agama' => set_value('id_agama', $row->id_agama),
                    'hp' => set_value('hp', $row->hp),
                    'alamat_surel' => set_value('alamat_surel', $row->alamat_surel),
                    'alamat_kantor' => set_value('alamat_kantor', $row->alamat_kantor),
                    'id_menikah' => set_value('id_menikah', $row->id_menikah),
                    'nip' => set_value('nip', $row->nip),
                    'id_pangkat' => set_value('id_pangkat', $row->id_pangkat),
                    'id_golongan' => set_value('id_golongan', $row->id_golongan),
                    'id_jabatanprofil' => set_value('id_jabatanprofil', $row->id_jabatanprofil),
                    'unit_kerja' => set_value('unit_kerja', $row->unit_kerja),
                    'hobi' => set_value('hobi', $row->hobi),
                    'nama_pasangan' => set_value('nama_pasangan', $row->nama_pasangan),
                    'id_jk' => set_value('id_jk', $row->id_jk),
                    'pendidikan' => set_value('pendidikan', $row->pendidikan),
                    'foto' => set_value('foto', $row->foto),
                    'foto_profil' => set_value('foto_profil', $row->foto_profil),
                    'button' => 'Simpan',
                    'action' => site_url('pembantu/update_pendidikan'),
                    'id_pendidikan' => set_value('id_pendidikan'),
                    'id_jenjang' => set_value('id_jenjang'),
                    'nama' => set_value('nama'),
                    'jurusan' => set_value('jurusan'),
                    'tempat' => set_value('tempat'),
                    'tahun_pendidikan' => set_value('tahun_pendidikan'),
                );

                $data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
                $data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
                $data['instansi'] = $this->config->item('nama_instansi');
                $data['credit'] = $this->config->item('credit_aplikasi');
                $data['alamat'] = $this->config->item('alamat_instansi');

                $data["agama"] = $this->Webadmin_model->Semua_Agama();
                $data["menikah"] = $this->Webadmin_model->Semua_Menikah();
                $data["pangkat"] = $this->Webadmin_model->Semua_Pangkat();
                $data["golongan"] = $this->Webadmin_model->Semua_Golongan();
                $data["jabatan"] = $this->Webadmin_model->Semua_Jabatanprofil();
                $data["jk"] = $this->Webadmin_model->Semua_Kelamin();
                $data["jenjang"] = $this->Webadmin_model->Semua_Jenjang();

                $sql_pendidikan = "SELECT tbl_pendidikan.*, tbl_jenjang.jenjang 
                                   FROM tbl_pendidikan 
                                   LEFT JOIN tbl_jenjang ON tbl_jenjang.id_jenjang = tbl_pendidikan.id_jenjang 
                                   WHERE tbl_pendidikan.id_profil = ? ORDER BY tbl_pendidikan.id_pendidikan ASC";
                $data['status_pegawai'] = $this->db->query($sql_pendidikan, array($id));

                $this->load->view('pembantu/bg_atas', $data);
                $this->load->view('pembantu/profil/tbl_pendidikan_form', $data);
                $this->load->view('pembantu/bg_bawah', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect('pembantu/profil');
            }
        }
    }

    public function update_pendidikan()
    {
        $cek = $this->session->userdata('logged_in_ppid');
        if (empty($cek)) {
            redirect('web');
        } else {
            $aj = $this->input->post('id_profil', TRUE);
            $data = array(
                'id_profil' => $aj,
                'id_jenjang' => $this->input->post('id_jenjang', TRUE),
                'nama' => $this->input->post('nama', TRUE),
                'jurusan' => $this->input->post('jurusan', TRUE),
                'tempat' => $this->input->post('tempat', TRUE),
                'tahun_pendidikan' => $this->input->post('tahun_pendidikan', TRUE),
            );

            $this->Pendidikan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect('pembantu/pendidikan/' . $aj);
        }
    }

    public function updatependidikan()
    {
        $id = $this->uri->segment(3);
        $id2 = $this->uri->segment(4);
        $cek = $this->session->userdata('logged_in_ppid');
        if (empty($cek)) {
            redirect('web');
        } else {
            $row = $this->Pendidikan_model->get_by_id($id);

            if ($row) {
                $data = array(
                    'button' => 'Update',
                    'action' => site_url('pembantu/update_pendidikan_final'),
                    'id_pendidikan' => set_value('id_pendidikan', $row->id_pendidikan),
                    'id_profil' => set_value('id_profil', $row->id_profil),
                    'id_jenjang' => set_value('id_jenjang', $row->id_jenjang),
                    'nama' => set_value('nama', $row->nama),
                    'jurusan' => set_value('jurusan', $row->jurusan),
                    'tempat' => set_value('tempat', $row->tempat),
                    'tahun_pendidikan' => set_value('tahun_pendidikan', $row->tahun_pendidikan),
                );
                
                $data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
                $data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
                $data['instansi'] = $this->config->item('nama_instansi');
                $data['credit'] = $this->config->item('credit_aplikasi');
                $data['alamat'] = $this->config->item('alamat_instansi');
                $data["jenjang"] = $this->Webadmin_model->Semua_Jenjang();

                $sql_pendidikan = "SELECT tbl_pendidikan.*, tbl_jenjang.jenjang 
                                   FROM tbl_pendidikan 
                                   LEFT JOIN tbl_jenjang ON tbl_jenjang.id_jenjang = tbl_pendidikan.id_jenjang 
                                   WHERE tbl_pendidikan.id_profil = ? ORDER BY tbl_pendidikan.id_pendidikan ASC";
                $data['status_pegawai'] = $this->db->query($sql_pendidikan, array($id2));

                $this->load->view('pembantu/bg_atas', $data);
                $this->load->view('pembantu/profil/tbl_pendidikan_form', $data);
                $this->load->view('pembantu/bg_bawah', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect('pembantu/pendidikan');
            }
        }
    }

    public function update_pendidikan_final()
    {
        $cek = $this->session->userdata('logged_in_ppid');
        if (empty($cek)) {
            redirect('web');
        } else {
            $aj = $this->input->post('id_profil', TRUE);
            $data = array(
                'id_profil' => $aj,
                'id_jenjang' => $this->input->post('id_jenjang', TRUE),
                'nama' => $this->input->post('nama', TRUE),
                'jurusan' => $this->input->post('jurusan', TRUE),
                'tempat' => $this->input->post('tempat', TRUE),
                'tahun_pendidikan' => $this->input->post('tahun_pendidikan', TRUE),
            );

            $this->Pendidikan_model->update($this->input->post('id_pendidikan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect('pembantu/pendidikan/' . $aj);
        }
    }

    public function deletependidikan()
    {
        $id = $this->uri->segment(3);
        $id2 = $this->uri->segment(4);

        $cek = $this->session->userdata('logged_in_ppid');
        if (empty($cek)) {
            redirect('web');
        } else {
            $row = $this->Pendidikan_model->get_by_id($id);

            if ($row) {
                $this->Pendidikan_model->delete($id);
                $this->session->set_flashdata('message', 'Delete Record Success');
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
            }
            redirect('pembantu/pendidikan/' . $id2);
        }
    }

    public function pekerjaan($id = '')
    {
        $cek = $this->session->userdata('logged_in_ppid');
        if (empty($cek)) {
            redirect('web');
        } else {
            $row = $this->Profil_model->get_by_id($id);

            if ($row) {
                $data = array(
                    'button' => 'Simpan',
                    'action' => site_url('pembantu/update_pekerjaan'),
                    'id_profil' => set_value('id_profil', $row->id_profil),
                    'identitas_diri' => set_value('identitas_diri', $row->identitas_diri),
                    'nama_lengkap' => set_value('nama_lengkap', $row->nama_lengkap),
                    'tempat_lahir' => set_value('tempat_lahir', $row->tempat_lahir),
                    'tanggal_lahir' => set_value('tanggal_lahir', date('d-m-Y', strtotime($row->tanggal_lahir))),
                    'alamatku' => set_value('alamatku', $row->alamat),
                    'id_agama' => set_value('id_agama', $row->id_agama),
                    'hp' => set_value('hp', $row->hp),
                    'alamat_surel' => set_value('alamat_surel', $row->alamat_surel),
                    'alamat_kantor' => set_value('alamat_kantor', $row->alamat_kantor),
                    'id_menikah' => set_value('id_menikah', $row->id_menikah),
                    'nip' => set_value('nip', $row->nip),
                    'id_pangkat' => set_value('id_pangkat', $row->id_pangkat),
                    'id_golongan' => set_value('id_golongan', $row->id_golongan),
                    'id_jabatanprofil' => set_value('id_jabatanprofil', $row->id_jabatanprofil),
                    'unit_kerja' => set_value('unit_kerja', $row->unit_kerja),
                    'hobi' => set_value('hobi', $row->hobi),
                    'nama_pasangan' => set_value('nama_pasangan', $row->nama_pasangan),
                    'id_jk' => set_value('id_jk', $row->id_jk),
                    'pendidikan' => set_value('pendidikan', $row->pendidikan),
                    'foto' => set_value('foto', $row->foto),
                    'foto_profil' => set_value('foto_profil', $row->foto_profil),
                    'id_pekerjaanprofil' => set_value('id_pekerjaanprofil'),
                    'id_jabatanprofil' => set_value('id_jabatanprofil'),
                    'periode' => set_value('periode'),
                    'unit_kerja' => set_value('unit_kerja'),
                );
                
                $data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
                $data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
                $data['instansi'] = $this->config->item('nama_instansi');
                $data['credit'] = $this->config->item('credit_aplikasi');
                $data['alamat'] = $this->config->item('alamat_instansi');

                $data["agama"] = $this->Webadmin_model->Semua_Agama();
                $data["menikah"] = $this->Webadmin_model->Semua_Menikah();
                $data["pangkat"] = $this->Webadmin_model->Semua_Pangkat();
                $data["golongan"] = $this->Webadmin_model->Semua_Golongan();
                $data["jabatan"] = $this->Webadmin_model->Semua_Jabatanprofil();
                $data["jk"] = $this->Webadmin_model->Semua_Kelamin();
                $data["skpd"] = $this->Webadmin_model->Semua_Skpd();

                $sql_pekerjaan = "SELECT tbl_pekerjaanprofil.*, tbl_skpd.skpd, tbl_jabatanprofil.jabatanprofil 
                                  FROM tbl_pekerjaanprofil 
                                  LEFT JOIN tbl_skpd ON tbl_skpd.id_skpd = tbl_pekerjaanprofil.unit_kerja 
                                  LEFT JOIN tbl_jabatanprofil ON tbl_jabatanprofil.id_jabatanprofil = tbl_pekerjaanprofil.id_jabatanprofil 
                                  WHERE tbl_pekerjaanprofil.id_profil = ? ORDER BY tbl_pekerjaanprofil.id_jabatanprofil ASC";
                $data['status_pegawai'] = $this->db->query($sql_pekerjaan, array($id));

                $this->load->view('pembantu/bg_atas', $data);
                $this->load->view('pembantu/profil/tbl_pekerjaan_form', $data);
                $this->load->view('pembantu/bg_bawah', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect('pembantu/profil');
            }
        }
    }

    public function update_pekerjaan()
    {
        $cek = $this->session->userdata('logged_in_ppid');
        if (empty($cek)) {
            redirect('web');
        } else {
            $aj = $this->input->post('id_profil', TRUE);
            $data = array(
                'id_profil' => $aj,
                'id_jabatanprofil' => $this->input->post('id_jabatanprofil', TRUE),
                'periode' => $this->input->post('periode', TRUE),
                'unit_kerja' => $this->input->post('unit_kerja', TRUE),
            );

            $this->Pekerjaanprofil_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect('pembantu/pekerjaan/' . $aj);
        }
    }

    public function deletepekerjaan()
    {
        $id = $this->uri->segment(3);
        $id2 = $this->uri->segment(4);
        $cek = $this->session->userdata('logged_in_ppid');
        if (empty($cek)) {
            redirect('web');
        } else {
            $row = $this->Pekerjaanprofil_model->get_by_id($id);

            if ($row) {
                $this->Pekerjaanprofil_model->delete($id);
                $this->session->set_flashdata('message', 'Delete Record Success');
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
            }
            redirect('pembantu/pekerjaan/' . $id2);
        }
    }

    public function updatepekerjaan()
    {
        $id = $this->uri->segment(3);
        $id2 = $this->uri->segment(4);
        $cek = $this->session->userdata('logged_in_ppid');
        if (empty($cek)) {
            redirect('web');
        } else {
            $row = $this->Pekerjaanprofil_model->get_by_id($id);

            if ($row) {
                $data = array(
                    'button' => 'Update',
                    'action' => site_url('pembantu/update_pekerjaan_final'),
                    'id_pekerjaanprofil' => set_value('id_pekerjaanprofil', $row->id_pekerjaanprofil),
                    'id_profil' => set_value('id_profil', $row->id_profil),
                    'id_jabatanprofil' => set_value('id_jabatanprofil', $row->id_jabatanprofil),
                    'periode' => set_value('periode', $row->periode),
                    'unit_kerja' => set_value('unit_kerja', $row->unit_kerja),
                );
                
                $data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
                $data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
                $data['instansi'] = $this->config->item('nama_instansi');
                $data['credit'] = $this->config->item('credit_aplikasi');
                $data['alamat'] = $this->config->item('alamat_instansi');

                $data["agama"] = $this->Webadmin_model->Semua_Agama();
                $data["menikah"] = $this->Webadmin_model->Semua_Menikah();
                $data["pangkat"] = $this->Webadmin_model->Semua_Pangkat();
                $data["golongan"] = $this->Webadmin_model->Semua_Golongan();
                $data["jabatan"] = $this->Webadmin_model->Semua_Jabatanprofil();
                $data["jk"] = $this->Webadmin_model->Semua_Kelamin();
                $data["skpd"] = $this->Webadmin_model->Semua_Skpd();

                $sql_pekerjaan = "SELECT tbl_pekerjaanprofil.*, tbl_skpd.skpd, tbl_jabatanprofil.jabatanprofil 
                                  FROM tbl_pekerjaanprofil 
                                  LEFT JOIN tbl_skpd ON tbl_skpd.id_skpd = tbl_pekerjaanprofil.unit_kerja 
                                  LEFT JOIN tbl_jabatanprofil ON tbl_jabatanprofil.id_jabatanprofil = tbl_pekerjaanprofil.id_jabatanprofil 
                                  WHERE tbl_pekerjaanprofil.id_profil = ? ORDER BY tbl_pekerjaanprofil.id_jabatanprofil ASC";
                $data['status_pegawai'] = $this->db->query($sql_pekerjaan, array($id2));

                $this->load->view('pembantu/bg_atas', $data);
                $this->load->view('pembantu/profil/tbl_pekerjaan_form', $data);
                $this->load->view('pembantu/bg_bawah', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect('pembantu/pekerjaan');
            }
        }
    }

    public function update_pekerjaan_final()
    {
        $cek = $this->session->userdata('logged_in_ppid');
        if (empty($cek)) {
            redirect('web');
        } else {
            $aj = $this->input->post('id_profil', TRUE);
            $data = array(
                'id_profil' => $aj,
                'id_jabatanprofil' => $this->input->post('id_jabatanprofil', TRUE),
                'periode' => $this->input->post('periode', TRUE),
                'unit_kerja' => $this->input->post('unit_kerja', TRUE),
            );

            $this->Pekerjaanprofil_model->update($this->input->post('id_pekerjaanprofil', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect('pembantu/pekerjaan/' . $aj);
        }
    }

    public function fotoku($id = '')
    {
        $cek = $this->session->userdata('logged_in_ppid');
        if (empty($cek)) {
            redirect('web');
        } else {
            $row = $this->Profil_model->get_by_id($id);

            if ($row) {
                $data = array(
                    'button' => 'Update',
                    'action' => site_url('pembantu/update_fotoprofil'),
                    'action2' => site_url('pembantu/simpan_anak'),
                    'id_anak' => set_value('id_anak'),
                    'id_profil' => set_value('id_profil', $row->id_profil),
                    'identitas_diri' => set_value('identitas_diri', $row->identitas_diri),
                    'nama_lengkap' => set_value('nama_lengkap', $row->nama_lengkap),
                    'tempat_lahir' => set_value('tempat_lahir', $row->tempat_lahir),
                    'tanggal_lahir' => set_value('tanggal_lahir', date('d-m-Y', strtotime($row->tanggal_lahir))),
                    'alamatku' => set_value('alamatku', $row->alamat),
                    'id_agama' => set_value('id_agama', $row->id_agama),
                    'hp' => set_value('hp', $row->hp),
                    'alamat_surel' => set_value('alamat_surel', $row->alamat_surel),
                    'alamat_kantor' => set_value('alamat_kantor', $row->alamat_kantor),
                    'id_menikah' => set_value('id_menikah', $row->id_menikah),
                    'nip' => set_value('nip', $row->nip),
                    'id_pangkat' => set_value('id_pangkat', $row->id_pangkat),
                    'id_golongan' => set_value('id_golongan', $row->id_golongan),
                    'id_jabatanprofil' => set_value('id_jabatanprofil', $row->id_jabatanprofil),
                    'unit_kerja' => set_value('unit_kerja', $row->unit_kerja),
                    'hobi' => set_value('hobi', $row->hobi),
                    'nama_pasangan' => set_value('nama_pasangan', $row->nama_pasangan),
                    'id_jk' => set_value('id_jk', $row->id_jk),
                    'pendidikan' => set_value('pendidikan', $row->pendidikan),
                    'foto' => set_value('foto', $row->foto),
                    'foto_profil' => set_value('foto_profil', $row->foto_profil),
                );

                $data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
                $data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
                $data['instansi'] = $this->config->item('nama_instansi');
                $data['credit'] = $this->config->item('credit_aplikasi');
                $data['alamat'] = $this->config->item('alamat_instansi');

                $data["agama"] = $this->Webadmin_model->Semua_Agama();
                $data["menikah"] = $this->Webadmin_model->Semua_Menikah();
                $data["pangkat"] = $this->Webadmin_model->Semua_Pangkat();
                $data["golongan"] = $this->Webadmin_model->Semua_Golongan();
                $data["jabatan"] = $this->Webadmin_model->Semua_Jabatanprofil();
                $data["jk"] = $this->Webadmin_model->Semua_Kelamin();
                $data["skpd"] = $this->Webadmin_model->Semua_Skpd();

                $sql_anak = "SELECT tbl_anak.*, tbl_kelamin.kelamin 
                             FROM tbl_anak 
                             LEFT JOIN tbl_kelamin ON tbl_kelamin.id_kelamin = tbl_anak.id_jk 
                             WHERE tbl_anak.id_profil = ? ORDER BY tbl_anak.id_anak DESC";
                $data['status_pegawai'] = $this->db->query($sql_anak, array($id));

                $this->load->view('pembantu/bg_atas', $data);
                $this->load->view('pembantu/profil/tbl_fotoku_form', $data);
                $this->load->view('pembantu/bg_bawah', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect('profil');
            }
        }
    }

    public function update_fotoprofil()
    {
        $cek = $this->session->userdata('logged_in_ppid');
        if (empty($cek)) {
            redirect('web');
        } else {
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->update($this->input->post('id_profil', TRUE));
            } else {
                if (empty($_FILES['userfile']['name'])) {
                    $data = array(
                        'nama_lengkap' => $this->input->post('nama_lengkap', TRUE),
                    );
                } else {
                    $config['upload_path'] = './asset/profil/';
                    $config['allowed_types'] = 'gif|jpg|jpeg|png';
                    $config['max_size'] = 5120;
                    $config['encrypt_name'] = TRUE;
                    
                    $this->load->library('upload', $config);
                    
                    if (!$this->upload->do_upload('userfile')) {
                        echo $this->upload->display_errors();
                        return; // return immediately avoiding further processing
                    } else {
                        $uploadData = $this->upload->data();
                        $data = array(
                            'nama_lengkap' => $this->input->post('nama_lengkap', TRUE),
                            'foto_profil' => $uploadData['file_name'],
                        );
                    }
                }

                $this->Profil_model->update($this->input->post('id_profil', TRUE), $data);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect('pembantu/profil');
            }
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nama_lengkap', 'nama lengkap', 'trim|required');
        $this->form_validation->set_rules('id_profil', 'id_profil', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}
?>