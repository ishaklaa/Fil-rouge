<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wiqaar — Profiles</title>
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

        .modal-enter {
            animation: modalIn 0.25s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
        }

        @keyframes modalIn {
            from {
                opacity: 0;
                transform: scale(0.92) translateY(12px);
            }
            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        .profile-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .profile-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 32px rgba(92, 58, 30, 0.12);
        }

        .wq-input {
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .wq-input:focus {
            outline: none;
            border-color: #a0724a;
            box-shadow: 0 0 0 3px rgba(160, 114, 74, 0.15);
        }

        .wq-select {
            transition: border-color 0.2s, box-shadow 0.2s;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23d4b896' stroke-width='2'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 16px;
        }

        .wq-select:focus {
            outline: none;
            border-color: #a0724a;
            box-shadow: 0 0 0 3px rgba(160, 114, 74, 0.15);
        }
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
            Profiles
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

            <div class="bg-brown-400 px-5 py-4 shrink-0">
                <p class="font-playfair text-lg text-beige-200 font-semibold">New Profile</p>
                <p class="text-beige-400 text-xs mt-0.5 font-light">Fill in the details below</p>
            </div>

            <div class="p-5 overflow-y-auto scroll-y">
                <form action="{{ route('profiles.store') }}" method="POST" class="flex flex-col gap-4">
                    @csrf

                    {{-- Name --}}
                    <div class="flex flex-col gap-1.5">
                        <label class="text-xs font-medium text-brown-300 tracking-wide uppercase">Name</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                               placeholder="e.g. Ahmed Al-Rashid"
                               class="wq-input w-full bg-beige-50 border border-beige-300 rounded-xl px-4 py-2.5 text-sm text-brown-400 placeholder-beige-400 @error('name') border-red-300 @enderror"/>
                        @error('name')
                        <p class="text-red-400 text-xs">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="flex flex-col gap-1.5">
                        <label class="text-xs font-medium text-brown-300 tracking-wide uppercase">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                               placeholder="e.g. ahmed@wiqaar.com"
                               class="wq-input w-full bg-beige-50 border border-beige-300 rounded-xl px-4 py-2.5 text-sm text-brown-400 placeholder-beige-400 @error('email') border-red-300 @enderror"/>
                        @error('email')
                        <p class="text-red-400 text-xs">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="flex flex-col gap-1.5">
                        <label class="text-xs font-medium text-brown-300 tracking-wide uppercase">Password</label>
                        <input type="password" name="password"
                               placeholder="••••••••"
                               class="wq-input w-full bg-beige-50 border border-beige-300 rounded-xl px-4 py-2.5 text-sm text-brown-400 placeholder-beige-400 @error('password') border-red-300 @enderror"/>
                        @error('password')
                        <p class="text-red-400 text-xs">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Role --}}
                    <div class="flex flex-col gap-1.5">
                        <label class="text-xs font-medium text-brown-300 tracking-wide uppercase">Role</label>
                        <select name="role_id" id="role_select"
                                class="wq-select w-full bg-beige-50 border border-beige-300 rounded-xl px-4 py-2.5 text-sm text-brown-400 @error('role_id') border-red-300 @enderror">
                            <option value="" disabled {{ old('role_id') ? '' : 'selected' }}>Select a role</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                    {{ ucfirst($role->name) }}
                                </option>
                            @endforeach
                        </select>
                        @error('role_id')
                        <p class="text-red-400 text-xs">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Branch --}}
                    <div class="flex flex-col gap-1.5">
                        <label class="text-xs font-medium text-brown-300 tracking-wide uppercase">Branch</label>
                        <select name="branch_id"
                                class="wq-select w-full bg-beige-50 border border-beige-300 rounded-xl px-4 py-2.5 text-sm text-brown-400 @error('branch_id') border-red-300 @enderror">
                            <option value="" disabled {{ old('branch_id') ? '' : 'selected' }}>Select a branch</option>
                            @foreach($branches as $branch)
                                <option
                                    value="{{ $branch->id }}" {{ old('branch_id') == $branch->id ? 'selected' : '' }}>
                                    {{ $branch->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('branch_id')
                        <p class="text-red-400 text-xs">{{ $message }}</p>
                        @enderror
                    </div>


                    <button type="submit"
                            class="w-full bg-brown-400 hover:bg-brown-500 text-beige-100 font-playfair font-semibold rounded-xl py-3 flex items-center justify-center gap-2 transition-all hover:-translate-y-0.5 hover:shadow-lg active:scale-95">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path d="M12 5v14M5 12h14"/>
                        </svg>
                        Create Profile
                    </button>

                </form>
            </div>
        </div>

        <!-- Stats -->
        <div class="bg-white rounded-2xl border border-beige-200 shadow-sm px-5 py-4 flex flex-col gap-3">
            <p class="text-xs font-medium text-brown-300 tracking-widest uppercase">Overview</p>
            <div class="grid grid-cols-3 gap-3 text-center">
                <div class="bg-beige-50 rounded-xl py-3 border border-beige-200">
                    <p class="font-playfair text-2xl font-bold text-brown-400">{{ $users->count() }}</p>
                    <p class="text-xs text-beige-400 mt-0.5">Total</p>
                </div>
                <div class="bg-beige-50 rounded-xl py-3 border border-beige-200">
                    <p class="font-playfair text-2xl font-bold text-brown-300">{{ $users->where('status','active')->count() }}</p>
                    <p class="text-xs text-beige-400 mt-0.5">Active</p>
                </div>
                <div class="bg-beige-50 rounded-xl py-3 border border-beige-200">
                    <p class="font-playfair text-2xl font-bold text-red-400">{{ $users->where('status','blocked')->count() }}</p>
                    <p class="text-xs text-beige-400 mt-0.5">Blocked</p>
                </div>
            </div>
        </div>

    </div>

    <!-- RIGHT — PROFILES GRID -->
    <div class="flex flex-col gap-4 flex-1 overflow-hidden">

        <h2 class="font-playfair text-xl font-semibold text-brown-400 shrink-0">All Profiles</h2>

        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm rounded-xl px-4 py-2.5">
                {{ session('success') }}
            </div>
        @endif

        <div
            class="grid grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-4 overflow-y-auto scroll-y pr-1 flex-1 content-start">

            @forelse($users as $user)
                <div class="profile-card bg-white rounded-2xl border border-beige-200 p-4 flex flex-col gap-3">

                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-brown-400 flex items-center justify-center shrink-0">
                            <span class="font-playfair text-base font-bold text-beige-200">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-playfair text-base font-semibold text-brown-400 truncate">{{ $user->name }}</p>
                            <p class="text-xs text-beige-400 truncate">{{ $user->email }}</p>
                        </div>
                        <span class="shrink-0 text-xs font-medium px-2.5 py-1 rounded-full
                            {{ $user->status === 'active'
                                ? 'bg-emerald-50 text-emerald-600 border border-emerald-200'
                                : 'bg-red-50 text-red-400 border border-red-200' }}">
                            {{ ucfirst($user->status) }}
                        </span>
                    </div>

                    <div class="border-t border-dashed border-beige-200"></div>

                    <div class="flex flex-col gap-1.5">
                        <div class="flex items-center gap-2">
                            <svg class="w-3.5 h-3.5 text-beige-400 shrink-0" fill="none" stroke="currentColor"
                                 stroke-width="2" viewBox="0 0 24 24">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                                <circle cx="9" cy="7" r="4"/>
                            </svg>
                            <span
                                class="text-xs text-brown-300 font-medium">{{ ucfirst($user->role->name ?? '—') }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-3.5 h-3.5 text-beige-400 shrink-0" fill="none" stroke="currentColor"
                                 stroke-width="2" viewBox="0 0 24 24">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                                <polyline points="9 22 9 12 15 12 15 22"/>
                            </svg>
                            <span class="text-xs text-brown-300 font-medium">{{ $user->branch->name ?? '—' }}</span>
                        </div>
                        @if($user->role_id == 3 && $user->shifts->isNotEmpty())
                            @foreach($user->shifts as $shift)
                                <div class="flex items-center gap-2">
                                    <svg class="w-3.5 h-3.5 text-beige-400 shrink-0" fill="none" stroke="currentColor"
                                         stroke-width="2" viewBox="0 0 24 24">
                                        <circle cx="12" cy="12" r="10"/>
                                        <path d="M12 6v6l4 2"/>
                                    </svg>
                                    <span class="text-xs text-brown-300 font-medium">
                {{ \Carbon\Carbon::parse($shift->created_at)->format('H:i') }} — {{ \Carbon\Carbon::parse($shift->ends_at)->format('H:i') }}
            </span>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <div class="flex gap-2 mt-1">
                        <button
                            onclick="openEditModal({{ $user->id }}, '{{ addslashes($user->name) }}', '{{ addslashes($user->email) }}', {{ $user->role_id }}, {{ $user->branch_id }}, '{{ $user->status }}')"
                            class="flex-1 flex items-center justify-center gap-1.5 bg-beige-100 border border-beige-200 hover:bg-brown-400 hover:text-beige-100 hover:border-brown-400 text-brown-300 text-xs font-medium rounded-xl py-2 transition-all">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                 viewBox="0 0 24 24">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5Z"/>
                            </svg>
                            Edit
                        </button>
                    </div>

                </div>
            @empty
                <div class="col-span-full flex flex-col items-center justify-center gap-3 py-24 text-beige-400">
                    <span class="text-6xl opacity-40">👤</span>
                    <p class="text-sm text-center">No profiles yet.<br>Create one on the left to get started.</p>
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
                <p class="font-playfair text-xl text-beige-200 font-semibold">Edit Profile</p>
                <p class="text-beige-400 text-xs mt-0.5 font-light">Update the profile details</p>
            </div>
            <button type="button" onclick="closeEditModal()"
                    class="w-8 h-8 rounded-xl bg-brown-300/50 hover:bg-brown-300 text-beige-300 flex items-center justify-center transition-all text-sm">
                ✕
            </button>
        </div>

        <form id="edit-form" method="POST" action="">
            @csrf
            @method('PUT')
            <div class="p-6 flex flex-col gap-4 overflow-y-auto scroll-y max-h-[70vh]">

                <div class="flex flex-col gap-1.5">
                    <label class="text-xs font-medium text-brown-300 tracking-wide uppercase">Name</label>
                    <input type="text" name="name" id="edit_name"
                           class="wq-input w-full bg-beige-50 border border-beige-300 rounded-xl px-4 py-2.5 text-sm text-brown-400"/>
                </div>

                <div class="flex flex-col gap-1.5">
                    <label class="text-xs font-medium text-brown-300 tracking-wide uppercase">Email</label>
                    <input type="email" name="email" id="edit_email"
                           class="wq-input w-full bg-beige-50 border border-beige-300 rounded-xl px-4 py-2.5 text-sm text-brown-400"/>
                </div>

                <div class="flex flex-col gap-1.5">
                    <label class="text-xs font-medium text-brown-300 tracking-wide uppercase">
                        New Password
                        <span class="text-beige-400 normal-case font-light">(leave blank to keep)</span>
                    </label>
                    <input type="password" name="password" placeholder="••••••••"
                           class="wq-input w-full bg-beige-50 border border-beige-300 rounded-xl px-4 py-2.5 text-sm text-brown-400 placeholder-beige-400"/>
                </div>

                <div class="flex flex-col gap-1.5">
                    <label class="text-xs font-medium text-brown-300 tracking-wide uppercase">Role</label>
                    <select name="role_id" id="edit_role"

                            class="wq-select w-full bg-beige-50 border border-beige-300 rounded-xl px-4 py-2.5 text-sm text-brown-400">
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex flex-col gap-1.5">
                    <label class="text-xs font-medium text-brown-300 tracking-wide uppercase">Branch</label>
                    <select name="branch_id" id="edit_branch"
                            class="wq-select w-full bg-beige-50 border border-beige-300 rounded-xl px-4 py-2.5 text-sm text-brown-400">
                        @foreach($branches as $branch)
                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-center justify-between bg-beige-50 border border-beige-200 rounded-xl px-4 py-3">
                    <div>
                        <p class="text-sm font-medium text-brown-400">Status</p>
                        <p class="text-xs text-beige-400 mt-0.5">Active or blocked</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="status" id="edit_status" value="active" class="sr-only peer">
                        <div
                            class="w-11 h-6 bg-beige-300 peer-checked:bg-brown-300 rounded-full transition-colors duration-200 after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-5 after:shadow-sm"></div>
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

<script>


    function openEditModal(id, name, email, roleId, branchId, shift) {
        document.getElementById('edit_name').value = name;
        document.getElementById('edit_email').value = email;
        document.getElementById('edit_role').value = roleId;
        document.getElementById('edit_branch').value = branchId;
        document.getElementById('edit_status').checked = status === 'active';
        document.getElementById('edit-form').action = "{{ route('profiles.update', '__id__') }}".replace('__id__', id);

        document.getElementById('edit-modal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('edit-modal').classList.add('hidden');
    }
</script>

</body>
</html>
