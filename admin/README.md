# Emmanuel Portfolio Admin Dashboard

This folder is a separate PHP/MySQL admin dashboard styled after the supplied dark green reference image. It uses the existing portfolio database and manages services, testimonials, projects, and contact messages.

## Install in XAMPP

Place this entire `admin` folder inside the existing portfolio project:

```text
C:\xampp\htdocs\emmanuel-portfolio\admin\
```

Import `database/admin_schema.sql` into the existing `emmanuel_portfolio` database through phpMyAdmin. This creates the `admin_users` table and adds indexes to the existing content tables.

Open the dashboard at:

```text
http://localhost/emmanuel-portfolio/admin/
```

The dashboard currently allows access only from the local computer; it does not include an admin login flow. Do not expose it on a public server until authentication is implemented. The `admin_users` table is created for future use but is not currently used by the dashboard.

## Main files

| File | Purpose |
|---|---|
| `index.php` | Statistics and recent messages dashboard |
| `logout.php` | Ends the current admin session |
| `services.php`, `service_form.php`, `service_delete.php` | Services CRUD |
| `testimonials.php`, `testimonial_form.php`, `testimonial_delete.php` | Testimonials CRUD |
| `projects.php`, `project_form.php`, `project_delete.php` | Projects CRUD |
| `messages.php`, `message.php` | Client inbox and message status management |
| `database/admin_schema.sql` | Admin table and indexes |
| `assets/admin.css` | Reference-inspired dashboard styling |
| `assets/admin.js` | Sidebar and delete confirmation behavior |

The dashboard reads the same `services`, `testimonials`, `projects`, and `contact_messages` tables used by the public portfolio. Therefore, records created or updated from the dashboard appear on the public website automatically.
