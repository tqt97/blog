<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class SocialLoginRateLimiter
{
    private const THROTTLE_KEY = 'social-login';

    private const THROTTLE_TIME = 5;

    public function __construct() {}

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $key = self::THROTTLE_KEY.$request->ip();
        $this->ensureIsNotRateLimited($key, $request);

        if (RateLimiter::tooManyAttempts($key, self::THROTTLE_TIME)) {
            return redirect()
                ->route('login')
                ->with('error', 'Too many login attempts. Please try again later.');
        }
        RateLimiter::hit($key);

        if (Auth::check()) {
            RateLimiter::clear($key);
        }

        return $next($request);
    }

    public function ensureIsNotRateLimited(string $key, Request $request): void
    {
        if (! RateLimiter::tooManyAttempts($key, self::THROTTLE_TIME)) {
            return;
        }

        event(new Lockout($request));

        $seconds = RateLimiter::availableIn($key);

        throw ValidationException::withMessages([
            'social_login' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }
}
