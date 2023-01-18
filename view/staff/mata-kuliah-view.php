<?php include_once 'view/template/sidebar.php' ?>

<div class="content-wrapper p-3">

    <div class="card card-primary collapsed-card">
        <div class="card-header">
            <h3 class="card-title">Import data Mata Kuliah</h3>

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
            <a class="btn btn-success mb-4" href="uploads/templates/template_mataKuliah.xlsx"><i class="fa-solid fa-file-arrow-down"></i> Download Template</a>
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group col-4">
                    <label for="idMataKuliah" class="form-label">Upload File</label>
                    <input type="file" class="form-control" id="idMataKuliah" name="fileImport" accept=".xls, .xlsx">
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
            <h3 class="card-title">Add Mata Kuliah</h3>

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
                    <label for="idMataKuliah" class="form-label">ID Mata Kuliah</label>
                    <input type="text" class="form-control" id="idMataKuliah" name="txtIdMataKuliah">
                </div>

                <div class="form-group col-2">
                    <label for="namaMataKuliah" class="form-label">Nama Mata Kuliah</label>
                    <input type="text" class="form-control" id="namaMataKuliah" name="txtNamaMataKuliah">
                </div>

                <div class="form-group col-2">
                    <label for="sks" class="form-label">SKS</label>
                    <input type="number" min="1" max="4" class="form-control" id="sks" name="txtSKS">
                </div>

                <div class="form-group col-2">
                    <label for="prodi" class="form-label">Program Studi</label>
                    <select class="form-select" name="optProgramStudi">
                        <?php foreach ($dataProgramStudi as $programStudi) { ?>
                            <option value="<?= $programStudi->getIdProgramStudi() ?>"><?= $programStudi->getNama() ?></option>
                        <?php } ?>
                    </select>
                </div>

                <input type="submit" class="btn btn-primary" value="Add Mata Kuliah" name="btnSubmit">

            </form>
        </div>
    </div>

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">
                List Mata Kuliah
            </h3>

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
                        <th>ID Mata Kuliah</th>
                        <th>Nama</th>
                        <th>SKS</th>
                        <th>Program Studi</th>
                        <th>Action</th>
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
                        echo '<td><button class="btn btn-warning" data-toggle="modal" data-target="#mataKuliah-' . $item->getIdMataKuliah() . '"><i class="fa-solid fa-pen-to-square"></i></button>
                        </td>';
                        echo "</tr>";
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

<?php foreach ($dataMataKuliah as $index => $mataKuliah) { ?>
    <div class="modal fade" id="mataKuliah-<?= $mataKuliah->getIdMataKuliah() ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post">
                <div class=" modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Edit mata kuliah</h1>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="idMataKuliah" class="form-label">ID Mata Kuliah</label>
                            <input type="text" class="form-control" id="idMataKuliah" name="updIdMataKuliah" value="<?php echo $mataKuliah->getIdMataKuliah() ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="namaMataKuliah" class="form-label">Nama Mata Kuliah</label>
                            <input type="text" class="form-control" id="namaMataKuliah" name="updNamaMataKuliah" value="<?php echo $mataKuliah->getNama() ?>">
                        </div>

                        <div class="form-group">
                            <label for="sksMataKuliah" class="form-label">SKS</label>
                            <input type="text" class="form-control" id="sksMataKuliah" name="updSksMataKuliah" value="<?php echo $mataKuliah->getSks() ?>">
                        </div>

                        <div class="form-group">
                            <label for="prodiMataKuliah" class="form-label">Program Studi</label>
                            <select class="form-select" name="updProdi">
                                <?php foreach ($dataProgramStudi as $programStudi) {
                                    if ($programStudi->getIdProgramStudi() == $mataKuliah->getProgramStudi()->getIdProgramStudi()) {
                                ?>
                                        <option value="<?= $programStudi->getIdProgramStudi() ?>" selected><?= $programStudi->getNama() ?></option>

                                    <?php
                                    } else {
                                    ?>
                                        <option value="<?= $programStudi->getIdProgramStudi() ?>"><?= $programStudi->getNama() ?></option>
                                <?php
                                    }
                                } ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Update Mata Kuliah" name="btnUpdate">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php } ?>

<script>
    $(function() {
        $('#form').validate({
            rules: {


            },
            messages: {


            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });

    });
</script>