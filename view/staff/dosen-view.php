<?php include_once 'view/template/sidebar.php' ?>

<div class="content-wrapper p-3">
    <div class="card card-primary collapsed-card">
        <div class="card-header">
            <h3 class="card-title">Add Dosen</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="maximize" title="Full Screen">
                    <i class="fas fa-expand"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <form method="post">

                <div class="form-group col-2">
                    <label for="idDosen" class="form-label">ID Dosen</label>
                    <input type="text" class="form-control" id="idDosen" name="txtIdDosen">
                </div>

                <div class="form-group col-2">
                    <label for="namaDosen" class="form-label">Nama Dosen</label>
                    <input type="text" class="form-control" id="namaDosen" name="txtNamaDosen">
                </div>

                <div class="form-group">
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

                <input type="submit" class="btn btn-primary" value="Add Dosen" name="btnSubmit">

            </form>
        </div>
    </div>

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">List Dosen</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="maximize" title="Full Screen">
                    <i class="fas fa-expand"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            <p class="mb-2">Filter Status by:</p>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="activeCheck" checked>
                <label class="form-check-label" for="activeCheck">
                    Aktif
                </label>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" value="" id="inactiveCheck" checked>
                <label class="form-check-label" for="inactiveCheck">
                    Tidak Aktif
                </label>
            </div>
            <table id="example1" class="table table-striped" style="width:100%">
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
                        if ($item->getStatus() == "1") {
                            echo "<td>Aktif</td>";
                        } else {
                            echo "<td>Tidak aktif</td>";
                        }
                        echo "<td><button class='btn btn-warning' data-toggle='modal' data-target='#dosen-" . $item->getIdUser() . "'><i class='fa-solid fa-pen-to-square'></i></button></td>";
                        echo "</tr>";
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>

</div>

<?php foreach ($dataDosen as $index => $dosen) { ?>
    <div class="modal fade" id="dosen-<?= $dosen->getIdUser() ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post">
                <div class=" modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Edit dosen</h1>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="idDosen" class="form-label">ID Dosen</label>
                            <input type="text" class="form-control" id="idDosen" name="txtIdDosen" value="<?php echo $dosen->getIdUser() ?>" readonly>
                        </div>

                        <div class="form-group">
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
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
            </form>
        </div>
    </div>
</div>
<?php } ?>

<script>
    var activeCheck = 1;
    var inactiveCheck = 0;

    $("#activeCheck").change(function() {
        if ($("#activeCheck").prop('checked') == true) {
            activeCheck = 1;
        } else {
            activeCheck = 10;
        }
        $.ajax({
            url: 'controller/AjaxController.php',
            type: 'post',
            data: {
                method: "fetchDosenStatus",
                statusActive: activeCheck,
                statusInactive: inactiveCheck
            },
            success: function(responsedata) {
                var table = $('#example1').DataTable();
                table.clear().draw();
                var response = $.parseJSON(responsedata);
                for (var i in response) {
                    var status;
                    if (response[i].status == 1) {
                        status = "Aktif"
                    } else {
                        status = "Tidak aktif"
                    }

                    table.row.add([
                        response[i].idUser,
                        response[i].nama,
                        status,
                        "<button class='btn btn-warning' data-toggle='modal' data-target='#dosen-" + response[i].idUser + "'><i class='fa-solid fa-pen-to-square'></i></button>"
                    ]).draw(false);




                }

            }
        })
    });

    $("#inactiveCheck").change(function() {
        if ($("#inactiveCheck").prop('checked') == true) {
            inactiveCheck = 0;
        } else {
            inactiveCheck = 10;
        }
        $.ajax({
            url: 'controller/AjaxController.php',
            type: 'post',
            data: {
                method: "fetchDosenStatus",
                statusActive: activeCheck,
                statusInactive: inactiveCheck
            },
            success: function(responsedata) {
                var table = $('#example1').DataTable();
                table.clear().draw();
                var response = $.parseJSON(responsedata);
                for (var i in response) {
                    var status;
                    if (response[i].status == 1) {
                        status = "Aktif"
                    } else {
                        status = "Tidak aktif"
                    }

                    table.row.add([
                        response[i].idUser,
                        response[i].nama,
                        status,
                        "<button class='btn btn-warning' data-toggle='modal' data-target='#dosen-" + response[i].idUser + "'><i class='fa-solid fa-pen-to-square'></i></button>"
                    ]).draw(false);




                }


            }
        })
    });
</script>