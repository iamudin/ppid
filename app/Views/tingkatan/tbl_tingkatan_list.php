

        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#"><?php echo $judul_lengkap.'  '.$instansi; ?></a></li>
                                    <li class="breadcrumb-item"><a href="#">Tingkatan Jabatan</a></li>
                                   
                                </ol>
                            </div>
                            <h4 class="page-title">Tingkatan Jabatan</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
    <div class="btn-toolbar" style="margin-bottom:20px;">
            <a class="btn btn-success" href="<?php echo base_url(); ?>tingkatan/create"> Tambah Data</a>&nbsp;
        <a class="btn btn-danger" href="<?php echo base_url(); ?>tingkatan">Refresh</a>
            </div> <div class="table-responsive5">
        <table width="100%" class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th width="2%">No</th>
		<th width="65%">Tingkatan</th>
		<th width="33%">Aksi</th>
            </tr><?php
            foreach ($tingkatan_data as $tingkatan)
            {
                ?>
                <tr>
			<td><?php echo ++$start ?></td>
			<td><?php echo $tingkatan->tingkatan ?></td>
			<td style="text-align:center">
				<?php 
				echo anchor(site_url('tingkatan/update/'.$tingkatan->id_tingkatan),'<i class="fa fa-pencil"></i>','class="btn btn-sm btn-success"'); 
				
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
        
	   
            
             <?php echo $pagination ?>
           </div>
            </div>
          </div>
        </div>
      </div> 
    </div>
    </div>
  
   