 <!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!--Favicon add-->
<link rel="icon" href="<?php echo base_url(); ?>favicon.ico" type="image/x-icon" />
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

  <!-- Bootstrap-->
  <link rel="stylesheet" href="<?php echo base_url(); ?>tema/css/bootstrap.min.css">
  <!--magnific-popup.cs-->
  <link rel="stylesheet" href="<?php echo base_url(); ?>tema/css/magnific-popup.css">
  <!--owl css-->
  <link rel="stylesheet" href="<?php echo base_url(); ?>tema/css/owl.carousel.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>tema/css/owl.theme.default.min.css">
     <!-- normalize css-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>tema/css/normalize.css">
     <!-- flacticon css-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>tema/font/flaticon.css">
     <!-- animate css--> 
    <link rel="stylesheet" href="<?php echo base_url(); ?>tema/css/animate.css">

  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
  <!--Fontawesom -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous" />
  <!--Font Famely-->
  <!--Poppins-->
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900&display=swap" rel="stylesheet">
  <!--Lato-->
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">
  <!-- style.css-->
 
<style type="text/css">
  body {
    font-size: 14px;
    font-weight: normal;
    line-height: 24px;
    position: relative;
    font-family: 'Public Sans', sans-serif;
    overflow-x: hidden;
    color: #000;
  }
  td,th{
    color: #000;
  }
</style>

</head>

<body onload="window.print()" style="background: #fff;">
 <?php
             $no=1;
            foreach ($status_pegawai->result_array() as $hasil)
            {
                ?>
<section id="tour-des" class="bg-white">
	
		<div class="container">
        <div align="center">

    <img style="width:30%;background: #fff;padding: 10px;" src="<?php echo base_url(); ?>asset/profil/<?php echo $hasil['foto_profil']; ?>"/></div><br>
			<div class="bookoing-secrty">
                        <div class="all-pacj-dfghg" style="text-align: center;">
                            <h6><?php echo $hasil['nama_lengkap']; ?>
                              <br>
                              <i style="font-size: 16px;"><?php echo $hasil['jabatanprofil']; ?></i>
                            </h6>

                        </div>
                        <div class="bookk0-natd-form-profil">
                
				
<h5>1.Data Pribadi</h5><br>


  
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
        </table><br>
 <h5>2.Keluarga</h5><br>

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
<br>
  <h5>3.Riwayat Pendidikan</h5><br>

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
        </table><br>
<h5>4.Riwayat Pekerjaan</h5><br>
<table width="100%" class="table table-bordered" style="margin-bottom: 10px">
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
       
                
                        </div>
                    </div>
					

       
			

						
		</div>
	</section>
	<!-- team end-->

	<?php } ?>
</body></html>