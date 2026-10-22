<?php

namespace App\Controllers;

use App\Core\CI_Controller;

#[\AllowDynamicProperties]
class Web extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Memuat library dan helper yang dibutuhkan secara global
        $this->load->model('News_model');
        $this->load->helper('date');
        $this->load->library('pagination');
        $this->load->library('user_agent');
    }

    function index()
    {
        $data['h2_title'] = 'PPID Kabupaten Bengkalis';
        $data['h2_desc'] = 'Website Resmi PPID Kabupaten Bengkalis Riau,Indonesia';
        $data['h2_kecil'] = "logo.png";
        $data['breadcrumb'] = 'Headline';
        $data["menu_atas"] = $this->News_model->Menu_Atas();
        $data["menu_bawah"] = $this->News_model->Menu_Bawah();
        $data["agenda"] = $this->News_model->Side_Agenda();
        $data["banner"] = $this->News_model->Side_Banner();
        $data["video"] = $this->News_model->Side_Video();
        $data["paper"] = $this->News_model->Side_Paper();
        $data["pengumuman"] = $this->News_model->Side_Pengumuman();
        $data["pegawai"] = $this->News_model->Pegawai();
        $data["cuplikan_galeri"] = $this->News_model->Tampil_Galeri();
        $data["download"] = $this->News_model->Side_Download();
        $data["bawah"] = $this->News_model->Berita_Bawah();
        $data["bawah2"] = $this->News_model->Berita_Bawah2();
        $data["peristiwa"] = $this->News_model->Berita_Peristiwa();
        $data["soal_polling"] = $this->News_model->Tampil_Polling();
        $data["absen"] = $this->News_model->Side_Absen();
        $data["par"] = $this->News_model->Semua_Menutypeku();
        $data["transparansi"] = $this->News_model->Side_Transparansi();
        $data["jenistrans"] = $this->News_model->Jenis_Transparansi();
        $data["penghargaan"] = $this->News_model->Berita_Penghargaan();
        $data["skpd"] = $this->News_model->Skpd();
        $data["profilku"] = $this->News_model->Profil();
        
        $soal_poll = $data["soal_polling"];
        $id_soal = 0;
        foreach ($soal_poll->result() as $soal) {
            $id_soal = $soal->id_soal_poll;
        }
        $data["jawaban_polling"] = $this->News_model->Tampil_Jwb_Poll($id_soal);
        $data["counter_pengunjung"] = $this->News_model->Counter_Pengunjung();
        
        setcookie("pengunjung", "sudah berkunjung", time() + 900 * 24, "/");
        if (!isset($_COOKIE["pengunjung"])) {
            $this->News_model->Update_Pengunjung();
        }
        
        $data["browser"] = $this->agent->browser() . ' ' . $this->agent->version();
        $data["os"] = $this->agent->platform();

        // Statistik
        $data["pemohon"] = $this->News_model->Jumlah_Pemohon();
        $data["permohonan"] = $this->News_model->Jumlah_Permohonan();
        $data["penyediaan"] = $this->News_model->Jumlah_Infomasi();
        $data["tolak"] = $this->News_model->Jumlah_Tolak();
        $data["keberatan"] = $this->News_model->Jumlah_Keberatan();

        $this->load->view('web/bg_atashome', $data);
        $this->load->view('web/bg_home', $data);
        $this->load->view('web/isi_index', $data);
        $this->load->view('web/bg_bawahrumah', $data);
    }

    function statis()
    {
        $id = $this->uri->segment(3) !== FALSE ? $this->uri->segment(3) : '';
        $am = $id;
        $data['id2'] = $this->uri->segment(4);
        $data['h2_desc'] = 'Website Resmi PPID Kabupaten Bengkalis Riau,Indonesia';
        $data['h2_kecil'] = $this->config->item('nama_aplikasi_pendek');
        $data['full'] = $this->config->item('nama_aplikasi_full');
        $data['alamat'] = $this->config->item('alamat');
        $data['breadcrumb'] = 'Profil';
        $data['url'] = base_url() . 'web/statis/' . $id . '/';
        $data['url2'] = base_url() . 'web/cetakstatis/' . $id;
        $data["menu_atas"] = $this->News_model->Menu_Atas();
        $data["menu_bawah"] = $this->News_model->Menu_Bawah();
        $data["top"] = $this->News_model->Berita_Top();
        $data["link3"] = $this->News_model->Side_Link2();
        $data["link4"] = $this->News_model->Side_Link3();
        $data["arsipkategori"] = $this->News_model->Berita_Arsip();
        $data["agenda"] = $this->News_model->Side_Agenda();
        $data["pengumuman2"] = $this->News_model->Side_Statis($data['id2']);
        $data["detail"] = $this->News_model->Data_Statis($id);

        $data["halaman"] = $this->News_model->Detail_Menu2($am);
        foreach ($data["halaman"]->result() as $soal) {
            $title = $soal->title;
            $data['h2_title'] = $title . ' | ' . $this->config->item('instansi');
            $data['kategori'] = $title;
        }
        
        $this->load->view('web/bg_atas', $data);
        $this->load->view('web/data_statis', $data);
        $this->load->view('web/bg_kiridetailstatis', $data);
        $this->load->view('web/bg_bawah', $data);
    }

    function cetakstatis()
    {
        $id = $this->uri->segment(3) !== FALSE ? $this->uri->segment(3) : '';
        $data['id2'] = $this->uri->segment(4);
        $data['h2_title'] = $this->config->item('instansi');
        $data['h2_desc'] = 'Website Resmi PPID Kabupaten Bengkalis Riau,Indonesia';
        $data['h2_kecil'] = $this->config->item('nama_aplikasi_pendek');
        $data['full'] = $this->config->item('nama_aplikasi_full');
        $data['alamat'] = $this->config->item('alamat');
        $data['breadcrumb'] = 'Profil';
        $data['url'] = base_url() . 'web/statis/' . $id . '/';
        $data['url2'] = base_url() . 'web/cetakstatis/' . $id;
        $data["menu_atas"] = $this->News_model->Menu_Atas();
        $data["menu_bawah"] = $this->News_model->Menu_Bawah();
        $data["top"] = $this->News_model->Berita_Top();
        $data["link3"] = $this->News_model->Side_Link2();
        $data["link4"] = $this->News_model->Side_Link3();
        $data["arsipkategori"] = $this->News_model->Berita_Arsip();
        $data["agenda"] = $this->News_model->Side_Agenda();
        $data["pengumuman2"] = $this->News_model->Side_Statis($data['id2']);
        $data["detail"] = $this->News_model->Data_Statis($id);
        $this->load->view('web/bg_cetakstatis', $data);
    }

    function detailberita($id = '')
    {
        $data["menu_atas"] = $this->News_model->Menu_Atas();
        $data["menu_bawah"] = $this->News_model->Menu_Bawah();
        $data["top"] = $this->News_model->Berita_Top();
        $data["link3"] = $this->News_model->Side_Link2();
        $data["link4"] = $this->News_model->Side_Link3();
        $data["arsipkategori"] = $this->News_model->Berita_Arsip();
        $data["agenda"] = $this->News_model->Side_Agenda();
        $data["pengumuman"] = $this->News_model->Side_Pengumuman();
        $data["detail"] = $this->News_model->Detail_Berita($id);
        
        foreach ($data["detail"]->result() as $soal) {
            $id_soal = $soal->judul_berita;
            $data['h2_title'] = $id_soal;
            $data['h2_kecil'] = $this->config->item('nama_aplikasi_pendek');
            $data['full'] = $this->config->item('nama_aplikasi_full');
            $data['alamat'] = $this->config->item('alamat');
            $data['h2_desc'] = strip_tags(substr($soal->isi, 0, 300));
            $data['judul_berita'] = $soal->judul_berita;
            $data['tanggal'] = $soal->tanggal;
            $data['waktu'] = $soal->waktu;
            $data['isi'] = $soal->isi;
            $data['id_berita'] = $soal->id_berita;
            $data['url'] = $soal->url;
            $data['gambar'] = $soal->gambar;
            $data['counter'] = $soal->counter;
            $data['id_kategori'] = $soal->id_kategori;
            $data['kategori'] = $soal->title;
            $data['permalink'] = $soal->permalink;
            $data['ket_foto'] = $soal->ket_foto;
            $data['anak'] = $soal->anak;
            $data['edi'] = $soal->editor;
            $data['rep'] = $soal->reporter;
            $data['foto'] = $soal->video;
            $data['breadcrumb'] = "Detail Berita";
            $data['linked'] = $soal->url;
        }
        $this->News_model->Update_Counter_Berita($id);
        $this->load->view('web/bg_atasdetail', $data);
        $this->load->view('web/bg_detail', $data);
        $this->load->view('web/bg_kiridetailberita', $data);
        $this->load->view('web/bg_bawah', $data);
    }

    function cetakberita($id = '')
    {
        $data["menu_atas"] = $this->News_model->Menu_Atas();
        $data["menu_bawah"] = $this->News_model->Menu_Bawah();
        $data["top"] = $this->News_model->Berita_Top();
        $data["link3"] = $this->News_model->Side_Link2();
        $data["link4"] = $this->News_model->Side_Link3();
        $data["arsipkategori"] = $this->News_model->Berita_Arsip();
        $data["agenda"] = $this->News_model->Side_Agenda();
        $data["pengumuman"] = $this->News_model->Side_Pengumuman();
        $data["detail"] = $this->News_model->Detail_Berita($id);
        
        foreach ($data["detail"]->result() as $soal) {
            $id_soal = $soal->judul_berita;
            $data['h2_title'] = $id_soal;
            $data['h2_kecil'] = $this->config->item('nama_aplikasi_pendek');
            $data['full'] = $this->config->item('nama_aplikasi_full');
            $data['alamat'] = $this->config->item('alamat');
            $data['h2_desc'] = urlencode(substr($soal->isi, 0, 300));
            $data['judul_berita'] = $soal->judul_berita;
            $data['tanggal'] = $soal->tanggal;
            $data['waktu'] = $soal->waktu;
            $data['isi'] = $soal->isi;
            $data['id_berita'] = $soal->id_berita;
            $data['url'] = $soal->url;
            $data['gambar'] = $soal->gambar;
            $data['counter'] = $soal->counter;
            $data['id_kategori'] = $soal->id_kategori;
            $data['kategori'] = $soal->nama_kategori;
            $data['permalink'] = $soal->permalink;
            $data['ket_foto'] = $soal->ket_foto;
            $data['anak'] = $soal->anak;
            $data['edi'] = $soal->editor;
            $data['rep'] = $soal->reporter;
            $data['foto'] = $soal->video;
            $data['breadcrumb'] = "Detail Berita";
        }
        $this->load->view('web/bg_detailcetak', $data);
    }

    function detailopini($id = '')
    {
        $data["menu_atas"] = $this->News_model->Menu_Atas();
        $data["menu_bawah"] = $this->News_model->Menu_Bawah();
        $data["top"] = $this->News_model->Berita_Top();
        $data["link3"] = $this->News_model->Side_Link2();
        $data["link4"] = $this->News_model->Side_Link3();
        $data["arsipkategori"] = $this->News_model->Berita_Arsip();
        $data["agenda"] = $this->News_model->Side_Agenda();
        $data["pengumuman"] = $this->News_model->Side_Pengumuman();
        $data["detail"] = $this->News_model->Detail_Berita($id);
        
        foreach ($data["detail"]->result() as $soal) {
            $id_soal = $soal->judul_berita;
            $data['h2_title'] = $id_soal;
            $data['h2_kecil'] = $this->config->item('nama_aplikasi_pendek');
            $data['full'] = $this->config->item('nama_aplikasi_full');
            $data['alamat'] = $this->config->item('alamat');
            $data['h2_desc'] = urlencode(substr($soal->isi, 0, 300));
            $data['judul_berita'] = $soal->judul_berita;
            $data['tanggal'] = $soal->tanggal;
            $data['waktu'] = $soal->waktu;
            $data['isi'] = $soal->isi;
            $data['lead'] = $soal->lite;
            $data['id_berita'] = $soal->id_berita;
            $data['url'] = $soal->url;
            $data['gambar'] = $soal->gambar;
            $data['counter'] = $soal->counter;
            $data['id_kategori'] = $soal->id_kategori;
            $data['kategori'] = $soal->nama_kategori;
            $data['permalink'] = $soal->permalink;
            $data['ket_foto'] = $soal->ket_foto;
            $data['anak'] = $soal->anak;
            $data['edi'] = $soal->editor;
            $data['rep'] = $soal->reporter;
            $data['ig'] = $soal->ig;
            $data['email'] = $soal->email;
            $data['foto'] = $soal->video;
            $data['breadcrumb'] = "Detail Berita";
        }
        $this->News_model->Update_Counter_Berita($id);

        $this->load->view('web/bg_atasdetailcoretan', $data);
        $this->load->view('web/bg_detailcoretan', $data);
        $this->load->view('web/bg_kiridetailcoretan', $data);
        $this->load->view('web/bg_bawah', $data);
    }

    function detailberitafoto($id = '')
    {
        $data["menu_atas"] = $this->News_model->Menu_Atas();
        $data["menu_bawah"] = $this->News_model->Menu_Bawah();
        $data["top"] = $this->News_model->Berita_Top();
        $data["link3"] = $this->News_model->Side_Link2();
        $data["link4"] = $this->News_model->Side_Link3();
        $data["arsipkategori"] = $this->News_model->Berita_Arsip();
        $data["agenda"] = $this->News_model->Side_Agenda();
        $data["pengumuman"] = $this->News_model->Side_Pengumuman();
        $data["detail"] = $this->News_model->Detail_Beritafoto($id);
        
        foreach ($data["detail"]->result() as $soal) {
            $id_soal = $soal->judul_beritafoto;
            $data['h2_title'] = $id_soal;
            $data['h2_kecil'] = $this->config->item('nama_aplikasi_pendek');
            $data['full'] = $this->config->item('nama_aplikasi_full');
            $data['alamat'] = $this->config->item('alamat');
            $data['h2_desc'] = urlencode(substr($soal->isi, 0, 100));
            $data['judul_berita'] = $soal->judul_beritafoto;
            $data['tanggal'] = $soal->tanggal;
            $data['waktu'] = $soal->waktu;
            $data['foto'] = $soal->penulis;
            $data['isi'] = $soal->isi;
            $data['id_berita'] = $soal->id_beritafoto;
            $data['gambar'] = $soal->gambar;
            $data['breadcrumb'] = "Detail Berita Foto";
        }

        $this->load->view('web/bg_atasdetailfoto', $data);
        $this->load->view('web/bg_detailfotoall', $data);
        $this->load->view('web/bg_kiridetailumum', $data);
        $this->load->view('web/bg_bawah', $data);
    }

    function detailpenghagargaan($id = '')
    {
        $data["menu_atas"] = $this->News_model->Menu_Atas();
        $data["menu_bawah"] = $this->News_model->Menu_Bawah();
        $data["top"] = $this->News_model->Berita_Top();
        $data["link3"] = $this->News_model->Side_Link2();
        $data["link4"] = $this->News_model->Side_Link3();
        $data["arsipkategori"] = $this->News_model->Berita_Arsip();
        $data["agenda"] = $this->News_model->Side_Agenda();
        $data["pengumuman"] = $this->News_model->Side_Pengumuman();
        $data["detail"] = $this->News_model->Detail_Penghagargaan($id);
        
        foreach ($data["detail"]->result() as $soal) {
            $id_soal = $soal->judul_penghargaan;
            $data['h2_title'] = $id_soal;
            $data['h2_kecil'] = $this->config->item('nama_aplikasi_pendek');
            $data['full'] = $this->config->item('nama_aplikasi_full');
            $data['alamat'] = $this->config->item('alamat');
            $data['h2_desc'] = urlencode(substr($soal->isi, 0, 100));
            $data['judul_berita'] = $soal->judul_penghargaan;
            $data['tanggal'] = $soal->tanggal;
            $data['waktu'] = $soal->waktu;
            $data['foto'] = $soal->judul_penghargaan;
            $data['isi'] = $soal->isi;
            $data['id_berita'] = $soal->id_penghargaan;
            $data['gambar'] = $soal->gambar;
            $data['breadcrumb'] = "Detail Berita Foto";
        }

        $this->load->view('web/bg_atasdetailfoto', $data);
        $this->load->view('web/bg_detailpenghagargaan', $data);
        $this->load->view('web/bg_kiridetailumum', $data);
        $this->load->view('web/bg_bawah', $data);
    }

    function cetakberitafoto($id = '')
    {
        $data["menu_atas"] = $this->News_model->Menu_Atas();
        $data["menu_bawah"] = $this->News_model->Menu_Bawah();
        $data["top"] = $this->News_model->Berita_Top();
        $data["link3"] = $this->News_model->Side_Link2();
        $data["link4"] = $this->News_model->Side_Link3();
        $data["arsipkategori"] = $this->News_model->Berita_Arsip();
        $data["agenda"] = $this->News_model->Side_Agenda();
        $data["pengumuman"] = $this->News_model->Side_Pengumuman();
        $data["detail"] = $this->News_model->Detail_Beritafoto($id);
        
        foreach ($data["detail"]->result() as $soal) {
            $id_soal = $soal->judul_beritafoto;
            $data['h2_title'] = $id_soal;
            $data['h2_kecil'] = $this->config->item('nama_aplikasi_pendek');
            $data['full'] = $this->config->item('nama_aplikasi_full');
            $data['alamat'] = $this->config->item('alamat');
            $data['h2_desc'] = urlencode(substr($soal->isi, 0, 100));
            $data['judul_berita'] = $soal->judul_beritafoto;
            $data['tanggal'] = $soal->tanggal;
            $data['waktu'] = $soal->waktu;
            $data['foto'] = $soal->penulis;
            $data['isi'] = $soal->isi;
            $data['id_berita'] = $soal->id_beritafoto;
            $data['gambar'] = $soal->gambar;
            $data['breadcrumb'] = "Detail Berita Foto";
        }
        $this->load->view('web/bg_cetakberitafoto', $data);
    }

    function detailagenda()
    {
        $id_agenda = $this->uri->segment(3) !== FALSE ? $this->uri->segment(3) : '';
        $data["menu_atas"] = $this->News_model->Menu_Atas();
        $data["menu_bawah"] = $this->News_model->Menu_Bawah();
        $data["top"] = $this->News_model->Berita_Top();
        $data["link3"] = $this->News_model->Side_Link2();
        $data["link4"] = $this->News_model->Side_Link3();
        $data["arsipkategori"] = $this->News_model->Berita_Arsip();
        $data["agenda"] = $this->News_model->Side_Agenda();
        $data["pengumuman"] = $this->News_model->Side_Pengumuman();
        $data['detail'] = $this->News_model->Detail_Agenda($id_agenda);
        
        foreach ($data["detail"]->result() as $soal) {
            $id_soal = $soal->tema_agenda;
            $data['h2_title'] = $id_soal;
            $data['h2_kecil'] = $soal->tema_agenda;
            $data['h2_desc'] = urlencode(substr($soal->isi, 0, 100));
            $data['judul_berita'] = $soal->tema_agenda;
            $data['tanggal'] = $soal->tgl_mulai;
            $data['jam'] = $soal->jam;
            $data['isi'] = $soal->isi;
            $data['lokasi'] = $soal->tempat;
            $data['id_berita'] = $soal->id_agenda;
            $data['id1'] = $soal->id1;
            $data['id2'] = $soal->id2;
            $data['id3'] = $soal->id3;
            $data['make1'] = $soal->ket1; // aslinya ket1
            $data['ket1'] = $soal->ket1;
            $data['ket2'] = $soal->ket2;
            $data['ket3'] = $soal->ket3;
            $data['breadcrumb'] = "Detail Agenda";
        }

        $this->load->view('web/bg_atas', $data);
        $this->load->view('web/bg_detailagenda', $data);
        $this->load->view('web/bg_kiridetailagenda', $data);
        $this->load->view('web/bg_bawah', $data);
    }

    function detailpaper()
    {
        $id_agenda = $this->uri->segment(3) !== FALSE ? $this->uri->segment(3) : '';
        $data["menu_atas"] = $this->News_model->Menu_Atas();
        $data["menu_bawah"] = $this->News_model->Menu_Bawah();
        $data["top"] = $this->News_model->Berita_Top();
        $data["link3"] = $this->News_model->Side_Link2();
        $data["link4"] = $this->News_model->Side_Link3();
        $data["arsipkategori"] = $this->News_model->Berita_Arsip();
        $data["agenda"] = $this->News_model->Side_Agenda();
        $data["pengumuman"] = $this->News_model->Side_Pengumuman();
        $data['detail'] = $this->News_model->Detail_Paper($id_agenda);
        
        foreach ($data["detail"]->result() as $soal) {
            $id_soal = $soal->judul_paper;
            $data['h2_title'] = $id_soal;
            $data['h2_kecil'] = $soal->judul_paper;
            $data['h2_desc'] = $soal->judul_paper;
            $data['judul_berita'] = $soal->judul_paper;
            $data['tanggal'] = $soal->tanggal;
            $data['isi'] = $soal->kop_bawah;
            $data['id_berita'] = $soal->id_paper;
            $data['breadcrumb'] = "Detail Agenda";
        }
        $this->load->view('web/bg_atas', $data);
        $this->load->view('web/bg_detailpaper2', $data);
        $this->load->view('web/bg_kiridetailkosong', $data);
        $this->load->view('web/bg_bawah', $data);
    }

    function detailpengumuman()
    {
        $id_pengumuman = $this->uri->segment(3) !== FALSE ? $this->uri->segment(3) : '';
        $data["menu_atas"] = $this->News_model->Menu_Atas();
        $data["menu_bawah"] = $this->News_model->Menu_Bawah();
        $data["top"] = $this->News_model->Berita_Top();
        $data["link3"] = $this->News_model->Side_Link2();
        $data["link4"] = $this->News_model->Side_Link3();
        $data["arsipkategori"] = $this->News_model->Berita_Arsip();
        $data["agenda"] = $this->News_model->Side_Agenda();
        $data["pengumuman"] = $this->News_model->Side_Pengumuman();
        $data['detail'] = $this->News_model->Detail_Pengumuman($id_pengumuman);
        
        foreach ($data["detail"]->result() as $soal) {
            $id_soal = $soal->judul_pengumuman;
            $data['h2_title'] = $id_soal;
            $data['h2_kecil'] = $soal->judul_pengumuman;
            $data['h2_desc'] = urlencode(substr($soal->isi, 0, 100));
            $data['judul_berita'] = $soal->judul_pengumuman;
            $data['tanggal'] = $soal->tanggal;
            $data['isi'] = $soal->isi;
            $data['id_berita'] = $soal->id_pengumuman;
            $data['file'] = $soal->file;
            $data['breadcrumb'] = "Detail Pengumuman";
        }

        $this->load->view('web/bg_atas', $data);
        $this->load->view('web/bg_detailpengumuman', $data);
        $this->load->view('web/bg_kiridetailumum', $data);
        $this->load->view('web/bg_bawah', $data);
    }

    function detailroro()
    {
        $id_pengumuman = $this->uri->segment(3) !== FALSE ? $this->uri->segment(3) : '';
        $data["menu_atas"] = $this->News_model->Menu_Atas();
        $data["menu_bawah"] = $this->News_model->Menu_Bawah();
        $data["top"] = $this->News_model->Berita_Top();
        $data["link3"] = $this->News_model->Side_Link2();
        $data["link4"] = $this->News_model->Side_Link3();
        $data["arsipkategori"] = $this->News_model->Berita_Arsip();
        $data["agenda"] = $this->News_model->Side_Agenda();
        $data["pengumuman"] = $this->News_model->Side_Pengumuman();
        $data['detail'] = $this->News_model->Detail_Roro($id_pengumuman);
        
        foreach ($data["detail"]->result() as $soal) {
            $id_soal = $soal->judul;
            $data['h2_title'] = $id_soal;
            $data['h2_kecil'] = $soal->judul;
            $data['h2_desc'] = urlencode(substr($soal->judul, 0, 100));
            $data['judul_berita'] = $soal->judul;
            $data['tanggal'] = $soal->tanggal;
            $data['isi'] = $soal->keterangan;
            $data['gambar'] = $soal->foto_besar;
            $data['id_berita'] = $soal->id_tarif;
            $data['breadcrumb'] = "Detail Pengumuman";
        }
        
        // Memuat pihak ketiga/library Mobile_Detect jika digunakan
        if(class_exists('Mobile_Detect')){
            $detect = new Mobile_Detect();
            if ($detect->isMobile()) {
                redirect('mobile/detailroro/'.$id_pengumuman);
                return;
            }
        }
        
        $this->load->view('web/bg_atas', $data);
        $this->load->view('web/bg_detailroro', $data);
        $this->load->view('web/bg_kiridetailumum', $data);
        $this->load->view('web/bg_bawah', $data);
    }

    function prosesindeks()
    {
        $page = $this->uri->segment(3);
        $limit = 50;
        $offset = !$page ? 0 : $page;
        
        $data['h2_title'] = 'Disdik Kabupaten Bengkalis | Cari Indeks Berita';
        $data['breadcrumb'] = 'Cari Indeks Berita';
        $data["menu_atas"] = $this->News_model->Menu_Atas();
        $data["menu_bawah"] = $this->News_model->Menu_Bawah();
        $data["top"] = $this->News_model->Berita_Top();
        $data["link3"] = $this->News_model->Side_Link2();
        $data["link4"] = $this->News_model->Side_Link3();
        $data["arsipkategori"] = $this->News_model->Berita_Arsip();
        $data["agenda"] = $this->News_model->Side_Agenda();
        $data["pengumuman"] = $this->News_model->Side_Pengumuman();
        
        $tgl = $this->input->post('tgl_mulai', TRUE);
        $bln = $this->input->post('bln_mulai', TRUE);
        $thn = $this->input->post('thn_mulai', TRUE);
        $id = $thn . "-" . $bln . "-" . $tgl;
        
        $data["page"] = $page;
        $total = $this->News_model->Total_CariIndeks($id);
        
        $config['base_url'] = base_url() . 'web/link/berita/' . $id;
        $config['total_rows'] = $total->num_rows();
        $config['per_page'] = $limit;
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['paginator'] = $this->pagination->create_links();
        $data["semua"] = $this->News_model->Berita_CariIndeks($id, $offset, $limit);
        
        $this->load->view('web/bg_atas', $data);
        $this->load->view('web/indekscari', $data);
        $this->load->view('web/bg_kiridetailberita', $data);
        $this->load->view('web/bg_bawah', $data);
    }

    function link()
    {
        $id = $this->uri->segment(3) !== FALSE ? $this->uri->segment(3) : '';
        $am = $id;
        $data['id2'] = $id;
        $data['h2_desc'] = 'PPID Kabupaten Bengkalis';
        $data['h2_kecil'] = $this->config->item('nama_aplikasi_pendek');
        $data['full'] = $this->config->item('nama_aplikasi_full');
        $data['alamat'] = $this->config->item('alamat');
        $data['breadcrumb'] = 'Profil';
        $data['url'] = base_url() . 'web/link/' . $id . '/';
        $data["menu_atas"] = $this->News_model->Menu_Atas();
        $data["menu_bawah"] = $this->News_model->Menu_Bawah();
        $data["top"] = $this->News_model->Berita_Top();
        $data["link3"] = $this->News_model->Side_Link2();
        $data["link4"] = $this->News_model->Side_Link3();
        $data["arsipkategori"] = $this->News_model->Berita_Arsip();
        $data["agenda"] = $this->News_model->Side_Agenda();
        $data["pengumuman"] = $this->News_model->Side_Pengumuman();
        $data["detail"] = $this->News_model->Data_Statis($id);

        $data["halaman"] = $this->News_model->Detail_Menu2($am);
        foreach ($data["halaman"]->result() as $soal) {
            $title = $soal->title;
            $data['h2_title'] = $title . ' | ' . $this->config->item('instansi');
            $data['kategori'] = $title;
        }

        $this->load->view('web/bg_atas', $data);
        
        // Paginator Configuration template
        $config_p['per_page'] = 10;
        $config_p['uri_segment'] = 4;
        $config_p['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination">';
        $config_p['full_tag_close'] = '</ul></nav></div>';
        $config_p['num_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config_p['num_tag_close'] = '</span></li>';
        $config_p['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config_p['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
        $config_p['next_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config_p['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config_p['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config_p['prev_tagl_close'] = '</span></li>';
        $config_p['first_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config_p['first_tagl_close'] = '</span></li>';
        $config_p['last_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config_p['last_tagl_close'] = '</span></li>';

        if ($id == "berita") {
            $page = $this->uri->segment(4);
            $offset = !$page ? 0 : $page;
            $data["semua"] = $this->News_model->Semua_Berita($config_p['per_page'], $offset);
            $tot_hal = $this->News_model->Total_Berita();
            
            $config_p['base_url'] = base_url() . 'web/link/' . $id . '/';
            $config_p['total_rows'] = $tot_hal->num_rows();
            $this->pagination->initialize($config_p);
            $data["paginator"] = $this->pagination->create_links();
            
            $this->load->view('web/semua_beritaku', $data); // Aslinya semua_berita
            $this->load->view('web/bg_kiridetail', $data);
            $this->load->view('web/bg_bawah', $data);

        } else if ($id == "struktur-ppid-kabupaten-bengkalis") {
            $page = $this->uri->segment(4);
            $config_p['per_page'] = 100;
            $offset = !$page ? 0 : $page;
            $data["semua"] = $this->News_model->Semua_Pegawai($config_p['per_page'], $offset);
            $tot_hal = $this->News_model->Total_Pegawai();
            
            $config_p['base_url'] = base_url() . 'web/link/' . $id . '/';
            $config_p['total_rows'] = $tot_hal->num_rows();
            $this->pagination->initialize($config_p);
            $data["paginator"] = $this->pagination->create_links();
            $data["info2"] = $this->News_model->Semua_Jabatan();

            $this->load->view('web/semua_pegawai', $data);
            $this->load->view('web/bg_kiridetailkosong', $data);
            $this->load->view('web/bg_bawah', $data);
            
        } else if ($id == "ppid") {
            $page = $this->uri->segment(4);
            $config_p['per_page'] = 100;
            $offset = !$page ? 0 : $page;
            $data["utama"] = $this->News_model->Semua_PpidUtama();
            $data["semua"] = $this->News_model->Semua_Ppid($config_p['per_page'], $offset);
            $tot_hal = $this->News_model->Total_Ppid();
            
            $config_p['base_url'] = base_url() . 'web/link/' . $id . '/';
            $config_p['total_rows'] = $tot_hal->num_rows();
            $this->pagination->initialize($config_p);
            $data["paginator"] = $this->pagination->create_links();
            $data["info2"] = $this->News_model->Semua_Jabatan();

            $this->load->view('web/semua_ppid', $data);
            $this->load->view('web/bg_kiridetailkosong', $data);
            $this->load->view('web/bg_bawah', $data);
            
        } else if ($id == "survey") {
            $data["info2"] = $this->News_model->Semua_Pertanyaan();
            $data["info3"] = $this->News_model->Semua_Pekerjaan();
            $data["info4"] = $this->News_model->Semua_Layanan();
            
            $this->load->view('web/semua_survey', $data);
            $this->load->view('web/bg_kiridetailkosong', $data);
            $this->load->view('web/bg_bawah', $data);
            
        } else if ($id == "penghargaan-ppid") {
            $page = $this->uri->segment(4);
            $config_p['per_page'] = 100;
            $offset = !$page ? 0 : $page;
            $data["semua"] = $this->News_model->Semua_penghargaan($config_p['per_page'], $offset);
            $tot_hal = $this->News_model->Total_Penghargaan();
            
            $config_p['base_url'] = base_url() . 'web/link/' . $id . '/';
            $config_p['total_rows'] = $tot_hal->num_rows();
            $this->pagination->initialize($config_p);
            $data["paginator"] = $this->pagination->create_links();
            $data["info2"] = $this->News_model->Semua_Jabatan();

            $this->load->view('web/semua_penghargaan', $data);
            $this->load->view('web/bg_kiridetailkosong', $data);
            $this->load->view('web/bg_bawah', $data);
            
        } else if ($id == "profil-pejabat") {
            $this->load->model('Webadmin_model');
            $data["jabatan"] = $this->Webadmin_model->Semua_Jabatanprofil();
            $data["skpd"] = $this->Webadmin_model->Semua_Skpd();
            $data["kepala"] = $this->News_model->Semua_Kepala();
            $data["sekdaku"] = $this->News_model->Semua_Sekda();
            $data["stafku"] = $this->News_model->Semua_Staf();
            $data["asistenku"] = $this->News_model->Semua_Asisten();
            $data["perangkatku"] = $this->News_model->Semua_Perangkat();
            
            $this->load->view('web/semua_profil', $data);
            $this->load->view('web/bg_kiridetailkosong', $data);
            $this->load->view('web/bg_bawah', $data);
            
        } else if ($id == "profil-dprd") {
            $this->load->model('Webadmin_model');
            $data["jabatan"] = $this->Webadmin_model->Semua_Jabatanprofil();
            $data["skpd"] = $this->Webadmin_model->Semua_Skpd();
            $data["ketuaku"] = $this->News_model->Semua_KetuaDPRD();
            $data["wakil"] = $this->News_model->Semua_WakilDPRD();
            $data["anggota"] = $this->News_model->Semua_AnggotaDPRD();
            
            $this->load->view('web/semua_profildprd', $data);
            $this->load->view('web/bg_kiridetailkosong', $data);
            $this->load->view('web/bg_bawah', $data);
            
        } else if ($id == "profil-sekda") {
            $this->load->model('Webadmin_model');
            $data["jabatan"] = $this->Webadmin_model->Semua_Jabatanprofil();
            $data["skpd"] = $this->Webadmin_model->Semua_Skpd();
            $data["sekdaku"] = $this->News_model->Semua_Sekda();
            $data["stafku"] = $this->News_model->Semua_Staf();
            $data["asistenku"] = $this->News_model->Semua_Asisten();
            $data["kasubag"] = $this->News_model->Semua_Kasubag("8", "3");
            $data["seksi"] = $this->News_model->Semua_Kasubag("9", "3");
            $data["pns"] = $this->News_model->Semua_Kasubag("10", "3");
            $data["honorer"] = $this->News_model->Semua_Kasubag("11", "3");
            
            $this->load->view('web/semua_profilsekda', $data);
            $this->load->view('web/bg_kiridetailkosong', $data);
            $this->load->view('web/bg_bawah', $data);
            
        } else if ($id == "profil-sekwan") {
            $this->load->model('Webadmin_model');
            $data["jabatan"] = $this->Webadmin_model->Semua_Jabatanprofil();
            $data["skpd"] = $this->Webadmin_model->Semua_Skpd();
            $data["sekdaku"] = $this->News_model->Semua_Sekwan();
            $data["kabag"] = $this->News_model->Semua_Kasubag("17", "4");
            $data["kasubag"] = $this->News_model->Semua_Kasubag("8", "4");
            $data["pns"] = $this->News_model->Semua_Kasubag("10", "4");
            $data["honorer"] = $this->News_model->Semua_Kasubag("11", "4");
            
            $this->load->view('web/semua_profilsekwan', $data);
            $this->load->view('web/bg_kiridetailkosong', $data);
            $this->load->view('web/bg_bawah', $data);
            
        } else if ($id == "profil-dinas") {
            $data["utama"] = $this->News_model->Semua_PpidUtama();
            $data["semua"] = $this->News_model->Semua_Ppidku();
            
            $this->load->view('web/semua_profildinas', $data);
            $this->load->view('web/bg_kiridetailkosong', $data);
            $this->load->view('web/bg_bawah', $data);
            
        } else if ($id == "profil-kecamatan") {
            $data["utama"] = $this->News_model->Semua_PpidUtama();
            $data["semua"] = $this->News_model->Semua_Ppidku2();
            
            $this->load->view('web/semua_profilkecamatan', $data);
            $this->load->view('web/bg_kiridetailkosong', $data);
            $this->load->view('web/bg_bawah', $data);
            
        } else if ($id == "transparansi-anggaran") {
            $this->load->model('Webadmin_model');
            $data["kategori2"] = $this->Webadmin_model->Semua_Jenis();
            
            $this->load->view('web/semua_transparansi', $data);
            $this->load->view('web/bg_kiridetailkosong', $data);
            $this->load->view('web/bg_bawah10', $data);
            
        } else if ($id == "agenda") {
            $page = $this->uri->segment(4);
            $config_p['per_page'] = 25;
            $offset = !$page ? 0 : $page;
            $data["semua"] = $this->News_model->Semua_Agenda($config_p['per_page'], $offset);
            $tot_hal = $this->News_model->Total_Agenda();
            
            $config_p['base_url'] = base_url() . 'web/link/' . $id . '/';
            $config_p['total_rows'] = $tot_hal->num_rows();
            $this->pagination->initialize($config_p);
            $data["paginator"] = $this->pagination->create_links();

            $this->load->view('web/semua_agenda', $data);
            $this->load->view('web/bg_kiridetail', $data);
            $this->load->view('web/bg_bawah', $data);
            
        } else if ($id == "pengumuman") {
            $page = $this->uri->segment(4);
            $config_p['per_page'] = 25;
            $offset = !$page ? 0 : $page;
            $data["semua"] = $this->News_model->Semua_Pengumuman($config_p['per_page'], $offset);
            $tot_hal = $this->News_model->Total_Pengumuman();
            
            $config_p['base_url'] = base_url() . 'web/link/' . $id . '/';
            $config_p['total_rows'] = $tot_hal->num_rows();
            $this->pagination->initialize($config_p);
            $data["paginator"] = $this->pagination->create_links();

            $this->load->view('web/semua_pengumuman', $data);
            $this->load->view('web/bg_kiridetail', $data);
            $this->load->view('web/bg_bawah', $data);
            
        } else if ($id == "informasi-publik") {
            $page = $this->uri->segment(4);
            $offset = !$page ? 0 : $page;
            $data["semua"] = $this->News_model->Semua_Download_Indeks($config_p['per_page'], $offset);
            $tot_hal = $this->News_model->Total_Download_Indeks();
            
            $config_p['base_url'] = base_url() . 'web/link/' . $id . '/';
            $config_p['total_rows'] = $tot_hal->num_rows();
            $this->pagination->initialize($config_p);
            $data["paginator"] = $this->pagination->create_links();

            $this->load->view('web/semua_downloadindeks', $data);
            $this->load->view('web/bg_kiridetailkosong', $data);
            $this->load->view('web/bg_bawah', $data);

        } else if ($id == "permohonan-informasi-publik") {
            $this->load->view('web/form_permohonan', $data);
            $this->load->view('web/bg_kiridetailkosong', $data);
            $this->load->view('web/bg_bawah', $data);
        } else if ($id == "cek-status-permohonan-informasi-publik") {
            $this->load->view('web/form_status', $data);
            $this->load->view('web/bg_kiridetailkosong', $data);
            $this->load->view('web/bg_bawah', $data);
        } else if ($id == "permohonan-keberatan") {
            $this->load->model('Webadmin_model');
            $data["kategori2"] = $this->Webadmin_model->Semua_Skpd();
            $this->load->view('web/form_keberatan', $data);
            $this->load->view('web/bg_kiridetailmohon', $data);
            $this->load->view('web/bg_bawah', $data);
        } else if ($id == "cek-permohonan-keberatan") {
            $this->load->view('web/form_cek', $data);
            $this->load->view('web/bg_kiridetailkosong', $data);
            $this->load->view('web/bg_bawah', $data);
        } else if ($id == "laporan-permintaan-informasi-publik") {
            $this->load->view('web/form_laporan', $data);
            $this->load->view('web/bg_kiridetailkosong', $data);
            $this->load->view('web/bg_bawah', $data);
        } else if ($id == "statistik-informasi-publik") {
            $this->load->model('Webadmin_model');
            $data["kategori"] = $this->Webadmin_model->Semua_Skpd_Counter();
            $data["par"] = $this->Webadmin_model->Semua_Menutypeku();
            $data["db"] = $this->News_model->V_TotalPid2();
            $data["downloadk"] = $this->News_model->Jumlah_Unduh();
            $data["permohanan"] = $this->News_model->Jumlah_Pemohon(); // sesuai struktur asal typo
            $data["keberatan"] = $this->News_model->Jumlah_Keberatan();
            $data["selesai"] = $this->News_model->Jumlah_Selesai();
            $data["tran"] = $this->News_model->Jumlah_Trans();

            $this->load->view('web/form_laporan', $data);
            $this->load->view('web/bg_kiridetailkosong', $data);
            $this->load->view('web/bg_bawah', $data);
        } else if ($id == "form-pengaduan-layanan") {
            $this->load->view('web/form_pengaduan', $data);
            $this->load->view('web/bg_kiridetailkosong', $data);
            $this->load->view('web/bg_bawah', $data);
        } else if ($id == "rekapitulasi-permohonan") {
            $this->load->model('Webadmin_model');
            $data["kategori"] = $this->Webadmin_model->Semua_Skpd_Counter();
            $this->load->view('web/rekapitulasi-permohonan', $data);
            $this->load->view('web/bg_kiridetailkosong', $data);
            $this->load->view('web/bg_bawah', $data);
        } else if ($id == "rekapitulasi-informasi-publik") {
            $this->load->model('Webadmin_model');
            $data["kategori"] = $this->Webadmin_model->Semua_Skpd_Counter();
            $this->load->view('web/rekapitulasi-publik', $data);
            $this->load->view('web/bg_kiridetailkosong', $data);
            $this->load->view('web/bg_bawah', $data);
        } else if ($id == "rekapitulasi-keberatan") {
            $this->load->model('Webadmin_model');
            $data["kategori"] = $this->Webadmin_model->Semua_Skpd_Counter();
            $this->load->view('web/rekapitulasi-keberatan', $data);
            $this->load->view('web/bg_kiridetailkosong', $data);
            $this->load->view('web/bg_bawah', $data);
        } else if ($id == "profil") {
            redirect('web/statis/profil-ppid');
        } else if ($id == "publikasi") {
            redirect('web/berita/berita-ppid');
        } else if ($id == "pelayanan") {
            redirect('web/link/permohonan-informasi-publik');
        } else if ($id == "laporan") {
            redirect('web/link/rekapitulasi-permohonan');
        } else if ($id == "faq") {
            $data['testi2'] = $this->db->query("SELECT tbl_faq.id_faq, tbl_faq.pertanyaan, tbl_faq.jawaban FROM tbl_faq ORDER BY tbl_faq.id_faq ASC");
            $this->load->view('web/faq', $data);
            $this->load->view('web/bg_kiridetailkosong', $data);
            $this->load->view('web/bg_bawah', $data);
        } else if ($id == "galeri-kegiatan") {
            $page = $this->uri->segment(4);
            $config_p['per_page'] = 20;
            $offset = !$page ? 0 : $page;
            $data["semua"] = $this->News_model->Semua_Foto($config_p['per_page'], $offset);
            $tot_hal = $this->News_model->Total_Foto();
            
            $config_p['base_url'] = base_url() . 'web/link/' . $id . '/';
            $config_p['total_rows'] = $tot_hal->num_rows();
            $this->pagination->initialize($config_p);
            $data["paginator"] = $this->pagination->create_links();

            $this->load->view('web/semua_foto', $data);
            $this->load->view('web/bg_kiridetailkosong', $data);
            $this->load->view('web/bg_bawah', $data);
        } else if ($id == "video-informasi") {
            $page = $this->uri->segment(4);
            $config_p['per_page'] = 9;
            $offset = !$page ? 0 : $page;
            $data["semua"] = $this->News_model->Semua_Video($config_p['per_page'], $offset);
            $tot_hal = $this->News_model->Total_Video();
            
            $config_p['base_url'] = base_url() . 'web/link/' . $id . '/';
            $config_p['total_rows'] = $tot_hal->num_rows();
            $this->pagination->initialize($config_p);
            $data["paginator"] = $this->pagination->create_links();

            $this->load->view('web/bg_detailvideo', $data);
            $this->load->view('web/bg_kiridetailkosong', $data);
            $this->load->view('web/bg_bawah', $data);
        } else if ($id == "e-paper") {
            $page = $this->uri->segment(4);
            $config_p['per_page'] = 1;
            $offset = !$page ? 0 : $page;
            $data["semua"] = $this->News_model->Semua_Paper($config_p['per_page'], $offset);
            $tot_hal = $this->News_model->Total_Paper();
            
            $config_p['base_url'] = base_url() . 'web/link/' . $id . '/';
            $config_p['total_rows'] = $tot_hal->num_rows();
            $this->pagination->initialize($config_p);
            $data["paginator"] = $this->pagination->create_links();

            $this->load->view('web/bg_detailpaper', $data);
            $this->load->view('web/bg_kiridetailbaca', $data);
            $this->load->view('web/bg_bawah', $data);
        } else if ($id == "infografis") {
            $page = $this->uri->segment(4);
            $config_p['per_page'] = 12;
            $offset = !$page ? 0 : $page;
            $data["semua"] = $this->News_model->Semua_Beritafoto($config_p['per_page'], $offset);
            $tot_hal = $this->News_model->Total_Beritafoto();
            
            $config_p['base_url'] = base_url() . 'web/link/' . $id . '/';
            $config_p['total_rows'] = $tot_hal->num_rows();
            $this->pagination->initialize($config_p);
            $data["paginator"] = $this->pagination->create_links();

            $this->load->view('web/semua_beritafoto', $data);
            $this->load->view('web/bg_kiridetailkosong', $data);
            $this->load->view('web/bg_bawah', $data);
        } else if ($id == "kontak") {
            $page = $this->uri->segment(4);
            $config_p['per_page'] = 5;
            $offset = !$page ? 0 : $page;
            $data["semua"] = $this->News_model->Semua_Kritik($config_p['per_page'], $offset);
            $tot_hal = $this->News_model->Total_Kritik();
            
            $config_p['base_url'] = base_url() . 'web/link/' . $id . '/';
            $config_p['total_rows'] = $tot_hal->num_rows();
            $this->pagination->initialize($config_p);
            $data["paginator"] = $this->pagination->create_links();

            $this->load->view('web/semua_kritik', $data);
            $this->load->view('web/bg_kiridetail', $data);
            $this->load->view('web/bg_bawah', $data);
        } else {
            $this->load->view('web/data_statis', $data);
            $this->load->view('web/bg_kiridetail', $data);
            $this->load->view('web/bg_bawah', $data);
        }
    }

    function detailpanitia($id = '')
    {
        $data['id2'] = $this->uri->segment(4);
        $data['h2_title'] = $this->config->item('instansi');
        $data['h2_desc'] = 'Website Resmi PPID Kabupaten Bengkalis Riau,Indonesia';
        $data['h2_kecil'] = $this->config->item('nama_aplikasi_pendek');
        $data['full'] = $this->config->item('nama_aplikasi_full');
        $data['alamat'] = $this->config->item('alamat');
        $data['breadcrumb'] = 'Profil';
        $data["menu_atas"] = $this->News_model->Menu_Atas();
        $data["menu_bawah"] = $this->News_model->Menu_Bawah();
        $data["top"] = $this->News_model->Berita_Top();
        $data["link3"] = $this->News_model->Side_Link2();
        $data["link4"] = $this->News_model->Side_Link3();
        $data["arsipkategori"] = $this->News_model->Berita_Arsip();
        $data["agenda"] = $this->News_model->Side_Agenda();
        
        $page = $this->uri->segment(4);
        $limit = 25;
        $offset = !$page ? 0 : $page;
        
        $data["semua"] = $this->News_model->Pencarian_Pegawai($id, $limit, $offset);
        $tot_hal = $this->News_model->Total_Pencarian_Pegawai($id);
        
        $config['base_url'] = base_url() . 'web/detailpanitia/' . $id . '/';
        $config['total_rows'] = $tot_hal->num_rows() ?? 0;
        $config['per_page'] = $limit;
        $config['uri_segment'] = 4;
        $config['first_link'] = 'Awal';
        $config['last_link'] = 'Akhir';
        $config['next_link'] = 'Selanjutnya';
        $config['prev_link'] = 'Sebelumnya';
        $this->pagination->initialize($config);
        $data["paginator"] = $this->pagination->create_links();
        $data["page"] = $page;
        $data["info2"] = $this->News_model->Semua_Jabatan();
        
        $this->load->view('web/bg_atas', $data);
        $this->load->view('web/semua_pegawai', $data);
        $this->load->view('web/bg_kiridetail', $data);
        $this->load->view('web/bg_bawah', $data);
    }

    function permohonanperiode()
    {
        $ur = $this->uri->segment(3);
        $jenisku = date('d-m-Y');
        $data['bulan'] = $ur;
        $data['tahun'] = date('Y', strtotime($jenisku));

        $data['id2'] = $this->uri->segment(4);
        $data['h2_title'] = $this->config->item('instansi');
        $data['h2_desc'] = 'Website Resmi PPID Kabupaten Bengkalis Riau,Indonesia';
        $data['h2_kecil'] = $this->config->item('nama_aplikasi_pendek');
        $data['full'] = $this->config->item('nama_aplikasi_full');
        $data['alamat'] = $this->config->item('alamat');
        $data['breadcrumb'] = 'Profil';
        $data["menu_atas"] = $this->News_model->Menu_Atas();
        $data["menu_bawah"] = $this->News_model->Menu_Bawah();
        $data["top"] = $this->News_model->Berita_Top();
        $data["link3"] = $this->News_model->Side_Link2();
        $data["link4"] = $this->News_model->Side_Link3();
        $data["arsipkategori"] = $this->News_model->Berita_Arsip();
        $data["agenda"] = $this->News_model->Side_Agenda();

        $this->load->model('Webadmin_model');
        $data["kategori"] = $this->Webadmin_model->Semua_Skpd_Counter();
        
        $this->load->view('web/bg_atas', $data);
        $this->load->view('web/rekapitulasi-permohonan2', $data);
        $this->load->view('web/bg_kiridetailkosong', $data);
        $this->load->view('web/bg_bawah', $data);
    }

    function permohonanperskpd()
    {
        $ur = $this->uri->segment(3);
        $data['bulan'] = $ur;

        $data['id2'] = $this->uri->segment(4);
        $data['h2_title'] = $this->config->item('instansi');
        $data['h2_desc'] = 'Website Resmi PPID Kabupaten Bengkalis Riau,Indonesia';
        $data['h2_kecil'] = $this->config->item('nama_aplikasi_pendek');
        $data['full'] = $this->config->item('nama_aplikasi_full');
        $data['alamat'] = $this->config->item('alamat');
        $data['breadcrumb'] = 'Profil';
        $data["menu_atas"] = $this->News_model->Menu_Atas();
        $data["menu_bawah"] = $this->News_model->Menu_Bawah();
        $data["top"] = $this->News_model->Berita_Top();
        $data["link3"] = $this->News_model->Side_Link2();
        $data["link4"] = $this->News_model->Side_Link3();
        $data["arsipkategori"] = $this->News_model->Berita_Arsip();
        $data["agenda"] = $this->News_model->Side_Agenda();

        $this->load->model('Webadmin_model');
        $data["kategori"] = $this->Webadmin_model->Semua_Skpd_Counter();
        $data["kategori2"] = $this->News_model->Detail_Skpd($ur);
        
        $this->load->view('web/bg_atas', $data);
        $this->load->view('web/rekapitulasi-permohonan3', $data);
        $this->load->view('web/bg_kiridetailkosong', $data);
        $this->load->view('web/bg_bawah', $data);
    }

    function publikperiode()
    {
        $ur = $this->uri->segment(3);
        $jenisku = date('d-m-Y');
        $data['bulan'] = $ur;
        $data['tahun'] = date('Y', strtotime($jenisku));

        $data['id2'] = $this->uri->segment(4);
        $data['h2_title'] = $this->config->item('instansi');
        $data['h2_desc'] = 'PPID Kabupaten Bengkalis';
        $data['h2_kecil'] = $this->config->item('nama_aplikasi_pendek');
        $data['full'] = $this->config->item('nama_aplikasi_full');
        $data['alamat'] = $this->config->item('alamat');
        $data['breadcrumb'] = 'Profil';
        $data["menu_atas"] = $this->News_model->Menu_Atas();
        $data["menu_bawah"] = $this->News_model->Menu_Bawah();
        $data["top"] = $this->News_model->Berita_Top();
        $data["link3"] = $this->News_model->Side_Link2();
        $data["link4"] = $this->News_model->Side_Link3();
        $data["arsipkategori"] = $this->News_model->Berita_Arsip();
        $data["agenda"] = $this->News_model->Side_Agenda();
        $data["pengumuman"] = $this->News_model->Side_Pengumuman();

        $this->load->model('Webadmin_model');
        $data["kategori"] = $this->Webadmin_model->Semua_Skpd_Counter();

        $this->load->view('web/bg_atas', $data);
        $this->load->view('web/publikperiode', $data);
        $this->load->view('web/bg_kiridetailkosong', $data);
        $this->load->view('web/bg_bawah', $data);
    }

    function publikskpd()
    {
        $ur = $this->uri->segment(3);
        $data['bulan'] = $ur;

        $data['id2'] = $this->uri->segment(4);
        $data['h2_title'] = $this->config->item('instansi');
        $data['h2_desc'] = 'Website Resmi PPID Kabupaten Bengkalis Riau,Indonesia';
        $data['h2_kecil'] = $this->config->item('nama_aplikasi_pendek');
        $data['full'] = $this->config->item('nama_aplikasi_full');
        $data['alamat'] = $this->config->item('alamat');
        $data['breadcrumb'] = 'Profil';
        $data["menu_atas"] = $this->News_model->Menu_Atas();
        $data["menu_bawah"] = $this->News_model->Menu_Bawah();
        $data["top"] = $this->News_model->Berita_Top();
        $data["link3"] = $this->News_model->Side_Link2();
        $data["link4"] = $this->News_model->Side_Link3();
        $data["arsipkategori"] = $this->News_model->Berita_Arsip();
        $data["agenda"] = $this->News_model->Side_Agenda();

        $this->load->model('Webadmin_model');
        $data["kategori"] = $this->Webadmin_model->Semua_Skpd_Counter();
        $data["kategori2"] = $this->News_model->Detail_Skpd($ur);
        
        $this->load->view('web/bg_atas', $data);
        $this->load->view('web/publikskpd', $data);
        $this->load->view('web/bg_kiridetailkosong', $data);
        $this->load->view('web/bg_bawah', $data);
    }

    function profiljabatan()
    {
        $ur = $this->uri->segment(3);
        $data['bulan'] = $ur;

        $data['id2'] = $this->uri->segment(4);
        $data['h2_title'] = $this->config->item('instansi');
        $data['h2_desc'] = 'Website Resmi PPID Kabupaten Bengkalis Riau,Indonesia';
        $data['h2_kecil'] = $this->config->item('nama_aplikasi_pendek');
        $data['full'] = $this->config->item('nama_aplikasi_full');
        $data['alamat'] = $this->config->item('alamat');
        $data['breadcrumb'] = 'Profil';
        $data["menu_atas"] = $this->News_model->Menu_Atas();
        $data["menu_bawah"] = $this->News_model->Menu_Bawah();
        $data["top"] = $this->News_model->Berita_Top();
        $data["link3"] = $this->News_model->Side_Link2();
        $data["link4"] = $this->News_model->Side_Link3();
        $data["arsipkategori"] = $this->News_model->Berita_Arsip();
        $data["agenda"] = $this->News_model->Side_Agenda();

        $this->load->model('Webadmin_model');
        $data["jabatan"] = $this->Webadmin_model->Semua_Jabatanprofil();
        $data["semua"] = $this->News_model->Semua_Profil_Jabatan($ur);
        $data["skpd"] = $this->Webadmin_model->Semua_Skpd();
        $data["id_jabatanprofil"] = $ur;

        $this->load->view('web/bg_atas', $data);
        $this->load->view('web/semua_profil', $data);
        $this->load->view('web/bg_kiridetailkosong', $data);
        $this->load->view('web/bg_bawah', $data);
    }

    function profilskpd()
    {
        $ur = $this->uri->segment(3);
        $data['bulan'] = $ur;

        $data['id2'] = $this->uri->segment(4);
        $data['h2_title'] = $this->config->item('instansi');
        $data['h2_desc'] = 'Website Resmi PPID Kabupaten Bengkalis Riau,Indonesia';
        $data['h2_kecil'] = $this->config->item('nama_aplikasi_pendek');
        $data['full'] = $this->config->item('nama_aplikasi_full');
        $data['alamat'] = $this->config->item('alamat');
        $data['breadcrumb'] = 'Profil';
        $data["menu_atas"] = $this->News_model->Menu_Atas();
        $data["menu_bawah"] = $this->News_model->Menu_Bawah();
        $data["top"] = $this->News_model->Berita_Top();
        $data["link3"] = $this->News_model->Side_Link2();
        $data["link4"] = $this->News_model->Side_Link3();
        $data["arsipkategori"] = $this->News_model->Berita_Arsip();
        $data["agenda"] = $this->News_model->Side_Agenda();

        $this->load->model('Webadmin_model');
        $data["jabatan"] = $this->Webadmin_model->Semua_Jabatanprofil();
        $data["semua"] = $this->News_model->Semua_Profil_Skpd($ur);
        $data["skpd"] = $this->Webadmin_model->Semua_Skpd();
        $data["id_skpd"] = $ur;

        $this->load->view('web/bg_atas', $data);
        $this->load->view('web/semua_profil', $data);
        $this->load->view('web/bg_kiridetailkosong', $data);
        $this->load->view('web/bg_bawah', $data);
    }

    function carisurat()
    {
        $nama_non = $this->input->post('kunci', TRUE);
        $id = urlencode($nama_non);
        $data['h2_title'] = "Pencarian Surat | PPID Kabupaten Bengkalis";
        $data['h2_kecil'] = "Pencarian Surat";
        $data['h2_desc'] = "Pencarian Surat";
        $data["menu_atas"] = $this->News_model->Menu_Atas();
        $data["menu_bawah"] = $this->News_model->Menu_Bawah();
        $data["top"] = $this->News_model->Berita_Top();
        $data["link3"] = $this->News_model->Side_Link2();
        $data["link4"] = $this->News_model->Side_Link3();
        $data["arsipkategori"] = $this->News_model->Berita_Arsip();
        $data["agenda"] = $this->News_model->Side_Agenda();
        $data["pengumuman"] = $this->News_model->Side_Pengumuman();
        
        $page = $this->uri->segment(5);
        $limit = 25;
        $offset = !$page ? 0 : $page;
        
        $data["semua"] = $this->News_model->Pencarian_Surat($id, $limit, $offset);
        $tot_hal = $this->News_model->Total_Pencarian_Surat($id);
        
        $config['base_url'] = base_url() . 'web/carisurat/' . $id . '/';
        $config['total_rows'] = $tot_hal->num_rows() ?? 0;
        $config['per_page'] = $limit;
        $config['uri_segment'] = 5;
        $config['first_link'] = 'Awal';
        $config['last_link'] = 'Akhir';
        $config['next_link'] = 'Selanjutnya';
        $config['prev_link'] = 'Sebelumnya';
        $this->pagination->initialize($config);
        $data["paginator"] = $this->pagination->create_links();
        $data["id"] = $nama_non;
        
        $this->load->view('web/bg_atas', $data);
        $this->load->view('web/semua_kritik', $data);
        $this->load->view('web/bg_kiridetail', $data);
        $this->load->view('web/bg_bawah', $data);
    }

    function caridownload()
    {
        $nama_non = $this->input->post('kunci', TRUE);
        $id = urlencode($nama_non);
        $data['h2_title'] = "Pencarian Dokumen | PPID Kabupaten Bengkalis";
        $data['h2_kecil'] = "Pencarian Dokumen";
        $data['h2_desc'] = "Pencarian Dokumen";
        $data["menu_atas"] = $this->News_model->Menu_Atas();
        $data["menu_bawah"] = $this->News_model->Menu_Bawah();
        $data["top"] = $this->News_model->Berita_Top();
        $data["link3"] = $this->News_model->Side_Link2();
        $data["link4"] = $this->News_model->Side_Link3();
        $data["arsipkategori"] = $this->News_model->Berita_Arsip();
        $data["agenda"] = $this->News_model->Side_Agenda();
        $data["pengumuman"] = $this->News_model->Side_Pengumuman();
        
        $page = $this->uri->segment(5);
        $limit = 125;
        $offset = !$page ? 0 : $page;
        
        $data["semua"] = $this->News_model->Pencarian_Download($id, $limit, $offset);
        $tot_hal = $this->News_model->Total_Pencarian_Download($id);
        
        $config['base_url'] = base_url() . 'web/caridownload/' . $id . '/';
        $config['total_rows'] = $tot_hal->num_rows() ?? 0;
        $config['per_page'] = $limit;
        $config['uri_segment'] = 5;
        $config['first_link'] = 'Awal';
        $config['last_link'] = 'Akhir';
        $config['next_link'] = 'Selanjutnya';
        $config['prev_link'] = 'Sebelumnya';
        $this->pagination->initialize($config);
        $data["paginator"] = $this->pagination->create_links();
        $data["id"] = $nama_non;
        
        $this->load->view('web/bg_atas', $data);
        $this->load->view('web/semua_downloadhasil', $data);
        $this->load->view('web/bg_kiridetailkosong', $data);
        $this->load->view('web/bg_bawah', $data);
    }

    function caripublik()
    {
        $nama_non = $this->input->post('katakunci', TRUE);
        $jenis = $this->input->post('jenis', TRUE);
        $skpd = $this->input->post('skpd', TRUE);

        // Mengamankan query gabungan string menggunakan Query Binding
        $sql = "SELECT tbl_download.kode_download, tbl_download.kode_menu, tbl_download.download, 
                       tbl_download.ket, tbl_download.counter, tbl_download.file, tbl_download.tanggal, 
                       tbl_skpd.skpd, tbl_menu.title 
                FROM tbl_download 
                LEFT JOIN tbl_menu ON tbl_menu.id = tbl_download.kode_menu 
                LEFT JOIN tbl_skpd ON tbl_skpd.id_skpd = tbl_download.id_skpd 
                WHERE tbl_download.kode_download != ''";

        $binds = array();

        if (!empty($nama_non)) {
            $sql .= " AND (tbl_download.download LIKE ? OR tbl_download.ket LIKE ?)";
            $binds[] = '%'.$nama_non.'%';
            $binds[] = '%'.$nama_non.'%';
        }
        if (!empty($jenis) && $jenis != "ac") {
            $sql .= " AND tbl_download.kode_menu = ?";
            $binds[] = $jenis;
        }
        if (!empty($skpd) && $skpd != "ac") {
            $sql .= " AND tbl_download.id_skpd = ?";
            $binds[] = $skpd;
        }

        $sql .= " ORDER BY tbl_download.kode_download DESC";

        $data['h2_title'] = "Pencarian Dokumen | PPID Kabupaten Bengkalis";
        $data['h2_kecil'] = "Pencarian Dokumen";
        $data['h2_desc'] = "Pencarian Dokumen";
        $data["menu_atas"] = $this->News_model->Menu_Atas();
        $data["menu_bawah"] = $this->News_model->Menu_Bawah();
        $data["top"] = $this->News_model->Berita_Top();
        $data["link3"] = $this->News_model->Side_Link2();
        $data["link4"] = $this->News_model->Side_Link3();
        $data["arsipkategori"] = $this->News_model->Berita_Arsip();
        $data["agenda"] = $this->News_model->Side_Agenda();
        $data["pengumuman"] = $this->News_model->Side_Pengumuman();
        
        $data["semua"] = $this->db->query($sql, $binds);
        $data["id"] = $nama_non;
        
        $this->load->view('web/bg_atas', $data);
        $this->load->view('web/semua_downloadhasilpublik', $data);
        $this->load->view('web/bg_kiridetailkosong', $data);
        $this->load->view('web/bg_bawah', $data);
    }

    function carippid()
    {
        $nama_non = $this->input->post('kunci', TRUE);
        $id = urlencode($nama_non);
        $data['h2_title'] = "Pencarian PPID Pembantu | PPID Kabupaten Bengkalis";
        $data['h2_kecil'] = "Pencarian PPID Pembantu";
        $data['h2_desc'] = "Pencarian PPID Pembantu";
        $data["menu_atas"] = $this->News_model->Menu_Atas();
        $data["menu_bawah"] = $this->News_model->Menu_Bawah();
        $data["top"] = $this->News_model->Berita_Top();
        $data["link3"] = $this->News_model->Side_Link2();
        $data["link4"] = $this->News_model->Side_Link3();
        $data["arsipkategori"] = $this->News_model->Berita_Arsip();
        $data["agenda"] = $this->News_model->Side_Agenda();
        $data["pengumuman"] = $this->News_model->Side_Pengumuman();
        
        $page = $this->uri->segment(5);
        $limit = 125;
        $offset = !$page ? 0 : $page;
        
        $data["semua"] = $this->News_model->Pencarian_Ppid($limit, $offset, $id);
        $tot_hal = $this->News_model->Total_Pencarian_Ppid($id);
        
        $config['base_url'] = base_url() . 'web/carippid/' . $id . '/';
        $config['total_rows'] = $tot_hal->num_rows() ?? 0;
        $config['per_page'] = $limit;
        $config['uri_segment'] = 5;
        $config['first_link'] = 'Awal';
        $config['last_link'] = 'Akhir';
        $config['next_link'] = 'Selanjutnya';
        $config['prev_link'] = 'Sebelumnya';
        $this->pagination->initialize($config);
        $data["paginator"] = $this->pagination->create_links();
        $data["id"] = $nama_non;
        $data["info2"] = $this->News_model->Semua_Jabatan();
        
        $this->load->view('web/bg_atas', $data);
        $this->load->view('web/semua_hasil', $data);
        $this->load->view('web/bg_kiridetailkosong', $data);
        $this->load->view('web/bg_bawah', $data);
    }

    function pencarianpublik()
    {
        $nama_non = $this->input->post('text', TRUE);
        $id = urlencode($nama_non);
        $data['h2_title'] = "Pencarian Dokumen | PPID Kabupaten Bengkalis";
        $data['h2_kecil'] = "Pencarian Dokumen";
        $data['h2_desc'] = "Pencarian Dokumen";
        $data["menu_atas"] = $this->News_model->Menu_Atas();
        $data["menu_bawah"] = $this->News_model->Menu_Bawah();
        $data["top"] = $this->News_model->Berita_Top();
        $data["link3"] = $this->News_model->Side_Link2();
        $data["link4"] = $this->News_model->Side_Link3();
        $data["arsipkategori"] = $this->News_model->Berita_Arsip();
        $data["agenda"] = $this->News_model->Side_Agenda();
        $data["pengumuman"] = $this->News_model->Side_Pengumuman();
        
        $page = $this->uri->segment(5);
        $limit = 125;
        $offset = !$page ? 0 : $page;
        
        $data["semua"] = $this->News_model->Pencarian_Download($id, $limit, $offset);
        $tot_hal = $this->News_model->Total_Pencarian_Download($id);
        
        $config['base_url'] = base_url() . 'web/pencarianpublik/' . $id . '/';
        $config['total_rows'] = $tot_hal->num_rows() ?? 0;
        $config['per_page'] = $limit;
        $config['uri_segment'] = 5;
        $config['first_link'] = 'Awal';
        $config['last_link'] = 'Akhir';
        $config['next_link'] = 'Selanjutnya';
        $config['prev_link'] = 'Sebelumnya';
        $this->pagination->initialize($config);
        $data["paginator"] = $this->pagination->create_links();
        $data["id"] = $nama_non;
        
        $this->load->view('web/bg_atas', $data);
        $this->load->view('web/semua_downloadhasil', $data);
        $this->load->view('web/bg_kiridetailkosong', $data);
        $this->load->view('web/bg_bawah', $data);
    }

    function cekstatus()
    {
        $data['h2_title'] = "Cek Status Permohonan Informasi Publik | PPID Kabupaten Bengkalis";
        $data['h2_kecil'] = "Pencarian Dokumen";
        $data['h2_desc'] = "Pencarian Dokumen";
        $data["menu_atas"] = $this->News_model->Menu_Atas();
        $data["menu_bawah"] = $this->News_model->Menu_Bawah();
        $data["top"] = $this->News_model->Berita_Top();
        $data["link3"] = $this->News_model->Side_Link2();
        $data["link4"] = $this->News_model->Side_Link3();
        $data["arsipkategori"] = $this->News_model->Berita_Arsip();
        $data["agenda"] = $this->News_model->Side_Agenda();
        $data["pengumuman"] = $this->News_model->Side_Pengumuman();
        
        $this->load->model('Webadmin_model');
        $data["kategori2"] = $this->Webadmin_model->Semua_Skpd();
        
        $id = $this->input->post('nik_no_ktp', TRUE);
        $id2 = $this->input->post('nama_lengkap', TRUE);

        $sql = "SELECT tbl_pemohon.id_pemohon, tbl_pemohon.nik, tbl_pemohon.email, tbl_pemohon.nama, 
                       tbl_pemohon.rincian, tbl_pemohon.`status`, tbl_pemohon.posted_date, tbl_pemohon.alamat, 
                       tbl_pemohon.phone, tbl_pemohon.replay, tbl_pemohon.foto, tbl_pemohon.pekerjaan, 
                       tbl_pemohon.tujuan, tbl_pemohon.id_skpd, tbl_pemohon.cara, tbl_pemohon.salinan, 
                       tbl_pemohon.cara2, tbl_skpd.skpd, tbl_jenis.jenis, tbl_pemohon.download, 
                       tbl_pemohon.pemenuhan, tbl_pemohon.ket, tbl_pemohon.status2, tbl_pemohon.register 
                FROM tbl_pemohon 
                LEFT JOIN tbl_skpd ON tbl_skpd.id_skpd = tbl_pemohon.id_skpd 
                LEFT JOIN tbl_jenis ON tbl_jenis.permalink = tbl_pemohon.jenis 
                WHERE tbl_pemohon.nik = ? AND tbl_pemohon.email = ? 
                ORDER BY tbl_pemohon.id_pemohon ASC";

        $data["semua"] = $this->db->query($sql, array($id, $id2));

        $this->load->view('web/bg_atas', $data);
        $this->load->view('web/hasil_status', $data);
        $this->load->view('web/bg_kiridetailkosong', $data);
        $this->load->view('web/bg_bawah', $data);
    }

    function cek_keberatan()
    {
        $data['h2_title'] = "Cek Status Keberatan Informasi Publik | PPID Kabupaten Bengkalis";
        $data['h2_kecil'] = "Cek Status Keberatan";
        $data['h2_desc'] = "Cek Status Keberatan";
        $data["menu_atas"] = $this->News_model->Menu_Atas();
        $data["menu_bawah"] = $this->News_model->Menu_Bawah();
        $data["top"] = $this->News_model->Berita_Top();
        $data["link3"] = $this->News_model->Side_Link2();
        $data["link4"] = $this->News_model->Side_Link3();
        $data["arsipkategori"] = $this->News_model->Berita_Arsip();
        $data["agenda"] = $this->News_model->Side_Agenda();
        $data["pengumuman"] = $this->News_model->Side_Pengumuman();
        
        $this->load->model('Webadmin_model');
        $data["kategori2"] = $this->Webadmin_model->Semua_Skpd();
        
        $id = $this->input->post('nik_no_ktp', TRUE);
        $id2 = $this->input->post('nama_lengkap', TRUE);

        $sql1 = "SELECT tbl_keberatan.id_keberatan, tbl_keberatan.nik, tbl_keberatan.nama, tbl_keberatan.email, 
                        tbl_keberatan.rincian, tbl_keberatan.`status`, tbl_keberatan.posted_date, tbl_keberatan.alamat, 
                        tbl_keberatan.phone, tbl_keberatan.replay, tbl_keberatan.foto, tbl_keberatan.pekerjaan, 
                        tbl_keberatan.tujuan, tbl_keberatan.alasan, tbl_keberatan.pemenuhan, tbl_keberatan.ket 
                 FROM tbl_keberatan 
                 WHERE tbl_keberatan.nik = ? AND tbl_keberatan.email = ? 
                 ORDER BY tbl_keberatan.id_keberatan ASC";
        $data["semua"] = $this->db->query($sql1, array($id, $id2));

        $sql2 = "SELECT tbl_pemohon.id_pemohon, tbl_pemohon.nik, tbl_pemohon.email, tbl_pemohon.nama, 
                        tbl_pemohon.rincian, tbl_pemohon.pemenuhan, tbl_pemohon.ket, tbl_pemohon.download, 
                        tbl_pemohon.`status`, tbl_pemohon.posted_date, tbl_pemohon.alamat, tbl_pemohon.phone, 
                        tbl_pemohon.replay, tbl_pemohon.foto, tbl_pemohon.pekerjaan, tbl_pemohon.tujuan, 
                        tbl_pemohon.id_skpd, tbl_pemohon.cara, tbl_pemohon.salinan, tbl_pemohon.cara2, 
                        tbl_pemohon.jenis, tbl_skpd.skpd 
                 FROM tbl_pemohon 
                 LEFT JOIN tbl_skpd ON tbl_skpd.id_skpd = tbl_pemohon.id_skpd 
                 WHERE tbl_pemohon.nik = ? AND tbl_pemohon.email = ? 
                 ORDER BY tbl_pemohon.id_pemohon ASC";
        $data["semua2"] = $this->db->query($sql2, array($id, $id2));

        $this->load->view('web/bg_atas', $data);
        $this->load->view('web/form_cekhasil', $data);
        $this->load->view('web/bg_kiridetailkosong', $data);
        $this->load->view('web/bg_bawah', $data);
    }

    function form_pemohon()
    {
        $data['h2_title'] = "Form Permohonan Informasi Publik | PPID Kabupaten Bengkalis";
        $data['h2_kecil'] = "Pencarian Dokumen";
        $data['h2_desc'] = "Pencarian Dokumen";
        $data["menu_atas"] = $this->News_model->Menu_Atas();
        $data["menu_bawah"] = $this->News_model->Menu_Bawah();
        $data["top"] = $this->News_model->Berita_Top();
        $data["link3"] = $this->News_model->Side_Link2();
        $data["link4"] = $this->News_model->Side_Link3();
        $data["arsipkategori"] = $this->News_model->Berita_Arsip();
        $data["agenda"] = $this->News_model->Side_Agenda();
        $data["pengumuman"] = $this->News_model->Side_Pengumuman();
        $this->load->model('Webadmin_model');
        $data["kategori2"] = $this->Webadmin_model->Semua_Skpd();

        $this->load->view('web/bg_atas', $data);
        $this->load->view('web/form_pemohon', $data);
        $this->load->view('web/bg_kiridetailmohon', $data);
        $this->load->view('web/bg_bawah', $data);
    }

    function form_pemohon2()
    {
        $data['h2_title'] = "Form Permohonan Informasi Publik | PPID Kabupaten Bengkalis";
        $data['h2_kecil'] = "Pencarian Dokumen";
        $data['h2_desc'] = "Pencarian Dokumen";
        $data["menu_atas"] = $this->News_model->Menu_Atas();
        $data["menu_bawah"] = $this->News_model->Menu_Bawah();
        $data["top"] = $this->News_model->Berita_Top();
        $data["link3"] = $this->News_model->Side_Link2();
        $data["link4"] = $this->News_model->Side_Link3();
        $data["arsipkategori"] = $this->News_model->Berita_Arsip();
        $data["agenda"] = $this->News_model->Side_Agenda();
        $data["pengumuman"] = $this->News_model->Side_Pengumuman();
        $this->load->model('Webadmin_model');
        $data["kategori2"] = $this->Webadmin_model->Semua_Skpd();
        $this->load->view('web/bg_atas', $data);
        $this->load->view('web/form_pemohon2', $data);
        $this->load->view('web/bg_kiridetailmohon', $data);
        $this->load->view('web/bg_bawah', $data);
    }

    function form_pemohon3()
    {
        $data['h2_title'] = "Form Permohonan Informasi Publik | PPID Kabupaten Bengkalis";
        $data['h2_kecil'] = "Form Permohonan Informasi Publik";
        $data['h2_desc'] = "Form Permohonan Informasi Publik";
        $data["menu_atas"] = $this->News_model->Menu_Atas();
        $data["menu_bawah"] = $this->News_model->Menu_Bawah();
        $data["top"] = $this->News_model->Berita_Top();
        $data["link3"] = $this->News_model->Side_Link2();
        $data["link4"] = $this->News_model->Side_Link3();
        $data["arsipkategori"] = $this->News_model->Berita_Arsip();
        $data["agenda"] = $this->News_model->Side_Agenda();
        $data["pengumuman"] = $this->News_model->Side_Pengumuman();
        $this->load->model('Webadmin_model');
        $data["kategori2"] = $this->Webadmin_model->Semua_Skpd();
        $this->load->view('web/bg_atas', $data);
        $this->load->view('web/form_pemohon3', $data);
        $this->load->view('web/bg_kiridetailmohon', $data);
        $this->load->view('web/bg_bawah', $data);
    }

    function simpanpemohon()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama_lengkap', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        if (empty($_FILES['userfile']['name'])) {
            $this->form_validation->set_rules('userfile', 'Document', 'required');
        }

        if ($this->form_validation->run() == FALSE) {
            echo "<script type='text/javascript'>alert('Inputan tidak Valid!!! Ulangi lagi.');</script>";
            echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "web/form_pemohon'>";
        } else {
            // Konfigurasi Upload File yang Aman
            $config['upload_path']   = './media/ktp/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size']      = 5120; // Maksimal 5MB
            $config['encrypt_name']  = TRUE; // Enkripsi nama file demi keamanan

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('userfile')) {
                echo $this->upload->display_errors();
            } else {
                $upload_data = $this->upload->data();
                
                $datainput['nik'] = $this->input->post('nik_no_ktp', TRUE);
                $datainput['nama'] = $this->input->post('nama_lengkap', TRUE);
                $datainput['email'] = $this->input->post('email', TRUE);
                $datainput['rincian'] = $this->input->post('rincian_informasi', TRUE);
                $datainput['alamat'] = $this->input->post('alamat', TRUE);
                $datainput['phone'] = $this->input->post('no_telepon', TRUE);
                $datainput['pekerjaan'] = $this->input->post('pekerjaan', TRUE);
                $datainput['posted_date'] = mdate("%Y-%m-%d", time());
                $datainput['tujuan'] = $this->input->post('tujuan', TRUE);
                $datainput['id_skpd'] = $this->input->post('kategori2', TRUE);
                $datainput['cara'] = $this->input->post('cara_memperoleh', TRUE);
                $datainput['salinan'] = $this->input->post('mendapatkan_salinan', TRUE);
                $datainput['cara2'] = $this->input->post('cara_mendapatkan', TRUE);
                $datainput['cara3'] = "Website";
                $datainput['jenis'] = "PRIBADI";
                $datainput["foto"] = $upload_data['file_name'];

                $this->News_model->Simpan_Pemohon($datainput);
                echo "<script type='text/javascript'>alert('Permohonan anda sudah terkirim, Kami akan melakukan Proses Verifikasi Terlebih dahulu sebelum Membalas Permohonan Anda');</script>";
                echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "web'>";
            }
        }
    }

    function Sukses()
    {
        $data['h2_title'] = "Konfirmasi Permohonan Informasi Publik | PPID Kabupaten Bengkalis";
        $data['h2_kecil'] = "Pencarian Dokumen";
        $data['h2_desc'] = "Pencarian Dokumen";
        $data["menu_atas"] = $this->News_model->Menu_Atas();
        $data["menu_bawah"] = $this->News_model->Menu_Bawah();
        $data["top"] = $this->News_model->Berita_Top();
        $data["link3"] = $this->News_model->Side_Link2();
        $data["link4"] = $this->News_model->Side_Link3();
        $data["arsipkategori"] = $this->News_model->Berita_Arsip();
        $data["agenda"] = $this->News_model->Side_Agenda();
        $data["pengumuman"] = $this->News_model->Side_Pengumuman();
        $this->load->model('Webadmin_model');
        $data["kategori2"] = $this->Webadmin_model->Semua_Skpd();
        $this->load->view('web/sukses', $data);
    }

    function simpanpemohon2()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama_lengkap', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        if (empty($_FILES['userfile']['name'])) {
            $this->form_validation->set_rules('userfile', 'Document', 'required');
        }

        if ($this->form_validation->run() == FALSE) {
            echo "<script type='text/javascript'>alert('Inputan tidak Valid!!! Ulangi lagi.');</script>";
            echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "web/form_pemohon2'>";
        } else {
            $config['upload_path']   = './media/ktp/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size']      = 5120;
            $config['encrypt_name']  = TRUE;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('userfile')) {
                echo $this->upload->display_errors();
            } else {
                $upload_data = $this->upload->data();

                $datainput['nik'] = $this->input->post('nik_no_ktp', TRUE);
                $datainput['nama'] = $this->input->post('nama_lengkap', TRUE);
                $datainput['email'] = $this->input->post('email', TRUE);
                $datainput['rincian'] = $this->input->post('rincian_informasi', TRUE);
                $datainput['alamat'] = $this->input->post('alamat', TRUE);
                $datainput['phone'] = $this->input->post('no_telepon', TRUE);
                $datainput['pekerjaan'] = $this->input->post('pekerjaan', TRUE);
                $datainput['posted_date'] = mdate("%Y-%m-%d", time());
                $datainput['tujuan'] = $this->input->post('tujuan', TRUE);
                $datainput['id_skpd'] = $this->input->post('kategori2', TRUE);
                $datainput['cara'] = $this->input->post('cara_memperoleh', TRUE);
                $datainput['salinan'] = $this->input->post('mendapatkan_salinan', TRUE);
                $datainput['cara2'] = $this->input->post('cara_mendapatkan', TRUE);
                $datainput['cara3'] = "Website";
                $datainput['jenis'] = "PERUSAHAAN";
                $datainput["foto"] = $upload_data['file_name'];

                $this->News_model->Simpan_Pemohon($datainput);
                echo "<script type='text/javascript'>alert('Permohonan anda sudah terkirim, Kami akan melakukan Proses Verifikasi Terlebih dahulu sebelum Membalas Permohonan Anda');</script>";
                echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "web'>";
            }
        }
    }

    public function uploadfotobaru()
    {
        if (!empty($_FILES['file']['name'])) {
            $config['upload_path']   = './media/ktp/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png|bmp';
            $config['max_size']      = 2048; // Maks 2MB
            $config['encrypt_name']  = TRUE;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('file')) {
                $upload_data = $this->upload->data();
                $kode = $this->input->post('id_param', TRUE);

                $data2['gambar'] = $upload_data['file_name'];
                $data2['id_pemohon'] = $kode;
                $this->load->model('Webadmin_model');
                $this->Webadmin_model->In_Polling("tbl_ktp", $data2);
            }
        }
    }

    function simpanpemohon3()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama_lengkap', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        if (empty($_FILES['userfile']['name'])) {
            $this->form_validation->set_rules('userfile', 'Document', 'required');
        }

        if ($this->form_validation->run() == FALSE) {
            echo "<script type='text/javascript'>alert('Inputan tidak Valid!!! Ulangi lagi.');</script>";
            echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "web/form_pemohon3'>";
        } else {
            $config['upload_path']   = './media/ktp/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size']      = 5120;
            $config['encrypt_name']  = TRUE;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('userfile')) {
                echo $this->upload->display_errors();
            } else {
                $upload_data = $this->upload->data();

                $datainput['id_pemohon'] = $this->input->post('id_param', TRUE);
                $datainput['nik'] = $this->input->post('nik_no_ktp', TRUE);
                $datainput['nama'] = $this->input->post('nama_lengkap', TRUE);
                $datainput['email'] = $this->input->post('email', TRUE);
                $datainput['rincian'] = $this->input->post('rincian_informasi', TRUE);
                $datainput['alamat'] = $this->input->post('alamat', TRUE);
                $datainput['phone'] = $this->input->post('no_telepon', TRUE);
                $datainput['pekerjaan'] = $this->input->post('pekerjaan', TRUE);
                $datainput['posted_date'] = mdate("%Y-%m-%d", time());
                $datainput['tujuan'] = $this->input->post('tujuan', TRUE);
                $datainput['id_skpd'] = $this->input->post('kategori2', TRUE);
                $datainput['cara'] = $this->input->post('cara_memperoleh', TRUE);
                $datainput['salinan'] = $this->input->post('mendapatkan_salinan', TRUE);
                $datainput['cara2'] = $this->input->post('cara_mendapatkan', TRUE);
                $datainput['cara3'] = "Website";
                $datainput['jenis'] = "ORMAS";
                $datainput["foto"] = $upload_data['file_name'];

                $this->News_model->Simpan_Pemohon($datainput);
                echo "<script type='text/javascript'>alert('Permohonan anda sudah terkirim, Kami akan melakukan Proses Verifikasi Terlebih dahulu sebelum Membalas Permohonan Anda');</script>";
                echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "web'>";
            }
        }
    }

    function simpankebaratan()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama_lengkap', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        if (empty($_FILES['userfile']['name'])) {
            $this->form_validation->set_rules('userfile', 'Document', 'required');
        }

        if ($this->form_validation->run() == FALSE) {
            echo "<script type='text/javascript'>alert('Inputan tidak Valid!!! Ulangi lagi.');</script>";
            echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "web/link/permohonan-keberatan'>";
        } else {
            $config['upload_path']   = './media/ktp/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size']      = 5120;
            $config['encrypt_name']  = TRUE;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('userfile')) {
                echo $this->upload->display_errors();
            } else {
                $upload_data = $this->upload->data();

                $datainput['nik'] = $this->input->post('nik_no_ktp', TRUE);
                $datainput['nama'] = $this->input->post('nama_lengkap', TRUE);
                $datainput['email'] = $this->input->post('email', TRUE);
                $datainput['rincian'] = $this->input->post('rincian_informasi', TRUE);
                $datainput['alamat'] = $this->input->post('alamat', TRUE);
                $datainput['phone'] = $this->input->post('no_telepon', TRUE);
                $datainput['pekerjaan'] = $this->input->post('pekerjaan', TRUE);
                $datainput['posted_date'] = mdate("%Y-%m-%d", time());
                $datainput['alasan'] = $this->input->post('cara_mendapatkan', TRUE);
                $datainput['tujuan'] = $this->input->post('tujuan', TRUE);
                $datainput['id_skpd'] = $this->input->post('kategori2', TRUE);
                $datainput["foto"] = $upload_data['file_name'];

                $this->News_model->Simpan_Keberatan($datainput);
                echo "<script type='text/javascript'>alert('Permohonan Keberatan anda sudah terkirim, Kami akan melakukan Proses Verifikasi Terlebih dahulu sebelum Membalas Permohonan Anda');</script>";
                echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "web'>";
            }
        }
    }

    function Sukses2()
    {
        $data['h2_title'] = "Konfirmasi Permohonan Informasi Publik | PPID Kabupaten Bengkalis";
        $data['h2_kecil'] = "Pencarian Dokumen";
        $data['h2_desc'] = "Pencarian Dokumen";
        $data["menu_atas"] = $this->News_model->Menu_Atas();
        $data["menu_bawah"] = $this->News_model->Menu_Bawah();
        $data["top"] = $this->News_model->Berita_Top();
        $data["link3"] = $this->News_model->Side_Link2();
        $data["link4"] = $this->News_model->Side_Link3();
        $data["arsipkategori"] = $this->News_model->Berita_Arsip();
        $data["agenda"] = $this->News_model->Side_Agenda();
        $data["pengumuman"] = $this->News_model->Side_Pengumuman();
        $this->load->model('Webadmin_model');
        $data["kategori2"] = $this->Webadmin_model->Semua_Skpd();
        $this->load->view('web/sukses2', $data);
    }

    function berita($id = '')
    {
        if (empty($id)) {
            $id = (string) $this->uri->segment(3);
        }
        $nominal = str_replace('-', ' ', (string) $id);
        $data['id2'] = $this->uri->segment(2);
        $data['h2_title'] = "Berita Kategori | PPID Kabupaten Bengkalis";
        $data['h2_kecil'] = $this->config->item('nama_aplikasi_pendek');
        $data['full'] = $this->config->item('nama_aplikasi_full');
        $data['alamat'] = $this->config->item('alamat');
        $data['bread'] = $nominal;
        $data["menu_atas"] = $this->News_model->Menu_Atas();
        $data["menu_bawah"] = $this->News_model->Menu_Bawah();
        $data["top"] = $this->News_model->Berita_Top();
        $data["link3"] = $this->News_model->Side_Link2();
        $data["link4"] = $this->News_model->Side_Link3();
        $data["arsipkategori"] = $this->News_model->Berita_Arsip();
        $data["agenda"] = $this->News_model->Side_Agenda();
        $data["pengumuman"] = $this->News_model->Side_Pengumuman();
        
        $page = $this->uri->segment(4);
        $limit = 10;
        $offset = !$page ? 0 : $page;
        
        $data["semua"] = $this->News_model->Semua_BeritaKat($limit, $offset, $id);
        $tot_hal = $this->News_model->Total_BeritaKat($id);
        
        $config['base_url'] = base_url() . 'web/berita/' . $id . '/';
        $config['total_rows'] = $tot_hal->num_rows() ?? 0;
        $config['per_page'] = $limit;
        $config['uri_segment'] = 4;
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
        $this->pagination->initialize($config);
        $data["paginator"] = $this->pagination->create_links();
        $data["page"] = $page;
        $data["detail"] = $this->News_model->Detail_Menu($id);
        
        foreach ($data["detail"]->result() as $soal) {
            $data['mm'] = $soal->title;
        }

        $this->load->view('web/bg_atas', $data);
        $this->load->view('web/semua_beritakat', $data);
        $this->load->view('web/bg_kiridetaildownload', $data);
        $this->load->view('web/bg_bawah', $data);
    }

    function coretan($id = '')
    {
        $nominal = str_replace('-', ' ', $id);
        $data['id2'] = $this->uri->segment(2);
        $data['h2_title'] = "Berita Kategori | PPID Kabupaten Bengkalis";
        $data['h2_kecil'] = $this->config->item('nama_aplikasi_pendek');
        $data['full'] = $this->config->item('nama_aplikasi_full');
        $data['alamat'] = $this->config->item('alamat');
        $data['bread'] = $nominal;
        $data["menu_atas"] = $this->News_model->Menu_Atas();
        $data["menu_bawah"] = $this->News_model->Menu_Bawah();
        $data["top"] = $this->News_model->Berita_Top();
        $data["link3"] = $this->News_model->Side_Link2();
        $data["link4"] = $this->News_model->Side_Link3();
        $data["arsipkategori"] = $this->News_model->Berita_Arsip();
        $data["agenda"] = $this->News_model->Side_Agenda();
        $data["pengumuman"] = $this->News_model->Side_Pengumuman();
        
        $page = $this->uri->segment(4);
        $limit = 10;
        $offset = !$page ? 0 : $page;
        
        $data["semua"] = $this->News_model->Semua_BeritaKat($limit, $offset, $id);
        $tot_hal = $this->News_model->Total_BeritaKat($id);
        
        $config['base_url'] = base_url() . 'web/coretan/' . $id . '/';
        $config['total_rows'] = $tot_hal->num_rows() ?? 0;
        $config['per_page'] = $limit;
        $config['uri_segment'] = 4;
        $config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav></div>';
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close'] = '</span></li>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
        $this->pagination->initialize($config);
        $data["paginator"] = $this->pagination->create_links();
        $data["page"] = $page;
        $data["detail"] = $this->News_model->Detail_Menu($id);
        
        foreach ($data["detail"]->result() as $soal) {
            $data['mm'] = $soal->title;
        }

        $this->load->view('web/bg_atas', $data);
        $this->load->view('web/semua_beritakatcoretan', $data);
        $this->load->view('web/bg_kiridetaildownload', $data);
        $this->load->view('web/bg_bawah', $data);
    }

    function download()
    {
        $id = $this->uri->segment(3);
        $nominal = str_replace('-', ' ', $id);
        $data['id2'] = $this->uri->segment(2);
        $data['h2_title'] = "Informasi Publik | PPID Kabupaten Bengkalis";
        $data['h2_kecil'] = $this->config->item('nama_aplikasi_pendek');
        $data['full'] = $this->config->item('nama_aplikasi_full');
        $data['alamat'] = $this->config->item('alamat');
        $data['bread'] = $nominal;
        $data["menu_atas"] = $this->News_model->Menu_Atas();
        $data["menu_bawah"] = $this->News_model->Menu_Bawah();
        $data["top"] = $this->News_model->Berita_Top();
        $data["link3"] = $this->News_model->Side_Link2();
        $data["link4"] = $this->News_model->Side_Link3();
        $data["arsipkategori"] = $this->News_model->Berita_Arsip();
        $data["agenda"] = $this->News_model->Side_Agenda();
        $data["pengumuman"] = $this->News_model->Side_Pengumuman();

        $page = $this->uri->segment(4);
        $limit = 10;
        $offset = !$page ? 0 : $page;
        
        $data["semua"] = $this->News_model->Semua_Download($limit, $offset, $id);
        $tot_hal = $this->News_model->Total_Download($id);
        
        $config['base_url'] = base_url() . 'web/download/' . $id . '/';
        $config['total_rows'] = $tot_hal->num_rows() ?? 0;
        $config['per_page'] = $limit;
        $config['uri_segment'] = 4;
        $config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav></div>';
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close'] = '</span></li>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
        $this->pagination->initialize($config);
        $data["paginator"] = $this->pagination->create_links();
        
        $this->load->view('web/bg_atas', $data);

        if ($id == "dasar-hukum") {
            $this->load->view('web/semua_pidato', $data);
        } else if ($id == "laporan-tahunan") {
            $this->load->view('web/semua_pidato2', $data);
        } else {
            $this->load->view('web/semua_download', $data);
        }
        
        $this->load->view('web/bg_kiridetailkosong', $data);
        $this->load->view('web/bg_bawah', $data);
    }

    public function detailpejabat($id = '')
    {
        $data['h2_title'] = "Profil Pejabat | PPID Kabupaten Bengkalis";
        $data['h2_kecil'] = "Detail Informasi Publik";
        $data['h2_desc'] = "Detail Informasi Publik";
        $data["menu_atas"] = $this->News_model->Menu_Atas();
        $data["menu_bawah"] = $this->News_model->Menu_Bawah();
        $data["top"] = $this->News_model->Berita_Top();
        $data["link3"] = $this->News_model->Side_Link2();
        $data["link4"] = $this->News_model->Side_Link3();
        $data["arsipkategori"] = $this->News_model->Berita_Arsip();
        $data["agenda"] = $this->News_model->Side_Agenda();
        $data["pengumuman"] = $this->News_model->Side_Pengumuman();

        // Mengamankan query dengan parameter binding
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

        $this->load->view('web/bg_atas', $data);
        $this->load->view('web/tbl_profil_read', $data);
        $this->load->view('web/bg_kiridetailkosong', $data);
        $this->load->view('web/bg_bawah', $data);
    }

    public function cetakpejabat($id = '')
    {
        $data['h2_title'] = "Profil Pejabat | PPID Kabupaten Bengkalis";
        $data['h2_kecil'] = "Detail Informasi Publik";
        $data['h2_desc'] = "Detail Informasi Publik";
        $data["menu_atas"] = $this->News_model->Menu_Atas();
        $data["menu_bawah"] = $this->News_model->Menu_Bawah();
        $data["top"] = $this->News_model->Berita_Top();
        $data["link3"] = $this->News_model->Side_Link2();
        $data["link4"] = $this->News_model->Side_Link3();
        $data["arsipkategori"] = $this->News_model->Berita_Arsip();
        $data["agenda"] = $this->News_model->Side_Agenda();
        $data["pengumuman"] = $this->News_model->Side_Pengumuman();

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

        $this->load->view('web/tbl_profil_cetak', $data);
    }

    function detailskpd()
    {
        $id = $this->uri->segment(3);
        $nominal = str_replace('-', ' ', $id);
        $data['id2'] = $this->uri->segment(2);
        
        $d = $this->News_model->Detail_Skpd($id);
        foreach ($d->result() as $soal) {
            $na = ucwords(strtolower($soal->skpd));
            $data['h2_title'] = "Informasi Publik $na | PPID Kabupaten Bengkalis";
            $data['bread'] = $na;
        }

        $data['h2_kecil'] = $this->config->item('nama_aplikasi_pendek');
        $data['full'] = $this->config->item('nama_aplikasi_full');
        $data['alamat'] = $this->config->item('alamat');

        $data["menu_atas"] = $this->News_model->Menu_Atas();
        $data["menu_bawah"] = $this->News_model->Menu_Bawah();
        $data["top"] = $this->News_model->Berita_Top();
        $data["link3"] = $this->News_model->Side_Link2();
        $data["link4"] = $this->News_model->Side_Link3();
        $data["arsipkategori"] = $this->News_model->Berita_Arsip();
        $data["agenda"] = $this->News_model->Side_Agenda();
        $data["pengumuman"] = $this->News_model->Side_Pengumuman();
        
        $page = $this->uri->segment(4);
        $limit = 10;
        $offset = !$page ? 0 : $page;
        
        $data["semua"] = $this->News_model->Semua_Downloadku($limit, $offset, $id);
        $tot_hal = $this->News_model->Total_Downloadku($id);
        
        $config['base_url'] = base_url() . 'web/detailskpd/' . $id . '/';
        $config['total_rows'] = $tot_hal->num_rows() ?? 0;
        $config['per_page'] = $limit;
        $config['uri_segment'] = 4;
        $config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav></div>';
        $this->pagination->initialize($config);
        $data["paginator"] = $this->pagination->create_links();

        $this->load->view('web/bg_atas', $data);
        $this->load->view('web/semua_downloadskpd', $data);
        $this->load->view('web/bg_kiridetailkosong', $data);
        $this->load->view('web/bg_bawah', $data);
    }

    function detailpejabatskpd()
    {
        $id = $this->uri->segment(3);
        $data['id2'] = $this->uri->segment(2);
        
        $d = $this->News_model->Detail_Skpd($id);
        foreach ($d->result() as $soal) {
            $na = ucwords(strtolower($soal->skpd));
            $data['h2_title'] = "Profil Pejabat $na | PPID Kabupaten Bengkalis";
            $data['bread'] = $na;
        }

        $data['h2_kecil'] = $this->config->item('nama_aplikasi_pendek');
        $data['full'] = $this->config->item('nama_aplikasi_full');
        $data['alamat'] = $this->config->item('alamat');

        $data["menu_atas"] = $this->News_model->Menu_Atas();
        $data["menu_bawah"] = $this->News_model->Menu_Bawah();
        $data["top"] = $this->News_model->Berita_Top();
        $data["link3"] = $this->News_model->Side_Link2();
        $data["link4"] = $this->News_model->Side_Link3();
        $data["arsipkategori"] = $this->News_model->Berita_Arsip();
        $data["agenda"] = $this->News_model->Side_Agenda();
        $data["pengumuman"] = $this->News_model->Side_Pengumuman();

        $data["kadis"] = $this->News_model->Semua_Kadis($id);
        $data["sekre"] = $this->News_model->Semua_Kasubag2("14", "5", $id);
        $data["kabid"] = $this->News_model->Semua_Kasubag2("15", "5", $id);
        $data["kasubag"] = $this->News_model->Semua_Kasubag2("8", "5", $id);
        $data["seksi"] = $this->News_model->Semua_Kasubag2("9", "5", $id);
        $data["pns"] = $this->News_model->Semua_Kasubag2("10", "5", $id);
        $data["honorer"] = $this->News_model->Semua_Kasubag2("11", "5", $id);

        $this->load->view('web/bg_atas', $data);
        $this->load->view('web/semua_detailprofildinas', $data);
        $this->load->view('web/bg_kiridetailkosong', $data);
        $this->load->view('web/bg_bawah', $data);
    }

    function detailpejabatkecamatan()
    {
        $id = $this->uri->segment(3);
        $data['id2'] = $this->uri->segment(2);
        
        $d = $this->News_model->Detail_Skpd($id);
        foreach ($d->result() as $soal) {
            $na = ucwords(strtolower($soal->skpd));
            $data['h2_title'] = "Profil Pejabat $na | PPID Kabupaten Bengkalis";
            $data['bread'] = $na;
        }

        $data['h2_kecil'] = $this->config->item('nama_aplikasi_pendek');
        $data['full'] = $this->config->item('nama_aplikasi_full');
        $data['alamat'] = $this->config->item('alamat');

        $data["menu_atas"] = $this->News_model->Menu_Atas();
        $data["menu_bawah"] = $this->News_model->Menu_Bawah();
        $data["top"] = $this->News_model->Berita_Top();
        $data["link3"] = $this->News_model->Side_Link2();
        $data["link4"] = $this->News_model->Side_Link3();
        $data["arsipkategori"] = $this->News_model->Berita_Arsip();
        $data["agenda"] = $this->News_model->Side_Agenda();
        $data["pengumuman"] = $this->News_model->Side_Pengumuman();

        $data["kadis"] = $this->News_model->Semua_Kadis2($id);
        $data["sekre"] = $this->News_model->Semua_Kasubag2("14", "6", $id);
        $data["kabid"] = $this->News_model->Semua_Kasubag2("15", "6", $id);
        $data["kasubag"] = $this->News_model->Semua_Kasubag2("8", "6", $id);
        $data["seksi"] = $this->News_model->Semua_Kasubag2("9", "6", $id);
        $data["pns"] = $this->News_model->Semua_Kasubag2("10", "6", $id);
        $data["honorer"] = $this->News_model->Semua_Kasubag2("11", "6", $id);

        $this->load->view('web/bg_atas', $data);
        $this->load->view('web/semua_detailprofilkecamatan', $data);
        $this->load->view('web/bg_kiridetailkosong', $data);
        $this->load->view('web/bg_bawah', $data);
    }

    function detailanggaran()
    {
        $id = $this->uri->segment(3);
        $data['id2'] = $this->uri->segment(2);
        
        $d = $this->News_model->Detail_Jenis($id);
        foreach ($d->result() as $soal) {
            $na = $soal->jenistransparansi;
            $data['h2_title'] = "Transparansi Anggaran $na | PPID Kabupaten Bengkalis";
            $data['bread'] = $na;
        }

        $data['h2_kecil'] = $this->config->item('nama_aplikasi_pendek');
        $data['full'] = $this->config->item('nama_aplikasi_full');
        $data['alamat'] = $this->config->item('alamat');

        $data["menu_atas"] = $this->News_model->Menu_Atas();
        $data["menu_bawah"] = $this->News_model->Menu_Bawah();
        $data["top"] = $this->News_model->Berita_Top();
        $data["link3"] = $this->News_model->Side_Link2();
        $data["link4"] = $this->News_model->Side_Link3();
        $data["arsipkategori"] = $this->News_model->Berita_Arsip();
        $data["agenda"] = $this->News_model->Side_Agenda();
        $data["pengumuman"] = $this->News_model->Side_Pengumuman();

        $page = $this->uri->segment(4);
        $limit = 10;
        $offset = !$page ? 0 : $page;
        
        $data["page"] = $page;
        $data["daftarartikel"] = $this->News_model->Semua_Transparansi($limit, $offset, $id);
        $tot_hal = $this->News_model->Total_Transparansiku($id);
        
        $config['base_url'] = base_url() . 'web/detailanggaran/' . $id . '/';
        $config['total_rows'] = $tot_hal->num_rows() ?? 0;
        $config['per_page'] = $limit;
        $config['uri_segment'] = 4;
        $config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav></div>';
        $this->pagination->initialize($config);
        $data["paginator"] = $this->pagination->create_links();
        
        $this->load->model('Webadmin_model');
        $data["kategori2"] = $this->Webadmin_model->Semua_Jenis();
        
        $this->load->view('web/bg_atas', $data);
        $this->load->view('web/semua_downloadtransparansi', $data);
        $this->load->view('web/bg_kiridetailkosong', $data);
        $this->load->view('web/bg_bawah10', $data);
    }

    function tampilkan()
    {
        $id_pengumuman = $this->uri->segment(3) !== FALSE ? $this->uri->segment(3) : '';
        $data['h2_title'] = "Detail Informasi Publik | PPID Kabupaten Bengkalis";
        $data['h2_kecil'] = "Detail Informasi Publik";
        $data['h2_desc'] = "Detail Informasi Publik";
        $data["menu_atas"] = $this->News_model->Menu_Atas();
        $data["menu_bawah"] = $this->News_model->Menu_Bawah();
        $data["top"] = $this->News_model->Berita_Top();
        $data["link3"] = $this->News_model->Side_Link2();
        $data["link4"] = $this->News_model->Side_Link3();
        $data["arsipkategori"] = $this->News_model->Berita_Arsip();
        $data["agenda"] = $this->News_model->Side_Agenda();
        $data["pengumuman"] = $this->News_model->Side_Pengumuman();
        $data["semua"] = $this->News_model->Semua_DownloadDetail($id_pengumuman);
        
        $this->load->view('web/bg_atas', $data);
        $this->load->view('web/bg_detailunduh', $data);
        $this->load->view('web/bg_kiridetaildownload', $data);
        $this->load->view('web/bg_bawah', $data);
    }

    function tampilkantransparansi()
    {
        $id_pengumuman = $this->uri->segment(3) !== FALSE ? $this->uri->segment(3) : '';
        $data['h2_title'] = "Detail Informasi Publik | PPID Kabupaten Bengkalis";
        $data['h2_kecil'] = "Detail Informasi Publik";
        $data['h2_desc'] = "Detail Informasi Publik";
        $data["menu_atas"] = $this->News_model->Menu_Atas();
        $data["menu_bawah"] = $this->News_model->Menu_Bawah();
        $data["top"] = $this->News_model->Berita_Top();
        $data["link3"] = $this->News_model->Side_Link2();
        $data["link4"] = $this->News_model->Side_Link3();
        $data["arsipkategori"] = $this->News_model->Berita_Arsip();
        $data["agenda"] = $this->News_model->Side_Agenda();
        $data["pengumuman"] = $this->News_model->Side_Pengumuman();
        $data["semua"] = $this->News_model->Semua_DownloadDetail2($id_pengumuman);
        
        $this->load->view('web/bg_atas', $data);
        $this->load->view('web/bg_detailtransparansi', $data);
        $this->load->view('web/bg_kiridetaildownload', $data);
        $this->load->view('web/bg_bawah', $data);
    }

    function unduh($id = '')
    {
        $page = $this->uri->segment(4);
        $this->News_model->Update_Counter_Download($id);
        echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "media/file/" . $page . "'>";
    }

    function unduhtransparansi($id = '')
    {
        $page = $this->uri->segment(4);
        echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "media/file/" . $page . "'>";
    }

    function unduhinformasi($id = '')
    {
        $page = $this->uri->segment(4);
        $this->News_model->Update_Counter_Download2($id);
        echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "media/file/" . $page . "'>";
    }

    function detailfoto($id = '')
    {
        $data["menu_atas"] = $this->News_model->Menu_Atas();
        $data["menu_bawah"] = $this->News_model->Menu_Bawah();
        $data["top"] = $this->News_model->Berita_Top();
        $data["link3"] = $this->News_model->Side_Link2();
        $data["link4"] = $this->News_model->Side_Link3();
        $data["arsipkategori"] = $this->News_model->Berita_Arsip();
        $data["agenda"] = $this->News_model->Side_Agenda();
        $data["pengumuman"] = $this->News_model->Side_Pengumuman();
        $data["detail"] = $this->News_model->Detail_Galeri($id);
        
        foreach ($data["detail"]->result() as $soal) {
            $id_soal = $soal->nama_album;
            $data['h2_title'] = $id_soal;
            $data['h2_kecil'] = $this->config->item('nama_aplikasi_pendek');
            $data['full'] = $this->config->item('nama_aplikasi_full');
            $data['alamat'] = $this->config->item('alamat');
            $data['h2_desc'] = urlencode(substr($soal->keterangan, 0, 100));
            $data['nama_album'] = $soal->nama_album;
            $data['tanggal'] = $soal->tanggal_album;
            $data['id_berita'] = $soal->id_album;
            $data['vv'] = $soal->penulis;
            $data['foto'] = $soal->penulis;
            $data['waktu'] = $soal->waktu;
            $data['counter'] = $soal->counter;
            $data['gambar'] = $soal->foto_besar;
            $data['isi'] = $soal->ket;
            $data['url'] = 'http://ppid.bengkaliskab.go.id/web/detailfoto/' . $id;
            $data['breadcrumb'] = "Detail Berita";
        }
        $data["semua"] = $this->News_model->Semua_Foto2();

        $this->load->view('web/bg_atas', $data);
        $this->load->view('web/bg_detailfoto', $data);
        $this->load->view('web/bg_kiridetailkosong', $data);
        $this->load->view('web/bg_bawah', $data);
    }

    function cetakgaleri($id = '')
    {
        $data["menu_atas"] = $this->News_model->Menu_Atas();
        $data["menu_bawah"] = $this->News_model->Menu_Bawah();
        $data["top"] = $this->News_model->Berita_Top();
        $data["link3"] = $this->News_model->Side_Link2();
        $data["link4"] = $this->News_model->Side_Link3();
        $data["arsipkategori"] = $this->News_model->Berita_Arsip();
        $data["agenda"] = $this->News_model->Side_Agenda();
        $data["pengumuman"] = $this->News_model->Side_Pengumuman();
        $data["detail"] = $this->News_model->Detail_Galeri($id);
        
        foreach ($data["detail"]->result() as $soal) {
            $id_soal = $soal->nama_album;
            $data['h2_title'] = $id_soal;
            $data['h2_kecil'] = $this->config->item('nama_aplikasi_pendek');
            $data['full'] = $this->config->item('nama_aplikasi_full');
            $data['alamat'] = $this->config->item('alamat');
            $data['h2_desc'] = urlencode(substr($soal->keterangan, 0, 100));
            $data['nama_album'] = $soal->nama_album;
            $data['tanggal'] = $soal->tanggal_album;
            $data['id_berita'] = $soal->id_album;
            $data['vv'] = $soal->penulis;
            $data['foto'] = $soal->penulis;
            $data['waktu'] = $soal->waktu;
            $data['counter'] = $soal->counter;
            $data['gambar'] = $soal->foto_besar;
            $data['isi'] = $soal->ket;
            $data['url'] = 'http://diskominfotik.bengkaliskab.go.id/web/detailfoto/' . $id;
            $data['breadcrumb'] = "Detail Berita";
        }
        $data["semua"] = $this->News_model->Semua_Foto2();
        $this->load->view('web/bg_detailcetakfoto', $data);
    }

    function detailvideo()
    {
        $id = $this->uri->segment(3);
        $data["menu_atas"] = $this->News_model->Menu_Atas();
        $data["menu_bawah"] = $this->News_model->Menu_Bawah();
        $data["top"] = $this->News_model->Berita_Top();
        $data["link3"] = $this->News_model->Side_Link2();
        $data["link4"] = $this->News_model->Side_Link3();
        $data["arsipkategori"] = $this->News_model->Berita_Arsip();
        $data["agenda"] = $this->News_model->Side_Agenda();
        $data["pengumuman"] = $this->News_model->Side_Pengumuman();
        $data["detail"] = $this->News_model->Detail_Video($id);
        
        foreach ($data["detail"]->result() as $soal) {
            $id_soal = $soal->judul_video;
            $data['h2_title'] = $id_soal;
            $data['h2_kecil'] = $this->config->item('nama_aplikasi_pendek');
            $data['full'] = $this->config->item('nama_aplikasi_full');
            $data['alamat'] = $this->config->item('alamat');
            $data['h2_desc'] = urlencode(substr($soal->penulis, 0, 100));
            $data['nama_album'] = $soal->judul_video;
            $data['tanggal'] = $soal->tanggal;
            $data['waktu'] = $soal->waktu;
            $data['vv'] = $soal->penulis;
            $data['id_berita'] = $id;
            $data['foto'] = $soal->penulis;
            $data['gambar'] = $soal->gambar;
            $data['isi'] = $soal->url;
            $data['url'] = 'http://diskominfotik.bengkaliskab.go.id/web/detailvideo/' . $id;
            $data['breadcrumb'] = "Detail Video";
        }
        
        $page = $this->uri->segment(5);
        $limit = 20;
        $offset = !$page ? 0 : $page;
        
        $data["semua"] = $this->News_model->Semua_Video($limit, $offset);
        $tot_hal = $this->News_model->Total_Video();
        
        $config['base_url'] = base_url() . 'web/detailvideo/' . $id . '/';
        $config['total_rows'] = $tot_hal->num_rows() ?? 0;
        $config['per_page'] = $limit;
        $config['uri_segment'] = 5;
        $config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav></div>';
        $this->pagination->initialize($config);
        $data["paginator"] = $this->pagination->create_links();

        $this->load->view('web/bg_atasdetailfoto', $data);
        $this->load->view('web/bg_detailvideo2', $data);
        $this->load->view('web/bg_kiridetailstatis', $data);
        $this->load->view('web/bg_bawah', $data);
    }

    function cetakvideo($id = '')
    {
        $data["menu_atas"] = $this->News_model->Menu_Atas();
        $data["menu_bawah"] = $this->News_model->Menu_Bawah();
        $data["top"] = $this->News_model->Berita_Top();
        $data["link3"] = $this->News_model->Side_Link2();
        $data["link4"] = $this->News_model->Side_Link3();
        $data["arsipkategori"] = $this->News_model->Berita_Arsip();
        $data["agenda"] = $this->News_model->Side_Agenda();
        $data["pengumuman"] = $this->News_model->Side_Pengumuman();
        $data["detail"] = $this->News_model->Detail_Video($id);
        
        foreach ($data["detail"]->result() as $soal) {
            $id_soal = $soal->judul_video;
            $data['h2_title'] = $id_soal;
            $data['h2_kecil'] = $this->config->item('nama_aplikasi_pendek');
            $data['full'] = $this->config->item('nama_aplikasi_full');
            $data['alamat'] = $this->config->item('alamat');
            $data['h2_desc'] = urlencode(substr($soal->penulis, 0, 100));
            $data['nama_album'] = $soal->judul_video;
            $data['tanggal'] = $soal->tanggal;
            $data['waktu'] = $soal->waktu;
            $data['vv'] = $soal->penulis;
            $data['id_berita'] = $id;
            $data['foto'] = $soal->penulis;
            $data['gambar'] = $soal->gambar;
            $data['isi'] = $soal->url;
            $data['url'] = 'http://diskominfotik.bengkaliskab.go.id/web/cetakvideo/' . $id;
            $data['breadcrumb'] = "cetak Video";
        }
        $this->load->view('web/bg_cetakvideo', $data);
    }

    function pencarian()
    {
        $nama_non = $this->input->post('q', TRUE);
        $id = urlencode($nama_non);
        $data['h2_title'] = "Pencarian Berita | PPID Kabupaten Bengkalis";
        $data['h2_kecil'] = "Pencarian Berita";
        $data['h2_desc'] = "Pencarian Berita";
        $data["menu_atas"] = $this->News_model->Menu_Atas();
        $data["menu_bawah"] = $this->News_model->Menu_Bawah();
        $data["top"] = $this->News_model->Berita_Top();
        $data["link3"] = $this->News_model->Side_Link2();
        $data["link4"] = $this->News_model->Side_Link3();
        $data["arsipkategori"] = $this->News_model->Berita_Arsip();
        $data["agenda"] = $this->News_model->Side_Agenda();
        $data["pengumuman"] = $this->News_model->Side_Pengumuman();
        
        $page = $this->uri->segment(5);
        $limit = 25;
        $offset = !$page ? 0 : $page;
        
        $data["semua"] = $this->News_model->Pencarian_Berita($id, $limit, $offset);
        $tot_hal = $this->News_model->Total_Pencarian($id);
        
        $config['base_url'] = base_url() . 'web/pencarian/' . $id . '/';
        $config['total_rows'] = $tot_hal->num_rows() ?? 0;
        $config['per_page'] = $limit;
        $config['uri_segment'] = 5;
        $config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav></div>';
        $this->pagination->initialize($config);
        $data["paginator"] = $this->pagination->create_links();
        $data["id"] = $nama_non;
        
        $this->load->view('web/bg_atas', $data);
        $this->load->view('web/bg_detailpencarian', $data);
        $this->load->view('web/bg_kiridetail', $data);
        $this->load->view('web/bg_bawah', $data);
    }

    function saran()
    {
        $data['h2_title'] = "Surat Warga";
        $data['h2_kecil'] = $this->config->item('nama_aplikasi_pendek');
        $data['full'] = $this->config->item('nama_aplikasi_full');
        $data['alamat'] = $this->config->item('alamat');
        $data["menu_atas"] = $this->News_model->Menu_Atas();
        $data["menu_bawah"] = $this->News_model->Menu_Bawah();
        $data["top"] = $this->News_model->Berita_Top();
        $data["link3"] = $this->News_model->Side_Link2();
        $data["link4"] = $this->News_model->Side_Link3();
        $data["arsipkategori"] = $this->News_model->Berita_Arsip();
        $data["agenda"] = $this->News_model->Side_Agenda();
        $data["pengumuman"] = $this->News_model->Side_Pengumuman();
        $data["page"] = 1;
        
        $this->load->view('web/bg_atas', $data);
        $this->load->view('web/bg_kontak', $data);
        $this->load->view('web/bg_kiridetailkosong', $data);
        $this->load->view('web/bg_bawah', $data);
    }

    function kirimkontak()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('komentar', 'Komentar', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            echo "<script type='text/javascript'>alert('Inputan tidak Valid!!! Ulangi lagi.');</script>";
            echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "web/saran'>";
        } else {
            $datainput['nama'] = urlencode($this->input->post('nama', TRUE));
            $datainput['email'] = urlencode($this->input->post('email', TRUE));
            $datainput['pesan'] = urlencode($this->input->post('komentar', TRUE));
            $datainput['alamat'] = urlencode($this->input->post('alamat', TRUE));
            $datainput['phone'] = urlencode($this->input->post('phone', TRUE));
            $datainput['pekerjaan'] = $this->input->post('pekerjaan', TRUE);
            $datainput['posted_date'] = mdate("%Y-%m-%d", time());

            if (empty($_FILES['userfile']['name'])) {
                $this->News_model->Simpan_Kontak($datainput);
                echo "<script type='text/javascript'>alert('Komentar anda sudah terkirim, Redaksi akan melakukan Proses Verifikasi Terlebih dahulu sebelum Ditampilkan');</script>";
                echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "web/link/kontak'>";
            } else {
                // Proses upload gambar yang aman
                $config['upload_path']   = './asset/banner/';
                $config['allowed_types'] = 'jpeg|jpg|png';
                $config['max_size']      = 2048;
                $config['encrypt_name']  = TRUE;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('userfile')) {
                    echo "Gagal melakukan proses upload file. Terlalu besar atau ekstensi tidak diizinkan.";
                    exit;
                } else {
                    $upload_data = $this->upload->data();
                    $datainput["foto"] = $upload_data['file_name'];
                    
                    $this->News_model->Simpan_Kontak($datainput);
                    echo "<script type='text/javascript'>alert('Testimoni anda sudah terkirim, Kami akan melakukan Proses Verifikasi Terlebih dahulu sebelum Ditampilkan');</script>";
                    echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "web/link/kontak-kami'>";
                }
            }
        }
    }

    function hasilpolling()
    {
        $data = array();
        $data["counter_pengunjung"] = $this->News_model->Counter_Pengunjung();
        setcookie("pengunjung", "sudah berkunjung", time() + 900 * 24, "/");
        if (!isset($_COOKIE["pengunjung"])) {
            $this->News_model->Update_Pengunjung();
        }
        
        $pilih = $this->input->post('polling', TRUE);
        setcookie("poling", "sudah poling", time() + 3600 * 24, "/");
        
        if (isset($_COOKIE["poling"])) {
            echo "<script type='text/javascript'>alert('Maaf, anda sudah mengisi polling ini!!! Setiap hari, hanya bisa mengisi satu kali. Silahkan vote kembali besok.');</script>";
            echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "web/lihathasil'>";
        } else {
            $this->News_model->Update_Polling($pilih);
            $data["soal_polling"] = $this->News_model->Tampil_Polling();
            $soal_poll = $data["soal_polling"];
            $id_soal = 0;
            foreach ($soal_poll->result() as $soal) {
                $id_soal = $soal->id_soal_poll;
            }
            $data["jawaban_polling"] = $this->News_model->Tampil_Jwb_Poll($id_soal);
            $data['h2_title'] = $this->config->item('instansi');
            $data['h2_kecil'] = $this->config->item('nama_aplikasi_pendek');
            $data['full'] = $this->config->item('nama_aplikasi_full');
            $data['alamat'] = $this->config->item('alamat');
            $data['h2_desc'] = '';
            $data['breadcrumb'] = 'Headline';
            $data['url'] = $this->config->item('base_url');
            $data["menu_atas"] = $this->News_model->Menu_Atas();
            $data["menu_bawah"] = $this->News_model->Menu_Bawah();
            $data["top"] = $this->News_model->Berita_Top();
            $data["link3"] = $this->News_model->Side_Link2();
            $data["link4"] = $this->News_model->Side_Link3();
            $data["arsipkategori"] = $this->News_model->Berita_Arsip();
            $data["agenda"] = $this->News_model->Side_Agenda();
            $data["pengumuman"] = $this->News_model->Side_Pengumuman();
            
            $this->load->view('web/bg_atas', $data);
            $this->load->view('web/hasil_polling', $data);
            $this->load->view('web/bg_kiridetail');
            $this->load->view('web/bg_bawah', $data);
        }
    }

    function lihathasil()
    {
        $data = array();
        $data["counter_pengunjung"] = $this->News_model->Counter_Pengunjung();
        setcookie("pengunjung", "sudah berkunjung", time() + 900 * 24, "/");
        if (!isset($_COOKIE["pengunjung"])) {
            $this->News_model->Update_Pengunjung();
        }
        
        $data["soal_polling"] = $this->News_model->Tampil_Polling();
        $soal_poll = $data["soal_polling"];
        $id_soal = 0;
        foreach ($soal_poll->result() as $soal) {
            $id_soal = $soal->id_soal_poll;
        }
        $data["jawaban_polling"] = $this->News_model->Tampil_Jwb_Poll($id_soal);
        $data['h2_title'] = $this->config->item('instansi');
        $data['h2_kecil'] = $this->config->item('nama_aplikasi_pendek');
        $data['full'] = $this->config->item('nama_aplikasi_full');
        $data['alamat'] = $this->config->item('alamat');
        $data['h2_desc'] = '';
        $data['breadcrumb'] = 'Headline';
        $data['url'] = $this->config->item('base_url');
        $data["menu_atas"] = $this->News_model->Menu_Atas();
        $data["menu_bawah"] = $this->News_model->Menu_Bawah();
        $data["top"] = $this->News_model->Berita_Top();
        $data["link3"] = $this->News_model->Side_Link2();
        $data["link4"] = $this->News_model->Side_Link3();
        $data["arsipkategori"] = $this->News_model->Berita_Arsip();
        $data["agenda"] = $this->News_model->Side_Agenda();
        $data["pengumuman"] = $this->News_model->Side_Pengumuman();
        
        $this->load->view('web/bg_atas', $data);
        $this->load->view('web/hasil_polling', $data);
        $this->load->view('web/bg_kiridetail');
        $this->load->view('web/bg_bawah', $data);
    }

    function detailsdm($id = '')
    {
        $data['h2_title'] = "Sumber Daya Manusia";
        $data['h2_kecil'] = $this->config->item('nama_aplikasi_pendek');
        $data['full'] = $this->config->item('nama_aplikasi_full');
        $data['alamat'] = $this->config->item('alamat');
        $data["menu_atas"] = $this->News_model->Menu_Atas();
        $data["menu_bawah"] = $this->News_model->Menu_Bawah();
        $data["agenda"] = $this->News_model->Side_Agenda();
        $data["pengumuman"] = $this->News_model->Side_Pengumuman();
        
        $page = $this->uri->segment(4);
        $limit = 25;
        $offset = !$page ? 0 : $page;
        
        $data["semua"] = $this->News_model->Pencarian_Pegawai($id, $limit, $offset);
        $tot_hal = $this->News_model->Total_Pencarian_Pegawai($id);
        
        $config['base_url'] = base_url() . 'web/detailsdm/' . $id . '/';
        $config['total_rows'] = $tot_hal->num_rows() ?? 0;
        $config['per_page'] = $limit;
        $config['uri_segment'] = 4;
        $config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav></div>';
        $this->pagination->initialize($config);
        $data["paginator"] = $this->pagination->create_links();
        $data["page"] = $page;
        $data["info2"] = $this->News_model->Semua_Jabatan();
        
        $this->load->view('web/bg_atas', $data);
        $this->load->view('web/bg_detailsdm', $data);
        $this->load->view('web/bg_kiridetail', $data);
        $this->load->view('web/bg_widgetdetail', $data);
        $this->load->view('web/bg_bawah', $data);
    }

// ====================================================================
    // FUNGSI BANTUAN ANTI BRUTE FORCE (MENGGUNAKAN FILE JSON)
    // ====================================================================

    // Menentukan lokasi file log (Pastikan folder writable/logs/ memiliki hak akses write/tulis)
    private $log_file = WRITEPATH . 'logs/brute_force.json';

    private function _get_brute_force_data()
    {
        if (file_exists($this->log_file)) {
            $json = file_get_contents($this->log_file);
            return json_decode($json, TRUE) ?: array();
        }
        return array();
    }

    private function _save_brute_force_data($data)
    {
        $dir = dirname($this->log_file);
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        file_put_contents($this->log_file, json_encode($data), LOCK_EX);
    }

 // Gunakan kombinasi IP dan User Agent sebagai "Fingerprint"
    private function _get_fingerprint($ip)
    {
        $ua = $this->input->user_agent();
        return md5($ip . $ua); // Kombinasi unik
    }

    private function _check_brute_force($ip)
    {
        $data = $this->_get_brute_force_data();
        $fingerprint = $this->_get_fingerprint($ip);
        
        if (isset($data[$fingerprint])) {
            $attempts = $data[$fingerprint]['attempts'];
            $lockout_time = $data[$fingerprint]['lockout_time'];

            if ($attempts >= 5 && time() < $lockout_time) {
                return ceil(($lockout_time - time()) / 60);
            }
            if ($attempts >= 5 && time() >= $lockout_time) {
                unset($data[$fingerprint]);
                $this->_save_brute_force_data($data);
            }
        }
        return 0;
    }

    private function _record_failed_login($ip)
    {
        $data = $this->_get_brute_force_data();
        $fingerprint = $this->_get_fingerprint($ip);

        if (!isset($data[$fingerprint])) {
            $data[$fingerprint] = array('attempts' => 1, 'lockout_time' => 0);
        } else {
            $data[$fingerprint]['attempts'] += 1;
        }

        if ($data[$fingerprint]['attempts'] >= 5) {
            $data[$fingerprint]['lockout_time'] = time() + (15 * 60);
        }
        $this->_save_brute_force_data($data);
    }

    private function _clear_failed_login($ip)
    {
        $data = $this->_get_brute_force_data();
        $fingerprint = $this->_get_fingerprint($ip);
        if (isset($data[$fingerprint])) {
            unset($data[$fingerprint]);
            $this->_save_brute_force_data($data);
        }
    }
 

 

    // ====================================================================
    // FUNGSI LOGIN UTAMA (LEBIH AMAN, TANPA NEWS_MODEL)
    // ====================================================================

    public function login()
    {
        $cek = $this->session->userdata('logged_in_ppid');
        $ip_address = $this->input->ip_address(); // Tangkap IP Address user

        if (empty($cek)) {
            
            // 1. CEK STATUS BRUTE FORCE BERDASARKAN IP ADDRESS
            $waktu_tunggu = $this->_check_brute_force($ip_address);
            
            if ($waktu_tunggu > 0) {
                // Tendang pengguna jika masih dalam masa blokir (15 menit)
                echo "<script type='text/javascript'>alert('Sistem mendeteksi percobaan login gagal beruntun dari IP Anda. Demi keamanan, Anda diblokir sementara. Silakan coba lagi dalam $waktu_tunggu menit.');</script>";
                echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "web'>";
                exit; 
            }

            // 2. VALIDASI FORM
            $this->load->library('form_validation');
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->_record_failed_login($ip_address); // Hitung sebagai gagal
                echo "<script type='text/javascript'>alert('Format Username/Password tidak valid!');</script>";
                echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "web'>";
                exit;
            } else {
                
                // 3. PROSES AUTENTIKASI LANGSUNG (Tanpa News_model)
                $u = $this->input->post('username', TRUE);
                $p = $this->input->post('password', TRUE);
                
                // Enkripsi password menggunakan MD5 dengan config key (sesuai struktur sistem Anda)
                $password_hashed = md5($p . $this->config->item("key_login"));

                // Query langsung ke tabel user_pembantu
                $this->db->where('username', $u);
                $this->db->where('password', $password_hashed);
                $query = $this->db->get('user_pembantu');

                if ($query->num_rows() > 0) {
                    
                    // LOGIN BERHASIL
                    $row = $query->row();
                    
                    // Daftarkan Sesi (Session) Pengguna
                    $session_data = array(
                        'logged_in_ppid' => TRUE,
                        'idm_ppid'       => $row->id_pembantu,
                        'akses_ppid'     => $row->akses,
                        'skpd_ppid'      => $row->id_skpd
                    );
                    $this->session->set_userdata($session_data);

              // Hapus daftar log gagal IP ini
                    $this->_clear_failed_login($ip_address); 
                    
                    // Gunakan pengaman sesi bawaan CodeIgniter (mencegah Session Fixation)
                    if (method_exists($this->session, 'sess_regenerate')) {
                        $this->session->sess_regenerate(TRUE);
                    }
                    
                    // Redirect menggunakan fungsi pembantu CodeIgniter agar aman
                    redirect('pembantu');

                } else {
                    
                    // LOGIN GAGAL (Kombinasi User/Pass salah)
                    $this->_record_failed_login($ip_address); 
                    
                    echo "<script type='text/javascript'>alert('Username atau Password salah!');</script>";
                    echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "web'>";
                    exit;
                    
                }
            }
        } else {
            // Jika sudah login, kembalikan ke web/pembantu
redirect('pembantu');
        }
    }

    function logout()
    {
        $this->session->sess_destroy();
        redirect('');
    }

    function beratperiode()
    {
        $ur = $this->uri->segment(3);
        $jenisku = date('d-m-Y');
        $data['bulan'] = $ur;
        $data['tahun'] = date('Y', strtotime($jenisku));

        $data['id2'] = $this->uri->segment(4);
        $data['h2_title'] = $this->config->item('instansi');
        $data['h2_desc'] = 'PPID Kabupaten Bengkalis';
        $data['h2_kecil'] = $this->config->item('nama_aplikasi_pendek');
        $data['full'] = $this->config->item('nama_aplikasi_full');
        $data['alamat'] = $this->config->item('alamat');
        $data['breadcrumb'] = 'Profil';
        $data["menu_atas"] = $this->News_model->Menu_Atas();
        $data["menu_bawah"] = $this->News_model->Menu_Bawah();
        $data["top"] = $this->News_model->Berita_Top();
        $data["link3"] = $this->News_model->Side_Link2();
        $data["link4"] = $this->News_model->Side_Link3();
        $data["arsipkategori"] = $this->News_model->Berita_Arsip();
        $data["agenda"] = $this->News_model->Side_Agenda();
        $data["pengumuman"] = $this->News_model->Side_Pengumuman();

        $this->load->model('Webadmin_model');
        $data["kategori"] = $this->Webadmin_model->Semua_Skpd_Counter();

        $this->load->view('web/bg_atas', $data);
        $this->load->view('web/rekapitulasi-keberatanperiode', $data);
        $this->load->view('web/bg_kiridetailkosong', $data);
        $this->load->view('web/bg_bawah', $data);
    }

    function beratskpd()
    {
        $ur = $this->uri->segment(3);
        $data['bulan'] = $ur;

        $data['id2'] = $this->uri->segment(4);
        $data['h2_title'] = $this->config->item('instansi');
        $data['h2_desc'] = 'Website Resmi PPID Kabupaten Bengkalis Riau,Indonesia';
        $data['h2_kecil'] = $this->config->item('nama_aplikasi_pendek');
        $data['full'] = $this->config->item('nama_aplikasi_full');
        $data['alamat'] = $this->config->item('alamat');
        $data['breadcrumb'] = 'Profil';
        $data["menu_atas"] = $this->News_model->Menu_Atas();
        $data["menu_bawah"] = $this->News_model->Menu_Bawah();
        $data["top"] = $this->News_model->Berita_Top();
        $data["link3"] = $this->News_model->Side_Link2();
        $data["link4"] = $this->News_model->Side_Link3();
        $data["arsipkategori"] = $this->News_model->Berita_Arsip();
        $data["agenda"] = $this->News_model->Side_Agenda();

        $this->load->model('Webadmin_model');
        $data["kategori"] = $this->Webadmin_model->Semua_Skpd();
        $data["kategori2"] = $this->News_model->Detail_Skpd($ur);
        
        $this->load->view('web/bg_atas', $data);
        $this->load->view('web/rekapitulasi-keberatanskpd', $data);
        $this->load->view('web/bg_kiridetailkosong', $data);
        $this->load->view('web/bg_bawah', $data);
    }

    function kirimsurvey()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        if ($this->form_validation->run() == FALSE) {
            echo "<script type='text/javascript'>alert('Inputan tidak Valid!!! Ulangi lagi.');</script>";
            echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "web/link/survey'>";
        } else {
            $datainput['nama_depan'] = $this->input->post('nama', TRUE);
            $datainput['nama_belakang'] = $this->input->post('belakang', TRUE);
            $datainput['email'] = $this->input->post('email', TRUE);
            $datainput['wa'] = $this->input->post('hp', TRUE);
            $datainput['id_pekerjaan'] = $this->input->post('pekerjaan', TRUE);
            $datainput['id_pelayanan'] = $this->input->post('jenis_layanan', TRUE);
            $datainput['saran'] = $this->input->post('saran', TRUE);
            $datainput['id_survey'] = $this->input->post('id_param', TRUE);
            $datainput['id_pengirim'] = $this->input->post('id_param', TRUE);
            $datainput['posted_date'] = mdate("%Y-%m-%d", time());
            
            $this->News_model->Simpan_Survey($datainput);
            
            $datax = $this->News_model->Semua_Pertanyaan();
            foreach ($datax->result_array() as $artikel) {
                $pecah = $this->input->post("q-" . $artikel['id_pertanyaan'], TRUE);
                if (!empty($pecah)) {
                    $dd = explode("-", $pecah);
                    if (count($dd) >= 2) {
                        $in['id_pengirim'] = $this->input->post('id_param', TRUE);
                        $in['id_pertanyaan'] = $dd[0];
                        $in['jawaban'] = $dd[1];
                        $this->db->insert("tbl_jawabansurvey", $in);
                    }
                }
            }
            
            echo "<script type='text/javascript'>alert('Survey anda sudah terkirim, Terima kasih atas partisipasi Anda.');</script>";
            echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "web'>";
        }
    }
} // Batas Penutup Kelas Web Utama