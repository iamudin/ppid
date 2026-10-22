<section id="tour-des" class="bg-gray">
		<div class="content-box">
			<h6 style="text-transform: capitalize;">Status Permohonan Keberatan</h6>
			<h2>PPID Kabupaten Bengkalis</h2>
			<div class="dlab-separator-outer ">
                                <div class="dlab-separator bg-warning style-skew"></div>
                            </div>
		</div>
		<div class="container">
			
					
				
			
			<table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead>
<tr><td width="25"><strong>No.</strong></td>
  <td width="57"><strong>Data Pemohon</strong></td>
  <td width="97"><strong>Judul Pengaduan<em>*</em></strong></td>
  <td width="107"><strong>Alasan</strong></td>
<td width="107"><strong>Isi</strong></td>
<td width="107"><strong>Tanggal</strong></td>
<td width="56"><strong>Status</strong></td>
<td width="56"><strong>Waktu Pemenuhan</strong></td>
</tr>
</thead>
<tbody>
<?php 
$no = 1;
foreach($semua->result_array() as $artikel){
			if($artikel['status']=="N"){
					
					$tt="Proses";
					$tt2="info";
				}
	elseif($artikel['status']=="Ditanggapi"){
		
		$tt=$artikel['status'];
		$tt2="success";
	}
	elseif($artikel['status']=="Tidak Ditanggapi"){
		
		$tt=$artikel['status'];
		$tt2="default";
	}
	
	
	?>
<tr class="tr">
<td align='center'><?php echo $no; ?></td>
<td><strong><?php echo $artikel['nik']; ?></strong><br><strong><?php echo $artikel['nama']; ?></strong><br>
  <?php echo $artikel['alamat']; ?><br>
  <?php echo $artikel['phone']; ?><br>
  <?php echo $artikel['email']; ?><br></td>
<td><?php echo substr($artikel['rincian'],0,100); ?></td>
<td><?php echo $artikel['alasan']; ?></td>
<td><?php echo $artikel['tujuan']; ?></td>
<td><?php echo tgl_indo($artikel['posted_date']); ?></td>
<td><span class="label label-<?php echo $tt2;?>"><?php echo $tt; ?></span></td>
<td><?php echo tgl_indo($artikel['pemenuhan']); ?></td>
</tr>

  <tr>
    <td colspan="11"><hr>
							
							<table id="datatable" class="table display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th width="2%">No</th>
                                <th width="26%">Nama File</th>
                                <th width="58%">Tindakan</th>
                            </tr>
                        </thead>
                     
                        <tbody>             
                                                                        <?php 
$no = 1;
$idm=$artikel['id_keberatan'];
$dok=$this->db->query("SELECT tbl_kelengkapanberat.id_kelengkapanberat, 
	tbl_kelengkapanberat.id_keberatan, 
	tbl_kelengkapanberat.id_jk, 
	tbl_jk.jk, 
	tbl_kelengkapanberat.berkas
FROM tbl_kelengkapanberat LEFT OUTER JOIN tbl_jk ON tbl_jk.id_jk = tbl_kelengkapanberat.id_jk
WHERE tbl_kelengkapanberat.id_keberatan='$idm' AND (tbl_kelengkapanberat.id_jk='8'
 OR tbl_kelengkapanberat.id_jk='9' OR tbl_kelengkapanberat.id_jk='11' OR tbl_kelengkapanberat.id_jk='10')  order by tbl_kelengkapanberat.id_kelengkapanberat ASC");

foreach($dok->result_array() as $artikel2){
	$file = str_replace('media/file/','',$artikel2['berkas']);
		 //$realfile = $path . "/" . $file;
	?>   
                                                                         
                                                            <tr>
                                                              <td><?php echo $no;?></td>
                                                              <td><?php echo $artikel2['jk']; ?></td>
                                                              <td><a target="_blank" class="btn btn-primary" href="<?php echo base_url(); ?>media/ktp/<? echo $file;?>" ><i class="fa fa-download" aria-hidden="true"></i> Download</a>
                                                              
                                                               
                                                        
                                                              
                                                              
                                                              </td>
                                                            </tr>
                                                            
                                                            <?php $no++;} ?>
                                  <tbody> 
						</table></td>
    
    </tr>
    <tr>
    	
    	<td colspan="11">Ket : <?php echo $artikel['ket']; ?></td>
    </tr>
    
<?php 
	$no++;
 }
  
?>
</tbody>
</table>
			
 
						
		</div>
	</section>
	<!-- team end-->