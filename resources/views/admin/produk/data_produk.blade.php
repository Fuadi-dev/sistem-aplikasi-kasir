<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Produk</title>
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
    }</style>
</head>

<body class="bg-gray-100">
    @extends('admin.sidebar')
    @section('content')
        <!-- Title (Centered) -->
        <div class="text-center mb-6">
            <h1 class="page-title">Data Produk</h1>
        </div>

        <!-- Add Produk Button and Search Bar Container -->
        <div class="mb-4 flex justify-between items-center max-w-6xl mx-auto">
            <!-- Add Produk Button (Left) -->
            <div class="mr-10">
                <a href="{{ url('/tambah_produk') }}"
                    class="inline-block rounded-lg bg-indigo-600 px-4 py-2 text-center font-medium text-white hover:bg-indigo-700 transition-all">
                    Tambah Produk
                </a>
            </div>

            <!-- Search Bar (Center) -->
            <div class="w-1/2">
                <form action="{{ url ('/search') }}" method="GET">   
                    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <input type="search" name="search_produk" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Cari berdasarkan kode produk atau nama produk" required />
                        <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                    </div>
                </form>
            </div>

            <!-- Empty div for spacing (Right) -->
            <div class="w-[200px]"></div>
        </div>

        <!-- Table Container -->
        <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-lg">
            <table class="min-w-full divide-y divide-gray-300 bg-white text-sm">
                <thead class="bg-indigo-100 text-gray-800">
                    <tr>
                        <th class="whitespace-nowrap px-6 py-3 font-semibold text-center">Kode Produk</th>
                        <th class="whitespace-nowrap px-6 py-3 font-semibold text-center">Nama Produk</th>
                        <th class="whitespace-nowrap px-6 py-3 font-semibold text-center">Harga</th>
                        <th class="whitespace-nowrap px-6 py-3 font-semibold text-center">Stok</th>
                        <th class="whitespace-nowrap px-6 py-3 font-semibold text-center">Opsi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($produk as $p)
                        <tr class="hover:bg-gray-50 transition-all">
                            <td class="text-center px-6 py-3 text-gray-700">{{ $p->ProdukID }}</td>
                            <td class="text-center px-6 py-3 text-gray-700">{{ $p->NamaProduk }}</td>
                            <td class="text-center px-6 py-3 text-gray-700">{{ $p->Harga }}</td>
                            <td class="text-center px-6 py-3 text-gray-700"> 
                            @if($p->Stok <= 0)
                                <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded">Stok Habis</span>
                            @elseif($p->Stok <= 5)
                                <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded">Stok Menipis</span>
                            @else
                                {{ $p->Stok }}
                            @endif
                            </td>
                            <td class="text-center px-6 py-3 text-gray-700">
                                <div class="flex justify-center space-x-4">
                                    <!-- Edit Button -->
                                    <a href="{{ url('edit_produk/' . $p->ProdukID) }}"
                                        class="inline-flex items-center justify-center rounded-full bg-yellow-300 p-3 text-white hover:bg-yellow-400 focus:outline-none transition-all"
                                        title="Edit Produk">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                    </a>


                                    <!-- Delete Button -->
                                    <form action="{{ url('/hapus_produk') }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id_produk" value="{{ $p->ProdukID }}">
                                        <button type="submit"
                                            class="inline-flex items-center justify-center rounded-full bg-red-500 p-3 text-white hover:bg-red-600 focus:outline-none transition-all"
                                            title="Delete Produk"
                                            onclick="return confirm('Are you sure you want to delete this item?');">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endsection
</body>
@if(session('error'))
<div id="popup-modal" tabindex="-1" class="fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-full bg-black bg-opacity-50 flex" onclick="closeModal(event)">
    <div class="relative p-4 w-full max-w-md max-h-full" onclick="event.stopPropagation();">
        <div class="relative bg-white rounded-lg shadow">
            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center " onclick="closeModal(event)">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">{{ session('error') }}</h3>
                <button onclick="closeModal(event)" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
@endif
<script>
    function closeModal(event) {
        const modal = document.getElementById('popup-modal');
        modal.classList.add('hidden'); // Menyembunyikan modal
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

</html>
