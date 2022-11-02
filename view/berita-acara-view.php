<div class="wrapper">

    <?php include_once 'view/template/sidebar.php' ?>

    <div class="container">

        <form  method="post">

        <h5 class="my-4">Logged in as : <?= $_SESSION['web_user_full_name'] ?></h5>
        <h5 class="my-4">Semester : <?= $semesterAktif->getNama() ?></h5>

        <div class="mb-3">
            <label for="" class="form-label">Jadwal</label>
            <select class="form-select" name="jadwal">
                <?php foreach ($jadwalDosen as $jadwal) { ?>
                    <option value="<?= $jadwal->getMataKuliah()->getIdMataKuliah() . '-' . $jadwal->getTipeKelas() ?>"><?= $jadwal ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="mb-5">
            <label for="" class="form-label">Kelas</label>
            <select class="form-select" name="kelas">
                <option value="A">Kelas A</option>
                <option value="B">Kelas B</option>
            </select>
        </div>

        <div class="mb-3 col-2">
            <label for="" class="form-label">Pertemuan</label>
            <input type="number" min="1" max="16" class="form-control" id="" name="pertemuan">
        </div>

        <div class="mb-3 col-4">
            <label for="" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="" value="<?php echo date('Y-m-d'); ?>" name="tanggal">
        </div>

        <div class="mb-3 col-3">
            <label for="" class="form-label">Waktu Mulai</label>
            <input type="time" class="form-control" id="" value="<?php echo date("Y/m/d h:i:s a"); ?>" name="waktu-mulai">
        </div>

        <div class="mb-3 col-3">
            <label for="" class="form-label">Waktu Selesai</label>
            <input type="time" class="form-control" id="" value="<?php echo date("Y/m/d h:i:s a"); ?>" name="waktu-selesai">
        </div>

        <div class="mb-5 col-3">
            <label for="" class="form-label">Rangkuman</label>
            <textarea class="form-control" id="" rows="10" name="rangkuman"></textarea>
        </div>

        <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" value="" id="isAsisten" name="isAsisten">
            <label class="form-check-label" for="isAsisten">
                Dibantu Asisten
            </label>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Asisten</label>
            <select class="form-select" aria-label="Default select example" id="select-asisten" disabled name="asisten">
                <option value="1">Asisten A</option>
                <option value="1">Asisten B</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="formFile" class="form-label">Upload Bukti Foto</label>
            <input class="form-control" type="file" id="formFile" name="foto-presensi">
        </div>

        <div class="mb-3">
            <button class="btn btn-primary" type="submit" name="btnSubmit">Submit</button>
        </div>

        </form>

    </div>
</div>
<script>
    $('#isAsisten').change((e) => {
        let state_select = $('#select-asisten').prop('disabled');
        $('#select-asisten').prop( "disabled", !state_select );
    });
</script>