<?php
namespace PhpDbLib\Database;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{

    public function boot(): void
    {
        $factory = $this->app['db'];

        $factory->extend(/**
         * @throws \Exception
         */ 'dblib', function ($config) {
            if (!isset($config['prefix'])) {
                $config['prefix'] = '';
            }
            $connector = new DBLIBConnector();
            $pdo = $connector->connect($config);
            return new DBLIBConnection($pdo, $config['database'], $config['prefix']);
        });

    }

    public function register()
    {

    }

    public function provides(): array
    {
        return array();
    }
}
