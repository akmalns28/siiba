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
            <form action="{{ route('grafik-barang-masuk') }}" method="get">
                <div class="form-group">
                    <label for="year">Tahun:</label>
                    <select class="custom-select" name="year" id="year" required>
                        @for ($year = $startYear; $year <= $endYear; $year++)
                            <option value="{{ $year }}" @if ($year == $selectedYear) selected @endif>
                                {{ $year }}</option>
                        @endfor
                    </select>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </form>
            <div id="chart"></div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.41.0/dist/apexcharts.min.js"></script>
    <script>
        var options = {
            series: [{
                name: "Barang Masuk",
                data: @json($data['dataTotalBarangMasuk'])
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
                text: 'Grafik Barang Masuk Per Tahun',
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
                        return value.toLocaleString("id-ID", {
                            style: "currency",
                            currency: "IDR"
                        });
                    }
                },
            },
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script>
@endpush
