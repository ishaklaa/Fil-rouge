<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mobyz — Welcome</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=DM+Sans:wght@300;400;500&display=swap"
        rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        beige: {
                            50: '#fefaf4',
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
                    keyframes: {
                        fadeUp: {
                            '0%': {opacity: '0', transform: 'translateY(30px)'},
                            '100%': {opacity: '1', transform: 'translateY(0)'},
                        },
                        fadeIn: {
                            '0%': {opacity: '0'},
                            '100%': {opacity: '1'},
                        },
                        float: {
                            '0%, 100%': {transform: 'translateY(0px)'},
                            '50%': {transform: 'translateY(-12px)'},
                        },
                        spin_slow: {
                            '0%': {transform: 'rotate(0deg)'},
                            '100%': {transform: 'rotate(360deg)'},
                        },
                    },
                    animation: {
                        'fade-up': 'fadeUp 0.8s ease forwards',
                        'fade-up-2': 'fadeUp 0.8s ease 0.2s forwards',
                        'fade-up-3': 'fadeUp 0.8s ease 0.4s forwards',
                        'fade-up-4': 'fadeUp 0.8s ease 0.6s forwards',
                        'fade-in': 'fadeIn 1.2s ease forwards',
                        'float': 'float 4s ease-in-out infinite',
                        'float-2': 'float 5s ease-in-out 1s infinite',
                        'float-3': 'float 6s ease-in-out 0.5s infinite',
                        'spin-slow': 'spin_slow 18s linear infinite',
                    },
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'DM Sans', sans-serif;
        }

        .noise {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 0;
            opacity: 0.04;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)'/%3E%3C/svg%3E");
            background-size: 200px;
        }

        .opacity-0-init {
            opacity: 0;
        }

        .glass {
            background: rgba(253, 246, 236, 0.55);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
        }

        .btn-login {
            position: relative;
            overflow: hidden;
        }

        .btn-login::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(120deg, transparent 0%, rgba(255, 255, 255, 0.12) 50%, transparent 100%);
            transform: translateX(-100%);
            transition: transform 0.5s ease;
        }

        .btn-login:hover::after {
            transform: translateX(100%);
        }

        .deco-ring {
            border-radius: 50%;
            border: 1.5px solid rgba(196, 154, 108, 0.25);
        }
    </style>
</head>
<body class="bg-beige-100 min-h-screen overflow-hidden relative flex flex-col">

{{-- Noise texture --}}
<div class="noise"></div>

{{-- Background radial blobs --}}
<div class="fixed inset-0 z-0 pointer-events-none">
    <div class="absolute -top-32 -left-32 w-[600px] h-[600px] rounded-full"
         style="background: radial-gradient(circle, rgba(196,154,108,0.18) 0%, transparent 70%)"></div>
    <div class="absolute -bottom-40 -right-40 w-[700px] h-[700px] rounded-full"
         style="background: radial-gradient(circle, rgba(125,82,48,0.13) 0%, transparent 70%)"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[900px] h-[900px] rounded-full"
         style="background: radial-gradient(circle, rgba(245,233,212,0.4) 0%, transparent 65%)"></div>
</div>

{{-- Floating decorative rings --}}
<div class="fixed inset-0 z-0 pointer-events-none overflow-hidden">
    <div class="deco-ring absolute w-[500px] h-[500px] -top-24 -right-24 animate-spin-slow opacity-40"></div>
    <div class="deco-ring absolute w-[300px] h-[300px] bottom-10 left-10 animate-spin-slow opacity-30"
         style="animation-direction: reverse; animation-duration: 25s;"></div>
    <div class="deco-ring absolute w-[180px] h-[180px] top-1/3 left-16 opacity-20"></div>
</div>

{{-- Floating icons --}}
<div class="fixed inset-0 z-0 pointer-events-none">
    <span class="absolute top-[12%] left-[8%]  text-4xl opacity-20 animate-float">🎾</span>
    <span class="absolute top-[20%] right-[10%] text-3xl opacity-15 animate-float-2">🏊</span>
    <span class="absolute bottom-[18%] left-[12%] text-3xl opacity-20 animate-float-3">🧘</span>
    <span class="absolute bottom-[22%] right-[8%]  text-4xl opacity-15 animate-float">🎳</span>
    <span class="absolute top-[55%] left-[5%]   text-2xl opacity-15 animate-float-2">⚽</span>
    <span class="absolute top-[45%] right-[5%]  text-2xl opacity-20 animate-float-3">🏹</span>
</div>

{{-- ── HEADER ── --}}
<header class="relative z-10 flex items-center justify-between px-8 py-5 opacity-0-init animate-fade-in">
    <div class="font-playfair text-2xl font-bold text-brown-400 tracking-widest">
        MO<span class="text-brown-100">BY</span>Z
    </div>

</header>

{{-- ── HERO ── --}}
<main class="relative z-10 flex-1 flex flex-col items-center justify-center text-center px-6 py-10">

    {{-- Badge --}}
    <div class="opacity-0-init animate-fade-up mb-6">
            <span class="glass border border-beige-300 text-brown-300 text-xs font-medium
                         px-5 py-2 rounded-full tracking-widest uppercase shadow-sm">
                ✦ &nbsp; Your Leisure Destination
            </span>
    </div>

    {{-- Main heading --}}
    <div class="opacity-0-init animate-fade-up-2">
        <h1 class="font-playfair font-bold text-brown-500 leading-tight mb-4"
            style="font-size: clamp(3rem, 8vw, 7rem); line-height: 1.08;">
            Welcome to<br>
            <span class="text-brown-300 italic">Mobyz</span>
        </h1>
    </div>

    {{-- Subtitle --}}
    <div class="opacity-0-init animate-fade-up-3">
        <p class="text-brown-200 text-lg font-light max-w-xl mx-auto mb-10 leading-relaxed">
            Discover a world of curated activities, wellness, and leisure experiences — all in one place.
        </p>
    </div>

    {{-- CTA --}}
    <div class="opacity-0-init animate-fade-up-4 flex flex-col sm:flex-row items-center gap-4">

        {{-- Login Button --}}
        <a href="{{ route('login.show') }}"
           class="btn-login bg-brown-400 hover:bg-brown-500 text-beige-100 font-playfair font-semibold
                      px-10 py-4 rounded-2xl text-lg tracking-wide shadow-xl transition-all duration-300
                      hover:-translate-y-1 hover:shadow-2xl flex items-center gap-3 group">
            <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor"
                 stroke-width="2" viewBox="0 0 24 24">
                <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/>
                <polyline points="10 17 15 12 10 7"/>
                <line x1="15" y1="12" x2="3" y2="12"/>
            </svg>
            Sign In
        </a>


    </div>

    {{-- Divider with decorative element --}}
    <div class="opacity-0-init animate-fade-up-4 flex items-center gap-4 mt-16 mb-10">
        <div class="h-px w-20 bg-gradient-to-r from-transparent to-beige-300"></div>
        <span class="text-beige-400 text-lg">✦</span>
        <div class="h-px w-20 bg-gradient-to-l from-transparent to-beige-300"></div>
    </div>


</main>

{{-- ── FOOTER ── --}}
<footer class="relative z-10 text-center py-5 text-beige-400 text-xs font-light tracking-wide">
    © {{ date('Y') }} Mobyz &nbsp;·&nbsp; All rights reserved
</footer>

</body>
</html>
