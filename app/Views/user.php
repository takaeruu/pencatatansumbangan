<section class="section">
    <div class="row" id="basic-table">
        <div class="col-12 col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">USER</h4>
                </div>

                <!-- Button for "Tambah User" -->
                <button class="btn btn-warning" id="btnTambahUser" onclick="loadTambahUserForm()">
                    <i class="fe fe-plus"></i> Tambah User
                </button>

                <div class="card-content" id="userTableContent">  <!-- This will contain the user table -->
                    <div class="card-body">
                        <!-- Table with outer spacing -->
                        <table class="table table-lg">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Username</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($oke as $key) {
                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $key->username ?></td>
                                        <td><?= $key->level ?></td>
                                        <td>
                                            <!-- Button for "Edit User" -->
                                            <button class="btn btn-warning" onclick="loadEditUserForm(<?= $key->id_user ?>)">
                                                <i class="now-ui-icons ui-1_check"></i> Edit
                                            </button>

                                            <!-- Delete Button -->
                                            <a href="<?= base_url('home/hapus_user/' . $key->id_user) ?>">
                                                <button class="btn btn-danger">
                                                    <i class="now-ui-icons ui-1_check"></i> Delete
                                                </button>
                                            </a>

                                            <!-- Reset Password Button -->
                                            <a href="<?= base_url('home/resetpassword/' . $key->id_user) ?>">
                                                <button class="btn btn-danger">
                                                    <i class="now-ui-icons ui-1_check"></i> Reset Password
                                                </button>
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

<!-- Dynamic Content Placeholder -->
<div id="dynamicContent"></div>

<script>
    // Function to load "Tambah User" form dynamically
    function loadTambahUserForm() {
        // Hide the "Tambah User" button
        document.getElementById('btnTambahUser').style.display = 'none';

        // Hide the user table content
        document.getElementById('userTableContent').style.display = 'none';

        // Fetch and load the form for adding a new user
        fetch('<?= base_url('home/t_user') ?>') // Endpoint for adding user form
            .then(response => response.text()) // Convert response to HTML
            .then(data => {
                // Display the form inside the dynamicContent div
                document.getElementById('dynamicContent').innerHTML = data;

                // Add a back button
                let backButton = `
                    <button class="btn btn-secondary" onclick="backToUserList()">
                        <i class="fe fe-arrow-left"></i> Back to User List
                    </button>
                `;
                document.getElementById('dynamicContent').insertAdjacentHTML('beforeend', backButton);
            })
            .catch(error => {
                console.error('Error:', error); // Log any errors
                alert('Terjadi kesalahan saat memuat form tambah user.');
            });
    }

    // Function to load "Edit User" form dynamically
    function loadEditUserForm(id_user) {
        // Hide the "Tambah User" button
        document.getElementById('btnTambahUser').style.display = 'none';

        // Hide the user table content
        document.getElementById('userTableContent').style.display = 'none';

        // Fetch and load the edit form for the user
        fetch('<?= base_url('home/e_user') ?>/' + id_user)
// Endpoint for editing user
            .then(response => response.text()) // Convert response to HTML
            .then(data => {
                // Display the edit form inside the dynamicContent div
                document.getElementById('dynamicContent').innerHTML = data;

                // Add a back button
                let backButton = `
                    <button class="btn btn-secondary" onclick="backToUserList()">
                        <i class="fe fe-arrow-left"></i> Back to User List
                    </button>
                `;
                document.getElementById('dynamicContent').insertAdjacentHTML('beforeend', backButton);
            })
            .catch(error => {
                console.error('Error:', error); // Log any errors
                alert('Terjadi kesalahan saat memuat form edit user.');
            });
    }

    // Function to return to the user list
    function backToUserList() {
        // Show the "Tambah User" button again
        document.getElementById('btnTambahUser').style.display = 'inline-block';

        // Show the user table content again
        document.getElementById('userTableContent').style.display = 'block';

        // Clear the dynamic content area (form area)
        document.getElementById('dynamicContent').innerHTML = '';
    }
</script>
