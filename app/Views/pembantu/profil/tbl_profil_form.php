 <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="header-icon"><i class="pe-7s-door-lock"></i></div>
                    <div class="header-title">
                        <h1>Profil Pegawai</h1>
                        <small><?php echo $this->config->item("nama_aplikasi_full"); ?></small>
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url(); ?>app_admin_home"><i class="pe-7s-home"></i> Home</a></li>
                            
                            <li class="active">Welcome</li>
                        </ol>
                    </div>
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-bd lobidrag">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4>Master Data</h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                   	<div class="btn-toolbar" style="margin-bottom:20px;">
	<a class="btn btn-success" href="<?php echo base_url(); ?>pembantu/tambahprofil"> Tambah Data</a>
        <a class="btn btn-default" href="<?php echo base_url(); ?>pembantu/profil">Refresh</a>
			</div>
                                    <div class="table-responsive">

        <form enctype="multipart/form-data" action="<?php echo $action; ?>" method="post">
	    <div class="form-group" style="display: none;">
            <label for="varchar">Identitas Diri <?php echo form_error('identitas_diri') ?></label>
            <input type="text" class="form-control" name="identitas_diri" id="identitas_diri" placeholder="Identitas Diri" value="<?php echo $identitas_diri; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nama Lengkap <?php echo form_error('nama_lengkap') ?></label>
            <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap" value="<?php echo $nama_lengkap; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Tempat Lahir <?php echo form_error('tempat_lahir') ?></label>
            <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" placeholder="Tempat Lahir" value="<?php echo $tempat_lahir; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Tanggal Lahir <?php echo form_error('tanggal_lahir') ?></label>
            <input autocomplete="off" type="text" class="form-control datepicker2" name="tanggal_lahir" id="tanggal_lahir" placeholder="Tanggal Lahir" value="<?php echo $tanggal_lahir; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Alamat <?php echo form_error('alamatku') ?></label>
            <input type="text" class="form-control" name="alamatku" id="alamatku" placeholder="Alamat" value="<?php echo $alamatku; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Agama <?php echo form_error('id_agama') ?></label>
           

        <select name="id_agama" class="input form-control" id="id_agama">
  <?php
foreach($agama->result_array() as $k)
{
if($k['id_agama']==$id_agama)
{
echo"<option value='".$k['id_agama']."' selected='selected'>".$k['agama']."</option>";
}
else{
echo"<option value='".$k['id_agama']."'>".$k['agama']."</option>";
}
}
?>
  </select>

        </div>
	    <div class="form-group">
            <label for="varchar">Telepon/Hp <?php echo form_error('hp') ?></label>
            <input type="text" class="form-control" name="hp" id="hp" placeholder="Hp" value="<?php echo $hp; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Alamat Surel <?php echo form_error('alamat_surel') ?></label>
            <input type="text" class="form-control" name="alamat_surel" id="alamat_surel" placeholder="Alamat Surel" value="<?php echo $alamat_surel; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Alamat Kantor <?php echo form_error('alamat_kantor') ?></label>
            <input type="text" class="form-control" name="alamat_kantor" id="alamat_kantor" placeholder="Alamat Kantor" value="<?php echo $alamat_kantor; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Status Pernikahan <?php echo form_error('id_menikah') ?></label>
           
            <select name="id_menikah" class="input form-control" id="id_menikah">
  <?php
foreach($menikah->result_array() as $k)
{
if($k['id_menikah']==$id_agama)
{
echo"<option value='".$k['id_menikah']."' selected='selected'>".$k['menikah']."</option>";
}
else{
echo"<option value='".$k['id_menikah']."'>".$k['menikah']."</option>";
}
}
?>
  </select>

        </div>
	    <div class="form-group">
            <label for="varchar">NIP <?php echo form_error('nip') ?></label>
            <input type="text" class="form-control" name="nip" id="nip" placeholder="Nip" value="<?php echo $nip; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Pangkat <?php echo form_error('id_pangkat') ?></label>
           
            <select name="id_pangkat" class="input form-control" id="id_pangkats">
  <?php
foreach($pangkat->result_array() as $k)
{
if($k['id_pangkat']==$id_pangkat)
{
echo"<option value='".$k['id_pangkat']."' selected='selected'>".$k['pangkat']."</option>";
}
else{
echo"<option value='".$k['id_pangkat']."'>".$k['pangkat']."</option>";
}
}
?>
  </select>

        </div>
	    <div class="form-group">
            <label for="int">Golongan <?php echo form_error('id_golongan') ?></label>
          

            <select name="id_golongan" class="input form-control" id="id_golongan">
  <?php
foreach($golongan->result_array() as $k)
{
if($k['id_golongan']==$id_golongan)
{
echo"<option value='".$k['id_golongan']."' selected='selected'>".$k['golongan']."</option>";
}
else{
echo"<option value='".$k['id_golongan']."'>".$k['golongan']."</option>";
}
}
?>
  </select>

        </div>

         <div class="form-group">
            <label for="int">Tingkat Jabatan  <?php echo form_error('id_tingkatan') ?></label>
           

             <select name="id_tingkatan" class="input form-control" id="id_tingkatan">
  <?php
foreach($tingkat->result_array() as $k)
{
if($k['id_tingkatan']==$id_tingkatan)
{
echo"<option value='".$k['id_tingkatan']."' selected='selected'>".$k['tingkatan']."</option>";
}
else{
echo"<option value='".$k['id_tingkatan']."'>".$k['tingkatan']."</option>";
}
}
?>
  </select>

        </div>
         <div class="form-group">
            <label for="int">Level Jabatan  <?php echo form_error('id_level') ?></label>
           

             <select name="id_level" class="input form-control" id="id_level">
  <?php
foreach($level->result_array() as $k)
{
if($k['id_level']==$id_level)
{
echo"<option value='".$k['id_level']."' selected='selected'>".$k['level']."</option>";
}
else{
echo"<option value='".$k['id_level']."'>".$k['level']."</option>";
}
}
?>
  </select>

        </div>
	    <div class="form-group">
            <label for="int">Jabatan Sekarang <?php echo form_error('id_jabatanprofil') ?></label>
           

             <select name="id_jabatanprofil" class="input form-control" id="id_jabatanprofil">
  <?php
foreach($jabatan->result_array() as $k)
{
if($k['id_jabatanprofil']==$id_jabatanprofil)
{
echo"<option value='".$k['id_jabatanprofil']."' selected='selected'>".$k['jabatanprofil']."</option>";
}
else{
echo"<option value='".$k['id_jabatanprofil']."'>".$k['jabatanprofil']."</option>";
}
}
?>
  </select>

        </div>
        <input type="hidden" name="unit_kerja" value="<?php echo $this->session->userdata('skpd_ppid');?>">
	    <div class="form-group">
            <label for="varchar">Hobi <?php echo form_error('hobi') ?></label>
            <input type="text" class="form-control" name="hobi" id="hobi" placeholder="Hobi" value="<?php echo $hobi; ?>" />
        </div>
        <hr>
        <div style="display: none;">
	    <div class="form-group">
            <label for="int">Nama Pasangan <?php echo form_error('nama_pasangan') ?></label>
            <input type="text" class="form-control" name="nama_pasangan" id="nama_pasangan" placeholder="Nama Pasangan" value="<?php echo $nama_pasangan; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Jenis Kelamin <?php echo form_error('id_jk') ?></label>
        

            <select name="id_jk" class="input form-control" id="id_jk">
  <?php
foreach($jk->result_array() as $k)
{
if($k['id_kelamin']==$id_jk)
{
echo"<option value='".$k['id_kelamin']."' selected='selected'>".$k['kelamin']."</option>";
}
else{
echo"<option value='".$k['id_kelamin']."'>".$k['kelamin']."</option>";
}
}
?>
  </select>

        </div>
	    <div class="form-group">
            <label for="varchar">Pendidikan <?php echo form_error('pendidikan') ?></label>
            <input type="text" class="form-control" name="pendidikan" id="pendidikan" placeholder="Pendidikan" value="<?php echo $pendidikan; ?>" />
        </div>
</div>
        <hr>

	    <div class="form-group">
            <label for="varchar">Foto <?php echo form_error('foto') ?></label>
           

             <input class="form-control" type="file" name="userfile" size="40"/>

        </div>
	   
	    <input type="hidden" name="id_profil" value="<?php echo $id_profil; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('pembantu/profil') ?>" class="btn btn-default">Cancel</a>
	</form>
 </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </section> <!-- /.content -->
            </div> <!-- /.content-wrapper -->
            