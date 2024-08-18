<?php $this->load->view('templates/header'); ?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Data Proyek</h1>
    <a href="<?php echo site_url('proyek/create'); ?>" class="btn btn-primary mb-3">Add New Proyek</a>

    <!-- Data Proyek Table -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Proyek Table
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Proyek</th>
                        <th>Client</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Pimpinan Proyek</th>
                        <th>Keterangan</th>
                        <th>Lokasi</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php if (!empty($proyek)): ?>
                        <?php foreach ($proyek as $proj): ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $proj['namaProyek']; ?></td>
                                <td><?php echo $proj['client']; ?></td>
                                <td><?php echo $proj['tglMulai']; ?></td>
                                <td><?php echo $proj['tglSelesai']; ?></td>
                                <td><?php echo $proj['pimpinanProyek']; ?></td>
                                <td><?php echo $proj['keterangan']; ?></td>
                                <td>
                                    <?php if (!empty($proj['lokasi'])): ?>
                                        <?php foreach ($proj['lokasi'] as $lokasi): ?>
                                            <span class="badge bg-secondary"><?php echo $lokasi['namaLokasi']; ?></span>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        No Location
                                    <?php endif; ?>
                                </td>
                                <td><?php echo $proj['createdAt']; ?></td>
                                <td>
                                    <a href="<?php echo site_url('proyek/edit/' . $proj['id']); ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="<?php echo site_url('proyek/delete/' . $proj['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="10" class="text-center">No data available</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php $this->load->view('templates/footer'); ?>