<?php

namespace App\Controllers;

use App\Core\CI_Controller;

#[\AllowDynamicProperties]
class Pertanyaan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (session_status() === PHP_SESSION_NONE) { session_start(); }
        $this->load->model('Pertanyaan_model');
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
            $config['base_url'] = base_url() . 'pertanyaan/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'pertanyaan/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'pertanyaan/index.html';
            $config['first_url'] = base_url() . 'pertanyaan/index.html';
        }

        $config['per_page'] = 100;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Pertanyaan_model->total_rows($q);
        $pertanyaan = $this->Pertanyaan_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'pertanyaan_data' => $pertanyaan,
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
        $this->load->view('pertanyaan/tbl_pertanyaan_list', $data);
        $this->load->view('webadmin/bg_bawah',$data);
    }}

    public function read($id = null) {
        $row = $this->Pertanyaan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_pertanyaan' => $row->id_pertanyaan,
		'pertanyaan' => $row->pertanyaan,
	    );
            $this->load->view('pertanyaan/tbl_pertanyaan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pertanyaan'));
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
            'action' => site_url('pertanyaan/create_action'),
	    'id_pertanyaan' => set_value('id_pertanyaan'),
	    'pertanyaan' => set_value('pertanyaan'),
	);
        $data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
        $data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
        $data['instansi'] = $this->config->item('nama_instansi');
        $data['credit'] = $this->config->item('credit_aplikasi');
        $data['alamat'] = $this->config->item('alamat_instansi');
        $data['akses']=$this->session->userdata('akses');
        $this->load->view('webadmin/bg_atas',$data);
        $this->load->view('pertanyaan/tbl_pertanyaan_form', $data);
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
		'pertanyaan' => $this->input->post('pertanyaan',TRUE),
	    );

            $this->Pertanyaan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('pertanyaan'));
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
        $row = $this->Pertanyaan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('pertanyaan/update_action'),
		'id_pertanyaan' => set_value('id_pertanyaan', $row->id_pertanyaan),
		'pertanyaan' => set_value('pertanyaan', $row->pertanyaan),
	    );
            $data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
            $data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
            $data['instansi'] = $this->config->item('nama_instansi');
            $data['credit'] = $this->config->item('credit_aplikasi');
            $data['alamat'] = $this->config->item('alamat_instansi');
            $data['akses']=$this->session->userdata('akses');
            $this->load->view('webadmin/bg_atas',$data);
            $this->load->view('pertanyaan/tbl_pertanyaan_form', $data);
            $this->load->view('webadmin/bg_bawah',$data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pertanyaan'));
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
            $this->update($this->input->post('id_pertanyaan', TRUE));
        } else {
            $data = array(
		'pertanyaan' => $this->input->post('pertanyaan',TRUE),
	    );

            $this->Pertanyaan_model->update($this->input->post('id_pertanyaan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pertanyaan'));
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
        $row = $this->Pertanyaan_model->get_by_id($id);

        if ($row) {
            $this->Pertanyaan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pertanyaan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pertanyaan'));
        }
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('pertanyaan', 'pertanyaan', 'trim|required');

	$this->form_validation->set_rules('id_pertanyaan', 'id_pertanyaan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Pertanyaan.php */
/* Location: ./application/controllers/Pertanyaan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-24 13:23:27 */
/* http://harviacode.com */