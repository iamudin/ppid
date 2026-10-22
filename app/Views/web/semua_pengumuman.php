<section id="blog-single-main-detail">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-12 col-sm-12 col-12">
<div class="content-box">
			<h6 style="text-transform: capitalize;">PPID</h6>
			<h2>Pengumuman</h2>
			<div class="dlab-separator-outer ">
                                <div class="dlab-separator bg-warning style-skew"></div>
                            </div>
		</div>
				

              <table class="table table-bordered">
                    <thead>
 <tr align="center" class="trhead">
<th width="33">No.</th>
<th width="269">Judul Pengumuman</th>
<th width="269">Tanggal</th>
<th width="269">Tindakan</th>
</tr>
</thead>
<tbody>
<?php
$nom=1;
foreach($semua->result_array() as $pengumuman)
{
?>
        <tr>
<td width="29" style="text-align:center;"><? echo $nom;?></td>
<td width="33" align="left"><? echo $pengumuman['judul_pengumuman'];?></td>
<td width="33"><? echo tgl_indo($pengumuman['tanggal']);?></td>
<td width="33" align="center"><a class="btn btn-danger" href="<?php echo base_url(); ?>web/detailpengumuman/<? echo $pengumuman['id_pengumuman'];?>/<? echo $pengumuman['permalink'];?>" >Detail</a></td>

</tr>            
        <?
	$nom++;
}
?>
</tbody>
</table>

<div class="blog-pagination d-flex justify-content-center text-center">
						<div class="wrapper blog-wrapper">
							<?php echo $paginator;?>
						</div>
					</div>
               

 
				</div>