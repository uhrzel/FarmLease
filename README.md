# FarmLease Laravel Project

## 📌 Project Description

FarmLease is a Laravel-based application designed to manage farm lease agreements efficiently. This guide provides step-by-step instructions to set up the project, install dependencies, and run the development server.

---

## 🚀 Installation Guide

### 1️⃣ Clone the Repository

```bash
git clone https://github.com/uhrzel/FarmLease.git
cd FarmLease
```

### 2️⃣ Install PHP Dependencies (Composer)

Make sure you have [Composer](https://getcomposer.org/) installed.

```bash
composer install
```

### 3️⃣ Install JavaScript Dependencies (Node.js & NPM)

Ensure [Node.js](https://nodejs.org/) is installed, then run:

```bash
npm install
```

### 4️⃣ Environment Configuration

Copy the `.env.example` file and configure your environment:

```bash
cp .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

### 5️⃣ Set Up the Database

Edit the `.env` file with your database credentials:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3307
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

Then, run the migrations:

```bash
php artisan migrate
```

### 6️⃣ Run the Application

You can run the Laravel application and assets in a single Git Bash window:

```bash
php artisan serve & npm run dev
```

Alternatively, run them separately:

```bash
php artisan serve
```

In another terminal:

```bash
npm run dev
```

### 7️⃣ Access the Application

Once the server is running, open your browser and visit:

```
http://127.0.0.1:8000
```

---

## 🛠 Additional Commands

-   **Clear Cache & Config:**
    ```bash
    php artisan cache:clear
    php artisan config:clear
    php artisan route:clear
    php artisan view:clear
    ```
-   **Run Database Seeder:**
    ```bash
    php artisan db:seed
    ```
-   **Compile Frontend Assets for Production:**
    ```bash
    npm run build
    ```

---

## 📜 License

This project is licensed under the MIT License.

---

## 👤 Author

Developed by **uhrzel**

📌 Repository: [FarmLease](https://github.com/uhrzel/FarmLease)

---

## 📄 README.md File

This document serves as the official **README.md** file for the FarmLease Laravel project.
