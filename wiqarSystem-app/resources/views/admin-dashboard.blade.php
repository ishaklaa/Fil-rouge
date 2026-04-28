<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wiqaar — Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500&display=swap"
        rel="stylesheet">
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
        body { font-family: 'DM Sans', sans-serif; }

        .scroll-y::-webkit-scrollbar { width: 4px; }
        .scroll-y::-webkit-scrollbar-track { background: #f5e9d4; border-radius: 10px; }
        .scroll-y::-webkit-scrollbar-thumb { background: #d4b896; border-radius: 10px; }

        .nav-link { transition: all 0.2s ease; }
        .nav-link:hover { transform: translateX(3px); }
        .nav-link.active {
            background: rgba(196, 154, 108, 0.15);
            border-left: 3px solid #c49a6c;
        }

        /* Mobile sidebar slide */
        #sidebar { transition: transform 0.3s ease; }
        @media (max-width: 767px) {
            #sidebar {
                position: fixed;
                top: 0; left: 0;
                height: 100%;
                z-index: 40;
                transform: translateX(-100%);
            }
            #sidebar.open { transform: translateX(0); }
        }
    </style>
</head>
<body class="bg-beige-100 min-h-screen">


<div class="md:hidden flex items-center justify-between bg-brown-400 px-4 py-3 sticky top-0 z-30">
    <h1 class="font-playfair text-xl font-bold text-beige-200 tracking-widest">
        WI<span class="text-brown-100">QA</span>AR
    </h1>
    <button onclick="document.getElementById('sidebar').classList.toggle('open'); document.getElementById('sidebar-overlay').classList.toggle('hidden')"
            class="text-beige-200 p-1">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
    </button>
</div>


<div id="sidebar-overlay" class="hidden fixed inset-0 bg-black/40 z-30 md:hidden"
     onclick="document.getElementById('sidebar').classList.remove('open'); this.classList.add('hidden')"></div>

<div class="flex md:h-screen md:overflow-hidden">

    <aside id="sidebar" class="w-56 shrink-0 bg-brown-400 flex flex-col h-full shadow-2xl">
        <div class="px-5 py-5 border-b border-brown-300/40">
            <h1 class="font-playfair text-2xl font-bold text-beige-200 tracking-widest hidden md:block">
                WI<span class="text-brown-100">QA</span>AR
            </h1>
            <p class="text-beige-400 text-xs mt-0.5 font-light tracking-widest uppercase">{{ ucfirst(Auth::user()->role->name ?? '') }} Panel</p>
        </div>
        <nav class="flex-1 px-3 py-4 flex flex-col gap-1 overflow-y-auto scroll-y">
            @if($user->role_id == 1 || $user->role_id == 2)
                <p class="text-beige-400 text-[10px] font-medium tracking-widest uppercase px-3 mb-1">Main</p>
                <a href="{{ route('admin.dashboard') }}"
                   class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-beige-200 hover:bg-brown-300/50 text-sm font-medium">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <rect x="3" y="3" width="7" height="7"/>
                        <rect x="14" y="3" width="7" height="7"/>
                        <rect x="14" y="14" width="7" height="7"/>
                        <rect x="3" y="14" width="7" height="7"/>
                    </svg>
                    Dashboard
                </a>
            @endif
            @if($user->role_id == 1 || $user->role_id == 2)
                <p class="text-beige-400 text-[10px] font-medium tracking-widest uppercase px-3 mt-3 mb-1">Manage</p>
                <a href="{{ route('profiles.index') }}"
                   class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-beige-200 hover:bg-brown-300/50 text-sm font-medium">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                    Profiles
                </a>
                <a href="{{ route('branches.index') }}"
                   class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-beige-200 hover:bg-brown-300/50 text-sm font-medium">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                        <polyline points="9 22 9 12 15 12 15 22"/>
                    </svg>
                    Branches
                </a>
                <a href="{{ route('activities.index') }}"
                   class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-beige-200 hover:bg-brown-300/50 text-sm font-medium">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
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
            @if($user->role_id == 1 || $user->role_id == 2)
                <a href="{{ route('cashier.statistics') }}"
                   class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-beige-200 hover:bg-brown-300/50 text-sm font-medium">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
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
                    <span class="font-playfair text-sm font-bold text-beige-200">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
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

    <main class="flex-1 overflow-y-auto scroll-y bg-beige-100 p-4 md:p-6">

        <div class="mb-6">
            <h2 class="font-playfair text-2xl font-bold text-brown-400">Dashboard</h2>
            <p class="text-xs text-beige-400 mt-0.5" id="clock"></p>
        </div>

        <div class="grid grid-cols-2 xl:grid-cols-4 gap-4 mb-6">

            <div class="bg-white rounded-2xl border border-beige-200 shadow-sm p-5 flex flex-col gap-2">
                <div class="flex items-center justify-between">
                    <p class="text-xs font-medium text-brown-300 tracking-widest uppercase">Profiles</p>
                    <div class="w-8 h-8 rounded-xl bg-beige-100 flex items-center justify-center">
                        <svg class="w-4 h-4 text-brown-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                        </svg>
                    </div>
                </div>
                <p class="font-playfair text-3xl font-bold text-brown-400">{{ $totalUsers }}</p>
                <p class="text-xs text-beige-400">Total users in system</p>
            </div>

            <div class="bg-white rounded-2xl border border-beige-200 shadow-sm p-5 flex flex-col gap-2">
                <div class="flex items-center justify-between">
                    <p class="text-xs font-medium text-brown-300 tracking-widest uppercase">Branches</p>
                    <div class="w-8 h-8 rounded-xl bg-beige-100 flex items-center justify-center">
                        <svg class="w-4 h-4 text-brown-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                        </svg>
                    </div>
                </div>
                <p class="font-playfair text-3xl font-bold text-brown-400">{{ $totalBranches }}</p>
                <p class="text-xs text-beige-400">Active branches</p>
            </div>

            <div class="bg-white rounded-2xl border border-beige-200 shadow-sm p-5 flex flex-col gap-2">
                <div class="flex items-center justify-between">
                    <p class="text-xs font-medium text-brown-300 tracking-widest uppercase">Activities</p>
                    <div class="w-8 h-8 rounded-xl bg-beige-100 flex items-center justify-center">
                        <svg class="w-4 h-4 text-brown-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M13 10V3L4 14h7v7l9-11h-7Z"/>
                        </svg>
                    </div>
                </div>
                <p class="font-playfair text-3xl font-bold text-brown-400">{{ $totalActivities }}</p>
                <p class="text-xs text-beige-400">Total activities</p>
            </div>

            <div class="bg-white rounded-2xl border border-beige-200 shadow-sm p-5 flex flex-col gap-2">
                <div class="flex items-center justify-between">
                    <p class="text-xs font-medium text-brown-300 tracking-widest uppercase">Orders Today</p>
                    <div class="w-8 h-8 rounded-xl bg-beige-100 flex items-center justify-center">
                        <svg class="w-4 h-4 text-brown-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/>
                            <path d="M3 6h18M16 10a4 4 0 0 1-8 0"/>
                        </svg>
                    </div>
                </div>
                <p class="font-playfair text-3xl font-bold text-brown-400">{{ $ordersToday }}</p>
                <p class="text-xs text-beige-400">Orders placed today</p>
            </div>

        </div>

        <div class="bg-white rounded-2xl border border-beige-200 shadow-sm p-5">
            <div class="flex items-center justify-between mb-4">
                <p class="text-sm font-medium text-brown-400 tracking-wide">Recent Profiles</p>
                <a href="{{ route('profiles.index') }}" class="text-xs text-brown-200 hover:text-brown-400 transition-all">View all →</a>
            </div>
            <div class="flex flex-col gap-2">
                @forelse($recentUsers as $user)
                    <div class="flex items-center gap-3 py-2 border-b border-beige-100 last:border-0">
                        <div class="w-8 h-8 rounded-lg bg-brown-400 flex items-center justify-center shrink-0">
                            <span class="font-playfair text-sm font-bold text-beige-200">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-brown-400 truncate">{{ $user->name }}</p>
                            <p class="text-xs text-beige-400 truncate">{{ $user->email }}</p>
                        </div>
                        <div class="flex items-center gap-2 shrink-0">
                            <span class="text-xs text-brown-200 hidden sm:inline">{{ ucfirst($user->role->name ?? '—') }}</span>
                            <span class="text-xs font-medium px-2 py-0.5 rounded-full
                                {{ $user->status === 'active' ? 'bg-emerald-50 text-emerald-600 border border-emerald-200' : 'bg-red-50 text-red-400 border border-red-200' }}">
                                {{ ucfirst($user->status) }}
                            </span>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-beige-400 text-center py-4">No profiles yet.</p>
                @endforelse
            </div>
        </div>

    </main>
</div>

<script>
    function updateClock() {
        const now = new Date();
        document.getElementById('clock').textContent = now.toLocaleDateString('en-US', {
            weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
        });
    }

    updateClock();
    setInterval(updateClock, 1000);
</script>

</body>
</html>
