-- Create wines table for admin wine management
CREATE TABLE IF NOT EXISTS wines (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    brand VARCHAR(100) NOT NULL,
    type VARCHAR(50) NOT NULL,
    cask VARCHAR(100),
    image_path VARCHAR(255),
    is_active TINYINT(1) DEFAULT 1,
    created_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES users(id)
);

-- Insert existing wines from the hardcoded data to maintain current content
INSERT INTO wines (name, brand, type, cask, image_path, is_active, created_by) VALUES
('Arbora', 'Arbora Vineyards', 'Pinot Noir', 'Gau Cask', '/ramaryselect/images/sidepan.png', 1, 1),
('Alto Italia', 'Alto Italia', 'Pinot Grigio', 'Gau Cask', '/ramaryselect/images/sidepan.png', 1, 1),
('Cavellor', 'Cavellor Estate', 'Pinot Grigio', 'Gau Cask', '/ramaryselect/images/sidepan.png', 1, 1),
('Trentino', 'Trentino Wines', 'Pinot Grigio', 'Gau Cask', '/ramaryselect/images/sidepan.png', 1, 1); 