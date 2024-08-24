# Svadharmam Management System



## Overview

The **Svadharmam Management System** is a PHP and MySQL-based application designed to manage detailed information related to ISKCON (International Society for Krishna Consciousness) devotees. The system allows administrators to create, view, and manage devotee profiles with various details, and supports role-based access control to ensure proper access levels for different types of users.

## Features

- **User Authentication**: Users can log in using either email or user ID. Roles are assigned to manage access to different functionalities.
- **Profile Management**: Admins can create, view, edit, and delete profiles. Each profile contains detailed information about the devotee.
- **Role-Based Access Control**: Only users with the role of `admin` or `counselor` can access certain functionalities. Unauthorized users are redirected to an access warning page.
- **Responsive Design**: The system uses Bootstrap for a responsive user interface, including profile cards and modals.

## Technologies Used

- **PHP**: Server-side scripting language.
- **MySQL**: Database management system.
- **Bootstrap**: Front-end framework for responsive design.
- **PDO (PHP Data Objects)**: For secure database interactions.

## Installation

### Prerequisites

- PHP 7.4 or higher
- MySQL 5.7 or higher
- A web server such as Apache or Nginx

### Steps

1. **Clone the Repository**

   ```bash
   git clone https://github.com/yourusername/svadharmam-management-system.git
   cd svadharmam-management-system
   ```

2. **Create the Database**

   - Create a new MySQL database named `svadharmam_db`.

3. **Import the Database Schema**

   - Import the SQL schema provided in `schema.sql` into your `svadharmam_db` database.

4. **Configure Database Connection**

   - Update the `config.php` file with your database connection details.

     ```php
     <?php
     $host = 'localhost';
     $db = 'svadharmam_db';
     $user = 'your_db_user';
     $pass = 'your_db_password';
     $charset = 'utf8mb4';

     $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
     $options = [
         PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
         PDO::ATTR_EMULATE_PREPARES => false,
     ];

     try {
         $conn = new PDO($dsn, $user, $pass, $options);
     } catch (\PDOException $e) {
         throw new \PDOException($e->getMessage(), (int)$e->getCode());
     }
     ?>
     ```

5. **Set Up the Web Server**

   - Place the project files in the web server's root directory.

6. **Access the Application**

   - Open your web browser and navigate to `http://localhost` (or the appropriate URL based on your setup).

## Usage

### User Roles

- **Admin**: Can create, view, edit, and delete profiles. Manage user roles and permissions.
- **Counselor**: Can view profiles and manage them if necessary.
- **User**: Standard user role with restricted access.

### Key Pages

- **`index.php`**: Home page or landing page of the application.
- **`login.php`**: User login page.
- **`create_profiles.php`**: Form to create new profiles.
- **`view_profiles.php`**: Page to view and search profiles.
- **`edit_profile.php`**: Form to edit existing profiles.
- **`noaccess.php`**: Access denied page for unauthorized users.

### Modals and Forms

- **Profile View Modal**: Displays detailed profile information with options to edit or delete.
- **Edit Profile Form**: Allows modification of profile details, available only to admins.

## Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository.
2. Create a new branch (`git checkout -b feature/YourFeature`).
3. Commit your changes (`git commit -am 'Add new feature'`).
4. Push to the branch (`git push origin feature/YourFeature`).
5. Create a new Pull Request.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Contact

For any questions or support, please reach out to [your-email@example.com](mailto:your-email@example.com).

---

Feel free to adjust the repository URL, database configuration details, and contact information to fit your project's specifics.