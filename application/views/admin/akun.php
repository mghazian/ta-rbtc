<div class="container">
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
		<form class="form-container" method="POST" action="<?php echo base_url ('admin/akun'); ?>">
			<div class="section-name">
				<h2>DATA AKUN</h2>
			</div>
			<div class="form-group">
				<label class="form-label">Username</label>
				<input type="text" class="form-control" name="username" value="<?php echo $akun['nama']; ?>">
			</div>
			<div class="form-group">
				<label class="form-label">Password lama</label>
				<input type="password" class="form-control" name="password_lama">
			</div>
			<div class="form-group">
				<label class="form-label">Password baru</label>
				<input type="password" class="form-control" name="password_baru">
			</div>
			<div class="form-group">
				<label class="form-label">Ulangi password baru</label>
				<input type="password" class="form-control" name="re_password_baru">
			</div>
			<button class="btn btn-info" type="submit" name="Submit">Simpan</button>
		</form>
	</div>
</div>