
CREATE DATABASE IF NOT EXISTS lms;


USE lms;



CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fname VARCHAR(50) NOT NULL,
    lname VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(50)  DEFAULT 'role'
);

CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fname VARCHAR(50) NOT NULL,
    lname VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(50)  DEFAULT 'admin'
);


 CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    publisher VARCHAR(255),
    language VARCHAR(100) DEFAULT 'English',
    category VARCHAR(100),
    image VARCHAR(255), 
    availability INT DEFAULT 3
)

CREATE TABLE borrow_books (
       id INT AUTO_INCREMENT PRIMARY KEY,
        user_id VARCHAR(50) NOT NULL,
        book_id VARCHAR(50) NOT NULL ,
        borrow_date DATE NOT NULL,
        due_date DATE NOT NULL,
        status VARCHAR(50) DEFAULT 'On Loan'
        
)
ALTER TABLE borrow_books
ADD COLUMN return_date DATE;



INSERT INTO admin (fname, lname, email, password, role) VALUES ('Admin', 'Lastname', 'admin@gmail.com', 'Abcde@1234', 'admin');
INSERT INTO admin (fname, lname, email, password, role) VALUES ('AdminLMS', 'AdminLastname', 'adminlms@gmail.com', '$2y$10$HnvvwOH.rXknHaLIs9qpceZHlAidMZxfEv1y.7jVxH423f092AbQ2', 'admin');

INSERT INTO admin (fname, lname, email, password, role) VALUES ('Nancy', 'Bob', 'nancy@gmail.com', 'Good_pass@3','admin'); 
 

ALTER TABLE books ADD COLUMN image BLOB;

INSERT INTO books (title, author, publisher, language, category, image) VALUES ('Great Expectations', 'Charles Dickens', 'Macmillan collectors library',
'English', 'Fiction', '../img/book_1.png'),
('An Inconvenient Truth', 'Al gore', 'Penguin books','English', 'Non-Fiction','../img/book_2.png'),
('Oxford Dictionary', 'Oxford press', 'Oxford press','English', 'Reference', '../img/book_.3png'),
('Anna Karenina', 'Leo Tolstoy', 'Star publishing','Russian', 'Fiction', '../img/book_4.png'),
('The tale of Genji', 'Murasaki Shikibu', 'Kinokuniya','Japanese', 'Fiction', '../img/book_5.png');



