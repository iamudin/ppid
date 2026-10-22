<section id="blog-single-main-detail">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-12 col-sm-12 col-12">
<div class="content-box">
			<h6 style="text-transform: capitalize;">Berita</h6>
			<h2>PPID Kabupaten Bengkalis</h2>
			<div class="dlab-separator-outer ">
                                <div class="dlab-separator bg-warning style-skew"></div>
                            </div>
		</div>
				

                <?php
					$nox=1;
foreach($semua->result_array() as $bi)
{
	$isi=strip_tags($bi['isi']);

?>
<div class="media meida-md">
                                <div class="media-left">

                                    <a href="<?php echo base_url(); ?>web/detailberita/<? echo $bi['id_berita'];?>/<? echo $bi['url'];?>">
                                     <div class="thumbnailku">
                                    <img class="object-fit_cover" src="<?php echo base_url(); ?>asset/berita/original/<? echo $bi['gambar'];?>" alt=""></div></a>


                                </div>
                                <!-- /.Post image -->
                                <div class="media-body">
                                    <div class="post-header">



                                        <h3 class="media-heading"><a href="<?php echo base_url(); ?>web/detailberita/<? echo $bi['id_berita'];?>/<? echo $bi['url'];?>"><? echo $bi['judul_berita'];?></a></h3>
                                        <div class="entry-meta">
                                            <span class="entry-date"><i class="fas fa-calendar-alt" aria-hidden="true"></i><time><? echo tgl_indo($bi['tanggal']);?><span class="hidden-xs">- <? echo $bi['waktu'];?> WIB</span></time></span>

                                        </div>
                                        <!-- /.Post meta -->
                                            <p class="d-none d-sm-block"> <? echo substr($isi,0,100);?>.</p>
                                    </div>


                                </div>
                            </div>

<?php }?>

<div class="blog-pagination d-flex justify-content-center text-center">
						<div class="wrapper blog-wrapper">
							<?php echo $paginator;?>
						</div>
					</div>
               

 
				</div>