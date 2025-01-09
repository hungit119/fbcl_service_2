<?php

namespace App\Providers;

use App\Repositories\Friend\FriendRepository;
use App\Repositories\Friend\FriendRepositoryInterface;
use App\Repositories\Images\ImageRepository;
use App\Repositories\Images\ImageRepositoryInterface;
use App\Repositories\Post\PostRepository;
use App\Repositories\Post\PostRepositoryInterface;
use App\Repositories\Tags\TagRepository;
use App\Repositories\Tags\TagRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\Services\Email\MailService;
use App\Services\Email\MailServiceInterface;
use App\Services\Jwt\JwtService;
use App\Services\Jwt\JwtServiceInterface;
use App\Usecases\Friend\FriendUsecase;
use App\Usecases\Friend\FriendUsecaseInterface;
use App\Usecases\Post\PostUsecase;
use App\Usecases\Post\PostUsecaseInterface;
use App\Usecases\User\UserUsecase;
use App\Usecases\User\UserUsecaseInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            UserRepositoryInterface::class,
            UserRepository::class
        );
        $this->app->singleton(
            PostRepositoryInterface::class,
            PostRepository::class
        );
        $this->app->singleton(
            TagRepositoryInterface::class,
            TagRepository::class
        );
        $this->app->singleton(
            ImageRepositoryInterface::class,
            ImageRepository::class
        );
        $this->app->singleton(
            JwtServiceInterface::class,
            JwtService::class
        );
        $this->app->singleton(
            MailServiceInterface::class,
            MailService::class
        );
        $this->app->singleton(
            UserUsecaseInterface::class,
            UserUsecase::class
        );
        $this->app->singleton(
            PostUsecaseInterface::class,
            PostUsecase::class
        );
        $this->app->singleton(
            FriendRepositoryInterface::class,
            FriendRepository::class
        );
        $this->app->singleton(
            FriendUsecaseInterface::class,
            FriendUsecase::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
