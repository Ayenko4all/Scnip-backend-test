## Scnip Product Sorting Test

## Requirements

To run the codebase on your local machine during development, you need to meet these base requirements:

- **PHP 8**
- Some PHP extensions: `redis mysql bcmath gmp curl intl openssl libxml`

## Setup

To set up the project locally,

- Clone the repository from source control.
- Navigate to the cloned repo on your computer using the CLI and do the following
    - Copy example env file to env `cp .env.example .env`.
    - Generate application key using `php artisan key:generate`.
    - Create a database in MySQL and enter its credentials in the `.env` file.
    - Install composer packages using `composer install`.
    - Run `php artisan db:seed` or `php artisan db:seed ProductSeeder` to seed product array into products table in the database.

    
## Test Endpoint
This can be find inside api route file


- URL {{base_url}}/api/products. Get method
-   Query parameter: `sort` pass `price` or`sales_to_view_ratio` as value
-   Extra parameters: `extra_sort` value `asc` and `desc` can be pass into `extra_sort` with price as `sort` to further sort price values if needed.
