

        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#"><?php echo $judul_lengkap.'  '.$instansi; ?></a></li>
                                    <li class="breadcrumb-item"><a href="#">Agama</a></li>
                                   
                                </ol>
                            </div>
                            <h4 class="page-title">Agama</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
    <div class="btn-toolbar" style="margin-bottom:20px;">
            <a class="btn btn-success" href="<?php echo base_url(); ?>agama/create"> Tambah Data</a>&nbsp;
        <a class="btn btn-danger" href="<?php echo base_url(); ?>agama">Refresh</a>
            </div> <div class="table-responsive5">
        <table width="100%" class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th width="2%">No</th>
		<th width="90%">Agama</th>
		<th width="8%">Aksi</th>
            </tr><?php
            foreach ($agama_data as $agama)
            {
                ?>
                <tr>
			<td><?php echo ++$start ?></td>
			<td><?php echo $agama->agama ?></td>
			<td style="text-align:center">
				<?php 
				echo anchor(site_url('agama/update/'.$agama->id_agama),'<i class="fa fa-pencil"></i>','class="btn btn-sm btn-success"'); 
				echo '  '; 
				echo anchor(site_url('agama/delete/'.$agama->id_agama),'<i class="fa fa-trash"></i>','class="btn btn-sm btn-danger"','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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