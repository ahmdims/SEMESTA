# Dockerfile Breakdown

This documentation explains the purpose of each part in the `Dockerfile` used to run a Laravel application inside a containerized environment.

## Dockerfile Contents

```Dockerfile
FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    default-mysql-client \
    libzip-dev \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install zip
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN useradd -G www-data,root -u 1000 -d /home/appuser appuser

WORKDIR /var/www

COPY . /var/www

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
```

## Prerequisites

Make sure the following tools are installed on your machine:

-   [Docker](https://www.docker.com/products/docker-desktop)
-   [Docker Compose](https://docs.docker.com/compose/)
-   Git
-   Laravel application files (already cloned or created)

## Step-by-Step Instructions

### 1. Clone the Project

```bash
git clone https://github.com/ahmdims/SEMESTA
cd SEMESTA
```

### 2. Prepare Your Environment

-   Copy the environment file:

```bash
cp .env.example .env
```

-   Update database config in `.env` based on Docker setup.

### 3. Build and Run Docker Containers

```bash
docker-compose up -d --build
```

-   `--build`: Rebuilds containers if necessary
-   `-d`: Runs containers in detached/background mode

### 4. Install Composer Dependencies

```bash
docker exec -it semesta-app composer install
```

### 5. Generate Application Key

```bash
docker exec -it semesta-app php artisan key:generate
```

### 6. Run Database Migrations (Optional)

```bash
docker exec -it semesta-app php artisan migrate
```

### 7. Access the Application

Open your browser and go to:

```
http://localhost:8000
```

You can also access phpMyAdmin at:

```
http://localhost:8080
```

> Login using:
>
> -   Server: `mysql`
> -   Username: `root`
> -   Password: `password`

### 8. Shut Down Docker Containers

When you're done working:

```bash
docker-compose down
```

## Summary of Common Commands

| Action                     | Command                                               |
| -------------------------- | ----------------------------------------------------- |
| Start & build containers   | `docker-compose up -d --build`                        |
| Install PHP dependencies   | `docker exec -it semesta-app composer install`         |
| Generate Laravel key       | `docker exec -it semesta-app php artisan key:generate` |
| Run database migrations    | `docker exec -it semesta-app php artisan migrate`      |
| Stop and remove containers | `docker-compose down`                                 |

## Notes

-   Ensure the Docker service names match those in your `docker-compose.yml` (e.g., `app`, `mysql`).
-   You can view running containers using:
    ```bash
    docker ps
    ```
