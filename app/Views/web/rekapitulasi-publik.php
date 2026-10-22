<section id="tour-des" class="bg-white">
		<div class="content-box">
			<h6 style="text-transform: capitalize;">Rekapitulasi </h6>
			<h2>Informasi Publik</h2>
			<div class="dlab-separator-outer ">
                                <div class="dlab-separator bg-warning style-skew"></div>
                            </div>
		</div>
		<div class="container">
			
					<script type="text/javascript">
   function group(data) {
	//alert(data);
	document.location.href = "<?php echo base_url(); ?>web/publikperiode/"+data;
   }
   </script>
   
    <script type="text/javascript">
   function group2(data) {
	//alert(data);
	document.location.href = "<?php echo base_url(); ?>web/publikskpd/"+data;
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
				
			
			<!--Model box-->
			 <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                  <th rowspan="2" align="center">
                  NAMA PID Utama/Pembantu                   </th>
                  <th colspan="3" align="center">INFORMASI PUBLIK</th>
                  <th rowspan="2" align="center">JUMLAH</th>
                </tr>
                <tr>
                                        <th align="center">SETIAP SAAT</th>
                                        <th align="center">
                        BERKALA                    </th>
                                        <th align="center">
                        SERTA MERTA                   </th>
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
$status_pegawai=$this->News_model->V_Jenis_Publik($idx,"10");
foreach($status_pegawai->result_array() as $jm){
		echo $jm['total'];
		}?></td>
                                                            <td align="center"><?php
$status_pegawai=$this->News_model->V_Jenis_Publik($idx,"191");
foreach($status_pegawai->result_array() as $jm){
		echo $jm['total'];
		}?></td>
                                                            <td align="center"><?php
$status_pegawai=$this->News_model->V_Jenis_Publik($idx,"241");
foreach($status_pegawai->result_array() as $jm){
		echo $jm['total'];
		}?></td>
                                                            <td align="center"><?php
$status_pegawai=$this->News_model->V_TotalPid($idx);
foreach($status_pegawai->result_array() as $jm){
		echo $jm['total'];
		}?></td>
                                    </tr>
                                    
                                    <?php $nom++;} ?>
                                    <tr>
                                                  <td><strong>JUMLAH</strong></td>
                                                  <td align="center"><?php
$status_pegawai=$this->News_model->V_Jenis_Publik2("10");
foreach($status_pegawai->result_array() as $jm){
		echo $jm['total'];
		}?></td>
                                                  <td align="center"><?php
$status_pegawai=$this->News_model->V_Jenis_Publik2("191");
foreach($status_pegawai->result_array() as $jm){
		echo $jm['total'];
		}?></td>
                                                  <td align="center"><?php
$status_pegawai=$this->News_model->V_Jenis_Publik2("241");
foreach($status_pegawai->result_array() as $jm){
		echo $jm['total'];
		}?></td>
                                                  <td align="center"><?php
$status_pegawai=$this->News_model->V_TotalPid2();
foreach($status_pegawai->result_array() as $jm){
		echo $jm['total'];
		}?></td>
              </tr>
                            </tbody>
        </table>
 
						
		</div>
	</section>
	<!-- team end-->