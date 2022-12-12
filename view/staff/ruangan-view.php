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








</div>