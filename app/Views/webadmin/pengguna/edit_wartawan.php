

        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#"><?php echo $judul_lengkap.'  '.$instansi; ?></a></li>
                                    <li class="breadcrumb-item"><a href="#">Pengguna</a></li>
                                   
                                </ol>
                            </div>
                            <h4 class="page-title">Pengguna</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                   	<div class="btn-toolbar" style="margin-bottom:20px;">
			<a class="btn btn-success" href="<?php echo base_url(); ?>webadmin/tambahpengguna"> Tambah Data</a>&nbsp;
        <a class="btn btn-danger" href="<?php echo base_url(); ?>webadmin/pengguna">Refresh</a>
	
	</div>
                                    <div class="table-responsive5">
  <?php
foreach($edit->result_array() as $d)
{
	$id = $d['kode_wartawan'];
}
?>
<form method="post" action="<?php echo base_url(); ?>webadmin/updatewartawan">
<div class="form-group">
                            <label class="control-label">Nama Pengguna</label>
                            <input type="search" value="<? echo $d['nama'];?>" name="nama" class="input form-control" size="35" /></div>
                            <div class="form-group">
                            <label class="control-label">Alamat</label>
                            <textarea name="alamat" type="search" class="input form-control" value="<? echo $d['alamat'];?>" id="alamat" /></textarea></div>
<div class="form-group">
                            <label class="control-label">Username</label>
<input name="username" type="search" class="input form-control" id="username" value="<? echo $d['username'];?>" size="30" /></div>
<div class="form-group">
                            <label class="control-label">Password</label>
<input name="password" type="search" class="input form-control" id="password" 
value="<? echo $d['password'];?>" size="30" /></div>

<div class="form-group">
                            <label class="control-label">Password</label>
	<select name="status"  class="input form-control" id="kategori2">
                                        <option value="">Pilih Status</option>
                                        <?php 
                                        $status=$d['akses'];
										if($status=="admin"){?>
                                       <option value="superadmin">
                                        	Super Admin
                                        </option>
                                        <option value="admin" selected>
                                        	Admin
                                        </option>
                                        <option value="user">
                                        	User
                                        </option>
                                        <option value="superadmin">
                                        	Super Admin
                                        </option>
                                        
                                        <?php }elseif($status=="user"){ ?>
                                           <option value="admin">
                                        	Admin
                                        </option>
                                        <option selected value="user">
                                        	User
                                        </option>
                                          <option value="superadmin">
                                        	Super Admin
                                        </option>
                                           <?php }elseif($status=="superadmin"){ ?>
                                           <option value="admin">
                                        	Admin
                                        </option>
                                        <option value="user">
                                        	User
                                        </option>
                                           <option selected value="superadmin">
                                        	Super Admin
                                        </option>
           
                                        <? } else{?>
                                             <option value="admin">
                                        	Admin
                                        </option>
                                        <option value="user">
                                        	User
                                        </option>
                                        <option value="superadmin">
                                        	Super Admin
                                        </option>
                                        
                                        <?php } ?>
									   </select></div>

 <button type="submit" class="btn btn-primary">Simpan Data</button>
		
<input type="hidden" name="id" value="<? echo $id;?>" />
</form>                      	</div>   
                             
                              
                               
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->
