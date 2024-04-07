<?php

class UsersController extends Controller
{
    private $userModel;
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }



    public function dashboard()
    {
        $totalUsers = $this->userModel->getTotalRecords();
        $totalDepartment = $this->userModel->getTotalDepartment();
        $data = [

            'totalUsers' => $totalUsers,
            'totalDepartment' => $totalDepartment
        ];
        $this->view('users/dashboard', $data);
    }
    public function settings()
    {
        $totalRecords = $this->userModel->getTotalRecords();
        $recordsPerPage = 5;
        $totalpages = ceil($totalRecords / $recordsPerPage);
        // var_dump($totalpages);
        $currentPage = pagination($totalpages);
        // var_dump($currentPage);
        $users = $this->userModel->getAllUsers($currentPage, $recordsPerPage);
        $data = [
            'users' => $users,
            'totalpages' => $totalpages,
            'currentPage' => $currentPage,
        ];


        $this->view('users/settings', $data);
    }
    public function create()
    {
        $roles = $this->userModel->getRoles();
        $departments = $this->userModel->getDepartments();
        $data = [
            'roles' => $roles,
            'departments' => $departments,
            'firstname' => '',
            'lastname' => '',
            'role' => '',
            'department' => '',
            'username' => '',
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
                'roles' => $roles,
                'departments' => $departments,
                'firstname' => trim($_POST['firstname']),
                'lastname' => trim($_POST['lastname']),
                'role' => isset($_POST['role']) ? trim($_POST['role']) : '',
                'department' => isset($_POST['department']) ? trim($_POST['department']) : '',
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
            if (empty($data['role'])) {
                $data['roleError'] = 'Choose a role.';
            }
            if (empty($data['department'])) {
                $data['departmentError'] = 'Choose a department.';
            }
            if (empty($data['username'])) {
                $data['usernameError'] = 'Enter a username.';
            } else {
                if ($this->userModel->findExisting($data['username'])) {
                    $data['usernameError'] = 'Username already taken please try a new!';
                }
            }
            if (empty($data['password'])) {
                $data['passwordError'] = 'Enter a password.';
            }

            if (
                empty($data['firstnameError']) &&
                empty($data['lastnameError']) &&
                empty($data['roleError']) &&
                empty($data['departmentError']) &&
                empty($data['usernameError']) &&
                empty($data['passwordError'])
            ) {
                $pass = $data['password'];
                $hashedpass = password_hash($pass, PASSWORD_ARGON2ID);

                if ($this->userModel->createAccount($data, $hashedpass)) {
                    flash('success', 'Create account successfully.');
                    header('location:' . URLROOT . '/users/settings');
                }
            }
        }
        $this->view('users/create', $data);
    }
    public function edit($id)
    {
        $user = $this->userModel->getUserById($id);

        $roles = $this->userModel->getRoles();
        $departments = $this->userModel->getDepartments();
        $data = [
            'id' => $id,
            'user' => $user,
            'roles' => $roles,
            'departments' => $departments,
            'firstname' => $user->firstname,
            'lastname' => $user->lastname,
            'role' => $user->role_id,
            'department' => $user->department_id,
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
                'roles' => $roles,
                'departments' => $departments,
                'firstname' => trim($_POST['firstname']),
                'lastname' => trim($_POST['lastname']),
                'role' => isset($user->role_id) ? trim($_POST['role']) : '',
                'department' => isset($user->department_id) ? trim($_POST['department']) : '',
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),

                'firstnameError' => '',
                'lastnameError' => '',
                'roleError' => '',
                'departmentError' => '',
                'usernameError' => '',
                'passwordError' => '',

            ];
            // var_dump($data['role']);
            // var_dump($data['id']);
            // var_dump($data['department']); 

            // die();

            if (empty($data['firstname'])) {
                $data['firstnameError'] = 'Enter a firstname.';
            }
            if (empty($data['lastname'])) {
                $data['lastnameError'] = 'Enter a lastname.';
            }
            if (empty($data['role'])) {
                $data['roleError'] = 'Choose a role.';
            }
            if (empty($data['department'])) {
                $data['departmentError'] = 'Choose a department.';
            }
            if (empty($data['username'])) {
                $data['usernameError'] = 'Enter a username.';
            }
            // if (empty($data['password'])) {
            //     $data['passwordError'] = 'Enter a password.';
            // }

            if (
                empty($data['firstnameError']) &&
                empty($data['lastnameError']) &&
                empty($data['roleError']) &&
                empty($data['departmentError']) &&
                empty($data['usernameError']) &&
                empty($data['passwordError'])
            ) {
                $pass = $data['password'];
                $hashedpass = password_hash($pass, PASSWORD_ARGON2ID);

                if ($this->userModel->updateUser($data, $hashedpass, $id)) {
                    flash('success', 'Update successfully.');
                    header('location:' . URLROOT . '/users/settings');
                }
            }
        }

        $this->view('users/edit', $data);
    }

    public function delete($id)
    {
        $data = [
            'id' => $id,
            'selected_id' => '',
        ];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = sanitizeData($_POST);
            $data = [
                'id' => $id,
                'selected_id' => isset($_POST['selected_id']) ?  $_POST['selected_id'] : '',
            ];
            $this->userModel->deleteUserById($data);
            header('Location: ' . URLROOT . '/users/settings');
        }
    }
}
