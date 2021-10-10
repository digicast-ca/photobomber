<p align="center"><img src="https://webcasting.digicast.ca/hubfs/Assets-Do-Not-Remove/C02%20-%20Footer/logo-icastgo-footer.png" alt="icastGo logo"></p>
<p align="center">
<font size="2">Research and Development Team</font>
</p>

# Photobomber challenge

Implement the Photobomber app, a simplified, poor man's version, of the Google Photos photobooks service.

In the app, a user should be able to upload photos to their gallery.
They should also be able to create photo albums with title, optional description and layout.
The layout determines how many photos are displayed per album page (e.g. 1, 2 or 4). To make it simpler use the same layout for all the pages.
When a new album is created, the user should be redirected to an album dashboard. There they should be able to edit the album title, description and layout as well as select photos from their gallery to be part of the album. The selected photos should be arranged into pages which display the photos according to the chosen layout.
Once all the photos have been chosen for the album, a "Compile" button should trigger the album compilation.
You don't need to worry about what this compilation means. Just think of it as a 3rd-party API which processes and optimizes the images for printing. A service class is provided for you to use in your "Compile" implementation.
Keep in mind that once the album starts compiling no further updates should be allowed on the album.
Also, be aware the compilation API might fail for mysterious reasons, and you will need to gracefully handle and inform the user about any errors.
So it's important that you model the album lifecycle to keep track of its current status.
If the compilation is done successfully, the user should receive an email confirming the album is ready to be shipped.

To sum it up, at the end you should end up with:

- A gallery page, listing all the photos
- A photo upload form
- An albums page, listing all the albums (title and status)
- An album creation/edition form
- An album dashboard page, showing album details and photos

## Instructions

- You're free to spend all the time you need on the project, but we recommend you try and keep it up to +- 4 hours.
- Our current development stack uses mainly Laravel, Vue and Tailwindcss, so this project makes all of those available to you. Nevertheless, feel free to use different technologies in your implementation.
- Although you should try to make your code as self-explanatory as possible, please try to document your implementation steps just so we can get a glimpse at your thought process. If you decide to do that, please use the `NOTES.md` file.
- Please take screenshots of your final solution and send them along with the code.
- You should use the `AlbumCompiler` class to trigger the fake album compilation.
- You should finish implementing the `AlbumCompilationWebhookController` class to handle the fake album compilation success or failure.
- A user is created for you when you migrate your database (email: `photobomber@icastgo.com` / password: `password`).
- See the installation steps for further local environment setup.

## Installation

- Create a `.env` file (use `.env.example` as a reference)
- Run `composer install`
- Create a database named `photobomber`
- Run `php artisan migrate --seed`
- Run `npm install`
- Change QUEUE_CONNECTION to `redis` on your `.env` and run `php artisan queue:listen` so the "Compile" job runs in the background (simulating an async API)

## Bonus

- Add ability to retry the album compilation in case of failure
- Add realtime updates to your UI (e.g. show status changes without the need to refresh the page)
- Add phpunit tests
- If you feel confortable, try to use Event Sourcing for modelling the Album lifecycle. The [spatie/laravel-event-sourcing](https://spatie.be/docs/laravel-event-sourcing/v4/introduction) package is available if you need it. Again, feel free to use whatever you prefer.

<br>

---

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[CMS Max](https://www.cmsmax.com/)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
