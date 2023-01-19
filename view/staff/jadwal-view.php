<?php include_once 'view/template/sidebar.php' ?>

<div class="content-wrapper p-3">
    <div class="card card-primary collapsed-card">
        <div class="card-header">
            <h3 class="card-title">Import data Jadwal</h3>

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
            <a class="btn btn-success mb-4" href="uploads/templates/template_jadwal.xlsx"><i class="fa-solid fa-file-arrow-down"></i> Download Template</a>
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group col-4">
                    <label for="idMataKuliah" class="form-label">Upload File</label>
                    <input type="file" class="form-control" id="idMataKuliah" name="fileImport" accept=".xls, .xlsx">
                </div>
                <div class="form-group col-4">
                    <input type="checkbox" name="rowTitle" id="rowTitle" checked>
                    <label for="rowTitle" class="form-label">First Row is Heading (Using Template)</label>
                </div>
                <input type="submit" class="btn btn-primary" name="btnImport" value="Import data">
            </form>

        </div>
    </div>

    <div class="card card-primary collapsed-card">
        <div class="card-header">
            <h3 class="card-title">Add Jadwal</h3>
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

            <form id="form" method="post">

                <h5>Semester : <?= $semesterAktif->getNama() ?></h5>

                <div class="form-group">
                    <label for="mataKuliah" class="form-label">Mata Kuliah</label>
                    <select class="form-select" id="mataKuliah" name="optMataKuliah" required>
                        <option selected disabled>Select Mata Kuliah</option>
                        <?php foreach ($dataMataKuliah as $mataKuliah) { ?>
                            <option value="<?= $mataKuliah->getIdMataKuliah() ?>"><?= $mataKuliah ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="dosen" class="form-label">Dosen</label>
                    <select class="form-select" id="dosen" name="optDosen" required>
                        <option selected disabled>Select Dosen</option>
                        <?php foreach ($dataDosen as $dosen) { ?>
                            <option value="<?= $dosen->getIdUser() ?>"><?= $dosen ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="radioKelas" id="radioKelasA" value="A" checked>
                        <label class="form-check-label" for="radioKelasA">
                            Kelas A
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="radioKelas" id="radioKelasB" value="B">
                        <label class="form-check-label" for="radioKelasB">
                            Kelas B
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="radioTipeKelas" id="radioTeori" value="Teori" checked>
                        <label class="form-check-label" for="radioTeori">
                            Teori
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="radioTipeKelas" id="radioPraktikum" value="Praktikum">
                        <label class="form-check-label" for="radioPraktikum">
                            Praktikum
                        </label>
                    </div>
                </div>

                <div class="form-group col-3">
                    <label for="hari" class="form-label">Hari</label>
                    <select name="optHari" id="hari" class="form-select" required>
                        <option selected disabled>Select Hari</option>
                        <option value="Senin">Senin</option>
                        <option value="Selasa">Selasa</option>
                        <option value="Rabu">Rabu</option>
                        <option value="Kamis">Kamis</option>
                        <option value="Jumat">Jumat</option>
                        <option value="Sabtu">Sabtu</option>
                    </select>
                </div>

                <div class="form-group col-3">
                    <label for="" class="form-label">Waktu Mulai</label>
                    <input type="time" class="form-control" id="" value="<?php echo date("Y/m/d h:i:s a"); ?>" name="waktu-mulai" required>
                </div>

                <div class="form-group col-3">
                    <label for="" class="form-label">Waktu Selesai</label>
                    <input type="time" class="form-control" id="" value="<?php echo date("Y/m/d h:i:s a"); ?>" name="waktu-selesai" required>
                </div>

                <div class="form-group">
                    <label for="ruangan" class="form-label">Ruangan</label>
                    <select class="form-select" id="ruangan" name="optRuangan">
                        <?php foreach ($dataRuangan as $ruangan) { ?>
                            <option value="<?= $ruangan->getIdRuangan() ?>"><?= $ruangan->getNama() ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <button id="btnSubmit" class="btn btn-primary" type="submit" name="btnSubmit">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">List Jadwal</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                    <i class="fas fa-expand"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>

        </div>
        <div class="card-body">
            <form method="post">
                <div class="form-group">
                    <label for="" class="form-label">Semester</label>
                    <select class="form-select" name="filter-semester" id="optSemester">
                        <option selected disabled>Select Semester</option>
                        <?php foreach ($dataSemester as $semester) { ?>
                            <option value="<?= $semester->getIdSemester() ?>" <?= $selectedSemester == $semester->getIdSemester() ? 'selected' : '' ?> ><?= $semester->getNama() ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <button id="btnSubmit" class="btn btn-primary" type="submit" name="btnFilter">Filter</button>
                </div>
            </form>
            <table id="example1" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Kode Mata Kuliah</th>
                        <th>Mata Kuliah</th>
                        <th>Kelas</th>
                        <th>Tipe Kelas</th>
                        <th>Ruangan</th>
                        <th>Waktu</th>
                        <th>Semester</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($dataJadwal as $index => $item) {
                        echo "<tr>";
                        echo "<td>" . $item->getMataKuliah()->getIdMataKuliah() . "</td>";
                        echo "<td>" . $item->getMataKuliah()->getNama() . "</td>";
                        echo "<td>" . $item->getKelas() . "</td>";
                        echo "<td>" . $item->getTipeKelas() . "</td>";
                        echo "<td>" . $item->getRuangan()->getNama() . "</td>";
                        echo "<td>" . $item->getHari() . ', ' . date('H:i', strtotime($item->getWaktuMulai())) . ' - ' . date('H:i', strtotime($item->getWaktuSelesai())) . "</td>";
                        echo "<td>" . $item->getSemester()->getNama() . "</td>";
                        echo '<td><button onclick="editJadwal(\'' . $item->getMataKuliah()->getIdMataKuliah() . '-' . $item->getUser()->getIdUser() . '-' .  $item->getSemester()->getIdSemester() . '-' . $item->getKelas() . '-' . $item->getTipeKelas() .'\')" class="btn btn-warning" data-toggle="modal" data-target="#editJadwalModal"><i class="fa-solid fa-pen-to-square"></i></button>
                        <button onclick="deleteJadwal(\'' . $item->getMataKuliah()->getIdMataKuliah() . '-' . $item->getUser()->getIdUser() . '-' .  $item->getSemester()->getIdSemester() . '-' . $item->getKelas() . '-' . $item->getTipeKelas() .'\')" class="btn btn-danger" data-toggle="modal" data-target="#deleteJadwalModal"><i class="fa-solid fa-trash"></i></button>
                        </td>';
                        echo "</tr>";
                    }
                    ?>

                </tbody>
            </table>
        </div>


    </div>
</div>
<div class="modal fade" id="editJadwalModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post">
                <input type="hidden" name="editMataKuliah" id="editMataKuliah">
                <input type="hidden" name="editDosen" id="editDosen">
                <input type="hidden" name="editSemester" id="editSemester">
                <input type="hidden" name="editKelas" id="editKelas">
                <input type="hidden" name="editTipeKelas" id="editTipeKelas">
                <div class=" modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Edit jadwal</h1>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                <div class="form-group">
                    <label for="editHari" class="form-label">Hari</label>
                    <select name="editHari" id="editHari" class="form-select" required>
                        <option selected disabled>Select Hari</option>
                        <option value="Senin">Senin</option>
                        <option value="Selasa">Selasa</option>
                        <option value="Rabu">Rabu</option>
                        <option value="Kamis">Kamis</option>
                        <option value="Jumat">Jumat</option>
                        <option value="Sabtu">Sabtu</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="" class="form-label">Waktu Mulai</label>
                    <input type="time" class="form-control" id="editWaktuMulai" value="<?php echo date("Y/m/d h:i:s a"); ?>" name="edit-waktu-mulai" required>
                </div>

                <div class="form-group">
                    <label for="" class="form-label">Waktu Selesai</label>
                    <input type="time" class="form-control" id="editWaktuSelesai" value="<?php echo date("Y/m/d h:i:s a"); ?>" name="edit-waktu-selesai" required>
                </div>

                <div class="form-group">
                    <label for="editRuangan" class="form-label">Ruangan</label>
                    <select class="form-select" id="editRuangan" name="editRuangan">
                        <?php foreach ($dataRuangan as $ruangan) { ?>
                            <option value="<?= $ruangan->getIdRuangan() ?>"><?= $ruangan->getNama() ?></option>
                        <?php } ?>
                    </select>
                </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Update Jadwal" name="btnUpdate">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<div class="modal fade" id="deleteJadwalModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post">
            <input type="hidden" name="deleteMataKuliah" id="deleteMataKuliah">
            <input type="hidden" name="deleteDosen" id="deleteDosen">
            <input type="hidden" name="deleteSemester" id="deleteSemester">
            <input type="hidden" name="deleteKelas" id="deleteKelas">
            <input type="hidden" name="deleteTipeKelas" id="deleteTipeKelas">
            <div class=" modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Delete Jadwal</h1>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span>Are you sure want to delete this data?</span>
                </div>
                <div class="modal-footer">
                    <button id="deleteConfirm" class="btn btn-primary" name="btnDelete">Delete Jadwal</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $(function() {
        $('#form').validate({
            rules: {


            },
            messages: {


            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });

    });

    function editJadwal(jadwal) {
        let array_jadwal = jadwal.split("-");
        $('#editMataKuliah').val(array_jadwal[0]);
        $('#editDosen').val(array_jadwal[1]);
        $('#editSemester').val(array_jadwal[2]);
        $('#editKelas').val(array_jadwal[3]);
        $('#editTipeKelas').val(array_jadwal[4]);
    }

    function deleteJadwal(jadwal) {
        let array_jadwal = jadwal.split("-");
        $('#deleteMataKuliah').val(array_jadwal[0]);
        $('#deleteDosen').val(array_jadwal[1]);
        $('#deleteSemester').val(array_jadwal[2]);
        $('#deleteKelas').val(array_jadwal[3]);
        $('#deleteTipeKelas').val(array_jadwal[4]);
    }
</script>