<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wiqaar — Orders History</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500&display=swap"
        rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'DM Sans', sans-serif;
        }

        .scroll-y::-webkit-scrollbar {
            width: 4px;
        }

        .scroll-y::-webkit-scrollbar-track {
            background: #f5e9d4;
            border-radius: 10px;
        }

        .scroll-y::-webkit-scrollbar-thumb {
            background: #d4b896;
            border-radius: 10px;
        }

        .order-card {
            transition: all 0.2s ease;
        }

        .order-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(61, 36, 16, 0.12);
        }

        details > summary {
            list-style: none;
            cursor: pointer;
        }

        details > summary::-webkit-details-marker {
            display: none;
        }

        details[open] .chevron {
            transform: rotate(180deg);
        }

        .chevron {
            transition: transform 0.2s ease;
        }
    </style>
</head>
<body class="bg-beige-100 min-h-screen">

<!-- HEADER -->
<header class="bg-brown-400 px-6 h-14 flex items-center justify-between shadow-lg sticky top-0 z-50">
    <h1 class="font-playfair text-2xl font-bold text-beige-200 tracking-widest">
        WI<span class="text-brown-100">QA</span>AR
    </h1>
    <div class="flex items-center gap-3">
        <span class="bg-brown-300 text-beige-200 text-xs font-medium px-4 py-1 rounded-full tracking-widest uppercase">
            Orders History
        </span>

        <!-- Dashboard -->
        <a href="{{ route('cashier.dashboard') }}"
           class="flex items-center gap-1.5 bg-brown-300 hover:bg-brown-200 text-beige-200 text-xs font-medium px-3 py-1.5 rounded-xl transition-all">
            Dashboard
        </a>

        <!-- Logout -->
        <a href="/logout"
           class="text-red-300 hover:text-red-100 text-xs font-medium transition-all underline underline-offset-2">
            Logout
        </a>
    </div>
</header>

<!-- MAIN -->
<div class="max-w-4xl mx-auto p-6 flex flex-col gap-5">
    <div>
        <h2 class="font-playfair text-2xl font-semibold text-brown-400">Statistics</h2>
        <p class="text-sm text-brown-200 mt-0.5">Activity performance overview</p>
    </div>

    {{-- Metric Cards --}}
    <div class="grid grid-cols-3 gap-3 mt-6">
        <div class="bg-beige-100 border border-beige-200 rounded-2xl p-4">
            <p class="text-xs text-brown-200">Total revenue</p>
            <p class="font-playfair text-2xl font-semibold text-brown-400 mt-1">
                {{ number_format($totalRevenue) }} <span class="text-sm font-normal text-brown-200">SAR</span>
            </p>
        </div>
        <div class="bg-beige-100 border border-beige-200 rounded-2xl p-4">
            <p class="text-xs text-brown-200">Activities booked</p>
            <p class="font-playfair text-2xl font-semibold text-brown-400 mt-1">{{ $totalActivities }}</p>
        </div>
        <div class="bg-beige-100 border border-beige-200 rounded-2xl p-4">
            <p class="text-xs text-brown-200">Total orders</p>
            <p class="font-playfair text-2xl font-semibold text-brown-400 mt-1">{{ $totalOrders }}</p>
        </div>
    </div>

    {{-- Activities List --}}
    <div class="mt-6">

        {{-- Header + Sort --}}
        <div class="flex items-center justify-between mb-3">
            <p class="text-sm font-semibold text-brown-400">All activities</p>
            <form method="GET" action="{{ request()->url() }}">
                <select name="filter" onchange="this.form.submit()"
                        class="text-xs text-brown-300 bg-white border border-beige-300 rounded-xl px-3 py-1.5 focus:outline-none cursor-pointer">
                    <option value="all" {{ request('filter') == 'all'       ? 'selected' : '' }}>All time</option>
                    <option value="name" {{ request('filter') == 'name'      ? 'selected' : '' }}>Sort by name</option>
                    <option value="last_day" {{ request('filter') == 'last_day'  ? 'selected' : '' }}>Last day</option>
                    <option value="last_week" {{ request('filter') == 'last_week' ? 'selected' : '' }}>Last week
                    </option>
                    <option value="last_month"{{ request('filter') == 'last_month'? 'selected' : '' }}>Last month
                    </option>
                </select>
            </form>
        </div>

        {{-- List --}}
        <div class="flex flex-col gap-3">
            @forelse($activities as $activity)
                @forelse($activity->orders as $order)
                    <div class="bg-white rounded-2xl border border-beige-200 shadow-sm overflow-hidden">
                        <div class="px-5 py-4 flex items-center gap-4">

                            <div class="w-10 h-10 rounded-xl bg-beige-100 border border-beige-200 flex items-center justify-center shrink-0">
                                <span class="font-playfair text-brown-300 text-xs font-bold">#{{ $order->id }}</span>
                            </div>

                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-brown-400 truncate">{{ $activity->title }}</p>
                                <p class="text-xs text-beige-400 mt-0.5">{{ $order->pivot->created_at->format('M d, Y \a\t h:i A') }}</p>
                            </div>

                            <div class="flex items-center gap-3 shrink-0">
                                <span class="text-xs text-brown-200">×{{ $order->pivot->quantity }}</span>
                                <span class="font-playfair font-bold text-brown-300 text-sm">{{ $activity->price }} SAR</span>
                                <span class="text-xs font-medium text-brown-300 bg-beige-100 border border-beige-300 rounded-lg px-3 py-1.5">
                        Order #{{ $order->id }}
                    </span>
                            </div>

                        </div>
                    </div>
                @empty
                @endforelse
            @empty
                <div class="flex flex-col items-center justify-center py-24 text-beige-400 gap-3">
                    <span class="text-5xl opacity-40">📋</span>
                    <p class="text-sm">No activities found.</p>
                </div>
            @endforelse
        </div>

    </div>
</div>


</body>
</html>
