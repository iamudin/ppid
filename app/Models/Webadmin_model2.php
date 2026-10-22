<?php

namespace App\Models;

use App\Core\CI_Model;

#[\AllowDynamicProperties]
class Webadmin_model2 extends CI_Model{
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
	public function getLoginData($usr,$psw)
	{
		//End
		$u = $usr;
		$p = md5($psw.$this->config->item("key_login"));
		$q_cek_login = $this->db->get_where('user', array('username' => $u, 'password' => $p));
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
				header('location:'.base_url().'webadmin');
			}
		}
		else
		{
			$this->session->set_flashdata('result_login', 'Username atau Password yang anda masukkan salah.');
			header('location:'.base_url().'webadmin/loginpage');
		}
		
	
	
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
	function Opini($offset,$limit)
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
tbl_menu on tbl_menu.id=tblberita.id_kategori where tblberita.id_kategori='255'
order by tblberita.id_berita DESC

 LIMIT $offset,$limit");
			return $q;
		}	
	function Total_Opini()
		{
			$q=$this->db->query("SELECT
tblberita.id_berita
FROM
tblberita where tblberita.id_kategori='255'");
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
	function Lampiran($id,$offset,$limit)
		{
			$q=$this->db->query("select tbl_pengumuman.id_pengumuman,tbl_lampiran.file,tbl_lampiran.id_lampiran,tbl_pengumuman.judul_pengumuman from tbl_lampiran left join
			 tbl_pengumuman on tbl_pengumuman.id_pengumuman=tbl_lampiran.id_pengumuman
			 where tbl_lampiran.id_pengumuman='$id'
			 order by tbl_lampiran.id_lampiran DESC LIMIT $offset,$limit");
			return $q;
		}
		function Daftar_Polling($offset,$limit)
		{
			$q=$this->db->query("select * from tbl_soalpolling order by id_soal_poll DESC LIMIT $offset,$limit");
			return $q;
		}
	
	function Daftar_Skpd($offset,$limit)
		{
			$q=$this->db->query("select * from tbl_skpd order by id_skpd DESC LIMIT $offset,$limit");
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
			$query=$this->db->query("select * from tbl_menu where status='Y'");
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
}
