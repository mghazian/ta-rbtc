<h1 class="title-bar">DATA AKUN</h1>
<div class="container">
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
		<form class="form-container" method="POST" action="<?php echo base_url ('mahasiswa/setting_akun'); ?>">
			<div class="standard-form">
				<div class="standard-form-header">
					<h3>AKUN</h3>
				</div>
				<div class="standard-form-body">
					<div class="form-group">
						<label class="form-label">Username</label>
						<input type="text" class="form-control" name="username" value="<?php echo $akun['nama']; ?>" disabled>
					</div>
					<div class="form-group">
						<label class="form-label">Password lama</label>
						<input type="password" class="form-control" name="password_lama" required>
					</div>
					<div class="form-group">
						<label class="form-label">Password baru</label>
						<input type="password" class="form-control" name="password_baru">
					</div>
					<div class="form-group">
						<label class="form-label">Ulangi password baru</label>
						<input type="password" class="form-control" name="re_password_baru">
					</div>
				</div>
			</div>
			<div class="standard-form">
				<div class="standard-form-header">
					<h3>INFORMASI DIRI</h3>
				</div>
				<div class="standard-form-body">
					<div class="form-group">
						<label class="form-label">Nama</label>
						<input type="text" class="form-control" name="nama_lengkap" value="<?php echo $akun['nama_lengkap']; ?>">
					</div>
					<div class="form-group">
						<label class="form-label">NRP</label>
						<input type="text" class="form-control" name="nrp" value="<?php echo $akun['nomor_induk']; ?>">
					</div>
				</div>
			</div>
			<button class="btn btn-primary" type="submit" name="Submit">Simpan</button>
		</form>
	</div>
</div>