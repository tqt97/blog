<?php

namespace App\Services\Auth;

use App\Exceptions\SocialiteAuthProviderException;
use App\Models\User;
use App\SocialEnums;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Contracts\User as SocialUser;
use Laravel\Socialite\Facades\Socialite;

class SocialiteService
{
    /**
     * Validate a given provider.
     *
     * @param  string  $provider  The provider to be validated.
     *
     * @throws SocialiteAuthProviderException If the provider is invalid.
     */
    public function validateProvider(string $provider): void
    {
        $allowedProviders = config('services.socialite_providers');
        if (! in_array($provider, $allowedProviders)) {
            throw new SocialiteAuthProviderException("Provider '$provider' is invalid. Allowed providers: ".implode(', ', $allowedProviders));
        }
    }

    /**
     * Retrieve the social user from the specified provider.
     *
     * @param  string  $provider  The social authentication provider to use.
     * @return SocialUser|null The authenticated social user or null if an error occurs.
     */
    public function getSocialUser(string $provider): ?SocialUser
    {
        try {
            return Socialite::driver($provider)->user();
        } catch (Exception $e) {
            Log::error('Socialite authentication error: '.$e->getMessage());

            return null;
        }
    }

    /**
     * Find or create a user based on the social user info.
     *
     * @param  string  $provider  The social authentication provider to use.
     * @param  SocialUser  $socialUser  The authenticated social user.
     */
    public function findOrCreateUser(string $provider): array
    {
        $socialUser = $this->getSocialUser($provider);
        if (empty($socialUser)) {
            return [
                'status' => SocialEnums::STATUS_ERROR,
                'redirect' => redirect()->route(SocialEnums::ROUTE_LOGIN)->with(['error' => 'Socialite authentication error']),
            ];
        }
        $userByEmail = User::where('email', $socialUser->getEmail())->first();

        if ($userByEmail) {
            // User already exists and auth_type is email
            if ($userByEmail->auth_type === 'email') {
                return [
                    'status' => SocialEnums::STATUS_MAIL_EXIST,
                    'redirect' => redirect()->route(SocialEnums::ROUTE_LOGIN)
                        ->with(['error' => 'This email is registered with password. Please login with email and password.']),
                ];
            }

            return $this->handleExistingUser($provider, $socialUser, $userByEmail);
        }

        return [
            'status' => SocialEnums::STATUS_REGISTER,
            'redirect' => redirect()->route(SocialEnums::ROUTE_REGISTER)->withInput([
                'name' => $socialUser->getName(),
                'email' => $socialUser->getEmail(),
                "{$provider}_id" => $socialUser->getId(),
                'auth_type' => $provider,
            ]),
        ];
    }

    private function handleExistingUser(string $provider, SocialUser $socialUser, User $user): array
    {
        if ($user->isLinkedWithProvider($provider, $socialUser->getId())) {
            Auth::login($user, remember: true);

            return [
                'status' => SocialEnums::STATUS_SUCCESS,
                'redirect' => redirect()->route(SocialEnums::ROUTE_DASHBOARD),
            ];
        }

        return [
            'status' => SocialEnums::STATUS_MAIL_EXIST,
            'redirect' => redirect()->route(SocialEnums::ROUTE_LOGIN)->with(['error' => 'Email has been already registered.']),
        ];
    }
}
