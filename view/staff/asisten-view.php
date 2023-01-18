<?php include_once 'view/template/sidebar.php' ?>

<div class="content-wrapper p-3">
    <div class="card card-primary collapsed-card">
        <div class="card-header">

            <h3 class="card-title">
                Asisten Dosen
            </h3>

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
                    <label for="idSemester" class="form-label">NRP</label>
                    <input type="number" min="0" class="form-control" id="idAsisten" name="txtIdAsisten">
                </div>

                <div class="form-group col-3">
                    <label for="namaAsisten" class="form-label">Nama Asisten</label>
                    <input type="text" class="form-control" id="namaAsisten" name="txtNamaAsisten">
                </div>

                <div class="form-group col-3">
                    <label for="noTelpAsisten" class="form-label">Nomor Telepon</label>
                    <input type="text" class="form-control" id="noTelpAsisten" name="txtNoTelpAsisten">
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

                <input type="submit" class="btn btn-primary" value="Add Asisten" name="btnSubmit">

            </form>
        </div>
    </div>

    <div class="card card-primary <?= $filterRekap ? 'collapsed-card' : '' ?>">
        <div class="card-header">
            <h3 class="card-title">
                List Asisten Dosen
            </h3>

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
                        <th>NRP</th>
                        <th>Nama</th>
                        <th>No Telp</th>
                        <th>Status</th>
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
                        if ($item->getStatus() == "1") {
                            echo "<td>Aktif</td>";
                        } else {
                            echo "<td>Tidak aktif</td>";
                        }
                        echo "<td><button class='btn btn-info' data-toggle='modal' data-target='#asisten-" . $item->getidAsistenDosen() . "'><i class='fa-solid fa-info'></i></button>
                        <button class='btn btn-warning' data-toggle='modal' data-target='#editAsisten-" . $item->getidAsistenDosen() . "'><i class='fa-solid fa-pen-to-square'></i></button></td>";
                        echo "</tr>";
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>

    <div class="card card-primary <?= $filterRekap ? '' : 'collapsed-card' ?>">
        <div class="card-header">
            <h3 class="card-title">
                Rekap Asisten
            </h3>
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
            <div class="form-group">
                <div class="form-group col-4">
                    <form method="post">
                        <label>Date From:</label>
                        <input type="date" class="form-control" name="filter-from-rekap" required>
                        <label>Date To:</label>
                        <input type="date" class="form-control" name="filter-to-rekap" required>
                        <input type="submit" value="Filter" name="filter-rekap" class="btn btn-primary my-4">
                    </form>
                </div>
            </div>
            <table id="example3" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>NRP</th>
                        <th>Nama Mahasiswa</th>
                        <th>Total Lama Asistensi (Jam)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($rekapAsisten as $index => $item) {
                        echo "<tr>";
                        echo "<td>" . $item["nrp"] . "</td>";
                        echo "<td>" . $item["nama_asisten"] . "</td>";
                        echo "<td>" . $item["lama_asistensi"] . "</td>";
                        echo "</tr>";
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>

    <?php if (isset($dataDetail)) { ?>
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    Detail <?= $asisten[$detailId]->getNama() . ' - ' . $detailAsisten[$detailId][$detailIndex]["kode_mata_kuliah"] ?>
                </h3>
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
                <div class="form-group">
                    <div class="form-group col-4">
                        <form method="post">
                            <input type='hidden' name='detailId' value='<?= $detailId ?>'>
                            <input type='hidden' name='detailIndex' value='<?= $detailIndex ?>'>
                            <label>Date From:</label>
                            <input type="date" class="form-control" name="filter-from" required>
                            <label>Date To:</label>
                            <input type="date" class="form-control" name="filter-to" required>
                            <input type="submit" value="Filter" name="btnDetail" class="btn btn-primary my-4">
                        </form>
                    </div>
                </div>
                <table id="example2" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Pertemuan</th>
                            <th>Lama Asistensi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($dataDetail as $index => $item) {
                            echo "<tr>";
                            echo "<td>" . date_format(date_create($item["waktu_mulai"]), "d F Y") . "</td>";
                            // echo "<td>" . date_format(date_create($item["waktu_selesai"]), "Y-m-d") . "</td>";
                            echo "<td>" . $item["pertemuan"] . "</td>";
                            echo "<td>" . $item["lama_asistensi"] . "</td>";
                            echo "</tr>";
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    <?php } ?>





</div>

<?php 
foreach ($detailAsisten as $index => $asisten) {
    
?>
    <div class="modal fade" id="asisten-<?= ($asisten != null) ? $asisten[0]["nrp"] : 0 ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Detail Asistensi</h1>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped dataTableAsisten" style="width:100%">
                        <thead>
                            <tr>
                                <th>Kode Mata Kuliah</th>
                                <th>Mata Kuliah</th>
                                <th>Kelas</th>
                                <th>Tipe Kelas</th>
                                <th>Total Jam</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($asisten as $idx => $item) {
                                echo "<tr>";
                                echo "<td>" . $item["kode_mata_kuliah"] . "</td>";
                                echo "<td>" . $item["nama"] . "</td>";
                                echo "<td>" . $item["kelas"] . "</td>";
                                echo "<td>" . $item["tipe_kelas"] . "</td>";
                                echo "<td>" . $item["total_jam"] . "</td>";
                                // echo "<td><button class='btn btn-warning' data-toggle='modal' data-target='#detail-$index$idx' data-dismiss='modal'>Detail</button></td>";
                                echo "<td><form method='post'>
                                <input type='hidden' name='detailId' value='$index'>
                                <input type='hidden' name='detailIndex' value='$idx'>
                                <input class='btn btn-warning' type='submit' name='btnDetail' value='Detail' >
                                </form></td>";
                                echo "</tr>";
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php foreach ($dataAsisten as $idx => $item) { ?>
    <div class="modal fade" id="editAsisten-<?= $item->getidAsistenDosen() ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post">
                <div class=" modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Edit Asisten Dosen</h1>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="idAsisten" class="form-label">ID Asisten Dosen</label>
                            <input type="text" class="form-control" id="idAsisten" name="updIdAsisten" value="<?php echo $item->getidAsistenDosen() ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="namaAsisten" class="form-label">Nama Asisten Dosen</label>
                            <input type="text" class="form-control" id="namaAsisten" name="updNamaAsisten" value="<?php echo $item->getNama() ?>">
                        </div>

                        <div class="form-group">
                            <label for="noTelp" class="form-label">No. Telp</label>
                            <input type="text" class="form-control" id="noTelp" name="updTelp" value="<?php echo $item->getNoTelp() ?>">
                        </div>

                        <div class="mb-4">
                            <label for="" class="form-label">Status</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="updRadioStatus" id="radioAktif" value="1" <?php echo ($item->getStatus() == '1') ? 'checked' : '' ?>>
                                <label class="form-check-label" for="radioAktif">
                                    Aktif
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="updRadioStatus" id="radioTidakAktif" value="0" <?php echo ($item->getStatus() == '0') ? 'checked' : '' ?>>
                                <label class="form-check-label" for="radioTidakAktif">
                                    Tidak Aktif
                                </label>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Update Asisten" name="btnUpdate">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
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
                method: "fetchAsistenStatus",
                statusActive: activeCheck,
                statusInactive: inactiveCheck
            },
            success: function(responsedata) {
                var table = $('#example1').DataTable();
                table.clear().draw();
                var response = $.parseJSON(responsedata);
                console.log(response);
                for (var i in response) {
                    var status;
                    if (response[i].status == 1) {
                        status = "Aktif"
                    } else {
                        status = "Tidak aktif"
                    }

                    table.row.add([
                        response[i].idAsistenDosen,
                        response[i].nama,
                        response[i].no_telp,
                        status,
                        "<button class='btn btn-info' data-toggle='modal' data-target='#asisten-" + response[i].idAsistenDosen + "'><i class='fa-solid fa-info'></i></button></td>"
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
                method: "fetchAsistenStatus",
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
                        response[i].idAsistenDosen,
                        response[i].nama,
                        response[i].no_telp,
                        status,
                        "<button class='btn btn-info' data-toggle='modal' data-target='#asisten-" + response[i].idAsistenDosen + "'><i class='fa-solid fa-info'></i></button></td>"
                    ]).draw(false);
                }
            }
        })
    });
</script>

<?php // foreach ($detailJadwalAsisten as $q => $asisten) { 
?>
<?php // foreach ($asisten as $w => $matkul) { 
?>
<!-- <div class="modal fade" id="detail-<?= $q . $w ?>" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Detail Asistensi</h1>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped dataTableAsisten" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Waktu Mulai</th>
                                    <th>Waktu Selesai</th>
                                    <th>Pertemuan</th>
                                    <th>Lama Asistensi</th>
                                </tr>
                            </thead>
                            <tbody> -->
<?php
// foreach ($matkul as $index => $item) {
//     echo "<tr>";
//     echo "<td>" . date_format(date_create($item["waktu_mulai"]), "d F Y") . "</td>";
//     echo "<td>" . date_format(date_create($item["waktu_selesai"]), "d F Y") . "</td>";
//     echo "<td>" . $item["pertemuan"] . "</td>";
//     echo "<td>" . $item["lama_asistensi"] . "</td>";
//     echo "</tr>";
// }
?>

<!-- </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" data-target="#asisten-<?= $q ?>" data-toggle="modal" data-dismiss="modal">Back</button>
                    </div>
                </div>
            </div>
        </div> -->
<?php // } 
?>
<?php // } 
?>