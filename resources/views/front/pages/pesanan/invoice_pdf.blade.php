<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 14px;
            color: #555;
            margin: 0;
            padding: 0;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: none;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            background-color: #fff;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 35px;
            line-height: 35px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #f8f8f8;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
            padding: 10px;
        }

        .invoice-box table tr.item td {
            padding: 15px;
            vertical-align: middle;
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.total td {
            padding-top: 20px;
        }

        .invoice-box table tr.item:last-child td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(4) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        .invoice-box .total-row {
            margin-top: 20px;
            text-align: right;
            font-size: 16px;
            font-weight: bold;
        }

        .invoice-box .total-row span {
            color: #333;
        }

        .invoice-box .company-logo img {
            width: 150px;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table>
            <tr class="top">
                <td colspan="4">
                    <table>
                        <tr>
                            <td class="title">
                                <div class="company-logo">
                                    <img src="{{ asset('path-to-logo.png') }}" alt="Sultan Swalayan 1 ">
                                </div>
                            </td>
                            <td>
                                Invoice-#{{ $pesanan->id_pemesanan }}<br>
                                Created: {{ date('Y-m-d') }}<br>
                                Due: {{ date('Y-m-d', strtotime('+1 days')) }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="information">
                <td colspan="4">
                    <table>
                        <tr>
                            <td>
                                Sultan Swalayan 1<br>
                                Jl. Nasional, Rundeng, Kec. Johan Pahlawan, Kabupaten Aceh Barat, Aceh 23681<br>
                            </td>
                            <td>
                                {{ $pesanan->pembeli?->nama }}<br>
                                {{ $pesanan->pengiriman_alamat }}<br>
                                {{ $pesanan->pengiriman_provinsi }} - {{ $pesanan->pengiriman_kota }}<br>
                                {{ $pesanan->pembeli?->no_telp }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <!-- Detail Kurir dan Ongkos Kirim -->
            <tr class="heading">
                <td colspan="4">Detail Pengiriman</td>
            </tr>
            <tr class="item">
                <td>Metode Pengiriman</td>
                <td colspan="3">{{ $pesanan->pengiriman_kurir }}</td>
            </tr>
            <tr class="item">
                <td>Ongkos Kirim</td>
                <td colspan="3">@money($pesanan->pengiriman_ongkir)</td>
            </tr>

            <!-- Detail Item -->
            <tr class="heading">
                <td>Item</td>
                <td>Kuantitas</td>
                <td>Harga per Item</td>
                <td>Subtotal</td>
            </tr>

            @foreach ($pesanan->pemesananItem as $item)
                <tr class="item">
                    <td>{{ $item->produk?->nama }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>@money($item->harga)</td>
                    <td>@money($item->total_harga)</td>
                </tr>
            @endforeach

            <!-- Total -->
            <tr class="total">
                <td colspan="3" style="text-align: right;">Total Produk:</td>
                <td>
                    @money($pesanan->total_harga_produk)
                </td>
            </tr>
            <tr class="total">
                <td colspan="3" style="text-align: right;">Total Pembayaran:</td>
                <td style="font-weight: bold; color: #ca5b5b;">
                    @money($pesanan->total_harga)
                </td>
            </tr>
            <br>

            <!-- Detail Pembayaran -->
            <tr class="heading">
                <td colspan="4">Detail Pembayaran</td>
            </tr>
            <tr class="item">
                <td>Metode Pembayaran</td>
                <td colspan="3">
                    Transfer Bank {{ $pesanan->metodePembayaran->bank }} - {{ $pesanan->metodePembayaran->no_rek }}
                    <br>
                    a/n {{ $pesanan->metodePembayaran->nama_rek }}
                </td>
            </tr>
            <tr class="item">
                <td>Status Pembayaran</td>
                @if ($pesanan->status == 'belum bayar')
                    <td colspan="3" style="color: red;">
                        Belum Dibayar
                    </td>
                @else
                    <td colspan="3" style="color: green;">
                        Sudah Dibayar
                    </td>
                @endif
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
