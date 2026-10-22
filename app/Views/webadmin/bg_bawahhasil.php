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

       
        <script src="<?php echo base_url(); ?>admintema/assets/pages/dashborad.js"></script>

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

		<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script type="text/javascript">
  jQuery(function($) {
    //highchart
    // Radialize the colors
 Highcharts.setOptions({
     colors: ['#00b495', '#ff2e4a', '#00e34e', '#24CBE5', 
     '#64E572', '#FF9655', '#FFF263',      '#6AF9C4']
    });
    $(function () {
        $('#chart').highcharts({
            chart: {
                type: 'pie',
                plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
            },
            title: {
                text: ''
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
              plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    },
                    connectorColor: ''
                }
            }
        },
            credits:{
              enabled:false
            },
            series: [{
                type: 'pie',
                name: 'Persentase',
                
                data: [
                
                                                     ['Sangat bagus', <?php
$status_pegawai=$this->Webadmin_model->V_Survey_Publik5("1");
foreach($status_pegawai->result_array() as $jm){
        echo $jm['total'];
        }?>],
              
                                                     ['Bagus',   <?php
$status_pegawai=$this->Webadmin_model->V_Survey_Publik5("2");
foreach($status_pegawai->result_array() as $jm){
        echo $jm['total'];
        }?>],
              
                                                     ['Biasa',  <?php
$status_pegawai=$this->Webadmin_model->V_Survey_Publik5("3");
foreach($status_pegawai->result_array() as $jm){
        echo $jm['total'];
        }?> ],
                                                     ['Kurang',   <?php
$status_pegawai=$this->Webadmin_model->V_Survey_Publik5("4");
foreach($status_pegawai->result_array() as $jm){
        echo $jm['total'];
        }?>],
                                                     ['Kurang sekali',   <?php
$status_pegawai=$this->Webadmin_model->V_Survey_Publik5("5");
foreach($status_pegawai->result_array() as $jm){
        echo $jm['total'];
        }?>],
              
                                               
                ]
            }]
        });
    });
  })
</script>          
    

    </body>
</html>