<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Pengguna</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <style>
        .page-title {
            color: #4f46e5;
            font-size: 2.5rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 2rem;
            letter-spacing: -0.025em;
        }
    </style>
</head>

<body class="bg-gray-100">
    @extends('admin.sidebar')
    @section('content')
        <div class="container mx-auto px-6 py-6">
            <!-- Title (Centered) -->
            <h1 class="page-title">Data Pengguna</h1>

            <!-- Add Button (Left-aligned) -->
            <div class="mb-4">
                <a href="{{ url('/tambah_pengguna') }}"
                    class="inline-block rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700 transition-all">
                    Tambah Pengguna
                </a>
            </div>

            <!-- User Table -->
            <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-lg">
                <table class="min-w-full divide-y divide-gray-300 bg-white text-sm">
                    <thead class="bg-indigo-100 text-gray-800">
                        <tr>
                            <th class="whitespace-nowrap px-6 py-3 font-semibold text-center">Nama</th>
                            <th class="whitespace-nowrap px-6 py-3 font-semibold text-center">Email</th>
                            <th class="whitespace-nowrap px-6 py-3 font-semibold text-center">Role</th>
                            <th class="whitespace-nowrap px-6 py-3 font-semibold text-center">Opsi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        @foreach ($user as $usr)
                            <tr class="hover:bg-gray-50 transition-all">
                                <td class="text-center px-6 py-3 text-gray-700">{{ $usr->name }}</td>
                                <td class="text-center px-6 py-3 text-gray-700">{{ $usr->email }}</td>
                                <td class="text-center px-6 py-3 text-gray-700">
                                    <form action="{{ url('/update_role') }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="id_user" value="{{ $usr->id_user }}">
                                        <select name="role" onchange="this.form.submit()" 
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5">
                                            <option value="karyawan" {{ $usr->role === 'karyawan' ? 'selected' : '' }}>Karyawan</option>
                                            <option value="admin" {{ $usr->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                        </select>
                                    </form>
                                </td>
                                <td class="text-center px-6 py-3 text-gray-700">
                                    <!-- Delete -->
                                    <form action="{{ url('/hapus_pengguna') }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id_user" value="{{ $usr->id_user }}">
                                        <button type="submit"
                                            class="inline-flex items-center justify-center rounded-full bg-red-500 p-3 text-white hover:bg-red-600 focus:outline-none transition-all"
                                            title="Delete User"
                                            onclick="return confirm('Are you sure you want to delete this item?');">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endsection
</body>
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

</html>
