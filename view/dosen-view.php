<?php include_once 'view/template/sidebar.php' ?>

<div class="content-wrapper p-3">

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Jadwal Dosen</h3>

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
                            <option value="<?= $semester->getIdSemester() ?>" <?= $selectedSemester == $semester->getIdSemester() ? 'selected' : '' ?>><?= $semester->getNama() ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <button id="btnSubmit" class="btn btn-primary" type="submit" name="btnFilter">Filter</button>
                </div>
            </form>
            <table id="example1" class="table table-bordered table-striped" style="width:100%">
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
                    foreach ($jadwalDosen as $index => $item) {
                        echo "<tr>";
                        echo "<td>" . $item->getMataKuliah()->getIdMataKuliah() . "</td>";
                        echo "<td>" . $item->getMataKuliah()->getNama() . "</td>";
                        echo "<td>" . $item->getKelas() . "</td>";
                        echo "<td>" . $item->getTipeKelas() . "</td>";
                        echo "<td>" . $item->getRuangan()->getNama() . "</td>";
                        echo "<td>" . $item->getHari() . ', ' . date('H:i', strtotime($item->getWaktuMulai())) . ' - ' . date('H:i', strtotime($item->getWaktuSelesai())) . "</td>";
                        echo "<td>" . $item->getSemester()->getNama() . "</td>";
                        echo "<td><button class='btn btn-primary' data-toggle='modal' data-target='#jadwal-$index'><i class='fa-solid fa-circle-info' style='color:white'></i></button></td>";
                        echo "</tr>";
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>


</div>



<?php foreach ($jadwalDosen as $index => $jadwal) {

?>
    <div class="modal fade" id="jadwal-<?= $index ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">

            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5"><?= $jadwal ?></h1>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php
                    $tipeKelas = explode("-", $jadwal)[3];
                    if (trim($tipeKelas) == "Teori") {
                        echo "Total pertemuan: " . count($jadwal->array_berita_acara) . " / 16";
                    } else {
                        echo "Total pertemuan: " . count($jadwal->array_berita_acara) . " / 14";
                    }

                    ?>
                    <table id="example2" class="table table-bordered table-striped dataTable" style="width:100%">
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
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            foreach ($jadwal->array_berita_acara as $index => $item) {

                                echo "<tr>";
                                echo "<td>" . $item->getPertemuan() . "</td>";
                                echo "<td>" . date('H:i', strtotime($item->getWaktuMulai())) . "</td>";
                                echo "<td>" . date('H:i', strtotime($item->getWaktuSelesai())) . "</td>";
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
                                echo '<td><button class="btn btn-warning" data-dismiss="modal" data-toggle="modal" data-target="#beritaAcara-' . $item->getIdBeritaAcara() . '"><i class="fa-solid fa-pen-to-square"></i></button>
                        <button onclick="deleteBeritaAcara(\'' . $item->getIdBeritaAcara() . '\')" class="btn btn-danger" data-dismiss="modal" data-toggle="modal" data-target="#deleteBeritaAcaraModal"><i class="fa-solid fa-trash"></i></button>
                        </td>';

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

    <?php foreach ($jadwal->array_berita_acara as $index => $item) {
    ?>

        <div class="modal fade" id="beritaAcara-<?= $item->getIdBeritaAcara() ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">

                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Edit berita acara</h1>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <form id="form" method="post" enctype="multipart/form-data">

                            <input type="hidden" name="idBeritaAcara" value="<?= $item->getIdBeritaAcara() ?>">
                            <div class="form-group">
                                <label for="" class="form-label">Jadwal</label>
                                <select class="form-control custom-select" name="jadwal" required>
                                    <?php foreach ($jadwalDosenAll as $jadwal) { ?>
                                        <option value="<?= $jadwal->getMataKuliah()->getIdMataKuliah() . '-' . $jadwal->getKelas() . '-' . $jadwal->getTipeKelas() ?>"><?= $jadwal ?></option>
                                    <?php } ?>
                                </select>
                            </div>


                            <div class="form-group col-2">
                                <label for="" class="form-label">Pertemuan</label>
                                <input type="number" min="1" max="16" class="form-control" id="" name="pertemuan" value="<?= $item->getPertemuan() ?>" required>

                            </div>

                            <div class="form-group col-3">
                                <label for="" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" id="" value="<?php

                                                                                        echo date_format(date_create($item->getWaktuMulai()), 'Y-m-d'); ?>" name="tanggal" required>
                            </div>

                            <div class="form-group col-3">
                                <label for="" class="form-label">Waktu Mulai</label>
                                <input type="time" class="form-control" id="" value="<?php
                                                                                        echo date('H:i', strtotime($item->getWaktuMulai())); ?>" name="waktu-mulai" required>

                            </div>

                            <div class="form-group col-3">
                                <label for="" class="form-label">Waktu Selesai</label>
                                <input type="time" class="form-control" id="" value="<?php echo date('H:i', strtotime($item->getWaktuSelesai())); ?>" name="waktu-selesai" required>
                            </div>

                            <div class="form-group col-2">
                                <label for="" class="form-label">Jumlah Mahasiswa</label>
                                <input type="number" min="1" class="form-control" id="" name="jumlah-mahasiswa" value="<?= $item->getJumlahMahasiswa() ?>" required>

                            </div>

                            <div class="form-group col-3">
                                <label for="" class="form-label">Rangkuman Materi</label>
                                <textarea class="form-control" id="" rows="10" name="pembahasan-materi" required><?= $item->getPembahasanMateri() ?></textarea>

                            </div>

                            <div class="form-group col-3">
                                <label for="" class="form-label">Catatan</label>
                                <textarea class="form-control" id="" rows="3" name="rangkuman" required><?= $item->getRangkuman() ?></textarea>

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

                                </select>

                            </div>

                            <div class="form-group col-3">
                                <label for="" class="form-label">Lama Asistensi</label>
                                <input type="number" min="0" class="form-control" disabled id="lama-asisten3" name="lama-asistensi3">

                            </div>

                            <div class="form-group">
                                <label for="formFile" class="form-label">Upload Bukti Foto</label>
                                <p>Jika tidak ada file yang dimasukkan, file sebelumnya yang akan digunakan.</p>
                                <input class="form-control" type="file" id="foto-presensi" name="foto-presensi" accept="image/png, image/jpeg, .pdf">
                            </div>

                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Update Berita Acara" name="btnUpdate">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    <?php } ?>
<?php } ?>

<div class="modal fade" id="deleteBeritaAcaraModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post">
            <div class=" modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Delete Berita Acara</h1>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span>Are you sure want to delete this data?</span>
                </div>
                <div class="modal-footer">
                    <button id="deleteConfirm" class="btn btn-primary" name="btnDelete">Delete Berita Acara</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>


<script>
    function deleteBeritaAcara(id) {
        $('#deleteConfirm').click(function() {
            window.location = "index.php?ahref=dosen&delcom=1&bid=" + id;
        })
    }
</script>