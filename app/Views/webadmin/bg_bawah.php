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
<!-- Summernote JS -->
<script src="<?php echo base_url(); ?>admintema/assets/plugins/summernote/summernote-bs4.min.js"></script>
<script>
$(document).ready(function() {
    var $editors = $('#editor, #editor1, textarea.ckeditor');
    if ($editors.length > 0 && typeof $.fn.summernote !== 'undefined') {
        $editors.each(function() {
            var $this = $(this);
            $this.summernote({
                height: 350,
                minHeight: 250,
                placeholder: 'Tulis isi konten di sini...',
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview']]
                ],
                callbacks: {
                    onImageUpload: function(files) {
                        for (var i = 0; i < files.length; i++) {
                            uploadSummernoteImage(files[i], $this);
                        }
                    }
                }
            });
        });

        function detectCurrentModul() {
            var path = window.location.pathname || '';
            var segments = path.replace(/\/+$/, '').split('/');
            var lastSegment = segments.pop() || '';
            if (/^\d+$/.test(lastSegment) && segments.length > 0) {
                lastSegment = segments.pop() || '';
            }
            lastSegment = lastSegment.toLowerCase();

            if (lastSegment.indexOf('artikel') !== -1 || lastSegment.indexOf('berita') !== -1) return 'berita';
            if (lastSegment.indexOf('pegawai') !== -1 || lastSegment.indexOf('kepegawaian') !== -1) return 'pegawai';
            if (lastSegment.indexOf('penghargaan') !== -1) return 'penghargaan';
            if (lastSegment.indexOf('banner') !== -1) return 'banner';
            if (lastSegment.indexOf('profil') !== -1) return 'profil';
            if (lastSegment.indexOf('agenda') !== -1) return 'agenda';
            if (lastSegment.indexOf('pengumuman') !== -1) return 'pengumuman';
            if (lastSegment.indexOf('statis') !== -1) return 'statis';
            if (lastSegment.indexOf('galeri') !== -1 || lastSegment.indexOf('album') !== -1 || lastSegment.indexOf('foto') !== -1) return 'galeri';
            if (lastSegment.indexOf('download') !== -1) return 'download';
            if (lastSegment.indexOf('faq') !== -1) return 'faq';
            return lastSegment || 'berita';
        }

        function uploadSummernoteImage(file, $target) {
            var data = new FormData();
            data.append("file", file);
            data.append("modul", detectCurrentModul());
            $.ajax({
                url: "<?php echo base_url(); ?>webadmin/upload_image_summernote",
                cache: false,
                contentType: false,
                processData: false,
                data: data,
                type: "POST",
                success: function(url) {
                    $target.summernote('insertImage', url);
                },
                error: function() {
                    // Fallback: jika upload server gagal, tetap masukkan gambar sebagai Base64
                    var reader = new FileReader();
                    reader.onloadend = function() {
                        $target.summernote('insertImage', reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        // Sinkronisasi data ke textarea saat form disubmit
        $('form').on('submit', function() {
            $editors.each(function() {
                var $t = $(this);
                if ($t.summernote('isEmpty')) {
                    $t.val('');
                } else {
                    $t.val($t.summernote('code'));
                }
            });
        });
    }
});
</script>
		
    <!-- Client-side Image Compressor & WebP Converter -->
    <script src="<?php echo base_url(); ?>assets/js/image-compressor.js?v=<?php echo time(); ?>"></script>

    </body>
</html>