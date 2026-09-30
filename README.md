# Dynamic PHP/MySQL Portfolio

This project converts the supplied static portfolio page into a PHP/MySQL website. The homepage reads portfolio settings, services, testimonials, and projects from the database. Each service has a database-backed Read More page, and the contact form inserts submissions into `contact_messages`.

## Project structure

| Path | Purpose |
|---|---|
| `index.php` | Dynamic portfolio homepage |
| `service.php` | Database-backed service details page |
| `contact.php` | Validates and inserts contact form submissions |
| `config/db.php` | PDO database connection |
| `includes/functions.php` | Escaping, JSON, flash-message, and redirect helpers |
| `database/schema.sql` | Database, tables, indexes, and starter content |
| `assets/css/style.css` | Responsive styling |
| `assets/js/script.js` | Mobile navigation |
| `assets/images/` | Copy the images and SVG files from the original portfolio here |

## Installation

Create a MySQL database by importing `database/schema.sql` in phpMyAdmin or from the command line:

```bash
mysql -u root -p < database/schema.sql
```

Copy the original portfolio images and SVG files into `assets/images/`. The seed data expects these names: `WhatsApp Image 2026-07-27 at 23.15.57.jpeg`, `FAVK7855.JPG`, `IMG_E0101.JPG`, `DQSX9717.JPG`, `web-development-flyer.svg`, `database-flyer.svg`, `ui-ux-flyer.svg`, and `project-emergency-blood.svg`.

Update the credentials in `config/db.php`, or set the environment variables `DB_HOST`, `DB_NAME`, `DB_USER`, and `DB_PASS`. Then run the project with Apache/XAMPP or PHP's local server:

```bash
php -S localhost:8000
```

Open `http://localhost:8000/index.php` in a browser.

## How the dynamic data works

The `portfolio_settings` table controls the hero, About section, social links, CV link, and profile image. The `services`, `testimonials`, and `projects` tables control their corresponding sections. Services, project technologies, and project features use JSON columns so they can be edited without changing the PHP template. The contact form uses a prepared statement and stores name, email, phone, subject, message, status, and timestamp in `contact_messages`.

For production, add an authenticated administrator area to manage the records, disable display of raw database errors, configure HTTPS, and add CSRF protection to all administrative forms.
