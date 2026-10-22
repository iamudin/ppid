        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#"><?php echo $judul_lengkap.'  '.$instansi; ?></a></li>
                                    <li class="breadcrumb-item"><a href="#">Level Jabatan</a></li>
                                   
                                </ol>
                            </div>
                            <h4 class="page-title">Level Jabatan</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
    <div class="btn-toolbar" style="margin-bottom:20px;">
            <a class="btn btn-success" href="<?php echo base_url(); ?>level/create"> Tambah Data</a>&nbsp;
        <a class="btn btn-danger" href="<?php echo base_url(); ?>level">Refresh</a>
            </div> <div class="table-responsive5">
        <table width="100%" class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th width="2%">No</th>
		<th width="54%">Level</th>
		<th width="44%">Aksi</th>
            </tr><?php
            foreach ($level_data as $level)
            {
                ?>
                <tr>
			<td><?php echo ++$start ?></td>
			<td><?php echo $level->level ?></td>
			<td style="text-align:center">
				<?php 
				echo anchor(site_url('level/update/'.$level->id_level),'<i class="fa fa-pencil"></i>','class="btn btn-sm btn-success"'); 
				
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
  
   