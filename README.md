This demo uses Laravel+React+Typescript

## Configure environment variables
```
cp .env.example .env
```
and point `LEGOOM_ID_URL` to the [Legoom ID server](https://github.com/marcorentap/legoom-id-demo).

## Execute
Install dependencies and generate passport keys
```
composer install
php artisan key:generate
npm install && npm run build
```

Setup sail's docker environment and choose a database service.
```bash
php artisan sail:install
```

Then replace `vendor/laravel/passport/src/Http/Controllers/AuthorizationControl` with [this AuthorizationController](https://gist.github.com/marcorentap/740046418fa270146ab0302b7067843b) (quick hack).

If you are also running Legoom ID locally, you might want to change the published ports in `docker-compose.yml` to avoid clashes. Then execute
```
./vendor/bin/sail up
```

In another terminal, run
```
./vendor/bin/sail artisan migrate
```

By default, the application will be available on [http://localhost](http://localhost)
