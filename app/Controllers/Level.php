<?php

namespace App\Controllers;

use App\Core\CI_Controller;

#[\AllowDynamicProperties]
class Level extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (session_status() === PHP_SESSION_NONE) { session_start(); }
        $this->load->model('Level_model');
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
            $config['base_url'] = base_url() . 'level/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'level/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'level/index.html';
            $config['first_url'] = base_url() . 'level/index.html';
        }

        $config['per_page'] = 100;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Level_model->total_rows($q);
        $level = $this->Level_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'level_data' => $level,
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
        $this->load->view('level/tbl_level_list', $data);
        $this->load->view('webadmin/bg_bawah',$data);
    }}

    public function read($id = null) {
        $row = $this->Level_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_level' => $row->id_level,
		'level' => $row->level,
	    );
            $this->load->view('level/tbl_level_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('level'));
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
            'action' => site_url('level/create_action'),
	    'id_level' => set_value('id_level'),
	    'level' => set_value('level'),
	);
        $data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
        $data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
        $data['instansi'] = $this->config->item('nama_instansi');
        $data['credit'] = $this->config->item('credit_aplikasi');
        $data['alamat'] = $this->config->item('alamat_instansi');
        $data['akses']=$this->session->userdata('akses');
        $this->load->view('webadmin/bg_atas',$data);
        $this->load->view('level/tbl_level_form', $data);
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
		'level' => $this->input->post('level',TRUE),
	    );

            $this->Level_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('level'));
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
        $row = $this->Level_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('level/update_action'),
		'id_level' => set_value('id_level', $row->id_level),
		'level' => set_value('level', $row->level),
	    );
            $data['judul_lengkap'] = $this->config->item('nama_aplikasi_full');
            $data['judul_pendek'] = $this->config->item('nama_aplikasi_pendek');
            $data['instansi'] = $this->config->item('nama_instansi');
            $data['credit'] = $this->config->item('credit_aplikasi');
            $data['alamat'] = $this->config->item('alamat_instansi');
            $data['akses']=$this->session->userdata('akses');
            $this->load->view('webadmin/bg_atas',$data);
            $this->load->view('level/tbl_level_form', $data);
            $this->load->view('webadmin/bg_bawah',$data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('level'));
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
            $this->update($this->input->post('id_level', TRUE));
        } else {
            $data = array(
		'level' => $this->input->post('level',TRUE),
	    );

            $this->Level_model->update($this->input->post('id_level', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('level'));
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
        $row = $this->Level_model->get_by_id($id);

        if ($row) {
            $this->Level_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('level'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('level'));
        }
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('level', 'level', 'trim|required');

	$this->form_validation->set_rules('id_level', 'id_level', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Level.php */
/* Location: ./application/controllers/Level.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-02-01 03:45:09 */
/* http://harviacode.com */