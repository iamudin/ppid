

        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#"><?php echo $judul_lengkap.'  '.$instansi; ?></a></li>
                                    <li class="breadcrumb-item"><a href="#">Berita</a></li>
                                   
                                </ol>
                            </div>
                            <h4 class="page-title">Berita</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                   	<div class="btn-toolbar" style="margin-bottom:20px;">
		<a class="btn btn-success" href="<?php echo base_url(); ?>webadmin/tambahberita"><i class="fa fa-plus-square"></i></a>&nbsp;
        <a class="btn btn-danger" href="<?php echo base_url(); ?>webadmin/berita"><i class="fa fa-refresh"></i></a>&nbsp;
        
        <a class="btn btn-info" href="<?php echo base_url(); ?>webadmin/tagar"><i class="fa fa-tag"></i></a>
        
	</div>

	 <form method="post" action="<?php echo base_url(); ?>webadmin/pencarian">
     <div class="row"> 
                <div class="col-md-12">	
     
    		 <div class="input-group">
        <div class="form-group  has-feedback">
            <input name="q" placeholder="Pencarian Berita" type="text" class="form-control" id="inputSuccess5">
            
        </div>
        <span class="input-group-btn">
            
            <input type="submit" name="cari" class="btn btn-danger" value="CARI">
        </span>
    </div>
    
			
     </div>
  </div>
   </form>
   
	                                     

                                    <div class="table-responsive">
  
                                        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead>
<tr>
<th width="33">No.</th>
<th width="269">Judul</th>
<th width="88">Kategori</th>
<th width="148">Tanggal</th>
<th width="54">Petugas</th>
<th width="54">Counter</th>
</tr>
</thead>
<tbody>
<?php 
$no = $page+1;
foreach($daftarartikel->result_array() as $artikel){ ?>
<tr>
<td align='center'><?php echo $no; ?></td>
<td><?php echo $artikel['judul_berita']; ?><br><br>

<a class="btn btn-info" href="<?php echo base_url()."webadmin/editartikel/".$artikel['id_berita'];?>">
<i class="fa fa-edit"></i>
</a>&nbsp;
  <a class="btn btn-danger" href="<?php echo base_url()."webadmin/hapusberita/".$artikel['id_berita'];?>" onClick="return confirm('Anda yakin ingin menghapus data ini?')">
 <i class="fa fa-trash"></i>
 </a>
</td>
<td><?php echo $artikel['title']; ?></td>
<td><?php echo tgl_indo($artikel['tanggal']); ?></td>
<td><strong><?php echo $artikel['editor']; ?></strong> (Editor) <br>
  <strong><?php echo $artikel['reporter']; ?></strong> (Reporter)<br>

  <strong><?php echo $artikel['video']; ?></strong> (Fotografer)
</td>

<td><?php echo $artikel['counter']; ?></td>
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