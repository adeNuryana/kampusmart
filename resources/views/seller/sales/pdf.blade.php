<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan - {{ $seller->sellerProfile?->store_name ?? $seller->name }}</title>

    <style>
        @page {
            margin: 24px 26px 38px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: DejaVu Sans, sans-serif;
            font-size: 9px;
            line-height: 1.4;
            color: #332B26;
            background: #ffffff;
        }

        .header-table,
        .summary-table,
        .data-table {
            width: 100%;
        }

        .header-table {
            border-collapse: collapse;
            margin-bottom: 14px;
            border-bottom: 2px solid #C8795A;
        }

        .header-table td {
            padding: 0 0 12px;
            vertical-align: top;
        }

        .brand {
            margin: 0;
            color: #4371D1;
            font-size: 21px;
            font-weight: bold;
            line-height: 1.1;
        }

        .document-label {
            margin-top: 4px;
            color: #A95E43;
            font-size: 8px;
            font-weight: bold;
            letter-spacing: 0.8px;
            text-transform: uppercase;
        }

        .store-name {
            margin-top: 11px;
            font-size: 14px;
            font-weight: bold;
        }

        .store-meta {
            margin-top: 2px;
            color: #806F64;
            font-size: 8px;
        }

        .document-info {
            width: 42%;
            text-align: right;
        }

        .document-info-title {
            margin-bottom: 5px;
            color: #927D6F;
            font-size: 8px;
            font-weight: bold;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .period-badge {
            display: inline-block;
            padding: 6px 9px;
            border: 1px solid #E8CFC4;
            border-radius: 5px;
            background: #FBEAE2;
            color: #A95E43;
            font-size: 9px;
            font-weight: bold;
        }

        .printed-at {
            margin-top: 5px;
            color: #927D6F;
            font-size: 8px;
        }

        .summary-table {
            margin-bottom: 14px;
            border-collapse: separate;
            border-spacing: 7px 0;
        }

        .summary-table td {
            width: 33.333%;
            padding: 9px 11px;
            border: 1px solid #DFD2C7;
            border-radius: 6px;
            background: #FAF7F2;
        }

        .summary-label {
            color: #927D6F;
            font-size: 7px;
            font-weight: bold;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .summary-value {
            margin-top: 3px;
            font-size: 16px;
            font-weight: bold;
            line-height: 1.2;
        }

        .summary-value.revenue {
            color: #65795E;
        }

        .summary-value.transactions {
            color: #806F64;
        }

        .summary-value.items {
            color: #C16848;
        }

        .section {
            margin-top: 13px;
        }

        .section-heading {
            margin: 0 0 6px;
            font-size: 11px;
            font-weight: bold;
        }

        .section-caption {
            margin-left: 5px;
            color: #927D6F;
            font-size: 8px;
            font-weight: normal;
        }

        .data-table {
            border-collapse: collapse;
            table-layout: fixed;
        }

        .data-table thead {
            display: table-header-group;
        }

        .data-table tr {
            page-break-inside: avoid;
        }

        .data-table th {
            padding: 6px 7px;
            border: 1px solid #DCCFC5;
            background: #6B7D63;
            color: #ffffff;
            font-size: 7px;
            font-weight: bold;
            letter-spacing: 0.35px;
            text-align: left;
            text-transform: uppercase;
        }

        .data-table td {
            padding: 6px 7px;
            border: 1px solid #E7DBD1;
            vertical-align: top;
            overflow-wrap: break-word;
        }

        .data-table tbody tr:nth-child(even) {
            background: #FCFAF7;
        }

        .top-products th {
            background: #8A765F;
        }

        .text-center {
            text-align: center !important;
        }

        .text-right {
            text-align: right !important;
        }

        .muted {
            color: #927D6F;
            font-size: 8px;
        }

        .order-number {
            color: #4371D1;
            font-weight: bold;
        }

        .amount {
            color: #65795E;
            font-weight: bold;
            white-space: nowrap;
        }

        .product-line {
            margin-bottom: 2px;
        }

        .product-line:last-child {
            margin-bottom: 0;
        }

        .empty-state {
            padding: 13px !important;
            color: #927D6F;
            text-align: center;
        }

        .page-footer {
            position: fixed;
            right: 0;
            bottom: -24px;
            left: 0;
            padding-top: 7px;
            border-top: 1px solid #E7DBD1;
            color: #927D6F;
            font-size: 7px;
        }

        .footer-right {
            float: right;
        }
    </style>
</head>

<body>
    <table class="header-table">
        <tr>
            <td>
                <h1 class="brand">{{ $siteSetting?->site_name ?? 'KampusMart' }}</h1>
                <div class="document-label">Seller Center &bull; Laporan Penjualan</div>

                <div class="store-name">
                    {{ $seller->sellerProfile?->store_name ?? 'Toko Seller' }}
                </div>

                <div class="store-meta">
                    Penjual: {{ $seller->name }}
                    @if ($seller->phone)
                        &nbsp;&bull;&nbsp; {{ $seller->phone }}
                    @endif
                </div>
            </td>

            <td class="document-info">
                <div class="document-info-title">Periode laporan</div>
                <div class="period-badge">{{ $periodLabel }}</div>
                <div class="printed-at">
                    Dicetak {{ now('Asia/Jakarta')->locale('id')->translatedFormat('d F Y, H:i') }} WIB
                </div>
            </td>
        </tr>
    </table>

    <table class="summary-table">
        <tr>
            <td>
                <div class="summary-label">Total omzet</div>
                <div class="summary-value revenue">
                    Rp{{ number_format($totalRevenue, 0, ',', '.') }}
                </div>
            </td>
            <td>
                <div class="summary-label">Transaksi selesai</div>
                <div class="summary-value transactions">
                    {{ number_format($totalCompletedOrders) }}
                </div>
            </td>
            <td>
                <div class="summary-label">Produk terjual</div>
                <div class="summary-value items">
                    {{ number_format($totalItemsSold) }}
                </div>
            </td>
        </tr>
    </table>

    <div class="section">
        <h2 class="section-heading">
            Produk Terlaris
            <span class="section-caption">Maksimal 5 produk berdasarkan unit terjual</span>
        </h2>

        <table class="data-table top-products">
            <thead>
                <tr>
                    <th class="text-center" style="width: 7%;">Peringkat</th>
                    <th style="width: 55%;">Nama Produk</th>
                    <th class="text-center" style="width: 16%;">Unit Terjual</th>
                    <th class="text-right" style="width: 22%;">Nilai Penjualan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bestSellingProducts as $index => $product)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td><strong>{{ $product['product_name'] }}</strong></td>
                        <td class="text-center">{{ number_format($product['total_sold']) }}</td>
                        <td class="text-right amount">
                            Rp{{ number_format($product['total_revenue'], 0, ',', '.') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="empty-state">
                            Belum ada data produk pada periode ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="section">
        <h2 class="section-heading">
            Rincian Transaksi
            <span class="section-caption">{{ number_format($totalCompletedOrders) }} transaksi selesai</span>
        </h2>

        <table class="data-table">
            <thead>
                <tr>
                    <th class="text-center" style="width: 4%;">No.</th>
                    <th style="width: 13%;">Nomor Pesanan</th>
                    <th style="width: 17%;">Pembeli</th>
                    <th style="width: 26%;">Produk</th>
                    <th class="text-center" style="width: 9%;">Pembayaran</th>
                    <th class="text-right" style="width: 14%;">Total</th>
                    <th style="width: 17%;">Waktu Transaksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($sales as $index => $sale)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td class="order-number">{{ $sale->order_number }}</td>
                        <td>
                            <strong>{{ $sale->buyer_name }}</strong>
                            @if ($sale->buyer_phone)
                                <br><span class="muted">{{ $sale->buyer_phone }}</span>
                            @endif
                        </td>
                        <td>
                            @foreach ($sale->items as $item)
                                <div class="product-line">
                                    {{ $item->product_name }}
                                    <span class="muted">({{ number_format($item->quantity) }} item)</span>
                                </div>
                            @endforeach
                        </td>
                        <td class="text-center">
                            {{ ucfirst(str_replace('_', ' ', $sale->payment_method ?? '-')) }}
                        </td>
                        <td class="text-right amount">
                            Rp{{ number_format($sale->subtotal, 0, ',', '.') }}
                        </td>
                        <td>
                            {{ $sale->created_at->timezone('Asia/Jakarta')->locale('id')->translatedFormat('d M Y') }}
                            <br><span class="muted">{{ $sale->created_at->timezone('Asia/Jakarta')->format('H:i') }} WIB</span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="empty-state">
                            Tidak ada transaksi selesai pada periode ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="page-footer">
        {{ $siteSetting?->site_name ?? 'KampusMart' }} &bull;
        {{ $seller->sellerProfile?->store_name ?? $seller->name }}
        <span class="footer-right">Laporan penjualan &bull; {{ $periodLabel }}</span>
    </div>
</body>

</html>
