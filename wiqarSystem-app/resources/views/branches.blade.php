<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wiqaar — Branches</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        beige: { 50: '#fefaf4', 100: '#fdf6ec', 200: '#f5e9d4', 300: '#e8d5b5', 400: '#d4b896' },
                        brown: { 100: '#c49a6c', 200: '#a0724a', 300: '#7d5230', 400: '#5c3a1e', 500: '#3d2410' },
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
        .branch-card:hover { transform: translateY(-3px); box-shadow: 0 12px 32px rgba(92,58,30,0.12); }

        .wq-input { transition: border-color 0.2s, box-shadow 0.2s; }
        .wq-input:focus { outline: none; border-color: #a0724a; box-shadow: 0 0 0 3px rgba(160,114,74,0.15); }
    </style>
</head>
<body class="bg-beige-100 min-h-screen">

<!-- ── HEADER ── -->
<header class="bg-brown-400 px-6 h-14 flex items-center justify-between shadow-lg sticky top-0 z-50">
    <h1 class="font-playfair text-2xl font-bold text-beige-200 tracking-widest">
        WI<span class="text-brown-100">QA</span>AR
    </h1>
    <div class="flex items-center gap-3">
        <span class="bg-brown-300 text-beige-200 text-xs font-medium px-4 py-1 rounded-full tracking-widest uppercase">
            Branches
        </span>
        <a href="{{ route('cashier.dashboard') }}"
           class="flex items-center gap-1.5 bg-brown-300 hover:bg-brown-200 text-beige-200 text-xs font-medium px-3 py-1.5 rounded-xl transition-all">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M3 12h18M3 6h18M3 18h18"/>
            </svg>
            Cashier
        </a>
        <a href="{{ route('activities.index') }}"
           class="flex items-center gap-1.5 bg-brown-300 hover:bg-brown-200 text-beige-200 text-xs font-medium px-3 py-1.5 rounded-xl transition-all">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M13 10V3L4 14h7v7l9-11h-7Z"/>
            </svg>
            Activities
        </a>
        <a href="{{ route('order.history') }}"
           class="flex items-center gap-1.5 bg-brown-300 hover:bg-brown-200 text-beige-200 text-xs font-medium px-3 py-1.5 rounded-xl transition-all">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M12 8v4l3 3m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
            </svg>
            History
        </a>
        <a href="/logout"
           class="flex items-center gap-1.5 bg-red-900/40 hover:bg-red-700 text-red-200 text-xs font-medium px-3 py-1.5 rounded-xl transition-all">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4M16 17l5-5-5-5M21 12H9"/>
            </svg>
            Logout
        </a>
    </div>
</header>

<!-- ── MAIN ── -->
<div class="flex gap-5 p-5 h-[calc(100vh-56px)]">

    <!-- LEFT — CREATE FORM -->
    <div class="w-[340px] shrink-0 flex flex-col gap-4">

        <div class="bg-white rounded-2xl border border-beige-200 shadow-xl overflow-hidden flex flex-col min-h-0">

            <div class="bg-brown-400 px-5 py-4 shrink-0">
                <p class="font-playfair text-lg text-beige-200 font-semibold">New Branch</p>
                <p class="text-beige-400 text-xs mt-0.5 font-light">Fill in the details below</p>
            </div>

            <div class="p-5 overflow-y-auto scroll-y">
                <form action="{{ route('branches.store') }}" method="POST" class="flex flex-col gap-4">
                    @csrf

                    <!-- Name -->
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

        <!-- Stats -->
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

    <!-- RIGHT — BRANCHES LIST -->
    <div class="flex flex-col gap-4 flex-1 overflow-hidden">

        <h2 class="font-playfair text-xl font-semibold text-brown-400 shrink-0">All Branches</h2>

        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm rounded-xl px-4 py-2.5">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex flex-col gap-3 overflow-y-auto scroll-y pr-1 flex-1 content-start">

            @forelse($branches as $branch)
                <div class="branch-card bg-white rounded-2xl border border-beige-200 px-5 py-4 flex items-center gap-4">

                    <!-- Icon -->
                    <div class="w-11 h-11 rounded-xl bg-beige-100 border border-beige-200 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-brown-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                            <polyline points="9 22 9 12 15 12 15 22"/>
                        </svg>
                    </div>

                    <!-- Info -->
                    <div class="flex-1 min-w-0">
                        <p class="font-playfair text-base font-semibold text-brown-400">{{ $branch->name }}</p>
                        <div class="flex items-center gap-1.5 mt-0.5">
                            <svg class="w-3 h-3 text-beige-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
                            </svg>
                            <p class="text-xs text-brown-200">{{ $branch->users->count() }} {{ Str::plural('worker', $branch->users->count()) }}</p>
                        </div>
                    </div>

                    <!-- Actions -->
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


<!-- ══════════════════════════════════
     EDIT MODAL
══════════════════════════════════ -->
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
                    class="w-8 h-8 rounded-xl bg-brown-300/50 hover:bg-brown-300 text-beige-300 flex items-center justify-center transition-all text-sm">✕</button>
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




<script>
    function openEditModal(id, name) {
        document.getElementById('edit_name').value  = name;
        document.getElementById('edit-form').action = "{{ route('branches.update', '__id__') }}".replace('__id__', id);
        document.getElementById('edit-modal').classList.remove('hidden');
    }
    function closeEditModal() { document.getElementById('edit-modal').classList.add('hidden'); }


</script>

</body>
</html>
