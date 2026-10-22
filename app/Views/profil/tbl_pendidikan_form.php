
        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#"><?php echo $judul_lengkap.'  '.$instansi; ?></a></li>
                                    <li class="breadcrumb-item"><a href="#">Tambah Riwayat Pendidikan</a></li>
                                   
                                </ol>
                            </div>
                            <h4 class="page-title">Tambah Riwayat Pendidikan</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
    <div class="btn-toolbar" style="margin-bottom:20px;">
            <a class="btn btn-success" href="<?php echo base_url(); ?>profil/create"> Tambah Data</a>&nbsp;
        <a class="btn btn-danger" href="<?php echo base_url(); ?>profil">Refresh</a>
            </div> <div class="table-responsive5"> 
 <!-- Nav tabs -->
<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#home">Tambah Data</a>
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
        <a href="<?php echo site_url('profil') ?>" class="btn btn-default">Cancel</a>
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
                echo anchor(site_url('profil/updatependidikan/'.$pendidikan['id_pendidikan'].'/'.$pendidikan['id_profil']),'<i class="fa fa-pencil"></i>','class="btn btn-sm btn-success"'); 
                echo '  '; 
                echo anchor(site_url('profil/deletependidikan/'.$pendidikan['id_pendidikan'].'/'.$pendidikan['id_profil']),'<i class="fa fa-trash"></i>','class="btn btn-sm btn-danger"','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
    </div>
   