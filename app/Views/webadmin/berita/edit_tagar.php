 <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#"><?php echo $judul_lengkap.'  '.$instansi; ?></a></li>
                                    <li class="breadcrumb-item"><a href="#">Tagar</a></li>
                                   
                                </ol>
                            </div>
                            <h4 class="page-title">Tagar</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                   	<div class="btn-toolbar" style="margin-bottom:20px;">
		<a class="btn btn-success" href="<?php echo base_url(); ?>webadmin/tambahberita"><i class="fa fa-plus-square"></i></a>&nbsp;
        <a class="btn btn-danger" href="<?php echo base_url(); ?>webadmin/berita"><i class="fa fa-refresh"></i></a>&nbsp;
        
        <a class="btn btn-info" href="<?php echo base_url(); ?>webadmin/tagar"><i class="fa fa-tag"></i></a>
		
	</div>
                                    <div class="table-responsive5">
     <?php
foreach($edit->result_array() as $d)
{
	$id = $d['id_tag'];
}
?>
<form method="post" action="<?php echo base_url(); ?>webadmin/updatetagar">
<div class="form-group">
                            <label class="control-label">tag</label>
                            
                            <input type="search" value="<? echo $d['tag'];?>" name="nama" class="input form-control" size="35" /></div>
<button type="submit" class="btn btn-primary">Simpan Data</button>
   
<input type="hidden" name="id" value="<? echo $id;?>" />
</form>
                                        
							</div>   
                             
                              
                               
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->