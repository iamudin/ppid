

        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#"><?php echo $judul_lengkap.'  '.$instansi; ?></a></li>
                                    <li class="breadcrumb-item"><a href="#">Agenda</a></li>
                                   
                                </ol>
                            </div>
                            <h4 class="page-title">Agenda</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                   	<div class="btn-toolbar" style="margin-bottom:20px;">
		<a class="btn btn-success" href="<?php echo base_url(); ?>webadmin/tambahagenda"> Tambah Data</a>&nbsp;
        <a class="btn btn-danger" href="<?php echo base_url(); ?>webadmin/agenda">Refresh</a>
	</div>
                                    <div class="table-responsive5">
     <?php
foreach($edit->result_array() as $d)
{
	$id = $d['id_petugas'];
$p1=$d['id_kepegawaian'];
$p2=$d['id_agenda'];
}
?>
<form method="post" action="<?php echo base_url(); ?>webadmin/updatepetugas">

<div class="form-group">
                            <label class="control-label">Agenda</label>
                           <select name="agenda"  id="p1" class="form-control selectpicker">
<option value="">Pilih Agenda</option>
<?php
foreach($datax2->result_array() as $k)
{
if($k['id_agenda']==$p2)
{
echo"<option selected value='".$k['agenda']."'>".$k['tema_agenda']."</option>";
}else
{
	echo"<option value='".$k['id_agenda']."'>".$k['tema_agenda']."</option>";
}
}
?>
</select></div>
<div class="form-group">
                            <label class="control-label">Nama Petugas</label>
                          <select name="pegawai"  id="p1" class="form-control selectpicker">
<option value="">Pilih Petugas</option>
<?php
foreach($datax1->result_array() as $k)
{
if($k['id_kepegawaian']==$p1)
{
echo"<option selected value='".$k['id_kepegawaian']."'>".$k['nama_pegawai']."</option>";
}else
{
	echo"<option value='".$k['id_kepegawaian']."'>".$k['nama_pegawai']."</option>";
}
}
?>
</select></div>

<div class="form-group">
                            <label class="control-label">Ket</label>
                            
                            <input type="search" value="<? echo $d['ket'];?>" name="nama" class="input form-control" size="35" /></div>
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