<?php

namespace Tests;

use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Events\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Routing\UrlGenerator;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    public function setUp() : void
    {
        $this->setUpDatabase();
        $this->migrateTables();
    }

    private function setUpDatabase()
    {
        $database = new DB();
        $database->addConnection(['driver' => 'sqlite', 'database' => ':memory:']);
        $database->bootEloquent();
        $database->setAsGlobal();
    }

    private function migrateTables()
    {
        DB::schema()->create('posts', function ($table) {
            $table->increments('id');
            $table->string('title');
            $table->text('content');
            $table->timestamps();
        });
    }

    protected function getRouter()
    {
        $container = Container::setInstance(new Container);
        $router = new Router(new Dispatcher, $container);
        $container->singleton(Registrar::class, function () use ($router) {
            return $router;
        });

        $container->singleton(\Illuminate\Contracts\Routing\UrlGenerator::class, function () use ($router) {
            return new UrlGenerator(
                $router->getRoutes(),
                Request::create(static::BASE_URL)
            );
        });

        return $router;
    }
}
