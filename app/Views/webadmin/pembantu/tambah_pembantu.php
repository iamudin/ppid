

        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#"><?php echo $judul_lengkap.'  '.$instansi; ?></a></li>
                                    <li class="breadcrumb-item"><a href="#">PPID</a></li>
                                   
                                </ol>
                            </div>
                            <h4 class="page-title">PPID</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                <div class="btn-toolbar" style="margin-bottom:20px;">
            <a class="btn btn-success" href="<?php echo base_url(); ?>webadmin/tambahpembantu"> Tambah Data</a>&nbsp;
        <a class="btn btn-danger" href="<?php echo base_url(); ?>webadmin/pembantu">Refresh</a>
            </div>
                             <div class="table-responsive5">
 <form enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>webadmin/simpanpembantu">
<div class="form-group">
                            <label class="control-label">
                            Nama Pengguna</label>
                            <input name="nama" type="search" class="input form-control" placeholder="Contoh : SEKRETARIAT DAERAH" size="35" /></div>
                            <div class="form-group">
                            <label class="control-label">Email</label>
                <textarea name="isi" class="form-control" id="alamat" placeholder="Contoh : humaspemkabbengkalis@gmail.com "></textarea></div>
                            
                             <div class="form-group">
                            <label class="control-label">Perangkat Daerah</label>
  
<select name="kategori"  id="kategori" class="form-control">
<option value="">Pilih SKPD/OPD</option>
<?php
foreach($kategori->result_array() as $k)
{
echo"<option value='".$k['id_skpd']."'>".$k['skpd']."</option>";
}
?>
</select></div>
                           
                            <div class="form-group">
                            <label class="control-label">Username</label>
                            <input name="username" type="search" class="input form-control" id="username" placeholder="Contoh : humasbengkalis" size="30" /></div>
                            <div class="form-group">
                            <label class="control-label">Password</label>
                            <input name="password" type="search" class="input form-control" id="password" placeholder="Contoh : Password" size="30" /></div>
<hr>
                                          <div class="form-group">
                            <label class="control-label"> Cover</label>
              <input type="file" name="userfile" size="40" class="form-control"/></div>
                                           
                              <div class="form-group">
                            <label class="control-label">Facebook</label>
              <input name="fb" type="search" class="form-control" placeholder="Contoh : https://www.facebook.com/HumasBengkalis/"  size="55"/>
    </div>
    
      <div class="form-group">
                            <label class="control-label">Twitter</label>
              <input name="tw" type="search" class="form-control" placeholder="Contoh : https://twitter.com/humasbengkalis"  size="55"/>
    </div>
    
      <div class="form-group">
                            <label class="control-label">Intagram</label>
              <input name="ig" type="search" class="form-control" placeholder="Contoh : https://www.instagram.com/humas.bengkalis/"  size="55"/>
    </div>
                            
                            <div class="form-group">
                            <label class="control-label">Gplus</label>
              <input name="gp" type="search" class="form-control" placeholder="Contoh : https://plus.google.com/+HumasPemkabBengkalis"  size="55"/>
    </div>
                             <div class="form-group">
                            <label class="control-label">Youtube</label>
              <input name="yt" type="search" class="form-control" placeholder="Contoh : https://www.youtube.com/c/HumasPemkabBengkalis"  size="55"/>
    </div>
                            
                                     <div class="form-group">
                            <label class="control-label">Website</label>
              <input name="web" type="search" class="form-control" placeholder="Contoh : https://humas.bengkaliskab.go.id/"  size="55"/>
    </div>
                
                                               <div class="form-group">
                            <label class="control-label">Alamat</label>
              <input name="alamat" type="search" class="form-control" placeholder="Contoh : Jl. Jendral Ahmad Yani No. 070 Bengkalis 28712 - Riau"  size="55"/>
    </div>
                                         
                             <button type="submit" class="btn btn-primary">Simpan Data</button>
			 
</form> 
                                   </div>      
                             
                              
                               
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->
