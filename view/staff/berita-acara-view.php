<?php include_once 'view/template/sidebar.php' ?>

<div class="content-wrapper p-3">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Berita Acara</h3>

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
            <div class="form-group">
                <label for="" class="form-label">Semester</label>
                <select class="form-select" name="semester" id="optSemester">
                    <option selected disabled>Select Semester</option>
                    <?php foreach ($dataSemester as $semester) { ?>
                        <option value="<?= $semester->getIdSemester() ?>"><?= $semester->getNama() ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label for="" class="form-label">Nama Dosen</label>
                <select class="form-select" name="dosen" id="optDosen" disabled>
                    <option selected disabled>Select Dosen</option>
                    <?php foreach ($dataDosen as $dosen) { ?>
                        <option value="<?= $dosen->getIdUser() ?>"><?= $dosen ?></option>
                    <?php } ?>
                </select>
            </div>


            <div class="form-group">
                <label for="" class="form-label">Jadwal</label>
                <select class="form-select" name="jadwal" id="optJadwal" disabled>

                </select>
            </div>


            <table id="example1" class="table table-striped dataTable" style="width:100%">
                <thead>
                    <tr>
                        <th>Pertemuan Ke</th>
                        <th>Waktu Mulai</th>
                        <th>Waktu Selesai</th>
                        <th>Pembahasan Materi</th>
                        <th>Catatan</th>
                        <th>Jumlah Mahasiswa</th>
                        <th>Foto Presensi</th>
                        <th>Waktu Submit</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>



</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
    $("#optSemester").change(function() {
        $('#optDosen').attr('disabled', false);
    });

    var selectDosen = $('#optDosen :selected').val();
    $("#optDosen").change(function() {
        selectDosen = $('#optDosen :selected').val();

        var $output = $('#optJadwal').html('');

        $.ajax({
            url: 'controller/AjaxController.php',
            type: 'post',
            data: {
                method: "fetchJadwalDosen",
                id: selectDosen
            },
            success: function(responsedata) {
                var response = $.parseJSON(responsedata);
                $('#optJadwal').attr('disabled', false);
                $output.append("<option selected disabled>Select Jadwal</option>");
                for (var i in response) {
                    $output.append("<option value='" + response[i].mataKuliah.idMataKuliah + "-" + response[i].kelas + "-" + response[i].tipe_kelas + "'>" + response[i].mataKuliah.idMataKuliah + " - " + response[i].mataKuliah.nama + " - " + response[i].kelas + " - " + response[i].tipe_kelas + "</option>");
                }
            }
        })

    });

    $("#optJadwal").change(function() {
        var selectJadwal = $('#optJadwal :selected').val();

        var table = $('#example1').DataTable();
        table.clear().draw();

        $.ajax({
            url: 'controller/AjaxController.php',
            type: 'post',
            data: {
                method: "fetchBeritaAcara",
                id: selectJadwal,
                dosen: selectDosen,
                semester: <?= $_SESSION['semester_aktif'] ?>,
            },
            success: function(responsedata) {
                var response = $.parseJSON(responsedata);

                for (var i in response) {
                    var waktu_mulai = new Date(response[i].waktu_mulai);
                    var waktu_selesai = new Date(response[i].waktu_selesai);

                    const date = new Date(response[i].tgl_berita_acara);
                    const yyyy = date.getFullYear();
                    const mm = date.toLocaleString('default', {
                        month: 'long'
                    }).substr(0, 3);
                    let dd = date.getDate();

                    let hh = date.getHours();

                    if (dd < 10) dd = '0' + dd;
                    if (hh < 10) hh = '0' + hh;

                    const formattedDate = dd + ' ' + mm + ' ' + yyyy + ', ' + hh + ':' + date.getMinutes() + ':' + date.getSeconds();

                    var foto_presensi = response[i].foto_presensi;

                    if (foto_presensi != null && foto_presensi.substr(-3, 3) == "pdf") {
                        foto_presensi = "<td><form method='post' action='view/pdf-view.php' target='_blank'>";
                        foto_presensi += "<input type='hidden' value='" + response[i].foto_presensi + "' name='url'>";
                        foto_presensi += "<button class='btn btn-success' type='submit'>Show</button>";
                        foto_presensi += "</form></td>";
                    } else {
                        foto_presensi = "<td><img width='100px' src='" + response[i].foto_presensi + "'></td>";
                    }

                    table.row.add([
                        response[i].pertemuan,
                        waktu_mulai.toLocaleTimeString([], {
                            hour: '2-digit',
                            minute: '2-digit'
                        }),

                        waktu_selesai.toLocaleTimeString([], {
                            hour: '2-digit',
                            minute: '2-digit'
                        }),
                        response[i].pembahasan_materi,
                        response[i].rangkuman,
                        response[i].jumlah_mahasiswa,
                        foto_presensi,
                        formattedDate
                    ]).draw(false);


                }
            }
        })

    });
</script>