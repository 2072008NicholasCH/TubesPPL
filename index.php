<!DOCTYPE html>
<html lang="en">

<head>
  <title>Sidebar 04</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>

  <?php
  $menu = filter_input(type: INPUT_GET, var_name: 'ahref');

  switch ($menu) {
    case 'login':
      include_once 'view/login-view.php';
      break;
    case 'home':
      include_once 'view/home-view.php';
      break;
    case 'about':
      include_once 'view/about-view.php';
      break;
    default:
      include_once 'view/home-view.php';
  }
  ?>
</body>

</html>