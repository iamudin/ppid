<section id="tour-des" class="bg-gray">
		<div class="content-box">
			<h6 style="text-transform: capitalize;">Status Permohonan Informasi Publik</h6>
			<h2>PPID Kabupaten Bengkalis</h2>
			<div class="dlab-separator-outer ">
                                <div class="dlab-separator bg-warning style-skew"></div>
                            </div>
		</div>
		<div class="container">
			
					
				
			
			 <table id="table" class="table table-sm table-striped table-bordered" cellspacing="0" width="100%">
			 	<thead>
<tr><th width="25" valign="top"><strong>No.</strong></th>
  <th width="57" valign="top"><strong>Data Pemohon</strong></th>
  <th width="97" valign="top"><strong>Rincian Informasi</strong></th>
<th width="107" valign="top"><strong>Tujuan</strong></th>
<th width="107" valign="top"><strong>Tanggal</strong></th>
<th width="56" valign="top"><strong>PPID
  Dituju</strong></th>
<th width="56" valign="top"><strong>Cara Mendapatkan Salinan Informasi</strong></th>
<th width="56" valign="top"><strong>Cara Mendapatkan Salinan Informasi</strong></th>
<th width="56" valign="top">Status</th>
<th width="56" valign="top">Download</th>
<th width="56" valign="top">Waktu Pemenuhan</th>
</tr>
</thead>

<tbody>
	
		
							<?php 
$no=1;
foreach($semua->result_array() as $artikel){ 
				if($artikel['status']=="N"){
					
					$tt="Proses";
					$tt2="info";
				}
	elseif($artikel['status']=="DIPENUHI"){
		
		$tt=$artikel['status'];
		$tt2="success";
	}
	elseif($artikel['status']=="TIDAK DIPENUHI"){
		
		$tt=$artikel['status'];
		$tt2="default";
	}
	elseif($artikel['status']=="DITOLAK"){
		
		$tt=$artikel['status'];
		$tt2="danger";
	}
	elseif($artikel['status']=="DISPOSISI"){
		
		$tt=$artikel['status'];
		$tt2="warning";
	}
				?>
							
							
						
						

<tr class="tr">
<td align='center'><?php echo $no; ?></td>
<td><strong><?php echo $artikel['nik']; ?><br><?php echo $artikel['nama']; ?></strong><br>
  <?php echo $artikel['alamat']; ?><br>
  <?php echo $artikel['phone']; ?><br>
  <?php echo $artikel['email']; ?><br>
  <?php echo $artikel['jenis']; ?></td>
<td><?php echo substr($artikel['rincian'],0,100); ?></td>
<td><?php echo $artikel['tujuan']; ?></td>
<td><?php echo tgl_indo($artikel['posted_date']); ?></td>
<td><?php echo $artikel['skpd']; ?></td>
<td><?php echo $artikel['salinan']; ?></td>
<td><?php echo $artikel['cara2']; ?></td>
<td><span class="label label-<?php echo $tt2;?>"><?php echo $tt; ?></span></td>
<td>




  <?php 
$no = 1;
$idm=$artikel['id_pemohon'];
$dok=$this->db->query("SELECT tbl_kelengkapan.id_kelengkapan, 
	tbl_kelengkapan.id_pemohon, 
	tbl_kelengkapan.id_jk, 
	tbl_kelengkapan.berkas, 
	tbl_jk.jk
FROM tbl_kelengkapan left join tbl_jk on tbl_jk.id_jk=tbl_kelengkapan.id_jk left join tbl_pemohon on tbl_pemohon.id_pemohon WHERE 
tbl_kelengkapan.id_pemohon='$idm' AND tbl_kelengkapan.id_jk!='3'
 and tbl_kelengkapan.id_jk!='4' and tbl_kelengkapan.id_jk='13' AND tbl_pemohon.status2='N'
  order by tbl_kelengkapan.id_kelengkapan ASC limit 1");

foreach($dok->result_array() as $artikel2){
	$file = str_replace('media/file/','',$artikel2['berkas']);
		 //$realfile = $path . "/" . $file;
	?>   <?php if ($artikel['download']!=""){ ?>
<a class="btn btn-primary" target="_blank" href="<?php echo $artikel['download']; ?>">LINK</a><?php } ?>
<br><br>
	<a target="_blank" class="btn btn-danger" href="<?php echo base_url(); ?>media/ktp/<? echo $file;?>" ><i class="fa fa-download" aria-hidden="true"></i> Download</a>
	<?php } ?>
</td>
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
$idm=$artikel['id_pemohon'];
$dok=$this->db->query("SELECT tbl_kelengkapan.id_kelengkapan, 
	tbl_kelengkapan.id_pemohon, 
	tbl_kelengkapan.id_jk, 
	tbl_kelengkapan.berkas, 
	tbl_jk.jk
FROM tbl_kelengkapan left join tbl_jk on tbl_jk.id_jk=tbl_kelengkapan.id_jk left join tbl_pemohon on tbl_pemohon.id_pemohon WHERE 
tbl_kelengkapan.id_pemohon='$idm' AND (tbl_kelengkapan.id_jk='1'
 OR tbl_kelengkapan.id_jk='2' OR tbl_kelengkapan.id_jk='5' OR tbl_kelengkapan.id_jk='6') AND tbl_pemohon.status2='N' order by tbl_kelengkapan.id_kelengkapan ASC");

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
    <td colspan="11">*Ket : <?php echo $artikel['ket']; ?></td>
    
    </tr>
							
							
							<?php ;$no++; } ?>
							
							
</tbody>
</table>

			
 
						
		</div>
	</section>
	<!-- team end-->