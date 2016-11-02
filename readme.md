## petclinic-laravel 

Laravel 5.3 implementation of [Sifu Petclinic app](https://docs.codesifu.com/tutorials/petclinic-tutorial-1.html) backend. Work still in progress.

### Installation
- `git pull git@github.com:nenadvasic/petclinic-laravel.git`
- `cd petclinic-laravel`
- `composer install`
- `cp .env.example .env` 
- Create a database and edit configuration in .env file
- `php artisan key:generate`
- `php artisan jwt:generate`
- `php artisan migrate`
- `php artisan serve --port=8080`


