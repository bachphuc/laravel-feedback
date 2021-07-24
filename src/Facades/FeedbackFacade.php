<?php

namespace bachphuc\LaravelFeedback\Facades;

use Illuminate\Support\Facades\Facade;

class FeedbackFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'feedback'; }

    /**
     * Register the routers for feedback package.
     *
     * @return void
     */
    public static function routes()
    {
        $router = static::$app->make('router');

        $namespace = '\bachphuc\LaravelFeedback\Http\Controllers\\';
        $router->resource('comments', $namespace . 'CommentController');
        $router->resource('reviews', $namespace . 'ReviewController');
    }
}