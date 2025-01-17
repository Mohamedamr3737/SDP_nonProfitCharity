<?php
// File: controllers/DonationController.php
require_once '../models/Receipt/BaseDonationReceipt.php';
require_once '../models/Receipt/TaxDecorator.php';
require_once '../models/Factories/DonationFactory.php';
require_once 'PaymentController.php';
require_once 'JsonController.php';
require_once  '../models/Observer/EmailNotification.php';
class DonationController {
    private $paymentController;

    public function __construct() {
        $this->paymentController = new PaymentController();
        ob_start(); // Start output buffering to catch any unexpected output
    }



    public function showDonationForm() {
        include '../views/donation/create.php';
    }

// File: controllers/DonationController.php
public function generateReceiptAndProcessPayment($data, $applyTax = true) {
    try {
        $donorName = $data['donorName'];
        $donationType = $data['donationType'];
        $donationAmount = isset($data['amount']) ? $data['amount'] : 0;
        $productName = isset($data['productName']) ? $data['productName'] : null;
        $serviceDescription = isset($data['serviceDescription']) ? $data['serviceDescription'] : null;
        $donorId=$data['donorId']?$data['donorId']:null;
        $donorEmail=$data['donorEmail'];
        // Generate the receipt
        $receipt = new BaseDonationReceipt($donorName, $donationAmount, $productName, $serviceDescription);
        if ($applyTax && $donationAmount != 0) {
            $taxRate = 0.14;
            $receipt = new TaxDecorator($receipt, $taxRate);
        }

        // Prepare receipt details for response
        $totalAmount = $receipt->getTotalAmount();
        $response = [
            'receipt' => $receipt->getDescription(),
            'totalAmount' => $totalAmount
        ];

        // Process payment if needed
        if ($donationType === "online" || $donationType === "check") {
            $paymentResult = $this->paymentController->processPayment([
                'donationType' => $donationType,
                'paymentMethod' => $data['paymentMethod'],
                'amount' => $totalAmount
            ]);

            if ($paymentResult['status'] === true) {
                // Payment successful; save donation and add payment message to response
                $response['message'] = $this->saveDonation($donorName, $donationType, $donorId,$totalAmount, $productName, $serviceDescription, $donorEmail);
                $response['paymentMessage'] = $paymentResult['message']; // Include payment message
                $response['status'] = 'success';
            } else {
                $response['message'] = "Payment failed. Donation not saved.";
                $response['status'] = 'error';
            }
        } else {
            // No payment needed; just save the donation
            $response['message'] = $this->saveDonation($donorName, $donationType, $donorId, $donationAmount, $productName, $serviceDescription, $donorEmail);
            $response['status'] = 'success';
        }

        // Return JSON response with success
        jsonResponse($response);

    } catch (Exception $e) {
        // Return JSON response with error message
        jsonResponse(['message' => "Error: " . $e->getMessage(), 'status' => 'error'], 500);
    }
}


    private function saveDonation($donorName, $donationType, $donorId, $amount = null, $productName = null, $serviceDescription = null, $donorEmail = null) {
        try {
            

            $donation = DonationFactory::createDonation($donationType, $donorName, $donorId, $amount, $productName, $serviceDescription, $donorEmail);
            $donation->addObserver(new EmailNotification());
            return $donation->save(); // Return success message from save method
        } catch (Exception $e) {
            return "Error saving donation: " . $e->getMessage();
        }
    }
    
}
