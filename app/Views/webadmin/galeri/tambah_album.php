

        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#"><?php echo $judul_lengkap.'  '.$instansi; ?></a></li>
                                    <li class="breadcrumb-item"><a href="#">Galeri Foto</a></li>
                                   
                                </ol>
                            </div>
                            <h4 class="page-title">Galeri Foto</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                   	<div class="btn-toolbar" style="margin-bottom:20px;">
		<a class="btn btn-success" href="<?php echo base_url(); ?>webadmin/tambahalbum"> Tambah Data</a>&nbsp;
        <a class="btn btn-danger" href="<?php echo base_url(); ?>webadmin/galeri">Refresh</a>
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
<form method="post" action="<?php echo base_url(); ?>webadmin/simpanalbum">
<div class="form-group">
                            <label class="control-label">Judul Berita Foto</label>
                            
                            <input type="search" name="nama" class="input form-control" size="35"/></div>
<div class="form-group">
                            <label class="control-label">Keterangan</label>
 <textarea  name="isi" id="editor1" class="form-control"></textarea></div>
 
   <div class="form-group">
                            <label class="control-label">Fotografer</label>
  
    <input type="search" name="fot"  size="55" class="form-control"/>
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

