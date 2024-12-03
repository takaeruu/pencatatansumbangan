<section class="section">
    <div class="row" id="basic-table">
        <div class="col-12 col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="text-transform: uppercase; font-size: 30px;">DONASI</h4>
                </div>

                <!-- Dropdown Filter for Program Name -->
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

                <!-- Button to trigger Modal for Adding Donation -->
                <button class="btn btn-warning" id="btnTambahDonasi" onclick="loadTambahDonasiForm()">
    <i class="fe fe-plus"></i> Tambah Donasi
</button>


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
                            <?php $no = 1; foreach ($oke as $donasi): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $donasi->nama_program ?></td>
                                    <td><?= $donasi->nama_pemberi ?></td>
                                    <td>Rp <?= number_format($donasi->jumlah_donasi, 0, ',', '.') ?></td>
                                    <td>
                                    <button class="btn btn-warning" onclick="loadEditDonasiForm(<?= $donasi->id_donasi ?>)">
    <i class="now-ui-icons ui-1_check"></i> Edit / Detail
</button>

                                        <a href="<?= base_url('home/hapus_donasi/'.$donasi->id_donasi) ?>" onclick="return confirm('Are you sure you want to delete this donation?')">
                                            <button class="btn btn-danger">Delete</button>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div id="dynamicContent"></div>


<!-- Include Bootstrap JavaScript if not already included -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Format for currency input (Donasi)
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

    // Format for input donation
    document.getElementById('hargadonasi').addEventListener('input', function(e) {
        let value = e.target.value.replace(/[^,\d]/g, '');
        if (value) {
            e.target.value = formatRupiah(value);
        }
    });

    // Apply Rupiah format to edit form fields as well
    document.querySelectorAll('[id^="editHargadonasi-"]').forEach(function(input) {
        input.addEventListener('input', function(e) {
            let value = e.target.value.replace(/[^,\d]/g, '');
            if (value) {
                e.target.value = formatRupiah(value);
            }
        });

        // Format on page load
        let initialValue = input.value.replace(/[^,\d]/g, '');
        if (initialValue) {
            input.value = formatRupiah(initialValue);
        }
    });

    // Function to filter donations by program
    function filterDonasi() {
        var programId = document.getElementById('programFilter').value;
        var form = document.createElement('form');
        form.method = 'GET';
        form.action = ''; // Current page

        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'filter_program';
        input.value = programId;

        form.appendChild(input);
        document.body.appendChild(form);
        form.submit();
    }

    // Function to clear the filter and reload page
    function clearFilter() {
        var form = document.createElement('form');
        form.method = 'GET';
        form.action = '';

        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'filter_program';
        input.value = '';

        form.appendChild(input);
        document.body.appendChild(form);
        form.submit();
    }

    // Load Add Donation form dynamically
    function loadTambahDonasiForm() {
    // Hide the "Tambah Donasi" button
    document.getElementById('btnTambahDonasi').style.display = 'none';

    // Hide the donation table content
    document.getElementById('basic-table').style.display = 'none';

    // Fetch and load the form for adding a new donation
    fetch('<?= base_url('home/t_donasi') ?>') // Endpoint for adding donation form
        .then(response => response.text()) // Convert response to HTML
        .then(data => {
            // Display the form inside the dynamicContent div
            document.getElementById('dynamicContent').innerHTML = data;

            // Add a back button
            let backButton = `
                <button class="btn btn-secondary mt-3" onclick="backToDonasiList()">
                    <i class="fe fe-arrow-left"></i> Back to Donasi List
                </button>
            `;
            document.getElementById('dynamicContent').insertAdjacentHTML('beforeend', backButton);
        })
        .catch(error => {
            console.error('Error:', error); // Log any errors
            alert('Terjadi kesalahan saat memuat form tambah donasi.');
        });
}



    // Load Edit Donation form dynamically
    function loadEditDonasiForm(id_donasi) {
    // Hide the "Tambah Donasi" button
    document.getElementById('btnTambahDonasi').style.display = 'none';

    // Hide the donation table content
    document.getElementById('basic-table').style.display = 'none';

    // Fetch and load the edit form for the donation
    fetch('<?= base_url('home/e_donasi') ?>/' + id_donasi) // Endpoint for editing donation
        .then(response => response.text()) // Convert response to HTML
        .then(data => {
            // Display the edit form inside the dynamicContent div
            document.getElementById('dynamicContent').innerHTML = data;

            // Add a back button
            let backButton = `
                <button class="btn btn-secondary mt-3" onclick="backToDonasiList()">
                    <i class="fe fe-arrow-left"></i> Back to Donasi List
                </button>
            `;
            document.getElementById('dynamicContent').insertAdjacentHTML('beforeend', backButton);
        })
        .catch(error => {
            console.error('Error:', error); // Log any errors
            alert('Terjadi kesalahan saat memuat form edit donasi.');
        });
}

function backToDonasiList() {
    // Hide the dynamic content
    document.getElementById('dynamicContent').innerHTML = '';

    // Show the donation table and "Tambah Donasi" button again
    document.getElementById('basic-table').style.display = 'block';
    document.getElementById('btnTambahDonasi').style.display = 'block';
}



</script>
