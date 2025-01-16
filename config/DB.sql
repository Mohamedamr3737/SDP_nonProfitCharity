CREATE TABLE if NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(50) NOT NULL,
    lastName VARCHAR(50) NOT NULL,
    phone VARCHAR(15) NOT NULL UNIQUE,
    type ENUM('donor', 'volunteer','beneficiary','admin') NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    login_type ENUM('email', 'social') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    skills TEXT NOT NULL,
    availability ENUM('available', 'unavailable') DEFAULT 'available',
    hours_worked INT DEFAULT 0
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

CREATE TABLE events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    date DATE NOT NULL,
    location VARCHAR(255) NOT NULL,
    last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    is_deleted TINYINT(1) DEFAULT 0
);

CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    required_skill VARCHAR(255) NOT NULL,
    is_completed TINYINT(1) DEFAULT 0,
    last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    is_deleted TINYINT(1) DEFAULT 0,
    FOREIGN KEY (event_id) REFERENCES events(id)
);


CREATE TABLE task_assignments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    task_id INT NOT NULL,
    volunteer_id INT NOT NULL,
    FOREIGN KEY (task_id) REFERENCES tasks(id),
    FOREIGN KEY (volunteer_id) REFERENCES users(id)
);


CREATE TABLE actions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    entity_type ENUM('task', 'event') NOT NULL,
    entity_id INT NOT NULL,
    action_type ENUM('add', 'update', 'delete') NOT NULL,
    previous_data TEXT,
    user_id INT NOT NULL,
    is_undone TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);


CREATE TABLE action_history (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    entity_type ENUM('task', 'event') NOT NULL,
    action_type ENUM('add', 'edit', 'delete') NOT NULL,
    entity_id INT NOT NULL,
    entity_data JSON NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);






