<?php

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

require_once __DIR__.'/../vendor/autoload.php';

try {
    (new Dotenv\Dotenv(__DIR__.'/../'))->load();
} catch (Dotenv\Exception\InvalidPathException $e) {
    //
}

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| Here we will load the environment and create the application instance
| that serves as the central piece of this framework. We'll use this
| application as an "IoC" container and router for this framework.
|
*/

$app = new Laravel\Lumen\Application(
    realpath(__DIR__.'/../')
);

//$app = new App\App(
//    realpath(__DIR__.'/../')
//);

 $app->withFacades();

// $app->withEloquent();



/*
|--------------------------------------------------------------------------
| Register Container Bindings
|--------------------------------------------------------------------------
|
| Now we will register a few bindings in the service container. We will
| register the exception handler and the console kernel. You may add
| your own bindings here if you like or you can make another file.
|
*/

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

/*
|--------------------------------------------------------------------------
| Register Middleware
|--------------------------------------------------------------------------
|
| Next, we will register the middleware with the application. These can
| be global middleware that run before and after each request into a
| route or middleware that'll be assigned to some specific routes.
|
*/

// $app->middleware([
//    App\Http\Middleware\ExampleMiddleware::class
// ]);

// $app->routeMiddleware([
//     'auth' => App\Http\Middleware\Authenticate::class,
// ]);

/*
|--------------------------------------------------------------------------
| Register Service Providers
|--------------------------------------------------------------------------
|
| Here we will register all of the application's service providers which
| are used to bind services into the container. Service providers are
| totally optional, so you are not required to uncomment this line.
|
*/

// $app->register(App\Providers\AppServiceProvider::class);
// $app->register(App\Providers\AuthServiceProvider::class);
// $app->register(App\Providers\EventServiceProvider::class);

/*
|--------------------------------------------------------------------------
| Load The Application Routes
|--------------------------------------------------------------------------
|
| Next we will include the routes file so that they can all be added to
| the application. This will provide all of the URLs the application
| can respond to, as well as the controllers that may handle them.
|
*/

$app->router->group([
    'namespace' => 'App\Http\Controllers',
], function ($router) {
    require __DIR__.'/../routes/web.php';
});

//$app->configureMonologUsing(function($monolog) {
//    return $monolog->pushHandler(new StreamHandler(storage_path('logs/info.log'), Logger::ERROR, false)); // false value as third argument to disable bubbling up the stack
//});

//$app->configureMonologUsing(function($monolog) {
//    $infoHandler = new Monolog\Handler\StreamHandler(storage_path('logs/info.log'), Monolog\Logger::INFO, false);
//    $debugHandler = new Monolog\Handler\StreamHandler(storage_path('logs/debug.log'), Monolog\Logger::DEBUG, false);
//    $handler->setFormatter(new \Monolog\Formatter\LineFormatter(null, null, true));

//    $monolog->setHandlers([$debugHandler, $infoHandler]);
//    $monolog->pushHandler($debugHandler);

//    $monolog->pushHandler(new StreamHandler(storage_path('logs/laravel_warning.log'), Logger::WARNING, false));
//    $monolog->pushHandler(new StreamHandler(storage_path('logs/laravel_debug.log'), Logger::DEBUG));
//    $monolog->pushHandler(new StreamHandler(storage_path('logs/laravel_info.log'), Logger::INFO));

//    return $monolog;
//});

return $app;
