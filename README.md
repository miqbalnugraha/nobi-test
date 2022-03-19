## Installation

- Clone this repository to your localhost folder (inside htdocs if you're using xampp)
- Inside your project folder, open the terminal and "run composer update"
- Run "copy .env.example .env"
- Run "php artisan key:generate"
- Don't forget make a database for your project at localhost/phpmyadmin. You can name it anything (ex: nobi_test)
- Once the database is created, you can make adjustments to the database settings in the ".env" file
- Back to your terminal, run "php artisan migrate"
- Run "php artisan db:seed"
- Lastly run "php artisan serve"
- Import nobi-test.postman_collection.json to Postman