<section id="tour-des" class="bg-gray">
		<div class="content-box">
			<h6 style="text-transform: capitalize;">Statistik</h6>
			<h2>Informasi Publik</h2>
			<div class="dlab-separator-outer ">
                                <div class="dlab-separator bg-warning style-skew"></div>
                            </div>
		</div>
		<div class="container">
			
					
				
			
			 <style type="text/css">
								
								.table th {
    text-align: center;
									float: none;
}

.table {
    border-radius: 5px;
    float: none;
}
								</style>

								<link href="<?php echo base_url(); ?>asset/blank/assets/plugins/datatables/dataTables.min.css" rel="stylesheet" type="text/css"/>
        
 <!-- Icon box circle center aligh -->
 <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>-->
 
    <script src="https://camatpinggir.bengkaliskab.go.id/humasbaru/js/jquery.min.js"></script>
  <script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
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

<div id="chart"></div>
<hr>
<div class="row" align="center">
                                    <div class="col-md-4 col-sm-4 col-4 col-xl-2 m-b10">
                                    	<a href="<?php echo base_url(); ?>web/link/informasi-publik" class="icon-cell">
                                       <div class="flight-cover">
							<p style="font-size: 22px;font-weight: 700;"><?php foreach($db->result_array() as $jm){
		echo $jm['total'];
		}?></p>
							
						</div>
						<p>Daftar
Informasi Publik</p></a>
                                    </div>

                                     <div class="col-md-4 col-sm-4 col-4 col-xl-2 m-b10">
                                     	<a href="<?php echo base_url(); ?>web/link/permohonan-informasi-publik" class="icon-cell">
                                       <div class="flight-cover">
							<p style="font-size: 22px;font-weight: 700;"><?php foreach($downloadk->result_array() as $soal)
	{echo $soal['tot'];}?></p>
							
						</div>
						<p>Jumlah
Unduh</p></a>
                                    </div>

                                     <div class="col-md-4 col-sm-4 col-4 col-xl-2 m-b10">
                                 <a href="<?php echo base_url(); ?>web/link/cek-status-permohonan-informasi-publik" class="icon-cell">      <div class="flight-cover">
							<p style="font-size: 22px;font-weight: 700;"><?php foreach($permohanan->result_array() as $soal)
	{echo $soal['tot'];}?></p>
							
						</div>
						<p>Jumlah
Permohonan</p></a>
                                    </div>

                                    <div class="col-md-4 col-sm-4 col-4 col-xl-2 m-b10">
                                    	  <a href="<?php echo base_url(); ?>web/link/cek-permohonan-keberatan" class="icon-cell">
                                       <div class="flight-cover">
							<p style="font-size: 22px;font-weight: 700;"><?php foreach($keberatan->result_array() as $soal)
	{echo $soal['tot'];}?></p>
							
						</div>
						<p>Jumlah
Keberatan</p></a>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-4 col-xl-2 m-b10">
                                    	<a href="<?php echo base_url(); ?>web/statis/alur-mekanisme-pelayanan-informasi-publik">
                                        <div class="flight-cover">
							<p style="font-size: 22px;font-weight: 700;"><?php foreach($selesai->result_array() as $soal)
	{echo $soal['total'];}?></p>
							
						</div>
						<p>Permohonan
Selesai</p></a>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-4 col-xl-2 m-b10">
                                    	<a href="<?php echo base_url(); ?>web/link/statistik-informasi-publik">
                                       <div class="flight-cover">
							<p style="font-size: 22px;font-weight: 700;"><?php foreach($tran->result_array() as $jm){
		echo $jm['total'];
		}?></p>
							
						</div>
						<p>Transparansi Anggaran</p></a>
                                    </div>

                                </div>
<hr>
 <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
            
            <thead>
                <tr>
                                        <th>
                        Nama PPID                    </th>
                                        <th>
                        Daftar Informasi Publik</th>
                                        <th>
                        Total Permohonan</th>
                                        <th>
                        Permohonan Selesai</th>
                                    </tr>
            </thead>
            <tbody>
            
            <?php
		$nom=1;
	    foreach($kategori->result_array() as $bi){
			$idx=$bi['id_skpd'];

		?>
                                                <tr>
                                                            <td>
                        <? echo $bi['skpd'];?>                 </td>
                                                            <td align="center"><?php
$status_pegawai=$this->News_model->V_TotalPid($idx);
foreach($status_pegawai->result_array() as $jm){
		echo $jm['total'];
		}?></td>
                                                            <td align="center"><?php
$status_pegawai=$this->News_model->V_ProsesSkpd($idx);
foreach($status_pegawai->result_array() as $jm){
		echo $jm['total'];
		}?></td>
                                                            <td align="center"><?php
$status_pegawai=$this->News_model->V_ProsesSkpd2($idx);
foreach($status_pegawai->result_array() as $jm){
		echo $jm['total'];
		}?></td>
                                    </tr>
                                    
                                    <?php $nom++;} ?>
                            </tbody>
        </table>
			
 
						
		</div>
	</section>
	<!-- team end-->