<?php

namespace App\Controllers;

use App\Core\CI_Controller;

#[\AllowDynamicProperties]
class Jenistransparansi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (session_status() === PHP_SESSION_NONE) { session_start(); }
        $this->load->model('Jenistransparansi_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $cek = $this->session->userdata('logged_in');
        $data['akses']=$this->session->userdata('akses');
        if(empty($cek))
        {
            header('location:'.base_url().'webadmin/loginpage');
        }
        else
        {

        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'jenistransparansi/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'jenistransparansi/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'jenistransparansi/index.html';
            $config['first_url'] = base_url() . 'jenistransparansi/index.html';
        }

        $config['per_page'] = 100;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Jenistransparansi_model->total_rows($q);
        $jenistransparansi = $this->Jenistransparansi_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'jenistransparansi_data' => $jenistransparansi,
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
        $this->load->view('jenistransparansi/tbl_jenistransparansi_list', $data);
        $this->load->view('webadmin/bg_bawah',$data);
    }}

    public function read($id = null) {
        $row = $this->Jenistransparansi_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_jenistransparansi' => $row->id_jenistransparansi,
		'jenistransparansi' => $row->jenistransparansi,
	    );
            $this->load->view('jenistransparansi/tbl_jenistransparansi_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jenistransparansi'));
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
            'action' => site_url('jenistransparansi/create_action'),
	    'id_jenistransparansi' => set_value('id_jenistransparansi'),
	    'jenistransparansi' => set_value('jenistransparansi'),
	);
        $data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
        $data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
        $data['instansi'] = $this->config->item('nama_instansi');
        $data['credit'] = $this->config->item('credit_aplikasi');
        $data['alamat'] = $this->config->item('alamat_instansi');
        $data['akses']=$this->session->userdata('akses');
        $this->load->view('webadmin/bg_atas',$data);
        $this->load->view('jenistransparansi/tbl_jenistransparansi_form', $data);
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
            $data = array(
		'jenistransparansi' => $this->input->post('jenistransparansi',TRUE),
	    );

            $this->Jenistransparansi_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('jenistransparansi'));
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
        $row = $this->Jenistransparansi_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('jenistransparansi/update_action'),
		'id_jenistransparansi' => set_value('id_jenistransparansi', $row->id_jenistransparansi),
		'jenistransparansi' => set_value('jenistransparansi', $row->jenistransparansi),
	    );
            $data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
            $data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
            $data['instansi'] = $this->config->item('nama_instansi');
            $data['credit'] = $this->config->item('credit_aplikasi');
            $data['alamat'] = $this->config->item('alamat_instansi');
            $data['akses']=$this->session->userdata('akses');
            $this->load->view('webadmin/bg_atas',$data);
            $this->load->view('jenistransparansi/tbl_jenistransparansi_form', $data);
            $this->load->view('webadmin/bg_bawah',$data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jenistransparansi'));
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
            $this->update($this->input->post('id_jenistransparansi', TRUE));
        } else {
            $data = array(
		'jenistransparansi' => $this->input->post('jenistransparansi',TRUE),
	    );

            $this->Jenistransparansi_model->update($this->input->post('id_jenistransparansi', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('jenistransparansi'));
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
        $row = $this->Jenistransparansi_model->get_by_id($id);

        if ($row) {
            $this->Jenistransparansi_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('jenistransparansi'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jenistransparansi'));
        }
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('jenistransparansi', 'jenistransparansi', 'trim|required');

	$this->form_validation->set_rules('id_jenistransparansi', 'id_jenistransparansi', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Jenistransparansi.php */
/* Location: ./application/controllers/Jenistransparansi.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-24 13:22:53 */
/* http://harviacode.com */