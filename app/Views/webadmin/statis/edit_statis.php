

        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#"><?php echo $judul_lengkap.'  '.$instansi; ?></a></li>
                                    <li class="breadcrumb-item"><a href="#">Data Statis</a></li>
                                   
                                </ol>
                            </div>
                            <h4 class="page-title">Data Statis</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
            	<div class="btn-toolbar" style="margin-bottom:20px;">
			<a class="btn btn-success" href="<?php echo base_url(); ?>webadmin/tambahstatis"> Tambah Data</a>&nbsp;
        <a class="btn btn-danger" href="<?php echo base_url(); ?>webadmin/statis">Refresh</a>
			</div>
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
<form name="frmContent" method="POST" action="<?php echo base_url()?>webadmin/updatedatastatis">

<div class="form-group">
                            <label class="control-label">Data Statis</label>
<?php
	foreach($edit->result_array() as $d)
	{
		$dt_id = $d["data_id"];
		$id_dt = $d["id_data"];
		$content = $d["content"];
	}
?>
    
    <select name="data_id" class="input form-control">
	<?php
	foreach($menu->result_array() as $s)
	{
		?>
        <option value="<? echo $s['id'];?>"><b><? echo $s['title'];?></b></option>
        <?
		$sub_menu=$this->Webadmin_model->Menu_Bawah2($s['id']);
		foreach($sub_menu->result_array() as $sm)
		{
		if($sm['id']==$dt_id)
		{
		echo "<option value='".$sm['id']."' selected>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$sm['title']."</option>";
		}
		else
		{
		echo "<option value='".$sm['id']."'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$sm['title']."</option>";
		}
    }
	}
	?>	
	</select>
    
	<input type="hidden" name="id_data" value="<?php echo $id_dt; ?>" />
</div>
<div class="form-group">
                            <label class="control-label">Isi Content</label>
<textarea id="editor1" name="content" class="ckeditor form-control"><?php echo $content; ?></textarea>
</div>
<input type="submit"  value="Simpan Data" class="btn btn-primary"/>
            </form>          
                 
                             
                              
                               
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->


       