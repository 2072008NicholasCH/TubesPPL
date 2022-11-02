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
<html lang="en">

<head>
  <title>Tubes PPL</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

  <!-- Bootstrap CSS CDN -->
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous"> -->

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <!-- Font Awesome JS -->
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>


  <style>
    .wrapper {
      display: flex;
      align-items: stretch;
    }

    #sidebar {
      min-width: 250px;
      max-width: 250px;
      min-height: 100vh;
    }

    #sidebar.active {
      margin-left: -250px;
    }

    a[data-toggle="collapse"] {
      position: relative;
    }

    .dropdown-toggle::after {
      display: block;
      position: absolute;
      top: 50%;
      right: 20px;
      transform: translateY(-50%);
    }

    @media (max-width: 768px) {
      #sidebar {
        margin-left: -250px;
      }

      #sidebar.active {
        margin-left: 0;
      }
    }

    @import "https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700";


    body {
      font-family: 'Poppins', sans-serif;
      background: #fafafa;
    }

    p {
      font-family: 'Poppins', sans-serif;
      font-size: 1.1em;
      font-weight: 300;
      line-height: 1.7em;
      color: #999;
    }

    a,
    a:hover,
    a:focus {
      color: inherit;
      text-decoration: none;
      transition: all 0.3s;
    }

    #sidebar {
      /* don't forget to add all the previously mentioned styles here too */
      background: #7386D5;
      color: #fff;
      transition: all 0.3s;
    }

    #sidebar .sidebar-header {
      padding: 20px;
      background: #6d7fcc;
    }

    #sidebar ul.components {
      padding: 20px 0;
      border-bottom: 1px solid #47748b;
    }

    #sidebar ul p {
      color: #fff;
      padding: 10px;
    }

    #sidebar ul li a {
      padding: 10px;
      font-size: 1.1em;
      display: block;
    }

    #sidebar ul li a:hover {
      color: #7386D5;
      background: #fff;
    }

    #sidebar ul li.active>a,
    a[aria-expanded="true"] {
      color: #fff;
      background: #6d7fcc;
    }

    ul ul a {
      font-size: 0.9em !important;
      padding-left: 30px !important;
      background: #6d7fcc;
    }
  </style>
</head>

<body>






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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.css" />

  <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.js"></script>

  <script>
    $(document).ready(function() {
      $('#dataTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    } );
      $('.dataTable').DataTable();
    });
  </script>

</body>



</html>