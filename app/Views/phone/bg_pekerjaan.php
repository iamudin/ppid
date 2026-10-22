<div class="detail">
				<article>
	<!--S:JUDUL ARTICLE-->
	<div class="detail_area">
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script type="text/javascript">
$(function () {

    // Radialize the colors
    Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function (color) {
        return {
            radialGradient: { cx: 0.5, cy: 0.3, r: 0.7 },
            stops: [
                [0, color],
                [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
            ]
        };
    });

    // Build the chart
    $('#desa').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'Grafik Statistik Kecamatan Pinggir'
        },
		subtitle: {
				text: 'Berdasarkan Pekerjaan Penduduk'
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
        series: [{
            type: 'pie',
            name: 'Sebanyak',
            data:        [
			
			<?php
						//$query=$this->db->query("SELECT * FROM t_polling")->row();

							// $jumlah = $data->jumlah;
							foreach($datax->result_array() as $tmpl_soal){
								$jumlah=$tmpl_soal['l']+$tmpl_soal['p'];
							?>
                            ['<?php echo $tmpl_soal['statistik']; ?>',   <?php echo $jumlah; ?> ],
              
                         <? }?>
			
			]            
        }]
    });
});
	
</script>

<div class="cleaner_h5"></div>
<div class="cleaner_h5"></div>

<div id="desa" style="min-width: 400px; height: 550px; margin: 0 auto;"></div><br>

<table width="100%" class="gen-table table table-bordered">
                    <thead>
 <tr align="center" class="trhead">
        <th width="4%" align="center">No</th>
        <th width="43%">Statistik</th>		
        <th width="15%">Laki-Laki</th>		
        <th width="20%">Perempuan</th>
        <th width="18%">Jumlah Penduduk</th>
    </tr>
    </thead>
    <tbody>
	
			<?php 
$no = 1;
foreach($datax->result_array() as $artikel){ 
$jumlah=$artikel['l']+$artikel['p'];
$total_lk+=$artikel['l'];
$total_p+=$artikel['p'];
$total_s+=$jumlah;
?>
			<tr style = "background-color : #FDFBFF">	
				<td><?php echo $no;?></td>
				<td><?php echo $artikel['statistik']; ?></td>				
				<td align="center"><?php echo $artikel['l']; ?></td>
				<td align="center"><?php echo $artikel['p']; ?></td>
				<td align="center"><? echo $jumlah;?></td>
			<tr>
            <? $no++;
			} ?>
				                 
	<tr style = "background-color : #F6F2FC">
	  <td colspan="2" style="text-align:right;">Total</td>
	  <td align="center"><?php echo $total_lk;?></td>
	  <td align="center"><?php echo $total_p;?></td>
	  <td align="center"><?php echo $total_s;?></td>
	</tr>
    </tbody>
</table>
					</article>
				
			<!--E:ISI ARTICLE-->
<div class="detail_area">
		<!--S:SHARE BOX-->
	


<div class="share-bot-new">
    <strong>Sebarkan Informasi:</strong><br><br>
    <!-- Go to www.addthis.com/dashboard to customize your tools --> <div class="addthis_inline_share_toolbox"></div>
        <div class="clearfix"></div>
</div>
	<!--E:SHARE BOX-->
	
	
</div>
	</div>

	
			
		
		
</div>