<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CineBook Library</title>
    <style>
        body {font-family: sans-serif; background: #f4f6f9; margin: 0; padding: 50px; } 
        .container { max-width: 400px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); } 
        h1 { text-align: center; color: #333; margin-bottom: 20px; } 
        .form-group { margin-bottom: 15px; } 
        label { display: block; font-weight: bold; margin-bottom: 5px; color: #555; } 
        input { width: 100%; padding: 10px; box-sizing: border-box; border: 1px solid #ccc; border-radius:4px; } 
        .btn { width: 100%; padding: 10px; background: #3498db; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; font-size: 15px; } 
        .btn:hover { background: #2980b9; } 
        .error { color: #e74c3c; font-size: 13px; margin-top: 5px; } 
        .footer-link { text-align: center; margin-top: 15px; font-size: 14px; } 
        .footer-link a { color: #3498db; text-decoration: none; } 
    </style>
</head>
<body>

    <div class="container">
        <h1>Login</h1>

        @if($errors->any())
        <div style="background: #e74c3c; color: white; padding: 10px; border-radius: 4px; margin-bottom: 15px; font-sizd: 14px; ">
            {{ $errors->first() }}
        </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Email Address:</label>
                <input type="email" name="email" required value="{{ old('email') }}">
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" class="btn">Log In</button>
        </form>

        <div class="footer-link">
            Don't have an account? <a href="{{ route('register') }}">Register here</a>
        </div>
    </div>
    
</body>
</html>