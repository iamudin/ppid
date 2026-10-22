

        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#"><?php echo $judul_lengkap.'  '.$instansi; ?></a></li>
                                    <li class="breadcrumb-item"><a href="#">Jenis Transparansi</a></li>
                                   
                                </ol>
                            </div>
                            <h4 class="page-title">Jenis Transparansi</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
    <div class="btn-toolbar" style="margin-bottom:20px;">
            <a class="btn btn-success" href="<?php echo base_url(); ?>jenistransparansi/create"> Tambah Data</a>&nbsp;
        <a class="btn btn-danger" href="<?php echo base_url(); ?>jenistransparansi">Refresh</a>
            </div> <div class="table-responsive5">
                
       <table width="100%" class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th width="2%">No</th>
        <th width="90%">Jenis Transparansi</th>
        <th width="8%">Aksi</th>
            </tr><?php
            foreach ($jenistransparansi_data as $jenistransparansi)
            {
                ?>
                <tr>
            <td><?php echo ++$start ?></td>
            <td><?php echo $jenistransparansi->jenistransparansi ?></td>
            <td>
                <?php 
                echo anchor(site_url('jenistransparansi/update/'.$jenistransparansi->id_jenistransparansi),'<i class="fa fa-pencil"></i>','class="btn btn-sm btn-success"'); 
                echo '  '; 
                echo anchor(site_url('jenistransparansi/delete/'.$jenistransparansi->id_jenistransparansi),'<i class="fa fa-trash"></i>','class="btn btn-sm btn-danger"','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
  
   