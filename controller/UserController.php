<?php

class UserController
{
    private $userDao;

    public function __construct()
    {
        $this->userDao = new UserDao();
    }

    public function index()
    {

        $loginSubmitted = filter_input(INPUT_POST, 'btnLogin');
        if (isset($loginSubmitted)) {
            $username = filter_input(INPUT_POST, 'txtUsername');
            $password = filter_input(INPUT_POST, 'txtPassword');

            $result = $this->userDao->read($username, $password);
            if ($result == false) {
                $message = '<i class="fa-solid fa-circle-xmark"></i> Invalid username or password';
                echo "<script> bootoast.toast({
                    message: '" . $message . "',
                    type: 'danger',
                    position: 'rightTop'
                }); </script>";
            } else if ($result->getIdUser() == $username) {
                $_SESSION['user'] = $result;
                $_SESSION['web_user_full_name'] = $result->getNama();
                $_SESSION['user_role_id'] = $result->role_idRole;
                $_SESSION['semester_aktif'] = 1;
                header('location:index.php');
            } else {
                $message = '<i class="fa-solid fa-circle-xmark"></i> Invalid username or password';
                echo "<script> bootoast.toast({
                    message: '" . $message . "',
                    type: 'danger',
                    position: 'rightTop'
                }); </script>";
            }
        }
        include_once 'view/login-view.php';
    }

    public function logout() {
        session_unset();
        session_destroy();
        header('location:index.php');
    }
}

?>