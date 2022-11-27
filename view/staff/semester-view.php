<div class="wrapper">

    <?php include_once 'view/template/sidebar.php' ?>

    <div class="container">
        <h2>Semester</h2>

        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3 col-4">
                <label class="form-label">Upload File</label>
                <input type="file" class="form-control" name="fileImport" accept=".xls, .xlsx">
            </div>
            <div class="mb-3 col-4">
                <input type="checkbox" name="rowTitle" id="rowTitle">
                <label for="rowTitle" class="form-label">First Row is Heading</label>
            </div>
            <input type="submit" class="btn btn-primary mb-5" name="btnImport" value="Import data">
        </form>

        <form method="post">

            <div class="mb-3 col-2">
                <label for="idSemester" class="form-label">ID Semester</label>
                <input type="number" class="form-control" id="idSemester" name="txtIdSemester">
            </div>

            <div class="mb-3 col-3">
                <label for="namaSemester" class="form-label">Nama Semester</label>
                <input type="text" class="form-control" id="namaSemester" name="txtNamaSemester">
            </div>

            <input type="submit" class="btn btn-primary mb-3" value="Add Semester" name="btnSubmit">

        </form>


        <table id="dataTable" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>ID Semester</th>
                    <th>Nama</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($dataSemester as $item) {
                    echo "<tr>";
                    echo "<td>" . $item->getIdSemester() . "</td>";
                    echo "<td>" . $item->getNama() . "</td>";
                    echo "</tr>";
                }
                ?>

            </tbody>
        </table>

    </div>
</div>