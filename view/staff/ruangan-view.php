<div class="wrapper">
    
    <?php include_once 'view/template/sidebar.php' ?>

    <div class="container">

    <table id="dataTable" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>ID Ruangan</th>
                    <th>Nama</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($dataRuangan as $item) {
                    echo "<tr>";
                    echo "<td>" . $item->getIdRuangan() . "</td>";
                    echo "<td>" . $item->getNama() . "</td>";
                    echo "</tr>";
                }
                ?>

            </tbody>
        </table>

        
    </div>
</div>