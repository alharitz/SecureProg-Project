
---

# SecureProg-Project

This is a secure forum project built with Laravel 11, designed for user and admin management with a dark theme. The project includes authentication, CRUD functionality, and role-based access control (admin vs. normal users).

## Features
- Admin dashboard for managing users and posts
- User home for interacting with the forum
- Role-based access control
- Secure login and registration using Jetstream

---

## Requirements

- PHP >= 8.1
- Composer
- MySQL or MariaDB
- Node.js & NPM (for compiling assets)
- Laravel 11
- Jetstream (with Livewire)

---

## Installation

1. **Clone the Repository**
   ```bash
   git clone https://github.com/yourusername/SecureProg-Project.git
   cd SecureProg-Project
   ```

2. **Install PHP Dependencies**
   Make sure you have [Composer](https://getcomposer.org/) installed, and then run:
   ```bash
   composer install
   ```

3. **Install Node.js Dependencies**
   Install the Node.js dependencies for asset management:
   ```bash
   npm install
   ```

4. **Create and Configure the `.env` File**
   Create a copy of the `.env.example` file and name it `.env`:
   ```bash
   cp .env.example .env
   ```

   Then, open the `.env` file and update the following lines:

   ```bash
   DB_DATABASE=secure_prog
   DB_USERNAME=your_db_username
   DB_PASSWORD=your_db_password
   ```

5. **Generate Application Key**
   Laravel requires an application key for encryption, which can be generated by running:
   ```bash
   php artisan key:generate
   ```

6. **Set Up the Database**
   Make sure you have a MySQL database named `secure_prog`:

   ```sql
   CREATE DATABASE secure_prog;
   ```

   Then, run the migrations to create the necessary tables:
   ```bash
   php artisan migrate
   ```

7. **Seed the Database (Optional)**
   To populate the database with some sample data, you can run the database seeders:
   ```bash
   php artisan db:seed
   ```

8. **Compile the Assets**
   Compile the CSS and JavaScript files using Laravel Mix:
   ```bash
   npm run dev
   ```

---

## Running the Application

To start the application, use the following command:

```bash
php artisan serve
```

This will start the development server at `http://127.0.0.1:8000`.

---

## Usage

- **Admin Login:** After registration, you can manually set a user as an admin by updating the `is_admin` column in the database to `1`.
- **Admin Dashboard:** Admin users have access to a special dashboard where they can manage other users and posts.
- **User Home:** Regular users will be directed to their home page after login.

---

## Additional Commands

- **Clear Cache**
   If you run into issues, clear your Laravel cache:
   ```bash
   php artisan optimize:clear
   ```

- **Run Tests**
   To run the application's test suite:
   ```bash
   php artisan test
   ```

---

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

---

## Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

---
