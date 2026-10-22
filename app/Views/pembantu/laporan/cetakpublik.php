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
<small>REKAPITULASI INFORMASI PUBLIK<small><br>
       <small>TAHUN : <?php echo $tahun;?></small><hr>
 <table width="100%" border="1" cellpadding="2" cellspacing="0" class="grid" style="width:100%;">
 
            <thead>
                <tr>
                  <th rowspan="2" align="center">
                  NAMA PPID                    </th>
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
$status_pegawai=$this->Webadmin_model->V_Jenis_Publik($idx,"10",$tahun);
foreach($status_pegawai->result_array() as $jm){
		echo $jm['total'];
		}?></td>
                                                            <td align="center"><?php
$status_pegawai=$this->Webadmin_model->V_Jenis_Publik($idx,"191",$tahun);
foreach($status_pegawai->result_array() as $jm){
		echo $jm['total'];
		}?></td>
                                                            <td align="center"><?php
$status_pegawai=$this->Webadmin_model->V_Jenis_Publik($idx,"241",$tahun);
foreach($status_pegawai->result_array() as $jm){
		echo $jm['total'];
		}?></td>
                                                            <td align="center"><?php
$status_pegawai=$this->Webadmin_model->V_TotalPid($idx,$tahun);
foreach($status_pegawai->result_array() as $jm){
		echo $jm['total'];
		}?></td>
                                    </tr>
                                    
                                    <?php $nom++;} ?>
                                    <tr>
                                                  <td><strong>JUMLAH</strong></td>
                                                  <td align="center"><?php
$status_pegawai=$this->Webadmin_model->V_Jenis_Publik2("10",$tahun);
foreach($status_pegawai->result_array() as $jm){
		echo $jm['total'];
		}?></td>
                                                  <td align="center"><?php
$status_pegawai=$this->Webadmin_model->V_Jenis_Publik2("191",$tahun);
foreach($status_pegawai->result_array() as $jm){
		echo $jm['total'];
		}?></td>
                                                  <td align="center"><?php
$status_pegawai=$this->Webadmin_model->V_Jenis_Publik2("241",$tahun);
foreach($status_pegawai->result_array() as $jm){
		echo $jm['total'];
		}?></td>
                                                  <td align="center"><?php
$status_pegawai=$this->Webadmin_model->V_TotalPid2($tahun);
foreach($status_pegawai->result_array() as $jm){
		echo $jm['total'];
		}?></td>
              </tr>
                            </tbody>
        </table>
        
        </div>