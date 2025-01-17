
<?php
require_once __DIR__ . '/../Donations/MoneyDonation/CheckDonation.php';
require_once __DIR__ . '/../Donations/MoneyDonation/InKindDonation.php';
require_once __DIR__ . '/../Donations/MoneyDonation/OnlineDonation.php';
require_once __DIR__ . '/../Donations/ProductDonation.php';
require_once __DIR__ . '/../Donations/ServiceDonation.php';

// File: factories/DonationFactory.php
// File: factories/DonationFactory.php
// File: factories/DonationFactory.php
class DonationFactory {

    public static function createDonation($type, $donorName, $donorId, $amount = null, $productName = null, $serviceDescription = null, $donorEmail = null) {
        switch ($type) {
            case 'online':
                $donation= new OnlineDonation($donorId, $donorName, $amount, $donorEmail);
                break;
            case 'check':
                $donation=  new CheckDonation($donorId, $donorName, $amount, $donorEmail );
                break;
            case 'in-kind':
                $donation=  new InKindDonation($donorId, $donorName, $amount, $donorEmail);
                break;
            case 'product':
                $donation=  new ProductDonation($donorId, $donorName, $productName, $donorEmail);
                break;
            case 'service':
                $donation=  new ServiceDonation($donorId, $donorName, $serviceDescription, $donorEmail);
                break;
            default:
                throw new Exception("Invalid donation type.");
        }
        // $donation->notifyObservers();
        return $donation;
    }
}


?>
