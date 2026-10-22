<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title><?php echo $judul_lengkap.'  '.$instansi; ?></title>
        <meta content="Admin Dashboard Bagian Humas Kabupaten" name="description" />
        <meta content="Bagian Humas Kabupaten Bengkalis" name="author" /
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App Icons -->
        <link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico">

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>admintema/assets/plugins/morris/morris.css">

        <!-- App css -->
        <link href="<?php echo base_url(); ?>admintema/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>admintema/assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>admintema/assets/css/style.css" rel="stylesheet" type="text/css" />
		 <link href="<?php echo base_url(); ?>admintema/assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />

             <link href="<?php echo base_url(); ?>datepicker/css/datepicker.css" rel="stylesheet" media="screen">
             <style>
 .ck-editor__editable
 {
    min-height: 400px !important;
    max-height: 400px !important;
 }
</style>
    </head>


    <body>

      

        <!-- Navigation Bar-->
        <header id="topnav">
            <div class="topbar-main">
                <div class="container-fluid">

                    <!-- Logo container-->
                    <div class="logo">
                        <!-- Text Logo -->
                        <!--<a href="index.html" class="logo">-->
                        <!--Upcube-->
                        <!--</a>-->
                        <!-- Image Logo -->
                        <a href="<?php echo base_url(); ?>webadmin" class="logo">
                            <img src="<?php echo base_url(); ?>admintema/assets/images/logo.png" alt="" height="40" class="logo-small">
                            <img src="<?php echo base_url(); ?>admintema/assets/images/logo.png" alt="" height="40" class="logo-large">
                        </a>

                    </div>
                    <!-- End Logo container-->


                    <div class="menu-extras topbar-custom">

                        <!-- Search input -->
                        <div class="search-wrap" id="search-wrap">
                            <div class="search-bar">
                                <input class="search-input" type="search" placeholder="Search" />
                                <a href="#" class="close-search toggle-search" data-target="#search-wrap">
                                    <i class="mdi mdi-close-circle"></i>
                                </a>
                            </div>
                        </div>

                        <ul class="list-inline float-right mb-0">
                            <!-- Search -->
                            <li class="list-inline-item dropdown notification-list">
                                <a class="nav-link waves-effect toggle-search" href="#"  data-target="#search-wrap">
                                    <i class="mdi mdi-magnify noti-icon"></i>
                                </a>
                            </li>
                            <!-- Messages-->
                            
                            
                            <!-- User-->
                            <li class="list-inline-item dropdown notification-list">
                                <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
                                   aria-haspopup="false" aria-expanded="false">
                                    <img src="<?php echo base_url(); ?>admintema/assets/images/users/avatar-1.png" alt="user" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                    <a class="dropdown-item" href="<?php echo base_url(); ?>webadmin/pengguna"><i class="dripicons-user text-muted"></i> Pengguna</a>
                                    
                                    <a target="_blank" class="dropdown-item" href="<?php echo base_url(); ?>web"><i class="dripicons-lock text-muted"></i> Lihat Website</a>
                                    
                                    <a class="dropdown-item" href="<?php echo base_url(); ?>webadmin/logout"><i class="dripicons-exit text-muted"></i> Logout</a>
                                </div>
                            </li>
                            <li class="menu-item list-inline-item">
                                <!-- Mobile menu toggle-->
                                <a class="navbar-toggle nav-link">
                                    <div class="lines">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </a>
                                <!-- End mobile menu toggle-->
                            </li>

                        </ul>
                    </div>
                    <!-- end menu-extras -->

                    <div class="clearfix"></div>

                </div> <!-- end container -->
            </div>
            <!-- end topbar-main -->

            <!-- MENU Start -->
            <div class="navbar-custom">
                <div class="container-fluid">
                    <div id="navigation">
                        <!-- Navigation Menu-->
                        <ul class="navigation-menu">

                            <li>
                                <a href="<?php echo base_url(); ?>webadmin"><i class="ti-home"></i>Home</a>
                            </li>

                            <?php
									if($akses!="user"){ ?>

                            <li class="has-submenu">
                                <a href="#"><i class="ti-crown"></i>Statis</a>
                                <ul class="submenu">
<li><a href="<?php echo base_url(); ?>webadmin/menustatis"><i class="icon-comment"></i> Menu Statis</a></li>
<li><a href="<?php echo base_url(); ?>webadmin/statis"><i class="icon-random"></i> Data Statis</a></li>
<li><a href="<?php echo base_url(); ?>webadmin/banner"><i class="icon-book"></i> Banner</a></li>   <li><a href="<?php echo base_url(); ?>webadmin/link"><i class="icon-tag"></i> Link Terkait</a></li>

</ul>
                            </li>
                            <?php } ?>
                            <li class="has-submenu">
                                <a href="#"><i class="ti-light-bulb"></i>Dinamis</a>
                                <ul class="submenu">
 <li><a href="<?php echo base_url(); ?>webadmin/kepegawaian"><i class="icon-retweet"></i> Kepegawaian</a></li>
  <li><a href="<?php echo base_url(); ?>webadmin/polling"><i class="icon-retweet"></i> Polling</a></li>                      
<li><a href="<?php echo base_url(); ?>webadmin/agenda"><i class="icon-retweet"></i> Agenda Kegiatan</a></li> 

<li><a href="<?php echo base_url(); ?>webadmin/pengumuman"><i class="icon-retweet"></i> Pengumuman</a></li> 	

<li><a href="<?php echo base_url(); ?>webadmin/paper"><i class="icon-retweet"></i> E-Paper</a></li> <li><a href="<?php echo base_url(); ?>webadmin/faq"><i class="icon-retweet"></i> Faq</a></li>    
 
                                </ul>
                            </li>
        <li class="has-submenu">
                                <a href="#"><i class="ti-light-bulb"></i>Informasi Publik</a>
                                <ul class="submenu">
 <li class="divider"></li>
<li><a href="<?php echo base_url(); ?>webadmin/skpd"><i class="icon-random"></i> Perangkat Daerah</a></li>
<li><a href="<?php echo base_url(); ?>webadmin/pembantu"><i class="icon-comment"></i> PPID Pembantu</a></li>
<li><a href="<?php echo base_url(); ?>webadmin/download"><i class="icon-random"></i> Informasi Publik</a></li>
<li><a href="<?php echo base_url(); ?>webadmin/permohonan"><i class="icon-random"></i> Permohonan Informasi Publik</a></li>

<li><a href="<?php echo base_url(); ?>webadmin/keberatan"><i class="icon-comment"></i> Permohonan Keberatan</a></li>

<li><a href="<?php echo base_url(); ?>webadmin/laporantahun">Cetak Laporan Per Tahun</a></li>
                          <li><a href="<?php echo base_url(); ?>webadmin/laporanbulan">Cetak Laporan Per Bulan</a></li>
                            <li><a href="<?php echo base_url(); ?>webadmin/laporanskpd">Cetak Laporan Per OPD/SKPD</a></li>
                            
                               <li><a href="<?php echo base_url(); ?>webadmin/laporanpublik">Rekapitulasi Informasi Publik</a></li>
                               
                                  <li><a href="<?php echo base_url(); ?>webadmin/laporankeberatan">Rekapitulasi Keberatan</a></li>                                 </ul>
                            </li>

<li>

 


<li class="has-submenu">
                                <a href="#"><i class="ti-light-bulb"></i>Publikasi</a>
                                <ul class="submenu">
<li><a href="<?php echo base_url(); ?>webadmin/berita">Berita</a></li>
                        
                      
                        
<li><a href="<?php echo base_url(); ?>webadmin/beritafoto">Infografis</a></li>
                        

<li>
                            <a href="<?php echo base_url(); ?>webadmin/galeri">
                              Galeri Foto
                               
                            </a>
                          
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>webadmin/video">
                              Video
                               
                            </a>
                          
                        </li>

<li>
                            <a href="<?php echo base_url(); ?>webadmin/penghargaan">
                              Penghargaan
                               
                            </a>
                          
                        </li>

<li><a href="<?php echo base_url(); ?>webadmin/kritik"> Pengunjung</a></li>

                    </ul>
                           
</li>
<li class="has-submenu">
                                <a href="#"><i class="ti-light-bulb"></i>Survey</a>
                                <ul class="submenu">
<li class="divider"></li>
<li><a href="<?php echo base_url(); ?>pertanyaan">Pertanyaan Survey</a></li>
<li><a href="<?php echo base_url(); ?>webadmin/survey">Survey</a></li>
<li><a href="<?php echo base_url(); ?>webadmin/hasilsurvey">Hasil Survey</a></li>
                           </ul>
                            </li>

                            <li class="has-submenu">
                                <a href="#"><i class="ti-light-bulb"></i>Transparansi</a>
                                <ul class="submenu">
<li><a href="<?php echo base_url(); ?>jenistransparansi">Jenis Transparansi</a></li>
<li><a href="<?php echo base_url(); ?>tahun">Tahun Transparansi</a></li>
<li><a href="<?php echo base_url(); ?>webadmin/transparansi">Transparansi</a></li>                          </ul>
                            </li>
                            
 <li class="has-submenu">
                                <a href="#"><i class="ti-light-bulb"></i>Profil Pegawai</a>
                                <ul class="submenu">
<li><a href="<?php echo base_url(); ?>pangkat">Pangkat</a></li>
<li><a href="<?php echo base_url(); ?>golongan">Golongan</a></li>
<li><a href="<?php echo base_url(); ?>tingkatan">Tingkatan Jabatan</a></li> 
<li><a href="<?php echo base_url(); ?>level">Level Jabatan</a></li> 
<li><a href="<?php echo base_url(); ?>jabatanprofil">Jabatan</a></li>  
<li><a href="<?php echo base_url(); ?>agama">Agama</a></li>                
<li><a href="<?php echo base_url(); ?>kelamin">Jenis Kelamin</a></li>  
<li><a href="<?php echo base_url(); ?>menikah">Status Pernikahan</a></li>   
<li><a href="<?php echo base_url(); ?>jenjang">Jenjang Pendidikan</a></li>   
<li><a href="<?php echo base_url(); ?>profil">Profil Pegawai</a></li>                          
</ul>
                            </li>
                            

                        </ul>
                        <!-- End navigation menu -->
                    </div> <!-- end #navigation -->
                </div> <!-- end container -->
            </div> <!-- end navbar-custom -->
        </header>
        <!-- End Navigation Bar-->


        