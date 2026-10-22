

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
<?php echo form_open_multipart('webadmin/simpanagenda');?>
<div class="form-group">
                            <label class="control-label">
                            Judul</label>
                            <input type="search" name="judul" class="input form-control"></div>
                            <div class="form-group">
                            <label class="control-label">Agenda</label>
                            
<textarea id="editor1" name="isi" cols="60" class="ckeditor form-control"></textarea><div class="form-group">
                            <label class="control-label">
Tanggal</label>
    <?php
$psh=array();
$psh=explode("-",$wkt_skr);
$tgl_skr=$psh[0];
$bln_skr=$psh[1];
$thn_skr=$psh[2];

echo "<select name='tgl_mulai' class='form-control'>";
for($i=1;$i<32;$i++)
{
if($tgl_skr==$i){
echo "<option selected>".$i."</option>";
}
else{
echo "<option>".$i."</option>";
}
}
echo "</select> - ";

echo "<select name='bln_mulai' class='form-control'>";
for($i=1;$i<13;$i++)
{
if($bln_skr==$i){
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
if($thn_skr==$i){
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
                            <label class="control-label">Jam</label>
                            <input type="search" name="jam" class="input form-control" size="80"></div>
                            
                            <div class="form-group">
                            <label class="control-label">Lokasi</label>
                            <input type="search" name="lokasi" class="input form-control" size="80"></div>
                            
                             
                            
                            
                            
<input type="submit"  value="Simpan" class="btn btn-primary"/>
</form>                            
							</div>   
                             
                              
                               
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->