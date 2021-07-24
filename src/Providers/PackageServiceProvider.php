<?php

namespace bachphuc\LaravelFeedback\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
// use bachphuc\LaravelHTMLElements\Facades\ElementFacade as Element;

class PackageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // if ($this->app->runningInConsole()) {
        //     $this->commands([
        //         ManageCommand::class,
        //     ]);
        // }
        $packagePath = dirname(__DIR__);
      
        // $this->publishes([
        //     $packagePath . '/Config/elements.php' => config_path('elements.php'),
        // ], 'elements-config');

        // boot translator
        $this->loadTranslationsFrom($packagePath . '/resources/lang' , 'feedback');

        // publish translator
        // $this->publishes([
        //     $packagePath . '/resources/lang' => resource_path('lang/vendor/elements'),
        // ], 'elements-lang');

        // register view
        $this->loadViewsFrom($packagePath . '/resources/views', 'feedback');

        // $this->publishes([
        //     $packagePath . '/resources/views' => resource_path('views/vendor/elements'),
        // ], 'elements-views');

        // $this->publishes([
        //     $packagePath . '/public' => public_path('vendor/elements'),
        // ], 'elements-assets');

        // load migrations
        $this->loadMigrationsFrom($packagePath.'/database/migrations');

        $namespace = '\bachphuc\LaravelFeedback';
        \HtmlElement::mapNamespace('feedback', $namespace);

        \HtmlElement::map('review-block', $namespace. '\Components\ReviewBlock');
        \HtmlElement::map('comment-block',  $namespace. '\Components\CommentBlock');
        \HtmlElement::map('rating-bar', $namespace. '\Components\RatingBar');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /*
         * Register the service provider for the dependency.
         */

        $packagePath = dirname(__DIR__);

        // register config
        // $this->mergeConfigFrom(
        //     $packagePath . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'elements.php' , 'elements'
        // );

        $this->app->bind('feedback', function(){
            return new \bachphuc\LaravelFeedback\Feedback();
        });

        // Element::map('review-list', '\bachphuc\LaravelFeedback\Components\ReviewList');
    }
}
