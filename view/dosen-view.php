<div class="wrapper">

    <?php include_once 'view/template/sidebar.php' ?>

    <div class="container mt-4">

        <h1>Hallo <?= $_SESSION['web_user_full_name'] ?></h1>

        <h2 class="mt-5">Jadwal Dosen</h2>

        <table id="dataTable" class="table table-striped" style="width:100%">
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
                    echo "<td><button class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#jadwal-$index'>Detail</button></td>";
                    echo "</tr>";
                }
                ?>

            </tbody>
        </table>

    </div>
</div>

<?php foreach ($jadwalDosen as $index => $jadwal) { ?>
    <div class="modal fade" id="jadwal-<?= $index ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5"><?= $jadwal ?></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
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
                            foreach ($jadwal->array_berita_acara as $index => $item) {
                                echo "<tr>";
                                echo "<td>" . $item->getPertemuan() . "</td>";
                                echo "<td>" . date('h:i', strtotime($item->getWaktuMulai())) . "</td>";
                                echo "<td>" . date('h:i', strtotime($item->getWaktuSelesai())) . "</td>";
                                echo "<td>" . $item->getPembahasanMateri() . "</td>";
                                echo "<td>" . $item->getRangkuman() . "</td>";
                                echo "<td>" . ($item->getJumlahMahasiswa() ? $item->getJumlahMahasiswa() : 0) . "</td>";
                                echo "<td><img width='100px' src='" . $item->getFotoPresensi() . "'></td>";
                                echo "<td>" . $item->getTglBeritaAcara() . "</td>";
                                echo "</tr>";
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>