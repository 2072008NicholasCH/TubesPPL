<?php


include_once 'utility/Connection.php';
include_once 'controller/UserController.php';
include_once 'controller/DosenController.php';
include_once 'controller/StaffController.php';
include_once 'dao/AsistenDao.php';
include_once 'dao/UserDao.php';
include_once 'dao/JadwalDao.php';
include_once 'dao/BeritaAcaraDao.php';
include_once 'dao/MataKuliahDao.php';
include_once 'dao/RuanganDao.php';
include_once 'dao/SemesterDao.php';
include_once 'dao/ProgramStudiDao.php';
include_once 'entity/Asisten.php';
include_once 'entity/BeritaAcara.php';
include_once 'entity/Jadwal.php';
include_once 'entity/MataKuliah.php';
include_once 'entity/ProgramStudi.php';
include_once 'entity/Role.php';
include_once 'entity/Ruangan.php';
include_once 'entity/Semester.php';
include_once 'entity/User.php';

session_start();

if (!isset($_SESSION['user'])) {
  $_SESSION['user'] = false;
}
?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Starter</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/3829a87171.js" crossorigin="anonymous"></script>

  <!-- Bootstrap CSS CDN -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>

  <!-- Toastr -->
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <style>
    .col-2,
    .col-3 {
      padding-left: 0;
    }
  </style>
</head>

<body class="hold-transition sidebar-mini">

  <div class="wrapper">
    <?php
    $menu = filter_input(INPUT_GET, 'ahref');

    switch ($menu) {
      case 'login':
        $userController = new UserController();
        $userController->index();
        break;
      case 'home':
        include_once 'view/home-view.php';
        break;
      case 'dosen':
        $dosenController = new DosenController();
        $dosenController->index();
        break;
      case 'dosen-berita-acara':
        $dosenController = new DosenController();
        $dosenController->beritaAcara();
        break;
      case 'staff':
        $staffController = new StaffController();
        $staffController->index();
        break;
      case 'staff-berita-acara':
        $staffController = new StaffController();
        $staffController->beritaAcara();
        break;
      case 'staff-jadwal':
        $staffController = new StaffController();
        $staffController->jadwal();
        break;
      case 'staff-mata-kuliah':
        $staffController = new StaffController();
        $staffController->mataKuliah();
        break;
      case 'staff-ruangan':
        $staffController = new StaffController();
        $staffController->ruangan();
        break;
      case 'staff-semester':
        $staffController = new StaffController();
        $staffController->semester();
        break;
      case 'staff-asisten':
        $staffController = new StaffController();
        $staffController->asisten();
        break;
      case 'staff-dosen':
        $staffController = new StaffController();
        $staffController->dosen();
        break;
      case 'about':
        include_once 'view/about-view.php';
        break;
      case 'input':
        include_once 'view/form-view.php';
        break;
      case 'logout':
        $userController = new UserController();
        $userController->logout();
      default:
        include_once 'view/home-view.php';
    }
    ?>
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- REQUIRED SCRIPTS -->

    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- jquery-validation -->
    <script src="plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="plugins/jquery-validation/additional-methods.min.js"></script>

    <!-- Toastr -->
    <script src="plugins/toastr/toastr.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>

    <!-- DataTables  & Plugins -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="plugins/jszip/jszip.min.js"></script>
    <script src="plugins/pdfmake/pdfmake.min.js"></script>
    <script src="plugins/pdfmake/vfs_fonts.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

    <!-- Page specific script -->
    <script>
      $(function() {
        $("#example1").DataTable({
          "responsive": true,
          "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        
        $('#example2').DataTable({
          "responsive": true,
          "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
      });
    </script>

    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- Default to the left -->
      <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>
  </div>
</body>

</html>