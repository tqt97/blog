<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\SocialiteService;
use App\SocialEnums;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller implements HasMiddleware
{
    public function __construct(protected readonly SocialiteService $socialService) {}

    /**
     * Get the middleware that should be assigned to the controller.
     */
    public static function middleware(): array
    {
        return [
            new Middleware('social.limit', only: ['loginSocial', 'callbackSocial']),
        ];
    }

    /**
     * Handle the login redirect to the social authentication provider.
     *
     * This method will validate the given provider and redirect the user to the
     * social authentication provider's login page. If there is an error with the
     * authentication, the user will be redirected back to the login page with an
     * error message.
     *
     * @param  string  $provider  The social authentication provider.
     * @return RedirectResponse The redirect response to send the user to.
     */
    public function loginSocial(string $provider): RedirectResponse
    {
        try {
            $this->socialService->validateProvider($provider);

            return Socialite::driver($provider)->redirect();
        } catch (Exception $e) {
            Log::error("Socialite authentication with '$provider' error: ".$e->getMessage());

            return $this->handleAuthenticationError($provider, $e);
        }
    }

    /**
     * Handle the callback from the social authentication provider.
     *
     * The user is redirected to this method after they have been authenticated
     * by the social authentication provider. This method will find or create
     * a user in the database and log them in. If there is an error with the
     * authentication, the user will be redirected back to the login page.
     *
     * @param  string  $provider  The social authentication provider.
     * @return RedirectResponse The redirect response to send the user to.
     */
    public function callbackSocial(string $provider): RedirectResponse
    {
        $this->socialService->validateProvider($provider);

        try {
            $callback = $this->socialService->findOrCreateUser($provider);

            // Add success logging
            if ($callback['status'] === 'success') {
                Log::info('Successful social authentication', [
                    'provider' => $provider,
                    'ip' => request()->ip(),
                    'user_agent' => request()->userAgent(),
                    'user_id' => auth()->id(),
                ]);
            }

            return $callback['redirect'];
        } catch (\Exception $e) {
            Log::error('Socialite authentication error: '.$e->getMessage());

            return $this->handleAuthenticationError($provider, $e);
        }
    }

    /**
     * Handles social authentication errors.
     *
     * If the application is in production environment, it returns a generic error message.
     * Otherwise, it returns the exception message.
     *
     * @param  string  $provider  The social authentication provider.
     * @param  \Exception  $e  The exception that occurred.
     * @return RedirectResponse A redirect response with the error message to the login page.
     */
    private function handleAuthenticationError(string $provider, Exception $e): RedirectResponse
    {
        $errorMessage = app()->environment('production')
            ? 'Unable to authenticate with '.ucfirst($provider)
            : $e->getMessage();

        return redirect()->route(SocialEnums::ROUTE_LOGIN)->with(['error' => $errorMessage]);
    }
}
