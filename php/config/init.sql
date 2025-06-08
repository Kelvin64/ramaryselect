-- Create database if not exists
CREATE DATABASE IF NOT EXISTS ramaryselect_db;
USE ramaryselect_db;

-- Create roles table
CREATE TABLE IF NOT EXISTS roles (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL UNIQUE
);

-- Create users table
CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    role_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (role_id) REFERENCES roles(id)
);

-- Insert default roles
INSERT INTO roles (name) VALUES 
    ('admin'),
    ('user')
ON DUPLICATE KEY UPDATE name=name;

-- Insert default admin user (password: admin123)
INSERT INTO users (username, password, email, role_id)
SELECT 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@ramaryselect.com', r.id
FROM roles r
WHERE r.name = 'admin'
ON DUPLICATE KEY UPDATE username=username; 