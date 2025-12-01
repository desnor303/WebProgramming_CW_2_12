
# 📘 COMP1841 Coursework – Student Question Forum 

This project is an extended and reorganized version of the original COMP1841 Coursework.
It includes the classic *Student Question Forum* plus a new **Page Builder System** that allows dynamic creation of new page types and their database tables.

The entire project has been restructured into a simple, clean MVC-like layout:

* `controller/` – handles all application logic
* `templates/` – HTML views
* `includes/` – shared PHP utilities (e.g., database connection)
* `public/` – CSS & JavaScript
* `uploads/` – uploaded images

---

## 📂 Project Structure

```
cw_builder/
│
├── controller/
│   ├── index.php              // Home (Questions list)
│   ├── addquestion.php        // Add Question
│   ├── users.php              // Users list
│   ├── adduser.php            // Add User
│   ├── edituser.php           // Edit User
│   ├── deleteuser.php         // Delete User
│   ├── modules.php            // Modules list
│   ├── addmodule.php          // Add Module
│   ├── editmodule.php         // Edit Module
│   ├── deletemodule.php       // Delete Module
│   ├── contact.php            // Contact form
│   ├── page_builder.php       // Create Page Types (Page Type 1 & "Lite" Page Type 2)
│   ├── dynamic_page.php       // Display records from a dynamic page
│   ├── dynamic_edit.php       // Edit record inside a dynamic page
│   └── dynamic_delete.php     // Delete record from a dynamic page
│
├── includes/
│   └── DatabaseConnection.php // PDO database connection
│
├── templates/
│   ├── layout.html.php        // Global layout (header, nav, footer)
│   ├── home.html.php          // Questions list view
│   ├── addquestion.html.php   // Add question form
│   ├── users.html.php         // Users list view
│   ├── user_form.html.php     // Add/Edit user form
│   ├── modules.html.php       // Modules list view
│   ├── module_form.html.php   // Add/Edit module form
│   ├── contact.html.php       // Contact page
│   ├── page_builder.html.php  // Page Builder UI
│   ├── dynamic_page.html.php  // Dynamic page record list
│   └── dynamic_form.html.php  // Add/Edit dynamic record form
│
├── public/
│   ├── styles.css             // Main UI styles + dark mode
│   └── theme.js               // Light/Dark mode switch
│
├── uploads/                   // Folder for uploaded images
│
└── README.md
```

---

## 🚀 Features

### ✔ Questions Module (Core Coursework Requirement)

* Add question with optional image upload
* Associate questions with Users & Modules
* Display questions as a formatted table
* Clean UI with Light/Dark theme support

### ✔ Users Management

* View user list
* Add user (separate form page)
* Edit user
* Delete user
* Email validation + duplicate email handling

### ✔ Modules Management

* List modules
* Add/Edit/Delete module
* Optional `description` field

### ✔ Contact Page

Provided as a simple contact form for coursework completeness.

### ✔ Page Builder System (Extended Feature)

The highlight of this version:

* Create new database-backed page types:

  * Text column (required)
  * Optional: Image column
  * Optional: Auto date column
  * Optional: userID (foreign key)
  * Optional: moduleID (foreign key)
* Automatically generates:

  * A database table
  * Foreign keys with ON DELETE CASCADE
  * A dynamic page list (`dynamic_page.php`)
  * Editing page (`dynamic_edit.php`)
  * Delete action (`dynamic_delete.php`)
* Automatically saves metadata in a `generated_page` table.

This system simulates how modern CMS platforms generate dynamic pages.

---

## 🛠 Installation

### 1. Import the database

Use phpMyAdmin to import the provided SQL file:

```
cw_builder.sql
```

### 2. Create the uploads folder

Make sure the folder exists:

```
cw_builder/uploads/
```

And ensure Apache/PHP has permission to write files (Windows usually works by default).

### 3. Run the project

Open:

```
http://localhost/COMP1841/cw_builder/controller/index.php
```

---

## 🌗 Light/Dark Theme

Implemented using:

* `theme.js`
* `styles.css` variables for both themes

Accessible via a toggle button in the top-left corner of the layout.

---

## 🧱 Coursework Requirements

This project demonstrates:

* PHP + MySQL using PDO
* Prepared statements
* Relational database design
* CRUD functionality
* Custom form validation
* Image upload handling
* Dynamic page generation (advanced feature)
* Web accessibility considerations
* Secure coding practices
* Clean, organized file structure

---

