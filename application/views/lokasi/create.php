<?php $this->load->view('templates/header'); ?>

<div class="container mt-5">
    <h1 class="mb-4">Create Lokasi</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add New Lokasi</h6>
        </div>
        <div class="card-body">
            <form action="<?php echo site_url('lokasi/store'); ?>" method="post">
                <div class="form-group">
                    <label for="namaLokasi">Nama Lokasi</label>
                    <input type="text" class="form-control" id="namaLokasi" name="namaLokasi" required>
                </div>
                <div class="form-group">
                    <label for="negara">Negara</label>
                    <input type="text" class="form-control" id="negara" name="negara" required>
                </div>
                <div class="form-group">
                    <label for="provinsi">Provinsi</label>
                    <input type="text" class="form-control" id="provinsi" name="provinsi" required>
                </div>
                <div class="form-group">
                    <label for="kota">Kota</label>
                    <input type="text" class="form-control" id="kota" name="kota" required>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Create</button>
                <a href="<?php echo site_url('lokasi'); ?>" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>

<?php $this->load->view('templates/footer'); ?>