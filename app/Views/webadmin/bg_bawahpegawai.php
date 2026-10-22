
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        © 2018 <?php echo $this->config->item("nama_aplikasi_full"); ?> - Bagian Humas Kabupaten Bengkalis.
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

       
        <script src="<?php echo base_url(); ?>admintema/assets/pages/dashborad.js"></script>

        <!-- App js -->
        <script src="<?php echo base_url(); ?>admintema/assets/js3/app.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>jquery-sortable-with-ajax/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>jquery-sortable-with-ajax/jquery-ui-1.7.1.custom.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){ 
						   
	$(function() {
		$("#sortTableExample tbody").sortable({ opacity: 0.6, cursor: 'move', update: function() {
			var order = $(this).sortable("serialize") + '&action=updateRecordsListings'; 
			$.post("<?=base_url('webadmin/updateku');?>", order, function(theResponse){
				$("#contentRight").html(theResponse);
			}); 															 
		}								  
		});
	});

});	
</script>

    </body>
</html>


   
