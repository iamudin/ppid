 <!-- Bootstrap -->
        <link href="<?php echo base_url(); ?>asset/blank/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<body>

<table  class="table" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>JK</th>
                                <th>Alamat</th>
                                <th>KTP</th>
                            </tr>
                        </thead>
                     
                        <tbody>             
                                                                        <?php 
$no = 1;
foreach($dok->result_array() as $artikel){
	?>   
                                                                         
                                                            <tr>
                                                              <td><?php echo $no;?></td>
                                                              <td><?php echo $artikel['nik']; ?></td>
                                                              <td><?php echo $artikel['nama']; ?></td>
                                                              <td><?php echo $artikel['jk']; ?></td>
                                                              <td><?php echo $artikel['alamat']; ?></td>
                                                              <td><img style="width:100%" src="<?php echo base_url(); ?>media/ktp/<?php echo $artikel['gambar']; ?>"/></td>
                                                            </tr>
                                                            
                                                            <?php $no++;} ?>
                                  <tbody> 
						</table>
						
		
</body>

                        