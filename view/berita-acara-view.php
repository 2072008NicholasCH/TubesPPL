<?php include_once 'view/template/sidebar.php' ?>

<div class="content-wrapper p-3">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Add Berita Acara</h3>

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
            <form id="form" method="post" enctype="multipart/form-data">
                <h5>Semester : <?= $semesterAktif->getNama() ?></h5>

                <div class="form-group">
                    <label for="" class="form-label">Jadwal</label>
                    <select class="form-control custom-select" name="jadwal" required>
                        <?php foreach ($jadwalDosen as $jadwal) { ?>
                            <option value="<?= $jadwal->getMataKuliah()->getIdMataKuliah() . '-' . $jadwal->getKelas() . '-' . $jadwal->getTipeKelas() ?>"><?= $jadwal ?></option>
                        <?php } ?>
                    </select>
                </div>


                <div class="form-group col-2">
                    <label for="" class="form-label">Pertemuan</label>
                    <input type="number" min="1" max="16" class="form-control" id="" name="pertemuan" required>

                </div>

                <div class="form-group col-3">
                    <label for="" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" id="" value="<?php echo date('Y-m-d'); ?>" name="tanggal" required>
                </div>

                <div class="form-group col-3">
                    <label for="" class="form-label">Waktu Mulai</label>
                    <input type="time" class="form-control" id="" value="<?php echo date("Y/m/d h:i:s a"); ?>" name="waktu-mulai" required>

                </div>

                <div class="form-group col-3">
                    <label for="" class="form-label">Waktu Selesai</label>
                    <input type="time" class="form-control" id="" value="<?php echo date("Y/m/d h:i:s a"); ?>" name="waktu-selesai" required>
                </div>

                <div class="form-group col-2">
                    <label for="" class="form-label">Jumlah Mahasiswa</label>
                    <input type="number" min="1" class="form-control" id="" name="jumlah-mahasiswa" required>
 
                </div>

                <div class="form-group col-3">
                    <label for="" class="form-label">Rangkuman Materi</label>
                    <textarea class="form-control" id="" rows="10" name="pembahasan-materi" required></textarea>

                </div>

                <div class="form-group col-3">
                    <label for="" class="form-label">Catatan</label>
                    <textarea class="form-control" id="" rows="3" name="rangkuman" required></textarea>

                </div>

                <h5 class="my-4">Asistensi</h5>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" value="true" id="isAsisten" name="isAsisten">
                    <label class="form-check-label" for="isAsisten">
                        Dibantu Asisten
                    </label>
                </div>

                <div class="form-group">
                    <label for="" class="form-label">Asisten</label>
                    <select class="form-control custom-select" aria-label="Default select example" id="select-asisten" disabled name="asisten">
                        <option value="" disabled selected>Select your option</option>
                        <?php foreach ($dataAsisten as $asisten) { ?>
                            <option value="<?= $asisten->getidAsistenDosen() ?>"><?= $asisten->getidAsistenDosen() . ' - ' . $asisten->getNama() ?></option>
                        <?php } ?>
                    </select>

                </div>

                <div class="form-group col-3">
                    <label for="" class="form-label">Lama Asistensi</label>
                    <input type="number" min="0" class="form-control" disabled id="lama-asisten" name="lama-asistensi">

                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" value="true" id="isAsisten2" name="isAsisten2">
                    <label class="form-check-label" for="isAsisten2">
                        Dibantu Asisten 2
                    </label>
                </div>

                <div class="form-group">
                    <label for="" class="form-label">Asisten 2</label>
                    <select class="form-select" aria-label="Default select example" id="select-asisten2" disabled name="asisten2">
                        <option value="" disabled selected>Select your option</option>
                        <?php foreach ($dataAsisten as $asisten) { ?>
                            <option value="<?= $asisten->getidAsistenDosen() ?>"><?= $asisten->getidAsistenDosen() . ' - ' . $asisten->getNama() ?></option>
                        <?php } ?>
                    </select>

                </div>

                <div class="form-group col-3">
                    <label for="" class="form-label">Lama Asistensi</label>
                    <input type="number" min="0" class="form-control" disabled id="lama-asisten2" name="lama-asistensi2">

                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" value="true" id="isAsisten3" name="isAsisten3">
                    <label class="form-check-label" for="isAsisten3">
                        Dibantu Asisten 3
                    </label>
                </div>

                <div class="form-group">
                    <label for="" class="form-label">Asisten 3</label>
                    <select class="form-select" aria-label="Default select example" id="select-asisten3" disabled name="asisten3">
                        <option value="" disabled selected>Select your option</option>
                        <?php foreach ($dataAsisten as $asisten) { ?>
                            <option value="<?= $asisten->getidAsistenDosen() ?>"><?= $asisten->getidAsistenDosen() . ' - ' . $asisten->getNama() ?></option>
                        <?php } ?>
                    </select>

                </div>

                <div class="form-group col-3">
                    <label for="" class="form-label">Lama Asistensi</label>
                    <input type="number" min="0" class="form-control" disabled id="lama-asisten3" name="lama-asistensi3">

                </div>

                <div class="form-group">
                    <label for="formFile" class="form-label">Upload Bukti Foto</label>
                    <input class="form-control" type="file" id="foto-presensi" name="foto-presensi" accept="image/png, image/jpeg, .pdf">
                </div>

                <div class="form-group">
                    <button class="btn btn-primary" type="submit" name="btnSubmit">Submit</button>
                </div>

            </form>
        </div>
    </div>

    <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
        <i class="fas fa-chevron-up"></i>
    </a>

</div>
<script>
    $(function() {
        $('#form').validate({
            rules: {
                pertemuan: {
                    required: true,
                    min: 1,
                    max: 16
                },
                password: {
                    required: true,
                    minlength: 5
                },
                terms: {
                    required: true
                },
            },
            messages: {
                pertemuan: {
                    required: "Please enter pertemuan",
                    min: "Please enter between 1-16",
                    max: "Please enter between 1-16",
                },
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
                },
                terms: "Please accept our terms"
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

    $('#isAsisten').change((e) => {
        let state_select = $('#select-asisten').prop('disabled');
        $('#isAsisten').val(state_select);
        $('#select-asisten').prop("disabled", !state_select);
        $('#select-asisten').prop("required", state_select);
        $('#lama-asisten').prop("disabled", !state_select);
        $('#lama-asisten').prop("required", state_select);
    });
    $('#isAsisten2').change((e) => {
        let state_select2 = $('#select-asisten2').prop('disabled');
        $('#isAsisten2').val(state_select2);
        $('#select-asisten2').prop("disabled", !state_select2);
        $('#select-asisten2').prop("required", state_select2);
        $('#lama-asisten2').prop("disabled", !state_select2);
        $('#lama-asisten2').prop("required", state_select2);
    });
    $('#isAsisten3').change((e) => {
        let state_select3 = $('#select-asisten3').prop('disabled');
        $('#isAsisten3').val(state_select3);
        $('#select-asisten3').prop("disabled", !state_select3);
        $('#select-asisten3').prop("required", state_select3);
        $('#lama-asisten3').prop("disabled", !state_select3);
        $('#lama-asisten3').prop("required", state_select3);
    });
</script>