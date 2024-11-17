<?php

class EmailLogin implements LoginStrategy {
    public function login($email, $password) {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM users WHERE email = :email AND login_type = 'email'");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            return [
                'status' => true,
                'message'=> "Login successful for {$user['email']}!"
            ];
        } else {
            return [
                'status' => false,
                'message'=> "Invalid email or password."
            ];
            
            
            
        }
    }
}

?>