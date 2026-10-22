<section id="tour-des" class="bg-gray">
		<div class="content-box">
			<h6 style="text-transform: capitalize;">Survey</h6>
			<h2>Pelayanan Informasi Publik</h2>
			<div class="dlab-separator-outer ">
                                <div class="dlab-separator bg-warning style-skew"></div>
                            </div>
		</div>
		<div class="container">
			   <form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>web/kirimsurvey">
					<?php
$menuk=$this->News_model->get_kode_mahasiswa5();
?> <input type="hidden" name="id_param" value="<?php echo $menuk;?>">
				<div class="row">
<div class="col-lg-4 col-md-12 col-sm-12 col-12">
	<div class="bookoing-secrty">
                        <div class="all-pacj-dfgh">
                            <h6>IDENTITAS PENGIRIM</h6>
                        </div>
                        <div class="bookk0-natd-form">
                 
                        <div class="form-group">
                            <label for="name">Nama Depan</label>
                           <input placeholder="Nama Depan" class="form-control" value="" required="required" name="nama">
                        </div>
                        <div class="form-group">
                            <label for="last-name">Nama Belakang</label>
                            <input placeholder="Nama Belakang" class="form-control" value="" required="required" name="belakang">
                        </div>

                         <div class="form-group">
                            <label for="last-name">E-mail</label>
                            <input placeholder="E-mail" class="form-control" value="" required="required" name="email">
                        </div>


                        <div class="form-group">
                            <label for="last-name">Nomor HP / WA</label>
                            <input placeholder="Nomor HP / WA" class="form-control" value="" required="required" name="hp">
                        </div>

                       

                        <div class="form-group mainm-sel">
                            <label for="text" id="form-control">Pekerjaan</label>
                                <div class="select-box">
                                    <span class="sec-po"></span>
                                     <select class="form-control select2" required id="pekerjaan" name="pekerjaan"><?php
foreach($info3->result_array() as $k)
{
echo"<option value='".$k['id_pekerjaan']."'>".$k['pekerjaan']."</option>";
}
?></select> 

                                    <div class="serv-ivmf-2 book-in">
                                        <i class="fas fa-angle-down"></i>
                                    </div>
                                </div>
                            </div>

                        
                         <div class="form-group mainm-sel">
                            <label for="text" id="form-control">Jenis Pelayanan</label>
                                <div class="select-box">
                                    <span class="sec-po"></span>
                                     <select class="form-control select2" required id="jenis_layanan" name="jenis_layanan"><?php
foreach($info4->result_array() as $k)
{
echo"<option value='".$k['id_pelayanan']."'>".$k['pelayanan']."</option>";
}
?></select> 
                                     
                                    <div class="serv-ivmf-2 book-in">
                                        <i class="fas fa-angle-down"></i>
                                    </div>
                                </div>
                            </div>

                          <div class="form-group">
                            <label for="last-name">Saran untuk peningkatan pelayanan informasi publik di PPID Kabupaten Bengkalis</label>
                            <input placeholder="Saran" class="form-control" value="" required="required" name="saran">
                        </div>
                
                
                      
                   

                    
                        </div>
                    </div>
			


</div>			
<div class="col-lg-8 col-md-12 col-sm-12 col-12"> <table class="table table-bordered">
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
{ ?>
                                <tr>
                                    <th class="text-left">
                                        <?php echo $k['pertanyaan'];?>
                                    </th>
                                    <td class="text-center">
                                        <input name="q-<?php echo $k['id_pertanyaan'];?>" type="radio" value="<?php echo $k['id_pertanyaan'];?>-1">
                                    </td>
                                    <td class="text-center">
                                        <input name="q-<?php echo $k['id_pertanyaan'];?>" type="radio" value="<?php echo $k['id_pertanyaan'];?>-2">
                                    </td>
                                    <td class="text-center">
                                        <input name="q-<?php echo $k['id_pertanyaan'];?>" type="radio" value="<?php echo $k['id_pertanyaan'];?>-3">
                                    </td>
                                    <td class="text-center">
                                        <input name="q-<?php echo $k['id_pertanyaan'];?>" type="radio" value="<?php echo $k['id_pertanyaan'];?>-4">
                                    </td>
                                    <td class="text-center">
                                        <input name="q-<?php echo $k['id_pertanyaan'];?>" type="radio" value="<?php echo $k['id_pertanyaan'];?>-5">
                                    </td>
                                </tr>
								<?php } ?>
                            </tbody>
                        </table>
<div align="right"> <div class="sunb-btn-naple">
                                <input type="submit" value="Kirim Survey" class="submit widet btn-lg" tabindex="7">
                            </div></div>
                    </div>

			    </div>
			
			<!--Model box-->
			</form>
 
						
		</div>
	</section>
	<!-- team end-->