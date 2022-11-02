<div class="wrapper">

    <?php include_once 'view/template/sidebar.php' ?>

    <div class="container">

        <h2>Mata Kuliah</h2>

        <form method="post">

            <div class="mb-3 col-2">
                <label for="idMataKuliah" class="form-label">ID Mata Kuliah</label>
                <input type="text" class="form-control" id="idMataKuliah" name="txtIdMataKuliah">
            </div>

            <div class="mb-3 col-2">
                <label for="namaMataKuliah" class="form-label">Nama Mata Kuliah</label>
                <input type="text" class="form-control" id="namaMataKuliah" name="txtNamaMataKuliah">
            </div>

            <div class="mb-3 col-2">
                <label for="sks" class="form-label">SKS</label>
                <input type="number" min="1" max="4" class="form-control" id="sks" name="txtSKS">
            </div>

            <div class="mb-3 col-2">
                <label for="prodi" class="form-label">Program Studi</label>
                <select class="form-select" name="optProgramStudi">
                    <?php foreach ($dataProgramStudi as $programStudi) { ?>
                        <option value="<?= $programStudi->getIdProgramStudi() ?>"><?= $programStudi->getNama() ?></option>
                    <?php } ?>
                </select>
            </div>

            <input type="submit" class="btn btn-primary mb-3" value="Add Mata Kuliah" name="btnSubmit">

        </form>

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