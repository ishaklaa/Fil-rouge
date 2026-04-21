<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wiqaar — Activities</title>
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

        .activity-card { transition: transform 0.2s ease, box-shadow 0.2s ease; }
        .activity-card:hover { transform: translateY(-3px); box-shadow: 0 12px 32px rgba(92,58,30,0.12); }

        .badge-low { animation: pulse-badge 2s ease-in-out infinite; }
        @keyframes pulse-badge { 0%, 100% { opacity: 1; } 50% { opacity: 0.6; } }

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
            Activities
        </span>
        <a href="{{ route('cashier.dashboard') }}"
           class="flex items-center gap-1.5 bg-brown-300 hover:bg-brown-200 text-beige-200 text-xs font-medium px-3 py-1.5 rounded-xl transition-all">
            Dashboard
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

            <!-- Fixed header -->
            <div class="bg-brown-400 px-5 py-4 shrink-0">
                <p class="font-playfair text-lg text-beige-200 font-semibold">New Activity</p>
                <p class="text-beige-400 text-xs mt-0.5 font-light">Fill in the details below</p>
            </div>

            <!-- Scrollable area -->
            <div class="p-5 overflow-y-auto scroll-y">
                <form action="{{ route('activities.store') }}" method="POST" class="flex flex-col gap-4">
                    @csrf

                    <div class="flex flex-col gap-1.5">
                        <label class="text-xs font-medium text-brown-300 tracking-wide uppercase">Title</label>
                        <input type="text" name="title" value="{{ old('title') }}"
                               placeholder="e.g. Archery Session"
                               class="wq-input w-full bg-beige-50 border border-beige-300 rounded-xl px-4 py-2.5 text-sm text-brown-400 placeholder-beige-400 @error('title') border-red-300 @enderror"/>
                        @error('title')
                        <p class="text-red-400 text-xs">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div class="flex flex-col gap-1.5">
                            <label class="text-xs font-medium text-brown-300 tracking-wide uppercase">Price</label>
                            <div class="flex items-center bg-beige-50 border border-beige-300 rounded-xl px-3 py-2.5 gap-2 focus-within:border-brown-200 focus-within:shadow-[0_0_0_3px_rgba(160,114,74,0.15)] transition-all @error('price') border-red-300 @enderror">
                                <input type="number" name="price" value="{{ old('price') }}" min="0" step="0.01" placeholder="0.00"
                                       class="bg-transparent outline-none text-sm text-brown-400 w-full placeholder-beige-400"/>
                                <span class="text-beige-400 text-xs font-medium shrink-0">SAR</span>
                            </div>
                            @error('price')
                            <p class="text-red-400 text-xs">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label class="text-xs font-medium text-brown-300 tracking-wide uppercase">Quantity</label>
                            <input type="number" name="quantity" value="{{ old('quantity') }}" min="0" placeholder="0"
                                   class="wq-input w-full bg-beige-50 border border-beige-300 rounded-xl px-4 py-2.5 text-sm text-brown-400 placeholder-beige-400 @error('quantity') border-red-300 @enderror"/>
                            @error('quantity')
                            <p class="text-red-400 text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-between bg-beige-50 border border-beige-200 rounded-xl px-4 py-3">
                        <div>
                            <p class="text-sm font-medium text-brown-400">Available</p>
                            <p class="text-xs text-beige-400 mt-0.5">Show in cashier view</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_available" value="1" class="sr-only peer"
                                {{ old('is_available', true) ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-beige-300 peer-checked:bg-brown-300 rounded-full transition-colors duration-200 after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-5 after:shadow-sm"></div>
                        </label>
                    </div>

                    <!-- ✅ Button is INSIDE the form, INSIDE the scrollable div -->
                    <button type="submit"
                            class="w-full bg-brown-400 hover:bg-brown-500 text-beige-100 font-playfair font-semibold rounded-xl py-3 flex items-center justify-center gap-2 transition-all hover:-translate-y-0.5 hover:shadow-lg active:scale-95">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path d="M12 5v14M5 12h14"/>
                        </svg>
                        Create Activity
                    </button>

                </form>
            </div>

        </div>

        <!-- Stats -->
        <div class="bg-white rounded-2xl border border-beige-200 shadow-sm px-5 py-4 flex flex-col gap-3">
            <p class="text-xs font-medium text-brown-300 tracking-widest uppercase">Overview</p>
            <div class="grid grid-cols-3 gap-3 text-center">
                <div class="bg-beige-50 rounded-xl py-3 border border-beige-200">
                    <p class="font-playfair text-2xl font-bold text-brown-400">{{ $activities->count() }}</p>
                    <p class="text-xs text-beige-400 mt-0.5">Total</p>
                </div>
                <div class="bg-beige-50 rounded-xl py-3 border border-beige-200">
                    <p class="font-playfair text-2xl font-bold text-brown-300">{{ $activities->where('is_available', true)->where('quantity', '>', 0)->count() }}</p>
                    <p class="text-xs text-beige-400 mt-0.5">Active</p>
                </div>
                <div class="bg-beige-50 rounded-xl py-3 border border-beige-200">
                    <p class="font-playfair text-2xl font-bold text-red-400">{{ $activities->whereBetween('quantity', [1, 3])->count() }}</p>
                    <p class="text-xs text-beige-400 mt-0.5">Low Stock</p>
                </div>
            </div>
        </div>

    </div>

    <!-- RIGHT — ACTIVITIES GRID -->
    <div class="flex flex-col gap-4 flex-1 overflow-hidden">

        <h2 class="font-playfair text-xl font-semibold text-brown-400 shrink-0">All Activities</h2>

        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm rounded-xl px-4 py-2.5">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-4 overflow-y-auto scroll-y pr-1 flex-1 content-start">

            @forelse($activities as $activity)
                <div class="activity-card bg-white rounded-2xl border border-beige-200 p-4 flex flex-col gap-3">

                    <div class="flex items-start justify-between gap-2">
                        <p class="font-playfair text-base font-semibold text-brown-400 leading-snug">{{ $activity->title }}</p>
                        <span class="shrink-0 text-xs font-medium px-2.5 py-1 rounded-full
                            {{ $activity->is_available && $activity->quantity > 0
                                ? 'bg-emerald-50 text-emerald-600 border border-emerald-200'
                                : 'bg-beige-200 text-beige-400 border border-beige-300' }}">
                            {{ $activity->is_available && $activity->quantity > 0 ? 'Available' : 'Unavailable' }}
                        </span>
                    </div>



                    <div class="border-t border-dashed border-beige-200"></div>

                    <div class="flex items-center justify-between">
                        <p class="font-playfair text-lg font-bold text-brown-300">
                            {{ number_format($activity->price, 2) }}
                            <span class="text-xs font-dm font-normal text-beige-400 ml-1">SAR</span>
                        </p>
                        <div class="flex items-center gap-1.5">
                            @if($activity->quantity > 0 && $activity->quantity <= 3)
                                <span class="badge-low text-[10px] font-medium text-amber-600 bg-amber-50 border border-amber-200 px-2 py-0.5 rounded-full">Low</span>
                            @endif
                            <div class="flex items-center gap-1 bg-beige-100 border border-beige-200 rounded-lg px-2.5 py-1">
                                <svg class="w-3 h-3 text-beige-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M20 7H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2Z"/>
                                </svg>
                                <span class="text-xs font-semibold text-brown-300">{{ $activity->quantity }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-2 mt-1">
                        <button
                            onclick="openEditModal({{ $activity->id }}, '{{ addslashes($activity->title) }}', '{{ addslashes($activity->description) }}', {{ $activity->price }}, {{ $activity->quantity }}, {{ $activity->is_available ? 'true' : 'false' }})"
                            class="flex-1 flex items-center justify-center gap-1.5 bg-beige-100 border border-beige-200 hover:bg-brown-400 hover:text-beige-100 hover:border-brown-400 text-brown-300 text-xs font-medium rounded-xl py-2 transition-all">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5Z"/>
                            </svg>
                            Edit
                        </button>
                    </div>
                </div>

            @empty
                <div class="col-span-full flex flex-col items-center justify-center gap-3 py-24 text-beige-400">
                    <span class="text-6xl opacity-40">🎯</span>
                    <p class="text-sm text-center">No activities yet.<br>Create one on the left to get started.</p>
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
                <p class="font-playfair text-xl text-beige-200 font-semibold">Edit Activity</p>
                <p class="text-beige-400 text-xs mt-0.5 font-light">Update the activity details</p>
            </div>
            <button type="button" onclick="closeEditModal()"
                    class="w-8 h-8 rounded-xl bg-brown-300/50 hover:bg-brown-300 text-beige-300 flex items-center justify-center transition-all text-sm">✕</button>
        </div>

        <form id="edit-form" method="POST" action="">
            @csrf
            @method('PUT')
            <div class="p-6 flex flex-col gap-4">

                <div class="flex flex-col gap-1.5">
                    <label class="text-xs font-medium text-brown-300 tracking-wide uppercase">Title</label>
                    <input type="text" name="title" id="edit_title"
                           class="wq-input w-full bg-beige-50 border border-beige-300 rounded-xl px-4 py-2.5 text-sm text-brown-400 transition-all"/>
                </div>



                <div class="grid grid-cols-2 gap-3">
                    <div class="flex flex-col gap-1.5">
                        <label class="text-xs font-medium text-brown-300 tracking-wide uppercase">Price</label>
                        <div class="flex items-center bg-beige-50 border border-beige-300 rounded-xl px-3 py-2.5 gap-2 focus-within:border-brown-200 focus-within:shadow-[0_0_0_3px_rgba(160,114,74,0.15)] transition-all">
                            <input type="number" name="price" id="edit_price" min="0" step="0.01"
                                   class="bg-transparent outline-none text-sm text-brown-400 w-full"/>
                            <span class="text-beige-400 text-xs font-medium shrink-0">SAR</span>
                        </div>
                    </div>
                    <div class="flex flex-col gap-1.5">
                        <label class="text-xs font-medium text-brown-300 tracking-wide uppercase">Quantity</label>
                        <input type="number" name="quantity" id="edit_quantity" min="0"
                               class="wq-input w-full bg-beige-50 border border-beige-300 rounded-xl px-4 py-2.5 text-sm text-brown-400 transition-all"/>
                    </div>
                </div>

                <div class="flex items-center justify-between bg-beige-50 border border-beige-200 rounded-xl px-4 py-3">
                    <div>
                        <p class="text-sm font-medium text-brown-400">Available</p>
                        <p class="text-xs text-beige-400 mt-0.5">Show in cashier view</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_available" id="edit_available" value="1" class="sr-only peer">
                        <div class="w-11 h-6 bg-beige-300 peer-checked:bg-brown-300 rounded-full transition-colors duration-200 after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-5 after:shadow-sm"></div>
                    </label>
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


<!-- ══════════════════════════════════
     DELETE MODAL
══════════════════════════════════ -->
{{--<div id="delete-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center">
    <div class="absolute inset-0 bg-brown-500/40 backdrop-blur-sm" onclick="closeDeleteModal()"></div>

    <div class="modal-enter relative bg-white rounded-3xl shadow-2xl w-full max-w-sm mx-4 overflow-hidden">
        <div class="h-1.5 bg-gradient-to-r from-red-300 via-red-500 to-red-300"></div>

        <div class="p-7 flex flex-col items-center text-center gap-4">
            <div class="w-16 h-16 rounded-2xl bg-red-50 border border-red-100 flex items-center justify-center text-3xl">🗑️</div>
            <div>
                <p class="font-playfair text-xl font-bold text-brown-500">Delete Activity?</p>
                <p class="text-sm text-brown-200 mt-1.5">
                    You're about to delete <span id="delete_title" class="font-semibold text-brown-400"></span>.
                    This action cannot be undone.
                </p>
            </div>

            <form id="delete-form" method="POST" action="" class="w-full">
                @csrf
                @method('DELETE')
                <div class="flex gap-3">
                    <button type="button" onclick="closeDeleteModal()"
                            class="flex-1 bg-beige-200 border border-beige-300 text-brown-300 font-medium rounded-xl py-3 hover:bg-beige-300 transition-all text-sm active:scale-95">
                        Cancel
                    </button>
                    <button type="submit"
                            class="flex-1 bg-red-500 hover:bg-red-600 text-white font-playfair font-semibold rounded-xl py-3 flex items-center justify-center gap-2 transition-all hover:shadow-lg active:scale-95">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M3 6h18M8 6V4h8v2M19 6l-1 14H6L5 6"/>
                        </svg>
                        Delete
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>--}}

<script>
    function openEditModal(id, title, description, price, quantity, isAvailable) {
        document.getElementById('edit_title').value       = title;
        document.getElementById('edit_price').value       = price;
        document.getElementById('edit_quantity').value    = quantity;
        document.getElementById('edit_available').checked = isAvailable;
        document.getElementById('edit-modal').classList.remove('hidden');
        document.getElementById('edit-form').action = "{{ route('activities.update', '__id__') }}".replace('__id__', id);
    }
    function closeEditModal()  { document.getElementById('edit-modal').classList.add('hidden'); }

 /*   function openDeleteModal(id, title) {
        document.getElementById('delete_title').textContent = title;
        document.getElementById('delete-modal').classList.remove('hidden');


    }
    function closeDeleteModal() { document.getElementById('delete-modal').classList.add('hidden'); }*/
</script>

</body>
</html>
