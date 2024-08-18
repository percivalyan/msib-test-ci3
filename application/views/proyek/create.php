<?php $this->load->view('templates/header'); ?>

<div class="container-fluid px-4">
    <h1 class="mt-4 mb-4">Create Proyek</h1>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-plus me-1"></i>
            Create New Proyek
        </div>
        <div class="card-body">
            <form action="<?php echo site_url('proyek/store'); ?>" method="post">
                <div class="form-group mb-3">
                    <label for="namaProyek">Nama Proyek</label>
                    <input type="text" class="form-control" id="namaProyek" name="namaProyek" required>
                </div>
                <div class="form-group mb-3">
                    <label for="client">Client</label>
                    <input type="text" class="form-control" id="client" name="client" required>
                </div>
                <div class="form-group mb-3">
                    <label for="tglMulai">Tanggal Mulai</label>
                    <input type="date" class="form-control" id="tglMulai" name="tglMulai" required>
                </div>
                <div class="form-group mb-3">
                    <label for="tglSelesai">Tanggal Selesai</label>
                    <input type="date" class="form-control" id="tglSelesai" name="tglSelesai" required>
                </div>
                <div class="form-group mb-3">
                    <label for="pimpinanProyek">Pimpinan Proyek</label>
                    <input type="text" class="form-control" id="pimpinanProyek" name="pimpinanProyek" required>
                </div>
                <div class="form-group mb-3">
                    <label for="keterangan">Keterangan</label>
                    <textarea class="form-control" id="keterangan" name="keterangan" rows="4"></textarea>
                </div>
                <div class="form-group mb-3">
                    <label>Lokasi</label>
                    <div class="form-check">
                        <?php if (!empty($lokasi)): ?>
                            <?php foreach ($lokasi as $loc): ?>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="lokasi_<?php echo $loc['id']; ?>" name="lokasiIds[]" value="<?php echo $loc['id']; ?>">
                                    <label class="form-check-label" for="lokasi_<?php echo $loc['id']; ?>"><?php echo $loc['namaLokasi']; ?></label>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>No Lokasi Available</p>
                        <?php endif; ?>
                    </div>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Create</button>
                <a href="<?php echo site_url('proyek'); ?>" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>

<?php $this->load->view('templates/footer'); ?>
