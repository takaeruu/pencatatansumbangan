<section class="section">
    <div class="row" id="basic-table">
        <div class="col-12 col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="text-transform: uppercase; font-size: 30px;">PROGRAM</h4>
                </div>
                
                <!-- Button to trigger Modal for Adding program -->
                <a class="nav-link text-Headings my-2" href="#" data-bs-toggle="modal" data-bs-target="#addUserModal">
                    <span class="fa fa-plus-circle" style="font-size: 30px;"></span> Tambah PROGRAM
                </a>

                <!-- Card Content with Table -->
                <div class="card-content">
                    <div class="card-body">
                        <!-- Table with outer spacing -->
                        <table class="table table-lg">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Nama Program</th>
                                    <th>Donasi Terkumpul</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $no = 1;
                                foreach ($oke as $oke) {
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= ($oke->nama_program) ?></td>
                                    <td><?= ($oke->donasi_terkumpul) ?></td>
                                    <td>
                                        <!-- Edit Button with Modal Trigger -->
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#editUserModal-<?= $oke->id_program ?>">
                                            <button class="btn btn-primary">Edit / Detail</button>
                                        </a>
                                        <a href="<?= base_url('home/hapus_program/'.$oke->id_program) ?>">
                                            <button class="btn btn-info">Delete</button>
                                        </a>

                                        <!-- Modal for Editing program -->
                                        <div class="modal fade" id="editUserModal-<?= $oke->id_program ?>" tabindex="-1" aria-labelledby="editUserModalLabel-<?= $oke->id_program ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editUserModalLabel-<?= $oke->id_program ?>">Edit program</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Form to Edit program -->
                                                        <form action="<?= base_url('home/aksi_e_program') ?>" method="POST">
                                                            <div class="mb-3">
                                                                <label for="editNamaprogram-<?= $oke->id_program ?>" class="form-label">Nama program</label>
                                                                <input type="text" class="form-control" id="editNamaprogram-<?= $oke->id_program ?>" name="nama_program" value ="<?= $oke->nama_program ?>" required>
                                                            </div>
                                                            <div class="modal-footer">
                                                            <input type="hidden" name="id" value="<?= $oke->id_program ?>">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal for Adding program -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Tambah program</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form to Add program -->
                <form action="<?= base_url('home/aksi_t_program') ?>" method="POST">
                    <div class="mb-3">
                        <label for="namaprogram" class="form-label">Nama program</label>
                        <input type="text" class="form-control" id="namaprogram" name="nama_program" required>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Tambah program</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Include Bootstrap JavaScript if not already included -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('hargaprogram').addEventListener('input', function(e) {
        let value = e.target.value.replace(/[^,\d]/g, '');
        if (value) {
            e.target.value = formatRupiah(value);
        }
    });

    function formatRupiah(angka, prefix = "Rp ") {
        let number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            let separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix + rupiah;
    }


    document.querySelectorAll('[id^="editHargaprogram-"]').forEach(function(input) {
    input.addEventListener('input', function(e) {
        let value = e.target.value.replace(/[^,\d]/g, '');
        if (value) {
            e.target.value = formatRupiah(value);
        }
    });

    // Format harga on page load to display correctly
    let initialValue = input.value.replace(/[^,\d]/g, '');
    if (initialValue) {
        input.value = formatRupiah(initialValue);
    }
});
</script>
