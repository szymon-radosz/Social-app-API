configure cloned repo

1. configure .env

APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=8889
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587  
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls
MAIL_FROM_NAME=

2. composer install
3. php artisan key:generate
4. php artisan migrate
5. php artisan passport:install
6. php artisan vendor:publish --provider="Intervention\Image\ImageServiceProviderLaravel5"

create test environment:

1. touch database/test.sqlite
2. create .env.testing

APP_NAME=Laravel
APP_ENV=testing
APP_KEY=base64:5CpEFQ9UTR543dbJUsT3araoSSyxuN8NF92gCJJXpk8=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack

DB_CONNECTION=sqlite
DB_DATABASE=database/test.sqlite

BROADCAST_DRIVER=log
CACHE_DRIVER=array
SESSION_DRIVER=array
SESSION_LIFETIME=120
QUEUE_DRIVER=sync

MAIL_DRIVER=smtp

3. php artisan migrate --env=testing
4. create unit test with command: php artisan make:test TestName --unit
5. run tests with command: ./vendor/bin/phpunit

Adding factories and seeds

1. php artisan make:factory TestFactory

$factory->define(App\Test::class, function (Faker $faker) {
return [
'name' => $faker->text($min=5, $max=10)
];
});

2. php artisan make:seeder TestSeeder

public function run()
{
//create 10 elements
factory(App\Test::class, 10)->create();
}

3. composer dump-autoload

Looks for all of the classes it needs to include again. It just regenerates the list of all classes that need to be included in the project

4. php artisan db:seed --class=TestSeeder
