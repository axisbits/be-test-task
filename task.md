# Project Description

## Key Project Points

### Architecture

The project is a **Laravel API application** that follows these design patterns:

* **Repository Pattern** – data-access layer (Prettus L5 Repository)
* **Transformer Pattern** – formatting API responses (League Fractal)
* **Policy Pattern** – access-control management
* **Request Pattern** – validating incoming data
* **Enum Pattern** – typed constants (BenSampo Laravel Enum)

### Tech Stack

* **PHP 8.4+**
* **Laravel 12.x**
* **Laravel Sanctum** – API authentication
* **SQLite** – database
* **PHPStan** – static analysis
* **PHP CS Fixer** – code formatting
* **Postman** – API testing

### Project Structure

```text
app/
├── Criteria/         # Data-filtering criteria
├── Enums/            # Typed constants
├── Http/
│   ├── Controllers/  # API controllers
│   └── Requests/     # Request validation
├── Models/           # Eloquent models
├── Policies/         # Access policies
├── Repositories/     # Data repositories
└── Transformers/     # Response transformers
├── database/
│   ├── factories/    # Test factories
│   ├── migrations/   # Migrations
│   └── seeders/      # Seeders
├── routes/api        # API routes
├── tests/            # Tests
├── .env              # Environment variables
├── .env.example      # Example environment variables
├── .phpstan.neon     # Static-analysis settings
├── .php-cs-fixer.php # Code-style settings
```

### Roles & Permissions

* **admin** – full access to all operations
* **user** – limited access (only their own data)

## Implemented Endpoints

### Authentication

* `POST /auth/login` – log in

### Users

* `GET /users` – list users
* `POST /users` – create user
* `GET /users/{id}` – view user
* `PUT /users/{id}` – update user
* `DELETE /users/{id}` – delete user

### Companies

* `GET /companies` – list companies
* `POST /companies` – create company
* `GET /companies/{id}` – view company
* `PUT /companies/{id}` – update company
* `DELETE /companies/{id}` – delete company

### Data Structure

#### Users

* `id` – unique identifier
* `first_name` – first name
* `last_name` – last name
* `email` – e-mail (unique)
* `password` – hashed password
* `role` – role (admin/user)
* `email_verified_at` – e-mail verification date
* `created_at`, `updated_at` – timestamps

#### Companies

* `id` – unique identifier
* `user_id` – linked user
* `name` – company name
* `email` – company e-mail
* `phone` – phone
* `address` – address
* `city` – city
* `state` – state/region
* `created_by` – who created the company
* `created_at`, `updated_at` – timestamps

---
# Task for a PHP Developer

## Objective

Implement full CRUD operations for two new entities: **Shops** and **Products**, strictly following the project’s design patterns.

**⚠️ Important note:** Shops and products have a **many-to-many** relationship. A product can be sold in several shops, and a shop can sell many products. Price, stock quantity, and availability may vary per shop.

## Implementation Requirements

### 1. Models & Migrations

#### Shop model

**Fields:**

* company relation (required)
* shop name (required, max 255 chars, unique)
* shop e-mail (nullable, valid e-mail)
* active flag (boolean, default true)
* opening hours (optionally specify weekdays and “from–to” times)
* created by

#### Product model

**Fields:**

* product name (required, max 255 chars)
* SKU/article (nullable, unique, max 100 chars)
* created by

### 2. API Endpoints

#### Shops

* list shops (paginated)
* create shop
* view shop with products
* update shop
* delete shop

#### Products

* list products (paginated + filtered)
* create product
* view product
* update product
* delete product

#### Product–Shop linking

* link product to shop
* update product data in shop
* unlink product from shop
* list products in a shop
* list shops selling a product

### 3. Validation

#### Creating/Editing a shop

* company is required only for **admin**; must exist in `companies`. For **user**, use their company
* name required, string, max 255, unique within the company
* e-mail optional, valid e-mail
* opening hours optional; can list multiple weekdays with “from–to” times

#### Creating/Editing a product

* name required, string, max 255
* SKU optional, string, max 100, unique among products

#### Linking a product to a shop

* shop required
* product required
* price required
* quantity optional
* availability flag optional

### 4. Access Policies

#### Admin

* may manage all shops and products

#### User

* may manage only their own shops and products

### 5. Repositories

* Every repository extends the base `Repository`

### 6. Transformers

* All responses must be JSON

#### Shop list – returns

```sh
- Shop name
- Opening hours
- Number of products in the shop
```

#### Shop view – returns

```sh
- Shop name
- Opening hours
- Company name and address
- Number of products in the shop
```

#### Product list – returns

```sh
- Product name
- Product SKU
```

#### Product view – returns

```sh
- Product name
- Product SKU
- Shops selling the product with prices and quantities
```

### 7. Filtering Criteria

#### Shop list

* Search by shop name

#### Product list

* Search by price range (from / to)

### 8. Additional Requirements

#### Tests (optional)

* Feature tests for all CRUD operations
* Authorization & policy tests
* Validation tests

#### Documentation

* Update the Postman collection with new endpoints
* Add sample requests and responses

## Evaluation Criteria

* **Compliance with project architecture patterns**
* **Code quality** and PSR standards
* **Completeness** of the implementation
* **Correct authorization** and policies
* **Validation quality** for incoming data
* **Test coverage** of core functionality
* **Documentation** of code and API endpoints

Good luck with the task! 🚀