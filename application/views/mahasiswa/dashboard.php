<div class="container">
	<div class="col-sm-4">
		<div class="standard-form">
			<h2 class="standard-form-header" style="padding: 10px">BIODATA</h2>
			<div class="standard-form-body">
				<div class="row" style="margin-left: 15px;">
					<div class="col-sm-3"><div class="label label-default">NAMA</div></div>
					<div class="col-sm-9"><?php echo $akun['nama_lengkap']; ?></div>
				</div>
				<div class="row" style="margin-left: 15px;">
					<div class="col-sm-3"><div class="label label-default">NRP</div></div>
					<div class="col-sm-9"><?php echo $akun['nomor_induk']; ?></div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="standard-form">
			<h2 class="standard-form-header" style="padding: 10px">STATUS PENGUMPULAN</h2>
			<div class="standard-form-body">
				<div class="row">
					<div class="col-sm-9">
						<div class="standard-form" style="border-right-width: 1px; border-left-width: 1px; border-bottom-width: 1px; padding:15px;">
							<h2>RINGKASAN USULAN</h2>
							<div class="standard-form-body">
								<?php if ( isset ($poster) ) { ?>
									<div class="row">
										<div class="col-sm-5 label label-primary">Judul Publikasi</div>
										<div class="col-sm-7"><?php echo $poster['judul_publikasi']; ?></div>
									</div>
									<div class="row">
										<div class="col-sm-5 label label-primary">Nama Penulis</div>
										<div class="col-sm-7"><?php echo $poster['nama_penulis']; ?></div>
									</div>
									<div class="row">
										<div class="col-sm-5 label label-primary">NRP Penulis</div>
										<div class="col-sm-7"><?php echo $poster['nrp_penulis']; ?></div>
									</div>
									<div class="row">
										<div class="col-sm-5 label label-primary">Tahun Publikasi</div>
										<div class="col-sm-7"><?php echo $poster['tahun_publikasi']; ?></div>
									</div>
									<div class="row">
										<div class="col-sm-5 label label-primary">Rumpun Mata Kuliah</div>
										<div class="col-sm-7"><?php echo $poster['nama_rmk']; ?></div>
									</div>
									<div class="row">
										<div class="col-sm-5 label label-primary">Waktu Entri</div>
										<div class="col-sm-7"><?php echo date_format (date_create_from_format ('Y-m-d H:i:s', $poster['waktu_entri']), 'j F Y'); ?> </div>
									</div>
									<div class="row">
										<div class="col-sm-5 label label-primary">Perubahan Terakhir</div>
										<div class="col-sm-7"><?php echo date_format (date_create_from_format ('Y-m-d H:i:s', $poster['perubahan_terakhir']), 'j F Y'); ?></div>
									</div>
								<?php } else { ?>
									<div style="vertical-align: middle; text-align: center; font-size: 130%; border-radius: 3px; background-color: #000; color: #eee;">
										MAHASISWA BELUM MENGUMPULKAN BERKAS
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
					<div class="col-sm-3" style="margin-left: 0;">
						<div class="row">
							<div class="col-sm-12">
								<center><h4>STATUS</h4></center>
							</div>
						</div>
						<div class="row" style="border-radius: 4px; border: 1px solid #bbb; padding: 10px;">
							<div class="col-sm-1">
								<?php
									echo '<div class="status-circle status-circle-';
									if ( ! isset ($poster) ) echo 'gray';
									else
									{
										if ($poster['id_status'] == 1) echo 'blue';
										else if ($poster['id_status'] == 2) echo 'green';
										else if ($poster['id_status'] == 3) echo 'red';
									}
									echo '"></div>';
								?>
							</div>
							<div class="col-sm-8">
								<b>
								<?php
									if ( ! isset ($poster) ) echo '-';
									else echo strtoupper ($poster['deskripsi']);
								?>
								</b>
							</div>
						</div>
						<div class="row" style="margin-top: 10px;">
							<?php if ( $poster['id_status'] == 3) echo '<a href="' . base_url ('mahasiswa/form_berkas') . '"><button class="btn btn-primary btn-block">REVISI</button></a>'; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>