

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
       <?php
    foreach($edit->result_array() as $d)
    {?>                              
<table width="100%" border="0" class="table table-bordered">
  <tbody>
    <tr>
      <td width="24%">Nama Depan</td>
      <td width="76%"><?php echo $d["nama_depan"];?></td>
    </tr>
    <tr>
      <td>Nama Belakang</td>
      <td><?php echo $d["nama_depan"];?></td>
    </tr>
    <tr>
      <td>E-mail</td>
      <td><?php echo $d["email"];?></td>
    </tr>
    <tr>
      <td>Nomor HP / WA</td>
      <td><?php echo $d["wa"];?></td>
    </tr>
    <tr>
      <td>Pekerjaan</td>
      <td><?php echo $d["pekerjaan"];?></td>
    </tr>
    <tr>
      <td>Jenis Pelayanan</td>
      <td><?php echo $d["pelayanan"];?></td>
    </tr>
    <tr>
      <td>Saran untuk peningkatan pelayanan informasi publik di PPID Kabupaten Bengkalis</td>
      <td><?php echo $d["saran"];?></td>
    </tr>
  </tbody>
</table>

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
    $jb=$k["jawaban"];

    ?>
                                <tr>
                                    <th class="text-left">
                                        <?php echo $k['pertanyaan'];?>
                                    </th>
                                    <td class="text-center">
                                    <?php if($jb=="1"){?>
                                       <i class="fa fa-check"></i>
                                    <?php }else{?>
                                        <i class="fa fa-close"></i>
                                    <?php } ?>
                                    </td>
                                    <td class="text-center">
                                         <?php if($jb=="2"){?>
                                       <i class="fa fa-check"></i>
                                    <?php }else{?>
                                        <i class="fa fa-close"></i>
                                    <?php } ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if($jb=="3"){?>
                                       <i class="fa fa-check"></i>
                                    <?php }else{?>
                                        <i class="fa fa-close"></i>
                                    <?php } ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if($jb=="4"){?>
                                       <i class="fa fa-check"></i>
                                    <?php }else{?>
                                        <i class="fa fa-close"></i>
                                    <?php } ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if($jb=="5"){?>
                                       <i class="fa fa-check"></i>
                                    <?php }else{?>
                                        <i class="fa fa-close"></i>
                                    <?php } ?>
                                    </td>
                                </tr>
								<?php } ?>
                            </tbody>
                        </table>
										

<?php } ?>

                          
                        	</div>   
                             
                              
                               
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->

            