

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
$p1="";
$p2=$this->uri->segment(3);
?>
	
                                    <form method="post" action="<?php echo base_url(); ?>webadmin/simpanpetugas">
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
                            <input type="search" name="nama" class="input form-control" size="35" style="width:65%;" /></div>
                             <button type="submit" class="btn btn-primary">Simpan Data</button>
   
</form> 
<br>
<table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%"><thead>
<tr>
<th>No.</th>
<th>Agenda</th>
<th>Petugas</th>
<th>Keterangan</th>
<th>Aksi</th>
</tr>
</thead>
<tbody>
<?php 
$no = $page+1;
foreach($daftarartikel->result_array() as $artikel){ ?>
<tr>
<td align='center'><?php echo $no; ?></td>
<td><?php echo $artikel['tema_agenda']; ?></td>
<td><?php echo $artikel['nama_pegawai']; ?></td>
<td><?php echo $artikel['ket']; ?></td>
<td width="120">
  <a class="btn btn-info" href="<?php echo base_url()."webadmin/editpetugas/".$artikel['id_petugas'];?>">
    <i class="fa fa-edit"></i>
    </a>&nbsp;
  <a class="btn btn-danger" href="<?php echo base_url()."webadmin/hapuspetugas/".$artikel['id_petugas'];?>" onClick="return confirm('Anda yakin ingin menghapus data ini?')">
    <i class="fa fa-trash"></i>
    </a>
</td>

</tr>
<?php 
	$no++;
 }
  
?>
</tbody>
</table>
                                 <nav aria-label="Page navigation example">

                                 


		<?php
		echo $paginator;
		?>
		
	</nav>              
							</div>   
                             
                              
                               
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->