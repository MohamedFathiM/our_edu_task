# Our Education Task

### How To install Project

## Development environment

-   [Composer](https://getcomposer.org) dependency manager
    javascript runtime build

### Clone repository

```sh
git clone https://github.com/MohamedFathiM/our_edu_task.git

```

### Install

-   Run those commands

```sh
composer install
```

### Database

#### Configuration

-   copy .env.example to .env
-   Run `php artisan key:generate`
-   Setup a mysql database and fill in `DB_HOST`, `DB_PORT`, `DB_USERNAME`, `DB_PASSWORD`, `DB_DATABASE` in `.env` file.

#### Migration

Run this command

```sh
php artisan migrate:fresh --seed
```
