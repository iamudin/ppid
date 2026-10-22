<div class="detail">
				<article>
	<!--S:JUDUL ARTICLE-->
	<div class="detail_area">
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script type="text/javascript">
$(function () {
    $('#desa').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Statistik Anak Kecamatan Pinggir'
        },
        subtitle: {
            text: 'Berdasarkan Gizi Buruk'
        },
        xAxis: {
            categories: [	
						<?php 
		$no = 1;
foreach($datax->result_array() as $artikel){ ?>
                'Anak Gizi Buruk <?php echo $artikel['statistik']; ?>',
               <? } ?>
				
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Jumlah Anak'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y} Anak</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
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
foreach($datax->result_array() as $artikel){ ?>
		{
            name: 'Laki Laki & Perempuan',
            data: [
					<?php echo $artikel['l']; ?>,
					<?php echo $artikel['p']; ?>				]

        },
		<? } ?>
		 ]
		
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
        <th width="15%">Anak Laki Laki Gizi Buruk</th>		
        <th width="20%">Anak Perempuan Gizi Buruk</th>
        <th width="18%">Jumlah Anak Gizi Buruk</th>
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