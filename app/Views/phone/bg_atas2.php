<html><head>
 <meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico" />
<title><? echo ! empty($h2_title) ? '' . $h2_title . '': '';?></title>
 <link href="<?php echo base_url(); ?>baru/css/frame.css" rel="stylesheet" type="text/css"> 
 <link rel="stylesheet" href="<?php echo base_url(); ?>baru/css/style.css">
 <link rel="stylesheet" href="<?php echo base_url(); ?>baru/css/style2.css">
 
 <script type="text/javascript" src="<?php echo base_url(); ?>baru/js/jquery.min.js"></script>
 <script src="<?php echo base_url(); ?>baru/js/handlebars-v3.0.1.js"></script>
 <script src="<?php echo base_url(); ?>baru/js/lodash.min.js"></script>
 <script src="<?php echo base_url(); ?>baru/js/ajsx.js" type="text/javascript"></script>
 <meta charset="utf-8">
	<meta content="IE=edge" http-equiv="x-ua-compatible">
	<meta content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" name="viewport">
	<meta content="yes" name="apple-mobile-web-app-capable">
	<meta content="yes" name="apple-touch-fullscreen">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Website Resmi Dinas Pendidikan Kabupaten Bengkalis Riau, Indonesia"> 
<meta name="keywords" content="Disdik bengkalis, Disdik pemerintah kabupaten bengkalis, bengkalis, Disdik">  
<meta name="author" content="Babam Suryaman">        
           
    <meta charset="UTF-8">    
    <meta name="language" content="Indonesia" />     
    <meta name="generator" content="Jahex" />     
    <meta name="revisit-after" content="7" />     
    <meta name="webcrawlers" content="all" />     
    <meta name="rating" content="general" />     
    <meta name="spiders" content="all" />     
    <meta name="robots" content="all" />
<!-- Go to www.addthis.com/dashboard to customize your tools --> <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-58d805e72586e5e7"></script> 
</head>
<body>


<div class="con_header">
 <div id="header_new" class="fixed">
  
 <a href="<?php echo base_url(); ?>mobile" class="logo"><img src="<?php echo base_url(); ?>baru/images/logo.png" alt="humasbengkalis"></a>

 <a class="menudetik" id="menudetik">
 <span class="grs">
 <span></span>
 <span></span>
 <span></span>
 </span>
  MENU
 </a>
 <a class="menudetik" id="tutupmenu">
 <span class="close">
 <span></span>
 <span></span>
 <span></span>
 </span>
 TUTUP
 </a>
 <div class="clearfix"></div>
 <div class="newnav">
 <div class="ncontainer">
 <div class="nuser user_login">
 </div>
 <form action="<?php echo base_url(); ?>mobile/pencarian" method="post" class="nsearch">
 <input type="text" placeholder="Search" class="ninput" name="q">
 <input type="image" src="<?php echo base_url(); ?>baru/images/ico_search.png" class="nbtn">
 </form>
  <div class="con_newnav">
 <div class="nlist-kanal nsubmenu">
			
<ul>
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
                         <? echo $m['title'];?></a>
                    </li>
                    <?
				}
				else
				{
				?>
		<li class="dropdown">
                           <a href="#" data-toggle="dropdown"><? echo $m['title'];?> <i class="icon-arrow"></i></a>
                       <ul class="dropdown-menu">
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
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<? echo $sm['title'];?></a></li>
                 <?
				}
				}
				elseif($sm['sorting']=="statis")
				{
					?>
<li><a href="<?php echo base_url(); ?>mobile/<? echo $sm['sorting'];?>/<? echo $sm['permalink'];?>/<? echo $sm['id_parent'];?>">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<? echo $sm['title'];?></a></li>
                    
                    <?
				}
				else
				{
					?>
                <li><a href="<?php echo base_url(); ?>mobile/<? echo $sm['sorting'];?>/<? echo $sm['permalink'];?>">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<? echo $sm['title'];?></a></li>

<?
				}
			}
			?>
                        </ul>
                      
                    </li>
           
        <?
        }
		}
		}
		?>
							
		</ul>				
		

 <div class="clearfix"></div>
 </div>
 
  
<div class="clearfix"></div>
</div> <div class="clearfix"></div>
 </div>
 </div>
 </div>
 </div>
</div>