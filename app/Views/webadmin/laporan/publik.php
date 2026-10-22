

        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#"><?php echo $judul_lengkap.'  '.$instansi; ?></a></li>
                                    <li class="breadcrumb-item"><a href="#">Rekapitulasi Informasi Publik</a></li>
                                   
                                </ol>
                            </div>
                            <h4 class="page-title">Rekapitulasi Informasi Publik</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
<form target="_blank" method="post" action="<?php echo base_url(); ?>webadmin/cetakpublik" />
                                         
                                         
                                        
                           
                                        
                                     
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
                                             <label for="inputHorizontalWarning" class="col-sm-1 col-form-label">SKPD/OPD </label>
                                             <div class="col-sm-3">
                                                <select name="kategori2"  id="kategori" class="form-control">
<option value="semua">SEMUA SKPD/OPD</option>
<?php
foreach($kategori2->result_array() as $k)
{
echo"<option value='".$k['id_skpd']."'>".$k['skpd']."</option>";
}
?>
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


            