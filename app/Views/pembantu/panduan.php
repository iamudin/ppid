 <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="header-icon"><i class="pe-7s-door-lock"></i></div>
                    <div class="header-title">
                        <h1>Panduan</h1>
                        <small><?php echo $this->config->item("nama_aplikasi_full"); ?></small>
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url(); ?>app_admin_home"><i class="pe-7s-home"></i> Home</a></li>
                            
                            <li class="active">Welcome</li>
                        </ol>
                    </div>
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-bd lobidrag">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4>Master Data</h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                        
                                    <div class="table-responsive">
                                        
                                        
                                  
                                       
                                       <div class="panel-group" id="accordion">
    <?php
	  $no=1;
		foreach($testi2->result_array() as $artikel)
		{
			if($no==1){
				
			$ss="in";
			}
			else{
			$ss="";	
			}
	?>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $no;?>">
          <?php echo $artikel['pertanyaan']; ?>
        </a>
      </h4>
    </div>
    <div id="collapse<?php echo $no;?>" class="panel-collapse collapse <?php echo $ss;?>">
      <div class="panel-body">
       <?php echo $artikel['jawaban']; ?>
      </div>
    </div>
  </div>
  <?php $no++;} ?>
  
  
</div>
                                   
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </section> <!-- /.content -->
            </div> <!-- /.content-wrapper -->
            