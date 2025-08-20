# QR Code Attendance System

## Introduction

HadirKu adalah platform manajemen kehadiran modern yang dirancang untuk memudahkan perusahaan, maupun organisasi dalam mencatat, memantau, dan menganalisis kehadiran secara real-time. Dengan sistem berbasis web dan fitur canggih seperti QR Code, laporan otomatis, notifikasi, dan analitik kehadiran, HadirKu membantu meningkatkan efisiensi, akurasi, dan transparansi dalam pengelolaan kehadiran.

## Presentation

For a visual overview and more details about the QR Code Attendance System App, please refer to our presentation:
[QR Code Attendance System App Presentation](https://www.figma.com/proto/GiQaXhGDYSyPdAVFQh2223/HadirKu-Website?node-id=7-285&p=f&t=0tQJcITOc653Pvfx-1&scaling=contain&content-scaling=fixed&page-id=3%3A4)

## Installation

Make sure you have Laravel 10 installed

### Step 1: Clone the Repository

```bash
git clone https://github.com/ahmdims/SEMESTA
cd SEMESTA
```

### Step 2: Install Dependencies

```bash
composer install
```

### Step 3: Set Up Environment File

```bash
php -r "file_exists('.env') || copy('.env.example', '.env');"
```

### Step 4: Configure the Database

Open the `.env` file and update the database connection settings:

Local Environment

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=semesta_db
DB_USERNAME=root
DB_PASSWORD=
```

Docker Environment [detailed installation info using Docker](https://github.com/ahmdims/SEMESTA/tree/main/docker)

```dotenv
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=semesta_db
DB_USERNAME=semesta_app
DB_PASSWORD=password
```

### Step 5: Generate Application Key

```bash
php artisan key:generate
```

### Step 6: Run Database Migrations

```bash
php artisan migrate
```

### Step 7: Seed the Database

```bash
php artisan db:seed
```

### Step 8: Link data from storage

```bash
php artisan storage:link
```

### Step 9: Start the Development Server

```bash
php artisan serve
```

Your QR Code Attendance System App application should now be up and running. You can access it at `http://127.0.0.1:8000`.

### Step 10: Tes Login

```bash
Email: admin@example.com
Password: 12345678
```

### Step 11: Docker Setup (Optional)

If you're using Docker, make sure you have Docker and Docker Compose installed, then run:

```bash
docker-compose up -d --build
```

Ensure your `.env` file is set to use Docker-based DB settings (as shown above).
