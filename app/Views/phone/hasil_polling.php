
<!--S:DETAIL-->


<div class="detail">

	<article>
	<!--S:JUDUL ARTICLE-->
	<div class="detail_area">
		<div class="date"></div>
		<h1 class="jdl">Hasil Jajak Pendapat</h1>
		<div class="clearfix"></div>
	</div>
	<!--E:JUDUL ARTICLE-->
   
		<!--S:ISI ARTICLE-->
	<div class="text_detail detail_area" id="detikdetailtext">
			   <?php
foreach($soal_polling->result_array() as $tmpl_soal){
$po=$tmpl_soal['soal_poll'];
}
?>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<!-- Mengembed Jquery -->
<script type="text/javascript">
// Meload paket API dari Google Chart
google.load('visualization', '1', {'packages':['corechart']});
// Membuat Callback yang meload API visualisasi Google Chart
google.setOnLoadCallback(drawChart);
function drawChart() {
var json = $.ajax({
url: '<?php echo base_url(); ?>Google-Chart-master/polling.php', // file json hasil query database
dataType: 'json',
async: false
}).responseText;
// Mengambil nilai JSON
var data = new google.visualization.DataTable(json);
var options = {
title: '<?php echo $po;?>',
		  chartArea:{width:"75%",height:"75%"},
		  is3D: 'true'
};
// API Chart yang akan menampilkan ke dalam div id
var chart = new google.visualization.PieChart(document.getElementById('tampil_chart'));
chart.draw(data, options);
}
</script>
         <div id="tampil_chart" style="width: 100%; height: 400px;
margin:0px
 auto;
 border:1px solid #ccc;"></div>    
               </div>
		
						                	                		               

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