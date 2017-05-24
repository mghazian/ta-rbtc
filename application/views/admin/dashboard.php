<div class="container-fluid">
	<div class="row">
		<div class="col-sm-3">
			<div class="stat-box">
				<div class="stat-box-header">
					<i class="fa fa-folder-open"></i><b> TOTAL POSTER</b>
				</div>
				<div class="stat-box-body">
					<strong><?php echo $total_poster; ?></strong>
				</div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="stat-box">
				<div class="stat-box-header">
					<i class="fa fa-print"></i><b> POSTER TERCETAK</b>
				</div>
				<div class="stat-box-body">
					<strong><?php echo $total_tercetak; ?></strong>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6">
			<div class="container-fluid table-panel">
				<div class="table-panel-header">
					<h4><span class="glyphicon glyphicon-info-sign"></span><b> DATA POSTER MUTAKHIR</b></h4>
				</div>
				<div class="table-panel-body">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>#</th>
								<th>Judul</th>
								<th>Penulis</th>
								<th>Tanggal masuk</th>
							</tr>
						</thead>
						<tbody>
							<?php for ($i = 0; $i < count ($poster_mutakhir); $i++)
							{
								$poster = $poster_mutakhir[$i];
							?>
							<tr>
								<td><?php echo $i + 1; ?></td>
								<td><?php echo $poster['judul_publikasi']; ?></td>
								<td><?php echo $poster['nama_penulis']; ?></td>
								<td><?php echo date_format ( date_create_from_format ('Y-m-d H:i:s', $poster['waktu_entri']), 'j F Y' ); ?></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
					<div class="pull-right">
						<a href="<?php echo base_url ('admin/poster') . '?order=newest'; ?>"><button class="btn btn-sm table-panel-button">Semua</button></a>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="container-fluid table-panel">
				<div class="table-panel-header">
					<h4><span class="glyphicon glyphicon-info-sign"></span><b> DATA POSTER TERCETAK</b></h4>
				</div>
				<div class="table-panel-body">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>#</th>
								<th>Judul</th>
								<th>Penulis</th>
								<th>Tanggal masuk</th>
								<th>Tanggal cetak</th>
							</tr>
						</thead>
						<tbody>
							<?php for ($i = 0; $i < count ($poster_tercetak); $i++)
							{
								$poster = $poster_tercetak[$i];
							?>
							<tr>
								<td><?php echo $i + 1; ?></td>
								<td><?php echo $poster['judul_publikasi']; ?></td>
								<td><?php echo $poster['nama_penulis']; ?></td>
								<td><?php echo date_format ( date_create_from_format ('Y-m-d H:i:s', $poster['waktu_entri']), 'j F Y' ); ?></td>
								<td><?php echo date_format ( date_create_from_format ('Y-m-d H:i:s', $poster['waktu_cetak']), 'j F Y' ); ?></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
					<div class="pull-right">
						<a href="<?php echo base_url ('admin/poster_tercetak'); ?>"><button class="btn btn-sm table-panel-button">Semua</button></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>