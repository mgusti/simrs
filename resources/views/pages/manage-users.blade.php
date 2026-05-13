@extends('layouts.app')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
        <x-common.page-breadcrumb pageTitle="Manage Users" />
        
        <button @click="$dispatch('open-modal', 'add-user')"
            class="inline-flex items-center gap-2 rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-brand-600 shadow-theme-xs">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 5V19M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Tambah User
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
                        <th class="px-5 py-4 text-sm font-semibold text-gray-800 dark:text-white/90 sm:px-10">Nama</th>
                        <th class="px-4 py-4 text-sm font-semibold text-gray-800 dark:text-white/90">Email / Username</th>
                        <th class="px-5 py-4 text-sm font-semibold text-gray-800 dark:text-white/90 text-right sm:px-10">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @forelse($users as $user)
                        <tr class="hover:bg-gray-50 dark:hover:bg-white/[0.02]">
                            <td class="px-5 py-4 text-sm text-gray-800 dark:text-white/90 sm:px-10">
                                {{ $user->name }}
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-700 dark:text-gray-300">
                                {{ $user->email }}
                            </td>
                            <td class="px-5 py-4 text-sm text-right sm:px-10">
                                <div class="flex items-center justify-end gap-2">
                                    <!-- Edit Icon -->
                                    <button @click="$dispatch('open-modal', 'edit-user-{{ $user->id }}')" 
                                        class="p-2 text-blue-600 hover:bg-blue-50 dark:text-blue-400 dark:hover:bg-blue-500/10 rounded-lg transition-colors"
                                        title="Edit User">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                    </button>
                                    
                                    <!-- Reset Password Icon -->
                                    <form action="{{ route('manage-users.reset-password', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Reset password user ini ke 12345678?')">
                                        @csrf
                                        <button type="submit" 
                                            class="p-2 text-amber-500 hover:bg-amber-50 dark:text-amber-400 dark:hover:bg-amber-500/10 rounded-lg transition-colors"
                                            title="Reset Password">
                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3m-3-3l-2.25-2.25"></path></svg>
                                        </button>
                                    </form>

                                    <!-- Delete Icon -->
                                    <form action="{{ route('manage-users.destroy', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus user ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                            class="p-2 text-red-600 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-500/10 rounded-lg transition-colors"
                                            title="Hapus User">
                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Edit User Modal -->
                        <x-common.modal name="edit-user-{{ $user->id }}" title="Edit User: {{ $user->name }}">
                            <form action="{{ route('manage-users.update', $user->id) }}" method="POST" class="p-6">
                                @csrf
                                @method('PUT')
                                <div class="space-y-4 px-2 sm:px-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Nama</label>
                                        <input type="text" name="name" value="{{ $user->name }}" required 
                                            class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm focus:border-brand-500 focus:ring-brand-500 dark:border-gray-700 dark:text-white">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Email / Username</label>
                                        <input type="email" name="email" value="{{ $user->email }}" required 
                                            class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm focus:border-brand-500 focus:ring-brand-500 dark:border-gray-700 dark:text-white">
                                    </div>
                                    
                                    <div class="space-y-3 pt-2">
                                        <label class="flex items-center gap-3 cursor-pointer">
                                            <input type="checkbox" name="access_tempat_tidur" {{ $user->access_tempat_tidur ? 'checked' : '' }}
                                                class="w-4 h-4 rounded border-gray-300 text-brand-500 focus:ring-brand-500 dark:border-gray-700 dark:bg-gray-800">
                                            <span class="text-sm text-gray-700 dark:text-gray-300 font-medium">Akses Tempat Tidur</span>
                                        </label>
                                        <label class="flex items-center gap-3 cursor-pointer">
                                            <input type="checkbox" name="access_pengaduan" {{ $user->access_pengaduan ? 'checked' : '' }}
                                                class="w-4 h-4 rounded border-gray-300 text-brand-500 focus:ring-brand-500 dark:border-gray-700 dark:bg-gray-800">
                                            <span class="text-sm text-gray-700 dark:text-gray-300 font-medium">Akses Pengaduan</span>
                                        </label>
                                    </div>
                                    <div class="flex justify-end gap-3 pt-8 pb-4">
                                        <button type="button" @click="show = false" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 transition-colors">Batal</button>
                                        <button type="submit" class="rounded-lg bg-brand-500 px-6 py-2.5 text-sm font-medium text-white hover:bg-brand-600 shadow-theme-xs transition-colors">Simpan Perubahan</button>
                                    </div>
                                </div>
                            </form>
                        </x-common.modal>
                    @empty
                        <tr>
                            <td colspan="3" class="px-5 py-10 text-center text-gray-500 dark:text-gray-400">Belum ada user tambahan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add User Modal -->
    <x-common.modal name="add-user" title="Tambah User Baru">
        <form action="{{ route('manage-users.store') }}" method="POST" class="p-6">
            @csrf
            <div class="space-y-4 px-2 sm:px-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Nama</label>
                    <input type="text" name="name" required placeholder="Nama Lengkap"
                        class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm focus:border-brand-500 focus:ring-brand-500 dark:border-gray-700 dark:text-white">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Email / Username</label>
                    <input type="email" name="email" required placeholder="user@example.com"
                        class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm focus:border-brand-500 focus:ring-brand-500 dark:border-gray-700 dark:text-white">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Password</label>
                    <input type="password" name="password" required placeholder="Minimal 6 karakter"
                        class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm focus:border-brand-500 focus:ring-brand-500 dark:border-gray-700 dark:text-white">
                </div>
                <div class="space-y-3 pt-2">
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="access_tempat_tidur"
                            class="w-4 h-4 rounded border-gray-300 text-brand-500 focus:ring-brand-500 dark:border-gray-700 dark:bg-gray-800">
                        <span class="text-sm text-gray-700 dark:text-gray-300 font-medium">Akses Tempat Tidur</span>
                    </label>
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="access_pengaduan"
                            class="w-4 h-4 rounded border-gray-300 text-brand-500 focus:ring-brand-500 dark:border-gray-700 dark:bg-gray-800">
                        <span class="text-sm text-gray-700 dark:text-gray-300 font-medium">Akses Pengaduan</span>
                    </label>
                </div>
                <div class="flex justify-end gap-3 pt-8 pb-4">
                    <button type="button" @click="show = false" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 transition-colors">Batal</button>
                    <button type="submit" class="rounded-lg bg-brand-500 px-6 py-2.5 text-sm font-medium text-white hover:bg-brand-600 shadow-theme-xs transition-colors">Tambah User</button>
                </div>
            </div>
        </form>
    </x-common.modal>
@endsection
