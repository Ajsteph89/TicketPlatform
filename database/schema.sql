CREATE DATABASE IF NOT EXISTS ticketing_app;
USE ticketing_app;

/* ===== USERS ===== */
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('organizer', 'goer') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

/* ===== EVENTS ===== */
CREATE TABLE events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    event_datetime DATETIME NOT NULL,
    location VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

/* ===== TICKETS ===== */
CREATE TABLE tickets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_id INT NOT NULL,
    ticket_type ENUM('VIP', 'General Admission') NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    quantity INT NOT NULL,
    sale_start DATETIME,
    sale_end DATETIME,
    image_path VARCHAR(255),
    FOREIGN KEY (event_id) REFERENCES events(id)
);

/* ===== ORDERS ===== */
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NULL,
    customer_name VARCHAR(255),
    customer_email VARCHAR(255),
    total DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

/* ===== ORDER ITEMS ===== */
CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    ticket_id INT NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (ticket_id) REFERENCES tickets(id)
);
