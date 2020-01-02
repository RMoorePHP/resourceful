<?php

namespace Tests;

use Illuminate\Http\Request;



class ResourcefulTest extends TestCase
{
    const BASE_URL = 'http://www.foo.com';

    /** @test */
    public function it_can_generate_show_route()
    {
        $router = $this->getRouter();

        $router->resource('posts', '\\Tests\\PostController');

        $post = Post::create(['title' => 'test', 'content' => 'test']);

        $route = $post->routes()->show();

        $response = $router->dispatch(Request::create($route, 'GET'));

        dump($response);

        $this->assertEquals(sprintf('%s/posts/%s', static::BASE_URL, $post->getRouteKey()), $route);
    }


}
