<?php $this->load->view('templates/header'); ?>

<div class="container-fluid px-4">
	<h1 class="mt-4">Dashboard</h1>
	<ol class="breadcrumb mb-4">
		<li class="breadcrumb-item active">Dashboard Overview</li>
	</ol>

	<!-- Dashboard Summaries -->
	<div class="row">
		<div class="col-xl-3 col-md-6">
			<div class="card bg-primary text-white mb-4">
				<div class="card-body">Total Lokasi: <?php echo count($lokasi); ?></div>
			</div>
		</div>
		<div class="col-xl-3 col-md-6">
			<div class="card bg-warning text-white mb-4">
				<div class="card-body">Total Proyek: <?php echo count($proyek); ?></div>
			</div>
		</div>
		<!-- Tambahkan summary lainnya jika diperlukan -->
	</div>

	<!-- Daftar Lokasi Table -->
	<div class="card mb-4">
		<div class="card-header">
			<i class="fas fa-table me-1"></i>
			Data Lokasi
		</div>
		<div class="card-body">
			<table id="datatablesSimple" class="table table-bordered table-striped">
				<thead class="thead-dark">
					<tr>
						<th>No.</th>
						<th>Nama Lokasi</th>
						<th>Negara</th>
						<th>Provinsi</th>
						<th>Kota</th>
						<th>Created At</th>
					</tr>
				</thead>
				<tbody>
					<?php $i = 1; ?>
					<?php if (!empty($lokasi)): ?>
						<?php foreach ($lokasi as $item): ?>
							<tr>
								<td><?php echo $i++; ?></td>
								<td><?php echo $item['namaLokasi']; ?></td>
								<td><?php echo $item['negara']; ?></td>
								<td><?php echo $item['provinsi']; ?></td>
								<td><?php echo $item['kota']; ?></td>
								<td><?php echo $item['createdAt']; ?></td>
							</tr>
						<?php endforeach; ?>
					<?php else: ?>
						<tr>
							<td colspan="6" class="text-center">Data Lokasi tidak tersedia.</td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>

	<!-- Daftar Proyek Table -->
	<div class="card mb-4">
		<div class="card-header">
			<i class="fas fa-table me-1"></i>
			Data Proyek
		</div>
		<div class="card-body">
			<table id="datatablesSimple" class="table table-bordered table-striped">
				<thead class="thead-dark">
					<tr>
						<th>No.</th>
						<th>Nama Proyek</th>
						<th>Client</th>
						<th>Tanggal Mulai</th>
						<th>Tanggal Selesai</th>
						<th>Pimpinan Proyek</th>
						<th>Lokasi Proyek</th>
						<th>Created At</th>
					</tr>
				</thead>
				<tbody>
					<?php $i = 1; ?>
					<?php if (!empty($proyek)): ?>
						<?php foreach ($proyek as $item): ?>
							<tr>
								<td><?php echo $i++; ?></td>
								<td><?php echo $item['namaProyek']; ?></td>
								<td><?php echo $item['client']; ?></td>
								<td><?php echo $item['tglMulai']; ?></td>
								<td><?php echo $item['tglSelesai']; ?></td>
								<td><?php echo $item['pimpinanProyek']; ?></td>
								<td>
									<ul>
										<?php foreach ($item['lokasiSet'] as $lokasi): ?>
											<li><?php echo $lokasi['namaLokasi'] . ' (' . $lokasi['kota'] . ', ' . $lokasi['provinsi'] . ')'; ?></li>
										<?php endforeach; ?>
									</ul>
								</td>
								<td><?php echo $item['createdAt']; ?></td>
							</tr>
						<?php endforeach; ?>
					<?php else: ?>
						<tr>
							<td colspan="8" class="text-center">Data Proyek tidak tersedia.</td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php $this->load->view('templates/footer'); ?>