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
                echo '<div class="bg-danger">Invalid Username or Password</div>';
            } else if ($result->getIdUser() == $username) {
                $_SESSION['user'] = $result;
                $_SESSION['web_user_full_name'] = $result->getNama();
                $_SESSION['user_role_id'] = $result->role_idRole;
                header('location:index.php');
            } else {
                echo '<div class="bg-danger">Invalid Username or Password</div>';
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