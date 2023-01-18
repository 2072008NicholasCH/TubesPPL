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
                        echo "</tr>";
                    }
                    ?>

                </tbody>
            </table>
        </div>


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
</script>