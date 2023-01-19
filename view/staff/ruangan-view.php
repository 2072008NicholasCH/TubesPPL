<?php include_once 'view/template/sidebar.php' ?>

<div class="content-wrapper p-3">
    <div class="card card-primary collapsed-card">

        <div class="card-header">
            <h3 class="card-title">Import data Ruangan</h3>

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
            <a class="btn btn-success mb-4" href="uploads/templates/template_ruangan.xlsx"><i class="fa-solid fa-file-arrow-down"></i> Download Template</a>
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group col-4">
                    <label class="form-label">Upload File</label>
                    <input type="file" class="form-control" name="fileImport" accept=".xls, .xlsx">
                </div>
                <div class="form-group col-4">
                    <input type="checkbox" name="rowTitle" id="rowTitle" checked>
                    <label for="rowTitle" class="form-label">First Row is Heading (Using Template)</label>
                </div>
                <input type="submit" class="btn btn-primary" name="btnImport" value="Import data">
            </form>
        </div>
    </div>

    <div class="card card-primary collapsed-card">
        <div class="card-header">
            <h3 class="card-title">Add Ruangan</h3>

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
                    <label for="idRuangan" class="form-label">ID Ruangan</label>
                    <input type="text" class="form-control" id="idRuangan" name="txtIdRuangan">
                </div>

                <div class="form-group col-3">
                    <label for="namaRuangan" class="form-label">Nama Ruangan</label>
                    <input type="text" class="form-control" id="namaRuangan" name="txtNamaRuangan">
                </div>

                <input type="submit" class="btn btn-primary" value="Add Ruangan" name="btnSubmit">

            </form>
        </div>
    </div>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">List Ruangan</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="maximize" title="Full Screen">
                    <i class="fas fa-expand"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <table id="example1" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>ID Ruangan</th>
                        <th>Nama</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($dataRuangan as $item) {
                        echo "<tr>";
                        echo "<td>" . $item->getIdRuangan() . "</td>";
                        echo "<td>" . $item->getNama() . "</td>";
                        echo '<td><button class="btn btn-warning" data-toggle="modal" data-target="#dosen-' . $item->getIdRuangan() . '"><i class="fa-solid fa-pen-to-square"></i></button>
                        <button onclick="deleteRuangan(\'' . $item->getIdRuangan() . '\')" class="btn btn-danger" data-toggle="modal" data-target="#deleteRuanganModal"><i class="fa-solid fa-trash"></i></button>
                        </td>';
                        echo "</tr>";
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

<?php foreach ($dataRuangan as $index => $ruangan) { ?>
    <div class="modal fade" id="dosen-<?= $ruangan->getIdRuangan() ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post">
                <div class=" modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Edit ruangan</h1>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="idRuangan" class="form-label">ID Ruangan</label>
                            <input type="text" class="form-control" id="idRuangan" name="updIdRuangan" value="<?php echo $ruangan->getIdRuangan() ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="namaRuangan" class="form-label">Nama Ruangan</label>
                            <input type="text" class="form-control" id="namaRuangan" name="updNamaRuangan" value="<?php echo $ruangan->getNama() ?>">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Update Ruangan" name="btnUpdate">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php } ?>

<div class="modal fade" id="deleteRuanganModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post">
            <div class=" modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Delete Ruangan</h1>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span>Are you sure want to delete this data?</span>
                </div>
                <div class="modal-footer">
                    <button id="deleteConfirm" class="btn btn-primary" name="btnDelete">Delete Ruangan</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function deleteRuangan(id) {
        $('#deleteConfirm').click(function() {
            window.location = "index.php?ahref=staff-ruangan&delcom=1&rid=" + id;
        })
    }
</script>