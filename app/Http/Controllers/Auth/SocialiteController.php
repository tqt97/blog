<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\SocialiteAuthProviderException;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function loginSocial(string $provider): RedirectResponse
    {
        $this->validateProvider($provider);

        return Socialite::driver($provider)->redirect();
    }

    public function callbackSocial(string $provider): RedirectResponse
    {
        $this->validateProvider($provider);

        $response = Socialite::driver($provider)->user();

        $user = User::updateOrCreate(
            ['email' => $response->getEmail()],
            [
                'password' => Str::password(),
                'name' => $response->getName() ?? $response->getNickname(),
                "{$provider}_id" => $response->getId(),
            ]
        );

        if ($user->wasRecentlyCreated) {
            event(new Registered($user));
        }

        Auth::login($user, remember: true);

        return redirect()->intended(route('dashboard', absolute: false));
    }

    protected function validateProvider(string $provider): void
    {
        $allowedProviders = ['github', 'google', 'facebook'];
        if (! in_array($provider, $allowedProviders)) {
            throw new SocialiteAuthProviderException("Provider '$provider' is invalid. Allowed providers: ".implode(', ', $allowedProviders));
        }
    }
}
