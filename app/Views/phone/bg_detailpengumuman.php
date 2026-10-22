
<!--S:DETAIL-->


<div class="detail">
 
	<article>
	<!--S:JUDUL ARTICLE-->
	<div class="detail_area">
		<div class="date"><? echo tgl_indo($tanggal);?></div>
		<h1 class="jdl"><? echo $judul_berita;?></h1>
		<div class="clearfix"></div>
	</div>
	<!--E:JUDUL ARTICLE-->
   
		<!--S:ISI ARTICLE-->
	<div class="text_detail detail_area" id="detikdetailtext">
			   <?
		echo $isi;
		?>
        
        <hr>
      <p>
            
       
		      <table width="100%">
<thead>
<tr>
<th>
<strong>No</strong></th>
<th><strong>Nama File</strong></th>
</tr>
</thead>
<tbody>
<?php 
	$car=$this->News_model->Car_Lampiran($id_berita);
$no = 1;
foreach($car->result_array() as $artikel){ ?>
<tr class="tr">
<td><?php echo $no; ?></td>
<td><?php echo $artikel['file']; ?><br>
  <a class="btn btn-danger btn-xs" target="_blank" href="<?php echo base_url(); ?>asset/lampiran/original/<?php echo $artikel['file']; ?>" >Download Lampiran</a>
</td>
</tr>
<?php 
$no++;
 }
  
?>
</tbody>
</table>
                                    
          
            
	</p>
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