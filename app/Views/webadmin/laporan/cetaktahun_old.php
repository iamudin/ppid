<style type="text/css">
table {
    border-collapse: collapse;
}
</style>
<table border="0" cellpadding="1" cellspacing="1" style="width:100%;">
  <tr>
    <td width="11%" rowspan="3" align="center"><img width="50" src="<?php echo base_url(); ?>logo.png"/></td>
    <td width="89%" align="center"><h3>PEMERINTAH KABUPATEN BENGKALIS</h3></td>
  </tr>
  <tr>
    <td align="center"><h1>PEJABAT PENGELOLA INFORMASI DAN DOKUMENTASI</h1></td>
  </tr>

  <tr>
    <td align="center"><h5>Jl. Kartini No. 12 Bengkalis 28712 - Riau<br>Email: ppid@bengkaliskab.go.id Website: www.ppid.bengkaliskab.go.id</h5></td>
  </tr>

</table>	
       <hr>
<div align="center"><h2>RINCIAN PELAYANAN INFORMASI PUBLIK</h2></div>
       
 <table width="100%" border="1" cellpadding="2" cellspacing="0" class="grid" style="width:100%;">
            
                <tr>
                  <th width="28%" rowspan="2" align="center"><strong>
                  BULAN                    </strong></th>
                  <th width="24%" colspan="3" align="center" valign="middle"><strong>PEMOHON INFORMASI</strong></th>
                  <th width="24%" colspan="2" align="center" valign="middle"><strong>MEKANISME    PERMOHONAN</strong></th>
                  <th width="24%" colspan="3" align="center" valign="middle"><strong>PELAYANAN PERMOHONAN INFORMASI</strong></th>
                </tr>
                <tr>
                                        <th width="8%" align="center" valign="top">
                        PERORANGAN</th>
                                        <th width="8%" align="center" valign="top">
                        BADAN HUKUM                    </th>
                                        <th width="8%" align="center" valign="top">
                        KELOMPOK MASYARAKAT                    </th>
                                        <th width="8%" align="center" valign="top">
                        DATANG LANGSUNG</th>
                                        <th width="8%" align="center" valign="top">
                        WEBSITE                  </th>
                                        <th width="8%" align="center" valign="top">DIPENUHI</th>
                                        <th width="8%" align="center" valign="top">TIDAK DIPENUHI</th>
                                        <th width="8%" align="center" valign="top">
                        DITOLAK                  </th>
                                    </tr>
           
            
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
$status_pegawai=$this->News_model->V_Proses_K($idx,"mengambil_langsung");
foreach($status_pegawai->result_array() as $jm){
		echo $jm['total'];
		}?></td>
                                                            <td align="center"><?php
$status_pegawai=$this->News_model->V_Proses($idx,"SETUJU");
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
                                     
                                    
                                    <?php $nom++;} ?> <tr>
                                        <td align="right"><strong>JUMLAH</strong></td>
                                                  <td align="center">&nbsp;</td>
                                                  <td align="center">&nbsp;</td>
                                                  <td align="center">&nbsp;</td>
                                                  <td align="center">&nbsp;</td>
                                                  <td align="center">&nbsp;</td>
                                                  <td align="center">&nbsp;</td>
                                                  <td align="center">&nbsp;</td>
                                                  <td align="center">&nbsp;</td>
   </tr>
                           
        </table>