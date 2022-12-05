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
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($dataSemester as $index => $item) {
                    echo "<tr>";
                    echo "<td>" . $item->getIdSemester() . "</td>";
                    echo "<td>" . $item->getNama() . "</td>";
                    echo "<td><button class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#semester-$index'><i class='fa-solid fa-pen-to-square'></i></button>";

                    if ($_SESSION['semester_aktif'] == $item->getIdSemester()) {
                        echo "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='This semester is in used. Cannot delete'>
                        <button disabled class='btn btn-danger'><i class='fa-solid fa-trash'></i></button>
                        </span>";
                    } else {
                        echo '<button onclick="deleteSemester(\'' . $item->getIdSemester() . '\')" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteSemesterModal"><i class="fa-solid fa-trash"></i></button>';
                    }
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

    </div>
</div>

<?php foreach ($dataSemester as $index => $semester) { ?>
    <div class="modal fade" id="semester-<?= $index ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <form method="post">
                <div class=" modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Edit Semester</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="idSemester" class="form-label">ID Semester</label>
                            <input type="number" class="form-control" id="idSemester" name="uptIdSemester" value="<?php echo $semester->getIdSemester() ?>" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="namaSemester" class="form-label">Nama Semester</label>
                            <input type="text" class="form-control" id="namaSemester" name="uptNamaSemester" value="<?php echo $semester->getNama() ?>">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Update Semester" name="btnUpdate">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php } ?>

<div class="modal fade" id="deleteSemesterModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <form method="post">
            <div class=" modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Delete Semester</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span>Are you sure want to delete this data?</span>
                </div>
                <div class="modal-footer">
                    <button id="deleteConfirm" class="btn btn-primary" name="btnDelete">Delete Semester</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function deleteSemester(id) {
        $('#deleteConfirm').click(function() {
            console.log(id);
            window.location = "index.php?ahref=staff-semester&delcom=1&sid=" + id;
        })
    }
</script>