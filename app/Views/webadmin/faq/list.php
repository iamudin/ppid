

        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#"><?php echo $judul_lengkap.'  '.$instansi; ?></a></li>
                                    <li class="breadcrumb-item"><a href="#">Data Statis</a></li>
                                   
                                </ol>
                            </div>
                            <h4 class="page-title">Faq</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                <div class="btn-toolbar" style="margin-bottom:20px;">
            <a class="btn btn-success" href="<?php echo base_url(); ?>webadmin/tambahfaq"> Tambah Data</a>&nbsp;
        <a class="btn btn-danger" href="<?php echo base_url(); ?>webadmin/faq">Refresh</a>
            </div>
                             <div class="table-responsive5">
                            <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                            <thead>
                                                <tr>
                                                   <th width="17">No</th>
                                            <th width="307">Pertanyaan</th>
                                            <th width="191">Jawaban</th>
                                            <th width="191">Options</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                                                                   <?php
        $no=1;
        foreach($status_pegawai->result_array() as $artikel)
        {
            $warna= ($no% 2 == 1) ? "" : "odd gradeX";
    ?>
                                        <tr class="<? echo $warna;?>">
                                             <td class="center"><? echo $no;?></td> 
<td><?php echo $artikel['pertanyaan']; ?></td>
<td class="td-actions"><?php echo $artikel['jawaban']; ?></td>
                                            <td class="td-actions">
                                                
                                                        <a href="<?php echo base_url()."webadmin/editfaq/".$artikel['id_faq'];?>" class="btn btn-info">
 <i class="fa fa-edit"></i></a>&nbsp;
                                                        

                                                    
                                                                    <a onClick="return confirm('Anda yakin ingin menghapus data ini?')" href="<?php echo base_url()."webadmin/hapusfaq/".$artikel['id_faq'];?>" class="btn btn-danger">
 <i class="fa fa-trash"></i></a>
                                                        
                                          </td>
                                        </tr>
                                         <?
             $no++;
        }
        ?>
                                            </tbody>
                                        </table>
                               
                                </div>      
                             
                              
                               
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->


       