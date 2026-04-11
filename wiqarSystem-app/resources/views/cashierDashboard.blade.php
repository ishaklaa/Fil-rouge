<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wiqaar — Cashier</title>
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
    </style>
</head>
<body class="bg-beige-100 min-h-screen">

<!-- ── HEADER ── -->
<header class="bg-brown-400 px-6 h-14 flex items-center justify-between shadow-lg sticky top-0 z-50">
    <h1 class="font-playfair text-2xl font-bold text-beige-200 tracking-widest">
        WI<span class="text-brown-100">QA</span>AR
    </h1>
    <div class="flex items-center gap-4">
        <span class="bg-brown-300 text-beige-200 text-xs font-medium px-4 py-1 rounded-full tracking-widest uppercase">
            Cashier
        </span>
        <span class="text-beige-300 text-sm font-light">14:32 · 30 Mar 2026</span>
    </div>
</header>

<!-- ── MAIN LAYOUT ── -->
<div class="flex gap-5 p-5 h-[calc(100vh-56px)]">

    <!-- LEFT — ACTIVITIES -->
    <div class="flex flex-col gap-4 flex-1 overflow-hidden">

        <div class="flex items-center justify-between">
            <h2 class="font-playfair text-xl font-semibold text-brown-400">Available Activities</h2>
        </div>

        <div class="grid grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-4 overflow-y-auto scroll-y pr-1 flex-1"
             id="activitiesDiv">

            <!-- Card — Available -->


        </div>
    </div>

    <!-- RIGHT — ORDER PANEL -->
    <div
        class="w-[400px] bg-white rounded-2xl border border-beige-200 shadow-xl flex flex-col overflow-hidden shrink-0">

        <!-- Order Header -->
        <div class="bg-brown-400 px-5 py-4 flex items-center justify-between">
            <span class="font-playfair text-lg text-beige-200 font-semibold">Current Order</span>
            <span
                class="bg-brown-100 text-white text-xs font-bold px-3 py-1 rounded-full min-w-[28px] text-center">3</span>
        </div>

        <!-- Order Items -->
        <div class="flex-1 overflow-y-auto scroll-y p-4 flex flex-col gap-3" id="orderDiv">

            <!-- Item -->
           {{-- <div class="bg-beige-100 rounded-xl px-4 py-3 border border-beige-200 flex items-center gap-3">
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-brown-400 truncate">Archery Session</p>
                    <p class="text-xs text-brown-200 mt-0.5">240.00 MAD</p>
                </div>
                <div class="flex items-center gap-1.5">
                    <button
                        class="w-7 h-7 rounded-lg border border-beige-300 bg-white text-brown-300 font-bold flex items-center justify-center hover:bg-brown-300 hover:text-white hover:border-brown-300 transition-all">
                        −
                    </button>
                    <span class="text-sm font-semibold text-brown-400 w-5 text-center">2</span>
                    <button
                        class="w-7 h-7 rounded-lg border border-beige-300 bg-white text-brown-300 font-bold flex items-center justify-center hover:bg-brown-300 hover:text-white hover:border-brown-300 transition-all">
                        +
                    </button>
                </div>
                <button
                    class="w-7 h-7 rounded-lg bg-red-50 text-red-400 flex items-center justify-center hover:bg-red-400 hover:text-white transition-all text-xs font-bold">
                    ✕
                </button>
            </div>--}}


            <!-- Empty state (shown when no items) -->
            <!--
            <div class="flex flex-col items-center justify-center text-beige-400 gap-3 py-16 flex-1">
                <span class="text-5xl opacity-40">🛒</span>
                <p class="text-sm text-center">No activities added yet.<br>Select from the left to begin.</p>
            </div>
            -->

        </div>

        <!-- Order Footer -->
        <div class="border-t border-beige-200 px-5 py-4 flex flex-col gap-3">

            <div class="flex justify-between text-sm text-brown-300">
                <span>Subtotal</span>
                <div>
                    <span id="subTotal">0</span>
                    <span>SAR</span>
                </div>

            </div>
            <div class="flex justify-between text-sm text-red-400">
                <span id="discount">Discount 0 %</span>
                <div>
                    <span id="discountValue" >0</span>
                    <span>SAR</span>
                </div>

            </div>

            <!-- Discount Input -->
            <div class="flex gap-2">
                <div
                    class="flex-1 flex items-center bg-beige-100 border border-beige-300 rounded-xl px-3 py-2 gap-2 focus-within:border-brown-200 transition-colors">
                    <input type="number" name="discount"  min="0" max="100" placeholder="Discount"
                           class="bg-transparent outline-none text-sm text-brown-400 w-full placeholder-beige-400" id="discountInput">
                    <span class="text-beige-400 text-sm font-medium shrink-0">%</span>
                </div>
                <button
                    class="bg-beige-200 border border-beige-300 rounded-xl px-4 text-sm font-medium text-brown-300 hover:bg-brown-200 hover:text-white hover:border-brown-200 transition-all whitespace-nowrap" id="discountModify">
                    Apply
                </button>
            </div>

            <!-- Total -->
            <div class="flex justify-between items-center pt-3 border-t border-dashed border-beige-300">
                <span class="font-playfair text-xl font-bold text-brown-500" >Total</span>
                <span class="font-playfair text-xl font-bold text-brown-300" id="TotalAmount">0</span>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-2 mt-1">
                <div id="messageContainer"></div>
                <button
                    class="flex-1 bg-brown-400 hover:bg-brown-500 text-beige-100 font-playfair font-semibold rounded-xl py-3 flex items-center justify-center gap-2 transition-all hover:-translate-y-0.5 hover:shadow-lg active:scale-95" onclick="checkOut()">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M9 12l2 2 4-4"/>
                        <circle cx="12" cy="12" r="9"/>
                    </svg>
                    Checkout
                </button>

                <!-- Receipt button — opens modal -->
                <button onclick="document.getElementById('receipt-modal').classList.remove('hidden')"
                        class="bg-beige-200 border border-beige-300 rounded-xl px-4 flex items-center justify-center text-brown-300 hover:bg-brown-100 hover:text-white hover:border-brown-100 transition-all text-xl"
                        title="View & Print Receipt">
                    🧾
                </button>
            </div>
        </div>
    </div>

</div>


<!-- ══════════════════════════════════
     RECEIPT MODAL
══════════════════════════════════ -->
<div id="receipt-modal" class="hidden fixed inset-0 z-[100] flex items-center justify-center">

    <!-- Backdrop -->
    <div class="absolute inset-0 bg-brown-500/40 backdrop-blur-sm"
         onclick="document.getElementById('receipt-modal').classList.add('hidden')"></div>

    <!-- Modal Card -->
    <div class="relative bg-white rounded-3xl shadow-2xl w-full max-w-sm mx-4 overflow-hidden">

        <!-- Top stripe -->
        <div class="h-1.5 bg-gradient-to-r from-brown-100 via-brown-300 to-brown-100"></div>

        <!-- Header -->
        <div class="px-7 pt-6 pb-4 text-center border-b border-dashed border-beige-300">
            <p class="font-playfair text-2xl font-bold text-brown-400 tracking-widest">WI<span
                    class="text-brown-100">QA</span>AR</p>
            <p class="text-xs text-brown-200 mt-1 tracking-wider uppercase font-medium">Official Receipt</p>
            <p class="text-xs text-beige-400 mt-2">30 Mar 2026 · 14:32</p>
        </div>

        <!-- Items -->
        <div class="px-7 py-4 flex flex-col gap-2.5 border-b border-dashed border-beige-300">
            <div class="flex justify-between text-sm">
                <span class="text-brown-300">Archery Session <span class="text-beige-400">×2</span></span>
                <span class="font-medium text-brown-400">240.00 MAD</span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-brown-300">Yoga Class <span class="text-beige-400">×1</span></span>
                <span class="font-medium text-brown-400">80.00 MAD</span>
            </div>
        </div>

        <!-- Totals -->
        <div class="px-7 py-4 flex flex-col gap-2 border-b border-dashed border-beige-300">
            <div class="flex justify-between text-sm text-brown-300">
                <span>Subtotal</span>
                <span>320.00 MAD</span>
            </div>
            <div class="flex justify-between text-sm text-red-400">
                <span>Discount (10%)</span>
                <span>−32.00 MAD</span>
            </div>
            <div class="flex justify-between items-center pt-2 mt-1 border-t border-beige-300">
                <span class="font-playfair text-lg font-bold text-brown-500">Total</span>
                <span class="font-playfair text-lg font-bold text-brown-300">288.00 MAD</span>
            </div>
        </div>

        <!-- Footer note -->
        <div class="px-7 py-4 text-center border-b border-dashed border-beige-300">
            <p class="text-xs text-beige-400 leading-relaxed">Thank you for visiting Wiqaar.<br>We hope to see you again
                soon.</p>
        </div>

        <!-- Actions -->
        <div class="px-7 py-5 flex gap-3">
            <button onclick="window.print()"
                    class="flex-1 bg-brown-400 hover:bg-brown-500 text-beige-100 font-playfair font-semibold rounded-xl py-2.5 flex items-center justify-center gap-2 transition-all hover:shadow-md active:scale-95 text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M6 9V2h12v7M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/>
                    <rect x="6" y="14" width="12" height="8" rx="1"/>
                </svg>
                Print
            </button>
            <button onclick="document.getElementById('receipt-modal').classList.add('hidden')"
                    class="flex-1 bg-beige-200 border border-beige-300 text-brown-300 font-medium rounded-xl py-2.5 hover:bg-beige-300 transition-all text-sm active:scale-95">
                Close
            </button>
        </div>
    </div>
</div>

<script src="{{asset('js/script.js')}}" ></script>
</body>
</html>
