<div class="wrapper">

    <?php include_once 'view/template/sidebar.php' ?>

    <div class="container">

        <form  method="post" enctype="multipart/form-data">

        <h5 class="my-4">Logged in as : <?= $_SESSION['web_user_full_name'] ?></h5>
        <h5 class="my-4">Semester : <?= $semesterAktif->getNama() ?></h5>

        <div class="mb-3">
            <label for="" class="form-label">Jadwal</label>
            <select class="form-select" name="jadwal" required>
                <?php foreach ($jadwalDosen as $jadwal) { ?>
                    <option value="<?= $jadwal->getMataKuliah()->getIdMataKuliah() . '-' . $jadwal->getKelas() . '-' . $jadwal->getTipeKelas() ?>"><?= $jadwal ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="mb-3 col-2">
            <label for="" class="form-label">Pertemuan</label>
            <input type="number" min="1" max="16" class="form-control" id="" name="pertemuan" required>
        </div>

        <div class="mb-3 col-4">
            <label for="" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="" value="<?php echo date('Y-m-d'); ?>" name="tanggal" required>
        </div>

        <div class="mb-3 col-3">
            <label for="" class="form-label">Waktu Mulai</label>
            <input type="time" class="form-control" id="" value="<?php echo date("Y/m/d h:i:s a"); ?>" name="waktu-mulai" required>
        </div>

        <div class="mb-3 col-3">
            <label for="" class="form-label">Waktu Selesai</label>
            <input type="time" class="form-control" id="" value="<?php echo date("Y/m/d h:i:s a"); ?>" name="waktu-selesai" required>
        </div>

        <div class="mb-5 col-3">
            <label for="" class="form-label">Rangkuman Materi</label>
            <textarea class="form-control" id="" rows="10" name="pembahasan-materi" required></textarea>
        </div>
        
        <div class="mb-5 col-3">
            <label for="" class="form-label">Catatan</label>
            <textarea class="form-control" id="" rows="3" name="rangkuman" required></textarea>
        </div>

        <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" value="true" id="isAsisten" name="isAsisten">
            <label class="form-check-label" for="isAsisten">
                Dibantu Asisten
            </label>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Asisten</label>
            <select class="form-select" aria-label="Default select example" id="select-asisten" disabled name="asisten">
                <?php foreach($dataAsisten as $asisten) { ?>    
                    <option value="<?= $asisten->getidAsistenDosen() ?>"><?= $asisten->getNama() ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="mb-3 col-3">
            <label for="" class="form-label">Lama Asistensi</label>
            <input type="number" min="0" class="form-control" disabled id="lama-asisten" name="lama-asistensi">
        </div>

        <div class="mb-3">
            <label for="formFile" class="form-label">Upload Bukti Foto</label>
            <input class="form-control" type="file" id="foto-presensi" name="foto-presensi" accept="image/png, image/jpeg">
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
        console.log($('#isAsisten').val());
        $('#isAsisten').val(state_select);
        $('#select-asisten').prop( "disabled", !state_select );
        $('#lama-asisten').prop( "disabled", !state_select );
    });
</script>