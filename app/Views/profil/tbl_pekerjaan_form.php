
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
                            <h4 class="page-title">Tambah Riwayat Pekerjaan</h4>
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
    <a class="nav-link" data-toggle="tab" href="#menu1">Riwayat Pekerjaan</a>
  </li>

</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane active" id="home">
<br>

   <form action="<?php echo $action; ?>" method="post">
       
            
            <input type="hidden" class="form-control" name="id_profil" id="id_profil" placeholder="Id Profil" value="<?php echo $id_profil; ?>" />
        
        <div class="form-group">
            <label for="varchar">Jabatan <?php echo form_error('id_jabatanprofil') ?></label>
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
        <div class="form-group">
            <label for="varchar">Periode <?php echo form_error('periode') ?></label>
            <input type="text" class="form-control" name="periode" id="periode" placeholder="Periode" value="<?php echo $periode; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Unit Kerja <?php echo form_error('unit_kerja') ?></label>
            <select name="unit_kerja" class="input form-control" id="unit_kerja">
  <?php
foreach($skpd->result_array() as $k)
{
if($k['id_skpd']==$unit_kerja)
{
echo"<option value='".$k['id_skpd']."' selected='selected'>".$k['skpd']."</option>";
}
else{
echo"<option value='".$k['id_skpd']."'>".$k['skpd']."</option>";
}
}
?>
  </select>
        </div>
        <input type="hidden" name="id_pekerjaanprofil" value="<?php echo $id_pekerjaanprofil; ?>" /> 
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
        <a href="<?php echo site_url('profil') ?>" class="btn btn-default">Cancel</a>
    </form></div>
  <div class="tab-pane fade" id="menu1"><br>

<table width="100%" class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th width="2%">No</th>
     
        <th width="30%">Jabatan</th>
        <th width="23%">Periode</th>
        <th width="28%">Unit Kerja</th>
        <th width="17%">Aksi</th>
            </tr><?php
             $no=1;
            foreach ($status_pegawai->result_array() as $pekerjaanprofil)
            {
                ?>
                <tr>
            <td><?php echo $no; ?></td>
           
            <td><?php echo $pekerjaanprofil['jabatanprofil']; ?></td>
            <td><?php echo $pekerjaanprofil['periode']; ?></td>
            <td><?php echo $pekerjaanprofil['skpd']; ?></td>
            <td style="text-align:center">
                <?php 
                echo anchor(site_url('profil/updatepekerjaan/'.$pekerjaanprofil['id_pekerjaanprofil'].'/'.$pekerjaanprofil['id_profil']),'<i class="fa fa-pencil"></i>','class="btn btn-sm btn-success"'); 
                echo '  '; 
                echo anchor(site_url('profil/deletepekerjaan/'.$pekerjaanprofil['id_pekerjaanprofil'].'/'.$pekerjaanprofil['id_profil']),'<i class="fa fa-trash"></i>','class="btn btn-sm btn-danger"','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
   