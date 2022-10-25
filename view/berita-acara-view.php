<div class="wrapper">

    <?php include_once 'view/template/sidebar.php' ?>

    <div class="container">

        <h5 class="my-4">Logged in as : <?= $_SESSION['web_user_full_name'] ?></h5>

        <div class="mb-3">
            <label for="" class="form-label">Jadwal</label>
            <select class="form-select" aria-label="Default select example">
                <option value="1">Jadwal 1</option>
                <option value="1">Jadwal 2</option>
                <option value="1">Jadwal 3</option>
            </select>
        </div>

        <div class="mb-5">
            <label for="" class="form-label">Kelas</label>
            <select class="form-select" aria-label="Default select example">
                <option value="1">Kelas A</option>
                <option value="1">Kelas B</option>
            </select>
        </div>

        <div class="mb-3 col-2">
            <label for="" class="form-label">Pertemuan</label>
            <input type="number" min="1" class="form-control" id="">
        </div>

        <div class="mb-3 col-4">
            <label for="" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="" value="<?php echo date('Y-m-d'); ?>">
        </div>

        <div class="mb-3 col-3">
            <label for="" class="form-label">Waktu Mulai</label>
            <input type="time" class="form-control" id="" value="<?php echo date("Y/m/d h:i:s a"); ?>">
        </div>

        <div class="mb-3 col-3">
            <label for="" class="form-label">Waktu Selesai</label>
            <input type="time" class="form-control" id="" value="<?php echo date("Y/m/d h:i:s a"); ?>">
        </div>

        <div class="mb-5 col-3">
            <label for="" class="form-label">Rangkuman</label>
            <textarea class="form-control" id="" rows="10"></textarea>
        </div>

        <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" value="" id="isAsisten">
            <label class="form-check-label" for="isAsisten">
                Dibantu Asisten
            </label>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Asisten</label>
            <select class="form-select" aria-label="Default select example" id="select-asisten" disabled>
                <option value="1">Asisten A</option>
                <option value="1">Asisten B</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="formFile" class="form-label">Upload Bukti Foto</label>
            <input class="form-control" type="file" id="formFile">
        </div>

        <div class="mb-3">
            <button class="btn btn-primary">Submit</button>
        </div>

    </div>
</div>
<script>
    $('#isAsisten').change((e) => {
        let state_select = $('#select-asisten').prop('disabled');
        $('#select-asisten').prop( "disabled", !state_select );
    });
</script>