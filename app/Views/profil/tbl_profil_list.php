
        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#"><?php echo $judul_lengkap.'  '.$instansi; ?></a></li>
                                    <li class="breadcrumb-item"><a href="#">Profil Pegawai</a></li>
                                   
                                </ol>
                            </div>
                            <h4 class="page-title">Profil Pegawai</h4>
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
        <table width="100%" class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th width="3%">No</th>
                <th width="9%">Foto</th>
		<th width="16%">Nama Lengkap</th>
		<th width="13%">Tempat Lahir</th>
		<th width="11%">Pangkat/Gol</th>
		<th width="7%">Tingkatan</th>
		<th width="7%">Level</th>
		<th width="7%">Jabatan</th>
		<th width="8%">Unit Kerja</th>
				<th width="8%">Detail Profil</th>
		</tr><?php 
$no = $page+1;
foreach($daftarartikel->result_array() as $profil){ ?>
                <tr>
			<td><?php echo $no; ?></td>
			<td><img style="width:75px;" src="<?php echo base_url(); ?>asset/profil/<?php echo $profil['foto']; ?>"/> </td>
			<td><?php echo $profil['nama_lengkap']; ?><br><br>
 <?php 
                echo anchor(site_url('profil/update/'.$profil['id_profil']),'<i class="fa fa-pencil"></i>','class="btn btn-sm btn-success"'); 
                echo '  '; 
                echo anchor(site_url('profil/delete/'.$profil['id_profil']),'<i class="fa fa-trash"></i>','class="btn btn-sm btn-danger"','onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
                echo '  ';
                echo anchor(site_url('profil/read/'.$profil['id_profil']),'<i class="fa fa-search"></i>','class="btn btn-sm btn-warning"'); 
                echo '  ';
                ?>
            </td>
			<td><?php echo $profil['tempat_lahir']; ?> / <?php echo tgl_indo2($profil['tanggal_lahir']); ?></td>
			<td><?php echo $profil['pangkat']; ?> / <?php echo $profil['golongan']; ?></td>
			<td><?php echo $profil['tingkatan']; ?></td>
			<td><?php echo $profil['level']; ?></td>
			<td><?php echo $profil['jabatanprofil']; ?></td>
			<td><?php echo $profil['skpd']; ?></td>
			<td> <div class="btn-group" role="group" aria-label="Button group with nested dropdown">

  <div class="btn-group" role="group">
    <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Tambah
    </button>
    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
      <a class="dropdown-item" href="<?php echo base_url(); ?>profil/keluarga/<?php echo $profil['id_profil']; ?>">Keluarga</a>
      <a class="dropdown-item" href="<?php echo base_url(); ?>profil/pendidikan/<?php echo $profil['id_profil']; ?>">Pendidikan</a>
      <a class="dropdown-item" href="<?php echo base_url(); ?>profil/pekerjaan/<?php echo $profil['id_profil']; ?>">Pekerjaan</a>

        <a class="dropdown-item" href="<?php echo base_url(); ?>profil/fotoku/<?php echo $profil['id_profil']; ?>">Foto Profil</a>
    </div>
  </div>
</div>

               
            </td>
			</tr>
              <?php 
	$no++;
 }
  
?>
        </table>
        
	   
            
            <?php
		echo $paginator;
		?>
      </div>
            </div>
          </div>
        </div>
      </div> 
    </div>
    </div>
  
   