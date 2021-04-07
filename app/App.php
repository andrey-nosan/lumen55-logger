<?php


namespace App;


use Monolog\Logger;

class App extends \Laravel\Lumen\Application
{
    protected function registerLogBindings()
    {
        $this->singleton('Illuminate\Contracts\Logging\Log', function () {
            if ($this->monologConfigurator) {
                return call_user_func($this->monologConfigurator, new Logger('lumen'));
            } else {
                return new Logger('lumen', [$this->getMonologHandler()]);
            }
        });
    }
}
