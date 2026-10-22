

        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#"><?php echo $judul_lengkap.'  '.$instansi; ?></a></li>
                                    <li class="breadcrumb-item"><a href="#">Rincian Pelayanan Informasi Publik Per Bulan</a></li>
                                   
                                </ol>
                            </div>
                            <h4 class="page-title">Rincian Pelayanan Informasi Publik Per Bulan</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
<form target="_blank" method="post" action="<?php echo base_url(); ?>webadmin/cetakpertahunsbulan" />
                                         
                                         
                                        
                           
                                        
                                     
                                        <div class="form-group row">
                                            <label for="inputHorizontalWarning" class="col-sm-2 col-form-label">Tahun</label>
                                            <div class="col-sm-3">
                                              <?php
$psh=array();
$psh=explode("-",$wkt_skr);
$tgl_skr=$psh[0];
$bln_skr=$psh[1];
$thn_skr=$psh[2];


echo "<select class='span3 input form-control' name='thn_mulai'>";
for($i=$thn_skr-2;$i<=$thn_skr+2;$i++)
{
if($thn_skr==$i){
echo "<option selected value='$i'>".$i."</option>";
}
else{
echo "<option value='$i'>".$i."</option>";
}
}
echo "</select>";
?>
                                              
                                            </div>
                                             <label for="inputHorizontalWarning" class="col-sm-1 col-form-label">Bulan </label>
                                             <div class="col-sm-3">
                                                <select   name="bulan" class="form-control">
 
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
                                            
                                        </div>
                                      
                                        <div class="form-group row">
                                     <label for="inputHorizontalDnger" class="col-sm-2 col-form-label"></label>
                                      <div class="col-sm-10">
                                         <button type="submit" class="btn btn-primary">Cetak</button>
                                         </div>
                                         </div>
                              
                                      
                            
                                    </form> 
                                   
                                    
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->


            