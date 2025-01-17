<?php
require_once __DIR__ . '/../models/User.php';

class AdminController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User(Database::getInstance()->getConnection());
    }

    public function assignRole($userId, $role) {
        if (!in_array($role, ['super_admin', 'donations_admin', 'payment_admin', 'user'])) {
            throw new Exception("Invalid role.");
        }
        return $this->userModel->updateRole($userId, $role);
    }

    public function addUser($data) {
        return $this->userModel->register($data);
    }

    public function viewUsers() {
        return $this->userModel->getAllUsers();
    }
}
