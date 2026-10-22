 <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="header-icon"><i class="pe-7s-door-lock"></i></div>
                    <div class="header-title">
                        <h1>Tambah Data Keluarga</h1>
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
  <li class="active">
    <a data-toggle="tab" href="#home">Pasangan</a>
  </li>
  <li>
    <a data-toggle="tab" href="#menu1">Anak</a>
  </li>

</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane active" id="home">
<br>

    <form enctype="multipart/form-data" action="<?php echo $action; ?>" method="post">
         <input type="hidden" class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap" value="<?php echo $nama_lengkap; ?>" />
       
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

        
        <input type="hidden" name="id_profil" value="<?php echo $id_profil; ?>" /> 
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
        <a href="<?php echo site_url('pembantu/profil') ?>" class="btn btn-default">Cancel</a>
    </form></div>
  <div class="tab-pane fade" id="menu1"><br>

     <form action="<?php echo $action2; ?>" method="post">
      
        <div class="form-group">
            <label for="varchar">Nama Anak <?php echo form_error('nama_anak') ?></label>
            <input type="text" class="form-control" name="nama_anak" id="nama_anak" placeholder="Nama Anak"/>
        </div>
        <div class="form-group">
            <label for="int">Jk <?php echo form_error('id_jk') ?></label>
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
            <input type="text" class="form-control" name="pendidikan" id="pendidikan" placeholder="Pendidikan" />
        </div>
        <input type="hidden" name="id_anak" value="<?php echo $id_anak; ?>" /> 
        <input type="hidden" name="id_profil" value="<?php echo $id_profil; ?>" /> 
        <button type="submit" class="btn btn-primary">Simpan</button> 
       
    </form><br>
<table width="100%" class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th width="2%">No</th>
        <th width="31%">Nama Anak</th>
        <th width="31%">Jenis Kelamin</th>
        <th width="23%">Pendidikan</th>
        <th width="13%">Aksi</th>
            </tr><?php
             $no=1;
            foreach ($status_pegawai->result_array() as $anak)
            {
                ?>
                <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $anak['nama_anak']; ?></td>
            <td><?php echo $anak['kelamin']; ?></td>
            <td><?php echo $anak['pendidikan']; ?></td>
            <td style="text-align:center">
                <?php 
                echo anchor(site_url('pembantu/update_anak/'.$anak['id_anak']),'<i class="fa fa-pencil"></i>','class="btn btn-sm btn-success"'); 
                echo '  '; 
                echo anchor(site_url('pembantu/delete_anak/'.$anak['id_anak'].'/'.$anak['id_profil']),'<i class="fa fa-trash"></i>','class="btn btn-sm btn-danger"','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
            
   