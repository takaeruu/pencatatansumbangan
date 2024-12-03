<section class="section">
    <div class="row" id="basic-table">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">TAMBAH USER</h4>
                </div>
                <div class="card-body">
                    <!-- Form Utama -->
                    <form method="POST" action="<?= base_url('home/aksi_t_user') ?>" id="modalForm" enctype="multipart/form-data">
    <div id="form-container">
        <!-- Form Tambah Modal 1 (Form Pertama) -->
        <div class="modal-form">
            <div class="row">
                <div class="col-md-7 mb-3">
                    <label for="nomor_surat">Username:</label>
                    <input type="text" class="form-control" name="username" placeholder="Masukkan Username" required>
                </div>
                
                <div class="col-md-7 mb-3">
                    <label for="tanggalkirim">NIS:</label>
                    <input type="text" class="form-control" name="nis" placeholder="Masukkan NIS" required>
                </div>
                <div class="col-md-7 mb-3">
                    <label for="jenis_pengajuan">Status:</label>
                    <select class="form-control" name="level" required>
                        <option value="" disabled selected>Pilih Status</option>
                        <option value="osis">Osis</option>
                        <option value="kelas">Kelas</option>
                    </select>
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
