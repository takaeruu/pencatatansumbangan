<section class="section">
    <div class="row" id="basic-table">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">TAMBAH DONASI</h4>
                </div>
                <div class="card-body">
                    <!-- Form Utama -->
                    <form method="POST" action="<?= base_url('home/aksi_t_donasi') ?>" id="modalForm" enctype="multipart/form-data">
    <div id="form-container">
        <!-- Form Tambah Modal 1 (Form Pertama) -->
        <div class="modal-form">
            <div class="row">

            <div class="col-md-7 mb-3">
        <label for="email-id-vertical">Nama Program:</label>
        <select class="form-control" name="nama_program" required>
            <option value="">Pilih</option>
            <?php foreach ($yoga as $item): ?>
                <option value="<?= $item->id_program ?>"><?= $item->nama_program ?></option>
            <?php endforeach; ?>
        </select>
    </div>
                <div class="col-md-7 mb-3">
                    <label for="nomor_surat">Nama Pemberi:</label>
                    <input type="text" class="form-control" name="nama_pemberi" placeholder="Masukkan Program" required>
                </div>
                <div class="col-md-7 mb-3">
                    <label for="nomor_surat">Jumlah Donasi:</label>
                    <input type="text" class="form-control" name="jumlah_donasi" placeholder="Masukkan Jumlah Donasi" required>
                </div>


            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-12">
            <button type="submit" class="btn btn-success">Save</button>
        </div>
    </div>
</form>

                </div>
            </div>
        </div>
    </div>
</section>
