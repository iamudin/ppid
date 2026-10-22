
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
       <div align="center"><h2>Permohonan Keberatan</h2></div>
       
       <br>
<br>
        
         <?php 
$no=1;
foreach($status_pegawai->result_array() as $artikel){ ?>
        <table border="0" cellspacing="1" cellpadding="0" width="100%">
  <tr>
    <td colspan="3" align="right">&nbsp;</td>
  </tr>
  <tr>
   
    <td colspan="3" align="right">&nbsp;</td>
  </tr>
  <tr>
    <td width="25%" align="left"><strong>No.Register</strong></td>
    <td width="1%">:</td>
    <td width="74%" align="left"><?php echo $artikel['register']; ?></td>
  </tr>
  <tr>
    <td align="left">&nbsp;</td>
    <td>&nbsp;</td>
    <td align="left">&nbsp;</td>
  </tr>
  <tr>
    <td width="25%" align="left"><strong>No.Identitas</strong></td>
             <td width="1%">:</td>
             <td width="74%" align="left"><?php echo $artikel['nik']; ?></td>
        </tr>
           <tr>
             <td align="left">&nbsp;</td>
             <td>&nbsp;</td>
             <td align="left">&nbsp;</td>
           </tr>
           <tr>
             <td align="left"><strong>Nama</strong></td>
             <td>:</td>
             <td align="left"><?php echo $artikel['nama']; ?></td>
        </tr>
           <tr>
             <td align="left">&nbsp;</td>
             <td>&nbsp;</td>
             <td align="left">&nbsp;</td>
           </tr>
           <tr>
             <td align="left"><strong>Alamat</strong></td>
             <td>:</td>
             <td align="left"><?php echo $artikel['alamat']; ?></td>
           </tr>
           <tr>
             <td align="left">&nbsp;</td>
             <td>&nbsp;</td>
             <td align="left">&nbsp;</td>
           </tr>
           <tr>
             <td align="left"><strong>Email</strong></td>
             <td>:</td>
             <td align="left"><?php echo $artikel['email']; ?></td>
        </tr>
           <tr>
             <td align="left">&nbsp;</td>
             <td>&nbsp;</td>
             <td align="left">&nbsp;</td>
           </tr>
           <tr>
             <td align="left"><strong>No Telepon</strong></td>
             <td>:</td>
             <td align="left"><?php echo $artikel['phone']; ?></td>
        </tr>
           <tr>
             <td align="left">&nbsp;</td>
             <td>&nbsp;</td>
             <td align="left">&nbsp;</td>
           </tr>
           <tr>
             <td align="left"><strong>Pekerjaan</strong></td>
             <td>:</td>
             <td align="left"><?php echo $artikel['pekerjaan']; ?></td>
        </tr>
           <tr>
             <td align="left">&nbsp;</td>
             <td>&nbsp;</td>
             <td align="left">&nbsp;</td>
           </tr>
           <tr>
             <td align="left"><strong>Judul Pengaduan*</strong></td>
             <td>:</td>
             <td align="left"><?php echo $artikel['rincian']; ?></td>
        </tr>
           <tr>
             <td align="left">&nbsp;</td>
             <td>&nbsp;</td>
             <td align="left">&nbsp;</td>
           </tr>
           <tr>
             <td align="left"><strong>Isi</strong></td>
             <td>:</td>
             <td align="left"><?php echo $artikel['tujuan']; ?></td>
        </tr>
           <tr>
             <td align="left">&nbsp;</td>
             <td>&nbsp;</td>
             <td align="left">&nbsp;</td>
           </tr>
           <tr>
             <td align="left"><strong>Alasan keberatan</strong></td>
             <td>:</td>
             <td align="left"><?php echo $artikel['alasan']; ?></td>
        </tr>
           <tr>
             <td align="left">&nbsp;</td>
             <td>&nbsp;</td>
             <td align="left">&nbsp;</td>
           </tr>
           <tr>
             <td align="left"><strong>Status</strong></td>
             <td>:</td>
             <td align="left"><?php echo $artikel['status']; ?></td>
        </tr>
                                
                 <tr>
                   <td align="left">&nbsp;</td>
                   <td>&nbsp;</td>
                   <td align="left">&nbsp;</td>
                 </tr>
                 <tr>
                   <td align="left"><strong>Keterangan</strong></td>
             <td>:</td>
             <td align="left"><?php echo $artikel['ket']; ?></td>
        </tr>         
                  
          
      </table>     
      <?php } ?>                           
                                       
                                   