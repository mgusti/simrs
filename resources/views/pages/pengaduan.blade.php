@extends('layouts.app')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
        <x-common.page-breadcrumb pageTitle="Daftar Pengaduan Masyarakat" />
        
        <a href="{{ route('pengaduan.download') }}" 
            class="inline-flex items-center gap-2 rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-brand-600 shadow-theme-xs">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M13.3333 13.3333L10 16.6667M10 16.6667L6.66667 13.3333M10 16.6667V8.33333M16.6667 12.5V13.3333C16.6667 15.1727 15.1727 16.6667 13.3333 16.6667H6.66667C4.82726 16.6667 3.33333 15.1727 3.33333 13.3333V12.5M16.6667 8.33333C16.6667 5.57191 14.4281 3.33333 11.6667 3.33333C10.0211 3.33333 8.56158 4.12642 7.65344 5.35245C7.34588 5.12324 6.96349 5 6.54762 5C5.41675 5 4.5 5.91675 4.5 7.04762C4.5 7.50209 4.64826 7.92193 4.89852 8.2619" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Download Excel
        </a>
    </div>

    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] xl:px-10 xl:py-12">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200 dark:border-gray-800">
                        <th class="px-4 py-4 text-left text-sm font-semibold text-gray-800 dark:text-white/90">No</th>
                        <th class="px-4 py-4 text-left text-sm font-semibold text-gray-800 dark:text-white/90">Pelapor</th>
                        <th class="px-4 py-4 text-left text-sm font-semibold text-gray-800 dark:text-white/90">Alamat & HP</th>
                        <th class="px-4 py-4 text-left text-sm font-semibold text-gray-800 dark:text-white/90">Isi Pengaduan</th>
                        <th class="px-4 py-4 text-left text-sm font-semibold text-gray-800 dark:text-white/90">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @forelse($pengaduans as $index => $item)
                        <tr class="hover:bg-gray-50 dark:hover:bg-white/[0.02]">
                            <td class="px-4 py-4 text-sm text-gray-700 dark:text-gray-300">
                                {{ $index + 1 }}
                            </td>
                            <td class="px-4 py-4 text-sm font-medium text-gray-800 dark:text-white/90">
                                {{ $item->nama ?? 'Anonim' }}
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-200 dark:text-gray-300">
                                <div class="flex flex-col gap-1">
                                    <span class="font-medium text-gray-900 dark:text-white">{{ $item->hp ?? '-' }}</span>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">{{ $item->alamat ?? '-' }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-700 dark:text-gray-300 max-w-md">
                                <div class="whitespace-normal break-words">
                                    {{ $item->pengaduan ?? '-' }}
                                </div>
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-700 dark:text-gray-300 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y H:i') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-10 text-center text-gray-500 dark:text-gray-400">
                                <div class="flex flex-col items-center justify-center space-y-2">
                                    <svg class="h-12 w-12 text-gray-300 dark:text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <p>Belum ada data pengaduan.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($pengaduans->hasPages())
            <div class="mt-6">
                {{ $pengaduans->links() }}
            </div>
        @endif
    </div>
@endsection
