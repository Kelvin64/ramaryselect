-- Create database if not exists
CREATE DATABASE IF NOT EXISTS ramaryselect_db;
USE ramaryselect_db;

-- Create roles table
CREATE TABLE IF NOT EXISTS roles (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create users table
CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (role_id) REFERENCES roles(id)
);

-- Create blog_posts table
CREATE TABLE IF NOT EXISTS blog_posts (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    summary TEXT NOT NULL,
    image_path VARCHAR(255),
    author_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (author_id) REFERENCES users(id)
);

-- Insert default roles
INSERT INTO roles (name) VALUES 
('customer'),
('admin')
ON DUPLICATE KEY UPDATE name = VALUES(name);

-- Create a default admin user (password: admin123)
-- Note: In production, you should change this password immediately
INSERT INTO users (username, email, password, role_id) 
SELECT 'admin', 'admin@wineshop.com', '$2y$10$8K1p/a0dR1xqM8K1p/a0dR1xqM8K1p/a0dR1xqM8K1p/a0dR1xqM8K1p/a0dR1xqM8K1p/a0dR1xqM', 
(SELECT id FROM roles WHERE name = 'admin')
WHERE NOT EXISTS (SELECT 1 FROM users WHERE username = 'admin'); 