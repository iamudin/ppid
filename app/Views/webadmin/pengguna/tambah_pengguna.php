

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
 <form method="post" action="<?php echo base_url(); ?>webadmin/simpanwartawan">
<div class="form-group">
                            <label class="control-label">
                            Nama Pengguna</label>
                            <input type="search" name="nama" class="input form-control" size="35" /></div>
                            <div class="form-group">
                            <label class="control-label">Alamat</label>
                            <textarea name="isi" id="alamat" class="form-control"></textarea></div>
                            <div class="form-group">
                            <label class="control-label">Username</label>
                            <input type="search" name="username" class="input form-control" size="30" id="username" /></div>
                            <div class="form-group">
                            <label class="control-label">Password</label>
                            <input type="search" name="password" class="input form-control" size="30" id="password" /></div>
<div class="form-group">
                            <label class="control-label">Status</label>
                            	<select name="status"  class="input form-control" id="kategori2">
                                        <option value="">Pilih Status</option>
                                        <option value="superadmin">
                                        	Super Admin
                                        </option>
                                             <option value="admin">
                                        	Admin
                                        </option>
                                        <option value="user">
                                        	User
                                        </option>
                                        
                                        
                                      
									   </select>
                            
                            
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
