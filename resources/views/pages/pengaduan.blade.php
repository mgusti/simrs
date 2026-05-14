@extends('layouts.app')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
        <x-common.page-breadcrumb pageTitle="Daftar Pengaduan Masyarakat" />
        
        <a href="{{ route('pengaduan.download') }}" 
            class="inline-flex items-center gap-2 rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-brand-600 shadow-theme-xs">
            <x-lucide-download class="w-5 h-5" />
            Download
        </a>
    </div>

    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] xl:px-10 xl:py-12">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200 dark:border-gray-800">
                        <th class="px-4 py-4 text-left text-sm font-semibold text-gray-800 dark:text-white/90 w-16">No</th>
                        <th class="px-4 py-4 text-left text-sm font-semibold text-gray-800 dark:text-white/90 w-48 whitespace-nowrap">Pelapor</th>
                        <th class="px-4 py-4 text-left text-sm font-semibold text-gray-800 dark:text-white/90 w-32">Alamat & HP</th>
                        <th class="px-4 py-4 text-left text-sm font-semibold text-gray-800 dark:text-white/90 min-w-[300px] w-auto">Isi Pengaduan</th>
                        <th class="px-4 py-4 text-left text-sm font-semibold text-gray-800 dark:text-white/90 w-48 whitespace-nowrap">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @forelse($pengaduans as $index => $item)
                        <tr class="hover:bg-gray-50 dark:hover:bg-white/[0.02]">
                            <td class="px-4 py-4 text-sm text-gray-700 dark:text-gray-300">
                                {{ $index + 1 }}
                            </td>
                            <td class="px-4 py-4 text-sm font-medium text-gray-800 dark:text-white/90">
                                <div class="flex flex-col gap-1">
                                    <span class="font-medium text-gray-900 dark:text-white">{{ $item->nama ?? 'Anonim' }}</span>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">{{ $item->email ?? '-' }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-700 dark:text-gray-300">
                                <div class="flex flex-col gap-1 max-w-[150px]">
                                    <span class="font-medium text-gray-900 dark:text-white">{{ $item->hp ?? '-' }}</span>
                                    <span class="text-xs text-gray-500 dark:text-gray-400 whitespace-normal break-words">{{ $item->alamat ?? '-' }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-700 dark:text-gray-300">
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
