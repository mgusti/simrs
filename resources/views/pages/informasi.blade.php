@extends('layouts.app')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
        <x-common.page-breadcrumb pageTitle="Manajemen Informasi" />
        
        <button @click="$dispatch('open-modal', 'add-informasi')"
            class="inline-flex items-center gap-2 rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-brand-600 shadow-theme-xs">
            <x-lucide-plus class="w-5 h-5" />
            Tambah Informasi
        </button>
    </div>

    @if(session('success'))
        <div class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4 text-sm text-green-700 dark:border-green-800 dark:bg-green-900/20 dark:text-green-400">
            {{ session('success') }}
        </div>
    @endif

    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-gray-100 dark:border-gray-800">
                        <th class="px-5 py-4 text-sm font-semibold text-gray-800 dark:text-white/90">Judul</th>
                        <th class="px-4 py-4 text-sm font-semibold text-gray-800 dark:text-white/90">Kategori</th>
                        <th class="px-4 py-4 text-sm font-semibold text-gray-800 dark:text-white/90">Link</th>
                        <th class="px-5 py-4 text-sm font-semibold text-gray-800 dark:text-white/90 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @forelse($informasi as $item)
                        <tr class="hover:bg-gray-50 dark:hover:bg-white/[0.02]">
                            <td class="px-5 py-4 text-sm text-gray-800 dark:text-white/90">
                                {{ $item->judul }}
                                @if($item->nomor)
                                    <br><span class="text-xs text-gray-500">No: {{ $item->nomor }}</span>
                                @endif
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-700 dark:text-gray-300">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                    {{ $item->kategori }}
                                </span>
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-700 dark:text-gray-300">
                                @if($item->link)
                                    <a href="{{ $item->link }}" target="_blank" class="text-blue-600 hover:underline">Link</a>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-3 py-4 text-sm sm:px-10">
                                <div class="flex items-center gap-2">
                                    <!-- Edit Icon -->
                                    <button @click="$dispatch('open-modal', 'edit-informasi-{{ $item->id }}')" 
                                        class="p-2 text-blue-600 hover:bg-blue-50 dark:text-blue-400 dark:hover:bg-blue-500/10 rounded-lg transition-colors"
                                        title="Edit">
                                        <x-lucide-edit class="w-5 h-5" />
                                    </button>
                                    
                                    <!-- Delete Icon -->
                                    <form action="{{ route('informasi.destroy', $item->id) }}" method="POST" class="m-0" onsubmit="return confirm('Hapus informasi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                            class="p-2 text-red-600 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-500/10 rounded-lg transition-colors flex items-center justify-center"
                                            title="Hapus">
                                            <x-lucide-trash-2 class="w-5 h-5" />
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Edit Informasi Modal -->
                        @push('modals')
                        <x-common.modal name="edit-informasi-{{ $item->id }}" title="Edit Informasi">
                            <form action="{{ route('informasi.update', $item->id) }}" method="POST" class="p-6">
                                @csrf
                                @method('PUT')
                                <div class="space-y-4 px-2 sm:px-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Judul</label>
                                        <input type="text" name="judul" value="{{ $item->judul }}" required 
                                            class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm focus:border-brand-500 focus:ring-brand-500 dark:border-gray-700 dark:text-white">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Kategori</label>
                                        <select name="kategori" required class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm focus:border-brand-500 focus:ring-brand-500 dark:border-gray-700 dark:text-white">
                                            <option value="sk" {{ $item->kategori == 'sk' ? 'selected' : '' }}>SK</option>
                                            <option value="dokumen_terbaru" {{ $item->kategori == 'dokumen_terbaru' ? 'selected' : '' }}>Dokumen Terbaru</option>
                                            <option value="panduan" {{ $item->kategori == 'panduan' ? 'selected' : '' }}>Panduan</option>
                                            <option value="penerimaan" {{ $item->kategori == 'penerimaan' ? 'selected' : '' }}>Penerimaan</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Link</label>
                                        <input type="text" name="link" value="{{ $item->link }}" 
                                            class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm focus:border-brand-500 focus:ring-brand-500 dark:border-gray-700 dark:text-white">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Nomor (Opsional)</label>
                                        <input type="text" name="nomor" value="{{ $item->nomor }}" 
                                            class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm focus:border-brand-500 focus:ring-brand-500 dark:border-gray-700 dark:text-white">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Deskripsi (Opsional)</label>
                                        <textarea name="deskripsi" class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm focus:border-brand-500 focus:ring-brand-500 dark:border-gray-700 dark:text-white">{{ $item->deskripsi }}</textarea>
                                    </div>
                                    <div class="flex justify-end gap-3 pt-8 pb-4">
                                        <button type="button" @click="show = false" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 transition-colors">Batal</button>
                                        <button type="submit" class="rounded-lg bg-brand-500 px-6 py-2.5 text-sm font-medium text-white hover:bg-brand-600 shadow-theme-xs transition-colors">Simpan Perubahan</button>
                                    </div>
                                </div>
                            </form>
                        </x-common.modal>
                        @endpush
                    @empty
                        <tr>
                            <td colspan="4" class="px-5 py-10 text-center text-gray-500 dark:text-gray-400">Belum ada data informasi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @push('modals')
    <!-- Add Informasi Modal -->
    <x-common.modal name="add-informasi" title="Tambah Informasi Baru">
        <form action="{{ route('informasi.store') }}" method="POST" class="p-6">
            @csrf
            <div class="space-y-4 px-2 sm:px-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Judul</label>
                    <input type="text" name="judul" required placeholder="Judul Informasi"
                        class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm focus:border-brand-500 focus:ring-brand-500 dark:border-gray-700 dark:text-white">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Kategori</label>
                    <select name="kategori" required class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm focus:border-brand-500 focus:ring-brand-500 dark:border-gray-700 dark:text-white">
                        <option value="sk">SK</option>
                        <option value="dokumen_terbaru">Dokumen Terbaru</option>
                        <option value="panduan">Panduan</option>
                        <option value="penerimaan">Penerimaan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Link</label>
                    <input type="text" name="link" placeholder="https://example.com/file.pdf"
                        class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm focus:border-brand-500 focus:ring-brand-500 dark:border-gray-700 dark:text-white">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Nomor (Opsional)</label>
                    <input type="text" name="nomor" placeholder="Nomor Surat/Dokumen"
                        class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm focus:border-brand-500 focus:ring-brand-500 dark:border-gray-700 dark:text-white">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Deskripsi (Opsional)</label>
                    <textarea name="deskripsi" placeholder="Deskripsi singkat"
                        class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm focus:border-brand-500 focus:ring-brand-500 dark:border-gray-700 dark:text-white"></textarea>
                </div>
                <div class="flex justify-end gap-3 pt-8 pb-4">
                    <button type="button" @click="show = false" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 transition-colors">Batal</button>
                    <button type="submit" class="rounded-lg bg-brand-500 px-6 py-2.5 text-sm font-medium text-white hover:bg-brand-600 shadow-theme-xs transition-colors">Tambah</button>
                </div>
            </div>
        </form>
    </x-common.modal>
    @endpush
@endsection
