# Australia University Library Management System (LMS)
## 📌 Overview
A web-based Australia University Library Management System built using PHP and MySQL. The system allows users to register, log in, browse books, borrow/return books, and enables admin-level book management, user management with secure session-based access.
## 🚀 Features
User registration and login system
Browse, borrow, and return books
Admin book management (add/update book status)
Session-based authentication and access control
Secure backend database operations
## 🛠️ Tech Stack
PHP • MySQL • SQL • HTML • CSS • phpMyAdmin
## 🗂️ Database Structure
users (id, name, email, password, role)
books (id, title, author, status, cover)
borrows (id, user_id, book_id, borrow_date, return_date)
## ⚙️ Setup Instructions
Import database into phpMyAdmin
Configure database_template.php with DB credentials
Run project using XAMPP local server
Access via browser
## 🔐 Security Features
Session-based authentication
Protected routes for borrow/return/admin pages
SQL injection prevention using prepared statements
## 🧪 Testing
Functional, database, security, and cross-browser compatibility testing were performed to ensure system reliability.
## 👨‍💻 Author
Valarmathy 
