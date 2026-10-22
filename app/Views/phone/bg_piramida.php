<div class="detail">
				<article>
	<!--S:JUDUL ARTICLE-->
	<div class="detail_area">
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script type="text/javascript">

$(function () {
    var categories = ['0-4', '5-9', '10-14', '15-19',
            '20-24', '25-29', '30-34', '35-39', '40-44',
            '45-49', '50-54', '55-59', '60-64', '65-69',
            '70-74', '75+ '];
    $(document).ready(function () {
        $('#desa').highcharts({
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Statistik Penduduk Kecamatan Pinggir'
            },
            subtitle: {
                text: 'Berdasarkan Kelompok Umur'
            },
            xAxis: [{
                categories: categories,
                reversed: false,
                labels: {
                    step: 1
                }
            }, { // mirror axis on right side
                opposite: true,
                reversed: false,
                categories: categories,
                linkedTo: 0,
                labels: {
                    step: 1
                }
            }],
            yAxis: {
                title: {
                    text: null
                },
                labels: {
                    formatter: function () {
                        return (Math.abs(this.value)) + '';
                    }
                },
                min: -390,
                max:  390            },

            plotOptions: {
                series: {
                    stacking: 'normal'
                }
            },

            tooltip: {
                formatter: function () {
                    return '<b>' + this.series.name + ', Umur ' + this.point.category + '</b><br/>' +
                        'Jumlah: ' + Highcharts.numberFormat(Math.abs(this.point.y), 0);
                }
            },

            series: [{
                name: 'Laki Laki',
                data: [
				<?php
							foreach($datax->result_array() as $tmpl_soal){
							?>
				-<?php echo $tmpl_soal['l']; ?>,
				<? } ?>
				]					
            }, {
                name: 'Perempuan',
                data: [<?php
							foreach($datax->result_array() as $tmpl_soal){
							?>
				<?php echo $tmpl_soal['p']; ?>,
				<? } ?>]            }]
        });
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
        <th width="43%">Kelompok Umur</th>		
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