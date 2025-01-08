<?php
class manage_accounts_m extends connectDB
{
    public function get_all_accounts()
    {
        // Câu truy vấn lấy tất cả tài khoản
        $sql = "SELECT * FROM users ORDER BY created_at DESC";
        $result = mysqli_query($this->con, $sql);

        $accounts = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $accounts[] = $row;
            }
        }
        return $accounts;
    }
    public function timkiem_find($email, $name)
    {
        $sql = "SELECT * FROM users WHERE email LIKE '%$email%' AND name LIKE '%$name%'";
        $result = mysqli_query($this->con, $sql);


        return $result;
    }
    public function update_account($id, $email, $password, $role, $name)
    {
        $sql = "UPDATE users SET email = ?, password = ?, role = ?, name = ?, updated_at = NOW() WHERE id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("ssisi", $email, $password, $role, $name, $id);
        return $stmt->execute();
    }
    public function deleteAccount($accountId)
    {
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $accountId);
        return $stmt->execute();
    }
    public function addAccount($email, $password, $name, $role)
    {
        $sql = "INSERT INTO users (email, password, name, role) VALUES (?, ?, ?, ?)";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("sssi", $email, $password, $name, $role);
        return $stmt->execute();
    }
}
