**Running the project**
-
Clone the git repo form github

    git clone git@github.com:nozhdelov/amp-task.git

Use composer to install the dependencies 

    composer install

Use npm to install the node packages 

    node install

Build the static resources

    npm run build

Create an empty database and fill its credentials in the .env file
Optionally use the log mail handler  MAIL_MAILER=log

 Run the migrations
 
    php artisan migrate

Optionally run the seeder to insert some fake data for the last 10 days
 
    php artisan db:seed

Start the local server
 
    php artisan serve

To run the tests

     php artisan test

The "App\Jobs\CollectPrices" job is configured to run every hour with the scheduler but can also be ran manually trough the "prices:collect" command

    php artisan prices:collect BTCUSD

