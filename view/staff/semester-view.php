<?php include_once 'view/template/sidebar.php' ?>

<div class="content-wrapper p-3">
    <div class="card card-primary collapsed-card">
        <div class="card-header">
            <h3 class="card-title">Import data Semester</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="maximize" title="Full Screen">
                    <i class="fas fa-expand"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group col-4">
                    <label class="form-label">Upload File</label>
                    <input type="file" class="form-control" name="fileImport" accept=".xls, .xlsx">
                </div>
                <div class="form-group col-4">
                    <input type="checkbox" name="rowTitle" id="rowTitle">
                    <label for="rowTitle" class="form-label">First Row is Heading</label>
                </div>
                <input type="submit" class="btn btn-primary" name="btnImport" value="Import data">
            </form>
        </div>
    </div>

    <div class="card card-primary collapsed-card">
        <div class="card-header">
            <h3 class="card-title">Add Semester</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="maximize" title="Full Screen">
                    <i class="fas fa-expand"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <form method="post">

                <div class="form-group col-2">
                    <label for="idSemester" class="form-label">ID Semester</label>
                    <input type="number" class="form-control" id="idSemester" name="txtIdSemester">
                </div>

                <div class="form-group col-3">
                    <label for="namaSemester" class="form-label">Nama Semester</label>
                    <input type="text" class="form-control" id="namaSemester" name="txtNamaSemester">
                </div>

                <input type="submit" class="btn btn-primary" value="Add Semester" name="btnSubmit">

            </form>
        </div>
    </div>

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">List Semester</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="maximize" title="Full Screen">
                    <i class="fas fa-expand"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            <table id="example1" class="table table-striped" style="width:100%">
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
                        echo "<td><button class='btn btn-warning' data-toggle='modal' data-target='#semester-$index'><i class='fa-solid fa-pen-to-square'></i></button>";

                        if ($_SESSION['semester_aktif'] == $item->getIdSemester()) {
                            echo "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='This semester is in used. Cannot delete'>
                        <button disabled class='btn btn-danger'><i class='fa-solid fa-trash'></i></button>
                        </span>";
                        } else {
                            echo '<button onclick="deleteSemester(\'' . $item->getIdSemester() . '\')" class="btn btn-danger" data-toggle="modal" data-target="#deleteSemesterModal"><i class="fa-solid fa-trash"></i></button>';
                        }
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>


</div>

<?php foreach ($dataSemester as $index => $semester) { ?>
    <div class="modal fade" id="semester-<?= $index ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post">
                <div class=" modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Edit Semester</h1>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="idSemester" class="form-label">ID Semester</label>
                            <input type="number" class="form-control" id="idSemester" name="uptIdSemester" value="<?php echo $semester->getIdSemester() ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="namaSemester" class="form-label">Nama Semester</label>
                            <input type="text" class="form-control" id="namaSemester" name="uptNamaSemester" value="<?php echo $semester->getNama() ?>">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Update Semester" name="btnUpdate">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php } ?>

<div class="modal fade" id="deleteSemesterModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post">
            <div class=" modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Delete Semester</h1>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span>Are you sure want to delete this data?</span>
                </div>
                <div class="modal-footer">
                    <button id="deleteConfirm" class="btn btn-primary" name="btnDelete">Delete Semester</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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