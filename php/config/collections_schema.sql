-- Wine Collections Table
CREATE TABLE IF NOT EXISTS wine_collections (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    image_path VARCHAR(500),
    pdf_path VARCHAR(500),
    is_active BOOLEAN DEFAULT TRUE,
    created_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL
);

-- Insert default collections if they don't exist
INSERT IGNORE INTO wine_collections (id, name, description, image_path, pdf_path, created_by) VALUES
(1, 'White Wines', 'Elegant, crisp, and refreshing. Explore our selection of premium white wines.', 'images/wine1.jpg', NULL, 1),
(2, 'Red Wines', 'Rich, bold, and full-bodied. Discover our curated red wine collection.', 'images/wine7.jpg', NULL, 1),
(3, 'Rosé Wines', 'Delicate, floral, and vibrant. Enjoy our handpicked rosé wines.', 'images/wine8.jpg', NULL, 1),
(4, 'Sparkling Wines', 'Celebrate with our selection of sparkling wines and champagnes.', 'images/wine9.jpg', NULL, 1); 