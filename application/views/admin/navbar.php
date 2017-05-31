<div class="navbar navbar-inverse">
	<div class="navbar-header">
		<a class="navbar-brand" href="#">REPOSITORI POSTER TA</a>
	</div>
	<ul class="nav navbar-nav pull-right">
		<li><a href="<?php echo base_url ('admin/akun'); ?>">Akun</a></li>
		<li><a href="<?php echo base_url ('admin'); ?>">Dashboard</a></li>
		<li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#">Tambah Akun <span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li><a href="<?php echo base_url ('admin/tambah_mahasiswa'); ?>">Tambah Mahasiswa</a></li>
				<li><a href="<?php echo base_url ('admin/tambah_admin'); ?>">Tambah Admin</a></li>
			</ul>
		</li>
		<li><a href="<?php echo base_url ('admin/tambah'); ?>">Tambah Poster</a></li>
		<li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#">Daftar Poster <span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li><a href="<?php echo base_url ('admin/poster'); ?>">Semua Poster</a></li>
				<li><a href="<?php echo base_url ('admin/poster?published=1'); ?>">Poster Tercetak</a></li>
				<li><a href="<?php echo base_url ('admin/poster?entri=desc'); ?>">Poster Termutakhir</a></li>
			</ul>
		</li>
		<li><a href="<?php echo base_url ('home/logout'); ?>">Logout</a></li>
	</ul>
</div>