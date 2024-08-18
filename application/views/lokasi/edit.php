<?php $this->load->view('templates/header'); ?>

<div class="container mt-5">
    <h1 class="mb-4">Edit Lokasi</h1>

    <?php if (isset($lokasi) && is_array($lokasi)): ?>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Lokasi</h6>
            </div>
            <div class="card-body">
                <form action="<?php echo site_url('lokasi/update/' . htmlspecialchars($lokasi['id'] ?? '', ENT_QUOTES, 'UTF-8')); ?>" method="post">
                    <div class="form-group">
                        <label for="namaLokasi">Nama Lokasi</label>
                        <input type="text" class="form-control" id="namaLokasi" name="namaLokasi" value="<?php echo htmlspecialchars($lokasi['namaLokasi'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="negara">Negara</label>
                        <input type="text" class="form-control" id="negara" name="negara" value="<?php echo htmlspecialchars($lokasi['negara'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="provinsi">Provinsi</label>
                        <input type="text" class="form-control" id="provinsi" name="provinsi" value="<?php echo htmlspecialchars($lokasi['provinsi'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="kota">Kota</label>
                        <input type="text" class="form-control" id="kota" name="kota" value="<?php echo htmlspecialchars($lokasi['kota'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="<?php echo site_url('lokasi'); ?>" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-danger" role="alert">
            Data tidak ditemukan.
        </div>
        <!-- Debug output to check what data is received -->
        <pre><?php print_r($lokasi); ?></pre>
    <?php endif; ?>
</div>

<?php $this->load->view('templates/footer'); ?>