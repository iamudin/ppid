

        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#"><?php echo $judul_lengkap.'  '.$instansi; ?></a></li>
                                    <li class="breadcrumb-item"><a href="#">Survey</a></li>
                                   
                                </ol>
                            </div>
                            <h4 class="page-title">Survey</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                   	<div class="btn-toolbar" style="margin-bottom:20px;">
		  <a class="btn btn-danger" href="<?php echo base_url(); ?>webadmin/survey">Refresh</a>&nbsp;
		<a class="btn btn-success" href="<?php echo base_url(); ?>pertanyaan">Pertanyaan Survey</a>

	</div>
                                    <div class="table-responsive5">
                                 <div id="chart"></div>
<hr>   

                          <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>&nbsp;
                                        
                                    </th>
                                    <th class="text-center" style="vertical-align: middle;">
                                        Sangat bagus
                                    </th>
                                    <th class="text-center" style="vertical-align: middle;">
                                        Bagus
                                    </th>
                                    <th class="text-center" style="vertical-align: middle;">
                                        Biasa
                                    </th>
                                    <th class="text-center" style="vertical-align: middle;">
                                        Kurang
                                    </th>
                                    <th class="text-center" style="vertical-align: middle;">
                                        Kurang sekali
                                    </th>
                                </tr>
                                <?php
                        $no=1;

foreach($info2->result_array() as $k)
{ 
    $idx=$k['id_pertanyaan'];

    ?>
                                <tr>
                                    <th class="text-left">
                                        <?php echo $k['pertanyaan'];?>
                                    </th>
                                    <td class="text-center"><?php
$status_pegawai=$this->Webadmin_model->V_Survey_Publik($idx,"1");
foreach($status_pegawai->result_array() as $jm){
        echo $jm['total'];
        }?></td>
                                    <td class="text-center"><?php
$status_pegawai=$this->Webadmin_model->V_Survey_Publik($idx,"2");
foreach($status_pegawai->result_array() as $jm){
        echo $jm['total'];
        }?></td>
                                    <td class="text-center"><?php
$status_pegawai=$this->Webadmin_model->V_Survey_Publik($idx,"3");
foreach($status_pegawai->result_array() as $jm){
        echo $jm['total'];
        }?></td>
                                    <td class="text-center"><?php
$status_pegawai=$this->Webadmin_model->V_Survey_Publik($idx,"4");
foreach($status_pegawai->result_array() as $jm){
        echo $jm['total'];
        }?></td>
                                    <td class="text-center"><?php
$status_pegawai=$this->Webadmin_model->V_Survey_Publik($idx,"5");
foreach($status_pegawai->result_array() as $jm){
        echo $jm['total'];
        }?></td>
                                </tr>
                                <?php } ?>
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

            