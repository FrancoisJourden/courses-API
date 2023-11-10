## About
This project is a simple API to manage grocery shopping.

It's made using Laravel framework and REST principles.
## JWT
Don't forget to generate a JWT secret key
```shell
php artisan jwt:secret
```
If you regenerate your key, all existing tokens will be invalidated.
## Run
### Dependencies
Don't forget to run the following command with a valid internet connection :
```shell
composer install
```
### Define environment variables
define a valid PostgreSQL DB connection in a `.env` file (based on `.env.example`)
```dotenv
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=YourDatabase
DB_USERNAME=yourUsername
DB_PASSWORD=yourPassWord
```
### Run server
Then you can run it with
```shell
php artisan serve
```
or directly with your PHP server.
