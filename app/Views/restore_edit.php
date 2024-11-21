<section class="section">
    <div class="row" id="basic-table">
        <div class="col-12 col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="text-transform: uppercase; font-size: 30px;">PROGRAM</h4>
                </div>
                
                <!-- Button to trigger Modal for Adding program -->


                <!-- Card Content with Table -->
                <div class="card-content">
                    <div class="card-body">
                        <!-- Table with outer spacing -->
                        <table class="table table-lg">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Nama Program</th>
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
                                    <td>
                                        <!-- Edit Button with Modal Trigger -->
                                        <a href="<?= base_url('home/aksi_restore_edit_program/' . $oke->id_program) ?>">
                                            <button class="btn btn-primary">Restore</button>
                                        </a>
                                        <a href="<?= base_url('home/hapus_program/'.$oke->id_program) ?>">
                                            <button class="btn btn-info">Delete</button>
                                        </a>

                                        <!-- Modal for Editing program -->
                                        
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
