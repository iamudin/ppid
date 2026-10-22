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
            text: 'Statistik Keluarga Kecamatan Pinggir'
        },
        subtitle: {
            text: 'Berdasarkan Kondisi Kehamilan'
        },
        xAxis: {
            categories: [
                'Normal',
				'Resiko Tinggi'

            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
			allowDecimals: false,
            title: {
                text: 'Jumlah Ibu'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y} KK</b></td></tr>',
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
foreach($datax->result_array() as $artikel){ 
$total_lk=$artikel['l'];
if($no=="1"){
	$warna="#CA0300";	
}
else if($no=="2"){
	$warna="#EA7201";	
}
else if($no=="3"){
	$warna="#F4F013";	
}
else{
	$warna="green";	
}

?>
		{
            name: '<?php echo $artikel['statistik']; ?>',
			color:'<? echo $warna;?>',
            data: [
					<?php echo $total_lk;?>				]

        },
		<? $no++; } ?>
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
        <th width="15%">Jumlah Keluarga</th>		
        </tr>
    </thead>
    <tbody>
	
			<?php 
$no = 1;
foreach($datax->result_array() as $artikel){ 
$total_lk+=$artikel['l'];
?>
			<tr style = "background-color : #FDFBFF">	
				<td><?php echo $no;?></td>
				<td><?php echo $artikel['statistik']; ?></td>				
				<td align="center"><?php echo $artikel['l']; ?></td>
                </tr>
                <? $no++;} ?>
		  <tr style = "background-color : #F6F2FC">
	  <td colspan="2" style="text-align:right;">Total</td>
	  <td align="center"><?php echo $total_lk;?></td>
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