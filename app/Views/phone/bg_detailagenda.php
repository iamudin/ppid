
<!--S:DETAIL-->


<div class="detail">
 
	<article>
	<!--S:JUDUL ARTICLE-->
	<div class="detail_area">
		<div class="date"></div>
		<h1 class="jdl"><? echo $judul_berita;?></h1>
		<div class="clearfix"></div>
	</div>
	<!--E:JUDUL ARTICLE-->
   
		<!--S:ISI ARTICLE-->
	<div class="detail_area">
			   <table class="table" width="100%">
                                        <tr>
                                            <td width="25%" valign="top">Tanggal</td>
                                            <td width="1%" valign="top">:</td>
                                            <td width="74%" valign="top"><? echo tgl_indo($tanggal);?></td>
                                        </tr>
                                        <tr>
                                            <td valign="top">Jam</td>
                                            <td valign="top">:</td>
                                            <td valign="top"><? echo $jam;?></td>
                                        </tr>
                                        <tr>
                                            <td valign="top">Agenda</td>
                                            <td valign="top">:</td>
                                            <td valign="top"> <?
		echo $isi;
		?> </td>
                                        </tr>
                                        <tr>
                                            <td valign="top">Lokasi</td>
                                            <td valign="top">:</td>
                                            <td valign="top"><? echo $lokasi;?> </td>
                                        </tr>
                                         <tr>
                                            <td valign="top">Petugas Liputan</td>
                                            <td>:</td>
                                            <td>
                                            <table width="100%" border="0">
  <tbody>
      <?php 
		
		$car=$this->News_model->Car_Pegawai($id_berita);
		foreach($car->result_array() as $sm)
		{ ?>
    <tr>
      <td valign="top"><img style="width:40px;" src="<?php echo base_url(); ?>asset/pegawai/<? echo $sm['gambar'];?>"></td>
      <td valign="top"><? echo $sm['nama_pegawai'];?> <br><small><i><? echo $sm['ket'];?></i></small></td>
    </tr>
     <?php } ?>
  </tbody>
</table>

                                        
        
     
       
                                            </td>
                 </tr>
                                        
                                    
      </table>
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