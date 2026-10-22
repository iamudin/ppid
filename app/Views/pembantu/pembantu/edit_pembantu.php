 <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="header-icon"><i class="pe-7s-door-lock"></i></div>
                    <div class="header-title">
                        <h1>PPID Pembantu</h1>
                        <small><?php echo $this->config->item("nama_aplikasi_full"); ?></small>
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url(); ?>webadmin"><i class="pe-7s-home"></i> Home</a></li>
                            
                            <li class="active">Welcome</li>
                        </ol>
                    </div>
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-bd lobidrag">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4>Master Data</h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                   	<div class="btn-toolbar" style="margin-bottom:20px;">
		       <a class="btn btn-default" href="<?php echo base_url(); ?>pembantu/pengguna">Refresh</a>
	
	</div>
                                    <div class="table-responsive">
  <?php
foreach($edit->result_array() as $d)
{
	$id = $d['id_pembantu'];
}
?>
<form enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>pembantu/updatepembantu">
<div class="form-group">
                            <label class="control-label">Nama Pengguna</label>
                            <input name="nama" type="search" class="input form-control" value="<? echo $d['nama'];?>" size="35" readonly /></div>
                            <div class="form-group">
                            <label class="control-label">Email</label>
                           
                            
                            <input name="alamatku" type="search" class="input form-control" placeholder="Contoh : humaspemkabbengkalis@gmail.com " value="<? echo $d['email'];?>" size="35" /></div>
                            
                            </div>
                            
                            <div class="form-group">
                            <label class="control-label">SKPD/OPD</label>
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
<input name="username" type="search" class="input form-control" id="username" value="<? echo $d['username'];?>" size="30" readonly /></div>
<div class="form-group">
                            <label class="control-label">Password</label>
<input name="password" type="search" class="input form-control" id="password" placeholder="Kosongkan Jika Password Tidak Di Ganti.." size="30" /></div>
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
              <input name="web" type="search" class="form-control" placeholder="Contoh : https://humas.bengkaliskab.go.id/" value="<? echo $d['webiste'];?>"  size="55"/>
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
                        </div>
                    </div>
                    
                </section> <!-- /.content -->
            </div> <!-- /.content-wrapper -->
            