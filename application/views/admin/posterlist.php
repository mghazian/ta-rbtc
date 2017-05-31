<?php
function echo_get ($param)
{
	if (isset ($_GET[$param]))
		echo $_GET[$param];
}

function match_get ($param, $target)
{
	if (isset ($_GET[$param]))
		return $_GET[$param] === $target;
	return FALSE;
}
?>
<div class="container">
	<div class="col-sm-12" style="margin-left: auto; margin-right: auto">
		<div class="row">
			<div class="standard-form">
				<h2 class="standard-form-header"><b><i class="fa fa-filter"></i> FILTER</b></h2>
				<div class="standard-form-body">
					<form class="form-container" method="GET" action="<?php echo base_url ('admin/poster'); ?>">
						<div class="row">
							<div class="col-sm-6">
								<h3 style="text-align: center; margin-bottom: 30px;"><b>INFORMASI TUGAS AKHIR</b></h3>
								<div class="form-group row">
									<div class="col-sm-4"><label><b>Judul Publikasi</b></label></div>
									<div class="col-sm-8"><input class="form-control" type="text" name="judul" value="<?php echo_get('judul'); ?>" /></div>
								</div>
								<div class="form-group row">
									<div class="col-sm-4"><label><b>Nama Penulis</b></label></div>
									<div class="col-sm-8"><input class="form-control" type="text" name="penulis" value="<?php echo_get('penulis'); ?>"/></div>
								</div>
								<div class="form-group row">
									<div class="col-sm-4"><label><b>NRP Penulis</b></label></div>
									<div class="col-sm-8"><input class="form-control" type="text" name="nrp" value="<?php echo_get('nrp'); ?>" /></div>
								</div>
								<div class="form-group row">
									<div class="col-sm-4"><label><b>Rumpun Mata Kuliah</b></label></div>
									<div class="col-sm-8">
										<select class="form-control" type="text" name="rmk">
											<option selected value="">-</option>
                            				<?php foreach ($rmk as $row) echo "<option value='" . $row['id_rmk'] ."' " . ((match_get ('rmk', $row['id_rmk'])) ? "selected" : "") . ">" . $row['nama_rmk'] . "</option>"; ?>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-4"><label><b>Status Permohonan</b></label></div>
									<div class="col-sm-8">
										<select class="form-control" type="text" name="status">
											<option selected value="">-</option>
                            				<?php foreach ($status as $row) echo "<option value='" . $row['id_status'] . "' " . ((match_get ('status', $row['id_status'])) ? "selected" : "") . ">" . $row['deskripsi'] . "</option>"; ?>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-4"><label><b>Sudah Terpampang?</b></label></div>
									<div class="col-sm-8">
										<select class="form-control" type="text" name="published">
											<option selected value="">-</option>
											<option value="0" <?php if (match_get ('published', '0')) echo 'selected'; ?>>Belum terpampang</option>
                            				<option value="1" <?php if (match_get ('published', '1')) echo 'selected'; ?>>Sudah terpampang</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-sm-6" style="padding: 1px 6%">
								<div class="row">
									<h3 style="text-align: center; margin-bottom: 30px;"><b>ORDER</b></h3>
									<div class="form-group row">
										<div class="col-sm-4"><label><b>Waktu Entri</b></label></div>
										<div class="col-sm-8">
											<select class="form-control" type="text" name="entri">
												<option selected value="">-</option>
												<option value="asc" <?php if (match_get ('entri', 'asc')) echo 'selected'; ?>>Ascending</option>
												<option value="desc" <?php if (match_get ('entri', 'desc')) echo 'selected'; ?>>Descending</option>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-sm-4"><label><b>Waktu Cetak</b></label></div>
										<div class="col-sm-8">
											<select class="form-control" type="text" name="cetak">
												<option selected value="">-</option>
												<option value="asc" <?php if (match_get ('cetak', 'asc')) echo 'selected'; ?>>Ascending</option>
												<option value="desc" <?php if (match_get ('cetak', 'desc')) echo 'selected'; ?>>Descending</option>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-sm-4"><label><b>Perubahan Terakhir</b></label></div>
										<div class="col-sm-8">
											<select class="form-control" type="text" name="changed">
												<option selected value="">-</option>
												<option value="asc" <?php if (match_get ('changed', 'asc')) echo 'selected'; ?>>Ascending</option>
												<option value="desc" <?php if (match_get ('changed', 'desc')) echo 'selected'; ?>>Descending</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<h3 style="text-align: center; margin-bottom: 30px;"><b>TANGGAL</b></h3>
									<div class="form-group row">
										<div class="col-sm-4"><label><b>Tahun Masuk</b></label></div>
										<div class="col-sm-8">
											<select class="form-control" type="text" name="tahun_entri">
												<option selected value="">-</option>
												<?php for ($i = 2000; $i <= date ('Y'); $i++)
													echo '<option value="' . $i . '">' . $i . '</option>';
												?>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-sm-4"><label><b>Bulan Masuk</b></label></div>
										<div class="col-sm-8">
											<select class="form-control" type="text" name="bulan_entri">
												<option selected value="">-</option>
												<?php for ($i = 1; $i <= 12; $i++)
													echo '<option value="' . date_format ( date_create_from_format ('n d H:i:s', $i . ' 01 00:00:00' ), 'm' ) . '">' . date_format ( date_create_from_format ('n d H:i:s', $i . ' 01 00:00:00'), 'F' ) . '</option>';
												?>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row" style="border-top: 1px solid #ddd; padding: 10px 5px">
							<div class="pull-right">
								<button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i> Filter</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
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
						<?php if ($row['id_status'] == 2)
						{
							if ($row['sudah_publish'] != 1) echo '<button class="btn btn-sm btn-info btn-block" data-toggle="modal" data-target="#' . $row['id_poster'] . '">Ubah status</button>';
							echo '<a href="' . base_url ('admin/edit') . '/' . $row['id_poster'] . '"><button class="btn btn-sm btn-info btn-warning btn-block">Ubah data</button></a>';
							echo '<a href="' . base_url ('admin/hapus_poster') . '/' . $row['id_poster'] . '"><button class="btn btn-sm btn-info btn-danger btn-block">Hapus</button></a>';
							echo '<hr>';
						}
						
						if ($row['id_status'] == 2)
						{
							if ($row['sudah_publish']) 	echo '<div class="label label-info">Sudah pernah dipampang</div>';
							else 						echo '<div class="label label-default">Belum pernah dipampang</div>';
						}

						if ($row['id_status'] == 1)	echo '<div class="label label-primary">Menunggu Keputusan</div>';
						if ($row['id_status'] == 2) echo '<div class="label label-success">Diterima</div>';
						if ($row['id_status'] == 3) echo '<div class="label label-danger">Ditolak</div>';

						if ($row['id_status'] == 1) echo '<a href="' . base_url ('admin/validasi_form/' . $row['id_poster']) . '"><button class="btn btn-sm btn-primary btn-block" style="margin-top: 15px">Validasi</button></a>';
						?>
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