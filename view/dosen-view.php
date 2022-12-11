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



<?php foreach ($jadwalDosen as $index => $jadwal) { ?>
    <div class="modal fade" id="jadwal-<?= $index ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5"><?= $jadwal ?></h1>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
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
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($jadwal->array_berita_acara as $index => $item) {
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>