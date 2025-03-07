<section class="section">
    <div class="row" id="basic-table">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">EDIT DONASI</h4>
                </div>
                <div class="card-body">
                    <!-- Form Utama -->
                    <form method="POST" action="<?= base_url('home/aksi_e_donasi') ?>" id="modalForm" enctype="multipart/form-data">
                        <div id="form-container">
                            <!-- Form Edit User -->
                            <div class="modal-form">
                                <div class="row">

                                <div class="mb-3">
                        <div class="form-group">
                            <label for="email-id-vertical">Nama Program:</label>
                            <select class="form-control" name="nama_program" required>
                                <?php foreach ($yoga as $item): ?>
                                    <option value="<?= $item->id_program ?>" 
                                        <?= $oke->id_program == $item->id_program ? 'selected' : ''; ?>>
                                        <?= $item->nama_program ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                                    <div class="col-md-7 mb-3">
                                        <label for="username">Nama Pemberi:</label>
                                        <input type="text" class="form-control" name="nama_pemberi"  value="<?= $oke->nama_pemberi ?>" required>
                                    </div>
                                    <div class="col-md-7 mb-3">
                                        <label for="username">Jumlah Donasi:</label>
                                        <input type="text" class="form-control" name="jumlah_donasi"  value="<?= $oke->jumlah_donasi ?>" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <!-- Hidden field untuk ID User -->
                                <input type="hidden" name="id" value="<?= $oke->id_donasi ?>">
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
