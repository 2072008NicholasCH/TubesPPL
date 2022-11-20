<div class="wrapper">

    <?php include_once 'view/template/sidebar.php' ?>

    <div class="container">
        <h2>Ruangan</h2>

        <form method="post">

            <div class="mb-3 col-2">
                <label for="idRuangan" class="form-label">ID Ruangan</label>
               <input type="text" class="form-control" id="idRuangan" name="txtIdRuangan">
            </div>

            <div class="mb-3 col-3">
                <label for="namaRuangan" class="form-label">Nama Ruangan</label>
                <input type="text" class="form-control" id="namaRuangan" name="txtNamaRuangan">
            </div>

            <input type="submit" class="btn btn-primary mb-3" value="Add Ruangan" name="btnSubmit">

        </form>

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