<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wiqaar — Branches</title>
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
        body { font-family: 'DM Sans', sans-serif; }

        .scroll-y::-webkit-scrollbar { width: 4px; }
        .scroll-y::-webkit-scrollbar-track { background: #f5e9d4; border-radius: 10px; }
        .scroll-y::-webkit-scrollbar-thumb { background: #d4b896; border-radius: 10px; }

        .modal-enter { animation: modalIn 0.25s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; }
        @keyframes modalIn {
            from { opacity: 0; transform: scale(0.92) translateY(12px); }
            to   { opacity: 1; transform: scale(1) translateY(0); }
        }

        .branch-card { transition: transform 0.2s ease, box-shadow 0.2s ease; }
        .branch-card:hover { transform: translateY(-3px); box-shadow: 0 12px 32px rgba(92, 58, 30, 0.12); }

        .wq-input { transition: border-color 0.2s, box-shadow 0.2s; }
        .wq-input:focus {
            outline: none;
            border-color: #a0724a;
            box-shadow: 0 0 0 3px rgba(160, 114, 74, 0.15);
        }


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
            <p class="text-beige-400 text-[10px] font-medium tracking-widest uppercase px-3 mb-1">Main</p>
            @if($user->role_id == 1 || $user->role_id == 2)
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
            @if($user->role_id == 1)
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

    <div class="flex-1 flex flex-col overflow-hidden">
        <div class="flex flex-col lg:flex-row gap-5 p-4 md:p-5 h-full overflow-y-auto lg:overflow-hidden">

            <div class="w-full lg:w-[340px] lg:shrink-0 flex flex-col gap-4">

                <div class="bg-white rounded-2xl border border-beige-200 shadow-xl overflow-hidden flex flex-col min-h-0">
                    <div class="bg-brown-400 px-5 py-4 shrink-0">
                        <p class="font-playfair text-lg text-beige-200 font-semibold">New Branch</p>
                        <p class="text-beige-400 text-xs mt-0.5 font-light">Fill in the details below</p>
                    </div>
                    <div class="p-5 overflow-y-auto scroll-y">
                        <form action="{{ route('branches.store') }}" method="POST" class="flex flex-col gap-4">
                            @csrf

                            <div class="flex flex-col gap-1.5">
                                <label class="text-xs font-medium text-brown-300 tracking-wide uppercase">Branch Name</label>
                                <input type="text" name="name" value="{{ old('name') }}"
                                       placeholder="e.g. Downtown Branch"
                                       class="wq-input w-full bg-beige-50 border border-beige-300 rounded-xl px-4 py-2.5 text-sm text-brown-400 placeholder-beige-400 @error('name') border-red-300 @enderror"/>
                                @error('name')
                                <p class="text-red-400 text-xs">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit"
                                    class="w-full bg-brown-400 hover:bg-brown-500 text-beige-100 font-playfair font-semibold rounded-xl py-3 flex items-center justify-center gap-2 transition-all hover:-translate-y-0.5 hover:shadow-lg active:scale-95">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path d="M12 5v14M5 12h14"/>
                                </svg>
                                Create Branch
                            </button>
                        </form>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-beige-200 shadow-sm px-5 py-4 flex flex-col gap-3">
                    <p class="text-xs font-medium text-brown-300 tracking-widest uppercase">Overview</p>
                    <div class="grid grid-cols-2 gap-3 text-center">
                        <div class="bg-beige-50 rounded-xl py-3 border border-beige-200">
                            <p class="font-playfair text-2xl font-bold text-brown-400">{{ $branches->count() }}</p>
                            <p class="text-xs text-beige-400 mt-0.5">Total Branches</p>
                        </div>
                        <div class="bg-beige-50 rounded-xl py-3 border border-beige-200">
                            <p class="font-playfair text-2xl font-bold text-brown-300">{{ $branches->sum(fn($b) => $b->users->count()) }}</p>
                            <p class="text-xs text-beige-400 mt-0.5">Total Workers</p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="flex flex-col gap-4 flex-1 lg:overflow-hidden">

                <h2 class="font-playfair text-xl font-semibold text-brown-400 shrink-0">All Branches</h2>

                @if(session('success'))
                    <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm rounded-xl px-4 py-2.5">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="flex flex-col gap-3 lg:overflow-y-auto scroll-y lg:pr-1 lg:flex-1 content-start pb-4">

                    @forelse($branches as $branch)
                        <div class="branch-card bg-white rounded-2xl border border-beige-200 px-5 py-4 flex items-center gap-4">

                            <div class="w-11 h-11 rounded-xl bg-beige-100 border border-beige-200 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-brown-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                                    <polyline points="9 22 9 12 15 12 15 22"/>
                                </svg>
                            </div>

                            <div class="flex-1 min-w-0">
                                <p class="font-playfair text-base font-semibold text-brown-400">{{ $branch->name }}</p>
                                <div class="flex items-center gap-1.5 mt-0.5">
                                    <svg class="w-3 h-3 text-beige-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                                        <circle cx="9" cy="7" r="4"/>
                                        <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
                                    </svg>
                                    <p class="text-xs text-brown-200">{{ $branch->users->count() }} {{ Str::plural('worker', $branch->users->count()) }}</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-2 shrink-0">
                                <button
                                    onclick="openEditModal({{ $branch->id }}, '{{ addslashes($branch->name) }}')"
                                    class="flex items-center gap-1.5 bg-beige-100 border border-beige-200 hover:bg-brown-400 hover:text-beige-100 hover:border-brown-400 text-brown-300 text-xs font-medium rounded-xl px-3 py-2 transition-all">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5Z"/>
                                    </svg>
                                    Edit
                                </button>
                            </div>
                        </div>

                    @empty
                        <div class="flex flex-col items-center justify-center gap-3 py-24 text-beige-400">
                            <span class="text-6xl opacity-40">🏢</span>
                            <p class="text-sm text-center">No branches yet.<br>Create one on the left to get started.</p>
                        </div>
                    @endforelse

                </div>
            </div>
        </div>



        <div id="edit-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center">
            <div class="absolute inset-0 bg-brown-500/40 backdrop-blur-sm" onclick="closeEditModal()"></div>

            <div class="modal-enter relative bg-white rounded-3xl shadow-2xl w-full max-w-md mx-4 overflow-hidden">
                <div class="h-1.5 bg-gradient-to-r from-brown-100 via-brown-300 to-brown-100"></div>

                <div class="bg-brown-400 px-6 py-5 flex items-center justify-between">
                    <div>
                        <p class="font-playfair text-xl text-beige-200 font-semibold">Edit Branch</p>
                        <p class="text-beige-400 text-xs mt-0.5 font-light">Update the branch details</p>
                    </div>
                    <button type="button" onclick="closeEditModal()"
                            class="w-8 h-8 rounded-xl bg-brown-300/50 hover:bg-brown-300 text-beige-300 flex items-center justify-center transition-all text-sm">
                        ✕
                    </button>
                </div>

                <form id="edit-form" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="p-6 flex flex-col gap-4">

                        <div class="flex flex-col gap-1.5">
                            <label class="text-xs font-medium text-brown-300 tracking-wide uppercase">Branch Name</label>
                            <input type="text" name="name" id="edit_name"
                                   class="wq-input w-full bg-beige-50 border border-beige-300 rounded-xl px-4 py-2.5 text-sm text-brown-400 transition-all"/>
                        </div>

                        <div class="flex gap-3 mt-1">
                            <button type="button" onclick="closeEditModal()"
                                    class="flex-1 bg-beige-200 border border-beige-300 text-brown-300 font-medium rounded-xl py-3 hover:bg-beige-300 transition-all text-sm active:scale-95">
                                Cancel
                            </button>
                            <button type="submit"
                                    class="flex-1 bg-brown-400 hover:bg-brown-500 text-beige-100 font-playfair font-semibold rounded-xl py-3 flex items-center justify-center gap-2 transition-all hover:shadow-lg active:scale-95">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2Z"/>
                                    <path d="M17 21v-8H7v8M7 3v5h8"/>
                                </svg>
                                Save Changes
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<script>
    function openEditModal(id, name) {
        document.getElementById('edit_name').value = name;
        document.getElementById('edit-form').action = "{{ route('branches.update', '__id__') }}".replace('__id__', id);
        document.getElementById('edit-modal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('edit-modal').classList.add('hidden');
    }
</script>

</body>
</html>
