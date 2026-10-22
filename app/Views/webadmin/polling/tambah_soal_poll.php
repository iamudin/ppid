

        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#"><?php echo $judul_lengkap.'  '.$instansi; ?></a></li>
                                    <li class="breadcrumb-item"><a href="#">Polling</a></li>
                                   
                                </ol>
                            </div>
                            <h4 class="page-title">Polling</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                   	<div class="btn-toolbar" style="margin-bottom:20px;">
			<a class="btn btn-success" href="<?php echo base_url(); ?>webadmin/tambahsoalpoll"> Tambah Soal Polling</a>&nbsp;
        <a class="btn btn-success" href="<?php echo base_url(); ?>webadmin/tambahjwbpoll">Tambah Jawaban Polling</a>&nbsp;
        <a class="btn btn-danger" href="<?php echo base_url(); ?>webadmin/polling">Refresh</a>
		</div>
                                    <div class="table-responsive5">
 <form method="post" action="<?php echo base_url(); ?>webadmin/simpansoalpoll">
<div class="form-group">
                            <label class="control-label">Soal Polling</label>
<input type="search" name="soal" class="input form-control" style="width:95%;"/>
</div>
<div class="form-group">
                            <label class="control-label">Status</label>
<select name="status" class="input form-control">
<option value="N">Tidak Aktif</option><option value="Y">Aktif</option>
</select></div>

<input type="submit" value="Simpan Data" class="btn btn-primary" />
</form>
                     						</div>   
                             
                              
                               
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->
            