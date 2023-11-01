@extends('layout.main')

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.41.0/dist/apexcharts.min.css">
    <style>
        .highcharts-credits {
            display: none;
        }
    </style>
@endpush

@section('container')
    <div class="card">
        <div class="card-header">
            <h4>{{ $header }}</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('laporan') }}" method="get">
                <div class="form-group">
                    <label for="">Pilih Filter</label>
                    <div class="input-group">
                        <select class="custom-select" name="year" id="year" required>
                            <option selected=" ">Pilih Tahun...</option>
                            @for ($year = $startYear; $year <= $endYear; $year++)
                                <option value="{{ $year }}" @selected($year == old('year', $selectedYear))>
                                    {{ $year }}</option>
                            @endfor
                        </select>
                        <select class="custom-select" name="transaksi" id="transaksi" required>
                            <option selected="">Pilih Transaksi...</option>
                            <option value="barang_masuk" @selected(old('transaksi', $selectedTransaksi) === 'barang_masuk')>Barang Masuk
                            </option>
                            <option value="lokasi" @selected(old('transaksi', $selectedTransaksi) === 'lokasi')>Lokasi</option>
                            <option value="peminjaman" @selected(old('transaksi', $selectedTransaksi) === 'peminjaman')>Peminjaman</option>
                        </select>
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">Cari</button>
                        </div>
                    </div>
                </div>
            </form>

            {{-- grafik  --}}
            <div id="chart"></div>

            <div class="row">
                <div class="col-12 col-sm-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="summary">
                                {{-- data  --}}
                                <div class="form-group">
                                    <label for="">Filter Bulan</label>
                                    <div class="input-group">
                                        <select class="custom-select" name="selectedMonth" id="selectedMonth" required>
                                            <option value=" " selected>Pilih Bulan...</option>
                                            @for ($month = 1; $month <= 12; $month++)
                                                <option value="{{ $month }}"
                                                    @if ($month == old('selectedMonth', $selectedMonth)) selected @endif>
                                                    {{ Carbon\Carbon::create()->month($month)->format('F') }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                                <table id="data-table" class="table table-bordered">
                                    <!-- Table content will be filled dynamically -->
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.41.0/dist/apexcharts.min.js"></script>
    <script>
        var options = {
            series: [{
                name: @if ($data['selectedTransaksi'] === 'peminjaman')
                    'Total Peminjam'
                @else
                    'Total Transaksi'
                @endif ,
                data: @json($data['dataTotalTransaksi'])
            }],
            chart: {
                height: 280,
                type: 'line',
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'straight'
            },
            title: {
                text: 'Grafik Data {{ ucfirst($data['selectedTransaksi']) }} Per Tahun',
                align: 'center'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'],
                    opacity: 0.5
                },
            },
            xaxis: {
                categories: @json($data['dataBulan']),
            },
            yaxis: {
                labels: {
                    formatter: function(value) {
                        @if ($data['selectedTransaksi'] === 'lokasi' || $data['selectedTransaksi'] === 'peminjaman')
                            return Math.round(value);
                        @else
                            return value.toLocaleString("id-ID", {
                                style: "currency",
                                currency: "IDR"
                            });
                        @endif
                    }
                },
            },
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script>
    <script>
        // Add event listener to the select element
        $('#selectedMonth').on('change', function() {
            var selectedMonth = $(this).val();
            var year = $('#year').val();
            var transaksi = $('#transaksi').val();
            // AJAX request to the server
            $.ajax({
                url: "{{ route('laporan') }}",
                method: "GET",
                data: {
                    selectedMonth: selectedMonth,
                    year: year,
                    transaksi: transaksi
                },
                dataType: "json",
                success: function(data) {
                    // Handle the received data and update the table
                    updateTable(data);
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        });

        function updateTable(data) {
            // Get the table element by its ID
            var table = document.getElementById("data-table");
            var transaksi = $('#transaksi').val();

            // Clear existing table data
            table.innerHTML = "";

            // Create table headers
            var thead = document.createElement("thead");
            var headerRow = document.createElement("tr");
            var headers;
            if (transaksi === "barang_masuk") {
                headers = ["No", "Nama Barang", "Jumlah", "Harga Satuan"];
            } else if (transaksi === "lokasi") {
                headers = ["No", "Ruangan", "Jumlah Barang"];
            } else if (transaksi === "peminjaman") {
                headers = ["No", "Peminjam", "Tanggal Peminjaman", "Jumlah Barang Dipinjam"];
            }

            headers.forEach(function(header) {
                var th = document.createElement("th");
                th.textContent = header;
                headerRow.appendChild(th);
            });

            thead.appendChild(headerRow);
            table.appendChild(thead);

            // Create table body and populate it with data
            var tbody = document.createElement("tbody");

            if (transaksi === "barang_masuk") {
                if (data.dataDBM.length > 0) {
                    data.dataDBM.forEach(function(row) {
                        var tr = document.createElement("tr");
                        tr.innerHTML = `
                            <td>${row.id}</td>
                            <td>${row.nama_barang}</td>
                            <td>${row.jumlah}</td>
                            <td>${row.harga}</td>
                        `;
                        tbody.appendChild(tr);
                    });
                } else {
                    var tr = document.createElement("tr");
                    tr.innerHTML = `<td class="text-center" colspan="6"><p>Data tidak tersedia.</p></td>`;
                    tbody.appendChild(tr);
                }
            } else if (transaksi === "lokasi") {
                if (data.dataLokasi.length > 0) {
                    var ruanganCounts = {}; // Object to store counts of detail_barang_id per ruangan_id
                    data.dataLokasi.forEach(function(row) {
                        var ruanganId = row.ruangan_id;
                        var detailBarangId = row.detail_barang_id;

                        if (!ruanganCounts[ruanganId]) {
                            ruanganCounts[ruanganId] = 0;
                        }

                        ruanganCounts[ruanganId]++;
                    });

                    Object.keys(ruanganCounts).forEach(function(ruanganId, index) {
                        var tr = document.createElement("tr");
                        tr.innerHTML = `
                        <td>${index + 1}</td>
                        <td>${ruanganId}</td>
                        <td>${ruanganCounts[ruanganId]}</td>
                    `;
                        tbody.appendChild(tr);
                    });
                } else {
                    var tr = document.createElement("tr");
                    tr.innerHTML = `<td class="text-center" colspan="3"><p>Data tidak tersedia.</p></td>`;
                    tbody.appendChild(tr);
                }
            } else if (transaksi === "peminjaman") {
                if (data.dataPeminjaman.length > 0) {
                    // Create an object to store the total detail barang count for each peminjam_id
                    var detailBarangCountByPeminjamId = {};

                    data.dataPeminjaman.forEach(function(row) {
                        // Get the peminjam_id for the current row
                        var peminjamId = row.peminjam.id;

                        // Check if the peminjam_id exists in the detailBarangCountByPeminjamId object
                        if (!detailBarangCountByPeminjamId[peminjamId]) {
                            // If it doesn't exist, initialize the count to 0
                            detailBarangCountByPeminjamId[peminjamId] = 0;
                        }

                        // Increment the total detail barang count for the current peminjam_id
                        detailBarangCountByPeminjamId[peminjamId]++;

                        // Create the table row for the current dataPeminjaman row
                        var tr = document.createElement("tr");
                        tr.innerHTML = `
                <td>${row.id}</td>
                <td>${row.peminjam.nama}</td>
                <td>${row.tgl_peminjaman}</td>
                <td>${detailBarangCountByPeminjamId[peminjamId]}</td>
            `;
                        tbody.appendChild(tr);
                    });

                } else {
                    var tr = document.createElement("tr");
                    tr.innerHTML = `<td class="text-center" colspan="6"><p>Data tidak tersedia.</p></td>`;
                    tbody.appendChild(tr);
                }
            }


            table.appendChild(tbody);
        }
    </script>
@endpush
