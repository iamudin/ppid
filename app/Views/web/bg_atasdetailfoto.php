<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="" />
<meta name="author" content="" />
<meta name="robots" content="" />
<meta name="description" content="Website Resmi PPID Kabupaten Bengkalis Riau, Indonesia"> 
<meta name="keywords" content="PPID bengkalis, PPID pemerintah kabupaten bengkalis, bengkalis, PPID">  
<meta name="author" content="Babam Suryaman"> 
<meta charset="UTF-8">
<meta name="language" content="Indonesia" /> 
<meta name="revisit-after" content="7" /> 
<meta name="webcrawlers" content="all" /> 
<meta name="rating" content="general" /> 
<meta name="spiders" content="all" /> 
<meta name="robots" content="all" />
<meta name="format-detection" content="telephone=no">
	<meta name="viewport" content="initial-scale=1, maximum-scale=1">
	<!-- Title-->
	<title><?php echo ! empty($h2_title) ? '' . $h2_title . '': '';?></title>



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
     <!--	normalize css-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>tema/css/normalize.css">
     <!--	flacticon css-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>tema/font/flaticon.css">
     <!--	animate css--> 
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
	<link rel="stylesheet" href="<?php echo base_url(); ?>tema/css/style.css">
	<!-- responsive.css-->
	<link rel="stylesheet" href="<?php echo base_url(); ?>tema/css/responsive.css">


<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5d66391c5fea9f001288d5bf&product=inline-share-buttons' async='async'></script>

</head>

<body>
	<!-- top header-->
	<div class="header-most-top d-none d-sm-block">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-8 col-sm-8 col-12">
					<div class="main-flex-top">
						<div class="email sel d-flex">
							<div class="main-email-text d-flex">
								<i class="fas fa-map-marker"></i>
								<p>Website Resmi PPID Kabupaten Bengkalis Riau </p>
							</div>
							
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-md-4 col-sm-4 col-12">
					<div class="email sel d-flex">

							<div class="main-loc-text d-flex">
								<i class="fas fa-phone"></i>
								<p><a href="phone:076121865">(0766) – 21865 </a></p>
							</div>
							<div class="main-loc-text d-flex">
								<i class="fas fa-envelope"></i>
								<p><a href="mailto:ppid@bengkaliskab.go.id">ppid@bengkaliskab.go.id</a></p>
							</div>
							<div class="main-loc-text d-flex">
								<i class="fas fa-info"></i>
								<p><a href="<?php echo base_url(); ?>web/link/faq">Faq</a></p>
							</div>
							<div class="main-loc-text d-flex">
								<i class="fas fa-share"></i>
								<p><a href="<?php echo base_url(); ?>web/link/kontak">Kontak Kami</a></p>
							</div>
						</div>
				</div>
			</div>
		</div>
	</div>
	<!-- top header end-->
	
	<!-- navber start-->
	<header id="top-heder-nav">
		<nav class="navbar navbar-expand-lg" data-toggle="sticky-onscroll">
			<div class="container">
				<a class="navbar-brand" href="<?php echo base_url(); ?>">
					<img src="<?php echo base_url(); ?>tema/img/logo.png" alt="">
				</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
					<span><i class="fas fa-bars"></i></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarResponsive">
					<ul class="navbar-nav">
						<li class="nav-item dropdown">
							<a class="nav-link  active" href="<?php echo base_url(); ?>">Home</a>
							
							
						</li>

						<?php
 		
		$no=1;
		foreach($menu_bawah->result_array() as $m){
		$hitungsub=$this->News_model->Hitung_Sub($m['id']);
		foreach($hitungsub->result_array() as $mx)
				{
				if($mx['jumlah']< 1)
				{
			?>
            		
            		 <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>web/<? echo $m['sorting'];?>/<? echo $m['permalink'];?>">
                        <? echo $m['title'];?></a>
                    </li>
                    <?
				}
				else
				{
				?>
		<li class="nav-item dropdown">
                        <a class="nav-link " href="<?php echo base_url(); ?>web/<? echo $m['sorting'];?>/<? echo $m['permalink'];?>">
                           <? echo $m['title'];?><span class='caret'></span>
                        </a>
                        <div class="dropdown-content">
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
<a href="<?php echo base_url(); ?>web/<? echo $sm['sorting'];?>/<? echo $sm['permalink'];?>">
<? echo $sm['title'];?></a>
                 <?
				}
				}
				elseif($sm['sorting']=="statis")
				{
					?>
<a href="<?php echo base_url(); ?>web/<? echo $sm['sorting'];?>/<? echo $sm['permalink'];?>">
<? echo $sm['title'];?></a>
                    
                    <?
				}
				else
				{
					?>
                <a href="<?php echo base_url(); ?>web/<? echo $sm['sorting'];?>/<? echo $sm['permalink'];?>">
				<? echo $sm['title'];?></a>

<?
				}
			}
			?>
                        </div>
                    </li>
           
        <?
        }
		}
		}
		?>
						
					</ul>
				</div>
				<div class="left-menu-pho">
					<div class="icon-phon-men">
						<a href="<?php echo base_url(); ?>web/link/permohonan-informasi-publik">
						<i class="fas fa-paper-plane"></i></a>
					</div>
					<div class="phone-number-idel">
						<h6><a href="<?php echo base_url(); ?>web/link/permohonan-informasi-publik">Kirim Permohonan</a></h6>
						<p>Informasi Publik</p>
					</div>
				</div>
			</div>
		</nav>
	</header>
	<!-- navber end-->