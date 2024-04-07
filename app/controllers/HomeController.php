<?php

class HomeController extends Controller
{
    private $homeModel;
    public function __construct()
    {
        $this->homeModel = $this->model('Home');
    }



    public function home()
    {

        $data = [

            'username' => '',
            'password' => '',
            'usernameError' => '',
            'passwordError' => '',

        ];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = sanitizeData($_POST);
            $data = [

                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'usernameError' => '',
                'passwordError' => '',

            ];
            if (empty($data['username'])) {
                $data['usernameError'] = 'Username is required';
            }
            if (empty($data['password'])) {
                $data['passwordError'] = 'Password is required';
            }
            if (
                empty($data['usernameError']) &&
                empty($data['passwordError'])
            ) {
                $checkUser = $this->homeModel->getUserByUsername($data);
                if ($checkUser) {
                    $this->CreateSession($checkUser);
                } else {
                    $data['passwordError'] = 'Invalid username or password. Please try again!';
                }
            }
        }
        $this->view('home', $data);
    }

    public function  CreateSession($checkUser)
    {
        $_SESSION['id'] = $checkUser->id;
        $_SESSION['firstname'] = $checkUser->firstname;
        $_SESSION['lastname'] = $checkUser->lastname;
        $_SESSION['username'] = $checkUser->username;
        $_SESSION['role_id'] = $checkUser->role_id;

        if ($_SESSION['role_id'] == 1) {
            header('location:' . URLROOT . '/users/dashboard');
        }
        if ($_SESSION['role_id'] > 1) {
            header('location:' . URLROOT . '/staff/profile');
        }
    }

    public function logout()
    {
        unset($_SESSION['id']);
        unset($_SESSION['firstname']);
        unset($_SESSION['lastname']);
        unset($_SESSION['username']);
        unset($_SESSION['role_id']);
        header('location:' . URLROOT . '/home');
        exit();
    }
}
