

        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#"><?php echo $judul_lengkap.'  '.$instansi; ?></a></li>
                                    <li class="breadcrumb-item"><a href="#">Agenda</a></li>
                                   
                                </ol>
                            </div>
                            <h4 class="page-title">Agenda</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                   	<div class="btn-toolbar" style="margin-bottom:20px;">
		<a class="btn btn-success" href="<?php echo base_url(); ?>webadmin/tambahagenda"> Tambah Data</a>&nbsp;
        <a class="btn btn-danger" href="<?php echo base_url(); ?>webadmin/agenda">Refresh</a>
	</div>
                                    <div class="table-responsive5">
<script src="<?php echo base_url(); ?>gambarbengkalis/tinymce/tinymce.min.js"></script>

<script type="text/javascript">
         var BASE_URL = "<?php echo base_url(); ?>gambarbengkalis"; // use your own base url
         tinymce.init({
             selector: "#editor1",
             theme: "modern",
             // width: 680,
             height: 300,
             relative_urls: false,
             remove_script_host: false,
             // document_base_url: BASE_URL,
             plugins: [
                 "advlist autolink link image lists charmap print preview hr anchor pagebreak",
                 "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
                 "table contextmenu directionality emoticons paste textcolor responsivefilemanager code"
             ],
             toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect | responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code",
             image_advtab: true,
             external_filemanager_path: BASE_URL + "/filemanager/",
             filemanager_title: "Media Gallery",
             filemanager_access_key:"myPrivateKey" ,
             external_plugins: { "filemanager": BASE_URL + "/filemanager/plugin.min.js" }
         });
     </script>
<?php echo form_open_multipart('webadmin/updateagenda');?>

<?php
foreach($detail->result_array() as $e){
$ps=array();
$ps=explode("-",$wkt_skr);
$tgl_skr=$ps[0];
$bln_skr=$ps[1];
$thn_skr=$ps[2];
$psh=array();
$psh=explode("-",$e["tgl_mulai"]);
$tgl_ml=$psh[2];
$bln_ml=$psh[1];
$thn_ml=$psh[0];
$psh2=array();
$psh2=explode("-",$e["tgl_selesai"]);
$tgl_sl=$psh2[2];
$bln_sl=$psh2[1];
$thn_sl=$psh2[0];
$judul=$e["tema_agenda"];
$isi=$e["isi"];
$tempat=$e["tempat"];
$waktu=$e["jam"];
$keterangan=$e["keterangan"];
$id=$e["id_agenda"];

//
$p1=$e["id1"];
$p2=$e["id2"];
$p3=$e["id3"];
$ket1=$e["ket1"];
$ket2=$e["ket2"];
$ket3=$e["ket3"];
//
}
?>
<div class="form-group">
                            <label class="control-label">Judul</label>
<input type="search" name="judul" class="input form-control" value="<?php echo $judul; ?>"></div>
<div class="form-group">
                            <label class="control-label">
Isi</label>
<textarea id="editor1" name="isi" cols="60" class="ckeditor form-control"><?php echo $isi; ?></textarea>
</div>
<div class="form-group">
                            <label class="control-label">Tanggal</label>
  <?php
echo "<select name='tgl_mulai' class='form-control'>";
for($i=1;$i<32;$i++)
{
if($tgl_ml==$i){
echo "<option selected>".$i."</option>";
}
else{
echo "<option>".$i."</option>";
}
}
echo "</select> - ";

echo "<select name='bln_mulai' class='form-control''>";
for($i=1;$i<13;$i++)
{
if($bln_ml==$i){
echo "<option selected>".$i."</option>";
}
else{
echo "<option>".$i."</option>";
}
}
echo "</select> - ";

echo "<select name='thn_mulai' class='form-control'>";
for($i=$thn_skr-2;$i<=$thn_skr+2;$i++)
{
if($thn_ml==$i){
echo "<option selected>".$i."</option>";
}
else{
echo "<option>".$i."</option>";
}
}
echo "</select>";
?>
</div>

<div class="form-group">
                            <label class="control-label">
                            Waktu Kegiatan</label>
                            <input type="search" name="jam" class="input form-control" size="80" value="<?php echo $waktu; ?>"></div>
                            
                           <div class="form-group">
                            <label class="control-label">Lokasi</label>
                            <input value="<?php echo $tempat; ?>" type="search" name="lokasi" class="input form-control" size="80"></div>  
                              
                          
                             
                           
                            
<input type="submit"  value="Simpan" class="btn btn-primary"/>
  <input type="hidden" name="id_agenda" value="<?php echo $id; ?>" />
            </form>
                            
							</div>   
                             
                              
                               
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->
            