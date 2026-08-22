<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>
        Laporan KampusMart
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


        /*
        |--------------------------------------------------------------------------
        | HEADER
        |--------------------------------------------------------------------------
        */

        .header {
            width: 100%;

            padding-bottom: 15px;

            margin-bottom: 18px;

            border-bottom: 2px solid #6F4E37;
        }


        .brand {
            font-size: 22px;

            font-weight: bold;

            color: #6F4E37;

            margin: 0;
        }


        .subtitle {
            margin-top: 4px;

            color: #76675D;

            font-size: 10px;
        }


        .period {
            margin-top: 8px;

            display: inline-block;

            padding: 5px 10px;

            border-radius: 5px;

            background: #F4EAE2;

            color: #6F4E37;

            font-weight: bold;
        }


        /*
        |--------------------------------------------------------------------------
        | TITLE
        |--------------------------------------------------------------------------
        */

        .section-title {
            margin-top: 18px;

            margin-bottom: 8px;

            font-size: 13px;

            font-weight: bold;

            color: #332B26;
        }


        /*
        |--------------------------------------------------------------------------
        | SUMMARY
        |--------------------------------------------------------------------------
        */

        .summary-table {
            width: 100%;

            border-collapse: separate;

            border-spacing: 7px 0;

            margin-left: -7px;

            margin-right: -7px;
        }


        .summary-card {
            padding: 12px;

            border: 1px solid #DFD2C7;

            border-radius: 6px;

            background: #FAF7F2;

            vertical-align: top;
        }


        .summary-label {
            margin-bottom: 5px;

            font-size: 8px;

            font-weight: bold;

            text-transform: uppercase;

            color: #927D6F;
        }


        .summary-value {
            font-size: 17px;

            font-weight: bold;

            color: #332B26;
        }


        .coffee {
            color: #6F4E37;
        }


        .gold {
            color: #A87A37;
        }


        .sage {
            color: #65795E;
        }


        .terracotta {
            color: #A95E43;
        }


        .red {
            color: #A65954;
        }


        /*
        |--------------------------------------------------------------------------
        | TABLE
        |--------------------------------------------------------------------------
        */

        table.data-table {
            width: 100%;

            border-collapse: collapse;

            margin-top: 8px;
        }


        .data-table th {
            padding: 8px 7px;

            border: 1px solid #DFD2C7;

            background: #F4EAE2;

            color: #6F4E37;

            font-size: 8px;

            font-weight: bold;

            text-transform: uppercase;

            text-align: left;
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
        | STATUS
        |--------------------------------------------------------------------------
        */

        .status {
            display: inline-block;

            padding: 4px 7px;

            border-radius: 10px;

            font-size: 8px;

            font-weight: bold;
        }


        .status-pending {
            background: #FAF2DF;
            color: #A87A37;
        }


        .status-confirmed {
            background: #F1E6DE;
            color: #6F4E37;
        }


        .status-processing {
            background: #FBEAE2;
            color: #A95E43;
        }


        .status-completed {
            background: #EEF3EA;
            color: #65795E;
        }


        .status-cancelled {
            background: #FAEDEC;
            color: #A65954;
        }


        /*
        |--------------------------------------------------------------------------
        | TWO COLUMN
        |--------------------------------------------------------------------------
        */

        .two-column {
            width: 100%;

            border-collapse: separate;

            border-spacing: 8px 0;

            margin-left: -8px;
        }


        .column-card {
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

        <div class="subtitle">
            Laporan Transaksi dan Aktivitas Marketplace
        </div>

        <div class="period">
            Periode:
            {{ $periodLabel }}
        </div>

    </div>



    {{-- ========================================================= --}}
    {{-- SUMMARY --}}
    {{-- ========================================================= --}}

    <div class="section-title">
        Ringkasan Laporan
    </div>


    <table class="summary-table">

        <tr>

            <td class="summary-card">

                <div class="summary-label">
                    Total Pesanan
                </div>

                <div class="summary-value coffee">
                    {{ number_format($totalOrders) }}
                </div>

            </td>


            <td class="summary-card">

                <div class="summary-label">
                    Nilai Transaksi
                </div>

                <div class="summary-value gold">

                    Rp{{ number_format($totalTransactionValue, 0, ',', '.') }}

                </div>

            </td>


            <td class="summary-card">

                <div class="summary-label">
                    Barang
                </div>

                <div class="summary-value terracotta">
                    {{ number_format($totalItems) }}
                </div>

            </td>


            <td class="summary-card">

                <div class="summary-label">
                    Pesanan Selesai
                </div>

                <div class="summary-value sage">
                    {{ number_format($completedOrders) }}
                </div>

            </td>


            <td class="summary-card">

                <div class="summary-label">
                    Dibatalkan
                </div>

                <div class="summary-value red">
                    {{ number_format($cancelledOrders) }}
                </div>

            </td>

        </tr>

    </table>



    {{-- SECOND SUMMARY --}}

    <table class="summary-table" style="margin-top: 8px;">

        <tr>

            <td class="summary-card">

                <div class="summary-label">
                    Buyer Terlibat
                </div>

                <div class="summary-value coffee">
                    {{ number_format($totalBuyers) }}
                </div>

            </td>


            <td class="summary-card">

                <div class="summary-label">
                    Seller Terlibat
                </div>

                <div class="summary-value terracotta">
                    {{ number_format($totalSellers) }}
                </div>

            </td>


            <td class="summary-card">

                <div class="summary-label">
                    Menunggu
                </div>

                <div class="summary-value gold">
                    {{ $statusSummary->get('pending', 0) }}
                </div>

            </td>


            <td class="summary-card">

                <div class="summary-label">
                    Diproses
                </div>

                <div class="summary-value terracotta">
                    {{ $statusSummary->get('processing', 0) }}
                </div>

            </td>

        </tr>

    </table>



    {{-- ========================================================= --}}
    {{-- TOP SELLER + PRODUCT --}}
    {{-- ========================================================= --}}

    <table class="two-column" style="margin-top: 18px;">

        <tr>


            {{-- TOP SELLER --}}

            <td class="column-card">

                <div class="section-title">
                    Seller Teratas
                </div>


                <table class="data-table">

                    <thead>

                        <tr>
                            <th>#</th>
                            <th>Toko</th>
                            <th>Pesanan</th>
                            <th class="text-right">
                                Transaksi
                            </th>
                        </tr>

                    </thead>


                    <tbody>

                        @forelse ($topSellers as $index => $seller)
                            <tr>

                                <td>
                                    {{ $index + 1 }}
                                </td>

                                <td>

                                    <strong>
                                        {{ $seller['store_name'] }}
                                    </strong>

                                    <br>

                                    <span style="color:#927D6F;">
                                        {{ $seller['name'] }}
                                    </span>

                                </td>

                                <td class="text-center">
                                    {{ $seller['orders'] }}
                                </td>

                                <td class="text-right">

                                    Rp{{ number_format($seller['transaction_value'], 0, ',', '.') }}

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="4" class="text-center">
                                    Tidak ada data.
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </td>



            {{-- TOP PRODUCTS --}}

            <td class="column-card">

                <div class="section-title">
                    Produk Terlaris
                </div>


                <table class="data-table">

                    <thead>

                        <tr>
                            <th>#</th>
                            <th>Produk</th>
                            <th>Terjual</th>
                            <th class="text-right">
                                Nilai
                            </th>
                        </tr>

                    </thead>


                    <tbody>

                        @forelse ($topProducts as $index => $product)
                            <tr>

                                <td>
                                    {{ $index + 1 }}
                                </td>

                                <td>
                                    {{ $product['name'] }}
                                </td>

                                <td class="text-center">
                                    {{ $product['quantity'] }}
                                </td>

                                <td class="text-right">

                                    Rp{{ number_format($product['transaction_value'], 0, ',', '.') }}

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="4" class="text-center">
                                    Tidak ada data.
                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </td>

        </tr>

    </table>



    {{-- ========================================================= --}}
    {{-- TRANSACTION DETAIL --}}
    {{-- ========================================================= --}}

    <div class="section-title">
        Detail Transaksi
    </div>


    <table class="data-table">

        <thead>

            <tr>

                <th>
                    No
                </th>

                <th>
                    Nomor Pesanan
                </th>

                <th>
                    Tanggal
                </th>

                <th>
                    Pembeli
                </th>

                <th>
                    Seller / Toko
                </th>

                <th class="text-center">
                    Barang
                </th>

                <th class="text-right">
                    Total
                </th>

                <th>
                    Status
                </th>

            </tr>

        </thead>


        <tbody>

            @forelse ($orders as $index => $order)
                @php
                    $statusLabel = match ($order->status) {
                        'pending' => 'Menunggu',

                        'confirmed' => 'Dikonfirmasi',

                        'processing' => 'Diproses',

                        'completed' => 'Selesai',

                        'sold' => 'Terjual',

                        'cancelled' => 'Dibatalkan',

                        default => ucfirst($order->status),
                    };

                    $statusClass = match ($order->status) {
                        'pending' => 'status-pending',

                        'confirmed' => 'status-confirmed',

                        'processing' => 'status-processing',

                        'completed', 'sold' => 'status-completed',

                        'cancelled' => 'status-cancelled',

                        default => '',
                    };
                @endphp


                <tr>

                    <td>
                        {{ $index + 1 }}
                    </td>


                    <td>
                        <strong>
                            {{ $order->order_number }}
                        </strong>
                    </td>


                    <td>

                        {{ $order->created_at->format('d M Y') }}

                        <br>

                        <span style="color:#927D6F;">

                            {{ $order->created_at->format('H:i') }}

                        </span>

                    </td>


                    <td>

                        <strong>
                            {{ $order->buyer_name }}
                        </strong>

                        <br>

                        <span style="color:#927D6F;">
                            {{ $order->buyer_phone ?? '-' }}
                        </span>

                    </td>


                    <td>

                        <strong>
                            {{ $order->seller?->sellerProfile?->store_name ?? '-' }}
                        </strong>

                        <br>

                        <span style="color:#927D6F;">
                            {{ $order->seller?->name ?? '-' }}
                        </span>

                    </td>


                    <td class="text-center">

                        {{ $order->items->sum('quantity') }}

                    </td>


                    <td class="text-right">

                        <strong>

                            Rp{{ number_format($order->subtotal, 0, ',', '.') }}

                        </strong>

                    </td>


                    <td>

                        <span class="status {{ $statusClass }}">

                            {{ $statusLabel }}

                        </span>

                    </td>

                </tr>


            @empty

                <tr>

                    <td colspan="8" class="text-center">

                        Tidak ada transaksi pada periode ini.

                    </td>

                </tr>
            @endforelse

        </tbody>

    </table>



    {{-- ========================================================= --}}
    {{-- FOOTER --}}
    {{-- ========================================================= --}}

    <div class="footer">

        Laporan KampusMart
        &nbsp;|&nbsp;

        Dicetak:
        {{ now()->format('d M Y H:i') }}

        &nbsp;|&nbsp;

        Dokumen ini dihasilkan oleh sistem administrasi KampusMart.

    </div>

</body>

</html>
