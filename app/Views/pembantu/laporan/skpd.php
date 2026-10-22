 <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="header-icon"><i class="pe-7s-door-lock"></i></div>
                    <div class="header-title">
                        <h1>RINCIAN PELAYANAN INFORMASI PUBLIK PER SKPD</h1>
                        <small>PPID Pemerintah Kabupaten Bengkalis</small>
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url(); ?>app_admin_home"><i class="pe-7s-home"></i> Home</a></li>
                            
                            <li class="active">Welcome</li>
                        </ol>
                    </div>
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-bd lobidrag">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4>Form Cetak</h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                 
                                  
                                       <form target="_blank" method="post" action="<?php echo base_url(); ?>pembantu/cetakpertahunskpd" />
                                         
                                         
                                        
                           
                                        
                                     
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
                        </div>
                </section> <!-- /.content -->
            </div> <!-- /.content-wrapper -->
            