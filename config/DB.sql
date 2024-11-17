CREATE TABLE if NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(50) NOT NULL,
    lastName VARCHAR(50) NOT NULL,
    phone VARCHAR(15) NOT NULL UNIQUE,
    type ENUM('donor', 'volunteer','beneficiary') NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    login_type ENUM('email', 'social') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE if NOT EXISTS donations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    donorId Int Null,
    donor_name VARCHAR(100),
    donation_type ENUM('online', 'check', 'in-kind', 'product', 'service') NOT NULL,
    amount DECIMAL(10, 2),            -- For money donations
    product_name VARCHAR(100),        -- For product donations
    service_description TEXT,         -- For service donations
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (donorId) REFERENCES users(id) ON DELETE SET NULL
);







