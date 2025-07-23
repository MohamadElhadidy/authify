@extends('layouts.guest')
@section('title', 'Login')

@section('content')
    <div class="flex min-h-full flex-col justify-center items-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img src="{{ asset('images/logo.svg') }}" alt="Your Company" class="mx-auto h-24 w-auto" />
            <h2 class="mt-6 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Sign in to your account</h2>
        </div>

        <div class="mt-4 sm:mx-auto sm:w-full sm:max-w-sm">
            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address</label>
                    <div class="mt-2">
                        <input id="email" type="email" name="email" required autocomplete="email"
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-black sm:text-sm/6" />
                    </div>

                    @error('email')
                        <div class="text-red-500 text-sm/6">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
                        <div class="text-sm">
                            <a href="{{ route('forgot-password') }}"
                                class="font-semibold text-black hover:text-gray-800">Forgot

                                password?</a>
                        </div>
                    </div>
                    <div class="mt-2">
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-black sm:text-sm/6" />
                    </div>
                </div>


                <div class="mt-6 space-y-6">
                    <div class="flex gap-3">
                        <div class="flex h-6 shrink-0 items-center">
                            <div class="group grid size-4 grid-cols-1">
                                <input id="remember_me" type="checkbox" name="remember_me" checked
                                    aria-describedby="remember_me-description"
                                    class="col-start-1 row-start-1 appearance-none cursor-pointer rounded-sm border border-gray-300 bg-white checked:border-black checked:bg-black indeterminate:border-black indeterminate:bg-black focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100 forced-colors:appearance-auto" />
                                <svg viewBox="0 0 14 14" fill="none"
                                    class="pointer-events-none col-start-1 row-start-1 size-3.5 self-center justify-self-center stroke-white group-has-disabled:stroke-gray-950/25">
                                    <path d="M3 8L6 11L11 3.5" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="opacity-0 group-has-checked:opacity-100" />
                                    <path d="M3 7H11" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="opacity-0 group-has-indeterminate:opacity-100" />
                                </svg>
                            </div>
                        </div>
                        <div class="text-sm/6">
                            <label for="remember_me" class="font-medium text-gray-900">Remember Me</label>
                        </div>
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="flex w-full justify-center cursor-pointer rounded-md bg-black px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-gray-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black">Sign
                        in</button>
                </div>
            </form>

            <p class="mt-10 text-center text-sm/6 text-gray-500">
                Not a member?
                <a href="{{ route('register') }}" class="font-semibold text-black hover:text-gray-800">Register</a>
            </p>
        </div>
    </div>

@endsection
