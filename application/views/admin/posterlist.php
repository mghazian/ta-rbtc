<div class="container">
	<div class="col-sm-12" style="margin-left: auto; margin-right: auto">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>#</th>
					<th>Judul</th>
					<th>Penulis</th>
					<th width="10%">Tahun publikasi</th>
					<th>RMK</th>
					<th width="10%">Tanggal entri</th>
					<th width="10%">Terakhir berubah</th>
					<th width="20%">Thumbnail</th>
					<th width="15%">Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php
					for ($i = 0; $i < count ($poster); $i++) {
						$row = $poster[$i];
				?>
				<tr class="<?php echo ($row['sudah_publish']) ? 'warning' : 'info'; ?>">
					<td><?php echo $set + $i + 1; ?></td>
					<td><?php echo $row['judul_publikasi']; ?></td>
					<td><?php echo $row['nama_penulis']; ?></td>
					<td><?php echo $row['tahun_publikasi']; ?></td>
					<td><?php echo $row['alias']; ?></td>
					<td><?php echo date_format ( date_create_from_format ('Y-m-d H:i:s', $row['waktu_entri']), 'j F Y (H:i:s)' ); ?></td>
					<td><?php echo date_format ( date_create_from_format ('Y-m-d H:i:s', $row['perubahan_terakhir']), 'j F Y (H:i:s)' ); ?></td>
					<td><img src="<?php echo base_url ($row['path_image']); ?>" alt="thumbnail" style="max-width: 100%; height:auto"></td>
					<td>
						<?php if ($row['sudah_publish'] != 1) echo '<button class="btn btn-sm btn-info btn-block" data-toggle="modal" data-target="#' . $row['id_poster'] . '">Ubah status</button>'; ?>
						<a href="<?php echo base_url ('admin/edit') . '/' . $row['id_poster']; ?>"><button class="btn btn-sm btn-info btn-warning btn-block">Ubah data</button></a>
						<a href="<?php echo base_url ('admin/hapus_poster') . '/' . $row['id_poster']; ?>"><button class="btn btn-sm btn-info btn-danger btn-block">Hapus</button></a>
						<div class="label <?php echo ($row['sudah_publish']) ? 'label-info' : 'label-default'; ?>">
							<?php echo ($row['sudah_publish']) ? 'Sudah pernah dipampang' : 'Belum pernah dipampang'; ?>
						</div>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
		<div class="pagination-container" style="border-radius: 20vw; width: 20vw; margin-right: auto; margin-left: auto;; background-color: #333;">
			<center><?php echo $this->pagination->create_links(); ?></center>
		</div>
	</div>
</div>



<!-- Modal -->
<?php foreach ($poster as $row) { ?>
<div id="<?php echo $row['id_poster']; ?>" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
    	<div class="modal-content">
    		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal">&times;</button>
        		<h4 class="modal-title">Ubah Status</h4>
      		</div>
      		<div class="modal-body">
        		<p>Status poster ini akan berubah menjadi "<b>Sudah pernah dipampang</b>". Apakah anda yakin akan mengubah status poster?<br/>
				Status tidak akan bisa dikembalikan lagi setelah ini!</p>
      		</div>
      		<div class="modal-footer">
				<form method="POST" action="<?php echo base_url ('admin/ubah_status_handler'); ?>">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button>
					<input type="hidden" name="id_poster" value="<?php echo $row['id_poster']; ?>" />
        			<button type="submit" class="btn btn-success">Ya</button>
				</form>
      		</div>
    	</div>
	</div>
</div>
<?php } ?>