<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
</head>
<body>
    @extends('admin.sidebar') <!-- Jika layout anda bernama app.blade.php -->

@section('content')
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        <!-- Stat Card 1 -->
        <div class="p-6 bg-white rounded-lg shadow-lg">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-semibold text-gray-800">Total Penjualan</h3>
                <i class="text-3xl text-indigo-600 ph-bold ph-chart-line"></i>
            </div>
            <div class="mt-4">
                <p class="text-3xl font-bold text-gray-800">Rp {{ number_format($totalPenjualan, 0, ',', '.') }}</p>
                <p class="text-sm text-gray-500">Selama bulan ini</p>
            </div>
        </div>

        <!-- Stat Card 2 -->
        <div class="p-6 bg-white rounded-lg shadow-lg">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-semibold text-gray-800">Total Produk</h3>
                <i class="text-3xl text-green-600 ph-bold ph-package"></i>
            </div>
            <div class="mt-4">
                <p class="text-3xl font-bold text-gray-800">{{ $totalProduk }} Produk</p>
                <p class="text-sm text-gray-500">Jumlah produk tersedia</p>
            </div>
        </div>

        <!-- Stat Card 3 -->
        <div class="p-6 bg-white rounded-lg shadow-lg">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-semibold text-gray-800">Member Baru</h3>
                <i class="text-3xl text-blue-600 ph-bold ph-users"></i>
            </div>
            <div class="mt-4">
                <p class="text-3xl font-bold text-gray-800">{{ $pelangganBaru }} Member</p>
                <p class="text-sm text-gray-500">Dalam 30 hari terakhir</p>
            </div>
        </div>
    </div>

    <!-- Recent Activity Section -->
    <div class="p-6 mt-8 bg-white rounded-lg shadow-lg">
        <h3 class="mb-4 text-2xl font-semibold text-gray-800">Aktivitas Terbaru</h3>
        <ul class="space-y-4">
            @foreach($aktivitasTerbaru as $aktivitas)
                <li class="flex items-center justify-between">
                    <div class="flex items-center">
                        <i class="text-xl text-indigo-500 ph-bold ph-shopping-cart"></i>
                        <span class="ml-3 text-gray-700">
                            Pesanan baru dari {{ $aktivitas->pelangganRelasi ? $aktivitas->pelangganRelasi->NamaPelanggan : 'Pelanggan Umum' }}
                            ({{ $aktivitas->NoNota }})
                        </span>
                    </div>
                    <span class="text-sm text-gray-500">{{ $aktivitas->TanggalPenjualan->diffForHumans() }}</span>
                </li>
            @endforeach
        </ul>
    </div>
@endsection

</body>
</html>
