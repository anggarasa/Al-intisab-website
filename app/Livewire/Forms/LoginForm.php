<?php

namespace App\Livewire\Forms;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Form;

class LoginForm extends Form
{
    #[Validate('required|string|email', message: [
        'required' => 'Email tidak boleh kosong',
        'email' => 'Format email tidak valid'
    ])]
    public string $email = '';

    #[Validate('required|string' , message: [
        'required' => 'Kata sandi tidak boleh kosong',
    ])]
    public string $password = '';

    #[Validate('boolean')]
    public bool $remember = false;

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate()
    {
        $this->ensureIsNotRateLimited();

        // Langsung return user yang berhasil login
        if (Auth::attempt($this->only(['email', 'password']), $this->remember)) {
            return Auth::user(); // Tambahkan ini
        }

        RateLimiter::hit($this->throttleKey());

        throw ValidationException::withMessages([
            'form.email' => trans('Email atau Password Salah'),
        ]);
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'form.email' => trans('Terlalu sering melakukan login, coba lagi setelah '. $seconds . ' detik'),
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email).'|'.request()->ip());
    }
}
