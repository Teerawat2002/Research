<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'id' => ['required', 'string'], // Supports both a_id and s_id
            'password' => ['required', 'string'], // Supports both a_password and s_password
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        $guards = [
            'advisors' => ['a_id' => $this->input('id'), 'password' => $this->input('password')],
            'students' => ['s_id' => $this->input('id'), 'password' => $this->input('password')],
        ];

        foreach ($guards as $guard => $credentials) {
            if (Auth::guard($guard)->attempt($credentials)) {
                RateLimiter::clear($this->throttleKey());
                return;
            }
        }

        RateLimiter::hit($this->throttleKey());

        throw ValidationException::withMessages([
            'id' => __('auth.failed'),
        ]);
    }

    /**
     * Ensure the login request is not rate limited.
     */
    public function ensureIsNotRateLimited(): void
    {
        $maxAttempts = config('auth.login_max_attempts', 5);

        if (!RateLimiter::tooManyAttempts($this->throttleKey(), $maxAttempts)) {
            return;
        }

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'id' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::lower($this->input('id')) . '|' . $this->ip();
    }
}
