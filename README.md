# 🎓 Student Registration System

## ITST 302 – Client-Server Technologies | Week 4 Laboratory Activity

A full-featured **Student Registration System** built with Laravel 12, MySQL, and Tailwind CSS. This project demonstrates server-side validation, file uploads, flash messages, and database integration — all key skills for enterprise web development.

---

## 📋 Table of Contents

1. [Introduction](#introduction)
2. [Objectives](#objectives)
3. [Laravel Request Lifecycle](#laravel-request-lifecycle)
4. [Validation Rules](#validation-rules)
5. [Database Design](#database-design)
6. [Registration Flowchart](#registration-flowchart)
7. [Screenshots](#screenshots)
8. [Problems Encountered](#problems-encountered)
9. [Solutions](#solutions)
10. [Reflection](#reflection)
11. [References](#references)

---

## 1. Introduction

### What is a Student Registration System?

A **Student Registration System** is a web application that allows students to sign up by providing their personal and academic information. It replaces paper-based enrollment forms with a digital process that is faster, more accurate, and easier to manage.

### Why is Data Validation Important?

Validation ensures that the data submitted through a form is **complete, correct, and secure**. Without validation:
- Users could submit blank forms
- Email addresses could be invalid
- Malicious users could upload harmful files
- The database could become filled with garbage data

### Role in Enterprise Applications

Registration systems are the **foundation of almost every enterprise web application** — from universities and hospitals to banks and e-commerce platforms. Every user account, patient record, or customer profile starts with a registration form. Learning to build them securely and correctly is essential for any junior developer.

---

## 2. Objectives

Upon completion of this activity, the following learning outcomes were achieved:

1. ✅ Develop HTML forms using Blade templates
2. ✅ Process client requests using Laravel controllers
3. ✅ Implement server-side validation using Laravel Validation Rules
4. ✅ Display flash messages for successful and failed operations
5. ✅ Upload and securely store files using Laravel Storage
6. ✅ Design and implement a relational database table using Laravel Migrations
7. ✅ Document software development processes using Markdown
8. ✅ Apply Git version control and portfolio-building practices

---

## 3. Laravel Request Lifecycle

When a user submits the registration form, here's how Laravel processes the request:

```
┌──────────────┐
│   Browser    │  User fills out the form and clicks "Register"
└──────┬───────┘
       │
       ▼
┌──────────────┐
│    Route     │  web.php matches /register → POST → StudentController@store
└──────┬───────┘
       │
       ▼
┌──────────────┐
│  Controller  │  StudentController::store() receives the Request object
└──────┬───────┘
       │
       ▼
┌──────────────┐
│  Validation  │  $request->validate([...]) checks all 11 fields
└──────┬───────┘
       │
    ┌──┴──┐
    │     │
   YES   NO
    │     │
    │     ▼
    │  ┌──────────────┐
    │  │  Return to   │  Form re-displayed with @error messages
    │  │  Form +      │
    │  │  Errors      │
    │  └──────────────┘
    │
    ▼
┌──────────────┐
│   Storage    │  Profile picture uploaded to storage/app/public/
└──────┬───────┘
       │
       ▼
┌──────────────┐
│  Database    │  Student record created in MySQL
└──────┬───────┘
       │
       ▼
┌──────────────┐
│  Flash Msg   │  "Student registered successfully!" stored in session
└──────┬───────┘
       │
       ▼
┌──────────────┐
│  Response    │  Redirect to /students/{id} — profile page
└──────────────┘
```

### Key Components:

| Layer | File | Role |
|-------|------|------|
| **Route** | `routes/web.php` | Maps URL to controller method |
| **Controller** | `app/Http/Controllers/StudentController.php` | Handles logic, validation, database |
| **Model** | `app/Models/Student.php` | Represents the `students` table |
| **View** | `resources/views/students/create.blade.php` | Registration form (Blade + Tailwind) |
| **View** | `resources/views/students/show.blade.php` | Student profile page |
| **Layout** | `resources/views/layouts/app.blade.php` | Master layout with nav, flash messages |
| **Migration** | `database/migrations/2026_08_27_063237_create_students_table.php` | Database table blueprint |

---

## 4. Validation Rules

| Field | Rule | Why It's Important |
|-------|------|--------------------|
| **Student ID** | `required, unique:students` | Every student must have a unique ID to avoid duplicate records |
| **First Name** | `required, string, max:100` | Names are required; limiting length prevents excessively long input |
| **Middle Name** | `nullable, string, max:100` | Optional field — not all students have a middle name |
| **Last Name** | `required, string, max:100` | Same as first name — required for identification |
| **Email** | `required, email, unique:students` | Valid email format ensures deliverability; uniqueness prevents duplicate accounts |
| **Mobile Number** | `required, numeric, digits_between:10,15` | Must be numeric (no letters). Length check ensures valid phone format |
| **Date of Birth** | `required, date` | Must be a valid date. Used for age verification and records |
| **Gender** | `required, in:Male,Female,Other` | Restricted to accepted values — prevents typos or invalid entries |
| **Program** | `required, string, max:100` | Required to know which course the student is enrolled in |
| **Year Level** | `required, string, max:20` | Required to track academic progress |
| **Address** | `required, string, max:500` | Required for contact purposes; length limit prevents abuse |
| **Profile Picture** | `required, image, mimes:jpeg,jpg,png, max:2048` | Only images allowed; specific formats; max 2MB file size to save server space |

---

## 5. Database Design

### Entity Relationship Diagram

```
┌───────────────────────────────────────────────────────────────┐
│                        students                               │
├───────────────────────────────────────────────────────────────┤
│  id                │  BIGINT (PK)   │  AUTO_INCREMENT         │
│  student_id        │  VARCHAR(255)  │  UNIQUE, NOT NULL       │
│  first_name        │  VARCHAR(100)  │  NOT NULL               │
│  middle_name       │  VARCHAR(100)  │  NULLABLE               │
│  last_name         │  VARCHAR(100)  │  NOT NULL               │
│  email             │  VARCHAR(255)  │  UNIQUE, NOT NULL       │
│  mobile_number     │  VARCHAR(15)   │  NOT NULL               │
│  date_of_birth     │  DATE          │  NOT NULL               │
│  gender            │  VARCHAR(10)   │  NOT NULL               │
│  program           │  VARCHAR(100)  │  NOT NULL               │
│  year_level        │  VARCHAR(20)   │  NOT NULL               │
│  address           │  TEXT          │  NOT NULL               │
│  profile_picture   │  VARCHAR(255)  │  NULLABLE               │
│  created_at        │  TIMESTAMP     │  AUTO                  │
│  updated_at        │  TIMESTAMP     │  AUTO                  │
└───────────────────────────────────────────────────────────────┘
```

### Table Structure

- **Primary Key:** `id` (auto-incrementing BIGINT)
- **Unique Constraints:** `student_id` and `email` — ensures no duplicate registrations
- **Data Types:** Appropriate types for each field (DATE for birth, VARCHAR for text, TEXT for address)
- **Indexes:** Laravel automatically indexes primary keys and unique columns

### SQL (Generated by Laravel Migration)

```php
Schema::create('students', function (Blueprint $table) {
    $table->id();
    $table->string('student_id')->unique();
    $table->string('first_name', 100);
    $table->string('middle_name', 100)->nullable();
    $table->string('last_name', 100);
    $table->string('email')->unique();
    $table->string('mobile_number', 15);
    $table->date('date_of_birth');
    $table->string('gender', 10);
    $table->string('program', 100);
    $table->string('year_level', 20);
    $table->text('address');
    $table->string('profile_picture', 255)->nullable();
    $table->timestamps();
});
```

---

## 6. Registration Flowchart

```
┌──────────────────────┐
│   User Opens Page    │
│   GET /register      │
└──────────┬───────────┘
           │
           ▼
┌──────────────────────┐
│   Fill Out Form      │
│   11 fields + image  │
└──────────┬───────────┘
           │
           ▼
┌──────────────────────┐
│   Click "Register"   │
│   POST /register     │
└──────────┬───────────┘
           │
           ▼
┌──────────────────────────────────┐
│         Laravel Validation       │
│  Checks all rules for each field │
└──────────┬───────────────────────┘
           │
     ┌─────┴─────┐
     │           │
   VALID       INVALID
     │           │
     │           ▼
     │    ┌──────────────────────┐
     │    │  Return to Form      │
     │    │  Show @error         │
     │    │  messages per field  │
     │    └──────────────────────┘
     │
     ▼
┌──────────────────────┐
│  Upload Profile Pic  │
│  → storage/app/public│
│  Save path in DB     │
└──────────┬───────────┘
           │
           ▼
┌──────────────────────┐
│  Save to MySQL       │
│  INSERT INTO students│
└──────────┬───────────┘
           │
           ▼
┌──────────────────────┐
│  Flash Message       │
│  "Student registered │
│   successfully!"     │
└──────────┬───────────┘
           │
           ▼
┌──────────────────────┐
│  Redirect to Profile │
│  GET /students/{id}  │
│  Display all info +  │
│  uploaded picture    │
└──────────────────────┘
```

---

## 7. Screenshots

*(See the `screenshots/` folder for full-size images)*

| # | Screenshot | Description |
|---|-----------|-------------|
| 1 | Registration Form | The complete form with all 11 fields |
| 2 | Validation Errors | Error messages displayed when invalid data is submitted |
| 3 | Flash Success Message | Green banner after successful registration |
| 4 | Uploaded Profile Picture | Image displayed on profile page |
| 5 | Student Profile Page | Full student details after registration |
| 6 | Database Records | MySQL table showing stored student data |
| 7 | Project Structure | VS Code showing the Laravel project tree |
| 8 | GitHub Repository | Public repository on GitHub |
| 9 | Terminal Output | Artisan commands and server running |

---

## 8. Problems Encountered

### Problem 1: Storage Link Not Created
The `php artisan storage:link` command was not run initially, so uploaded profile pictures returned a 404 error when the browser tried to display them.

### Problem 2: Validation Errors Not Appearing
When submitting invalid data, the form redirected back but the error messages were not displayed. The `@error` directives in the Blade template were missing the `$message` variable.

### Problem 3: CSRF Token Expiration
During testing with curl, the CSRF token expired between fetching the form and submitting it, causing a 419 "Page Expired" error. This doesn't happen in a real browser but was confusing during automated testing.

---

## 9. Solutions

### Solution 1: Create Storage Symlink
```bash
php artisan storage:link
```
This creates a symbolic link from `public/storage` to `storage/app/public`, making uploaded files accessible via a URL like `http://localhost:8000/storage/profile_pictures/image.jpg`.

### Solution 2: Add @error Directives
Added `@error('field_name')` directives after every input field in the Blade template, plus a summary block at the top:
```blade
@error('field_name')
    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
@enderror
```

### Solution 3: Cookie Jar for Testing
For curl testing, used a cookie jar (`-c cookies.txt -b cookies.txt`) to maintain the session across requests, keeping the CSRF token valid.

---

## 10. Reflection

### The Importance of Validation

Before this project, I understood validation as just "making sure fields aren't empty." Now I realize it's **much more** — it's a critical security and data integrity layer. Each validation rule serves a specific purpose:

- **`required`** prevents incomplete records
- **`unique`** stops duplicate entries
- **`email`** ensures valid contact information
- **`image`** and **`mimes`** block malicious file uploads
- **`max:2048`** prevents server storage abuse

### Lessons Learned About Handling User Input

User input is **untrustworthy**. Users make typos, skip fields, and sometimes try to exploit forms. Server-side validation is the **last line of defense** — even if client-side JavaScript validation is bypassed, the server catches everything. This project taught me to:
- Always validate on the server, never trust the client
- Store files with secure paths, not user-supplied filenames
- Use flash messages to give clear feedback
- Keep models and controllers clean with `$fillable` and Form Requests

### Server-Side vs Client-Side Validation

| Aspect | Client-Side (JS) | Server-Side (Laravel) |
|--------|------------------|----------------------|
| Speed | Instant feedback | After form submission |
| Security | Can be bypassed | Cannot be bypassed |
| User Experience | Good for quick hints | Essential for security |
| Reliability | Low | High |

Both are useful, but **server-side validation is mandatory** for any production application.

### File Security in Web Applications

Uploading files is one of the most dangerous operations in web development. Laravel's Storage system mitigates this by:
- Storing files outside the public web root
- Using randomly generated filenames (not user-supplied ones)
- Allowing only specific MIME types
- Enforcing file size limits

### Real-World Enterprise Usage

Every major web application relies on registration systems — Google, Facebook, Amazon, university portals, healthcare systems, and banking apps. The pattern is always the same: **form → validation → storage → feedback**. Mastering this flow is the foundation for building any data-driven web application.

---

## 11. References

Laravel LLC. (2024). *Laravel Documentation – Validation*. https://laravel.com/docs/validation

Laravel LLC. (2024). *Laravel Documentation – File Storage*. https://laravel.com/docs/filesystem

Laravel LLC. (2024). *Laravel Documentation – Migrations*. https://laravel.com/docs/migrations

PHP Documentation Group. (2024). *PHP Manual*. https://www.php.net/manual/

MySQL Documentation. (2024). *MySQL 8.0 Reference Manual*. https://dev.mysql.com/doc/refman/8.0/en/

Tailwind Labs. (2024). *Tailwind CSS Documentation*. https://tailwindcss.com/docs

MDN Web Docs. (2024). *HTML Forms Guide*. https://developer.mozilla.org/en-US/docs/Learn/Forms

---

## 📁 Project Structure

```
week04-student-registration/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── StudentController.php
│   │   └── Controller.php
│   └── Models/
│       └── Student.php
├── database/
│   └── migrations/
│       └── 2026_08_27_063237_create_students_table.php
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php
│       └── students/
│           ├── create.blade.php
│           └── show.blade.php
├── routes/
│   └── web.php
├── screenshots/
├── documentation/
├── storage/
│   └── app/
│       └── public/
│           └── profile_pictures/
├── README.md
├── composer.json
├── package.json
├── vite.config.js
└── tailwind.config.js
```

---

## 🚀 How to Run

```bash
# 1. Install dependencies
composer install
npm install

# 2. Configure .env (MySQL database)
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=student_registration
DB_USERNAME=root
DB_PASSWORD=1234

# 3. Create database
mysql -u root -p1234 -e "CREATE DATABASE student_registration"

# 4. Run migrations
php artisan migrate

# 5. Create storage link
php artisan storage:link

# 6. Build frontend
npm run build

# 7. Start the server
php artisan serve

# 8. Visit http://localhost:8000/register
```

---

> *Built with Laravel 12, MySQL 8.0, Tailwind CSS v4, and Vite.*
> *ITST 302 – Client-Server Technologies | Week 4 Laboratory Activity*