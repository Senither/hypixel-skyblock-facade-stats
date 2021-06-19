# Hypixel SkyBlock Facade Stats

A simple web app that displays some historic usage data for the [Hypixel Facade API](https://hypixel-api.senither.com/), the app is built using [Lumen](https://lumen.laravel.com/), [TailwindCSS](https://tailwindcss.com/), and [ApexCharts](https://apexcharts.com/).

Learn more about the facade API at [hypixel-api.senither.com](https://hypixel-api.senither.com/) or checkout the code at [Senither/hypixel-skyblock-facade](https://github.com/Senither/hypixel-skyblock-facade) on github.

## Table of Content

* [Prerequisites](#prerequisites)
* [Installing Facade Stats](#installing-facade-stats)
* [Contributing](#contributing)
* [License](#License)

## Prerequisites

* Apache2 / Nginx
* [Yarn](https://yarnpkg.com/)
* [Composer](https://getcomposer.org/)
* Node >= v10.15
* PHP >= v7.3
  + BCMath PHP Extension
  + Ctype PHP Extension
  + JSON PHP Extension
  + Mbstring PHP Extension
  + OpenSSL PHP Extension
  + PDO PHP Extension
  + Tokenizer PHP Extension
  + XML PHP Extension
  + GD PHP Extension

## Installing Facade Stats

The app utilizes [Composer](https://getcomposer.org/) for installing the PHP dependencies, and [Yarn](https://yarnpkg.com/) for installing the node dependencies, to get started you'll first need to clone down the repository.

    git clone https://github.com/senither/hypixel-skyblock-facade-stats.git .

Next, go into the `hypixel-skyblock-facade-stats` folder, first, we'll set up the PHP side of the project, to do this install all the dependencies using Composer

    composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev

Then rename and set up your environment variables by renaming the `.env.example` file to `.env` and adding in your settings.

> **Note:** Only the database settings and the `FACADE_STATS_URL` are actually required to get the app up and running, the facade stats URL should point the the `/v1/stats` route of your facade API instance.

Now that's done, we're now ready to migrate our database, this will create all the tables required for the application.

    php artisan migrate

Next we'll need to make sure that the application can read all the required files, and write to the places where files will be generated later when the app is in-use, the easiest way to do this is by setting the storage cache directory to permission level 775 and changing the ownership of the files with the account that runs our webserver.

    chmod -R 775 storage
    chown -R www-data:www-data *

Now we'll need to set up our cronjobs for the application, this will allow the app to collect API stats in the background every minute, this can be done by setting up a cronjob to run the artisan schedule:run command, start by opening the crontab file.

    crontab -u www-data -e

Next, add a new cron command at the bottom of the file that runs every minute.

    * * * * * php /path/to/your/hypixel-skyblock-facade-stats/artisan schedule:run

We're now done with the server side portion of the app, finally we can setup the assets, this is made easy using [Yarn](https://yarnpkg.com/), first install the node dependencies.

    yarn install

And finally build the assets for production.

    yarn prod

And you're done, if you have setup Apache or Nginx to point to the projects public directory the entire app should now be setup and ready to be used, simply visit the site in the browser.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## License

Hypixel Skyblock Facade Stats is open-sourced software licensed under the [MIT](https://opensource.org/licenses/MIT).
