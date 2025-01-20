# Youdemy Project

## Description

This project is a Learning Management System (LMS) named **Youdemy**, designed to facilitate the management of courses, users, and educational content. The application offers tailored functionalities for different user roles: visitors, students, teachers, and administrators. 

## Features

### Front Office

#### Visitor
- Access the course catalog with pagination.
- Search for courses using keywords.
- Create an account and choose a role (Student or Teacher).

#### Student
- View the course catalog.
- Search and view course details (description, content, teacher, etc.).
- Enroll in courses after authentication.
- Access the "My Courses" section to manage enrolled courses.

#### Teacher
- Add new courses with details:
  - Title, description, content (video or document), tags, and category.
- Manage courses:
  - Edit, delete, and view enrolled students.
- Access a "Statistics" section:
  - Number of enrolled students, total courses created, etc.

### Back Office

#### Administrator
- Validate teacher accounts.
- Manage users:
  - Activate, suspend, or delete users.
- Manage content:
  - Courses, categories, and tags.
  - Bulk insert tags for efficiency.
- Access global statistics:
  - Total courses, distribution by category, most popular course by enrollment, Top 3 teachers.

### Cross-Cutting Features
- Courses can have multiple tags (many-to-many relationship).
- Implements polymorphism in methods such as adding and displaying courses.
- Authentication and authorization system to secure sensitive routes.
- Role-based access control to ensure users can only access features corresponding to their role.

## Technical Requirements

- Adherence to Object-Oriented Programming principles (encapsulation, inheritance, polymorphism).
- Relational database with proper management of relationships (one-to-many, many-to-many).
- Use of PHP sessions for managing authenticated users.
- User data validation for enhanced security.

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/WissamDouskary/Youdemy.git
   ```
2. Navigate to the project directory:
   ```bash
   cd Youdemy
   ```
3. Set up the database:
   - Import the provided SQL file in your database management system.
   - Configure database credentials in the project.
4. Start a local server:
   ```bash
   php -S localhost:8000
   ```
5. Access the application in your browser at [http://localhost:8000](http://localhost:8000).

## Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository.
2. Create a new branch:
   ```bash
   git checkout -b feature-name
   ```
3. Commit your changes:
   ```bash
   git commit -m "Add feature description"
   ```
4. Push to the branch:
   ```bash
   git push origin feature-name
   ```
5. Submit a pull request.

## License

This project is licensed under the [MIT License](LICENSE).

## Acknowledgements

- Thank you to all contributors for helping improve the project.
