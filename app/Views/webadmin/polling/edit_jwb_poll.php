

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


		 <form method="post" action="<?php echo base_url(); ?>index.php/webadmin/updatejwbpoll">
 <div class="form-group">
                            <label class="control-label">Pertanyaan</label>
<?php
foreach($detail->result_array() as $s)
{
$id_soal = $s['id_soal_poll'];
$id_jwb = $s['id_jawaban_poll'];
$jwb = $s['jawaban'];
$counter = $s['counter'];
}
?>
<select class="input form-control" name="pertanyaan" style="width:75%;">
<?php
foreach($soal_poll->result_array() as $s)
{
if($id_soal==$s['id_soal_poll'])
{
echo "<option value='".$s['id_soal_poll']."' selected='selected'>".$s['soal_poll']."</option>";
}
else{
echo "<option value='".$s['id_soal_poll']."'>".$s['soal_poll']."</option>";
}
}
?>
</select></div>
 <div class="form-group">
                            <label class="control-label">Jawaban</label>
<input type="search" class="input form-control" size="50" name="jawaban" value="<?php echo $jwb; ?>" /></div>

 <div class="form-group">
                            <label class="control-label">
                            Counter</label>
                            <input type="search" class="input form-control" size="50" name="counter" value="<?php echo $counter; ?>" /></div>

<input type="submit" class="btn btn-primary" value="Simpan Data" /> 
<input type="hidden" name="id" value="<?php echo $id_jwb; ?>" />
</form>  						</div>   
                             
                              
                               
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->