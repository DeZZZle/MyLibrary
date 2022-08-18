<?php

namespace App\Providers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('book-edit', function (User $user, $id) {
            $book = Book::query()->where('id', $id)->first();
            if (isset($book->id) and ($book->author_id == $user->id))
                return true;
            return false;
        });
        Gate::define('user-edit', function (User $user, $id) {
            return $user->id == $id;
        });
    }
}
