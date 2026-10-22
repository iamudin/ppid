 <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#"><?php echo $judul_lengkap.'  '.$instansi; ?></a></li>
                                    <li class="breadcrumb-item"><a href="#">Kepegawaian</a></li>
                                   
                                </ol>
                            </div>
                            <h4 class="page-title">Kepegawaian</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                   	<div class="btn-toolbar" style="margin-bottom:20px;">
		<a class="btn btn-success" href="<?php echo base_url(); ?>webadmin/tambahkepegawaian"> Tambah Data</a>&nbsp;
        <a class="btn btn-info" href="<?php echo base_url(); ?>webadmin/tambahjabatan">Tambah Jabatan</a>&nbsp;
        <a class="btn btn-danger" href="<?php echo base_url(); ?>webadmin/kepegawaian">Refresh</a>
		
	</div>
                                    <div class="table-responsive5">
     <?php
foreach($edit->result_array() as $d)
{
	$id = $d['id_jabatan'];
}
?>
<form method="post" action="<?php echo base_url(); ?>webadmin/updatejabatan">
<div class="form-group">
                            <label class="control-label">Jabatan</label>
                            
                            <input type="search" value="<? echo $d['jabatan'];?>" name="nama" class="input form-control" size="35" /></div>
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