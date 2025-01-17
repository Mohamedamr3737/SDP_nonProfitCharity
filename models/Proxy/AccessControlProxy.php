<?php

class AccessControlProxy {
    private $realHandler; // The actual controller or action handler
    private $userRole;

    public function __construct($realHandler, $userRole) {
        $this->realHandler = $realHandler;
        $this->userRole = $userRole;
    }

    public function handleRequest($requiredRole, $viewFile = null, $method = null, ...$params) {
        error_log("from hereeeee user role: " . $this->userRole . " required role: " . $requiredRole . " result: " . $this->authorize($requiredRole));
        if ($this->authorize($requiredRole)) {
            // If authorized, perform the requested operation
            if ($viewFile) {
                extract($params[0] ?? []);
                include $viewFile; // Render the view
            } elseif (is_callable($method)) {
                // If the method is a callable (e.g., Closure), execute it
                return $method(...$params);
            } elseif ($method) {
                // Call the method on the real handler
                return call_user_func_array([$this->realHandler, $method], $params);
            }
        } else {
            // Redirect to unauthorized page or show an error
            include '../views/unauthorized.php';
            exit;
        }
    }
    

    private function authorize($requiredRole) {
        // Define role hierarchy: higher roles can access lower-level functionalities
        $roleHierarchy = [
            'super_admin' => ['super_admin'],
            'Admin' => ['super_admin', 'donations_admin','payment_admin' ],
            'donations_admin' => ['super_admin', 'donations_admin'],
            'payment_admin' => ['super_admin', 'payment_admin'],
            'user' => ['super_admin', 'Admin', 'donations_admin', 'payment_admin', 'user']
        ];
    
        return in_array($this->userRole, $roleHierarchy[$requiredRole] ?? []);
    }
}
