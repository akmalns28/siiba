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
            <th scope="col">No Peminjaman</th>
            <th scope="col">Peminjam</th>
            <th scope="col">Tanggal Peminjaman</th>
            <th scope="col">Tanggal Kembali</th>
            <th scope="col">Status</th>
        </tr>
        @php
            $no = 1;
        @endphp
        @foreach ($data as $peminjaman)
            <tr>
                <td scope="row">{{ $no++ }}</td>
                <td>{{ $peminjaman->no_peminjaman }}</td>
                <td>{{ $peminjaman->peminjam->nama }}</td>
                <td>{{ $peminjaman->tgl_peminjaman }}</td>
                <td>{{ $peminjaman->tgl_kembali}}</td>
                <td>{{ $peminjaman->detail_barang->status }}</td>
            </tr>
        @endforeach
    </table>
</body>

</html>


</html>
