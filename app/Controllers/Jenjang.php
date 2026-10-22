<?php

namespace App\Controllers;

use App\Core\CI_Controller;

#[\AllowDynamicProperties]
class Jenjang extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (session_status() === PHP_SESSION_NONE) { session_start(); }
        $this->load->model('Jenjang_model');
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
            $config['base_url'] = base_url() . 'jenjang/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'jenjang/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'jenjang/index.html';
            $config['first_url'] = base_url() . 'jenjang/index.html';
        }

        $config['per_page'] = 100;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Jenjang_model->total_rows($q);
        $jenjang = $this->Jenjang_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'jenjang_data' => $jenjang,
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
        $this->load->view('jenjang/tbl_jenjang_list', $data);
        $this->load->view('webadmin/bg_bawah',$data);
    }}

    public function read($id = null) {
        $row = $this->Jenjang_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_jenjang' => $row->id_jenjang,
		'jenjang' => $row->jenjang,
	    );
            $this->load->view('jenjang/tbl_jenjang_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jenjang'));
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
            'action' => site_url('jenjang/create_action'),
	    'id_jenjang' => set_value('id_jenjang'),
	    'jenjang' => set_value('jenjang'),
	);
        $data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
        $data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
        $data['instansi'] = $this->config->item('nama_instansi');
        $data['credit'] = $this->config->item('credit_aplikasi');
        $data['alamat'] = $this->config->item('alamat_instansi');
        $data['akses']=$this->session->userdata('akses');
        $this->load->view('webadmin/bg_atas',$data);
        $this->load->view('jenjang/tbl_jenjang_form', $data);
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
		'jenjang' => $this->input->post('jenjang',TRUE),
	    );

            $this->Jenjang_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('jenjang'));
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
        $row = $this->Jenjang_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('jenjang/update_action'),
		'id_jenjang' => set_value('id_jenjang', $row->id_jenjang),
		'jenjang' => set_value('jenjang', $row->jenjang),
	    );
            $data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
            $data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
            $data['instansi'] = $this->config->item('nama_instansi');
            $data['credit'] = $this->config->item('credit_aplikasi');
            $data['alamat'] = $this->config->item('alamat_instansi');
            $data['akses']=$this->session->userdata('akses');
            $this->load->view('webadmin/bg_atas',$data);
            $this->load->view('jenjang/tbl_jenjang_form', $data);
            $this->load->view('webadmin/bg_bawah',$data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jenjang'));
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
            $this->update($this->input->post('id_jenjang', TRUE));
        } else {
            $data = array(
		'jenjang' => $this->input->post('jenjang',TRUE),
	    );

            $this->Jenjang_model->update($this->input->post('id_jenjang', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('jenjang'));
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
        $row = $this->Jenjang_model->get_by_id($id);

        if ($row) {
            $this->Jenjang_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('jenjang'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jenjang'));
        }
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('jenjang', 'jenjang', 'trim|required');

	$this->form_validation->set_rules('id_jenjang', 'id_jenjang', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Jenjang.php */
/* Location: ./application/controllers/Jenjang.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-25 04:29:28 */
/* http://harviacode.com */