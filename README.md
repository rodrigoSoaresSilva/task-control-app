# About
This is a study project in **Laravel** version **11.37**.

The system is a simple task management application featuring file export functionality and email notifications for each new task.

The goal is to practice and enhance knowledge in **Laravel/UI** with **Bootstrap**, **session-based authentication**, **email notifications** and **actions**, as well as **Excel** and **PDF export** capabilities.

## 💿 Install

Set up your project using your preferred package manager.

Use the corresponding command to install the dependencies:

```bash
composer install
```

And then:

```bash
npm install
```

## Usage

This section covers how to start the development and UI servers.

### Configuration

Update your **.env** file with your database credentials (you can use **.env.example** as a template).

Run the following command to create the database structure:

```bash
php artisan migrate
```

### Starting the Development Server

To start the development server run the following command. The server will be accessible at [http://127.0.0.1:8000](http://127.0.0.1:8000):

```bash
php artisan serve
```

### Starting the UI Server

To start the UI server, run the following command:

```bash
npm run dev
```

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

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
