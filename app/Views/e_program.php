<section class="section">
    <div class="row" id="basic-table">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">EDIT PROGRAM</h4>
                </div>
                <div class="card-body">
                    <!-- Form Utama -->
                    <form method="POST" action="<?= base_url('home/aksi_e_program') ?>" id="modalForm" enctype="multipart/form-data">
                        <div id="form-container">
                            <!-- Form Edit User -->
                            <div class="modal-form">
                                <div class="row">
                                    <div class="col-md-7 mb-3">
                                        <label for="username">Username:</label>
                                        <input type="text" class="form-control" name="nama_program"  value="<?= $oke->nama_program ?>" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <!-- Hidden field untuk ID User -->
                                <input type="hidden" name="id" value="<?= $oke->id_program ?>">
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
