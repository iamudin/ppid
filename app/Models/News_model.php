<?php

namespace App\Models;

use App\Core\CI_Model;

#[\AllowDynamicProperties]
class News_model extends CI_Model{
		function __construct()
	    {
	         parent::__construct();
	    }
	    
	    function add($groupuser)
	    {
	     $this->db->insert($this->table, $groupuser);
	    }
function Detail_Menu2($id)
		{
			$q=$this->db->query("SELECT
tbl_menu.title
FROM
tbl_menu WHERE permalink='$id'");
			return $q;	
		}		
	  
 
 
 public function get_kode_mahasiswa() {
  //$tahun = date("Y");
  //$kode = 'MHS';
  $query = $this->db->query("SELECT MAX(id_pemohon) as max_id FROM tbl_pemohon"); 
  $row = $query->row_array();
  $max_id = $row['max_id']; 
  $max_id1 =$max_id;
  $kode_mahasiswa = $max_id1 +1;
  $maxkode_mahasiswa = $kode_mahasiswa;
  return $maxkode_mahasiswa;
 }

 public function get_kode_mahasiswa5() {
  //$tahun = date("Y");
  //$kode = 'MHS';
  $query = $this->db->query("SELECT MAX(id_pengirim) as max_id FROM tbl_pengirim"); 
  $row = $query->row_array();
  $max_id = $row['max_id']; 
  $max_id1 =$max_id;
  $kode_mahasiswa = $max_id1 +1;
  $maxkode_mahasiswa = $kode_mahasiswa;
  return $maxkode_mahasiswa;
 }
 
	function Perintah($id,$id2)
		{
			$q=$this->db->query("SELECT
*
FROM
$id order by $id2 ASC");
			return $q;
		}
		
		function Jumlah_Pemohon()
		{
			$q=$this->db->query("SELECT
COUNT(tbl_pemohon.id_pemohon) as tot
FROM
tbl_pemohon
");
			return $q;
		}
		
		function Jumlah_Permohonan()
		{
			$q=$this->db->query("SELECT
COUNT(tbl_pemohon.id_pemohon) as tot
FROM
tbl_pemohon
");
			return $q;
		}
		function Jumlah_Infomasi()
		{
			$q=$this->db->query("SELECT
COUNT(tbl_pemohon.id_pemohon) as tot
FROM
tbl_pemohon where tbl_pemohon.status='DIPENUHI' AND tbl_pemohon.status2='N'
");
			return $q;
		}
		function Jumlah_Tolak()
		{
			$q=$this->db->query("SELECT
COUNT(tbl_pemohon.id_pemohon) as tot
FROM
tbl_pemohon where tbl_pemohon.status='DITOLAK'
");
			return $q;
		}
		function Jumlah_Keberatan()
		{
			$q=$this->db->query("SELECT
COUNT(tbl_keberatan.id_keberatan) as tot
FROM
tbl_keberatan
");
			return $q;
		}
		
	function Side_Bengkalis()

		{

			$q=$this->db->query("SELECT
*
FROM
tbl_bengkalis where tbl_bengkalis.id='1' order by tbl_bengkalis.id ASC
");

			return $q;

		}
	function Side_Hitung()

		{

			$q=$this->db->query("SELECT
*
FROM
tbl_hitung  order by tbl_hitung.id_hitung DESC limit 0,1
");

			return $q;

		}
	function Side_Absen()
		{
			
			$tanggal=date("Y-m-d");
			$q=$this->db->query("SELECT
tbl_absensi.id_absensi,
tbl_absensi.tanggal,
tbl_absensi.id_pegawai,
tbl_absensi.pagi,
tbl_absensi.siang,
tbl_absensi.ket,
tbl_kepegawaian.nama_pegawai,
tbl_kepegawaian.nip,
tbl_jabatan.jabatan,
tbl_kepegawaian.gambar
FROM
tbl_absensi LEFT JOIN
tbl_kepegawaian on tbl_kepegawaian.id_kepegawaian=tbl_absensi.id_pegawai left join tbl_jabatan
on tbl_jabatan.id_jabatan=tbl_kepegawaian.kode_jabatan
 WHERE tbl_absensi.pagi='H' order by tbl_absensi.tanggal DESC

");

			return $q;

		}
	function Semua_Komoditi()

		{

			$q=$this->db->query("SELECT
tbl_komoditi.id_komoditi,
tbl_komoditi.judul_komoditi,
tbl_komoditi.tanggal,
tbl_komoditi.penulis,
tbl_komoditi.isi,
tbl_komoditi.visible
FROM
tbl_komoditi order by tbl_komoditi.id_komoditi ASC
");

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
	function Bijak_Function()
		{
			$q=$this->db->query("SELECT
tbl_bijak.foto_besar,
tbl_bijak.keterangan
FROM
tbl_bijak order by tbl_bijak.id_bijak desc limit 1 ");
			return $q;
		}
		
		function Berita_Pantun()

		{

			$q=$this->db->query("SELECT
*
FROM
tbl_pantun order by tbl_pantun.id_pantun DESC Limit 0,5
");

			return $q;

		}
		function Berita_Pantun2()

		{

			$q=$this->db->query("SELECT
*
FROM
tbl_pantun order by tbl_pantun.id_pantun DESC Limit 0,1
");

			return $q;

		}
		function Car_Pegawai($id)

		{

			$q=$this->db->query("SELECT
*
FROM
tbl_petugas left join tbl_agenda on tbl_agenda.id_agenda=tbl_petugas.id_agenda left join
tbl_kepegawaian on tbl_kepegawaian.id_kepegawaian=tbl_petugas.id_kepegawaian 
where  tbl_petugas.id_agenda='$id'");

			return $q;

		}
	function Car_Lampiran($id)

		{

			$q=$this->db->query("SELECT
*
FROM
tbl_lampiran 
where  tbl_lampiran.id_pengumuman='$id'");

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
		function SKPD_Function($id)
		{
			$q=$this->db->query("SELECT tbl_menu.id, 
	tbl_menu.title, 
	tbl_menu.id_parent, 
	tbl_menu.`level`, 
	tbl_menu.permalink, 
	tbl_menu.sorting, 
	tbl_menu.`status`, 
	tbl_menu.link
FROM tbl_menu where tbl_menu.link='$id'");
			return $q;
		}
		function Side_Download()
		{
			$q=$this->db->query("SELECT
tbl_download.kode_download,
tbl_download.kode_menu,
tbl_download.download,
tbl_download.ket,
tbl_download.file,
tbl_download.tanggal,
tbl_skpd.skpd,
tbl_menu.title
FROM
tbl_download LEFT JOIN tbl_menu on tbl_menu.id=tbl_download.kode_menu
left join tbl_skpd on tbl_skpd.id_skpd=tbl_download.id_skpd
order by tbl_download.kode_download DESC limit 5");
			return $q;
		}
	function Side_Download2()
		{
			$q=$this->db->query("SELECT
tbl_download.kode_download,
tbl_download.download,
tbl_download.ukuran,
tbl_download.file,
tbl_download.tanggal
FROM
tbl_download where tbl_download.kode_menu='252' or tbl_download.kode_menu='251' or tbl_download.kode_menu='172'
 order by tbl_download.kode_download  DESC limit 5");
			return $q;
		}
		function Side_Komoditi()
		{
			$q=$this->db->query("SELECT
tbl_komoditi.id_komoditi,
tbl_komoditi.judul_komoditi,
tbl_komoditi.tanggal,
tbl_komoditi.penulis,
tbl_komoditi.isi,
tbl_komoditi.visible
FROM
tbl_komoditi
 order by tbl_komoditi.id_komoditi ASC");
			return $q;
		}
		function Side_Paper()
		{
			$q=$this->db->query("SELECT
tbl_paper.id_paper,
tbl_paper.judul_paper,
tbl_paper.url,
tbl_paper.tanggal,
tbl_paper.penulis,
tbl_paper.gambar
FROM
tbl_paper
 order by tbl_paper.id_paper DESC limit 1");
			return $q;
		}
		function Side_Telepon()
		{
			$q=$this->db->query("SELECT
tbl_telepon.id_telepon,
tbl_telepon.nama,
tbl_telepon.telepon
FROM
tbl_telepon
 order by tbl_telepon.id_telepon DESC");
			return $q;
		}
		function Side_Roro()
		{
			$q=$this->db->query("SELECT
tbl_tarif.id_tarif,
tbl_tarif.judul,
tbl_tarif.keterangan,
tbl_tarif.foto_kecil,
tbl_tarif.foto_besar,
tbl_tarif.tanggal,
tbl_tarif.waktu
FROM
tbl_tarif
 order by tbl_tarif.id_tarif DESC limit 5");
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
 limit 0,1");
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
 where tblberita.counter > 100 
order by tblberita.id_berita DESC
 limit 0,5");
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
tblberita.counter,
tblberita.anak,
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
tblkategori on tblkategori.id_kategori=tblberita.id_kategori where tblberita.counter > 100 
order by tblberita.id_berita DESC
 limit 0,5");
			return $q;
		}
		function Berita_PopularDetail()
		{
			$q=$this->db->query("SELECT
tblberita.id_berita,
tblberita.judul_berita,
tblberita.isi,
tblberita.tanggal,
tblberita.waktu,
tblberita.counter,
tblberita.anak,
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
tblberita  order by tblberita.id_berita DESC limit 0,3");
			return $q;
		}
		function Berita_Bawah2()
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
tblberita  order by tblberita.id_berita DESC limit 3,1");
			return $q;
		}
		function Berita_Terkini()
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
tblberita  order by tblberita.id_berita DESC limit 0,5");
			return $q;
		}
		function Berita_TerkiniDetail()
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
tblberita  order by tblberita.id_berita DESC limit 0,5");
			return $q;
		}
			function Berita_Bawah_Mobile()
		{
			$q=$this->db->query("SELECT tblberita.id_berita, 
	tblberita.judul_berita, 
	tblberita.isi, 
	tblberita.tanggal, 
	tblberita.anak, 
	tblberita.waktu, 
	tblberita.lite, 
	tblberita.url, 
	tblberita.gambar, 
	tblberita.foto_kecil, 
	tbl_menu.title, 
	tbl_menu.permalink
FROM tblberita LEFT JOIN tbl_menu on tbl_menu.id=tblberita.id_kategori
ORDER BY tblberita.id_berita DESC limit 0,10");
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
tbl_beritafoto.permalink,
tbl_beritafoto.tanggal,
tbl_beritafoto.penulis,
tbl_beritafoto.gambar
FROM
tbl_beritafoto order by tbl_beritafoto.id_beritafoto DESC limit 0,4");
			return $q;
		}
function Berita_PeristiwaM()
		{
			$q=$this->db->query("SELECT
tbl_beritafoto.id_beritafoto,
tbl_beritafoto.judul_beritafoto,
tbl_beritafoto.isi,
tbl_beritafoto.permalink,
tbl_beritafoto.tanggal,
tbl_beritafoto.penulis,
tbl_beritafoto.gambar
FROM
tbl_beritafoto order by tbl_beritafoto.id_beritafoto DESC limit 0,2");
			return $q;
		}
	function Berita_Peristiwa2()
		{
			$q=$this->db->query("SELECT
tbl_beritafoto.id_beritafoto,
tbl_beritafoto.judul_beritafoto,
tbl_beritafoto.isi,
tbl_beritafoto.tanggal,
tbl_beritafoto.permalink,
tbl_beritafoto.penulis,
tbl_beritafoto.gambar
FROM
tbl_beritafoto order by tbl_beritafoto.id_beritafoto DESC limit 2,3");
			return $q;
		}
		function Video_Function($id)
		{
			$q=$this->db->query("SELECT
tbl_video.url,
tbl_video.id_video,
tbl_video.judul_video
FROM
tbl_video WHERE id_kategori='$id' ORDER BY tbl_video.id_video DESC
 limit 1");
			return $q;
		}
		function Semua_DownloadDetail($id)
		{
			$q=$this->db->query("SELECT
tbl_download.kode_download,
tbl_download.counter,
tbl_download.kode_menu,
tbl_download.download,
tbl_download.ket,
tbl_download.file,
tbl_download.ukuran,
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
tbl_album_galeri.permalink,
tbl_album_galeri.id_album,
tbl_galeri.foto_kecil,
tbl_album_galeri.tanggal_album,
tbl_galeri.foto_besar,
tbl_album_galeri.keterangan
FROM
tbl_album_galeri left JOIN
tbl_galeri on tbl_galeri.id_album=tbl_album_galeri.id_album
order by id_album DESC 
limit 6
");
			return $q;
		}
function Tampil_GaleriM()
		{
			$q=$this->db->query("SELECT
tbl_album_galeri.nama_album,
tbl_album_galeri.permalink,
tbl_album_galeri.id_album,
tbl_galeri.foto_kecil,
tbl_album_galeri.tanggal_album,
tbl_galeri.foto_besar,
tbl_album_galeri.keterangan
FROM
tbl_album_galeri left JOIN
tbl_galeri on tbl_galeri.id_album=tbl_album_galeri.id_album group by tbl_album_galeri.id_album
order by id_album DESC 
limit 2
");
			return $q;
		}
		function Galeri_Terkait($id)
		{
			$q=$this->db->query("SELECT
tbl_album_galeri.nama_album,
tbl_album_galeri.permalink,
tbl_album_galeri.id_album,
tbl_galeri.foto_kecil,
tbl_album_galeri.tanggal_album,
tbl_galeri.foto_besar,
tbl_album_galeri.keterangan
FROM
tbl_album_galeri left JOIN
tbl_galeri on tbl_galeri.id_album=tbl_album_galeri.id_album where tbl_album_galeri.id_album!='$id' group by tbl_album_galeri.id_album
order by id_album DESC 
limit 4
");
			return $q;
		}
		function Side_Agenda()
		{
			$q=$this->db->query("select * from tbl_agenda order by id_agenda DESC limit 3");
			return $q;
		}
		function Side_Pengumuman()
		{
			$q=$this->db->query("select * from tbl_pengumuman order by id_pengumuman DESC limit 3");
			return $q;
		}
		function Side_Banner()
		{
			$q=$this->db->query("select * from tbl_banner limit 0,3");
			return $q;
		}
		function Side_Banner2()
		{
			$q=$this->db->query("select * from tbl_banner limit 2,5");
			return $q;
		}
		function Tampil_Polling()
		{
			$q=$this->db->query("select * from tbl_soalpolling where status='Y'");
			return $q;
		}
		function Tampil_Jwb_Poll($id_soal)
		{
			$q=$this->db->query("select * from tbl_jawabanpoll where id_soal_poll='$id_soal' order by tbl_jawabanpoll.id_jawaban_poll DESC");
			return $q;
		}
		function Menu_Atas()
		{
			$q=$this->db->query("select * from tbl_menu where id_parent='induk' ORDER BY id 
			ASC LIMIT 3");
			return $q;
		}
		function Menu_Bawah()
		{
			$q=$this->db->query("select * from tbl_menu where id_parent='induk'
			 ORDER BY id ASC LIMIT 0,7");
			return $q;
		}
		function Menu_Atas2()
		{
			$q=$this->db->query("select * from tbl_menu where id_parent='induk' ORDER BY id ASC LIMIT 6,15");
			return $q;
		}
		function Menu_Bawah2($id)
		{
			$q=$this->db->query("SELECT * from tbl_menu where id_parent='$id' ORDER BY id ASC");
			return $q;
		}
		function Menu_Mobile()
		{
			$q=$this->db->query("select * from tbl_menu where id_parent='induk' ORDER BY id ASC limit 0,8");
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
			$q=$this->db->query("select * from tbl_link order by id_link ASC limit 10");
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
		function Side_Info()
		{
			$q=$this->db->query("select * from tbl_info order by id_info  DESC limit 5");
			return $q;
		}
		function Side_Video()
		{
			$q=$this->db->query("select * from tbl_video order by id_video DESC limit 9");
			return $q;
		}
	function Side_VideoM()
		{
			$q=$this->db->query("select * from tbl_video order by id_video DESC limit 2");
			return $q;
		}
		function Video_Terkait($id)
		{
			$q=$this->db->query("select * from tbl_video where tbl_video.id_video!='$id' order by id_video DESC limit 4");
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
tbl_menu.title,
tblberita.id_kategori,
tblberita.editor,
tblberita.reporter,
tblberita.video,
tblberita.anak,
tblberita.judul_berita,
tblberita.lite,
tblberita.isi,
tblberita.gambar,
tblberita.tanggal,
tblberita.waktu,
tblberita.counter,
tblberita.foto_kecil,
tblberita.ig,
tblberita.email,
tblberita.ket_foto,
tblberita.url
FROM
tblberita left JOIN
tblkategori on tblkategori.id_kategori=tblberita.id_kategori LEFT JOIN tbl_menu ON tbl_menu.id = tblberita.id_kategori
WHERE tblberita.id_berita='$id'");
			return $q;	
		}
	
	function Detail_Skpd($id)
		{
			$q=$this->db->query("SELECT
*
FROM
tbl_skpd 
WHERE tbl_skpd.id_skpd='$id'");
			return $q;	
		}
		function Detail_Beritafoto($id)
		{
			$q=$this->db->query("SELECT
tbl_beritafoto.id_beritafoto,
tbl_beritafoto.judul_beritafoto,
tbl_beritafoto.isi,
tbl_beritafoto.tanggal,
tbl_beritafoto.permalink,
tbl_beritafoto.waktu,
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
			$query_update=$this->db->query("update tblberita
			 set counter=counter+1 where id_berita='$id_berita'");
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
tblberita where  tblberita.id_berita!='$key' AND tblberita.id_kategori='$id' order by tblberita.id_berita DESC LIMIT 2");
			return $q;	
		}
		function Foto_Terkait($key)
		{
			$q=$this->db->query("SELECT
tbl_beritafoto.id_beritafoto,
tbl_beritafoto.judul_beritafoto,
tbl_beritafoto.permalink,
tbl_beritafoto.isi,
tbl_beritafoto.tanggal,
tbl_beritafoto.penulis,
tbl_beritafoto.gambar
FROM
tbl_beritafoto
 where  tbl_beritafoto.id_beritafoto!='$key' order by RAND() LIMIT 4");
			return $q;	
		}
	    function Detail_Agenda($id_agenda)
		{

			$q=$this->db->query("select * from tbl_agenda where id_agenda='$id_agenda'");
			return $q;
		}
function Detail_Paper($id_agenda)
		{

			$q=$this->db->query("select * from tbl_paper where id_paper='$id_agenda'");
			return $q;
		}
		function Detail_Pengumuman($id_pengumuman)
		{
			$q=$this->db->query("select * from tbl_pengumuman where id_pengumuman='$id_pengumuman'");
			return $q;
		}
		function Detail_Roro($id_pengumuman)
		{
			$q=$this->db->query("SELECT tbl_tarif.id_tarif, 
	tbl_tarif.judul, 
	tbl_tarif.keterangan, 
	tbl_tarif.foto_kecil, 
	tbl_tarif.foto_besar, 
	tbl_tarif.tanggal, 
	tbl_tarif.waktu
FROM tbl_tarif where tbl_tarif.id_tarif='$id_pengumuman'");
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
		function Update_Polling($id_poll)
		{
			$query_update=$this->db->query("update tbl_jawabanpoll set counter=counter+1 where id_jawaban_poll='$id_poll'");
			return $query_update;
		}
		function Semua_Download($limit,$ofset,$status)
		{
			$q=$this->db->query("SELECT
tbl_download.kode_download,
tbl_download.kode_menu,
tbl_download.download,
tbl_download.counter,
tbl_download.ket,
tbl_download.file,
tbl_download.tanggal,
tbl_skpd.skpd,
tbl_menu.title
FROM
tbl_download LEFT JOIN tbl_menu on tbl_menu.id=tbl_download.kode_menu
left join tbl_skpd on tbl_skpd.id_skpd=tbl_download.id_skpd
WHERE tbl_menu.permalink
='$status' order by tbl_download.kode_download DESC limit $ofset,$limit");
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
	
	function Semua_Downloadku($limit,$ofset,$status)
		{
			$q=$this->db->query("SELECT
tbl_download.kode_download,
tbl_download.kode_menu,
tbl_download.download,
tbl_download.ket,
tbl_download.file,
tbl_download.tanggal,
tbl_download.counter,
tbl_skpd.skpd,
tbl_menu.title
FROM
tbl_download LEFT JOIN tbl_menu on tbl_menu.id=tbl_download.kode_menu
left join tbl_skpd on tbl_skpd.id_skpd=tbl_download.id_skpd
WHERE tbl_download.id_skpd='$status' order by tbl_download.kode_download DESC limit $ofset,$limit");
			return $q;
		}
		function Total_Downloadku($status)
		{
			$q=$this->db->query("SELECT
tbl_download.kode_download
FROM
tbl_download INNER JOIN
tbl_menu on tbl_menu.id=tbl_download.kode_menu
WHERE tbl_download.id_skpd
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
tbl_download.counter,
tbl_download.tanggal,
tbl_skpd.skpd,
tbl_menu.title
FROM
tbl_download LEFT JOIN tbl_menu on tbl_menu.id=tbl_download.kode_menu
left join tbl_skpd on tbl_skpd.id_skpd=tbl_download.id_skpd
order by tbl_download.kode_download DESC limit $ofset,$limit");
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
tbl_download.counter,
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
tbl_download.counter,
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
		function Total_Pengumuman()
		{
			$q=$this->db->query("select * from tbl_pengumuman order by id_pengumuman DESC");
			return $q;
		}
		function Semua_Pengumuman_Jenis($limit,$ofset,$id)
		{
			$q=$this->db->query("SELECT
tbl_pengumuman.id_pengumuman,
tbl_pengumuman.judul_pengumuman,
tbl_pengumuman.tanggal,
tbl_pengumuman.penulis,
tbl_pengumuman.isi,
tbl_pengumuman.visible,
tbl_pengumuman.id_jpengumuman,
tbljpengumuman.id_jpengumuman,
tbljpengumuman.jpengumuman
FROM
tbljpengumuman INNER JOIN
tbl_pengumuman on tbl_pengumuman.id_jpengumuman=tbljpengumuman.id_jpengumuman WHERE 
tbl_pengumuman.id_jpengumuman='$id' order by tbl_pengumuman.id_pengumuman DESC limit $ofset,$limit");
			return $q;
		}
		function Semua_Jabatan()
		{
			$query=$this->db->query("select * from tbl_jabatan order by id_jabatan ASC");
			return $query;
		}
		function Total_Pencarian_Pegawai($status)
		{
			$q=$this->db->query("select * from tbl_kepegawaian where kode_jabatan='$status' order by id_kepegawaian ASC");
			return $q;
		}
		function Pencarian_Pegawai($status,$limit,$ofset)
		{
			$q=$this->db->query("select * from tbl_kepegawaian left join tbl_jabatan on tbl_jabatan.id_jabatan=tbl_kepegawaian.kode_jabatan
			 where kode_jabatan='$status' order by id_kepegawaian ASC limit $ofset,$limit");
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
	function Semua_Ppid($limit,$ofset)
		{
			$q=$this->db->query("SELECT user_pembantu.id_pembantu, 
	user_pembantu.nama, 
	user_pembantu.email, 
	user_pembantu.username, 
	user_pembantu.`password`, 
	user_pembantu.`status`, 
	user_pembantu.akses, 
	user_pembantu.id_kepegawaian, 
	user_pembantu.id_skpd, 
	tbl_skpd.skpd, 
	user_pembantu.webiste, 
	user_pembantu.gambar, 
	user_pembantu.fb, 
	user_pembantu.twitter, 
	user_pembantu.alamat, 
	user_pembantu.ig, 
	user_pembantu.gplus, 
	user_pembantu.yt
FROM user_pembantu LEFT OUTER JOIN tbl_skpd ON tbl_skpd.id_skpd = user_pembantu.id_skpd where  tbl_skpd.id_skpd!='32'  order by user_pembantu.id_pembantu ASC limit $ofset,$limit");
			return $q;
		}
		function Semua_Ppidku()
		{
			$q=$this->db->query("SELECT user_pembantu.id_pembantu, 
	user_pembantu.nama, 
	user_pembantu.email, 
	user_pembantu.username, 
	user_pembantu.`password`, 
	user_pembantu.`status`, 
	user_pembantu.akses, 
	user_pembantu.id_kepegawaian, 
	user_pembantu.id_skpd, 
	tbl_skpd.skpd, 
	user_pembantu.webiste, 
	user_pembantu.gambar, 
	user_pembantu.fb, 
	user_pembantu.twitter, 
	user_pembantu.alamat, 
	user_pembantu.ig, 
	user_pembantu.gplus, 
	user_pembantu.yt
FROM user_pembantu LEFT OUTER JOIN tbl_skpd ON tbl_skpd.id_skpd = user_pembantu.id_skpd where  tbl_skpd.id_skpd!='32'  AND tbl_skpd.status='Y' order by user_pembantu.id_pembantu ASC");
			return $q;
		}
		function Semua_Ppidku2()
		{
			$q=$this->db->query("SELECT user_pembantu.id_pembantu, 
	user_pembantu.nama, 
	user_pembantu.email, 
	user_pembantu.username, 
	user_pembantu.`password`, 
	user_pembantu.`status`, 
	user_pembantu.akses, 
	user_pembantu.id_kepegawaian, 
	user_pembantu.id_skpd, 
	tbl_skpd.skpd, 
	user_pembantu.webiste, 
	user_pembantu.gambar, 
	user_pembantu.fb, 
	user_pembantu.twitter, 
	user_pembantu.alamat, 
	user_pembantu.ig, 
	user_pembantu.gplus, 
	user_pembantu.yt
FROM user_pembantu LEFT OUTER JOIN tbl_skpd ON tbl_skpd.id_skpd = user_pembantu.id_skpd where  tbl_skpd.id_skpd!='32'  AND tbl_skpd.status='N' order by user_pembantu.id_pembantu ASC");
			return $q;
		}
		function Semua_PpidUtama()
		{
			$q=$this->db->query("SELECT user_pembantu.id_pembantu, 
	user_pembantu.nama, 
	user_pembantu.email, 
	user_pembantu.username, 
	user_pembantu.`password`, 
	user_pembantu.`status`, 
	user_pembantu.akses, 
	user_pembantu.id_kepegawaian, 
	user_pembantu.id_skpd, 
	tbl_skpd.skpd, 
	user_pembantu.webiste, 
	user_pembantu.gambar, 
	user_pembantu.fb, 
	user_pembantu.twitter, 
	user_pembantu.alamat, 
	user_pembantu.ig, 
	user_pembantu.gplus, 
	user_pembantu.yt
FROM user_pembantu LEFT OUTER JOIN tbl_skpd ON tbl_skpd.id_skpd = user_pembantu.id_skpd
 where  tbl_skpd.id_skpd='32' order by user_pembantu.id_pembantu");
			return $q;
		}
		function Total_Ppid()
		{
			$q=$this->db->query("select * from user_pembantu order by user_pembantu.id_pembantu ASC");
			return $q;
		}
	
	function Pencarian_Ppid($limit,$ofset,$id)
		{
			$q=$this->db->query("SELECT user_pembantu.id_pembantu, 
	user_pembantu.nama, 
	user_pembantu.email, 
	user_pembantu.username, 
	user_pembantu.`password`, 
	user_pembantu.`status`, 
	user_pembantu.akses, 
	user_pembantu.id_kepegawaian, 
	user_pembantu.id_skpd, 
	tbl_skpd.skpd, 
	user_pembantu.webiste, 
	user_pembantu.gambar, 
	user_pembantu.fb, 
	user_pembantu.twitter, 
	user_pembantu.alamat, 
	user_pembantu.ig, 
	user_pembantu.gplus, 
	user_pembantu.yt
FROM user_pembantu LEFT OUTER JOIN tbl_skpd ON tbl_skpd.id_skpd = user_pembantu.id_skpd where  tbl_skpd.skpd like '%$id%' order by user_pembantu.id_pembantu ASC limit $ofset,$limit");
			return $q;
		}
	function Total_Pencarian_Ppid($id)
		{
			$q=$this->db->query("select * from user_pembantu LEFT OUTER JOIN tbl_skpd ON tbl_skpd.id_skpd = user_pembantu.id_skpd where  tbl_skpd.skpd like '%$id%' order by user_pembantu.id_pembantu ASC");
			return $q;
		}
		function Semua_Berita($limit,$ofset)
		{
			$q=$this->db->query("SELECT tblberita.id_berita, 
	tblberita.judul_berita, 
	tblberita.isi, 
	tblberita.tanggal, 
	tblberita.anak, 
	tblberita.waktu, 
	tblberita.lite, 
	tblberita.url, 
	tblberita.gambar, 
	tblberita.foto_kecil, 
	tbl_menu.title, 
	tbl_menu.permalink
FROM tblberita LEFT JOIN tbl_menu on tbl_menu.id=tblberita.id_kategori where id_kategori!='255' order by id_berita DESC limit $ofset,$limit");
			return $q;
		}
		function Total_Berita()
		{
			$q=$this->db->query("select * from tblberita where id_kategori!='250' order by id_berita DESC");
			return $q;
		}
		function Semua_Sekolah($limit,$ofset)
		{
			$q=$this->db->query("select a.id_sekolah_profil, a.npsn, a.nama_sekolah, a.status_sekolah, b.pendidikan, c.kecamatan from 
		dlmbg_sekolah_profil a left join dlmbg_super_jenjang_pendidikan b on
		a.id_jenjang_pendidikan=b.id_super_jenjang_pendidikan left join dlmbg_super_kecamatan c on a.id_kecamatan=c.id_super_kecamatan 
		
		 limit $ofset,$limit");
			return $q;
		}
		function Total_Sekolah()
		{
			$q=$this->db->query("select * from dlmbg_sekolah_profil");
			return $q;
		}
		function Semua_Guru($limit,$ofset)
		{
			$q=$this->db->query("select a.nama, a.jk, a.status_pns, a.golongan, a.tugas, b.nama_sekolah, a.tempat_lahir, 
		a.tanggal_lahir, a.tanggal_bertugas from dlmbg_sekolah_guru a left join dlmbg_sekolah_profil b on a.id_sekolah=b.id_sekolah_profil
		left join dlmbg_super_jenjang_pendidikan c on 
		a.id_jenjang_pendidikan=c.id_super_jenjang_pendidikan
		
		 limit $ofset,$limit");
			return $q;
		}
		function Total_Guru()
		{
			$q=$this->db->query("select * from dlmbg_sekolah_guru");
			return $q;
		}
		function Semua_Siswa($limit,$ofset)
		{
			$q=$this->db->query("select a.nama, a.nisn, a.kelas, b.nama_sekolah, c.pendidikan, 
			d.kecamatan from dlmbg_sekolah_siswa a left join 
		dlmbg_sekolah_profil b on a.id_sekolah=b.id_sekolah_profil left join dlmbg_super_jenjang_pendidikan c 
		on a.id_jenjang_pendidikan=c.id_super_jenjang_pendidikan left
		 join dlmbg_super_kecamatan d on a.id_kecamatan=d.id_super_kecamatan
		 limit $ofset,$limit");
			return $q;
		}
		function Total_Siswa()
		{
			$q=$this->db->query("select * from dlmbg_sekolah_siswa");
			return $q;
		}
		function Semua_Beritafoto($limit,$ofset)
		{
			$q=$this->db->query("select * from tbl_beritafoto  order by id_beritafoto DESC limit $ofset,$limit");
			return $q;
		}
		function Total_Beritafoto()
		{
			$q=$this->db->query("select * from tbl_beritafoto order by id_beritafoto DESC");
			return $q;
		}
		function Semua_BeritaKat($limit,$ofset,$id)
		{
			$q=$this->db->query("SELECT tblberita.id_berita, 
	tblberita.judul_berita, 
	tblberita.isi, 
	tblberita.tanggal, 
	tblberita.anak, 
	tblberita.waktu, 
	tblberita.lite, 
	tblberita.url, 
	tblberita.gambar, 
	tblberita.foto_kecil, 
	tbl_menu.title, 
	tbl_menu.permalink
FROM tblberita LEFT JOIN tbl_menu on tbl_menu.id=tblberita.id_kategori where tbl_menu.permalink='$id'
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
			$q=$this->db->query("select * from tblberita where id_kategori!='250' order by id_berita DESC limit $ofset,$limit");
			return $q;
		}
		function Total_Artikel()
		{
			$q=$this->db->query("select * from tblberita where id_kategori!='250' order by id_berita DESC");
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
		function Simpan_Survey($datainput)
		{
			$this->db->insert('tbl_pengirim',$datainput);
		}
	function Simpan_Pemohon($datainput)
		{
			$this->db->insert('tbl_pemohon',$datainput);
		}
	function Simpan_Keberatan($datainput)
		{
			$this->db->insert('tbl_keberatan',$datainput);
		}
		function Semua_Foto2()
		{
			$q=$this->db->query("SELECT
tbl_album_galeri.nama_album,
tbl_album_galeri.permalink,
tbl_album_galeri.id_album,
tbl_galeri.foto_kecil,
tbl_album_galeri.tanggal_album,
tbl_galeri.foto_besar,
tbl_album_galeri.keterangan
FROM
tbl_album_galeri INNER JOIN
tbl_galeri on tbl_galeri.id_album=tbl_album_galeri.id_album
GROUP BY tbl_album_galeri.id_album 
order by id_album DESC LIMIT 16");
			return $q;
		}
		function Semua_Foto($limit,$ofset)
		{
			$q=$this->db->query("SELECT
tbl_album_galeri.nama_album,
tbl_album_galeri.id_album,
tbl_album_galeri.permalink,
tbl_galeri.foto_kecil,
tbl_album_galeri.tanggal_album,
tbl_galeri.foto_besar,
tbl_album_galeri.keterangan
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
		function Semua_Video($limit,$ofset)
		{
			$q=$this->db->query("SELECT
tbl_video.id_video,
tbl_video.judul_video,
tbl_video.permalink,
tbl_video.url,
tbl_video.tanggal,
tbl_video.waktu,
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
		function Semua_Paper($limit,$ofset)
		{
			$q=$this->db->query("SELECT
*
FROM
tbl_paper 
order by tbl_paper.id_paper DESC limit $ofset,$limit");
			return $q;
		}
		function Total_Paper()
		{
			$q=$this->db->query("select * from tbl_paper order by tbl_paper.id_paper ASC");
			return $q;
		}
		function Semua_Bijak($limit,$ofset)
		{
			$q=$this->db->query("SELECT
tbl_bijak.id_bijak,
tbl_bijak.judul,
tbl_bijak.keterangan,
tbl_bijak.foto_kecil,
tbl_bijak.foto_besar,
tbl_bijak.tanggal,
tbl_bijak.waktu
FROM
tbl_bijak

order by tbl_bijak.id_bijak DESC limit $ofset,$limit");
			return $q;
		}
		function Total_Bijak()
		{
			$q=$this->db->query("select * from tbl_bijak order by tbl_bijak.id_bijak ASC");
			return $q;
		}
		function Semua_Pantun($limit,$ofset)
		{
			$q=$this->db->query("SELECT
*
FROM
tbl_pantun 
order by tbl_pantun.id_pantun DESC limit $ofset,$limit");
			return $q;
		}
		function Total_Pantun()
		{
			$q=$this->db->query("select * from tbl_pantun order by tbl_pantun.id_pantun ASC");
			return $q;
		}
		function Detail_Galeri($id_album)
		{
			$q=$this->db->query("SELECT
tbl_album_galeri.nama_album,
tbl_album_galeri.penulis,
tbl_album_galeri.permalink,
tbl_album_galeri.id_album,
tbl_album_galeri.keterangan as ket,
tbl_galeri.foto_kecil,
tbl_galeri.foto_besar,
tbl_galeri.keterangan,
tbl_album_galeri.tanggal_album,
tbl_album_galeri.waktu,
tbl_album_galeri.counter,
tbl_galeri.id_foto
FROM
tbl_album_galeri INNER JOIN
tbl_galeri on tbl_galeri.id_album=tbl_album_galeri.id_album
 where tbl_galeri.id_album='$id_album'");
			return $q;
		}
		function Detail_Video($id_album)
		{
			$q=$this->db->query("SELECT
tbl_video.id_video,
tbl_video.judul_video,
tbl_video.url,
tbl_video.tanggal,
tbl_video.waktu,
tbl_video.penulis,
tbl_video.permalink,
tbl_video.gambar,
tbl_video.id_kategori
FROM
tbl_video

 where tbl_video.id_video='$id_album'");
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
tblhubungi.pekerjaan,
tblhubungi.foto,
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
		function Pencarian_Surat($id,$limit,$ofset)
		{
			$q=$this->db->query("SELECT
tblhubungi.id_hubungi,
tblhubungi.nama,
tblhubungi.email,
tblhubungi.pesan,
tblhubungi.pekerjaan,
tblhubungi.foto,
tblhubungi.`status`,
tblhubungi.posted_date,
tblhubungi.alamat,
tblhubungi.phone,
tblhubungi.replay
FROM
tblhubungi WHERE tblhubungi.`status`='Y' AND tblhubungi.nama like '%$id%'
 order by tblhubungi.id_hubungi DESC limit $ofset,$limit");
			return $q;
		}
		function Total_Pencarian_Surat($id)
		{
			$q=$this->db->query("SELECT
tblhubungi.id_hubungi
FROM
tblhubungi WHERE tblhubungi.`status`='Y' AND tblhubungi.nama like '%$id%'");
			return $q;
		}
		function Berita_Function($id,$limit)
		{
			$q=$this->db->query("SELECT
tblberita.id_berita,
tblberita.judul_berita,
tblberita.isi,
tblberita.tanggal,
tblberita.editor,
tblberita.anak,
tblberita.waktu,
tblberita.lite,
tblberita.url,
tblberita.gambar,
tblberita.foto_kecil
FROM
tblberita where tblberita.id_kategori='$id' order by tblberita.id_berita DESC limit 0,$limit");
			return $q;
		}
	function Download_Function($id,$limit)
		{
			$q=$this->db->query("SELECT
tbl_download.kode_download,
tbl_download.download,
tbl_download.ukuran,
tbl_download.counter,
tbl_download.file,
tbl_download.tanggal
FROM
tbl_download where tbl_download.kode_menu='$id' order by tbl_download.kode_download DESC limit 0,$limit");
			return $q;
		}
		function Semua_Statistik($limit,$ofset,$status)
		{
			$q=$this->db->query("SELECT tbl_statistik.id_statistik, 
	tbl_statistik.judul, 
	tbl_statistik.ket, 
	tbl_statistik.file, 
	tbl_statistik.tanggal, 
	tbl_statistik.waktu, 
	tbl_statistik.counter, 
	tbl_statistik.kode_menu, 
	tbl_statistik.permalink, 
	tbl_statistik.ukuran
FROM tbl_statistik INNER JOIN
tbl_menu on tbl_menu.id=tbl_statistik.kode_menu
WHERE tbl_menu.permalink
='$status' order by tbl_statistik.id_statistik ASC limit $ofset,$limit");
			return $q;
		}
		function Total_Statistik($status)
		{
			$q=$this->db->query("SELECT
tbl_statistik.id_statistik
FROM
tbl_statistik INNER JOIN
tbl_menu on tbl_menu.id=tbl_statistik.kode_menu
WHERE tbl_menu.permalink
='$status'");
			return $q;
		}
	
	function Semua_StatistikDetail($id)
		{
			$q=$this->db->query("SELECT
*
FROM
tbl_statistik 
WHERE tbl_statistik.id_statistik='$id'");
			return $q;
		}
		
		function Pencarian_Download($id,$limit,$ofset)
		{
			$q=$this->db->query("SELECT
tbl_download.kode_download,
tbl_download.kode_menu,
tbl_download.download,
tbl_download.ket,
tbl_download.counter,
tbl_download.file,
tbl_download.tanggal,
tbl_skpd.skpd,
tbl_menu.title
FROM
tbl_download LEFT JOIN tbl_menu on tbl_menu.id=tbl_download.kode_menu
left join tbl_skpd on tbl_skpd.id_skpd=tbl_download.id_skpd WHERE tbl_download.download like '%$id%' or tbl_download.ket like '%$id%'
 order by tbl_download.kode_download DESC limit $ofset,$limit");
			return $q;
		}
		function Total_Pencarian_Download($id)
		{
			$q=$this->db->query("SELECT
tbl_download.kode_download
FROM
tblhubungi WHERE tbl_download.download like '%$id%' or tbl_download.ket like '%$id%'");
			return $q;
		}
		
	
	public function getLoginDataUser($usr,$psw)
	{
		//End
		$u = $usr;
		$p = md5($psw.$this->config->item("key_login"));
		$q_cek_login = $this->db->get_where('user_pembantu', array('username' => $u, 'password' => $p));
		if(count($q_cek_login->result())>0)
		{
			foreach($q_cek_login->result() as $qck)
			{
				foreach($q_cek_login->result() as $qad)
				{
					$sess_data['logged_in_ppid'] = 'yesGetMeLogin';
					$sess_data['username_ppid'] = $qad->username;
					$sess_data['idm_ppid'] = $qad->id_pembantu;
					$sess_data['nama_pengguna_ppid'] = $qad->nama;
					$sess_data['akses_ppid'] = $qad->akses;
					$sess_data['skpd_ppid'] = $qad->id_skpd;
					$this->session->set_userdata($sess_data);
				}
				header('location:'.base_url().'pembantu');
			}
		}
		else
		{
			$this->session->set_flashdata('result_login', 'Username atau Password yang anda masukkan salah.');
			header('location:'.base_url().'web');
		}
		
	
	
	}
	function Jumlah_Trans()
		{
			$q=$this->db->query("SELECT
COUNT(tbl_transparansi.id_transparansi) as total
FROM
tbl_transparansi");
			return $q;
		}
	function Jumlah_Selesai()
		{
			$q=$this->db->query("SELECT
COUNT(tbl_pemohon.id_pemohon) as total
FROM
tbl_pemohon where tbl_pemohon.status!='N' AND tbl_pemohon.status!='DISPOSISI'
");
			return $q;
		}
	function Jumlah_Unduh()
		{
			$q=$this->db->query("SELECT
SUM(tbl_download.counter) as tot
FROM
tbl_download
");
			return $q;
		}
	
	function V_Proses($id,$status)
		{
			$q=$this->db->query("SELECT
COUNT(tbl_pemohon.id_pemohon) as total
FROM
tbl_pemohon where tbl_pemohon.id_skpd='$id' AND tbl_pemohon.status='$status'
");
			return $q;
		}
	function V_Jenis($id,$status)
		{
			$q=$this->db->query("SELECT
COUNT(tbl_pemohon.id_pemohon) as total
FROM
tbl_pemohon where tbl_pemohon.id_skpd='$id' AND tbl_pemohon.jenis='$status'
");
			return $q;
		}
		function V_Jenis_Bulan($id,$status,$bln,$thn)
		{
			$q=$this->db->query("SELECT
COUNT(tbl_pemohon.id_pemohon) as total
FROM
tbl_pemohon where tbl_pemohon.id_skpd='$id' AND tbl_pemohon.jenis='$status' and MONTH(tbl_pemohon.posted_date)='$bln' AND YEAR(tbl_pemohon.posted_date)='$thn'
");
			return $q;
		}
	function V_TotalPid($id)
		{
			$q=$this->db->query("SELECT
COUNT(tbl_download.kode_download) as total
FROM
tbl_download where tbl_download.id_skpd='$id' AND (tbl_download.kode_menu='10' OR tbl_download.kode_menu='191' OR tbl_download.kode_menu='241')
");
			return $q;
		}
		function V_ProsesSkpd($id)
		{
			$q=$this->db->query("SELECT
COUNT(tbl_pemohon.id_pemohon) as total
FROM
tbl_pemohon where tbl_pemohon.id_skpd='$id'
");
			return $q;
		}
	
	function V_ProsesSkpd2($id)
		{
			$q=$this->db->query("SELECT
COUNT(tbl_pemohon.id_pemohon) as total
FROM
tbl_pemohon where tbl_pemohon.id_skpd='$id' AND tbl_pemohon.status!='N' AND tbl_pemohon.status!='DISPOSISI'
");
			return $q;
		}
	
		function V_Proses_K($id,$status)
		{
			$q=$this->db->query("SELECT
COUNT(tbl_pemohon.id_pemohon) as total
FROM
tbl_pemohon where tbl_pemohon.id_skpd='$id' AND tbl_pemohon.status='DIPENUHI' AND 
tbl_pemohon.cara3='$status' AND tbl_pemohon.status2='N'
");
			return $q;
		}
		
		function V_Proses2($id,$status,$bln,$thn)
		{
			$q=$this->db->query("SELECT
COUNT(tbl_pemohon.id_pemohon) as total
FROM
tbl_pemohon where tbl_pemohon.id_skpd='$id' AND tbl_pemohon.status='$status' 
and MONTH(tbl_pemohon.posted_date)='$bln' AND YEAR(tbl_pemohon.posted_date)='$thn'
");
			return $q;
		}
		
		function V_Proses_K2($id,$status,$bln,$thn)
		{
			$q=$this->db->query("SELECT
COUNT(tbl_pemohon.id_pemohon) as total
FROM
tbl_pemohon where tbl_pemohon.id_skpd='$id' AND tbl_pemohon.status='DIPENUHI' AND tbl_pemohon.status2='N' AND 
tbl_pemohon.cara3='$status' and MONTH(tbl_pemohon.posted_date)='$bln' AND YEAR(tbl_pemohon.posted_date)='$thn'
");
			return $q;
		}
		
		function V_Totalfak($id)
		{
			$q=$this->db->query("SELECT
COUNT(tbl_download.kode_download) as total
FROM
tbl_download where tbl_download.kode_menu='$id'
");
			return $q;
		}
	
	function V_Jenis_Publik($id,$status)
		{
			$q=$this->db->query("SELECT
COUNT(tbl_download.kode_download) as total
FROM
tbl_download where tbl_download.kode_menu='$status' AND tbl_download.id_skpd='$id'
");
			return $q;
		}
	function V_Jenis_Publik2($status)
		{
			$q=$this->db->query("SELECT
COUNT(tbl_download.kode_download) as total
FROM
tbl_download where tbl_download.kode_menu='$status'
");
			return $q;
		}
	function V_TotalPid2()
		{
			$q=$this->db->query("SELECT
COUNT(tbl_download.kode_download) as total
FROM
tbl_download WHERE tbl_download.kode_menu='10' OR tbl_download.kode_menu='191' OR tbl_download.kode_menu='241'
");
			return $q;
		}
	
	function V_Jenis_Publik_Bulan($id,$status,$bln,$thn)
		{
			$q=$this->db->query("SELECT
COUNT(tbl_download.kode_download) as total
FROM
tbl_download where tbl_download.kode_menu='$status' AND tbl_download.id_skpd='$id' and MONTH(tbl_download.tanggal)='$bln' AND YEAR(tbl_download.tanggal)='$thn'
");
			return $q;
		}
	
	function V_TotalPid_Bulan($id,$bln,$thn)
		{
			$q=$this->db->query("SELECT
COUNT(tbl_download.kode_download) as total
FROM
tbl_download where tbl_download.id_skpd='$id' and MONTH(tbl_download.tanggal)='$bln' AND YEAR(tbl_download.tanggal)='$thn' AND (tbl_download.kode_menu='10' OR tbl_download.kode_menu='191' OR tbl_download.kode_menu='241')
");
			return $q;
		}
	
	function V_TotalPid2_Bulan($bln,$thn)
		{
			$q=$this->db->query("SELECT
COUNT(tbl_download.kode_download) as total
FROM
tbl_download where MONTH(tbl_download.tanggal)='$bln' AND YEAR(tbl_download.tanggal)='$thn'
");
			return $q;
		}
	function V_Jenis_Publik2_Bulan($status,$bln,$thn)
		{
			$q=$this->db->query("SELECT
COUNT(tbl_download.kode_download) as total
FROM
tbl_download where tbl_download.kode_menu='$status' AND MONTH(tbl_download.tanggal)='$bln' AND YEAR(tbl_download.tanggal)='$thn' AND (tbl_download.kode_menu='10' OR tbl_download.kode_menu='191' OR tbl_download.kode_menu='241')
");
			return $q;
		}
	
	//Keberatan
	function V_Berat($id,$status)
		{
			$q=$this->db->query("SELECT
COUNT(tbl_keberatan.id_keberatan) as total
FROM
tbl_keberatan where tbl_keberatan.id_skpd='$id' AND tbl_keberatan.status='$status'
");
			return $q;
		}
	function V_Berat_Total($id)
		{
			$q=$this->db->query("SELECT
COUNT(tbl_keberatan.id_keberatan) as total
FROM
tbl_keberatan where tbl_keberatan.id_skpd='$id'
");
			return $q;
		}
	
	function V_Berat2($status)
		{
			$q=$this->db->query("SELECT
COUNT(tbl_keberatan.id_keberatan) as total
FROM
tbl_keberatan where tbl_keberatan.status='$status'
");
			return $q;
		}
	function V_Berat_Total2()
		{
			$q=$this->db->query("SELECT
COUNT(tbl_keberatan.id_keberatan) as total
FROM
tbl_keberatan
");
			return $q;
		}
	
	//Keberatan Bulan
	function V_Berat_Bulan($id,$status,$bln,$thn)
		{
			$q=$this->db->query("SELECT
COUNT(tbl_keberatan.id_keberatan) as total
FROM
tbl_keberatan where tbl_keberatan.id_skpd='$id' AND tbl_keberatan.status='$status' and MONTH(tbl_keberatan.posted_date)='$bln' AND YEAR(tbl_keberatan.posted_date)='$thn'
");
			return $q;
		}
	function V_Berat_Total_Bulan($id,$bln,$thn)
		{
			$q=$this->db->query("SELECT
COUNT(tbl_keberatan.id_keberatan) as total
FROM
tbl_keberatan where tbl_keberatan.id_skpd='$id' and MONTH(tbl_keberatan.posted_date)='$bln' AND YEAR(tbl_keberatan.posted_date)='$thn'
");
			return $q;
		}
	
	function V_Berat2_Bulan($status,$bln,$thn)
		{
			$q=$this->db->query("SELECT
COUNT(tbl_keberatan.id_keberatan) as total
FROM
tbl_keberatan where tbl_keberatan.status='$status' and MONTH(tbl_keberatan.posted_date)='$bln' AND YEAR(tbl_keberatan.posted_date)='$thn'
");
			return $q;
		}
	function V_Berat_Total2_Bulan($bln,$thn)
		{
			$q=$this->db->query("SELECT
COUNT(tbl_keberatan.id_keberatan) as total
FROM
tbl_keberatan where MONTH(tbl_keberatan.posted_date)='$bln' AND YEAR(tbl_keberatan.posted_date)='$thn'
");
			return $q;
		}

		function Semua_Menutypeku()
		{
			$query=$this->db->query("select * from tbl_menu where id='10' or id='191' or id='241' order by id ASC");
			return $query;
		}
		function Side_Transparansi()
		{
			$q=$this->db->query("SELECT
tbl_transparansi.id_transparansi,
tbl_transparansi.id_jenistransparansi,
tbl_transparansi.judul,
tbl_transparansi.file,
tbl_transparansi.tanggal,
tbl_transparansi.counter,
tbl_transparansi.id_tahun,
tbl_jenistransparansi.jenistransparansi,
tbl_tahun.tahun,
tbl_skpd.skpd
FROM
tbl_transparansi
LEFT JOIN tbl_jenistransparansi ON tbl_jenistransparansi.id_jenistransparansi = tbl_transparansi.id_jenistransparansi
LEFT JOIN tbl_tahun ON tbl_tahun.id_tahun = tbl_transparansi.id_tahun LEFT JOIN
tbl_skpd on tbl_skpd.id_skpd=tbl_transparansi.id_skpd
ORDER BY
tbl_transparansi.id_transparansi DESC

 LIMIT 0,5");
			return $q;
		}
		function Jenis_Transparansi()

		{

			$q=$this->db->query("SELECT
*
FROM
tbl_jenistransparansi order by tbl_jenistransparansi.id_jenistransparansi ASC
");

			return $q;

		}
		function Semua_JumlahTransparansi($id)
		{
			$q=$this->db->query("SELECT COUNT(tbl_transparansi.id_transparansi) as jum 
	
FROM tbl_transparansi where tbl_transparansi.id_jenistransparansi='$id'");
			return $q;
		}
		function Berita_Penghargaan()
		{
			$q=$this->db->query("SELECT tbl_penghargaan.waktu, 
	tbl_penghargaan.tanggal, 
	tbl_penghargaan.tahun, 
	tbl_penghargaan.permalink, 
	tbl_penghargaan.gambar, 
	tbl_penghargaan.url, 
	tbl_penghargaan.isi, 
	tbl_penghargaan.judul_penghargaan, 
	tbl_penghargaan.id_kategori, 
	tbl_penghargaan.id_penghargaan, 
	tbl_menu.title
FROM tbl_penghargaan LEFT join tbl_menu on tbl_menu.id=tbl_penghargaan.id_kategori

 order by tbl_penghargaan.id_penghargaan DESC LIMIT 0,6");
			return $q;
		}
		function Skpd()
		{
			$q=$this->db->query("SELECT
*
FROM
tbl_skpd order by id_skpd ASC");
			return $q;	
		}
		function Profil()
		{
			$q=$this->db->query("SELECT
tbl_profil.id_profil,
tbl_profil.identitas_diri,
tbl_profil.nama_lengkap,
tbl_profil.tempat_lahir,
tbl_profil.tanggal_lahir,
tbl_profil.alamat,
tbl_profil.id_agama,
tbl_profil.hp,
tbl_profil.alamat_surel,
tbl_profil.alamat_kantor,
tbl_profil.id_menikah,
tbl_profil.nip,
tbl_profil.id_pangkat,
tbl_profil.id_golongan,
tbl_profil.id_jabatanprofil,
tbl_profil.unit_kerja,
tbl_profil.hobi,
tbl_profil.nama_pasangan,
tbl_profil.id_jk,
tbl_profil.pendidikan,
tbl_profil.foto,
tbl_profil.foto_profil,
tbl_agama.agama,
tbl_menikah.menikah,
tbl_pangkat.pangkat,
tbl_golongan.golongan,
tbl_jabatanprofil.jabatanprofil,
tbl_kelamin.kelamin,
tbl_skpd.skpd
FROM
tbl_profil
LEFT JOIN tbl_agama ON tbl_agama.id_agama = tbl_profil.id_agama
LEFT JOIN tbl_menikah ON tbl_menikah.id_menikah = tbl_profil.id_menikah
LEFT JOIN tbl_pangkat ON tbl_pangkat.id_pangkat = tbl_profil.id_pangkat
LEFT JOIN tbl_golongan ON tbl_golongan.id_golongan = tbl_profil.id_golongan
LEFT JOIN tbl_jabatanprofil ON tbl_jabatanprofil.id_jabatanprofil = tbl_profil.id_jabatanprofil
LEFT JOIN tbl_kelamin ON tbl_kelamin.id_kelamin = tbl_profil.id_jk LEFT JOIN
tbl_skpd ON tbl_skpd.id_skpd=tbl_profil.unit_kerja where tbl_profil.status='Y'
ORDER BY
tbl_profil.id_profil ASC
 LIMIT 0,6");
			return $q;
		}

		function Detail_Penghagargaan($id)
		{
			$q=$this->db->query("SELECT tbl_penghargaan.waktu, 
	tbl_penghargaan.tanggal, 
	tbl_penghargaan.tahun, 
	tbl_penghargaan.permalink, 
	tbl_penghargaan.gambar, 
	tbl_penghargaan.url, 
	tbl_penghargaan.isi, 
	tbl_penghargaan.judul_penghargaan, 
	tbl_penghargaan.id_kategori, 
	tbl_penghargaan.id_penghargaan, 
	tbl_menu.title
FROM tbl_penghargaan LEFT join tbl_menu on tbl_menu.id=tbl_penghargaan.id_kategori
where tbl_penghargaan.id_penghargaan='$id'");
			return $q;
		}
		function Penghargaan_Terkait($id)
		{
			$q=$this->db->query("SELECT tbl_penghargaan.waktu, 
	tbl_penghargaan.tanggal, 
	tbl_penghargaan.tahun, 
	tbl_penghargaan.permalink, 
	tbl_penghargaan.gambar, 
	tbl_penghargaan.url, 
	tbl_penghargaan.isi, 
	tbl_penghargaan.judul_penghargaan, 
	tbl_penghargaan.id_kategori, 
	tbl_penghargaan.id_penghargaan, 
	tbl_menu.title
FROM tbl_penghargaan LEFT join tbl_menu on tbl_menu.id=tbl_penghargaan.id_kategori
where tbl_penghargaan.id_penghargaan!='$id' LIMIT 0,2");
			return $q;
		}
		function Semua_DownloadDetail2($id)
		{
			$q=$this->db->query("SELECT
tbl_transparansi.id_transparansi,
tbl_transparansi.id_jenistransparansi,
tbl_transparansi.judul,
tbl_transparansi.file,
tbl_transparansi.tanggal,
tbl_transparansi.counter,
tbl_transparansi.id_tahun,
tbl_jenistransparansi.jenistransparansi,
tbl_tahun.tahun,
tbl_skpd.skpd
FROM
tbl_transparansi
LEFT JOIN tbl_jenistransparansi ON tbl_jenistransparansi.id_jenistransparansi = tbl_transparansi.id_jenistransparansi
LEFT JOIN tbl_tahun ON tbl_tahun.id_tahun = tbl_transparansi.id_tahun LEFT JOIN
tbl_skpd on tbl_skpd.id_skpd=tbl_transparansi.id_skpd
WHERE tbl_transparansi.id_transparansi='$id'");
			return $q;
		}
		function Semua_Profil($limit,$ofset)
		{
			$q=$this->db->query("SELECT
tbl_profil.id_profil,
tbl_profil.identitas_diri,
tbl_profil.nama_lengkap,
tbl_profil.tempat_lahir,
tbl_profil.tanggal_lahir,
tbl_profil.alamat,
tbl_profil.id_agama,
tbl_profil.hp,
tbl_profil.alamat_surel,
tbl_profil.alamat_kantor,
tbl_profil.id_menikah,
tbl_profil.nip,
tbl_profil.id_pangkat,
tbl_profil.id_golongan,
tbl_profil.id_jabatanprofil,
tbl_profil.unit_kerja,
tbl_profil.hobi,
tbl_profil.nama_pasangan,
tbl_profil.id_jk,
tbl_profil.pendidikan,
tbl_profil.foto,
tbl_profil.foto_profil,
tbl_agama.agama,
tbl_menikah.menikah,
tbl_pangkat.pangkat,
tbl_golongan.golongan,
tbl_jabatanprofil.jabatanprofil,
tbl_kelamin.kelamin,
tbl_skpd.skpd
FROM
tbl_profil
LEFT JOIN tbl_agama ON tbl_agama.id_agama = tbl_profil.id_agama
LEFT JOIN tbl_menikah ON tbl_menikah.id_menikah = tbl_profil.id_menikah
LEFT JOIN tbl_pangkat ON tbl_pangkat.id_pangkat = tbl_profil.id_pangkat
LEFT JOIN tbl_golongan ON tbl_golongan.id_golongan = tbl_profil.id_golongan
LEFT JOIN tbl_jabatanprofil ON tbl_jabatanprofil.id_jabatanprofil = tbl_profil.id_jabatanprofil
LEFT JOIN tbl_kelamin ON tbl_kelamin.id_kelamin = tbl_profil.id_jk LEFT JOIN
tbl_skpd ON tbl_skpd.id_skpd=tbl_profil.unit_kerja
ORDER BY
tbl_profil.id_profil ASC limit $ofset,$limit");
			return $q;
		}
		function Total_Profil()
		{
			$q=$this->db->query("select * from tbl_profil order
			 by tbl_profil.id_profil ASC");
			return $q;
		}
		function Semua_penghargaan($limit,$ofset)
		{
			$q=$this->db->query("SELECT tbl_penghargaan.waktu, 
	tbl_penghargaan.tanggal, 
	tbl_penghargaan.tahun, 
	tbl_penghargaan.permalink, 
	tbl_penghargaan.gambar, 
	tbl_penghargaan.url, 
	tbl_penghargaan.isi, 
	tbl_penghargaan.judul_penghargaan, 
	tbl_penghargaan.id_kategori, 
	tbl_penghargaan.id_penghargaan, 
	tbl_menu.title
FROM tbl_penghargaan LEFT join tbl_menu on tbl_menu.id=tbl_penghargaan.id_kategori order by tbl_penghargaan.id_penghargaan DESC limit $ofset,$limit");
			return $q;
		}
		function Total_Penghargaan()
		{
			$q=$this->db->query("select * from tbl_penghargaan");
			return $q;
		}
		function Semua_Profil_Jabatan($id)
		{
			$q=$this->db->query("SELECT
tbl_profil.id_profil,
tbl_profil.identitas_diri,
tbl_profil.nama_lengkap,
tbl_profil.tempat_lahir,
tbl_profil.tanggal_lahir,
tbl_profil.alamat,
tbl_profil.id_agama,
tbl_profil.hp,
tbl_profil.alamat_surel,
tbl_profil.alamat_kantor,
tbl_profil.id_menikah,
tbl_profil.nip,
tbl_profil.id_pangkat,
tbl_profil.id_golongan,
tbl_profil.id_jabatanprofil,
tbl_profil.unit_kerja,
tbl_profil.hobi,
tbl_profil.nama_pasangan,
tbl_profil.id_jk,
tbl_profil.pendidikan,
tbl_profil.foto,
tbl_profil.foto_profil,
tbl_agama.agama,
tbl_menikah.menikah,
tbl_pangkat.pangkat,
tbl_golongan.golongan,
tbl_jabatanprofil.jabatanprofil,
tbl_kelamin.kelamin,
tbl_skpd.skpd
FROM
tbl_profil
LEFT JOIN tbl_agama ON tbl_agama.id_agama = tbl_profil.id_agama
LEFT JOIN tbl_menikah ON tbl_menikah.id_menikah = tbl_profil.id_menikah
LEFT JOIN tbl_pangkat ON tbl_pangkat.id_pangkat = tbl_profil.id_pangkat
LEFT JOIN tbl_golongan ON tbl_golongan.id_golongan = tbl_profil.id_golongan
LEFT JOIN tbl_jabatanprofil ON tbl_jabatanprofil.id_jabatanprofil = tbl_profil.id_jabatanprofil
LEFT JOIN tbl_kelamin ON tbl_kelamin.id_kelamin = tbl_profil.id_jk LEFT JOIN
tbl_skpd ON tbl_skpd.id_skpd=tbl_profil.unit_kerja where tbl_profil.id_jabatanprofil='$id'
ORDER BY
tbl_profil.id_profil ASC ");
			return $q;
		}
		function Semua_Profil_Skpd($id)
		{
			$q=$this->db->query("SELECT
tbl_profil.id_profil,
tbl_profil.identitas_diri,
tbl_profil.nama_lengkap,
tbl_profil.tempat_lahir,
tbl_profil.tanggal_lahir,
tbl_profil.alamat,
tbl_profil.id_agama,
tbl_profil.hp,
tbl_profil.alamat_surel,
tbl_profil.alamat_kantor,
tbl_profil.id_menikah,
tbl_profil.nip,
tbl_profil.id_pangkat,
tbl_profil.id_golongan,
tbl_profil.id_jabatanprofil,
tbl_profil.unit_kerja,
tbl_profil.hobi,
tbl_profil.nama_pasangan,
tbl_profil.id_jk,
tbl_profil.pendidikan,
tbl_profil.foto,
tbl_profil.foto_profil,
tbl_agama.agama,
tbl_menikah.menikah,
tbl_pangkat.pangkat,
tbl_golongan.golongan,
tbl_jabatanprofil.jabatanprofil,
tbl_kelamin.kelamin,
tbl_skpd.skpd
FROM
tbl_profil
LEFT JOIN tbl_agama ON tbl_agama.id_agama = tbl_profil.id_agama
LEFT JOIN tbl_menikah ON tbl_menikah.id_menikah = tbl_profil.id_menikah
LEFT JOIN tbl_pangkat ON tbl_pangkat.id_pangkat = tbl_profil.id_pangkat
LEFT JOIN tbl_golongan ON tbl_golongan.id_golongan = tbl_profil.id_golongan
LEFT JOIN tbl_jabatanprofil ON tbl_jabatanprofil.id_jabatanprofil = tbl_profil.id_jabatanprofil
LEFT JOIN tbl_kelamin ON tbl_kelamin.id_kelamin = tbl_profil.id_jk LEFT JOIN
tbl_skpd ON tbl_skpd.id_skpd=tbl_profil.unit_kerja where tbl_profil.unit_kerja='$id'
ORDER BY
tbl_profil.id_profil ASC ");
			return $q;
		}
		function Detail_Jenis($id)
		{
			$q=$this->db->query("SELECT
*
FROM
tbl_jenistransparansi
WHERE tbl_jenistransparansi.id_jenistransparansi='$id'");
			return $q;	
		}

		function Semua_Transparansi($limit,$ofset,$id)
		{
			$q=$this->db->query("SELECT
tbl_transparansi.id_transparansi,
tbl_transparansi.id_jenistransparansi,
tbl_transparansi.judul,
tbl_transparansi.file,
tbl_transparansi.tanggal,
tbl_transparansi.counter,
tbl_transparansi.id_tahun,
tbl_jenistransparansi.jenistransparansi,
tbl_tahun.tahun,
tbl_skpd.skpd
FROM
tbl_transparansi
LEFT JOIN tbl_jenistransparansi ON tbl_jenistransparansi.id_jenistransparansi = tbl_transparansi.id_jenistransparansi
LEFT JOIN tbl_tahun ON tbl_tahun.id_tahun = tbl_transparansi.id_tahun LEFT JOIN
tbl_skpd on tbl_skpd.id_skpd=tbl_transparansi.id_skpd WHERE tbl_transparansi.id_jenistransparansi
='$id'
ORDER BY
tbl_transparansi.id_transparansi DESC

 LIMIT $ofset,$limit");
			return $q;
		}
		function Total_Transparansiku($status)
		{
			$q=$this->db->query("SELECT
tbl_transparansi.id_transparansi
FROM
tbl_transparansi 
WHERE tbl_transparansi.id_jenistransparansi
='$status'");
			return $q;
		}
		function Semua_Pertanyaan()
		{
			$query=$this->db->query("select * from tbl_pertanyaan order by id_pertanyaan ASC");
			return $query;
		}
		function Semua_Pekerjaan()
		{
			$query=$this->db->query("select * from tbl_pekerjaan");
			return $query;
		}
		function Semua_Layanan()
		{
			$query=$this->db->query("select * from tbl_pelayanan");
			return $query;
		}

		function Semua_Kepala()
		{
			$q=$this->db->query("SELECT
tbl_profil.nama_lengkap,
tbl_profil.foto,
tbl_jabatanprofil.jabatanprofil,
tbl_profil.id_profil
FROM
tbl_profil
LEFT JOIN tbl_jabatanprofil ON tbl_jabatanprofil.id_jabatanprofil = tbl_profil.id_jabatanprofil
WHERE
tbl_profil.id_level='18' OR tbl_profil.id_level='19' AND tbl_profil.status='Y' LIMIT 2");
			return $q;
		}

		function Semua_Sekda()
		{
			$q=$this->db->query("SELECT
tbl_profil.nama_lengkap,
tbl_profil.foto,
tbl_jabatanprofil.jabatanprofil,
tbl_profil.id_profil
FROM
tbl_profil
LEFT JOIN tbl_jabatanprofil ON tbl_jabatanprofil.id_jabatanprofil = tbl_profil.id_jabatanprofil
WHERE
tbl_profil.id_level='1' AND tbl_profil.status='Y' LIMIT 1");
			return $q;
		}
		function Semua_Sekwan()
		{
			$q=$this->db->query("SELECT
tbl_profil.nama_lengkap,
tbl_profil.foto,
tbl_jabatanprofil.jabatanprofil,
tbl_profil.id_profil
FROM
tbl_profil
LEFT JOIN tbl_jabatanprofil ON tbl_jabatanprofil.id_jabatanprofil = tbl_profil.id_jabatanprofil
WHERE
tbl_profil.id_level='12' AND tbl_profil.status='Y' LIMIT 1");
			return $q;
		}
		function Semua_Staf()
		{
			$q=$this->db->query("SELECT
tbl_profil.nama_lengkap,
tbl_profil.foto,
tbl_jabatanprofil.jabatanprofil,
tbl_profil.id_profil
FROM
tbl_profil
LEFT JOIN tbl_jabatanprofil ON tbl_jabatanprofil.id_jabatanprofil = tbl_profil.id_jabatanprofil
WHERE
tbl_profil.id_level='2' AND tbl_profil.status='Y'");
			return $q;
		}
		function Semua_Asisten()
		{
			$q=$this->db->query("SELECT
tbl_profil.nama_lengkap,
tbl_profil.foto,
tbl_jabatanprofil.jabatanprofil,
tbl_profil.id_profil
FROM
tbl_profil
LEFT JOIN tbl_jabatanprofil ON tbl_jabatanprofil.id_jabatanprofil = tbl_profil.id_jabatanprofil
WHERE
tbl_profil.id_level='3' AND tbl_profil.status='Y'");
			return $q;
		}
		function Semua_Perangkat()
		{
			$q=$this->db->query("SELECT
tbl_profil.nama_lengkap,
tbl_profil.foto,
tbl_jabatanprofil.jabatanprofil,
tbl_profil.id_profil
FROM
tbl_profil
LEFT JOIN tbl_jabatanprofil ON tbl_jabatanprofil.id_jabatanprofil = tbl_profil.id_jabatanprofil
WHERE
tbl_profil.id_level='4' AND tbl_profil.status='Y'");
			return $q;
		}
		function Semua_KetuaDPRD()
		{
			$q=$this->db->query("SELECT
tbl_profil.nama_lengkap,
tbl_profil.foto,
tbl_jabatanprofil.jabatanprofil,
tbl_profil.id_profil
FROM
tbl_profil
LEFT JOIN tbl_jabatanprofil ON tbl_jabatanprofil.id_jabatanprofil = tbl_profil.id_jabatanprofil
WHERE
tbl_profil.id_level='5' AND tbl_profil.status='Y' LIMIT 1");
			return $q;
		}
		function Semua_WakilDPRD()
		{
			$q=$this->db->query("SELECT
tbl_profil.nama_lengkap,
tbl_profil.foto,
tbl_jabatanprofil.jabatanprofil,
tbl_profil.id_profil
FROM
tbl_profil
LEFT JOIN tbl_jabatanprofil ON tbl_jabatanprofil.id_jabatanprofil = tbl_profil.id_jabatanprofil
WHERE
tbl_profil.id_level='6' AND tbl_profil.status='Y'");
			return $q;
		}
		function Semua_AnggotaDPRD()
		{
			$q=$this->db->query("SELECT
tbl_profil.nama_lengkap,
tbl_profil.foto,
tbl_jabatanprofil.jabatanprofil,
tbl_profil.id_profil
FROM
tbl_profil
LEFT JOIN tbl_jabatanprofil ON tbl_jabatanprofil.id_jabatanprofil = tbl_profil.id_jabatanprofil
WHERE
tbl_profil.id_level='7' AND tbl_profil.status='Y'");
			return $q;
		}
		function Semua_Kasubag($id,$id2)
		{
			$q=$this->db->query("SELECT
tbl_profil.nama_lengkap,
tbl_profil.foto,
tbl_jabatanprofil.jabatanprofil,
tbl_profil.id_profil
FROM
tbl_profil
LEFT JOIN tbl_jabatanprofil ON tbl_jabatanprofil.id_jabatanprofil = tbl_profil.id_jabatanprofil
WHERE
tbl_profil.id_level='$id' AND tbl_profil.status='Y' AND tbl_profil.id_tingkatan='$id2'");
			return $q;
		}

		function Semua_Kadis($id)
		{
			$q=$this->db->query("SELECT
tbl_profil.nama_lengkap,
tbl_profil.foto,
tbl_jabatanprofil.jabatanprofil,
tbl_profil.id_profil
FROM
tbl_profil
LEFT JOIN tbl_jabatanprofil ON tbl_jabatanprofil.id_jabatanprofil = tbl_profil.id_jabatanprofil
WHERE
tbl_profil.id_level='13' AND tbl_profil.status='Y' AND tbl_profil.unit_kerja='$id' LIMIT 1");
			return $q;
		}
		function Semua_Kasubag2($id,$id2,$id3)
		{
			$q=$this->db->query("SELECT
tbl_profil.nama_lengkap,
tbl_profil.foto,
tbl_jabatanprofil.jabatanprofil,
tbl_profil.id_profil
FROM
tbl_profil
LEFT JOIN tbl_jabatanprofil ON tbl_jabatanprofil.id_jabatanprofil = tbl_profil.id_jabatanprofil
WHERE
tbl_profil.id_level='$id' AND tbl_profil.status='Y' AND tbl_profil.id_tingkatan='$id2' 
AND tbl_profil.unit_kerja='$id3'");
			return $q;
		}

		function Semua_Kadis2($id)
		{
			$q=$this->db->query("SELECT
tbl_profil.nama_lengkap,
tbl_profil.foto,
tbl_jabatanprofil.jabatanprofil,
tbl_profil.id_profil
FROM
tbl_profil
LEFT JOIN tbl_jabatanprofil ON tbl_jabatanprofil.id_jabatanprofil = tbl_profil.id_jabatanprofil
WHERE
tbl_profil.id_level='16' AND tbl_profil.status='Y' AND tbl_profil.unit_kerja='$id' LIMIT 1");
			return $q;
		}

}