<div class="wrapper">

    <?php include_once 'view/template/sidebar.php' ?>

    <div class="container">

        <form method="post">

            <h5 class="my-4">Semester : <?= $semesterAktif->getNama() ?></h5>

            <div class="mb-3">
                <label for="mataKuliah" class="form-label">Mata Kuliah</label>
                <select class="form-select" id="mataKuliah" name="optMataKuliah">
                    <?php foreach ($dataMataKuliah as $mataKuliah) { ?>
                        <option value="<?= $mataKuliah->getIdMataKuliah() ?>"><?= $mataKuliah->getIdMataKuliah() . ' - ' . $mataKuliah->getNama() ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-4">
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

            <div class="mb-3">
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

            <div class="mb-3 col-3">
                <label for="" class="form-label">Waktu Mulai</label>
                <input type="time" class="form-control" id="" value="<?php echo date("Y/m/d h:i:s a"); ?>" name="waktu-mulai">
            </div>

            <div class="mb-3 col-3">
                <label for="" class="form-label">Waktu Selesai</label>
                <input type="time" class="form-control" id="" value="<?php echo date("Y/m/d h:i:s a"); ?>" name="waktu-selesai">
            </div>

            <div class="mb-3">
                <label for="ruangan" class="form-label">Ruangan</label>
                <select class="form-select" id="ruangan" name="optRuangan">
                    <?php foreach ($dataRuangan as $ruangan) { ?>
                        <option value="<?= $ruangan->getIdRuangan() ?>"><?= $ruangan->getNama() ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-3">
                <button class="btn btn-primary" type="submit" name="btnSubmit">Submit</button>
            </div>
    </div>
</div>