<div class="container">
	<div id="poster">
		<div class="poster-header">
			<?php echo $poster['judul_publikasi']; ?>
		</div>
		<div class="poster-body">
			<div class="col-sm-3">
				<div><center><h2><b><i class="fa fa-id-badge"></i> PERISET</b></h2></center></div>
				<hr>
				<div><?php echo $poster['nama_penulis']; ?></div>
				<div style="margin-top: 36px;">
					<div class="label label-info"><?php echo $poster['tahun_publikasi']; ?></div>
					<div class="label label-success"><?php echo $poster['alias']; ?></div>
				</div>
			</div>
			<div class="col-sm-9" style="border-left: 1px solid #ddd;">
				<img src="<?php echo base_url ($poster['path_image']); ?>" />
			</div>
		</div>
		<div class="poster-footer"></div>
	</div>
</div>