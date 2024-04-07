<?php

class StaffController extends Controller
{

    private $staffModel;
    public function __construct()
    {
        $this->staffModel = $this->model('Staff');
    }

    public function profile()
    {
        // $roles = $this->staffModel->getRoles();
        // $departments = $this->staffModel->getDepartments();
        $id = $_SESSION['id'];
        $user = $this->staffModel->getInfoById($id);
        // var_dump($user);
        $data = [
            'id' => $id,
            'user' => $user,
            'firstname' => $user->firstname,
            'lastname' => $user->lastname,
            'username' => $user->username,
            'password' => '',

            'firstnameError' => '',
            'lastnameError' => '',
            'roleError' => '',
            'departmentError' => '',
            'usernameError' => '',
            'passwordError' => '',
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = sanitizeData($_POST);
            $data = [
                'id' => $id,
                'user' => $user,
                // 'roles' => $roles,
                // 'departments' => $departments,
                'firstname' => trim($_POST['firstname']),
                'lastname' => trim($_POST['lastname']),
                // 'role' => isset($_POST['role']) ? trim($_POST['role']) : '',
                // 'department' => isset($_POST['department']) ? trim($_POST['department']) : '',
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),

                'firstnameError' => '',
                'lastnameError' => '',
                'roleError' => '',
                'departmentError' => '',
                'usernameError' => '',
                'passwordError' => '',

            ];

            if (empty($data['firstname'])) {
                $data['firstnameError'] = 'Enter a firstname.';
            }
            if (empty($data['lastname'])) {
                $data['lastnameError'] = 'Enter a lastname.';
            }
            // if (empty($data['role'])) {
            //     $data['roleError'] = 'Choose a role.';
            // }
            // if (empty($data['department'])) {
            //     $data['departmentError'] = 'Choose a department.';
            // }
            if (empty($data['username'])) {
                $data['usernameError'] = 'Enter a username.';
            }
            // if (empty($data['password'])) {
            //     $data['passwordError'] = 'Enter a password.';
            // }

            if (
                empty($data['firstnameError']) &&
                empty($data['lastnameError']) &&
                // empty($data['roleError']) &&
                // empty($data['departmentError']) &&
                empty($data['usernameError']) &&
                empty($data['passwordError'])
            ) {
                $pass = $data['password'];
                $hashedpass = password_hash($pass, PASSWORD_ARGON2ID);

                if ($this->staffModel->updateUser($data, $hashedpass, $id)) {
                    header('location:' . URLROOT . '/staff/profile');
                }
            }
        }


        $this->view('staff/profile', $data);
    }
}
