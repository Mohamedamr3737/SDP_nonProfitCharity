<?php

require_once '../core/BaseModel.php';
class User extends BaseModel {
    private $id;
    private $firstName;
    private $lastName;
    private $phone;
    private $type;
    private $email;
    private $password;
    private $login_type;
    private $skills;
    private $role;

    public function __constructUser($data) {
        $this->firstName = $data['firstName'];
        $this->lastName = $data['lastName'];
        $this->phone = $data['phone'];
        $this->type = $data['type'];
        $this->email = $data['email'];
        $this->password = $data['password'];
        $this->login_type = $data['login_type'];
        $this->skills = $data['skills'];
    }
    public function getName() {
        return $this->firstName ." " . $this->lastName;
        }

    public function getType() {
        return $this->type;
        }
    public function getEmail() {
        return $this->email;
        }

    public function getId() {
        return $this->id;
        }

    public function getSkill() {
        return $this->skills;
        }
    public function getRole() {
        return $this->role;
        }
    
    
    public function findByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($user) {
            $this->id = $user['id'];
            $this->firstName = $user['firstName'];
            $this->lastName = $user['lastName'];
            $this->phone = $user['phone'];
            $this->type = $user['type'];
            $this->email = $user['email'];
            $this->password = $user['password'];
            $this->login_type = $user['login_type'];
            $this->skills = $user['skills'];
            $this->role= $user['role'];
            return true;
        }
        return false;
    }
    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    


    public function register(User $user) {
        try{
        $hashedPassword = password_hash($this->password, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare("INSERT INTO users (firstName, lastName, phone, type, email, password, login_type, skills) VALUES (:firstName, :lastName, :phone, :type, :email, :password, :login_type, :skills)");
        $stmt->execute([
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'phone' => $this->phone,
            'type' => $this->type,
            'email' => $this->email,
            'password' => $hashedPassword,
            'login_type' => $this->login_type,
            'skills' => $this->skills,
        ]);

        return[
            'statusCode'=>200,
            'message'=>"User registered successfully!"
        ] ;
    }catch(PDOException $e){

        return[
            "error"=> $e->getMessage(),
            "statusCode"=> 409
        ] ;
        }
    }
    public function setAvailability($userId, $availability) {
        // Define valid availability states
        $validStates = ['available', 'busy', 'unavailable'];
    
        // Check if the provided availability state is valid
        if (!in_array($availability, $validStates)) {
            throw new InvalidArgumentException("Invalid availability state. Valid states are: 'available', 'busy', 'unavailable'.");
        }
    
        // Update the availability in the database
        $stmt = $this->db->prepare("UPDATE users SET availability = :availability WHERE id = :id");
        $stmt->execute([
            'availability' => $availability,
            'id' => $userId,
        ]);
    }
    
    public function findAvailableUsersBySkill($skill) {
        $stmt = $this->db->prepare("
            SELECT * FROM users 
            WHERE skills LIKE :skill AND availability = 'available'
        ");
        $stmt->execute(['skill' => '%' . $skill . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function updateRole($userId, $role) {
        $stmt = $this->db->prepare("UPDATE users SET role = :role WHERE id = :id");
        $stmt->execute(['role' => $role, 'id' => $userId]);
        return $stmt->rowCount();
    }

    public function getAllUsers() {
        $stmt = $this->db->query("SELECT id, firstName, lastName, email, role FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    
}

?>