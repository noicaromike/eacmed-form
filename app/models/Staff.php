<?php


class Staff
{

    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function getInfoById($id)
    {

        $this->db->query('SELECT users.*, roles.role AS role_name, departments.department AS dept_name
                            FROM users 
                            JOIN roles ON users.role_id = roles.id
                            JOIN departments ON users.department_id = departments.id
                            WHERE users.id = :id');
        $this->db->bind(':id', $id);
        if ($this->db->rowCount() > 0) {
            return $this->db->single();
        } else {
            return false;
        }
    }
    public function getRoles()
    {
        $this->db->query('SELECT * FROM roles ORDER BY id ASC');
        $results = $this->db->resultSet();
        return $results;
    }
    public function getDepartments()
    {
        $this->db->query('SELECT * FROM departments ORDER BY id ASC');
        $results = $this->db->resultSet();
        return $results;
    }

    public function updateUser($data, $hashedpass, $id)
    {
        if (!empty($data['password'])) {
            $this->db->query('UPDATE users SET 
                            firstname = :firstname,
                            lastname = :lastname,
                            username = :username,
                            password = :password
                        WHERE id=:id 
        ');
            $this->db->bind(':id', $id);
            $this->db->bind(':firstname', $data['firstname']);
            $this->db->bind(':lastname', $data['lastname']);
            $this->db->bind(':username', $data['username']);
            $this->db->bind(':password', $hashedpass);

            $updated = $this->db->execute();
            return $updated;
        } else {
            $this->db->query('UPDATE users SET 
                            firstname = :firstname,
                            lastname = :lastname,
                            username = :username
                            
                        WHERE id=:id 
        ');
            $this->db->bind(':id', $id);
            $this->db->bind(':firstname', $data['firstname']);
            $this->db->bind(':lastname', $data['lastname']);
            $this->db->bind(':username', $data['username']);
            // $this->db->bind(':password', $hashedpass);
            $updated = $this->db->execute();
            return $updated;
        }
    }
}
