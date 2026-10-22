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
                                    <div class="table-responsivex">
                                        <table width="100%" class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th width="2%">No</th>
                <th width="5%">Foto</th>
		<th width="16%">Nama Lengkap</th>
		<th width="15%">Tempat Lahir</th>
		<th width="13%">Pangkat/Gol</th>
		<th width="12%">Tingkatan</th>
		<th width="9%">Level</th>
		<th width="7%">Jabatan</th>
		<th width="21%">Detail Profil</th>
		</tr><?php 
$no = $page+1;
foreach($daftarartikel->result_array() as $profil){ ?>
                <tr>
			<td><?php echo $no; ?></td>
			<td><img style="width:75px;" src="<?php echo base_url(); ?>asset/profil/<?php echo $profil['foto']; ?>"/> </td>
			<td><?php echo $profil['nama_lengkap']; ?><br><br>
 <?php 
                echo anchor(site_url('pembantu/update/'.$profil['id_profil']),'<i class="fa fa-pencil"></i>','class="btn btn-sm btn-success"'); 
                echo '  '; 
                echo anchor(site_url('pembantu/delete/'.$profil['id_profil']),'<i class="fa fa-trash"></i>','class="btn btn-sm btn-danger"','onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
                echo '  ';
                echo anchor(site_url('pembantu/read/'.$profil['id_profil']),'<i class="fa fa-search"></i>','class="btn btn-sm btn-warning"'); 
                echo '  ';
                ?>
            </td>
			<td><?php echo $profil['tempat_lahir']; ?> / <?php echo tgl_indo2($profil['tanggal_lahir']); ?></td>
			<td><?php echo $profil['pangkat']; ?> / <?php echo $profil['golongan']; ?></td>
			<td><?php echo $profil['tingkatan']; ?></td>
			<td><?php echo $profil['level']; ?></td>
			<td><?php echo $profil['jabatanprofil']; ?></td>
			<td>
  <div class="btn-group">
    <button type="button" class="btn btn-primary">Tambah</button>
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
      <span class="caret"></span>
      </button>
    <ul class="dropdown-menu" role="menu">
      <li><a class="dropdown-item" href="<?php echo base_url(); ?>pembantu/keluarga/<?php echo $profil['id_profil']; ?>">Keluarga</a></li>
      <li>
        <a href="<?php echo base_url(); ?>pembantu/pendidikan/<?php echo $profil['id_profil']; ?>">Pendidikan</a></li><li>
          <a href="<?php echo base_url(); ?>pembantu/pekerjaan/<?php echo $profil['id_profil']; ?>">Pekerjaan</a></li><li>
            
            <a href="<?php echo base_url(); ?>pembantu/fotoku/<?php echo $profil['id_profil']; ?>">Foto Profil</a></li>
      </ul>
  </div>
			  
			  </td>
			</tr>
              <?php 
	$no++;
 }
  
?>
        </table>
                                   <div class="pagination pagination-centered">
		<ul>
		<?php
		echo $paginator;
		?>
		</ul>
	</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </section> <!-- /.content -->
            </div> <!-- /.content-wrapper -->
            