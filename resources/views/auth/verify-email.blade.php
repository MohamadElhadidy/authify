@extends('layouts.guest')
@section('title', 'Verify Email')

@section('content')
    <div class="flex min-h-full flex-col justify-center items-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img src="{{ asset('images/logo.svg') }}" alt="Your Company" class="mx-auto h-24 w-auto" />
            <h2 class="mt-6 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Verify Your Email</h2>
        </div>



        <div class="mt-4 sm:mx-auto sm:w-full sm:max-w-sm">

            @if (session('status') === 'verification-link-sent')
                <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4 text-center">
                    A new verification link has been sent to your email address.
                </div>
            @endif

            <p class="text-gray-600 mb-6 text-center">
                Before continuing, please check your email for a verification link.
                If you didn’t receive the email, click below to resend it.
            </p>

            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit"
                    class="flex w-full justify-center rounded-md cursor-pointer bg-black px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-gray-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black">
                    Resend Verification Email
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}" class="mt-4">
                @csrf
                <button type="submit"
                    class="flex w-full justify-center rounded-md cursor-pointer bg-white border-2 border-black px-3 py-1.5 text-sm/6 font-semibold text-black shadow-xs hover:bg-gray-200 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black">
                    Log Out
                </button>
            </form>
        </div>
    </div>

@endsection
