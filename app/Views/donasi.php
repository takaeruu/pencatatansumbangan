<section class="section">
    <div class="row" id="basic-table">
        <div class="col-12 col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="text-transform: uppercase; font-size: 30px;">DONASI</h4>
                </div>
                
                    <!-- Dropdown Filter untuk Nama Program -->
                    <div class="mb-3">
                    <label for="programFilter">Filter by Program:</label>
                    <select class="form-control" id="programFilter" onchange="filterDonasi()">
                        <option value="">Pilih Program</option>
                        <?php foreach ($yoga as $item): ?>
                            <option value="<?= $item->id_program ?>" <?= isset($filter_program) && $filter_program == $item->id_program ? 'selected' : ''; ?>>
                                <?= $item->nama_program ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Button to Clear Filter -->
                <button class="btn btn-info mb-3" onclick="clearFilter()">Clear Filter</button>


                <!-- Button to trigger Modal for Adding donasi -->
                <a class="nav-link text-Headings my-2" href="#" data-bs-toggle="modal" data-bs-target="#addUserModal">
                    <span class="fa fa-plus-circle" style="font-size: 30px;"></span> Tambah Donasi
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
                                    <th>Nama Pemberi</th>
                                    <th>Jumlah Donasi</th>
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
                                    <td><?= ($oke->nama_pemberi) ?></td>
                                    <td><?= ($oke->jumlah_donasi) ?></td>
                                    <td>
                                        <!-- Edit Button with Modal Trigger -->
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#editUserModal-<?= $oke->id_donasi ?>">
                                            <button class="btn btn-primary">Edit / Detail</button>
                                        </a>
                                        <a href="<?= base_url('home/hapus_donasi/'.$oke->id_donasi) ?>">
                                            <button class="btn btn-info">Delete</button>
                                        </a>

                                        <!-- Modal for Editing donasi -->
                                        <div class="modal fade" id="editUserModal-<?= $oke->id_donasi ?>" tabindex="-1" aria-labelledby="editUserModalLabel-<?= $oke->id_donasi ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel-<?= $oke->id_donasi ?>">Edit Donasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form to Edit Donasi -->
                <form action="<?= base_url('home/aksi_e_donasi') ?>" method="POST">
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

                    <div class="mb-3">
                        <label for="editNamadonasi-<?= $oke->id_donasi ?>" class="form-label">Nama Pemberi</label>
                        <input type="text" class="form-control" id="editNamadonasi-<?= $oke->id_donasi ?>" name="nama_pemberi" value="<?= $oke->nama_pemberi ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="editJumlahdonasi-<?= $oke->id_donasi ?>" class="form-label">Jumlah Donasi</label>
                        <input type="text" class="form-control" id="editJumlahdonasi-<?= $oke->id_donasi ?>" name="jumlah_donasi" value="<?= $oke->jumlah_donasi ?>" required>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" value="<?= $oke->id_donasi ?>">
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

<!-- Modal for Adding donasi -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Tambah donasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form to Add donasi -->
                <form action="<?= base_url('home/aksi_t_donasi') ?>" method="POST">
                <div class="mb-3">
    <div class="form-group">
        <label for="email-id-vertical">Nama Program:</label>
        <select class="form-control" name="nama_program" required>
            <option value="">Pilih</option>
            <?php foreach ($yoga as $item): ?>
                <option value="<?= $item->id_program ?>"><?= $item->nama_program ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>

                    <div class="mb-3">
                        <label for="namadonasi" class="form-label">Nama Pemberi</label>
                        <input type="text" class="form-control" id="namadonasi" name="nama_pemberi" required>
                    </div>
                    <div class="mb-3">
                        <label for="namadonasi" class="form-label">Nama Jumlah Donasi</label>
                        <input type="text" class="form-control" id="namadonasi" name="jumlah_donasi" required>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Tambah donasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Include Bootstrap JavaScript if not already included -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('hargadonasi').addEventListener('input', function(e) {
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


    document.querySelectorAll('[id^="editHargadonasi-"]').forEach(function(input) {
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

function filterDonasi() {
        var programId = document.getElementById('programFilter').value;
        var form = document.createElement('form');
        form.method = 'GET';
        form.action = ''; // Halaman yang sama

        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'filter_program';
        input.value = programId;

        form.appendChild(input);
        document.body.appendChild(form);
        form.submit(); // Kirim form secara otomatis
    }

    // Function to clear the filter and reload the page without any filter
    function clearFilter() {
        var form = document.createElement('form');
        form.method = 'GET';
        form.action = ''; // Halaman yang sama

        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'filter_program';
        input.value = ''; // Clear the filter value

        form.appendChild(input);
        document.body.appendChild(form);
        form.submit(); // Submit the form to reload the page without the filter
    }
</script>