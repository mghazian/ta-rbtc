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
					<h4><?php echo $poster['nama_penulis'] . ' / ' . $poster['nrp_penulis']; ?></h4>
					<hr>
					<div class="form-group">
						<div class="row">
							<div class="col-sm-4"><label class="control-label">Rumpun Mata Kuliah</label></div>
							<div class="col-sm-8"><p class="form-control-static"><?php echo $poster['nama_rmk']; ?></p></div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-sm-4"><label class="control-label">Abstrak</label></div>
							<div class="col-sm-8"><p class="form-control-static"><?php echo $poster['abstrak']; ?></p></div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-sm-4"><label class="control-label">Kata Kunci</label></div>
							<div class="col-sm-8"><p class="form-control-static"><?php echo $poster['kata_kunci']; ?></p></div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-sm-4"><label class="control-label">Dosen Pembimbing 1</label></div>
							<div class="col-sm-8"><p class="form-control-static"><?php echo $poster['dosbing_1']; ?></p></div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-sm-4"><label class="control-label">Dosen Pembimbing 2</label></div>
							<div class="col-sm-8"><p class="form-control-static"><?php echo $poster['dosbing_2']; ?></p></div>
						</div>
					</div>
				</center>
			</div>
			<div class="button-container" style="margin-top: -15px; margin-left: 25px; margin-right: 25px;">
				<div class="pull-left">
					<form method="POST" action="<?php echo base_url ('admin/validasi'); ?>">
						<input type="text" name="id_poster" value="<?php echo $poster['id_poster']; ?>" hidden />
						<button class="btn table-panel-button" type="submit" name="action" value="1">Terima</button>
						<button class="btn table-panel-button" type="submit" name="action" value="0">Tolak</button>
					</form>
				</div>
				<div class="pull-right">
					<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>"><button class="btn table-panel-button" style="background-color: #333;">Kembali</button></a>
				</div>
			</div>
		</div>
	</div>
</div>