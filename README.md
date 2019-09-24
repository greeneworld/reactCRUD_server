# Restful API In Laravel 5.6 Using jwt Authentication
> How to install
 - Clone the repository
 - Set up database credentials in .env file
 - Run `php artisan migrate` to migrate the database
 - Run `composer update`

Read the tutorial at [Restful API In Laravel 5.6 Using jwt Authentication](https://tutsforweb.com/restful-api-in-laravel-56-using-jwt-authentication)

Learn more about at [https://tutsforweb.com](https://tutsforweb.com)

-install backend
# composer install
# cp .\.env.example .env     //create the .env file.
# php artisan key:generate

Create the database.
Modify the database name, username and password in .env file
	DB_DATABASE=your_db_name
	DB_USERNAME=your_db_username (default: root)
	DB_PASSWORD=your_db_password (default: empty)
# php artisan migrate
# php artisan db: seed
# php artisan jwt:secret

Insert the API informations(facebook, google) for social login
at the end of the .env file.
	FACEBOOK_ID=facebook_api_id
	FACEBOOK_SECRET=facebook_secret_key
	FACEBOOK_URL=<YOUR_SERVER_ROOT>/login/facebook

GOOGLE_ID=google_api_id
GOOGLE_SECRET=google_secret_key
	GOOGLE_URL=<YOUR_SERVER_ROOT>/login/google
	
for example (in our project)
	FACEBOOK_ID=513184806112725
	FACEBOOK_SECRET=cb6542930fcf77e2a8d8bf413f583cb9
	FACEBOOK_URL=http://localhost:3000/login/facebook

	GOOGLE_ID=298747513453-fsq0ec7jdivs16cqn6fsghl0hr0t9fn4.apps.googleusercontent.com
	GOOGLE_SECRET=3CmO6jCl_AXezlmjNwFipRo9
	GOOGLE_URL=http://localhost:3000/login/google
(when hosting the frontend and backend, replace the localhost:3000 with your_server_root)	
# php artisan serve (for local server)

-install frontend.
# npm install
# npm start
