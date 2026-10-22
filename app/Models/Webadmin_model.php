<?php

namespace App\Models;

use App\Core\CI_Model;

#[\AllowDynamicProperties]
class Webadmin_model extends CI_Model{
		function __construct()
	    {
	    parent::__construct();
	    }
		function Simpan_Kepegawaian($data)
		{
			$s=$this->db->insert('tbl_kepegawaian',$data);
			return $s;
		}
	function Update_Counter_Skpd($id_berita)
		{
			$query_update=$this->db->query("update tbl_skpd
			 set gatot=gatot+1 where id_skpd='$id_berita'");
			return $query_update;
		}
	function Lampiran($id,$offset,$limit)
		{
			$q=$this->db->query("select tbl_pengumuman.id_pengumuman,tbl_lampiran.file,tbl_lampiran.id_lampiran,tbl_pengumuman.judul_pengumuman from tbl_lampiran left join
			 tbl_pengumuman on tbl_pengumuman.id_pengumuman=tbl_lampiran.id_pengumuman
			 where tbl_lampiran.id_pengumuman='$id'
			 order by tbl_lampiran.id_lampiran DESC LIMIT $offset,$limit");
			return $q;
		}

	public function getLoginData($usr,$psw)
	{
		//End
		$u = $usr;
		$p = md5($psw.$this->config->item("key_login"));
		$q_cek_login = $this->db->get_where('user', array('username' => $u, 'password' => $p,'status2' => 'active'));
		if(count($q_cek_login->result())>0)
		{
			foreach($q_cek_login->result() as $qck)
			{
				foreach($q_cek_login->result() as $qad)
				{
					$sess_data['logged_in'] = 'yesGetMeLogin';
					$sess_data['username'] = $qad->username;
					$sess_data['idm'] = $qad->kode_wartawan;
					$sess_data['nama_pengguna'] = $qad->nama;
					$sess_data['akses'] = $qad->akses;
					$this->session->set_userdata($sess_data);
				}
				header('location:' . base_url() . 'webadmin');
				exit;
			}
		}
		else
		{
			$this->session->set_flashdata('result_login', 'Username atau Password yang anda masukkan salah.');
			header('location:' . base_url() . 'webadmin/loginpage');
			exit;
		}
		
	
	
	}
	
	function Bijak($offset,$limit)
		{
			$q=$this->db->query("SELECT
*
FROM
tbl_bijak
 order by tbl_bijak.id_bijak ASC LIMIT $offset,$limit");
			return $q;
		}
	function Hitung($offset,$limit)
		{
			$q=$this->db->query("SELECT `id_hitung`, `judul`, `tanggal` FROM `tbl_hitung`

 order by tbl_hitung.id_hitung DESC LIMIT $offset,$limit");
			return $q;
		}
		function Banner($offset,$limit)
		{
			$q=$this->db->query("SELECT
tbl_banner.id_banner,
tbl_banner.judul,
tbl_banner.keterangan,
tbl_banner.foto_kecil,
tbl_banner.foto_besar,
tbl_banner.tanggal,
tbl_banner.waktu
FROM
tbl_banner
 order by tbl_banner.id_banner ASC LIMIT $offset,$limit");
			return $q;
		}
		function Pantun($offset,$limit)
		{
			$q=$this->db->query("SELECT 
	tbl_pantun.id_pantun, 
	tbl_pantun.judul, 
	tbl_pantun.isi, 
	tbl_pantun.permalink, 
	tbl_pantun.id_kategori, 
	tbl_menu.title
FROM tbl_pantun LEFT join tbl_menu on tbl_menu.id=tbl_pantun.id_kategori
ORDER BY tbl_pantun.id_pantun DESC LIMIT $offset,$limit");
			return $q;
		}
function Petugas($offset,$limit)
		{
			$q=$this->db->query("SELECT
*
FROM
tbl_petugas left join tbl_agenda on tbl_agenda.id_agenda=tbl_petugas.id_agenda left join
tbl_kepegawaian on tbl_kepegawaian.id_kepegawaian=tbl_petugas.id_kepegawaian 
 order by tbl_petugas.id_petugas DESC LIMIT $offset,$limit");
			return $q;
		}
		function Tarif($offset,$limit)
		{
			$q=$this->db->query("SELECT tbl_tarif.id_tarif, 
	tbl_tarif.judul, 
	tbl_tarif.keterangan, 
	tbl_tarif.foto_kecil, 
	tbl_tarif.foto_besar, 
	tbl_tarif.tanggal, 
	tbl_tarif.waktu
FROM tbl_tarif
 order by tbl_tarif.id_tarif ASC LIMIT $offset,$limit");
			return $q;
		}
		function Kepegawaian($offset,$limit)
		{
			$q=$this->db->query("SELECT
tbl_kepegawaian.id_kepegawaian,
tbl_kepegawaian.nip,
tbl_kepegawaian.nama_pegawai,
tbl_kepegawaian.`pangkat/gol`,
tbl_jabatan.jabatan
FROM
tbl_kepegawaian LEFT JOIN
tbl_jabatan on tbl_jabatan.id_jabatan=tbl_kepegawaian.kode_jabatan

order by tbl_kepegawaian.urut ASC
 LIMIT $offset,$limit");
			return $q;
		}
		function Data_Login($user,$pass)
		{
			$user_bersih=$user;
			$pass_bersih=$pass;
			$p = md5($pass_bersih.$this->config->item("key_login"));
			$query=$this->db->query("select * from user where username='$user_bersih' and password='$p'");
			return $query;
		}
		function Simpan_Artikel($data)
		{
			$s=$this->db->insert('tblberita',$data);
			return $s;
		}
		function Simpan_Artikel2($tabel,$data)
		{
			$s=$this->db->insert($tabel,$data);
			return $s;
		}
		function Total_Data($tabel)
		{
			$q=$this->db->query("select * from $tabel");
			return $q;
		}
		function Total_Data_Cari($tabel,$id)
		{
			$q=$this->db->query("select * from $tabel where judul_berita like '%$id%'");
			return $q;
		}
		function Total_Data_Cari2($tabel,$id)
		{
			$q=$this->db->query("select * from $tabel where judul like '%$id%'");
			return $q;
		}
		function Total_Data_Cari3($tabel,$id)
		{
			$q=$this->db->query("select * from $tabel where judul like '%$id%'");
			return $q;
		}
		function In_Polling($tabel,$data)
		{
			$s=$this->db->insert($tabel,$data);
			return $s;
		}
		function Delete_Content($id,$seleksi,$tabel)
		{
			$this->db->where($seleksi,$id);
			$this->db->delete($tabel);
		}
		function Simpan_Data($tabel,$data)
		{
			$s=$this->db->insert($tabel,$data);
			return $s;
		}
		function Edit_Content($tabel,$seleksi)
		{
			$query=$this->db->query("select * from $tabel where $seleksi");
			return $query;
		}
		function Update_Content($tabel,$isi,$seleksi)
		{
			$this->db->where($seleksi,$isi[$seleksi]);
			$this->db->update($tabel,$isi);
		}
		private function reindex($tablename, $id_name) {
			$query = $this->db->query("SELECT IFNULL((MAX(".$id_name.")+1),1) As id FROM `".$tablename."`");
			foreach($query->result_array() as $row) {
				$max = $row['id'];			
			}
			$this->db->query('ALTER TABLE `'.$tablename.'` AUTO_INCREMENT ='.$max.';');
		}
		function Tampil_Data($tabel,$id)
		{
			$q=$this->db->query("select * from ".$tabel." order by ".$id." DESC");
			return $q;
		}
		function Tampil_Data_Terbatas($tabel,$id,$join,$offset,$limit)
		{
			$q=$this->db->query("select * from ".$tabel." ".$join." order by ".$id." DESC LIMIT ".$offset.",".$limit."");
			return $q;
		}
		function Tampil_Data_Terseleksi($tabel,$id,$id_seleksi)
		{
			$q=$this->db->query("select * from ".$tabel." where ".$id." = ".$id_seleksi."");
			return $q;
		}
		function Kat($offset,$limit)
		{
			$q=$this->db->query("SELECT
tbl_kat.kode_kat,
tbl_kat.kat
FROM
tbl_kat
 order by kode_kat DESC LIMIT $offset,$limit");
			return $q;
		}
		function Jabatan($offset,$limit)
		{
			$q=$this->db->query("SELECT
*
FROM
tbl_jabatan
 order by id_jabatan DESC LIMIT $offset,$limit");
			return $q;
		}
		function Wartawan($offset,$limit)
		{
			$q=$this->db->query("SELECT
`user`.kode_wartawan,
`user`.nama,
`user`.alamat,
`user`.akses,
`user`.username,
`user`.`password`,
`user`.`status`
FROM
`user`
 order by `user`.kode_wartawan DESC LIMIT $offset,$limit");
			return $q;
		}
		function Link($offset,$limit)
		{
			$q=$this->db->query("SELECT
tbl_link.id_link,
tbl_link.judul_link,
tbl_link.url,
tbl_link.tanggal,
tbl_link.penulis,
tbl_link.gambar
FROM
tbl_link
 order by tbl_link.id_link ASC LIMIT $offset,$limit");
			return $q;
		}
		function Beritafoto($offset,$limit)
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

 order by tbl_beritafoto.id_beritafoto DESC LIMIT $offset,$limit");
			return $q;
		}
		function Paper($offset,$limit)
		{
			$q=$this->db->query("SELECT
tbl_paper.id_paper,
tbl_paper.judul_paper,
tbl_paper.url,
tbl_paper.kop_bawah,
tbl_paper.tanggal,
tbl_paper.penulis,
tbl_paper.gambar
FROM
tbl_paper
 order by tbl_paper.id_paper DESC LIMIT $offset,$limit");
			return $q;
		}
		function Info($offset,$limit)
		{
			$q=$this->db->query("SELECT
tbl_info.id_info,
tbl_info.judul_info,
tbl_info.url,
tbl_info.tanggal,
tbl_info.penulis,
tbl_info.gambar
FROM
tbl_info
 order by tbl_info.id_info DESC LIMIT $offset,$limit");
			return $q;
		}
		function Video($offset,$limit)
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
order by tbl_video.id_video DESC
LIMIT $offset,$limit");
			return $q;
		}
		function Semua_Sitemap_Induk()
		{
			$q=$this->db->query("select * from tbl_menu where id_parent='induk' ORDER BY id ASC");
			return $q;
		}
		function Semua_Sitemap_Anak($id)
		{
			$q=$this->db->query("select * from tbl_menu where id_parent='$id'");
			return $q;
		}
		function Semua_Menu()
		{
			$query=$this->db->query("select * from tbl_menu where id_parent='induk' order by id ASC");
			return $query;
		}
		function Semua_Menu8()
		{
			$query=$this->db->query("select * from tbl_menu where sorting='berita' order by id ASC");
			return $query;
		}
		function Semua_Tag()
		{
			$query=$this->db->query("select * from tbl_tag order by id_tag DESC");
			return $query;
		}
		 public function get_kode_mahasiswa() {
  $tahun = date("Y");
  $kode = 'MHS';
  $query = $this->db->query("SELECT MAX(id_berita) as max_id FROM tblberita"); 
  $row = $query->row_array();
  $max_id = $row['max_id']; 
  $max_id1 =(int) $max_id;
  $kode_mahasiswa = $max_id1 +1;
  $maxkode_mahasiswa = $kode_mahasiswa;
  return $maxkode_mahasiswa;
 }
		function Semua_Menu89()
		{
			$query=$this->db->query("SELECT
tblkv.id_kategori,
tblkv.kategori
FROM
tblkv
order by tblkv.id_kategori ASC");
			return $query;
		}
		function Semua_Sub()
		{
			$query=$this->db->query("select * from tblsub");
			return $query;
		}
		function TampilSubId($id)
		{
			$query=$this->db->query("select * from tblsub where id_kategori='$id'");
			return $query;
		}
		function Menu_Bawah2($id)
		{
			$q=$this->db->query("SELECT * from tbl_menu where id_parent='$id'");
			return $q;
		}
		function Semua_Kat()
		{
			$query=$this->db->query("select * from tbl_kat order by kode_kat ASC");
			return $query;
		}
		function Semua_Jabatan()
		{
			$query=$this->db->query("select * from tbl_jabatan order by id_jabatan ASC");
			return $query;
		}
		function Statis($offset,$limit)
		{
			$q=$this->db->query("select * from tbl_data left join tbl_menu on tbl_data.data_id=tbl_menu.id where tbl_data.data_id!='counter' order by tbl_data.id_data ASC LIMIT $offset,$limit");
			return $q;
		}
		function Semua_Kategori()
		{
			$query=$this->db->query("select * from tblkategori");
			return $query;
		}
		function Artikel($offset,$limit)
		{
			$q=$this->db->query("SELECT
tblberita.id_berita,
tblberita.judul_berita,
tblberita.tanggal,
tblberita.waktu,
tblberita.editor,
tblberita.reporter,
tblberita.video,
tblberita.counter,
tbl_menu.title
FROM
tblberita LEFT JOIN
tbl_menu on tbl_menu.id=tblberita.id_kategori
order by tblberita.id_berita DESC

 LIMIT $offset,$limit");
			return $q;
		}	
		function Artikel_Cari($offset,$limit,$id)
		{
			$q=$this->db->query("SELECT
tblberita.id_berita,
tblberita.judul_berita,
tblberita.tanggal,
tblberita.waktu,
tblberita.editor,
tblberita.reporter,
tblberita.video,
tblberita.counter,
tbl_menu.title
FROM
tblberita LEFT JOIN
tbl_menu on tbl_menu.id=tblberita.id_kategori where judul_berita like '%$id%'
order by tblberita.id_berita DESC

 LIMIT $offset,$limit");
			return $q;
		}	
		function Pidato_Cari($offset,$limit,$id)
		{
			$q=$this->db->query("SELECT tbl_pidato.kode_pidato, 
	tbl_pidato.judul, 
	tbl_pidato.ket, 
	tbl_pidato.file, 
	tbl_pidato.tanggal, 
	tbl_pidato.waktu, 
	tbl_pidato.counter, 
	tbl_pidato.kode_menu, 
	tbl_pidato.permalink, 
	tbl_pidato.kode, 
	tbl_pidato.tanggal_acara, 
	tbl_pidato.tempat, 
	tbl_pidato.jumlah_pantun, 
	tbl_menu.title
FROM tbl_pidato LEFT JOIN tbl_menu on tbl_menu.id=tbl_pidato.kode_menu where
 tbl_pidato.judul like '%$id%'
order by tbl_pidato.kode_pidato DESC

 LIMIT $offset,$limit");
			return $q;
		}	
		function Pantun_Cari($offset,$limit,$id)
		{
			$q=$this->db->query("SELECT 
	tbl_pantun.id_pantun, 
	tbl_pantun.judul, 
	tbl_pantun.isi, 
	tbl_pantun.permalink, 
	tbl_pantun.id_kategori, 
	tbl_menu.title
FROM tbl_pantun LEFT join tbl_menu on tbl_menu.id=tbl_pantun.id_kategori where
 tbl_pantun.judul like '%$id%'
order by tbl_pantun.id_pantun DESC

 LIMIT $offset,$limit");
			return $q;
		}	
		function Album_Galeri($offset,$limit)
		{
			$q=$this->db->query("select * from tbl_album_galeri order by id_album DESC LIMIT $offset,$limit");
			return $q;
		}
		function Semua_Album()
		{
			$q=$this->db->query("select * from tbl_album_galeri");
			return $q;
		}
		function Foto($id,$offset,$limit)
		{
			$q=$this->db->query("select * from tbl_galeri left join
			 tbl_album_galeri on tbl_galeri.id_album=tbl_album_galeri.id_album 
			 where tbl_galeri.id_album='$id'
			 order by id_foto DESC LIMIT $offset,$limit");
			return $q;
		}
		function Daftar_Polling($offset,$limit)
		{
			$q=$this->db->query("select * from tbl_soalpolling order by id_soal_poll DESC LIMIT $offset,$limit");
			return $q;
		}
		function Download($offset,$limit)
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
order by tbl_download.kode_download DESC
 LIMIT $offset,$limit");
			return $q;
		}
	function Download_Pembantu($offset,$limit,$id)
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
left join tbl_skpd on tbl_skpd.id_skpd=tbl_download.id_skpd where tbl_download.id_skpd='$id'
order by tbl_download.kode_download DESC
 LIMIT $offset,$limit");
			return $q;
		}
		function Total_DataPembantu($id)
		{
			$q=$this->db->query("select * from tbl_download where tbl_download.id_skpd='$id'");
			return $q;
		}
	
		function Semua_Menutype()
		{
			$query=$this->db->query("select * from tbl_menu where status='Y' AND id_parent!='8'");
			return $query;
		}
	function Semua_Menutype5()
		{
			$query=$this->db->query("select * from tbl_menu where id_parent='8' AND sorting='pidato'");
			return $query;
		}
		function Semua_Bulan()
		{
			$query=$this->db->query("select * from tbl_bulan order by id_bulan ASC");
			return $query;
		}
		function Kritik($offset,$limit,$nilai)
		{
			$q=$this->db->query("SELECT
tblhubungi.id_hubungi,
tblhubungi.nama,
tblhubungi.email,
tblhubungi.pesan,
tblhubungi.`status`,
tblhubungi.posted_date,
tblhubungi.alamat,
tblhubungi.phone
FROM
tblhubungi where tblhubungi.status='$nilai'
 order by tblhubungi.id_hubungi DESC LIMIT $offset,$limit");
			return $q;
		}
		function Total_Data_Kritik($tabel,$nilai)
		{
			$q=$this->db->query("select * from $tabel where $tabel.status='$nilai'");
			return $q;
		}
		function Agenda($offset,$limit)
		{
			$q=$this->db->query("SELECT
tbl_agenda.id_agenda,
tbl_agenda.tema_agenda,
tbl_agenda.isi,
tbl_agenda.tgl_mulai,
tbl_agenda.tgl_selesai,
tbl_agenda.tgl_posting,
tbl_agenda.tempat,
tbl_agenda.jam,
tbl_agenda.keterangan
FROM
tbl_agenda

 order by tbl_agenda.id_agenda DESC LIMIT $offset,$limit");
			return $q;
		}
		function Pengumuman($offset,$limit)
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
tbl_pengumuman  LEFT JOIN
tbljpengumuman on tbl_pengumuman.id_jpengumuman=tbljpengumuman.id_jpengumuman
 order by tbl_pengumuman.id_pengumuman DESC LIMIT $offset,$limit");
			return $q;
		}
		function Sms($offset,$limit)
		{
			$q=$this->db->query("SELECT
tbl_sms.id_sms,
tbl_sms.judul_sms,
tbl_sms.tanggal,
tbl_sms.penulis,
tbl_sms.isi,
tbl_sms.visible
FROM
tbl_sms
 order by tbl_sms.id_sms DESC LIMIT $offset,$limit");
			return $q;
		}
		function Komoditi($offset,$limit)
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
 order by tbl_komoditi.id_komoditi DESC LIMIT $offset,$limit");
			return $q;
		}
		function Telepon($offset,$limit)
		{
			$q=$this->db->query("SELECT
tbl_telepon.id_telepon,
tbl_telepon.nama,
tbl_telepon.telepon
FROM
tbl_telepon

 order by tbl_telepon.id_telepon DESC LIMIT $offset,$limit");
			return $q;
		}
	function Tagar($offset,$limit)
		{
			$q=$this->db->query("SELECT
*
FROM
tbl_tag
 order by id_tag DESC LIMIT $offset,$limit");
			return $q;
		}

		function Penghargaan($offset,$limit)
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

 order by tbl_penghargaan.id_penghargaan DESC LIMIT $offset,$limit");
			return $q;
		}
		function Daftar_Skpd($offset,$limit)
		{
			$q=$this->db->query("select * from tbl_skpd order by id_skpd DESC LIMIT $offset,$limit");
			return $q;
		}

		function Pembantu($offset,$limit)
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
ORDER BY user_pembantu.id_pembantu DESC LIMIT $offset,$limit");
			return $q;
		}
		function Permohonan($offset,$limit,$nilai)
		{
			$q=$this->db->query("SELECT
tbl_pemohon.id_pemohon,
tbl_pemohon.nik,
tbl_pemohon.email,
tbl_pemohon.nama,
tbl_pemohon.jenis as jenisku,
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

 where tbl_pemohon.status='$nilai'
 order by tbl_pemohon.id_pemohon DESC LIMIT $offset,$limit");
			return $q;
		}
	
	function PermohonanFinal($offset,$limit)
		{
			$q=$this->db->query("SELECT
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
tbl_pemohon.jenis as jenisku,
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

 where tbl_pemohon.status!='N' AND tbl_pemohon.status!='DISPOSISI'
 order by tbl_pemohon.id_pemohon DESC LIMIT $offset,$limit");
			return $q;
		}
	function Permohonan_Pembantu($offset,$limit,$id)
		{
			$q=$this->db->query("SELECT
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
tbl_pemohon.jenis as jenisku,
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

 where tbl_pemohon.id_skpd='$id' AND tbl_pemohon.status='DISPOSISI'
 order by tbl_pemohon.id_pemohon DESC LIMIT $offset,$limit");
			return $q;
		}
		function Total_Data_Kritik_Pembantu($id)
		{
			$q=$this->db->query("SELECT tbl_pemohon.id_pemohon
FROM tbl_pemohon  where tbl_pemohon.id_skpd='$id' AND tbl_pemohon.status='DISPOSISI'");
			return $q;
		}
	
function PermohonanFinalPembantu($offset,$limit,$id)
		{
			$q=$this->db->query("SELECT
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
tbl_pemohon.jenis as jenisku,
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
 where tbl_pemohon.id_skpd='$id'
 AND tbl_pemohon.status!='DISPOSISI' 
AND tbl_pemohon.status!='N'
 order by tbl_pemohon.id_pemohon DESC LIMIT $offset,$limit");
			return $q;
		}
		
		function Total_Data_KritikFinalPembantu($id)
		{
			$q=$this->db->query("SELECT tbl_pemohon.id_pemohon
FROM tbl_pemohon  where tbl_pemohon.id_skpd='$id' AND tbl_pemohon.status!='DISPOSISI' 
AND tbl_pemohon.status!='N'
 order by tbl_pemohon.id_pemohon DESC");
			return $q;
		}
		
	function Total_Data_KritikFinal()
		{
			$q=$this->db->query("SELECT tbl_pemohon.id_pemohon
FROM tbl_pemohon  where tbl_pemohon.status!='N' AND tbl_pemohon.status!='DISPOSISI'
 order by tbl_pemohon.id_pemohon DESC");
			return $q;
		}
	
	
	function Keberatan($offset,$limit)
		{
			$q=$this->db->query("SELECT tbl_keberatan.id_keberatan, 
	tbl_keberatan.nik, 
	tbl_keberatan.nama, 
	tbl_keberatan.email, 
	tbl_keberatan.rincian, 
	tbl_keberatan.`status`, 
	tbl_keberatan.posted_date, 
	tbl_keberatan.alamat, 
	tbl_keberatan.phone, 
	tbl_keberatan.replay, 
	tbl_keberatan.foto, 
	tbl_keberatan.pekerjaan, 
	tbl_keberatan.tujuan, 
	tbl_keberatan.alasan, 
	tbl_keberatan.pemenuhan, 
	tbl_keberatan.ket
FROM tbl_keberatan where tbl_keberatan.status!='Ditanggapi'
 order by tbl_keberatan.id_keberatan DESC LIMIT $offset,$limit");
			return $q;
		}
		function Total_Data_KritikKeberatan()
		{
			$q=$this->db->query("SELECT tbl_keberatan.id_keberatan
FROM tbl_keberatan where tbl_keberatan.status!='Ditanggapi'");
			return $q;
		}
	
	function KeberatanFinal($offset,$limit)
		{
			$q=$this->db->query("SELECT tbl_keberatan.id_keberatan, 
	tbl_keberatan.nik, 
	tbl_keberatan.nama, 
	tbl_keberatan.email, 
	tbl_keberatan.rincian, 
	tbl_keberatan.`status`, 
	tbl_keberatan.posted_date, 
	tbl_keberatan.alamat, 
	tbl_keberatan.phone, 
	tbl_keberatan.replay, 
	tbl_keberatan.foto, 
	tbl_keberatan.pekerjaan, 
	tbl_keberatan.tujuan, 
	tbl_keberatan.alasan, 
	tbl_keberatan.pemenuhan, 
	tbl_keberatan.ket
FROM tbl_keberatan where tbl_keberatan.status='Ditanggapi'
 order by tbl_keberatan.id_keberatan DESC LIMIT $offset,$limit");
			return $q;
		}
	
	function Total_Data_Keberatan()
		{
			$q=$this->db->query("SELECT tbl_keberatan.id_keberatan
FROM tbl_keberatan where tbl_keberatan.status='Ditanggapi'
 order by tbl_keberatan.id_keberatan DESC");
			return $q;
		}
	
	function V_Jenis_Bulan_Admin($status,$bln,$thn)
		{
			$q=$this->db->query("SELECT
COUNT(tbl_pemohon.id_pemohon) as total
FROM
tbl_pemohon where tbl_pemohon.jenis='$status' and MONTH(tbl_pemohon.posted_date)='$bln' AND YEAR(tbl_pemohon.posted_date)='$thn'
");
			return $q;
		}
		
		function V_Jenis_Bulan_Admin_Total($status,$thn)
		{
			$q=$this->db->query("SELECT
COUNT(tbl_pemohon.id_pemohon) as total
FROM
tbl_pemohon where tbl_pemohon.jenis='$status' and YEAR(tbl_pemohon.posted_date)='$thn'
");
			return $q;
		}
		
		function V_Proses_K2_Admin($status,$bln,$thn)
		{
			$q=$this->db->query("SELECT
COUNT(tbl_pemohon.id_pemohon) as total
FROM
tbl_pemohon where  
tbl_pemohon.cara2='$status' and MONTH(tbl_pemohon.posted_date)='$bln' AND YEAR(tbl_pemohon.posted_date)='$thn'
");
			return $q;
		}
		function V_Proses_K2_Admin_Total($status,$thn)
		{
			$q=$this->db->query("SELECT
COUNT(tbl_pemohon.id_pemohon) as total
FROM
tbl_pemohon where 
tbl_pemohon.cara2='$status' and YEAR(tbl_pemohon.posted_date)='$thn'
");
			return $q;
		}
		function V_Proses2_Admin($status,$bln,$thn)
		{
			$q=$this->db->query("SELECT
COUNT(tbl_pemohon.id_pemohon) as total
FROM
tbl_pemohon where tbl_pemohon.status='$status' 
and MONTH(tbl_pemohon.posted_date)='$bln' AND YEAR(tbl_pemohon.posted_date)='$thn'
");
			return $q;
		}
		
		function V_Proses2_Admin_Total($status,$thn)
		{
			$q=$this->db->query("SELECT
COUNT(tbl_pemohon.id_pemohon) as total
FROM
tbl_pemohon where tbl_pemohon.status='$status' 
and YEAR(tbl_pemohon.posted_date)='$thn'
");
			return $q;
		}
		
		//KEdua
		
		function V_Jenis_Bulan_Admin2($status,$bln,$thn,$skpd)
		{
			$q=$this->db->query("SELECT
COUNT(tbl_pemohon.id_pemohon) as total
FROM
tbl_pemohon where tbl_pemohon.id_skpd='$skpd' AND tbl_pemohon.jenis='$status' 
and MONTH(tbl_pemohon.posted_date)='$bln' AND YEAR(tbl_pemohon.posted_date)='$thn'
");
			return $q;
		}
		
		function V_Jenis_Bulan_Admin_Total2($status,$thn,$skpd)
		{
			$q=$this->db->query("SELECT
COUNT(tbl_pemohon.id_pemohon) as total
FROM
tbl_pemohon where tbl_pemohon.id_skpd='$skpd' AND tbl_pemohon.jenis='$status' and YEAR(tbl_pemohon.posted_date)='$thn'
");
			return $q;
		}
		
		function V_Proses_K2_Admin2($status,$bln,$thn,$skpd)
		{
			$q=$this->db->query("SELECT
COUNT(tbl_pemohon.id_pemohon) as total
FROM
tbl_pemohon where tbl_pemohon.id_skpd='$skpd' AND tbl_pemohon.status='DIPENUHI' AND tbl_pemohon.status2='N' AND 
tbl_pemohon.cara3='$status' and MONTH(tbl_pemohon.posted_date)='$bln' AND YEAR(tbl_pemohon.posted_date)='$thn'
");
			return $q;
		}
		function V_Proses_K2_Admin_Total2($status,$thn,$skpd)
		{
			$q=$this->db->query("SELECT
COUNT(tbl_pemohon.id_pemohon) as total
FROM
tbl_pemohon where tbl_pemohon.id_skpd='$skpd' AND tbl_pemohon.status='DIPENUHI' AND tbl_pemohon.status2='N' AND 
tbl_pemohon.cara3='$status' and YEAR(tbl_pemohon.posted_date)='$thn'
");
			return $q;
		}
		function V_Proses2_Admin2($status,$bln,$thn,$skpd)
		{
			$q=$this->db->query("SELECT
COUNT(tbl_pemohon.id_pemohon) as total
FROM
tbl_pemohon where tbl_pemohon.id_skpd='$skpd' AND tbl_pemohon.status='$status' 
and MONTH(tbl_pemohon.posted_date)='$bln' AND YEAR(tbl_pemohon.posted_date)='$thn'
");
			return $q;
		}
		
		function V_Proses2_Admin_Total2($status,$thn,$skpd)
		{
			$q=$this->db->query("SELECT
COUNT(tbl_pemohon.id_pemohon) as total
FROM
tbl_pemohon where tbl_pemohon.id_skpd='$skpd' AND tbl_pemohon.status='$status' 
and YEAR(tbl_pemohon.posted_date)='$thn'
");
			return $q;
		}
	
	//Publik
	
	function V_Jenis_Publik($id,$status,$tahun)
		{
			$q=$this->db->query("SELECT
COUNT(tbl_download.kode_download) as total
FROM
tbl_download where tbl_download.kode_menu='$status' AND tbl_download.id_skpd='$id' AND 
YEAR(tbl_download.tanggal)='$tahun'
");
			return $q;
		}
	function V_Jenis_Publik2($status,$tahun)
		{
			$q=$this->db->query("SELECT
COUNT(tbl_download.kode_download) as total
FROM
tbl_download where tbl_download.kode_menu='$status' AND YEAR(tbl_download.tanggal)='$tahun'
");
			return $q;
		}
	function V_TotalPid($id,$tahun)
		{
			$q=$this->db->query("SELECT
COUNT(tbl_download.kode_download) as total
FROM
tbl_download where tbl_download.id_skpd='$id' AND YEAR(tbl_download.tanggal)='$tahun' AND 
(tbl_download.kode_menu='10' OR tbl_download.kode_menu='191' OR tbl_download.kode_menu='241')
");
			return $q;
		}
	function V_TotalPid2($tahun)
		{
			$q=$this->db->query("SELECT
COUNT(tbl_download.kode_download) as total
FROM
tbl_download where YEAR(tbl_download.tanggal)='$tahun' AND 
(tbl_download.kode_menu='10' OR tbl_download.kode_menu='191' OR tbl_download.kode_menu='241')
");
			return $q;
		}
	//Keberatan
	
	function V_Berat($id,$status,$tahun)
		{
			$q=$this->db->query("SELECT
COUNT(tbl_keberatan.id_keberatan) as total
FROM
tbl_keberatan where tbl_keberatan.id_skpd='$id' AND tbl_keberatan.status='$status'
");
			return $q;
		}
	function V_Berat_Total($id,$tahun)
		{
			$q=$this->db->query("SELECT
COUNT(tbl_keberatan.id_keberatan) as total
FROM
tbl_keberatan where tbl_keberatan.id_skpd='$id'
");
			return $q;
		}
	
	function V_Berat2($status,$tahun)
		{
			$q=$this->db->query("SELECT
COUNT(tbl_keberatan.id_keberatan) as total
FROM
tbl_keberatan where tbl_keberatan.status='$status'
");
			return $q;
		}
	function V_Berat_Total2($tahun)
		{
			$q=$this->db->query("SELECT
COUNT(tbl_keberatan.id_keberatan) as total
FROM
tbl_keberatan
");
			return $q;
		}

		function Semua_Skpd()
		{
			$query=$this->db->query("SELECT
*
FROM
tbl_skpd
order by tbl_skpd.id_skpd ASC");
			return $query;
		}
		function Semua_Skpdku($id)
		{
			$query=$this->db->query("SELECT
*
FROM
tbl_skpd where tbl_skpd.id_skpd='$id'
order by tbl_skpd.id_skpd ASC");
			return $query;
		}
		function Semua_Skpd_Counter()
		{
			$query=$this->db->query("SELECT
*
FROM
tbl_skpd
order by tbl_skpd.gatot DESC");
			return $query;
		}
	function Semua_Jk()
		{
			$query=$this->db->query("SELECT
*
FROM
tbl_jk
where id_jk='1' OR id_jk='2' OR id_jk='3' OR id_jk='4' OR id_jk='5'
OR id_jk='6' OR id_jk='7' OR id_jk='13' order by tbl_jk.id_jk");
			return $query;
		}

		function Semua_Jk2()
		{
			$query=$this->db->query("SELECT
*
FROM
tbl_jk
order by tbl_jk.id_jk ASC LIMIT 7,5");
			return $query;
		}
		
		function Semua_Jk3()
		{
			$query=$this->db->query("SELECT
*
FROM
tbl_jk
 where tbl_jk.id_jk='4' or tbl_jk.id_jk='13'");
			return $query;
		}

		function Pengirim($offset,$limit)
		{
			$q=$this->db->query("SELECT
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
	tbl_pelayanan on tbl_pelayanan.id_pelayanan=tbl_pengirim.id_pelayanan
 order by tbl_pengirim.id_pengirim DESC LIMIT $offset,$limit");
			return $q;
		}
		function Semua_Pertanyaan($id)
		{
			$query=$this->db->query("SELECT
tbl_jawabansurvey.id_survey,
tbl_jawabansurvey.id_pengirim,
tbl_jawabansurvey.id_pertanyaan,
tbl_jawabansurvey.jawaban,
tbl_pertanyaan.pertanyaan
FROM
tbl_jawabansurvey LEFT JOIN
tbl_pertanyaan on tbl_pertanyaan.id_pertanyaan=tbl_jawabansurvey.id_pertanyaan where 
tbl_jawabansurvey.id_pengirim='$id' order by tbl_jawabansurvey.id_pertanyaan ASC
");
			return $query;
		}
		function Semua_Pertanyaan2()
		{
			$query=$this->db->query("select * from tbl_pertanyaan order by id_pertanyaan ASC");
			return $query;
		}
		function Transparansi($offset,$limit)
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

 LIMIT $offset,$limit");
			return $q;
		}
		function Semua_Jenis()
		{
			$query=$this->db->query("SELECT
*
FROM
tbl_jenistransparansi order by tbl_jenistransparansi.id_jenistransparansi ASC");
			return $query;
		}
		
		function Semua_Tahun()
		{
			$query=$this->db->query("SELECT
*
FROM
tbl_tahun");
			return $query;
		}

		function Profil($offset,$limit)
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
tbl_skpd.skpd,
tbl_tingkatan.tingkatan,
tbl_level.`level`
FROM
tbl_profil
LEFT JOIN tbl_agama ON tbl_agama.id_agama = tbl_profil.id_agama
LEFT JOIN tbl_menikah ON tbl_menikah.id_menikah = tbl_profil.id_menikah
LEFT JOIN tbl_pangkat ON tbl_pangkat.id_pangkat = tbl_profil.id_pangkat
LEFT JOIN tbl_golongan ON tbl_golongan.id_golongan = tbl_profil.id_golongan
LEFT JOIN tbl_jabatanprofil ON tbl_jabatanprofil.id_jabatanprofil = tbl_profil.id_jabatanprofil
LEFT JOIN tbl_kelamin ON tbl_kelamin.id_kelamin = tbl_profil.id_jk
LEFT JOIN tbl_skpd ON tbl_skpd.id_skpd = tbl_profil.unit_kerja LEFT JOIN
tbl_tingkatan on tbl_tingkatan.id_tingkatan=tbl_profil.id_tingkatan LEFT JOIN 
tbl_level on tbl_level.id_level=tbl_profil.id_level
ORDER BY
tbl_profil.id_profil DESC

 LIMIT $offset,$limit");
			return $q;
		}
		function Semua_Agama()
		{
			$query=$this->db->query("SELECT
*
FROM
tbl_agama");
			return $query;
		}
		function Semua_Menikah()
		{
			$query=$this->db->query("SELECT
*
FROM
tbl_menikah");
			return $query;
		}
		function Semua_Pangkat()
		{
			$query=$this->db->query("SELECT
*
FROM
tbl_pangkat");
			return $query;
		}
		function Semua_Golongan()
		{
			$query=$this->db->query("SELECT
*
FROM
tbl_golongan");
			return $query;
		}
		function Semua_Tingkat()
		{
			$query=$this->db->query("SELECT
*
FROM
tbl_tingkatan");
			return $query;
		}
		function Semua_Jabatanprofil()
		{
			$query=$this->db->query("SELECT
*
FROM
tbl_jabatanprofil");
			return $query;
		}
		function Semua_Level()
		{
			$query=$this->db->query("SELECT
*
FROM
tbl_level");
			return $query;
		}
		function Semua_Kelamin()
		{
			$query=$this->db->query("SELECT
*
FROM
tbl_kelamin");
			return $query;
		}
		function Semua_Jenjang()
		{
			$query=$this->db->query("SELECT
*
FROM
tbl_jenjang");
			return $query;
		}

		function Semua_Menutypeku()
		{
			$query=$this->db->query("select * from tbl_menu where id='10' or id='191' or id='241' order by id ASC");
			return $query;
		}
		function Semua_Menutype2()
		{
			$query=$this->db->query("select * from tbl_menu where sorting='statistik'");
			return $query;
		}

		function Profil_Pembantu($offset,$limit,$id)
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
tbl_skpd.skpd,
tbl_tingkatan.tingkatan,
tbl_level.`level`
FROM
tbl_profil
LEFT JOIN tbl_agama ON tbl_agama.id_agama = tbl_profil.id_agama
LEFT JOIN tbl_menikah ON tbl_menikah.id_menikah = tbl_profil.id_menikah
LEFT JOIN tbl_pangkat ON tbl_pangkat.id_pangkat = tbl_profil.id_pangkat
LEFT JOIN tbl_golongan ON tbl_golongan.id_golongan = tbl_profil.id_golongan
LEFT JOIN tbl_jabatanprofil ON tbl_jabatanprofil.id_jabatanprofil = tbl_profil.id_jabatanprofil
LEFT JOIN tbl_kelamin ON tbl_kelamin.id_kelamin = tbl_profil.id_jk
LEFT JOIN tbl_skpd ON tbl_skpd.id_skpd = tbl_profil.unit_kerja LEFT JOIN
tbl_tingkatan on tbl_tingkatan.id_tingkatan=tbl_profil.id_tingkatan LEFT JOIN 
tbl_level on tbl_level.id_level=tbl_profil.id_level where tbl_profil.unit_kerja='$id'
ORDER BY
tbl_profil.id_profil DESC

 LIMIT $offset,$limit");
			return $q;
		}
		function Total_DataProfil($id)
		{
			$q=$this->db->query("select * from tbl_profil where tbl_profil.unit_kerja='$id'");
			return $q;
		}

		function V_Survey_Publik($id,$status)
		{
			$q=$this->db->query("SELECT
COUNT(tbl_jawabansurvey.jawaban) as total
FROM
tbl_jawabansurvey where tbl_jawabansurvey.id_pertanyaan='$id' AND
tbl_jawabansurvey.jawaban='$status'
");
			return $q;
		}
		function V_Survey_Publik5($status)
		{
			$q=$this->db->query("SELECT
COUNT(tbl_jawabansurvey.jawaban) as total
FROM
tbl_jawabansurvey where 
tbl_jawabansurvey.jawaban='$status'
");
			return $q;
		}
}
