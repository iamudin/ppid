

        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#"><?php echo $judul_lengkap.'  '.$instansi; ?></a></li>
                                    <li class="breadcrumb-item"><a href="#">Paper</a></li>
                                   
                                </ol>
                            </div>
                            <h4 class="page-title">Paper</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                   	<div class="btn-toolbar" style="margin-bottom:20px;">
		<a class="btn btn-success" href="<?php echo base_url(); ?>webadmin/tambahpaper"> Tambah Data</a>&nbsp;
        <a class="btn btn-danger" href="<?php echo base_url(); ?>webadmin/paper">Refresh</a>
	
	</div>
                                    <div class="table-responsive5">
         <?php
foreach($edit->result_array() as $d)
{
	$id = $d['id_paper'];
}
?>

 <style type="text/css">
.batasiklan{
	border-bottom:2px solid #dba427;
	padding-bottom:5px;
	font-size:16px;
}

</style>
<?php
$menuk=$id;
?>
 <script src="<?php echo base_url(); ?>asset/blank/assets/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>
       
<link href="<?php echo base_url(); ?>drop/dropzone.min.css" type="text/css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>drop/dropzone.min.js"></script>
     <form enctype="multipart/form-data" action="<?php echo site_url('/webadmin/uploadpdfbaru'); ?>" class="dropzone"  >
     <input type="hidden" name="id_param" value="<?php echo $menuk;?>">
</form>
				</div>   
                             
                              
                               
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->
            