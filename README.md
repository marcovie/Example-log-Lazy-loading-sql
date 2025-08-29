# Laravel Lazy Loading Demo

A practical demonstration of the N+1 query problem in Laravel and how to solve it using eager loading. This project includes automatic lazy loading detection that logs violations without breaking your application.

## 🎯 Purpose

This project demonstrates:

-   **N+1 Query Problem**: How lazy loading can cause performance issues
-   **Eager Loading Solution**: Using `with()` to optimize database queries
-   **Lazy Loading Detection**: Automatic logging of lazy loading violations
-   **Performance Comparison**: Visual comparison using Laravel Debugbar

## ⚠️ Important Notice

**This project is for educational purposes and has not been fully tested for production use.** The lazy loading detection code provided is a code example that could be adapted for production environments to find lazy loading issues, but it should be thoroughly tested and reviewed before being deployed to production systems.

## 🏗️ Project Structure

### Models

-   **Product** (`app/Models/Product.php`) - Products with name and description
-   **Price** (`app/Models/Price.php`) - Price history for products (50 prices per product)

### Controllers

-   **ProductsLazyController** (`app/Http/Controllers/ProductsLazyController.php`) - Demonstrates N+1 problem
-   **ProductsEagerController** (`app/Http/Controllers/ProductsEagerController.php`) - Shows optimized eager loading

### Database

-   **5 Products** with **50 prices each** (250 total price records)
-   **SQLite database** for easy setup and portability

### Lazy Loading Detection

-   **AppServiceProvider** (`app/Providers/AppServiceProvider.php`) - Logs lazy loading violations with detailed context

## 🚀 Setup Instructions

### 1. Clone the Repository

```bash
git clone <repository-url>
cd example-stop-lazy-loading
```

### 2. Install Dependencies

```bash
composer install -o
```

### 3. Environment Setup

```bash
# Copy environment file (already configured for SQLite)
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Database Setup

```bash
# Create the database directory if it doesn't exist
mkdir -p database

# Create the SQLite database file
touch database/database.sqlite

# Run migrations and seed the database
php artisan migrate:fresh --seed
```

This creates:

-   5 products (Laptop, Smartphone, Tablet, Desktop Computer, Headphones)
-   50 price records for each product (250 total)

### 5. Start the Application

```bash
# Option 1: Full development environment (recommended)
composer dev

# Option 2: Just the Laravel server
php artisan serve
```

## 🧪 Testing the Demo

### 1. Visit the Homepage

Open `http://localhost:8000` to see two comparison buttons:

-   **Red Button**: Products with Lazy Loading (N+1 Problem)
-   **Green Button**: Products with Eager Loading (Optimized)

### 2. Compare Performance

#### Lazy Loading (`/products-lazy`)

-   **Queries**: 6 total (1 for products + 5 for each product's prices)
-   **Problem**: Each product triggers a separate query for its prices

#### Eager Loading (`/products-eager`)

-   **Queries**: 2 total (1 for products + 1 for all prices)
-   **Solution**: All prices loaded in a single optimized query

### 3. View Performance Data

The **Laravel Debugbar** appears at the bottom of each page showing:

-   Total execution time
-   Memory usage
-   **Database queries** (click to see all queries)
-   Query timing details

## 📊 Code Comparison

### Lazy Loading (N+1 Problem)

```php
// ProductsLazyController.php
$products = Product::all(); // 1 query

foreach ($products as $product) {
    $product->prices->count(); // 5 additional queries (1 per product)
}
// Total: 6 queries
```

### Eager Loading (Optimized)

```php
// ProductsEagerController.php
$products = Product::with('prices')->get(); // 2 queries total

foreach ($products as $product) {
    $product->prices->count(); // No additional queries - data already loaded
}
// Total: 2 queries
```

## 🕵️ Lazy Loading Detection

### Automatic Monitoring

The project includes automatic lazy loading detection that:

-   **Monitors** all Eloquent model relationships
-   **Logs violations** without breaking the application
-   **Provides context** for easy debugging

### Log File Location

View lazy loading violations in:

```bash
storage/logs/laravel.log
```

### Sample Log Entry

```
[2025-08-29 15:12:05] local.ERROR: Lazy loading detected {"model":"App\\Models\\Product","model_id":1,"relation":"prices","file":"/home/marcovie/projects/example-stop-lazy-loading/app/Http/Controllers/ProductsLazyController.php","line":22,"url":"http://127.0.0.1:8000/products-lazy","method":"GET"}
```

### Log Information Includes:

-   **Model**: Which model triggered the lazy loading
-   **Model ID**: Specific model instance
-   **Relation**: Which relationship was lazy loaded
-   **File & Line**: Exact location in your code
-   **URL & Method**: Request context

## 🐛 Troubleshooting

### Database File Not Found Error

If you encounter the error:
```
Database file at path [database/database.sqlite] does not exist. Ensure this is an absolute path to the database.
```

**Solution:**
1. Create the database directory: `mkdir -p database`
2. Create the SQLite database file: `touch database/database.sqlite`
3. Run migrations: `php artisan migrate:fresh --seed`

### Vendor Directory Missing Error

If you encounter:
```
Failed to open stream: No such file or directory in .../vendor/autoload.php
```

**Solution:** Install dependencies first:
```bash
composer install -o
```

### Other Common Issues

- **Permission denied**: Ensure the `database` directory has write permissions
- **Path issues**: The `.env` file should have `DB_DATABASE=database/database.sqlite` (relative path from project root)
- **SQLite not installed**: Install SQLite3 on your system if missing

## 🛠️ Key Files Modified

### Database Configuration

-   **`.env`** - SQLite database configuration
-   **`.env.example`** - Template with SQLite setup

### Models & Relationships

-   **`app/Models/Product.php`** - Product model with `hasMany` prices relationship
-   **`app/Models/Price.php`** - Price model with `belongsTo` product relationship

### Migrations & Seeders

-   **`database/migrations/*_create_products_table.php`** - Products table schema
-   **`database/migrations/*_create_prices_table.php`** - Prices table schema with foreign key
-   **`database/seeders/ProductSeeder.php`** - Seeds 5 products with 50 prices each
-   **`database/seeders/DatabaseSeeder.php`** - Calls ProductSeeder

### Controllers

-   **`app/Http/Controllers/ProductsLazyController.php`** - Demonstrates N+1 problem
-   **`app/Http/Controllers/ProductsEagerController.php`** - Shows eager loading solution

### Routes & Views

-   **`routes/web.php`** - Routes for both controllers
-   **`resources/views/welcome.blade.php`** - Homepage with comparison buttons

### Lazy Loading Detection

-   **`app/Providers/AppServiceProvider.php`** - Configures lazy loading detection and logging

### Dependencies

-   **`composer.json`** - Added Laravel Debugbar for query visualization
-   **`package.json`** - Frontend dependencies

## 📚 Learning Outcomes

After exploring this project, you'll understand:

1. **N+1 Query Problem**: How innocent-looking code can cause performance issues
2. **Eager Loading**: Using `with()` to optimize database queries
3. **Performance Monitoring**: Using Laravel Debugbar to identify bottlenecks
4. **Lazy Loading Detection**: Implementing automatic monitoring in production
5. **Best Practices**: Writing efficient Eloquent queries

## 🎯 Production Tips

### Enable Lazy Loading Detection

The lazy loading detection is already configured in `AppServiceProvider.php`. **Important:** This code is provided as an educational example and should be thoroughly tested before production use.

For production consideration:

1. **Test thoroughly** in staging environments first
2. **Monitor logs** regularly for lazy loading violations
3. **Fix violations** by adding appropriate `with()` clauses
4. **Consider alerting** for critical performance issues
5. **Review performance impact** of the detection mechanism itself

### Performance Monitoring

-   Use Laravel Debugbar in development
-   Consider tools like Laravel Telescope for production debugging
-   Monitor database query counts and execution times
-   **Always test detection code** in non-production environments first

## 🤝 Contributing

Feel free to submit issues and pull requests to improve this educational example!

## 📄 License

This project is open source and available under the [MIT License](LICENSE).
