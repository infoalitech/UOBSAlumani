# PHP CRUD Application

## Overview
This project is a PHP CRUD application that implements a login system and provides functionality for managing blogs, news articles, and job postings. It features a user authentication system, allowing users to register, log in, and log out. The application also includes pages for viewing blogs, news, and job postings, as well as a detailed view for each job.

## Project Structure
```
php-crud-app
├── public
│   ├── index.php            # Entry point of the application
│   ├── login.php            # User login form
│   ├── logout.php           # User logout functionality
│   ├── register.php         # User registration form
│   ├── home.php             # Home page
│   ├── blogs.php            # List of blogs
│   ├── news.php             # List of news articles
│   ├── jobs.php             # List of job postings
│   ├── job_detail.php       # Job detail page
│   ├── css
│   │   └── styles.css       # CSS styles
│   └── js
│       └── scripts.js       # JavaScript functionality
├── src
│   ├── config
│   │   └── database.php     # Database connection configuration
│   ├── controllers
│   │   ├── AuthController.php # Handles user authentication
│   │   ├── BlogController.php # Manages blog CRUD operations
│   │   ├── NewsController.php # Manages news CRUD operations
│   │   ├── JobController.php  # Manages job CRUD operations
│   │   └── HomeController.php # Manages home page content
│   ├── models
│   │   ├── User.php          # User model
│   │   ├── Blog.php          # Blog model
│   │   ├── News.php          # News model
│   │   └── Job.php           # Job model
│   └── views
│       ├── auth
│       │   ├── login.php     # Login view
│       │   ├── register.php  # Registration view
│       │   └── logout.php    # Logout confirmation view
│       ├── home.php          # Home page view
│       ├── blogs.php         # Blogs view
│       ├── news.php          # News view
│       ├── jobs.php          # Jobs view
│       └── job_detail.php    # Job detail view
├── migrations
│   └── create_tables.sql     # SQL script to create database tables
├── .htaccess                 # URL rewriting and server configuration
├── composer.json             # Composer dependencies
└── README.md                 # Project documentation
```

## Features
- User authentication (registration, login, logout)
- CRUD operations for blogs, news articles, and job postings
- Responsive design with CSS styling
- JavaScript functionality for enhanced user experience

## Installation
1. Clone the repository to your local machine.
2. Navigate to the project directory.
3. Run `composer install` to install dependencies.
4. Set up your database and run the SQL script located in `migrations/create_tables.sql`.
5. Configure your database connection in `src/config/database.php`.
6. Start your local server and access the application via `public/index.php`.

## Usage
- Visit the home page to navigate through the application.
- Use the login and registration forms to manage user accounts.
- Access the blogs, news, and jobs pages to view and manage content.

## Contributing
Contributions are welcome! Please submit a pull request or open an issue for any suggestions or improvements.

## License
This project is open-source and available under the MIT License.