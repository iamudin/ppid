
<!--S:DETAIL-->


<div class="detail">

	<article>
	<!--S:JUDUL ARTICLE-->
	<div class="detail_area">
		<div class="date"></div>
		<h1 class="jdl">Info Bengkalis</h1>
		<div class="clearfix"></div>
	</div>
	<!--E:JUDUL ARTICLE-->
   
		<!--S:ISI ARTICLE-->
	<div class="text_detail detail_area" id="detikdetailtext">
			  <?php
	    foreach($info->result_array() as $ter){
		?>
                <table class="table">
    <thead>
      </thead>
    <tbody>
     
      <tr>
<td style="border-top:none;">Bupati </td><td style="border-top:none;"> <?php echo $ter['bupati'];?></td></tr>
<tr><td>Wakil Bupati </td><td> <?php echo $ter['wakil'];?></td></tr>
<tr><td>Hari Jadi </td><td> <?php echo $ter['hari'];?></td></tr>
<tr><td>Luas </td><td> <?php echo $ter['luas'];?></td></tr>
<tr><td>Penduduk </td><td> <?php echo $ter['penduduk'];?></td></tr>
<tr><td>Laki-Laki </td><td> <?php echo $ter['lk'];?></td></tr>
<tr><td>Perempuan </td><td> <?php echo $ter['pr'];?></td></tr>
<tr><td>Kepadatan </td><td> <?php echo $ter['kepadatan'];?></td></tr>
<tr><td>Jumlah PNS </td><td> <?php echo $ter['pns'];?></td></tr>
<tr><td>Kecamatan </td><td> <?php echo $ter['kecamatan'];?></td></tr>
<tr><td>Desa </td><td> <?php echo $ter['desa'];?></td></tr>
<tr><td>Kelurahan </td><td> <?php echo $ter['kelurahan'];?></td></tr>
<tr><td>Zona Waktu </td><td> <?php echo $ter['zona'];?></td></tr>
<tr><td>Kode Telepon </td><td> <?php echo $ter['telp'];?></td></tr>
<tr><td>Ketinggian </td><td> <?php echo $ter['tinggi'];?></td></tr>
     
    </tbody>
  </table>
                               <?php } ?>
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