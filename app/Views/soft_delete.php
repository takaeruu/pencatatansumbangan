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
                                // Filter berdasarkan program jika ada parameter 'filter_program'
                                if (isset($filter_program)) {
                                    $oke = array_filter($oke, function($donasi) use ($filter_program) {
                                        return $donasi->id_program == $filter_program;
                                    });
                                }

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
                                        <a href="<?= base_url('home/restore_donasi/'.$oke->id_donasi) ?>">
                                            <button class="btn btn-primary">Restore</button>
                                        </a>
                                        <a href="<?= base_url('home/hapus_donasi_permanent/'.$oke->id_donasi) ?>">
                                            <button class="btn btn-info">Delete</button>
                                        </a>
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

<script>
    // Filter Donasi function to submit the form
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
