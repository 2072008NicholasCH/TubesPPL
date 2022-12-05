<div class="wrapper">

    <?php include_once 'view/template/sidebar.php' ?>

    <div class="container">
        <h2>Berita Acara</h2>

        <div class="mb-3">
            <label for="" class="form-label">Nama Dosen</label>
            <select class="form-select" name="dosen" id="optDosen" required>
                <?php foreach ($dataDosen as $dosen) { ?>
                    <option value="<?= $dosen->getIdUser() ?>"><?= $dosen ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Jadwal</label>
            <select class="form-select" name="jadwal" id="optJadwal" required>
                
            </select>
        </div>


        <table id="dataTable" class="table table-striped dataTable" style="width:100%">
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
                <?php
                foreach ($dataBeritaAcara as $index => $item) {
                    echo "<tr>";
                    echo "<td>" . $item->getPertemuan() . "</td>";
                    echo "<td>" . date('h:i', strtotime($item->getWaktuMulai())) . "</td>";
                    echo "<td>" . date('h:i', strtotime($item->getWaktuSelesai())) . "</td>";
                    echo "<td>" . $item->getPembahasanMateri() . "</td>";
                    echo "<td>" . $item->getRangkuman() . "</td>";
                    echo "<td>" . ($item->getJumlahMahasiswa() ? $item->getJumlahMahasiswa() : 0) . "</td>";
                    if (substr($item->getFotoPresensi(), -3) == 'pdf') {
                        echo "<td><form method='post' action='view/pdf-view.php' target='_blank'>";
                        echo "<input type='hidden' value='" . $item->getFotoPresensi() . "' name='url'>";
                        echo "<button class='btn btn-success' type='submit'>Show</button>";
                        echo "</form></td>";
                    } else {
                        echo "<td><img width='100px' src='" . $item->getFotoPresensi() . "'></td>";
                    }
                    echo "<td>" . $item->getTglBeritaAcara() . "</td>";
                    echo "</tr>";
                }
                ?>

            </tbody>
        </table>

    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
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
                for (var i in response) {
                    $output.append("<option value='" + response[i].mataKuliah.idMataKuliah + "-" + response[i].kelas + "-" + response[i].tipe_kelas + "'>" + response[i].mataKuliah.idMataKuliah + " - " + response[i].mataKuliah.nama + " - " + response[i].kelas + " - " + response[i].tipe_kelas + "</option>");
                }
            }
        })

    });

    $("#optJadwal").change(function() {
        var selectJadwal = $('#optJadwal :selected').val();

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
                var table = $('#dataTable').DataTable();
                table.clear();
                table.destroy();
                $('#dataTable').DataTable();
                var $output = $('#dataTable tbody').html('');
                for (var i in response) {
                    var waktu_mulai = new Date(response[i].waktu_mulai);
                    var waktu_selesai = new Date(response[i].waktu_selesai);

                    var foto_presensi = response[i].foto_presensi;

                    $output.append('<tr>');
                    $output.append('<td>' + response[i].pertemuan + '</td>');
                    $output.append('<td>' + waktu_mulai.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'}) + '</td>');
                    $output.append('<td>' + waktu_selesai.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'}) + '</td>');
                    $output.append('<td>' + response[i].pembahasan_materi + '</td>');
                    $output.append('<td>' + response[i].rangkuman + '</td>');
                    $output.append('<td>' + response[i].jumlah_mahasiswa + '</td>');
                    if (foto_presensi != null && foto_presensi.substr(-3, 3) == "pdf") {
                        $output.append("<td><form method='post' action='view/pdf-view.php' target='_blank'>");
                        $output.append("<input type='hidden' value='" + response[i].foto_presensi + "' name='url'>");
                        $output.append("<button class='btn btn-success' type='submit'>Show</button>");
                        $output.append("</form></td>");
                    } else {
                        $output.append("<td><img width='100px' src='" + response[i].foto_presensi + "'></td>");
                    }
                    $output.append('<td>' + response[i].tgl_berita_acara);
                    $output.append('</tr>');
                }
            }
        })

    });
</script>