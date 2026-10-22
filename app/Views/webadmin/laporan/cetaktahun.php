<style type="text/css">
table {
    border-collapse: collapse;
}
body {
  font-family:arial;
}
td{
	font-family:arial;
	font-size:13px;
}
.isi{
		padding-left: 10px;
		padding-right: 10px;
		padding-top: 10px;
		padding-bottom: 10px;
	}
page {
  background: white;
  display: block;
  margin: 0 auto;
  margin-bottom: 0.5cm;
}
page[size="A4"] {  
  width: 29.7cm;
  height:21cm ; 
}
page[size="A4"][layout="portrait"] {
  width: 29.7cm;
  height: 21cm;  
}
page[size="A3"] {
  width: 42cm;
  height:29.7cm ;
}
page[size="A3"][layout="portrait"] {
  width: 42cm;
  height: 29.7cm;  
}
page[size="A5"] {
  width: 14.8cm;
  height: 21cm;
}
page[size="A5"][layout="portrait"] {
  width: 21cm;
  height: 14.8cm;  
}
@media print {
  body, page {
    margin: 0;
    box-shadow: 0;
  }
}
	
</style>
<body onLoad="window.print();">
<table border="0" cellpadding="1" cellspacing="1" style="width:100%;">
  <tr>
    <td width="7%" rowspan="3"><img width="50" src="<?php echo base_url(); ?>logo.png"/></td>
    <td width="93%" style="font-size:18px;">PEMERINTAH KABUPATEN BENGKALIS</td>
  </tr>
  <tr>
    <td style="font-size:14px;">Pejabat Pengelola Informasi Dan Dokumentasi</td>
  </tr>

  <tr>
    <td>Jl. Kartini No. 012 Kode Pos 28712 Bengkalis Riau<br>Email: ppid@bengkaliskab.go.id Website: www.ppid.bengkaliskab.go.id</td>
  </tr>

</table>	
       <hr>
<small>RINCIAN PELAYANAN INFORMASI PUBLIK<small><br>
<small>TAHUN : <?php echo $tahun;?></small><hr>
       
 <table width="100%" border="1" cellpadding="2" cellspacing="0" class="grid" style="width:100%;">
            
                <tr>
                  <td widtd="28%" rowspan="2" align="center"><strong>
                  BULAN                    </strong></td>
                  <td widtd="24%" colspan="3" align="center" valign="middle"><strong>PEMOHON INFORMASI</strong></td>
                  <td widtd="24%" colspan="2" align="center" valign="middle"><strong>MEKANISME    PERMOHONAN</strong></td>
                  <td widtd="24%" colspan="3" align="center" valign="middle"><strong>PELAYANAN PERMOHONAN INFORMASI</strong></td>
                </tr>
                <tr>
                                        <td widtd="8%" align="center" valign="top">
                        PERORANGAN</td>
                                        <td widtd="8%" align="center" valign="top">
                        BADAN HUKUM                    </td>
                                        <td widtd="8%" align="center" valign="top">
                        KELOMPOK MASYARAKAT                    </td>
                                        <td widtd="8%" align="center" valign="top">
                        DATANG LANGSUNG</td>
                                        <td widtd="8%" align="center" valign="top">
                        WEBSITE                  </td>
                                        <td widtd="8%" align="center" valign="top">DIPENUHI</td>
                                        <td widtd="8%" align="center" valign="top">TIDAK DIPENUHI</td>
                                        <td widtd="8%" align="center" valign="top">
                        DITOLAK                  </td>
                                    </tr>
           
            
           
                                              <?php
											  
$namaBulan = array("Januari","Februaru","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
$noBulan = 1;
    for($index=0; $index<12; $index++){ 
	$bulan=$noBulan;
	?>
                                                <tr>
                                                            <td>
                        <?php echo $namaBulan[$index];?>
                 </td>
                                                            <td align="center"><?php 
$status_pegawai=$this->Webadmin_model->V_Jenis_Bulan_Admin("PRIBADI",$bulan,$tahun);
foreach($status_pegawai->result_array() as $jm){
		echo $jm['total'];
		}?></td>
                                                            <td align="center"><?php
$status_pegawai=$this->Webadmin_model->V_Jenis_Bulan_Admin("PERUSAHAAN",$bulan,$tahun);
foreach($status_pegawai->result_array() as $jm){
		echo $jm['total'];
		}?></td>
                                                            <td align="center"><?php
$status_pegawai=$this->Webadmin_model->V_Jenis_Bulan_Admin("ORMAS",$bulan,$tahun);
foreach($status_pegawai->result_array() as $jm){
		echo $jm['total'];
		}?></td>
                                                            <td align="center"><?php
$status_pegawai=$this->Webadmin_model->V_Proses_K2_Admin("Datang Langsung",$bulan,$tahun);
foreach($status_pegawai->result_array() as $jm){
		echo $jm['total'];
		}?></td>
                                                            <td align="center"><?php
$status_pegawai=$this->Webadmin_model->V_Proses_K2_Admin("Website",$bulan,$tahun);
foreach($status_pegawai->result_array() as $jm){
		echo $jm['total'];
		}?></td>
                                                            <td align="center"><?php
$status_pegawai=$this->Webadmin_model->V_Proses2_Admin("DIPENUHI",$bulan,$tahun);
foreach($status_pegawai->result_array() as $jm){
		echo $jm['total'];
		}?></td>
                                                            <td align="center"><?php
$status_pegawai=$this->Webadmin_model->V_Proses2_Admin("TIDAK DIPENUHI",$bulan,$tahun);
foreach($status_pegawai->result_array() as $jm){
		echo $jm['total'];
		}?></td>
                                                            <td align="center"><?php
$status_pegawai=$this->Webadmin_model->V_Proses2_Admin("DITOLAK",$bulan,$tahun);
foreach($status_pegawai->result_array() as $jm){
		echo $jm['total'];
		}?></td>
                                    </tr>
                                     
                                    <?php $noBulan++;} ?>
                                  
                                       
                                        
   <tr>
     <td align="right"><strong>JUMLAH</strong></td>
                                                  <td align="center"><strong>
                                                  <?php 
$status_pegawai=$this->Webadmin_model->V_Jenis_Bulan_Admin_Total("PRIBADI",$tahun);
foreach($status_pegawai->result_array() as $jm){
		echo $jm['total'];
		}?>
                                                  </strong></td>
                                                  <td align="center"><strong>
                                                  <?php
$status_pegawai=$this->Webadmin_model->V_Jenis_Bulan_Admin_Total("PERUSAHAAN",$tahun);
foreach($status_pegawai->result_array() as $jm){
		echo $jm['total'];
		}?>
                                                  </strong></td>
                                                  <td align="center"><strong>
                                                  <?php
$status_pegawai=$this->Webadmin_model->V_Jenis_Bulan_Admin_Total("ORMAS",$tahun);
foreach($status_pegawai->result_array() as $jm){
		echo $jm['total'];
		}?>
                                                  </strong></td>
                                                  <td align="center"><strong>
                                                  <?php
$status_pegawai=$this->Webadmin_model->V_Proses_K2_Admin_Total("Datang Langsung",$tahun);
foreach($status_pegawai->result_array() as $jm){
		echo $jm['total'];
		}?>
                                                  </strong></td>
                                                  <td align="center"><strong>
                                                  <?php
$status_pegawai=$this->Webadmin_model->V_Proses_K2_Admin_Total("Website",$tahun);
foreach($status_pegawai->result_array() as $jm){
		echo $jm['total'];
		}?>
                                                  </strong></td>
                                                  <td align="center"><strong>
                                                  <?php
$status_pegawai=$this->Webadmin_model->V_Proses2_Admin_Total("DIPENUHI",$tahun);
foreach($status_pegawai->result_array() as $jm){
		echo $jm['total'];
		}?>
                                                  </strong></td>
                                                  <td align="center"><strong>
                                                  <?php
$status_pegawai=$this->Webadmin_model->V_Proses2_Admin_Total("TIDAK DIPENUHI",$tahun);
foreach($status_pegawai->result_array() as $jm){
		echo $jm['total'];
		}?>
                                                  </strong></td>
                                                  <td align="center"><strong>
                                                  <?php
$status_pegawai=$this->Webadmin_model->V_Proses2_Admin_Total("DITOLAK",$tahun);
foreach($status_pegawai->result_array() as $jm){
		echo $jm['total'];
		}?>
                                                  </strong></td>
   </tr>
                           
        </table>
        
        </div>