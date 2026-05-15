@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="Tempat Tidur" />
    
    @if(session('success'))
        <div class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4 text-sm text-green-700 dark:border-green-800 dark:bg-green-900/20 dark:text-green-400">
            {{ session('success') }}
        </div>
    @endif

    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] xl:px-10 xl:py-12">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200 dark:border-gray-800">
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-800 dark:text-white/90">Ruangan</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-800 dark:text-white/90">Kelas</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-800 dark:text-white/90">Kapasitas</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-800 dark:text-white/90">Tersedia</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-800 dark:text-white/90">Pria</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-800 dark:text-white/90">Wanita</th>
                        <th class="px-4 py-3 text-right text-sm font-semibold text-gray-800 dark:text-white/90 w-48 whitespace-nowrap">Terakhir Update</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-800 dark:text-white/90 w-28 whitespace-nowrap">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($beds as $bed)
                        <tr class="border-b border-gray-200 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-white/[0.02]">
                            <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">{{ $bed->ruang }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">{{ $bed->kelas }}</td>
                            <td class="px-4 py-3 text-center text-sm text-gray-700 dark:text-gray-300">{{ $bed->kapasitas }}</td>
                            <td class="px-4 py-3 text-center text-sm text-gray-700 dark:text-gray-300">{{ $bed->tersedia }}</td>
                            <td class="px-4 py-3 text-center text-sm text-gray-700 dark:text-gray-300">{{ $bed->tersediapria }}</td>
                            <td class="px-4 py-3 text-center text-sm text-gray-700 dark:text-gray-300">{{ $bed->tersediawanita }}</td>
                            <td class="px-4 py-3 text-right text-sm text-gray-700 dark:text-gray-300 whitespace-nowrap">{{ \Carbon\Carbon::parse($bed->ts)->format('d M Y H:i') }}</td>
                            <td class="px-4 py-3 text-center whitespace-nowrap">
                                <button onclick="openEditModal({{ $bed->id }}, '{{ $bed->kelas }}', '{{ $bed->ruang }}', {{ $bed->kapasitas }}, {{ $bed->tersedia }}, {{ $bed->tersediapria }}, {{ $bed->tersediawanita }})"
                                    class="inline-flex items-center justify-center rounded-lg border border-brand-500 px-3 py-1.5 text-sm font-medium text-brand-500 transition hover:bg-brand-500 hover:text-white dark:border-brand-600 dark:text-brand-400">
                                    Edit
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @push('modals')
    <!-- Edit Modal -->
    <div id="editModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-gray-900/50" style="z-index: 999999;">
        <div class="w-full max-w-lg rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-gray-900">
            <h3 class="mb-4 text-lg font-semibold text-gray-800 dark:text-white">Edit Tempat Tidur</h3>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                
                <div class="space-y-4">
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Ruangan</label>
                        <input type="text" id="ruangan" name="ruangan" required
                            class="h-10 w-full rounded-lg border border-gray-300 px-4 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white">
                    </div>

                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Kelas</label>
                        <input type="text" id="kelas" name="kelas" required
                            class="h-10 w-full rounded-lg border border-gray-300 px-4 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Kapasitas</label>
                            <input type="number" id="kapasitas" name="kapasitas" required
                                class="h-10 w-full rounded-lg border border-gray-300 px-4 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white">
                        </div>
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Tersedia</label>
                            <input type="number" id="tersedia" name="tersedia" required
                                class="h-10 w-full rounded-lg border border-gray-300 px-4 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Tersedia Pria</label>
                            <input type="number" id="tersediapria" name="tersediapria" required
                                class="h-10 w-full rounded-lg border border-gray-300 px-4 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white">
                        </div>
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Tersedia Wanita</label>
                            <input type="number" id="tersediawanita" name="tersediawanita" required
                                class="h-10 w-full rounded-lg border border-gray-300 px-4 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white">
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex gap-3">
                    <button type="submit" class="flex-1 rounded-lg bg-brand-500 py-2.5 font-medium text-white transition hover:bg-brand-600">
                        Simpan
                    </button>
                    <button type="button" onclick="closeEditModal()"
                        class="flex-1 rounded-lg border border-gray-300 py-2.5 font-medium text-gray-700 transition hover:bg-gray-50 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-gray-800">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endpush

    <script>
        function openEditModal(id, kelas, ruangan, kapasitas, tersedia, tersediapria, tersediawanita) {
            document.getElementById('kelas').value = kelas;
            document.getElementById('ruangan').value = ruangan;
            document.getElementById('kapasitas').value = kapasitas;
            document.getElementById('tersedia').value = tersedia;
            document.getElementById('tersediapria').value = tersediapria;
            document.getElementById('tersediawanita').value = tersediawanita;
            
            const form = document.getElementById('editForm');
            form.action = '{{ route("tempat-tidur.update", ":id") }}'.replace(':id', id);
            
            document.getElementById('editModal').classList.remove('hidden');
            document.getElementById('editModal').classList.add('flex');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
            document.getElementById('editModal').classList.remove('flex');
        }

        // Close modal when clicking outside
        document.getElementById('editModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditModal();
            }
        });
    </script>
@endsection
