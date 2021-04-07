<?php

namespace App\Http\Controllers;



use Illuminate\Support\Facades\Log;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index()
    {

        app()->configureMonologUsing(function($monolog) {
//    $infoHandler = new Monolog\Handler\StreamHandler(storage_path('logs/info.log'), Monolog\Logger::INFO, false);
//    $debugHandler = new Monolog\Handler\StreamHandler(storage_path('logs/debug.log'), Monolog\Logger::DEBUG, false);
//    $handler->setFormatter(new \Monolog\Formatter\LineFormatter(null, null, true));

//    $monolog->setHandlers([$debugHandler, $infoHandler]);
//    $monolog->pushHandler($debugHandler);

            $monolog->pushHandler(new StreamHandler(storage_path('logs/laravel_warning.log'), Logger::DEBUG, true));
//    $monolog->pushHandler(new StreamHandler(storage_path('logs/laravel_debug.log'), Logger::DEBUG));
//    $monolog->pushHandler(new StreamHandler(storage_path('logs/laravel_info.log'), Logger::INFO));

            return $monolog;
        });

        Log::debug('debug');
        Log::info('info', ['test' => 'tset']);
        Log::notice('notice', ['notice']);
        Log::warning('warning');
        Log::error('error');
        Log::critical('critical');
        Log::alert('alert');
        Log::emergency('emergency');

        return __METHOD__;
    }
}
