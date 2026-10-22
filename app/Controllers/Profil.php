<?php

namespace App\Controllers;

use App\Core\CI_Controller;

#[\AllowDynamicProperties]
class Profil extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (session_status() === PHP_SESSION_NONE) { session_start(); }
        $this->load->model('Profil_model');
        $this->load->model('Webadmin_model');
        $this->load->model('Anak_model');
        $this->load->model('Pendidikan_model');
        $this->load->model('Pekerjaanprofil_model');
        $this->load->library('form_validation');
    }
    function index()
    {
        $page=$this->uri->segment(3);
        $limit=100;
        if(!$page):
        $offset = 0;
        else:
        $offset = $page;
        endif;
        $datestring = "Login : %d-%m-%Y pukul %h:%i %a";
        $time = time();
        $data["tanggal"] = mdate($datestring, $time);
        $cek = $this->session->userdata('logged_in');
        $data['akses']=$this->session->userdata('akses');
        $data["page"] = $page;
        if(empty($cek))
        {
            header('location:'.base_url().'webadmin/loginpage');
        }
        else
        {
            $data['h2_title'] = 'Kepegawaian';
            $data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
            $data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
            $data['instansi'] = $this->config->item('nama_instansi');
            $data['credit'] = $this->config->item('credit_aplikasi');
            $data['alamat'] = $this->config->item('alamat_instansi');
            $total = $this->Webadmin_model->Total_Data("tbl_profil");
            $config['base_url'] = base_url() . '/profil/';
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
            $data['daftarartikel'] = $this->Webadmin_model->Profil($offset,$limit);
            $this->load->view('webadmin/bg_atas',$data);
            $this->load->view('profil/tbl_profil_list',$data);
            $this->load->view('webadmin/bg_bawah');
            }
            
    }
    

    public function read($id = null) {
        $cek = $this->session->userdata('logged_in');
        $data['akses']=$this->session->userdata('akses');
        if(empty($cek))
        {
            header('location:'.base_url().'webadmin/loginpage');
        }
        else
        {
            $data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
            $data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
            $data['instansi'] = $this->config->item('nama_instansi');
            $data['credit'] = $this->config->item('credit_aplikasi');
            $data['alamat'] = $this->config->item('alamat_instansi');
            $data['akses']=$this->session->userdata('akses');

             $data['status_pegawai'] = $this->db->query("SELECT
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
tbl_skpd ON tbl_skpd.id_skpd=tbl_profil.unit_kerja where tbl_profil.id_profil='$id'");

              $data['keluarga'] = $this->db->query("SELECT
tbl_anak.id_anak,
tbl_anak.id_profil,
tbl_anak.nama_anak,
tbl_anak.id_jk,
tbl_anak.pendidikan,
tbl_kelamin.kelamin
FROM
tbl_anak LEFT JOIN
tbl_kelamin ON tbl_kelamin.id_kelamin=tbl_anak.id_jk where tbl_anak.id_profil='$id'
 ORDER BY tbl_anak.id_anak ASC");

               $data['pendidikan'] = $this->db->query("SELECT
tbl_pendidikan.id_pendidikan,
tbl_pendidikan.id_jenjang,
tbl_pendidikan.nama,
tbl_pendidikan.jurusan,
tbl_pendidikan.tempat,
tbl_pendidikan.tahun_pendidikan,
tbl_jenjang.jenjang,
tbl_pendidikan.id_profil
FROM
tbl_pendidikan
LEFT JOIN tbl_jenjang ON tbl_jenjang.id_jenjang = tbl_pendidikan.id_jenjang
 where tbl_pendidikan.id_profil='$id'
 ORDER BY tbl_pendidikan.id_pendidikan ASC");

                $data['pekerjaan'] = $this->db->query("SELECT
tbl_pekerjaanprofil.unit_kerja,
tbl_pekerjaanprofil.periode,
tbl_pekerjaanprofil.id_jabatanprofil,
tbl_pekerjaanprofil.id_profil,
tbl_pekerjaanprofil.id_pekerjaanprofil,
tbl_skpd.skpd,
tbl_jabatanprofil.jabatanprofil
FROM
tbl_pekerjaanprofil LEFT JOIN
tbl_skpd ON tbl_skpd.id_skpd=tbl_pekerjaanprofil.unit_kerja LEFT JOIN
tbl_jabatanprofil on tbl_jabatanprofil.id_jabatanprofil=tbl_pekerjaanprofil.id_jabatanprofil
 where tbl_pekerjaanprofil.id_profil='$id'
 ORDER BY tbl_pekerjaanprofil.id_jabatanprofil ASC");


              $this->load->view('webadmin/bg_atas',$data);
              $this->load->view('profil/tbl_profil_read', $data);
              $this->load->view('webadmin/bg_bawah',$data);
       
    }
    }

    public function create() 
    {
        $cek = $this->session->userdata('logged_in');
        $data['akses']=$this->session->userdata('akses');
        if(empty($cek))
        {
            header('location:'.base_url().'webadmin/loginpage');
        }
        else
        {
        $data = array(
            'button' => 'Simpan',
            'action' => site_url('profil/create_action'),
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
        $data['akses']=$this->session->userdata('akses');

        $data["agama"]=$this->Webadmin_model->Semua_Agama();
        $data["menikah"]=$this->Webadmin_model->Semua_Menikah();
        $data["pangkat"]=$this->Webadmin_model->Semua_Pangkat();
        $data["golongan"]=$this->Webadmin_model->Semua_Golongan();
        $data["jabatan"]=$this->Webadmin_model->Semua_Jabatanprofil();
        $data["jk"]=$this->Webadmin_model->Semua_Kelamin();
        $data["skpd"]=$this->Webadmin_model->Semua_Skpd();
        $data["tingkat"]=$this->Webadmin_model->Semua_Tingkat();
        $data["level"]=$this->Webadmin_model->Semua_Level();
        $this->load->view('webadmin/bg_atas',$data);
        $this->load->view('profil/tbl_profil_form', $data);
        $this->load->view('webadmin/bg_bawah',$data);
    }
    }
    
    public function create_action() 
    {
        $cek = $this->session->userdata('logged_in');
        $data['akses']=$this->session->userdata('akses');
        if(empty($cek))
        {
            header('location:'.base_url().'webadmin/loginpage');
        }
        else
        {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            if(empty($_FILES['userfile']['name'])){
            $data = array(
		'identitas_diri' => $this->input->post('identitas_diri',TRUE),
		'nama_lengkap' => $this->input->post('nama_lengkap',TRUE),
		'tempat_lahir' => $this->input->post('tempat_lahir',TRUE),
		'tanggal_lahir' => date('Y-m-d', strtotime($this->input->post('tanggal_lahir',TRUE))),
		'alamat' => $this->input->post('alamatku',TRUE),
		'id_agama' => $this->input->post('id_agama',TRUE),
        'id_level' => $this->input->post('id_level',TRUE),
		'hp' => $this->input->post('hp',TRUE),
		'alamat_surel' => $this->input->post('alamat_surel',TRUE),
		'alamat_kantor' => $this->input->post('alamat_kantor',TRUE),
		'id_menikah' => $this->input->post('id_menikah',TRUE),
		'nip' => $this->input->post('nip',TRUE),
		'id_pangkat' => $this->input->post('id_pangkat',TRUE),
		'id_golongan' => $this->input->post('id_golongan',TRUE),
        'id_tingkatan' => $this->input->post('id_tingkatan',TRUE),
		'id_jabatanprofil' => $this->input->post('id_jabatanprofil',TRUE),
		'unit_kerja' => $this->input->post('unit_kerja',TRUE),
		'hobi' => $this->input->post('hobi',TRUE),
		'nama_pasangan' => $this->input->post('nama_pasangan',TRUE),
		'id_jk' => $this->input->post('id_jk',TRUE),
		'pendidikan' => $this->input->post('pendidikan',TRUE),
        'foto' => "welcome.png",
	    );

            $this->Profil_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('profil'));
            }else{
                $acak=rand(00000000000,99999999999);
                $bersih=$_FILES['userfile']['name'];
                $nm=str_replace(" ","_","$bersih");
                $pisah=explode(".",$nm);
                $nama_murni=$pisah[0];
                $ubah=$acak.$nama_murni; //tanpa ekstensi
                $config["file_name"]=$ubah; //dengan eekstensi
                //$in["foto_besar"]=$acak.$nm;
                $config['upload_path'] = './asset/profil/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = '500000';
                $config['max_width'] = '12000';
                $config['max_height'] = '12000';                        
                $this->load->library('upload', $config);
                //Kedua
                if(!$this->upload->do_upload())
                {
                 echo $this->upload->display_errors();
                }
                else {
             $data = array(
        'identitas_diri' => $this->input->post('identitas_diri',TRUE),
        'nama_lengkap' => $this->input->post('nama_lengkap',TRUE),
        'tempat_lahir' => $this->input->post('tempat_lahir',TRUE),
        'tanggal_lahir' => date('Y-m-d', strtotime($this->input->post('tanggal_lahir',TRUE))),
        'alamat' => $this->input->post('alamatku',TRUE),
        'id_agama' => $this->input->post('id_agama',TRUE),
        'hp' => $this->input->post('hp',TRUE),
        'alamat_surel' => $this->input->post('alamat_surel',TRUE),
        'alamat_kantor' => $this->input->post('alamat_kantor',TRUE),
        'id_menikah' => $this->input->post('id_menikah',TRUE),
        'nip' => $this->input->post('nip',TRUE),
        'id_level' => $this->input->post('id_level',TRUE),
        'id_tingkatan' => $this->input->post('id_tingkatan',TRUE),
        'id_pangkat' => $this->input->post('id_pangkat',TRUE),
        'id_golongan' => $this->input->post('id_golongan',TRUE),
        'id_jabatanprofil' => $this->input->post('id_jabatanprofil',TRUE),
        'unit_kerja' => $this->input->post('unit_kerja',TRUE),
        'hobi' => $this->input->post('hobi',TRUE),
        'nama_pasangan' => $this->input->post('nama_pasangan',TRUE),
        'id_jk' => $this->input->post('id_jk',TRUE),
        'pendidikan' => $this->input->post('pendidikan',TRUE),
        'foto' => $acak.$nm,
        );

            $this->Profil_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('profil'));
                }
                  
            }
        }
        }
    }
    
    public function update($id = null) {
        $cek = $this->session->userdata('logged_in');
        $data['akses']=$this->session->userdata('akses');
        if(empty($cek))
        {
            header('location:'.base_url().'webadmin/loginpage');
        }
        else
        {
        $row = $this->Profil_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('profil/update_action'),
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
            $data['akses']=$this->session->userdata('akses');

            $data["agama"]=$this->Webadmin_model->Semua_Agama();
        $data["menikah"]=$this->Webadmin_model->Semua_Menikah();
        $data["pangkat"]=$this->Webadmin_model->Semua_Pangkat();
        $data["golongan"]=$this->Webadmin_model->Semua_Golongan();
        $data["jabatan"]=$this->Webadmin_model->Semua_Jabatanprofil();
        $data["jk"]=$this->Webadmin_model->Semua_Kelamin();
        $data["skpd"]=$this->Webadmin_model->Semua_Skpd();
        $data["tingkat"]=$this->Webadmin_model->Semua_Tingkat();
        $data["level"]=$this->Webadmin_model->Semua_Level();
            $this->load->view('webadmin/bg_atas',$data);
            $this->load->view('profil/tbl_profil_form', $data);
            $this->load->view('webadmin/bg_bawah',$data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('profil'));
        }
        }
    }
    
    public function update_action() 
    {
        $cek = $this->session->userdata('logged_in');
        $data['akses']=$this->session->userdata('akses');
        if(empty($cek))
        {
            header('location:'.base_url().'webadmin/loginpage');
        }
        else
        {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_profil', TRUE));
        } else {

                
                

             if(empty($_FILES['userfile']['name'])){
            $data = array(
		'identitas_diri' => $this->input->post('identitas_diri',TRUE),
		'nama_lengkap' => $this->input->post('nama_lengkap',TRUE),
		'tempat_lahir' => $this->input->post('tempat_lahir',TRUE),
		'tanggal_lahir' => date('Y-m-d', strtotime($this->input->post('tanggal_lahir',TRUE))),
		'alamat' => $this->input->post('alamatku',TRUE),
		'id_agama' => $this->input->post('id_agama',TRUE),
		'hp' => $this->input->post('hp',TRUE),
        'id_tingkatan' => $this->input->post('id_tingkatan',TRUE),
		'alamat_surel' => $this->input->post('alamat_surel',TRUE),
		'alamat_kantor' => $this->input->post('alamat_kantor',TRUE),
		'id_menikah' => $this->input->post('id_menikah',TRUE),
		'nip' => $this->input->post('nip',TRUE),
        'id_level' => $this->input->post('id_level',TRUE),
		'id_pangkat' => $this->input->post('id_pangkat',TRUE),
		'id_golongan' => $this->input->post('id_golongan',TRUE),
		'id_jabatanprofil' => $this->input->post('id_jabatanprofil',TRUE),
		'unit_kerja' => $this->input->post('unit_kerja',TRUE),
		'hobi' => $this->input->post('hobi',TRUE),
		'nama_pasangan' => $this->input->post('nama_pasangan',TRUE),
		'id_jk' => $this->input->post('id_jk',TRUE),
		'pendidikan' => $this->input->post('pendidikan',TRUE),
	    ); 
            }else{
                $acak=rand(00000000000,99999999999);
                $bersih=$_FILES['userfile']['name'];
                $nm=str_replace(" ","_","$bersih");
                $pisah=explode(".",$nm);
                $nama_murni=$pisah[0];
                $ubah=$acak.$nama_murni; //tanpa ekstensi
                $config["file_name"]=$ubah; //dengan eekstensi
                //$in["foto_besar"]=$acak.$nm;
                $config['upload_path'] = './asset/profil/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = '500000';
                $config['max_width'] = '12000';
                $config['max_height'] = '12000';                        
                $this->load->library('upload', $config);
                //Kedua
                if(!$this->upload->do_upload())
                {
                 echo $this->upload->display_errors();
                }
                else {
                $data = array(
        'identitas_diri' => $this->input->post('identitas_diri',TRUE),
        'nama_lengkap' => $this->input->post('nama_lengkap',TRUE),
        'tempat_lahir' => $this->input->post('tempat_lahir',TRUE),
        'tanggal_lahir' => date('Y-m-d', strtotime($this->input->post('tanggal_lahir',TRUE))),
        'alamat' => $this->input->post('alamatku',TRUE),
        'id_agama' => $this->input->post('id_agama',TRUE),
        'hp' => $this->input->post('hp',TRUE),
        'alamat_surel' => $this->input->post('alamat_surel',TRUE),
        'alamat_kantor' => $this->input->post('alamat_kantor',TRUE),
        'id_menikah' => $this->input->post('id_menikah',TRUE),
        'nip' => $this->input->post('nip',TRUE),
        'id_tingkatan' => $this->input->post('id_tingkatan',TRUE),
        'id_pangkat' => $this->input->post('id_pangkat',TRUE),
        'id_golongan' => $this->input->post('id_golongan',TRUE),
        'id_jabatanprofil' => $this->input->post('id_jabatanprofil',TRUE),
        'unit_kerja' => $this->input->post('unit_kerja',TRUE),
        'hobi' => $this->input->post('hobi',TRUE),
        'id_level' => $this->input->post('id_level',TRUE),
        'nama_pasangan' => $this->input->post('nama_pasangan',TRUE),
        'id_jk' => $this->input->post('id_jk',TRUE),
        'pendidikan' => $this->input->post('pendidikan',TRUE),
        'foto' => $acak.$nm,
    );
            }
        }

            $this->Profil_model->update($this->input->post('id_profil', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('profil'));
        }
        }
    }
    
    public function delete($id = null) {
        $cek = $this->session->userdata('logged_in');
        $data['akses']=$this->session->userdata('akses');
        if(empty($cek))
        {
            header('location:'.base_url().'webadmin/loginpage');
        }
        else
        {
        $row = $this->Profil_model->get_by_id($id);

        if ($row) {
            $this->Profil_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('profil'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('profil'));
        }
        }
    }

    public function keluarga($id) 
    {
        $cek = $this->session->userdata('logged_in');
        $data['akses']=$this->session->userdata('akses');
        if(empty($cek))
        {
            header('location:'.base_url().'webadmin/loginpage');
        }
        else
        {
        $row = $this->Profil_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('profil/update_keluarga'),
                'action2' => site_url('profil/simpan_anak'),
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
            $data['akses']=$this->session->userdata('akses');

            $data["agama"]=$this->Webadmin_model->Semua_Agama();
        $data["menikah"]=$this->Webadmin_model->Semua_Menikah();
        $data["pangkat"]=$this->Webadmin_model->Semua_Pangkat();
        $data["golongan"]=$this->Webadmin_model->Semua_Golongan();
        $data["jabatan"]=$this->Webadmin_model->Semua_Jabatanprofil();
        $data["jk"]=$this->Webadmin_model->Semua_Kelamin();
        $data["skpd"]=$this->Webadmin_model->Semua_Skpd();

         $data['status_pegawai'] = $this->db->query("SELECT
tbl_anak.id_anak,
tbl_anak.id_profil,
tbl_anak.nama_anak,
tbl_anak.id_jk,
tbl_anak.pendidikan,
tbl_kelamin.kelamin
FROM
tbl_anak LEFT JOIN
tbl_kelamin ON tbl_kelamin.id_kelamin=tbl_anak.id_jk where tbl_anak.id_profil='$id'
 ORDER BY tbl_anak.id_anak DESC");

            $this->load->view('webadmin/bg_atas',$data);
            $this->load->view('profil/tbl_keluarga_form', $data);
            $this->load->view('webadmin/bg_bawah',$data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('profil'));
        }
        }
    }
     public function simpan_anak() 
    {
        $cek = $this->session->userdata('logged_in');
        $data['akses']=$this->session->userdata('akses');
        if(empty($cek))
        {
            header('location:'.base_url().'webadmin/loginpage');
        }
        else
        {
            $idm=$this->input->post('id_profil',TRUE);
            $data = array(
        'id_profil' => $this->input->post('id_profil',TRUE),
        'nama_anak' => $this->input->post('nama_anak',TRUE),
        'id_jk' => $this->input->post('id_jk',TRUE),
        'pendidikan' => $this->input->post('pendidikan',TRUE),
        );

            $this->Anak_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('profil/keluarga/'.$idm));
           
        
    }
    }

    public function update_anak($id) 
    {
        $cek = $this->session->userdata('logged_in');
        $data['akses']=$this->session->userdata('akses');
        if(empty($cek))
        {
            header('location:'.base_url().'webadmin/loginpage');
        }
        else
        {
        $row = $this->Anak_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action3' => site_url('profil/update_anak_action'),
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
            $data['akses']=$this->session->userdata('akses');

             $data["agama"]=$this->Webadmin_model->Semua_Agama();
        $data["menikah"]=$this->Webadmin_model->Semua_Menikah();
        $data["pangkat"]=$this->Webadmin_model->Semua_Pangkat();
        $data["golongan"]=$this->Webadmin_model->Semua_Golongan();
        $data["jabatan"]=$this->Webadmin_model->Semua_Jabatanprofil();
        $data["jk"]=$this->Webadmin_model->Semua_Kelamin();
        $data["skpd"]=$this->Webadmin_model->Semua_Skpd();


            $this->load->view('webadmin/bg_atas',$data);
            $this->load->view('profil/tbl_anak_form', $data);
            $this->load->view('webadmin/bg_bawah',$data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('anak'));
        }
        }
    }
     public function update_keluarga() 
    {
        $cek = $this->session->userdata('logged_in');
        $data['akses']=$this->session->userdata('akses');
        if(empty($cek))
        {
            header('location:'.base_url().'webadmin/loginpage');
        }
        else
        {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_profil', TRUE));
        } else {

            $idm=$this->input->post('id_profil', TRUE);
            $data = array(
        'nama_pasangan' => $this->input->post('nama_pasangan',TRUE),
        'id_jk' => $this->input->post('id_jk',TRUE),
        'pendidikan' => $this->input->post('pendidikan',TRUE),
        ); 
           

            $this->Profil_model->update($this->input->post('id_profil', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('profil/keluarga/'.$idm));
        }
        }
    }
    public function update_anak_action() 
    {
        $cek = $this->session->userdata('logged_in');
        $data['akses']=$this->session->userdata('akses');
        if(empty($cek))
        {
            header('location:'.base_url().'webadmin/loginpage');
        }
        else
        {
      
            $aj=$this->input->post('id_profil',TRUE);
            $data = array(
        'id_profil' => $this->input->post('id_profil',TRUE),
        'nama_anak' => $this->input->post('nama_anak',TRUE),
        'id_jk' => $this->input->post('id_jk',TRUE),
        'pendidikan' => $this->input->post('pendidikan',TRUE),
        );

            $this->Anak_model->update($this->input->post('id_anak', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('profil/keluarga/'.$aj));
        
        }
    }
     public function delete_anak() 
    {
        $id=$this->uri->segment(3);
        $id2=$this->uri->segment(4);
        $cek = $this->session->userdata('logged_in');
        $data['akses']=$this->session->userdata('akses');
        if(empty($cek))
        {
            header('location:'.base_url().'webadmin/loginpage');
        }
        else
        {
        $row = $this->Anak_model->get_by_id($id);

        if ($row) {
            $this->Anak_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('profil/keluarga/'.$id2));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('profil/keluarga/'.$id2));
        }
        }
    }
    public function pendidikan($id) 
    {
        $cek = $this->session->userdata('logged_in');
        $data['akses']=$this->session->userdata('akses');
        if(empty($cek))
        {
            header('location:'.base_url().'webadmin/loginpage');
        }
        else
        {
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
            'action' => site_url('profil/update_pendidikan'),
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
            $data['akses']=$this->session->userdata('akses');

            $data["agama"]=$this->Webadmin_model->Semua_Agama();
        $data["menikah"]=$this->Webadmin_model->Semua_Menikah();
        $data["pangkat"]=$this->Webadmin_model->Semua_Pangkat();
        $data["golongan"]=$this->Webadmin_model->Semua_Golongan();
        $data["jabatan"]=$this->Webadmin_model->Semua_Jabatanprofil();
        $data["jk"]=$this->Webadmin_model->Semua_Kelamin();
        $data["jenjang"]=$this->Webadmin_model->Semua_Jenjang();

         $data['status_pegawai'] = $this->db->query("SELECT
tbl_pendidikan.id_pendidikan,
tbl_pendidikan.id_jenjang,
tbl_pendidikan.nama,
tbl_pendidikan.jurusan,
tbl_pendidikan.tempat,
tbl_pendidikan.tahun_pendidikan,
tbl_jenjang.jenjang,
tbl_pendidikan.id_profil
FROM
tbl_pendidikan
LEFT JOIN tbl_jenjang ON tbl_jenjang.id_jenjang = tbl_pendidikan.id_jenjang
 where tbl_pendidikan.id_profil='$id'
 ORDER BY tbl_pendidikan.id_pendidikan ASC");

            $this->load->view('webadmin/bg_atas',$data);
            $this->load->view('profil/tbl_pendidikan_form', $data);
            $this->load->view('webadmin/bg_bawah',$data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('profil'));
        }
        }
    }
     public function update_pendidikan() 
    {
        $cek = $this->session->userdata('logged_in');
        $data['akses']=$this->session->userdata('akses');
        if(empty($cek))
        {
            header('location:'.base_url().'webadmin/loginpage');
        }
        else
        {
        
            $aj=$this->input->post('id_profil',TRUE);
            $data = array(
        'id_profil' => $this->input->post('id_profil',TRUE),
        'id_jenjang' => $this->input->post('id_jenjang',TRUE),
        'nama' => $this->input->post('nama',TRUE),
        'jurusan' => $this->input->post('jurusan',TRUE),
        'tempat' => $this->input->post('tempat',TRUE),
        'tahun_pendidikan' => $this->input->post('tahun_pendidikan',TRUE),
        );

            $this->Pendidikan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('profil/pendidikan/'.$aj));
        
        }
    }

     public function updatependidikan() 
    {
        $id=$this->uri->segment(3);
        $id2=$this->uri->segment(4);
        $cek = $this->session->userdata('logged_in');
        $data['akses']=$this->session->userdata('akses');
        if(empty($cek))
        {
            header('location:'.base_url().'webadmin/loginpage');
        }
        else
        {
        $row = $this->Pendidikan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('profil/update_pendidikan_final'),
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
            $data['akses']=$this->session->userdata('akses');
             $data["jenjang"]=$this->Webadmin_model->Semua_Jenjang();

         $data['status_pegawai'] = $this->db->query("SELECT
tbl_pendidikan.id_pendidikan,
tbl_pendidikan.id_jenjang,
tbl_pendidikan.nama,
tbl_pendidikan.jurusan,
tbl_pendidikan.tempat,
tbl_pendidikan.tahun_pendidikan,
tbl_jenjang.jenjang,
tbl_pendidikan.id_profil
FROM
tbl_pendidikan
LEFT JOIN tbl_jenjang ON tbl_jenjang.id_jenjang = tbl_pendidikan.id_jenjang
 where tbl_pendidikan.id_profil='$id2'
 ORDER BY tbl_pendidikan.id_pendidikan ASC");


            $this->load->view('webadmin/bg_atas',$data);
            $this->load->view('profil/tbl_pendidikan_form', $data);
            $this->load->view('webadmin/bg_bawah',$data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pendidikan'));
        }
        }
    }
    public function update_pendidikan_final() 
    {
        $cek = $this->session->userdata('logged_in');
        $data['akses']=$this->session->userdata('akses');
        if(empty($cek))
        {
            header('location:'.base_url().'webadmin/loginpage');
        }
        else
        {
            $aj=$this->input->post('id_profil',TRUE);
            $data = array(
        'id_profil' => $this->input->post('id_profil',TRUE),
        'id_jenjang' => $this->input->post('id_jenjang',TRUE),
        'nama' => $this->input->post('nama',TRUE),
        'jurusan' => $this->input->post('jurusan',TRUE),
        'tempat' => $this->input->post('tempat',TRUE),
        'tahun_pendidikan' => $this->input->post('tahun_pendidikan',TRUE),
        );

            $this->Pendidikan_model->update($this->input->post('id_pendidikan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('profil/pendidikan/'.$aj));
        
        }
    }
     public function deletependidikan() 
    {
        $id=$this->uri->segment(3);
        $id2=$this->uri->segment(4);

        $cek = $this->session->userdata('logged_in');
        $data['akses']=$this->session->userdata('akses');
        if(empty($cek))
        {
            header('location:'.base_url().'webadmin/loginpage');
        }
        else
        {
        $row = $this->Pendidikan_model->get_by_id($id);

        if ($row) {
            $this->Pendidikan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('profil/pendidikan/'.$id2));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('profil/pendidikan/'.$id2));
        }
        }
    }
    public function pekerjaan($id) 
    {
        $cek = $this->session->userdata('logged_in');
        $data['akses']=$this->session->userdata('akses');
        if(empty($cek))
        {
            header('location:'.base_url().'webadmin/loginpage');
        }
        else
        {
        $row = $this->Profil_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Simpan',
                'action' => site_url('profil/update_pekerjaan'),
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
            $data['akses']=$this->session->userdata('akses');

            $data["agama"]=$this->Webadmin_model->Semua_Agama();
        $data["menikah"]=$this->Webadmin_model->Semua_Menikah();
        $data["pangkat"]=$this->Webadmin_model->Semua_Pangkat();
        $data["golongan"]=$this->Webadmin_model->Semua_Golongan();
        $data["jabatan"]=$this->Webadmin_model->Semua_Jabatanprofil();
        $data["jk"]=$this->Webadmin_model->Semua_Kelamin();
        $data["skpd"]=$this->Webadmin_model->Semua_Skpd();

             $data['status_pegawai'] = $this->db->query("SELECT
tbl_pekerjaanprofil.unit_kerja,
tbl_pekerjaanprofil.periode,
tbl_pekerjaanprofil.id_jabatanprofil,
tbl_pekerjaanprofil.id_profil,
tbl_pekerjaanprofil.id_pekerjaanprofil,
tbl_skpd.skpd,
tbl_jabatanprofil.jabatanprofil
FROM
tbl_pekerjaanprofil LEFT JOIN
tbl_skpd ON tbl_skpd.id_skpd=tbl_pekerjaanprofil.unit_kerja LEFT JOIN
tbl_jabatanprofil on tbl_jabatanprofil.id_jabatanprofil=tbl_pekerjaanprofil.id_jabatanprofil
 where tbl_pekerjaanprofil.id_profil='$id'
 ORDER BY tbl_pekerjaanprofil.id_jabatanprofil ASC");

            $this->load->view('webadmin/bg_atas',$data);
            $this->load->view('profil/tbl_pekerjaan_form', $data);
            $this->load->view('webadmin/bg_bawah',$data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('profil'));
        }
        }
    }
     public function update_pekerjaan() 
    {
        $cek = $this->session->userdata('logged_in');
        $data['akses']=$this->session->userdata('akses');
        if(empty($cek))
        {
            header('location:'.base_url().'webadmin/loginpage');
        }
        else
        {
       
            $aj=$this->input->post('id_profil',TRUE);
            $data = array(
        'id_profil' => $this->input->post('id_profil',TRUE),
        'id_jabatanprofil' => $this->input->post('id_jabatanprofil',TRUE),
        'periode' => $this->input->post('periode',TRUE),
        'unit_kerja' => $this->input->post('unit_kerja',TRUE),
        );

            $this->Pekerjaanprofil_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('profil/pekerjaan/'.$aj));
        
        }
    }
     public function deletepekerjaan() 
    {
        $id=$this->uri->segment(3);
        $id2=$this->uri->segment(4);
        $cek = $this->session->userdata('logged_in');
        $data['akses']=$this->session->userdata('akses');
        if(empty($cek))
        {
            header('location:'.base_url().'webadmin/loginpage');
        }
        else
        {
        $row = $this->Pekerjaanprofil_model->get_by_id($id);

        if ($row) {
            $this->Pekerjaanprofil_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('profil/pekerjaan/'.$id2));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('profil/pekerjaan/'.$id2));
        }
        }
    }
     public function updatepekerjaan() 
    {
        $id=$this->uri->segment(3);
        $id2=$this->uri->segment(4);
        $cek = $this->session->userdata('logged_in');
        $data['akses']=$this->session->userdata('akses');
        if(empty($cek))
        {
            header('location:'.base_url().'webadmin/loginpage');
        }
        else
        {
        $row = $this->Pekerjaanprofil_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('profil/update_pekerjaan_final'),
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
            $data['akses']=$this->session->userdata('akses');

             $data["agama"]=$this->Webadmin_model->Semua_Agama();
        $data["menikah"]=$this->Webadmin_model->Semua_Menikah();
        $data["pangkat"]=$this->Webadmin_model->Semua_Pangkat();
        $data["golongan"]=$this->Webadmin_model->Semua_Golongan();
        $data["jabatan"]=$this->Webadmin_model->Semua_Jabatanprofil();
        $data["jk"]=$this->Webadmin_model->Semua_Kelamin();
        $data["skpd"]=$this->Webadmin_model->Semua_Skpd();

             $data['status_pegawai'] = $this->db->query("SELECT
tbl_pekerjaanprofil.unit_kerja,
tbl_pekerjaanprofil.periode,
tbl_pekerjaanprofil.id_jabatanprofil,
tbl_pekerjaanprofil.id_profil,
tbl_pekerjaanprofil.id_pekerjaanprofil,
tbl_skpd.skpd,
tbl_jabatanprofil.jabatanprofil
FROM
tbl_pekerjaanprofil LEFT JOIN
tbl_skpd ON tbl_skpd.id_skpd=tbl_pekerjaanprofil.unit_kerja LEFT JOIN
tbl_jabatanprofil on tbl_jabatanprofil.id_jabatanprofil=tbl_pekerjaanprofil.id_jabatanprofil
 where tbl_pekerjaanprofil.id_profil='$id2'
 ORDER BY tbl_pekerjaanprofil.id_jabatanprofil ASC");

            $this->load->view('webadmin/bg_atas',$data);
            $this->load->view('profil/tbl_pekerjaan_form', $data);
            $this->load->view('webadmin/bg_bawah',$data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pekerjaanprofil'));
        }
        }
    }
     public function update_pekerjaan_final() 
    {
        $cek = $this->session->userdata('logged_in');
        $data['akses']=$this->session->userdata('akses');
        if(empty($cek))
        {
            header('location:'.base_url().'webadmin/loginpage');
        }
        else
        {
        
            $aj=$this->input->post('id_profil',TRUE);
            $data = array(
        'id_profil' => $this->input->post('id_profil',TRUE),
        'id_jabatanprofil' => $this->input->post('id_jabatanprofil',TRUE),
        'periode' => $this->input->post('periode',TRUE),
        'unit_kerja' => $this->input->post('unit_kerja',TRUE),
        );

            $this->Pekerjaanprofil_model->update($this->input->post('id_pekerjaanprofil', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('profil/pekerjaan/'.$aj));
        
        }
    }
     public function fotoku($id) 
    {
        $cek = $this->session->userdata('logged_in');
        $data['akses']=$this->session->userdata('akses');
        if(empty($cek))
        {
            header('location:'.base_url().'webadmin/loginpage');
        }
        else
        {
        $row = $this->Profil_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('profil/update_fotoprofil'),
                'action2' => site_url('profil/simpan_anak'),
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
            $data['akses']=$this->session->userdata('akses');

            $data["agama"]=$this->Webadmin_model->Semua_Agama();
        $data["menikah"]=$this->Webadmin_model->Semua_Menikah();
        $data["pangkat"]=$this->Webadmin_model->Semua_Pangkat();
        $data["golongan"]=$this->Webadmin_model->Semua_Golongan();
        $data["jabatan"]=$this->Webadmin_model->Semua_Jabatanprofil();
        $data["jk"]=$this->Webadmin_model->Semua_Kelamin();
        $data["skpd"]=$this->Webadmin_model->Semua_Skpd();

         $data['status_pegawai'] = $this->db->query("SELECT
tbl_anak.id_anak,
tbl_anak.id_profil,
tbl_anak.nama_anak,
tbl_anak.id_jk,
tbl_anak.pendidikan,
tbl_kelamin.kelamin
FROM
tbl_anak LEFT JOIN
tbl_kelamin ON tbl_kelamin.id_kelamin=tbl_anak.id_jk where tbl_anak.id_profil='$id'
 ORDER BY tbl_anak.id_anak DESC");

            $this->load->view('webadmin/bg_atas',$data);
            $this->load->view('profil/tbl_fotoku_form', $data);
            $this->load->view('webadmin/bg_bawah',$data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('profil'));
        }
        }
    }

    public function update_fotoprofil() 
    {
        $cek = $this->session->userdata('logged_in');
        $data['akses']=$this->session->userdata('akses');
        if(empty($cek))
        {
            header('location:'.base_url().'webadmin/loginpage');
        }
        else
        {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_profil', TRUE));
        } else {
             if(empty($_FILES['userfile']['name'])){
            $data = array(
       
        'nama_lengkap' => $this->input->post('nama_lengkap',TRUE),
        ); 
            }else{
                $acak=rand(00000000000,99999999999);
                $bersih=$_FILES['userfile']['name'];
                $nm=str_replace(" ","_","$bersih");
                $pisah=explode(".",$nm);
                $nama_murni=$pisah[0];
                $ubah=$acak.$nama_murni; //tanpa ekstensi
                $config["file_name"]=$ubah; //dengan eekstensi
                //$in["foto_besar"]=$acak.$nm;
                $config['upload_path'] = './asset/profil/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = '500000';
                $config['max_width'] = '12000';
                $config['max_height'] = '12000';                        
                $this->load->library('upload', $config);
                //Kedua
                if(!$this->upload->do_upload())
                {
                 echo $this->upload->display_errors();
                }
                else {
                $data = array(
        'nama_lengkap' => $this->input->post('nama_lengkap',TRUE),
        'foto_profil' => $acak.$nm,
    );
            }
        }

            $this->Profil_model->update($this->input->post('id_profil', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('profil'));
        }
        }
    }
    
    public function _rules() 
    {
	//$this->form_validation->set_rules('identitas_diri', 'identitas diri', 'trim|required');
	$this->form_validation->set_rules('nama_lengkap', 'nama lengkap', 'trim|required');
	//$this->form_validation->set_rules('tempat_lahir', 'tempat lahir', 'trim|required');
	

	$this->form_validation->set_rules('id_profil', 'id_profil', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Profil.php */
/* Location: ./application/controllers/Profil.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-25 04:36:46 */
/* http://harviacode.com */