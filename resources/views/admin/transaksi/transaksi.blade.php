<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Transaksi Penjualan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/transaksi.css') }}">
    <style>
        @media print {
            /* Sembunyikan sidebar dan elemen lain */
            body * {
                visibility: hidden;
            }
            aside, main {
                display: none !important;
            }
            
            /* Reset margin dan padding */
            body, html {
                margin: 0 !important;
                padding: 0 !important;
                width: 100% !important;
                height: auto !important;
            }
            
            /* Atur area cetak */
            #printArea, #printArea * {
                visibility: visible !important;
            }
            #printArea {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                padding: 20px;
                margin: 0;
                background: white;
            }
            
            /* Atur ukuran kertas */
            @page {
                size: A4 portrait;
                margin: 10mm;
            }
            
            /* Atur tabel */
            #printArea table {
                width: 100%;
                border-collapse: collapse;
                page-break-inside: avoid;
            }
            #printArea th,
            #printArea td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: center;
            }
            #printArea thead {
                background-color: #f3f4f6 !important;
                -webkit-print-color-adjust: exact;
            }
            #printArea tfoot {
                background-color: #f9fafb !important;
                -webkit-print-color-adjust: exact;
            }
            
            /* Memastikan semua konten terlihat */
            #printArea * {
                overflow: visible !important;
            }
            
            /* Memastikan background warna tercetak */
            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
            
            /* Reset transformasi dan margin dari layout utama */
            main {
                margin-left: 0 !important;
                transform: none !important;
            }
        }
    </style>
</head>
<body class="min-h-screen">
    @extends('admin.sidebar')
    @section('content')
        <div class="card">
            <h1 class="page-title">Transaksi Penjualan</h1>

            <div class="grid grid-cols-1 gap-8 mb-8 md:grid-cols-3">
                <div class="input-group">
                    <label for="memberId">Member ID</label>
                    <input type="number" id="memberId" placeholder="Masukkan ID Member" onblur="checkMember(this)">
                </div>
                <div class="flex items-center justify-between h-10 member-info">
                        <span class="font-semibold text-green-700">Nama Member:</span>
                        <span id="memberName" class="font-semibold text-green-700"></span>
                </div>
                <button onclick="emptyCart()" class="flex items-center w-40 h-10 btn-danger">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    Kosongkan
                </button>
            </div>

            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-center text-gray-700">Kode Barang</th>
                            <th class="px-6 py-3 text-center text-gray-700">Nama Barang</th>
                            <th class="px-6 py-3 text-center text-gray-700">Harga</th>
                            <th class="px-6 py-3 text-center text-gray-700">Jumlah</th>
                            <th class="px-6 py-3 text-center text-gray-700">Subtotal</th>
                            <th class="px-6 py-3 text-center text-gray-700">Opsi</th>
                        </tr>
                    </thead>
                    <tbody id="cart-items">
                        <!-- Cart items will be dynamically added here -->
                    </tbody>
                </table>
            </div>

            <div class="summary-card">
                <div class="summary-row">
                    <span>Total Item</span>
                    <span id="totalItems">0</span>
                </div>
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span id="subtotal">Rp 0</span>
                </div>
                <div class="summary-row">
                    <span>Diskon</span>
                    <span id="memberDiscount">0%</span>
                </div>
                <div class="summary-row">
                    <span>Total Setelah Diskon</span>
                    <span id="total">Rp 0</span>
                </div>
            </div>

            <div class="flex justify-center mt-8">
                <button onclick="finishTransaction()" class="btn-primary">
                    Selesai Transaksi
                </button>
            </div>
        </div>

        <!-- Modifikasi modal HTML -->
        <div id="alert-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 flex items-center justify-center hidden w-full h-full bg-black bg-opacity-50">
            <div class="relative w-full max-w-md max-h-full p-4">
                <div class="relative bg-white rounded-lg shadow">
                    <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" onclick="closeModal()">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-4 text-center md:p-5">
                        <!-- Default icon (untuk error/warning) -->
                        <svg id="modal-icon-warning" class="hidden w-12 h-12 mx-auto mb-4 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                        <!-- Success icon (gambar checkmark) -->
                        <div id="modal-icon-success" class="hidden mx-auto mb-4">
                            <div class="flex items-center justify-center w-24 h-24 mx-auto bg-green-100 rounded-full">
                                <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 id="modal-message" class="mb-5 text-lg font-normal text-gray-500"></h3>
                        <button onclick="closeModal()" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('js/transaksi.js') }}"></script>
    @endsection
</body>
</html>