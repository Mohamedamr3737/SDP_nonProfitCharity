<?php
class SocialLogin implements LoginStrategy {
    public function login($username, $password) {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM users WHERE email = :username AND login_type = 'social'");
        $stmt->execute(['username' => $username]);
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