<?php $this->load->view('templates/header'); ?>

<div class="container-fluid px-4">
    <h1 class="mt-4 mb-4">Edit Proyek</h1>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-edit me-1"></i>
            Edit Proyek
        </div>
        <div class="card-body">
            <form action="<?php echo site_url('proyek/update/' . $proyek['id']); ?>" method="post">
                <div class="form-group mb-3">
                    <label for="namaProyek">Nama Proyek</label>
                    <input type="text" class="form-control" id="namaProyek" name="namaProyek" value="<?php echo set_value('namaProyek', $proyek['namaProyek']); ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="client">Client</label>
                    <input type="text" class="form-control" id="client" name="client" value="<?php echo set_value('client', $proyek['client']); ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="tglMulai">Tanggal Mulai</label>
                    <input type="date" class="form-control" id="tglMulai" name="tglMulai" value="<?php echo set_value('tglMulai', date('Y-m-d', strtotime($proyek['tglMulai']))); ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="tglSelesai">Tanggal Selesai</label>
                    <input type="date" class="form-control" id="tglSelesai" name="tglSelesai" value="<?php echo set_value('tglSelesai', date('Y-m-d', strtotime($proyek['tglSelesai']))); ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="pimpinanProyek">Pimpinan Proyek</label>
                    <input type="text" class="form-control" id="pimpinanProyek" name="pimpinanProyek" value="<?php echo set_value('pimpinanProyek', $proyek['pimpinanProyek']); ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="keterangan">Keterangan</label>
                    <textarea class="form-control" id="keterangan" name="keterangan" rows="4" required><?php echo set_value('keterangan', $proyek['keterangan']); ?></textarea>
                </div>
                <div class="form-group mb-3">
                    <label>Lokasi</label><br>
                    <?php if (!empty($lokasi)): ?>
                        <?php foreach ($lokasi as $loc): ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="lokasi_ids[]" value="<?php echo $loc['id']; ?>" id="lokasi_<?php echo $loc['id']; ?>" <?php echo in_array($loc['id'], array_column($proyek_lokasi, 'id')) ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="lokasi_<?php echo $loc['id']; ?>">
                                    <?php echo $loc['namaLokasi']; ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No Lokasi Available</p>
                    <?php endif; ?>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="<?php echo site_url('proyek'); ?>" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>

<?php $this->load->view('templates/footer'); ?>