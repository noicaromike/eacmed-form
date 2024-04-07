<?php



class DepartmentsController extends Controller
{

    private $departmentModel;
    public function __construct()
    {
        $this->departmentModel = $this->model('Department');
    }

    public function settings()
    {
        $totalRecords = $this->departmentModel->getTotalRecords();
        $recordsPerPage = 5;
        $totalpages = ceil($totalRecords / $recordsPerPage);
        // var_dump($totalpages);
        $currentPage = pagination($totalpages);
        // var_dump($currentPage);
        $departments = $this->departmentModel->getAllDepartments($currentPage, $recordsPerPage);
        $data = [
            'departments' => $departments,
            'totalpages' => $totalpages,
            'currentPage' => $currentPage,
        ];
        $this->view('departments/settings', $data);
    }
    public function create()
    {
        $data = [
            'department' => '',
            'departmentError' => ''
        ];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = sanitizeData($_POST);
            $data = [
                'department' => trim($_POST['department']),
                'departmentError' => ''
            ];

            if (empty($data['department'])) {
                $data['departmentError'] = 'Please enter a department name';
            } else {
                if ($this->departmentModel->findExisting($data)) {
                    $data['departmentError'] = 'Department already exist please try again!';
                }
            }
            if (empty($data['departmentError'])) {
                if ($this->departmentModel->addDepartment($data)) {
                    flash('success', 'Create department successfully.');
                    header('location:' . URLROOT . '/departments/settings');
                }
            }
        }
        $this->view('departments/create', $data);
    }
    public function edit($id)
    {
        $department = $this->departmentModel->getDepartmentById($id);
        $data = [
            'id' => $id,
            'department' => $department->department,
            'departmentError' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = sanitizeData($_POST);
            $data = [
                'id' => $id,
                'department' => trim($_POST['department']),
                'departmentError' => ''
            ];
            if (empty($data['department'])) {
                $data['departmentError'] = 'Enter a Department';
            } else {
                if ($this->departmentModel->findExisting($data)) {
                    $data['departmentError'] = 'Department already Exist';
                }
            }
            if (empty($data['departmentError'])) {
                if ($this->departmentModel->updateDepartment($data)) {
                    flash('success', 'Update successfully.');
                    header('location:' . URLROOT . '/departments/settings');
                }
            }
        }

        $this->view('departments/edit', $data);
    }

    // no views this is for funneling params
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
            $this->departmentModel->deleteUserById($data);
            header('Location: ' . URLROOT . '/departments/settings');
        }
    }
}
