
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

                <?php
             $no=1;
            foreach ($status_pegawai->result_array() as $hasil)
            {
                ?>
                <!-- Nav tabs -->
<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#home">Data Pribadi</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#menu1">Keluarga</a>
  </li>

  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#menu2">Riwayat Pendidikan</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#menu3">Riwayat Pekerjaan</a>
  </li>

</ul>

<div class="tab-content">
  <div class="tab-pane active" id="home">
    <br>
 <table width="100%" class="table">
        <tr><td width="15%">Foto</td>
          <td width="1%">:</td>
          <td width="84%"><img style="width:75px;" src="<?php echo base_url(); ?>asset/profil/<?php echo $hasil['foto']; ?>"/></td></tr>
        <tr><td>Nama Lengkap</td>
          <td>:</td>
          <td><?php echo $hasil['nama_lengkap']; ?></td></tr>
        <tr><td>Tempat Lahir</td>
          <td>:</td>
          <td><?php echo $hasil['tempat_lahir']; ?></td></tr>
        <tr><td>Tanggal Lahir</td>
          <td>:</td>
          <td><?php echo tgl_indo2($hasil['tanggal_lahir']); ?></td></tr>
        <tr><td>Alamat</td>
          <td>:</td>
          <td><?php echo $hasil['alamat']; ?></td></tr>
        <tr><td>Agama</td>
          <td>:</td>
          <td><?php echo $hasil['agama']; ?></td></tr>
        <tr><td>Hp</td>
          <td>:</td>
          <td><?php echo $hasil['hp']; ?></td></tr>
        <tr><td>Alamat Surel</td>
          <td>:</td>
          <td><?php echo $hasil['alamat_surel']; ?></td></tr>
        <tr><td>Alamat Kantor</td>
          <td>:</td>
          <td><?php echo $hasil['alamat_kantor']; ?></td></tr>
        <tr><td>Status Pernikahan</td>
          <td>:</td>
          <td><?php echo $hasil['menikah']; ?></td></tr>
        <tr>
          <td>NIP</td>
          <td>:</td>
          <td><?php echo $hasil['nip']; ?></td></tr>
        <tr><td>Pangkat</td>
          <td>:</td>
          <td><?php echo $hasil['pangkat']; ?></td></tr>
        <tr><td>Golongan</td>
          <td>:</td>
          <td><?php echo $hasil['golongan']; ?></td></tr>
        <tr><td>Jabatan Sekarang</td>
          <td>:</td>
          <td><?php echo $hasil['jabatanprofil']; ?></td></tr>
        <tr><td>Unit Kerja</td>
          <td>:</td>
          <td><?php echo $hasil['skpd']; ?></td></tr>
        <tr><td>Hobi</td>
          <td>:</td>
          <td><?php echo $hasil['hobi']; ?></td></tr>
       
        <tr><td>Foto Profil</td>
          <td>:</td>
          <td><img style="width:175px;" src="<?php echo base_url(); ?>asset/profil/<?php echo $hasil['foto_profil']; ?>"/></td></tr>
        <tr><td></td>
          <td>&nbsp;</td>
          <td><a href="<?php echo site_url('profil') ?>" class="btn btn-default">Cancel</a></td></tr>
    </table>
  </div>
  <div class="tab-pane fade" id="menu1"><br>
	  <table width="100%" class="table">
        <tr>
          <td width="15%">Nama Pasangan</td>
          <td width="1%">:</td>
          <td width="84%"><?php echo $hasil['nama_pasangan']; ?></td></tr>
        <tr>
          <td>Jenis Kelamin</td>
          <td>:</td>
          <td><?php echo $hasil['kelamin']; ?></td></tr>
        <tr>
          <td>pendidikan</td>
          <td>:</td>
          <td><?php echo $hasil['pendidikan']; ?></td></tr>
        </table>
      <table width="100%" class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th width="1%">No</th>
        <th width="36%">Nama Anak</th>
        <th width="24%">Jenis Kelamin</th>
        <th width="39%">Pendidikan</th>
        </tr><?php
             $no=1;
            foreach ($keluarga->result_array() as $anak)
            {
                ?>
                <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $anak['nama_anak']; ?></td>
            <td><?php echo $anak['kelamin']; ?></td>
            <td><?php echo $anak['pendidikan']; ?></td>
            </tr>
                <?php
            $no++;}
            ?>
        </table>

  </div>
  <div class="tab-pane fade" id="menu2"><br>
<table width="100%" class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th width="2%">No</th>
        <th width="18%">Jenjang</th>
        <th width="37%">Nama Sekolah/Universitas</th>
        <th width="13%">Jurusan</th>
        <th width="12%">Tempat</th>
        <th width="18%">Tahun Pendidikan</th>
        </tr><?php
             $no=1;
            foreach ($pendidikan->result_array() as $pendidikan)
            {
                ?>
                <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $pendidikan['jenjang']; ?></td>
            <td><?php echo $pendidikan['nama']; ?></td>
            <td><?php echo $pendidikan['jurusan']; ?></td>
            <td><?php echo $pendidikan['tempat']; ?></td>
            <td><?php echo $pendidikan['tahun_pendidikan']; ?></td>
            </tr>
               <?php
            $no++;}
            ?>
        </table>
  </div>
  <div class="tab-pane fade" id="menu3"><br><table width="100%" class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th width="2%">No</th>
     
        <th width="39%">Jabatan</th>
        <th width="27%">Periode</th>
        <th width="32%">Unit Kerja</th>
        </tr><?php
             $no=1;
            foreach ($pekerjaan->result_array() as $pekerjaanprofil)
            {
                ?>
                <tr>
            <td><?php echo $no; ?></td>
           
            <td><?php echo $pekerjaanprofil['jabatanprofil']; ?></td>
            <td><?php echo $pekerjaanprofil['periode']; ?></td>
            <td><?php echo $pekerjaanprofil['skpd']; ?></td>
            </tr>
               <?php
            $no++;}
            ?>
        </table></div>

</div>
       <?php } ?>
      </div>
            </div>
          </div>
        </div>
      </div> 
    </div>
    </div>