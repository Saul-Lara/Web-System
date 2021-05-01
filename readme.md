## Web System

<img alt="GitHub repo size" src="https://img.shields.io/github/repo-size/Saul-Lara/Web-System?style=flat-square"> <img alt="GitHub licence" src="https://img.shields.io/github/license/Saul-Lara/Web-System?style=flat-square"> <img alt="GitHub last commit" src="https://img.shields.io/github/last-commit/Saul-Lara/Web-System?color=green&style=flat-square">

This is a system that allows the control of inventory and sales.

## :rocket: Built With

```
📄 Laravel 7
📑 Php 8
🗃️ MariaDB
```

## :wrench: Setup

1. Clone this :open_file_folder: repository.
2. `cd` into it.
3. Install Composer Dependencies.  
   `composer install`
4. Rename or copy `.env.example` file to `.env`
5. Generate an app encryption key.  
   `php artisan key:generate`
6. Create an empty database for the aplication.
7. In the `.env` file. add databse information to allow laravel to connect to the database.
8. Migrate the database.
   `php artisan migrate`
9. Add a user in the database.

```shell
php artisan tinker

User::create([name => "Your name", email => "theEmail@example.com", password => Hash::make("thePassword")])

```

10. `php artisan serve`
11. Visit `localhost:8000` in your browser.

---
