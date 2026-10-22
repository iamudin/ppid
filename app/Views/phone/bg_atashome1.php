<!DOCTYPE html>
<html lang="en-US">
<head>
	<title><? echo ! empty($h2_title) ? '' . $h2_title . '': '';?></title>
	<meta charset="utf-8">
	<meta content="IE=edge" http-equiv="x-ua-compatible">
	<meta content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" name="viewport">
	<meta content="yes" name="apple-mobile-web-app-capable">
	<meta content="yes" name="apple-touch-fullscreen">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Website Resmi Humas Pemerintah Kabupaten Bengkalis Riau, Indonesia"> 
<meta name="keywords" content="humas bengkalis, humas pemerintah kabupaten bengkalis, bengkalis, humas">  
<meta name="author" content="Babam Suryaman">        
    <meta charset="UTF-8">    
    <meta name="language" content="Indonesia" />     
    <meta name="generator" content="Jahex" />     
    <meta name="revisit-after" content="7" />     
    <meta name="webcrawlers" content="all" />     
    <meta name="rating" content="general" />     
    <meta name="spiders" content="all" />     
    <meta name="robots" content="all" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>hp/css/style.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>hp/css/responsive.css">
	<link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico" />
</head>

<body>

<div id="main">

	<!-- LEFT SIDEBAR -->
	<div id="slide-out-left" class="side-nav">
		
		<!-- Form Search -->
		<div class="top-left-nav">
<form class="pbar-search-form" id="pbar-search-form" action="https://humas.bengkaliskab.go.id/mobile/pencarian" method="post">
			<div class="searchbar">
				<i class="fa fa-search"></i>
				<input name='q' type="text" placeholder="Search">
			</div>
</form>
		</div>
		<!-- End Form Search -->
		
		<!-- App/Site Menu -->
		<ul class="collapsible" data-collapsible="accordion">
			<li>
			<a href="<?php echo base_url(); ?>mobile"><i class="fa fa-home"></i> Home </a>
			</li>

			
			<?php
 		
		$no=1;
		foreach($menu_atas->result_array() as $m){
		$hitungsub=$this->News_model->Hitung_Sub($m['id']);
		foreach($hitungsub->result_array() as $mx)
				{
				if($mx['jumlah']< 1)
				{
			?>
            		 <li>
                        <a href="<?php echo base_url(); ?>mobile/<? echo $m['sorting'];?>/<? echo $m['permalink'];?>">
                        <i class="fa fa-terminal"></i> <? echo $m['title'];?></a>
                    </li>
                    <?
				}
				else
				{
				?>
		<li><div class="collapsible-header">
                       <i class="fa fa-edit"></i>
                           <? echo $m['title'];?> <span class="angle-right fa fa-angle-right"></span></div>
                       <div class="collapsible-body">
                        <ul>
                           <?
		$sub_menu=$this->News_model->Menu_Bawah2($m['id']);
		foreach($sub_menu->result_array() as $sm)
		{
				if($sm['sorting']=="download")
				{
				$hitung=$this->News_model->Hitung_Download($sm['id']);
				foreach($hitung->result_array() as $mx)
				{
				 ?>
<li><a href="<?php echo base_url(); ?>mobile/<? echo $sm['sorting'];?>/<? echo $sm['permalink'];?>">
<? echo $sm['title'];?></a></li>
                 <?
				}
				}
				elseif($sm['sorting']=="statis")
				{
					?>
<li><a href="<?php echo base_url(); ?>mobile/<? echo $sm['sorting'];?>/<? echo $sm['permalink'];?>/<? echo $sm['id_parent'];?>">
<? echo $sm['title'];?></a></li>
                    
                    <?
				}
				else
				{
					?>
                <li><a href="<?php echo base_url(); ?>mobile/<? echo $sm['sorting'];?>/<? echo $sm['permalink'];?>">
				<? echo $sm['title'];?></a></li>

<?
				}
			}
			?>
                        </ul>
                        </div>
                    </li>
           
        <?
        }
		}
		}
		?>
							
		</ul>
		<!-- End Site/App Menu -->

	</div>
	<!-- END LEFT SIDEBAR -->

	
	<!-- MAIN PAGE -->
	<div id="page">
		
		<!-- FIXED Top Navbar -->
		<div class="top-navbar">
			<div class="top-navbar-left">
				<a href="#" id="menu-left" data-activates="slide-out-left">
					<i class="fa fa-bars"></i>
				</a>
			</div>
			<div class="top-navbar-right">
				<a href="<?php echo base_url(); ?>mobile/link/berita">
					<i class="fa fa-th-large"></i>
				</a>
			</div>
			<div class="site-title">
				<h1><a href="<?php echo base_url(); ?>mobile">Humas Pemkab Bengkalis</a></h1>
			</div>
		</div>
		<!-- End FIXED Top Navbar -->

		