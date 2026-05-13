@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        <!-- Dashboard Header Metrics -->
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3 md:gap-6">
            <!-- Total Pengaduan Hari Ini -->
            <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
                <div class="flex items-center justify-center w-12 h-12 bg-blue-50 rounded-xl dark:bg-blue-500/10">
                    <svg class="text-blue-600 dark:text-blue-400" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                    </svg>
                </div>
                <div class="mt-5">
                    <span class="text-sm text-gray-500 dark:text-gray-400">Pengaduan Hari Ini</span>
                    <h4 class="mt-2 font-bold text-gray-800 text-title-sm dark:text-white/90">
                        {{ number_format($complaintsToday) }}
                    </h4>
                </div>
            </div>

            <!-- Total Pengaduan Keseluruhan -->
            <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
                <div class="flex items-center justify-center w-12 h-12 bg-green-50 rounded-xl dark:bg-green-500/10">
                    <svg class="text-green-600 dark:text-green-400" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>
                <div class="mt-5">
                    <span class="text-sm text-gray-500 dark:text-gray-400">Total Pengaduan</span>
                    <h4 class="mt-2 font-bold text-gray-800 text-title-sm dark:text-white/90">
                        {{ number_format($totalComplaints) }}
                    </h4>
                </div>
            </div>

            <!-- Total Ruang Belum Update -->
            <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
                <div class="flex items-center justify-center w-12 h-12 bg-red-50 rounded-xl dark:bg-red-500/10">
                    <svg class="text-red-600 dark:text-red-400" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                </div>
                <div class="mt-5">
                    <span class="text-sm text-gray-500 dark:text-gray-400">Ruang Belum Update Hari Ini</span>
                    <h4 class="mt-2 font-bold text-gray-800 text-title-sm dark:text-white/90">
                        {{ $unupdatedBeds->count() }}
                    </h4>
                </div>
            </div>
        </div>

        </div>
    </div>
@endsection
