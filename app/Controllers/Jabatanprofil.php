<?php

namespace App\Controllers;

use App\Core\CI_Controller;

#[\AllowDynamicProperties]
class Jabatanprofil extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (session_status() === PHP_SESSION_NONE) { session_start(); }
        $this->load->model('Jabatanprofil_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $cek = $this->session->userdata('logged_in');
        $data['akses']=$this->session->userdata('akses');
        if(empty($cek))
        {
            header('location:'.base_url().'webadmin/loginpage'); exit;
        }
        else
        {

        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'jabatanprofil/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'jabatanprofil/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'jabatanprofil/index.html';
            $config['first_url'] = base_url() . 'jabatanprofil/index.html';
        }

        $config['per_page'] = 100;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Jabatanprofil_model->total_rows($q);
        $jabatanprofil = $this->Jabatanprofil_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'jabatanprofil_data' => $jabatanprofil,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
        $data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
        $data['instansi'] = $this->config->item('nama_instansi');
        $data['credit'] = $this->config->item('credit_aplikasi');
        $data['alamat'] = $this->config->item('alamat_instansi');
        $data['akses']=$this->session->userdata('akses');
        $this->load->view('webadmin/bg_atas',$data);
        $this->load->view('jabatanprofil/tbl_jabatanprofil_list', $data);
        $this->load->view('webadmin/bg_bawah',$data);
    }}

    public function read($id = null) {
        $row = $this->Jabatanprofil_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_jabatanprofil' => $row->id_jabatanprofil,
		'jabatanprofil' => $row->jabatanprofil,
	    );
            $this->load->view('jabatanprofil/tbl_jabatanprofil_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jabatanprofil'));
        }
    }

    public function create() 
    {
        $cek = $this->session->userdata('logged_in');
        $data['akses']=$this->session->userdata('akses');
        if(empty($cek))
        {
            header('location:'.base_url().'webadmin/loginpage'); exit;
        }
        else
        {
        $data = array(
            'button' => 'Simpan',
            'action' => site_url('jabatanprofil/create_action'),
	    'id_jabatanprofil' => set_value('id_jabatanprofil'),
	    'jabatanprofil' => set_value('jabatanprofil'),
	);
        $data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
        $data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
        $data['instansi'] = $this->config->item('nama_instansi');
        $data['credit'] = $this->config->item('credit_aplikasi');
        $data['alamat'] = $this->config->item('alamat_instansi');
        $data['akses']=$this->session->userdata('akses');
        $this->load->view('webadmin/bg_atas',$data);
        $this->load->view('jabatanprofil/tbl_jabatanprofil_form', $data);
        $this->load->view('webadmin/bg_bawah',$data);
    }
    }
    
    public function create_action() 
    {
        $cek = $this->session->userdata('logged_in');
        $data['akses']=$this->session->userdata('akses');
        if(empty($cek))
        {
            header('location:'.base_url().'webadmin/loginpage'); exit;
        }
        else
        {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'jabatanprofil' => $this->input->post('jabatanprofil',TRUE),
	    );

            $this->Jabatanprofil_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('jabatanprofil'));
        }
        }
    }
    
    public function update($id = null) {
        $cek = $this->session->userdata('logged_in');
        $data['akses']=$this->session->userdata('akses');
        if(empty($cek))
        {
            header('location:'.base_url().'webadmin/loginpage'); exit;
        }
        else
        {
        $row = $this->Jabatanprofil_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('jabatanprofil/update_action'),
		'id_jabatanprofil' => set_value('id_jabatanprofil', $row->id_jabatanprofil),
		'jabatanprofil' => set_value('jabatanprofil', $row->jabatanprofil),
	    );
            $data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
            $data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
            $data['instansi'] = $this->config->item('nama_instansi');
            $data['credit'] = $this->config->item('credit_aplikasi');
            $data['alamat'] = $this->config->item('alamat_instansi');
            $data['akses']=$this->session->userdata('akses');
            $this->load->view('webadmin/bg_atas',$data);
            $this->load->view('jabatanprofil/tbl_jabatanprofil_form', $data);
            $this->load->view('webadmin/bg_bawah',$data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jabatanprofil'));
        }
        }
    }
    
    public function update_action() 
    {
        $cek = $this->session->userdata('logged_in');
        $data['akses']=$this->session->userdata('akses');
        if(empty($cek))
        {
            header('location:'.base_url().'webadmin/loginpage'); exit;
        }
        else
        {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_jabatanprofil', TRUE));
        } else {
            $data = array(
		'jabatanprofil' => $this->input->post('jabatanprofil',TRUE),
	    );

            $this->Jabatanprofil_model->update($this->input->post('id_jabatanprofil', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('jabatanprofil'));
        }
        }
    }
    
    public function delete($id = null) {
        $cek = $this->session->userdata('logged_in');
        $data['akses']=$this->session->userdata('akses');
        if(empty($cek))
        {
            header('location:'.base_url().'webadmin/loginpage'); exit;
        }
        else
        {
        $row = $this->Jabatanprofil_model->get_by_id($id);

        if ($row) {
            $this->Jabatanprofil_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('jabatanprofil'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jabatanprofil'));
        }
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('jabatanprofil', 'jabatanprofil', 'trim|required');

	$this->form_validation->set_rules('id_jabatanprofil', 'id_jabatanprofil', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Jabatanprofil.php */
/* Location: ./application/controllers/Jabatanprofil.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-24 21:10:18 */
/* http://harviacode.com */