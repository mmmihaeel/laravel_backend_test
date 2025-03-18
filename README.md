# Laravel E-Commerce Application

This is a Laravel-based e-commerce web application built with Docker and MariaDB. The application provides a modern API for managing products, user comments, filters, and purchase history. It includes user registration and authentication features to ensure that only authorized users can perform certain actions.

## Features

- **User Authentication:**
  - Registration and login for users.
- **RESTful API for Products:**
  - **Create Product:** Add a new product.
  - **List Products:** Retrieve a list of available products.
  - **Update Product:** Modify product details.
  - **Delete Product:** Remove a product.
  - Each product may include: name, description, price, category, image, etc.
- **Product Comments:**
  - Authenticated users can add comments to products.
  - View, add, and delete comments.
- **Filters:**
  - Filter products by parameters such as category, price range, and popularity.
- **Purchase History:**
  - Users can view their purchase history.
  - Records include details like products purchased, date, and total amount.

## Technologies Used

- **Backend:** PHP (Laravel Framework)
- **Containerization:** Docker & Docker Compose
- **Database:** MariaDB
- **API:** RESTful endpoints

## Project Structure

```
your-project/
├── docker-compose.yml         # Docker Compose configuration
├── docker/
│   ├── laravel/
│   │   └── Dockerfile         # Dockerfile for the Laravel application
│   └── mariadb/
│       └── Dockerfile         # Dockerfile for MariaDB (customized if needed)
└── src/                       # Laravel project source code
    ├── app
    ├── bootstrap
    ├── config
    ├── database              # Migrations and seeds reside here
    ├── public
    ├── routes
    └── .env                  # Environment variables
```

## Installation & Running the Application

### Prerequisites

- Docker
- Docker Compose

### Steps to Set Up and Run

1. **Clone the Repository**

   ```sh
   git clone https://github.com/yourusername/your-repo-name.git
   cd your-repo-name
   ```

2. **Configure Environment Variables**

   Ensure that the `.env` file inside the `src/` folder contains the correct database settings. It should look similar to this:

   ```env
   DB_CONNECTION=mysql
   DB_HOST=mariadb
   DB_PORT=3306
   DB_DATABASE=laravel
   DB_USERNAME=laravel
   DB_PASSWORD=secret
   ```

3. **Build and Start Containers**

   Run the following command from the project root (where your `docker-compose.yml` is located):

   ```sh
   docker-compose up -d --build
   ```

   This command builds the images (if necessary) and starts the containers for both the Laravel application and MariaDB.

4. **Run Database Migrations**

   With the containers up and running, execute the Laravel migrations to set up the database schema:

   ```sh
   docker exec -it laravel_ecommerce_app php artisan migrate
   ```

5. **Access the Application**

   Open your web browser and navigate to [http://localhost:8000](http://localhost:8000) to see the Laravel application in action.

## API Endpoints

### Products API

- **Create a Product:** `POST /api/products`
- **Get All Products:** `GET /api/products`
- **Update a Product:** `PUT /api/products/{id}`
- **Delete a Product:** `DELETE /api/products/{id}`

### Comments API

- **List Comments:** `GET /api/products/{id}/comments`
- **Add a Comment:** `POST /api/products/{id}/comments`
- **Delete a Comment:** `DELETE /api/comments/{id}`

### Purchase History API

- **Get Purchase History:** `GET /api/user/purchases`

> **Note:** API endpoints are secured. You must authenticate (using Laravel Passport, Sanctum, or another authentication method) to perform operations like adding comments or viewing purchase history.

## Additional Information

- The project adheres to Laravel coding standards and utilizes OOP principles and design patterns for maintainability and scalability.
- The Docker setup ensures a consistent and easily deployable development environment.

## License

This project is licensed under the [MIT License](LICENSE).
