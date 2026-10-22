<section id="tour-des" class="bg-gray">
		<div class="content-box">
			<h6 style="text-transform: capitalize;">FAQ</h6>
			<h2>PPID Kabupaten Bengkalis</h2>
			<div class="dlab-separator-outer ">
                                <div class="dlab-separator bg-warning style-skew"></div>
                            </div>
		</div>
		<div class="container">
			
					 <blockquote class="bg-white" style="padding: 20px;">
                                      
                                       	Halaman Frequently Asked Question (FAQ)
 ini memuat pertanyaan dan jawaban yang sering ditanyakan.
  Sebelum Anda mengajukan pertanyaan lewat Kontak, alangkah
   baiknya jika membaca semua pertanyaan yang ada di halaman ini.
    Mungkin hal yang ingin Anda tanyakan, jawabannya ada disini. 
                                       </blockquote> 
				
			
			<div class="all-faq-cover">
						
						<div id="accordion">
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
							<div class="card wow fadeIn" data-wow-duration="1s">
								<div class="card-header" id="heading-<?php echo $no;?>">
									<h5 class="mb-0">
										<a class="collapsed" role="button" data-toggle="collapse" href="#collapse-<?php echo $no;?>" aria-expanded="false" aria-controls="collapse-2">
											 <?php echo $artikel['pertanyaan']; ?>
										</a>
									</h5>
								</div>
								<div id="collapse-<?php echo $no;?>" class="collapse" data-parent="#accordion" aria-labelledby="heading-<?php echo $no;?>">
									<div class="card-body">
										<p><?php echo $artikel['jawaban']; ?> </p>
									</div>
								</div>
							</div>
						  <?php $no++;} ?>
							
							
							
							
							
						</div>
					</div>
			
 
						
		</div>
	</section>
	<!-- team end-->