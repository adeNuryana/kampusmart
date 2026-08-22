<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>
        Laporan Penjualan
    </title>


    <style>
        @page {
            margin: 25px 28px;
        }


        * {
            box-sizing: border-box;
        }


        body {
            margin: 0;
            padding: 0;

            font-family:
                DejaVu Sans,
                sans-serif;

            font-size: 10px;

            color: #332B26;

            background: #ffffff;
        }


        .header {
            width: 100%;

            padding-bottom: 15px;

            margin-bottom: 18px;

            border-bottom: 2px solid #C8795A;
        }


        .brand {
            margin: 0;

            color: #6F4E37;

            font-size: 21px;

            font-weight: bold;
        }


        .seller-center {
            margin-top: 3px;

            color: #A95E43;

            font-size: 9px;

            font-weight: bold;

            text-transform: uppercase;
        }


        .store-name {
            margin-top: 12px;

            font-size: 14px;

            font-weight: bold;

            color: #332B26;
        }


        .store-owner {
            margin-top: 3px;

            color: #806F64;
        }


        .period {
            display: inline-block;

            margin-top: 9px;

            padding: 5px 9px;

            border-radius: 5px;

            background: #FBEAE2;

            color: #A95E43;

            font-size: 9px;

            font-weight: bold;
        }


        .section-title {
            margin-top: 18px;

            margin-bottom: 8px;

            color: #332B26;

            font-size: 12px;

            font-weight: bold;
        }


        /*
        |--------------------------------------------------------------------------
        | SUMMARY
        |--------------------------------------------------------------------------
        */

        .summary {
            width: 100%;

            border-collapse: separate;

            border-spacing: 8px 0;

            margin-left: -8px;
        }


        .summary td {
            width: 33.333%;

            padding: 12px;

            vertical-align: top;

            border: 1px solid #DFD2C7;

            border-radius: 6px;

            background: #FAF7F2;
        }


        .summary-label {
            margin-bottom: 6px;

            color: #927D6F;

            font-size: 8px;

            font-weight: bold;

            text-transform: uppercase;
        }


        .summary-value {
            color: #332B26;

            font-size: 18px;

            font-weight: bold;
        }


        .sage {
            color: #65795E;
        }


        .coffee {
            color: #6F4E37;
        }


        .terracotta {
            color: #A95E43;
        }


        /*
        |--------------------------------------------------------------------------
        | TABLE
        |--------------------------------------------------------------------------
        */

        .data-table {
            width: 100%;

            border-collapse: collapse;
        }


        .data-table th {
            padding: 8px 7px;

            border: 1px solid #DFD2C7;

            background: #F4EAE2;

            color: #6F4E37;

            font-size: 8px;

            font-weight: bold;

            text-align: left;

            text-transform: uppercase;
        }


        .data-table td {
            padding: 8px 7px;

            border: 1px solid #E7DBD1;

            vertical-align: top;
        }


        .data-table tr:nth-child(even) td {
            background: #FCFAF8;
        }


        .text-right {
            text-align: right !important;
        }


        .text-center {
            text-align: center !important;
        }


        /*
        |--------------------------------------------------------------------------
        | TOP PRODUCT
        |--------------------------------------------------------------------------
        */

        .two-column {
            width: 100%;

            border-collapse: separate;

            border-spacing: 8px 0;

            margin-left: -8px;
        }


        .two-column>tbody>tr>td {
            width: 50%;

            vertical-align: top;
        }


        /*
        |--------------------------------------------------------------------------
        | FOOTER
        |--------------------------------------------------------------------------
        */

        .footer {
            margin-top: 20px;

            padding-top: 10px;

            border-top: 1px solid #DFD2C7;

            color: #927D6F;

            font-size: 8px;
        }
    </style>

</head>


<body>


    {{-- ========================================================= --}}
    {{-- HEADER --}}
    {{-- ========================================================= --}}

    <div class="header">

        <h1 class="brand">
            KampusMart
        </h1>

        <div class="seller-center">
            Seller Center • Laporan Penjualan
        </div>


        <div class="store-name">

            {{ $seller->sellerProfile?->store_name ?? 'Toko Seller' }}

        </div>


        <div class="store-owner">

            Penjual:
            {{ $seller->name }}

            @if ($seller->phone)
                &nbsp; | &nbsp;

                {{ $seller->phone }}
            @endif

        </div>


        <div class="period">
            Periode: {{ $periodLabel }}
        </div>

    </div>



    {{-- ========================================================= --}}
    {{-- SUMMARY --}}
    {{-- ========================================================= --}}

    <div class="section-title">
        Ringkasan Penjualan
    </div>


    <table class="summary">

        <tr>

            <td>

                <div class="summary-label">
                    Total Omzet
                </div>

                <div class="summary-value sage">

                    Rp{{ number_format($totalRevenue, 0, ',', '.') }}

                </div>

            </td>


            <td>

                <div class="summary-label">
                    Transaksi Selesai
                </div>

                <div class="summary-value coffee">

                    {{ number_format($totalCompletedOrders) }}

                </div>

            </td>


            <td>

                <div class="summary-label">
                    Produk Terjual
                </div>

                <div class="summary-value terracotta">

                    {{ number_format($totalItemsSold) }}

                </div>

            </td>

        </tr>

    </table>



    {{-- ========================================================= --}}
    {{-- TOP PRODUCT --}}
    {{-- ========================================================= --}}

    <div class="section-title">
        Produk Terlaris
    </div>


    <table class="data-table">

        <thead>

            <tr>

                <th style="width: 50px;">
                    Peringkat
                </th>

                <th>
                    Produk
                </th>

                <th class="text-center" style="width: 120px;">

                    Unit Terjual

                </th>

                <th class="text-right" style="width: 180px;">

                    Nilai Penjualan

                </th>

            </tr>

        </thead>


        <tbody>

            @forelse ($bestSellingProducts as $index => $product)
                <tr>

                    <td class="text-center">

                        {{ $index + 1 }}

                    </td>


                    <td>

                        <strong>
                            {{ $product['product_name'] }}
                        </strong>

                    </td>


                    <td class="text-center">

                        {{ number_format($product['total_sold']) }}

                    </td>


                    <td class="text-right">

                        Rp{{ number_format($product['total_revenue'], 0, ',', '.') }}

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="4" class="text-center">

                        Belum ada data penjualan.

                    </td>

                </tr>
            @endforelse

        </tbody>

    </table>



    {{-- ========================================================= --}}
    {{-- SALES HISTORY --}}
    {{-- ========================================================= --}}

    <div class="section-title">
        Riwayat Penjualan
    </div>


    <table class="data-table">

        <thead>

            <tr>

                <th style="width: 35px;">
                    No
                </th>

                <th>
                    Nomor Pesanan
                </th>

                <th>
                    Pembeli
                </th>

                <th class="text-center">
                    Jumlah Barang
                </th>

                <th class="text-right">
                    Total
                </th>

                <th>
                    Tanggal
                </th>

            </tr>

        </thead>


        <tbody>

            @forelse ($sales as $index => $sale)
                <tr>

                    <td class="text-center">

                        {{ $index + 1 }}

                    </td>


                    <td>

                        <strong>
                            {{ $sale->order_number }}
                        </strong>

                    </td>


                    <td>

                        <strong>
                            {{ $sale->buyer_name }}
                        </strong>

                        @if ($sale->buyer_phone)
                            <br>

                            <span style="color:#927D6F;">
                                {{ $sale->buyer_phone }}
                            </span>
                        @endif

                    </td>


                    <td class="text-center">

                        {{ $sale->items->sum('quantity') }}

                    </td>


                    <td class="text-right">

                        <strong>

                            Rp{{ number_format($sale->subtotal, 0, ',', '.') }}

                        </strong>

                    </td>


                    <td>

                        {{ $sale->created_at->timezone('Asia/Jakarta')->locale('id')->translatedFormat('d M Y, H:i') }}

                        WIB

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="6" class="text-center">

                        Tidak ada transaksi selesai
                        pada periode ini.

                    </td>

                </tr>
            @endforelse

        </tbody>

    </table>



    {{-- ========================================================= --}}
    {{-- FOOTER --}}
    {{-- ========================================================= --}}

    <div class="footer">

        Laporan Penjualan KampusMart

        &nbsp; | &nbsp;

        {{ $seller->sellerProfile?->store_name ?? $seller->name }}

        &nbsp; | &nbsp;

        Dicetak:

        {{ now('Asia/Jakarta')->locale('id')->translatedFormat('d F Y, H:i') }}

        WIB

    </div>

</body>

</html>
