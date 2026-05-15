@extends('layouts.app')

@section('content')
    <div x-data="{ search: '' }">
        <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
            <x-common.page-breadcrumb pageTitle="Jadwal Dokter" />
            
            <div class="flex items-center gap-3">
                <input type="text" x-model="search" placeholder="Cari..."
                    class="w-44 h-10 rounded-lg border border-gray-200 bg-white px-3 text-sm focus:border-brand-500 focus:ring-brand-500 dark:border-gray-800 dark:bg-white/[0.03] dark:text-white transition-all shadow-theme-xs"
                    autocomplete="off">

                <button @click="$dispatch('open-modal', 'add-jadwal')" class="inline-flex h-10 items-center gap-2 rounded-lg bg-brand-500 px-4 text-sm font-medium text-white transition hover:bg-brand-600 shadow-theme-xs">
                    <x-lucide-plus class="w-5 h-5" />
                    Tambah Jadwal
                </button>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4 text-sm text-green-700 dark:border-green-800 dark:bg-green-900/20 dark:text-green-400">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700 dark:border-red-800 dark:bg-red-900/20 dark:text-red-400">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b border-gray-100 dark:border-gray-800">
                            <th class="px-5 py-4 text-sm font-semibold text-gray-800 dark:text-white/90 sm:px-10">Nama Dokter</th>
                            <th class="px-4 py-4 text-sm font-semibold text-gray-800 dark:text-white/90">Ruangan / Poli</th>
                            <th class="px-4 py-4 text-sm font-semibold text-gray-800 dark:text-white/90">Hari Praktek Aktif</th>
                            <th class="px-5 py-4 text-sm font-semibold text-gray-800 dark:text-white/90 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                        @forelse($dokters as $dokter)
                            @php
                                $searchString = strtolower($dokter->nm_dokter . ' ' . ($dokter->ruangan_utama->nama_ruangan ?? '') . ' ' . implode(' ', $dokter->active_days));
                            @endphp
                            <tr x-show="'{{ $searchString }}'.includes(search.toLowerCase())" class="hover:bg-gray-50 dark:hover:bg-white/[0.02]">
                                <td class="px-5 py-4 text-sm text-gray-800 dark:text-white/90 sm:px-10 font-medium">
                                    {{ $dokter->nm_dokter }}
                                </td>
                            <td class="px-4 py-4 text-sm text-gray-700 dark:text-gray-300">
                                {{ $dokter->ruangan_utama->nama_ruangan ?? '-' }}
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-700 dark:text-gray-300">
                                <div class="flex flex-wrap gap-1.5">
                                    @php
                                        $order = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                                        $sortedDays = collect($dokter->active_days)->sortBy(fn($day) => array_search($day, $order));
                                    @endphp
                                    @forelse($sortedDays as $day)
                                        <span class="px-2.5 py-0.5 rounded-full text-xs font-medium {{ $day === 'Jumat' ? 'bg-amber-50 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400' : 'bg-blue-50 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400' }}">
                                            {{ $day }}
                                        </span>
                                    @empty
                                        <span class="text-xs text-gray-400 italic">Tidak ada hari aktif</span>
                                    @endforelse
                                </div>
                            </td>
                            <td class="px-3 py-4 text-sm sm:px-10">
                                <div class="flex items-center gap-2">
                                    <button @click="$dispatch('open-modal', 'edit-jadwal-{{ $dokter->id }}')" 
                                        class="p-2 text-blue-600 hover:bg-blue-50 dark:text-blue-400 dark:hover:bg-blue-500/10 rounded-lg transition-colors"
                                        title="Atur Hari & Ruangan">
                                        <x-lucide-settings class="w-5 h-5" />
                                    </button>
                                    <form action="{{ route('jadwal-dokter.destroy', $dokter->id) }}" method="POST" class="m-0" onsubmit="return confirm('Hapus seluruh data jadwal untuk dokter ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-red-600 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-500/10 rounded-lg transition-colors" title="Hapus dari Daftar">
                                            <x-lucide-trash-2 class="w-5 h-5" />
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Edit Modal -->
                        @push('modals')
                        <x-common.modal name="edit-jadwal-{{ $dokter->id }}" title="Pengaturan Jadwal: {{ $dokter->nm_dokter }}">
                            <form action="{{ route('jadwal-dokter.update', $dokter->id) }}" method="POST" class="p-6">
                                @csrf
                                @method('PUT')
                                <div class="space-y-5">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Ruangan / Poli</label>
                                        <select name="ruangan_id" required class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm focus:border-brand-500 focus:ring-brand-500 dark:border-gray-700 dark:text-white">
                                            @foreach($ruangans as $ruangan)
                                                <option value="{{ $ruangan->id }}" {{ ($dokter->ruangan_utama->id ?? '') == $ruangan->id ? 'selected' : '' }} class="dark:bg-gray-900">{{ $ruangan->nama_ruangan }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Aktifkan Hari Praktek</label>
                                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                                            @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $day)
                                                <label class="flex items-center gap-3 p-3 rounded-xl border border-gray-100 dark:border-gray-800 cursor-pointer hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                                                    <input type="checkbox" name="hari[]" value="{{ $day }}" {{ ($dokter->all_days_status[$day] ?? 0) == 1 ? 'checked' : '' }}
                                                        class="w-4 h-4 rounded border-gray-300 text-brand-500 focus:ring-brand-500 dark:border-gray-700 dark:bg-gray-800">
                                                    <div class="flex flex-col">
                                                        <span class="text-sm text-gray-700 dark:text-gray-300 font-medium">{{ $day }}</span>
                                                        <span class="text-[10px] text-gray-400">{{ $day === 'Jumat' ? '08:00 - 10:00' : '08:00 - 12:00' }}</span>
                                                    </div>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="flex justify-end gap-3 pt-4">
                                        <button type="button" @click="show = false" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 transition-colors">Batal</button>
                                        <button type="submit" class="rounded-lg bg-brand-500 px-6 py-2.5 text-sm font-medium text-white hover:bg-brand-600 shadow-theme-xs transition-colors">Simpan Pengaturan</button>
                                    </div>
                                </div>
                            </form>
                        </x-common.modal>
                        @endpush
                    @empty
                        <tr>
                            <td colspan="4" class="px-5 py-10 text-center text-gray-500 dark:text-gray-400">Tabel kosong. Klik tombol di atas untuk menambah jadwal dokter secara manual.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

    @push('modals')
    <!-- Add Modal -->
    <x-common.modal name="add-jadwal" title="Tambah Jadwal Dokter Baru">
        <form action="{{ route('jadwal-dokter.store') }}" method="POST" class="p-6">
            @csrf
            <div class="space-y-5">
                <div x-data="{ 
                    search: '', 
                    open: false, 
                    selectedId: '', 
                    selectedName: '',
                    dokters: {{ json_encode($allDokters->map(fn($d) => ['id' => $d->id, 'name' => $d->nm_dokter])) }},
                    get filteredDokters() {
                        if (this.search === '') return this.dokters.slice(0, 10);
                        return this.dokters.filter(d => d.name.toLowerCase().includes(this.search.toLowerCase())).slice(0, 10);
                    },
                    selectDokter(dokter) {
                        this.selectedId = dokter.id;
                        this.selectedName = dokter.name;
                        this.search = dokter.name;
                        this.open = false;
                    }
                }" class="relative">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Pilih Dokter (Autocomplete)</label>
                    <input type="text" x-model="search" @focus="open = true" @click.away="open = false" 
                        placeholder="Ketik nama dokter..."
                        class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm focus:border-brand-500 focus:ring-brand-500 dark:border-gray-700 dark:text-white"
                        autocomplete="off">
                    
                    <input type="hidden" name="dokter_id" :value="selectedId" required>

                    <div x-show="open && filteredDokters.length > 0" 
                        class="absolute z-50 w-full mt-1 max-h-60 overflow-auto rounded-lg border border-gray-200 bg-white shadow-lg dark:border-gray-700 dark:bg-gray-800">
                        <template x-for="dokter in filteredDokters" :key="dokter.id">
                            <div @click="selectDokter(dokter)" 
                                class="px-4 py-2 text-sm cursor-pointer hover:bg-brand-50 dark:hover:bg-brand-500/10 dark:text-gray-300"
                                x-text="dokter.name">
                            </div>
                        </template>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Ruangan / Poli</label>
                    <select name="ruangan_id" required class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm focus:border-brand-500 focus:ring-brand-500 dark:border-gray-700 dark:text-white">
                        <option value="" disabled selected class="dark:bg-gray-900">Pilih Ruangan...</option>
                        @foreach($ruangans as $ruangan)
                            <option value="{{ $ruangan->id }}" class="dark:bg-gray-900">{{ $ruangan->nama_ruangan }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Pilih Hari Praktek</label>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                        @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $day)
                            <label class="flex items-center gap-3 p-3 rounded-xl border border-gray-100 dark:border-gray-800 cursor-pointer hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                                <input type="checkbox" name="hari[]" value="{{ $day }}"
                                    class="w-4 h-4 rounded border-gray-300 text-brand-500 focus:ring-brand-500 dark:border-gray-700 dark:bg-gray-800">
                                <div class="flex flex-col">
                                    <span class="text-sm text-gray-700 dark:text-gray-300 font-medium">{{ $day }}</span>
                                    <span class="text-[10px] text-gray-400">{{ $day === 'Jumat' ? '08:00 - 10:00' : '08:00 - 12:00' }}</span>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-4">
                    <button type="button" @click="show = false" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 transition-colors">Batal</button>
                    <button type="submit" class="rounded-lg bg-brand-500 px-6 py-2.5 text-sm font-medium text-white hover:bg-brand-600 shadow-theme-xs transition-colors">Simpan Jadwal</button>
                </div>
            </div>
        </form>
    </x-common.modal>
    @endpush
@endsection
