<!-- Footer -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        © 2018 <?php echo $this->config->item("nama_aplikasi_full"); ?> - Diskominfotik Kabupaten Bengkalis.
                    </div>
                </div>
            </div>
        </footer>
        <!-- End Footer -->


        <!-- jQuery  -->
        <script src="<?php echo base_url(); ?>admintema/assets/js3/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>admintema/assets/js3/popper.min.js"></script>
        <script src="<?php echo base_url(); ?>admintema/assets/js3/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>admintema/assets/js3/modernizr.min.js"></script>
        <script src="<?php echo base_url(); ?>admintema/assets/js3/waves.js"></script>
        <script src="<?php echo base_url(); ?>admintema/assets/js3/jquery.slimscroll.js"></script>
        <script src="<?php echo base_url(); ?>admintema/assets/js3/jquery.nicescroll.js"></script>
        <script src="<?php echo base_url(); ?>admintema/assets/js3/jquery.scrollTo.min.js"></script>

       


        <!-- App js -->
        <script src="<?php echo base_url(); ?>admintema/assets/js3/app.js"></script>
        
        <script src="<?php echo base_url(); ?>multi/jquery.multiple.select.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>multi/multiple-select.css"/>
<script>
			$(document).ready(function(){
				$('#demo9').multipleSelect({
					placeholder: "Pilih Tag",
					filter:true
				});
			});
		</script>
		
         <script type="text/javascript" src="<?php echo base_url(); ?>datepicker/js/bootstrap-datepicker.js"></script>
          <script type="text/javascript">
$(document).ready(function() {
    //datepicker2
    $('.datepicker2').datepicker({
        autoclose: true,
        format: "dd-mm-yyyy",
        todayHighlight: true,
        orientation: "auto",
        todayBtn: true,
        todayHighlight: true,  
    });
    
    
    
});


</script>
<script src="<?php echo base_url(); ?>barulagi5/build/ckeditor.js"></script>
<script>
  ClassicEditor
    .create( document.querySelector( '#editor' ), {
      ckfinder: {
            // Upload the images to the server using the CKFinder QuickUpload command.
            uploadUrl: '<?php echo base_url(); ?>assets/gambar/core/connector/php/connector.php?command=QuickUpload&type=Images&responseType=json'
            }
    } )
    .then( editor => {
      window.editor = editor;
    } )
    .catch( err => {
      console.error( err.stack );
    } );
</script>
		
    <!-- Client-side Image Compressor & WebP Converter -->
    <script src="<?php echo base_url(); ?>assets/js/image-compressor.js"></script>

    </body>
</html>