USE emmanuel_portfolio;

CREATE TABLE IF NOT EXISTS admin_users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(190) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('admin', 'editor') NOT NULL DEFAULT 'admin',
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    last_login_at DATETIME NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

ALTER TABLE services ADD INDEX IF NOT EXISTS idx_services_active_order (is_active, sort_order);
ALTER TABLE testimonials ADD INDEX IF NOT EXISTS idx_testimonials_active_order (is_active, sort_order);
ALTER TABLE projects ADD INDEX IF NOT EXISTS idx_projects_active_order (is_active, sort_order);
