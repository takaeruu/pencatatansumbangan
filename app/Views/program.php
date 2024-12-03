<section class="section">
    <div class="row" id="basic-table">
        <div class="col-12 col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="text-transform: uppercase; font-size: 30px;">PROGRAM</h4>
                </div>
                
                <!-- Button to trigger Modal for Adding program -->
                <button class="btn btn-warning" id="btnTambahProgram" onclick="loadTambahProgramForm()">
                    <i class="fe fe-plus"></i> Tambah Program
                </button>

                <!-- Card Content with Table -->
                <div class="card-content">
                    <div class="card-body">
                        <!-- Table with outer spacing -->
                        <table class="table table-lg" id="programTableContent">
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
                                        <button class="btn btn-warning" onclick="loadEditProgramForm(<?= $oke->id_program ?>)">
                                            <i class="now-ui-icons ui-1_check"></i> Edit / Detail
                                        </button>

                                        <a href="<?= base_url('home/hapus_program/'.$oke->id_program) ?>">
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


<div id="dynamicContent"></div>
<!-- Include Bootstrap JavaScript if not already included -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // Format input untuk harga program
document.getElementById('hargaprogram').addEventListener('input', function(e) {
    let value = e.target.value.replace(/[^,\d]/g, '');
    if (value) {
        e.target.value = formatRupiah(value);
    }
});

// Format rupiah untuk input harga program
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

// Format harga pada input edit program
document.querySelectorAll('[id^="editHargaprogram-"]').forEach(function(input) {
    input.addEventListener('input', function(e) {
        let value = e.target.value.replace(/[^,\d]/g, '');
        if (value) {
            e.target.value = formatRupiah(value);
        }
    });

    // Format harga on page load
    let initialValue = input.value.replace(/[^,\d]/g, '');
    if (initialValue) {
        input.value = formatRupiah(initialValue);
    }
});

// Function to load "Tambah Program" form dynamically
function loadTambahProgramForm() {
    // Hide the "Tambah Program" button
    document.getElementById('btnTambahProgram').style.display = 'none';

    // Hide the program table content
    document.getElementById('programTableContent').style.display = 'none';

    // Fetch and load the form for adding a new program
    fetch('<?= base_url('home/t_program') ?>') // Endpoint for adding program form
        .then(response => response.text()) // Convert response to HTML
        .then(data => {
            // Display the form inside the dynamicContent div
            document.getElementById('dynamicContent').innerHTML = data;

            // Add a back button
            let backButton = `
                <button class="btn btn-secondary" onclick="backToProgramList()">
                    <i class="fe fe-arrow-left"></i> Back to Program List
                </button>
            `;
            document.getElementById('dynamicContent').insertAdjacentHTML('beforeend', backButton);
        })
        .catch(error => {
            console.error('Error:', error); // Log any errors
            alert('Terjadi kesalahan saat memuat form tambah program.');
        });
}


// Function to load "Edit Program" form dynamically
function loadEditProgramForm(id_program) {
    // Hide the "Tambah Program" button
    document.getElementById('btnTambahProgram').style.display = 'none';

    // Hide the program table content
    document.getElementById('programTableContent').style.display = 'none';

    // Fetch and load the edit form for the program
    fetch('<?= base_url('home/e_program') ?>/' + id_program) // Endpoint for editing program
        .then(response => response.text()) // Convert response to HTML
        .then(data => {
            // Display the edit form inside the dynamicContent div
            document.getElementById('dynamicContent').innerHTML = data;

            // Add a back button
            let backButton = `
                <button class="btn btn-secondary" onclick="backToProgramList()">
                    <i class="fe fe-arrow-left"></i> Back to Program List
                </button>
            `;
            document.getElementById('dynamicContent').insertAdjacentHTML('beforeend', backButton);
        })
        .catch(error => {
            console.error('Error:', error); // Log any errors
            alert('Terjadi kesalahan saat memuat form edit program.');
        });
}

// Function to return to the program list
function backToProgramList() {
    // Show the "Tambah Program" button again
    document.getElementById('btnTambahProgram').style.display = 'inline-block';

    // Show the program table content again
    document.getElementById('programTableContent').style.display = 'block';

    // Clear the dynamic content area (form area)
    document.getElementById('dynamicContent').innerHTML = '';
}

</script>
