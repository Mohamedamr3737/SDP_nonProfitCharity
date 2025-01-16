<?php

require_once 'CertificateTemplate.php';
require_once __DIR__ . '/../../vendor/autoload.php'; // Ensure FPDF is autoloaded


class EnhancedVolunteerCertificate extends CertificateTemplate {
    private $pdf;

    public function __construct() {
        $this->pdf = new FPDF();
        $this->pdf->AddPage();
        $this->pdf->SetFont('Arial', 'B', 16);
    }

    protected function setHeader() {
        // Add header image or title
        $this->pdf->Image('../Public/Assets/images/logo (2).png', 10, 10, 30); // Optional logo
        $this->pdf->SetXY(50, 10);
        $this->pdf->Cell(0, 20, 'Certificate of Completion', 0, 1, 'C');
        $this->pdf->Ln(10);
    }

    protected function addVolunteerDetails($volunteer) {
        $this->pdf->SetFont('Arial', '', 12);
        $this->pdf->Cell(0, 10, "Volunteer Name: " . $volunteer['firstName'] . " " . $volunteer['lastName'], 0, 1, 'L');
        $this->pdf->Cell(0, 10, "Email: " . $volunteer['email'], 0, 1, 'L');
        $this->pdf->Ln(5);
    }

    protected function addTaskDetails($task) {
        $this->pdf->SetFont('Arial', '', 12);
        $this->pdf->Cell(0, 10, "Task Name: " . $task['name'], 0, 1, 'L');
        $this->pdf->Cell(0, 10, "Required Skill: " . $task['required_skill'], 0, 1, 'L');
        $this->pdf->Cell(0, 10, "Completed On: " . date('Y-m-d'), 0, 1, 'L');
        $this->pdf->Ln(5);
    }

    protected function addFooter() {
        $this->pdf->Ln(10);
        $this->pdf->SetFont('Arial', 'I', 12);
        $this->pdf->Cell(0, 10, "Thank you for your valuable contribution!", 0, 1, 'C');
        $this->pdf->Ln(20);
        $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->Cell(0, 10, "Generated on " . date('Y-m-d H:i:s'), 0, 1, 'C');
    }

    protected function finalize() {
        $fileName = 'certificates/Certificate_' . time() . '.pdf';
        $filePath = __DIR__ . '/../../public/' . $fileName; // Save to public directory
        $this->pdf->Output('F', $filePath); // Save PDF
        return '/' . $fileName; // Return web-accessible path
    }
    
}
?>
