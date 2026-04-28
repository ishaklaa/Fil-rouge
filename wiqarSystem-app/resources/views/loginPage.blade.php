<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mobyz — Sign In</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=DM+Sans:wght@300;400;500&display=swap"
        rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        beige: {
                            100: '#fdf6ec',
                            200: '#f5e9d4',
                            300: '#e8d5b5',
                            400: '#d4b896',
                        },
                        brown: {
                            100: '#c49a6c',
                            200: '#a0724a',
                            300: '#7d5230',
                            400: '#5c3a1e',
                            500: '#3d2410',
                        },
                    },
                    fontFamily: {
                        playfair: ['"Playfair Display"', 'serif'],
                        dm: ['"DM Sans"', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'DM Sans', sans-serif;
        }

        .input-focus:focus {
            outline: none;
            border-color: #7d5230;
            box-shadow: 0 0 0 3px rgba(125, 82, 48, 0.1);
        }
    </style>
</head>
<body class="bg-beige-100 min-h-screen flex items-center justify-center px-4">

<div class="bg-white rounded-2xl shadow-xl border border-beige-200 w-full max-w-md p-8">

    <div class="text-center mb-8">
        <h1 class="font-playfair text-3xl font-bold text-brown-400 tracking-widest">
            WI<span class="text-brown-100">QA</span>R
        </h1>
        <p class="text-brown-200 text-sm mt-2">Sign in to your account</p>
    </div>


    @if (session('error'))
        <div
            style="background-color: #fee2e2; color: #b91c1c; padding: 1rem; margin-bottom: 1rem; border-radius: 0.5rem; border: 1px solid #f87171;">
            {{ session('error') }}
        </div>
    @endif
    <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-5">
        @csrf

        <div class="flex flex-col gap-1.5">
            <label for="email" class="text-sm font-medium text-brown-400">Email</label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="you@example.com"
                class="input-focus bg-beige-100 border border-beige-300 rounded-xl px-4 py-3
                           text-sm text-brown-500 placeholder-beige-400 transition-all"
            >
            @error('email')
            <span class="text-red-400 text-xs">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex flex-col gap-1.5">
            <label for="password" class="text-sm font-medium text-brown-400">Password</label>
            <input
                type="password"
                id="password"
                name="password"
                placeholder="••••••••"
                class="input-focus bg-beige-100 border border-beige-300 rounded-xl px-4 py-3
                           text-sm text-brown-500 placeholder-beige-400 transition-all"
            >

        </div>


        <button type="submit"
                class="mt-2 bg-brown-400 hover:bg-brown-500 text-beige-100 font-playfair font-semibold
                           rounded-xl py-3 text-base tracking-wide transition-all hover:-translate-y-0.5
                           hover:shadow-lg active:scale-95">
            Sign In
        </button>
    </form>



</div>

</body>
</html>
