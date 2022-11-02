<div class="wrapper">
    
    <?php include_once 'view/template/sidebar.php' ?>

    <div class="container mt-4">

        <h1>Hallo <?= $_SESSION['web_user_full_name'] ?></h1>

        <h2>Jadwal Dosen</h2>

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
                foreach ($jadwalDosen as $item) {
                    echo "<tr>";
                    echo "<td>" . $item->getMataKuliah()->getIdMataKuliah() . "</td>";
                    echo "<td>" . $item->getMataKuliah()->getNama() . "</td>";
                    echo "<td>" . $item->getKelas() . "</td>";
                    echo "<td>" . $item->getTipeKelas() . "</td>";
                    echo "<td>" . $item->getRuangan()->getNama() . "</td>";
                    echo "<td>" . date('l', strtotime($item->getWaktuMulai())) . ', ' . date('H:i', strtotime($item->getWaktuMulai())) . ' - ' . date('H:i', strtotime($item->getWaktuSelesai())) . "</td>";
                    echo "<td>" . $item->getSemester()->getNama() . "</td>";
                    echo "<td><button class='btn btn-warning'>Detail</button></td>";
                    echo "</tr>";
                }
                ?>

            </tbody>
        </table>

    </div>
</div>