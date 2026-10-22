

        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#"><?php echo $judul_lengkap.'  '.$instansi; ?></a></li>
                                    <li class="breadcrumb-item"><a href="#">Perangkat Daerah</a></li>
                                   
                                </ol>
                            </div>
                            <h4 class="page-title">Perangkat Daerah</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                <div class="btn-toolbar" style="margin-bottom:20px;">
            <a class="btn btn-success" href="<?php echo base_url(); ?>webadmin/tambahskpd"> Tambah Data</a>&nbsp;
        <a class="btn btn-danger" href="<?php echo base_url(); ?>webadmin/skpd">Refresh</a>
            </div>
                             <div class="table-responsive5">
                             <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead>
<tr align="center"><th width="3%"><strong>No</strong></th>
<th width="48%"><strong>Nama Perangkat Daerah</strong></th>
<th width="38%">
  Aksi
</th>
</tr>
</thead>
<tbody>
<?php 
$no = 1+$page;
foreach($detail->result_array() as $artikel){ ?>
<tr class="tr">
<td><?php echo $no; ?></td>
<td><?php echo $artikel['skpd']; ?></td>
<?php
echo"<td>
    <a class='btn btn-info' href='".base_url()."index.php/webadmin/editskpd/".$artikel['id_skpd']."'><i class='fa fa-edit'></i></a>
    <a class='btn btn-danger' href='".base_url()."index.php/webadmin/hapusskpd/".$artikel['id_skpd']."' onClick=\"return confirm('Anda yakin ingin menghapus data ini?')\" ><i class='fa fa-trash'></i></a></td>";
?>
</tr>
<?php 
$no++;
 }
  
?>
</tbody>
</table>



<?php
        echo $paginator;
        ?>
                               
                                </div>      
                             
                              
                               
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->


       