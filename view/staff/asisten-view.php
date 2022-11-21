<div class="wrapper">

    <?php include_once 'view/template/sidebar.php' ?>

    <div class="container">
        <h2>Asisten</h2>

        <form method="post">

            <div class="mb-3 col-2">
                <label for="idSemester" class="form-label">NRP</label>
                <input type="number" min="0" class="form-control" id="idAsisten" name="txtIdAsisten">
            </div>

            <div class="mb-3 col-3">
                <label for="namaAsisten" class="form-label">Nama Asisten</label>
                <input type="text" class="form-control" id="namaAsisten" name="txtNamaAsisten">
            </div>
            
            <div class="mb-3 col-3">
                <label for="noTelpAsisten" class="form-label">Nomor Telepon</label>
                <input type="text" class="form-control" id="noTelpAsisten" name="txtNoTelpAsisten">
            </div>

            <input type="submit" class="btn btn-primary mb-3" value="Add Asisten" name="btnSubmit">

        </form>


        <table id="dataTable" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>NRP</th>
                    <th>Nama</th>
                    <th>No Telp</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($asisten as $index => $item) {
                    echo "<tr>";
                    echo "<td>" . $item->getidAsistenDosen() . "</td>";
                    echo "<td>" . $item->getNama() . "</td>";
                    echo "<td>" . $item->getNoTelp() . "</td>";
                    echo "<td><button class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#asisten-$index'>Detail</button></td>";
                    echo "</tr>";
                }
                ?>

            </tbody>
        </table>

    </div>
</div>

<?php foreach ($detailAsisten as $index => $asisten) { ?>
    <div class="modal fade" id="asisten-<?= $index ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Detail Asistensi</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table id="dataTable" class="table table-striped dataTable" style="width:100%">
                        <thead>
                            <tr>
                                <th>Kode Mata Kuliah</th>
                                <th>Mata Kuliah</th>
                                <th>Kelas</th>
                                <th>Tipe Kelas</th>
                                <th>Total Jam</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($asisten as $index => $item) {
                                echo "<tr>";
                                echo "<td>" . $item["kode_mata_kuliah"] . "</td>";
                                echo "<td>" . $item["nama"] . "</td>";
                                echo "<td>" . $item["kelas"] . "</td>";
                                echo "<td>" . $item["tipe_kelas"] . "</td>";
                                echo "<td>" . $item["total_jam"] . "</td>";
                                echo "</tr>";
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>