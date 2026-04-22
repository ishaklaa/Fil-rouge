<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wiqaar — Statistics</title>
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
                        beige: {50: '#fefaf4', 100: '#fdf6ec', 200: '#f5e9d4', 300: '#e8d5b5', 400: '#d4b896'},
                        brown: {100: '#c49a6c', 200: '#a0724a', 300: '#7d5230', 400: '#5c3a1e', 500: '#3d2410'},
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

        .nav-link {
            transition: all 0.2s ease;
        }

        .nav-link:hover {
            transform: translateX(3px);
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
<body class="bg-beige-100">

<div class="flex h-screen overflow-hidden">

    <!-- ── ASIDE ── -->
    <aside class="w-56 shrink-0 bg-brown-400 flex flex-col h-full shadow-2xl">
        <div class="px-5 py-5 border-b border-brown-300/40">
            <h1 class="font-playfair text-2xl font-bold text-beige-200 tracking-widest">
                WI<span class="text-brown-100">QA</span>AR
            </h1>
            <p class="text-beige-400 text-xs mt-0.5 font-light tracking-widest uppercase">{{ ucfirst(Auth::user()->role->name ?? '') }}
                Panel</p>
        </div>
        <nav class="flex-1 px-3 py-4 flex flex-col gap-1 overflow-y-auto scroll-y">
            <p class="text-beige-400 text-[10px] font-medium tracking-widest uppercase px-3 mb-1">Main</p>
            @if($user->role_id == 1|| $user->role_id == 2)

                <a href="{{ route('admin.dashboard') }}"
                   class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-beige-200 hover:bg-brown-300/50 text-sm font-medium">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <rect x="3" y="3" width="7" height="7"/>
                        <rect x="14" y="3" width="7" height="7"/>
                        <rect x="14" y="14" width="7" height="7"/>
                        <rect x="3" y="14" width="7" height="7"/>
                    </svg>
                    Dashboard
                </a>
            @endif
            @if($user->role_id == 1)
                <p class="text-beige-400 text-[10px] font-medium tracking-widests uppercase px-3 mt-3 mb-1">Manage</p>

                <a href="{{ route('profiles.index') }}"
                   class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-beige-200 hover:bg-brown-300/50 text-sm font-medium">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                    Profiles
                </a>

                <a href="{{ route('branches.index') }}"
                   class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-beige-200 hover:bg-brown-300/50 text-sm font-medium">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                        <polyline points="9 22 9 12 15 12 15 22"/>
                    </svg>
                    Branches
                </a>

                <a href="{{ route('activities.index') }}"
                   class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-beige-200 hover:bg-brown-300/50 text-sm font-medium">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <path d="M13 10V3L4 14h7v7l9-11h-7Z"/>
                    </svg>
                    Activities
                </a>
            @endif

            <p class="text-beige-400 text-[10px] font-medium tracking-widest uppercase px-3 mt-3 mb-1">Reports</p>
            <a href="{{ route('order.history') }}"
               class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-beige-200 hover:bg-brown-300/50 text-sm font-medium">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M12 8v4l3 3m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                History
            </a>
            @if($user->role_id == 1|| $user->role_id == 2)
                <a href="{{ route('cashier.statistics') }}"
                   class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-beige-200 hover:bg-brown-300/50 text-sm font-medium">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <path d="M3 3v18h18"/>
                        <path d="M18 17V9M13 17V5M8 17v-3"/>
                    </svg>
                    Statistics
                </a>
            @endif

        </nav>
        <div class="px-3 py-4 border-t border-brown-300/40 flex flex-col gap-2">
            <div class="flex items-center gap-3 px-3 py-2">
                <div class="w-8 h-8 rounded-lg bg-brown-300 flex items-center justify-center shrink-0">
                    <span
                        class="font-playfair text-sm font-bold text-beige-200">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-beige-200 text-sm font-medium truncate">{{ Auth::user()->name }}</p>
                    <p class="text-beige-400 text-xs truncate">{{ ucfirst(Auth::user()->role->name ?? '') }}</p>
                </div>
            </div>
            <a href="/logout"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl bg-red-900/30 hover:bg-red-700/60 text-red-200 text-sm font-medium transition-all">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4M16 17l5-5-5-5M21 12H9"/>
                </svg>
                Logout
            </a>
        </div>
    </aside>

    <!-- ── MAIN CONTENT ── -->
    <div class="flex-1 overflow-y-auto scroll-y p-6 flex flex-col gap-6">

        {{-- Page Title --}}
        <div>
            <h2 class="font-playfair text-2xl font-semibold text-brown-400">Statistics</h2>
            <p class="text-sm text-brown-200 mt-0.5">Activity performance overview</p>
        </div>

        {{-- Metric Cards --}}
        <div class="grid grid-cols-3 gap-4">
            <div class="bg-white border border-beige-200 rounded-2xl shadow-sm p-5">
                <p class="text-xs text-brown-200 tracking-wide uppercase">Total Revenue</p>
                <p class="font-playfair text-3xl font-bold text-brown-400 mt-1">
                    {{ number_format($totalRevenue) }}
                    <span class="text-sm font-normal text-brown-200">SAR</span>
                </p>
            </div>
            <div class="bg-white border border-beige-200 rounded-2xl shadow-sm p-5">
                <p class="text-xs text-brown-200 tracking-wide uppercase">Activities Booked</p>
                <p class="font-playfair text-3xl font-bold text-brown-400 mt-1">{{ $totalActivities }}</p>
            </div>
            <div class="bg-white border border-beige-200 rounded-2xl shadow-sm p-5">
                <p class="text-xs text-brown-200 tracking-wide uppercase">Total Orders</p>
                <p class="font-playfair text-3xl font-bold text-brown-400 mt-1">{{ $totalOrders }}</p>
            </div>
        </div>

        {{-- Activities List --}}
        <div class="bg-white rounded-2xl border border-beige-200 shadow-sm p-5 flex flex-col gap-4">

            {{-- Header + Filter --}}
            <div class="flex items-center justify-between">
                <p class="text-sm font-semibold text-brown-400">All Activities</p>
                <form method="GET" action="{{ request()->url() }}">
                    <select name="filter" onchange="this.form.submit()"
                            class="text-xs text-brown-300 bg-beige-50 border border-beige-300 rounded-xl px-3 py-1.5 focus:outline-none cursor-pointer">
                        <option value="all" {{ request('filter') == 'all'        ? 'selected' : '' }}>All time</option>
                        <option value="name" {{ request('filter') == 'name'       ? 'selected' : '' }}>Sort by name
                        </option>
                        <option value="last_day" {{ request('filter') == 'last_day'   ? 'selected' : '' }}>Last day
                        </option>
                        <option value="last_week" {{ request('filter') == 'last_week'  ? 'selected' : '' }}>Last week
                        </option>
                        <option value="last_month" {{ request('filter') == 'last_month' ? 'selected' : '' }}>Last
                            month
                        </option>
                    </select>
                </form>
            </div>

            {{-- List --}}
            <div class="flex flex-col gap-3">
                @forelse($activities as $activity)
                    @forelse($activity->orders as $order)
                        <div class="order-card bg-beige-50 rounded-2xl border border-beige-200 overflow-hidden">
                            <div class="px-5 py-4 flex items-center gap-4">
                                <div
                                    class="w-10 h-10 rounded-xl bg-white border border-beige-200 flex items-center justify-center shrink-0">
                                    <span
                                        class="font-playfair text-brown-300 text-xs font-bold">#{{ $order->id }}</span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-brown-400 truncate">{{ $activity->title }}</p>
                                    <p class="text-xs text-beige-400 mt-0.5">{{ $order->pivot->created_at->format('M d, Y \a\t h:i A') }}</p>
                                </div>
                                <div class="flex items-center gap-3 shrink-0">
                                    <span class="text-xs text-brown-200">×{{ $order->pivot->quantity }}</span>
                                    <span class="font-playfair font-bold text-brown-300 text-sm">{{ $activity->price }} SAR</span>
                                    <span
                                        class="text-xs font-medium text-brown-300 bg-white border border-beige-300 rounded-lg px-3 py-1.5">
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

</div>

</body>
</html>
