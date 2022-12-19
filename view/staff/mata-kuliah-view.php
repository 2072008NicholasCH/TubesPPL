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
</div>
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