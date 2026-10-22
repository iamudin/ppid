

        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#"><?php echo $judul_lengkap.'  '.$instansi; ?></a></li>
                                    <li class="breadcrumb-item"><a href="#">Pengunjung</a></li>
                                   
                                </ol>
                            </div>
                            <h4 class="page-title">Pengunjung</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                   	<div class="btn-toolbar" style="margin-bottom:20px;">
		  <a class="btn btn-danger" href="<?php echo base_url(); ?>webadmin/kritik">Refresh</a>&nbsp;
		<a class="btn btn-success" href="<?php echo base_url(); ?>webadmin/kritikview">Data Yang Di Tampilkan</a>

	</div>
                                    <div class="table-responsive5">
     <script type="text/javascript" src="<?php echo base_url(); ?>editor/ckeditor/ckeditor.js"></script>
<?php
foreach($edit->result_array() as $d)
{
	$id = $d['id_hubungi'];
}
?>
<form method="post" action="<?php echo base_url(); ?>webadmin/updatekontak">
<div class="form-group">
                            <label class="control-label">Nama Pembaca</label>
                            <input type="search" value="<? echo $d['nama'];?>" name="nama" class="input form-control" size="35" /></div>
                            <div class="form-group">
                            <label class="control-label">Email</label>
<input name="email" type="search" class="input form-control" value="<? echo $d['email'];?>" size="40" id="email" /></div>
<div class="form-group">
                            <label class="control-label">Pesan</label><textarea name="pesan" cols="30" id="alamat" class="ckeditor form-control"><? echo $d['pesan'];?></textarea></div>
                            <div class="form-group">
                            <label class="control-label">Kirim Balasan</label><textarea name="pesan2" cols="30" id="pesan" class="ckeditor form-control"></textarea></div>
        <div class="form-group">
                            <label class="control-label">                    
                            Status</label>
                            <select name="status" style="width:50px;" >
<option value="Y">Y</option>
<option value="N">N</option>
</select></div>

<input type="submit"  value="Simpan Data" class="btn btn-primary"/>
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

            