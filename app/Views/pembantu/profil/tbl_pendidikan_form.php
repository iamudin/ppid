 <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="header-icon"><i class="pe-7s-door-lock"></i></div>
                    <div class="header-title">
                        <h1>Tambah Riwayat Pendidikan</h1>
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
                                    <div class="table-responsivex">
 <!-- Nav tabs -->
<ul class="nav nav-tabs">
  <li class="nav-item active">
    <a class="nav-link" data-toggle="tab" href="#home">Tambah Data</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#menu1">Riwayat Pendidikan</a>
  </li>

</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane active" id="home">
<br>

    <form action="<?php echo $action; ?>" method="post">
        
            <input type="hidden" class="form-control" name="id_profil" id="id_profil" placeholder="Id Profil" value="<?php echo $id_profil; ?>" />
      
        <div class="form-group">
            <label for="int">Jenjang Pendidikan <?php echo form_error('id_jenjang') ?></label>
           
             <select name="id_jenjang" class="input form-control" id="id_jenjang">
  <?php
foreach($jenjang->result_array() as $k)
{
if($k['id_jenjang']==$id_jenjang)
{
echo"<option value='".$k['id_jenjang']."' selected='selected'>".$k['jenjang']."</option>";
}
else{
echo"<option value='".$k['id_jenjang']."'>".$k['jenjang']."</option>";
}
}
?>
  </select>

        </div>
        <div class="form-group">
            <label for="varchar">Nama Sekolah/Universitas <?php echo form_error('nama') ?></label>
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Jurusan <?php echo form_error('jurusan') ?></label>
            <input type="text" class="form-control" name="jurusan" id="jurusan" placeholder="Jurusan" value="<?php echo $jurusan; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Tempat <?php echo form_error('tempat') ?></label>
            <input type="text" class="form-control" name="tempat" id="tempat" placeholder="Tempat" value="<?php echo $tempat; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Tahun Pendidikan <?php echo form_error('tahun_pendidikan') ?></label>
            <input type="text" class="form-control" name="tahun_pendidikan" id="tahun_pendidikan" placeholder="Tahun Pendidikan" value="<?php echo $tahun_pendidikan; ?>" />
        </div>
        <input type="hidden" name="id_pendidikan" value="<?php echo $id_pendidikan; ?>" /> 
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
        <a href="<?php echo site_url('pembantu/profil') ?>" class="btn btn-default">Cancel</a>
    </form></div>
  <div class="tab-pane fade" id="menu1"><br>
<table width="100%" class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th width="2%">No</th>
        <th width="13%">Jenjang</th>
        <th width="34%">Nama Sekolah/Universitas</th>
        <th width="11%">Jurusan</th>
        <th width="10%">Tempat</th>
        <th width="16%">Tahun Pendidikan</th>
        <th width="14%">Aksi</th>
            </tr><?php
             $no=1;
            foreach ($status_pegawai->result_array() as $pendidikan)
            {
                ?>
                <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $pendidikan['jenjang']; ?></td>
            <td><?php echo $pendidikan['nama']; ?></td>
            <td><?php echo $pendidikan['jurusan']; ?></td>
            <td><?php echo $pendidikan['tempat']; ?></td>
            <td><?php echo $pendidikan['tahun_pendidikan']; ?></td>
            <td>
                <?php 
                echo anchor(site_url('pembantu/updatependidikan/'.$pendidikan['id_pendidikan'].'/'.$pendidikan['id_profil']),'<i class="fa fa-pencil"></i>','class="btn btn-sm btn-success"'); 
                echo '  '; 
                echo anchor(site_url('pembantu/deletependidikan/'.$pendidikan['id_pendidikan'].'/'.$pendidikan['id_profil']),'<i class="fa fa-trash"></i>','class="btn btn-sm btn-danger"','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
                ?>
            </td>
        </tr>
               <?php
            $no++;}
            ?>
        </table>
  </div>
</div>
        
 </div>
            </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </section> <!-- /.content -->
            </div> <!-- /.content-wrapper -->
            
   