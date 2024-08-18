<?php $this->load->view('templates/header'); ?>

<div class="container-fluid px-4">
    <h1 class="mt-4 mb-4">Data Lokasi</h1>
    <a href="<?php echo site_url('lokasi/create'); ?>" class="btn btn-primary mb-3">Add New Lokasi</a>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Lokasi Table
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>No.</th>
                        <th>Nama Lokasi</th>
                        <th>Negara</th>
                        <th>Provinsi</th>
                        <th>Kota</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php if (!empty($lokasi)): ?>
                        <?php foreach ($lokasi as $lok): ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $lok['namaLokasi']; ?></td>
                                <td><?php echo $lok['negara']; ?></td>
                                <td><?php echo $lok['provinsi']; ?></td>
                                <td><?php echo $lok['kota']; ?></td>
                                <td><?php echo $lok['createdAt']; ?></td>
                                <td>
                                    <a href="<?php echo site_url('lokasi/edit/' . $lok['id']); ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="<?php echo site_url('lokasi/delete/' . $lok['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7">No data available</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php $this->load->view('templates/footer'); ?>