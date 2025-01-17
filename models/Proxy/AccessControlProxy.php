<?php

class AccessControlProxy {
    private $realHandler; // The actual controller or action handler
    private $userRole;

    public function __construct($realHandler, $userRole) {
        $this->realHandler = $realHandler;
        $this->userRole = $userRole;
    }

    public function handleRequest($requiredRole, $viewFile = null, $method = null, ...$params) {
        error_log("from hereeeee "."user role: " . $this->userRole. "requred role: " . $requiredRole. "result: ".  $this->authorize($requiredRole));
        if ($this->authorize($requiredRole)) {
            // If authorized, perform the requested operation
            if ($viewFile) {
                include $viewFile; // Render the view
            } elseif ($method) {
                // Call the method on the real handler
                error_log(json_encode(call_user_func_array([$this->realHandler, $method], $params)));
                return call_user_func_array([$this->realHandler, $method], $params);
            }
        } else {
            // Redirect to unauthorized page or show an error
            header("Location: /unauthorized");
            exit;
        }
    }

    private function authorize($requiredRole) {
        // Define role hierarchy: higher roles can access lower-level functionalities
        $roleHierarchy = [
            'super_admin' => ['super_admin'],
            'admin' => ['super_admin', 'admin'],
            'donation_admin' => ['super_admin', 'admin', 'donation_admin'],
            'payment_admin' => ['super_admin', 'admin', 'payment_admin'],
            'user' => ['super_admin', 'admin', 'donation_admin', 'payment_admin', 'user']
        ];

        return in_array($this->userRole, $roleHierarchy[$requiredRole] ?? []);
    }
}
