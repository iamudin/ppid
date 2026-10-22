 <?php
             $no=1;
            foreach ($status_pegawai->result_array() as $hasil)
            {
                ?>
<section id="tour-des" class="bg-gray">
		<div class="content-box">
			<h6 style="text-transform: capitalize;">Profil Pejabat</h6>
			<h2>PPID Kabupaten Bengkalis</h2>
			<div class="dlab-separator-outer ">
                                <div class="dlab-separator bg-warning style-skew"></div>
                            </div>
		</div>
		<div class="container">
        <div align="center">

    <img style="width:30%;background: #fff;padding: 10px;" src="<?php echo base_url(); ?>asset/profil/<?php echo $hasil['foto_profil']; ?>"/></div><br>
			<div class="bookoing-secrty">
                        <div class="all-pacj-dfgh" style="text-align: center;">
                            <h6><?php echo $hasil['nama_lengkap']; ?>
                              <br>
                              <i style="font-size: 16px;"><?php echo $hasil['jabatanprofil']; ?></i>
                            </h6>

                        </div>
                        <div class="bookk0-natd-form-profil">
                
				
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
  
 <table width="100%" class="table table-bordered">
        <tr><td width="15%">Nama Lengkap</td>
          <td width="84%"><?php echo $hasil['nama_lengkap']; ?></td></tr>
        <tr><td>Tempat Lahir</td>
          <td><?php echo $hasil['tempat_lahir']; ?></td></tr>
        <tr><td>Tanggal Lahir</td>
          <td><?php echo tgl_indo2($hasil['tanggal_lahir']); ?></td></tr>
        <tr><td>Alamat</td>
          <td><?php echo $hasil['alamat']; ?></td></tr>
        <tr><td>Agama</td>
          <td><?php echo $hasil['agama']; ?></td></tr>
        <tr><td>Telepon/Hp</td>
          <td><?php echo $hasil['hp']; ?></td></tr>
        <tr><td>Alamat Surel</td>
          <td><?php echo $hasil['alamat_surel']; ?></td></tr>
        <tr><td>Alamat Kantor</td>
          <td><?php echo $hasil['alamat_kantor']; ?></td></tr>
        <tr><td>Status Pernikahan</td>
          <td><?php echo $hasil['menikah']; ?></td></tr>
        <tr>
          <td>NIP</td>
          <td><?php echo $hasil['nip']; ?></td></tr>
        <tr><td>Pangkat</td>
          <td><?php echo $hasil['pangkat']; ?></td></tr>
        <tr><td>Golongan</td>
          <td><?php echo $hasil['golongan']; ?></td></tr>
        <tr><td>Jabatan Sekarang</td>
          <td><?php echo $hasil['jabatanprofil']; ?></td></tr>
        <tr><td>Unit Kerja</td>
          <td><?php echo $hasil['skpd']; ?></td></tr>
        <tr><td>Hobi</td>
          <td><?php echo $hasil['hobi']; ?></td></tr>
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
<style type="text/css">
  .ak a{
    color: #fff;
  }
   .ak i{
    color: #fff;
  }
</style>
                 <div align="center" class="ak">
                   <a target="_BLANK" href="<?php echo base_url(); ?>web/cetakpejabat/<?php echo $hasil['id_profil']; ?>" class="btn btn-danger btn-lg"><i class="fas fa-print"></i> Cetak</a>&nbsp;
                   <a href="<?php echo base_url(); ?>web/link/profil-pejabat" class="btn btn-warning btn-lg"><i class="fas fa-back-alt"></i> Kembali</a>
                 </div>  
                        </div>
                    </div>
					

       
			

						
		</div>
	</section>
	<!-- team end-->

	<?php } ?>