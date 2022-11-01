<div class="wrapper">

    <?php include_once 'view/template/sidebar.php' ?>

    <div class="container">

        <table id="dataTable" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>ID Mata Kuliah</th>
                    <th>Nama</th>
                    <th>SKS</th>
                    <th>Program Studi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($dataMataKuliah as $item) {
                    echo "<tr>";
                    echo "<td>" . $item->getIdMataKuliah() . "</td>";
                    echo "<td>" . $item->getNama() . "</td>";
                    echo "<td>" . $item->getSks() . "</td>";
                    echo "<td>" . $item->getProgramStudi()->getNama() . "</td>";
                    echo "</tr>";
                }
                ?>

            </tbody>
        </table>

    </div>
</div>
