<!DOCTYPE html>
<html>

<head>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #6e6e6e;
            color: white;
        }
    </style>
</head>

<body>

    <h1>Data Barang</h1>
    <h4>{{ 'Tanggal: '. now()->format('d-m-Y') }}</h4>
    <table id="customers">
        <tr>
            <th scope="col">No</th>
            <th scope="col">Kode Transaksi</th>
            <th scope="col">Supplier</th>
            <th scope="col">Sumber Dana</th>
            <th scope="col">Tanggal Masuk</th>
        </tr>
        @php
            $no = 1;
        @endphp
        @foreach ($data as $barang_msk)
            <tr>
                <td scope="row">{{ $no++ }}</td>
                <td>{{ $barang_msk->kode_barang_masuk }}</td>
                <td>{{ $barang_msk->supplier->nama_suplier }}</td>
                <td>{{ $barang_msk->dana->dana }}</td>
                <td>{{ $barang_msk->tgl_masuk_barang}}</td>
            </tr>
        @endforeach
    </table>
</body>

</html>


</html>
