@extends('layouts.guest')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-green-50 p-4">
    <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-xs">
        <div class="text-center mb-8">
            <img src="{{ asset('logo.png') }}" alt="Logo Masjid" class="h-20 mx-auto mb-4">
            <h1 class="text-2xl font-bold text-green-800">Masjid Al-Firdaus</h1>
            <p class="text-sm text-gray-600">Silakan masuk untuk mengakses admin panel</p>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="mb-4 text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="mb-4">
                <div class="text-red-600 text-sm">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Input -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-2">Email</label>
                <input 
                    type="email" 
                    name="email" 
                    value="{{ old('email') }}"
                    required 
                    autofocus
                    class="w-full px-4 py-2 border rounded-lg focus:border-green-500 focus:ring-green-500"
                    placeholder="Masukkan email">
            </div>

            <!-- Password Input -->
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-medium mb-2">Password</label>
                <input 
                    type="password" 
                    name="password" 
                    required 
                    class="w-full px-4 py-2 border rounded-lg focus:border-green-500 focus:ring-green-500"
                    placeholder="••••••••">
            </div>

            <!-- Remember Me -->
            <div class="mb-6 flex items-center">
                <input 
                    type="checkbox" 
                    name="remember" 
                    id="remember" 
                    class="rounded border-gray-300 text-green-600 focus:ring-green-500">
                <label class="ml-2 text-sm text-gray-600" for="remember">Ingat Saya</label>
            </div>

            <!-- Login Button -->
            <button type="submit" class="w-full bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-700 transition-colors">
                <i class="fas fa-sign-in-alt mr-2"></i>Masuk
            </button>

            <!-- Forgot Password Link -->
            @if (Route::has('password.request'))
                <div class="mt-4 text-center">
                    <a href="{{ route('password.request') }}" class="text-sm text-green-600 hover:text-green-700">
                        Lupa Password?
                    </a>
                </div>
            @endif
        </form>
    </div>
</div>
@endsection