<?php
class Login_m extends connectDB
{
    public function checkLogin($email, $password)
    {
        $sql = "SELECT * FROM users WHERE email = ?";

        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("s", $email);

        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            if ($password == $user['password']) {
                return $user;
            }
        }


        return false;
    }
}
