This demo uses Laravel+React+Typescript

## Configure environment variables
```
cp .env.example .env
```
Set the `LEGOOM_ID_URL` to the [Legoom ID server URL](https://github.com/marcorentap/legoom-id-demo). Then, set `LEGOOM_CLIENT_ID` and `LEGOOM_CLIENT_SECRET` to the corresponding [client ID and secret](https://github.com/marcorentap/legoom-id-demo/blob/master/README.md) you generated.

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

If you are also running Legoom ID locally, you might want to change the published ports in `docker-compose.yml` to avoid clashes. Then execute
```
./vendor/bin/sail up
```

In another terminal, run
```
./vendor/bin/sail artisan migrate
```

By default, the application will be available on [http://localhost](http://localhost)
