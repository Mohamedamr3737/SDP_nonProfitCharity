<?php

abstract class CertificateTemplate {
    // Template method
    public function generateCertificate($volunteer, $task) {
        $this->validateCompletion($task);
        $this->setHeader();
        $this->addVolunteerDetails($volunteer);
        $this->addTaskDetails($task);
        $this->addFooter();
        return $this->finalize();
    }

    // Steps of the template method
    protected function validateCompletion($task) {
        if ($task['is_completed'] != 1) {
            throw new Exception("Task must be completed to generate a certificate.");
        }
    }

    protected abstract function setHeader();
    protected abstract function addVolunteerDetails($volunteer);
    protected abstract function addTaskDetails($task);
    protected abstract function addFooter();
    protected abstract function finalize();
}
?>
