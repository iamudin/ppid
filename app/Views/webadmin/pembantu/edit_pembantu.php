

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
  <?php
foreach($edit->result_array() as $d)
{
	$id = $d['id_pembantu'];
}
?>
<form enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>webadmin/updatepembantu">
<div class="form-group">
                            <label class="control-label">Nama Pengguna</label>
                            <input name="nama" type="search" class="input form-control" placeholder="Contoh : SEKRETARIAT DAERAH" value="<? echo $d['nama'];?>" size="35" /></div>
                            <div class="form-group">
                            <label class="control-label">Email</label>
                            <input name="alamatku" type="search" class="input form-control" placeholder="Contoh : humaspemkabbengkalis@gmail.com " value="<? echo $d['email'];?>" size="35" /></div>
                            
                            <div class="form-group">
                            <label class="control-label">Perangkat Daerah</label>
 <select name="kategori" class="input form-control" id="kategori">
  <?php
	 $tipe=$d['id_skpd'];
foreach($kategori->result_array() as $k)
{
if($k['id_skpd']==$tipe)
{
echo"<option value='".$k['id_skpd']."' selected='selected'>".$k['skpd']."</option>";
}
else{
echo"<option value='".$k['id_skpd']."'>".$k['skpd']."</option>";
}
}
?>
  </select></div>
  
  
<div class="form-group">
                            <label class="control-label">Username</label>
<input name="username" type="search" class="input form-control" id="username" placeholder="Contoh : humasbengkalis" value="<? echo $d['username'];?>" size="30" /></div>
<div class="form-group">
                            <label class="control-label">Password</label>
<input name="password" type="search" class="input form-control" id="password" placeholder="Contoh : Password" size="30" /></div>
<hr>
                                        <div class="form-group">
                            <label class="control-label"> Cover</label>
              <input type="file" name="userfile" size="40" class="form-control"/></div>
                                           
                <div class="form-group">
                  <label class="control-label">Facebook</label>
              <input name="fb" type="search" class="form-control" placeholder="Contoh : https://www.facebook.com/HumasBengkalis/" value="<? echo $d['fb'];?>"  size="55"/>
    </div>
    
      <div class="form-group">
                  <label class="control-label">Twitter</label>
              <input name="tw" type="search" class="form-control" placeholder="Contoh : https://twitter.com/humasbengkalis" value="<? echo $d['twitter'];?>"  size="55"/>
    </div>
    
      <div class="form-group">
                  <label class="control-label">Intagram</label>
              <input name="ig" type="search" class="form-control" placeholder="Contoh : https://www.instagram.com/humas.bengkalis/" value="<? echo $d['ig'];?>"  size="55"/>
    </div>
                            
                <div class="form-group">
                  <label class="control-label">Gplus</label>
              <input name="gp" type="search" class="form-control" placeholder="Contoh : https://plus.google.com/+HumasPemkabBengkalis" value="<? echo $d['gplus'];?>"  size="55"/>
    </div>
                <div class="form-group">
                  <label class="control-label">Youtube</label>
              <input name="yt" type="search" class="form-control" placeholder="Contoh : https://www.youtube.com/c/HumasPemkabBengkalis" value="<? echo $d['yt'];?>"  size="55"/>
    </div>
                            
                <div class="form-group">
                  <label class="control-label">Website</label>
              <input name="web" type="search" class="form-control" value="<? echo $d['webiste'];?>"  size="55"/>
    </div>
 <div class="form-group">
                            <label class="control-label">Alamat</label>
              <input name="alamat" type="search" class="form-control" placeholder="Contoh : Jl. Jendral Ahmad Yani No. 070 Bengkalis 28712 - Riau" value="<? echo $d['alamat'];?>"  size="55"/>
    </div>
 <button type="submit" class="btn btn-primary">Simpan Data</button>
		
<input type="hidden" name="id" value="<? echo $id;?>" />
</form>                       </div>      
                             
                              
                               
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->
