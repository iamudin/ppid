<section id="blog-single-main-detail">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-12 col-sm-12 col-12">
<div class="content-box">
			<h6 style="text-transform: capitalize;">Hasil Pencarian "<?php echo esc($id ?? ''); ?>"</h6>
			<h2>PPID Kabupaten Bengkalis</h2>
			<div class="dlab-separator-outer ">
                                <div class="dlab-separator bg-warning style-skew"></div>
                            </div>
		</div>
				

                <?php
					$nox=1;
if (!empty($semua) && $semua->num_rows() > 0) {
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
                                    <div class="post-meta date-meta">
                                        <p class="font-style"><i class="fa fa-calendar"></i> <?php echo tgl_indo($bi['tanggal']);?></p>
                                    </div>
                                    <h4 class="media-heading"><a href="<?php echo base_url(); ?>web/detailberita/<? echo $bi['id_berita'];?>/<? echo $bi['url'];?>"><? echo $bi['judul_berita'];?></a></h4>
                                    <p><?php echo string_limit_words($isi,15); ?> ...</p>
                                </div>
                            </div>
<?php
}
} else {
?>
<div class="alert alert-warning">Tidak ditemukan berita dengan kata kunci "<?php echo esc($id ?? ''); ?>"</div>
<?php
}
?>
<br>
<?php echo ! empty($paginator) ? '' . $paginator . '': '';?>
</div>
