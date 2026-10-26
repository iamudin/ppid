<!-- Scroll to top-->
	<div class="to-top pos-rtive">
	<a href="#banner-home"><i class ="fa fa-angle-up"></i></a>
    </div>
    <!-- Scroll to top-->

	<!-- footer start-->
<footer id="footer-all-page">
		<div class="container">
			<!--Model box-->
				
			
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
	
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/cylinder.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script type="text/javascript">
  jQuery(function($) {
    //highchart
    // Radialize the colors
 Highcharts.setOptions({
     colors: ['#00b495', '#ff2e4a', '#00e34e', '#24CBE5', 
	 '#64E572', '#FF9655', '#FFF263',      '#6AF9C4']
    });
    $(function () {
        $('#chart').highcharts({
            chart: {
                type: 'pie',
				plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
            },
            title: {
                text: ''
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
              plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    },
                    connectorColor: ''
                }
            }
        },
            credits:{
              enabled:false
            },
            series: [{
                type: 'pie',
                name: 'Persentase',
                
                data: [
				
                                        <?php
						//$query=$this->db->query("SELECT * FROM t_polling")->row();

							// $jumlah = $data->jumlah;
							foreach($par->result_array() as $tmpl_soal){
								$idk=$tmpl_soal['id'];
								$status_pegawai=$this->News_model->V_Totalfak($idk);
foreach($status_pegawai->result_array() as $jm){
								$jumlah=$jm['total'];
}
							?>
                            ['<?php echo $tmpl_soal['title']; ?>',   <?php echo $jumlah; ?> ],
              
                         <? }?>
                      
                ]
            }]
        });
    });
  })
</script>    

<script type="text/javascript">
$(function () {
    $('#chart2').highcharts({
        chart: {
             type: 'cylinder',
        options3d: {
            enabled: true,
            alpha: 15,
            beta: 15,
            depth: 50,
            viewDistance: 25
        }
        },
        title: {
            text: 'Transparansi Anggaran Pemerintah Kabupaten Bengkalis'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: [
                'Jenis Transparansi'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            allowDecimals: false,
            title: {
                text: 'Jumlah Dokumen'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y} Dokumen</b></td></tr>',
            footerFormat: '</table>',
            shared: false,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [
        <?php 
        $no = 1;
foreach($jenistrans->result_array() as $artikel){ 
$idx=$artikel['id_jenistransparansi'];
$ar= $this->News_model->Semua_JumlahTransparansi($idx);
  foreach($ar->result_array() as $hm)
{
    $total_lk=$hm['jum'];
}

?>
        {
            name: '<?php echo htmlentities($artikel['jenistransparansi']); ?>',
            data: [
                    <?php echo $total_lk;?>             ]

        },
        <? $no++; } ?>
        ]
        
    });
});
    </script>    
    
    <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-MGH70226QX"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-MGH70226QX');
</script>
	
	<!-- Client-side Image Compressor & WebP Converter -->
	<script src="<?php echo base_url(); ?>assets/js/image-compressor.js?v=<?php echo time(); ?>"></script>
</body>

</html>