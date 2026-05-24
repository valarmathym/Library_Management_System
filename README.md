# Australia University Library Management System (LMS)
## You tube video Link on Blackbox Testing(Functional Testing) & Database Testing of the LMS
     https://youtu.be/63wRn4-VNFI              
 ## Security and Compatibility Testing of the LMS  
    https://youtu.be/F5uroVdligU
## 📌 Overview
A full-stack web development project using PHP, MySQL, HTML, and CSS that implements a Library Management System with user authentication, database operations, and admin-controlled book management. The system allows users to register, log in, browse books, borrow/return books, and enables admin-level book management, user management with secure session-based access.
## 🚀 Features
User registration and login system
Browse, borrow, and return books
Admin book management (add/update book status)
Session-based authentication and access control
Secure backend database operations
## 🛠️ Tech Stack
PHP • MySQL • SQL • HTML • CSS • phpMyAdmin
## Usecase Diagram

<img width="400" height="300" alt="image" src="https://github.com/user-attachments/assets/e703e271-2924-46ea-a08a-aef19cfde1bf" />

## Story Board 
<img width="400" height="300" alt="image" src="https://github.com/user-attachments/assets/4116a34c-8198-470a-93e4-bb459c94b143" />

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
