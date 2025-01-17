
<?php

// File: controllers/AuthController.php

require_once '../core/BaseController.php';
require_once '../models/User.php';
require_once '../models/LoginContext.php';
require_once '../config/Database.php';
require_once '../models/LoginStrategies/LoginStrategy.php';
require_once '../models/LoginStrategies/SocialLogin.php';
require_once '../models/LoginStrategies/EmailLogin.php';
require_once 'JsonController.php';


class AuthController extends BaseController {
    private $userModel;
    private $loginContext;

    public function __construct() {
        parent::__construct();
        $this->userModel = new User(Database::getInstance()->getConnection());
        $this->loginContext = new LoginContext();
        // session_start();
    }

    public function signup($data) {

        if ($data['type'] === 'beneficiary') {
            $data['email'] = null;
            $data['password'] = '';
            $data['rePassword'] = ''; // Match empty passwords
            $data['login_type'] = '';
            $data['skills'] = '';
        }

        $this->userModel->__constructUser($data);

        if($data['type'] === 'beneficiary' || $data['password']==$data['rePassword']){
        // Call the User model's register method
        $response=$this->userModel->register($this->userModel);

        return jsonResponse($response) ;
        }else{
            $response['statusCode']=400;
            $response['message']= "password mismatch";
            return jsonResponse($response) ;
        }
    }

    public function login($data) {
        $email = $data['email'];
        $password = $data['password'];
        $loginType = $data['login_type'];

        // Set the appropriate login strategy
        if ($loginType === 'email') {
            $this->loginContext->setStrategy(new EmailLogin());
        } elseif ($loginType === 'social') {
            $this->loginContext->setStrategy(new SocialLogin());
        } else {
            return "Invalid login type.";
        }

        // Execute the login strategy
        $response= $this->loginContext->executeLogin($email, $password);
        if ($response['status'] === true) {
            $this->userModel->findByEmail($email);
            $_SESSION['user_id'] = $this->userModel->getId();
            $_SESSION['user_name'] = $this->userModel->getName();
            $_SESSION['user_email'] = $this->userModel->getEmail();
            $_SESSION['user_type'] = $this->userModel->getType();
            $_SESSION['user_role'] = $this->userModel->getRole();
            $response['statusCode']=200;
            return jsonResponse($response);
        } else{
            $response['statusCode']=401;
            return jsonResponse($response);
        }
    }
}
