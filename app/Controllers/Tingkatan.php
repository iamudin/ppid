<?php

namespace App\Controllers;

use App\Core\CI_Controller;

#[\AllowDynamicProperties]
class Tingkatan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (session_status() === PHP_SESSION_NONE) { session_start(); }
        $this->load->model('Tingkatan_model');
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
            $config['base_url'] = base_url() . 'tingkatan/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'tingkatan/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'tingkatan/index.html';
            $config['first_url'] = base_url() . 'tingkatan/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Tingkatan_model->total_rows($q);
        $tingkatan = $this->Tingkatan_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'tingkatan_data' => $tingkatan,
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
        $this->load->view('tingkatan/tbl_tingkatan_list', $data);
        $this->load->view('webadmin/bg_bawah',$data);
    }}

    public function read($id = null) {
        $row = $this->Tingkatan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_tingkatan' => $row->id_tingkatan,
		'tingkatan' => $row->tingkatan,
	    );
            $this->load->view('tingkatan/tbl_tingkatan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tingkatan'));
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
            'button' => 'Create',
            'action' => site_url('tingkatan/create_action'),
	    'id_tingkatan' => set_value('id_tingkatan'),
	    'tingkatan' => set_value('tingkatan'),
	);
        $data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
        $data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
        $data['instansi'] = $this->config->item('nama_instansi');
        $data['credit'] = $this->config->item('credit_aplikasi');
        $data['alamat'] = $this->config->item('alamat_instansi');
        $data['akses']=$this->session->userdata('akses');
        $this->load->view('webadmin/bg_atas',$data);
        $this->load->view('tingkatan/tbl_tingkatan_form', $data);
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
		'tingkatan' => $this->input->post('tingkatan',TRUE),
	    );

            $this->Tingkatan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('tingkatan'));
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
        $row = $this->Tingkatan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tingkatan/update_action'),
		'id_tingkatan' => set_value('id_tingkatan', $row->id_tingkatan),
		'tingkatan' => set_value('tingkatan', $row->tingkatan),
	    );
            $data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
            $data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
            $data['instansi'] = $this->config->item('nama_instansi');
            $data['credit'] = $this->config->item('credit_aplikasi');
            $data['alamat'] = $this->config->item('alamat_instansi');
            $data['akses']=$this->session->userdata('akses');
            $this->load->view('webadmin/bg_atas',$data);
            $this->load->view('tingkatan/tbl_tingkatan_form', $data);
            $this->load->view('webadmin/bg_bawah',$data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tingkatan'));
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
            $this->update($this->input->post('id_tingkatan', TRUE));
        } else {
            $data = array(
		'tingkatan' => $this->input->post('tingkatan',TRUE),
	    );

            $this->Tingkatan_model->update($this->input->post('id_tingkatan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tingkatan'));
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
        $row = $this->Tingkatan_model->get_by_id($id);

        if ($row) {
            $this->Tingkatan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tingkatan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tingkatan'));
        }
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('tingkatan', 'tingkatan', 'trim|required');

	$this->form_validation->set_rules('id_tingkatan', 'id_tingkatan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Tingkatan.php */
/* Location: ./application/controllers/Tingkatan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-02-01 03:22:34 */
/* http://harviacode.com */