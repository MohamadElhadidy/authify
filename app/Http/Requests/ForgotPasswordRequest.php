<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class ForgotPasswordRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
     public function rules(): array
    {
        return [
            'email' => 'required|email',
        ];
    }


    public function prepareForValidation()
    {
        $this->rateLimitCheck();
    }

    protected function rateLimitCheck(): void
    {
        $key = 'forget-password' . $this->ip();
        $maxAttempts = 2;
        $decaySeconds = 60;

        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            throw ValidationException::withMessages([
                'email' => ['Too many attempts. Please try again in ' . RateLimiter::availableIn($key) . ' seconds.'],
            ]);
        }

        RateLimiter::hit($key, $decaySeconds);
    }
}
