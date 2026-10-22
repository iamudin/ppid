<?php

namespace App\Models;

use App\Core\CI_Model;

#[\AllowDynamicProperties]
class News_modelold extends CI_Model{
		function __construct()
	    {
	         parent::__construct();
	    }
	    function add($groupuser)
	    {
	     $this->db->insert($this->table, $groupuser);
	    }
		function Tampil_Polling()
		{
			$q=$this->db->query("select * from tbl_soalpolling where status='Y'");
			return $q;
		}
		function Tampil_Jwb_Poll($id_soal)
		{
			$q=$this->db->query("select * from tbl_jawabanpoll where id_soal_poll='$id_soal'");
			return $q;
		}
		function Update_Polling($id_poll)
		{
			$query_update=$this->db->query("update tbl_jawabanpoll set counter=counter+1 where id_jawaban_poll='$id_poll'");
			return $query_update;
		}
		function Detail_Video($id_album)
		{
			$q=$this->db->query("SELECT
tbl_video.id_video,
tbl_video.judul_video,
tbl_video.url,
tbl_video.tanggal,
tbl_video.penulis,
tbl_video.gambar,
tbl_video.id_kategori
FROM
tbl_video

 where tbl_video.id_video='$id_album'");
			return $q;
		}
		function Side_Video()
		{
			$q=$this->db->query("select * from tbl_video order by id_video DESC limit 6");
			return $q;
		}
		function Semua_Video($limit,$ofset)
		{
			$q=$this->db->query("SELECT
tbl_video.id_video,
tbl_video.judul_video,
tbl_video.url,
tbl_video.tanggal,
tbl_video.penulis,
tbl_video.gambar,
tblkv.kategori
FROM
tbl_video LEFT JOIN
tblkv on tblkv.id_kategori=tbl_video.id_kategori
order by tbl_video.id_video DESC limit $ofset,$limit");
			return $q;
		}
		function Total_Video()
		{
			$q=$this->db->query("select * from tbl_video order by tbl_video.id_video DESC");
			return $q;
		}
		function Video_Function($id)
		{
			$q=$this->db->query("SELECT
tbl_video.url,
tbl_video.id_video,
tbl_video.permalink,
tbl_video.judul_video
FROM
tbl_video WHERE tbl_video.id_video='$id' ORDER BY tbl_video.id_video DESC
 limit 1");
			return $q;
		}
		function Berita_Bawah_sub($id,$limit)
		{
			$q=$this->db->query("SELECT
tblberita.id_berita,
tblberita.judul_berita,
tblberita.isi,
tblberita.tanggal,
tblberita.waktu,
tblberita.lite,
tblberita.url,
tblberita.gambar,
tblberita.foto_kecil
FROM
tblberita where tblberita.id_kategori='$id' order by tblberita.id_berita DESC limit 0,$limit");
			return $q;
		}
		function Banner_Function($id)
		{
			$q=$this->db->query("SELECT
tbl_banner.foto_besar,
tbl_banner.keterangan
FROM
tbl_banner where id_banner='$id'");
			return $q;
		}
		function Perintah($id,$id2)
		{
			$q=$this->db->query("SELECT
*
FROM
$id order by $id2 ASC");
			return $q;
		}
		
		function Berita_CariIndeks($id,$offset,$limit)

		{

			$q=$this->db->query("SELECT
tblberita.id_berita,
tblberita.judul_berita,
tblberita.isi,
tblberita.tanggal,
tblberita.waktu,
tblberita.lite,
tblberita.url,
tblberita.gambar,
tblberita.foto_kecil,
tblberita.lite,
tblberita.id_kategori,
tblkategori.nama_kategori,
tblkategori.permalink
FROM
tblberita LEFT JOIN
tblkategori on tblkategori.id_kategori=tblberita.id_kategori where tblberita.tanggal='$id' order by tblberita.id_berita DESC LIMIT $offset,$limit");

			return $q;

		}

		function Total_CariIndeks($id)

		{

			$q=$this->db->query("SELECT

tblberita.id_berita

FROM

tblberita where tblberita.tanggal='$id'");

			return $q;

		}
		function Side_Download()
		{
			$q=$this->db->query("SELECT
tbl_download.kode_download,
tbl_download.download,
tbl_download.file,
tbl_download.permalink,
tbl_download.tanggal
FROM
tbl_download 
 order by tbl_download.kode_download  DESC limit 5");
			return $q;
		}
		
	
		function Berita_Headline()
		{
			$q=$this->db->query("SELECT
tblberita.id_berita,
tblberita.judul_berita,
tblberita.isi,
tblberita.tanggal,
tblberita.waktu,
tblberita.url,
tblberita.gambar,
tblberita.foto_kecil,
tblberita.lite,
tblberita.id_kategori,
tbl_menu.title
FROM
tblberita LEFT JOIN
tbl_menu on tbl_menu.id=tblberita.id_kategori 
where tblberita.status='HEADLINE'
order by tblberita.id_berita DESC
 limit 0,5");
			return $q;
		}
		function Berita_Headline_Mobile()
		{
			$q=$this->db->query("SELECT
tblberita.id_berita,
tblberita.judul_berita,
tblberita.isi,
tblberita.tanggal,
tblberita.waktu,
tblberita.lite,
tblberita.url,
tblberita.gambar,
tblberita.foto_kecil,
tblberita.lite,
tblberita.id_kategori,
tblkategori.nama_kategori,
tblkategori.permalink
FROM
tblberita LEFT JOIN
tblkategori on tblkategori.id_kategori=tblberita.id_kategori
order by tblberita.id_berita DESC
 limit 0,5");
			return $q;
		}
		function Berita_Top()
		{
			$q=$this->db->query("SELECT
tblberita.id_berita,
tblberita.judul_berita,
tblberita.isi,
tblberita.tanggal,
tblberita.waktu,
tblberita.lite,
tblberita.url,
tblberita.gambar,
tblberita.foto_kecil,
tblberita.lite,
tblberita.id_kategori,
tblkategori.nama_kategori,
tblkategori.permalink
FROM
tblberita LEFT JOIN
tblkategori on tblkategori.id_kategori=tblberita.id_kategori
order by tblberita.id_berita DESC
 limit 0,6");
			return $q;
		}
		function Berita_Popular()
		{
			$q=$this->db->query("SELECT
tblberita.id_berita,
tblberita.judul_berita,
tblberita.isi,
tblberita.tanggal,
tblberita.waktu,
tblberita.anak,
tblberita.lite,
tblberita.url,
tblberita.gambar,
tblberita.foto_kecil,
tblberita.lite,
tblberita.id_kategori,
tblberita.counter,
tblkategori.nama_kategori,
tblkategori.permalink
FROM
tblberita LEFT JOIN
tblkategori on tblkategori.id_kategori=tblberita.id_kategori where tblberita.counter > 100
order by tblberita.id_berita DESC
 limit 0,5");
			return $q;
		}
		function Berita_Atas()
		{
			$q=$this->db->query("SELECT
tblberita.id_berita,
tblberita.judul_berita,
tblberita.isi,
tblberita.tanggal,
tblberita.waktu,
tblberita.lite,
tblberita.url,
tblberita.gambar,
tblberita.foto_kecil,
tblberita.lite,
tblberita.id_kategori,
tblkategori.nama_kategori,
tblkategori.permalink
FROM
tblberita LEFT JOIN
tblkategori on tblkategori.id_kategori=tblberita.id_kategori
order by tblberita.id_berita DESC
 limit 0,6");
			return $q;
		}
		function Berita_Bawah()
		{
			$q=$this->db->query("SELECT
tblberita.id_berita,
tblberita.judul_berita,
tblberita.isi,
tblberita.tanggal,
tblberita.waktu,
tblberita.lite,
tblberita.url,
tblberita.gambar,
tblberita.foto_kecil
FROM
tblberita order by tblberita.id_berita DESC limit 0,4");
			return $q;
		}
			function Berita_Bawah_Mobile()
		{
			$q=$this->db->query("SELECT
tblberita.id_berita,
tblberita.judul_berita,
tblberita.isi,
tblberita.tanggal,
tblberita.waktu,
tblberita.lite,
tblberita.url,
tblberita.gambar,
tblberita.foto_kecil
FROM
tblberita order by tblberita.id_berita DESC limit 0,15");
			return $q;
		}
		function Berita_Arsip()
		{
			$q=$this->db->query("SELECT
tbl_menu.id,
tbl_menu.title,
tbl_menu.id_parent,
tbl_menu.`level`,
tbl_menu.permalink,
tbl_menu.sorting,
tbl_menu.`status`,
tbl_menu.link
FROM
tbl_menu WHERE tbl_menu.sorting='berita'

order by tbl_menu.id ASC");
			return $q;
		}
		function Berita_Peristiwa()
		{
			$q=$this->db->query("SELECT
tbl_beritafoto.id_beritafoto,
tbl_beritafoto.judul_beritafoto,
tbl_beritafoto.isi,
tbl_beritafoto.tanggal,
tbl_beritafoto.penulis,
tbl_beritafoto.gambar
FROM
tbl_beritafoto order by tbl_beritafoto.id_beritafoto DESC limit 3");
			return $q;
		}
		
		function Semua_DownloadDetail($id)
		{
			$q=$this->db->query("SELECT
tbl_download.kode_download,
tbl_download.kode_menu,
tbl_download.download,
tbl_download.ket,
tbl_download.file,
tbl_download.tanggal,
tbl_download.waktu,
tbl_download.counter
FROM
tbl_download 
WHERE tbl_download.kode_download='$id'");
			return $q;
		}
		function Side_Kritik()
		{
			$q=$this->db->query("SELECT
tblhubungi.id_hubungi,
tblhubungi.nama,
tblhubungi.email,
tblhubungi.pesan,
tblhubungi.`status`,
tblhubungi.posted_date,
tblhubungi.alamat,
tblhubungi.phone,
tblhubungi.replay
FROM
tblhubungi WHERE tblhubungi.`status`='Y'
 order by tblhubungi.id_hubungi DESC limit 5");
			return $q;
		}
		function Tampil_Galeri()
		{
			$q=$this->db->query("SELECT
tbl_album_galeri.nama_album,
tbl_album_galeri.id_album,
tbl_galeri.foto_kecil,
tbl_album_galeri.tanggal_album,
tbl_galeri.foto_besar,
tbl_album_galeri.permalink,
tbl_album_galeri.keterangan
FROM
tbl_album_galeri left JOIN
tbl_galeri on tbl_galeri.id_album=tbl_album_galeri.id_album group by tbl_album_galeri.id_album
order by id_album DESC 
limit 6
");
			return $q;
		}
		function Side_Agenda()
		{
			$q=$this->db->query("select * from tbl_agenda order by id_agenda DESC limit 5");
			return $q;
		}
		
		function Side_Banner()
		{
			$q=$this->db->query("select * from tbl_banner limit 0,2");
			return $q;
		}
		function Side_Banner2()
		{
			$q=$this->db->query("select * from tbl_banner limit 1,5");
			return $q;
		}
		
		function Menu_Atas()
		{
			$q=$this->db->query("select * from tbl_menu where id_parent='induk' ORDER BY id ASC LIMIT 7");
			return $q;
		}
		function Menu_Atas2()
		{
			$q=$this->db->query("select * from tbl_menu where id_parent='induk' ORDER BY id ASC LIMIT 3,15");
			return $q;
		}
		function Menu_Bawah2($id)
		{
			$q=$this->db->query("SELECT * from tbl_menu where id_parent='$id'");
			return $q;
		}
		function Side_Statis($id)
		{
			$q=$this->db->query("select * from tbl_menu where tbl_menu.id_parent='$id'");
			return $q;
		}
		function Data_Statis($id)
		{
			$q=$this->db->query("select * from tbl_data left join tbl_menu on tbl_data.data_id=tbl_menu.id where tbl_menu.permalink='$id'");
			return $q;
		}
		function Side_Link()
		{
			$q=$this->db->query("select * from tbl_link order by id_link ASC limit 5");
			return $q;
		}
		function Side_Link2()
		{
			$q=$this->db->query("select * from tbl_link order by id_link ASC limit 5,3");
			return $q;
		}
		function Side_Link3()
		{
			$q=$this->db->query("select * from tbl_link order by id_link ASC limit 8,7");
			return $q;
		}
		
		
		function Link_Function($id)
		{
			$q=$this->db->query("SELECT
tbl_menu.id,
tbl_menu.title,
tbl_menu.id_parent,
tbl_menu.`level`,
tbl_menu.permalink,
tbl_menu.sorting,
tbl_menu.`status`,
tbl_menu.link
FROM
tbl_menu
 where tbl_menu.id_parent='$id' order by tbl_menu.id ASC");
			return $q;
		}
		function Detail_Berita($id)
		{
			$q=$this->db->query("SELECT
tblkategori.nama_kategori,
tblkategori.permalink,
tblberita.id_berita,
tblberita.id_kategori,
tblberita.anak,
tblberita.judul_berita,
tblberita.isi,
tblberita.gambar,
tblberita.tanggal,
tblberita.waktu,
tblberita.counter,
tblberita.foto_kecil,
tblberita.ket_foto,
tblberita.url
FROM
tblberita left JOIN
tblkategori on tblkategori.id_kategori=tblberita.id_kategori
WHERE tblberita.id_berita='$id'");
			return $q;	
		}
		function Detail_Beritafoto($id)
		{
			$q=$this->db->query("SELECT
tbl_beritafoto.id_beritafoto,
tbl_beritafoto.judul_beritafoto,
tbl_beritafoto.isi,
tbl_beritafoto.tanggal,
tbl_beritafoto.penulis,
tbl_beritafoto.gambar
FROM
tbl_beritafoto

WHERE tbl_beritafoto.id_beritafoto='$id'");
			return $q;	
		}
		function Detail_Menu($id)
		{
			$q=$this->db->query("SELECT
tbl_menu.title
FROM
tbl_menu WHERE permalink='$id'");
			return $q;	
		}
		function Update_Counter_Berita($id_berita)
		{
			$query_update=$this->db->query("update tblberita set counter=counter+1 where id_berita='$id_berita'");
			return $query_update;
		}
		function Update_Counter_Download($id_berita)
		{
			$query_update=$this->db->query("update tbl_download set counter=counter+1 where kode_download='$id_berita'");
			return $query_update;
		}
		function Update_Counter_Download2($id_berita)
		{
			$query_update=$this->db->query("update tbl_informasi set counter=counter+1 where kode_informasi='$id_berita'");
			return $query_update;
		}
		function Berita_Terkait($id,$key)
		{
			$q=$this->db->query("SELECT
tblberita.id_berita,
tblberita.judul_berita,
tblberita.anak,
tblberita.waktu,
tblberita.lite,
tblberita.isi,
tblberita.gambar,
tblberita.tanggal,
tblberita.url
FROM
tblberita where  tblberita.id_berita!='$key' order by RAND() LIMIT 4");
			return $q;	
		}

	    function Detail_Agenda($id_agenda)
		{

			$q=$this->db->query("select * from tbl_agenda where id_agenda='$id_agenda'");
			return $q;
		}
		
		
		function Update_Pengunjung()
		{
			$query_update=$this->db->query("update tbl_data set content=content+1 where data_id='counter'");
			return $query_update;
		}
		function Counter_Pengunjung()
		{
			$q=$this->db->query("select * from tbl_data where data_id='counter'");
			return $q;
		}
		
		function Semua_Download($limit,$ofset,$status)
		{
			$q=$this->db->query("SELECT
tbl_download.kode_download,
tbl_download.kode_menu,
tbl_download.download,
tbl_download.ket,
tbl_download.file,
tbl_download.tanggal,
tbl_download.waktu,
tbl_download.counter
FROM
tbl_download INNER JOIN
tbl_menu on tbl_menu.id=tbl_download.kode_menu
WHERE tbl_menu.permalink
='$status' order by tbl_download.kode_download ASC limit $ofset,$limit");
			return $q;
		}
		function Total_Download($status)
		{
			$q=$this->db->query("SELECT
tbl_download.kode_download
FROM
tbl_download INNER JOIN
tbl_menu on tbl_menu.id=tbl_download.kode_menu
WHERE tbl_menu.permalink
='$status'");
			return $q;
		}
		function Semua_Download_Indeks($limit,$ofset)
		{
			$q=$this->db->query("SELECT
tbl_download.kode_download,
tbl_download.kode_menu,
tbl_download.download,
tbl_download.ket,
tbl_download.file,
tbl_download.tanggal,
tbl_download.waktu,
tbl_download.counter
FROM
tbl_download LEFT JOIN
tbl_menu on tbl_menu.id=tbl_download.kode_menu
order by tbl_download.kode_download ASC limit $ofset,$limit");
			return $q;
		}
		function Total_Download_Indeks()
		{
			$q=$this->db->query("SELECT
*
FROM
tbl_download");
			return $q;
		}
		function Semua_Produk_Indeks($limit,$ofset)
		{
			$q=$this->db->query("SELECT
tbl_download.kode_download,
tbl_download.kode_menu,
tbl_download.download,
tbl_download.ket,
tbl_download.file,
tbl_download.tanggal,
tbl_download.waktu,
tbl_download.counter
FROM
tbl_download LEFT JOIN 
tbl_menu on tbl_menu.id=tbl_download.kode_menu WHERE tbl_menu.id_parent='133'
order by tbl_download.kode_download ASC limit $ofset,$limit");
			return $q;
		}
		function Total_Produk_Indeks()
		{
			$q=$this->db->query("SELECT
tbl_download.kode_download,
tbl_download.kode_menu,
tbl_download.download,
tbl_download.ket,
tbl_download.file,
tbl_download.tanggal,
tbl_download.waktu,
tbl_download.counter
FROM
tbl_download LEFT JOIN 
tbl_menu on tbl_menu.id=tbl_download.kode_menu WHERE tbl_menu.id_parent='133'
order by tbl_download.kode_download ASC");
			return $q;
		}
	    function Semua_Pengumuman($limit,$ofset)
		{
			$q=$this->db->query("select * from tbl_pengumuman order by id_pengumuman DESC limit $ofset,$limit");
			return $q;
		}

		function Semua_Jabatan()
		{
			$query=$this->db->query("select * from tbl_jabatan order by id_jabatan ASC");
			return $query;
		}
		function Total_Pencarian_Pegawai($status)
		{
			$q=$this->db->query("select * from tbl_kepegawaian where kode_jabatan='$status' order by urut ASC");
			return $q;
		}
		function Pencarian_Pegawai($status,$limit,$ofset)
		{
			$q=$this->db->query("select * from tbl_kepegawaian left join tbl_jabatan on tbl_jabatan.id_jabatan=tbl_kepegawaian.kode_jabatan
			 where kode_jabatan='$status' order by urut ASC limit $ofset,$limit");
			return $q;
		}
		function Semua_Agenda($limit,$ofset)
		{
			$q=$this->db->query("select * from tbl_agenda order by id_agenda DESC limit $ofset,$limit");
			return $q;
		}
		function Total_Agenda()
		{
			$q=$this->db->query("select * from tbl_agenda order by id_agenda DESC");
			return $q;
		}
		function Pegawai()
		{
			$q=$this->db->query("select * from tbl_kepegawaian left join tbl_jabatan on tbl_jabatan.id_jabatan=tbl_kepegawaian.kode_jabatan
			order by urut ASC limit 6");
			return $q;
		}
		function Semua_Pegawai($limit,$ofset)
		{
			$q=$this->db->query("select * from tbl_kepegawaian left join tbl_jabatan on tbl_jabatan.id_jabatan=tbl_kepegawaian.kode_jabatan
			order by urut ASC limit $ofset,$limit");
			return $q;
		}
		function Total_Pegawai()
		{
			$q=$this->db->query("select * from tbl_kepegawaian order by id_kepegawaian ASC");
			return $q;
		}
		function Semua_Berita($limit,$ofset)
		{
			$q=$this->db->query("select * from tblberita order by id_berita DESC limit $ofset,$limit");
			return $q;
		}
		function Total_Berita()
		{
			$q=$this->db->query("select * from tblberita order by id_berita DESC");
			return $q;
		}
		function Semua_Beritafoto($limit,$ofset)
		{
			$q=$this->db->query("select * from tbl_beritafoto order by id_beritafoto DESC limit $ofset,$limit");
			return $q;
		}
		function Total_Beritafoto()
		{
			$q=$this->db->query("select * from tbl_beritafoto order by id_beritafoto DESC");
			return $q;
		}
		function Semua_BeritaKat($limit,$ofset,$id)
		{
			$q=$this->db->query("SELECT
tblberita.id_berita,
tblberita.judul_berita,
tblberita.tanggal,
tblberita.waktu,
tblberita.counter,
tbl_menu.title,
tblberita.gambar,
tblberita.url,
tblberita.isi,
tblberita.anak,
tblberita.lite,
tblberita.id_kategori
FROM
tblberita LEFT JOIN
tbl_menu on tbl_menu.id=tblberita.id_kategori where tbl_menu.permalink='$id'
order by tblberita.id_berita DESC limit $ofset,$limit");
			return $q;
		}
		function Total_BeritaKat($id)
		{
			$q=$this->db->query("SELECT
tblberita.id_berita
FROM
tblberita LEFT JOIN
tbl_menu on tbl_menu.id=tblberita.id_kategori where tbl_menu.permalink='$id'");
			return $q;
		}
		function Pencarian_Berita($id,$limit,$ofset)
		{
			$q=$this->db->query("select * from tblberita where judul_berita like '%$id%' order by id_berita DESC limit $ofset,$limit");
			return $q;
		}
		function Semua_Artikel($limit,$ofset)
		{
			$q=$this->db->query("select * from tblberita order by id_berita DESC limit $ofset,$limit");
			return $q;
		}
		function Total_Artikel()
		{
			$q=$this->db->query("select * from tblberita order by id_berita DESC");
			return $q;
		}
		function Berita_Pencarian($id,$offset,$limit)
		{
			$q=$this->db->query("SELECT
*
FROM
tblberita where tblberita.judul_berita like '%$id%' order by tblberita.id_berita DESC LIMIT $offset,$limit");
			return $q;
		}
		function Total_Pencarian($id)
		{
			$q=$this->db->query("SELECT
tblberita.id_berita
FROM
tblberita where tblberita.judul_berita like '%$id%'");
			return $q;
		}
		function Simpan_Kontak($datainput)
		{
			$this->db->insert('tblhubungi',$datainput);
		}
		function Semua_Foto($limit,$ofset)
		{
			$q=$this->db->query("SELECT
tbl_album_galeri.nama_album,
tbl_album_galeri.id_album,
tbl_galeri.foto_kecil,
tbl_album_galeri.tanggal_album,
tbl_galeri.foto_besar,
tbl_album_galeri.keterangan,
tbl_album_galeri.permalink
FROM
tbl_album_galeri INNER JOIN
tbl_galeri on tbl_galeri.id_album=tbl_album_galeri.id_album
GROUP BY tbl_album_galeri.id_album
order by id_album DESC limit $ofset,$limit");
			return $q;
		}
		function Total_Foto()
		{
			$q=$this->db->query("select * from tbl_album_galeri order by id_album DESC");
			return $q;
		}
	
		function Detail_Galeri($id_album)
		{
			$q=$this->db->query("SELECT
tbl_album_galeri.nama_album,
tbl_album_galeri.id_album,
tbl_album_galeri.keterangan as ket,
tbl_galeri.foto_kecil,
tbl_galeri.foto_besar,
tbl_galeri.keterangan,
tbl_album_galeri.tanggal_album,
tbl_album_galeri.waktu,
tbl_album_galeri.counter,
tbl_album_galeri.permalink,
tbl_galeri.id_foto
FROM
tbl_album_galeri INNER JOIN
tbl_galeri on tbl_galeri.id_album=tbl_album_galeri.id_album
 where tbl_galeri.id_album='$id_album'");
			return $q;
		}
		
		function Hitung_Download($nilai)
		{
			$q=$this->db->query("SELECT COUNT(*) AS jum
FROM
tbl_download WHERE tbl_download.kode_menu='$nilai'
");
			return $q;
		}
		function Hitung_Sub($nilai)
		{
			$q=$this->db->query("SELECT COUNT(*) AS jumlah
FROM
tbl_menu where id_parent='$nilai'");
			return $q;
		}
		function Semua_Kritik($limit,$ofset)
		{
			$q=$this->db->query("SELECT
tblhubungi.id_hubungi,
tblhubungi.nama,
tblhubungi.email,
tblhubungi.pesan,
tblhubungi.`status`,
tblhubungi.posted_date,
tblhubungi.alamat,
tblhubungi.phone,
tblhubungi.replay
FROM
tblhubungi WHERE tblhubungi.`status`='Y'
 order by tblhubungi.id_hubungi DESC limit $ofset,$limit");
			return $q;
		}
		function Total_Kritik()
		{
			$q=$this->db->query("SELECT
tblhubungi.id_hubungi
FROM
tblhubungi WHERE tblhubungi.`status`='Y'");
			return $q;
		}
		function Berita_Function($id,$limit)
		{
			$q=$this->db->query("SELECT
tblberita.id_berita,
tblberita.judul_berita,
tblberita.isi,
tblberita.tanggal,
tblberita.waktu,
tblberita.lite,
tblberita.url,
tblberita.gambar,
tblberita.foto_kecil
FROM
tblberita where tblberita.id_kategori='$id' order by tblberita.id_berita DESC limit 0,$limit");
			return $q;
		}
		
}