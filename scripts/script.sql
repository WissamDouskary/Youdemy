CREATE DATABASE youdemy;

USE youdemy;

CREATE TABLE role (
    role_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255)
)

CREATE TABLE users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role_id INT,
    status ENUM('active', 'suspended', 'waiting'),
    FOREIGN KEY (role_id) REFERENCES role(role_id) ON DELETE CASCADE
);

CREATE TABLE categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE course_video (
    course_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    video TEXT NOT NULL,
    teacher_id INT NOT NULL,
    category_id INT,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (teacher_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES categories(category_id) ON DELETE CASCADE
);

CREATE TABLE course_text (
    course_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    content TEXT NOT NULL,
    teacher_id INT NOT NULL,
    category_id INT,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (teacher_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES categories(category_id) ON DELETE CASCADE
);

CREATE TABLE tags (
    tag_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE course_tags (
    course_id INT NOT NULL, 
    tag_id INT NOT NULL,
    PRIMARY KEY (course_id, tag_id),
    FOREIGN KEY (course_id) REFERENCES course_video(course_id) ON DELETE CASCADE,
    FOREIGN KEY (tag_id) REFERENCES tags(tag_id) ON DELETE CASCADE
);

CREATE TABLE enrollments (
    student_id INT NOT NULL,
    course_id INT NOT NULL, 
    inscription_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(student_id, course_id),
    FOREIGN KEY (student_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES course_video(course_id) ON DELETE CASCADE
);
