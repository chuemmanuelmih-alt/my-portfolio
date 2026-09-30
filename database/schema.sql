CREATE DATABASE IF NOT EXISTS emmanuel_portfolio
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE emmanuel_portfolio;

CREATE TABLE IF NOT EXISTS portfolio_settings (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(100) NOT NULL UNIQUE,
    setting_value TEXT NULL,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS services (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    icon_class VARCHAR(100) NOT NULL DEFAULT 'bx bx-code',
    short_description TEXT NOT NULL,
    details_title VARCHAR(150) NULL,
    details_description TEXT NULL,
    details_image VARCHAR(255) NULL,
    detail_items JSON NULL,
    sort_order INT NOT NULL DEFAULT 0,
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS testimonials (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    client_name VARCHAR(150) NOT NULL,
    client_role VARCHAR(150) NULL,
    image VARCHAR(255) NULL,
    content TEXT NOT NULL,
    rating TINYINT UNSIGNED NOT NULL DEFAULT 5,
    sort_order INT NOT NULL DEFAULT 0,
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS projects (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    description TEXT NOT NULL,
    image VARCHAR(255) NULL,
    project_url VARCHAR(255) NULL,
    technologies JSON NULL,
    features JSON NULL,
    sort_order INT NOT NULL DEFAULT 0,
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS contact_messages (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    email VARCHAR(190) NOT NULL,
    phone VARCHAR(50) NULL,
    subject VARCHAR(200) NOT NULL,
    message TEXT NOT NULL,
    status ENUM('new', 'read', 'replied', 'archived') NOT NULL DEFAULT 'new',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_contact_status (status),
    INDEX idx_contact_created_at (created_at)
);

INSERT INTO portfolio_settings (setting_key, setting_value) VALUES
('site_name', 'EMMANUEL'),
('page_title', 'CHU EMMANUEL MIH | Software Engineering Student'),
('hero_name', 'CHU EMMANUEL MIH'),
('hero_role', 'WEB-DEVELOPER'),
('hero_intro', 'I build responsive, useful and modern digital experiences for people and businesses.'),
('profile_image', 'WhatsApp Image 2026-07-27 at 23.15.57.jpeg'),
('about_role', 'Web-developer'),
('about_short', 'I am passionate about building websites by designing both the frontend and backend. I use HTML, CSS and JavaScript for frontend design and PHP for backend development. You can trust me for e-commerce websites and other business systems.'),
('about_read_more', 'about.php'),
('cv_url', '#'),
('linkedin_url', '#'),
('github_url', '#'),
('facebook_url', '#'),
('instagram_url', '#')
ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value);

INSERT INTO services (title, icon_class, short_description, details_title, details_description, details_image, detail_items, sort_order) VALUES
('Web Development', 'bx bx-code', 'We build fast, responsive and modern websites that help your business stand out online and attract more customers.', 'Web Development', 'I design and develop responsive websites and web applications tailored to meet your business needs. Whether you need a personal portfolio, business website, e-commerce platform, or custom web application, I build solutions that are secure, scalable, and optimized for all devices and browsers.', 'web-development-flyer.svg', '["Responsive website development", "E-commerce website development", "Custom web applications", "Landing pages", "Performance optimization", "Bug fixing and technical support"]', 1),
('UI/UX Design', 'bx bx-palette', 'We design clean, intuitive and user-friendly interfaces that deliver smooth and engaging digital experiences for users.', 'UI/UX Design', 'Great digital products begin with exceptional user experiences. I create intuitive, engaging, and visually appealing interfaces that help users navigate effortlessly while achieving your business goals.', 'ui-ux-flyer.svg', '["User Interface (UI) design", "User Experience (UX) research and design", "Wireframing and prototyping", "Responsive layouts", "Design systems", "Website and mobile app interface design", "User-centered design improvements"]', 2),
('Database Administration', 'bxl-android', 'We develop, manage and administer databases for companies, organizations and businesses. Proper management is guaranteed.', 'Database Administration', 'A well-managed database is the foundation of every successful application. I provide database administration services to ensure your data remains organized, secure, and accessible.', 'database-flyer.svg', '["Database design and implementation", "Database optimization", "Backup and recovery solutions", "Performance tuning", "Data migration", "Security and user access management", "Ongoing database maintenance"]', 3)
ON DUPLICATE KEY UPDATE title = VALUES(title);

INSERT INTO testimonials (client_name, client_role, image, content, rating, sort_order) VALUES
('Chef Bakhita', 'CEO, Bakhis Cakes and More', 'FAVK7855.JPG', 'Working with this developer was a fantastic experience. They transformed our outdated bakery website into a modern and responsive platform that looks great on every device. Communication was clear throughout the project, deadlines were met, and the final result exceeded our expectations.', 5, 1),
('Nurse Atumkhezibuhchu', 'Hospital Management Client', 'IMG_E0101.JPG', 'He built a hospital management system for us which helped to manage patient information and doctor information. This improved the management of our hospital.', 5, 2),
('Engr. Gilad', 'Agriculture Software Client', 'DQSX9717.JPG', 'Working with him was a memorable experience. He designed the interface for our agriculture software very well.', 5, 3);

INSERT INTO projects (title, description, image, project_url, technologies, features, sort_order) VALUES
('Emergency Blood Request System', 'A web-based platform for managing emergency blood requests, donor records, and lifesaving coordination in real time.', 'project-emergency-blood.svg', '#', '["HTML", "CSS", "JavaScript", "PHP", "MySQL"]', '["Donor registration", "Blood request management", "Donor information tracking", "Database storage", "Admin management"]', 1);
