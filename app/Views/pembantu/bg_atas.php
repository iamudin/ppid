<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title><?php echo $judul_lengkap.'  '.$instansi; ?></title>

        <!-- Favicon and touch icons -->
	<link rel="icon" href="<?php echo base_url(); ?>asset/techadmin/images/favicon.ico">

        <!-- Start Global Mandatory Style
        =====================================================================-->
        <!-- jquery-ui css -->
        <link href="<?php echo base_url(); ?>asset/blank/assets/plugins/jquery-ui-1.12.1/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
        <!-- Bootstrap -->
        <link href="<?php echo base_url(); ?>asset/blank/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <!-- Bootstrap rtl -->
        <!--<link href="<?php echo base_url(); ?>asset/blank/assets/bootstrap-rtl/bootstrap-rtl.min.css" rel="stylesheet" type="text/css"/>-->
        <!-- Lobipanel css -->
        <link href="<?php echo base_url(); ?>asset/blank/assets/plugins/lobipanel/lobipanel.min.css" rel="stylesheet" type="text/css"/>
        <!-- Pace css -->
        <link href="<?php echo base_url(); ?>asset/blank/assets/plugins/pace/flash.css" rel="stylesheet" type="text/css"/>
        <!-- Font Awesome -->
        <link href="<?php echo base_url(); ?>asset/blank/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <!-- Pe-icon -->
        <link href="<?php echo base_url(); ?>asset/blank/assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet" type="text/css"/>
        <!-- Themify icons -->
        <link href="<?php echo base_url(); ?>asset/blank/assets/themify-icons/themify-icons.css" rel="stylesheet" type="text/css"/>
        
        <!-- dataTables css -->
        <link href="<?php echo base_url(); ?>asset/blank/assets/plugins/datatables/dataTables.min.css" rel="stylesheet" type="text/css"/>
        <!-- End Global Mandatory Style
        =====================================================================-->
        <!-- Start Theme Layout Style
        =====================================================================-->
        <!-- Theme style -->
        <link href="<?php echo base_url(); ?>asset/blank/assets/dist/css/styleBD.css" rel="stylesheet" type="text/css"/>
        <!-- Theme style rtl -->
        <!--<link href="<?php echo base_url(); ?>asset/blank/assets/dist/css/styleBD-rtl.css" rel="stylesheet" type="text/css"/>-->
        <!-- End Theme Layout Style
        =====================================================================-->
        
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
        
        <link href="<?php echo base_url('asset/techadmin/data/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')?>" rel="stylesheet">
        
    </head>

    <body class="hold-transition fixed sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">
            <header class="main-header"> 
                <a href="<?php echo base_url(); ?>pembantu" class="logo"> <!-- Logo -->
                    <span class="logo-mini">
                        <!--<b>A</b>BD-->
                        <img src="<?php echo base_url(); ?>asset/blank/assets/dist/img/mini-logo.png" alt="">
                    </span>
                    <span class="logo-lg">
                        <!--<b>Admin</b>BD-->
                        <img src="<?php echo base_url(); ?>asset/blank/assets/dist/img/logo.png" alt="">
                    </span>
                </a>
                <!-- Header Navbar -->
                <nav class="navbar navbar-static-top">
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"> <!-- Sidebar toggle button-->
                        <span class="sr-only">Toggle navigation</span>
                        <span class="pe-7s-keypad"></span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                        
                           
                           
                            <!-- settings -->
                            <li class="dropdown dropdown-user">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="pe-7s-settings"></i></a>
                                <ul class="dropdown-menu">
                                   
                                    <li><a href="<?php echo base_url(); ?>pembantu/pengguna"><i class="pe-7s-users"></i> Ubah Profil</a></li>
                                    
                                    <li><a target="_blank" href="<?php echo base_url(); ?>web"><i class="pe-7s-settings"></i> Lihat Website</a></li>
                                    <li><a href="<?php echo base_url(); ?>web/logout"><i class="pe-7s-key"></i> Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- =============================================== -->
            <!-- Left side column. contains the sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel -->
                    
                    <!-- search form -->
                    <form action="<?php echo base_url(); ?>pembantu/pencarian" method="post" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                <button type="submit" name="search" id="search-btn" class="btn"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form> <!-- /.search form -->
                    <!-- sidebar menu -->
                    <ul class="sidebar-menu">
                        <li class="header">MENU UTAMA</li>
                        <li>
                            <a href="<?php echo base_url(); ?>pembantu"><i class="ti-home"></i> <span>Dashboard</span>
                               
                            </a>
                        </li>
                        
                      
                      
                     
                        
                        <li><a href="<?php echo base_url(); ?>pembantu/permohonan"><i class="ti-pencil-alt"></i></i> Permohonan Informasi Publik</a></li>
                        


                        
                        <li><a href="<?php echo base_url(); ?>pembantu/download"><i class="ti-server"></i> Informasi Publik</a></li>

                        
                            
                              <li><a href="<?php echo base_url(); ?>pembantu/laporan"><i class="ti-layout"></i> Laporan Pelayanan</a></li>
                              
                              <li><a href="<?php echo base_url(); ?>pembantu/laporanpublik"><i class="ti-layout"></i> Laporan Informasi Publik</a></li>

                  <li><a href="<?php echo base_url(); ?>pembantu/laporan"><i class="ti-layout"></i> Laporan Pelayanan</a></li>
                              
                              <li><a href="<?php echo base_url(); ?>pembantu/profil"><i class="ti-layout"></i> Profil Pegawai</a></li>

                         <li><a href="<?php echo base_url(); ?>pembantu/panduan"><i class="ti-bookmark"></i> Panduan</a></li>


                        
          
                     
                   
                        
                    </ul>
                </div> <!-- /.sidebar -->
            </aside>
            <!-- =============================================== -->
           