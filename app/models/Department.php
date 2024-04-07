<?php


class Department
{

    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function getTotalRecords()
    {
        $this->db->query('SELECT count(*) AS total FROM departments');
        $this->db->execute();
        $row = $this->db->single();
        return $row->total;
    }
    public function getAllDepartments($currentPage, $recordsPerPage)
    {
        $offset = ($currentPage - 1) * $recordsPerPage;
        $this->db->query('SELECT * FROM departments ORDER BY id DESC LIMIT :pages,:rows');
        $this->db->bind(':pages', $offset);
        $this->db->bind(':rows', $recordsPerPage);
        $this->db->execute();
        $results = $this->db->resultSet();
        return $results;
    }
    public function addDepartment($data)
    {
        $this->db->query('INSERT INTO departments (department) VALUES (:department)');
        $this->db->bind(':department', $data['department']);
        if ($this->db->execute())
            return true;
        else
            return false;
    }

    public function findExisting($data)
    {
        $this->db->query('SELECT * FROM departments WHERE department = :department');
        $this->db->bind(':department', $data['department']);
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getDepartmentById($id)
    {
        $this->db->query('SELECT * FROM departments WHERE id = :id');
        $this->db->bind(':id', $id);
        $row = $this->db->single();
        return $row;
    }

    public function updateDepartment($data)
    {
        $this->db->query('UPDATE departments SET 
                            department = :department
                        WHERE id = :id
        
        ');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':department', $data['department']);
        $updated = $this->db->execute();
        return $updated;
    }

    public function deleteUserById($data)
    {
        $this->db->query('DELETE FROM departments WHERE id = :id');
        $this->db->bind(':id', $data['id']);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
