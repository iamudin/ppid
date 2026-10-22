
        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#"><?php echo $judul_lengkap.'  '.$instansi; ?></a></li>
                                    <li class="breadcrumb-item"><a href="#">Tambah Data Kelurga</a></li>
                                   
                                </ol>
                            </div>
                            <h4 class="page-title">Tambah Data Kelurga</h4>
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
    <a class="nav-link active" data-toggle="tab" href="#home">Pasangan</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#menu1">Anak</a>
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
        <a href="<?php echo site_url('profil') ?>" class="btn btn-default">Cancel</a>
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
                echo anchor(site_url('profil/update_anak/'.$anak['id_anak']),'<i class="fa fa-pencil"></i>','class="btn btn-sm btn-success"'); 
                echo '  '; 
                echo anchor(site_url('profil/delete_anak/'.$anak['id_anak'].'/'.$anak['id_profil']),'<i class="fa fa-trash"></i>','class="btn btn-sm btn-danger"','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
   