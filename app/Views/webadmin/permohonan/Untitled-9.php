<?php
function updatefinalberkas() 
	{
		//$data["page"] = $page;
		$cek = $this->session->userdata('logged_in');
		$data['akses']=$this->session->userdata('akses');
		if(empty($cek))
		{
			header('location:'.base_url().'webadmin/loginpage');
		}
		else
		{
				$tgl = " %Y-%m-%d";
				$jam = "%h:%i:%a";
				$time = time();
			
				$in["id_pemohon"]=$this->input->post('id');
				$in["id_jk"]=$this->input->post('kategori');
			
				$acak=rand(00000000000,99999999999);
				$bersih=$_FILES['userfile']['name'];
				$nm=str_replace(" ","_","$bersih");
				$pisah=explode(".",$nm);
				$nama_murni=$pisah[0];
				$ubah=$acak.$nama_murni; //tanpa ekstensi
				$config["file_name"]=$ubah; //dengan eekstensi
				$in["berkas"]=$acak.$nm;
			
				$config['upload_path'] = './media/ktp/';
				$config['allowed_types'] = 'gif|jpg|jpeg|png';
				$config['max_size'] = '500000';
				$config['max_width'] = '12000';
				$config['max_height'] = '12000';						
				$this->load->library('upload', $config);
				$idx=$this->input->post('id');
			
				if(!$this->upload->do_upload())
				{
				 echo $this->upload->display_errors();
				}
				else {
				$this->session->set_flashdata('message', 'Data Tersimpan!');
				$this->Webadmin_model->In_Polling("tbl_kelengkapan",$in);
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."webadmin/prosespermohonan/$idx'>";
				}

			}
			
	}

function hapusdokumenku()
	{
		$id='';
		if ($this->uri->segment(3) === FALSE)
		{
    			$id=$id;
		}
		else
		{
    			$id = $this->uri->segment(3);
		}
		//$data["page"] = $page;
		$idx=$id = $this->uri->segment(4);
		$cek = $this->session->userdata('logged_in');
		$data['akses']=$this->session->userdata('akses');
		if(empty($cek))
		{
			header('location:'.base_url().'webadmin/loginpage');
		}
		else
		{
			$this->session->set_flashdata('message', 'Data Terhapus!');
			$this->Webadmin_model->Delete_Content($id,"id_kelengkapan","tbl_kelengkapan");
	   		echo "<meta http-equiv='refresh' content='0; url=".base_url()."webadmin/prosespermohonan/$idx'>";
			}
			
	}