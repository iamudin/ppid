<section id="tour-des" class="bg-white">
		<div class="content-box">
			<h6 style="text-transform: capitalize;">Rekapitulasi </h6>
			<h2>Permohonan</h2>
			<div class="dlab-separator-outer ">
                                <div class="dlab-separator bg-warning style-skew"></div>
                            </div>
		</div>
		<div class="container">
			
					
				<script type="text/javascript">
   function group(data) {
	//alert(data);
	document.location.href = "<?php echo base_url(); ?>web/permohonanperiode/"+data;
   }
   </script>
   
    <script type="text/javascript">
   function group2(data) {
	//alert(data);
	document.location.href = "<?php echo base_url(); ?>web/permohonanperskpd/"+data;
   }
   </script>
   
<form class="form-inline" action="#">
  <div class="form-group">
      <select onchange="return group(this.value)"  name="bulan" class="form-control">
<option value="">Pilih Periode</option>   
<option value="1">Januari</option>
<option value="2">Februari</option>
<option value="3">Maret</option>
<option value="4">April</option>
<option value="5">Mei</option>
<option value="6">Juni</option>
<option value="7">Juli</option>
<option value="8">Agustus</option>
<option value="9">September</option>
<option value="10">Oktober</option>
<option value="11">November</option>
<option value="12">Desember</option>
</select>
  </div>
                        <div class="form-group">
                            
                            <select onchange="return group2(this.value)" style="width: 50%;" name="kategori2"  id="kategori" class="form-control">
<option value="">Pilih PID Utama/Pembantu</option>
<?php
foreach($kategori->result_array() as $k)
{
echo"<option value='".$k['id_skpd']."'>".$k['skpd']."</option>";
}
?>
</select>
                        </div>
</form>
<hr>
<style type="text/css">
								
								.table th {
    text-align: center;
									float: none;
}

.table {
    border-radius: 5px;
    float: none;
}
								</style>
 <table id="table" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
            <thead>
                <tr>
                  <th rowspan="2" align="center">
                  NAMA PID Utama/Pembantu                   </th>
                  <th colspan="3" align="center">PEMOHON INFORMASI</th>
                  <th colspan="2" align="center">MEKANISME    PERMOHONAN</th>
                  <th colspan="3" align="center">PELAYANAN PERMOHONAN INFORMASI</th>
                </tr>
                <tr>
                                        <th align="center">
                        PERORANGAN</th>
                                        <th align="center">
                        BADAN HUKUM                    </th>
                                        <th align="center">
                        KELOMPOK MASYARAKAT                    </th>
                                        <th align="center">
                        DATANG LANGSUNG</th>
                                        <th align="center">
                        WEBSITE                  </th>
                                        <th align="center">DIPENUHI</th>
                                        <th align="center">TIDAK DIPENUHI</th>
                                        <th align="center">
                        DITOLAK                  </th>
                                    </tr>
            </thead>
            <tbody>
            
            <?php
		$nom=1;
	    foreach($kategori->result_array() as $bi){
			$idx=$bi['id_skpd'];

		?>
                                                <tr>
                                                            <td>
                        <? echo $bi['skpd'];?>                 </td>
                                                            <td align="center"><?php
$status_pegawai=$this->News_model->V_Jenis($idx,"PRIBADI");
foreach($status_pegawai->result_array() as $jm){
		echo $jm['total'];
		}?></td>
                                                            <td align="center"><?php
$status_pegawai=$this->News_model->V_Jenis($idx,"PERUSAHAAN");
foreach($status_pegawai->result_array() as $jm){
		echo $jm['total'];
		}?></td>
                                                            <td align="center"><?php
$status_pegawai=$this->News_model->V_Jenis($idx,"ORMAS");
foreach($status_pegawai->result_array() as $jm){
		echo $jm['total'];
		}?></td>
                                                            <td align="center"><?php
$status_pegawai=$this->News_model->V_Proses_K($idx,"Mengambil Langsung");
foreach($status_pegawai->result_array() as $jm){
		echo $jm['total'];
		}?></td>
                                                            <td align="center"><?php
$status_pegawai=$this->News_model->V_Proses_K($idx,"Website");
foreach($status_pegawai->result_array() as $jm){
		echo $jm['total'];
		}?></td>
                                                            <td align="center"><?php
$status_pegawai=$this->News_model->V_Proses($idx,"DIPENUHI");
foreach($status_pegawai->result_array() as $jm){
		echo $jm['total'];
		}?></td>
                                                            <td align="center"><?php
$status_pegawai=$this->News_model->V_Proses($idx,"TIDAK DIPENUHI");
foreach($status_pegawai->result_array() as $jm){
		echo $jm['total'];
		}?></td>
                                                            <td align="center"><?php
$status_pegawai=$this->News_model->V_Proses($idx,"DITOLAK");
foreach($status_pegawai->result_array() as $jm){
		echo $jm['total'];
		}?></td>
                                    </tr>
                                    
                                    <?php $nom++;} ?>
                            </tbody>
        </table>
			
			<!--Model box-->
			
 
						
		</div>
	</section>
	<!-- team end-->