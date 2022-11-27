<div class="wrapper">
    <?php include_once 'view/template/sidebar.php' ?>

    <div class="container">

        <h2>Dosen</h2>

        <form method="post">

            <div class="mb-3 col-2">
                <label for="idDosen" class="form-label">ID Dosen</label>
                <input type="text" class="form-control" id="idDosen" name="txtIdDosen">
            </div>

            <div class="mb-3 col-2">
                <label for="namaDosen" class="form-label">Nama Dosen</label>
                <input type="text" class="form-control" id="namaDosen" name="txtNamaDosen">
            </div>

            <div class="mb-4">
                <label for="" class="form-label">Status</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="radioStatus" id="radioAktif" value="1" checked>
                    <label class="form-check-label" for="radioAktif">
                        Aktif
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="radioStatus" id="radioTidakAktif" value="0">
                    <label class="form-check-label" for="radioTidakAktif">
                        Tidak Aktif
                    </label>
                </div>
            </div>

            <input type="submit" class="btn btn-primary mb-3" value="Add Dosen" name="btnSubmit">

        </form>

        <table id="dataTable" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>ID Dosen</th>
                    <th>Nama</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($dataDosen as $index => $item) {
                    echo "<tr>";
                    echo "<td>" . $item->getIdUser() . "</td>";
                    echo "<td>" . $item->getNama() . "</td>";
                    echo "<td>" . $item->getStatus() . "</td>";
                    echo "<td><button class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#dosen-$index'><i class='fa-solid fa-pen-to-square'></i></button></td>";
                    echo "</tr>";
                }
                ?>

            </tbody>
        </table>

    </div>
</div>

<?php foreach ($dataDosen as $index => $dosen) { ?>
    <div class="modal fade" id="dosen-<?= $index ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <form method="post">
                <div class=" modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Edit dosen</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="idDosen" class="form-label">ID Dosen</label>
                            <input type="text" class="form-control" id="idDosen" name="txtIdDosen" value="<?php echo $dosen->getIdUser() ?>" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="namaDosen" class="form-label">Nama Dosen</label>
                            <input type="text" class="form-control" id="namaDosen" name="txtNamaDosen" value="<?php echo $dosen->getNama() ?>">
                        </div>

                        <div class="mb-4">
                            <label for="" class="form-label">Status</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="radioStatus" id="radioAktif" value="1" <?php echo ($dosen->getStatus() == '1') ? 'checked' : '' ?>>
                                <label class="form-check-label" for="radioAktif">
                                    Aktif
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="radioStatus" id="radioTidakAktif" value="0" <?php echo ($dosen->getStatus() == '0') ? 'checked' : '' ?>>
                                <label class="form-check-label" for="radioTidakAktif">
                                    Tidak Aktif
                                </label>
                            </div>
                        </div>



                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Update Dosen" name="btnUpdate">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
            </form>
        </div>
    </div>
    </div>
<?php } ?>