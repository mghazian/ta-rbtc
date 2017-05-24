<div class="container">
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
		<div class="image-container">
			<img src="<?php echo base_url ($poster['path_image']); ?>" style="width: 100%; height: auto; border: 3px solid black;" alt="thumbnail">
		</div>
		<div class="table-panel">
			<div class="table-panel-header">
				DATA POSTER
			</div>
			<div class="table-panel-body">
				<center>
					<h2><?php echo $poster['judul_publikasi'] . ' (' . $poster['tahun_publikasi'] . ')'; ?></h2>
					<h3><?php echo $poster['nama_penulis']; ?></h3>
				</center>
			</div>
			<div class="button-container" style="margin-top: -15px; margin-left: 25px;">
				<a href="<?php echo base_url ('admin/hapus_poster_handler') . '/' . $poster['id_poster']; ?>"><button class="btn table-panel-button">Hapus</button></a>
			</div>
		</div>
	</div>
</div>