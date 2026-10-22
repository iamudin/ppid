<!-- Scroll to top-->
	<div class="to-top pos-rtive">
	<a href="#banner-home"><i class ="fa fa-angle-up"></i></a>
    </div>
    <!-- Scroll to top-->

	<!-- footer start-->
<footer id="footer-all-page">
		<div class="container">
			<div class="row">
			
				<div class="col-lg-4 col-md-6 col-sm-6 col-6">
					<div class="quick-link">
						<div class="comm-foot-hed">
							<h6>Pelayanan</h6>
						</div>
						<div class="foot-list ">
							<ul>
								 <?php
	$fungsi=$this->News_model->Menu_Bawah2('8');
	foreach($fungsi->result_array() as $m){?>
				<li><i class="fa fa-chevron-right"></i>&nbsp;&nbsp;<a href="<?php echo base_url(); ?>web/<? echo $m['sorting'];?>/<? echo $m['permalink'];?>"><? echo $m['title'];?></a></li>
                
                <?
	}
	?> 
							</ul>
						</div>
					</div>
				</div>
				<div class="col-lg-2 col-md-6 col-sm-6 col-6">
					<div class="quick-link">
						<div class="comm-foot-hed">
							<h6>Publikasi</h6>
						</div>
						<div class="foot-list">
							<ul>
								 <?php
	$fungsi=$this->News_model->Menu_Bawah2('3');
	foreach($fungsi->result_array() as $m){?>
				<li><i class="fa fa-chevron-right"></i>&nbsp;&nbsp;<a href="<?php echo base_url(); ?>web/<? echo $m['sorting'];?>/<? echo $m['permalink'];?>"><? echo $m['title'];?></a></li>
                
                <?
	}
	?> 
							</ul>
						</div>
					</div>
				</div>

					<div class="col-lg-3 col-md-6 col-sm-6 col-6 d-none d-sm-block">
					<div class="quick-link">
						<div class="comm-foot-hed">
							<h6>Informasi Publik</h6>
						</div>
						<div class="foot-list">
							<ul>
								 <?php
	$fungsi=$this->News_model->Menu_Bawah2('7');
	foreach($fungsi->result_array() as $m){?>
				<li><i class="fa fa-chevron-right"></i>&nbsp;&nbsp;<a href="<?php echo base_url(); ?>web/<? echo $m['sorting'];?>/<? echo $m['permalink'];?>"><? echo $m['title'];?></a></li>
                
                <?
	}
	?> 
							</ul>
						</div>
					</div>
				</div>

				<div class="col-lg-3 col-md-6 col-sm-6 col-6 d-none d-sm-block">
					<div class="widget_getintuch">
						<div class="comm-foot-hed">
							<h6>Kontak Kami</h6>
						</div>
						<div class="foot-list">
							  <ul>
                                <li><i class="fa fa-map-marker"></i><strong>Alamat</strong>
Jl. Kartini No. 012</li>
                                <li><i class="fa fa-phone"></i><strong>Telepon</strong> (0766) – 21865</li>
                                
                                 <li><i class="fa fa-fax"></i><strong>Fax</strong>(0766) - 21865</li>
                                 
                                 <li><i class="fa fa-envelope"></i><strong>Email</strong>ppid@bengkaliskab.go.id</li>
                            </ul>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>	
	
	<!-- footer bottom-->
	<div class="footre-bottom">
		<div class="container">
			<div class="row">
				<div class="col-lg-7 col-md-6 col-sm-6 col-6">
					<div class="copy-right-para">
						<p>Copyright © 2020 PPID Kabupaten Bengkalis - Design By TIM IT PPID</p>
					</div>
				</div>
				<div class="col-lg-5 col-md-6 col-sm-6 col-6">
					<div class="copy-right-icon">
						<a target="_BLANK" href="https://web.facebook.com/PPID-Bengkalis-1792890634350386"><i class="fab fa-facebook-f face no-ag"></i></a>
						<a target="_BLANK" href="https://twitter.com/ppidbengkalis"><i class="fab fa-twitter face"></i></a>
						<a target="_BLANK" href="https://www.instagram.com/ppidbengkalis/"><i class="fab fa-instagram face"></i></a>
						<a target="_BLANK" href="https://www.youtube.com/channel/UCyenbSwkuLpnDKRFPHc1eRg"><i class="fab fa-youtube face"></i></a>
						<a target="_BLANK" href="<?php echo base_url(); ?>feed"><i class="fas fa-rss face"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- footer end-->
	
	
	
	<!-- Main js -->
	<script src="<?php echo base_url(); ?>tema/js2/jquery-3.3.1.min.js"></script>
	
	<!-- Bootstrap-->
	<script src="<?php echo base_url(); ?>tema/js2/bootstrap.min.js"></script>

	<!-- owl.carousel-->
	<script src="<?php echo base_url(); ?>tema/js2/owl.carousel.min.js"></script>
	
	<!-- wow.min-->
	<script src="<?php echo base_url(); ?>tema/js2/wow.min.js"></script>
	
	<!-- html5shiv-->
	<script src="<?php echo base_url(); ?>tema/js2/html5shiv.js"></script>
	
	<!-- respondl-->
	<script src="<?php echo base_url(); ?>tema/js2/respond.min.js"></script>
	
	<!-- prettifyl-->
	<script src="<?php echo base_url(); ?>tema/js2/prettify.js"></script>
	
	<!--bootstrap-datepicker-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
   
    <!-- custom-->
	<script src="<?php echo base_url(); ?>tema/js2/custom.js"></script>
	
	<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-MGH70226QX"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-MGH70226QX');
</script>
	
	<!-- Client-side Image Compressor & WebP Converter -->
	<script src="<?php echo base_url(); ?>assets/js/image-compressor.js"></script>
</body>

</html>