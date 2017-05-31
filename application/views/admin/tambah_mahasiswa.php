<h1 class="title-bar">TAMBAH AKUN MAHASISWA</h1>
<div class="container">
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
		<form class="form-container" method="POST" action="<?php echo base_url ('admin/tambah_mahasiswa'); ?>">
			<div class="standard-form">
				<div class="standard-form-header">
				</div>
				<div class="standard-form-body">
					<div class="form-group">
						<label class="form-label">Username</label>
						<input type="text" class="form-control" name="username" required>
					</div>
					<div class="form-group">
						<label class="form-label">Password</label>
						<input type="password" class="form-control" name="password" required>
					</div>
					<div class="form-group">
						<label class="form-label">Ulangi password</label>
						<input type="password" class="form-control" name="re_password">
					</div>
				</div>
			</div>
			<button class="btn btn-primary" type="submit" name="Submit">Simpan</button>
		</form>
	</div>
</div>