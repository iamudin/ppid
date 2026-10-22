

        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#"><?php echo $judul_lengkap.'  '.$instansi; ?></a></li>
                                    <li class="breadcrumb-item"><a href="#">Menu Statis</a></li>
                                   
                                </ol>
                            </div>
                            <h4 class="page-title">Menu Statis</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">

                             <form name="frmContent" method="POST" action="<?php echo base_url()?>webadmin/updatemenu">
<?php
	foreach($edit->result_array() as $d)
	{
		$dt_id = $d["id"];
		$id_dt = $d["title"];
		$content = $d["id_parent"];
		$status = $d["status"];
		$status2 = $d["link"];
		
	}
?>
	<input type="hidden" name="id" value="<?php echo $dt_id; ?>" />
 <div class="form-group">
                            <label class="control-label">Menu Induk</label>
 <select class="form-control" name="kategori"  id="kategori2">
   <option value="induk">MENU INDUK</option>
    <?php
	foreach($daftar->result_array() as $s)
	{
		if($s['id']==$content)
		{
		echo "<option value='".$s['id']."' selected>".$s['id']." - ".$s['title']."</option>";
		}
		else
		{
		echo "<option value='".$s['id']."'>".$s['id']." - ".$s['title']."</option>";
		}
	}
	?>	
    </select></div>
     <div class="form-group">
                            <label class="control-label">Label Menu</label>
  <input value="<?php echo $id_dt; ?>" type="search" class="form-control" name="permalink" style="width:90%" id="permalink" /></div>
 <div class="form-group">
                            <label class="control-label">Menu Bawah / Download</label><?
  if($status=="Y")
  	{
	
   ?>
<input checked name="visible" type="radio" value="Y">Download / Upload &nbsp;<input name="visible" type="radio" value="N">
Statis &nbsp;<input name="visible" type="radio" value="LINK">
Link&nbsp;<input name="visible" type="radio" value="BERITA">Berita
<?
	}
	else if($status=="N")
	{
		?>
      <input name="visible" type="radio" value="Y">Download / Upload &nbsp;<input checked name="visible" type="radio" value="N">
Statis &nbsp;<input name="visible" type="radio" value="LINK">
Link&nbsp;<input name="visible" type="radio" value="BERITA">Berita
        
        <?
	}
	else if($status=="LINK")
	{
	?>
    <input name="visible" type="radio" value="Y">Download / Upload &nbsp;<input  name="visible" type="radio" value="N">
Statis &nbsp;<input name="visible" checked type="radio" value="LINK">
Link&nbsp;<input name="visible" type="radio" value="BERITA">Berita
    <?
	}
	else{
	?>
    <input name="visible" type="radio" value="Y">Download / Upload &nbsp;<input  name="visible" type="radio" value="N">
Statis &nbsp;<input name="visible" type="radio" value="LINK">
Link&nbsp;<input name="visible" checked type="radio" value="BERITA">Berita
    
    <?
	}
	?>
    </div>
     <div class="form-group">
                            <label class="control-label">Link</label>
<input value="<?php echo $status2; ?>" class="form-control" type="search" name="permalink2" style="width:50%" id="permalink2" /> * Masukan Link Tujuan Jika Pilihan (LINK)</div>
<input type="submit" value="Simpan Data" class="btn btn-primary" />

            </form>
                               
                 
                             
                              
                               
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->


       