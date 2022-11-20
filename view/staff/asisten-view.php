<div class="wrapper">

    <?php include_once 'view/template/sidebar.php' ?>

    <div class="container">
        <h2>Asisten</h2>

        <form method="post">

            <div class="mb-3 col-2">
                <label for="idSemester" class="form-label">NRP</label>
                <input type="number" min="0" class="form-control" id="idAsisten" name="txtIdAsisten">
            </div>

            <div class="mb-3 col-3">
                <label for="namaAsisten" class="form-label">Nama Asisten</label>
                <input type="text" class="form-control" id="namaAsisten" name="txtNamaAsisten">
            </div>
            
            <div class="mb-3 col-3">
                <label for="noTelpAsisten" class="form-label">Nomor Telepon</label>
                <input type="text" class="form-control" id="noTelpAsisten" name="txtNoTelpAsisten">
            </div>

            <input type="submit" class="btn btn-primary mb-3" value="Add Asisten" name="btnSubmit">

        </form>


        <table id="dataTable" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>NRP</th>
                    <th>Nama</th>
                    <th>No Telp</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($asisten as $item) {
                    echo "<tr>";
                    echo "<td>" . $item->getidAsistenDosen() . "</td>";
                    echo "<td>" . $item->getNama() . "</td>";
                    echo "<td>" . $item->getNoTelp() . "</td>";
                    echo "</tr>";
                }
                ?>

            </tbody>
        </table>

    </div>
</div>